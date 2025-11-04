<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredStores = \App\Models\UserStore::where('is_active', true)
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
            $this->info('Toko ' . $store->store_name . ' (ID: ' . $store->id . ') telah dinonaktifkan karena kedaluwarsa.');
        }

        $this->info('Selesai menonaktifkan toko yang kedaluwarsa.');

        return Command::SUCCESS;
    }
}
