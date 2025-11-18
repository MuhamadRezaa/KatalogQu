<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    <title>{{ $product->name }} - {{ $userStore->store_name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #E6397A;
            --secondary-color: #FFDDE1;
            --rose-gold-color: #B76E79;
            --text-color: #4A4A4A;
            --white-bg: #ffffff;
            --font-primary: 'Playfair Display', serif;
            --font-secondary: 'Inter', sans-serif;
            --accent-pink-light: #FFF0F5;
            /* Background pink lembut seperti di screenshot */
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: var(--font-secondary);
            background-color: var(--accent-pink-light);
            color: var(--text-color);
            padding-top: 50px;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0;
        }

        .navbar-brand .brand-logo {
            height: 45px;
            width: auto;
            border-radius: 8px;
            object-fit: contain;
        }

        .brand-text {
            font-family: var(--font-primary);
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--primary-color);
        }

        /* Product Detail Card */
        .product-detail-card {
            background: var(--white-bg);
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            padding: 2rem;
            margin-bottom: 3rem;
        }

        /* Gambar Utama & Zoom */
        .main-image-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            border: 1px solid #f0f0f0;
            aspect-ratio: 1/1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: zoom-in;
            /* Indikator bisa di-zoom */
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .main-image-container:hover .main-image {
            transform: scale(1.02);
        }

        /* Thumbnails */
        .thumbnail-img {
            width: 100%;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            border: 2px solid transparent;
            opacity: 0.7;
            transition: all 0.2s;
            background: #fff;
        }

        .thumbnail-img:hover,
        .thumbnail-img.active {
            border-color: var(--primary-color);
            opacity: 1;
        }

        /* Product Info */
        .product-title {
            font-family: var(--font-primary);
            font-weight: 700;
            color: #333;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .product-old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 1.1rem;
            margin-left: 10px;
        }

        /* Button */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(230, 57, 122, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #c42a63;
            border-color: #c42a63;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 57, 122, 0.4);
        }

        .btn-wa {
            background-color: rgb(97, 188, 7);
            color: var(--white-bg);
            border-color: rgb(97, 188, 7);
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(230, 57, 122, 0.3);
            transition: all 0.3s ease;
        }

        .btn-wa:hover {
            /* background-color: transparent; */
            border-color: #c42a63;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 57, 122, 0.4);
        }

        /* Produk Serupa (Matching Screenshot) */
        .section-title {
            font-family: var(--font-primary);
            font-weight: 700;
            color: var(--primary-color);
            /* Warna Pink Judul */
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .related-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .related-img-container {
            width: 100%;
            aspect-ratio: 1/1;
            /* Kotak sempurna */
            background-color: #f8f9fa;
            /* Fallback color */
            overflow: hidden;
            position: relative;
        }

        /* Untuk mengakomodasi gambar PNG transparan agar backgroundnya menarik (opsional, sesuai screenshot user biru muda/biru) */
        .related-card:nth-child(odd) .related-img-container {
            background-color: #e0e7ff;
            /* Biru muda selang seling */
        }

        .related-card:nth-child(even) .related-img-container {
            background-color: #dbeafe;
            /* Biru sangat muda */
        }

        /* Override background jika gambar penuh */
        .related-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .related-card:hover .related-img-container img {
            transform: scale(1.05);
        }

        .related-info {
            padding: 1rem;
            text-align: center;
            background: white;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .related-info h6 {
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .related-info .price {
            color: var(--primary-color);
            /* Warna harga merah/pink */
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Footer */
        .main-content {
            flex: 1;
        }

        .footer {
            background-color: var(--rose-gold-color);
            color: #fff;
            background-image: linear-gradient(to right, #B76E79, #d48894);
            padding: 2rem 0;
            margin-top: auto;
            /* Push footer to bottom */
        }

        /* Responsive Tweaks */
        @media (max-width: 768px) {
            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .related-card {
                border-radius: 10px;
            }

            .related-info {
                padding: 0.8rem;
            }

            .related-info h6 {
                font-size: 0.9rem;
            }

            .related-info .price {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('tenant.store.index') }}">
                @if ($userStore->store_logo)
                    <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="Logo" class="brand-logo me-2">
                @endif
                <span class="brand-text">{{ $userStore->store_name }}</span>
            </a>
            <a href="{{ route('tenant.store.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Ke halaman Toko
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="container py-5">

            <div class="product-detail-card">
                <div class="row g-4">
                    <div class="col-lg-5">
                        @php
                            $mainImageSrc =
                                $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png');
                        @endphp

                        <a href="{{ $mainImageSrc }}" class="glightbox" id="mainImageLink"
                            data-gallery="product-gallery">
                            <div class="main-image-container mb-3">
                                <img id="mainImage" src="{{ $mainImageSrc }}" alt="{{ $product->name }}"
                                    class="main-image">
                                <div
                                    style="position: absolute; bottom: 10px; right: 10px; background: rgba(255,255,255,0.8); padding: 5px 8px; border-radius: 5px; font-size: 12px;">
                                    <i class="fas fa-search-plus"></i> Zoom
                                </div>
                            </div>
                        </a>

                        @if ($product->images && $product->images->count() > 0)
                            <div class="row g-2 mb-4">
                                {{-- Thumbnail Gambar Utama --}}
                                <div class="col-3">
                                    <img src="{{ $mainImageSrc }}" class="thumbnail-img active"
                                        onclick="changeImage(this.src, this.src)" alt="Main view">
                                </div>
                                {{-- Thumbnails Gambar Tambahan --}}
                                @foreach ($product->images as $img)
                                    @php
                                        $imgUrl = route('tenant.asset.domain', ['path' => ltrim($img->image_url, '/')]);
                                    @endphp
                                    <div class="col-3">
                                        <a href="{{ $imgUrl }}" class="glightbox d-none"
                                            data-gallery="product-gallery"></a>

                                        <img src="{{ $imgUrl }}" class="thumbnail-img"
                                            onclick="changeImage(this.src, '{{ $imgUrl }}')"
                                            alt="{{ $img->alt }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-7">
                        <div class="ps-lg-4">
                            <div class="mb-2">
                                <span
                                    class="badge bg-secondary">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                @if ($product->brand)
                                    <span class="badge bg-info text-dark ms-1">{{ $product->brand->name }}</span>
                                @endif
                            </div>

                            <h1 class="product-title">{{ $product->name }}</h1>

                            <div class="mb-4 d-flex align-items-baseline">
                                <span class="product-price">{{ $product->price_idr }}</span>
                                @if ($product->old_price_idr)
                                    <span class="product-old-price">{{ $product->old_price_idr }}</span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <h5 class="fw-bold mb-2">Deskripsi</h5>
                                <div class="text-muted small" style="white-space: pre-line;">
                                    {!! $product->description ?? 'Tidak ada deskripsi.' !!}
                                </div>
                            </div>

                            @if ($product->specification && count($product->specification) > 0)
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-2">Spesifikasi</h5>
                                    <table class="table table-sm table-borderless table-responsive">
                                        @foreach ($product->specification as $key => $value)
                                            <tr>
                                                <td class="text-muted pe-3" width="150">{{ $key }}</td>
                                                <td class="fw-medium">{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif

                            <div class="d-grid gap-2 mt-5">
                                @php
                                    $phone = $userStore->whatsapp_number ?? $userStore->store_phone;
                                    $phone = preg_replace('/[^0-9]/', '', $phone);
                                    if (substr($phone, 0, 1) == '0') {
                                        $phone = '62' . substr($phone, 1);
                                    }
                                    $waUrl =
                                        "https://wa.me/{$phone}?text=" .
                                        urlencode(
                                            "Halo, saya tertarik dengan produk *{$product->name}* (" .
                                                url()->current() .
                                                ') yang ada di website Anda.',
                                        );
                                @endphp

                                <button onclick="confirmPurchase('{{ $waUrl }}')" class="btn btn-wa btn-lg">
                                    <i class="fab fa-whatsapp me-2"></i> Hubungi
                                </button>
                            </div>
                            @if (in_array('barcodeproduk', $menus))
                                <div class="text-center mt-3">
                                    <button id="show-barcode-button"
                                        class="btn btn-outline-secondary btn-sm rounded-pill">
                                        <i class="fas fa-barcode me-1"></i> Tampilkan Barcode
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="mt-5 pt-2">
                    <h3 class="section-title">Produk Serupa</h3>
                    <div class="row g-3">
                        @foreach ($relatedProducts as $related)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="related-card">
                                    <a href="{{ route('tenant.store.product', $related->slug ?: $related->id) }}"
                                        class="text-decoration-none">
                                        <div class="related-img-container">
                                            <img src="{{ $related->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png') }}"
                                                alt="{{ $related->name }}">
                                        </div>
                                        <div class="related-info">
                                            <h6 class="text-truncate">{{ $related->name }}</h6>
                                            <div class="price">{{ $related->price_idr }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0 small">&copy; {{ date('Y') }} {{ $userStore->store_name }}. Powered by KatalogQu.</p>
        </div>
    </footer>

    <!-- Barcode Modal -->
    <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalLabel">Barcode Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <svg id="barcode" class="mx-auto" style="width: 100%; max-width: 100%; height: auto;"></svg>
                    <p class="text-muted mt-2 mb-0">SKU: {{ $product->sku ?: 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

    <script>
        // Inisialisasi Lightbox
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            selector: '.glightbox'
        });

        // Fungsi Ganti Gambar Thumbnail
        function changeImage(src, largeSrc) {
            // Ganti source gambar utama
            const mainImg = document.getElementById('mainImage');
            mainImg.style.opacity = 0;
            setTimeout(() => {
                mainImg.src = src;
                mainImg.style.opacity = 1;
            }, 200);

            // Update link lightbox agar saat di-zoom sesuai gambar yang aktif
            const mainLink = document.getElementById('mainImageLink');
            mainLink.href = largeSrc;

            // Reload lightbox instance untuk mengenali perubahan href
            lightbox.reload();

            // Update class active pada thumbnail
            document.querySelectorAll('.thumbnail-img').forEach(img => img.classList.remove('active'));
            event.target.classList.add('active');
        }

        // Fungsi SweetAlert Konfirmasi Beli
        function confirmPurchase(url) {
            Swal.fire({
                title: 'Hubungi Penjual?',
                text: "Anda akan diarahkan ke WhatsApp untuk memesan produk ini.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#E6397A', // Sesuai warna primary tema
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut Chat',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(url, '_blank');
                }
            });
        }

        // --- Barcode Modal Logic ---
        const showBarcodeBtn = document.getElementById('show-barcode-button');
        const barcodeModalEl = document.getElementById('barcodeModal');

        if (showBarcodeBtn && barcodeModalEl) {
            const barcodeModal = new bootstrap.Modal(barcodeModalEl);
            const barcodeValue = '{{ $product->sku ?: $product->id }}';

            showBarcodeBtn.addEventListener('click', () => {
                try {
                    JsBarcode("#barcode", barcodeValue, {
                        format: "CODE128",
                        lineColor: "#4A4A4A", // Match theme text color
                        displayValue: true
                    });
                    barcodeModal.show();
                } catch (e) {
                    console.error("Error generating barcode:", e);
                    document.getElementById('barcode').parentElement.innerHTML =
                        '<p class="text-danger">Error: Gagal membuat barcode.</p>';
                    barcodeModal.show();
                }
            });
        }
    </script>
</body>

</html>
