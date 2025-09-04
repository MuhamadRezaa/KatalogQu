<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\TemplatePurchase;
use App\Models\User;
use App\Models\CatalogTemplate;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Apply auth middleware only to specific methods, allow demo checkout
        $this->middleware('auth')->except(['showTemplate', 'processTemplate', 'showSuccess', 'showPaymentStatus']);
    }

    /**
     * Menyediakan status pembayaran melalui API untuk pengecekan via JavaScript.
     */
    public function checkStatusApi($orderId)
    {
        // Gunakan TemplatePurchase untuk mengambil data
        $purchase = \App\Models\TemplatePurchase::where('transaction_id', $orderId)->first();

        if (!$purchase) {
            return response()->json(['status' => 'error', 'message' => 'Pesanan tidak ditemukan'], 404);
        }

        // Kembalikan status pembayaran dari data yang ditemukan
        return response()->json([
            'status' => 'success',
            'payment_status' => $purchase->payment_status,
        ]);
    }

    /**
     * Show the checkout template page
     *
     * @param string|null $slug The template slug
     */
    public function showTemplate($slug = null)
    {
        // Tampilkan halaman maintenance untuk checkout template
        //return view('payment.checkout.checkout-maintenance', compact('slug'));
        // Pass the slug to the view if provided
        return view('payment.checkout.template', compact('slug'));
    }

    public function showSuccess(Request $request)
    {
        $orderId = $request->query('order_id');

        // Ambil data dari database berdasarkan order_id
        $templatePurchase = null;
        if ($orderId) {
            $templatePurchase = TemplatePurchase::with('catalogTemplate')
                ->where('transaction_id', $orderId)
                ->first();
        }

        // Jika data tidak ditemukan di database, gunakan fallback dari URL parameters
        if ($templatePurchase) {
            return view('payment.checkout.success', [
                'order_id' => $templatePurchase->transaction_id,
                'template_name' => $templatePurchase->catalogTemplate->name ?? 'Template',
                'total_amount' => 'Rp ' . number_format($templatePurchase->amount, 0, ',', '.'),
                'payment_status' => $templatePurchase->payment_status,
                'purchase_data' => $templatePurchase
            ]);
        } else {
            // Fallback ke URL parameters jika data tidak ditemukan
            $templateName = $request->query('template_name');
            $totalAmount = $request->query('total_amount');

            return view('payment.checkout.success', [
                'order_id' => $orderId,
                'template_name' => $templateName,
                'total_amount' => $totalAmount,
                'payment_status' => 'paid',
                'purchase_data' => null
            ]);
        }
    }

    /**
     * Show the payment status/receipt page.
     *
     * @param string $orderId
     * @return \Illuminate\View\View
     */
    public function showPaymentStatus(string $orderId)
    {
        $templatePurchase = TemplatePurchase::with('catalogTemplate')
            ->where('transaction_id', $orderId)
            ->first();

        if (!$templatePurchase) {
            // Handle case where order is not found, maybe redirect to an error page or home
            return redirect()->route('welcome')->with('error', 'Detail pesanan tidak ditemukan.');
        }

        return view('payment.checkout.status', compact('templatePurchase'));
    }

    /**
     * Get payment status via API for AJAX requests.
     *
     * @param string $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaymentStatusApi(string $orderId)
    {
        $templatePurchase = \App\Models\TemplatePurchase::with('catalogTemplate')
            ->where('transaction_id', $orderId)
            ->first();

        if (!$templatePurchase) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'payment_status' => $templatePurchase->payment_status,
            'order_id' => $templatePurchase->transaction_id,
            'template_name' => $templatePurchase->catalogTemplate->name ?? 'N/A',
            'amount' => $templatePurchase->amount,
            // Add any other data you want to send to the frontend
        ]);
    }



    /**
     * Process Midtrans payment
     */
    private function processMidtransPayment($orderId, $templateData, $request)
    {
        // Prepare payment data for Midtrans
        $paymentData = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $templateData['price']
            ],
            'customer_details' => [
                'first_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone
            ],
            'item_details' => [[
                'id' => 'template-' . strtolower(str_replace(' ', '-', $templateData['type'])),
                'price' => (int) $templateData['price'],
                'quantity' => 1,
                'name' => $templateData['name']
            ]]
        ];

        // Get Midtrans Snap Token
        $snapToken = $this->getMidtransSnapToken($paymentData);

        if (!$snapToken) {
            throw new \Exception('Failed to generate payment token');
        }

        // Store order data in session for later processing
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_data' => $paymentData,
                'payment_method' => 'midtrans'
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'midtrans',
            'snap_token' => $snapToken,
            'order_id' => $orderId
        ]);
    }

    /**
     * Process Bank Transfer payment
     */
    private function processBankTransferPayment($orderId, $templateData, $request)
    {
        // Bank account details
        $bankAccounts = [
            'bca' => [
                'bank_name' => 'Bank Central Asia (BCA)',
                'account_number' => '1234567890',
                'account_name' => 'PT KatalogKu Indonesia'
            ],
            'mandiri' => [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'PT KatalogKu Indonesia'
            ],
            'bni' => [
                'bank_name' => 'Bank Negara Indonesia (BNI)',
                'account_number' => '1122334455',
                'account_name' => 'PT KatalogKu Indonesia'
            ],
            'bri' => [
                'bank_name' => 'Bank Rakyat Indonesia (BRI)',
                'account_number' => '5544332211',
                'account_name' => 'PT KatalogKu Indonesia'
            ]
        ];

        // Store order data in session
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_method' => 'bank_transfer',
                'bank_accounts' => $bankAccounts,
                'expires_at' => now()->addHours(24)->format('Y-m-d H:i:s')
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'bank_transfer',
            'order_id' => $orderId,
            'bank_accounts' => $bankAccounts,
            'amount' => (int) $templateData['price'],
            'expires_at' => now()->addHours(24)->format('Y-m-d H:i:s'),
            'instructions' => 'Silakan transfer ke salah satu rekening di atas dengan nominal yang tepat. Pembayaran akan dikonfirmasi dalam 1x24 jam.'
        ]);
    }

    /**
     * Process E-Wallet payment
     */
    private function processEWalletPayment($orderId, $templateData, $request)
    {
        // E-Wallet options
        $eWalletOptions = [
            'gopay' => [
                'name' => 'GoPay',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for GoPay</svg>')
            ],
            'ovo' => [
                'name' => 'OVO',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for OVO</svg>')
            ],
            'dana' => [
                'name' => 'DANA',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for DANA</svg>')
            ],
            'shopeepay' => [
                'name' => 'ShopeePay',
                'phone' => '081234567890',
                'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for ShopeePay</svg>')
            ]
        ];

        // Store order data in session
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_method' => 'e_wallet',
                'e_wallet_options' => $eWalletOptions,
                'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s')
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'e_wallet',
            'order_id' => $orderId,
            'e_wallet_options' => $eWalletOptions,
            'amount' => (int) $templateData['price'],
            'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s'),
            'instructions' => 'Pilih salah satu e-wallet dan lakukan pembayaran sesuai nominal yang tertera.'
        ]);
    }

    /**
     * Process QRIS payment
     */
    private function processQRISPayment($orderId, $templateData, $request)
    {
        // Generate QRIS code (in real implementation, this would be from payment gateway)
        $qrisData = [
            'qr_code' => 'data:image/svg+xml;base64,' . base64_encode(
                '<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg">' .
                    '<rect width="200" height="200" fill="white"/>' .
                    '<text x="100" y="100" text-anchor="middle" font-family="Arial" font-size="12">QRIS Code</text>' .
                    '<text x="100" y="120" text-anchor="middle" font-family="Arial" font-size="10">' . $orderId . '</text>' .
                    '</svg>'
            ),
            'merchant_name' => 'KatalogKu Indonesia',
            'merchant_city' => 'Jakarta'
        ];

        // Store order data in session
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => [
                    'email' => $request->email,
                    'full_name' => $request->full_name,
                    'phone' => $request->phone
                ],
                'template' => $templateData,
                'payment_method' => 'qris',
                'qris_data' => $qrisData,
                'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s')
            ]
        ]);

        return response()->json([
            'success' => true,
            'payment_type' => 'qris',
            'order_id' => $orderId,
            'qris_data' => $qrisData,
            'amount' => (int) $templateData['price'],
            'expires_at' => now()->addMinutes(15)->format('Y-m-d H:i:s'),
            'instructions' => 'Scan QR Code di atas menggunakan aplikasi mobile banking atau e-wallet yang mendukung QRIS.'
        ]);
    }
}
