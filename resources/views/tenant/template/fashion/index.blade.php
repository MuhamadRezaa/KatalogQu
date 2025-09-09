<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
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
            <a href="{{ url('/') }}" class="nav-brand">
                <div class="brand-icon">
                    @if ($userStore && $userStore->store_logo)
                        <img class="brand-logo" src="{{ asset('storage/' . $userStore->store_logo) }}"
                            alt="{{ $userStore->store_name ?? 'Store Logo' }}" loading="lazy" decoding="async">
                    @else
                        <img class="brand-logo" src="{{ asset('assets/demo/fashion/img/temp/logo-fashion.png') }}"
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
    </style>

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
                @foreach ($categories as $category)
                    <div class="category-card" data-category-id="{{ $category->id }}">
                        <div class="category-name">{{ $category->name }}</div>
                        <div class="category-description">{{ $category->description }}</div>
                    </div>
                @endforeach
            </div>

            {{-- PERBAIKAN: Bagian Sub Kategori dikosongkan, akan diisi oleh JavaScript --}}
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
                    <div class="footer-brand-container">
                        @if ($userStore && $userStore->store_logo)
                            <img class="footer-logo" src="{{ asset('storage/' . $userStore->store_logo) }}"
                                alt="{{ $userStore->store_name ?? 'Store Logo' }}" loading="lazy" decoding="async">
                        @else
                            <img class="footer-logo"
                                src="{{ asset('assets/demo/fashion/img/temp/logo-fashion.png') }}"
                                alt="{{ $userStore->store_name ?? 'Fashion Store Logo' }}" loading="lazy"
                                decoding="async">
                        @endif
                    </div>
                </div>
                <div class="footer-section footer-text-content">
                    <h3>{{ $userStore->store_name ?? 'Fashion Store' }}</h3>
                    <p>{{ $userStore->store_description ?? 'A place to find your best fashion.' }}</p>
                </div>
            </div>
            <div class="footer-middle-space">
            </div>
            <div class="footer-section footer-contact">
                <h3>Informasi Kontak</h3>
                <div class="contact-item">
                    <i class="contact-icon">📞</i>
                    <span>{{ $userStore->store_phone ?? 'Nomor Telepon Tidak Tersedia' }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">✉️</i>
                    <span>{{ $userStore->store_email ?? 'Alamat Email Tidak Tersedia' }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">📍</i>
                    <span>{{ $userStore->store_address ?? 'Alamat Tidak Tersedia' }}</span>
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
    </style>

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

    <script>
        // Data dari Blade disiapkan untuk JavaScript
        const allCategories = @json($categories);
        const allSubcategories = @json($subCategories);
        const initialProducts = @json($products->items());
        const ASSET_URL = "{{ asset('storage/') }}";

        document.addEventListener('DOMContentLoaded', () => {
            // State (status) saat ini untuk filter
            let currentCategory = 'all';
            let currentSubcategory = null;

            // Elemen-elemen penting
            const categoryCards = document.querySelectorAll('.category-card');
            const subcategorySection = document.getElementById('subcategorySection');
            const subcategoryGrid = document.getElementById('subcategoryGrid');
            const productsGrid = document.getElementById('productsGrid');
            const noResultsDiv = document.getElementById('noResults');

            // --- FUNGSI-FUNGSI UTAMA ---

            // Fungsi untuk menampilkan subkategori yang relevan
            function showSubcategoriesForCategory(categoryId) {
                subcategoryGrid.innerHTML = ''; // Selalu kosongkan dulu

                let relevantSubcategories = [];
                if (categoryId === 'all') {
                    // Jika pilih "Semua Produk", tampilkan SEMUA subkategori
                    relevantSubcategories = allSubcategories;
                } else {
                    // Jika pilih kategori spesifik, filter subkategori berdasarkan product_category_id
                    relevantSubcategories = allSubcategories.filter(sub => sub.product_category_id == categoryId);
                }

                // Jika tidak ada subkategori yang relevan, sembunyikan bagian ini
                if (relevantSubcategories.length === 0) {
                    hideSubcategories();
                    return;
                }

                // Buat kartu "Semua Sub Kategori"
                const allSubCard = document.createElement('div');
                allSubCard.className = 'subcategory-card active';
                allSubCard.innerHTML = `<div class="subcategory-name">Semua Sub Kategori</div>`;
                allSubCard.onclick = () => selectSubcategory(null, allSubCard);
                subcategoryGrid.appendChild(allSubCard);

                // Buat kartu untuk setiap subkategori yang relevan
                relevantSubcategories.forEach(sub => {
                    const subCard = document.createElement('div');
                    subCard.className = 'subcategory-card';
                    subCard.dataset.subcategoryId = sub.id;
                    subCard.innerHTML = `
                        <div class="subcategory-name">${sub.name}</div>
                        <div class="subcategory-description">${sub.description || ''}</div>
                    `;
                    subCard.onclick = () => selectSubcategory(sub.id, subCard);
                    subcategoryGrid.appendChild(subCard);
                });

                subcategorySection.style.display = 'block'; // Tampilkan bagian subkategori
            }

            // Fungsi untuk menyembunyikan bagian subkategori
            function hideSubcategories() {
                subcategorySection.style.display = 'none';
            }

            // Fungsi yang dijalankan saat subkategori dipilih
            function selectSubcategory(subcategoryId, element) {
                currentSubcategory = subcategoryId;
                document.querySelectorAll('.subcategory-card').forEach(card => card.classList.remove('active'));
                element.classList.add('active');
                filterAndRenderProducts(); // Filter ulang produk
            }

            // Fungsi utama untuk filter dan render produk
            function filterAndRenderProducts() {
                let filtered = initialProducts;

                // 1. Filter berdasarkan Kategori Utama
                if (currentCategory !== 'all') {
                    filtered = filtered.filter(p => p.product_category_id == currentCategory);
                }

                // 2. Filter berdasarkan Sub Kategori
                if (currentSubcategory !== null) {
                    filtered = filtered.filter(p => p.sub_category_id == currentSubcategory);
                }

                // 3. Filter berdasarkan Pencarian
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                if (searchTerm) {
                    filtered = filtered.filter(p =>
                        p.name.toLowerCase().includes(searchTerm) ||
                        (p.description && p.description.toLowerCase().includes(searchTerm)) ||
                        (p.sku && p.sku.toLowerCase().includes(searchTerm))
                    );
                }

                // 4. Urutkan Harga
                const sortPrice = document.getElementById('sortPrice').value;
                if (sortPrice === 'low-high') {
                    filtered.sort((a, b) => a.price - b.price);
                } else if (sortPrice === 'high-low') {
                    filtered.sort((a, b) => b.price - a.price);
                }

                // 5. Urutkan Nama
                const sortName = document.getElementById('sortName').value;
                if (sortName === 'a-z') {
                    filtered.sort((a, b) => a.name.localeCompare(b.name));
                } else if (sortName === 'z-a') {
                    filtered.sort((a, b) => b.name.localeCompare(a.name));
                }

                // 6. Urutkan Tanggal
                const sortDate = document.getElementById('sortDate').value;
                if (sortDate === 'newest') {
                    filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                } else if (sortDate === 'oldest') {
                    filtered.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                }

                renderProducts(filtered);
            }

            // Fungsi untuk render kartu produk ke HTML
            function renderProducts(products) {
                productsGrid.innerHTML = '';
                noResultsDiv.style.display = products.length === 0 ? 'block' : 'none';

                products.forEach(product => {
                    const imageUrl = product.image ? `${ASSET_URL}/${product.image}` :
                        'https://via.placeholder.com/200?text=No+Image';
                    const formattedPrice = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(product.price);

                    const productCard = document.createElement('div');
                    productCard.className = 'product-card';
                    productCard.dataset.productId = product.id;
                    productCard.onclick = () => showProductDetails(product.id);

                    productCard.innerHTML = `
                        <div class="product-image">
                            <img src="${imageUrl}" alt="${product.name}" loading="lazy">
                        </div>
                        <div class="product-info">
                            <div class="product-category">${product.category ? product.category.name : ''}</div>
                            <div class="product-name">${product.name}</div>
                            <div class="product-price">${formattedPrice}</div>
                        </div>
                    `;
                    productsGrid.appendChild(productCard);
                });
            }

            // --- EVENT LISTENERS ---

            // Klik pada kartu kategori utama
            categoryCards.forEach(card => {
                card.addEventListener('click', function() {
                    document.querySelectorAll('.category-card').forEach(c => c.classList.remove(
                        'active'));
                    this.classList.add('active');

                    currentCategory = this.dataset.categoryId;
                    currentSubcategory = null; // Reset subkategori

                    showSubcategoriesForCategory(currentCategory);
                    filterAndRenderProducts();
                });
            });

            // Input pada filter
            document.getElementById('searchInput').addEventListener('input', filterAndRenderProducts);
            document.getElementById('sortPrice').addEventListener('change', filterAndRenderProducts);
            document.getElementById('sortName').addEventListener('change', filterAndRenderProducts);
            document.getElementById('sortDate').addEventListener('change', filterAndRenderProducts);

            // --- INISIALISASI ---
            hideSubcategories();
            filterAndRenderProducts(); // Render produk awal saat halaman dimuat
        });
    </script>

    {{-- Sisanya adalah script untuk slider dan modal --}}
    <script>
        const productModal = document.getElementById('productModal');
        const modalContent = document.getElementById('modalContent');

        function showProductDetails(productId) {
            const product = initialProducts.find(p => p.id === productId);
            if (!product) return;

            const imageUrl = product.image ? `${ASSET_URL}/${product.image}` :
                'https://via.placeholder.com/200?text=No+Image';
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(product.price);

            const material = product.specification?.material || '';
            const sizes = product.specification?.sizes || [];
            const colors = product.specification?.colors || [];

            modalContent.innerHTML = `
                <div class="modal-product-details">
                    <div class="modal-product-image">
                        <img src="${imageUrl}" alt="${product.name}">
                    </div>
                    <div class="modal-product-info">
                        <h2 class="modal-product-name">${product.name}</h2>
                        <div class="modal-product-price">${formattedPrice}</div>
                        <div class="modal-product-description">
                            <h4>Deskripsi:</h4>
                            <p>${product.description || 'Tidak ada deskripsi.'}</p>
                        </div>
                        ${material ? `<div class="modal-section"><h4>Material:</h4><p>${material}</p></div>` : ''}
                        ${sizes.length > 0 ? `<div class="modal-section"><h4>Ukuran:</h4><div class="sizes-list">${sizes.map(s => `<span class="size-tag">${s}</span>`).join('')}</div></div>` : ''}
                        ${colors.length > 0 ? `<div class="modal-section"><h4>Warna:</h4><div class="colors-list">${colors.map(c => `<span class="color-tag">${c}</span>`).join('')}</div></div>` : ''}
                    </div>
                </div>
            `;

            productModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        document.querySelector('.modal-close').addEventListener('click', () => {
            productModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        window.addEventListener('click', (event) => {
            if (event.target == productModal) {
                productModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Hero Slider Script
        document.addEventListener('DOMContentLoaded', () => {
            const sliderWrapper = document.getElementById('slider-wrapper');
            const prevBtn = document.querySelector('.slider-nav.prev');
            const nextBtn = document.querySelector('.slider-nav.next');
            const indicatorsContainer = document.getElementById('slider-indicators');
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;
            let currentIndex = 0;
            let slideInterval;

            function updateSlider() {
                const offset = -currentIndex * 100;
                sliderWrapper.style.transform = `translateX(${offset}%)`;

                const indicators = document.querySelectorAll('.slider-indicator');
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentIndex);
                });
            }

            function goToNextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }

            function startAutoplay() {
                slideInterval = setInterval(goToNextSlide, 5000);
            }

            function stopAutoplay() {
                clearInterval(slideInterval);
            }

            nextBtn.addEventListener('click', () => {
                stopAutoplay();
                goToNextSlide();
                startAutoplay();
            });

            prevBtn.addEventListener('click', () => {
                stopAutoplay();
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider();
                startAutoplay();
            });

            startAutoplay();
        });
    </script>

</body>

</html>
