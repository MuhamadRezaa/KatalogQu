<?php

namespace App\Services;

interface WhatsvaServiceContract
{
    public function sendMessage(string $jid, string $message): bool;
    public function buildMessage(string $key, array $placeholders = []): string;
    public function notifyAdmins(string $messageKey, array $placeholders = []): void;
}
