<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Payment;
use App\Models\UserStore;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CatalogTemplate;
use App\Services\XenditService;
use App\Models\TemplatePurchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * @var XenditService
     */
    protected $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->middleware('auth')->except(['showTemplate', 'processTemplate', 'showSuccess', 'showPaymentStatus', 'createXenditInvoiceApi']);
        $this->xenditService = $xenditService;
    }

    public function checkStatusApi($orderId)
    {
        $purchase = \App\Models\TemplatePurchase::where('transaction_id', $orderId)->first();
        if (!$purchase) {
            return response()->json(['status' => 'error', 'message' => 'Pesanan tidak ditemukan'], 404);
        }
        return response()->json([
            'status' => 'success',
            'payment_status' => $purchase->payment_status,
        ]);
    }

    public function showTemplate($slug = null)
    {
        return view('payment.checkout.template', compact('slug'));
    }

    public function showSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $templatePurchase = TemplatePurchase::with('catalogTemplate')->where('transaction_id', $orderId)->first();
        if ($templatePurchase) {
            $displayStatus = ($request->query('payment_status') === 'paid') ? 'paid' : $templatePurchase->payment_status;
            return view('payment.checkout.success', [
                'order_id' => $templatePurchase->transaction_id,
                'template_name' => $templatePurchase->catalogTemplate->name ?? 'Template',
                'total_amount' => 'Rp ' . number_format($templatePurchase->final_amount, 0, ',', '.'),
                'payment_status' => $displayStatus,
                'purchase_data' => $templatePurchase
            ]);
        } else {
            return view('payment.checkout.success', [
                'order_id' => $orderId,
                'template_name' => $request->query('template_name'),
                'total_amount' => $request->query('total_amount'),
                'payment_status' => 'paid',
                'purchase_data' => null
            ]);
        }
    }

    public function showPaymentStatus(string $orderId)
    {
        $templatePurchase = TemplatePurchase::with('catalogTemplate')->where('transaction_id', $orderId)->firstOrFail();
        return view('payment.checkout.status', compact('templatePurchase'));
    }

    public function getPaymentStatusApi(string $orderId)
    {
        $templatePurchase = \App\Models\TemplatePurchase::with('catalogTemplate')->where('transaction_id', $orderId)->first();
        if (!$templatePurchase) {
            return response()->json(['status' => 'error', 'message' => 'Order not found.'], 404);
        }
        return response()->json([
            'status' => 'success',
            'payment_status' => $templatePurchase->payment_status,
            'order_id' => $templatePurchase->transaction_id,
            'template_name' => $templatePurchase->catalogTemplate->name ?? 'N/A',
            'amount' => $templatePurchase->amount,
        ]);
    }

    public function processTemplate(Request $request)
    {
        Log::info('Checkout process started.', $request->all());
        $validator = Validator::make($request->all(), [
            'template_slug' => 'required|string|exists:catalog_templates,slug',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);
        if ($validator->fails()) {
            Log::error('Checkout validation failed.', $validator->errors()->toArray());
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }
        $template = CatalogTemplate::where('slug', $request->input('template_slug'))->firstOrFail();
        $orderId = 'KatalogQu-' . strtoupper($template->slug) . '-' . time();
        $templateData = [
            'price' => $template->price,
            'name' => $template->name,
            'type' => $template->category->name ?? 'Template'
        ];
        $paymentMethod = $request->input('payment_method');
        if ($paymentMethod === 'xendit') {
            return $this->processXenditPayment($orderId, $templateData, $request);
        } elseif ($paymentMethod === 'bank_transfer') {
            return $this->processBankTransferPayment($orderId, $templateData, $request);
        }
        return response()->json(['success' => false, 'message' => 'Metode pembayaran tidak valid.'], 400);
    }

    private function processXenditPayment($orderId, $templateData, $request)
    {
        try {
            $invoice = $this->xenditService->createInvoice(
                $orderId,
                (int) $templateData['price'],
                $request->email,
                $templateData['name'],
                $request->full_name,
                'new_purchase' // Parameter keenam
            );
            session([
                'checkout_order' => [
                    'order_id' => $orderId,
                    'customer' => [
                        'email' => $request->email,
                        'full_name' => $request->full_name,
                        'phone' => $request->phone
                    ],
                    'template' => $templateData,
                    'payment_method' => 'xendit'
                ]
            ]);
            return response()->json([
                'success' => true,
                'payment_type' => 'xendit',
                'invoice_url' => $invoice->getInvoiceUrl(),
                'order_id' => $orderId
            ]);
        } catch (\Exception $e) {
            Log::error('Xendit Payment Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat link pembayaran Xendit.'
            ], 500);
        }
    }

    private function processBankTransferPayment($orderId, $templateData, $request)
    {
        $bankAccounts = [
            'bca' => ['bank_name' => 'Bank Central Asia (BCA)', 'account_number' => '1234567890', 'account_name' => 'PT KatalogKu Indonesia'],
            'mandiri' => ['bank_name' => 'Bank Mandiri', 'account_number' => '0987654321', 'account_name' => 'PT KatalogKu Indonesia'],
            'bni' => ['bank_name' => 'Bank Negara Indonesia (BNI)', 'account_number' => '1122334455', 'account_name' => 'PT KatalogKu Indonesia'],
            'bri' => ['bank_name' => 'Bank Rakyat Indonesia (BRI)', 'account_number' => '5544332211', 'account_name' => 'PT KatalogKu Indonesia']
        ];
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => ['email' => $request->email, 'full_name' => $request->full_name, 'phone' => $request->phone],
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

    private function processEWalletPayment($orderId, $templateData, $request)
    {
        $eWalletOptions = [
            'gopay' => ['name' => 'GoPay', 'phone' => '081234567890', 'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for GoPay</svg>')],
            'ovo' => ['name' => 'OVO', 'phone' => '081234567890', 'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for OVO</svg>')],
            'dana' => ['name' => 'DANA', 'phone' => '081234567890', 'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for DANA</svg>')],
            'shopeepay' => ['name' => 'ShopeePay', 'phone' => '081234567890', 'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg>QR Code for ShopeePay</svg>')]
        ];
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => ['email' => $request->email, 'full_name' => $request->full_name, 'phone' => $request->phone],
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

    private function processQRISPayment($orderId, $templateData, $request)
    {
        $qrisData = [
            'qr_code' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg"><rect width="200" height="200" fill="white"/><text x="100" y="100" text-anchor="middle" font-family="Arial" font-size="12">QRIS Code</text><text x="100" y="120" text-anchor="middle" font-family="Arial" font-size="10">' . $orderId . '</text></svg>'),
            'merchant_name' => 'KatalogKu Indonesia',
            'merchant_city' => 'Jakarta'
        ];
        session([
            'checkout_order' => [
                'order_id' => $orderId,
                'customer' => ['email' => $request->email, 'full_name' => $request->full_name, 'phone' => $request->phone],
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

    public function cancelPayment(Request $request)
    {
        $validated = $request->validate(['order_id' => 'required|string|max:255']);
        $orderId = $validated['order_id'];

        Log::info('Checkout cancellation request received', ['order_id' => $orderId]);

        $templatePurchase = \App\Models\TemplatePurchase::where('transaction_id', $orderId)
            ->where('payment_status', 'pending')
            ->first();

        if (!$templatePurchase) {
            Log::warning('Could not find a pending TemplatePurchase record to cancel.', ['order_id' => $orderId]);
            return response()->json(['success' => true, 'message' => 'Order is not pending or does not exist.']);
        }

        try {
            DB::beginTransaction();

            $details = json_decode((string) $templatePurchase->payment_details, true);
            if (isset($details['xendit_invoice_id'])) {
                $xenditInvoiceId = $details['xendit_invoice_id'];
                Log::info('Attempting to expire Xendit invoice.', ['xendit_invoice_id' => $xenditInvoiceId]);

                $this->xenditService->expireInvoice($xenditInvoiceId);

                Log::info('Successfully expired Xendit invoice.', ['xendit_invoice_id' => $xenditInvoiceId]);
            } else {
                Log::warning('No Xendit invoice ID found for cancellation.', ['order_id' => $orderId]);
            }

            $templatePurchase->payment_status = 'cancelled';
            $templatePurchase->save();
            Log::info('TemplatePurchase status updated to cancelled.', ['id' => $templatePurchase->id]);

            $userStore = \App\Models\UserStore::where('payment_transaction_id', $orderId)
                ->where('setup_status', 'pending')
                ->first();

            if ($userStore) {
                $userStore->setup_status = 'cancelled';
                $userStore->is_active = false;
                $userStore->save();
                Log::info('UserStore status updated to cancelled.', ['id' => $userStore->id]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaction successfully cancelled.',
            ]);
        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }

            Log::error('Error during checkout cancellation', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel transaction.',
            ], 500);
        }
    }

    public function createXenditInvoiceApi(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('API: Xendit invoice request received', [
            'timestamp' => now()->toISOString(),
            'ip_address' => $request->ip(),
        ]);

        $validated = $request->validate([
            'template_data' => 'required|array',
            'customer_data' => 'required|array',
            'template_data.id' => 'required|string',
            'customer_data.email' => 'required|email',
            'customer_data.first_name' => 'required|string',
        ]);

        try {
            DB::beginTransaction(); // Mulai transaksi di sini

            $templateData = $validated['template_data'];
            $customerData = $validated['customer_data'];

            $catalogTemplate = \App\Models\CatalogTemplate::where('slug', $templateData['id'])->firstOrFail();

            $base_price = (float) $catalogTemplate->price;
            $tax_rate = 0.11;
            $calculated_tax = round($base_price * $tax_rate);
            $calculated_total = $base_price + $calculated_tax;

            $orderId = 'KatalogQu-' . strtoupper($templateData['id']) . '-' . time();

            $guestUser = \App\Models\User::firstOrCreate(
                ['email' => $customerData['email']],
                [
                    'name' => $customerData['first_name'] . ' ' . ($customerData['last_name'] ?? ''),
                    'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                    'email_verified_at' => now()
                ]
            );

            \App\Models\UserStore::updateOrCreate(
                ['payment_transaction_id' => $orderId],
                [
                    'user_id' => $guestUser->id,
                    'catalog_template_id' => $catalogTemplate->id,
                    'store_name' => 'Store-' . time(),
                    'subdomain' => 'store-' . strtolower(Str::random(8)),
                    'setup_status' => 'pending',
                    'is_active' => false,
                    'payment_transaction_id' => $orderId,
                ]
            );

            $purchase = \App\Models\TemplatePurchase::create([
                'transaction_id' => $orderId,
                'user_id' => $guestUser->id,
                'catalog_template_id' => $catalogTemplate->id,
                'amount' => $base_price,
                'final_amount' => $calculated_total,
                'payment_method' => 'xendit',
                'payment_status' => 'pending',
                'payment_details' => json_encode(['flow_source' => 'createXenditInvoiceApi']),
            ]);

            $invoice = $this->xenditService->createInvoice(
                $orderId,
                $calculated_total,
                $customerData['email'],
                $catalogTemplate->name,
                $customerData['first_name'],
                'new_purchase' // Tambahkan parameter keenam ini
            );

            if ($invoice && $invoice->getId()) {
                $details = json_decode((string) $purchase->payment_details, true) ?? [];
                $details['xendit_invoice_id'] = $invoice->getId();
                $purchase->payment_details = json_encode($details);
                $purchase->save();
            }

            DB::commit(); // Selesai transaksi di sini

            return response()->json([
                'success' => true,
                'invoice_url' => $invoice->getInvoiceUrl(),
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error
            \Illuminate\Support\Facades\Log::error('Xendit Invoice Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran dengan Xendit.',
                'debug_message' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // ========================================
    // METODE BARU UNTUK PERPANJANGAN
    // ========================================

    /**
     * Menampilkan halaman checkout untuk perpanjangan.
     *
     * @param Tenant $tenant
     * @return \Illuminate\View\View
     */
    public function showRenewalCheckout(Tenant $tenant)
    {
        $userStore = UserStore::where('user_id', Auth::id())
            ->where('tenant_id', $tenant->id)
            ->first();

        if (!$userStore) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke toko ini.');
        }

        // Cari template dari pembelian terakhir yang sudah berhasil (paid)
        $latestPurchase = TemplatePurchase::where('user_id', Auth::id())
            ->where('catalog_template_id', $userStore->catalog_template_id)
            ->where('payment_status', 'paid')
            ->orderBy('expires_at', 'desc')
            ->first();

        // Jika tidak ada pembelian yang berhasil, alihkan pengguna.
        if (!$latestPurchase) {
            return redirect()->route('home')->with('error', 'Anda belum memiliki paket langganan yang aktif. Silakan beli paket baru.');
        }

        // Ambil template dari pembelian terakhir tersebut.
        $currentTemplate = $latestPurchase->catalogTemplate;

        // Sekarang, kirimkan hanya satu template ini ke view
        return view('payment.checkout.renewal', compact('tenant', 'userStore', 'currentTemplate'));
    }

    /**
     * Memproses perpanjangan langganan.
     *
     * @param Request $request
     * @param Tenant $tenant
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function processRenewal(Request $request)
    {
        // Validasi input awal
        $validator = Validator::make($request->all(), [
            'user_store_id' => 'required|exists:user_stores,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validasi gagal.', 'details' => $validator->errors()], 400);
        }

        // Cari UserStore dan relasi tenant-nya
        $userStore = UserStore::with('tenant')
            ->find($request->input('user_store_id'));

        // Cek jika UserStore tidak ditemukan
        if (!$userStore) {
            return response()->json(['error' => 'Toko tidak ditemukan.'], 404);
        }

        $tenant = $userStore->tenant;
        if (!$tenant) {
            Log::error('Tenant tidak ditemukan untuk UserStore', ['user_store_id' => $userStore->id]);
            return response()->json(['error' => 'Data tenant tidak valid.'], 500);
        }

        // Pengecekan otorisasi
        $loggedInUserId = Auth::id();
        $tenantOwnerId = $userStore->user_id;

        Log::info('Otorisasi perpanjangan toko', [
            'logged_in_user_id' => $loggedInUserId,
            'tenant_owner_id' => $tenantOwnerId,
            'user_store_id' => $userStore->id
        ]);

        if ($loggedInUserId !== $tenantOwnerId) {
            return response()->json(['error' => 'Akses ditolak. Anda tidak memiliki izin untuk mengelola toko ini.'], 403);
        }

        // Validasi tambahan
        $validated = $request->validate([
            'template_id' => 'required|exists:catalog_templates,id',
            'payment_method' => 'required|in:xendit,bank_transfer,e_wallet,qris',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Dapatkan tanggal kedaluwarsa terakhir
            $lastPurchase = TemplatePurchase::where('user_id', $user->id)
                ->where('payment_status', 'paid')
                ->orderBy('expires_at', 'desc')
                ->first();

            // Perbaikan: Ambil objek CatalogTemplate untuk durasi dan harga
            $catalogTemplate = CatalogTemplate::findOrFail($validated['template_id']);

            // Hitung tanggal kedaluwarsa baru
            $newExpiry = now()->addMonths($catalogTemplate->subscription_duration_months);
            if ($lastPurchase && $lastPurchase->expires_at > now()) {
                $newExpiry = $lastPurchase->expires_at->addMonths($catalogTemplate->subscription_duration_months);
            }

            // Buat ID transaksi unik
            $orderId = 'RENEWAL-' . Str::upper(Str::random(8)) . '-' . now()->timestamp;
            $base_price = (float) $catalogTemplate->price;
            $tax_rate = 0.11;
            $calculated_tax = round($base_price * $tax_rate);
            $calculated_total = $base_price + $calculated_tax;
            //$finalAmount = $catalogTemplate->price;

            // Simpan data perpanjangan
            $purchase = new TemplatePurchase();
            $purchase->user_id = $user->id;
            $purchase->catalog_template_id = $catalogTemplate->id;
            $purchase->transaction_id = $orderId;
            $purchase->amount = $base_price;
            $purchase->final_amount = $calculated_total;
            $purchase->payment_status = 'pending';
            $purchase->payment_method = $validated['payment_method'];
            $purchase->expires_at = $newExpiry;

            // Menambahkan detail penting untuk webhook perpanjangan
            $details = [
                'request_type' => 'extension',
                'user_store_id' => $userStore->id,
            ];
            $purchase->payment_details = json_encode($details);

            $purchase->save();

            $userStore->payment_transaction_id = $orderId;
            $userStore->save();

            if ($validated['payment_method'] === 'xendit') {
                $invoice = $this->xenditService->createInvoice(
                    $orderId,
                    $calculated_total,
                    $user->email,
                    'Perpanjangan Layanan Toko',
                    $user->name,
                    'renewal' // <--- Tambahkan parameter keenam ini
                );

                if ($invoice && $invoice->getId()) {
                    $details = json_decode((string) $purchase->payment_details, true) ?? [];
                    $details['xendit_invoice_id'] = $invoice->getId();
                    $purchase->payment_details = json_encode($details);
                    $purchase->save();
                }

                DB::commit();

                return response()->json([
                    'success' => true,
                    'redirect_url' => $invoice->getInvoiceUrl()
                ]);
            }

            DB::commit();

            return redirect()->route('renewal.manual_payment', ['order_id' => $orderId]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal memproses perpanjangan toko', [
                'error' => $e->getMessage(),
                'user_store_id' => $userStore->id ?? 'unknown'
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses perpanjangan. Silakan coba lagi.'
            ], 500);
        }
    }


    /**
     * Menampilkan halaman sukses untuk perpanjangan langganan.
     * Ini akan menjadi halaman "loading" atau "sedang memproses".
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function handlePaymentCallback(Request $request)
    {
        // Mendapatkan ID pesanan dari data respons pembayaran
        $orderId = $request->input('order_id');
        $paymentStatus = $request->input('transaction_status');

        Log::info("Menerima callback dari penyedia pembayaran. Order ID: {$orderId}, Status: {$paymentStatus}");

        $templatePurchase = TemplatePurchase::where('transaction_id', $orderId)->first();

        if (!$templatePurchase) {
            Log::warning("Callback: Transaksi tidak ditemukan untuk order ID: {$orderId}");
            return redirect()->route('home')->withErrors(['message' => 'Transaksi tidak ditemukan.']);
        }

        // Perbarui status di database
        if (in_array($paymentStatus, ['paid', 'settlement'])) {
            $templatePurchase->payment_status = 'paid';
            $templatePurchase->save();
            Log::info("Callback: Status untuk order {$orderId} berhasil diperbarui menjadi 'paid'.");

            // --- PENGALIHAN LANGSUNG ---
            return redirect()->route('renewal.success', ['order_id' => $orderId]);
        } else {
            // Jika status tidak berhasil, alihkan ke halaman utama dengan pesan error.
            Log::warning("Callback: Pembayaran untuk order {$orderId} gagal. Status: {$paymentStatus}");
            return redirect()->route('home')->withErrors(['message' => 'Pembayaran gagal. Silakan coba lagi.']);
        }
    }

    /**
     * Tampilan untuk status pembayaran perpanjangan (berhasil).
     *
     * @return \Illuminate\View\View
     */
    public function renewalSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $templatePurchase = TemplatePurchase::where('transaction_id', $orderId)->first();

        if (!$templatePurchase) {
            return redirect()->route('home')->withErrors(['message' => 'Transaksi tidak ditemukan.']);
        }

        // Dapatkan user store yang terkait dengan pembelian
        $userStore = UserStore::where('payment_transaction_id', $templatePurchase->transaction_id)->first();

        if (!$userStore) {
            return redirect()->route('home')->withErrors(['message' => 'Data toko pengguna tidak ditemukan.']);
        }
        $tenant = $userStore->tenant;

        // Ambil pembelian terbaru dari database, yang akan digunakan sebagai $latestPurchase
        $latestPurchase = TemplatePurchase::where('user_id', $templatePurchase->user_id)
            ->whereIn('payment_status', ['paid', 'settlement'])
            ->orderBy('created_at', 'desc')
            ->first();

        // Kirimkan variabel yang diperlukan ke view
        return view('payment.checkout.successrenewal', compact('templatePurchase', 'userStore', 'tenant', 'latestPurchase'));
    }
}
