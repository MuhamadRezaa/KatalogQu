{{--
====================================================================================================
| KONTEN DINAMIS DARI DATABASE                                                                      |
====================================================================================================
| Halaman ini dikelola dari Admin Panel. Termasuk info toko, banner, kategori, dan produk.         |
====================================================================================================
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'Toko Kosmetik' }} - E-Katalog Premium</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- CSS Kustom: Tema Baru (Inspirasi MS Glow) --}}
    <style>
        :root {
            --primary-color: #E6397A;
            /* Vibrant Pink/Magenta Accent */
            --secondary-color: #FFDDE1;
            /* Soft Pink Background */
            --rose-gold-color: #B76E79;
            --text-color: #4A4A4A;
            /* Dark Charcoal for softer text */
            --white-bg: #ffffff;
            --font-primary: 'Playfair Display', serif;
            --font-secondary: 'Inter', sans-serif;
        }

        body {
            font-family: var(--font-secondary);
            /* Gradien lembut untuk latar belakang body */
            background-color: #FFF5F7;
            background-image: linear-gradient(180deg, #FFF5F7 0%, #FFE9EC 100%);
            color: var(--text-color);
        }

        .section-title {
            font-family: var(--font-primary);
            font-weight: 700;
            color: var(--primary-color);
            /* Judul dengan warna aksen */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.05);
        }

        .section-subtitle {
            font-family: var(--font-secondary);
            color: #888;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
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
            font-size: 1.6rem;
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(230, 57, 122, 0.3);
        }

        .btn-primary:hover {
            background-color: #c42a63;
            border-color: #c42a63;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(230, 57, 122, 0.4);
        }

        /* Perbaikan Hero Section - FULL WIDTH */
        .hero-section {
            padding-top: 80px;
            width: 100%;
            margin: 0;
        }

        #heroCarousel,
        .carousel-inner,
        .carousel-item {
            width: 100%;
        }

        .hero-slide {
            position: relative;
            width: 100%;
            height: 60vh;
            /* Tinggi hero section */
            min-height: 550px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Gambar memenuhi area tanpa distorsi */
            z-index: 1;
            animation: zoomIn 15s infinite;
            /* Efek zoom halus */
        }

        .hero-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.2) 50%, rgba(0, 0, 0, 0.6) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            animation: fadeIn 1.5s ease-out;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            /* Shadow pada teks agar terbaca */
        }

        .hero-title {
            font-family: var(--font-primary);
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.2;
            color: #fff;
        }

        .hero-subtitle {
            font-family: var(--font-secondary);
            font-size: 1.3rem;
            color: #eee;
            margin-top: 1rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .carousel-indicators [data-bs-target] {
            background-color: var(--primary-color);
        }

        /* [BARU] Styling untuk Tombol Navigasi Carousel Hero */
        .hero-section .carousel-control-prev,
        .hero-section .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            transition: background-color 0.3s ease, transform 0.3s ease;
            opacity: 0.8;
            z-index: 4;
            /* Pastikan di atas overlay */
        }

        .hero-section .carousel-control-prev {
            left: 2rem;
        }

        .hero-section .carousel-control-next {
            right: 2rem;
        }

        .hero-section .carousel-control-prev:hover,
        .hero-section .carousel-control-next:hover {
            background-color: rgba(255, 255, 255, 0.4);
            opacity: 1;
            transform: translateY(-50%) scale(1.05);
        }

        .hero-section .carousel-control-prev-icon,
        .hero-section .carousel-control-next-icon {
            width: 25px;
            height: 25px;
        }

        /*
         ================================================================================
         [PERUBAHAN] PENYESUAIAN SMARTPHONE
         ================================================================================
        */
        @media (max-width: 768px) {
            /* [PENYESUAIAN MOBILE] Navbar */
            .navbar-brand .brand-logo {
                height: 40px;
            }

            .brand-text {
                font-size: 1.4rem;
            }

            /* [PENYESUAIAN MOBILE] Hero */
            .hero-slide {
                min-height: 480px;
                /* Mengurangi tinggi minimal dari 550px */
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            /* [PENYESUAIAN MOBILE] Kontrol Carousel Hero */
            .hero-section .carousel-control-prev {
                left: 1rem;
            }

            .hero-section .carousel-control-next {
                right: 1rem;
            }

            .hero-section .carousel-control-prev,
            .hero-section .carousel-control-next {
                width: 40px;
                height: 40px;
            }

            /* [PENYESUAIAN MOBILE] Judul Section */
            .section-title {
                font-size: 1.8rem;
            }

            /* [PENYESUAIAN MOBILE] Kartu Produk */
            .product-image-container {
                height: 200px;
                /* Mengurangi tinggi gambar */
            }

            .product-title {
                font-size: 1rem;
                /* Menyesuaikan ukuran font judul produk */
            }

            .current-price {
                font-size: 1.15rem;
            }

            /* [PENYESUAIAN MOBILE] Footer */
            .footer-brand {
                text-align: center;
                /* Logo dan teks footer di tengah */
            }
        }
        /* [AKHIR PERUBAHAN] */


        @keyframes zoomIn {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Styling Section */
        .featured-products-section {
            background-color: var(--white-bg);
            /* Latar belakang putih bersih */
        }

        .new-products-section {
            background-color: #FFF5F7;
            /* Warna soft pink */
        }

        /* [BARU] Penyesuaian Swiper agar mirip promo */
        .featured-swiper {
            width: 100%;
            padding-top: 20px;
            padding-bottom: 50px;
        }

        .featured-swiper .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 280px;
        }

        .featured-swiper .swiper-slide-shadow-left,
        .featured-swiper .swiper-slide-shadow-right {
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0));
        }

        .search-filter-section,
        .products-content-section {
            background-color: transparent;
            /* Transparan agar gradien body terlihat */
        }

        .product-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            background: var(--white-bg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.07);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(230, 57, 122, 0.15);
        }

        .product-image-container {
            height: 250px;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.08);
        }

        .product-info {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            text-align: center;
            /* Teks di tengah */
        }

        .product-title {
            font-family: var(--font-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            flex-grow: 1;
        }

        .product-category {
            font-size: 0.8rem;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .current-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* [PERBAIKAN] Menambahkan style untuk harga lama yang dicoret */
        .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9em;
            margin-left: 0.5rem;
        }

        .badge-new,
        .badge-promo {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8em;
            font-weight: 600;
        }

        .badge-new {
            background-color: #28a745;
        }

        .badge-promo {
            background-color: #dc3545;
        }


        .footer {
            background-color: var(--rose-gold-color);
            /* Warna rose gold gelap */
            color: #fff;
            background-image: linear-gradient(to top, #B76E79, #c47c87);
        }

        .footer a {
            color: #fff;
            font-weight: 600;
        }

        .footer-title {
            font-family: var(--font-primary);
            color: #fff;
            margin-bottom: 1rem;
        }

        .footer .border-secondary {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .modal-image-col {
            background-color: var(--secondary-color);
        }

        /* [BARU] Style untuk Brand di Modal */
        #modalProductBrand {
            color: var(--primary-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        /* [PERBAIKAN] Memastikan deskripsi tidak overflow */
        #modalProductDescription {
            overflow-wrap: break-word;
            word-wrap: break-word;
            /* Fallback untuk browser lama */
        }

        /* * [DIHAPUS] Gaya Pagination Modern tidak diperlukan lagi
         * karena kita menggunakan tombol "Lihat Selengkapnya"
        */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if ($userStore->store_logo)
                    <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="Logo" class="brand-logo me-2">
                @else
                    <div class="brand-icon"><i class="fas fa-gem"></i></div>
                @endif
                <span class="brand-text">{{ $userStore->store_name ?? 'Beauty Store' }}</span>
            </a>
        </div>
    </nav>

    {{-- Hero Section Telah Diperbarui --}}
    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            @if (isset($banners) && $banners->count() > 0)
                <div class="carousel-indicators">
                    @foreach ($banners as $index => $banner)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
            <div class="carousel-inner">
                @forelse ($banners as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="hero-slide">
                            <img src="{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                                alt="{{ $banner->title }}" class="hero-background"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=1920&q=80';">
                            <div class="container">
                                <div class="hero-content">
                                    <h1 class="hero-title">{{ $banner->title }}</h1>
                                    <p class="hero-subtitle">{{ $banner->subtitle }}</p>
                                    @if ($banner->link)
                                        <a href="{{ $banner->link }}"
                                            class="btn btn-primary mt-3">{{ $banner->button_text ?? 'Lihat Sekarang' }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="hero-slide">
                            <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=1920&q=80"
                                alt="Cosmetics Collection" class="hero-background">
                            <div class="container">
                                <div class="hero-content">
                                    <h1 class="hero-title">Selamat Datang di {{ $userStore->store_name }}</h1>
                                    <p class="hero-subtitle">Temukan produk kecantikan terbaik untuk Anda.</p>
                                    <a href="#products" class="btn btn-primary mt-3">Lihat Produk</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- [BARU] Tombol Navigasi Ditambahkan di Sini --}}
            @if (isset($banners) && $banners->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </section>

    {{-- Sisa konten (produk, footer, modal) tidak berubah signifikan secara struktur, hanya tampilan visualnya saja melalui CSS di atas --}}
    @if (isset($featuredProducts) && $featuredProducts->count() > 0)
        <section class="featured-products-section py-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title">Produk Unggulan</h2>
                        <p class="section-subtitle">Produk unggulan pilihan terbaik untuk Anda</p>
                    </div>
                </div>
                <div class="swiper-container featured-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($featuredProducts as $product)
                            <div class="swiper-slide h-100 pb-3">
                                <div class="product-card" data-product-id="{{ $product->id }}">
                                    @if ($product->discount_percentage)
                                        <div class="badge-promo">PROMO</div>
                                    @elseif ($product->is_new)
                                        <div class="badge-new">Baru</div>
                                    @endif
                                    <div class="product-image-container"><img
                                            src="{{ $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png') }}"
                                            alt="{{ $product->name }}" class="product-image"></div>
                                    <div class="product-info">
                                        <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}
                                        </p>
                                        <h5 class="product-title">{{ $product->name }}</h5>
                                        <div class="product-price mt-auto">
                                            <span class="current-price">{{ $product->price_idr }}</span>
                                            @if ($product->old_price_idr)
                                                <span class="old-price">{{ $product->old_price_idr }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($newProducts) && $newProducts->count() > 0)
        <section class="new-products-section py-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title">Produk Terbaru</h2>
                        <p class="section-subtitle">Koleksi terbaru dari toko kami</p>
                    </div>
                </div>
                <div class="swiper-container featured-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($newProducts as $product)
                            <div class="swiper-slide h-100 pb-3">
                                <div class="product-card" data-product-id="{{ $product->id }}">
                                    <div class="badge-new">Baru</div>
                                    <div class="product-image-container"><img
                                            src="{{ $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png') }}"
                                            alt="{{ $product->name }}" class="product-image"></div>
                                    <div class="product-info">
                                        <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}
                                        </p>
                                        <h5 class="product-title">{{ $product->name }}</h5>
                                        <div class="product-price mt-auto">
                                            <span class="current-price">{{ $product->price_idr }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <section class="search-filter-section pt-5" id="products">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Semua Produk</h2>
                <p class="section-subtitle">Pilih kategori produk yang sesuai dengan selera Anda</p>
            </div>

            {{--
             ================================================================================
             [PERUBAHAN] PENYESUAIAN GRID FILTER SMARTPHONE
             ================================================================================
             Menambahkan kelas col-6 dan col-12 untuk tata letak 2 kolom di HP
            --}}
            <div class="row align-items-center g-3 mt-3">
                <div class="col-lg-3 col-6"><input type="text" id="searchInput" class="form-control filter-control"
                        placeholder="Cari produk..." value="{{ request('search') }}"></div>
                <div class="col-lg-2 col-md-3 col-6"><select id="categoryFilter" class="form-select filter-control">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select></div>
                <div class="col-lg-2 col-md-3 col-6"><select id="subcategoryFilter" class="form-select filter-control">
                        <option value="">Semua Sub Kategori</option>
                    </select></div>
                <div class="col-lg-2 col-md-3 col-6"><select id="brandFilter" class="form-select filter-control">
                        <option value="">Semua Brand</option>
                    </select></div>
                <div class="col-lg-2 col-md-3 col-6"><select id="priceFilter" class="form-select filter-control">
                        <option value="">Semua Harga</option>
                        @foreach ($priceRanges as $range)
                            <option data-min="{{ $range->min ?? '' }}" data-max="{{ $range->max ?? '' }}"
                                {{ request('price_min') == $range->min && request('price_max') == $range->max ? 'selected' : '' }}>
                                {{ $range->name }}</option>
                        @endforeach
                    </select></div>
                <div class="col-lg-2 col-md-3 col-6"><select id="sortFilter" class="form-select filter-control">
                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru
                        </option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga
                            Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga
                            Tertinggi</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select></div>
                <div class="col-lg-1 col-md-3 col-12"><a href="{{ url()->current() }}#products"
                        class="btn btn-outline-secondary w-100">Reset</a></div>
            </div>
            {{-- [AKHIR PERUBAHAN] --}}
        </div>
    </section>

    <section class="products-content-section pt-4 pb-5">
        <div class="container">
            <div class="row g-4" id="productsGrid">
                @forelse ($products as $product)
                    <div class="col-6 col-md-4 col-lg-4">
                        <div class="product-card" data-product-id="{{ $product->id }}">
                            @if ($product->discount_percentage)
                                <div class="badge-promo">PROMO</div>
                            @elseif ($product->is_new)
                                <div class="badge-new">Baru</div>
                            @endif
                            <div class="product-image-container"><img
                                    src="{{ $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png') }}"
                                    alt="{{ $product->name }}" class="product-image"></div>
                            <div class="product-info">
                                <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <div class="product-price mt-auto">
                                    <span class="current-price">{{ $product->price_idr }}</span>
                                    @if ($product->old_price_idr)
                                        <span class="old-price">{{ $product->old_price_idr }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="fs-4 text-muted">Produk tidak ditemukan.</p>
                        <p>Coba ubah kata kunci atau filter Anda.</p><a href="{{ url()->current() }}#products"
                            class="btn btn-primary mt-3">Reset Filter</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- [PERBARUAN] Tombol "Lihat Selengkapnya" menggantikan pagination --}}
    <div class="my-5 d-flex justify-content-center" id="loadMoreContainer">
        {{-- Pastikan $products adalah objek Paginator --}}
        @if ($products instanceof \Illuminate\Pagination\AbstractPaginator && $products->hasMorePages())
            <button class="btn btn-primary" id="loadMoreBtn"
                data-next-page-url="{{ $products->appends(request()->query())->nextPageUrl() }}">
                Lihat Selengkapnya
            </button>
        @endif
    </div>
    {{-- AKHIR PERBARUAN --}}

    <footer id="contact" class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        @if ($userStore->store_logo)
                            <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                alt="Logo" class="footer-logo mb-3" width="150"
                                style="border-radius:10px; background: white; padding: 10px;">
                        @else<h4 class="text-white">{{ $userStore->store_name }}</h4>
                        @endif
                        <p class="footer-description">{{ $userStore->store_description }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="mb-0 small">&copy; {{ date('Y') }} {{ $userStore->store_name }}. Powered by PT. Era
                        Cipta Digital.</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row m-0">
                        <div class="col-lg-6 modal-image-col">
                            <div id="modalCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" id="modalCarouselInner">
                                    {{-- Images will be loaded here by JS --}}
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 modal-details-col">
                            {{-- [DIUBAH] Penambahan elemen untuk brand --}}
                            <p id="modalProductBrand">BRAND</p>
                            <div class="d-flex align-items-center mb-2">
                                <h3 id="modalProductName" class="mb-0">Nama Produk</h3>
                                <span id="modalProductBadge" class="badge ms-2"></span>
                            </div>
                            <p class="text-muted" id="modalProductCategory">Kategori</p>
                            <div class="d-flex align-items-baseline mb-3">
                                <h4 class="fw-bold me-2" id="modalProductPrice">Rp 0</h4>
                                <h5 class="text-muted text-decoration-line-through" id="modalProductOldPrice">Rp 0
                                </h5>
                            </div>

                            {{-- [PERBAIKAN] Menukar Posisi Spesifikasi dan Deskripsi --}}
                            <h5>Spesifikasi</h5>
                            <div id="modalProductSpecs"></div>
                            <h5>Deskripsi</h5>
                            <p id="modalProductDescription">Deskripsi produk...</p>
                            {{-- Akhir Perbaikan Posisi --}}

                            <div class="d-grid mt-4">
                                <a id="chatButton" href="#" target="_blank" class="btn btn-success btn-lg">
                                    <i class="fab fa-whatsapp me-2"></i> Chat Toko</a>
                            </div>

                            <div id="related-products-section" class="mt-4 pt-4 border-top">
                                <h6 class="mb-3">Anda Mungkin Juga Suka</h6>
                                <div id="related-products-container" class="row g-2">
                                    {{-- Related products will be loaded here by JS --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    @php
        // Menggabungkan semua produk yang ada di halaman untuk Javascript
        $allProducts = ($products->getCollection() ?? collect())
            ->merge($featuredProducts ?? collect())
            ->merge($newProducts ?? collect())
            ->merge($promoProducts ?? collect());

        // Memformat data produk untuk digunakan di Javascript
        $productsForJs = $allProducts
            ->unique('id')
            ->map(function ($product) {
                $images = $product->images
                    ? $product->images
                        ->sortBy('position')
                        ->map(fn($img) => route('tenant.asset.domain', ['path' => ltrim($img->image_url, '/')]))
                        ->values()
                        ->all()
                    : [];
                if ($product->primary_image_src) {
                    array_unshift($images, $product->primary_image_src);
                }
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'brand' => $product->brand->name ?? '',
                    'category_id' => $product->product_category_id,
                    'category' => $product->category->name ?? 'Uncategorized',
                    'subcategory' => $product->subcategory->name ?? '',
                    'price_formatted' => $product->price_idr,
                    'old_price_formatted' => $product->old_price_idr,
                    'description' => $product->description,
                    'specs' => $product->specification,
                    'images' => array_unique($images),
                    'image' => $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png'),
                    'is_new' => $product->is_new,
                    'discount_percentage' => $product->discount_percentage,
                ];
            })
            ->values();

        // [PERBAIKAN TOTAL] Membuat data Kategori -> Subkategori dari variabel Controller
        // Pastikan variabel $categoriesWithSubcategories sudah dikirim dari Controller (Langkah 1)
        $categoriesForFilterJs = collect($categoriesWithSubcategories ?? [])
            ->keyBy('id')
            ->map(function ($category) {
                // Mengambil nama dari relasi subcategories yang sudah di-load
                return $category->subcategories->pluck('name');
            })
            ->filter(function ($subcategories) {
                // Hanya sertakan kategori yang punya sub-kategori
                return $subcategories->isNotEmpty();
            });

    @endphp

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data dari PHP
        const allProductsData = @json($productsForJs);
        // [PERBAIKAN TOTAL] Menggunakan data kategori dan subkategori yang lengkap dari controller
        const categoriesData = @json($categoriesForFilterJs);

        // Inisialisasi Modal dan Variabel
        const productModal = new bootstrap.Modal(document.getElementById('productModal'));
        const storePhoneNumber = "{{ $userStore->store_phone ?? '' }}";

        // Inisialisasi Swiper/Carousel
        if (document.querySelector('.featured-swiper')) {
            new Swiper('.featured-swiper', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                loop: true,
                slidesPerView: 'auto',
                coverflowEffect: {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                },
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3,
                    }
                }
            });
        }

        // Fungsi untuk mengisi detail produk di modal
        function populateModal(product) {
            if (!product) return;
            document.getElementById('modalProductBrand').textContent = product.brand || '';
            document.getElementById('modalProductName').textContent = product.name;
            document.getElementById('modalProductCategory').textContent = product.category + (product
                .subcategory ? ' > ' + product.subcategory : '');
            document.getElementById('modalProductPrice').textContent = product.price_formatted;

            const oldPriceEl = document.getElementById('modalProductOldPrice');
            oldPriceEl.style.display = product.old_price_formatted ? 'inline' : 'none';
            oldPriceEl.textContent = product.old_price_formatted || '';

            document.getElementById('modalProductDescription').innerHTML = product.description ||
                'Tidak ada deskripsi.';

            const badgeEl = document.getElementById('modalProductBadge');
            badgeEl.textContent = '';
            badgeEl.className = 'badge ms-2';

            if (product.discount_percentage) {
                badgeEl.classList.add('bg-danger');
                badgeEl.textContent = 'PROMO';
            } else if (product.is_new) {
                badgeEl.classList.add('bg-success');
                badgeEl.textContent = 'BARU';
            }

            const carouselInner = document.getElementById('modalCarouselInner');
            carouselInner.innerHTML = product.images && product.images.length > 0 ?
                product.images.map((src, i) =>
                    `<div class="carousel-item ${i === 0 ? 'active' : ''}"><img src="${src}" class="d-block w-100" alt="Gambar produk"></div>`
                ).join('') :
                `<div class="carousel-item active"><img src="{{ asset('assets/demo/toko-kosmetik/img/placeholder.png') }}" class="d-block w-100" alt="Placeholder"></div>`;

            new bootstrap.Carousel(document.getElementById('modalCarousel')).to(0);

            const specsContainer = document.getElementById('modalProductSpecs');
            specsContainer.innerHTML = '';
            if (product.specs && Object.keys(product.specs).length > 0) {
                let listHtml = '<ul class="list-unstyled">';
                for (const [key, value] of Object.entries(product.specs)) {
                    listHtml += `<li><strong>${key}:</strong> ${value}</li>`;
                }
                specsContainer.innerHTML = listHtml + '</ul>';
            } else {
                specsContainer.innerHTML = '<p>Tidak ada spesifikasi.</p>';
            }

            const message = `Halo, saya tertarik dengan produk "${product.name}".`;
            document.getElementById('chatButton').href =
                `https://wa.me/${storePhoneNumber}?text=${encodeURIComponent(message)}`;

            // Logika untuk menampilkan produk terkait (related products)
            const relatedContainer = document.getElementById('related-products-container');
            relatedContainer.innerHTML = '';
            const relatedProducts = allProductsData.filter(p => p.category_id === product.category_id && p
                .id !== product.id).slice(0, 3);
            if (relatedProducts.length > 0) {
                document.getElementById('related-products-section').style.display = 'block';
                relatedProducts.forEach(rp => {
                    const col = document.createElement('div');
                    col.className = 'col-4';
                    col.innerHTML = `
                        <div class="related-product-card" data-product-id="${rp.id}" style="cursor:pointer;">
                            <img src="${rp.image}" alt="${rp.name}" class="img-fluid rounded">
                            <div class="small mt-1">${rp.name}</div>
                        </div>
                    `;
                    relatedContainer.appendChild(col);
                });
            } else {
                document.getElementById('related-products-section').style.display = 'none';
            }
        }

        // [PERBARUAN] Menggunakan Event Delegation untuk klik produk
        function handleProductClick(event) {
            // Cari elemen kartu terdekat dari target yang diklik
            const card = event.target.closest('.product-card, .related-product-card');
            if (!card) return; // Klik tidak di dalam kartu yang valid

            event.stopPropagation();
            const productId = parseInt(card.dataset.productId, 10);
            const product = allProductsData.find(p => p.id === productId);

            // PERINGATAN: Jika produk dimuat via AJAX (filter/load more),
            // produk tsb mungkin tidak ada di `allProductsData` jika data tidak di-refresh.
            // Untuk saat ini, kita asumsikan `allProductsData` cukup lengkap untuk produk yang sering dilihat.
            if (product) {
                populateModal(product);
                if (!productModal._isShown) productModal.show();
            } else {
                console.warn(`Data produk untuk ID ${productId} tidak ditemukan di allProductsData.`);
                // Idealnya, lakukan fetch ke server untuk data produk tunggal jika tidak ditemukan
                // fetch(`/api/product/${productId}`).then(...)
            }
        }

        // Pasang listener di parent container. Ini akan menangani kartu yang ada sekarang DAN yang dimuat nanti.
        const productsGrid = document.getElementById('productsGrid');
        if (productsGrid) {
            productsGrid.addEventListener('click', handleProductClick);
        }

        // Pasang juga di swiper (karena mereka di luar #productsGrid)
        document.querySelectorAll('.featured-swiper').forEach(swiper => {
            swiper.addEventListener('click', handleProductClick);
        });

        // Pasang juga di related products di dalam modal
        const relatedContainer = document.getElementById('related-products-container');
        if (relatedContainer) {
            relatedContainer.addEventListener('click', handleProductClick);
        }
        // AKHIR PERBARUAN Event Delegation

        // --- LOGIKA FILTER ---
        const filterControls = document.querySelectorAll('.filter-control');
        let debounceTimer;

        // [PERBAIKAN TOTAL] Fungsi untuk mengisi filter sub-kategori berdasarkan data lengkap dari server
        function updateSubcategoryFilter() {
            const categoryId = document.getElementById('categoryFilter').value;
            const subcategoryFilter = document.getElementById('subcategoryFilter');

            // Simpan nilai sub-kategori yang sedang dipilih (jika ada)
            const currentSubcategoryValue = new URLSearchParams(window.location.search).get('subcategory');

            subcategoryFilter.innerHTML = '<option value="">Semua Sub Kategori</option>'; // Reset
            subcategoryFilter.disabled = false; // Nonaktifkan sementara

            if (categoryId && categoriesData[categoryId] && categoriesData[categoryId].length > 0) {
                const subcategories = categoriesData[categoryId];
                subcategories.forEach(subName => {
                    const option = document.createElement('option');
                    option.value = subName;
                    option.textContent = subName;
                    // Jika nilai sama dengan yang ada di URL, pilih opsi ini
                    if (subName === currentSubcategoryValue) {
                        option.selected = true;
                    }
                    subcategoryFilter.appendChild(option);
                });
                subcategoryFilter.disabled = false; // Aktifkan kembali jika ada isinya
            }
        }

        // Fungsi untuk mengisi filter brand secara dinamis
        function populateBrandFilter() {
            const brandFilter = document.getElementById('brandFilter');
            if (!brandFilter) return; // Pastikan elemen ada

            const brands = [...new Set(allProductsData.map(p => p.brand).filter(b => b))];
            brands.sort();

            const currentBrandValue = new URLSearchParams(window.location.search).get('brand');

            // Kosongkan opsi sebelumnya (kecuali yang pertama)
            brandFilter.innerHTML = '<option value="">Semua Brand</option>';

            brands.forEach(brand => {
                const option = document.createElement('option');
                option.value = brand;
                option.textContent = brand;
                if (brand === currentBrandValue) {
                    option.selected = true;
                }
                brandFilter.appendChild(option);
            });
        }

        // ========================================================================
        // [PERUBAHAN UTAMA] Fungsi applyFilters diubah untuk menggunakan AJAX/Fetch
        // ========================================================================
        function applyFilters() {
            const search = document.getElementById('searchInput').value;
            const category = document.getElementById('categoryFilter').value;
            const subcategory = document.getElementById('subcategoryFilter').value;
            const brand = document.getElementById('brandFilter').value;
            const sort = document.getElementById('sortFilter').value;
            const priceFilter = document.getElementById('priceFilter').options[document.getElementById(
                'priceFilter').selectedIndex];
            const price_min = priceFilter.dataset.min || '';
            const price_max = priceFilter.dataset.max || '';

            const params = new URLSearchParams({
                search,
                category,
                subcategory,
                brand,
                sort,
                price_min,
                price_max
            });

            // Hapus parameter kosong
            for (let [key, value] of params.entries()) {
                if (!value) {
                    params.delete(key);
                }
            }

            const url = window.location.pathname + '?' + params.toString();
            // Ganti URL di browser tanpa me-reload
            window.history.pushState({}, '', url + '#products');

            // Ambil container
            const productsGridContainer = document.getElementById('productsGrid');
            const loadMoreContainer = document.getElementById('loadMoreContainer');

            // Tampilkan status loading di grid
            productsGridContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <span class="spinner-border spinner-border-lg" role="status" aria-hidden="true"></span>
                    <p class="fs-4 mt-3">Mencari produk...</p>
                </div>`;
            // Sembunyikan tombol "load more" saat loading
            if (loadMoreContainer) {
                loadMoreContainer.style.display = 'none';
                loadMoreContainer.innerHTML = ''; // Kosongkan
            }

            // Lakukan fetch
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    // Parse HTML yang diterima
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Ambil grid produk baru dari HTML yang diterima
                    const newProductsGrid = doc.getElementById('productsGrid');
                    if (newProductsGrid && newProductsGrid.innerHTML.trim() !== '') {
                        // GANTI isi grid
                        productsGridContainer.innerHTML = newProductsGrid.innerHTML;
                    } else {
                        // Tampilkan pesan "tidak ditemukan" jika grid kosong
                        productsGridContainer.innerHTML = `
                            <div class="col-12 text-center py-5">
                                <p class="fs-4 text-muted">Produk tidak ditemukan.</p>
                                <p>Coba ubah kata kunci atau filter Anda.</p>
                            </div>`;
                    }

                    // Ambil container "load more" baru
                    const newLoadMoreContainer = doc.getElementById('loadMoreContainer');
                    if (loadMoreContainer && newLoadMoreContainer) {
                        // Ganti isi container. Listener sudah di-handle oleh event delegation.
                        loadMoreContainer.innerHTML = newLoadMoreContainer.innerHTML;
                        // Tampilkan kembali jika ada isinya
                        if (newLoadMoreContainer.innerHTML.trim() !== '') {
                            loadMoreContainer.style.display = 'flex';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error applying filters:', error);
                    productsGridContainer.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <p class="fs-4 text-muted">Gagal memuat produk. Coba lagi.</p>
                        </div>`;
                    if (loadMoreContainer) {
                        loadMoreContainer.style.display = 'none';
                    }
                });
        }
        // ========================================================================
        // [AKHIR PERUBAHAN UTAMA]
        // ========================================================================


        // Event Listeners untuk semua kontrol filter
        const categoryFilter = document.getElementById('categoryFilter');
        if (categoryFilter) {
            categoryFilter.addEventListener('change', (e) => {
                updateSubcategoryFilter();
                // Langsung terapkan filter setelah mengganti kategori
                applyFilters();
            });
        }

        filterControls.forEach(control => {
            // Jangan tambahkan event listener ganda ke categoryFilter dan searchInput
            if (control.id !== 'categoryFilter' && control.id !== 'searchInput') {
                control.addEventListener('change', applyFilters);
            }
        });

        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                // Menunggu 500ms setelah user berhenti mengetik sebelum menerapkan filter
                debounceTimer = setTimeout(applyFilters, 500);
            });

            // Tambahkan listener untuk 'Enter'
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Hentikan submit form (jika ada)
                    clearTimeout(debounceTimer); // Batalkan debounce
                    applyFilters(); // Langsung filter
                }
            });
        }

        // Inisialisasi filter saat halaman dimuat
        updateSubcategoryFilter();
        populateBrandFilter();


        // ========================================================================
        // [PERUBAHAN UTAMA] Logika "Load More" menggunakan Event Delegation
        // ========================================================================
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        const productsGridContainer = document.getElementById('productsGrid');

        if (loadMoreContainer && productsGridContainer) {
            // Pasang listener pada CONTAINER, bukan tombol
            loadMoreContainer.addEventListener('click', function(event) {
                // Cek apakah yang diklik adalah tombol #loadMoreBtn
                if (event.target && event.target.id === 'loadMoreBtn') {
                    const loadMoreBtn = event.target; // Tombol yang diklik
                    const url = loadMoreBtn.dataset.nextPageUrl;
                    if (!url) return;

                    // Tampilkan status loading
                    loadMoreBtn.disabled = true;
                    loadMoreBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memuat...';

                    fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.text();
                        })
                        .then(html => {
                            // Parse HTML yang diterima
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Ambil produk baru dari grid di HTML yang diterima
                            const newProducts = doc.querySelectorAll(
                                '#productsGrid > .col-6, #productsGrid > .col-md-4, #productsGrid > .col-lg-4'
                            );

                            if (newProducts.length > 0) {
                                newProducts.forEach(product => {
                                    // APPEND (tambahkan) produk ke grid yang ada
                                    productsGridContainer.appendChild(product);
                                });
                            }

                            // Cek apakah ada tombol "load more" di halaman berikutnya
                            const newLoadMoreContainerContent = doc.getElementById('loadMoreContainer')?.innerHTML;

                            if (newLoadMoreContainerContent) {
                                // Ganti isi container. Listener akan tetap berfungsi.
                                loadMoreContainer.innerHTML = newLoadMoreContainerContent;
                            } else {
                                // Ini adalah halaman terakhir, kosongkan container
                                loadMoreContainer.innerHTML = '';
                                loadMoreContainer.style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error loading more products:', error);
                            // Kembalikan tombol ke status normal jika terjadi error
                            if(loadMoreBtn) { // Cek jika tombol masih ada
                                loadMoreBtn.disabled = false;
                                loadMoreBtn.innerHTML = 'Gagal Memuat. Coba Lagi.';
                            }
                        });
                }
            });
        }
        // ========================================================================
        // [AKHIR PERUBAHAN UTAMA]
        // ========================================================================

    });
</script>
</body>

</html>
