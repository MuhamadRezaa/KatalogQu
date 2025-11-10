<?php

namespace App\Http\Controllers;

use App\Models\UserStore;
use App\Models\TemplatePurchase;
use App\Services\WhatsvaServiceContract;
use Illuminate\Http\Request;

class ManajemenTokoController extends Controller
{
    protected $whatsvaService;

    public function __construct(WhatsvaServiceContract $whatsvaService)
    {
        $this->whatsvaService = $whatsvaService;
    }

    /**
     * Menampilkan daftar semua toko di panel admin pusat.
     */
    public function index()
    {
        $stores = UserStore::with('user')->whereIn('setup_status', ['pending_validation', 'completed'])->latest()->paginate(15);
        $centralDomain = config('tenancy.central_domains')[0] ?? request()->getHost();

        return view('admin-main.pages.manajemen-toko.index', compact('stores', 'centralDomain'));
    }

    /**
     * Mengubah status aktif/non-aktif sebuah toko yang sudah disetujui.
     */
    public function toggleStatus(UserStore $userStore)
    {
        // Fungsi ini hanya boleh dijalankan untuk toko yang sudah selesai setup-nya.
        if ($userStore->setup_status === 'completed') {

            // Cek apakah ini pertama kalinya toko diaktifkan.
            if (!$userStore->is_active && is_null($userStore->activated_at)) {
                // Jika ya, set is_active dan activated_at.
                $userStore->update([
                    'is_active' => true,
                    'activated_at' => now(),
                ]);
            } else {
                // Jika hanya menonaktifkan atau mengaktifkan kembali, cukup toggle is_active.
                $userStore->update([
                    'is_active' => !$userStore->is_active,
                ]);
            }

            return back()->with('success', 'Status toko berhasil diubah.');
        }

        return back()->with('error', 'Toko ini harus disetujui (approve) terlebih dahulu sebelum bisa diaktifkan/dinonaktifkan.');
    }

    /**
     * Menyetujui toko yang sedang dalam status 'pending_validation'.
     * INI PERUBAHAN UTAMA: is_active tidak diubah di sini.
     */
    public function approve(UserStore $userStore)
    {
        // Pastikan hanya toko yang 'pending' yang bisa di-approve.
        if ($userStore->setup_status === 'pending_validation') {
            $purchase = TemplatePurchase::where('transaction_id', $userStore->payment_transaction_id)->first();

            if (!$purchase) {
                return back()->with('error', 'Data pembelian tidak ditemukan untuk toko ini.');
            }

            $duration = $purchase->duration_months ?? 12; // Fallback to 12 months if not set

            $activated_at = now();
            $expires_at = now()->addMonths($duration);

            $userStore->update([
                // Ubah status setup menjadi 'completed' dan set expires_at.
                'setup_status' => 'completed',
                'is_active' => true,
                'activated_at' => $activated_at,
                'expires_at' => $expires_at,
            ]);

            // Kirim notifikasi WhatsApp
            try {
                $user = $userStore->user;
                if ($user && $user->phone_number) {
                    // Kirim pesan ke pengguna
                    $messageToUser = $this->whatsvaService->buildMessage('toko_aktif', [
                        'name' => $user->name,
                        'store_name' => $userStore->store_name,
                        'activated_at' => $activated_at->format('d M Y'),
                        'expires_at' => $expires_at->format('d M Y'),
                    ]);
                    $this->whatsvaService->sendMessage($user->phone_number, $messageToUser);

                    // Kirim notifikasi ke admin
                    $this->whatsvaService->notifyAdmins('admin_notifikasi_toko_aktif', [
                        'store_name' => $userStore->store_name,
                        'activated_at' => $activated_at->format('d M Y'),
                        'expires_at' => $expires_at->format('d M Y'),
                        'name' => $user->name,
                        'email' => $user->email,
                    ]);
                }
            } catch (\Exception $e) {
                // Jangan gagalkan proses utama jika notifikasi gagal
                \Illuminate\Support\Facades\Log::error('WHATSAPP_NOTIFICATION_ERROR [ApproveStore]: ' . $e->getMessage());
            }

            return back()->with('success', 'Toko berhasil disetujui dan sekarang siap untuk diaktifkan.');
        }

        return back()->with('error', 'Toko ini tidak dalam status menunggu validasi.');
    }
}
