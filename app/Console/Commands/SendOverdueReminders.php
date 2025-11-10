<?php

namespace App\Console\Commands;

use App\Models\UserStore;
use App\Services\WhatsvaServiceContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class SendOverdueReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends reminders for overdue stores that were deactivated 3 and 6 days ago.';

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
        URL::forceRootUrl(config('app.url'));
        $this->info('Starting to send overdue reminders...');
        Log::info('Cronjob: Starting SendOverdueReminders command.');

        $reminderDays = [3, 6];

        foreach ($reminderDays as $days) {
            $targetDeactivationDate = now()->subDays($days)->toDateString();
            $this->info("Checking for stores deactivated {$days} day(s) ago on {$targetDeactivationDate}...");

            $stores = UserStore::with('user')
                ->where('is_active', false)
                ->whereNotNull('deactivated_at')
                ->whereDate('deactivated_at', $targetDeactivationDate)
                ->get();

            if ($stores->isEmpty()) {
                $this->info("No stores found deactivated {$days} day(s) ago.");
                continue;
            }

            $this->info("Found {$stores->count()} store(s) deactivated {$days} day(s) ago.");

            foreach ($stores as $store) {
                $user = $store->user;

                if (!$user || !$user->phone_number) {
                    Log::warning("Skipping overdue reminder for store #{$store->id} due to missing user or phone number.");
                    continue;
                }

                try {
                    $renewLink = route('checkout.show-renewal', ['tenant' => $store->tenant_id]);
                    $deletionDate = $store->deactivated_at->addDays(7);

                    // Kirim notifikasi ke pengguna
                    $userMessageKey = "overdue_pengguna_hari_{$days}";
                    $messageToUser = $this->whatsvaService->buildMessage($userMessageKey, [
                        'name' => $user->name,
                        'store_name' => $store->store_name,
                        'days_overdue' => $days,
                        'expires_at' => $store->expires_at->format('d M Y'),
                        'days_left' => 7 - $days,
                        'deletion_date' => $deletionDate->format('d M Y'),
                        'renew_link' => $renewLink,
                    ]);
                    $this->whatsvaService->sendMessage($user->phone_number, $messageToUser);
                    $this->info("Sent {$days}-day overdue reminder to user {$user->name} for store {$store->store_name}.");

                    // Kirim notifikasi ke admin
                    $adminMessageKey = "overdue_admin_hari_{$days}";
                    $this->whatsvaService->notifyAdmins($adminMessageKey, [
                        'store_name' => $store->store_name,
                        'name' => $user->name,
                        'email' => $user->email,
                        'days_overdue' => $days,
                        'expires_at' => $store->expires_at->format('d M Y'),
                        'deletion_date' => $deletionDate->format('d M Y'),
                    ]);
                    $this->info("Sent admin notification for overdue store {$store->store_name}.");

                } catch (\Exception $e) {
                    Log::error("Failed to send {$days}-day overdue reminder for store #{$store->id}: " . $e->getMessage());
                    $this->error("Failed to process overdue reminder for store #{$store->id}. Check logs.");
                }
            }
        }

        $this->info('Finished sending overdue reminders.');
        Log::info('Cronjob: Finished SendOverdueReminders command.');
        return 0;
    }
}