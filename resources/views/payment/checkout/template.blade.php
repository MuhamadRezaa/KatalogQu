<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout Template - KatalogQu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-50">
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout Template</h1>
                <p class="text-gray-600">Selesaikan pembelian template Anda</p>
                <div id="midtrans-status" class="mt-3 p-3 rounded-lg inline-block" style="display:none;">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Detail Template</h2>

                    <div class="mb-6">
                        <img id="template-preview" src="" alt="Template Preview"
                            class="w-full h-48 object-cover rounded-lg border"
                            onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDQwMCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMjAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgNzVIMjI1VjEyNUgxNzVWNzVaIiBmaWxsPSIjOUI5QkEwIi8+CjxwYXRoIGQ9Ik0xOTAgOTBIMjEwVjExMEgxOTBWOTBaIiBmaWxsPSIjRjNGNEY2Ii8+Cjx0ZXh0IHg9IjIwMCIgeT0iMTUwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjOUI5QkEwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiPlRlbXBsYXRlIFByZXZpZXc8L3RleHQ+Cjwvc3ZnPg=='">
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Template:</span>
                            <span id="template-name" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kategori:</span>
                            <span id="template-category" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga:</span>
                            <span id="template-price" class="font-medium text-[#478413] text-lg"></span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <h3 class="font-medium mb-3">Fitur Template:</h3>
                        <ul id="template-features" class="list-disc list-inside text-sm text-gray-600 space-y-1">
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Informasi Pembeli</h2>

                    <form id="checkout-form" class="space-y-4">
                        <div>
                            <label for="customer-name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap
                                *</label>
                            <input type="text" id="customer-name" name="customer_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan nama lengkap Anda"
                                value="{{ Auth::check() ? Auth::user()->name : '' }}">
                        </div>

                        <div>
                            <label for="customer-email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                *</label>
                            <input type="email" id="customer-email" name="customer_email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan email Anda"
                                value="{{ Auth::check() ? Auth::user()->email : '' }}">
                        </div>

                        <div>
                            <label for="customer-phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Telepon *</label>
                            <input type="tel" id="customer-phone" name="customer_phone" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan nomor telepon Anda">
                        </div>

                        {{-- <div>
                            <label for="customer-company" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Perusahaan (Opsional)</label>
                            <input type="text" id="customer-company" name="customer_company"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan nama perusahaan">
                        </div> --}}
                    </form>

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
                            class="w-full bg-gradient-to-r from-[#478413] to-[#34571E] text-white py-3 px-4 rounded-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            <i data-lucide="credit-card" class="h-5 w-5 inline mr-2"></i>
                            <span id="button-text">Memuat data template...</span>
                        </button>
                        <div class="text-center mt-3">
                            <p class="text-xs text-gray-500">
                                <i data-lucide="info" class="w-3 h-3 inline mr-1"></i>
                                Toko Anda akan dibuat saat tombol ini ditekan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" id="back-to-demo"
                    class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors">
                    <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i>
                    Kembali ke Demo Template
                </a>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 text-center max-w-sm mx-4">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600 font-medium">Memproses pembayaran...</p>
            <p class="text-sm text-gray-500 mt-2">Mohon tunggu, sistem sedang membuat toko Anda</p>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Global variables
        let paymentInProgress = false;
        let templateData = null; // Store template data globally

        // Helper to format currency
        function formatCurrency(amount) {
            return 'Rp ' + Math.round(amount).toLocaleString('id-ID');
        }

        // Get template slug function
        function getTemplateSlug() {
            const routeSlug = '{{ $slug ?? '' }}';
            if (routeSlug) return routeSlug;
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('template') || 'toko-komputer'; // Fallback
        }

        // Fetch template data from API
        function fetchTemplateData() {
            const templateSlug = getTemplateSlug();
            showLoading();

            fetch(`/api/templates/${templateSlug}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) throw new Error(data.error);

                    templateData = data; // Store for later use

                    const price = parseFloat(templateData.price);
                    const tax = price * 0.11;
                    const total = price + tax;

                    // Update UI
                    document.getElementById('template-name').textContent = templateData.name;
                    document.getElementById('template-category').textContent = templateData.category ? templateData
                        .category.name : 'General';
                    document.getElementById('template-price').textContent = formatCurrency(price);
                    document.getElementById('subtotal').textContent = formatCurrency(price);
                    document.getElementById('tax-amount').textContent = formatCurrency(tax);
                    document.getElementById('total').textContent = formatCurrency(total);
                    if (templateData.preview_image) {
                        document.getElementById('template-preview').src = '/storage/' + templateData.preview_image;
                    }
                    if (templateData.demo_url) {
                        document.getElementById('back-to-demo').href = templateData.demo_url;
                    }

                    // Enable button and update text
                    const buttonElement = document.getElementById('process-payment-btn');
                    buttonElement.disabled = false;
                    document.getElementById('button-text').textContent = `Bayar Sekarang - ${formatCurrency(total)}`;

                    const midtransStatus = document.getElementById('midtrans-status');
                    if (midtransStatus) midtransStatus.style.display = 'none';

                    hideLoading();
                })
                .catch(error => {
                    console.error('Error fetching template data:', error);
                    alert('Gagal memuat detail template. Silakan coba lagi.');
                    hideLoading();
                });
        }

        // Process payment button listener
        document.getElementById('process-payment-btn').addEventListener('click', function() {
            if (paymentInProgress) return;
            processPayment();
        });

        function processPayment() {
            paymentInProgress = true;
            showLoading();

            // Validate form
            const customerName = document.getElementById('customer-name').value.trim();
            const customerEmail = document.getElementById('customer-email').value.trim();
            const customerPhone = document.getElementById('customer-phone').value.trim();

            if (!customerName || !customerEmail || !customerPhone) {
                alert('Mohon lengkapi semua data yang wajib diisi (*).');
                paymentInProgress = false;
                hideLoading();
                return;
            }

            if (!templateData) {
                alert('Data template belum dimuat. Silakan tunggu atau refresh halaman.');
                paymentInProgress = false;
                hideLoading();
                return;
            }

            // Prepare data for backend
            const payload = {
                template_data: {
                    id: templateData.slug,
                    name: templateData.name,
                    price: templateData.price
                },
                customer_data: {
                    first_name: customerName.split(' ')[0] || 'Guest',
                    last_name: customerName.split(' ').slice(1).join(' ') || '',
                    email: customerEmail,
                    phone: customerPhone
                }
            };

            // Call the new Xendit API endpoint
            fetch(`/api/xendit/create-invoice`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.invoice_url) {
                        // Redirect to Xendit payment page
                        window.location.href = data.invoice_url;
                    } else {
                        throw new Error(data.message || 'Gagal membuat invoice pembayaran.');
                    }
                })
                .catch(error => {
                    hideLoading();
                    paymentInProgress = false;
                    console.error('Payment error:', error);
                    alert('Terjadi kesalahan saat memproses pembayaran: ' + error.message);
                });
        }

        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('process-payment-btn').disabled = true;
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
            document.getElementById('process-payment-btn').disabled = false;
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            fetchTemplateData();
        });
    </script>
</body>

</html>
