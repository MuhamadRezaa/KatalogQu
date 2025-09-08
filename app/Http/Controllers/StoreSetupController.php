<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserStore;
use App\Models\CatalogTemplate;
use App\Models\Payment;
use App\Models\Tenant;
use App\Models\StoreAdmin;
use Stancl\Tenancy\Database\Models\Domain;

class StoreSetupController extends Controller
{
    /**
     * Show store setup form after payment
     */
    public function showForm(Request $request)
    {
        $paymentId = $request->query('payment_id');
        $orderId = $request->query('order_id');

        // Validate payment exists (ignore status for now as requested)
        $payment = null;
        if ($paymentId) {
            $payment = Payment::find($paymentId);
        } elseif ($orderId) {
            $payment = Payment::where('transaction_id', $orderId)->first();
        }

        // For demo/testing: if no payment found but order_id provided, try to find TemplatePurchase
        if (!$payment && $orderId) {
            $templatePurchase = \App\Models\TemplatePurchase::where('transaction_id', $orderId)->first();
            if ($templatePurchase) {
                // Create or find payment record from template purchase
                $payment = Payment::firstOrCreate(
                    ['transaction_id' => $orderId],
                    [
                        'user_id' => $templatePurchase->user_id,
                        'catalog_template_id' => $templatePurchase->catalog_template_id,
                        'store_name' => 'Store Setup - ' . $orderId, // Add required store_name field
                        'amount' => $templatePurchase->final_amount,
                        'final_amount' => $templatePurchase->final_amount,
                        'payment_method' => 'midtrans',
                        'status' => 'paid', // Assuming paid for setup
                        'payment_details' => [
                            'from_template_purchase' => true,
                            'template_purchase_id' => $templatePurchase->id
                        ]
                    ]
                );
            }
        }

        if (!$payment) {
            return redirect()->route('checkout.template')->with('error', 'Payment not found. Please complete payment first.');
        }

        // Check if store setup already completed
        $userStore = UserStore::where('payment_transaction_id', $payment->transaction_id)->first();
        if ($userStore && $userStore->setup_status === 'completed') {
            return redirect('http://' . $userStore->subdomain . '.' . config('app.domain', 'localhost') . '/admin')
                ->with('success', 'Store already set up. Welcome to your admin panel!');
        }

        return view('payment.store-setup.form', compact('payment', 'userStore'));
    }

    /**
     * Process store setup form submission
     */
    public function processForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:payments,id',
            'store_name' => 'required|string|max:255|unique:user_stores,store_name',
            'subdomain' => 'required|string|max:50|alpha_dash|unique:user_stores,subdomain|unique:domains,domain',
            'store_description' => 'nullable|string|max:1000',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
            'store_address' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $logoPath = null;
        if ($request->hasFile('store_logo')) {
            $logoPath = $request->file('store_logo')->store('store-logos', 'public');
        }

        try {
            DB::beginTransaction();

            $payment = Payment::findOrFail($request->payment_id);

            $userStore = UserStore::updateOrCreate(
                ['payment_transaction_id' => $payment->transaction_id],
                [
                    'user_id' => $payment->user_id,
                    'catalog_template_id' => $payment->catalog_template_id,
                    'store_name' => $request->store_name,
                    'subdomain' => $request->subdomain,
                    'store_description' => $request->store_description,
                    'store_logo' => $logoPath,
                    'store_phone' => $request->store_phone,
                    'store_email' => $request->store_email,
                    'store_address' => $request->store_address,
                    'setup_status' => 'pending_validation', // status baru
                    'setup_completed_at' => now(),
                    'is_active' => false, // Toko belum aktif
                ]
            );

            // Create tenant but don't activate it yet
            $tenant = $this->createTenant($userStore);

            $userStore->update([
                'tenant_id' => $tenant->id,
                'tenant_created' => true
            ]);

            User::where('id', $payment->user_id)->update([
                'tenant_id' => $tenant->id
            ]);

            StoreAdmin::create([
                'user_id' => $payment->user_id,
                'store_id' => $userStore->id,
                'tenant_id' => $tenant->id,
                'role' => 'owner',
                'can_manage_products' => true,
                'can_manage_orders' => true,
                'can_manage_settings' => true,
                'can_manage_admins' => true,
                'last_active_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Store setup completed! Your subdomain is now under review.',
                'redirect_url' => route('store.setup.pending', ['store_id' => $userStore->id])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to create store: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan halaman validasi pending.
     */
    public function showPendingValidation(Request $request)
    {
        $store_id = $request->query('store_id');
        $userStore = UserStore::where('id', $store_id)->where('user_id', Auth::id())->firstOrFail();

        return view('payment.store-setup.pending-validation', compact('userStore'));
    }


    /**
     * Create tenant for the store
     */
    private function createTenant(UserStore $userStore)
    {
        // Create tenant
        $tenant = Tenant::create([
            'id' => Str::uuid(),
            'data' => [
                'store_name' => $userStore->store_name,
                'store_description' => $userStore->store_description,
                'user_id' => $userStore->user_id,
                'user_store_id' => $userStore->id,
                'subdomain' => $userStore->subdomain // Store subdomain in tenant data
            ]
        ]);

        // Create domain for tenant
        $domain = Domain::create([
            'domain' => $userStore->subdomain . '.' . config('app.domain', 'localhost'),
            'tenant_id' => $tenant->id
        ]);

        return $tenant;
    }

    /**
     * Check subdomain availability
     */
    public function checkSubdomain(Request $request)
    {
        $subdomain = $request->query('subdomain');

        if (empty($subdomain)) {
            return response()->json(['available' => false, 'message' => 'Subdomain is required']);
        }

        if (!preg_match('/^[a-zA-Z0-9-]+$/', $subdomain)) {
            return response()->json(['available' => false, 'message' => 'Subdomain can only contain letters, numbers, and hyphens']);
        }

        $existsInStores = UserStore::where('subdomain', $subdomain)->exists();
        $existsInDomains = Domain::where('domain', $subdomain . '.' . config('app.domain', 'localhost'))->exists();

        $available = !$existsInStores && !$existsInDomains;

        return response()->json([
            'available' => $available,
            'message' => $available ? 'Subdomain is available' : 'Subdomain is already taken'
        ]);
    }
}
