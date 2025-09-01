<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TemplatePurchase;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Log the raw request for debugging
        Log::info('Midtrans webhook received', [
            'headers' => $request->headers->all(),
            'body' => $request->getContent(),
            'method' => $request->method(),
            'url' => $request->fullUrl()
        ]);

        try {
            // Set Midtrans configuration
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized', true);
            \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds', true);

            // SSL Configuration: Use CA certificate bundle approach
            $caBundlePaths = [
                '/etc/ssl/certs/ca-certificates.crt', // Debian/Ubuntu
                '/etc/ssl/certs/ca-bundle.crt',       // CentOS/RHEL
                '/usr/share/ssl/certs/ca-bundle.crt', // CentOS/RHEL
                '/usr/local/share/certs/ca-root-nss.crt', // FreeBSD
                '/etc/ssl/cert.pem',                  // macOS
                storage_path('cacert.pem'),           // Downloaded bundle
            ];

            $caBundle = null;
            foreach ($caBundlePaths as $path) {
                if (file_exists($path) && is_readable($path)) {
                    $caBundle = $path;
                    break;
                }
            }

            if ($caBundle) {
                // Use proper SSL verification with CA bundle
                \Midtrans\Config::$curlOptions = [
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_CAINFO => $caBundle,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_CONNECTTIMEOUT => 30,
                    CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
                ];
            } else {
                // Fallback for development environment only
                if (config('app.env') !== 'production') {
                    \Midtrans\Config::$curlOptions = [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_CAINFO => null,
                        CURLOPT_CAPATH => null,
                        CURLOPT_TIMEOUT => 60,
                        CURLOPT_CONNECTTIMEOUT => 30,
                        CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
                    ];
                } else {
                    // Production: always use SSL verification
                    \Midtrans\Config::$curlOptions = [
                        CURLOPT_SSL_VERIFYPEER => true,
                        CURLOPT_SSL_VERIFYHOST => 2,
                        CURLOPT_TIMEOUT => 60,
                        CURLOPT_CONNECTTIMEOUT => 30,
                        CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
                    ];
                }
            }

            // Get notification body from Midtrans
            $notification = new \Midtrans\Notification();

            Log::info('Midtrans notification parsed', [
                'order_id' => $notification->order_id,
                'transaction_status' => $notification->transaction_status,
                'payment_type' => $notification->payment_type,
                'fraud_status' => $notification->fraud_status ?? null,
                'gross_amount' => $notification->gross_amount ?? null,
                'transaction_time' => $notification->transaction_time ?? null,
                'signature_key' => $notification->signature_key ?? null
            ]);

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? null;

            // Find template purchase by transaction_id
            $templatePurchase = TemplatePurchase::where('transaction_id', $orderId)->first();

            if (!$templatePurchase) {
                Log::warning('Template purchase not found for order_id: ' . $orderId, [
                    'available_purchases' => TemplatePurchase::select('transaction_id', 'payment_status')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get()
                        ->toArray()
                ]);
                return response()->json(['status' => 'ok']); // Still return ok to prevent retries
            }

            // Log current status before update
            Log::info('Found template purchase', [
                'purchase_id' => $templatePurchase->id,
                'current_status' => $templatePurchase->payment_status,
                'transaction_id' => $templatePurchase->transaction_id
            ]);

            // Update payment status based on transaction status
            $paymentStatus = 'pending';
            $paidAt = null;

            switch ($transactionStatus) {
                case 'capture':
                    // For credit card payments
                    if ($fraudStatus === 'challenge') {
                        $paymentStatus = 'pending'; // Keep as pending for manual review
                        Log::warning('Payment flagged for fraud review', [
                            'order_id' => $orderId,
                            'fraud_status' => $fraudStatus
                        ]);
                    } else {
                        $paymentStatus = 'paid';
                        $paidAt = now();
                    }
                    break;

                case 'settlement':
                    // For other payment methods (bank transfer, etc.)
                    $paymentStatus = 'paid';
                    $paidAt = now();
                    break;

                case 'pending':
                    $paymentStatus = 'pending';
                    break;

                case 'deny':
                case 'cancel':
                case 'expire':
                case 'failure':
                    $paymentStatus = 'failed';
                    break;

                case 'refund':
                case 'partial_refund':
                    $paymentStatus = 'refunded';
                    break;

                default:
                    Log::warning('Unknown transaction status received', [
                        'order_id' => $orderId,
                        'transaction_status' => $transactionStatus
                    ]);
                    $paymentStatus = 'pending';
                    break;
            }

            // Update template purchase
            $templatePurchase->update([
                'payment_status' => $paymentStatus,
                'paid_at' => $paidAt,
                'payment_details' => json_encode(array_merge(
                    json_decode($templatePurchase->payment_details, true) ?? [],
                    [
                        'midtrans_notification' => [
                            'transaction_status' => $transactionStatus,
                            'payment_type' => $notification->payment_type ?? null,
                            'fraud_status' => $fraudStatus,
                            'transaction_time' => $notification->transaction_time ?? null,
                            'gross_amount' => $notification->gross_amount ?? null,
                            'signature_key' => $notification->signature_key ?? null,
                            'updated_at' => now()->toISOString(),
                            'notification_received_at' => now()->toISOString()
                        ]
                    ]
                ))
            ]);

            Log::info('Template purchase updated successfully', [
                'purchase_id' => $templatePurchase->id,
                'transaction_id' => $orderId,
                'old_status' => $templatePurchase->getOriginal('payment_status'),
                'new_status' => $paymentStatus,
                'paid_at' => $paidAt ? $paidAt->toISOString() : null
            ]);

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Midtrans notification error: ' . $e->getMessage(), [
                'exception_class' => get_class($e),
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'request_headers' => $request->headers->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function test(Request $request)
    {
        Log::info('Midtrans test endpoint hit');
        return response()->json(['message' => 'Test endpoint working', 'data' => $request->all()], 200);
    }

    /**
     * Manual payment status check for debugging
     */
    public function checkPaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string'
        ]);

        try {
            $orderId = $request->order_id;

            // Set Midtrans configuration
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production');

            // Check status from Midtrans
            $status = (object) \Midtrans\Transaction::status($orderId);

            Log::info('Manual payment status check', [
                'order_id' => $orderId,
                'midtrans_status' => $status
            ]);

            // Find template purchase
            $templatePurchase = TemplatePurchase::where('transaction_id', $orderId)->first();

            if (!$templatePurchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Template purchase not found',
                    'midtrans_status' => $status
                ], 404);
            }

            // Update status if needed
            $currentStatus = $templatePurchase->payment_status;
            $newStatus = $this->mapMidtransStatus($status->transaction_status, $status->fraud_status ?? null);

            if ($currentStatus !== $newStatus['status']) {
                $templatePurchase->update([
                    'payment_status' => $newStatus['status'],
                    'paid_at' => $newStatus['paid_at'],
                    'payment_details' => json_encode(array_merge(
                        json_decode($templatePurchase->payment_details, true) ?? [],
                        [
                            'manual_status_check' => [
                                'checked_at' => now()->toISOString(),
                                'midtrans_response' => $status,
                                'old_status' => $currentStatus,
                                'new_status' => $newStatus['status']
                            ]
                        ]
                    ))
                ]);

                Log::info('Payment status updated via manual check', [
                    'order_id' => $orderId,
                    'old_status' => $currentStatus,
                    'new_status' => $newStatus['status']
                ]);
            }

            return response()->json([
                'success' => true,
                'order_id' => $orderId,
                'current_database_status' => $templatePurchase->refresh()->payment_status,
                'midtrans_status' => $status->transaction_status,
                'fraud_status' => $status->fraud_status ?? null,
                'payment_type' => $status->payment_type ?? null,
                'gross_amount' => $status->gross_amount ?? null,
                'transaction_time' => $status->transaction_time ?? null,
                'was_updated' => $currentStatus !== $newStatus['status']
            ]);
        } catch (\Exception $e) {
            Log::error('Manual payment status check failed: ' . $e->getMessage(), [
                'order_id' => $request->order_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to check payment status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Map Midtrans status to internal status
     */
    private function mapMidtransStatus($transactionStatus, $fraudStatus = null)
    {
        $paymentStatus = 'pending';
        $paidAt = null;

        switch ($transactionStatus) {
            case 'capture':
                if ($fraudStatus === 'challenge') {
                    $paymentStatus = 'pending';
                } else {
                    $paymentStatus = 'paid';
                    $paidAt = now();
                }
                break;

            case 'settlement':
                $paymentStatus = 'paid';
                $paidAt = now();
                break;

            case 'pending':
                $paymentStatus = 'pending';
                break;

            case 'deny':
            case 'cancel':
            case 'expire':
            case 'failure':
                $paymentStatus = 'failed';
                break;

            case 'refund':
            case 'partial_refund':
                $paymentStatus = 'refunded';
                break;
        }

        return [
            'status' => $paymentStatus,
            'paid_at' => $paidAt
        ];
    }
}
