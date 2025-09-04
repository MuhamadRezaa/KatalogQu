<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Struk Pembayaran {{ $purchase->transaction_id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
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
            padding: 0;
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

        .receipt-section {
            margin-bottom: 25px;
        }

        .receipt-section h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #478413;
            margin-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
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

        .total-section .info-row .value {
            font-weight: 600;
            color: #2c5a08;
        }

        .total-section .info-row.grand-total .value {
            font-size: 1.2rem;
            color: #478413;
        }

        .receipt-footer {
            text-align: center;
            padding: 25px;
            background-color: #f8f9fa;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .print-button {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogQu Logo">
            <h4>STRUK PEMBAYARAN</h4>
        </div>

        <div class="receipt-body">
            <div class="receipt-section">
                <div class="info-row">
                    <span class="label">Tanggal</span>
                    <span
                        class="value">{{ $purchase->paid_at ? $purchase->paid_at->format('d/m/Y H:i') : $purchase->created_at->format('d/m/Y H:i') }}
                        WIB</span>
                </div>
                <div class="info-row">
                    <span class="label">Invoice</span>
                    <span class="value">{{ $purchase->transaction_id }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Merchant</span>
                    <span class="value">KatalogQu</span>
                </div>
                <div class="info-row">
                    <span class="label">Pembeli</span>
                    <span class="value">{{ $purchase->user->name }}</span>
                </div>
            </div>

            <div class="receipt-section">
                <h5>DETAIL PEMBELIAN</h5>
                <div class="info-row">
                    <span class="label">{{ $purchase->catalogTemplate->name ?? 'Template Katalog' }}</span>
                    <span class="value">Rp {{ number_format($purchase->amount, 0, ',', '.') }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">
                        {{-- Logika ini akan menampilkan nilai dari database, baik itu "Midtrans" atau "QRIS" --}}
                        {{ $purchase->payment_method ?? 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="receipt-section total-section">
                <h5>TOTAL</h5>
                <div class="info-row">
                    <span class="label">Total Harga</span>
                    <span class="value">Rp {{ number_format($purchase->amount, 0, ',', '.') }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Pajak (11%)</span>
                    @php
                        // Hitung pajak dari selisih total akhir dan harga dasar
                        $tax = $purchase->final_amount - $purchase->amount;
                    @endphp
                    <span class="value">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="info-row grand-total">
                    <span class="label">Total Bayar</span>
                    <span class="value">Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Profil</a>
            </div>
        </div>

        <div class="receipt-footer">
            Terima kasih telah melakukan pembelian di <strong>KatalogQu</strong>.
        </div>
    </div>
</body>

</html>
