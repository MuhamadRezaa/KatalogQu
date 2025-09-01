<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        try {
            // For development, we'll handle SSL issues at the environment level
            /** @var \Laravel\Socialite\Two\GoogleProvider $googleDriver */
            $googleDriver = Socialite::driver('google');

            return $googleDriver
                ->with([
                    'prompt' => 'select_account',
                    'access_type' => 'offline'
                ])
                ->redirect();
        } catch (Exception $e) {
            logger()->error('Google Redirect Error: ' . $e->getMessage());
            logger()->error('Google Redirect Error Details: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Check if it's an SSL-related error
            if (str_contains($e->getMessage(), 'SSL') || str_contains($e->getMessage(), 'certificate')) {
                return redirect()->route('login')->with('error', 'Masalah koneksi SSL terdeteksi. Silakan hubungi administrator.');
            }

            return redirect()->route('login')->with('error', 'Tidak dapat terhubung ke Google: ' . $e->getMessage());
        }
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\GoogleProvider $googleDriver */
            $googleDriver = Socialite::driver('google');
            $googleUser = $googleDriver->stateless()->user();

            // Check if user already exists with this google_id
            $existingUserWithGoogleId = User::where('google_id', $googleUser->getId())->first();

            if ($existingUserWithGoogleId) {
                // User exists with this Google ID, log them in
                Auth::login($existingUserWithGoogleId, true);

                if ($existingUserWithGoogleId->role === 'admin') {
                    return redirect()->route('admin-main.dashboard')->with('success', 'Selamat datang, Admin!');
                }

                return redirect()->route('welcome')->with('success', 'Selamat datang di KatalogQu!');
            }

            // Check if user exists with same email but no google_id
            $existingUserWithEmail = User::where('email', $googleUser->getEmail())->first();

            if ($existingUserWithEmail) {
                // Store Google user data in session for account selection
                session([
                    'google_user' => [
                        'id' => $googleUser->getId(),
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'avatar' => $googleUser->getAvatar(),
                    ],
                    'existing_user' => $existingUserWithEmail
                ]);

                return view('auth.google-account-selection', [
                    'googleUser' => session('google_user'),
                    'existingUser' => $existingUserWithEmail
                ]);
            }

            // Create new user with Google data
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]);

            // Log the user in
            Auth::login($user, true);

            return redirect()->route('welcome')->with('success', 'Akun berhasil dibuat dengan Google! Selamat datang di KatalogQu!');
        } catch (Exception $e) {
            logger()->error('Google Login Error: ' . $e->getMessage());
            logger()->error('Google Login Error Details: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Check if it's an SSL-related error
            if (str_contains($e->getMessage(), 'SSL') || str_contains($e->getMessage(), 'certificate')) {
                return redirect()->route('login')->with('error', 'Masalah koneksi SSL terdeteksi. Silakan hubungi administrator.');
            }

            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }

    /**
     * Handle Google account linking or new registration
     */
    public function handleGoogleRegister(Request $request)
    {
        $googleUser = session('google_user');
        $existingUser = session('existing_user');

        if (!$googleUser) {
            return redirect('/login')->with('error', 'Sesi Google telah berakhir. Silakan coba lagi.');
        }

        $action = $request->input('action');

        if ($action === 'link' && $existingUser) {
            // Link existing account with Google
            $existingUser->update([
                'google_id' => $googleUser['id'],
                'avatar' => $googleUser['avatar'],
            ]);

            session()->forget(['google_user', 'existing_user']);
            Auth::login($existingUser, true);

            return redirect()->route('welcome')->with('success', 'Akun Google berhasil dihubungkan!');
        }

        if ($action === 'register') {
            // Create new user with Google data
            $newUser = User::create([
                'name' => $googleUser['name'],
                'email' => $googleUser['email'],
                'google_id' => $googleUser['id'],
                'avatar' => $googleUser['avatar'],
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]);

            session()->forget(['google_user', 'existing_user']);
            Auth::login($newUser, true);

            return redirect()->route('welcome')->with('success', 'Akun baru berhasil dibuat dengan Google!');
        }

        return redirect('/login')->with('error', 'Pilihan tidak valid.');
    }
}
