<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WhatsvaServiceContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    protected $whatsvaService;

    public function __construct(WhatsvaServiceContract $whatsvaService)
    {
        $this->whatsvaService = $whatsvaService;
    }

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
        if (! $request->has('code')) {
            // Pengguna kemungkinan membatalkan otentikasi
            return redirect()->route('login')->with('error', 'Otentikasi Google dibatalkan.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();

            // 1. Cari pengguna berdasarkan google_id (paling utama), termasuk yang di-soft-delete
            $user = User::withTrashed()->where('google_id', $googleUser->getId())->first();

            // 2. Jika tidak ketemu, cari berdasarkan email, termasuk yang di-soft-delete
            if (! $user) {
                $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

                // Jika pengguna ditemukan via email (mungkin daftar manual sebelumnya),
                // update google_id mereka untuk mempermudah login selanjutnya.
                if ($user) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            // 3. Jika pengguna ditemukan, aktif, DAN memiliki nomor telepon, langsung login.
            //    Jika tidak memenuhi kriteria di atas (pengguna baru, di-soft-delete, atau nomor telepon kosong),
            //    arahkan ke proses registrasi/konfirmasi.
            if ($user && ! $user->trashed() && ! empty($user->phone_number)) { // User found, NOT soft-deleted, AND has phone number
                // Update google_id jika belum ada (misal: daftar manual lalu login Google)
                if (empty($user->google_id)) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }
                Auth::login($user, true);
                session()->forget('google_user_data'); // Hapus data dari session

                return redirect()->route('welcome')->with('success', 'Selamat datang kembali!');
            }

            // Jika pengguna tidak ditemukan, atau ditemukan tapi di-soft-delete,
            // atau pengguna aktif tapi nomor telepon kosong,
            // alihkan ke proses registrasi/konfirmasi.
            $sessionData = [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ];

            // Jika pengguna ditemukan (aktif atau di-soft-delete), tambahkan nomor telepon mereka ke data sesi jika ada
            if ($user) {
                $sessionData['phone_number'] = $user->phone_number;
            }

            session(['google_user_data' => $sessionData]);

            return redirect()->route('google.register.view'); // Arahkan ke route view registrasi baru

        } catch (Exception $e) {
            Log::error('GOOGLE_CALLBACK_ERROR: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat otentikasi dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan halaman konfirmasi untuk pendaftaran baru dengan Google.
     */
    public function showGoogleRegisterView()
    {
        if (! session()->has('google_user_data')) {
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
        // Transform phone number input
        $phoneNumber = $request->input('phone_number');
        if ($phoneNumber && substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62'.substr($phoneNumber, 1);
            $request->merge(['phone_number' => $phoneNumber]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'google_id' => 'required|string',
            'avatar' => 'nullable|string|url',
            'phone_number' => ['required', 'string', 'regex:/^62[0-9]{8,13}$/', 'unique:users,phone_number'],
        ]);

        try {
            // Coba cari pengguna yang sudah ada (termasuk yang di-soft-delete)
            $user = User::withTrashed()->where('google_id', $request->google_id)->first();

            if (! $user) {
                $user = User::withTrashed()->where('email', $request->email)->first();
            }

            if ($user) {
                // Jika pengguna ditemukan (baik aktif atau di-soft-delete)
                if ($user->trashed()) {
                    $user->restore(); // Kembalikan pengguna jika di-soft-delete
                }

                // Update google_id jika belum ada (misal: daftar manual lalu login Google)
                if (empty($user->google_id)) {
                    $user->google_id = $request->google_id;
                }

                // Update nomor telepon jika kosong
                if (empty($user->phone_number)) {
                    $user->phone_number = $request->phone_number;
                }

                $user->save(); // Simpan semua perubahan

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
                'phone_number' => $request->phone_number,
            ]);

            // Kirim notifikasi WhatsApp untuk pengguna baru
            $messageToUser = $this->whatsvaService->buildMessage('pengguna_mendaftar_akun', [
                'name' => $user->name,
            ]);
            $this->whatsvaService->sendMessage($user->phone_number, $messageToUser);

            $this->whatsvaService->notifyAdmins('admin_notifikasi_pengguna_baru', [
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
            ]);

            Auth::login($user, true);
            session()->forget('google_user_data'); // Hapus data dari session

            return redirect()->route('welcome')->with('success', 'Akun berhasil dibuat dengan Google! Selamat datang.');
        } catch (\Exception $e) {
            Log::error('GOOGLE_REGISTER_PROCESS_ERROR: '.$e->getMessage());

            return redirect()->route('register')->with('error', 'Gagal menyimpan data pengguna. Silakan coba lagi.');
        }
    }
}
