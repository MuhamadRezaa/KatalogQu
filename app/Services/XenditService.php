<?php

namespace App\Services;

use Xendit\ApiException;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\XenditSdkException;
use Illuminate\Support\Facades\Log;
use Xendit\Invoice\CreateInvoiceRequest;
use GuzzleHttp\Client;

// Tambahkan model yang dibutuhkan
use App\Models\TemplatePurchase;
use App\Models\UserStore;
use Carbon\Carbon;

class XenditService
{
    private $invoiceApi;

    public function __construct()
    {
        $secretKey = config('services.xendit.secret_key');
        Configuration::setXenditKey($secretKey);

        // Create a Guzzle client with custom SSL verification
        $guzzleClient = new Client([
            'verify' => storage_path('cacert.pem')
        ]);

        // Pass the custom client to the Api class
        $this->invoiceApi = new InvoiceApi($guzzleClient);
    }

    public function createInvoice(string $externalId, int $amount, string $payerEmail, string $description, string $name, string $paymentType)
    {
        try {
            // Tentukan URL redirect berdasarkan tipe pembayaran
            $successRedirectUrl = ($paymentType === 'renewal')
                ? route('renewal.success', ['order_id' => $externalId])
                : route('checkout.status', ['order_id' => $externalId]);

            $createInvoiceRequest = new CreateInvoiceRequest([
                'external_id' => $externalId,
                'amount' => $amount,
                'payer_email' => $payerEmail,
                'description' => $description,
                'customer' => [
                    'given_names' => $name,
                ],
                'success_redirect_url' => $successRedirectUrl,
                'failure_redirect_url' => route('checkout.status', ['order_id' => $externalId, 'status' => 'failed']),
                'language' => 'id',
            ]);

            return $this->invoiceApi->createInvoice($createInvoiceRequest);
        } catch (XenditSdkException $e) {
            Log::error('Xendit SDK Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Expire an existing invoice.
     *
     * @param string $invoiceId The ID of the invoice to expire.
     * @return \Xendit\Invoice\Invoice
     */
    public function expireInvoice(string $invoiceId)
    {
        try {
            // The SDK method is called expireInvoice and takes the invoice ID.
            return $this->invoiceApi->expireInvoice($invoiceId);
        } catch (XenditSdkException $e) {
            Log::error('Xendit Expire Invoice Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Cancel a payment request using the v3 API.
     *
     * @param string $paymentRequestId The ID of the payment request to cancel.
     * @return bool
     */
    public function cancelPaymentRequest(string $paymentRequestId): bool
    {
        try {
            $secretKey = config('services.xendit.secret_key');
            $url = "https://api.xendit.co/v3/payment_requests/{$paymentRequestId}/cancel";

            $client = new Client([
                'verify' => storage_path('cacert.pem')
            ]);

            $response = $client->post($url, [
                'auth' => [$secretKey, ''], // Basic Auth
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                Log::info("Xendit payment request {$paymentRequestId} cancelled successfully.");
                return true;
            }

            Log::error("Failed to cancel Xendit payment request {$paymentRequestId}. Status: " . $response->getStatusCode(), [
                'response' => json_decode($response->getBody()->getContents(), true)
            ]);
            return false;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';
            Log::error("Xendit Cancel Payment Request API Error for ID {$paymentRequestId}: " . $e->getMessage(), [
                'response' => json_decode($responseBody, true)
            ]);
            return false;
        } catch (\Exception $e) {
            Log::critical("XenditService General Exception during cancelPaymentRequest for ID {$paymentRequestId}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Handle incoming Xendit notifications and update database.
     */
    public function handleNotification(array $payload)
    {
        // Pastikan status pembayaran berhasil
        if (isset($payload['status']) && ($payload['status'] === 'PAID' || $payload['status'] === 'SETTLED')) {
            $orderId = $payload['external_id'];

            // Cari transaksi di database Anda
            $purchase = TemplatePurchase::where('transaction_id', $orderId)
                ->where('payment_status', 'pending')
                ->first();

            if ($purchase) {
                // Update status pembayaran
                $purchase->payment_status = strtolower($payload['status']);
                $purchase->payment_details = json_encode($payload);
                $purchase->save();

                // Perbarui masa aktif di tabel user_stores jika ini perpanjangan
                $paymentDetails = json_decode($purchase->payment_details, true);
                if (isset($paymentDetails['user_store_id'])) {
                    $userStore = UserStore::find($paymentDetails['user_store_id']);
                    if ($userStore) {
                        $currentExpiry = Carbon::parse($userStore->expires_at);
                        $newExpiryDate = $currentExpiry->addYear(1);

                        // Perbarui kolom expires_at
                        $userStore->update([
                            'expires_at' => $newExpiryDate,
                        ]);

                        Log::info('User store ' . $userStore->id . ' expires_at updated successfully.');
                    }
                }

                return ['status' => 'success', 'message' => 'Notification processed successfully.'];
            } else {
                Log::warning('Received Xendit notification for an unknown or already processed order: ' . $orderId);
                return ['status' => 'warning', 'message' => 'Order not found or already processed.'];
            }
        }

        return ['status' => 'error', 'message' => 'Invalid notification status.'];
    }
}
