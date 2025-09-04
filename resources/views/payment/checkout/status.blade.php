<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Status Pembayaran - {{ $templatePurchase->transaction_id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Poppins', sans-serif;
        }

        .receipt-container {
            max-width: 450px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .receipt-header {
            background: linear-gradient(135deg, #478413 0%, #2c5a08 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-bottom: 5px solid #f99a07;
        }

        .receipt-header img {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .receipt-header h4 {
            font-weight: 600;
            margin: 0;
        }

        .receipt-body {
            padding: 30px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .info-row .label {
            color: #6c757d;
        }

        .info-row .value {
            font-weight: 500;
            text-align: right;
        }

        /* --- AWAL PERUBAHAN --- */
        .template-preview {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
        }

        /* --- AKHIR PERUBAHAN --- */

        .status-badge {
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 9999px;
            font-size: 0.9rem;
        }

        .status-paid {
            background-color: #d1fae5;
            color: #067647;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #b45309;
        }

        .status-failed {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .action-area {
            margin-top: 30px;
            text-align: center;
        }

        .action-area .message {
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .receipt-footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .btn-brand {
            background-color: #478413;
            border-color: #478413;
            color: white;
        }

        .btn-brand:hover {
            background-color: #2c5a08;
            border-color: #2c5a08;
            color: white;
        }
    </style>
</head>

<body>

    <div class="receipt-container">
        <div class="receipt-header">
            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogQu Logo">
            <h4 id="statusTitle">
                @if ($templatePurchase->payment_status == 'paid')
                    Pembayaran Berhasil
                @elseif($templatePurchase->payment_status == 'pending')
                    Menunggu Konfirmasi
                @else
                    Pembayaran Gagal
                @endif
            </h4>
        </div>

        <div class="receipt-body">

            @if ($templatePurchase->catalogTemplate && $templatePurchase->catalogTemplate->preview_image)
                <img src="{{ asset('storage/' . $templatePurchase->catalogTemplate->preview_image) }}"
                    alt="Template Preview" class="template-preview">
            @endif

            <div class="info-row">
                <span class="label">Nama Template</span>
                <span class="value">{{ $templatePurchase->catalogTemplate->name ?? 'N/A' }}</span>
            </div>

            <div class="info-row">
                <span class="label">ID Pesanan</span>
                <span class="value">{{ $templatePurchase->transaction_id }}</span>
            </div>
            <div class="info-row">
                <span class="label">Total Bayar</span>
                <span class="value fw-bold">Rp {{ number_format($templatePurchase->final_amount, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="label">Status</span>
                <span class="value">
                    <span id="statusBadge" class="status-badge status-{{ $templatePurchase->payment_status }}">
                        {{ ucfirst($templatePurchase->payment_status) }}
                    </span>
                </span>
            </div>

            <div id="actionArea" class="action-area">
                @if ($templatePurchase->payment_status == 'paid')
                    <p class="message text-success">Pembayaran Anda telah dikonfirmasi!</p>
                    <a href="{{ route('store.setup.form', ['order_id' => $templatePurchase->transaction_id]) }}"
                        class="btn btn-brand w-100">Lanjutkan Setup Toko</a>
                @elseif ($templatePurchase->payment_status == 'pending')
                    <p class="message text-warning">Kami sedang menunggu konfirmasi pembayaran Anda.</p>
                    <button id="checkStatusBtn" class="btn btn-warning w-100">Cek Ulang Status</button>
                @else
                    <p class="message text-danger">Maaf, pembayaran Anda tidak berhasil.</p>
                    <a href="{{ route('checkout.template', ['slug' => $templatePurchase->catalogTemplate->slug ?? 'default']) }}"
                        class="btn btn-danger w-100">Coba Lagi</a>
                @endif
            </div>
        </div>

        <div class="receipt-footer">
            <p class="mb-0">Halaman ini akan diperbarui secara otomatis.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderId = "{{ $templatePurchase->transaction_id }}";
            let paymentStatus = "{{ $templatePurchase->payment_status }}";
            const checkStatusBtn = document.getElementById('checkStatusBtn');
            const statusTitle = document.getElementById('statusTitle');
            const statusBadge = document.getElementById('statusBadge');
            const actionArea = document.getElementById('actionArea');
            let intervalId = null;

            async function updateStatusOnPage(newStatus) {
                paymentStatus = newStatus;

                // Hentikan pengecekan otomatis jika status tidak lagi 'pending'
                if (paymentStatus !== 'pending' && intervalId) {
                    clearInterval(intervalId);
                }

                // Ubah Teks Judul
                statusTitle.textContent = newStatus === 'paid' ? 'Pembayaran Berhasil' : (newStatus ===
                    'failed' ? 'Pembayaran Gagal' : 'Menunggu Konfirmasi');

                // Ubah Badge Status
                statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                statusBadge.className = `status-badge status-${newStatus}`;

                // Ubah Area Tombol Aksi
                if (newStatus === 'paid') {
                    actionArea.innerHTML = `
                        <p class="message text-success">Pembayaran Anda telah dikonfirmasi!</p>
                        <a href="{{ route('store.setup.form', ['order_id' => $templatePurchase->transaction_id]) }}" class="btn btn-brand w-100">Lanjutkan Setup Toko</a>
                    `;
                } else if (newStatus === 'failed') {
                    actionArea.innerHTML = `
                        <p class="message text-danger">Maaf, pembayaran Anda tidak berhasil.</p>
                        <a href="{{ route('checkout.template', ['slug' => $templatePurchase->catalogTemplate->slug ?? 'default']) }}" class="btn btn-danger w-100">Coba Lagi</a>
                    `;
                }
            }

            async function checkStatus() {
                try {
                    const response = await fetch(`/api/checkout/status-api/${orderId}`);
                    if (!response.ok) return;

                    const data = await response.json();
                    if (data.status === 'success' && data.payment_status !== paymentStatus) {
                        updateStatusOnPage(data.payment_status);
                    }
                } catch (error) {
                    console.error('Gagal memeriksa status:', error);
                }
            }

            if (paymentStatus === 'pending') {
                intervalId = setInterval(checkStatus, 7000); // Check every 7 seconds
            }

            if (checkStatusBtn) {
                checkStatusBtn.addEventListener('click', async function() {
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memeriksa...';
                    await checkStatus();

                    // Kembalikan tombol ke keadaan semula jika status masih 'pending'
                    if (paymentStatus === 'pending') {
                        setTimeout(() => {
                            this.disabled = false;
                            this.textContent = 'Cek Ulang Status';
                        }, 2000);
                    }
                });
            }
        });
    </script>
</body>

</html>
