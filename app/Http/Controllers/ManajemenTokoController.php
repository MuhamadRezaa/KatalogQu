<?php

namespace App\Http\Controllers;

use App\Models\UserStore;
use Illuminate\Http\Request;

class ManajemenTokoController extends Controller
{
    /**
     * Menampilkan daftar semua toko di panel admin pusat.
     */
    public function index()
    {
        $stores = UserStore::with('user')->latest()->paginate(15);
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
            $userStore->update([
                // HANYA ubah status setup menjadi 'completed'.
                // 'is_active' tetap false (default).
                'setup_status' => 'completed',
            ]);

            return back()->with('success', 'Toko berhasil disetujui dan sekarang siap untuk diaktifkan.');
        }

        return back()->with('error', 'Toko ini tidak dalam status menunggu validasi.');
    }
}
