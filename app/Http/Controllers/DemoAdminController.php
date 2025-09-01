<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CatalogTemplate;
use App\Models\TemplatePurchase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DemoAdminController extends Controller
{
    /**
     * Test controller method
     */
    public function testController()
    {
        return response('Controller test works! Models available: ' . class_exists('App\Models\TemplatePurchase'));
    }

    /**
     * Show the demo admin dashboard
     */
    public function dashboard()
    {
        try {
            // Test data queries first
            $purchaseCount = TemplatePurchase::count();
            $userCount = User::count();
            $templateCount = CatalogTemplate::count();

            // Test simple query without relations
            $recentPurchases = TemplatePurchase::orderBy('created_at', 'desc')->limit(5)->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'purchase_count' => $purchaseCount,
                    'user_count' => $userCount,
                    'template_count' => $templateCount,
                    'recent_purchases_count' => $recentPurchases->count(),
                    'message' => 'Dashboard data loaded successfully'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Get purchased catalogs data for API
     */
    public function getPurchasedCatalogs(Request $request)
    {
        $query = TemplatePurchase::with(['user', 'catalogTemplate'])
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by customer name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $purchases = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $purchases->items(),
            'pagination' => [
                'current_page' => $purchases->currentPage(),
                'last_page' => $purchases->lastPage(),
                'per_page' => $purchases->perPage(),
                'total' => $purchases->total()
            ]
        ]);
    }

    /**
     * Get purchase details
     */
    public function getPurchaseDetails($id)
    {
        $purchase = TemplatePurchase::with(['user', 'catalogTemplate'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $purchase
        ]);
    }

    /**
     * Update purchase status
     */
    public function updatePurchaseStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $purchase = TemplatePurchase::findOrFail($id);
        $purchase->update([
            'payment_status' => $request->status,
            'paid_at' => $request->status === 'paid' ? now() : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status pembelian berhasil diperbarui',
            'data' => $purchase
        ]);
    }

    /**
     * Download template file
     */
    public function downloadTemplate($id)
    {
        try {
            $purchase = TemplatePurchase::with('catalogTemplate')->findOrFail($id);

            if ($purchase->payment_status !== 'paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Template hanya dapat diunduh setelah pembayaran selesai'
                ], 403);
            }

            // Demo: Return a sample file or redirect to template preview
            $templateName = $purchase->catalogTemplate->name ?? 'Template';
            $fileName = str_replace(' ', '_', $templateName) . '_' . $purchase->transaction_id . '.zip';

            // For demo purposes, we'll create a simple text file
            $content = "Demo Template File\n\n";
            $content .= "Template: {$templateName}\n";
            $content .= "Customer: {$purchase->customer_name}\n";
            $content .= "Order ID: {$purchase->transaction_id}\n";
            $content .= "Download Date: " . now()->format('Y-m-d H:i:s') . "\n\n";
            $content .= "This is a demo file. In production, this would be the actual template files.";

            return response($content)
                ->header('Content-Type', 'text/plain')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunduh template: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send template via email
     */
    public function sendTemplate($id)
    {
        try {
            $purchase = TemplatePurchase::with('catalogTemplate')->findOrFail($id);

            if ($purchase->payment_status !== 'paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Template hanya dapat dikirim setelah pembayaran selesai'
                ], 403);
            }

            // Demo: Simulate sending email
            // In production, you would use Laravel's Mail facade to send actual emails

            $templateName = $purchase->catalogTemplate->name ?? 'Template';
            $customerEmail = $purchase->customer_email;
            $customerName = $purchase->customer_name;

            // Log the email sending (for demo purposes)
            Log::info('Demo: Template email sent', [
                'template' => $templateName,
                'customer_email' => $customerEmail,
                'customer_name' => $customerName,
                'order_id' => $purchase->transaction_id,
                'sent_at' => now()
            ]);

            // Update download count or last sent timestamp if needed
            $purchase->update([
                'download_count' => ($purchase->download_count ?? 0) + 1,
                'last_downloaded_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => "Template '{$templateName}' berhasil dikirim ke {$customerEmail}",
                'details' => [
                    'template' => $templateName,
                    'customer' => $customerName,
                    'email' => $customerEmail,
                    'sent_at' => now()->format('Y-m-d H:i:s')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim template: ' . $e->getMessage()
            ], 500);
        }
    }
}
