<?php

// Test the actual API endpoint
$testData = [
    'payment_data' => [
        'transaction_details' => [
            'order_id' => 'API-TEST-' . time(),
            'gross_amount' => 150000
        ],
        'customer_details' => [
            'first_name' => 'API Test Customer',
            'email' => 'apitest@example.com',
            'phone' => '081234567890'
        ],
        'item_details' => [[
            'id' => 'template-api-test',
            'price' => 150000,
            'quantity' => 1,
            'name' => 'API Test Template'
        ]]
    ],
    'template_data' => [
        'id' => 'toko_komputer',
        'name' => 'TechZone - Computer Store Template',
        'type' => 'Toko Komputer',
        'price' => 150000
    ],
    'customer_data' => [
        'name' => 'API Test Customer',
        'email' => 'apitest@example.com',
        'phone' => '081234567890'
    ]
];

$jsonData = json_encode($testData);

// Get CSRF token first
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://localhost:8000/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
]);

$response = curl_exec($ch);
curl_close($ch);

// Extract CSRF token (simple extraction)
preg_match('/name="csrf-token" content="([^"]+)"/', $response, $matches);
$csrfToken = $matches[1] ?? 'test-token';

echo "CSRF Token: " . substr($csrfToken, 0, 20) . "...\n";

// Test API endpoint
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://localhost:8000/api/midtrans/get-snap-token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json',
        'X-CSRF-TOKEN: ' . $csrfToken
    ],
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
]);

echo "Testing API endpoint...\n";
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";

$responseData = json_decode($response, true);
if ($responseData && isset($responseData['success']) && $responseData['success']) {
    echo "API TEST SUCCESS!\n";
    echo "Snap Token: " . substr($responseData['snap_token'], 0, 20) . "...\n";
} else {
    echo "API TEST FAILED!\n";
    if (isset($responseData['message'])) {
        echo "Error: " . $responseData['message'] . "\n";
    }
}
