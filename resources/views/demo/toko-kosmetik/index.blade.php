<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Canu Cosmetics - E-Katalog Premium</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-kosmetik/style.css') }}">
</head>

<body>
    <!-- Loading Screen -->
    {{-- <div class="loading-screen" id="loadingScreen">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <h3>Canu Cosmetics</h3>
            <p>Memuat koleksi kecantikan premium...</p>
        </div>
    </div> --}}

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <div class="brand-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <span class="brand-text">Canu Cosmetics</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero-slide">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="hero-content">
                                        <h1 class="hero-title">Temukan Kecantikan Sejati Anda</h1>
                                        <p class="hero-subtitle">Koleksi kosmetik premium untuk wanita modern yang
                                            percaya diri</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="hero-image">
                                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                            alt="Cosmetics Collection" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="hero-slide slide-2">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="hero-content">
                                        <h1 class="hero-title">Skincare Revolusioner</h1>
                                        <p class="hero-subtitle">Formula inovatif untuk kulit sehat dan bercahaya</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="hero-image">
                                        <img src="https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                            alt="Skincare Products" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="hero-slide slide-3">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="hero-image">
                                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                            alt="Makeup Collection" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <section class="category-section py-5">
        <div class="text-center">
            <h2 class="section-title">Kategori Produk</h2>
            <p class="section-subtitle">Pilih kategori produk yang sesuai dengan selera Anda</p>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="search-filter-section py-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 mb-3">
                    <div class="search-box">
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Cari produk kosmetik...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
                <div class="col-lg-2 mb-3">
                    <select id="priceFilter" class="form-select">
                        <option value="all">Semua Harga</option>
                        <option value="0-100000">
                            < Rp 100.000</option>
                        <option value="100000-300000">Rp 100.000 - 300.000</option>
                        <option value="300000-500000">Rp 300.000 - 500.000</option>
                        <option value="500000+"> > Rp 500.000</option>
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <select id="sortFilter" class="form-select">
                        <option value="name">Nama A-Z</option>
                        <option value="price-low">Harga Terendah</option>
                        <option value="price-high">Harga Tertinggi</option>
                        <option value="rating">Rating Tertinggi</option>
                    </select>
                </div>
                <div class="col-lg-2 mb-3">
                    <button class="btn btn-outline-secondary w-100" onclick="clearAllFilters()">
                        <i class="fas fa-times"></i> Reset
                    </button>
                </div>
            </div>

            <div class="filter-results">
                <span id="productsCount">36 produk tersedia</span>
            </div>
        </div>
    </section>

    <!-- Products Content Section -->
    <section id="products" class="products-content-section py-5">
        <div class="container">

            <!-- Category Filter Buttons -->
            <div class="category-filters mb-4">
                <button class="category-btn active" data-category="all" onclick="filterByCategory('all')">
                    <i class="fas fa-th-large"></i>
                    Semua Produk
                    <span class="count">36</span>
                </button>
                <button class="category-btn" data-category="skincare" onclick="filterByCategory('skincare')">
                    <i class="fas fa-leaf"></i>
                    Skincare
                    <span class="count">8</span>
                </button>
                <button class="category-btn" data-category="lipstick" onclick="filterByCategory('lipstick')">
                    <i class="fas fa-kiss"></i>
                    Lipstick
                    <span class="count">2</span>
                </button>
                <button class="category-btn" data-category="foundation" onclick="filterByCategory('foundation')">
                    <i class="fas fa-palette"></i>
                    Foundation
                    <span class="count">3</span>
                </button>
                <button class="category-btn" data-category="eyeshadow" onclick="filterByCategory('eyeshadow')">
                    <i class="fas fa-eye"></i>
                    Eyeshadow
                    <span class="count">1</span>
                </button>
                <button class="category-btn" data-category="mascara" onclick="filterByCategory('mascara')">
                    <i class="fas fa-eye"></i>
                    Mascara
                    <span class="count">1</span>
                </button>
                <button class="category-btn" data-category="blush" onclick="filterByCategory('blush')">
                    <i class="fas fa-heart"></i>
                    Blush
                    <span class="count">1</span>
                </button>
                <button class="category-btn" data-category="highlighter" onclick="filterByCategory('highlighter')">
                    <i class="fas fa-star"></i>
                    Highlighter
                    <span class="count">1</span>
                </button>
                <button class="category-btn" data-category="fragrance" onclick="filterByCategory('fragrance')">
                    <i class="fas fa-spray-can"></i>
                    Fragrance
                    <span class="count">3</span>
                </button>
                <button class="category-btn" data-category="haircare" onclick="filterByCategory('haircare')">
                    <i class="fas fa-cut"></i>
                    Hair Care
                    <span class="count">4</span>
                </button>
                <button class="category-btn" data-category="bodycare" onclick="filterByCategory('bodycare')">
                    <i class="fas fa-hand-holding-heart"></i>
                    Body Care
                    <span class="count">3</span>
                </button>
                <button class="category-btn" data-category="nailcare" onclick="filterByCategory('nailcare')">
                    <i class="fas fa-hand-paper"></i>
                    Nail Care
                    <span class="count">3</span>
                </button>
                <button class="category-btn" data-category="tools" onclick="filterByCategory('tools')">
                    <i class="fas fa-tools"></i>
                    Tools & Accessories
                    <span class="count">3</span>
                </button>
            </div>

            <div class="row" id="productsGrid">
                <!-- Products will be populated by JavaScript -->
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-primary" id="loadMoreBtn" onclick="loadMoreProducts()">Muat Lebih
                    Banyak</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer py-4">
        <div class="container">
            <div class="row">
                <!-- Logo Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogQu"
                            class="footer-logo mb-3" width="150" height="auto">
                        <p class="footer-description">Katalog digital khusus untuk produk kosmetik dan kecantikan.
                            Temukan berbagai produk skincare, makeup, dan perawatan kecantikan terbaik.</p>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="col-lg-8 col-md-6 mb-4 footer-contact-section">
                    <h5 class="footer-title">Contact</h5>
                    <div class="contact-info">
                        <p class="contact-address">Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV<br>
                            No.172 Kompleks, Asam Kumbang, Kec. Medan<br>
                            Selayung, Kota Medan, Sumatera Utara 20133</p>
                        <p class="contact-email">pteraciptadigital@gmail.com</p>
                        <p class="contact-phone">08123456789</p>

                        <!-- Social Media -->
                        <div class="social-links mt-3">
                            <a href="https://www.facebook.com/people/PT-Era-Cipta-Digital/61571510908596/"
                                target="_blank" class="social-link"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/eracipta.digital/" target="_blank"
                                class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="https://pteraciptadigital.id/news" target="_blank" class="social-link"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="https://www.youtube.com/watch?v=lLnvxPIqDp8" target="_blank"
                                class="social-link"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row mt-4 pt-4 border-top">
                <div class="col-12 text-center">
                    <p class="mb-0 small text-white">&copy; 2025 PT. Era Cipta Digital.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Modal content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pencarian Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="modalSearchInput"
                        placeholder="Ketik nama produk...">
                    <div id="searchResults" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/demo/toko-kosmetik/script.js') }}"></script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-kosmetik',
    ])

</body>

</html>
