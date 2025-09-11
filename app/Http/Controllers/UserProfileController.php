<?php

namespace App\Http\Controllers;

use App\Models\TemplatePurchase;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function show()
    {
        $user = Auth::user();

        // Mengambil riwayat pembelian
        $purchases = TemplatePurchase::where('user_id', $user->id)
            ->with('catalogTemplate')
            ->latest()
            ->paginate(10, ['*'], 'purchases_page'); // Paginasi untuk pembelian

        // Mengambil katalog/toko yang dimiliki pengguna (yang sudah selesai)
        $userStores = UserStore::where('user_id', $user->id)
            ->where('setup_status', 'completed')
            ->latest()
            ->paginate(10, ['*'], 'stores_page'); // Paginasi untuk toko

        // --- AWAL PERUBAHAN ---
        // Mengambil data setup toko yang masih tertunda
        $pendingSetups = UserStore::where('user_id', $user->id)
            ->whereIn('setup_status', ['pending', 'in_progress', 'pending_validation'])
            ->with('catalogTemplate') // Memuat relasi template
            ->latest()
            ->get();
        // --- AKHIR PERUBAHAN ---

        return view('profile.show', compact('user', 'purchases', 'userStores', 'pendingSetups'));
    }


    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan struk untuk pembelian tertentu.
     */
    public function showInvoice($transactionId)
    {
        $purchase = TemplatePurchase::where('transaction_id', $transactionId)
            ->where('user_id', Auth::id())
            ->with('catalogTemplate', 'user')
            ->firstOrFail();

        return view('profile.invoice', compact('purchase'));
    }
}
