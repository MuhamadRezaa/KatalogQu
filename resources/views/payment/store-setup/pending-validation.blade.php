<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Subdomain Anda Sedang Ditinjau - KatalogKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center">
            <div>
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 mb-6">
                    <i data-lucide="hourglass" class="h-10 w-10 text-yellow-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Terima Kasih!</h2>
                <p class="text-gray-600 mb-8">Pengaturan toko Anda telah kami terima dan pembayaran Anda berhasil.</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg px-6 py-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Subdomain Sedang Ditinjau</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Untuk memastikan keamanan dan kualitas layanan, subdomain yang Anda daftarkan:
                    <br>
                    <strong
                        class="text-indigo-600">{{ $userStore->subdomain ?? 'subdomain' }}.{{ config('app.domain', 'localhost') }}</strong>
                    <br>
                    akan divalidasi secara manual oleh tim kami.
                </p>
                <p class="text-sm text-gray-600">
                    Proses ini biasanya memakan waktu maksimal 1x24 jam. Kami akan memberitahu Anda melalui email jika
                    subdomain Anda telah aktif dan siap digunakan.
                </p>
                <div class="mt-6">
                    <a href="{{ route('profile.show') }}"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kembali ke Profil Saya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>

</html>
