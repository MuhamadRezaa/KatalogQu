<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perpanjangan Langganan - KatalogQu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .hidden {
            display: none;
        }

        /* Styling untuk modal kustom */
        .modal {
            transition: opacity 0.3s ease-in-out;
        }

        .modal.is-active {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Floating Home Button -->
    <div class="fixed top-6 left-6 z-50">
        <a href="{{ url('/') }}"
            class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#478413] to-[#34571E] text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 group"
            title="Kembali ke Halaman Utama">
            <i data-lucide="home" class="w-5 h-5"></i>
        </a>
        <div
            class="absolute left-14 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap pointer-events-none">
            Kembali ke Home
        </div>
    </div>

    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Perpanjangan Langganan</h1>
                <p class="text-gray-600">Selesaikan perpanjangan paket langganan Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Detail Langganan</h2>

                    <div class="mb-6">
                        <img id="template-preview" src="{{ Storage::url($currentTemplate->preview_image) }}"
                            alt="Template Preview" class="w-full h-48 object-cover rounded-lg border"
                            onerror="this.src='https://placehold.co/600x400/E5E7EB/9CA3AF?text=Pratinjau+Toko'">
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Toko:</span>
                            <span id="store-name" class="font-medium">{{ $userStore->store_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Domain Toko:</span>
                            <a href="{{ request()->getScheme() }}://{{ $userStore->subdomain }}.{{ config('app.domain') }}"
                                target="_blank" id="store-domain" class="font-medium text-[#478413] hover:underline">
                                {{ $userStore->subdomain }}.{{ config('app.domain') }}
                            </a>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Paket Aktif:</span>
                            <span id="current-package-name"
                                class="font-medium">{{ $currentTemplate->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Masa Aktif Berakhir:</span>
                            <span id="expiry-date" class="font-medium">
                                {{ $userStore->expires_at ? \Carbon\Carbon::parse($userStore->expires_at)->translatedFormat('d F Y') : 'N/A' }}
                            </span>
                        </div>
                    </div>

                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Informasi Pembayaran</h2>
                    <form id="renewal-form" class="space-y-4">
                        @csrf
                        <input type="hidden" name="user_store_id" value="{{ $userStore->id }}">

                        <div>
                            <label for="customer-name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="customer-name" name="customer_name" required readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#478413] focus:border-transparent bg-gray-100"
                                value="{{ Auth::user()->name }}">
                        </div>

                        <div>
                            <label for="customer-email"
                                class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="customer-email" name="customer_email" required readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#478413] focus:border-transparent bg-gray-100"
                                value="{{ Auth::user()->email }}">
                        </div>

                        <div class="mt-6 pt-4 border-t">
                            <h3 class="font-medium mb-3">Pilih Durasi Perpanjangan</h3>
                            <div id="duration-options" class="space-y-2">
                                <!-- Opsi durasi akan ditambahkan di sini oleh JavaScript -->
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t">
                            <h3 class="font-medium mb-3">Ringkasan Pesanan</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span id="subtotal" class="font-medium"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pajak (11%):</span>
                                    <span id="tax-amount" class="font-medium"></span>
                                </div>
                                <div class="flex justify-between text-lg font-semibold pt-2 border-t">
                                    <span>Total:</span>
                                    <span id="total" class="text-[#478413]"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button id="process-payment-btn" type="button"
                                class="w-full bg-gradient-to-r from-[#478413] to-[#34571E] text-white py-3 px-4 rounded-lg font-semibold transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i data-lucide="credit-card" class="h-5 w-5 inline mr-2"></i>
                                <span id="button-text">Bayar Sekarang</span>
                            </button>
                            <div class="text-center mt-3">
                                <p class="text-xs text-gray-500">
                                    <i data-lucide="info" class="w-3 h-3 inline mr-1"></i>
                                    Anda akan dialihkan ke halaman pembayaran.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" onclick="history.back();"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
                    <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i>
                    Kembali ke Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>

    <!-- Loading & Message Overlay -->
    <div id="loading-overlay"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center modal">
        <div class="bg-white rounded-lg p-6 text-center max-w-sm mx-4">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600 font-medium" id="overlay-message">Memproses pembayaran...</p>
            <p class="text-sm text-gray-500 mt-2">Mohon tunggu, kami sedang memproses pembayaran Anda</p>
        </div>
    </div>

    <!-- Custom Alert/Modal -->
    <div id="alert-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center modal">
        <div class="bg-white rounded-lg p-6 text-center max-w-sm mx-4 shadow-xl">
            <div id="alert-icon" class="mx-auto w-12 h-12 flex items-center justify-center rounded-full mb-4">
                <!-- Icon will be inserted here -->
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2" id="alert-title"></h3>
            <p class="text-sm text-gray-600 mb-4" id="alert-message"></p>
            <button id="alert-ok-btn"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">OK</button>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        const templateData = @json($currentTemplate);
        let selectedPrice = 0;

        // Helper to format currency
        function formatCurrency(amount) {
            return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
        }

        function updatePrice() {
            const selectedDuration = document.querySelector('input[name="duration"]:checked');
            if (!selectedDuration) return;

            selectedPrice = parseFloat(selectedDuration.value);
            const tax = selectedPrice * 0.11;
            const total = selectedPrice + tax;

            document.getElementById('subtotal').textContent = formatCurrency(selectedPrice);
            document.getElementById('tax-amount').textContent = formatCurrency(tax);
            document.getElementById('total').textContent = formatCurrency(total);
            document.getElementById('button-text').textContent = `Bayar Sekarang - ${formatCurrency(total)}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const durationContainer = document.getElementById('duration-options');
            durationContainer.innerHTML = '';
            if (templateData.prices && templateData.prices.length > 0) {
                templateData.prices.sort((a, b) => a.duration_months - b.duration_months).forEach((price,
                    index) => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center justify-between p-3 border rounded-md';
                    const label = document.createElement('label');
                    label.className = 'flex items-center cursor-pointer';
                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'duration';
                    input.value = price.price;
                    input.dataset.duration = price.duration_months;
                    input.className = 'mr-3';
                    if (index === 0) {
                        input.checked = true;
                    }
                    const span = document.createElement('span');
                    span.textContent = `${price.duration_months} Bulan`;
                    label.appendChild(input);
                    label.appendChild(span);
                    const priceSpan = document.createElement('span');
                    priceSpan.className = 'font-semibold';
                    priceSpan.textContent = formatCurrency(price.price);
                    div.appendChild(label);
                    div.appendChild(priceSpan);
                    durationContainer.appendChild(div);
                });

                document.querySelectorAll('input[name="duration"]').forEach(radio => {
                    radio.addEventListener('change', updatePrice);
                });

                updatePrice();
                document.getElementById('process-payment-btn').disabled = false;
            } else {
                durationContainer.textContent = 'Opsi harga tidak tersedia.';
                document.getElementById('process-payment-btn').disabled = true;
                document.getElementById('button-text').textContent = 'Perpanjangan tidak tersedia';
            }
        });

        // Custom alert function
        function customAlert(title, message, type = 'info') {
            const modal = document.getElementById('alert-modal');
            const iconDiv = document.getElementById('alert-icon');
            const titleEl = document.getElementById('alert-title');
            const messageEl = document.getElementById('alert-message');
            const okBtn = document.getElementById('alert-ok-btn');

            titleEl.textContent = title;
            messageEl.textContent = message;
            iconDiv.innerHTML = '';
            iconDiv.className = 'mx-auto w-12 h-12 flex items-center justify-center rounded-full mb-4';

            if (type === 'success') {
                iconDiv.classList.add('bg-green-100');
                iconDiv.innerHTML = `<i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>`;
            } else if (type === 'error') {
                iconDiv.classList.add('bg-red-100');
                iconDiv.innerHTML = `<i data-lucide="x-circle" class="w-6 h-6 text-red-600"></i>`;
            } else {
                iconDiv.classList.add('bg-blue-100');
                iconDiv.innerHTML = `<i data-lucide="info" class="w-6 h-6 text-blue-600"></i>`;
            }
            lucide.createIcons();
            modal.classList.remove('hidden');

            okBtn.onclick = () => {
                modal.classList.add('hidden');
            };
        }

        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('process-payment-btn').disabled = true;
            document.getElementById('button-text').textContent = 'Memproses...';
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
            document.getElementById('process-payment-btn').disabled = false;
            document.getElementById('button-text').textContent = 'Bayar Sekarang';
        }

        document.getElementById('process-payment-btn').addEventListener('click', async function() {
            showLoading();

            const userStoreId = document.querySelector('input[name="user_store_id"]').value;
            const selectedDuration = document.querySelector('input[name="duration"]:checked');

            if (!selectedDuration) {
                hideLoading();
                customAlert('Gagal', 'Silakan pilih durasi perpanjangan.', 'error');
                return;
            }

            const data = {
                user_store_id: userStoreId,
                duration: selectedDuration.dataset.duration,
                price: selectedPrice,
                payment_method: 'xendit',
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/checkout/process-renewal', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(data),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Terjadi kesalahan pada server.');
                }

                const result = await response.json();

                if (result.success && result.redirect_url) {
                    window.location.href = result.redirect_url;
                } else {
                    throw new Error(result.message || 'Gagal memproses perpanjangan.');
                }
            } catch (error) {
                console.error('Payment error:', error);
                customAlert('Gagal', 'Terjadi kesalahan saat memproses perpanjangan. ' + error.message,
                    'error');
            } finally {
                hideLoading();
            }
        });
    </script>
</body>

</html>
