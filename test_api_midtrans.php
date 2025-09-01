<?php

// Simple test for Midtrans API endpoint
echo "=== Testing Midtrans Configuration ===\n";

// Load environment
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "Server Key: " . ($_ENV['MIDTRANS_SERVER_KEY'] ?? 'NOT SET') . "\n";
echo "Client Key: " . ($_ENV['MIDTRANS_CLIENT_KEY'] ?? 'NOT SET') . "\n";
echo "Is Production: " . ($_ENV['MIDTRANS_IS_PRODUCTION'] ?? 'false') . "\n";

// Test cURL to Midtrans
echo "\n=== Testing Midtrans API Connection ===\n";

$serverKey = $_ENV['MIDTRANS_SERVER_KEY'] ?? '';
if (empty($serverKey)) {
    echo "ERROR: Server key not configured\n";
    exit(1);
}

$testData = [
    'transaction_details' => [
        'order_id' => 'TEST-' . time(),
        'gross_amount' => 150000
    ],
    'customer_details' => [
        'first_name' => 'Test User',
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

$url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
$auth = base64_encode($serverKey . ':');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($testData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . $auth
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo "cURL Error: " . $error . "\n";
} else {
    echo "HTTP Code: " . $httpCode . "\n";
    echo "Response: " . $response . "\n";
    
    if ($httpCode == 201) {
        $data = json_decode($response, true);
        if (isset($data['token'])) {
            echo "SUCCESS: Token received - " . substr($data['token'], 0, 20) . "...\n";
        } else {
            echo "ERROR: No token in response\n";
        }
    } else {
        echo "ERROR: HTTP " . $httpCode . "\n";
    }
}