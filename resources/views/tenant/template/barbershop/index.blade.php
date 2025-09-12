{{--
====================================================================================================
| KONTEN DINAMIS DARI DATABASE                                                                     |
====================================================================================================
| Halaman ini dikelola dari Admin Panel. Termasuk info toko, banner, kategori, dan produk/layanan.  |
====================================================================================================
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon"
        href="{{ $userStore->store_logo ? route('tenant.asset.domain', ['path' => $userStore->store_logo]) : asset('assets/demo/barbershop/img/klasik.png') }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'Classic Cuts Barbershop' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/barbershop/styles.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- CSS TAMBAHAN UNTUK MODAL SIDE-BY-SIDE & UI LAINNYA --}}
    <style>
        .modal-body {
            display: flex;
            flex-direction: column;
            /* Default untuk mobile: gambar di atas, teks di bawah */
            gap: 1.5rem;
        }

        .modal-image-container,
        .modal-info-container {
            width: 100%;
        }

        @media (min-width: 768px) {

            /* Tampilan untuk tablet dan desktop */
            .modal-body {
                flex-direction: row;
                /* Ubah menjadi layout berdampingan */
                align-items: flex-start;
            }

            .modal-image-container {
                width: 40%;
                /* Lebar untuk gambar */
                flex-shrink: 0;
            }

            .modal-info-container {
                width: 60%;
                /* Lebar untuk info */
            }
        }

        .pagination-container {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 10px 15px;
            background-color: #fff;
            color: #555;
            border-right: 1px solid #ddd;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9em;
        }

        .pagination li:first-child a,
        .pagination li:first-child span {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .pagination li:last-child a,
        .pagination li:last-child span {
            border-right: 0;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .pagination li.active span {
            background-color: #4A90E2;
            color: #fff;
            border-color: #4A90E2;
            cursor: default;
        }

        .pagination li.disabled span {
            color: #aaa;
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .pagination li a:hover {
            background-color: #f0f0f0;
        }

        /* Style untuk Filter Container */
        .filter-container {
            background-color: #13120e;
            /* Warna background diubah di sini */
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(255, 1, 1, 0.08);
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            flex-grow: 1;
            min-width: 200px;
        }

        .filter-dropdown {
            min-width: 180px;
        }

        /* Style untuk old price */
        .service-old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9em;
            margin-top: 4px;
        }

        .service-price+.service-old-price {
            margin-top: -5px;
        }
    </style>
</head>

<body>
    {{-- Bagian Hero (Slider Banner) --}}
    <section id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-background-slider">
            @forelse ($banners as $banner)
                <div class="bg-slide {{ $loop->first ? 'active' : '' }}" data-slide="{{ $loop->index }}">
                    <div class="bg-image"
                        style="background-image: url('{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}')">
                    </div>
                </div>
            @empty
                <div class="bg-slide active" data-slide="0">
                    <div class="bg-image"
                        style="background-image: url('{{ asset('assets/demo/barbershop/img/bgg.jpg') }}')"></div>
                </div>
                <div class="bg-slide" data-slide="1">
                    <div class="bg-image"
                        style="background-image: url('{{ asset('assets/demo/barbershop/img/bgg1.jpg') }}')"></div>
                </div>
                <div class="bg-slide" data-slide="2">
                    <div class="bg-image"
                        style="background-image: url('{{ asset('assets/demo/barbershop/img/bg.jpeg') }}')"></div>
                </div>
            @endforelse
        </div>
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-text">✨ Barbershop Premium</span>
            </div>
            <div class="hero-icon">
                <i class="fas fa-cut"></i>
            </div>
            <h1 class="hero-title">
                <span class="title-main">{{ $userStore->store_name }}</span>
                <span class="title-sub">Professional Style</span>
            </h1>
            <p class="hero-subtitle">
                {{ $userStore->store_description ?? 'Transformasi penampilan Anda dengan sentuhan profesional dan gaya modern yang memukau' }}
            </p>
            <div class="hero-features">
                <div class="feature-item"><i class="fas fa-award"></i><span>Kualitas Premium</span></div>
                <div class="feature-item"><i class="fas fa-clock"></i><span>Layanan Cepat</span></div>
                <div class="feature-item"><i class="fas fa-star"></i><span>Hasil Memuaskan</span></div>
            </div>
        </div>
        <div class="slider-nav">
            <button class="slider-btn prev" aria-label="Slide sebelumnya"><i class="fas fa-chevron-left"></i></button>
            <button class="slider-btn next" aria-label="Slide selanjutnya"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="slider-dots">
            @if ($banners->count() > 0)
                @foreach ($banners as $banner)
                    <button class="dot {{ $loop->first ? 'active' : '' }}" data-slide="{{ $loop->index }}"
                        aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            @else
                <button class="dot active" data-slide="0" aria-label="Slide 1"></button>
                <button class="dot" data-slide="1" aria-label="Slide 2"></button>
                <button class="dot" data-slide="2" aria-label="Slide 3"></button>
            @endif
        </div>
    </section>

    {{-- Layanan & Gaya Rambut Dinamis --}}
    <section id="services-and-styles" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Layanan & Gaya Rambut</h2>
                <p class="section-subtitle">
                    Pilih layanan atau temukan inspirasi gaya rambut yang paling cocok untuk Anda.
                </p>
            </div>

            <div class="category-cards-container">
                {{-- <button class="card-category active" data-filter="all">
                <div class="card-content">
                    <i class="fas fa-tags text-5xl"></i>
                    <h3 class="card-title">Semua Kategori</h3>
                </div>
            </button> --}}

                @if (isset($categories) && $categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <button class="card-category" data-filter="{{ $category->slug ?? $category->id }}">
                            <img src="{{ $category->image
                                ? route('tenant.asset.domain', ['path' => ltrim($category->image, '/')])
                                : asset('assets/images/no-image-icon.png') }}"
                                alt="{{ $category->name }}" class="card-image">
                            <div class="card-content">
                                <h3 class="card-title">{{ $category->name }}</h3>
                            </div>
                        </button>
                    @endforeach
                @else
                    <p class="text-gray-500">Belum ada kategori</p>
                @endif
            </div>

            {{-- Panel Filter Baru --}}
            {{-- <div class="filter-container"> ... </div> --}}

            <div class="view-controls">
                <button id="grid-view-btn" class="active">
                    <i class="fas fa-th-large"></i>
                </button>
                <button id="list-view-btn">
                    <i class="fas fa-list"></i>
                </button>
            </div>

            <style>
                .view-controls {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background: rgba(255, 255, 255, 0.05);
                    border-radius: 10px;
                    padding: 0.5rem;
                    margin: 1rem 0;
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    backdrop-filter: blur(8px);
                }

                .view-controls button {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 40px;
                    height: 36px;
                    background: transparent;
                    color: #ccc;
                    border: none;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: all 0.3s ease;
                    border-radius: 6px;
                    margin: 0 0.3rem;
                }

                .view-controls button:hover {
                    background: rgba(255, 255, 255, 0.1);
                    transform: translateY(-1px);
                }

                .view-controls button.active {
                    background: #f39c12;
                    color: #000;
                    box-shadow: 0 2px 6px rgba(243, 156, 18, 0.3);
                }
            </style>

            {{-- Grid Produk/Layanan --}}
            <div class="services-grid" id="product-grid">
                {{-- Konten diisi oleh JavaScript --}}
            </div>

            {{-- Pesan tidak ada hasil --}}
            <div id="no-results-message" style="display: none; text-align: center; color: #666; margin: 40px 0;">
                Tidak ada layanan yang ditemukan dengan filter tersebut.
            </div>

            {{-- Pagination akan disembunyikan saat filter client-side aktif --}}
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </div>

        <style>
            /* Global Box Sizing */
            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            /* ------------------------------ */
            /* Overlay & Background Section */
            /* ------------------------------ */
            #services-and-styles {
                position: relative;
                background-image: url('{{ asset('assets/images/barbershop-bg.jpg') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                padding: 60px 0;
                overflow: hidden;
            }

            #services-and-styles::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(40, 20, 10, 0.9) 100%);
                z-index: 1;
            }

            #services-and-styles .container,
            #services-and-styles .section-header {
                position: relative;
                z-index: 2;
            }

            /* ------------------------------ */
            /* Header Section */
            /* ------------------------------ */
            .section-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .section-title {
                font-size: 2.5rem;
                font-weight: 800;
                color: #f39c12;
                letter-spacing: 1px;
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                position: relative;
                display: inline-block;
            }

            .section-title::after {
                content: '';
                display: block;
                width: 70px;
                height: 3px;
                background: #f39c12;
                margin: 8px auto 0;
                border-radius: 2px;
            }

            .section-subtitle {
                font-size: 1.1rem;
                color: #e0e0e0;
                max-width: 650px;
                margin: 1.2rem auto 0;
                line-height: 1.6;
                font-weight: 300;
            }

            /* ------------------------------ */
            /* Kartu Kategori */
            /* ------------------------------ */
            .category-cards-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1.2rem;
                justify-content: center;
                padding: 1.5rem 0;
                margin-bottom: 2.5rem;
            }

            .card-category {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                cursor: pointer;
                border: 2px solid transparent;
                border-radius: 16px;
                padding: 1.2rem 0.8rem;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(8px);
                color: #fff;
                transition: all 0.3s ease;
                width: 140px;
                min-height: 180px;
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
                position: relative;
                overflow: hidden;
            }

            .card-category:hover {
                transform: translateY(-6px);
                border-color: #f39c12;
                box-shadow: 0 10px 25px rgba(243, 156, 18, 0.3);
            }

            .card-category.active {
                border-color: #f39c12;
                background: rgba(243, 156, 18, 0.1);
                transform: translateY(-3px);
            }

            .card-image {
                width: 100%;
                max-width: 110px;
                height: 90px;
                object-fit: cover;
                border-radius: 10px;
                margin-bottom: 0.8rem;
                border: 2px solid rgba(255, 255, 255, 0.1);
                transition: transform 0.3s ease;
            }

            .card-category:hover .card-image {
                transform: scale(1.05);
            }

            .card-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100%;
                z-index: 1;
            }

            .card-title {
                margin: 0;
                font-size: 1rem;
                font-weight: 700;
                color: #fff;
                transition: color 0.3s ease;
            }

            .card-category:hover .card-title {
                color: #f39c12;
            }

            /* ------------------------------ */
            /* Grid Produk (Diperbaiki untuk Mobile) */
            /* ------------------------------ */
            #product-grid {
                display: grid;
                gap: 1.5rem;
                margin-top: 2rem;
                justify-items: center;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                padding: 0 1rem;
            }

            .card-product {
                width: 100%;
                max-width: 280px;
                /* Dikurangi dari 320px */
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(8px);
                border-radius: 16px;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
                overflow: hidden;
                transition: all 0.3s ease;
                text-align: center;
                color: #f0f0f0;
                position: relative;
                border: 1px solid rgba(255, 255, 255, 0.1);
                margin: 0 auto;
                /* Pusatkan di mobile */
            }

            .card-product:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 30px rgba(243, 156, 18, 0.3);
                border-color: rgba(243, 156, 18, 0.4);
            }

            .card-product img {
                width: 100%;
                height: 160px;
                /* Dikurangi dari 200px */
                object-fit: cover;
                border-bottom: 2px solid rgba(243, 156, 18, 0.3);
            }

            .card-product .card-body {
                padding: 1.2rem;
            }

            .card-product .card-title {
                font-size: 1.2rem;
                font-weight: 700;
                color: #f39c12;
                margin-bottom: 0.5rem;
            }

            .card-product .card-text {
                font-size: 0.9rem;
                color: #ccc;
                margin-bottom: 1rem;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-product .price {
                font-size: 1.3rem;
                font-weight: 800;
                color: #fff;
                margin-bottom: 1rem;
            }

            .card-produc

            /* Global Box Sizing */
            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            /* ------------------------------ */
            /* Overlay & Background Section */
            /* ------------------------------ */
            #services-and-styles {
                position: relative;
                background-image: url('{{ asset('assets/images/barbershop-bg.jpg') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                padding: 60px 0;
                overflow: hidden;
            }

            #services-and-styles::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(40, 20, 10, 0.9) 100%);
                z-index: 1;
            }

            #services-and-styles .container,
            #services-and-styles .section-header {
                position: relative;
                z-index: 2;
            }

            /* ------------------------------ */
            /* Header Section */
            /* ------------------------------ */
            .section-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .section-title {
                font-size: 2.5rem;
                font-weight: 800;
                color: #f39c12;
                letter-spacing: 1px;
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                position: relative;
                display: inline-block;
            }

            .section-title::after {
                content: '';
                display: block;
                width: 70px;
                height: 3px;
                background: #f39c12;
                margin: 8px auto 0;
                border-radius: 2px;
            }

            .section-subtitle {
                font-size: 1.1rem;
                color: #e0e0e0;
                max-width: 650px;
                margin: 1.2rem auto 0;
                line-height: 1.6;
                font-weight: 300;
            }

            /* ------------------------------ */
            /* Kartu Kategori */
            /* ------------------------------ */
            .category-cards-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1.2rem;
                justify-content: center;
                padding: 1.5rem 0;
                margin-bottom: 2.5rem;
            }

            .card-category {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                cursor: pointer;
                border: 2px solid transparent;
                border-radius: 16px;
                padding: 1.2rem 0.8rem;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(8px);
                color: #fff;
                transition: all 0.3s ease;
                width: 140px;
                min-height: 180px;
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
                position: relative;
                overflow: hidden;
            }

            .card-category:hover {
                transform: translateY(-6px);
                border-color: #f39c12;
                box-shadow: 0 10px 25px rgba(243, 156, 18, 0.3);
            }

            .card-category.active {
                border-color: #f39c12;
                background: rgba(243, 156, 18, 0.1);
                transform: translateY(-3px);
            }

            .card-image {
                width: 100%;
                max-width: 110px;
                height: 90px;
                object-fit: cover;
                border-radius: 10px;
                margin-bottom: 0.8rem;
                border: 2px solid rgba(255, 255, 255, 0.1);
                transition: transform 0.3s ease;
            }

            .card-category:hover .card-image {
                transform: scale(1.05);
            }

            .card-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100%;
                z-index: 1;
            }

            .card-title {
                margin: 0;
                font-size: 1rem;
                font-weight: 700;
                color: #fff;
                transition: color 0.3s ease;
            }

            .card-category:hover .card-title {
                color: #f39c12;
            }

            /* ------------------------------ */
            /* Grid Produk (Diperbaiki)     */
            /* ------------------------------ */
            #product-grid {
                display: grid;
                gap: 1rem;
                /* Mengurangi jarak antar kartu */
                margin-top: 2rem;
                justify-items: center;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                padding: 0 0.5rem;
                /* Mengurangi padding horizontal */
            }

            .card-product {
                width: 100%;
                max-width: 280px;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(8px);
                border-radius: 16px;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
                overflow: hidden;
                transition: all 0.3s ease;
                text-align: center;
                color: #f0f0f0;
                position: relative;
                border: 1px solid rgba(255, 255, 255, 0.1);
                margin: 0 auto;
            }

            .card-product:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 30px rgba(243, 156, 18, 0.3);
                border-color: rgba(243, 156, 18, 0.4);
            }

            .card-product img {
                width: 100%;
                height: 160px;
                object-fit: cover;
                border-bottom: 2px solid rgba(243, 156, 18, 0.3);
            }

            .card-product .card-body {
                padding: 1.2rem;
            }

            .card-product .card-title {
                font-size: 1.2rem;
                font-weight: 700;
                color: #f39c12;
                margin-bottom: 0.5rem;
            }

            .card-product .card-text {
                font-size: 0.9rem;
                color: #ccc;
                margin-bottom: 1rem;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-product .price {
                font-size: 1.3rem;
                font-weight: 800;
                color: #fff;
                margin-bottom: 1rem;
            }

            .card-product .btn {
                display: inline-block;
                padding: 0.5rem 1.2rem;
                background: #f39c12;
                color: #000;
                font-weight: 700;
                border-radius: 50px;
                text-decoration: none;
                transition: all 0.3s ease;
                font-size: 0.95rem;
                width: 100%;
            }

            .card-product .btn:hover {
                background: #e67e22;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(243, 156, 18, 0.4);
            }

            /* ------------------------------ */
            /* Responsif Khusus Mobile Kecil */
            /* ------------------------------ */
            @media (max-width: 480px) {
                .section-title {
                    font-size: 2rem;
                }

                .section-subtitle {
                    font-size: 1rem;
                    padding: 0 1rem;
                }

                .category-cards-container {
                    gap: 0.8rem;
                    padding: 1rem 0;
                }

                .card-category {
                    width: 120px;
                    min-height: 160px;
                    padding: 1rem 0.6rem;
                }

                .card-image {
                    height: 80px;
                }

                #product-grid {
                    grid-template-columns: 1fr;
                    gap: 1.2rem;
                    padding: 0 0.8rem;
                }

                .card-product {
                    max-width: 95%;
                    margin: 0 auto;
                }

                .card-product img {
                    height: 140px;
                }

                .card-product .card-body {
                    padding: 1rem;
                }

                .card-product .card-title {
                    font-size: 1.1rem;
                }

                .card-product .price {
                    font-size: 1.2rem;
                }
            }

            /* ------------------------------ */
            /* Tablet */
            /* ------------------------------ */
            @media (min-width: 481px) and (max-width: 768px) {
                #product-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            /* ------------------------------ */
            /* Desktop */
            /* ------------------------------ */
            @media (min-width: 769px) {
                #product-grid {
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                }
            }

            /* ------------------------------ */
            /* Pesan Tidak Ada Hasil & Pagination */
            /* ------------------------------ */
            #no-results-message {
                display: none;
                text-align: center;
                color: #aaa;
                margin: 3rem 0;
                font-size: 1.1rem;
                font-style: italic;
                padding: 1.5rem;
                background: rgba(0, 0, 0, 0.2);
                border-radius: 12px;
                border: 1px dashed #555;
            }

            .pagination-container {
                margin-top: 2.5rem;
                text-align: center;
            }

            .pagination-container .pagination {
                display: inline-flex;
                gap: 0.4rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .pagination-container .page-item .page-link {
                color: #f39c12;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(243, 156, 18, 0.3);
                padding: 0.4rem 0.8rem;
                border-radius: 6px;
                transition: all 0.3s ease;
                font-size: 0.85rem;
            }

            .pagination-container .page-item.active .page-link {
                background: #f39c12;
                color: #000;
                font-weight: 700;
            }

            .pagination-container .page-link:hover {
                background: rgba(243, 156, 18, 0.2);
                transform: translateY(-1px);
            }

            /* --------------------------------- */
            /* GAYA BARU: TAMPILAN LIST        */
            /* --------------------------------- */
            #product-grid.product-list {
                display: flex;
                flex-direction: column;
                gap: 1.2rem;
                /* Mengurangi jarak vertikal antar item */
                padding: 0 1rem;
            }

            #product-grid.product-list .card-product {
                display: flex;
                flex-direction: row;
                width: 100%;
                max-width: 700px;
                /* Mengurangi lebar maksimum kartu */
                margin: 0 auto;
                text-align: left;
                height: auto;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(8px);
                border-radius: 16px;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            #product-grid.product-list .card-product:hover {
                transform: translateY(-4px);
                /* Mengurangi efek hover agar tidak terlalu jauh */
                box-shadow: 0 8px 20px rgba(243, 156, 18, 0.3);
                border-color: rgba(243, 156, 18, 0.4);
            }

            #product-grid.product-list .card-product .card-image-container {
                width: 120px;
                /* Lebar gambar yang lebih ringkas */
                min-width: 120px;
                height: auto;
                flex-shrink: 0;
                position: relative;
                border-radius: 16px 0 0 16px;
                /* Sudut membulat di kiri */
                overflow: hidden;
            }

            #product-grid.product-list .card-product .card-image-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-bottom: none;
                border-right: 2px solid rgba(243, 156, 18, 0.3);
            }

            #product-grid.product-list .card-product .card-body {
                padding: 1.2rem 1.5rem;
                /* Sesuaikan padding agar lebih proporsional */
                display: flex;
                flex-direction: column;
                justify-content: center;
                flex-grow: 1;
                gap: 0.4rem;
                /* Mengurangi jarak antar elemen di dalam konten kartu */
            }

            #product-grid.product-list .card-product .card-text {
                font-size: 0.9rem;
                color: #ccc;
                line-height: 1.4;
                -webkit-line-clamp: 2;
                /* Membatasi deskripsi menjadi 2 baris */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            #product-grid.product-list .card-product .card-title {
                font-size: 1.2rem;
                font-weight: 700;
                margin-top: 0;
                margin-bottom: 0.2rem;
                color: #f39c12;
            }

            #product-grid.product-list .card-product .price {
                font-size: 1.2rem;
                font-weight: 800;
                color: #fff;
                margin: 0;
            }

            /* Responsif untuk tampilan list */
            @media (max-width: 768px) {
                #product-grid.product-list .card-product {
                    flex-direction: column;
                    max-width: 320px;
                    border-radius: 16px;
                }

                #product-grid.product-list .card-product .card-image-container {
                    width: 100%;
                    height: 150px;
                    min-width: unset;
                    border-radius: 16px 16px 0 0;
                    border-right: none;
                    border-bottom: 2px solid rgba(243, 156, 18, 0.3);
                }

                #product-grid.product-list .card-product .card-body {
                    padding: 1rem;
                    text-align: center;
                    align-items: center;
                }
            }
        </style>
    </section>

    <style>
        /* Gaya untuk section utama */
        #services-and-styles {
            position: relative;
            /* Penting untuk penempatan overlay */
            background-image: url('{{ asset('assets/images/barbershop-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* Memberikan efek parallax */
            color: #f0f0f0;
            /* Mengubah warna teks agar terlihat jelas di atas background gelap */
            padding: 60px 0;
            /* Menambah ruang di atas dan bawah section */
        }

        /* Membuat overlay gelap untuk membuat teks lebih menonjol */
        #services-and-styles::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Warna overlay hitam dengan transparansi 70% */
        }

        /* Memastikan konten di dalam section berada di atas overlay */
        #services-and-styles .container,
        #services-and-styles .section-header {
            position: relative;
            z-index: 2;
            /* Meletakkan konten di atas pseudo-element ::before */
        }

        /* Memperbaiki gaya teks di atas background gelap */
        .section-header h2.section-title,
        .section-header p.section-subtitle {
            color: #ffffff;
            /* Pastikan judul dan subtitle berwarna putih */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            /* Menambahkan bayangan teks agar lebih mudah dibaca */
        }
    </style>

    <style>
        /* ... kode CSS yang sudah ada ... */

        /* Tambahkan gaya ini untuk memberi jarak di bawah section Hero */
        .hero {
            margin-bottom: 3rem;
            /* Memberikan ruang kosong di bawah elemen Hero */
        }

        /* Atau, jika mau, tambahkan ruang di atas section Services */
        .services {
            margin-top: 3rem;
            margin-bottom: 3rem;
            /* Memberikan ruang kosong di atas elemen Services */
        }

        /* ... kode CSS yang sudah ada ... */
    </style>

    {{-- Our Service (Dynamic from Database) --}}



    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="hero-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h1>{{ $userStore->store_name ?? 'Classic Cuts Barbershop' }}</h1>
                </div>
                <div class="footer-contact">
                    <h3 class="footer-title">Kontak Kami</h3>
                    <ul class="footer-list">
                        <li><i class="fas fa-map-marker-alt"></i>
                            {{ $userStore->store_address ?? 'Alamat lengkap belum diatur.' }}</li>
                        <li><i class="fas fa-phone"></i>
                            {{ $userStore->store_phone ?? 'Nomor telepon belum diatur.' }}</li>
                        <li><i class="fas fa-envelope"></i> {{ $userStore->store_email ?? 'Email belum diatur.' }}
                        </li>
                        <li><i class="fas fa-clock"></i> {{ $userStore->operating_hours ?? 'Sen-Sab: 09:00 - 21:00' }}
                        </li>
                    </ul>
                    <div class="footer-social" style="margin-top: 15px">
                        @if ($userStore->instagram_url ?? null)
                            <a href="{{ $userStore->instagram_url }}" class="social-link" aria-label="Instagram"
                                target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if ($userStore->facebook_url ?? null)
                            <a href="{{ $userStore->facebook_url }}" class="social-link" aria-label="Facebook"
                                target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $userStore->store_name ?? 'Classic Cuts Barbershop' }}. Diberdayakan
                    oleh KatalogQu</p>
            </div>
        </div>
    </footer>

    <style>
        .footer {
            background-color: #1a1a1a;
            color: #e0e0e0;
            padding: 4rem 0 2rem;
            font-family: 'Poppins', sans-serif;
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-brand {
            flex: 1 1 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        @media (min-width: 768px) {
            .footer-brand {
                align-items: flex-start;
                text-align: left;
            }
        }

        .hero-icon {
            font-size: 3.5rem;
            color: #f39c12;
            margin-bottom: 0.5rem;
            animation: bounce 2s infinite ease-in-out;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .footer-brand h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .footer-contact {
            flex: 1 1 300px;
            text-align: right;
            /* Ini akan membuat semua konten di dalam footer-contact rata kanan */
        }

        @media (min-width: 768px) {
            .footer-contact {
                text-align: right;
            }
        }

        .footer-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f39c12;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #f39c12;
            margin-left: auto;
            /* Ini yang membuat garis rata kanan */
            margin-right: 0;
            margin-top: 10px;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 1rem;
            line-height: 2.2;
        }

        .footer-list li {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            /* Ini yang membuat item list rata kanan */
            gap: 12px;
        }

        .footer-list i {
            color: #f39c12;
            font-size: 1.1rem;
        }

        .footer-social {
            margin-top: 2rem;
            display: flex;
            gap: 1.5rem;
            justify-content: flex-end;
            /* Ini yang membuat ikon sosial rata kanan */
        }

        .social-link {
            width: 40px;
            height: 40px;
            background-color: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .social-link:hover {
            background-color: #f39c12;
            color: #1a1a1a;
            transform: translateY(-5px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #999;
        }
    </style>

    {{-- Modal Detail --}}
    <div id="product-modal" class="modal" style="display: none;">
        <div class="modal-content large">
            <button class="modal-close" id="modal-close">×</button>
            <div class="modal-body">
                <!-- Gambar -->
                <div class="modal-image-container">
                    <img id="modal-main-image" src="" alt="Detail Gambar" />
                    <div id="modal-thumbnail-container" class="thumbnail-container">
                        <!-- Thumbnail akan diisi oleh JS -->
                    </div>
                </div>

                <!-- Informasi Produk -->
                <div class="modal-info-container">
                    <h2 id="modal-title" class="modal-title"></h2>
                    <p id="modal-category" class="modal-category"></p>
                    <p id="modal-price" class="modal-price"></p>
                    <p id="modal-old-price" class="modal-old-price"></p>

                    <h3 class="modal-subtitle">Deskripsi</h3>
                    <p id="modal-description" class="modal-description"></p>

                    <h3 class="modal-subtitle">Spesifikasi / Detail</h3>
                    <ul id="modal-specs" class="modal-specs"></ul>
                </div>
            </div>
        </div>
    </div>

    {{-- css detail --}}
    <style>
        /* --------------------------------- */
        /* MODAL STYLING           */
        /* --------------------------------- */

        /* Kontainer Modal Utama */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Kotak Konten Modal */
        .modal-content.large {
            background-color: #2c2b29;
            border-radius: 15px;
            padding: 2.5rem;
            position: relative;
            max-width: 900px;
            /* Batasan lebar modal untuk tampilan desktop */
            width: 90%;
            /* Menggunakan persentase agar responsif */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            color: #f0f0f0;
            display: flex;
            /* Menggunakan Flexbox untuk tata letak */
            flex-direction: column;
            /* Default: susun konten ke bawah */
            gap: 2rem;
        }

        /* Pengaturan Responsif untuk Modal */
        @media (min-width: 768px) {
            .modal-content.large {
                flex-direction: row;
                /* Ubah ke tata letak baris di layar yang lebih lebar */
                text-align: left;
            }
        }

        /* Tombol Tutup Modal */
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: #999;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .modal-close:hover {
            color: #f39c12;
        }

        /* Bagian Gambar Modal */
        .modal-image-container {
            flex: 1;
            /* Mengambil sisa ruang yang tersedia */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #modal-main-image {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            object-fit: cover;
            max-height: 400px;
            /* Batasi tinggi gambar utama */
        }

        /* Bagian Informasi Modal */
        .modal-info-container {
            flex: 1;
            /* Mengambil sisa ruang yang tersedia */
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .modal-title {
            font-size: 2rem;
            font-weight: 700;
            color: #f39c12;
            margin-bottom: 0.5rem;
        }

        .modal-category {
            background-color: #444;
            color: #ccc;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .modal-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .modal-old-price {
            color: #999;
            text-decoration: line-through;
        }

        .modal-subtitle {
            font-size: 1.25rem;
            font-weight: 600;
            color: #f39c12;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.25rem;
        }

        .modal-description {
            font-size: 1rem;
            color: #ccc;
            line-height: 1.6;
        }

        .modal-specs {
            list-style: none;
            padding: 0;
            margin: 0;
            color: #ccc;
            line-height: 1.6;
        }

        .modal-specs li::before {
            content: "•";
            color: #f39c12;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        .modal-chat-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 1.5rem;
            padding: 0.75rem 1.5rem;
            background-color: #25d366;
            /* Warna WhatsApp */
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
            gap: 0.5rem;
        }

        .modal-chat-button i {
            font-size: 1.25rem;
        }

        .modal-chat-button:hover {
            background-color: #128c7e;
            transform: translateY(-2px);
        }
    </style>

    <template id="thumbnail-template">
        <button class="thumbnail"><img class="thumbnail-image" src="" alt="thumbnail" /></button>
    </template>

    <script>
        // ===================================================================================
        // SCRIPT UTAMA
        // ===================================================================================

        // 1. PERSIAPAN DATA PRODUK DARI PHP KE JAVASCRIPT
        // =================================================
        @php
            use Illuminate\Pagination\AbstractPaginator;
            $rawProducts = $products instanceof AbstractPaginator ? $products->getCollection() : collect($products ?? []);

            $productsForJs = $rawProducts
                ->map(function ($product) {
                    $imagesCollection = $product->images ?? ($product->productimgs ?? collect());
                    $allImages = $imagesCollection->sortBy('position')->map(fn($img) => route('tenant.asset.domain', ['path' => ltrim($img->image_url ?? ($img->image_path ?? ''), '/')]))->values()->all();

                    $primaryImage = null;
                    if ($product->primary_image_src) {
                        $primaryImage = $product->primary_image_src;
                    } elseif ($product->image) {
                        $primaryImage = route('tenant.asset.domain', ['path' => ltrim($product->image, '/')]);
                    }

                    if ($primaryImage && !in_array($primaryImage, $allImages)) {
                        array_unshift($allImages, $primaryImage);
                    }

                    if (empty($allImages)) {
                        $allImages[] = asset('assets/demo/barbershop/img/klasik.png');
                    }

                    $category = $product->category ?? null;
                    $specs = $product->specification ?? ($product->specs ?? []);
                    if (is_string($specs)) {
                        $specs = json_decode($specs, true) ?? [];
                    }

                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug ?? null,
                        'price' => $product->price ?? 0,
                        'old_price' => $product->old_price ?? null,
                        'description' => $product->description ?? 'Layanan berkualitas tinggi untuk penampilan terbaik Anda.',
                        'category_slug' => $category->slug ?? ($category->id ?? 'uncategorized'),
                        'category_name' => $category->name ?? 'Uncategorized',
                        'images' => $allImages,
                        'specs' => (object) $specs,
                    ];
                })
                ->values();
        @endphp
        window.productsData = @json($productsForJs);

        // 2. LOGIKA UNTUK MODAL DETAIL, FILTER, DAN LAINNYA
        // =================================================
        document.addEventListener('DOMContentLoaded', function() {
            const productGrid = document.getElementById('product-grid');
            const modal = document.getElementById('product-modal');
            if (!modal) return;

            const modalClose = document.getElementById('modal-close');
            const mainImage = document.getElementById('modal-main-image');
            const thumbContainer = document.getElementById('modal-thumbnail-container');
            const thumbTemplate = document.getElementById('thumbnail-template');
            const titleEl = document.getElementById('modal-title');
            const categoryEl = document.getElementById('modal-category');
            const priceEl = document.getElementById('modal-price');
            const oldPriceEl = document.getElementById('modal-old-price');
            const descEl = document.getElementById('modal-description');
            const specsEl = document.getElementById('modal-specs');
            const chatButton = document.getElementById('chat-button');
            const noResultsMessage = document.getElementById('no-results-message');
            const paginationContainer = document.querySelector('.pagination-container');

            // Elemen Filter
            const searchInput = document.getElementById('search-input');
            const priceFilter = document.getElementById('price-filter');
            const sortFilter = document.getElementById('sort-filter');

            // Elemen Filter Kategori (menggunakan card)
            const categoryCards = document.querySelectorAll('.card-category');

            // Elemen Tombol Tampilan BARU
            const gridViewBtn = document.getElementById('grid-view-btn');
            const listViewBtn = document.getElementById('list-view-btn');

            function formatRupiah(angka) {
                if (angka === null || typeof angka === 'undefined' || isNaN(Number(angka))) return 'Hubungi Kami';
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function renderProducts(productsToRender) {
                if (!productGrid) return;
                productGrid.innerHTML = '';
                if (productsToRender.length === 0) {
                    if (noResultsMessage) noResultsMessage.style.display = 'block';
                    return;
                }

                if (noResultsMessage) noResultsMessage.style.display = 'none';

                // Tentukan apakah kita harus merender sebagai grid atau list
                const isList = productGrid.classList.contains('product-list');

                productsToRender.forEach(product => {
                    const imageSrc = product.images.length > 0 ? product.images[0] :
                        '{{ asset('assets/demo/barbershop/img/klasik.png') }}';

                    let priceHtml = `<div class="service-price">${formatRupiah(product.price)}</div>`;
                    if (product.old_price && Number(product.old_price) > Number(product.price)) {
                        priceHtml +=
                            `<div class="service-old-price">${formatRupiah(product.old_price)}</div>`;
                    }

                    // Pilih template HTML berdasarkan tampilan yang aktif (grid atau list)
                    let productHtml = '';
                    if (isList) {
                        productHtml = `
                    <div class="card-product" data-product-id="${product.id}">
                        <div class="card-image-container">
                            <img src="${imageSrc}" alt="${product.name}" class="w-full h-full object-cover">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">${product.name}</h3>
                            <p class="card-text">${product.description || 'Tidak ada deskripsi.'}</p>
                            <div class="flex items-center justify-between mt-auto">
                                <div class="price">${formatRupiah(product.price)}</div>
                                <a href="#" class="btn btn-primary" onclick="window.showDynamicModal(${product.id}); return false;">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                    } else {
                        productHtml = `
                    <div class="card-product" data-product-id="${product.id}">
                        <img src="${imageSrc}" alt="${product.name}" class="card-image">
                        <div class="card-body">
                            <h3 class="card-title">${product.name}</h3>
                            <p class="card-text">${product.description || 'Tidak ada deskripsi.'}</p>

                            <a href="#" class="btn btn-primary" onclick="window.showDynamicModal(${product.id}); return false;">
                                Detail
                            </a>
                        </div>
                    </div>
                `;
                    }
                    productGrid.insertAdjacentHTML('beforeend', productHtml);
                });
            }

            // Fungsi utama untuk filter dan sorting
            function applyFiltersAndSort() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';

                const activeCategoryCard = document.querySelector('.card-category.active');
                const selectedCategory = activeCategoryCard ? activeCategoryCard.dataset.filter : 'all';

                const priceRange = priceFilter ? priceFilter.value.split('-') : ['all'];
                const minPrice = priceRange[0] !== 'all' ? parseFloat(priceRange[0]) : 0;
                const maxPrice = priceRange[0] !== 'all' ? parseFloat(priceRange[1]) : Infinity;
                const sortBy = sortFilter ? sortFilter.value : 'default';

                let filtered = window.productsData.filter(p => {
                    const nameMatch = p.name.toLowerCase().includes(searchTerm);
                    const categoryMatch = selectedCategory === 'all' || p.category_slug ===
                        selectedCategory;
                    const priceMatch = p.price >= minPrice && p.price <= maxPrice;
                    return nameMatch && categoryMatch && priceMatch;
                });

                // Sorting
                filtered.sort((a, b) => {
                    switch (sortBy) {
                        case 'price-asc':
                            return a.price - b.price;
                        case 'price-desc':
                            return b.price - a.price;
                        case 'name-asc':
                            return a.name.localeCompare(b.name);
                        case 'name-desc':
                            return b.name.localeCompare(a.name);
                        default:
                            return 0;
                    }
                });

                renderProducts(filtered);

                if (paginationContainer) {
                    paginationContainer.style.display = 'none';
                }
            }

            // Fungsi untuk beralih ke tampilan grid
            function setGridView() {
                if (productGrid.classList.contains('product-list')) {
                    productGrid.classList.remove('product-list');
                }
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                applyFiltersAndSort(); // Render ulang produk dengan tampilan baru
            }

            // Fungsi untuk beralih ke tampilan list
            function setListView() {
                if (!productGrid.classList.contains('product-list')) {
                    productGrid.classList.add('product-list');
                }
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                applyFiltersAndSort(); // Render ulang produk dengan tampilan baru
            }

            // Tambahkan event listener untuk tombol tampilan
            if (gridViewBtn) {
                gridViewBtn.addEventListener('click', setGridView);
            }
            if (listViewBtn) {
                listViewBtn.addEventListener('click', setListView);
            }

            // Aktifkan tampilan grid secara default saat halaman dimuat
            setGridView();

            // Tambahkan event listener untuk kartu-kartu kategori
            if (categoryCards) {
                categoryCards.forEach(card => {
                    card.addEventListener('click', function() {
                        categoryCards.forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                        applyFiltersAndSort();
                    });
                });
            }

            // Tambahkan event listener ke filter lainnya
            if (searchInput) searchInput.addEventListener('input', applyFiltersAndSort);
            if (priceFilter) priceFilter.addEventListener('change', applyFiltersAndSort);
            if (sortFilter) sortFilter.addEventListener('change', applyFiltersAndSort);

            // Modal untuk produk dinamis
            if (productGrid) {
                productGrid.addEventListener('click', function(event) {
                    const card = event.target.closest('.card-product');
                    if (!card) return;

                    const productId = parseInt(card.dataset.productId, 10);
                    const product = window.productsData.find(p => p.id === productId);
                    if (!product) return;

                    openProductModal(product);
                });
            }

            function openProductModal(product) {
                if (titleEl) titleEl.textContent = product.name;
                if (categoryEl) categoryEl.textContent = product.category_name;
                if (priceEl) priceEl.textContent = formatRupiah(product.price);
                if (descEl) descEl.innerHTML = product.description || '<i>Tidak ada deskripsi.</i>';

                if (oldPriceEl) {
                    if (product.old_price && Number(product.old_price) > Number(product.price)) {
                        oldPriceEl.textContent = formatRupiah(product.old_price);
                        oldPriceEl.style.display = 'inline';
                    } else {
                        oldPriceEl.style.display = 'none';
                    }
                }

                if (mainImage && product.images.length > 0) {
                    mainImage.src = product.images[0];
                }

                if (thumbContainer) {
                    thumbContainer.innerHTML = '';
                    if (product.images.length > 1) {
                        product.images.forEach((imgSrc, index) => {
                            if (thumbTemplate) {
                                const thumbNode = thumbTemplate.content.cloneNode(true);
                                const thumbBtn = thumbNode.querySelector('.thumbnail');
                                const thumbImg = thumbNode.querySelector('.thumbnail-image');
                                thumbImg.src = imgSrc;
                                thumbBtn.dataset.fullSrc = imgSrc;
                                if (index === 0) thumbBtn.classList.add('active');
                                thumbContainer.appendChild(thumbNode);
                            }
                        });
                    }
                }

                if (specsEl) {
                    specsEl.innerHTML = '';
                    if (product.specs && Object.keys(product.specs).length > 0) {
                        for (const [key, value] of Object.entries(product.specs)) {
                            const li = document.createElement('li');
                            li.innerHTML = `<strong>${key}:</strong> ${value}`;
                            specsEl.appendChild(li);
                        }
                    } else {
                        specsEl.innerHTML = '<li>Konsultasikan dengan barber kami untuk detail lebih lanjut.</li>';
                    }
                }

                if (chatButton) {
                    const phoneNumber = '{{ $userStore->store_phone ?? '' }}';
                    if (phoneNumber) {
                        const message = `Halo, saya tertarik dengan layanan "${product.name}".`;
                        chatButton.href =
                            `https://wa.me/${phoneNumber.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`;
                        chatButton.style.display = 'flex';
                    } else {
                        chatButton.style.display = 'none';
                    }
                }

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            window.showDynamicModal = function(productId) {
                const product = window.productsData.find(p => p.id === productId);
                if (product) {
                    openProductModal(product);
                } else {
                    console.warn('Product not found:', productId);
                }
            }

            window.showStaticModal = function(title, description, imageUrl) {
                if (titleEl) titleEl.textContent = title;
                if (descEl) descEl.innerHTML = description;
                if (mainImage) mainImage.src = imageUrl;

                if (categoryEl) categoryEl.textContent = 'Layanan Populer';
                if (priceEl) priceEl.textContent = '';
                if (oldPriceEl) oldPriceEl.style.display = 'none';
                if (thumbContainer) thumbContainer.innerHTML = '';
                if (specsEl) specsEl.innerHTML = '<li>Detail lebih lanjut tersedia di barbershop kami.</li>';
                if (chatButton) chatButton.style.display = 'none';

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            if (modalClose) modalClose.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });

            if (thumbContainer) {
                thumbContainer.addEventListener('click', function(e) {
                    const btn = e.target.closest('.thumbnail');
                    if (!btn) return;
                    if (mainImage) mainImage.src = btn.dataset.fullSrc;
                    document.querySelectorAll('#modal-thumbnail-container .thumbnail').forEach(el => el
                        .classList.remove('active'));
                    btn.classList.add('active');
                });
            }

            // Panggil filter saat pertama kali halaman dimuat
            applyFiltersAndSort();

            // Hero slider
            class HeroSlider {
                constructor() {
                    this.bgSlides = document.querySelectorAll('.bg-slide');
                    this.dots = document.querySelectorAll('.dot');
                    this.prevBtn = document.querySelector('.slider-btn.prev');
                    this.nextBtn = document.querySelector('.slider-btn.next');
                    this.currentSlide = 0;
                    this.totalSlides = this.bgSlides.length;
                    this.autoPlayInterval = null;
                    this.autoPlayDelay = 5000;
                    this.init();
                }

                init() {
                    if (this.totalSlides <= 1) {
                        if (this.prevBtn) this.prevBtn.style.display = 'none';
                        if (this.nextBtn) this.nextBtn.style.display = 'none';
                        if (document.querySelector('.slider-dots')) document.querySelector('.slider-dots').style
                            .display = 'none';
                        return;
                    }
                    this.bindEvents();
                    this.startAutoPlay();
                    this.goToSlide(this.currentSlide);
                }

                bindEvents() {
                    if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prevSlide());
                    if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.nextSlide());
                    this.dots.forEach((dot) => {
                        dot.addEventListener('click', () => this.goToSlide(parseInt(dot.dataset
                            .slide)));
                    });
                }

                goToSlide(index) {
                    if (index < 0) index = this.totalSlides - 1;
                    if (index >= this.totalSlides) index = 0;
                    this.bgSlides.forEach(slide => slide.classList.remove('active'));
                    this.dots.forEach(dot => dot.classList.remove('active'));
                    if (this.bgSlides[index]) this.bgSlides[index].classList.add('active');
                    if (this.dots[index]) this.dots[index].classList.add('active');
                    this.currentSlide = index;
                    this.resetAutoPlay();
                }

                nextSlide() {
                    this.goToSlide(this.currentSlide + 1);
                }

                prevSlide() {
                    this.goToSlide(this.currentSlide - 1);
                }

                startAutoPlay() {
                    if (this.totalSlides > 1) {
                        this.autoPlayInterval = setInterval(() => this.nextSlide(), this.autoPlayDelay);
                    }
                }

                resetAutoPlay() {
                    if (this.autoPlayInterval) {
                        clearInterval(this.autoPlayInterval);
                    }
                    this.startAutoPlay();
                }
            }
            new HeroSlider();
        });
    </script>
</body>

</html>
