<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\TemplatePurchase;
use App\Models\User;
use App\Models\CatalogTemplate;
use App\Models\Tenant; // Added this line
use App\Models\UserStore; // Added this line

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {

        // Get all paid catalogs with user and template information
        $paidCatalogs = TemplatePurchase::with(['user', 'catalogTemplate', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->where('status', 'success');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Get pending payments
        $pendingPayments = Payment::with(['templatePurchase.user', 'templatePurchase.catalogTemplate'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Existing Statistics
        $totalPaidOrders = $paidCatalogs->count();
        $totalRevenue = TemplatePurchase::where('payment_status', 'paid')->sum('final_amount');
        $pendingOrdersCount = $pendingPayments->count();

        // New Statistics for Central Dashboard
        $totalUsers = User::count();
        $totalStores = UserStore::count();
        $templatesSold = TemplatePurchase::count(); // This is already calculated as $totalPaidOrders, but keeping for clarity with Blade variable name

        $recentUsers = User::latest()->take(5)->get();
        $recentStores = UserStore::latest()->with('tenant.domains')->take(5)->get();

        return view('admin-main.pages.dashboard', compact( // Changed view name from 'pages.admin-main.paid-catalogs'
            'paidCatalogs',
            'pendingPayments',
            'totalPaidOrders',
            'totalRevenue',
            'pendingOrdersCount',
            'totalUsers',
            'totalStores',
            'templatesSold',
            'recentUsers',
            'recentStores'
        ));
    }

    /**
     * Get order details via API
     */
    public function getOrderDetails($orderId)
    {
        try {
            $purchase = TemplatePurchase::with(['user', 'catalogTemplate'])
                ->where('transaction_id', $orderId)
                ->first();

            if (!$purchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan'
                ], 404);
            }

            $orderDetails = [
                'order_id' => $purchase->transaction_id,
                'customer_name' => $purchase->user->name,
                'email' => $purchase->user->email,
                'template_name' => $purchase->catalogTemplate->name,
                'amount' => $purchase->final_amount,
                'payment_method' => $purchase->payment_method,
                'payment_status' => $purchase->payment_status,
                'order_date' => $purchase->created_at->format('Y-m-d'),
                'payment_date' => $purchase->paid_at ? $purchase->paid_at->format('Y-m-d') : null
            ];

            return response()->json([
                'success' => true,
                'data' => $orderDetails
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                                    'message' => 'Terjadi kesalahan saat mengambil detail pesanan'            ], 500);
        }
    }

    /**
     * Confirm payment via API
     */
    public function confirmPayment(Request $request, $orderId)
    {
        try {
            $purchase = TemplatePurchase::where('transaction_id', $orderId)
                ->where('payment_status', 'pending')
                ->first();

            if (!$purchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan atau sudah diproses'
                ], 404);
            }

            // Update payment status
            $purchase->update([
                'payment_status' => 'paid',
                'paid_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => "Pembayaran untuk pesanan {$orderId} berhasil dikonfirmasi"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                                    'message' => 'Terjadi kesalahan saat mengkonfirmasi pembayaran'            ], 500);
        }
    }

    /**
     * Cancel order via API
     */
    public function cancelOrder(Request $request, $orderId)
    {
        try {
            $purchase = TemplatePurchase::where('transaction_id', $orderId)
                ->where('payment_status', 'pending')
                ->first();

            if (!$purchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan atau tidak dapat dibatalkan'
                ], 404);
            }

            // Update payment status to failed
            $purchase->update([
                'payment_status' => 'failed'
            ]);

            return response()->json([
                'success' => true,
                'message' => "Pesanan {$orderId} berhasil dibatalkan"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                                    'message' => 'Terjadi kesalahan saat membatalkan pesanan'            ], 500);
        }
    }

    /**
     * Send template to email via API
     */
    public function sendTemplate(Request $request, $orderId)
    {
        try {
            $purchase = TemplatePurchase::with(['user', 'catalogTemplate'])
                ->where('transaction_id', $orderId)
                ->where('payment_status', 'paid')
                ->first();

            if (!$purchase) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesanan tidak ditemukan atau belum dibayar'
                ], 404);
            }

            // Here you would implement actual email sending logic
            // For now, we'll simulate it

            return response()->json([
                'success' => true,
                'message' => "Template berhasil dikirim ke {$purchase->user->email}"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                                    'message' => 'Terjadi kesalahan saat mengirim template'            ], 500);
        }
    }
}
