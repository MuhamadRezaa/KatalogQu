@extends('tenant.admin.layouts.app')

@section('title', $userStore->store_name . ' - Dashboard')

@section('content')
    <div class="row">
        <!-- Welcome Card -->
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

            <!-- Baris Statistik -->
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

            @push('scripts')
                <script>
                    feather.replace();
                </script>
            @endpush


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
@push('scripts')
    <script>
        feather.replace();
    </script>
    <script>
        $(document).ready(function() {
            const storeUrl =
                `${window.location.protocol}//{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}`;
            const storeName = "{{ $userStore->store_name }}";

            // 1. Buat QR Code untuk ditampilkan di halaman (ukuran kecil & simpel)
            jQuery('#qrcode').qrcode({
                width: 512, // Generate at higher resolution for better quality
                height: 512,
                text: storeUrl
            });
            // Apply responsive styling to the generated canvas
            $('#qrcode canvas').css({
                'width': '100%',
                'height': 'auto',
                'max-width': '256px' // Limit max size to keep it compact
            });


            $('#download-qrcode').on('click', function(e) {
                e.preventDefault();

                try {

                    const logo = new Image();
                    logo.src =
                        "{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}";
                    logo.crossOrigin = "anonymous";

                    const logoKatalogqu = new Image();
                    logoKatalogqu.src = "{{ asset('assets/images/katalogqu_logo.png') }}";
                    logoKatalogqu.crossOrigin = "anonymous";

                    logo.onload = function() {
                        logoKatalogqu.onload =
                            function() { // Ensure both logos are loaded before drawing
                                // 2. Tentukan parameter desain untuk template
                                const canvasWidth = 600;
                                const canvasHeight = 900;
                                const qrSize = 380; // --- PERUBAHAN: Ukuran QR disesuaikan
                                const mainColor = '#478413'; // Warna Hijau dari branding
                                const accentColor = '#f99a07'; // Warna Oranye untuk aksen
                                const backgroundColor = '#ffffff';
                                const textColor = '#212529';
                                const lightTextColor = '#6c757d';
                                const cardRadius = 35;

                                // 3. Buat canvas utama untuk template
                                const canvas = document.createElement('canvas');
                                canvas.width = canvasWidth;
                                canvas.height = canvasHeight;
                                const ctx = canvas.getContext('2d');

                                // Helper function untuk menggambar rounded rectangle
                                function drawRoundRect(ctx, x, y, width, height, radius) {
                                    ctx.beginPath();
                                    ctx.moveTo(x + radius, y);
                                    ctx.lineTo(x + width - radius, y);
                                    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
                                    ctx.lineTo(x + width, y + height - radius);
                                    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y +
                                        height);
                                    ctx.lineTo(x + radius, y + height);
                                    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
                                    ctx.lineTo(x, y + radius);
                                    ctx.quadraticCurveTo(x, y, x + radius, y);
                                    ctx.closePath();
                                    ctx.fill();
                                }

                                // 4. Gambar latar belakang dan kartu utama
                                ctx.fillStyle = '#f0f2f5';
                                ctx.fillRect(0, 0, canvasWidth, canvasHeight);
                                ctx.fillStyle = backgroundColor;
                                ctx.shadowColor = 'rgba(0,0,0,0.1)';
                                ctx.shadowBlur = 15;
                                drawRoundRect(ctx, 40, 40, canvasWidth - 80, canvasHeight - 80,
                                    cardRadius);
                                ctx.shadowColor = 'transparent';

                                // 5. Gambar header hijau dengan sudut atas yang membulat
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
                                ctx.quadraticCurveTo(headerX + headerWidth, headerY, headerX +
                                    headerWidth,
                                    headerY + cardRadius);
                                ctx.lineTo(headerX + headerWidth, headerY + headerHeight);
                                ctx.closePath();
                                ctx.fill();

                                // Gambar aksen oranye
                                ctx.fillStyle = accentColor;
                                ctx.fillRect(40, 140, canvasWidth - 80, 5);

                                // 6. Gambar LOGO di header
                                const logoHeight = 70; // Increased size
                                const logoWidth = (logo.width / logo.height) * logoHeight;
                                const logoX = (canvasWidth - logoWidth) / 2;
                                const logoY = 40 + (100 - logoHeight) / 2;
                                ctx.drawImage(logo, logoX, logoY, logoWidth, logoHeight);

                                // 7. Tambahkan teks nama toko dan lainnya
                                ctx.textAlign = 'center';
                                ctx.fillStyle = textColor;
                                ctx.font = 'bold 52px Arial';
                                ctx.fillText(storeName, canvasWidth / 2, 240);

                                ctx.fillStyle = lightTextColor;
                                ctx.font = '30px Arial';
                                ctx.fillText('Scan di Sini', canvasWidth / 2,
                                    295); // --- PERUBAHAN: Menambah jarak

                                // 8. Buat elemen sementara untuk generate QR code
                                let tempContainer = $('<div>').hide().appendTo('body');
                                tempContainer.qrcode({
                                    render: 'canvas',
                                    width: qrSize,
                                    height: qrSize,
                                    text: storeUrl
                                });
                                let qrCanvas = tempContainer.find('canvas')[0];

                                // 9. Gambar QR code ke canvas utama
                                const qrX = (canvasWidth - qrSize) / 2;
                                const qrY = 320; // --- PERUBAHAN: Menambah jarak
                                ctx.drawImage(qrCanvas, qrX, qrY, qrSize, qrSize);

                                // 10. Tambahkan URL dan Footer
                                ctx.fillStyle = lightTextColor;
                                ctx.font = '22px Arial';
                                ctx.fillText(storeUrl.replace(/^https?:\/\//, ''), canvasWidth / 2,
                                    canvasHeight -
                                    160); // --- PERUBAHAN: Menambah jarak

                                // Gambar logo Katalogqu di footer
                                const logoKHeight = 50;
                                const logoKWidth = (logoKatalogqu.width / logoKatalogqu.height) *
                                    logoKHeight;
                                const logoKX = (canvasWidth - logoKWidth) / 2;
                                const logoKY = canvasHeight - 140;
                                ctx.drawImage(logoKatalogqu, logoKX, logoKY, logoKWidth, logoKHeight);

                                ctx.font = 'bold 16px Arial';
                                ctx.fillStyle = textColor;
                                ctx.fillText('Powered by PT. Era Cipta Digital', canvasWidth / 2,
                                    canvasHeight -
                                    70); // --- PERUBAHAN: Menambah jarak

                                // 11. Hapus elemen sementara
                                tempContainer.remove();

                                // 12. Trigger download
                                let link = document.createElement('a');
                                link.href = canvas.toDataURL("image/png");
                                link.download = `QR_Code_${storeName.replace(/\s+/g, '_')}.png`;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            };
                        logoKatalogqu.onerror = function() {
                            alert("Gagal memuat gambar logo 'Powered by'. Pastikan path benar.");
                        };
                    };

                    logo.onerror = function() {
                        alert("Gagal memuat gambar logo utama. Pastikan path benar.");
                    };

                } catch (error) {
                    console.error("Terjadi kesalahan saat mengunduh QR code:", error);
                    alert("Terjadi kesalahan, tidak dapat mengunduh QR code.");
                }
            });

            // Logika untuk tombol Copy Link

            $('#copy-link').on('click', async function() {

                const button = $(this);



                try {

                    await navigator.clipboard.writeText(storeUrl);

                    // Simpan teks asli
                    const originalText = button.html();

                    // Ubah teks tombol menjadi "Copied!"
                    button.html('<i class="fa fa-check me-2"></i> Link Tersimpan!');

                    // Kembalikan ke teks asli setelah beberapa detik
                    setTimeout(() => {
                        button.html(originalText);
                    }, 2000);

                } catch (err) {
                    alert('Gagal menyalin link.');
                }
            });
        });
    </script>
@endpush
