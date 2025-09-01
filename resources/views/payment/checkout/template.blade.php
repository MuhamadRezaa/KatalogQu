<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout Template - KatalogKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>

<body class="bg-gray-50">
    <!-- Bubble Button untuk kembali ke home -->
    <div class="fixed top-6 left-6 z-50">
        <a href="{{ url('/') }}"
            class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#478413] to-[#34571E] text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 group"
            title="Kembali ke Halaman Utama">
            <i data-lucide="home" class="w-5 h-5"></i>
        </a>
        <!-- Tooltip -->
        <div
            class="absolute left-14 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap pointer-events-none">
            Kembali ke Home
        </div>
    </div>

    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout Template</h1>
                <p class="text-gray-600">Selesaikan pembelian template Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Template Information -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Detail Template</h2>

                    <!-- Template Preview -->
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
                            <!-- Features will be populated by JavaScript -->
                        </ul>
                    </div>
                </div>

                <!-- Checkout Form -->
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

                    <!-- Order Summary -->
                    <div class="mt-6 pt-4 border-t">
                        <h3 class="font-medium mb-3">Ringkasan Pesanan</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span id="subtotal" class="font-medium"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pajak (0%):</span>
                                <span class="font-medium">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-lg font-semibold pt-2 border-t">
                                <span>Total:</span>
                                <span id="total" class="text-[#478413]"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="mt-6">
                        <button id="process-payment-btn" type="button"
                            class="w-full bg-gradient-to-r from-[#478413] to-[#34571E] text-white py-3 px-4 rounded-lg font-semibold hover:from-cyan-600 hover:to-blue-700 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i data-lucide="credit-card" class="h-5 w-5 inline mr-2"></i>
                            Bayar Sekarang - <span id="payment-amount"></span>
                        </button>
                        <center>
                            <i class="text-xs text-gray-500 mt-2">
                                -- Create your domain after payments --
                        </center>
                        </i>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
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
        <div class="bg-white rounded-lg p-6 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Memproses pembayaran...</p>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Get template slug from route parameter, URL parameter, or localStorage
        function getTemplateSlug() {
            // First check if slug is passed from the controller (route parameter)
            const routeSlug = '{{ $slug ?? '' }}';
            if (routeSlug) {
                return routeSlug;
            }

            // Fallback to URL query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const slug = urlParams.get('template');

            if (slug) {
                return slug;
            }

            // Fallback to localStorage if available
            const pendingCheckout = localStorage.getItem('pendingCheckout');
            if (pendingCheckout) {
                try {
                    const data = JSON.parse(pendingCheckout);
                    return data.template_slug || data.id;
                } catch (e) {
                    console.error('Error parsing pendingCheckout:', e);
                }
            }

            // Default fallback
            return 'toko-komputer';
        }

        // Fetch template data from API
        function fetchTemplateData() {
            const templateSlug = getTemplateSlug();
            showLoading();

            // Use the current origin for API calls to ensure correct port
            const baseUrl = window.location.origin;
            fetch(`${baseUrl}/api/templates/${templateSlug}`)
                .then(response => response.json())
                .then(template => {
                    if (template.error) {
                        throw new Error(template.error);
                    }

                    // Update UI with template data
                    document.getElementById('template-name').textContent = template.name;
                    document.getElementById('template-category').textContent = template.category ? template.category
                        .name : 'General';
                    document.getElementById('template-price').textContent = 'Rp ' + parseFloat(template.price)
                        .toLocaleString('id-ID');
                    document.getElementById('subtotal').textContent = 'Rp ' + parseFloat(template.price).toLocaleString(
                        'id-ID');
                    document.getElementById('total').textContent = 'Rp ' + parseFloat(template.price).toLocaleString(
                        'id-ID');
                    document.getElementById('payment-amount').textContent = 'Rp ' + parseFloat(template.price)
                        .toLocaleString('id-ID');

                    // Set preview image if available
                    if (template.preview_image) {
                        document.getElementById('template-preview').src = '/storage/' + template.preview_image;
                    }

                    // Set back to demo link
                    if (template.demo_url) {
                        document.getElementById('back-to-demo').href = template.demo_url;
                    }

                    // Set default features based on template category
                    const featuresList = document.getElementById('template-features');
                    featuresList.innerHTML = '';

                    let features = [];
                    const categoryName = template.category ? template.category.name.toLowerCase() : '';

                    if (categoryName.includes('komputer') || categoryName.includes('computer')) {
                        features = [
                            'Desain responsif untuk semua perangkat',
                            'Katalog produk dengan pencarian dan filter',
                            'Sistem keranjang belanja',
                            'Integrasi payment gateway',
                            'Panel admin untuk manajemen produk',
                            'SEO optimized',
                            'Mobile-friendly interface',
                            'Image lightbox gallery'
                        ];
                    } else if (categoryName.includes('fnb') || categoryName.includes('food')) {
                        features = [
                            'Desain menarik untuk bisnis F&B',
                            'Katalog menu dengan kategori',
                            'Fitur pencarian dan filter menu',
                            'Keranjang belanja',
                            'Integrasi pembayaran Midtrans',
                            'Panel admin untuk manajemen menu',
                            'Responsif untuk mobile dan desktop',
                            'Galeri gambar produk'
                        ];
                    } else {
                        features = [
                            'Desain responsif untuk semua perangkat',
                            'Katalog produk dengan pencarian dan filter',
                            'Sistem keranjang belanja',
                            'Integrasi payment gateway',
                            'Panel admin untuk manajemen produk',
                            'SEO optimized',
                            'Mobile-friendly interface'
                        ];
                    }

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
                    document.getElementById('template-name').textContent = 'TechZone - Computer Store Template';
                    document.getElementById('template-category').textContent = 'Toko Komputer';
                    document.getElementById('template-price').textContent = 'Rp 150.000';
                    document.getElementById('subtotal').textContent = 'Rp 150.000';
                    document.getElementById('total').textContent = 'Rp 150.000';
                    document.getElementById('payment-amount').textContent = 'Rp 150.000';
                    document.getElementById('back-to-demo').href = '/demo/toko-komputer';
                    hideLoading();
                });
        }

        // Process payment functionality
        document.getElementById('process-payment-btn').addEventListener('click', function() {
            processPayment();
        });

        function processPayment() {
            // Validate form
            const customerName = document.getElementById('customer-name').value.trim();
            const customerEmail = document.getElementById('customer-email').value.trim();
            const customerPhone = document.getElementById('customer-phone').value.trim();
            const customerCompany = document.getElementById('customer-company').value.trim();

            if (!customerName || !customerEmail || !customerPhone) {
                alert('Mohon lengkapi semua data yang wajib diisi (*).');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(customerEmail)) {
                alert('Format email tidak valid.');
                return;
            }

            // Phone validation
            const phoneRegex = /^[0-9+\-\s()]+$/;
            if (!phoneRegex.test(customerPhone)) {
                alert('Format nomor telepon tidak valid.');
                return;
            }

            // Show loading
            showLoading();

            // Get template data
            const templateSlug = getTemplateSlug();

            // Use the current origin for API calls to ensure correct port
            const baseUrl = window.location.origin;
            fetch(`${baseUrl}/api/templates/${templateSlug}`)
                .then(response => response.json())
                .then(template => {
                    if (template.error) {
                        throw new Error(template.error);
                    }

                    // Prepare template data
                    const templateData = {
                        id: template.slug,
                        name: template.name,
                        type: template.category ? template.category.name : 'General',
                        price: parseFloat(template.price),
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
                    alert('Gagal memuat data template. Silakan coba lagi.');
                });
        }

        function processMidtransPayment(templateData) {
            // Check if Midtrans Snap is available
            if (typeof window.snap === 'undefined') {
                hideLoading();
                alert('Layanan pembayaran Midtrans tidak tersedia. Silakan refresh halaman dan coba lagi.');
                return;
            }

            // Generate order ID
            const orderId = 'TEMPLATE-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

            // Prepare payment data
            const paymentData = {
                transaction_details: {
                    order_id: orderId,
                    gross_amount: templateData.price
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
                }]
            };

            // Call backend to get Snap token
            console.log('Sending payment request:', {
                payment_data: paymentData,
                template_data: templateData,
                customer_data: {
                    first_name: templateData.customer.first_name,
                    last_name: templateData.customer.last_name,
                    email: templateData.customer.email,
                    phone: templateData.customer.phone,
                    company: templateData.customer.company
                }
            });

            // Use the current origin for API calls to ensure correct port
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
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    hideLoading();

                    if (data.success && data.snap_token) {
                        // Open Midtrans Snap popup
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('Payment success:', result);
                                handlePaymentSuccess(result, templateData);
                            },
                            onPending: function(result) {
                                console.log('Payment pending:', result);
                                handlePaymentPending(result, templateData);
                            },
                            onError: function(result) {
                                console.log('Payment error:', result);
                                handlePaymentError(result);
                            },
                            onClose: function() {
                                console.log('Payment popup closed');
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Failed to get payment token');
                    }
                })
                .catch(error => {
                    hideLoading();
                    console.error('Payment error:', error);

                    // More detailed error handling
                    let errorMessage = 'Terjadi kesalahan saat memproses pembayaran.';

                    if (error.message) {
                        if (error.message.includes('Failed to fetch')) {
                            errorMessage = 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
                        } else if (error.message.includes('CSRF')) {
                            errorMessage = 'Sesi telah berakhir. Silakan refresh halaman dan coba lagi.';
                        } else if (error.message.includes('Midtrans') || error.message.includes('payment')) {
                            errorMessage = 'Layanan pembayaran sedang tidak tersedia. Silakan coba lagi nanti.';
                        } else {
                            errorMessage = `Error: ${error.message}`;
                        }
                    }

                    // Show user-friendly error message
                    alert(errorMessage +
                        '\n\nJika masalah berlanjut, silakan hubungi customer service atau coba refresh halaman.');

                    // Optionally redirect to retry or contact page
                    if (confirm('Apakah Anda ingin mencoba lagi?')) {
                        // User can try again
                        return;
                    } else {
                        // Redirect to demo or contact page
                        const templateSlug = getTemplateSlug();
                        window.location.href = `/demo/${templateSlug}`;
                    }
                });
        }

        function handlePaymentSuccess(result, templateData) {
            // Store payment result for setup form
            sessionStorage.setItem('paymentResult', JSON.stringify({
                order_id: result.order_id,
                template_data: templateData,
                payment_status: 'paid',
                completed_at: new Date().toISOString()
            }));

            alert('Pembayaran berhasil! Silakan lengkapi setup toko Anda.');
            // Redirect to store setup form with order_id
            window.location.href = '/store-setup?order_id=' + result.order_id;
        }

        function handlePaymentPending(result, templateData) {
            // Store pending payment for setup form (ignoring status as requested)
            sessionStorage.setItem('paymentResult', JSON.stringify({
                order_id: result.order_id,
                template_data: templateData,
                payment_status: 'pending',
                completed_at: new Date().toISOString()
            }));

            alert('Pembayaran sedang diproses. Anda dapat melanjutkan setup toko.');
            // Redirect to store setup form even for pending payments
            window.location.href = '/store-setup?order_id=' + result.order_id;
        }

        function handlePaymentError(result) {
            alert('Pembayaran gagal. Silakan coba lagi.');
        }

        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('process-payment-btn').disabled = true;
        }

        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
            document.getElementById('process-payment-btn').disabled = false;
        }

        // Initialize page with template data
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            fetchTemplateData();
        });
    </script>
</body>

</html>
