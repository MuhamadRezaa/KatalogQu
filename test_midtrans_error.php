<?php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test Midtrans configuration and API call
try {
    echo "=== Testing Midtrans Configuration ===\n";

    // Check configuration
    $serverKey = config('services.midtrans.server_key');
    $clientKey = config('services.midtrans.client_key');
    $isProduction = config('services.midtrans.is_production');

    echo "Server Key: " . ($serverKey ? 'Set (' . substr($serverKey, 0, 10) . '...)' : 'NOT SET') . "\n";
    echo "Client Key: " . ($clientKey ? 'Set (' . substr($clientKey, 0, 10) . '...)' : 'NOT SET') . "\n";
    echo "Production: " . ($isProduction ? 'true' : 'false') . "\n\n";

    if (empty($serverKey) || empty($clientKey)) {
        throw new \Exception('Midtrans configuration is incomplete');
    }

    // Set Midtrans configuration
    \Midtrans\Config::$serverKey = $serverKey;
    \Midtrans\Config::$isProduction = $isProduction;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    // SSL bypass for development
    \Midtrans\Config::$curlOptions = [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CAINFO => null,
        CURLOPT_CAPATH => null,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_USERAGENT => 'Laravel-Katalogku/1.0'
    ];

    echo "=== Testing Database Connection ===\n";

    // Test database connection
    $templatePurchase = new \App\Models\TemplatePurchase();
    echo "TemplatePurchase model loaded successfully\n";

    // Check if table exists
    $tableExists = \Illuminate\Support\Facades\Schema::hasTable('template_purchases');
    echo "template_purchases table exists: " . ($tableExists ? 'YES' : 'NO') . "\n";

    if ($tableExists) {
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing('template_purchases');
        echo "Table columns: " . implode(', ', $columns) . "\n";
    }

    echo "\n=== Testing Midtrans API Call ===\n";

    // Prepare test payment data
    $paymentData = [
        'transaction_details' => [
            'order_id' => 'TEST-' . time(),
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

    echo "Payment data prepared:\n";
    echo json_encode($paymentData, JSON_PRETTY_PRINT) . "\n\n";

    // Try to get Snap token
    echo "Calling Midtrans Snap API...\n";
    $snapToken = \Midtrans\Snap::getSnapToken($paymentData);

    echo "SUCCESS! Snap token received: " . substr($snapToken, 0, 20) . "...\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
