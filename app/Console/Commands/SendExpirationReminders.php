<?php

namespace App\Console\Commands;

use App\Models\UserStore;
use App\Services\WhatsvaServiceContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendExpirationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send expiration reminders to store owners for stores expiring in 7, 3, and 1 day(s).';

    protected $whatsvaService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WhatsvaServiceContract $whatsvaService)
    {
        parent::__construct();
        $this->whatsvaService = $whatsvaService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting to send expiration reminders...');
        Log::info('Cronjob: Starting SendExpirationReminders command.');

        $reminderDays = [7, 3, 1];

        foreach ($reminderDays as $days) {
            $targetDate = now()->addDays($days)->toDateString();
            $this->info("Checking for stores expiring in {$days} day(s) on {$targetDate}...");

            $stores = UserStore::with('user')
                ->where('is_active', true)
                ->whereDate('expires_at', $targetDate)
                ->get();

            if ($stores->isEmpty()) {
                $this->info("No stores found expiring in {$days} day(s).");
                continue;
            }

            $this->info("Found {$stores->count()} store(s) expiring in {$days} day(s).");

            foreach ($stores as $store) {
                $user = $store->user;

                if (!$user || !$user->phone_number) {
                    Log::warning("Skipping reminder for store #{$store->id} due to missing user or phone number.");
                    continue;
                }

                try {
                    $renewLink = route('checkout.show-renewal', ['tenant' => $store->tenant_id]);

                    // Kirim notifikasi ke pengguna
                    $userMessageKey = "pengingat_masa_aktif_pengguna_{$days}_hari";
                    $messageToUser = $this->whatsvaService->buildMessage($userMessageKey, [
                        'name' => $user->name,
                        'store_name' => $store->store_name,
                        'expires_at' => $store->expires_at->format('d M Y'),
                        'renew_link' => $renewLink,
                    ]);
                    $this->whatsvaService->sendMessage($user->phone_number, $messageToUser);
                    $this->info("Sent {$days}-day reminder to user {$user->name} for store {$store->store_name}.");

                    // Kirim notifikasi ke admin
                    $adminMessageKey = "pengingat_masa_aktif_admin_{$days}_hari";
                    $this->whatsvaService->notifyAdmins($adminMessageKey, [
                        'store_name' => $store->store_name,
                        'name' => $user->name,
                        'email' => $user->email,
                        'expires_at' => $store->expires_at->format('d M Y'),
                    ]);
                    $this->info("Sent admin notification for store {$store->store_name}.");

                } catch (\Exception $e) {
                    Log::error("Failed to send {$days}-day reminder for store #{$store->id}: " . $e->getMessage());
                    $this->error("Failed to process reminder for store #{$store->id}. Check logs.");
                }
            }
        }

        $this->info('Finished sending expiration reminders.');
        Log::info('Cronjob: Finished SendExpirationReminders command.');
        return 0;
    }
}