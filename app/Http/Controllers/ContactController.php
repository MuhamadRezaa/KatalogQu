<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Sanitasi dan pembersihan input
        $input = $request->all();

        // Trim whitespace dari semua input
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = trim($value);
            }
        });

        // Buat request baru dengan input yang sudah dibersihkan
        $request->merge($input);

        // Validasi input yang sangat fleksibel
        $validated = $request->validate([
            'name' => 'required|min:1|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'nullable|max:25', // Diperpanjang untuk nomor internasional
            'subjek' => 'required|min:1|max:255',
            'text' => 'required|min:1|max:10000', // Diperpanjang untuk pesan yang lebih detail
        ], [
            // Custom error messages yang lebih friendly
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama terlalu panjang (maksimal 255 karakter).',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email terlalu panjang (maksimal 255 karakter).',
            'no_telp.max' => 'Nomor telepon terlalu panjang (maksimal 25 karakter).',
            'subjek.required' => 'Subjek pesan wajib diisi.',
            'subjek.min' => 'Subjek tidak boleh kosong.',
            'subjek.max' => 'Subjek terlalu panjang (maksimal 255 karakter).',
            'text.required' => 'Pesan wajib diisi.',
            'text.min' => 'Pesan tidak boleh kosong.',
            'text.max' => 'Pesan terlalu panjang (maksimal 10.000 karakter).',
        ]);

        try {
            // Log untuk debugging
            Log::info('Attempting to save contact message', $validated);

            // Membuat entri baru di database
            $contact = Contact::create($validated);

            // Log sukses
            Log::info('Contact message saved successfully', ['id' => $contact->id]);

            // Kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim! Tim kami akan segera merespons.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Log database error
            Log::error('Database error when saving contact message', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan database. Silakan coba lagi atau hubungi administrator.');
        } catch (\Exception $e) {
            // Log general error
            Log::error('General error when saving contact message', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }
    }
}
