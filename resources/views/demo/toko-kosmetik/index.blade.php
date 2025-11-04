<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://via.placeholder.com/32/E6397A/FFFFFF?text=CS" type="image/x-icon">
    <title>Canu Cosmetics - E-Katalog Premium</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
        }

        body {
            font-family: var(--font-secondary);
            background-color: #FFF5F7;
            background-image: linear-gradient(180deg, #FFF5F7 0%, #FFE9EC 100%);
            color: var(--text-color);
        }

        .section-title {
            font-family: var(--font-primary);
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.05);
        }

        .section-subtitle {
            font-family: var(--font-secondary);
            color: #888;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06); */
            /* <-- Ganti ini */
            border-bottom: 1px solid #e5e7eb;
            /* <-- Tambahkan style border seperti toko-komputer */
        }

        /* Menghilangkan border pada tombol hamburger */
        .navbar-toggler {
            border: none;
            font-size: 1.25rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Menyesuaikan menu mobile agar mirip toko-komputer */
        @media (max-width: 991.98px) {

            /* Ini adalah breakpoint 'lg' Bootstrap */
            .navbar-collapse {
                /* Ini meniru 'border-t border-gray-200' dari toko-komputer */
                border-top: 1px solid #e5e7eb;
                margin-top: 1rem;
                /* Memberi jarak dari logo */
                padding-top: 0.5rem;
            }

            .navbar-nav .nav-link {
                /* Ini meniru 'block px-3 py-2' dari toko-komputer */
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                padding-left: 0;
                /* Rata kiri */
            }
        }

        .brand-text {
            font-family: var(--font-primary);
            font-weight: 700;
            font-size: 1.6rem;
            color: var(--primary-color);
        }

        .hero-section {
            padding-top: 70px;
        }

        .hero-slide {
            position: relative;
            width: 100%;
            /* height: 60vh; */
            /* <-- Hapus atau komentari baris ini */
            /* min-height: 450px; */
            /* <-- Hapus atau komentari baris ini */
            aspect-ratio: 16 / 9;
            /* <-- Tambahkan baris ini untuk rasio 1080p */
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
            z-index: 1;
            animation: zoomIn 15s infinite;
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
        }

        .hero-title {
            font-family: var(--font-primary);
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: #eee;
        }

        .promo-products-section {
            background-color: var(--white-bg);
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .promo-swiper {
            width: 100%;
            padding-top: 20px;
            padding-bottom: 50px;
        }

        .promo-swiper .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 280px;
        }

        .promo-swiper .swiper-slide-shadow-left,
        .promo-swiper .swiper-slide-shadow-right {
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0));
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
            height: 180px;
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
            padding: 1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .product-brand {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.1rem;
            text-transform: uppercase;
        }

        .product-title {
            font-family: var(--font-primary);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            flex-grow: 1;
        }

        .product-category {
            font-size: 0.75rem;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .current-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .old-price {
            font-size: 0.8rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 5px;
        }

        .badge-new,
        .badge-promo {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 0.75em;
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
            color: #fff;
            padding: 4rem 0;
        }

        .footer-title {
            font-family: var(--font-primary);
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .footer p,
        .footer li {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #fff;
        }

        .social-links a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
        }

        .modal-body .btn-close {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }

        .related-product-card {
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .related-product-card:hover {
            transform: translateY(-5px);
        }

        .related-product-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 5px;
            border: 1px solid #eee;
        }

        .related-product-title {
            font-size: 0.8rem;
            color: var(--text-color);
            font-weight: 500;
        }

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

        @media (min-width: 768px) {
            .hero-title {
                font-size: 4rem;
            }

            .hero-subtitle {
                font-size: 1.3rem;
            }

            .product-image-container {
                height: 250px;
            }

            .product-info {
                padding: 1.25rem;
            }

            .product-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 991px) {
            .modal-dialog.modal-lg .row>.col-lg-6 {
                width: 100%;
            }

            .modal-image-col {
                border-radius: 15px 15px 0 0;
                min-height: 300px;
            }

            .modal-details-col {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="https://via.placeholder.com/45x45/E6397A/FFFFFF?text=CS" alt="Logo"
                    class="brand-logo me-2" style="height: 40px;">
                <span class="brand-text">Canu Cosmetics</span>
            </a>
        </div>
    </nav>

    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" id="heroCarouselIndicators"></div>
            <div class="carousel-inner" id="heroCarouselInner"></div>
        </div>
    </section>

    <section class="promo-products-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Produk Promo</h2>
                    <p class="section-subtitle">Jangan lewatkan penawaran spesial kami!</p>
                </div>
            </div>
            <div class="swiper-container promo-swiper">
                <div class="swiper-wrapper" id="promoProductsSwiper"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="search-filter-section pt-5" id="products">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Semua Produk</h2>
                <p class="section-subtitle">Temukan produk yang sesuai dengan selera Anda</p>
            </div>
            <div class="row align-items-center g-2 mt-3">
                <div class="col-12 mb-2 col-lg-3"><input type="text" id="searchInput"
                        class="form-control filter-control" placeholder="Cari produk, brand..."></div>
                <div class="col-6 col-lg-2"><select id="categoryFilter" class="form-select filter-control">
                        <option value="">Kategori</option>
                    </select></div>
                <div class="col-6 col-lg-2"><select id="subcategoryFilter" class="form-select filter-control">
                        <option value="">Sub Kategori</option>
                    </select></div>
                <div class="col-6 col-lg-2"><select id="brandFilter" class="form-select filter-control">
                        <option value="">Brand</option>
                    </select></div>
                <div class="col-6 col-lg-2"><select id="priceFilter" class="form-select filter-control">
                        <option value="">Harga</option>
                        <option data-min="0" data-max="100000">&lt; 100rb</option>
                        <option data-min="100000" data-max="300000">100rb - 300rb</option>
                        <option data-min="300000" data-max="500000">300rb - 500rb</option>
                        <option data-min="500000" data-max=""> &gt; 500rb</option>
                    </select></div>
                <div class="col-6 col-lg-2"><select id="sortFilter" class="form-select filter-control">
                        <option value="newest">Terbaru</option>
                        <option value="price_low">Termurah</option>
                        <option value="price_high">Termahal</option>
                        <option value="name">Nama A-Z</option>
                    </select></div>
                <div class="col-12 mt-2 col-lg-1 mt-lg-0"><button class="btn btn-outline-secondary w-100"
                        onclick="resetFilters()">Reset</button></div>
            </div>
        </div>
    </section>

    <section class="products-content-section pt-4 pb-5">
        <div class="container">
            <div class="row g-3 g-md-4" id="productsGrid"></div>
        </div>
    </section>
    {{-- [BARU] Tambahkan Kontainer Pagination di Sini --}}
    <div class="my-5 d-flex justify-content-center" id="paginationContainer">
    </div>

    <footer id="contact" class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Canu Cosmetics</h5>
                    <p>Temukan kecantikan sejati Anda dengan koleksi kosmetik premium kami. Dibuat dengan bahan-bahan
                        terbaik untuk menonjolkan pesona alami Anda setiap hari.</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">Jl. Demo Raya No.123, Kota Fiktif</li>
                        <li class="mb-2">info@canucosmetics.com</li>
                        <li class="mb-2">+62 815-7250-5989</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-white border-opacity-25">
                <div class="col-12 text-center">
                    <p class="mb-0 small">&copy; 2025 Canu Cosmetics. Powered by PT. Era Cipta Digital.</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row m-0">
                        <div class="col-lg-6 modal-image-col">
                            <div id="modalCarousel" class="carousel slide">
                                <div class="carousel-inner" id="modalCarouselInner"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 modal-details-col">
                            <p id="modalProductBrand" class="text-uppercase">BRAND</p>
                            <div class="d-flex align-items-center mb-2">
                                <h3 id="modalProductName" class="mb-0">Nama Produk</h3>
                                <span id="modalProductBadge" class="badge ms-2"></span>
                            </div>
                            <p class="text-muted" id="modalProductCategory">Kategori > Sub-kategori</p>
                            <div class="d-flex align-items-baseline mb-3">
                                <h4 class="fw-bold me-2" id="modalProductPrice">Rp 0</h4>
                                <h5 class="text-muted text-decoration-line-through" id="modalProductOldPrice">Rp 0
                                </h5>
                            </div>
                            <strong>Deskripsi</strong>
                            <p id="modalProductDescription">Deskripsi produk...</p>
                            <br>
                            <strong>Spesifikasi</strong>
                            <div id="modalProductSpecs"></div>
                            <div class="d-grid mt-4">
                                <a id="chatButton" href="#" target="_blank" class="btn btn-success btn-lg"><i
                                        class="fab fa-whatsapp me-2"></i> Chat Toko</a>
                            </div>
                            <div id="related-products-section" class="mt-4 pt-4 border-top">
                                <h6 class="mb-3">Anda Mungkin Juga Suka</h6>
                                <div id="related-products-container" class="row g-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dummyBanners = [{
                    title: "Temukan Kecantikan Sejati Anda",
                    subtitle: "Koleksi kosmetik premium untuk wanita modern",
                    image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=1920&q=80"
                },
                {
                    title: "Skincare Revolusioner",
                    subtitle: "Formula inovatif untuk kulit sehat dan bercahaya",
                    image: "https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?auto=format&fit=crop&w=1920&q=80"
                },
                {
                    title: "Temukan Kecantikan Sejati Anda",
                    subtitle: "Koleksi kosmetik premium untuk wanita modern",
                    image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=1920&q=80"
                },
            ];
            const dummyCategories = [{
                id: 1,
                name: "Skincare"
            }, {
                id: 2,
                name: "Makeup"
            }, {
                id: 8,
                name: "Fragrance"
            }];
            const dummyProducts = [{
                    id: 1,
                    name: "Hydrating Serum",
                    brand: "Aura Beauty",
                    category_id: 1,
                    subcategory: "Serum Wajah",
                    price: 150000,
                    old_price: null,
                    description: "Serum yang menghidrasi.",
                    specs: {
                        Volume: "30ml",
                        Bahan: "Hyaluronic Acid"
                    },
                    images: [
                        "images/kosmetik.jpg"
                    ],
                    is_new: true,
                    discount_percentage: null
                },
                {
                    id: 2,
                    name: "Matte Lipstick (Ruby Red)",
                    brand: "Canu Glow",
                    category_id: 2,
                    subcategory: "Lip Cream",
                    price: 85000,
                    old_price: 100000,
                    description: "Lipstick matte merah.",
                    specs: {
                        Warna: "Merah",
                        Finish: "Matte"
                    },
                    images: [
                        "images/kosmetik.jpg"
                    ],
                    is_new: false,
                    discount_percentage: 15
                },
                {
                    id: 3,
                    name: "Radiant Foundation",
                    brand: "Aura Beauty",
                    category_id: 2,
                    subcategory: "Liquid Foundation",
                    price: 280000,
                    old_price: null,
                    description: "Foundation ringan.",
                    specs: {
                        Shade: "Light Beige",
                        SPF: "30"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1588667822765-f93021a590c7?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: true,
                    discount_percentage: null
                },
                {
                    id: 4,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 9,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 11,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 12,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 13,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 14,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 15,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 16,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 17,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 18,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 19,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 20,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 21,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 22,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 23,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 24,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 25,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 26,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 27,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 28,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "images/kosmetik.jpg"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 29,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 30,
                    name: "Eyeshadow Palette (Nude)",
                    brand: "Ethereal Skin",
                    category_id: 2,
                    subcategory: "Eyeshadow",
                    price: 180000,
                    old_price: null,
                    description: "Palet eyeshadow nude.",
                    specs: {
                        JumlahShade: "12"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 8,
                    name: "Eau de Parfum (Floral)",
                    brand: "Ethereal Skin",
                    category_id: 8,
                    subcategory: "Parfum EDP",
                    price: 350000,
                    old_price: 400000,
                    description: "Parfum aroma floral.",
                    specs: {
                        Ukuran: "50ml",
                        Aroma: "Floral"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1541108523308-b0a340ddbf58?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: 12
                },
                {
                    id: 10,
                    name: "Compact Powder",
                    brand: "Aura Beauty",
                    category_id: 2,
                    subcategory: "Bedak Padat",
                    price: 110000,
                    old_price: 130000,
                    description: "Bedak padat matte.",
                    specs: {
                        Shade: "Natural",
                        Finish: "Matte"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: true,
                    discount_percentage: 15
                },
            ];

            const allProductsData = dummyProducts.map(p => ({
                ...p,
                price_formatted: `Rp ${p.price.toLocaleString('id-ID')}`,
                old_price_formatted: p.old_price ? `Rp ${p.old_price.toLocaleString('id-ID')}` : null,
                category: dummyCategories.find(c => c.id === p.category_id)?.name || 'Lainnya',
                image: p.images[0]
            }));

            const promoProducts = allProductsData.filter(p => p.discount_percentage !== null);
            //{{-- INI KODE YANG BENAR --}}
            const productModal = new bootstrap.Modal(document.getElementById('productModal'));

            // [BARU] Variabel untuk Pagination
            let currentPage = 1;
            const productsPerPage = 12; // 4 kolom x 3 baris = 12 produk per halaman
            const paginationContainer = document.getElementById('paginationContainer');

            function populateBanners() {
                const indicators = document.getElementById('heroCarouselIndicators');
                const inner = document.getElementById('heroCarouselInner');
                indicators.innerHTML = dummyBanners.map((_, i) =>
                    `<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="${i}" class="${i === 0 ? 'active' : ''}"></button>`
                ).join('');
                inner.innerHTML = dummyBanners.map((b, i) =>
                    `<div class="carousel-item ${i === 0 ? 'active' : ''}"><div class="hero-slide"><img src="${b.image}" class="hero-background"><div class="hero-content"><h1 class="hero-title">${b.title}</h1><p class="hero-subtitle">${b.subtitle}</p></div></div></div>`
                ).join('');
            }

            function populateSwiper(containerId, products) {
                const swiperContainer = document.getElementById(containerId);
                if (products.length === 0) {
                    swiperContainer.closest('.promo-products-section').style.display = 'none';
                    return;
                }
                swiperContainer.innerHTML = products.map(p =>
                    `<div class="swiper-slide h-100">${createProductCardHtml(p)}</div>`).join('');
            }

            function createProductCardHtml(product) {
                let badgeHtml = '';
                if (product.discount_percentage) badgeHtml = `<div class="badge-promo">PROMO</div>`;
                else if (product.is_new) badgeHtml = `<div class="badge-new">BARU</div>`;

                return `<div class="product-card" data-product-id="${product.id}">${badgeHtml}<div class="product-image-container"><img src="${product.image}" alt="${product.name}" class="product-image"></div><div class="product-info"><p class="product-brand">${product.brand}</p><h5 class="product-title">${product.name}</h5><p class="product-category">${product.subcategory}</p><div class="product-price mt-auto"><span class="current-price">${product.price_formatted}</span> ${product.old_price_formatted ? `<span class="old-price">${product.old_price_formatted}</span>` : ''}</div></div></div>`;
            }

            function displayProducts(products) {
                const grid = document.getElementById('productsGrid');
                grid.innerHTML = products.length > 0 ? products.map(p =>
                        `<div class="col-6 col-md-4 col-lg-3">${createProductCardHtml(p)}</div>`).join('') :
                    `<div class="col-12 text-center py-5"><p class="fs-4 text-muted">Produk tidak ditemukan.</p></div>`;
                setupProductCardListeners();
            }

            // [BARU] Fungsi untuk merender tombol pagination
            function renderPagination(totalProducts) {
                const totalPages = Math.ceil(totalProducts / productsPerPage);
                paginationContainer.innerHTML = ''; // Kosongkan
                if (totalPages <= 1) return; // Sembunyikan jika hanya 1 halaman

                let paginationHtml = '<ul class="pagination">';

                // Tombol "Previous"
                paginationHtml += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="prev" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>`;

                // Tombol Angka
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
                }

                // Tombol "Next"
                paginationHtml += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="next" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>`;

                paginationHtml += '</ul>';
                paginationContainer.innerHTML = paginationHtml;
            }

            let debounceTimer;

            // [DIGANTI] Fungsi filterProducts diganti menjadi updateProductDisplay
            function updateProductDisplay() {
                // 1. Ambil Nilai Filter
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const categoryId = document.getElementById('categoryFilter').value;
                const subcategory = document.getElementById('subcategoryFilter').value;
                const brand = document.getElementById('brandFilter').value;
                const sortBy = document.getElementById('sortFilter').value;
                const priceFilter = document.getElementById('priceFilter').options[document.getElementById(
                    'priceFilter').selectedIndex];
                const priceMin = parseFloat(priceFilter.dataset.min) || null;
                const priceMax = parseFloat(priceFilter.dataset.max) || null;

                // 2. Filter Data
                let filtered = allProductsData.filter(p =>
                    (!searchTerm || p.name.toLowerCase().includes(searchTerm) || p.brand.toLowerCase().includes(
                        searchTerm)) &&
                    (!categoryId || p.category_id == categoryId) &&
                    (!subcategory || p.subcategory === subcategory) &&
                    (!brand || p.brand === brand) &&
                    (!priceMin || p.price >= priceMin) &&
                    (!priceMax || p.price <= priceMax)
                );

                // 3. Sortir Data
                filtered.sort((a, b) => {
                    switch (sortBy) {
                        case 'price_low':
                            return a.price - b.price;
                        case 'price_high':
                            return b.price - a.price;
                        case 'name':
                            return a.name.localeCompare(b.name);
                        default:
                            // Asumsi 'newest'
                            // Jika ada ID, gunakan b.id - a.id. Jika tidak, gunakan index.
                            // Kita asumsikan data dummy sudah urut terbaru
                            return 0;
                    }
                });

                // 4. [BARU] Render Pagination berdasarkan total produk *yang difilter*
                renderPagination(filtered.length);

                // 5. [BARU] Slice/Potong array untuk halaman saat ini
                const startIndex = (currentPage - 1) * productsPerPage;
                const paginatedProducts = filtered.slice(startIndex, startIndex + productsPerPage);

                // 6. Tampilkan produk yang sudah dipaginasi
                displayProducts(paginatedProducts);
            }

            window.resetFilters = function() {
                document.querySelectorAll('.filter-control').forEach(el => el.selectedIndex = 0);
                document.getElementById('searchInput').value = '';
                currentPage = 1; // [BARU] Reset ke halaman 1
                updateProductDisplay(); // [DIGANTI] Panggil fungsi baru
            }

            // [DIGANTI] setupEventListeners diperbarui
            function setupEventListeners() {
                // Listener untuk Kontrol Filter
                document.querySelectorAll('.filter-control').forEach(c => c.addEventListener('change', () => {
                    currentPage = 1; // [BARU] Reset ke halaman 1
                    updateProductDisplay(); // [DIGANTI] Panggil fungsi baru
                }));

                // Listener untuk Input Search (dengan debounce)
                document.getElementById('searchInput').addEventListener('input', () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        currentPage = 1; // [BARU] Reset ke halaman 1
                        updateProductDisplay(); // [DIGANTI] Panggil fungsi baru
                    }, 300);
                });

                // Listener untuk Klik "Related Product" di Modal
                document.getElementById('related-products-container').addEventListener('click', function(e) {
                    const card = e.target.closest('.related-product-card');
                    if (card) {
                        const productId = parseInt(card.dataset.productId, 10);
                        const newProduct = allProductsData.find(p => p.id === productId);
                        if (newProduct) {
                            populateModal(newProduct);
                            // Scroll modal ke atas
                            document.querySelector('#productModal .modal-body').scrollTop = 0;
                        }
                    }
                });

                // [BARU] Event Listener untuk Pagination (AJAX)
                paginationContainer.addEventListener('click', function(e) {
                    const clickedLink = e.target.closest('.page-link');
                    if (!clickedLink) return;

                    e.preventDefault();
                    const pageData = clickedLink.dataset.page;
                    const isDisabled = clickedLink.closest('.page-item.disabled');
                    if (isDisabled) return; // Jangan lakukan apa-apa jika tombol disabled

                    if (pageData === 'prev') {
                        if (currentPage > 1) currentPage--;
                    } else if (pageData === 'next') {
                        // Hitung total halaman dari jumlah tombol angka
                        const totalPages = paginationContainer.querySelectorAll('.page-item').length -
                            2; // Kurangi Prev/Next
                        if (currentPage < totalPages) currentPage++;
                    } else if (pageData) {
                        const pageNum = parseInt(pageData, 10);
                        if (pageNum !== currentPage) currentPage = pageNum;
                    } else {
                        return; // Klik pada link non-aktif
                    }

                    // Panggil fungsi update
                    updateProductDisplay();

                    // Scroll ke atas ke bagian produk
                    const productsSection = document.getElementById('products');
                    if (productsSection) {
                        productsSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            }

            // [BARU] Fungsi untuk mengisi data produk ke modal
            function populateModal(product) {
                // 1. Dapatkan elemen-elemen modal
                const modalBrand = document.getElementById('modalProductBrand');
                const modalName = document.getElementById('modalProductName');
                const modalBadge = document.getElementById('modalProductBadge');
                const modalCategory = document.getElementById('modalProductCategory');
                const modalPrice = document.getElementById('modalProductPrice');
                const modalOldPrice = document.getElementById('modalProductOldPrice');
                const modalDescription = document.getElementById('modalProductDescription');
                const modalSpecs = document.getElementById('modalProductSpecs');
                const modalCarouselInner = document.getElementById('modalCarouselInner');
                const chatButton = document.getElementById('chatButton');
                const relatedContainer = document.getElementById('related-products-container');

                // 2. Isi data dasar
                modalBrand.textContent = product.brand;
                modalName.textContent = product.name;
                modalCategory.textContent = `${product.category} > ${product.subcategory}`;
                modalPrice.textContent = product.price_formatted;
                modalDescription.textContent = product.description;

                // 3. Atur harga lama (jika ada)
                if (product.old_price_formatted) {
                    modalOldPrice.textContent = product.old_price_formatted;
                    modalOldPrice.style.display = 'inline';
                } else {
                    modalOldPrice.style.display = 'none';
                }

                // 4. Atur badge (jika ada)
                if (product.discount_percentage) {
                    modalBadge.textContent = 'PROMO';
                    modalBadge.className = 'badge ms-2 bg-danger'; // Tambah kelas Bootstrap
                    modalBadge.style.display = 'inline';
                } else if (product.is_new) {
                    modalBadge.textContent = 'BARU';
                    modalBadge.className = 'badge ms-2 bg-success'; // Tambah kelas Bootstrap
                    modalBadge.style.display = 'inline';
                } else {
                    modalBadge.style.display = 'none';
                }

                // 5. Isi spesifikasi
                modalSpecs.innerHTML = Object.entries(product.specs).map(([key, value]) =>
                    `<div class="row gx-2"><div class="col-5 col-md-4"><p>${key}</p></div><div class="col-7 col-md-8">: ${value}</div></div>`
                ).join('');

                // 6. Isi carousel gambar
                modalCarouselInner.innerHTML = product.images.map((img, index) =>
                    `<div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img src="${img}" class="d-block w-100" alt="${product.name}" style="aspect-ratio: 1/1; object-fit: cover;">
                    </div>`
                ).join('');

                // 7. Isi produk terkait (3 produk dari kategori yang sama)
                const relatedProducts = allProductsData.filter(p =>
                    p.category_id === product.category_id && p.id !== product.id
                ).slice(0, 3); // Ambil maks 3

                if (relatedProducts.length > 0) {
                    document.getElementById('related-products-section').style.display = 'block';
                    relatedContainer.innerHTML = relatedProducts.map(rp =>
                        `<div class="col-4">
                            <div class="related-product-card" data-product-id="${rp.id}">
                                <img src="${rp.image}" alt="${rp.name}">
                                <div class="related-product-title">${rp.name}</div>
                            </div>
                        </div>`
                    ).join('');
                } else {
                    document.getElementById('related-products-section').style.display = 'none';
                }


                // 8. Atur tombol chat
                chatButton.href =
                    `https://wa.me/6281572505989?text=Hai,%20saya%20tertarik%20dengan%20produk%20${encodeURIComponent(product.name)}`;
            }


            function setupProductCardListeners() {
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const product = allProductsData.find(p => p.id == this.dataset.productId);
                        if (product) {
                            populateModal(product);
                            productModal.show();
                        }
                    });
                });
            }

            function populateFilters() {
                const catFilter = document.getElementById('categoryFilter');
                catFilter.innerHTML += dummyCategories.map(c => `<option value="${c.id}">${c.name}</option>`).join(
                    '');

                const subcatFilter = document.getElementById('subcategoryFilter');
                const subcategories = [...new Set(allProductsData.map(p => p.subcategory))].sort();
                subcatFilter.innerHTML += subcategories.map(s => `<option value="${s}">${s}</option>`).join('');

                const brandFilter = document.getElementById('brandFilter');
                brandFilter.innerHTML += [...new Set(allProductsData.map(p => p.brand))].sort().map(b =>
                    `<option value="${b}">${b}</option>`).join('');
            }

            // --- INITIALIZATION ---
            populateBanners();
            populateSwiper('promoProductsSwiper', promoProducts);

            new Swiper('.promo-swiper', {
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

            populateFilters();
            // filterProducts(); // [DIGANTI]
            updateProductDisplay(); // [DIGANTI] Panggil fungsi baru saat inisialisasi
            setupEventListeners();
        });
    </script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-kosmetik',
    ])


</body>

</html>
