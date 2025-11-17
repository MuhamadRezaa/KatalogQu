@extends('tenant.admin.layouts.app')

@section('title', $userStore->store_name . ' - Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if ($userStore->store_logo)
                                <img src="{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                    alt="{{ $userStore->store_name }}" class="rounded-circle" width="50" height="50">
                            @else
                                <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="icofont icofont-shop text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <h4 class="text-white mb-0">{{ $userStore->store_name }}</h4>
                            <p class="text-white-50 mb-0">Dashboard Manajemen Toko</p>
                        </div>
                        {{-- New column for the button --}}
                        <div class="col-auto ms-auto">
                            <a href="//{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}" target="_blank"
                                class="btn btn-light bg-light text-white">
                                <i class="fa fa-external-link"></i> Pratinjau Toko
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted">URL Toko</h6>
                            <p class="mb-0">
                                <strong>{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}</strong>
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <small class="text-muted">Setup Toko Selesai Pada:
                                {{ $userStore->setup_completed_at ? $userStore->setup_completed_at->format('M d, Y') : 'N/A' }}</small>
                        </div>
                    </div>

                </div>
            </div>

            @php
                // Dua metrik ini selalu aktif
                $metrics = collect([
                    [
                        'label' => 'Total Produk',
                        'icon' => 'box',
                        'value' => $userStore->products_count ?? $userStore->products->count(),
                        'enabled' => true,
                    ],
                    [
                        'label' => 'Total Kategori',
                        'icon' => 'layers',
                        'value' => $userStore->productcategories_count ?? $userStore->productcategories->count(),
                        'enabled' => true,
                    ],
                    // Opsional
                    [
                        'label' => 'Total Sub Kategori',
                        'icon' => 'git-branch',
                        'value' => $userStore->productsubcategories_count ?? $userStore->productsubcategories->count(),
                        'enabled' => in_array('subkategoriproduk', $menus ?? []),
                    ],
                    [
                        'label' => 'Total Brand',
                        'icon' => 'tag',
                        'value' => $userStore->brands_count ?? $userStore->brands->count(),
                        'enabled' => in_array('brandproduk', $menus ?? []),
                    ],
                ])->where('enabled', true);

                $count = $metrics->count();

                // Mapping: 4→4 kolom, 3→3 kolom, 2→2 kolom (default minimal 2 biar rapi di desktop)
                $lgCols = $count >= 4 ? 4 : ($count == 3 ? 3 : 2);

                // Siapkan URL logo dengan aman, atau null jika tidak ada
                $logoUrlForJs = $userStore->store_logo
                    ? route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo])
                    : null;

                // Siapkan juga URL logo KatalogQu
                $katalogquLogoUrlForJs = asset('assets/images/katalogqu_logo.png');
            @endphp

            <div class="row row-cols-2 row-cols-xl-{{ $lgCols }} g-3 mb-3">
                @foreach ($metrics as $m)
                    <div class="col">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-1">{{ $m['label'] }}</p>
                                    <h4 class="mb-0">{{ $m['value'] }}</h4>
                                </div>
                                <i data-feather="{{ $m['icon'] }}" class="txt-primary"
                                    style="width:48px;height:48px;"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Feather icons script diletakkan di dalam @push('scripts') --}}

        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-center">QR Code Toko</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <h4 class="mb-3">{{ $userStore->store_name }}</h4>
                        <span class="mb-2">Scan Ini</span>
                        <div id="qrcode" class="mb-3"></div>
                        <div
                            class="d-flex justify-content-center align-items-center gap-2 w-100 flex-md-column flex-xxl-row">
                            <button id="copy-link"
                                class="btn btn-primary d-flex align-items-center justify-content-center flex-fill"> <i
                                    class="fa fa-copy me-2"></i> Copy Link
                            </button>
                            <button id="download-qrcode"
                                class="btn btn-primary d-flex align-items-center justify-content-center flex-fill"> <i
                                    class="fa fa-download me-2"></i> Download QR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

@endsection

{{-- Kode JavaScript dipindahkan ke @push('scripts') --}}
@push('scripts')
    {{-- Pastikan library Feather Icons dimuat (biasanya di layout utama) --}}
    {{-- <script src="path/to/feather.min.js"></script> --}}
    <script>
        feather.replace(); // Jalankan Feather Icons
    </script>
    {{-- Pastikan library jQuery dan jQuery QRCode dimuat sebelum script ini --}}
    {{-- <script src="path/to/jquery.min.js"></script> --}}
    {{-- <script src="{{ asset('path/to/jquery.qrcode.min.js') }}"></script> --}}
    {{-- Atau dari CDN jika Anda menggunakan CDN --}}
    {{-- Pastikan path ini benar --}}
    <script>
        $(document).ready(function() {
            const storeUrl =
                `{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}`; // URL tanpa http
            const fullStoreUrl = `${window.location.protocol}//${storeUrl}`; // URL lengkap
            const storeName = "{{ $userStore->store_name }}";

            // 1. Buat QR Code untuk ditampilkan di halaman (ukuran kecil & simpel)
            const qrcodeElement = document.getElementById('qrcode');
            if (qrcodeElement) {
                jQuery(qrcodeElement).qrcode({
                    width: 256, // Ukuran display disesuaikan
                    height: 256,
                    text: fullStoreUrl // Gunakan URL lengkap
                });
                // Apply styling to the generated canvas if needed
                $('#qrcode canvas').css({
                    'width': '100%',
                    'height': 'auto',
                    'max-width': '256px'
                });
            } else {
                console.error("Elemen #qrcode tidak ditemukan.");
            }

            // Variabel URL logo disiapkan dari PHP
            const storeLogoUrl = @json($logoUrlForJs);
            const katalogquLogoUrl = @json($katalogquLogoUrlForJs);

            $('#download-qrcode').on('click', function(e) {
                e.preventDefault();

                try {
                    const logo = new Image();
                    let logoLoaded = false; // Flag logo toko
                    let logoLoadPromise = Promise.resolve(); // Promise untuk logo toko

                    // Cek jika storeLogoUrl ada, baru coba muat
                    if (storeLogoUrl) {
                        logoLoadPromise = new Promise((
                            resolve) => { // Hapus 'reject' jika error dianggap non-fatal
                            logo.src = storeLogoUrl; // Gunakan variabel JS
                            logo.crossOrigin = "anonymous";
                            logo.onload = () => {
                                logoLoaded = true;
                                resolve();
                            };
                            logo.onerror = (err) => {
                                console.error("Gagal memuat logo toko:", err);
                                resolve(); // Tetap resolve agar proses lanjut tanpa logo toko
                            };
                        });
                    } else {
                        console.log("Tidak ada URL logo toko, skip pemuatan logo toko.");
                    }


                    // Promise untuk logo KatalogQu
                    const logoKatalogqu = new Image();
                    let kqLogoLoaded = false;
                    let kqLogoLoadPromise = new Promise((resolve) => { // Hapus 'reject'
                        logoKatalogqu.src = katalogquLogoUrl;
                        logoKatalogqu.crossOrigin = "anonymous";
                        logoKatalogqu.onload = () => {
                            kqLogoLoaded = true;
                            resolve();
                        };
                        logoKatalogqu.onerror = (err) => {
                            console.error("Gagal memuat logo KatalogQu:", err);
                            resolve(); // Tetap resolve agar proses lanjut tanpa logo KQ
                        };
                    });


                    // Tunggu kedua logo (jika ada) selesai dimuat
                    Promise.all([logoLoadPromise, kqLogoLoadPromise]).then(() => {
                        console.log("Semua promise logo selesai. Mulai menggambar canvas...");
                        // Panggil fungsi gambar setelah semua siap
                        drawQrCodeCanvas(
                            logoLoaded ? logo : null,
                            kqLogoLoaded ? logoKatalogqu : null
                        );
                    });

                    // Fungsi utama untuk menggambar canvas QR Code
                    function drawQrCodeCanvas(storeLogoImage, katalogquLogoImage) {
                        console.log("Menggambar canvas. Logo Toko:", storeLogoImage ? "Ada" : "Tidak Ada",
                            "Logo KQ:", katalogquLogoImage ? "Ada" : "Tidak Ada");
                        // ... (parameter desain canvas: canvasWidth, etc. tetap sama) ...
                        const canvasWidth = 600;
                        const canvasHeight = 900;
                        const qrSize = 380;
                        const mainColor = '#478413';
                        const accentColor = '#f99a07';
                        const backgroundColor = '#ffffff';
                        const textColor = '#212529';
                        const lightTextColor = '#6c757d';
                        const cardRadius = 35;

                        const canvas = document.createElement('canvas');
                        canvas.width = canvasWidth;
                        canvas.height = canvasHeight;
                        const ctx = canvas.getContext('2d');

                        // Helper rounded rectangle (tetap sama)
                        function drawRoundRect(ctx, x, y, width, height, radius) {
                            ctx.beginPath();
                            ctx.moveTo(x + radius, y);
                            ctx.lineTo(x + width - radius, y);
                            ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
                            ctx.lineTo(x + width, y + height - radius);
                            ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
                            ctx.lineTo(x + radius, y + height);
                            ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
                            ctx.lineTo(x, y + radius);
                            ctx.quadraticCurveTo(x, y, x + radius, y);
                            ctx.closePath();
                            ctx.fill();
                        }

                        // Gambar latar & kartu (tetap sama)
                        ctx.fillStyle = '#f0f2f5';
                        ctx.fillRect(0, 0, canvasWidth, canvasHeight);
                        ctx.fillStyle = backgroundColor;
                        ctx.shadowColor = 'rgba(0,0,0,0.1)';
                        ctx.shadowBlur = 15;
                        drawRoundRect(ctx, 40, 40, canvasWidth - 80, canvasHeight - 80, cardRadius);
                        ctx.shadowColor = 'transparent';

                        // Gambar header & aksen (tetap sama)
                        const headerX = 40;
                        const headerY = 40;
                        const headerWidth = canvasWidth - 80;
                        const headerHeight = 100;
                        ctx.fillStyle = mainColor;
                        ctx.beginPath();
                        ctx.moveTo(headerX, headerY + headerHeight);
                        ctx.lineTo(headerX, headerY + cardRadius);
                        ctx.quadraticCurveTo(headerX, headerY, headerX + cardRadius, headerY);
                        ctx.lineTo(headerX + headerWidth - cardRadius, headerY);
                        ctx.quadraticCurveTo(headerX + headerWidth, headerY, headerX + headerWidth,
                            headerY + cardRadius);
                        ctx.lineTo(headerX + headerWidth, headerY + headerHeight);
                        ctx.closePath();
                        ctx.fill();
                        ctx.fillStyle = accentColor;
                        ctx.fillRect(40, 140, canvasWidth - 80, 5);

                        // Gambar LOGO TOKO di header (jika ada dan berhasil dimuat)
                        if (storeLogoImage && storeLogoImage.complete && storeLogoImage.naturalWidth !==
                            0) {
                            console.log("Menggambar logo toko...");
                            const logoHeight = 70;
                            const logoRatio = storeLogoImage.width / storeLogoImage.height;
                            const logoWidth = logoHeight * logoRatio;
                            const logoX = (canvasWidth - logoWidth) / 2;
                            const logoY = 40 + (headerHeight - logoHeight) / 2;
                            try {
                                ctx.drawImage(storeLogoImage, logoX, logoY, logoWidth, logoHeight);
                            } catch (drawErr) {
                                console.error("Error saat menggambar logo toko:", drawErr);
                                // Fallback jika drawImage gagal
                                ctx.textAlign = 'center';
                                ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                                ctx.font = 'bold 24px Arial';
                                const initials = storeName.substring(0, 2).toUpperCase();
                                ctx.fillText(initials, canvasWidth / 2, 40 + headerHeight / 2 + 8);
                            }
                        } else {
                            console.log("Logo toko tidak ada atau gagal dimuat, menggambar inisial...");
                            // Fallback jika logo toko tidak ada atau gagal dimuat
                            ctx.textAlign = 'center';
                            ctx.fillStyle = 'rgba(255, 255, 255, 0.8)';
                            ctx.font = 'bold 24px Arial';
                            // Ambil 2 huruf pertama dari nama toko
                            const initials = storeName.substring(0, 2).toUpperCase();
                            ctx.fillText(initials, canvasWidth / 2, 40 + headerHeight / 2 +
                                8); // Sesuaikan posisi vertikal
                        }

                        // Teks nama toko & scan (tetap sama)
                        ctx.textAlign = 'center';
                        ctx.fillStyle = textColor;
                        ctx.font = 'bold 52px Arial';
                        ctx.fillText(storeName, canvasWidth / 2, 240);
                        ctx.fillStyle = lightTextColor;
                        ctx.font = '30px Arial';
                        ctx.fillText('Scan di Sini', canvasWidth / 2, 295);

                        // Generate QR code (tetap sama)
                        let tempContainer = $('<div>').hide().appendTo('body');
                        // Buat QR Code di elemen sementara
                        try {
                            jQuery(tempContainer).qrcode({
                                render: 'canvas',
                                width: qrSize,
                                height: qrSize,
                                text: fullStoreUrl // Pakai URL lengkap
                            });
                        } catch (qrError) {
                            console.error("Error saat generate QR Code:", qrError);
                            alert("Gagal membuat QR code.");
                            tempContainer.remove();
                            return; // Hentikan proses jika QR gagal
                        }

                        let qrCanvas = tempContainer.find('canvas')[0];
                        if (!qrCanvas) {
                            console.error("Canvas QR code tidak ditemukan di elemen temporer.");
                            alert("Gagal mendapatkan gambar QR code.");
                            tempContainer.remove();
                            return;
                        }


                        // Gambar QR code (tetap sama)
                        const qrX = (canvasWidth - qrSize) / 2;
                        const qrY = 320;
                        try {
                            ctx.drawImage(qrCanvas, qrX, qrY, qrSize, qrSize);
                        } catch (drawQrErr) {
                            console.error("Error saat menggambar QR code ke canvas utama:", drawQrErr);
                            alert("Gagal menggambar QR code.");
                            tempContainer.remove();
                            return;
                        }


                        // Teks URL & Footer
                        ctx.fillStyle = lightTextColor;
                        ctx.font = '22px Arial';
                        ctx.fillText(storeUrl, canvasWidth / 2, canvasHeight -
                            160); // Tampilkan URL tanpa http

                        // Gambar logo KatalogQu di footer (jika ada dan berhasil dimuat)
                        if (katalogquLogoImage && katalogquLogoImage.complete && katalogquLogoImage
                            .naturalWidth !== 0) {
                            console.log("Menggambar logo KatalogQu...");
                            const logoKHeight = 50;
                            const logoKRratio = katalogquLogoImage.width / katalogquLogoImage.height;
                            const logoKWidth = logoKHeight * logoKRratio;
                            const logoKX = (canvasWidth - logoKWidth) / 2;
                            const logoKY = canvasHeight - 140;
                            try {
                                ctx.drawImage(katalogquLogoImage, logoKX, logoKY, logoKWidth, logoKHeight);
                            } catch (drawKqErr) {
                                console.error("Error saat menggambar logo KatalogQu:", drawKqErr);
                            }

                        } else {
                            console.log("Logo KatalogQu tidak ada atau gagal dimuat.");
                        }


                        // Teks Powered by (tetap sama)
                        ctx.font = 'bold 16px Arial';
                        ctx.fillStyle = textColor;
                        ctx.fillText('Powered by PT. Era Cipta Digital', canvasWidth / 2, canvasHeight -
                            70);

                        // Hapus elemen sementara & trigger download (tetap sama)
                        tempContainer.remove();
                        let link = document.createElement('a');
                        link.href = canvas.toDataURL("image/png");
                        link.download = `QR_Code_${storeName.replace(/\s+/g, '_')}.png`;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        console.log("Proses download QR code selesai.");
                    } // Akhir fungsi drawQrCodeCanvas

                } catch (error) {
                    console.error("Terjadi kesalahan saat mengunduh QR code:", error);
                    alert("Terjadi kesalahan, tidak dapat mengunduh QR code.");
                }
            });

            // Logika untuk tombol Copy Link
            $('#copy-link').on('click', async function() {
                const button = $(this);
                try {
                    await navigator.clipboard.writeText(fullStoreUrl); // Gunakan URL lengkap
                    const originalText = button.html();
                    button.html('<i class="fa fa-check me-2"></i> Link Tersimpan!');
                    setTimeout(() => {
                        button.html(originalText);
                    }, 2000);
                } catch (err) {
                    console.error('Gagal menyalin link:', err); // Tambahkan log error
                    alert('Gagal menyalin link.');
                }
            });
        });
    </script>
@endpush
