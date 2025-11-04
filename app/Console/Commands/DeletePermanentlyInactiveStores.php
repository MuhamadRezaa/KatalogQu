<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\UserStore;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DeletePermanentlyInactiveStores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-permanently-inactive-stores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user stores that have been inactive for 7 days due to expiration, along with their data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mencari toko non-aktif yang kedaluwarsa untuk dihapus...');

        $storesToDelete = UserStore::where('is_active', false)
            ->whereNotNull('deactivated_at')
            ->where('deactivated_at', '<=', now()->subDays(7))
            ->get();

        if ($storesToDelete->isEmpty()) {
            $this->info('Tidak ada toko non-aktif yang memenuhi kriteria penghapusan.');
            return Command::SUCCESS;
        }

        foreach ($storesToDelete as $store) {
            try {
                $this->warn('Memproses penghapusan toko: ' . $store->store_name . ' (ID: ' . $store->id . ')');

                // 1. Hapus direktori storage tenant
                if ($store->tenant_id) {
                    $tenantStoragePath = 'tenants/' . $store->tenant_id;
                    if (Storage::disk('public')->exists($tenantStoragePath)) {
                        Storage::disk('public')->deleteDirectory($tenantStoragePath);
                        $this->info('Direktori storage tenant ' . $store->tenant_id . ' berhasil dihapus.');
                    } else {
                        $this->warn('Direktori storage tenant ' . $store->tenant_id . ' tidak ditemukan atau sudah dihapus.');
                    }
                }

                // 2. Hapus record Tenant (ini akan secara cascade menghapus Domains)
                if ($store->tenant_id) {
                    $tenant = Tenant::find($store->tenant_id);
                    if ($tenant) {
                        $tenant->delete();
                        $this->info('Record Tenant ' . $store->tenant_id . ' dan domain terkait berhasil dihapus.');
                    } else {
                        $this->warn('Record Tenant ' . $store->tenant_id . ' tidak ditemukan atau sudah dihapus.');
                    }
                }

                // 3. Hapus record UserStore (ini akan secara cascade menghapus StoreAdmin, StoreProduct, dll.)
                $store->delete();
                $this->info('Record UserStore ' . $store->store_name . ' (ID: ' . $store->id . ') dan data terkait berhasil dihapus.');

                Log::info('Toko dihapus permanen', [
                    'store_id' => $store->id,
                    'store_name' => $store->store_name,
                    'subdomain' => $store->subdomain,
                    'deactivated_at' => $store->deactivated_at,
                    'deleted_at' => now()
                ]);

            } catch (\Exception $e) {
                $this->error('Gagal menghapus toko ' . $store->store_name . ' (ID: ' . $store->id . '): ' . $e->getMessage());
                Log::error('Gagal menghapus toko permanen', [
                    'store_id' => $store->id,
                    'store_name' => $store->store_name,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        $this->info('Selesai menghapus toko non-aktif yang kedaluwarsa.');

        return Command::SUCCESS;
    }
}
