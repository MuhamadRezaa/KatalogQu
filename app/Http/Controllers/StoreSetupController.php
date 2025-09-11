<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StoreAdmin;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain;

class StoreSetupController extends Controller
{
    /**
     * Menampilkan form setup toko setelah pembayaran.
     * UPDATED: Enhanced to work with UserStore records created during payment initiation
     */
    public function showForm(Request $request)
    {
        $orderId = $request->query('order_id');

        // First, try to find existing UserStore record created during payment initiation
        $userStore = null;
        if ($orderId) {
            $userStore = UserStore::where('payment_transaction_id', $orderId)->first();
        }

        // If UserStore exists and already completed, redirect to admin
        if ($userStore && $userStore->setup_status === 'completed' && $userStore->is_active) {
            $domain = $userStore->subdomain . '.' . config('app.domain', 'localhost');
            return redirect('http://' . $domain . '/admin')->with('success', 'Store already set up. Welcome back!');
        }

        // If UserStore exists and is pending validation, redirect to pending page
        if ($userStore && $userStore->setup_status === 'pending_validation') {
            return redirect()->route('store.setup.pending', ['store_id' => $userStore->id]);
        }

        // Try to find payment record (legacy support)
        $payment = null;
        if ($orderId) {
            $payment = Payment::where('transaction_id', $orderId)->first();
        }

        // If no payment record exists, try to create one from template purchase
        if (!$payment && $orderId) {
            $templatePurchase = \App\Models\TemplatePurchase::with('catalogTemplate')->where('transaction_id', $orderId)->first();
            if ($templatePurchase) {
                $payment = Payment::firstOrCreate(
                    ['transaction_id' => $orderId],
                    [
                        'user_id' => $templatePurchase->user_id,
                        'catalog_template_id' => $templatePurchase->catalog_template_id,
                        'store_name' => 'Store Setup - ' . $orderId,
                        'amount' => $templatePurchase->final_amount,
                        'final_amount' => $templatePurchase->final_amount,
                        'payment_method' => 'midtrans',
                        'status' => 'paid',
                        'payment_details' => [
                            'from_template_purchase' => true,
                            'template_name' => $templatePurchase->catalogTemplate->name ?? 'Store Template'
                        ]
                    ]
                );
            }
        }

        // if (!$payment) {
        //     return redirect()->route('home')->with('error', 'Payment not found. Please complete payment first.');
        // }

        // // --- AWAL PERUBAHAN ---
        // // Saat pengguna mengunjungi halaman setup, buat record dengan status 'pending'.
        // // Hal ini memastikan proses setup terlacak sejak awal.
        // $userStore = UserStore::firstOrCreate(
        //     ['payment_transaction_id' => $payment->transaction_id],
        //     [
        //         'user_id'             => $payment->user_id,
        //         'catalog_template_id' => $payment->catalog_template_id,
        //         // Buat nama toko dan subdomain unik sementara untuk memenuhi constraint database.
        //         // Nilai ini akan diperbarui saat pengguna mengirimkan form.
        //         'store_name'          => 'New Store - ' . Str::random(10),
        //         'subdomain'           => 'store' . time() . Str::lower(Str::random(5)),
        //         'setup_status'        => 'pending', // Atur status awal menjadi 'pending'
        //         'is_active'           => false,
        //     ]
        // );

        // If we have UserStore but no Payment, we can work with UserStore alone
        if ($userStore && !$payment) {
            // Create a mock payment object from UserStore data
            $payment = new \stdClass();
            $payment->id = $userStore->id;
            $payment->transaction_id = $userStore->payment_transaction_id;
            $payment->user_id = $userStore->user_id;
            $payment->catalog_template_id = $userStore->catalog_template_id;
        }

        // If neither UserStore nor Payment exists, redirect with error
        if (!$userStore && !$payment) {
            return redirect()->route('home')->with('error', 'Payment not found. Please complete payment first.');
        }

        return view('payment.store-setup.form', compact('payment', 'userStore'));
    }

    /**
     * Memproses data dari form setup toko.
     * UPDATED: Enhanced to work with existing UserStore records
     */
    public function processForm(Request $request)
    {
        // Try to find existing UserStore record first
        $userStore = null;
        $payment = null;

        if ($request->has('user_store_id')) {
            $userStore = UserStore::findOrFail($request->user_store_id);
        } elseif ($request->has('payment_id')) {
            $payment = Payment::findOrFail($request->payment_id);
            $userStore = UserStore::where('payment_transaction_id', $payment->transaction_id)->first();
        }

        // If no UserStore found and we have payment, something went wrong
        if (!$userStore && $payment) {
            return response()->json([
                'success' => false,
                'message' => 'Store record not found. Please contact support.'
            ], 404);
        }

        // If no UserStore and no payment, invalid request
        if (!$userStore) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request. Store or payment information required.'
            ], 400);
        }

        $userStoreId = $userStore->id;

        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:255|unique:user_stores,store_name,' . $userStoreId,
            'subdomain' => 'required|string|max:50|alpha_dash|unique:user_stores,subdomain,' . $userStoreId . '|unique:domains,domain',
            'store_description' => 'nullable|string|max:1000',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
            'store_address' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $logoPath = $userStore->store_logo ?? null; // Pertahankan logo lama jika tidak ada yang baru
        if ($request->hasFile('store_logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('store_logo')->store('store-logos', 'public');
        }

        try {
            DB::beginTransaction();

            // SECURITY ENHANCEMENT: Update the existing UserStore record instead of creating new one
            $userStore->update([
                'store_name' => $request->store_name,
                'subdomain' => $request->subdomain,
                'store_description' => $request->store_description,
                'store_logo' => $logoPath,
                'store_phone' => $request->store_phone,
                'store_email' => $request->store_email,
                'store_address' => $request->store_address,
                'setup_status' => 'pending_validation', // Move from 'pending' to 'pending_validation'
                'setup_completed_at' => now(),
                'is_active' => false, // Still not active until admin approval
            ]);

            // Create tenant and admin records if not already created
            if (!$userStore->tenant_created) {
                $tenant = $this->createTenant($userStore);
                $userStore->update(['tenant_id' => $tenant->id, 'tenant_created' => true]);

                // Update user's tenant_id
                User::where('id', $userStore->user_id)->update(['tenant_id' => $tenant->id]);

                // Create store admin record
                StoreAdmin::create([
                    'user_id' => $userStore->user_id,
                    'store_id' => $userStore->id,
                    'tenant_id' => $tenant->id,
                    'role' => 'owner',
                    'can_manage_products' => true,
                    'can_manage_orders' => true,
                    'can_manage_settings' => true,
                    'can_manage_admins' => true,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Store setup completed! Your store is now under review.',
                'redirect_url' => route('store.setup.pending', ['store_id' => $userStore->id])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->hasFile('store_logo') && $logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            return response()->json(['success' => false, 'message' => 'Failed to create store: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Menampilkan halaman "Menunggu Validasi".
     * UPDATED: Enhanced security and user experience
     */
    public function showPendingValidation(Request $request)
    {
        $store_id = $request->query('store_id');

        // Find user store and ensure it belongs to the current user or is accessible
        $userStore = UserStore::where('id', $store_id)->first();

        if (!$userStore) {
            return redirect()->route('home')->with('error', 'Store not found.');
        }

        // If user is authenticated, ensure they own this store
        if (Auth::check() && $userStore->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        // If store is already active, redirect to admin
        if ($userStore->is_active) {
            $domain = $userStore->subdomain . '.' . config('app.domain', 'localhost');
            return redirect('http://' . $domain . '/admin')->with('success', 'Your store has been approved!');
        }

        return view('payment.store-setup.pending-validation', compact('userStore'));
    }

    /**
     * Membuat tenant dan domain untuk toko baru.
     */
    private function createTenant(UserStore $userStore)
    {
        $tenant = Tenant::create([
            'id' => Str::uuid(),
            'data' => ['store_name' => $userStore->store_name]
        ]);

        $tenant->domains()->create([
            'domain' => $userStore->subdomain . '.' . config('app.domain', 'localhost')
        ]);

        return $tenant;
    }

    /**
     * Mengecek ketersediaan subdomain.
     * UPDATED: Enhanced validation and security
     */
    public function checkSubdomain(Request $request)
    {
        $subdomain = $request->query('subdomain');
        $excludeStoreId = $request->query('exclude_store_id'); // For editing existing stores

        if (empty($subdomain)) {
            return response()->json(['available' => false, 'message' => 'Subdomain is required']);
        }

        // Enhanced validation
        if (strlen($subdomain) < 3) {
            return response()->json(['available' => false, 'message' => 'Subdomain must be at least 3 characters long']);
        }

        if (strlen($subdomain) > 50) {
            return response()->json(['available' => false, 'message' => 'Subdomain must be no more than 50 characters long']);
        }

        if (!preg_match('/^[a-zA-Z0-9-]+$/', $subdomain)) {
            return response()->json(['available' => false, 'message' => 'Subdomain can only contain letters, numbers, and hyphens']);
        }

        if (preg_match('/^-|-$/', $subdomain)) {
            return response()->json(['available' => false, 'message' => 'Subdomain cannot start or end with a hyphen']);
        }

        // Reserved subdomains check
        $reservedSubdomains = ['www', 'admin', 'api', 'app', 'mail', 'ftp', 'blog', 'shop', 'store', 'support', 'help'];
        if (in_array(strtolower($subdomain), $reservedSubdomains)) {
            return response()->json(['available' => false, 'message' => 'This subdomain is reserved and cannot be used']);
        }

        // Check availability in UserStores
        $storeQuery = UserStore::where('subdomain', $subdomain);
        if ($excludeStoreId) {
            $storeQuery->where('id', '!=', $excludeStoreId);
        }
        $existsInStores = $storeQuery->exists();

        // Check availability in Domains
        $domainQuery = Domain::where('domain', $subdomain . '.' . config('app.domain', 'localhost'));
        $existsInDomains = $domainQuery->exists();

        $available = !$existsInStores && !$existsInDomains;

        return response()->json([
            'available' => $available,
            'message' => $available ? 'Subdomain is available' : 'Subdomain is already taken'
        ]);
    }

    /**
     * API endpoint to get store setup status
     * NEW: For checking setup progress
     */
    public function getSetupStatus(Request $request)
    {
        $orderId = $request->query('order_id');

        if (!$orderId) {
            return response()->json(['error' => 'Order ID is required'], 400);
        }

        $userStore = UserStore::where('payment_transaction_id', $orderId)->first();

        if (!$userStore) {
            return response()->json(['error' => 'Store not found'], 404);
        }

        return response()->json([
            'success' => true,
            'setup_status' => $userStore->setup_status,
            'is_active' => $userStore->is_active,
            'store_name' => $userStore->store_name,
            'subdomain' => $userStore->subdomain,
            'setup_completed_at' => $userStore->setup_completed_at,
            'activated_at' => $userStore->activated_at
        ]);
    }
}
