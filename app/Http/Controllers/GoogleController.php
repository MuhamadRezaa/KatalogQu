<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    /**
     * Alihkan pengguna ke halaman otentikasi Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Dapatkan informasi pengguna dari Google dan proses login.
     * Fungsi ini HANYA untuk LOGIN, tidak untuk mendaftar.
     */
    public function handleGoogleCallback(Request $request)
    {
        // Cek apakah ada parameter 'code' yang menandakan otentikasi berhasil
        if (!$request->has('code')) {
            // Pengguna kemungkinan membatalkan otentikasi
            return redirect()->route('login')->with('error', 'Otentikasi Google dibatalkan.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();

            // 1. Cari pengguna berdasarkan google_id (paling utama), termasuk yang di-soft-delete
            $user = User::withTrashed()->where('google_id', $googleUser->getId())->first();

            // 2. Jika tidak ketemu, cari berdasarkan email, termasuk yang di-soft-delete
            if (!$user) {
                $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

                // Jika pengguna ditemukan via email (mungkin daftar manual sebelumnya),
                // update google_id mereka untuk mempermudah login selanjutnya.
                if ($user) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            // 3. PENTING: Jika pengguna ditemukan (baik via google_id atau email) ATAU pengguna sama sekali tidak ditemukan,
            //    selalu alihkan ke proses registrasi/konfirmasi dengan membawa data dari Google.
            session([
                'google_user_data' => [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]
            ]);
            return redirect()->route('google.register.view'); // Arahkan ke route view registrasi baru

        } catch (Exception $e) {
            Log::error('GOOGLE_CALLBACK_ERROR: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat otentikasi dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan halaman konfirmasi untuk pendaftaran baru dengan Google.
     */
    public function showGoogleRegisterView()
    {
        if (!session()->has('google_user_data')) {
            return redirect()->route('register')->with('error', 'Data Google tidak ditemukan. Silakan coba mendaftar lagi.');
        }

        $googleUserData = session('google_user_data');
        return view('auth.google-register', ['google_user' => $googleUserData]); // Pastikan Anda membuat view ini
    }

    /**
     * Membuat pengguna baru dari data Google setelah konfirmasi.
     */
    public function handleGoogleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'google_id' => 'required|string',
            'avatar' => 'nullable|string|url',
        ]);

        try {
            // Coba cari pengguna yang sudah ada (termasuk yang di-soft-delete)
            $user = User::withTrashed()->where('google_id', $request->google_id)->first();

            if (!$user) {
                $user = User::withTrashed()->where('email', $request->email)->first();
            }

            if ($user) {
                // Jika pengguna ditemukan (baik aktif atau di-soft-delete)
                if ($user->trashed()) {
                    $user->restore(); // Kembalikan pengguna jika di-soft-delete
                }

                // Update google_id jika belum ada (misal: daftar manual lalu login Google)
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $request->google_id]);
                }

                Auth::login($user, true);
                session()->forget('google_user_data');

                return redirect()->route('welcome')->with('success', 'Selamat datang kembali!');
            }

            // Jika pengguna tidak ditemukan sama sekali, buat yang baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'google_id' => $request->google_id,
                'avatar' => $request->avatar,
                'password' => Hash::make(Str::random(24)), // Buat password acak yang aman
                'email_verified_at' => now(),
            ]);

            Auth::login($user, true);
            session()->forget('google_user_data'); // Hapus data dari session

            return redirect()->route('welcome')->with('success', 'Akun berhasil dibuat dengan Google! Selamat datang.');
        } catch (\Exception $e) {
            Log::error('GOOGLE_REGISTER_PROCESS_ERROR: ' . $e->getMessage());
            return redirect()->route('register')->with('error', 'Gagal menyimpan data pengguna. Silakan coba lagi.');
        }
    }
}
