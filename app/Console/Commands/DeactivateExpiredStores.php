<?php

namespace App\Console\Commands;

use App\Models\UserStore;
use App\Services\WhatsvaServiceContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class DeactivateExpiredStores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deactivate-expired-stores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivates expired stores and sends overdue notifications.';

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
     */
    public function handle()
    {
        URL::forceRootUrl(config('app.url'));
        $expiredStores = UserStore::where('is_active', true)
            ->where('expires_at', '<=', now())
            ->get();

        if ($expiredStores->isEmpty()) {
            $this->info('Tidak ada toko aktif yang kedaluwarsa.');

            return Command::SUCCESS;
        }

        foreach ($expiredStores as $store) {
            $store->is_active = false;
            $store->deactivated_at = now(); // Set the deactivated_at timestamp
            $store->save();
            $this->info('Toko '.$store->store_name.' (ID: '.$store->id.') telah dinonaktifkan karena kedaluwarsa.');

            // Kirim notifikasi WhatsApp
            try {
                $user = $store->user;
                if ($user && $user->phone_number) {
                    $renewLink = route('checkout.show-renewal', ['tenant' => $store->tenant_id]);

                    // Kirim pesan ke pengguna
                    $this->whatsvaService->sendMessage(
                        $user->phone_number,
                        $this->whatsvaService->buildMessage('overdue_pengguna_hari_h', [
                            'name' => $user->name,
                            'store_name' => $store->store_name,
                            'expires_at' => $store->expires_at->format('d M Y'),
                            'renew_link' => $renewLink,
                        ])
                    );

                    // Kirim notifikasi ke admin
                    $this->whatsvaService->notifyAdmins('overdue_admin_hari_h', [
                        'store_name' => $store->store_name,
                        'name' => $user->name,
                        'email' => $user->email,
                        'expires_at' => $store->expires_at->format('d M Y'),
                    ]);

                    $this->info("Notifikasi overdue hari H terkirim untuk toko: {$store->store_name}");
                }
            } catch (\Exception $e) {
                Log::error("Gagal mengirim notifikasi overdue hari H untuk toko #{$store->id}: ".$e->getMessage());
                $this->error("Gagal memproses notifikasi untuk toko #{$store->id}. Cek log.");
            }
        }

        $this->info('Selesai menonaktifkan toko yang kedaluwarsa.');

        return Command::SUCCESS;
    }
}
