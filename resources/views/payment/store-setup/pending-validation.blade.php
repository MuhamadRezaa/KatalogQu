<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Toko Sedang Ditinjau - KatalogQu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center bg-white p-10 rounded-xl shadow-lg">
            <div>
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-orange-100 mb-6">
                    <i data-lucide="shield-check" class="h-10 w-10 text-yellow-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Toko Anda Sedang Ditinjau</h2>
                <p class="text-gray-600 mb-8">
                    Terima kasih telah melakukan pendaftaran di KatalogQu. Toko Anda dengan nama <strong
                        style="font-style: italic; text-grey-400"
                        class="text-gray-800">{{ $userStore->store_name }}</strong> sedang
                    dalam
                    proses validasi oleh
                    tim kami.
                </p>
                <div class="bg-gray-100 rounded-lg p-4 text-left">
                    <p class="text-sm text-gray-700"><strong>Subdomain:</strong> <a href="#"
                            class="text-indigo-600 pointer-events-none">{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}</a>
                    </p>
                    <p class="text-sm text-gray-700"><strong>Status:</strong> <span
                            class="font-semibold text-yellow-700">Menunggu Persetujuan</span></p>
                </div>
                <p class="mt-6 text-sm text-gray-500">
                    Proses ini biasanya memakan waktu beberapa jam. Anda akan menerima notifikasi email setelah toko
                    Anda aktif. Halaman ini akan otomatis diperbarui.
                </p>
            </div>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    Kembali ke Halaman Utama </a>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
