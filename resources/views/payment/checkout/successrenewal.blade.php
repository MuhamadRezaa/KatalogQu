<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Pembayaran Berhasil - KatalogQu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-2xl w-full text-center">

        <div class="flex flex-col items-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="check-circle" class="w-10 h-10 text-green-600"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Pembayaran Berhasil!</h1>
            <p class="text-gray-600">Terima kasih atas pembayaran Anda. Masa aktif toko Anda telah berhasil
                diperpanjang.
            </p>
        </div>

        <hr class="my-8 border-gray-200">

        <div class="text-left">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Perpanjangan</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 flex items-center gap-2">
                        <i data-lucide="calendar-plus" class="w-5 h-5 text-indigo-500"></i>
                        Tanggal Pembayaran
                    </span>
                    <span class="font-medium text-gray-800">{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 flex items-center gap-2">
                        <i data-lucide="dollar-sign" class="w-5 h-5 text-green-500"></i>
                        Jumlah Dibayar
                    </span>
                    <span class="font-medium text-gray-800">
                        @if ($templatePurchase)
                            {{ 'Rp ' . number_format($templatePurchase->final_amount, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5 text-yellow-500"></i>
                        Masa Aktif Baru
                    </span>
                    <span class="font-bold text-lg text-indigo-600">
                        {{-- Gunakan nilai dari database --}}
                        {{ \Carbon\Carbon::parse($userStore->expires_at)->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>


        <hr class="my-8 border-gray-200">

        <div class="space-y-4">
            <p class="text-gray-600">Anda dapat kembali ke dashboard untuk mengelola toko Anda.</p>
            <a href="{{ url('/profile#stores') }}"
                class="inline-flex items-center justify-center w-full px-6 py-3 border border-transparent rounded-full shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 transform hover:scale-105">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-2"></i>
                Kembali ke Profile Saya
            </a>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
