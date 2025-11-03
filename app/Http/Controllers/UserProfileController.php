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
            ->with(['catalogTemplate', 'payment'])
            ->latest()
            ->get();

        // Mengambil katalog/toko yang dimiliki pengguna (yang sudah selesai)
        $userStores = UserStore::where('user_id', $user->id)
            ->where('setup_status', 'completed')
            ->latest()
            ->get();

        // --- AWAL PERUBAHAN ---
        // Mengambil data setup toko yang masih tertunda
        $pendingSetups = UserStore::where('user_id', $user->id)
            ->whereIn('setup_status', ['pending', 'in_progress', 'pending_validation'])
            ->with(['catalogTemplate', 'templatePurchase.payment']) // Memuat relasi template & pembelian
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

        // Transform phone number input
        $phoneNumber = $request->input('phone_number');
        if ($phoneNumber && substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
            $request->merge(['phone_number' => $phoneNumber]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'phone_number' => ['nullable', 'string', 'regex:/^62[0-9]{8,13}$/'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
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
