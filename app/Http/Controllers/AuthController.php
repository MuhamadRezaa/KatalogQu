<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WhatsvaServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    protected $whatsvaService;

    public function __construct(WhatsvaServiceContract $whatsvaService)
    {
        $this->whatsvaService = $whatsvaService;
    }

    /**
     * Display the registration form.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Transform phone number input
        $phoneNumber = $request->input('phone_number');
        if ($phoneNumber && substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62'.substr($phoneNumber, 1);
            $request->merge(['phone_number' => $phoneNumber]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'regex:/^62[0-9]{8,13}$/', 'unique:users,phone_number'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ], [
            'g-recaptcha-response.required' => 'Harap konfirmasi bahwa Anda bukan robot.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal, silakan coba lagi.',
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
            ]);

            // Kirim pesan WhatsApp ke pengguna
            $messageToUser = $this->whatsvaService->buildMessage('pengguna_mendaftar_akun', [
                'name' => $user->name,
            ]);
            $this->whatsvaService->sendMessage($user->phone_number, $messageToUser);

            // Kirim notifikasi ke admin
            $this->whatsvaService->notifyAdmins('admin_notifikasi_pengguna_baru', [
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
            ]);

            Auth::login($user);

            return redirect()->route('welcome')->with('success', 'Registrasi berhasil! Selamat datang.');
        } catch (\Exception $e) {
            // Catat error spesifik ke file log
            Log::error('REGISTRATION_ERROR: '.$e->getMessage());

            // Kembalikan pengguna dengan pesan error yang jelas
            return back()->with('error', 'Terjadi kesalahan saat mendaftarkan akun. Silakan coba lagi nanti.')->withInput();
        }
    }

    /**
     * Display the login form.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function attempt(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ], [
            'g-recaptcha-response.required' => 'Harap konfirmasi bahwa Anda bukan robot.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal, silakan coba lagi.',
        ]);

        // **PERBARUAN: Cek apakah user ada sebelum mencoba login**
        $user = User::where('email', $credentials['email'])->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar. Silakan daftar terlebih dahulu.',
            ])->onlyInput('email');
        }

        // Lanjutkan proses login jika user ada
        if (Auth::attempt(\Illuminate\Support\Arr::except($credentials, 'g-recaptcha-response'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            $currentSessionId = $request->session()->getId();
            $userId = Auth::user()->id;

            tenancy()->central(function () use ($userId, $currentSessionId) {
                DB::table('sessions')
                    ->where('user_id', $userId)
                    ->where('id', '!=', $currentSessionId)
                    ->delete();
            });

            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin-main.index')->with('success', 'Selamat datang, Admin!');
            }

            return redirect()->route('welcome')->with('success', 'Selamat datang di KatalogQu!');
        }

        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
