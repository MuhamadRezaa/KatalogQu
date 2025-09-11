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
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>

<body class="bg-gray-50">
    <!-- Debug Panel - Remove in production -->
    <div id="debug-panel"
        class="fixed top-0 right-0 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4 text-sm z-50"
        style="display: none;">
        <strong>Debug Info:</strong>
        <div id="debug-content"></div>
        <button onclick="document.getElementById('debug-panel').style.display='none'"
            class="float-right font-bold">&times;</button>
    </div>

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
                <!-- Midtrans Status Indicator -->
                <div id="midtrans-status" class="mt-3 p-3 rounded-lg inline-block">
                    <p class="text-sm">
                        <i data-lucide="loader" class="w-4 h-4 inline mr-1 animate-spin"></i>
                        Memuat sistem pembayaran...
                    </p>
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

                        <div>
                            <label for="customer-company" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Perusahaan (Opsional)</label>
                            <input type="text" id="customer-company" name="customer_company"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan nama perusahaan">
                        </div>
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
                            <span id="button-text">Memuat sistem pembayaran...</span>
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
        let currentUserStoreId = null;
        let paymentInProgress = false;
        let midtransReady = false;
        let currentOrderId = null;

        // FIXED: Comprehensive Midtrans loading check
        function checkMidtransAvailability() {
            return new Promise((resolve, reject) => {
                let attempts = 0;
                const maxAttempts = 30; // 3 seconds total

                const checkInterval = setInterval(() => {
                    attempts++;

                    // Check if snap object exists and has required methods
                    if (typeof window.snap !== 'undefined' &&
                        typeof window.snap.pay === 'function') {

                        clearInterval(checkInterval);
                        midtransReady = true;
                        updateMidtransStatus('ready');
                        resolve(true);
                        return;
                    }

                    if (attempts >= maxAttempts) {
                        clearInterval(checkInterval);
                        midtransReady = false;
                        updateMidtransStatus('failed');
                        reject(new Error('Midtrans Snap failed to load after 3 seconds'));
                        return;
                    }
                }, 100); // Check every 100ms
            });
        }

        function updateMidtransStatus(status) {
            const statusElement = document.getElementById('midtrans-status');
            const buttonElement = document.getElementById('process-payment-btn');
            const buttonText = document.getElementById('button-text');

            switch (status) {
                case 'loading':
                    statusElement.innerHTML = `
                        <p class="text-sm text-blue-600">
                            <i data-lucide="loader" class="w-4 h-4 inline mr-1 animate-spin"></i>
                            Memuat sistem pembayaran...
                        </p>
                    `;
                    statusElement.className = 'mt-3 bg-blue-50 border border-blue-200 p-3 rounded-lg inline-block';
                    buttonElement.disabled = true;
                    buttonText.textContent = 'Memuat sistem pembayaran...';
                    break;

                case 'ready':
                    statusElement.innerHTML = `
                        <p class="text-sm text-green-600">
                            <i data-lucide="shield-check" class="w-4 h-4 inline mr-1"></i>
                            Sistem pembayaran siap - Aman dengan enkripsi SSL
                        </p>
                    `;
                    statusElement.className = 'mt-3 bg-green-50 border border-green-200 p-3 rounded-lg inline-block';
                    buttonElement.disabled = false;
                    buttonText.innerHTML = 'Bayar Sekarang - <span id="payment-amount"></span>';
                    // Update payment amount if available
                    const total = document.getElementById('total').textContent;
                    if (total && document.getElementById('payment-amount')) {
                        document.getElementById('payment-amount').textContent = total;
                    }
                    break;

                case 'failed':
                    statusElement.innerHTML = `
                        <p class="text-sm text-red-600">
                            <i data-lucide="alert-triangle" class="w-4 h-4 inline mr-1"></i>
                            Gagal memuat sistem pembayaran -
                            <button onclick="retryMidtrans()" class="underline hover:no-underline">Coba Lagi</button>
                        </p>
                    `;
                    statusElement.className = 'mt-3 bg-red-50 border border-red-200 p-3 rounded-lg inline-block';
                    buttonElement.disabled = true;
                    buttonText.textContent = 'Sistem pembayaran tidak tersedia';
                    showDebugInfo('Midtrans Script gagal dimuat. Periksa koneksi internet atau konfigurasi server.');
                    break;
            }

            // Refresh icons after DOM update
            lucide.createIcons();
        }

        function retryMidtrans() {
            updateMidtransStatus('loading');

            // Remove existing script
            const existingScript = document.querySelector('script[src*="snap.js"]');
            if (existingScript) {
                existingScript.remove();
            }

            // Add new script
            const script = document.createElement('script');
            @if (config('services.midtrans.is_production'))
                script.src = 'https://app.midtrans.com/snap/snap.js';
            @else
                script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
            @endif
            script.setAttribute('data-client-key', '{{ config('services.midtrans.client_key') }}');

            script.onload = () => {
                setTimeout(() => {
                    checkMidtransAvailability().catch(error => {
                        console.error('Midtrans retry failed:', error);
                    });
                }, 500);
            };

            script.onerror = () => {
                updateMidtransStatus('failed');
            };

            document.head.appendChild(script);
        }

        function showDebugInfo(message) {
            const debugPanel = document.getElementById('debug-panel');
            const debugContent = document.getElementById('debug-content');

            debugContent.innerHTML = `
                <div>${message}</div>
                <div>Client Key: {{ config('services.midtrans.client_key') ? 'Configured' : 'Missing' }}</div>
                <div>Environment: {{ config('services.midtrans.is_production') ? 'Production' : 'Sandbox' }}</div>
                <div>Current URL: ${window.location.href}</div>
                <div>User Agent: ${navigator.userAgent}</div>
            `;

            debugPanel.style.display = 'block';
        }

        // Get template slug function
        function getTemplateSlug() {
            const routeSlug = '{{ $slug ?? '' }}';
            if (routeSlug) {
                return routeSlug;
            }

            const urlParams = new URLSearchParams(window.location.search);
            const slug = urlParams.get('template');

            if (slug) {
                return slug;
            }

            const pendingCheckout = localStorage.getItem('pendingCheckout');
            if (pendingCheckout) {
                try {
                    const data = JSON.parse(pendingCheckout);
                    return data.template_slug || data.id;
                } catch (e) {
                    console.error('Error parsing pendingCheckout:', e);
                }
            }

            return 'toko-komputer';
        }

        // Fetch template data from API
        function fetchTemplateData() {
            const templateSlug = getTemplateSlug();
            showLoading();

            const baseUrl = window.location.origin;
            fetch(`${baseUrl}/api/templates/${templateSlug}`)
                .then(response => response.json())
                .then(template => {
                    if (template.error) {
                        throw new Error(template.error);
                    }

                    const price = parseFloat(template.price);
                    const tax = price * 0.11;
                    const total = Math.round(price + tax);

                    // Update UI with template data
                    document.getElementById('template-name').textContent = template.name;
                    document.getElementById('template-category').textContent = template.category ? template.category
                        .name : 'General';
                    document.getElementById('template-price').textContent = 'Rp ' + price.toLocaleString('id-ID');
                    document.getElementById('subtotal').textContent = 'Rp ' + price.toLocaleString('id-ID');
                    document.getElementById('tax-amount').textContent = 'Rp ' + Math.round(tax).toLocaleString('id-ID');
                    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');

                    // Update payment amount if button is ready
                    const paymentAmountElement = document.getElementById('payment-amount');
                    if (paymentAmountElement) {
                        paymentAmountElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
                    }

                    // Set preview image if available
                    if (template.preview_image) {
                        document.getElementById('template-preview').src = '/storage/' + template.preview_image;
                    }

                    // Set back to demo link
                    if (template.demo_url) {
                        document.getElementById('back-to-demo').href = template.demo_url;
                    }

                    // Add features
                    const featuresList = document.getElementById('template-features');
                    featuresList.innerHTML = '';
                    let features = [
                        'Desain responsif untuk semua perangkat',
                        'Katalog produk dengan pencarian dan filter',
                        'Sistem keranjang belanja',
                        'Integrasi payment gateway',
                        'Panel admin untuk manajemen produk',
                        'SEO optimized',
                        'Mobile-friendly interface'
                    ];

                    features.forEach(feature => {
                        const li = document.createElement('li');
                        li.textContent = feature;
                        featuresList.appendChild(li);
                    });

                    hideLoading();
                })
                .catch(error => {
                    console.error('Error fetching template data:', error);
                    // Show default data if fetch fails
                    const price = 150000;
                    const tax = price * 0.11;
                    const total = Math.round(price + tax);

                    document.getElementById('template-name').textContent = 'TechZone - Computer Store Template';
                    document.getElementById('template-category').textContent = 'Toko Komputer';
                    document.getElementById('template-price').textContent = 'Rp ' + price.toLocaleString('id-ID');
                    document.getElementById('subtotal').textContent = 'Rp ' + price.toLocaleString('id-ID');
                    document.getElementById('tax-amount').textContent = 'Rp ' + Math.round(tax).toLocaleString('id-ID');
                    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
                    document.getElementById('back-to-demo').href = '/demo/toko-komputer';
                    hideLoading();
                });
        }

        // Process payment functionality
        document.getElementById('process-payment-btn').addEventListener('click', function() {
            if (!midtransReady) {
                alert('Sistem pembayaran belum siap. Mohon tunggu atau refresh halaman.');
                return;
            }

            if (paymentInProgress) {
                console.log('Payment already in progress, ignoring click');
                return;
            }

            processPayment();
        });

        function processPayment() {
            paymentInProgress = true;

            // Validate form
            const customerName = document.getElementById('customer-name').value.trim();
            const customerEmail = document.getElementById('customer-email').value.trim();
            const customerPhone = document.getElementById('customer-phone').value.trim();
            const customerCompany = document.getElementById('customer-company').value.trim();

            if (!customerName || !customerEmail || !customerPhone) {
                alert('Mohon lengkapi semua data yang wajib diisi (*).');
                paymentInProgress = false;
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(customerEmail)) {
                alert('Format email tidak valid.');
                paymentInProgress = false;
                return;
            }

            // Phone validation
            const phoneRegex = /^[0-9+\-\s()]+$/;
            if (!phoneRegex.test(customerPhone)) {
                alert('Format nomor telepon tidak valid.');
                paymentInProgress = false;
                return;
            }

            // Show loading
            showLoading();

            // Get template data
            const templateSlug = getTemplateSlug();
            const baseUrl = window.location.origin;

            fetch(`${baseUrl}/api/templates/${templateSlug}`)
                .then(response => response.json())
                .then(template => {
                    if (template.error) {
                        throw new Error(template.error);
                    }

                    const price = parseFloat(template.price);
                    const tax = price * 0.11;
                    const roundedTax = Math.round(tax);
                    const total = price + roundedTax;

                    // Prepare template data
                    const templateData = {
                        id: template.slug,
                        name: template.name,
                        type: template.category ? template.category.name : 'General',
                        price: price,
                        tax: roundedTax,
                        total: total,
                        timestamp: new Date().toISOString(),
                        customer: {
                            first_name: customerName.split(' ')[0] || 'Guest',
                            last_name: customerName.split(' ').slice(1).join(' ') || '',
                            email: customerEmail,
                            phone: customerPhone,
                            company: customerCompany
                        }
                    };

                    // Save to localStorage
                    localStorage.setItem('pendingCheckout', JSON.stringify({
                        ...templateData,
                        template_slug: template.slug
                    }));

                    // Process Midtrans payment
                    processMidtransPayment(templateData);
                })
                .catch(error => {
                    console.error('Error fetching template data:', error);
                    hideLoading();
                    paymentInProgress = false;
                    alert('Gagal memuat data template. Silakan coba lagi.');
                });
        }

        function processMidtransPayment(templateData) {
            // Double check Midtrans availability
            if (!midtransReady || typeof window.snap === 'undefined') {
                hideLoading();
                paymentInProgress = false;
                alert('Sistem pembayaran tidak tersedia. Silakan refresh halaman dan coba lagi.');
                return;
            }

            // Generate order ID
            const timestamp = Date.now();
            const randomPart = Math.random().toString(36).substr(2, 9);
            const orderId = 'KatalogQu-TEMPLATE' + timestamp + '-' + randomPart;
            currentOrderId = orderId; // Store order ID for cancellation

            // Prepare payment data
            const paymentData = {
                transaction_details: {
                    order_id: orderId,
                    gross_amount: templateData.total
                },
                customer_details: {
                    first_name: templateData.customer.first_name,
                    last_name: templateData.customer.last_name,
                    email: templateData.customer.email,
                    phone: templateData.customer.phone
                },
                item_details: [{
                        id: 'template-' + templateData.id,
                        price: templateData.price,
                        quantity: 1,
                        name: templateData.name
                    },
                    {
                        id: 'tax-' + templateData.id,
                        price: templateData.tax,
                        quantity: 1,
                        name: 'PPN 11%'
                    }
                ]
            };

            // Call backend to get Snap token
            const baseUrl = window.location.origin;
            fetch(`${baseUrl}/api/midtrans/get-snap-token`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        payment_data: paymentData,
                        template_data: templateData,
                        customer_data: {
                            first_name: templateData.customer.first_name,
                            last_name: templateData.customer.last_name,
                            email: templateData.customer.email,
                            phone: templateData.customer.phone,
                            company: templateData.customer.company
                        }
                    })
                })
                .then(response => {
                    // Always try to parse the JSON body
                    return response.json().then(data => {
                        // If response was not OK, create an error object with details from the body
                        if (!response.ok) {
                            const error = new Error(data.message || `HTTP error! status: ${response.status}`);
                            error.debug_message = data.debug_message;
                            throw error;
                        }
                        // If response was OK, return the data for the next .then()
                        return data;
                    });
                })
                .then(data => {
                    hideLoading();

                    if (data.success && data.snap_token) {
                        if (data.user_store_id) {
                            currentUserStoreId = data.user_store_id;
                        }

                        // Open Midtrans Snap popup
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('Payment success:', result);
                                paymentInProgress = false;
                                handlePaymentSuccess(result, templateData);
                            },
                            onPending: function(result) {
                                console.log('onPending callback triggered. Current Order ID:',
                                    currentOrderId);
                                paymentInProgress = false;

                                if (currentOrderId) {
                                    console.log(
                                        'Order ID found, attempting to call cancellation API from onPending.'
                                        );
                                    // Send cancellation request to the backend
                                    const baseUrl = window.location.origin;
                                    fetch(`${baseUrl}/checkout/cancel`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').getAttribute(
                                                    'content')
                                            },
                                            body: JSON.stringify({
                                                order_id: currentOrderId
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                console.log(
                                                    'Transaction status updated to cancelled from onPending.'
                                                    );
                                            }
                                        })
                                        .catch(error => {
                                            console.error(
                                                'Failed to notify backend of cancellation from onPending:',
                                                error);
                                        });
                                } else {
                                    console.error(
                                        'Cannot cancel payment from onPending because currentOrderId is null.'
                                        );
                                }

                                alert(
                                    'Pembayaran dibatalkan. Pesanan Anda telah ditandai sebagai "dibatalkan".');
                            },
                            onError: function(result) {
                                console.log('Payment error:', result);
                                paymentInProgress = false;
                                alert(
                                    'Pembayaran gagal. Silakan coba lagi atau gunakan metode pembayaran lain.'
                                );
                            },
                            onClose: function() {
                                console.log('onClose callback triggered. Current Order ID:',
                                currentOrderId);
                                paymentInProgress = false;

                                if (currentOrderId) {
                                    console.log(
                                        'Order ID found, attempting to call cancellation API from onClose.'
                                        );
                                    // Send cancellation request to the backend
                                    const baseUrl = window.location.origin;
                                    fetch(`${baseUrl}/checkout/cancel`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').getAttribute(
                                                    'content')
                                            },
                                            body: JSON.stringify({
                                                order_id: currentOrderId
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                console.log('Transaction status updated to cancelled.');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Failed to notify backend of cancellation:',
                                                error);
                                        });
                                } else {
                                    console.error(
                                        'Cannot cancel payment from onClose because currentOrderId is null.'
                                        );
                                }

                                alert(
                                    'Pembayaran dibatalkan. Pesanan Anda telah ditandai sebagai "dibatalkan".');
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Failed to get payment token');
                    }
                })
                .catch(error => {
                    hideLoading();
                    paymentInProgress = false;
                    console.error('Payment error:', error);

                    // Use the detailed error message from the server
                    let errorMessage = error.message || 'Terjadi kesalahan saat memproses pembayaran.';
                    let debugMessage = error.debug_message || 'No debug info.';

                    showDebugInfo(`Payment Error: ${errorMessage} <br> Server Debug: ${debugMessage}`);
                    alert(errorMessage +
                        '\n\nJika masalah berlanjut, silakan hubungi customer service atau coba refresh halaman.');

                    if (confirm('Apakah Anda ingin mencoba lagi?')) {
                        return;
                    } else {
                        const templateSlug = getTemplateSlug();
                        window.location.href = `/demo/${templateSlug}`;
                    }
                });
        }

        function handlePaymentSuccess(result, templateData) {
            sessionStorage.setItem('paymentResult', JSON.stringify({
                order_id: result.order_id,
                template_data: templateData,
                payment_status: 'paid',
                completed_at: new Date().toISOString(),
                user_store_id: currentUserStoreId
            }));

            // Redirect to the status page without any artificial parameters
            const statusUrl = new URL(`${window.location.origin}/checkout/status/${result.order_id}`);
            window.location.href = statusUrl.href;
        }

        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('process-payment-btn').disabled = true;
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
            if (midtransReady) {
                document.getElementById('process-payment-btn').disabled = false;
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();

            // Reset variables
            paymentInProgress = false;
            currentUserStoreId = null;

            // Update status to loading
            updateMidtransStatus('loading');

            // Check Midtrans availability
            checkMidtransAvailability()
                .then(() => {
                    console.log('Midtrans loaded successfully');
                    // Fetch template data after Midtrans is ready
                    fetchTemplateData();
                })
                .catch(error => {
                    console.error('Midtrans failed to load:', error);
                    // Still try to fetch template data
                    fetchTemplateData();
                });
        });

        // Additional debugging for production
        window.addEventListener('error', function(event) {
            if (event.error && event.error.message.includes('snap')) {
                showDebugInfo(`JavaScript Error: ${event.error.message} at ${event.filename}:${event.lineno}`);
            }
        });
    </script>
</body>

</html>
