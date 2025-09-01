<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class CustomMidtransService
{
    private $serverKey;
    private $isProduction;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.server_key');
        $this->isProduction = config('services.midtrans.is_production', false);
    }

    /**
     * Get Snap token directly via CURL to avoid SDK error handling issues
     */
    public function getSnapToken(array $paymentData): string
    {
        Log::info('CustomMidtransService: Starting Snap token generation', [
            'order_id' => $paymentData['transaction_details']['order_id'] ?? 'unknown',
            'amount' => $paymentData['transaction_details']['gross_amount'] ?? 'unknown',
            'is_production' => $this->isProduction
        ]);

        if (empty($this->serverKey)) {
            Log::error('CustomMidtransService: Server key not configured');
            throw new Exception('Midtrans server key is not configured');
        }

        // Determine API URL
        $apiUrl = $this->isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        Log::info('CustomMidtransService: Using API URL', [
            'url' => $apiUrl,
            'environment' => $this->isProduction ? 'production' : 'sandbox'
        ]);

        // Initialize CURL
        $ch = curl_init();

        // SSL Configuration: Use CA certificate bundle approach
        $caBundlePaths = [
            '/etc/ssl/certs/ca-certificates.crt', // Debian/Ubuntu
            '/etc/ssl/certs/ca-bundle.crt',       // CentOS/RHEL
            '/usr/share/ssl/certs/ca-bundle.crt', // CentOS/RHEL
            '/usr/local/share/certs/ca-root-nss.crt', // FreeBSD
            '/etc/ssl/cert.pem',                  // macOS
            storage_path('cacert.pem'),           // Downloaded bundle
        ];

        $caBundle = null;
        foreach ($caBundlePaths as $path) {
            if (file_exists($path) && is_readable($path)) {
                $caBundle = $path;
                break;
            }
        }

        Log::info('CustomMidtransService: SSL Configuration', [
            'ca_bundle_found' => $caBundle ? 'yes' : 'no',
            'ca_bundle_path' => $caBundle,
            'environment' => config('app.env')
        ]);

        $curlOptions = [
            CURLOPT_URL => $apiUrl,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($this->serverKey . ':'),
                'User-Agent: Laravel-Katalogku/1.0'
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($paymentData),
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CONNECTTIMEOUT => 30,
        ];

        if ($caBundle) {
            // Use proper SSL verification with CA bundle
            $curlOptions[CURLOPT_SSL_VERIFYPEER] = true;
            $curlOptions[CURLOPT_SSL_VERIFYHOST] = 2;
            $curlOptions[CURLOPT_CAINFO] = $caBundle;
        } else {
            // Fallback for development environment only
            if (config('app.env') !== 'production') {
                $curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
                $curlOptions[CURLOPT_SSL_VERIFYHOST] = false;
            } else {
                // Production: always use SSL verification
                $curlOptions[CURLOPT_SSL_VERIFYPEER] = true;
                $curlOptions[CURLOPT_SSL_VERIFYHOST] = 2;
            }
        }

        curl_setopt_array($ch, $curlOptions);

        Log::info('CustomMidtransService: Sending request to Midtrans API', [
            'order_id' => $paymentData['transaction_details']['order_id'] ?? 'unknown',
            'payload_size' => strlen(json_encode($paymentData)) . ' bytes'
        ]);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        $curlErrorNo = curl_errno($ch);
        $requestInfo = curl_getinfo($ch);

        curl_close($ch);

        Log::info('CustomMidtransService: Received response from Midtrans', [
            'http_code' => $httpCode,
            'response_size' => strlen($result) . ' bytes',
            'total_time' => $requestInfo['total_time'] ?? 'unknown',
            'curl_error' => $curlError ?: 'none'
        ]);

        // Handle CURL errors
        if ($result === false) {
            Log::error('CustomMidtransService: CURL Error', [
                'error' => $curlError,
                'error_no' => $curlErrorNo,
                'url' => $apiUrl,
                'order_id' => $paymentData['transaction_details']['order_id'] ?? 'unknown'
            ]);
            throw new Exception('Tidak dapat terhubung ke layanan pembayaran. Periksa koneksi internet Anda.');
        }

        // Parse response
        $response = json_decode($result, true);

        if ($httpCode >= 400) {
            Log::error('CustomMidtransService: API Error Response', [
                'http_code' => $httpCode,
                'response' => $response,
                'order_id' => $paymentData['transaction_details']['order_id'] ?? 'unknown'
            ]);

            $errorMessage = 'Terjadi kesalahan pada sistem pembayaran.';

            if (isset($response['error_messages']) && is_array($response['error_messages'])) {
                $errorMessage = implode(', ', $response['error_messages']);
            } elseif (isset($response['message'])) {
                $errorMessage = $response['message'];
            }

            throw new Exception($errorMessage);
        }

        // Check for token in response
        if (!isset($response['token'])) {
            Log::error('CustomMidtransService: Response Missing Token', [
                'response' => $response,
                'order_id' => $paymentData['transaction_details']['order_id'] ?? 'unknown'
            ]);
            throw new Exception('Token pembayaran tidak diterima dari server.');
        }

        Log::info('CustomMidtransService: Snap Token Generated Successfully', [
            'order_id' => $paymentData['transaction_details']['order_id'] ?? 'unknown',
            'token_prefix' => substr($response['token'], 0, 10) . '...',
            'redirect_url' => $response['redirect_url'] ?? 'not_provided'
        ]);

        return $response['token'];
    }
}
