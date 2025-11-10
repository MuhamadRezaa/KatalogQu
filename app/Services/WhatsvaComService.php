<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsvaComService implements WhatsvaServiceContract
{
    protected $instanceKey;

    protected $baseUrl;

    protected $adminJids;

    public function __construct()
    {
        $this->instanceKey = config('whatsva.providers.whatsva_com.instance_key');
        $this->baseUrl = config('whatsva.providers.whatsva_com.base_url');
        $this->adminJids = array_filter(config('whatsva.admin_jids', []));
    }

    public function sendMessage(string $jid, string $message): bool
    {
        if (empty($this->instanceKey) || empty($this->baseUrl) || empty($jid)) {
            Log::error("WhatsvaComService: Attempt to send message failed. Instance key, base URL, or JID is not configured.");
            return false;
        }

        Log::info("WhatsvaComService: Attempting to send message to {$jid}.");

        try {
            $response = Http::post($this->baseUrl, [
                'apikey' => $this->instanceKey,
                'jid' => $jid,
                'message' => $message
            ]);

            if ($response->successful()) {
                Log::info("WhatsvaComService: Message successfully sent to {$jid}.", $response->json() ?? []);
                return true;
            }

            Log::error("WhatsvaComService: Failed to send message to {$jid}. Status: " . $response->status(), $response->json() ?? ['response_body' => $response->body()]);
            return false;

        } catch (\Exception $e) {
            Log::critical("WhatsvaComService Exception: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Membuat pesan dari template di config.
     */
    public function buildMessage(string $key, array $placeholders = []): string
    {
        $template = config('whatsva.messages.' . $key);

        if (! $template) {
            return '';
        }

        foreach ($placeholders as $placeholder => $value) {
            $template = str_replace('{'.$placeholder.'}', $value, $template);
        }

        return $template;
    }

    /**
     * Mengirim pesan notifikasi ke semua admin yang terdaftar.
     */
    public function notifyAdmins(string $messageKey, array $placeholders = []): void
    {
        $message = $this->buildMessage($messageKey, $placeholders);

        if (empty($message)) {
            Log::warning("WhatsvaComService: Message template for key '{$messageKey}' not found or empty.");

            return;
        }

        if (empty($this->adminJids)) {
            Log::warning("WhatsvaComService: No admin JIDs configured to send notification '{$messageKey}'.");

            return;
        }

        foreach ($this->adminJids as $jid) {
            if (! empty($jid)) {
                $this->sendMessage($jid, $message);
            }
        }
    }
}
