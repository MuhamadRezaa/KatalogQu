<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'E-Katalog Fashion' }}</title>

    <meta name="description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta name="keywords" content="fashion, clothing, style, trends, catalog, online shopping, apparel, accessories">
    <meta name="author" content="Fashion E-Catalog">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Fashion E-Catalog Demo">
    <meta property="og:description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/og-image.jpg">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/demo/fashion/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-brand">
                <div class="brand-icon">
                    @if ($userStore && $userStore->store_logo)
                        <img class="brand-logo" src="{{ asset('storage/' . $userStore->store_logo) }}"
                            alt="{{ $userStore->store_name ?? 'Store Logo' }}" loading="lazy" decoding="async">
                    @else
                        <img class="brand-logo" src="{{ asset('assets/images/no-image-icon.png') }}"
                            alt="{{ $userStore->store_name ?? 'Fashion Store Logo' }}" loading="lazy" decoding="async">
                    @endif
                </div>
                <span class="brand-text">{{ $userStore->store_name ?? 'Fashion Store' }}</span>
            </a>
            <div class="nav-actions">
            </div>
        </div>
    </nav>

    <style>
        .brand-logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        @media (min-width: 640px) {
            .brand-logo {
                height: 50px;
                width: 50px;
            }
        }

        /* Hero Content Styling - Sesuai Demo Fashion */
        .hero-tagline {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 1rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s ease-in-out;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s ease-in-out;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 400;
            opacity: 0.8;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
            .hero-tagline {
                font-size: 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }
        }

        /* Hero Section Styling - Fashion Theme */
        .hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Swiper Banner Styles */
        .swiper-container {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Hero Content Positioning */
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            text-align: center;
            color: white;
            width: 90%;
            max-width: 800px;
            padding: 2rem;
        }

        /* Hero text styling untuk banner */
        .hero-title {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            font-weight: 700;
            line-height: 1.1;
        }

        .hero-subtitle {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
            font-weight: 400;
            opacity: 0.9;
            line-height: 1.4;
        }

        /* Custom pagination styling untuk tema fashion */
        .swiper-pagination {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 4;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            width: 12px;
            height: 12px;
            margin: 0 6px;
        }

        .swiper-pagination-bullet-active {
            background: #ec4899;
            transform: scale(1.2);
        }

        /* Navigation buttons styling */
        .swiper-button-prev,
        .swiper-button-next {
            color: white !important;
            background: rgba(0, 0, 0, 0.5) !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            z-index: 10 !important;
            margin-top: -25px !important;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .swiper-button-prev:hover,
        .swiper-button-next:hover {
            color: white !important;
            background: rgba(236, 72, 153, 0.9) !important;
            transform: scale(1.1);
            border-color: rgba(236, 72, 153, 0.8);
        }

        .swiper-button-prev::after,
        .swiper-button-next::after {
            font-size: 16px !important;
            font-weight: bold;
        }

        .swiper-button-prev {
            left: 20px !important;
        }

        .swiper-button-next {
            right: 20px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .swiper-container {
                height: 60vh;
            }

            .hero-content {
                padding: 1rem;
            }

            /* Hide navigation buttons on mobile */
            .swiper-button-prev,
            .swiper-button-next {
                display: none;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .swiper-container {
                height: 80vh;
            }
        }
        }

        /* Hero Background dan Overlay Styles */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .bg-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .bg-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.3) 100%);
            opacity: 0.8;
        }

        /* Konfigurasi Kategori - Styling yang Dapat Dikustomisasi */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(var(--max-categories-per-row, 4), 1fr);
            gap: 1rem;
        }

        .category-grid.category-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .category-grid.category-carousel {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding-bottom: 0.5rem;
        }

        .category-rounded .category-card {
            border-radius: 12px;
        }

        .category-square .category-card {
            border-radius: 4px;
        }

        .category-circle .category-card {
            border-radius: 50%;
            aspect-ratio: 1;
        }

        /* Konfigurasi Produk - Styling yang Dapat Dikustomisasi */
        .product-image-rounded {
            border-radius: 12px;
        }

        .product-image-square {
            border-radius: 4px;
        }

        .product-image-circle {
            border-radius: 50%;
            aspect-ratio: 1;
            object-fit: cover;
        }

        /* Responsive untuk kategori */
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .category-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    {{-- Hero Section dengan Swiper.js --}}
    <section class="hero">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @forelse ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="bg-image"
                            style="background-image: url('{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}');">
                        </div>
                        <div class="hero-overlay"></div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="bg-image" style="background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);">
                        </div>
                        <div class="hero-overlay"></div>
                    </div>
                @endforelse
            </div>

            {{-- Hero Content --}}
            <div class="hero-content">
                <h1 id="heroTitle"
                    class="text-4xl md:text-6xl lg:text-8xl font-bold mb-4 hero-title transition-opacity duration-500">
                    {{ $banners->first()->title ?? ($userStore->store_name ?? 'Fashion Store') }}
                </h1>
                <p id="heroSubtitle"
                    class="text-xl md:text-2xl lg:text-3xl mb-8 hero-subtitle transition-opacity duration-500">
                    {{ $banners->first()->subtitle ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti' }}
                </p>
                @if ($banners->first() && $banners->first()->link)
                    <a id="heroButton" href="{{ $banners->first()->link }}"
                        class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                        {{ $banners->first()->button_text ?? 'Lihat Koleksi' }}
                    </a>
                @endif
            </div>

            {{-- Navigation Buttons --}}
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            {{-- Pagination --}}
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <main class="container">
        <section class="section">
            <div class="section-title">
                <h2 id="categoryTitle">Kategori</h2>
                <p id="categorySubtitle">Pilih kategori produk yang Anda inginkan</p>
            </div>

            <div class="category-grid" id="categoryGrid">
                <div class="category-card active" data-category-id="all">
                    <div class="category-name">Semua Produk</div>
                    <div class="category-description">Lihat semua produk yang tersedia</div>
                </div>
                @foreach ($categories as $category)
                    <div class="category-card" data-category-id="{{ $category->id }}">
                        <div class="category-name">{{ $category->name }}</div>
                        <div class="category-description">{{ $category->description }}</div>
                    </div>
                @endforeach
            </div>

            <div class="subcategory-section" id="subcategorySection" style="display: none;">
                <div class="section-title">
                    <h3>Sub Kategori</h3>
                    <p>Pilih sub kategori untuk filter lebih spesifik</p>
                </div>
                <div class="subcategory-grid" id="subcategoryGrid">
                    {{-- Subkategori akan dimuat di sini oleh JavaScript --}}
                </div>
            </div>

            <div id="searchContainer" class="search-container">
                <div class="search-and-filters-wrapper">
                    <div class="search-wrapper">
                        <input type="text" id="searchInput" placeholder="Cari produk...">
                    </div>

                    <div class="filters-section">
                        <div class="filter-group">
                            <label for="sortPrice">Urutkan Harga:</label>
                            <select id="sortPrice">
                                <option value="">-- Pilih --</option>
                                <option value="low-high">Harga Terendah</option>
                                <option value="high-low">Harga Tertinggi</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortName">Urutkan Nama:</label>
                            <select id="sortName">
                                <option value="">-- Pilih --</option>
                                <option value="a-z">A - Z</option>
                                <option value="z-a">Z - A</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortDate">Urutkan Tanggal:</label>
                            <select id="sortDate">
                                <option value="">-- Pilih --</option>
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-title">
                <h2 id="productTitle">Semua Produk</h2>
                <p id="productSubtitle">Jelajahi koleksi lengkap kami</p>
            </div>

            {{-- PERBAIKAN: Menggunakan Blade untuk render produk dari server --}}
            <div class="products-grid" id="productsGrid">
                @forelse ($products as $product)
                    @php
                        $imagePath = $product->image ?? ($product->productImages->first()->image_path ?? null);
                        $imageUrl = $imagePath
                            ? url('tenancy/assets') . '/' . trim($imagePath, '/')
                            : 'https://via.placeholder.com/200?text=No+Image';
                        $formattedPrice = 'Rp ' . number_format($product->price, 0, ',', '.');
                    @endphp
                    <div class="product-card" data-product-id="{{ $product->id }}"
                        onclick="showProductDetails({{ $product->id }})">
                        <div class="product-image">
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" loading="lazy"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/200?text=No+Image'; this.style.opacity='1';"
                                onload="this.style.opacity='1';" style="opacity: 0; transition: opacity 0.3s ease;">
                        </div>
                        <div class="product-info">
                            <div class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">{{ $formattedPrice }}</div>
                        </div>
                    </div>
                @empty
                    {{-- Div ini hanya akan ditampilkan jika $products kosong --}}
                    <div id="noResults" class="no-results" style="display: block; grid-column: 1 / -1;">
                        <h3>Produk yang Anda cari tidak ditemukan</h3>
                        <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
                    </div>
                @endforelse
            </div>

            {{-- PERBAIKAN: Menambahkan link paginasi --}}
            <div class="pagination-links">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </section>

    </main>

    <style>
        /* Style untuk pagination */
        .pagination-links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination li.active span {
            background-color: #333;
            color: #fff;
            border-color: #333;
        }

        .pagination li.disabled span {
            color: #aaa;
            background-color: #f5f5f5;
        }
    </style>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left-content">
                <div class="footer-logo-section">
                    <div class="footer-brand-container">
                        @if ($userStore && $userStore->store_logo)
                            <img id="footerStoreLogo" class="footer-logo"
                                src="{{ asset('storage/' . $userStore->store_logo) }}"
                                alt="{{ $userStore->store_name ?? 'Store Logo' }}" loading="lazy" decoding="async">
                        @else
                            <img id="footerStoreLogo" class="footer-logo"
                                src="{{ asset('assets/demo/fashion/img/temp/logo-fashion.png') }}"
                                alt="{{ $userStore->store_name ?? 'Fashion Store Logo' }}" loading="lazy"
                                decoding="async">
                        @endif
                    </div>
                </div>
                <div class="footer-section footer-text-content">
                    <h3 id="footerStoreName">{{ $userStore->store_name ?? 'Fashion Store' }}</h3>
                    <p id="footerStoreDescription">
                        {{ $userStore->store_description ?? 'A place to find your best fashion.' }}</p>
                </div>
            </div>
            <div class="footer-middle-space">
            </div>
            <div class="footer-section footer-contact">
                <h3>Informasi Kontak</h3>
                <div class="contact-item">
                    <i class="contact-icon">📞</i>
                    <span id="footerStorePhone">{{ $userStore->store_phone ?? 'Nomor Telepon Tidak Tersedia' }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">✉</i>
                    <span id="footerStoreEmail">{{ $userStore->store_email ?? 'Alamat Email Tidak Tersedia' }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">📍</i>
                    <span id="footerStoreAddress">{{ $userStore->store_address ?? 'Alamat Tidak Tersedia' }}</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Powered by PT. Era Cipta Digital</p>
        </div>
    </footer>

    <style>
        .footer-brand-container {
            height: 50px;
            width: 50px;
        }

        .footer-logo {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        /* Style untuk gambar produk */
        .product-image {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .no-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            color: #666;
            font-size: 1rem;
            border-radius: 8px;
        }

        .modal-product-image {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
            background: #f8f9fa;
        }

        .modal-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .modal-product-image .no-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            color: #999;
            font-size: 1.2rem;
            border-radius: 12px;
        }
    </style>

    <!-- Product Modal -->
    <div id="productModal" class="product-modal">
        <div class="modal-container">
            <span onclick="closeModal()" class="modal-close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <style>
        /* Modal Styles */
        .product-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease-out;
            padding: 2rem;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .product-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
        }

        .modal-container {
            position: fixed;
            background-color: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 1000px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            /*animation: zoomIn 0.3s ease-out;*/
            margin: auto;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: color 0.2s ease;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #000;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .product-modal {
                padding: 1rem;
            }

            .modal-container {
                margin: 10px;
                /* kasih jarak aman di HP */
                width: calc(100% - 20px);
            }

            .modal-close {
                top: 10px;
                right: 15px;
                font-size: 24px;
            }
        }
    </style>

    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <p>Memuat data...</p>
    </div>

    <script>
        // ===== KONFIGURASI YANG DAPAT DIKUSTOMISASI OLEH ADMIN =====

        // Konfigurasi Hero Section - Menggunakan data banner dari database
        const heroConfig = {
            slides: [
                @forelse ($banners as $banner)
                    {
                        title: "{{ $banner->title ?? ($userStore->store_name ?? 'Fashion Store') }}",
                        subtitle: "{{ $banner->subtitle ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti' }}",
                        background: "{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                    }
                    {{ !$loop->last ? ',' : '' }}
                @empty
                    {
                        title: "{{ $userStore->store_name ?? 'Fashion Store' }}",
                        subtitle: "Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti",
                        background: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                    }
                @endforelse
            ]
        };

        // Konfigurasi Informasi Toko
        const storeConfig = {
            name: "{{ $userStore->store_name ?? 'Fashion Store' }}",
            description: "{{ $userStore->store_description ?? 'Temukan koleksi fashion terbaru dan terbaik untuk gaya hidup Anda.' }}",
            phone: "{{ $userStore->store_phone ?? '+62 123 456 789' }}",
            email: "{{ $userStore->store_email ?? 'info@fashionstore.com' }}",
            address: "{{ $userStore->store_address ?? 'Jakarta, Indonesia' }}",
            logo: "{{ $userStore->store_logo ? asset('storage/' . $userStore->store_logo) : '' }}"
        };

        // Konfigurasi Kategori yang Dapat Dikustomisasi
        const categoryConfig = {
            showAllCategory: {{ $storeSettings->show_all_category ?? 'true' }},
            allCategoryText: "{{ $storeSettings->all_category_text ?? 'Semua Kategori' }}",
            categoryDisplayStyle: "{{ $storeSettings->category_display_style ?? 'grid' }}", // grid, list, carousel
            maxCategoriesPerRow: {{ $storeSettings->max_categories_per_row ?? 4 }},
            showCategoryIcons: {{ $storeSettings->show_category_icons ?? 'true' }},
            categoryIconStyle: "{{ $storeSettings->category_icon_style ?? 'rounded' }}" // rounded, square, circle
        };

        // Konfigurasi Produk yang Dapat Dikustomisasi
        const productConfig = {
            productsPerPage: {{ $storeSettings->products_per_page ?? 12 }},
            showProductPrice: {{ $storeSettings->show_product_price ?? 'true' }},
            showProductDescription: {{ $storeSettings->show_product_description ?? 'true' }},
            productImageStyle: "{{ $storeSettings->product_image_style ?? 'rounded' }}", // rounded, square, circle
            enableProductModal: {{ $storeSettings->enable_product_modal ?? 'true' }},
            showContactSeller: {{ $storeSettings->show_contact_seller ?? 'true' }},
            contactButtonText: "{{ $storeSettings->contact_button_text ?? 'Hubungi Penjual' }}"
        };

        // Data dari Blade disiapkan untuk JavaScript
        const allCategories = @json($categories);
        const allSubcategories = @json($subCategories);
        const allProducts = @json($products->items());

        // Current filter state
        let currentCategoryId = 'all';
        let currentSubcategoryId = null;
        let currentSearchTerm = '';

        // Tenant Asset Helper Function
        const tenantAssetBase = "{{ url('tenancy/assets') }}/";

        const tenantAssetUrl = (p) => {
            let path = (p || '')
                .replace(/^storage\/+/i, '') // buang "storage/" kalau ada
                .replace(/^\/+/, '') // buang slash depan
                .replaceAll('\\', '/'); // normalize backslash Windows
            return tenantAssetBase + encodeURI(path);
        };

        // Legacy support - ASSET_URL for backward compatibility
        const ASSET_URL = tenantAssetBase;

        // Loading overlay functions
        function showLoadingOverlay() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = 'flex';
            }
        }

        function hideLoadingOverlay() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // --- FUNGSI-FUNGSI UTAMA ---

            // Fungsi untuk mengarahkan pengguna dengan parameter filter
            function applyFilterAndReload() {
                const baseUrl = "{{ url()->current() }}";
                const params = new URLSearchParams();

                // Kategori
                const activeCategory = document.querySelector('.category-card.active');
                if (activeCategory && activeCategory.dataset.categoryId !== 'all') {
                    params.set('category', activeCategory.dataset.categoryId);
                }

                // Subkategori
                const activeSubcategory = document.querySelector('.subcategory-card.active');
                if (activeSubcategory && activeSubcategory.dataset.subcategoryId) {
                    params.set('subcategory', activeSubcategory.dataset.subcategoryId);
                }

                // Pencarian
                const searchTerm = document.getElementById('searchInput').value;
                if (searchTerm) {
                    params.set('search', searchTerm);
                }

                // Urutan
                const sortPrice = document.getElementById('sortPrice').value;
                const sortName = document.getElementById('sortName').value;
                const sortDate = document.getElementById('sortDate').value;

                if (sortPrice) params.set('sort', sortPrice);
                else if (sortName) params.set('sort', sortName);
                else if (sortDate) params.set('sort', sortDate);

                window.location.href = `${baseUrl}?${params.toString()}`;
            }

            // Fungsi untuk menampilkan subkategori yang relevan
            function showSubcategoriesForCategory(categoryId) {
                const subcategoryGrid = document.getElementById('subcategoryGrid');
                const subcategorySection = document.getElementById('subcategorySection');
                subcategoryGrid.innerHTML = '';

                // Jika kategori "Semua Kategori", sembunyikan subkategori
                if (categoryId === 'all') {
                    subcategorySection.style.display = 'none';
                    return;
                }

                // Filter subkategori berdasarkan kategori dan produk yang tersedia
                const relevantSubcategories = allSubcategories.filter(sub => {
                    // Pastikan ada produk yang menggunakan subkategori ini dan berada di kategori yang dipilih
                    return allProducts.some(product =>
                        product.product_category_id == categoryId &&
                        product.sub_category_id == sub.id
                    );
                });

                if (relevantSubcategories.length === 0) {
                    subcategorySection.style.display = 'none';
                    return;
                }

                const allSubCard = document.createElement('div');
                allSubCard.className = 'subcategory-card active';
                allSubCard.innerHTML = '<div class="subcategory-name">Semua Sub Kategori</div>';
                allSubCard.onclick = () => selectSubcategory(null, allSubCard);
                subcategoryGrid.appendChild(allSubCard);

                relevantSubcategories.forEach(sub => {
                    const subCard = document.createElement('div');
                    subCard.className = 'subcategory-card';
                    subCard.dataset.subcategoryId = sub.id;
                    subCard.innerHTML = `<div class="subcategory-name">${sub.name}</div>`;
                    subCard.onclick = () => selectSubcategory(sub.id, subCard);
                    subcategoryGrid.appendChild(subCard);
                });

                subcategorySection.style.display = 'block';
            }

            function selectSubcategory(subcategoryId, element) {
                document.querySelectorAll('.subcategory-card').forEach(card => card.classList.remove('active'));
                element.classList.add('active');
                currentSubcategoryId = subcategoryId;
                filterProductsByCategory(currentCategoryId);
            }

            // Function to filter products without page reload
            function filterProductsByCategory(categoryId) {
                currentCategoryId = categoryId;

                let filteredProducts = allProducts;

                // Filter by category
                if (categoryId !== 'all') {
                    filteredProducts = filteredProducts.filter(product =>
                        product.product_category_id == categoryId
                    );
                }

                // Filter by subcategory if selected
                if (currentSubcategoryId) {
                    filteredProducts = filteredProducts.filter(product =>
                        product.sub_category_id == currentSubcategoryId
                    );
                }

                // Filter by search term if exists
                if (currentSearchTerm) {
                    filteredProducts = filteredProducts.filter(product =>
                        product.name.toLowerCase().includes(currentSearchTerm.toLowerCase()) ||
                        (product.description && product.description.toLowerCase().includes(currentSearchTerm
                            .toLowerCase()))
                    );
                }

                renderProducts(filteredProducts);
            }

            // Function to render products
            function renderProducts(products) {
                const productsGrid = document.getElementById('productsGrid');

                if (products.length === 0) {
                    productsGrid.innerHTML = `
                        <div id="noResults" class="no-results" style="display: block; grid-column: 1 / -1;">
                            <h3>Produk yang Anda cari tidak ditemukan</h3>
                            <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
                        </div>
                    `;
                    return;
                }

                productsGrid.innerHTML = products.map(product => {
                    const imagePath = product.image || (product.product_images && product.product_images[
                        0] ? product.product_images[0].image_path : null);
                    const imageUrl = imagePath ?
                        `${window.location.origin}/tenancy/assets/${imagePath.replace(/^\//, '')}` :
                        'https://via.placeholder.com/200?text=No+Image';
                    const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(product.price);
                    const categoryName = allCategories.find(cat => cat.id == product.product_category_id)
                        ?.name || 'Uncategorized';

                    return `
                        <div class="product-card" data-product-id="${product.id}" onclick="showProductDetails(${product.id})">
                            <div class="product-image">
                                <img src="${imageUrl}" alt="${product.name}" loading="lazy"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/200?text=No+Image'; this.style.opacity='1';"
                                    onload="this.style.opacity='1';" style="opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                            <div class="product-info">
                                <div class="product-category">${categoryName}</div>
                                <div class="product-name">${product.name}</div>
                                <div class="product-price">${formattedPrice}</div>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            // --- EVENT LISTENERS ---

            document.querySelectorAll('.category-card').forEach(card => {
                card.addEventListener('click', function() {
                    const categoryId = this.dataset.categoryId;

                    // Update active state
                    document.querySelectorAll('.category-card').forEach(c => c.classList.remove(
                        'active'));
                    this.classList.add('active');

                    // Reset subcategory selection
                    currentSubcategoryId = null;

                    // Show subcategories only if not "Semua Kategori"
                    if (categoryId === 'all') {
                        // Hide subcategories section
                        const subcategorySection = document.querySelector('.subcategory-section');
                        if (subcategorySection) {
                            subcategorySection.style.display = 'none';
                        }
                    } else {
                        // Show subcategories for this category
                        showSubcategoriesForCategory(categoryId);
                        const subcategorySection = document.querySelector('.subcategory-section');
                        if (subcategorySection) {
                            subcategorySection.style.display = 'block';
                        }
                    }

                    // Filter products without page reload
                    filterProductsByCategory(categoryId);
                });
            });

            // Event listener untuk filter
            document.getElementById('searchInput').addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    currentSearchTerm = e.target.value;
                    filterProductsByCategory(currentCategoryId);
                }
            });

            document.getElementById('searchInput').addEventListener('input', (e) => {
                currentSearchTerm = e.target.value;
                filterProductsByCategory(currentCategoryId);
            });
            document.getElementById('sortPrice').addEventListener('change', applyFilterAndReload);
            document.getElementById('sortName').addEventListener('change', applyFilterAndReload);
            document.getElementById('sortDate').addEventListener('change', applyFilterAndReload);

            // --- FUNGSI KUSTOMISASI ADMIN ---

            // Fungsi untuk menerapkan konfigurasi hero section
            function applyHeroConfiguration() {
                // Update hero background images
                const bgSlides = document.querySelectorAll('.bg-slide');
                bgSlides.forEach((slide, index) => {
                    if (heroConfig.slides[index]) {
                        const slideData = heroConfig.slides[index];
                        const bgImage = slide.querySelector('.bg-image');
                        if (bgImage) {
                            bgImage.style.backgroundImage = `url('${slideData.background}')`;
                            bgImage.style.backgroundSize = 'cover';
                            bgImage.style.backgroundPosition = 'center';
                            bgImage.style.backgroundRepeat = 'no-repeat';
                        }
                    }
                });

                // Update hero content for first slide
                updateHeroContent(0);
            }

            // Fungsi untuk update konten hero berdasarkan slide aktif
            function updateHeroContent(slideIndex) {
                const heroTitle = document.querySelector('.hero-title');
                const heroSubtitle = document.querySelector('.hero-subtitle');

                if (heroConfig.slides[slideIndex]) {
                    const slideData = heroConfig.slides[slideIndex];

                    if (heroTitle) {
                        heroTitle.style.opacity = '0';
                        setTimeout(() => {
                            heroTitle.textContent = slideData.title;
                            heroTitle.style.opacity = '1';
                        }, 200);
                    }
                    if (heroSubtitle) {
                        heroSubtitle.style.opacity = '0';
                        setTimeout(() => {
                            heroSubtitle.textContent = slideData.subtitle;
                            heroSubtitle.style.opacity = '1';
                        }, 300);
                    }
                }
            }

            // Fungsi untuk menerapkan konfigurasi footer
            function applyFooterConfiguration() {
                // Update store name in footer
                const footerStoreName = document.querySelector('.footer h3');
                if (footerStoreName) footerStoreName.textContent = storeConfig.name;

                // Update store description in footer
                const footerDescription = document.querySelector('.footer p');
                if (footerDescription) footerDescription.textContent = storeConfig.description;

                // Update contact information
                const contactItems = document.querySelectorAll('.contact-item span');
                if (contactItems[0]) contactItems[0].textContent = storeConfig.phone;
                if (contactItems[1]) contactItems[1].textContent = storeConfig.email;
                if (contactItems[2]) contactItems[2].textContent = storeConfig.address;

                // Update logo if available
                if (storeConfig.logo) {
                    const brandIcon = document.querySelector('.brand-icon');
                    if (brandIcon) {
                        brandIcon.innerHTML =
                            `<img src="${storeConfig.logo}" alt="${storeConfig.name}" style="width: 40px; height: 40px; object-fit: contain;">`;
                    }
                }
            }

            // Fungsi untuk menerapkan konfigurasi kategori
            function applyCategoryConfiguration() {
                // Update "Semua Kategori" text jika ada
                const allCategoryCard = document.querySelector(
                    '.category-card[data-category-id="all"] .category-name');
                if (allCategoryCard && categoryConfig.allCategoryText) {
                    allCategoryCard.textContent = categoryConfig.allCategoryText;
                }

                // Apply category display style
                const categoryGrid = document.querySelector('.category-grid');
                if (categoryGrid) {
                    categoryGrid.className = `category-grid category-${categoryConfig.categoryDisplayStyle}`;

                    // Set max categories per row via CSS custom property
                    categoryGrid.style.setProperty('--max-categories-per-row', categoryConfig.maxCategoriesPerRow);
                }

                // Apply category icon style
                const categoryCards = document.querySelectorAll('.category-card');
                categoryCards.forEach(card => {
                    card.classList.add(`category-${categoryConfig.categoryIconStyle}`);
                });
            }

            // Fungsi untuk menerapkan konfigurasi produk
            function applyProductConfiguration() {
                // Update contact button text
                const contactButtons = document.querySelectorAll('.contact-seller-btn');
                contactButtons.forEach(btn => {
                    if (productConfig.contactButtonText) {
                        btn.textContent = productConfig.contactButtonText;
                    }
                });

                // Apply product image style
                const productImages = document.querySelectorAll('.product-image');
                productImages.forEach(img => {
                    img.classList.add(`product-image-${productConfig.productImageStyle}`);
                });

                // Hide/show product elements based on configuration
                if (!productConfig.showProductPrice) {
                    const priceElements = document.querySelectorAll('.product-price');
                    priceElements.forEach(el => el.style.display = 'none');
                }

                if (!productConfig.showProductDescription) {
                    const descElements = document.querySelectorAll('.product-description');
                    descElements.forEach(el => el.style.display = 'none');
                }

                if (!productConfig.showContactSeller) {
                    const contactElements = document.querySelectorAll('.contact-seller-btn');
                    contactElements.forEach(el => el.style.display = 'none');
                }
            }

            // --- INISIALISASI ---
            const currentUrlParams = new URLSearchParams(window.location.search);
            const currentCategory = currentUrlParams.get('category') || 'all';
            const currentSubcategory = currentUrlParams.get('subcategory');

            // Terapkan semua konfigurasi saat halaman dimuat
            applyHeroConfiguration();
            applyFooterConfiguration();
            applyCategoryConfiguration();
            applyProductConfiguration();

            // Atur state aktif untuk kategori
            document.querySelectorAll('.category-card').forEach(c => c.classList.remove('active'));
            const activeCategoryCard = document.querySelector(
                `.category-card[data-category-id="${currentCategory}"]`);
            if (activeCategoryCard) {
                activeCategoryCard.classList.add('active');
            } else {
                // Jika tidak ada kategori yang cocok, aktifkan "Semua Kategori"
                const allCategoryCard = document.querySelector('.category-card[data-category-id="all"]');
                if (allCategoryCard) {
                    allCategoryCard.classList.add('active');
                }
            }

            // Tampilkan dan atur state aktif untuk subkategori
            if (currentCategory !== 'all') {
                showSubcategoriesForCategory(currentCategory);
                if (currentSubcategory) {
                    document.querySelectorAll('.subcategory-card').forEach(sc => sc.classList.remove('active'));
                    const activeSubCard = document.querySelector(
                        `.subcategory-card[data-subcategory-id="${currentSubcategory}"]`);
                    if (activeSubCard) activeSubCard.classList.add('active');
                }
            } else {
                // Pastikan subkategori disembunyikan untuk kategori "Semua Kategori"
                const subcategorySection = document.getElementById('subcategorySection');
                if (subcategorySection) {
                    subcategorySection.style.display = 'none';
                }
            }
        });
    </script>

    {{-- Sisanya adalah script untuk slider dan modal --}}
    <script>
        const productModal = document.getElementById('productModal');
        const modalContent = document.getElementById('modalContent');
        const loadingOverlay = document.getElementById('loadingOverlay'); // Ensure this is defined

        async function showProductDetails(productId) {
            // Show modal immediately
            productModal.style.display = 'flex';
            productModal.classList.add('show');
            document.body.style.overflow = 'hidden';

            modalContent.innerHTML = `
                <div class="modal-loading">
                    <div class="loading-spinner"></div>
                    <p>Memuat detail produk...</p>
                </div>
            `;

            try {
                // First try to find product in local data
                let product = allProducts.find(p => p.id == productId);

                if (!product) {
                    // Fallback to API if not found in local data
                    const response = await fetch(`/api/products/${productId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const data = await response.json();

                    if (!data.success) {
                        throw new Error(data.message || 'Failed to fetch product details');
                    }

                    product = data;
                }

                if (!product) {
                    throw new Error('Product not found');
                }

                // Handle multiple images
                const images = [];
                if (product.image) {
                    images.push(product.image);
                }
                if (product.product_images && product.product_images.length > 0) {
                    product.product_images.forEach(img => {
                        const imgPath = img.image_path || img;
                        if (imgPath && !images.includes(imgPath)) {
                            images.push(imgPath);
                        }
                    });
                }
                if (product.images && product.images.length > 0) {
                    product.images.forEach(img => {
                        const imgPath = img.image_path || img;
                        if (imgPath && !images.includes(imgPath)) {
                            images.push(imgPath);
                        }
                    });
                }

                const primaryImageUrl = images.length > 0 ?
                    `${window.location.origin}/tenancy/assets/${images[0].replace(/^\//, '')}` :
                    'https://via.placeholder.com/400x400?text=No+Image';

                const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(product.price);

                // Handle old price for discount display
                const oldPriceFormatted = product.old_price ?
                    'Rp ' + new Intl.NumberFormat('id-ID').format(product.old_price) : null;

                const material = product.specification?.material || product.material || '';
                const sizes = product.specification?.sizes || product.sizes || [];
                const colors = product.specification?.colors || product.colors || [];
                const brand = product.brand?.name || product.brand || '';
                const sku = product.sku || '';

                // Generate image gallery HTML
                let imageGalleryHTML = '';
                if (images.length > 1) {
                    imageGalleryHTML = `
                        <div class="image-gallery">
                            ${images.map((img, index) => {
                                const imgUrl = `${window.location.origin}/tenancy/assets/${img.replace(/^\//, '')}`;
                                return `
                                                                                                                                                                                                                            <img src="${imgUrl}"
                                                                                                                                                                                                                                 alt="${product.name} ${index + 1}"
                                                                                                                                                                                                                                 class="gallery-thumb ${index === 0 ? 'active' : ''}"
                                                                                                                                                                                                                                 onclick="changeMainImage('${imgUrl}', this)">
                                                                                                                                                                                                                        `;
                            }).join('')}
                        </div>
                    `;
                }

                // Generate sizes HTML
                let sizesHTML = '';
                if (sizes && sizes.length > 0) {
                    sizesHTML = `
                        <div class="modal-section">
                            <h4>Ukuran Tersedia:</h4>
                            <div class="sizes-list">
                                ${sizes.map(size => `<span class="size-tag">${size}</span>`).join('')}
                            </div>
                        </div>
                    `;
                }

                // Generate colors HTML
                let colorsHTML = '';
                if (colors && colors.length > 0) {
                    colorsHTML = `
                        <div class="modal-section">
                            <h4>Warna Tersedia:</h4>
                            <div class="colors-list">
                                ${colors.map(color => `<span class="color-tag">${color}</span>`).join('')}
                            </div>
                        </div>
                    `;
                }

                modalContent.innerHTML = `
                    <div class="modal-product-details">
                        <div class="modal-product-image">
                            <img id="mainProductImage" src="${primaryImageUrl}"
                                 alt="${product.name}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                 style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;">
                            <div class="no-image" style="display: none; height: 400px; background: #f0f0f0; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.2rem; color: #999;">📷 Image Not Available</div>
                            ${imageGalleryHTML}
                        </div>
                        <div class="modal-product-info">
                            <div class="modal-product-header">
                                <div class="modal-product-category">
                                    <span class="category-name">${product.category?.name || 'Uncategorized'}</span>
                                    ${product.sub_category?.name || product.subcategory?.name ? `<span class="subcategory-name"> > ${product.sub_category?.name || product.subcategory?.name}</span>` : ''}
                                </div>
                                ${sku ? `<div class="modal-product-sku">SKU: ${sku}</div>` : ''}
                                ${brand ? `<div class="modal-product-brand">Brand: ${brand}</div>` : ''}
                            </div>
                            <h2 class="modal-product-name">${product.name}</h2>
                            <div class="modal-product-pricing">
                                <div class="price-container">
                                    <div class="modal-product-price">${formattedPrice}</div>
                                    ${oldPriceFormatted ? `<div class="modal-product-old-price">${oldPriceFormatted}</div>` : ''}
                                </div>
                            </div>

                            <div class="modal-product-description">
                                <h4>Deskripsi:</h4>
                                <p>${product.description || 'Tidak ada deskripsi tersedia untuk produk ini.'}</p>
                            </div>

                            <div class="modal-product-specs">
                                ${material ? `
                                                                                                                                                                                                                            <div class="modal-section">
                                                                                                                                                                                                                                <h4>Material:</h4>
                                                                                                                                                                                                                                <p class="spec-value">${material}</p>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                        ` : ''}
                                ${sizesHTML}
                                ${colorsHTML}
                            </div>

                            <div class="modal-product-actions">
                                <button class="btn-contact contact-seller-btn" onclick="contactSeller('${product.name}')">
                                    <i class="fab fa-whatsapp"></i> Hubungi
                                </button>
                            </div>
                        </div>
                    </div>

                    <style>
                        .modal-product-details {
                            display: grid;
                            grid-template-columns: 1fr 1fr;
                            gap: 2rem;
                            padding: 2rem;
                        }

                        .modal-product-category {
                            font-size: 0.9rem;
                            color: #777;
                            margin-bottom: 0.5rem;
                        }

                        .category-name {
                            font-weight: 600;
                            color: #555;
                        }

                        .subcategory-name {
                            color: #888;
                            font-weight: 400;
                        }

                        .modal-product-sku {
                            font-size: 0.85rem;
                            color: #666;
                            margin-bottom: 0.3rem;
                        }

                        .modal-product-brand {
                            font-size: 0.85rem;
                            color: #666;
                            margin-bottom: 0.5rem;
                        }

                        .modal-product-name {
                            font-size: 2rem;
                            font-weight: 700;
                            color: #333;
                            margin-bottom: 1rem;
                            line-height: 1.2;
                        }

                        .price-container {
                            display: flex;
                            align-items: center;
                            gap: 1rem;
                            margin-bottom: 1.5rem;
                        }

                        .modal-product-price {
                            font-size: 1.8rem;
                            font-weight: 700;
                            color: #e74c3c;
                        }

                        .modal-product-old-price {
                            font-size: 1.2rem;
                            color: #999;
                            text-decoration: line-through;
                            font-weight: 400;
                        }

                        .modal-section {
                            margin-bottom: 1.5rem;
                        }

                        .modal-section h4 {
                            font-size: 1.1rem;
                            font-weight: 600;
                            color: #333;
                            margin-bottom: 0.5rem;
                        }

                        .modal-section p {
                            line-height: 1.6;
                            color: #555;
                        }

                        .sizes-list, .colors-list {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 0.5rem;
                        }

                        .size-tag, .color-tag {
                            background: #f0f0f0;
                            padding: 0.4rem 0.8rem;
                            border-radius: 20px;
                            font-size: 0.9rem;
                            font-weight: 500;
                            border: 1px solid #ddd;
                        }

                        .stock-info.in-stock { color: #28a745; }
                        .stock-info.low-stock { color: #ffc107; }
                        .stock-info.out-of-stock { color: #dc3545; }

                        /* Gallery Styles */
                        .image-gallery {
                            display: flex;
                            flex-direction: column;
                            gap: 1rem;
                        }

                        .main-image {
                            width: 100%;
                            height: 400px;
                            object-fit: cover;
                            border-radius: 8px;
                            border: 1px solid #ddd;
                        }

                        .gallery-thumbnails {
                            display: flex;
                            gap: 0.5rem;
                            overflow-x: auto;
                            padding: 0.5rem 0;
                        }

                        .gallery-thumb {
                            width: 60px;
                            height: 60px;
                            object-fit: cover;
                            border-radius: 4px;
                            border: 2px solid transparent;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            flex-shrink: 0;
                        }

                        .gallery-thumb:hover {
                            border-color: #007bff;
                            opacity: 0.8;
                        }

                        .gallery-thumb.active {
                            border-color: #007bff;
                            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
                        }

                        /* Error Modal Styles */
                        .modal-error {
                            text-align: center;
                            padding: 3rem 2rem;
                            max-width: 400px;
                            margin: 0 auto;
                        }

                        .error-icon {
                            font-size: 4rem;
                            margin-bottom: 1rem;
                        }

                        .modal-error h3 {
                            color: #dc3545;
                            margin-bottom: 1rem;
                            font-size: 1.5rem;
                        }

                        .modal-error p {
                            color: #666;
                            margin-bottom: 2rem;
                            line-height: 1.6;
                        }

                        .btn-retry {
                            background: #007bff;
                            color: white;
                            border: none;
                            padding: 0.75rem 1.5rem;
                            border-radius: 6px;
                            font-size: 1rem;
                            cursor: pointer;
                            transition: background-color 0.3s ease;
                        }

                        .btn-retry:hover {
                            background: #0056b3;
                        }

                        /* Action Buttons */
                        .modal-actions {
                            display: flex;
                            gap: 1rem;
                            margin-top: 2rem;
                        }

                        .btn-contact {
                            flex: 1;
                            background: linear-gradient(135deg, #25d366, #128c7e);
                            color: white;
                            border: none;
                            padding: 14px 28px;
                            border-radius: 30px;
                            font-size: 1.1rem;
                            font-weight: 600;
                            cursor: pointer;
                            transition: all 0.3s ease;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.2);
                            text-decoration: none;
                            width: 100%;
                        }

                        .btn-contact:hover {
                            background: linear-gradient(135deg, #128c7e, #25d366);
                            transform: translateY(-2px);
                            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
                        }

                        .btn-contact i {
                            font-size: 1.2rem;
                        }

                        .modal-product-actions {
                            margin-top: 2rem;
                        }

                        @media (max-width: 768px) {
                            .modal-product-details {
                                grid-template-columns: 1fr;
                                gap: 1rem;
                                padding: 1rem;
                            }

                            .modal-product-name {
                                font-size: 1.5rem;
                            }

                            .modal-product-price {
                                font-size: 1.4rem;
                            }

                            .main-image {
                                height: 250px;
                            }

                            .modal-actions {
                                flex-direction: column;
                            }
                        }

                        /* Additional Responsive Improvements */
                        @media (max-width: 576px) {
                            .container {
                                padding: 1rem 0.5rem;
                            }

                            .section-title h2 {
                                font-size: 1.8rem;
                            }

                            .category-grid {
                                grid-template-columns: repeat(2, 1fr);
                                gap: 0.75rem;
                            }

                            .category-card {
                                padding: 1rem;
                                min-height: 120px;
                            }

                            .category-card h3 {
                                font-size: 1rem;
                                margin-bottom: 0.5rem;
                            }

                            .category-card p {
                                font-size: 0.8rem;
                                line-height: 1.3;
                            }

                            .search-and-filters-wrapper {
                                flex-direction: column;
                                gap: 1rem;
                            }

                            .filters-section {
                                flex-direction: column;
                                gap: 0.75rem;
                            }

                            .filter-group {
                                width: 100%;
                            }

                            .filter-group select {
                                width: 100%;
                                padding: 0.75rem;
                                font-size: 0.9rem;
                            }

                            .search-box {
                                width: 100%;
                                padding: 0.75rem 1rem;
                                font-size: 0.9rem;
                            }

                            .products-grid {
                                grid-template-columns: repeat(2, 1fr);
                                gap: 0.75rem;
                            }

                            .product-card {
                                padding: 0.75rem;
                            }

                            .product-image {
                                height: 140px;
                            }

                            .product-name {
                                font-size: 0.9rem;
                                line-height: 1.2;
                                margin-bottom: 0.5rem;
                            }

                            .product-price {
                                font-size: 1rem;
                                margin-bottom: 0.5rem;
                            }

                            .product-description {
                                font-size: 0.8rem;
                                line-height: 1.3;
                                margin-bottom: 0.75rem;
                            }

                            .btn-detail {
                                padding: 0.5rem 0.75rem;
                                font-size: 0.8rem;
                            }
                        }

                        @media (max-width: 400px) {
                            .category-grid {
                                grid-template-columns: 1fr;
                                gap: 0.5rem;
                            }

                            .products-grid {
                                grid-template-columns: 1fr;
                                gap: 0.5rem;
                            }

                            .product-image {
                                height: 180px;
                            }
                        }
                    </style>
                `;

                productModal.classList.add('show');
                document.body.style.overflow = 'hidden';

            } catch (error) {
                console.error('Error fetching product details:', error);
                hideLoadingOverlay();
                modalContent.innerHTML = `
                    <div class="modal-error">
                        <div class="error-icon">⚠️</div>
                        <h3>Gagal Memuat Detail Produk</h3>
                        <p>Terjadi kesalahan saat memuat detail produk. Silakan coba lagi.</p>
                        <button class="btn-retry" onclick="showProductDetails(${productId})">Coba Lagi</button>
                    </div>
                `;
                productModal.style.display = 'flex';
            }
        }

        // Function to change main image in gallery
        function changeMainImage(imageUrl, thumbElement) {
            const mainImage = document.getElementById('mainProductImage');
            if (mainImage) {
                mainImage.src = imageUrl;
            }

            // Update active thumbnail
            document.querySelectorAll('.gallery-thumb').forEach(thumb => {
                thumb.classList.remove('active');
            });
            thumbElement.classList.add('active');
        }

        // Function to contact seller via WhatsApp
        function contactSeller(productName) {
            const storePhone = "{{ $userStore->store_phone ?? ($userStore->phone ?? '') }}";
            if (!storePhone) {
                alert('Nomor kontak tidak tersedia. Silakan hubungi admin untuk informasi lebih lanjut.');
                return;
            }

            const storeName = "{{ $userStore->store_name ?? 'Toko' }}";
            const message =
                `Halo ${storeName},\n\nSaya tertarik dengan produk "${productName}" yang ada di katalog Anda.\n\nBisakah Anda memberikan informasi lebih lanjut mengenai:\n- Ketersediaan stok\n- Detail produk\n- Harga dan cara pemesanan\n\nTerima kasih!`;

            // Clean phone number (remove non-numeric characters)
            const cleanPhone = storePhone.replace(/[^0-9]/g, '');

            // Add country code if not present
            const formattedPhone = cleanPhone.startsWith('62') ? cleanPhone : '62' + cleanPhone.replace(/^0/, '');

            const whatsappUrl = `https://wa.me/${formattedPhone}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        // Close modal
        function closeModal() {
            if (productModal) {
                productModal.classList.remove('show');
                productModal.style.display = 'none';
                document.body.style.overflow = 'auto';

                // Clear modal content
                const modalContent = document.getElementById('modalContent');
                if (modalContent) {
                    modalContent.innerHTML = '';
                }
            }
        }

        // Close modal when clicking outside
        productModal.addEventListener('click', function(event) {
            if (event.target === productModal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && productModal && productModal.classList.contains('show')) {
                closeModal();
            }
        });

        // ===== BANNER SLIDER MENGGUNAKAN SWIPER.JS =====
        // Implementasi slider banner sudah dipindahkan ke Swiper.js
        // untuk performa yang lebih baik dan fitur yang lebih lengkap
    </script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Banner data untuk hero content updates
        @php
            $bannerData = $banners->map(function ($banner) {
                return [
                    'title' => $banner->title ?? 'Fashion Store',
                    'subtitle' => $banner->subtitle ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti',
                    'link' => $banner->link,
                    'button_text' => $banner->button_text ?? 'Lihat Koleksi',
                ];
            });
        @endphp

        const bannerData = @json($bannerData);
        console.log('Banner data:', bannerData);

        // Function to update hero content
        function updateHeroContent(index) {
            const banner = bannerData[index] || bannerData[0];
            const titleElement = document.getElementById('heroTitle');
            const subtitleElement = document.getElementById('heroSubtitle');
            const buttonElement = document.getElementById('heroButton');

            if (titleElement && subtitleElement) {
                // Fade out
                titleElement.style.opacity = '0';
                subtitleElement.style.opacity = '0';

                setTimeout(() => {
                    // Update content
                    titleElement.textContent = banner.title;
                    subtitleElement.textContent = banner.subtitle;

                    // Update button
                    if (buttonElement && banner.link) {
                        buttonElement.href = banner.link;
                        buttonElement.textContent = banner.button_text;
                        buttonElement.style.display = 'inline-block';
                    } else if (buttonElement) {
                        buttonElement.style.display = 'none';
                    }

                    // Fade in
                    titleElement.style.opacity = '1';
                    subtitleElement.style.opacity = '1';
                }, 250);
            }
        }

        // Initialize Swiper for banner slider
        console.log('Initializing Swiper...');
        const swiper = new Swiper(".swiper-container", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 800,
            on: {
                slideChange: function() {
                    const realIndex = this.realIndex;
                    console.log('Slide changed to:', realIndex);
                    updateHeroContent(realIndex);
                },
                init: function() {
                    console.log('Swiper initialized successfully');
                    console.log('Navigation buttons:', document.querySelectorAll(
                        '.swiper-button-prev, .swiper-button-next'));
                }
            }
        });

        console.log('Swiper instance:', swiper);

        // Initialize hero content on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateHeroContent(0);
        });
    </script>

</body>

</html>
