<?php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Custom Midtrans Service ===\n";

try {
    // Create template purchase record first (simulating API behavior)
    $orderId = 'TEST-' . time();

    echo "Order ID: $orderId\n";

    // Test the custom service
    $midtransService = new \App\Services\CustomMidtransService();

    $paymentData = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => 150000
        ],
        'customer_details' => [
            'first_name' => 'Test Customer',
            'email' => 'test@example.com',
            'phone' => '081234567890'
        ],
        'item_details' => [[
            'id' => 'template-test',
            'price' => 150000,
            'quantity' => 1,
            'name' => 'Test Template'
        ]]
    ];

    echo "Getting Snap token...\n";
    $snapToken = $midtransService->getSnapToken($paymentData);

    echo "SUCCESS!\n";
    echo "Snap Token: " . substr($snapToken, 0, 20) . "...\n";
    echo "Full Response: Payment popup can be opened with this token\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
