<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'E-Katalog Fashion' }}</title>

    <meta name="description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta name="keywords" content="fashion, clothing, style, trends, catalog, online shopping, apparel, accessories">
    <meta name="author" content="Fashion E-Catalog Demo">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Fashion E-Catalog Demo">
    <meta property="og:description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/og-image.jpg">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/demo/fashion/style.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <div class="brand-icon">
                    <div class="icon-inner"></div>
                </div>
                <span class="brand-text">Fashion E-Catalog</span>
            </a>
            <div class="nav-actions">
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="slider-container" id="slider-container">
            <div class="slider-wrapper" id="slider-wrapper">
                <div class="slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
                <div class="slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
                <div class="slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
            </div>
        </div>

        <button class="slider-nav prev">
            <svg viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
        </button>
        <button class="slider-nav next">
            <svg viewBox="0 0 24 24">
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
            </svg>
        </button>

        <div class="slider-indicators" id="slider-indicators">
            <div class="slider-indicator active"></div>
            <div class="slider-indicator"></div>
            <div class="slider-indicator"></div>
        </div>

        <div class="hero-content">
            <div class="hero-tagline">Temukan Gaya Anda</div>
            <h1 class="hero-title">Katalog Fashion</h1>
            <p class="hero-subtitle">Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti</p>
        </div>
    </section>

    <main class="container">
        <section class="section">
            <div class="section-title">
                <h2>Kategori</h2>
                <p>Pilih kategori produk yang Anda inginkan</p>
            </div>

            <div class="category-grid" id="categoryGrid">
                <div class="category-card active" data-category-id="all">
                    <div class="category-name">Semua Produk</div>
                    <div class="category-description">Lihat semua produk yang tersedia</div>
                </div>
                <div class="category-card" data-category-id="new">
                    <div class="category-name">New Item</div>
                    <div class="category-description">Produk terbaru dalam koleksi kami</div>
                </div>
            </div>

            <div class="subcategory-section" id="subcategorySection" style="display: none;">
                <div class="section-title">
                    <h3>Sub Kategori</h3>
                    <p>Pilih sub kategori untuk filter lebih spesifik</p>
                </div>
                <div class="subcategory-grid" id="subcategoryGrid">
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
                <h2>Semua Produk</h2>
                <p>Jelajahi koleksi lengkap kami</p>
            </div>

            <div class="products-grid" id="productsGrid">
            </div>

            <div id="noResults" class="no-results" style="display: none;">
                <h3>Produk yang Anda cari tidak ditemukan</h3>
                <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left-content">
                <div class="footer-logo-section">
                    <div class="footer-brand-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 5L25 15H35L27.5 22.5L30 32.5L20 27.5L10 32.5L12.5 22.5L5 15H15L20 5Z"
                                fill="white" opacity="0.9" />
                        </svg>
                    </div>
                </div>
                <div class="footer-section footer-text-content">
                    <h3>Fashion E-Catalog</h3>
                    <p>Temukan koleksi fashion terbaru dan terbaik untuk gaya hidup Anda.</p>
                </div>
            </div>
            <div class="footer-middle-space">
            </div>
            <div class="footer-section footer-contact">
                <h3>Informasi Kontak</h3>
                <div class="contact-item">
                    <i class="contact-icon">📞</i>
                    <span>+62 123 456 789</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">✉️</i>
                    <span>info@fashioncatalog.com</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">📍</i>
                    <span>Jakarta, Indonesia</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Powered by PT. Era Cipta Digital</p>
        </div>
    </footer>

    <div id="productModal" class="product-modal">
        <div class="modal-container">
            <span class="modal-close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <p>Memuat data...</p>
    </div>

</body>

</html>
