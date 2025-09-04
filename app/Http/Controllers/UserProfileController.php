<?php

namespace App\Http\Controllers;

use App\Models\TemplatePurchase;
use App\Models\UserStore; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            ->paginate(5, ['*'], 'purchases_page'); // Paginasi untuk pembelian

        // Mengambil katalog/toko yang dimiliki pengguna
        $userStores = UserStore::where('user_id', $user->id)
            ->where('setup_status', 'completed')
            ->latest()
            ->paginate(5, ['*'], 'stores_page'); // Paginasi untuk toko

        return view('profile.show', compact('user', 'purchases', 'userStores'));
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
