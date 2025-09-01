<?php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Checking Payment Status ===\n";

$orderId = 'TEMPLATE-1756100348209-7tnq9xqhf';

try {
    $purchase = \App\Models\TemplatePurchase::where('transaction_id', $orderId)->first();

    if ($purchase) {
        echo "✅ Purchase Found!\n";
        echo "Transaction ID: {$purchase->transaction_id}\n";
        echo "Payment Status: {$purchase->payment_status}\n";
        echo "Amount: {$purchase->amount}\n";
        echo "Payment Method: {$purchase->payment_method}\n";
        echo "Created: {$purchase->created_at}\n";
        echo "Updated: {$purchase->updated_at}\n";
        echo "Paid At: " . ($purchase->paid_at ?? 'NULL') . "\n";

        // Check payment details
        $details = json_decode($purchase->payment_details, true);
        echo "\nPayment Details:\n";
        echo json_encode($details, JSON_PRETTY_PRINT);
    } else {
        echo "❌ Purchase NOT found in database\n";

        // Check if there are any recent purchases
        $recentPurchases = \App\Models\TemplatePurchase::orderBy('created_at', 'desc')->take(5)->get();
        echo "\nRecent purchases:\n";
        foreach ($recentPurchases as $p) {
            echo "- {$p->transaction_id} | {$p->payment_status} | {$p->created_at}\n";
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
