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

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
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

        .featured-products-section {
            background-color: var(--white-bg);
        }

        .search-filter-section,
        .products-content-section {
            background-color: transparent;
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
        }

        .product-brand {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-title {
            font-family: var(--font-primary);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            flex-grow: 1;
            line-height: 1.3;
        }

        .product-category {
            font-size: 0.75rem;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.75rem;
        }

        .current-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .old-price {
            font-size: 0.9rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 5px;
        }

        .badge-new,
        .badge-promo {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 10;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-new {
            background-color: #4CAF50;
        }

        .badge-promo {
            background-color: #FF5252;
        }

        .footer {
            background-color: var(--rose-gold-color);
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-radius: 15px 0 0 15px;
        }

        .modal-dialog.modal-lg .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }

        .modal-body {
            padding: 0;
            position: relative;
        }

        .modal-body .btn-close {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 0.5rem;
            opacity: 1;
        }

        .modal-carousel-image {
            max-height: 400px;
            object-fit: contain;
        }

        .modal-details-col {
            padding: 2rem;
        }

        #modalProductBrand {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.3rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive Grid untuk Mobile */
        @media (max-width: 576px) {
            #productsGrid .col-md-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .product-image-container {
                height: 180px;
            }

            .product-info {
                padding: 1rem;
            }

            .product-title {
                font-size: 0.95rem;
            }

            .current-price {
                font-size: 1.1rem;
            }
        }

        /* Filter Controls Responsive */
        @media (max-width: 991px) {
            .search-filter-section .row>div {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="https://via.placeholder.com/45x45/E6397A/FFFFFF?text=CS" alt="Logo"
                    class="brand-logo me-2">
                <span class="brand-text">Canu Cosmetics</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" id="heroCarouselIndicators"></div>
            <div class="carousel-inner" id="heroCarouselInner"></div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="featured-products-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Produk Unggulan</h2>
                    <p class="section-subtitle">Produk pilihan terbaik yang paling diminati</p>
                </div>
            </div>
            <div class="swiper-container featured-swiper">
                <div class="swiper-wrapper" id="featuredProductsSwiper">
                </div>
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
            <div class="row align-items-center g-3 mt-3">
                <div class="col-lg-3 col-md-12">
                    <input type="text" id="searchInput" class="form-control filter-control"
                        placeholder="Cari produk, brand...">
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <select id="categoryFilter" class="form-select filter-control">
                        <option value="">Semua Kategori</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <select id="brandFilter" class="form-select filter-control">
                        <option value="">Semua Brand</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <select id="priceFilter" class="form-select filter-control">
                        <option value="">Semua Harga</option>
                        <option data-min="0" data-max="100000">&lt; Rp 100.000</option>
                        <option data-min="100000" data-max="300000">Rp 100.000 - 300.000</option>
                        <option data-min="300000" data-max="500000">Rp 300.000 - 500.000</option>
                        <option data-min="500000" data-max=""> &gt; Rp 500.000</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <select id="sortFilter" class="form-select filter-control">
                        <option value="default">Default</option>
                        <option value="newest">Terbaru</option>
                        <option value="price_low">Harga Terendah</option>
                        <option value="price_high">Harga Tertinggi</option>
                        <option value="name">Nama A-Z</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-4 col-12">
                    <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">Reset</button>
                </div>
            </div>
        </div>
    </section>

    <section class="products-content-section pt-4 pb-5">
        <div class="container">
            <div class="row g-4" id="productsGrid">
            </div>
        </div>
    </section>

    <footer id="contact" class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <img src="https://via.placeholder.com/150x50/E6397A/FFFFFF?text=CanuCosmetics" alt="KatalogQu"
                            class="footer-logo mb-3" width="150" height="auto"
                            style="border-radius:10px; background: white; padding: 10px;">
                        <p class="footer-description">Katalog digital khusus untuk produk kosmetik dan kecantikan.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 mb-4 footer-contact-section">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="contact-info">
                        <p class="contact-address">Jl. Demo Raya No.123<br>Kota Fiktif, Negara Imajinasi</p>
                        <p class="contact-email">info@canucosmetics.com</p>
                        <p class="contact-phone">08123456789</p>
                        <div class="social-links mt-3">
                            <a href="#" target="_blank" class="social-link"><i
                                    class="fab fa-facebook"></i></a>
                            <a href="#" target="_blank" class="social-link"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="mb-0 small text-white">&copy; 2025 Canu Cosmetics. Powered by PT. Era Cipta Digital.</p>
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
                                <div class="carousel-inner" id="modalCarouselInner"></div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#modalCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
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
                            <h5>Deskripsi</h5>
                            <p id="modalProductDescription">Deskripsi produk...</p>
                            <h5>Spesifikasi</h5>
                            <div id="modalProductSpecs"></div>
                            <div class="d-grid mt-4">
                                <a id="chatButton" href="#" target="_blank" class="btn btn-success btn-lg">
                                    <i class="fab fa-whatsapp me-2"></i> Chat Toko
                                </a>
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
                    image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=1920&q=80",
                    link: "#products",
                    button_text: "Lihat Koleksi"
                },
                {
                    title: "Skincare Revolusioner",
                    subtitle: "Formula inovatif untuk kulit sehat dan bercahaya",
                    image: "https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?auto=format&fit=crop&w=1920&q=80",
                    link: "#products",
                    button_text: "Jelajahi Skincare"
                },
                {
                    title: "Sentuhan Glamor Setiap Hari",
                    subtitle: "Makeup berkualitas tinggi untuk tampilan memukau",
                    image: "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=1920&q=80",
                    link: "#products",
                    button_text: "Belanja Makeup"
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
                    description: "Serum yang menghidrasi secara mendalam untuk kulit kering.",
                    specs: {
                        Volume: "30ml",
                        Bahan: "Hyaluronic Acid"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1629198688000-71f2747c9773?auto=format&fit=crop&w=700&q=80"
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
                    description: "Lipstick matte dengan warna merah intens.",
                    specs: {
                        Warna: "Merah",
                        Finish: "Matte"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1590740685974-98c5666f7f2b?auto=format&fit=crop&w=700&q=80"
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
                    description: "Foundation ringan dengan hasil akhir bercahaya.",
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
                    description: "Palet eyeshadow dengan warna nude serbaguna.",
                    specs: {
                        JumlahShade: "12",
                        Finish: "Matte, Shimmer"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1512496015822-eae5d5ac2956?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 5,
                    name: "Volume Mascara",
                    brand: "Canu Glow",
                    category_id: 2,
                    subcategory: "Mascara",
                    price: 95000,
                    old_price: null,
                    description: "Mascara yang memberikan volume ekstrem.",
                    specs: {
                        Warna: "Hitam",
                        Efek: "Volume"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1588673759367-93e8701e6997?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
                    discount_percentage: null
                },
                {
                    id: 6,
                    name: "Cream Blush (Pink)",
                    brand: "Aura Beauty",
                    category_id: 2,
                    subcategory: "Blush On",
                    price: 75000,
                    old_price: null,
                    description: "Blush krim dengan warna pink alami.",
                    specs: {
                        Warna: "Pink",
                        Tekstur: "Krim"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1599818816766-31976a4401c1?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: true,
                    discount_percentage: null
                },
                {
                    id: 7,
                    name: "Liquid Highlighter",
                    brand: "Canu Glow",
                    category_id: 2,
                    subcategory: "Highlighter",
                    price: 120000,
                    old_price: null,
                    description: "Highlighter cair untuk kilau wajah sempurna.",
                    specs: {
                        Warna: "Champagne",
                        Ukuran: "15ml"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1593529555132-73a7f45c81f1?auto=format&fit=crop&w=700&q=80"
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
                    description: "Parfum dengan aroma floral mewah.",
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
                    id: 9,
                    name: "Anti-Aging Cream",
                    brand: "Ethereal Skin",
                    category_id: 1,
                    subcategory: "Pelembab Wajah",
                    price: 320000,
                    old_price: null,
                    description: "Krim anti-penuaan untuk mengurangi kerutan.",
                    specs: {
                        Volume: "50g",
                        BahanAktif: "Retinol"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1606703554653-e99d6c3427f7?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: true,
                    discount_percentage: null
                },
                {
                    id: 10,
                    name: "Compact Powder",
                    brand: "Aura Beauty",
                    category_id: 2,
                    subcategory: "Bedak Padat",
                    price: 110000,
                    old_price: 130000,
                    description: "Bedak padat untuk hasil akhir matte.",
                    specs: {
                        Shade: "Natural",
                        Finish: "Matte"
                    },
                    images: [
                        "https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=700&q=80"
                    ],
                    is_new: false,
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

            const featuredProducts = allProductsData.filter(p => p.discount_percentage || p.id % 4 === 0).slice(0,
                8);
            const productModal = new bootstrap.Modal(document.getElementById('productModal'));
            const storePhoneNumber = "628123456789";

            function populateBanners() {
                const indicators = document.getElementById('heroCarouselIndicators');
                const inner = document.getElementById('heroCarouselInner');
                indicators.innerHTML = dummyBanners.map((_, i) =>
                    `<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="${i}" class="${i === 0 ? 'active' : ''}"></button>`
                ).join('');
                inner.innerHTML = dummyBanners.map((b, i) => `
                    <div class="carousel-item ${i === 0 ? 'active' : ''}">
                        <div class="hero-slide">
                            <img src="${b.image}" alt="${b.title}" class="hero-background">
                            <div class="container">
                                <div class="hero-content">
                                    <h1 class="hero-title">${b.title}</h1>
                                    <p class="hero-subtitle">${b.subtitle}</p>
                                    <a href="${b.link}" class="btn btn-primary mt-3">${b.button_text}</a>
                                </div>
                            </div>
                        </div>
                    </div>`).join('');
            }

            function populateSwiper(containerId, products) {
                const swiperContainer = document.getElementById(containerId);
                swiperContainer.innerHTML = products.map(product => `
                    <div class="swiper-slide h-100 pb-3">${createProductCardHtml(product)}</div>
                `).join('');
            }

            function createProductCardHtml(product) {
                let badgeHtml = '';
                if (product.discount_percentage) {
                    badgeHtml = `<div class="badge-promo">Promo</div>`;
                } else if (product.is_new) {
                    badgeHtml = `<div class="badge-new">Baru</div>`;
                }

                return `
                    <div class="product-card" data-product-id="${product.id}">
                        ${badgeHtml}
                        <div class="product-image-container">
                            <img src="${product.image}" alt="${product.name}" class="product-image">
                        </div>
                        <div class="product-info">
                            <p class="product-brand">${product.brand}</p>
                            <h5 class="product-title">${product.name}</h5>
                            <p class="product-category">${product.subcategory}</p>
                            <div class="product-price mt-auto">
                                <span class="current-price">${product.price_formatted}</span>
                                ${product.old_price_formatted ? `<span class="old-price">${product.old_price_formatted}</span>` : ''}
                            </div>
                        </div>
                    </div>`;
            }

            function displayProducts(products) {
                const grid = document.getElementById('productsGrid');
                if (products.length === 0) {
                    grid.innerHTML =
                        `<div class="col-12 text-center py-5"><p class="fs-4 text-muted">Produk tidak ditemukan.</p></div>`;
                    return;
                }
                grid.innerHTML = products.map(p =>
                    `<div class="col-md-4 col-lg-3 col-6">${createProductCardHtml(p)}</div>`).join('');
                setupProductCardListeners();
            }

            function populateModal(product) {
                document.getElementById('modalProductBrand').textContent = product.brand;
                document.getElementById('modalProductName').textContent = product.name;
                document.getElementById('modalProductCategory').textContent =
                    `${product.category} > ${product.subcategory}`;
                document.getElementById('modalProductPrice').textContent = product.price_formatted;

                const oldPriceEl = document.getElementById('modalProductOldPrice');
                oldPriceEl.style.display = product.old_price_formatted ? 'inline' : 'none';
                oldPriceEl.textContent = product.old_price_formatted || '';

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

                document.getElementById('modalProductDescription').innerHTML = product.description ||
                    'Tidak ada deskripsi.';

                const carouselInner = document.getElementById('modalCarouselInner');
                carouselInner.innerHTML = product.images.map((src, i) =>
                    `<div class="carousel-item ${i === 0 ? 'active' : ''}"><img src="${src}" class="d-block w-100 modal-carousel-image" alt="Gambar produk"></div>`
                ).join('');
                new bootstrap.Carousel(document.getElementById('modalCarousel')).to(0);

                const specsContainer = document.getElementById('modalProductSpecs');
                specsContainer.innerHTML = (product.specs && Object.keys(product.specs).length > 0) ?
                    `<ul class="list-unstyled">${Object.entries(product.specs).map(([k, v]) => `<li><strong>${k}:</strong> ${v}</li>`).join('')}</ul>` :
                    '<p>Tidak ada spesifikasi.</p>';

                const message = `Halo, saya tertarik dengan produk "${product.name}".`;
                document.getElementById('chatButton').href =
                    `https://wa.me/${storePhoneNumber}?text=${encodeURIComponent(message)}`;
            }

            let debounceTimer;

            function filterProducts() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const categoryId = document.getElementById('categoryFilter').value;
                const brand = document.getElementById('brandFilter').value;
                const sortBy = document.getElementById('sortFilter').value;
                const priceFilter = document.getElementById('priceFilter').options[document.getElementById(
                    'priceFilter').selectedIndex];
                const priceMin = priceFilter.dataset.min ? parseFloat(priceFilter.dataset.min) : null;
                const priceMax = priceFilter.dataset.max ? parseFloat(priceFilter.dataset.max) : null;

                let filtered = allProductsData.filter(p => {
                    const matchesSearch = !searchTerm || p.name.toLowerCase().includes(searchTerm) || p
                        .brand.toLowerCase().includes(searchTerm);
                    const matchesCategory = !categoryId || p.category_id == categoryId;
                    const matchesBrand = !brand || p.brand === brand;
                    let matchesPrice = true;
                    if (priceMin !== null || priceMax !== null) {
                        matchesPrice = (!priceMin || p.price >= priceMin) && (!priceMax || p.price <
                            priceMax);
                    }
                    return matchesSearch && matchesCategory && matchesBrand && matchesPrice;
                });

                filtered.sort((a, b) => {
                    switch (sortBy) {
                        case 'newest':
                            return b.id - a.id;
                        case 'price_low':
                            return a.price - b.price;
                        case 'price_high':
                            return b.price - a.price;
                        case 'name':
                            return a.name.localeCompare(b.name);
                        default:
                            return 0;
                    }
                });
                displayProducts(filtered);
            }

            window.resetFilters = function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('categoryFilter').value = '';
                document.getElementById('brandFilter').value = '';
                document.getElementById('priceFilter').value = '';
                document.getElementById('sortFilter').value = 'default';
                filterProducts();
            }

            function setupEventListeners() {
                document.querySelectorAll('.filter-control').forEach(control => {
                    control.addEventListener('change', filterProducts);
                    if (control.id === 'searchInput') {
                        control.addEventListener('input', () => {
                            clearTimeout(debounceTimer);
                            debounceTimer = setTimeout(filterProducts, 300);
                        });
                    }
                });
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
                const categoryFilter = document.getElementById('categoryFilter');
                categoryFilter.innerHTML = '<option value="">Semua Kategori</option>' + dummyCategories.map(c =>
                    `<option value="${c.id}">${c.name}</option>`).join('');

                const brandFilter = document.getElementById('brandFilter');
                const brands = [...new Set(allProductsData.map(p => p.brand))];
                brandFilter.innerHTML = '<option value="">Semua Brand</option>' + brands.sort().map(b =>
                    `<option value="${b}">${b}</option>`).join('');
            }

            populateBanners();
            populateSwiper('featuredProductsSwiper', featuredProducts);
            new Swiper('.featured-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 3
                    },
                    1024: {
                        slidesPerView: 4
                    }
                }
            });
            populateFilters();
            filterProducts();
            setupEventListeners();
        });
    </script>
</body>

</html>
