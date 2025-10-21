<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TemplatePurchase;
// Tambahkan service dan model yang diperlukan
use App\Services\XenditService;
use App\Models\UserStore;
use Carbon\Carbon;

class XenditController extends Controller
{
    protected $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->xenditService = $xenditService;
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
                    } else {
                        Log::error('RENEWAL_WEBHOOK: Toko Pengguna tidak ditemukan', ['user_store_id' => $paymentDetails['user_store_id']]);
                    }
                }

                Log::info('Status pembayaran diperbarui menjadi LUNAS untuk pesanan: ' . $orderId);
            } else {
                Log::warning('Menerima notifikasi Xendit untuk pesanan yang tidak dikenal atau sudah diproses: ' . $orderId);
            }
        }

        return response()->json(['status' => 'Notifikasi diterima'], 200);
    }
}
