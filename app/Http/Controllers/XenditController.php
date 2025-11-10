<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TemplatePurchase;
// Tambahkan service dan model yang diperlukan
use App\Services\WhatsvaServiceContract;
use App\Services\XenditService;
use App\Models\UserStore;
use Carbon\Carbon;

class XenditController extends Controller
{
    protected $xenditService;
    protected $whatsvaService;

    public function __construct(XenditService $xenditService, WhatsvaServiceContract $whatsvaService)
    {
        $this->xenditService = $xenditService;
        $this->whatsvaService = $whatsvaService;
    }

    /**
     * Create a new Xendit invoice and save the transaction.
     */
    public function createInvoice(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'email' => 'required|email',
            'name' => 'required|string',
            'catalog_template_id' => 'nullable|integer',
            'user_store_id' => 'nullable|integer',
        ]);

        if ($request->user_store_id) {
            $orderId = 'RENEWAL-' . $request->user_store_id . '-' . time();
            $description = 'Perpanjangan Layanan Toko';
            $amount = 100000;
        } else {
            $orderId = 'KatalogQu-' . time();
            $description = 'Pembelian Template ' . $request->catalog_template_id;
            $amount = 100000;
        }

        TemplatePurchase::create([
            'transaction_id' => $orderId,
            'user_id' => $request->user_id,
            'catalog_template_id' => $request->catalog_template_id,
            'amount' => $amount,
            'final_amount' => $amount,
            'payment_status' => 'pending',
            'payment_details' => json_encode(['user_store_id' => $request->user_store_id, 'request_type' => $request->user_store_id ? 'extension' : 'new_purchase']),
            // Kolom expires_at dihilangkan dari sini karena akan diperbarui setelah pembayaran berhasil
        ]);

        try {
            $invoice = $this->xenditService->createInvoice(
                $orderId,
                $amount,
                $request->email,
                $description,
                $request->name,
                'renewal'
            );

            return response()->json([
                'status' => 'success',
                'redirect_url' => $invoice['invoice_url']
            ]);
        } catch (\Exception $e) {
            Log::error('Xendit Invoice Creation Failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal membuat invoice.'], 500);
        }
    }

    /**
     * Handle incoming Xendit notifications (callbacks/webhooks).
     */
    public function notificationHandler(Request $request)
    {
        Log::info('Xendit notification received.', $request->all());

        $payload = $request->all();

        if (isset($payload['status']) && ($payload['status'] === 'PAID' || $payload['status'] === 'SETTLED')) {
            $orderId = $payload['external_id'];

            $purchase = TemplatePurchase::where('transaction_id', $orderId)
                ->where('payment_status', 'pending')
                ->first();

            if ($purchase) {
                $purchase->payment_status = strtolower($payload['status']);

                // Ambil detail yang sudah ada ('request_type', 'user_store_id')
                $paymentDetails = json_decode($purchase->payment_details, true) ?? [];
                
                // Tambahkan payload callback dari Xendit ke dalam details untuk arsip
                $paymentDetails['xendit_callback_payload'] = $payload;
                
                // Simpan kembali gabungan details
                $purchase->payment_details = json_encode($paymentDetails);
                $purchase->save();

                // Perbarui masa aktif di tabel user_stores jika ini perpanjangan
                if (isset($paymentDetails['request_type']) && $paymentDetails['request_type'] === 'extension') {
                    Log::info('RENEWAL_WEBHOOK: Processing extension', ['purchase_id' => $purchase->id]);
                    $userStore = UserStore::find($paymentDetails['user_store_id']);
                    if ($userStore) {
                        $duration = $purchase->duration_months ?? 12; // Fallback to 12
                        Log::info('RENEWAL_WEBHOOK: Data', [
                            'user_store_id' => $userStore->id,
                            'purchase_duration' => $purchase->duration_months,
                            'calculated_duration' => $duration,
                            'current_expiry' => $userStore->expires_at
                        ]);

                        $currentExpiry = Carbon::parse($userStore->expires_at);
                        $newExpiryDate = $currentExpiry->isFuture() ? $currentExpiry->addMonths($duration) : now()->addMonths($duration);

                        $userStore->update([
                            'expires_at' => $newExpiryDate,
                        ]);
                        Log::info('User store ' . $userStore->id . ' expires_at updated successfully to ' . $newExpiryDate->toDateTimeString());

                        // Kirim notifikasi perpanjangan berhasil
                        try {
                            $user = $userStore->user;
                            if ($user && $user->phone_number) {
                                $this->whatsvaService->sendMessage(
                                    $user->phone_number,
                                    $this->whatsvaService->buildMessage('perpanjangan_berhasil_pengguna', [
                                        'name' => $user->name,
                                        'store_name' => $userStore->store_name,
                                        'new_expires_at' => $newExpiryDate->format('d M Y'),
                                    ])
                                );

                                $this->whatsvaService->notifyAdmins('admin_notifikasi_perpanjangan_berhasil', [
                                    'store_name' => $userStore->store_name,
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'new_expires_at' => $newExpiryDate->format('d M Y'),
                                ]);
                            }
                        } catch (\Exception $e) {
                            Log::error('WHATSAPP_RENEWAL_NOTIFICATION_ERROR: ' . $e->getMessage(), ['user_store_id' => $userStore->id]);
                        }

                    } else {
                        Log::error('RENEWAL_WEBHOOK: Toko Pengguna tidak ditemukan', ['user_store_id' => $paymentDetails['user_store_id']]);
                    }
                } else {
                    // Logika untuk pembelian baru (bukan perpanjangan)
                    Log::info('Status pembayaran diperbarui menjadi LUNAS untuk pesanan: ' . $orderId);

                    // Kirim notifikasi WhatsApp untuk pembelian baru
                    try {
                        $user = $purchase->user;
                        if ($user && $user->phone_number) {
                            // Kirim pesan ke pengguna
                            $messageToUser = $this->whatsvaService->buildMessage('setelah_checkout', [
                                'name' => $user->name,
                                'order_id' => $purchase->transaction_id,
                                'total_amount' => 'Rp ' . number_format($purchase->final_amount, 0, ',', '.'),
                            ]);
                            $this->whatsvaService->sendMessage($user->phone_number, $messageToUser);

                            // Kirim notifikasi ke admin
                            $this->whatsvaService->notifyAdmins('admin_notifikasi_pesanan_baru', [
                                'order_id' => $purchase->transaction_id,
                                'name' => $user->name,
                                'total_amount' => 'Rp ' . number_format($purchase->final_amount, 0, ',', '.'),
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('WHATSAPP_NOTIFICATION_ERROR: ' . $e->getMessage(), ['order_id' => $orderId]);
                    }
                }
            } else {
                Log::warning('Menerima notifikasi Xendit untuk pesanan yang tidak dikenal atau sudah diproses: ' . $orderId);
            }
        }

        return response()->json(['status' => 'Notifikasi diterima'], 200);
    }
}
