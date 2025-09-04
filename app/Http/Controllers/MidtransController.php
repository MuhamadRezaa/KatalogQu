<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\TemplatePurchase;
use App\Models\Payment;
use Midtrans\Config;
// use App\Models\User; // Added for potential use cases
// use Midtrans\Notification;

class MidtransController extends Controller
{
    /**
     * Handles Midtrans payment notification webhook.
     * This is the single source of truth for payment status updates.
     */
    public function notificationHandler(Request $request)
    {
        Log::info('Midtrans webhook received', [
            'headers' => $request->headers->all(),
            'body'    => $request->getContent(),
        ]);

        // 1) Decode JSON
        $raw = $request->getContent();
        $data = json_decode($raw, true) ?? [];
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Invalid JSON payload', ['err' => json_last_error_msg()]);
            return response()->json(['status' => 'ok']); // acknowledge, hindari retry
        }

        // 2) Field wajib untuk signature
        foreach (['order_id', 'status_code', 'gross_amount', 'signature_key'] as $k) {
            if (!array_key_exists($k, $data)) {
                Log::error('Midtrans payload missing key', ['missing' => $k, 'payload' => $data]);
                return response()->json(['status' => 'ok']);
            }
        }

        $orderId   = (string) $data['order_id'];
        $statusCode = (string) $data['status_code'];
        $grossAmount = (string) $data['gross_amount'];          // STRING persis dari body
        $sigMid = strtolower((string) $data['signature_key']);

        $serverKey = (string) config('services.midtrans.server_key', '');
        if ($serverKey === '') {
            Log::error('Midtrans server key empty');
            return response()->json(['status' => 'ok']);
        }

        // 3) Verifikasi signature
        $sigLocal = strtolower(hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey));
        if (!hash_equals($sigLocal, $sigMid)) {
            Log::error('Signature mismatch', [
                'order_id'  => $orderId,
                'status_code' => $statusCode,
                'gross_amount_body' => $grossAmount,
                'sig_local' => substr($sigLocal, 0, 12) . '…',
                'sig_mid'   => substr($sigMid, 0, 12) . '…',
            ]);
            return response()->json(['status' => 'ok']); // abaikan update
        }

        // 4) Status dan tipe pembayaran dari Midtrans
        $trxStatus   = $data['transaction_status'] ?? null;
        $fraudStatus = $data['fraud_status'] ?? null;
        $paymentTypeRaw = $data['payment_type'] ?? null; // Ambil tipe pembayaran mentah

        // --- AWAL PERUBAHAN ---
        // Tentukan metode pembayaran yang akan disimpan
        $paymentMethod = 'Midtrans'; // Default untuk semua pembayaran via Midtrans
        if (strtolower((string)$paymentTypeRaw) === 'qris') {
            $paymentMethod = 'QRIS'; // Ubah menjadi 'QRIS' jika tipenya adalah qris
        }
        // --- AKHIR PERUBAHAN ---

        Log::info('Midtrans notification parsed', [
            'order_id'     => $orderId,
            'trx_status'   => $trxStatus,
            'payment_type' => $paymentTypeRaw,
            'final_method' => $paymentMethod, // Log metode final yang akan disimpan
            'fraud_status' => $fraudStatus,
            'merchant_id'  => $data['merchant_id'] ?? null,
            'currency'     => $data['currency'] ?? null,
        ]);

        // 5) Transaksi & lock
        DB::beginTransaction();
        try {
            $payment = Payment::where('transaction_id', $orderId)
                ->lockForUpdate()
                ->first();

            $tpl = TemplatePurchase::where('transaction_id', $orderId)
                ->lockForUpdate()
                ->first();

            if (!$payment && !$tpl) {
                Log::warning('No Payment & TemplatePurchase found', ['order_id' => $orderId]);
                DB::commit();
                return response()->json(['status' => 'ok']);
            }

            // 6) Mapping status internal + paidAt
            $internal = 'pending';
            $paidAt = null;

            if ($trxStatus === 'capture' || $trxStatus === 'settlement') {
                if (($fraudStatus ?? 'accept') === 'accept') {
                    $internal = 'paid';
                    $paidAt = isset($data['settlement_time'])
                        ? \Carbon\Carbon::parse($data['settlement_time'], 'Asia/Jakarta')
                        ->timezone(config('app.timezone', 'UTC'))
                        : now();
                } elseif (($fraudStatus ?? null) === 'challenge') {
                    $internal = 'pending';
                    Log::warning('FDS challenge', ['order_id' => $orderId]);
                } else {
                    $internal = 'failed';
                }
            } elseif ($trxStatus === 'pending') {
                $internal = 'pending';
            } elseif (in_array($trxStatus, ['deny', 'cancel', 'expire', 'failure'], true)) {
                $internal = 'failed';
            } elseif (in_array($trxStatus, ['refund', 'partial_refund'], true)) {
                $internal = 'refunded';
            }

            Log::info('Before update', [
                'order_id'        => $orderId,
                'payment_status'  => $payment->status ?? null,
                'template_status' => $tpl->payment_status ?? null,
                'internal_status' => $internal,
            ]);

            // 7) Update per entitas (idempoten)
            if ($payment && $payment->status === 'pending') {
                $payment->status = $internal;
                $payment->paid_at = $paidAt;
                $payment->payment_method = $paymentMethod; // Gunakan variabel yang sudah diproses
                $payment->payment_details = array_merge(
                    is_array($payment->payment_details) ? $payment->payment_details : (json_decode($payment->payment_details, true) ?? []),
                    ['midtrans_notification' => $data]
                );
                $payment->save();
            }

            if ($tpl && strtolower((string)$tpl->payment_status) === 'pending') {
                $tpl->payment_status = $internal;
                $tpl->paid_at = $paidAt;
                $tpl->payment_method = $paymentMethod; // Gunakan variabel yang sudah diproses
                $tpl->payment_details = array_merge(
                    is_array($tpl->payment_details) ? $tpl->payment_details : (json_decode($tpl->payment_details, true) ?? []),
                    ['midtrans_notification' => $data]
                );
                $tpl->save();
            }

            DB::commit();
            Log::info('Updated OK', ['order_id' => $orderId, 'status' => $internal]);
            return response()->json(['status' => 'ok']);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Process error', ['order_id' => $orderId, 'err' => $e->getMessage()]);
            return response()->json(['status' => 'ok']); // acknowledge
        }
    }

    /**
     * Manual payment status check for debugging.
     * This method remains for manual checks but should not be part of the primary flow.
     */
    public function checkPaymentStatus(Request $request)
    {
        $request->validate(['order_id' => 'required|string']);
        $orderId = $request->order_id;

        try {
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');

            $status = \Midtrans\Transaction::status($orderId);

            Log::info('Manual payment status check', [
                'order_id' => $orderId,
                'midtrans_status' => $status
            ]);

            return response()->json([
                'success' => true,
                'midtrans_status' => $status
            ]);
        } catch (\Exception $e) {
            Log::error('Manual payment status check failed: . ' . $e->getMessage(), ['order_id' => $orderId]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to check payment status: ' . $e->getMessage()
            ], 500);
        }
    }
}
