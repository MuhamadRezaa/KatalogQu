<?php

require_once 'vendor/autoload.php';

// Load Laravel but don't use its error handling for this test
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test direct CURL call to Midtrans API
try {
    echo "=== Testing Direct CURL to Midtrans ===\n";

    $serverKey = config('services.midtrans.server_key');
    $isProduction = config('services.midtrans.is_production');

    echo "Server Key: " . ($serverKey ? 'Set' : 'NOT SET') . "\n";
    echo "Production: " . ($isProduction ? 'true' : 'false') . "\n\n";

    // Prepare payment data
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

    // Determine API URL
    $apiUrl = $isProduction
        ? 'https://app.midtrans.com/snap/v1/transactions'
        : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

    echo "API URL: $apiUrl\n";

    // Initialize CURL
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($serverKey . ':')
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($paymentData),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_VERBOSE => true,
        CURLOPT_STDERR => fopen('php://temp', 'rw+')
    ]);

    echo "Making CURL request...\n";
    $result = curl_exec($ch);

    // Get CURL info
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    $curlErrorNo = curl_errno($ch);

    echo "HTTP Code: $httpCode\n";
    echo "CURL Error No: $curlErrorNo\n";
    echo "CURL Error: $curlError\n";

    if ($result === false) {
        echo "CURL failed with error: $curlError (Code: $curlErrorNo)\n";

        // Get verbose output
        rewind(curl_getinfo($ch, CURLOPT_STDERR));
        $verboseLog = stream_get_contents(curl_getinfo($ch, CURLOPT_STDERR));
        echo "Verbose log:\n$verboseLog\n";
    } else {
        echo "CURL Success!\n";
        echo "Response: " . substr($result, 0, 200) . "...\n";

        $response = json_decode($result, true);
        if (isset($response['token'])) {
            echo "Snap token received: " . substr($response['token'], 0, 20) . "...\n";
        } elseif (isset($response['error_messages'])) {
            echo "API Error: " . implode(', ', $response['error_messages']) . "\n";
        }
    }

    curl_close($ch);
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
