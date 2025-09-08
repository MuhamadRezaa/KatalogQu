<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'Fashion E-Catalog' }}</title>

    <meta name="description"
        content="{{ $userStore->store_description ?? 'Katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini' }}">
    <meta name="keywords" content="fashion, clothing, style, trends, catalog, online shopping, apparel, accessories">
    <meta name="author" content="{{ $userStore->store_name ?? 'Fashion E-Catalog' }}">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="{{ $userStore->store_name ?? 'Fashion E-Catalog' }}">
    <meta property="og:description"
        content="{{ $userStore->store_description ?? 'Katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini' }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('storage/' . $userStore->store_logo) }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/demo/fashion/style.css') }}">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <div class="brand-icon">
                    <div class="icon-inner"></div>
                </div>
                <span class="brand-text">{{ $userStore->store_name ?? 'Fashion E-Catalog' }}</span>
            </a>
            <div class="nav-actions">
                <!-- Navigation actions can be added here -->
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <!-- Slider Container -->
        <div class="slider-container" id="slider-container">
            <div class="slider-wrapper" id="slider-wrapper">
                @forelse ($banners as $index => $banner)
                    <div class="slide"
                        style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ route('tenant.asset', ['path' => $banner->image_url]) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    </div>
                @empty
                    <div class="slide"
                        style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    </div>
                    <div class="slide"
                        style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    </div>
                    <div class="slide"
                        style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Slider Navigation Buttons -->
        <button class="slider-nav prev" onclick="previousSlide()">
            <svg viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
        </button>
        <button class="slider-nav next" onclick="nextSlide()">
            <svg viewBox="0 0 24 24">
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
            </svg>
        </button>

        <!-- Slider Indicators -->
        <div class="slider-indicators" id="slider-indicators">
            @if (count($banners) > 0)
                @foreach ($banners as $index => $banner)
                    <div class="slider-indicator {{ $index == 0 ? 'active' : '' }}"
                        onclick="goToSlide({{ $index }})"></div>
                @endforeach
            @else
                <div class="slider-indicator active" onclick="goToSlide(0)"></div>
                <div class="slider-indicator" onclick="goToSlide(1)"></div>
                <div class="slider-indicator" onclick="goToSlide(2)"></div>
            @endif
        </div>

        <div class="hero-content">
            <div class="hero-tagline">Temukan Gaya Anda</div>
            <h1 class="hero-title">{{ $userStore->store_name ?? 'Katalog Fashion' }}</h1>
            <p class="hero-subtitle">
                {{ $userStore->store_description ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti' }}
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container">
        <!-- Categories Section -->
        <section class="section">
            <div class="section-title">
                <h2>Kategori</h2>
                <p>Pilih kategori produk yang Anda inginkan</p>
            </div>

            <div class="category-grid" id="categoryGrid">
                <div class="category-card active" onclick="filterProducts('all', event)" data-category-id="all">
                    <div class="category-name">Semua Produk</div>
                    <div class="category-description">Lihat semua produk yang tersedia</div>
                </div>
                <div class="category-card" onclick="filterProducts('new', event)" data-category-id="new">
                    <div class="category-name">New Item</div>
                    <div class="category-description">Produk terbaru dalam koleksi kami</div>
                </div>
                <!-- Categories will be loaded dynamically -->
            </div>

            <!-- Subcategory Section -->
            <div class="subcategory-section" id="subcategorySection" style="display: none;">
                <div class="section-title">
                    <h3>Sub Kategori</h3>
                    <p>Pilih sub kategori untuk filter lebih spesifik</p>
                </div>
                <div class="subcategory-grid" id="subcategoryGrid">
                    <!-- Subcategories will be loaded dynamically -->
                </div>
            </div>

            <!-- Search and Filters Section -->
            <div id="searchContainer" class="search-container">
                <div class="search-and-filters-wrapper">
                    <div class="search-wrapper">
                        <input type="text" id="searchInput" placeholder="Cari produk..." onkeyup="searchProducts()">
                    </div>

                    <div class="filters-section">
                        <div class="filter-group">
                            <label for="sortPrice">Urutkan Harga:</label>
                            <select id="sortPrice" onchange="sortProducts(this.value)">
                                <option value="">-- Pilih --</option>
                                <option value="low-high">Harga Terendah</option>
                                <option value="high-low">Harga Tertinggi</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortName">Urutkan Nama:</label>
                            <select id="sortName" onchange="sortProducts(this.value)">
                                <option value="">-- Pilih --</option>
                                <option value="a-z">A - Z</option>
                                <option value="z-a">Z - A</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortDate">Urutkan Tanggal:</label>
                            <select id="sortDate" onchange="sortProducts(this.value)">
                                <option value="">-- Pilih --</option>
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="section">
            <div class="section-title">
                <h2>Semua Produk</h2>
                <p>Jelajahi koleksi lengkap kami</p>
            </div>

            <div class="products-grid">
                @forelse ($products as $product)
                    @php $src = $product->primary_image_src; @endphp
                    <div class="product-card" data-product-id="{{ $product->id }}"
                        onclick="openProductModal('{{ $product->name }}', '{{ addslashes($product->description ?? '') }}', '{{ $src ? route('tenant.asset', ['path' => $src]) : '' }}', '{{ $product->price_idr }}', '{{ $product->category->name ?? 'Uncategorized' }}')">
                        <div class="product-image-container">
                            @if ($src)
                                <img class="product-image" src="{{ route('tenant.asset', ['path' => $src]) }}"
                                    alt="{{ $product->name }}" loading="lazy" />
                            @else
                                <div class="no-image-placeholder">
                                    <span>No Image</span>
                                </div>
                            @endif
                            @if ($product->discount_percentage)
                                <div class="discount-badge">-{{ $product->discount_percentage }}%</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                            <div class="product-pricing">
                                <span class="product-price">{{ $product->price_idr }}</span>
                                @if ($product->old_price_idr)
                                    <span class="product-old-price">{{ $product->old_price_idr }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-products">
                        <p>No products found.</p>
                    </div>
                @endforelse
            </div>

            <div id="noResults" class="no-results" style="display: none;">
                <h3>Produk yang Anda cari tidak ditemukan</h3>
                <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </section>

    </main>

    {{-- Product Modal --}}
    <div id="product-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto relative">
                <button id="close-modal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="grid md:grid-cols-2 gap-6 p-6">
                    <div class="space-y-4">
                        <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden">
                            <img id="modal-image" class="w-full h-full object-contain" src=""
                                alt="">
                        </div>
                        <div id="modal-thumbnails" class="flex gap-2 overflow-x-auto"></div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h2 id="modal-title" class="text-2xl font-bold text-gray-900"></h2>
                            <p id="modal-category" class="text-gray-600"></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span id="modal-price" class="text-3xl font-bold text-gray-900"></span>
                            <span id="modal-old-price" class="text-xl text-gray-500 line-through hidden"></span>
                            <span id="modal-discount"
                                class="bg-red-500 text-white text-sm font-semibold px-2 py-1 rounded hidden"></span>
                        </div>
                        <div id="modal-description" class="text-gray-700"></div>
                        <div id="modal-specifications" class="space-y-2"></div>
                        <div class="flex gap-3 pt-4">
                            <button
                                class="flex-1 bg-pink-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-pink-700 transition-colors">
                                Add to Cart
                            </button>
                            <button
                                class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{ $userStore->store_name ?? 'Fashion E-Catalog' }}</h3>
                <p>{{ $userStore->store_description ?? 'Katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini' }}
                </p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Categories</h4>
                <ul>
                    @foreach ($categories->take(5) as $category)
                        <li><a href="#">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Info</h4>
                <div class="contact-info">
                    @if ($userStore->phone)
                        <p>Phone: {{ $userStore->phone }}</p>
                    @endif
                    @if ($userStore->email)
                        <p>Email: {{ $userStore->email }}</p>
                    @endif
                    @if ($userStore->address)
                        <p>Address: {{ $userStore->address }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $userStore->store_name ?? 'Fashion E-Catalog' }}. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Product Modal -->
    <div id="product-modal" class="product-modal" style="display: none;">
        <div class="modal-container">
            <span onclick="closeModal()" class="modal-close">&times;</span>
            <div class="modal-content">
                <div class="modal-image-section">
                    <img id="modal-image" src="" alt="" class="modal-image">
                    <div id="modal-discount" class="modal-discount-badge hidden"></div>
                </div>
                <div class="modal-info-section">
                    <h2 id="modal-title" class="modal-title"></h2>
                    <p id="modal-category" class="modal-category"></p>
                    <div class="modal-price-section">
                        <span id="modal-price" class="modal-current-price"></span>
                        <span id="modal-old-price" class="modal-old-price hidden"></span>
                    </div>
                    <div class="modal-description">
                        <h4>Deskripsi Produk</h4>
                        <p id="modal-description"></p>
                    </div>
                    <div class="modal-actions">
                        <button class="modal-btn modal-btn-primary" onclick="closeModal()">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
        <p>Memuat data...</p>
    </div>

    <script>
        // Define a global asset URL for the external script
        const ASSET_URL = "{{ asset('assets/demo/fashion') }}";
    </script>
    <script src="{{ asset('assets/demo/fashion/script.js') }}"></script>

    <script>
        // Global variables
        let currentSlide = 0;
        let totalSlides = 0;
        let allProducts = @json($products->items() ?? []);
        let filteredProducts = [...allProducts];
        let categories = @json($categories ?? []);
        let subcategories = @json($subcategories ?? []);
        let currentCategory = 'all';
        let currentSubcategory = '';
        let currentSort = '';
        let searchQuery = '';

        // Initialize slider
        function initSlider() {
            const sliderWrapper = document.getElementById('slider-wrapper');
            const indicators = document.getElementById('slider-indicators');

            if (sliderWrapper) {
                totalSlides = sliderWrapper.children.length;

                // Auto-slide every 5 seconds
                setInterval(() => {
                    nextSlide();
                }, 5000);
            }
        }

        // Slider functions
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function previousSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function updateSlider() {
            const sliderWrapper = document.getElementById('slider-wrapper');
            const indicators = document.querySelectorAll('.slider-indicator');

            if (sliderWrapper) {
                sliderWrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
            }

            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
        }

        // Load categories
        function loadCategories() {
            const categoryGrid = document.getElementById('categoryGrid');
            if (!categoryGrid) return;

            categories.forEach(category => {
                const categoryCard = document.createElement('div');
                categoryCard.className = 'category-card';
                categoryCard.setAttribute('data-category-id', category.id);
                categoryCard.onclick = (e) => filterProducts(category.id, e);
                categoryCard.innerHTML = `
                    <div class="category-name">${category.name}</div>
                    <div class="category-description">${category.description || 'Lihat produk dalam kategori ini'}</div>
                `;
                categoryGrid.appendChild(categoryCard);
            });
        }

        // Filter products
        function filterProducts(categoryId, event) {
            // Update active category
            document.querySelectorAll('.category-card').forEach(card => {
                card.classList.remove('active');
            });

            if (event) {
                event.currentTarget.classList.add('active');
            }

            currentCategory = categoryId;
            currentSubcategory = '';

            // Show/hide subcategory section
            const subcategorySection = document.getElementById('subcategorySection');
            if (categoryId !== 'all' && categoryId !== 'new') {
                loadSubcategories(categoryId);
                subcategorySection.style.display = 'block';
            } else {
                subcategorySection.style.display = 'none';
            }

            applyFilters();
        }

        // Load subcategories
        function loadSubcategories(categoryId) {
            const subcategoryGrid = document.getElementById('subcategoryGrid');
            if (!subcategoryGrid) return;

            subcategoryGrid.innerHTML = '';

            // Add "All" subcategory option
            const allSubcategoryCard = document.createElement('div');
            allSubcategoryCard.className = 'subcategory-card active';
            allSubcategoryCard.setAttribute('data-subcategory-id', '');
            allSubcategoryCard.onclick = (e) => filterBySubcategory('', e);
            allSubcategoryCard.innerHTML = `
                <div class="subcategory-name">Semua</div>
            `;
            subcategoryGrid.appendChild(allSubcategoryCard);

            // Add actual subcategories
            const categorySubcategories = subcategories.filter(sub => sub.category_id == categoryId);
            categorySubcategories.forEach(subcategory => {
                const subcategoryCard = document.createElement('div');
                subcategoryCard.className = 'subcategory-card';
                subcategoryCard.setAttribute('data-subcategory-id', subcategory.id);
                subcategoryCard.onclick = (e) => filterBySubcategory(subcategory.id, e);
                subcategoryCard.innerHTML = `
                    <div class="subcategory-name">${subcategory.name}</div>
                `;
                subcategoryGrid.appendChild(subcategoryCard);
            });
        }

        // Filter by subcategory
        function filterBySubcategory(subcategoryId, event) {
            document.querySelectorAll('.subcategory-card').forEach(card => {
                card.classList.remove('active');
            });

            if (event) {
                event.currentTarget.classList.add('active');
            }

            currentSubcategory = subcategoryId;
            applyFilters();
        }

        // Search products
        function searchProducts() {
            const searchInput = document.getElementById('searchInput');
            searchQuery = searchInput ? searchInput.value.toLowerCase() : '';
            applyFilters();
        }

        // Filter products by search and filters (legacy function for compatibility)
        function filterProductsDirectly() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategory = document.getElementById('categoryFilter').value;
            const minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
            const maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;

            const productCards = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            productCards.forEach(card => {
                const productName = card.querySelector('.product-name').textContent.toLowerCase();
                const productCategory = card.querySelector('.product-category').textContent;
                const priceText = card.querySelector('.product-price').textContent.replace(/[^0-9]/g, '');
                const productPrice = parseFloat(priceText) || 0;

                const matchesSearch = productName.includes(searchTerm);
                const matchesCategory = !selectedCategory || productCategory === selectedCategory;
                const matchesPrice = productPrice >= minPrice && productPrice <= maxPrice;

                if (matchesSearch && matchesCategory && matchesPrice) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noResults = document.getElementById('noResults');
            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Sort products
        function sortProducts(sortType) {
            // Clear other sort selects
            const sortSelects = ['sortPrice', 'sortName', 'sortDate'];
            sortSelects.forEach(selectId => {
                const select = document.getElementById(selectId);
                if (select && select.id !== event.target.id) {
                    select.value = '';
                }
            });

            currentSort = sortType;
            applyFilters();
        }

        // Apply all filters
        function applyFilters() {
            filteredProducts = allProducts.filter(product => {
                // Search filter
                if (searchQuery && !product.name.toLowerCase().includes(searchQuery)) {
                    return false;
                }

                // Category filter
                if (currentCategory === 'new') {
                    // Show products created in last 30 days
                    const thirtyDaysAgo = new Date();
                    thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
                    const productDate = new Date(product.created_at);
                    return productDate >= thirtyDaysAgo;
                } else if (currentCategory !== 'all') {
                    if (product.category_id != currentCategory) {
                        return false;
                    }
                }

                // Subcategory filter
                if (currentSubcategory && product.subcategory_id != currentSubcategory) {
                    return false;
                }

                return true;
            });

            // Apply sorting
            if (currentSort) {
                filteredProducts.sort((a, b) => {
                    switch (currentSort) {
                        case 'low-high':
                            return parseFloat(a.price) - parseFloat(b.price);
                        case 'high-low':
                            return parseFloat(b.price) - parseFloat(a.price);
                        case 'a-z':
                            return a.name.localeCompare(b.name);
                        case 'z-a':
                            return b.name.localeCompare(a.name);
                        case 'oldest':
                            return new Date(a.created_at) - new Date(b.created_at);
                        case 'newest':
                            return new Date(b.created_at) - new Date(a.created_at);
                        default:
                            return 0;
                    }
                });
            }

            renderProducts();
        }

        // Render products
        function renderProducts() {
            const productGrid = document.querySelector('.products-grid');
            const noResults = document.getElementById('noResults');

            if (!productGrid) return;

            // Get all product cards
            const allCards = productGrid.querySelectorAll('.product-card');

            if (filteredProducts.length === 0) {
                allCards.forEach(card => card.style.display = 'none');
                if (noResults) noResults.style.display = 'block';
                return;
            }

            if (noResults) noResults.style.display = 'none';

            allCards.forEach(card => {
                const productId = card.getAttribute('data-product-id');
                const shouldShow = filteredProducts.some(product => product.id == productId);
                card.style.display = shouldShow ? 'block' : 'none';
            });
        }

        // Open product modal
        function openProductModal(name, description, imageSrc, price, category) {
            const modal = document.getElementById('product-modal');
            if (!modal) return;

            // Update modal content
            document.getElementById('modal-title').textContent = name;
            document.getElementById('modal-category').textContent = category;
            document.getElementById('modal-price').textContent = price;
            document.getElementById('modal-description').textContent = description || 'No description available.';

            if (imageSrc) {
                document.getElementById('modal-image').src = imageSrc;
                document.getElementById('modal-image').alt = name;
            }

            modal.style.display = 'block';
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('product-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initSlider();
            loadCategories();
            renderProducts();

            // Close modal when clicking close button or outside modal
            const closeModalBtn = document.getElementById('close-modal');
            const modal = document.getElementById('product-modal');

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }

            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }
        });
    </script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'fashion',
    ])
</body>

</html>
