<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Pembayaran Berhasil - KatalogKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                    <i data-lucide="check" class="h-10 w-10 text-green-600"></i>
                </div>

                <!-- Success Message -->
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    @if (isset($payment_status))
                        @if ($payment_status === 'paid')
                            Pembayaran Berhasil!
                        @elseif($payment_status === 'pending')
                            Pembayaran Sedang Diproses
                        @elseif($payment_status === 'failed')
                            Pembayaran Gagal
                        @else
                            Status Pembayaran
                        @endif
                    @else
                        Pembayaran Berhasil!
                    @endif
                </h2>
                <p class="text-gray-600 mb-8">
                    @if (isset($payment_status))
                        @if ($payment_status === 'paid')
                            Terima kasih telah melakukan pembelian template. Pesanan Anda sedang diproses.
                        @elseif($payment_status === 'pending')
                            Pembayaran Anda sedang diverifikasi. Mohon tunggu konfirmasi lebih lanjut.
                        @elseif($payment_status === 'failed')
                            Maaf, pembayaran Anda tidak dapat diproses. Silakan coba lagi.
                        @else
                            Status pembayaran Anda: {{ ucfirst($payment_status) }}
                        @endif
                    @else
                        Terima kasih telah melakukan pembelian template. Pesanan Anda sedang diproses.
                    @endif
                </p>

                <!-- Order Details -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8 text-left">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pesanan</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order ID:</span>
                            <span class="font-medium" id="orderId">{{ $order_id ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Template:</span>
                            <span class="font-medium" id="templateName">{{ $template_name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total:</span>
                            <span class="font-medium text-green-600" id="totalAmount">{{ $total_amount ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            @if (isset($payment_status))
                                @if ($payment_status === 'paid')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Berhasil
                                    </span>
                                @elseif($payment_status === 'pending')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($payment_status === 'failed')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Gagal
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($payment_status) }}
                                    </span>
                                @endif
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Berhasil
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    @if (isset($payment_status) && $payment_status === 'paid')
                        <!-- Primary action: Setup your store -->
                        <a href="{{ route('store.setup.form') }}"
                            class="w-full bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-200 block text-center">
                            <i data-lucide="store" class="inline-block w-5 h-5 mr-2"></i>
                            Setup Toko Anda Sekarang
                        </a>

                        <!-- Secondary action: Download template -->
                        <button onclick="downloadTemplate()"
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            <i data-lucide="download" class="inline-block w-5 h-5 mr-2"></i>
                            Download Template
                        </button>
                    @elseif(isset($payment_status) && $payment_status === 'pending')
                        <button disabled
                            class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                            <i data-lucide="clock" class="inline-block w-5 h-5 mr-2"></i>
                            Menunggu Pembayaran
                        </button>

                        <!-- Info message for pending payment -->
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <i data-lucide="info" class="inline-block w-4 h-4 mr-1"></i>
                                Setelah pembayaran berhasil, Anda akan dapat melanjutkan untuk setup toko.
                            </p>
                        </div>
                    @elseif(isset($payment_status) && $payment_status === 'failed')
                        <button disabled
                            class="w-full bg-red-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                            <i data-lucide="x-circle" class="inline-block w-5 h-5 mr-2"></i>
                            Pembayaran Gagal
                        </button>

                        <!-- Retry payment -->
                        <a href="/demo/toko-komputer"
                            class="block w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 text-center">
                            <i data-lucide="refresh-cw" class="inline-block w-5 h-5 mr-2"></i>
                            Coba Lagi
                        </a>
                    @else
                        <!-- Fallback for testing or unknown status -->
                        <a href="{{ route('store.setup.form') }}"
                            class="w-full bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition duration-200 block text-center">
                            <i data-lucide="store" class="inline-block w-5 h-5 mr-2"></i>
                            Setup Toko Anda Sekarang
                        </a>

                        <button onclick="downloadTemplate()"
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            <i data-lucide="download" class="inline-block w-5 h-5 mr-2"></i>
                            Download Template
                        </button>
                    @endif

                    <a href="/demo/toko-komputer"
                        class="block w-full bg-gray-200 text-gray-800 py-3 px-6 rounded-lg font-semibold hover:bg-gray-300 transition duration-200 text-center">
                        <i data-lucide="arrow-left" class="inline-block w-5 h-5 mr-2"></i>
                        Kembali ke Demo
                    </a>
                </div>


                <!-- Additional Info -->
                <div
                    class="mt-8 p-4 rounded-lg
                    @if (isset($payment_status)) @if ($payment_status === 'paid')
                            bg-blue-50
                        @elseif($payment_status === 'pending')
                            bg-yellow-50
                        @elseif($payment_status === 'failed')
                            bg-red-50
                        @else
                            bg-blue-50 @endif
@else
bg-blue-50
                    @endif
                ">
                    <p
                        class="text-sm
                        @if (isset($payment_status)) @if ($payment_status === 'paid')
                                text-blue-800
                            @elseif($payment_status === 'pending')
                                text-yellow-800
                            @elseif($payment_status === 'failed')
                                text-red-800
                            @else
                                text-blue-800 @endif
@else
text-blue-800
                        @endif
                    ">
                        <i data-lucide="info" class="inline-block w-4 h-4 mr-1"></i>
                        @if (isset($payment_status))
                            @if ($payment_status === 'paid')
                                Selamat! Anda dapat langsung setup toko online Anda. Link download template juga telah
                                dikirim ke email Anda.
                            @elseif($payment_status === 'pending')
                                Pembayaran Anda sedang diproses. Kami akan mengirimkan konfirmasi melalui email setelah
                                pembayaran berhasil.
                            @elseif($payment_status === 'failed')
                                Pembayaran gagal. Silakan coba lagi atau hubungi customer service untuk bantuan.
                            @else
                                Status pembayaran: {{ ucfirst($payment_status) }}
                            @endif
                        @else
                            Selamat! Anda dapat langsung setup toko online Anda. Link download template juga telah
                            dikirim ke email Anda.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        function downloadTemplate() {
            const orderId = document.getElementById('orderId').textContent;

            @if (isset($purchase_data) && $purchase_data)
                // Gunakan data dari database
                @if ($purchase_data->payment_status === 'paid')
                    // Redirect ke endpoint download yang aman
                    window.location.href = `/admin/demo/download-template/{{ $purchase_data->id }}`;
                @else
                    showNotification('Pembayaran belum selesai. Status: {{ ucfirst($purchase_data->payment_status) }}',
                        'error');
                @endif
            @else
                // Fallback untuk demo jika data tidak ada di database
                const templateData = JSON.parse(localStorage.getItem('purchasedTemplate') || '{}');

                if (templateData.name) {
                    // Create a simple text file as demo
                    const content =
                        `Template: ${templateData.name}\nKategori: ${templateData.type}\nHarga: ${templateData.price}\n\nTerima kasih telah membeli template ini!`;
                    const blob = new Blob([content], {
                        type: 'text/plain'
                    });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `${templateData.name.replace(/\s+/g, '_')}_template.txt`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);

                    // Show success message
                    showNotification('Template berhasil didownload!', 'success');
                } else {
                    showNotification('Data template tidak ditemukan', 'error');
                }
            @endif
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

            if (type === 'success') {
                notification.classList.add('bg-green-500', 'text-white');
            } else if (type === 'error') {
                notification.classList.add('bg-red-500', 'text-white');
            } else {
                notification.classList.add('bg-blue-500', 'text-white');
            }

            notification.innerHTML = `<div class="flex items-center space-x-2"><span>${message}</span></div>`;

            document.body.appendChild(notification);
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Load order details from URL parameters or localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const orderId = urlParams.get('order_id');
            const templateData = JSON.parse(localStorage.getItem('purchasedTemplate') || '{}');

            if (orderId) {
                document.getElementById('orderId').textContent = orderId;
            }

            if (templateData.name) {
                document.getElementById('templateName').textContent = templateData.name;
                document.getElementById('totalAmount').textContent =
                    `Rp ${parseInt(templateData.price).toLocaleString('id-ID')}`;
            }
        });
    </script>
</body>

</html>
