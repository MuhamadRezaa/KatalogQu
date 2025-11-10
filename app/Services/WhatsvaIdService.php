<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsvaIdService implements WhatsvaServiceContract
{
    protected $instanceKey;

    protected $baseUrl;

    protected $adminJids;

    public function __construct()
    {
        $this->instanceKey = config('whatsva.providers.whatsva_id.instance_key');
        $this->baseUrl = config('whatsva.providers.whatsva_id.base_url');
        $this->adminJids = array_filter(config('whatsva.admin_jids', []));
    }

    /**
     * Mengirim pesan WhatsApp ke JID tertentu menggunakan provider whatsva.id.
     */
    public function sendMessage(string $jid, string $message): bool
    {
        if (empty($this->instanceKey) || empty($this->baseUrl) || empty($jid)) {
            Log::error('WhatsvaIdService: Attempt to send message failed. Instance key, base URL, or JID is not configured.');

            return false;
        }

        Log::info("WhatsvaIdService: Attempting to send message to {$jid}.");

        try {
            $response = Http::post($this->baseUrl, [
                'instance_key' => $this->instanceKey,
                'jid' => $jid,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info("WhatsvaIdService: Message successfully sent to {$jid}.", $response->json() ?? []);

                return true;
            }

            Log::error("WhatsvaIdService: Failed to send message to {$jid}. Status: ".$response->status(), $response->json() ?? ['response_body' => $response->body()]);

            return false;

        } catch (\Exception $e) {
            Log::critical('WhatsvaIdService Exception: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Membuat pesan dari template di config.
     */
    public function buildMessage(string $key, array $placeholders = []): string
    {
        $template = config('whatsva.messages.'.$key);

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
            Log::warning("WhatsvaIdService: Message template for key '{$messageKey}' not found or empty.");

            return;
        }

        if (empty($this->adminJids)) {
            Log::warning("WhatsvaIdService: No admin JIDs configured to send notification '{$messageKey}'.");

            return;
        }

        foreach ($this->adminJids as $jid) {
            if (! empty($jid)) {
                $this->sendMessage($jid, $message);
            }
        }
    }
}
