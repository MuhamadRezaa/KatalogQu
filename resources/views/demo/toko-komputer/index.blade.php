<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>TechZone - Modern Computer Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .category-card.category-active {
            border-color: #06b6d4;
            /* cyan-500 */
            box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.5);
            /* ring-2 ring-cyan-500/50 */
        }
    </style>
</head>

<body class="min-h-screen bg-white">
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <!-- ADDED: lazy -->
                <img class="rounded h-8 w-8 sm:h-10 sm:w-10"
                    src="{{ asset('assets/demo/toko-komputer/img/temp/logo-toko.png') }}" alt="TechZone Logo"
                    loading="lazy" decoding="async" />
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-cyan-500">
                    TechZone
                </h1>
            </a>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden border-t border-gray-200 bg-white hidden">
            <div class="px-4 py-2 space-y-1">
                <a href="#hero"
                    class="block px-3 py-2 text-gray-700 hover:text-cyan-500 hover:bg-gray-50 rounded-lg transition-colors">Beranda</a>
                <a href="#products"
                    class="block px-3 py-2 text-gray-700 hover:text-cyan-500 hover:bg-gray-50 rounded-lg transition-colors">Produk</a>
                <a href="#about"
                    class="block px-3 py-2 text-gray-700 hover:text-cyan-500 hover:bg-gray-50 rounded-lg transition-colors">Tentang</a>
                <a href="#contact"
                    class="block px-3 py-2 text-gray-700 hover:text-cyan-500 hover:bg-gray-50 rounded-lg transition-colors">Kontak</a>
                <!-- Will be populated by JavaScript -->
            </div>
        </div>
        </div>
    </header>

    <!-- Slider Banner -->
    <div class="mx-auto">
        <div class="swiper-container aspect-video overflow-hidden">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative">
                    <img src="https://images.pexels.com/photos/2115257/pexels-photo-2115257.jpeg?auto=compress&cs=tinysrgb&w=1280&h=720&dpr=1"
                        class="w-full h-full object-cover" alt="Build PC Offer" />
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="text-center text-white p-4">
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">
                                Special Build Offer!
                            </h2>
                            <p class="text-lg md:text-xl mb-4">
                                Discounts on premium parts for your dream
                                PC.
                            </p>
                            {{-- <a href="#"
                                class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">Learn
                                More</a> --}}
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide relative">
                    <img src="https://images.pexels.com/photos/1779487/pexels-photo-1779487.jpeg?auto=compress&cs=tinysrgb&w=1280&h=720&dpr=1"
                        class="w-full h-full object-cover" alt="Gaming Gear" />
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="text-center text-white p-4">
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">
                                Upgrade Your Gear
                            </h2>
                            <p class="text-lg md:text-xl mb-4">
                                Top-tier peripherals for the ultimate
                                experience.
                            </p>
                            {{-- <a href="#"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">Shop
                                Now</a> --}}
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide relative">
                    <img src="https://images.pexels.com/photos/1029757/pexels-photo-1029757.jpeg?auto=compress&cs=tinysrgb&w=1280&h=720&dpr=1"
                        class="w-full h-full object-cover" alt="Laptops on Sale" />
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="text-center text-white p-4">
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">
                                Laptops for Every Need
                            </h2>
                            <p class="text-lg md:text-xl mb-4">
                                Powerful, portable, and now on sale.
                            </p>
                            {{-- <a href="#"
                                class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">View
                                Deals</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination relative text-center py-4"></div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 py-8">
        <!-- Category Display Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Browse by Category
            </h2>
            <div id="category-display"
                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                <!-- Category cards will be populated by JavaScript -->
            </div>

            <!-- Category Card Template -->
            <template id="category-card-template">
                <div
                    class="category-card bg-white rounded-xl p-2 border border-gray-200 hover:border-cyan-300 hover:shadow-lg transition-all duration-300 cursor-pointer group">
                    <div class="relative w-full overflow-hidden rounded-lg mb-2" style="aspect-ratio: 5 / 4;">
                        <img class="category-image w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105"
                            loading="lazy" decoding="async" src="" alt="" />
                    </div>
                    <div class="text-center">
                        <h3
                            class="category-name font-semibold text-gray-800 group-hover:text-cyan-600 transition-colors mb-2">
                        </h3>
                        <p class="category-count text-sm text-gray-500 group-hover:text-cyan-500 transition-colors"></p>
                    </div>
                </div>
            </template>
        </div>

        <!-- Filters -->
        <div class="bg-white p-6 rounded-lg shadow-md top-24 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                Search Products
            </h2>

            <div class="mb-6">
                <div class="relative w-full">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 h-4 w-4"></i>
                    <input type="text" id="search-input" placeholder="Search..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent focus:bg-white transition-all text-sm" />
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-4">Filters</h2>

            <!-- Category and Price Range Filters - Side by side on tablet -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                <!-- Category & Sub-category Wrapper -->
                <select id="category-filter" class="hidden">
                    <option value="all" selected>Semua Kategori</option>
                </select>

            </div>


            <!-- Price Range Filter -->
            <div class="mb-6">
                <h3 class="font-semibold mb-2 text-gray-700">
                    Price Range
                </h3>

                <select id="price-range"
                    class="w-full py-2 px-3 border border-gray-300 rounded-lg text-sm focus:ring-cyan-500 focus:border-cyan-500 transition">
                    <option value="">Semua harga</option>
                    <option data-min="0" data-max="100000">
                        Di bawah Rp 100rb
                    </option>
                    <option data-min="100000" data-max="500000">
                        Rp 100rb - Rp 500rb
                    </option>
                    <option data-min="500000" data-max="1000000">
                        Rp 500rb - Rp 1jt
                    </option>
                    <option data-min="1000000" data-max="3000000">
                        Rp 1jt - Rp 3jt
                    </option>
                    <option data-min="3000000" data-max="5000000">
                        Rp 3jt - Rp 5jt
                    </option>
                    <option data-min="5000000" data-max="10000000">
                        Rp 5jt - Rp 10jt
                    </option>
                    <option data-min="10000000" data-max="20000000">
                        Rp 10jt - Rp 20jt
                    </option>
                    <option data-min="20000000" data-max="">
                        Rp 20jt ke atas
                    </option>
                </select>

                <!-- tetap gunakan hidden input agar kompatibel dengan filter lama -->
                <input type="hidden" id="min-price-filter" name="min_price" />
                <input type="hidden" id="max-price-filter" name="max_price" />
            </div>

            <!-- Brand Filter -->
            <div class="mb-6">
                <h3 class="font-semibold mb-2 text-gray-700">Brand</h3>
                <div class="relative">
                    <div class="relative">
                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 h-4 w-4 z-10"></i>
                        <input type="text" id="brand-search" placeholder="Cari brand..."
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-t-lg focus:ring-cyan-500 focus:border-cyan-500 transition text-sm" />
                        <button id="brand-dropdown-toggle"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition">
                            <i data-lucide="chevron-down" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <!-- Dropdown content -->
                    <div id="brand-dropdown"
                        class="hidden absolute top-full left-0 right-0 bg-white border border-t-0 border-gray-300 rounded-b-lg shadow-lg max-h-60 overflow-y-auto z-20">
                        <div id="brand-options" class="py-2">
                            <!-- Brand options will be populated by JavaScript -->
                        </div>

                        <!-- Brand Option Template -->
                        <template id="brand-option-template">
                            <div
                                class="brand-option px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center justify-between">
                                <span class="brand-name text-sm"></span>
                                <i data-lucide="check" class="brand-check h-4 w-4 text-green-500 hidden"></i>
                            </div>
                        </template>
                    </div>

                    <!-- Selected brands display -->
                    <div id="selected-brands" class="mt-2 flex flex-wrap gap-2 hidden">
                        <!-- Selected brand tags will appear here -->
                    </div>

                    <!-- Selected Brand Tag Template -->
                    <template id="brand-tag-template">
                        <span
                            class="brand-tag inline-flex items-center gap-1 px-3 py-2 bg-cyan-100 text-cyan-800 text-xs rounded-full">
                            <span class="brand-tag-name"></span>
                            <button class="brand-tag-remove hover:bg-cyan-200 rounded-full p-0.5">
                                <i data-lucide="x" class="h-3 w-3"></i>
                            </button>
                        </span>
                    </template>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button id="reset-filters"
                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors">
                    Reset
                </button>
                <button id="apply-filters"
                    class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    Terapkan
                </button>
            </div>
        </div>

        <!-- Sub-Category Display Section -->
        <div id="subcategory-display-container" class="mb-8 hidden">
            <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Sub-Kategori untuk <span
                    id="selected-category-name"></span></h3>
            <div id="subcategory-display" class="flex flex-wrap justify-center gap-3">
                <!-- Sub-category buttons/checkboxes will be populated here -->
            </div>
            <template id="subcategory-checkbox-template">
                <div>
                    <input type="radio" id="" name="subcategory" value="" class="hidden peer">
                    <label for=""
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer text-gray-700 bg-white hover:bg-gray-100 hover:text-gray-900 peer-checked:border-cyan-500 peer-checked:bg-cyan-50 peer-checked:text-cyan-700 transition-colors">
                        <span class="text-sm font-medium"></span>
                    </label>
                </div>
            </template>
        </div>

        <!-- Product Grid -->
        <!-- ADDED: toolbar sorting -->
        <div id="product-grid-toolbar" class="flex items-center justify-between mb-4">
            <div class="text-sm text-gray-600">
                <span id="result-count">Menampilkan produk</span>
            </div>
            <div class="flex items-center gap-2">
                <label for="sort-select" class="text-sm text-gray-600">Urutkan:</label>
                <select id="sort-select"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-cyan-500 focus:border-cyan-500">
                    <option value="relevance">Relevansi</option>
                    <option value="price-asc">Harga: Terendah</option>
                    <option value="price-desc">Harga: Tertinggi</option>
                    <option value="name-asc">Nama: A-Z</option>
                    <option value="name-desc">Nama: Z-A</option>
                    <option value="newest">Terbaru</option>
                </select>
            </div>
        </div>

        <div id="product-grid"
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
            <!-- Product card template - will be cloned by JavaScript -->
            <template id="product-card-template">
                <div
                    class="product-card bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 group border border-gray-200 relative cursor-pointer">
                    <div class="product-image-container relative overflow-hidden bg-gray-100"
                        style="aspect-ratio: 5 / 4;">
                        <img class="product-image w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105"
                            loading="lazy" decoding="async" src="" alt="" />

                        <!-- Promo badge -->
                        <span
                            class="promo-badge absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full hidden">
                            Promo
                        </span>

                        <!-- Out of stock overlay -->
                        <div
                            class="stock-overlay absolute inset-0 bg-black/50 flex items-center justify-center hidden">
                            <span class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm font-semibold">Stok
                                Habis</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="product-name text-base font-semibold text-gray-800 line-clamp-2"></h3>
                        <p class="product-category text-xs text-gray-500 mb-2"></p>
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-wrap items-baseline gap-x-1">
                                <span class="product-price font-bold text-gray-900"></span>
                                <span class="product-old-price text-gray-500 line-through hidden"></span>
                            </div>
                            <div class="savings-badge-container mt-1">
                                <span
                                    class="savings-badge text-xs font-semibold bg-green-100 text-green-800 px-2 py-1 rounded-md hidden"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Product cards will be inserted here by JavaScript -->
        </div>
        <div id="no-results" class="hidden text-center py-16">
            <i data-lucide="search-x" class="mx-auto h-16 w-16 text-gray-400"></i>
            <h3 class="mt-4 text-lg font-semibold text-gray-800">
                No Products Found
            </h3>
            <p class="mt-1 text-gray-500">
                Try adjusting your filters to find what you're looking for.
            </p>
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="flex flex-wrap justify-center items-center gap-2 mt-8">
            <!-- Pagination template -->
            <template id="pagination-template">
                <button
                    class="pagination-prev px-2 py-2 xs:px-3 xs:py-2 sm:px-4 sm:py-2 border rounded-lg hover:bg-gray-100 transition text-xs xs:text-sm sm:text-base min-w-[44px] min-h-[44px] xs:min-w-[48px] xs:min-h-[48px] sm:min-w-auto sm:min-h-auto flex items-center justify-center">
                    <span class="hidden sm:inline">Previous</span>
                    <span class="hidden xs:inline sm:hidden">Prev</span>
                    <span class="xs:hidden">‹</span>
                </button>
                <div class="pagination-numbers flex flex-wrap justify-center gap-1 xs:gap-2 sm:gap-2">
                    <!-- Page numbers will be inserted here -->
                </div>
                <button
                    class="pagination-next px-2 py-2 xs:px-3 xs:py-2 sm:px-4 sm:py-2 border rounded-lg hover:bg-gray-100 transition text-xs xs:text-sm sm:text-base min-w-[44px] min-h-[44px] xs:min-w-[48px] xs:min-h-[48px] sm:min-w-auto sm:min-h-auto flex items-center justify-center">
                    <span class="hidden sm:inline">Next</span>
                    <span class="hidden xs:inline sm:hidden">Next</span>
                    <span class="xs:hidden">›</span>
                </button>
            </template>

            <!-- Page number button template -->
            <template id="page-button-template">
                <button
                    class="page-button px-2 py-2 xs:px-3 xs:py-2 sm:px-4 sm:py-2 border rounded-lg hover:bg-gray-100 transition text-xs xs:text-sm sm:text-base min-w-[44px] min-h-[44px] xs:min-w-[48px] xs:min-h-[48px] sm:min-w-auto sm:min-h-auto flex items-center justify-center">
                    1
                </button>
            </template>

            <!-- Pagination will be populated by JavaScript -->
        </div>
    </main>

    <!-- Product Modal -->
    <div id="product-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-4xl max-h-full overflow-y-auto">
            <div class="relative">
                <button id="modal-close" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                    <i data-lucide="x" class="h-6 w-6"></i>
                </button>
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Product Images -->
                        <div class="space-y-4">
                            <div class="relative aspect-square bg-gray-100 rounded-xl overflow-hidden">
                                <img id="main-image"
                                    src="https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Product Image" class="w-full h-full object-contain cursor-zoom-in" />

                                <button id="fullscreen-button"
                                    class="absolute top-3 right-3 bg-gray-900/50 p-2 rounded-full text-white hover:bg-gray-900 transition-colors"
                                    title="Lihat gambar penuh">
                                    <i data-lucide="maximize" class="h-6 w-6"></i>
                                </button>

                                <div id="promo-badge" class="absolute top-4 left-4">
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        Promo
                                    </span>
                                </div>

                                <div id="stock-overlay"
                                    class="absolute inset-0 bg-black/50 flex items-center justify-center hidden">
                                    <span class="bg-red-500 text-white px-6 py-3 rounded-lg text-lg font-medium">
                                        Stok Habis
                                    </span>
                                </div>
                            </div>

                            <!-- Thumbnail Images -->
                            <div id="thumbnail-container" class="grid grid-cols-4 gap-3">
                                <!-- Thumbnails will be dynamically inserted here -->
                            </div>

                            <!-- Thumbnail Template -->
                            <template id="thumbnail-template">
                                <button
                                    class="thumbnail bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300"
                                    style="aspect-ratio: 5 / 4;">
                                    <img class="thumbnail-image w-full h-full object-cover" loading="lazy"
                                        decoding="async" src="" alt="" />
                                </button>
                            </template>
                        </div>

                        <!-- Product Info -->
                        <div class="space-y-6">
                            <div>
                                <div class="flex items-start justify-between mb-2">
                                    <h1 id="product-title"
                                        class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 leading-tight">
                                        ASUS ROG Strix G15 Gaming Laptop
                                    </h1>
                                </div>

                                <p id="product-category-text" class="text-blue-600 font-medium">
                                    Laptop
                                </p>
                            </div>

                            <!-- Price -->
                            <div class="space-y-2">
                                <div class="flex items-baseline space-x-3 flex-wrap">
                                    <span id="current-price" class="text-2xl font-bold text-gray-900">
                                        Rp 15.999.000
                                    </span>
                                    <span id="original-price" class="text-sm text-gray-500 line-through">
                                        Rp 17.999.000
                                    </span>
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Deskripsi
                                </h3>
                                <p id="product-description" class="text-gray-700 leading-relaxed">
                                    Laptop gaming powerful dengan AMD Ryzen
                                    7 dan RTX 3060 untuk performa gaming
                                    terbaik. Dilengkapi dengan layar 144Hz
                                    dan sistem pendingin canggih untuk
                                    pengalaman gaming yang optimal.
                                </p>
                            </div>

                            <!-- Specifications -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                    Spesifikasi
                                </h3>
                                <ul id="product-specs" class="space-y-2">
                                    <!-- Specs will be dynamically inserted here -->
                                </ul>

                                <!-- Product Spec Template -->
                                <template id="product-spec-template">
                                    <li class="spec-item flex items-center text-gray-700">
                                        <span class="w-2 h-2 bg-blue-600 rounded-full mr-3 flex-shrink-0"></span>
                                        <span class="spec-text"></span>
                                    </li>
                                </template>
                            </div>



                            <!-- Chat Button -->
                            <div class="pt-6 border-t border-gray-200">
                                <a href="https://wa.me/6281572505989" target="_blank"
                                    class="w-full flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                                    <i data-lucide="message-circle" class="h-5 w-5 mr-2"></i>
                                    Chat Toko
                                </a>
                            </div>
                            <!-- ADDED: tombol share produk -->
                            <div class="pt-4">
                                <div class="flex flex-wrap gap-2">
                                    <button id="share-button"
                                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm">
                                        <i data-lucide="share-2" class="h-4 w-4"></i>
                                        Share Produk
                                    </button>
                                    <button id="copy-link-button"
                                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm">
                                        <i data-lucide="copy" class="h-4 w-4"></i>
                                        Salin Link
                                    </button>
                                </div>
                            </div>

                            <!-- Similar Products Section -->
                            <div class="pt-6 border-t border-gray-200 mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Produk Serupa</h3>
                                <div id="similar-products-container" class="grid grid-cols-3 gap-3">
                                    <!-- Similar products will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="image-lightbox"
        class="hidden fixed inset-0 bg-black bg-opacity-80 z-[60] flex items-center justify-center p-4">
        <img id="lightbox-image" src="" alt="Fullscreen product image"
            class="max-w-full max-h-full object-contain" />
        <button id="lightbox-close" class="absolute top-4 right-4 text-white/80 hover:text-white">
            <i data-lucide="x" class="h-8 w-8"></i>
        </button>
        <button id="lightbox-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-gray-900/50 p-2 rounded-full text-white hover:bg-gray-900 transition-colors">
            <i data-lucide="chevron-left" class="h-8 w-8"></i>
        </button>
        <button id="lightbox-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-gray-900/50 p-2 rounded-full text-white hover:bg-gray-900 transition-colors">
            <i data-lucide="chevron-right" class="h-8 w-8"></i>
        </button>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <!-- Main Footer -->
        <div class="container mx-auto px-4 sm:px-6 py-12 lg:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <!-- Column 1: Brand -->
                <div class="space-y-4 mr-6">
                    <a href="index.html" class="flex items-center space-x-4 mb-4">
                        <!-- ADDED: lazy -->
                        <img class="h-16 w-16 rounded"
                            src="{{ asset('assets/demo/toko-komputer/img/temp/logo-toko.png') }}" alt="TechZone Logo"
                            loading="lazy" decoding="async" />
                        <span class="text-4xl font-bold text-white">TechZone</span>
                    </a>
                    <p class="text-base text-gray-400">
                        Your one-stop solution for all things tech.
                        High-quality components and expert service.
                    </p>
                </div>

                <!-- Column 2: Customer Help -->
                <div class="space-y-4 mr-6">
                    <h3 class="text-white font-semibold text-lg lg:text-xl mb-4 lg:mb-6">
                        Contact
                    </h3>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="map-pin" class="h-4 w-4 lg:h-5 lg:w-5 text-cyan-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">
                                Store Address
                            </p>
                            <p class="text-xs lg:text-sm text-gray-400">
                                Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV No.172 Kompleks, Asam Kumbang,
                                Kec.
                                Medan Selayang, Kota Medan, Sumatera Utara 20133
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i data-lucide="phone" class="h-4 w-4 lg:h-5 lg:w-5 text-cyan-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">
                                Phone & WhatsApp
                            </p>
                            <p class="text-xs lg:text-sm text-gray-400">
                                0815-7250-5989
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i data-lucide="mail" class="h-4 w-4 lg:h-5 lg:w-5 text-cyan-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">
                                Email
                            </p>
                            <p class="text-xs lg:text-sm text-gray-400">
                                pteraciptadigital@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sub-Footer -->
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-4 sm:px-6 py-4 lg:py-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <div class="text-center sm:text-left">
                        <p class="text-xs lg:text-sm text-gray-400">
                            © 2025 PT. Era Cipta Digital
                        </p>
                    </div>

                    <div class="flex space-x-4 lg:space-x-6">
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                            aria-label="Follow us on Facebook">
                            <i data-lucide="facebook" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                            aria-label="Follow us on Instagram">
                            <i data-lucide="instagram" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                            aria-label="Follow us on YouTube">
                            <i data-lucide="youtube" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                            aria-label="Follow us on Twitter">
                            <i data-lucide="twitter" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper-container", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log("DOM fully loaded and parsed");
            const products = [{
                    id: 1,
                    name: "ASUS ROG Strix G15",
                    category: "Laptop",
                    subcategory: "Laptop Gaming",
                    brand: "ASUS",
                    price: 18990000,
                    oldPrice: 21990000,
                    isPromo: true, // ADDED
                    images: [
                        "{{ asset('assets/demo/toko-komputer/img/product/laptop/GamingLaptopROGStrix.png') }}",
                        "https://images.pexels.com/photos/18105/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=800",
                        "https://images.pexels.com/photos/205421/pexels-photo-205421.jpeg?auto=compress&cs=tinysrgb&w=800",
                    ],
                    url: "product-detail.html",
                    description: "Experience gaming like never before with the powerful ASUS ROG Strix G15, featuring top-tier graphics and a high-refresh-rate display.",
                    specs: {
                        "CPU": "AMD Ryzen 7 5800H",
                        "GPU": "RTX 3060 6GB",
                        "RAM": "16GB DDR4",
                        "Storage": "512GB NVMe SSD",
                        "Display": '15.6" 144Hz Display',
                    },
                },
                {
                    id: 2,
                    name: "NVIDIA GeForce RTX 4080",
                    category: "GPU",
                    subcategory: "NVIDIA GeForce",
                    brand: "NVIDIA",
                    price: 15000000,
                    oldPrice: 17500000,
                    images: [
                        "{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}",
                        "https://images.pexels.com/photos/777001/pexels-photo-777001.jpeg?auto=compress&cs=tinysrgb&w=800",
                    ],
                    url: "product-detail.html",
                    description: "The NVIDIA GeForce RTX 4080 delivers the ultra performance and features that enthusiast gamers and creators demand.",
                    specs: {
                        "Memory": "16GB GDDR6X",
                        "Interface": "PCIe 4.0",
                        "Features 1": "DLSS 3",
                        "Features 2": "Ray Tracing",
                    },
                },
                {
                    id: 3,
                    name: "Corsair Vengeance RGB Pro 32GB",
                    category: "RAM",
                    subcategory: "DDR4",
                    brand: "Corsair",
                    price: 2500000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Illuminate your system with vivid, animated lighting from ten individually addressable RGB LEDs per module.",
                    specs: {
                        "Capacity": "32GB (2x16GB)",
                        "Type": "DDR4 3200MHz",
                        "Compatibility": "Intel XMP 2.0",
                        "Lighting": "Dynamic Multi-Zone RGB Lighting",
                    },
                },
                {
                    id: 4,
                    name: "SteelSeries Apex Pro TKL",
                    category: "Keyboard",
                    subcategory: "Mechanical",
                    brand: "SteelSeries",
                    price: 3200000,
                    oldPrice: 3500000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The Apex Pro TKL is the biggest leap in mechanical keyboards since the invention of the mechanical switch 35 years ago.",
                    specs: {
                        "Switches": "OmniPoint Adjustable Mechanical Switches",
                        "Display": "OLED Smart Display",
                        "Material": "Aircraft Grade Aluminum Alloy Frame",
                        "Connectivity": "Detachable USB-C Cable",
                    },
                },
                {
                    id: 5,
                    name: "Logitech G Pro X Superlight",
                    category: "Mouse",
                    subcategory: "Mouse Gaming",
                    brand: "Logitech",
                    price: 2300000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A result of our continued collaboration with top esports pros, PRO X SUPERLIGHT is engineered with a single goal—to create one of the lightest PRO wireless gaming mice possible.",
                    specs: {
                        "Weight": "Under 63 grams",
                        "Connectivity": "LIGHTSPEED Wireless",
                        "Sensor": "HERO 25K Sensor",
                        "Feet": "Zero-additive PTFE Feet",
                    },
                },
                {
                    id: 6,
                    name: "Custom Build PC - Ryzen 9",
                    category: "PC Desktop",
                    subcategory: "PC Rakitan",
                    brand: "AMD",
                    price: 35000000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Get the ultimate gaming performance with a custom-built PC powered by the AMD Ryzen 9 processor.",
                    specs: {
                        "CPU": "AMD Ryzen 9 5950X",
                        "GPU": "NVIDIA RTX 3080 Ti",
                        "RAM": "64GB DDR4 3600MHz",
                        "Storage": "2TB NVMe SSD",
                        "Cooling": "Custom Liquid Cooling",
                    },
                },
                {
                    id: 7,
                    name: "ASUS ROG Swift PG279QM",
                    category: "Monitor",
                    subcategory: "Gaming (High Refresh Rate)",
                    brand: "ASUS",
                    price: 12000000,
                    oldPrice: 13500000,
                    isPromo: true, // ADDED
                    images: [
                        "{{ asset('assets/demo/toko-komputer/img/product/laptop/ASUSROGSwift27.png') }}",
                    ],
                    url: "product-detail.html",
                    description: "The ROG Swift PG279QM is the perfect gaming monitor for fast-paced action games. This QHD display features a 240 Hz refresh rate and NVIDIA G-SYNC technology.",
                    specs: {
                        "Size/Resolution": "27-inch QHD (2560 x 1440)",
                        "Refresh Rate": "240Hz",
                        "Sync Technology": "NVIDIA G-SYNC",
                        "Panel Type": "Fast IPS Panel",
                    },
                },
                {
                    id: 8,
                    name: "Logitech C922 Pro Stream Webcam",
                    category: "Aksesoris PC",
                    subcategory: "Webcam",
                    brand: "Logitech",
                    price: 1600000,
                    oldPrice: 1800000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Stream and record vibrant, true-to-life video. The C922 Pro Stream Webcam is designed for serious streamers.",
                    specs: {
                        "Resolution/FPS": "1080p/30fps or 720p/60fps",
                        "Audio": "Stereo Audio",
                        "Focus": "Autofocus",
                        "Features": "Background Replacement",
                    },
                }, {
                    id: 9,
                    name: "Corsair RM850x PSU",
                    category: "PSU",
                    subcategory: "850W",
                    brand: "Corsair",
                    price: 2100000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Corsair RMx series power supplies give you extremely tight voltage control, quiet operation, Gold-certified efficiency, and a fully modular cable set.",
                    specs: {
                        "Wattage": "850 Watts",
                        "Efficiency": "80 PLUS Gold Certified",
                        "Modularity": "Fully Modular",
                        "Fan Mode": "Zero RPM Fan Mode",
                    },
                }, {
                    id: 10,
                    name: "ASUS TUF Gaming F15",
                    category: "Laptop",
                    subcategory: "Laptop Gaming",
                    brand: "ASUS",
                    price: 15500000,
                    oldPrice: 16000000,
                    isPromo: true, // ADDED
                    url: "product-detail.html",
                    description: "Geared for serious gaming and real-world durability, the TUF Gaming F15 is a fully-loaded Windows 10 Pro gaming laptop that can carry you to victory.",
                    specs: {
                        "CPU": "Intel Core i7-11800H",
                        "GPU": "RTX 3050 Ti",
                        "RAM": "16GB DDR4",
                        "Storage": "1TB NVMe SSD",
                        "Display": '15.6" 144Hz Display',
                    },
                }, {
                    id: 11,
                    name: "NVIDIA GeForce RTX 4090",
                    category: "GPU",
                    subcategory: "NVIDIA GeForce",
                    brand: "NVIDIA",
                    price: 28000000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The NVIDIA GeForce RTX 4090 is the ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics.",
                    specs: {
                        "Memory": "24GB GDDR6X",
                        "Interface": "PCIe 4.0",
                        "Features 1": "DLSS 3",
                        "Features 2": "8K Gaming",
                    },
                }, {
                    id: 12,
                    name: "Logitech G502 HERO",
                    category: "Mouse",
                    subcategory: "Mouse Gaming",
                    brand: "Logitech",
                    price: 899000,
                    oldPrice: 1100000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "G502 HERO features an advanced optical sensor for maximum tracking accuracy, customizable RGB lighting, custom game profiles, from 200 up to 25,600 DPI, and repositionable weights.",
                    specs: {
                        "Sensor": "HERO 25K Sensor",
                        "Buttons": "11 Programmable Buttons",
                        "Customization": "Adjustable Weights",
                        "Lighting": "LIGHTSYNC RGB",
                    },
                }, {
                    id: 13,
                    name: "Razer BlackWidow V3 Pro",
                    category: "Keyboard",
                    subcategory: "Mechanical",
                    brand: "Razer",
                    price: 2800000,
                    oldPrice: 3000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A full-featured mechanical gaming keyboard with three modes of connection and a full-height keycap design.",
                    specs: {
                        "Switches": "Razer Green Mechanical Switches",
                        "Lighting": "Razer Chroma RGB",
                        "Connectivity": "Three Connectivity Modes",
                        "Build Material": "Durable Aluminum Construction",
                    },
                }, {
                    id: 14,
                    name: "Samsung Odyssey G7",
                    category: "Monitor",
                    subcategory: "Gaming (High Refresh Rate)",
                    brand: "Samsung",
                    price: 9500000,
                    oldPrice: 10500000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The Samsung Odyssey G7 is a monitor built for speed, with a 240Hz refresh rate and a 1ms response time.",
                    specs: {
                        "Size/Resolution": "32-inch QHD (2560x1440)",
                        "Refresh Rate": "240Hz",
                        "Curvature": "1000R",
                        "Sync Technology": "G-Sync Compatible",
                    },
                }, {
                    id: 15,
                    name: "Intel Core i9-13900K",
                    category: "Processor",
                    subcategory: "Intel Processors",
                    brand: "Intel",
                    price: 10500000,
                    oldPrice: 11000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The flagship Intel Core i9-13900K delivers incredible performance for gaming, streaming, and content creation.",
                    specs: {
                        "Cores/Threads": "24 Cores / 32 Threads",
                        "Max Clock Speed": "Up to 5.8 GHz",
                        "Socket": "LGA 1700 Socket",
                        "Memory Support": "DDR5 Support",
                    },
                }, {
                    id: 16,
                    name: "ASUS ROG Maximus Z790 Hero",
                    category: "Motherboard",
                    subcategory: "Platform Intel",
                    brand: "ASUS",
                    price: 8500000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A powerful motherboard designed to handle the latest Intel processors with robust power delivery and advanced cooling solutions.",
                    specs: {
                        "Chipset": "Intel Z790 Chipset",
                        "Socket": "LGA 1700 Socket",
                        "Memory Support": "DDR5 Support",
                        "PCIe Version": "PCIe 5.0",
                    },
                }, {
                    id: 17,
                    name: "Western Digital Black SN850X 1TB",
                    category: "SSD",
                    subcategory: "SSD NVMe",
                    brand: "Western Digital",
                    price: 2800000,
                    oldPrice: 3200000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Blazing-fast NVMe SSD for next-gen gaming, with speeds of up to 7300MB/s.",
                    specs: {
                        "Capacity": "1TB",
                        "Interface": "NVMe PCIe Gen4",
                        "Read Speed": "up to 7300MB/s",
                        "Features": "Heatsink Included",
                    },
                }, {
                    id: 18,
                    name: "Seagate Barracuda 4TB HDD",
                    category: "HDD",
                    subcategory: "Hard Disk Internal (HDD)",
                    brand: "Seagate",
                    price: 1500000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Reliable and high-capacity hard drive for all your storage needs.",
                    specs: {
                        "Capacity": "4TB",
                        "Interface": "SATA 6Gb/s",
                        "RPM": "5400",
                        "Cache": "256MB",
                    },
                }, {
                    id: 19,
                    name: "Corsair iCUE H150i ELITE CAPELLIX",
                    category: "Cooling",
                    subcategory: "Pendingin CPU (CPU Cooler)",
                    brand: "Corsair",
                    price: 2900000,
                    oldPrice: 3100000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A liquid CPU cooler with vibrant RGB lighting and powerful cooling performance.",
                    specs: {
                        "Radiator Size": "360mm",
                        "Fans": "3x ML120 RGB",
                        "Lighting": "Dynamic RGB Lighting",
                        "Software": "iCUE Software Control",
                    },
                }, {
                    id: 20,
                    name: "NZXT H5 Flow",
                    category: "Casing",
                    subcategory: "ATX Tower",
                    brand: "NZXT",
                    price: 1800000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "An ATX mid-tower case designed for optimal airflow and a clean, modern aesthetic.",
                    specs: {
                        "Form Factor": "Mid-Tower ATX",
                        "Side Panel": "Tempered Glass",
                        "Cooling": "Excellent Airflow",
                        "Features": "Cable Management Bar",
                    },
                }, {
                    id: 21,
                    name: "HyperX QuadCast S",
                    category: "Audio",
                    subcategory: "Mikrofon",
                    brand: "HyperX",
                    price: 2500000,
                    oldPrice: 2800000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A versatile USB microphone with a stunning RGB light and four polar patterns to suit any recording situation.",
                    specs: {
                        "Polar Patterns": "Four",
                        "Controls": "Tap-to-mute Sensor",
                        "Lighting": "Vibrant RGB Lighting",
                        "Accessories": "Built-in Pop Filter",
                    },
                }, {
                    id: 22,
                    name: "ASUS ROG Zephyrus G14",
                    category: "Laptop",
                    subcategory: "Laptop Gaming",
                    brand: "ASUS",
                    price: 21000000,
                    oldPrice: 23000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/product/laptop/1000.png') }}"],
                    url: "product-detail.html",
                    description: "A compact and powerful gaming laptop featuring a stunning AniMe Matrix display on the lid.",
                    specs: {
                        "CPU": "AMD Ryzen 9 6900HS",
                        "GPU": "Radeon RX 6800S",
                        "RAM": "16GB DDR5",
                        "Storage": "1TB NVMe SSD",
                        "Display": '14" QHD 120Hz Display',
                    },
                }, {
                    id: 23,
                    name: "Gigabyte AORUS FO48U",
                    category: "Monitor",
                    subcategory: "Gaming (High Refresh Rate)",
                    brand: "Gigabyte",
                    price: 20000000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A large format 48-inch OLED gaming monitor with a 120Hz refresh rate and true black performance.",
                    specs: {
                        "Panel Type": "48-inch OLED",
                        "Resolution": "4K UHD (3840x2160)",
                        "Refresh Rate": "120Hz",
                        "Sync Technology": "FreeSync Premium",
                    },
                }, {
                    id: 24,
                    name: "Logitech G915 TKL",
                    category: "Keyboard",
                    subcategory: "Wireless",
                    brand: "Logitech",
                    price: 3500000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A wireless mechanical gaming keyboard with low-profile GL switches and LIGHTSPEED connectivity.",
                    specs: {
                        "Switches": "GL Tactile Switches",
                        "Connectivity": "LIGHTSPEED Wireless",
                        "Lighting": "LIGHTSYNC RGB",
                        "Material": "Aircraft-grade Aluminum",
                    },
                }, {
                    id: 25,
                    name: "AMD Ryzen 7 7700X",
                    category: "Processor",
                    subcategory: "AMD Processors",
                    brand: "AMD",
                    price: 7000000,
                    oldPrice: 7500000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A high-performance CPU for gaming and productivity, built on the new AM5 platform.",
                    specs: {
                        "Cores/Threads": "8 Cores / 16 Threads",
                        "Max Clock Speed": "Up to 5.4 GHz",
                        "Socket": "AM5 Socket",
                        "Memory Support": "DDR5 Support",
                    },
                }, {
                    id: 26,
                    name: "MSI MAG B650 TOMAHAWK WIFI",
                    category: "Motherboard",
                    subcategory: "Platform AMD",
                    brand: "MSI",
                    price: 4200000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A robust motherboard for AMD Ryzen 7000 series processors, with excellent connectivity and power delivery.",
                    specs: {
                        "Chipset": "AMD B650 Chipset",
                        "Socket": "AM5 Socket",
                        "Memory Support": "DDR5 Support",
                        "Wireless": "Wi-Fi 6E",
                    },
                }, {
                    id: 27,
                    name: "Crucial P3 Plus 2TB",
                    category: "SSD",
                    subcategory: "SSD NVMe",
                    brand: "Crucial",
                    price: 3000000,
                    oldPrice: 3300000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A cost-effective yet fast NVMe SSD for high-speed storage.",
                    specs: {
                        "Capacity": "2TB",
                        "Interface": "NVMe PCIe Gen4",
                        "Read Speed": "up to 5000MB/s",
                        "Technology": "Micron Advanced 3D NAND",
                    },
                }, {
                    id: 28,
                    name: "Fractal Design Meshify C",
                    category: "Casing",
                    subcategory: "ATX Tower",
                    brand: "Fractal Design",
                    price: 1600000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A compact and high-performance ATX mid-tower case with an iconic mesh front panel.",
                    specs: {
                        "Form Factor": "Mid-Tower ATX",
                        "Side Panel": "Tempered Glass",
                        "Cooling": "High Airflow Design",
                        "Size": "Compact Footprint",
                    },
                }, {
                    id: 29,
                    name: "Razer DeathAdder V3 Pro",
                    category: "Mouse",
                    subcategory: "Mouse Gaming",
                    brand: "Razer",
                    price: 2400000,
                    oldPrice: 2600000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "An ultra-lightweight esports mouse with a refined ergonomic form factor.",
                    specs: {
                        "Weight": "63g Ultra-lightweight",
                        "Sensor": "Focus Pro 30K Optical Sensor",
                        "Switches": "Razer Optical Mouse Switches Gen-3",
                        "Design": "Ergonomic Form",
                    },
                }, {
                    id: 30,
                    name: "Corsair Vengeance RGB Pro 16GB",
                    category: "RAM",
                    subcategory: "DDR4",
                    brand: "Corsair",
                    price: 1500000,
                    oldPrice: 1700000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "Illuminate your system with vivid, animated lighting from ten individually addressable RGB LEDs per module.",
                    specs: {
                        "Capacity": "16GB (2x8GB)",
                        "Type": "DDR4 3200MHz",
                        "Compatibility": "Intel XMP 2.0",
                        "Lighting": "Dynamic Multi-Zone RGB Lighting",
                    },
                }, {
                    id: 31,
                    name: "ASUS TUF Gaming A15",
                    category: "Laptop",
                    subcategory: "Laptop Gaming",
                    brand: "ASUS",
                    price: 14000000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/product/laptop/1000.png') }}"],
                    url: "product-detail.html",
                    description: "Geared for serious gaming and real-world durability, the TUF Gaming A15 is a fully-loaded Windows 10 Pro gaming laptop that can carry you to victory.",
                    specs: {
                        "CPU": "AMD Ryzen 7 6800H",
                        "GPU": "RTX 3050",
                        "RAM": "16GB DDR5",
                        "Storage": "512GB NVMe SSD",
                        "Display": '15.6" 144Hz Display',
                    },
                }, {
                    id: 32,
                    name: "LG UltraGear 27GN950-B",
                    category: "Monitor",
                    subcategory: "Gaming (High Refresh Rate)",
                    brand: "LG",
                    price: 15000000,
                    oldPrice: 16500000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A stunning 4K UHD monitor with a 144Hz refresh rate, delivering an immersive gaming experience.",
                    specs: {
                        "Size/Resolution": "27-inch 4K UHD (3840x2160)",
                        "Refresh Rate": "144Hz",
                        "Panel Type": "Nano IPS Display",
                        "HDR": "VESA DisplayHDR 600",
                    },
                }, {
                    id: 33,
                    name: "SteelSeries Arctis 7+",
                    category: "Headset",
                    subcategory: "Headset Gaming",
                    brand: "SteelSeries",
                    price: 2500000,
                    oldPrice: 2800000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A comfortable and versatile wireless gaming headset with a long-lasting battery.",
                    specs: {
                        "Connectivity": "2.4 GHz Wireless",
                        "Audio Quality": "Lossless Audio",
                        "Microphone": "ClearCast Microphone",
                        "Battery Life": "24-hour",
                    },
                }, {
                    id: 34,
                    name: "Razer Huntsman Mini",
                    category: "Keyboard",
                    subcategory: "Mechanical",
                    brand: "Razer",
                    price: 1800000,
                    oldPrice: 2000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A compact 60% gaming keyboard with Razer Optical Switches for lightning-fast actuation.",
                    specs: {
                        "Switches": "Razer Linear Optical Switches",
                        "Form Factor": "60%",
                        "Keycaps": "Doubleshot PBT",
                        "Connectivity": "Detachable USB-C Cable",
                    },
                }, {
                    id: 35,
                    name: "Intel Core i7-13700K",
                    category: "Processor",
                    subcategory: "Intel Processors",
                    brand: "Intel",
                    price: 7500000,
                    oldPrice: 8000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A powerful CPU for high-end gaming and multi-tasking, offering a great balance of performance and price.",
                    specs: {
                        "Cores/Threads": "16 Cores / 24 Threads",
                        "Max Clock Speed": "Up to 5.4 GHz",
                        "Socket": "LGA 1700 Socket",
                        "Memory Support": "DDR5 Support",
                    },
                }, {
                    id: 36,
                    name: "EVGA SuperNOVA 1000 G6",
                    category: "PSU",
                    subcategory: "1000W+",
                    brand: "EVGA",
                    price: 3000000,
                    oldPrice: 3300000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A high-quality 1000W power supply with 80 PLUS Gold efficiency and a fully modular design.",
                    specs: {
                        "Wattage": "1000 Watts",
                        "Efficiency": "80 PLUS Gold Certified",
                        "Modularity": "Fully Modular",
                        "Features": "Eco Mode",
                    },
                }, {
                    id: 37,
                    name: "Samsung 980 Pro 2TB",
                    category: "SSD",
                    subcategory: "SSD NVMe",
                    brand: "Samsung",
                    price: 4500000,
                    oldPrice: 5000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A high-performance NVMe SSD designed for demanding applications and next-gen gaming consoles.",
                    specs: {
                        "Capacity": "2TB",
                        "Interface": "NVMe PCIe Gen4",
                        "Read Speed": "up to 7000MB/s",
                        "Features": "Heatsink Version Available",
                    },
                }, {
                    id: 38,
                    name: "NZXT Kraken X63",
                    category: "Cooling",
                    subcategory: "Pendingin CPU (CPU Cooler)",
                    brand: "NZXT",
                    price: 2800000,
                    oldPrice: 3000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A beautiful and effective liquid CPU cooler with a stunning infinity mirror design.",
                    specs: {
                        "Radiator Size": "280mm",
                        "Fans": "2x Aer P140",
                        "Lighting": "RGB Infinity Mirror",
                        "Software": "CAM Software Control",
                    },
                }, {
                    id: 39,
                    name: "Custom Build PC - Intel i7",
                    category: "PC Desktop",
                    subcategory: "PC Rakitan",
                    brand: "Intel",
                    price: 25000000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A custom-built PC optimized for high-performance gaming and streaming, powered by an Intel Core i7 processor.",
                    specs: {
                        "CPU": "Intel Core i7-13700K",
                        "GPU": "NVIDIA RTX 4070 Ti",
                        "RAM": "32GB DDR5",
                        "Storage": "1TB NVMe SSD",
                        "Cooling": "AIO Liquid Cooling",
                    },
                }, {
                    id: 40,
                    name: "Logitech G PRO X Headset",
                    category: "Headset",
                    subcategory: "Headset Gaming",
                    brand: "Logitech",
                    price: 2000000,
                    oldPrice: 2200000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The PRO X Gaming Headset is engineered for pros and designed with detachable mic and customizable sound profiles.",
                    specs: {
                        "Microphone Tech": "BLUE VO!CE Technology",
                        "Audio Tech": "DTS Headphone:X 2.0",
                        "Comfort": "Memory Foam Earpads",
                        "Build Material": "Durable Steel and Aluminum Construction",
                    },
                }, {
                    id: 41,
                    name: "ASUS ROG Swift PG32UQX",
                    category: "Monitor",
                    subcategory: "Profesional (Akurasi Warna)",
                    brand: "ASUS",
                    price: 30000000,
                    oldPrice: 32000000,
                    images: [
                        "{{ asset('assets/demo/toko-komputer/img/product/laptop/ASUSROGSwift27.png') }}",
                    ],
                    url: "product-detail.html",
                    description: "An ultimate 32-inch gaming monitor with Mini-LED technology for stunning visuals and a high refresh rate.",
                    specs: {
                        "Size/Resolution": "32-inch 4K UHD",
                        "Backlight": "Mini-LED",
                        "Refresh Rate": "144Hz",
                        "Sync Technology": "G-Sync Ultimate",
                    },
                }, {
                    id: 42,
                    name: "Corsair K100 RGB",
                    category: "Keyboard",
                    subcategory: "Mechanical",
                    brand: "Corsair",
                    price: 3800000,
                    oldPrice: 4000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The CORSAIR K100 RGB is the pinnacle of CORSAIR keyboards, blending stunning design, a durable aluminum frame, and per-key RGB lighting.",
                    specs: {
                        "Switches": "CORSAIR OPX RGB Optical-Mechanical",
                        "Technology": "AXON Hyper-Processing",
                        "Lighting": "44-Zone RGB LightEdge",
                        "Ergonomics": "Detachable Magnetic Palm Rest",
                    },
                }, {
                    id: 43,
                    name: "NVIDIA GeForce RTX 4070 Ti",
                    category: "GPU",
                    subcategory: "NVIDIA GeForce",
                    brand: "NVIDIA",
                    price: 12000000,
                    oldPrice: 13500000,
                    isPromo: true, // ADDED
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The NVIDIA GeForce RTX 4070 Ti delivers incredible performance for gamers and creators, with DLSS 3 and real-time ray tracing.",
                    specs: {
                        "Memory": "12GB GDDR6X",
                        "Interface": "PCIe 4.0",
                        "Features 1": "DLSS 3",
                        "Features 2": "Ray Tracing",
                    },
                }, {
                    id: 44,
                    name: "Kingston Fury Beast 64GB",
                    category: "RAM",
                    subcategory: "DDR5",
                    brand: "Kingston",
                    price: 4500000,
                    oldPrice: null,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "High-speed DDR5 memory with aggressive styling and powerful performance for the latest platforms.",
                    specs: {
                        "Capacity": "64GB (2x32GB)",
                        "Type": "DDR5 5200MHz",
                        "Compatibility": "Intel XMP 3.0",
                        "Features": "Plug N Play",
                    },
                }, {
                    id: 45,
                    name: "Lian Li PC-O11 Dynamic",
                    category: "Casing",
                    subcategory: "ATX Tower",
                    brand: "Lian Li",
                    price: 2500000,
                    oldPrice: 2800000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A sleek and stylish case designed for custom water cooling and showcasing your high-end components.",
                    specs: {
                        "Form Factor": "Mid-Tower ATX",
                        "Design": "Dual Chamber",
                        "Panels": "Tempered Glass",
                        "Cooling Support": "Excellent Water Cooling",
                    },
                }, {
                    id: 46,
                    name: "Logitech G203 LIGHTSYNC",
                    category: "Mouse",
                    subcategory: "Mouse Gaming",
                    brand: "Logitech",
                    price: 450000,
                    oldPrice: 550000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A versatile gaming mouse with customizable LIGHTSYNC RGB lighting and a gaming-grade sensor.",
                    specs: {
                        "Sensor": "8000 DPI",
                        "Buttons": "6 Programmable",
                        "Lighting": "LIGHTSYNC RGB",
                        "Design": "Classic",
                    },
                }, {
                    id: 47,
                    name: "AMD Ryzen 5 7600X",
                    category: "Processor",
                    subcategory: "AMD Processors",
                    brand: "AMD",
                    price: 4500000,
                    oldPrice: 5000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The perfect CPU for mid-range gaming, offering excellent performance at an accessible price.",
                    specs: {
                        "Cores/Threads": "6 Cores / 12 Threads",
                        "Max Clock Speed": "Up to 5.3 GHz",
                        "Socket": "AM5 Socket",
                        "Memory Support": "DDR5 Support",
                    },
                }, {
                    id: 48,
                    name: "MSI GeForce RTX 3060 VENTUS 2X 12G",
                    category: "GPU",
                    subcategory: "NVIDIA GeForce",
                    brand: "MSI",
                    price: 6500000,
                    oldPrice: 7000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "The RTX 3060 delivers solid performance for 1080p and 1440p gaming with a great price-to-performance ratio.",
                    specs: {
                        "Memory": "12GB GDDR6",
                        "Interface": "PCIe 4.0",
                        "Cooling": "Twin Fan Thermal Design",
                        "Features": "Ray Tracing",
                    },
                }, {
                    id: 49,
                    name: "Corsair K70 RGB PRO",
                    category: "Keyboard",
                    subcategory: "Mechanical",
                    brand: "Corsair",
                    price: 2500000,
                    oldPrice: 2700000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "An iconic mechanical gaming keyboard with tournament-level performance and durability.",
                    specs: {
                        "Switches": "CHERRY MX Mechanical",
                        "Keycaps": "PBT Double-Shot PRO",
                        "Technology": "AXON Hyper-Processing",
                        "Features": "Tournament Switch",
                    },
                }, {
                    id: 50,
                    name: "HP OMEN 27c",
                    category: "Monitor",
                    subcategory: "Gaming (High Refresh Rate)",
                    brand: "HP",
                    price: 7500000,
                    oldPrice: 8000000,
                    images: ["{{ asset('assets/demo/toko-komputer/img/temp/computer-store.png') }}"],
                    url: "product-detail.html",
                    description: "A curved QHD gaming monitor with a fast refresh rate and adaptive sync technology for smooth gameplay.",
                    specs: {
                        "Size/Resolution": "27-inch QHD (2560x1440)",
                        "Refresh Rate": "240Hz",
                        "Curvature": "1000R",
                        "Sync Technology": "AMD FreeSync Premium Pro",
                    },
                }
            ];
            console.log('Products array:', products);

            // ADDED: stok default via mapping (tanpa mengubah array products)
            const productStock = {
                2: 0,
                7: 12,
                10: 0,
                22: 5
            }; // contoh; sisakan yang lain default
            products.forEach((p) => {
                p.stock = productStock[p.id] ?? p.stock ?? 20;
            });

            // ADDED: Category display functionality
            const setupCategoryDisplay = () => {
                console.log('setupCategoryDisplay function called');
                const categoryDisplay = document.getElementById("category-display");
                if (!categoryDisplay)
                    return;
                // Count products by category
                const categoryCounts = {};
                products.forEach(
                    (product) => {
                        const category = product.category;
                        categoryCounts[category] = (categoryCounts[category] || 0) + 1;
                    }
                );

                // Sort categories by product count (descending) then alphabetically
                const sortedCategories = Object.entries(categoryCounts).sort((a, b) => {
                    if (b[1] !== a[1])
                        return b[1] - a[1]; // Sort by count descending
                    return a[0].localeCompare(b[0]); // Then alphabetically
                });

                const categoryFilter = document.getElementById('category-filter');
                if (categoryFilter) {
                    // Clear existing options except the first one ("All")
                    while (categoryFilter.options.length > 1) {
                        categoryFilter.remove(1);
                    }

                    sortedCategories.forEach(([category, count]) => {
                        const option = document.createElement('option');
                        option.value = category;
                        option.textContent = `${category}`;
                        categoryFilter.appendChild(option);
                    });
                }

                // Create category cards using template
                categoryDisplay.innerHTML = "";
                const categoryTemplate = document.getElementById("category-card-template");

                // Map to store the first image for each category
                const categoryImages = {};
                products.forEach(product => {
                    if (!categoryImages[product.category] && product.images && product.images.length >
                        0) {
                        categoryImages[product.category] = product.images[0];
                    }
                });

                sortedCategories.forEach(([category, count], index) => {
                    const categoryCard = categoryTemplate.content.cloneNode(true);
                    const cardElement = categoryCard.querySelector(".category-card");
                    const categoryImage = categoryCard.querySelector(".category-image");
                    const categoryName = categoryCard.querySelector(".category-name");
                    const categoryCount = categoryCard.querySelector(".category-count");

                    // Populate template with data
                    categoryName.textContent = category;
                    categoryCount.textContent = `${count} produk`;

                    // Set category image
                    categoryImage.src = categoryImages[category] ||
                        "{{ asset('assets/images/no-image-icon.png') }}";
                    categoryImage.alt = category;

                    // Hide cards beyond the 11th one initially
                    if (index >= 12) {
                        cardElement.classList.add('hidden', 'category-hidden');
                    }

                    // Add click handler to filter by category
                    cardElement.addEventListener("click", () => {
                        const categoryFilter = document.getElementById("category-filter");
                        let activeCategory = category;

                        // Deselect if clicking the same card again
                        if (cardElement.classList.contains('category-active')) {
                            cardElement.classList.remove('category-active');
                            document.querySelectorAll('.category-card').forEach(c => c.classList
                                .remove('category-active'));
                            activeCategory = 'all';
                            document.getElementById("subcategory-display-container").classList
                                .add('hidden');
                            if (categoryFilter) {
                                categoryFilter.value = 'all';
                            }
                        } else {
                            // Remove active state from other cards and add to current
                            document.querySelectorAll('.category-card').forEach(c => c.classList
                                .remove('category-active'));
                            cardElement.classList.add('category-active');
                        }


                        if (categoryFilter) {
                            categoryFilter.value = activeCategory;
                        }

                        updateSubcategoryDisplay(activeCategory);
                        applyFilters();
                        document.getElementById('product-grid-toolbar').scrollIntoView({
                            behavior: 'smooth'
                        });
                    });
                    categoryDisplay.appendChild(categoryCard);
                });

                // Add 'Show More' button if there are more than 11 categories
                if (sortedCategories.length > 11) {
                    const showMoreButtonContainer = document.createElement('div');
                    showMoreButtonContainer.className = 'col-span-full text-center mt-4';
                    showMoreButtonContainer.innerHTML =
                        `
                            <button id="show-more-categories-btn"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <span id="show-more-text">Lihat lainnya</span>
                                <i data-lucide="chevron-down" class="h-4 w-4 ml-2 transition-transform duration-300" id="show-more-icon"></i>
                            </button>
                        `;
                    categoryDisplay.appendChild(showMoreButtonContainer);

                    // Re-render lucide icons for the new button
                    lucide.createIcons();

                    const showMoreBtn = document.getElementById('show-more-categories-btn');
                    let isExpanded = false;
                    showMoreBtn.addEventListener('click', () => {
                        isExpanded = !isExpanded;
                        document.querySelectorAll('.category-hidden').forEach(card => {
                            card.classList.toggle('hidden');
                        });

                        const showMoreText = document.getElementById('show-more-text');
                        const showMoreIcon = document.getElementById('show-more-icon');

                        if (isExpanded) {
                            showMoreText.textContent = 'Sembunyikan';
                            showMoreIcon.style.transform = 'rotate(180deg)';
                        } else {
                            showMoreText.textContent = 'Lihat lainnya';
                            showMoreIcon.style.transform = 'rotate(0deg)';
                        }
                    });
                }
            };

            // ADDED: ref elemen sorting & counter
            const categoryFilter = document.getElementById("category-filter");
            const sortSelect = document.getElementById("sort-select");
            const resultCount = document.getElementById("result-count");

            // ADDED: fungsi sorting dengan prioritas stok
            const sortProducts = (arr) => {
                const mode = sortSelect?.value || "relevance";
                const a = [...arr];

                // Fungsi untuk sorting berdasarkan mode yang dipilih
                const applySortMode = (products) => {
                    switch (mode) {
                        case "price-asc":
                            return products.sort((x, y) => x.price - y.price);
                        case "price-desc":
                            return products.sort((x, y) => y.price - x.price);
                        case "name-asc":
                            return products.sort((x, y) => x.name.localeCompare(y.name));
                        case "name-desc":
                            return products.sort((x, y) => y.name.localeCompare(x.name));
                        case "newest":
                            return products.sort((x, y) => y.id - x.id); // asumsi id naik = lebih baru
                        default:
                            return products; // relevansi = hasil filter apa adanya
                    }
                };

                // Pisahkan produk berdasarkan stok
                const inStock = a.filter((product) => product.stock > 0);
                const outOfStock = a.filter((product) => product.stock <= 0);

                // Terapkan sorting pada masing-masing grup
                const sortedInStock = applySortMode(inStock);
                const sortedOutOfStock = applySortMode(outOfStock);

                // Gabungkan: produk berstock di depan, stok habis di belakang
                return [...sortedInStock, ...sortedOutOfStock];
            };

            const productGrid = document.getElementById("product-grid");
            const noResults = document.getElementById("no-results");
            const subcategoryFilterContainer = document.getElementById('subcategory-filter-container');
            const subcategoryFilter = document.getElementById('subcategory-filter');
            const minPriceFilter = document.getElementById("min-price-filter");
            const maxPriceFilter = document.getElementById("max-price-filter");
            const brandFilter = document.getElementById("brand-filter");
            const resetFiltersBtn = document.getElementById("reset-filters");
            const searchInput = document.getElementById("search-input");
            const modal = document.getElementById("product-modal");
            const modalClose = document.getElementById("modal-close");
            const mainImage = document.getElementById("main-image");
            const productTitle = document.getElementById("product-title");
            const productCategory = document.getElementById("product-category-text");
            const currentPrice = document.getElementById("current-price");
            const originalPrice = document.getElementById("original-price");
            const productDescription = document.getElementById("product-description");
            const productSpecs = document.getElementById("product-specs");
            const thumbnailContainer = document.getElementById("thumbnail-container");
            const paginationContainer = document.getElementById("pagination-container");
            const minPriceDisplay = document.getElementById("min-price-display");
            const maxPriceDisplay = document.getElementById("max-price-display");

            let currentPage = 1;
            const productsPerPage = 18;
            let filteredProducts = [];
            const formatNumberInput = (event) => {
                const input = event.target;
                let cursorPosition = input.selectionStart;
                const originalValue = input.value;
                const rawValue = input.value.replace(/[^0-9]/g, "");
                const hiddenInput = document.getElementById(input.id.replace("-display", "-filter"));
                if (hiddenInput) {
                    hiddenInput.value = rawValue;
                }

                if (rawValue) {
                    const formattedValue = new Intl.NumberFormat("id-ID").format(rawValue);
                    input.value = formattedValue;
                } else {
                    input.value = "";
                }

                const newLength = input.value.length;
                const originalLength = originalValue.length;
                if (newLength > originalLength) {
                    cursorPosition = cursorPosition + (newLength - originalLength);
                }
                input.setSelectionRange(cursorPosition, cursorPosition);
            };

            const formatPrice = (price) => {
                if (!price)
                    return "";
                return new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0,
                    })
                    .format(price)
                    .replace(
                        "IDR",
                        "Rp"
                    );
            };

            const openModal = (product) => {
                // Set up lightbox images array for this product
                currentLightboxImages = product.images;
                currentLightboxIndex = 0;
                mainImage.src = product.images[0];
                productTitle.textContent = product.name;
                productCategory.textContent = product.subcategory ?
                    `${product.category} > ${product.subcategory}` : product.category;
                currentPrice.textContent = formatPrice(product.price);
                if (product.oldPrice) {
                    originalPrice.textContent = formatPrice(product.oldPrice);
                    originalPrice.classList.remove("hidden");
                } else {
                    originalPrice.classList.add("hidden");
                }

                // ADDED: promo badge & stok overlay
                const promoBadgeEl = document.getElementById("promo-badge");

                // Get the span inside the promo-badge div
                const promoBadgeSpan = promoBadgeEl.querySelector("span");
                const stockOverlayEl = document.getElementById("stock-overlay");

                // Always hide by default
                promoBadgeEl.classList.add("hidden");
                if (product.isPromo) {
                    promoBadgeEl.classList.remove("hidden");
                    promoBadgeSpan.textContent = "Promo";
                }

                if (product.stock <= 0) {
                    stockOverlayEl.classList.remove("hidden");
                } else {
                    stockOverlayEl.classList.add("hidden");
                }

                if (product.stock <= 0) {
                    stockOverlayEl.classList.remove("hidden");
                } else {
                    stockOverlayEl.classList.add("hidden");
                }

                // ADDED: share handlers
                const shareBtn = document.getElementById("share-button");
                const copyBtn = document.getElementById("copy-link-button");
                const productUrl =
                    `${location.origin}${location.pathname}?product=${encodeURIComponent(product.id)}`;

                shareBtn?.addEventListener("click", async () => {
                    try {
                        if (navigator.share) {
                            await navigator.share({
                                title: product.name,
                                text: `${product.name} - ${formatPrice(product.price)}`,
                                url: productUrl,
                            });
                        } else {
                            await navigator.clipboard.writeText(productUrl);
                            alert("Link produk disalin ke clipboard.");
                        }
                    } catch (e) {
                        console.error(e);
                    }
                });

                copyBtn?.addEventListener("click", async () => {
                    try {
                        await navigator.clipboard.writeText(productUrl);
                        alert("Link produk disalin ke clipboard.");
                    } catch (e) {
                        console.error(e);
                    }
                });

                productDescription.textContent = product.description;
                productSpecs.innerHTML = "";

                // Similar Products Logic
                const similarProductsContainer = document.getElementById('similar-products-container');
                similarProductsContainer.innerHTML = ''; // Clear previous similar products

                const similarProducts = products.filter(p =>
                    p.category === product.category && p.id !== product.id
                );

                // Shuffle and take up to 3
                const shuffledSimilar = similarProducts.sort(() => 0.5 - Math.random());
                const selectedSimilar = shuffledSimilar.slice(0, 3);

                if (selectedSimilar.length > 0) {
                    selectedSimilar.forEach(similarProd => {
                        const similarProdCard = document.createElement('div');
                        similarProdCard.className = 'cursor-pointer';
                        similarProdCard.innerHTML = `
                            <img src="${similarProd.images[0]}" alt="${similarProd.name}" class="w-full h-auto object-cover rounded-lg mb-1">
                            <p class="text-xs font-medium text-gray-800 line-clamp-2">${similarProd.name}</p>
                            <p class="text-xs text-gray-600">${formatPrice(similarProd.price)}</p>
                        `;
                        similarProdCard.addEventListener('click', () => {
                            openModal(similarProd); // Open modal for similar product
                        });
                        similarProductsContainer.appendChild(similarProdCard);
                    });
                } else {
                    similarProductsContainer.innerHTML =
                        '<p class="text-sm text-gray-500">Tidak ada produk serupa.</p>';
                }

                const hasContent = (val) => {
                    if (val === null || val === undefined)
                        return false;
                    if (typeof val === "string")
                        return val.trim() !== "";
                    return true;
                };

                const specsEntries = [];
                const specsData = product.specs;
                if (Array.isArray(specsData)) {
                    specsData.forEach((item) => {
                        if (typeof item === "string") {
                            if (hasContent(item)) {
                                specsEntries.push([null, item.trim()]);
                            }
                            return;
                        }

                        if (item && typeof item === "object") {
                            if ("key" in item && "value" in item) {
                                if (hasContent(item.value)) {
                                    specsEntries.push([item.key, item.value]);
                                }
                                return;
                            }

                            Object
                                .entries(
                                    item
                                )
                                .forEach(
                                    ([entryKey,
                                        entryValue
                                    ]) => {
                                        if (hasContent(
                                                entryValue
                                            )) {
                                            specsEntries
                                                .push(
                                                    [entryKey,
                                                        entryValue
                                                    ]
                                                );
                                        }
                                    }
                                );
                        }
                    });
                } else if (
                    specsData &&
                    typeof specsData ===
                    "object"
                ) {
                    Object
                        .entries(
                            specsData
                        )
                        .forEach(
                            ([entryKey,
                                entryValue
                            ]) => {
                                if (hasContent(
                                        entryValue
                                    )) {
                                    specsEntries
                                        .push(
                                            [entryKey,
                                                entryValue
                                            ]
                                        );
                                }
                            }
                        );
                } else if (
                    typeof specsData ===
                    "string" &&
                    hasContent(
                        specsData
                    )
                ) {
                    specsEntries
                        .push(
                            [null,
                                specsData
                                .trim()
                            ]
                        );
                }

                if (specsEntries
                    .length >
                    0
                ) {
                    specsEntries
                        .forEach(
                            ([label,
                                value
                            ]) => {
                                const
                                    li =
                                    document
                                    .createElement(
                                        "li"
                                    );
                                li.className =
                                    "flex justify-between py-1";

                                const
                                    labelSpan =
                                    document
                                    .createElement(
                                        "span"
                                    );
                                labelSpan
                                    .className =
                                    "text-gray-600";
                                labelSpan
                                    .textContent =
                                    label &&
                                    hasContent(
                                        label
                                    ) ?
                                    String(
                                        label
                                    ) :
                                    String
                                    .fromCharCode(
                                        8226
                                    );

                                const
                                    valueSpan =
                                    document
                                    .createElement(
                                        "span"
                                    );
                                valueSpan
                                    .className =
                                    "font-medium";
                                valueSpan
                                    .textContent =
                                    String(
                                        value
                                    );

                                li.appendChild(
                                    labelSpan
                                );
                                li.appendChild(
                                    valueSpan
                                );
                                productSpecs
                                    .appendChild(
                                        li
                                    );
                            }
                        );
                } else {
                    productSpecs
                        .innerHTML =
                        '<li class="text-gray-500 italic">Tidak ada spesifikasi</li>';
                }
                thumbnailContainer
                    .innerHTML =
                    "";
                const
                    thumbnailTemplate =
                    document
                    .getElementById(
                        "thumbnail-template"
                    );

                product
                    .images
                    .forEach(
                        (image,
                            index
                        ) => {
                            const
                                thumbnailElement =
                                thumbnailTemplate
                                .content
                                .cloneNode(
                                    true
                                );
                            const
                                button =
                                thumbnailElement
                                .querySelector(
                                    ".thumbnail"
                                );
                            const
                                thumbnailImage =
                                thumbnailElement
                                .querySelector(
                                    ".thumbnail-image"
                                );

                            // Populate template with data
                            thumbnailImage
                                .src =
                                image;
                            thumbnailImage
                                .alt =
                                `Image ${index + 1}`;

                            if (index ===
                                0
                            ) {
                                button
                                    .classList
                                    .add(
                                        "border-blue-600"
                                    );
                            }

                            button
                                .addEventListener(
                                    "click",
                                    () => {
                                        mainImage
                                            .src =
                                            image;
                                        document
                                            .querySelectorAll(
                                                ".thumbnail"
                                            )
                                            .forEach(
                                                (
                                                    thumb
                                                ) =>
                                                thumb
                                                .classList
                                                .remove(
                                                    "border-blue-600"
                                                )
                                            );
                                        button
                                            .classList
                                            .add(
                                                "border-blue-600"
                                            );
                                    }
                                );

                            thumbnailContainer
                                .appendChild(
                                    thumbnailElement
                                );
                        }
                    );

                modal
                    .classList
                    .remove(
                        "hidden"
                    );
                lucide
                    .createIcons();
            };

            const
                closeModal =
                () => {
                    modal
                        .classList
                        .add(
                            "hidden"
                        );
                };

            modalClose
                .addEventListener(
                    "click",
                    closeModal
                );
            window
                .addEventListener(
                    "click",
                    (
                        event
                    ) => {
                        if (event
                            .target ==
                            modal
                        ) {
                            closeModal
                                ();
                        }
                    }
                );

            const
                renderProducts =
                (
                    productsToRender
                ) => {
                    console.log('renderProducts function called with:', productsToRender);
                    // Clear existing products but keep template
                    const
                        existingCards =
                        productGrid
                        .querySelectorAll(
                            ".product-card:not(template *)"
                        );
                    existingCards
                        .forEach(
                            (
                                card
                            ) =>
                            card
                            .remove()
                        );

                    if (productsToRender
                        .length ===
                        0
                    ) {
                        productGrid
                            .classList
                            .add(
                                "hidden"
                            );
                        noResults
                            .classList
                            .remove(
                                "hidden"
                            );
                        paginationContainer
                            .classList
                            .add(
                                "hidden"
                            );
                        lucide
                            .createIcons();
                        return;
                    }

                    productGrid
                        .classList
                        .remove(
                            "hidden"
                        );
                    noResults
                        .classList
                        .add(
                            "hidden"
                        );
                    paginationContainer
                        .classList
                        .remove(
                            "hidden"
                        );

                    const
                        startIndex =
                        (currentPage -
                            1
                        ) *
                        productsPerPage;
                    const
                        endIndex =
                        startIndex +
                        productsPerPage;
                    const
                        productsOnPage =
                        productsToRender
                        .slice(
                            startIndex,
                            endIndex
                        );

                    const
                        template =
                        document
                        .getElementById(
                            "product-card-template"
                        );

                    productsOnPage
                        .forEach(
                            (
                                product
                            ) => {
                                // Clone template
                                const
                                    productCard =
                                    template
                                    .content
                                    .cloneNode(
                                        true
                                    );
                                const
                                    cardElement =
                                    productCard
                                    .querySelector(
                                        ".product-card"
                                    );

                                // Get elements from template
                                const
                                    imageContainer =
                                    productCard
                                    .querySelector(
                                        ".product-image-container"
                                    );
                                const
                                    productImage =
                                    productCard
                                    .querySelector(
                                        ".product-image"
                                    );
                                const
                                    promoBadge = // ADDED
                                    productCard
                                    .querySelector(
                                        ".promo-badge"
                                    );
                                const
                                    stockOverlay =
                                    productCard
                                    .querySelector(
                                        ".stock-overlay"
                                    );
                                const
                                    productName =
                                    productCard
                                    .querySelector(
                                        ".product-name"
                                    );
                                const
                                    productCategory =
                                    productCard
                                    .querySelector(
                                        ".product-category"
                                    );
                                const
                                    productPrice =
                                    productCard
                                    .querySelector(
                                        ".product-price"
                                    );
                                const
                                    productOldPrice =
                                    productCard
                                    .querySelector(
                                        ".product-old-price"
                                    );

                                // Calculate discount and stock status
                                const
                                    isOut =
                                    product
                                    .stock <=
                                    0;

                                // Populate template with product data
                                productImage
                                    .src =
                                    product
                                    .images[
                                        0
                                    ];
                                productImage
                                    .alt =
                                    product
                                    .name;
                                productName
                                    .textContent =
                                    product
                                    .name;
                                productCategory
                                    .textContent =
                                    product.subcategory ? `${product.category} > ${product.subcategory}` : product
                                    .category;
                                productPrice.textContent =
                                    formatPrice(
                                        product
                                        .price
                                    );

                                // Handle promo badge // ADDED
                                if (product.isPromo) {
                                    promoBadge.classList.remove("hidden");
                                } else {
                                    promoBadge.classList.add("hidden");
                                }

                                // Handle old price and savings badge
                                const savingsBadge = productCard.querySelector('.savings-badge');

                                if (product.oldPrice && product.oldPrice > product.price) {
                                    productOldPrice.textContent = formatPrice(product.oldPrice);
                                    productOldPrice.classList.remove("hidden");

                                    const savings = product.oldPrice - product.price;
                                    savingsBadge.textContent = `Hemat ${formatPrice(savings)}`;
                                    savingsBadge.classList.remove('hidden');
                                } else {
                                    productOldPrice.classList.add("hidden");
                                    savingsBadge.classList.add('hidden');
                                }

                                // Handle out of stock
                                if (
                                    isOut
                                ) {
                                    imageContainer
                                        .classList
                                        .add(
                                            "grayscale"
                                        );
                                    stockOverlay
                                        .classList
                                        .remove(
                                            "hidden"
                                        );
                                }

                                // Add click event

                                cardElement.addEventListener("click", () => {

                                    console.log('Product card clicked. Product ID:', product
                                    .id); // Debugging line

                                    console.log('Product data:', product); // Debugging line

                                    openModal(product);

                                });

                                // Append to grid
                                productGrid
                                    .appendChild(
                                        productCard
                                    );
                            }
                        );
                    lucide
                        .createIcons();
                };

            const
                displayPagination =
                (
                    productsToPaginate
                ) => {
                    // Clear existing pagination but keep templates
                    const
                        existingPagination =
                        paginationContainer
                        .querySelectorAll(
                            ":not(template)"
                        );
                    existingPagination
                        .forEach(
                            (
                                el
                            ) =>
                            el
                            .remove()
                        );

                    const
                        pageCount =
                        Math
                        .ceil(
                            productsToPaginate
                            .length /
                            productsPerPage
                        );

                    if (pageCount <=
                        1
                    ) {
                        paginationContainer
                            .classList
                            .add(
                                "hidden"
                            );
                        return;
                    } else {
                        paginationContainer
                            .classList
                            .remove(
                                "hidden"
                            );
                    }

                    const
                        paginationTemplate =
                        document
                        .getElementById(
                            "pagination-template"
                        );
                    const
                        pageButtonTemplate =
                        document
                        .getElementById(
                            "page-button-template"
                        );

                    // Clone pagination template
                    const
                        paginationElement =
                        paginationTemplate
                        .content
                        .cloneNode(
                            true
                        );
                    const
                        prevButton =
                        paginationElement
                        .querySelector(
                            ".pagination-prev"
                        );
                    const
                        nextButton =
                        paginationElement
                        .querySelector(
                            ".pagination-next"
                        );
                    const
                        numbersContainer =
                        paginationElement
                        .querySelector(
                            ".pagination-numbers"
                        );

                    // Setup prev button with responsive classes
                    prevButton
                        .className = `pagination-prev px-2 py-2 sm:px-4 border rounded-lg text-sm sm:text-base min-w-[44px] sm:min-w-auto ${
                        currentPage === 1
                            ? "text-gray-400 cursor-not-allowed bg-gray-50"
                            : "hover:bg-gray-100 transition"
                    }`;
                    prevButton
                        .disabled =
                        currentPage ===
                        1;
                    prevButton
                        .addEventListener(
                            "click",
                            () => {
                                if (currentPage >
                                    1
                                ) {
                                    currentPage--;
                                    renderProducts
                                        (
                                            productsToPaginate
                                        );
                                    displayPagination
                                        (
                                            productsToPaginate
                                        );
                                }
                            }
                        );

                    // Smart pagination: limit visible page numbers based on screen size and current page
                    const
                        getVisiblePages =
                        () => {
                            const
                                isMobile =
                                window
                                .innerWidth <
                                640; // sm breakpoint
                            const
                                maxVisible =
                                isMobile ?
                                3 :
                                7; // Show fewer pages on mobile

                            if (pageCount <=
                                maxVisible
                            ) {
                                return Array
                                    .from({
                                            length: pageCount
                                        },
                                        (_,
                                            i
                                        ) =>
                                        i +
                                        1
                                    );
                            }

                            const
                                half =
                                Math
                                .floor(
                                    maxVisible /
                                    2
                                );
                            let start =
                                Math
                                .max(
                                    1,
                                    currentPage -
                                    half
                                );
                            let end =
                                Math
                                .min(
                                    pageCount,
                                    start +
                                    maxVisible -
                                    1
                                );

                            // Adjust start if we're near the end
                            if (end -
                                start +
                                1 <
                                maxVisible
                            ) {
                                start =
                                    Math
                                    .max(
                                        1,
                                        end -
                                        maxVisible +
                                        1
                                    );
                            }

                            const
                                pages = [];

                            // Add first page and ellipsis if needed
                            if (start >
                                1
                            ) {
                                pages
                                    .push(
                                        1
                                    );
                                if (start >
                                    2
                                ) {
                                    pages
                                        .push(
                                            "..."
                                        );
                                }
                            }

                            // Add visible pages
                            for (
                                let i =
                                    start; i <=
                                end; i++
                            ) {
                                pages
                                    .push(
                                        i
                                    );
                            }

                            // Add ellipsis and last page if needed
                            if (end <
                                pageCount
                            ) {
                                if (end <
                                    pageCount -
                                    1
                                ) {
                                    pages
                                        .push(
                                            "..."
                                        );
                                }
                                pages
                                    .push(
                                        pageCount
                                    );
                            }

                            return pages;
                        };

                    // Create page number buttons with smart pagination
                    const
                        visiblePages =
                        getVisiblePages();
                    visiblePages
                        .forEach(
                            (
                                page
                            ) => {
                                if (page ===
                                    "..."
                                ) {
                                    // Create ellipsis element
                                    const
                                        ellipsis =
                                        document
                                        .createElement(
                                            "span"
                                        );
                                    ellipsis
                                        .className =
                                        "px-2 py-2 sm:px-4 text-gray-500 text-sm sm:text-base min-w-[44px] min-h-[44px] sm:min-w-auto sm:min-h-auto flex items-center justify-center";
                                    ellipsis
                                        .textContent =
                                        "...";
                                    numbersContainer
                                        .appendChild(
                                            ellipsis
                                        );
                                } else {
                                    const
                                        pageButtonElement =
                                        pageButtonTemplate
                                        .content
                                        .cloneNode(
                                            true
                                        );
                                    const
                                        pageButton =
                                        pageButtonElement
                                        .querySelector(
                                            ".page-button"
                                        );

                                    pageButton
                                        .className = `page-button px-2 py-2 sm:px-4 border rounded-lg text-sm sm:text-base min-w-[44px] min-h-[44px] sm:min-w-auto sm:min-h-auto ${
                                page === currentPage
                                    ? "bg-cyan-500 text-white border-cyan-500"
                                    : "hover:bg-gray-100 transition"
                            }`;
                                    pageButton
                                        .textContent =
                                        page;
                                    pageButton
                                        .addEventListener(
                                            "click",
                                            () => {
                                                currentPage =
                                                    page;
                                                renderProducts
                                                    (
                                                        productsToPaginate
                                                    );
                                                displayPagination
                                                    (
                                                        productsToPaginate
                                                    );
                                            }
                                        );
                                    numbersContainer
                                        .appendChild(
                                            pageButtonElement
                                        );
                                }
                            }
                        );

                    // Setup next button with responsive classes
                    nextButton
                        .className = `pagination-next px-2 py-2 sm:px-4 border rounded-lg text-xs text-sm sm:text-base min-w-[32px] xs:min-w-[40px] sm:min-w-auto ${
                        currentPage === pageCount
                            ? "text-gray-400 cursor-not-allowed bg-gray-50"
                            : "hover:bg-gray-100 transition"
                    }`;
                    nextButton
                        .disabled =
                        currentPage ===
                        pageCount;
                    nextButton
                        .addEventListener(
                            "click",
                            () => {
                                if (currentPage <
                                    pageCount
                                ) {
                                    currentPage++;
                                    renderProducts
                                        (
                                            productsToPaginate
                                        );
                                    displayPagination
                                        (
                                            productsToPaginate
                                        );
                                }
                            }
                        );

                    paginationContainer
                        .appendChild(
                            paginationElement
                        );
                };







            const updateSubcategoryDisplay = (activeCategory) => {
                const subcategoryContainer = document.getElementById("subcategory-display-container");
                const subcategoryDisplay = document.getElementById("subcategory-display");
                const selectedCategoryName = document.getElementById("selected-category-name");
                const subcategoryTemplate = document.getElementById("subcategory-checkbox-template");

                const subcategories = [...new Set(products.filter(p => p.category === activeCategory && p
                    .subcategory).map(p => p.subcategory))].sort();

                subcategoryDisplay.innerHTML = '';

                if (subcategories.length > 0) {
                    selectedCategoryName.textContent = activeCategory;

                    // Add an "All" radio button
                    const allRadioClone = subcategoryTemplate.content.cloneNode(true);
                    const allDiv = allRadioClone.querySelector('div');
                    const allInput = allDiv.querySelector('input');
                    const allLabel = allDiv.querySelector('label');
                    const allSpan = allLabel.querySelector('span');
                    const allInputId = `subcat-${activeCategory.replace(/\s+/g, '-')}-all`;

                    allInput.id = allInputId;
                    allInput.value = 'all';
                    allInput.checked = true;
                    allInput.addEventListener('change', applyFilters);
                    allLabel.htmlFor = allInputId;
                    allSpan.textContent = 'All';
                    subcategoryDisplay.appendChild(allDiv);

                    subcategories.forEach((subcategory, index) => {
                        const radioClone = subcategoryTemplate.content.cloneNode(true);
                        const div = radioClone.querySelector('div');
                        const input = div.querySelector('input');
                        const label = div.querySelector('label');
                        const span = label.querySelector('span');
                        const inputId = `subcat-${activeCategory.replace(/\s+/g, '-')}-${index}`;

                        input.id = inputId;
                        input.value = subcategory;
                        input.addEventListener('change', applyFilters);
                        label.htmlFor = inputId;
                        span.textContent = subcategory;

                        subcategoryDisplay.appendChild(div);
                    });

                    subcategoryContainer.classList.remove('hidden');
                } else {
                    subcategoryContainer.classList.add('hidden');
                }
            };

            const applyFilters = () => {
                const
                    searchTerm =
                    searchInput
                    .value
                    .toLowerCase();
                const
                    selectedCategory =
                    categoryFilter ? categoryFilter.value : 'all';


                const
                    minPrice =
                    parseFloat(
                        minPriceFilter
                        .value
                    ) ||
                    0;
                const
                    maxPrice =
                    parseFloat(
                        maxPriceFilter
                        .value
                    ) ||
                    Infinity;
                const
                    brandSelections =
                    getBrandSelections();
                const isSubcategoryVisible = !document.getElementById('subcategory-display-container').classList
                    .contains('hidden');

                filteredProducts =
                    products
                    .filter(
                        (
                            product
                        ) => {
                            const
                                nameMatch =
                                product
                                .name
                                .toLowerCase()
                                .includes(
                                    searchTerm
                                );
                            const
                                categoryMatch =
                                selectedCategory ===
                                "all" ||
                                product
                                .category ===
                                selectedCategory;

                            let subcategoryMatch = true;
                            const selectedSubcategory = document.querySelector(
                                '#subcategory-display input[name="subcategory"]:checked')?.value;

                            if (isSubcategoryVisible && selectedSubcategory && selectedSubcategory !== 'all') {
                                subcategoryMatch = product.subcategory === selectedSubcategory;
                            }

                            const
                                priceMatch =
                                product
                                .price >=
                                minPrice &&
                                product
                                .price <=
                                maxPrice;
                            const
                                brandMatch =
                                brandSelections
                                .length ===
                                0 ||
                                brandSelections
                                .includes(
                                    product
                                    .brand
                                );
                            return (
                                nameMatch &&
                                categoryMatch &&
                                subcategoryMatch &&
                                priceMatch &&
                                brandMatch
                            );
                        }
                    );

                // ADDED: terapkan sorting & update counter
                const
                    sorted =
                    sortProducts(
                        filteredProducts
                    );
                currentPage =
                    1;
                renderProducts
                    (
                        sorted
                    );
                displayPagination
                    (
                        sorted
                    );

                if (
                    resultCount
                ) {
                    resultCount
                        .textContent =
                        `Menampilkan ${sorted.length} produk`;
                }
            };

            const
                resetFilters = () => {
                    searchInput.value = "";
                    if (categoryFilter) {
                        categoryFilter.value = "all";
                    }
                    minPriceFilter.value = "";
                    maxPriceFilter.value = "";

                    const priceRangeSelect = document.getElementById("price-range");
                    if (priceRangeSelect) {
                        priceRangeSelect.value = "";
                    }

                    // Reset brand selections and UI
                    selectedBrands = [];
                    const brandSearch = document.getElementById("brand-search");
                    if (brandSearch) {
                        brandSearch.value = "";
                    }

                    // This logic to re-render brand options is based on the original code structure
                    const brandOptions = document.getElementById("brand-options");
                    if (brandOptions) {
                        brandOptions.innerHTML = "";
                        const brandOptionTemplate = document.getElementById("brand-option-template");
                        if (brandOptionTemplate) {
                            allBrands.forEach((brand) => {
                                const optionElement = brandOptionTemplate.content.cloneNode(true);
                                const option = optionElement.querySelector(".brand-option");
                                const brandName = optionElement.querySelector(".brand-name");
                                const brandCheck = optionElement.querySelector(".brand-check");

                                if (brandName) brandName.textContent = brand;
                                if (brandCheck) brandCheck.classList.add("hidden");

                                if (option) {
                                    option.addEventListener("click", () => {
                                        if (window.toggleBrand) window.toggleBrand(brand);
                                    });
                                }
                                brandOptions.appendChild(optionElement);
                            });
                            lucide.createIcons();
                        }
                    }
                    const selectedBrandsContainer = document.getElementById("selected-brands");
                    if (selectedBrandsContainer) {
                        selectedBrandsContainer.innerHTML = '';
                        selectedBrandsContainer.classList.add('hidden');
                    }


                    // Hide subcategory display
                    const subcategoryContainer = document.getElementById("subcategory-display-container");
                    if (subcategoryContainer) {
                        subcategoryContainer.classList.add('hidden');
                    }

                    // Deselect all category cards
                    document.querySelectorAll('.category-card').forEach(c => c.classList.remove('category-active'));

                    // Finally, apply the reset filters to update the product grid
                    applyFilters();
                };

            // Brand dropdown functionality
            let
                selectedBrands = [];
            let
                allBrands = [];
            let
                filteredBrands = [];

            const
                setupBrandDropdown =
                () => {
                    // Get all unique brands from products
                    allBrands = [
                            ...
                            new Set(
                                products
                                .map(
                                    (
                                        p
                                    ) =>
                                    p
                                    .brand
                                )
                                .filter(
                                    (
                                        b
                                    ) =>
                                    b
                                )
                            ),
                        ]
                        .sort();
                    filteredBrands = [...
                        allBrands
                    ];

                    // Get DOM elements
                    const
                        brandSearch =
                        document
                        .getElementById(
                            "brand-search"
                        );
                    const
                        brandDropdownToggle =
                        document
                        .getElementById(
                            "brand-dropdown-toggle"
                        );
                    const
                        brandDropdown =
                        document
                        .getElementById(
                            "brand-dropdown"
                        );
                    const
                        brandOptions =
                        document
                        .getElementById(
                            "brand-options"
                        );
                    const
                        selectedBrandsContainer =
                        document
                        .getElementById(
                            "selected-brands"
                        );

                    if (!
                        brandSearch ||
                        !
                        brandDropdownToggle ||
                        !
                        brandDropdown ||
                        !
                        brandOptions
                    ) {
                        return;
                    }

                    // Populate brand options using template
                    const
                        renderBrandOptions =
                        (brands =
                            filteredBrands
                        ) => {
                            brandOptions
                                .innerHTML =
                                "";
                            const
                                brandOptionTemplate =
                                document
                                .getElementById(
                                    "brand-option-template"
                                );

                            brands
                                .forEach(
                                    (
                                        brand
                                    ) => {
                                        const
                                            optionElement =
                                            brandOptionTemplate
                                            .content
                                            .cloneNode(
                                                true
                                            );
                                        const
                                            option =
                                            optionElement
                                            .querySelector(
                                                ".brand-option"
                                            );
                                        const
                                            brandName =
                                            optionElement
                                            .querySelector(
                                                ".brand-name"
                                            );
                                        const
                                            brandCheck =
                                            optionElement
                                            .querySelector(
                                                ".brand-check"
                                            );

                                        // Populate template with data
                                        brandName
                                            .textContent =
                                            brand;

                                        if (selectedBrands
                                            .includes(
                                                brand
                                            )
                                        ) {
                                            brandCheck
                                                .classList
                                                .remove(
                                                    "hidden"
                                                );
                                        } else {
                                            brandCheck
                                                .classList
                                                .add(
                                                    "hidden"
                                                );
                                        }

                                        option
                                            .addEventListener(
                                                "click",
                                                () =>
                                                toggleBrand(
                                                    brand
                                                )
                                            );
                                        brandOptions
                                            .appendChild(
                                                optionElement
                                            );
                                    }
                                );
                            lucide
                                .createIcons();
                        };

                    // Toggle brand selection
                    const toggleBrand = (brand) => {
                        if (selectedBrands.includes(brand)) {
                            selectedBrands = selectedBrands.filter(
                                (b) => b !== brand
                            );
                        } else {
                            selectedBrands.push(brand);
                        }
                        renderBrandOptions();
                        renderSelectedBrands();
                        // applyFilters(); // Disabled for manual apply
                    };

                    // Make toggleBrand available globally for onclick handlers
                    window
                        .toggleBrand =
                        toggleBrand;

                    // Render selected brand tags using template
                    const
                        renderSelectedBrands =
                        () => {
                            if (selectedBrands
                                .length ===
                                0
                            ) {
                                selectedBrandsContainer
                                    .classList
                                    .add(
                                        "hidden"
                                    );
                                return;
                            }

                            selectedBrandsContainer
                                .classList
                                .remove(
                                    "hidden"
                                );
                            selectedBrandsContainer
                                .innerHTML =
                                "";
                            const
                                brandTagTemplate =
                                document
                                .getElementById(
                                    "brand-tag-template"
                                );

                            selectedBrands
                                .forEach(
                                    (
                                        brand
                                    ) => {
                                        const
                                            tagElement =
                                            brandTagTemplate
                                            .content
                                            .cloneNode(
                                                true
                                            );
                                        const
                                            tag =
                                            tagElement
                                            .querySelector(
                                                ".brand-tag"
                                            );
                                        const
                                            brandTagName =
                                            tagElement
                                            .querySelector(
                                                ".brand-tag-name"
                                            );
                                        const
                                            removeButton =
                                            tagElement
                                            .querySelector(
                                                ".brand-tag-remove"
                                            );

                                        // Populate template with data
                                        brandTagName
                                            .textContent =
                                            brand;

                                        removeButton
                                            .addEventListener(
                                                "click",
                                                () => {
                                                    selectedBrands =
                                                        selectedBrands
                                                        .filter(
                                                            (
                                                                b
                                                            ) =>
                                                            b !==
                                                            brand
                                                        );
                                                    renderBrandOptions
                                                        ();
                                                    renderSelectedBrands
                                                        ();
                                                }
                                            );

                                        selectedBrandsContainer
                                            .appendChild(
                                                tagElement
                                            );
                                    }
                                );
                            lucide
                                .createIcons();
                        };

                    // Remove brand function (no longer needed as we use event listeners)

                    // Search functionality
                    brandSearch
                        .addEventListener(
                            "input",
                            (
                                e
                            ) => {
                                const
                                    searchTerm =
                                    e
                                    .target
                                    .value
                                    .toLowerCase();
                                filteredBrands =
                                    allBrands
                                    .filter(
                                        (
                                            brand
                                        ) =>
                                        brand
                                        .toLowerCase()
                                        .includes(
                                            searchTerm
                                        )
                                    );
                                renderBrandOptions
                                    ();

                                // Auto-open dropdown when typing
                                if (
                                    searchTerm &&
                                    brandDropdown
                                    .classList
                                    .contains(
                                        "hidden"
                                    )
                                ) {
                                    brandDropdown
                                        .classList
                                        .remove(
                                            "hidden"
                                        );
                                    updateDropdownToggle
                                        (
                                            true
                                        );
                                }
                            }
                        );

                    // Dropdown toggle functionality
                    const
                        updateDropdownToggle =
                        (
                            isOpen
                        ) => {
                            const
                                chevron =
                                brandDropdownToggle
                                .querySelector(
                                    "svg"
                                );
                            if (chevron) {
                                if (
                                    isOpen
                                ) {
                                    chevron
                                        .style
                                        .transform =
                                        "rotate(180deg)";
                                } else {
                                    chevron
                                        .style
                                        .transform =
                                        "rotate(0deg)";
                                }
                            }
                        };

                    brandDropdownToggle
                        .addEventListener(
                            "click",
                            () => {
                                const
                                    isHidden =
                                    brandDropdown
                                    .classList
                                    .contains(
                                        "hidden"
                                    );
                                if (
                                    isHidden
                                ) {
                                    brandDropdown
                                        .classList
                                        .remove(
                                            "hidden"
                                        );
                                    updateDropdownToggle
                                        (
                                            true
                                        );
                                } else {
                                    brandDropdown
                                        .classList
                                        .add(
                                            "hidden"
                                        );
                                    updateDropdownToggle
                                        (
                                            false
                                        );
                                }
                            }
                        );

                    // Close dropdown when clicking outside
                    document
                        .addEventListener(
                            "click",
                            (
                                e
                            ) => {
                                const
                                    brandFilterContainer =
                                    e
                                    .target
                                    .closest(
                                        ".relative"
                                    );
                                if (!
                                    brandFilterContainer ||
                                    !
                                    brandFilterContainer
                                    .contains(
                                        brandSearch
                                    )
                                ) {
                                    brandDropdown
                                        .classList
                                        .add(
                                            "hidden"
                                        );
                                    updateDropdownToggle
                                        (
                                            false
                                        );
                                }
                            }
                        );

                    // Initial render
                    renderBrandOptions
                        ();
                    renderSelectedBrands
                        ();
                };



            // Update getBrandSelections function for new dropdown
            const
                getBrandSelections =
                () => {
                    return selectedBrands;
                };


            // subcategoryFilter.addEventListener("change", applyFilters); // Disabled for manual apply
            if (categoryFilter) {
                categoryFilter.addEventListener('change', () => {
                    const selectedCategory = categoryFilter.value;
                    updateSubcategoryDisplay(selectedCategory);

                    document.querySelectorAll('.category-card').forEach(c => c.classList.remove(
                        'category-active'));
                    document.querySelectorAll('.category-card').forEach(card => {
                        const cardCategoryName = card.querySelector('.category-name').textContent;
                        if (cardCategoryName === selectedCategory) {
                            card.classList.add('category-active');
                        }
                    });
                });
            }

            resetFiltersBtn.addEventListener("click", resetFilters);

            const applyFiltersBtn = document.getElementById("apply-filters");
            if (applyFiltersBtn) {
                applyFiltersBtn.addEventListener("click", applyFilters);
            }
            // searchInput.addEventListener("input", applyFilters); // Disabled for manual apply

            // ADDED: trigger sort
            // sortSelect?.addEventListener("change", () => {
            //     applyFilters();
            // }); // Disabled for manual apply

            // Setup price range dropdown
            const priceRangeSelect = document.getElementById("price-range");
            if (priceRangeSelect) {
                priceRangeSelect.addEventListener("change", (e) => {
                    const selectedOption = e.target.selectedOptions[0];
                    if (selectedOption) {
                        const minPrice = selectedOption.dataset.min || "";
                        const maxPrice = selectedOption.dataset.max || "";
                        minPriceFilter.value = minPrice;
                        maxPriceFilter.value = maxPrice;
                    } else {
                        minPriceFilter.value = "";
                        maxPriceFilter.value = "";
                    }
                    // applyFilters(); // Disabled for manual apply
                });
            }

            setupBrandDropdown();

            setupCategoryDisplay();

            // updateSubcategoryFilter(); // Initial call to set state

            applyFilters(); // Initial call to show all products

            // === LIGHTBOX GALLERY ===
            let
                currentLightboxImages = [];
            let currentLightboxIndex =
                0;
            const
                imageLightbox =
                document
                .getElementById(
                    "image-lightbox"
                );
            const
                lightboxImage =
                document
                .getElementById(
                    "lightbox-image"
                );
            const
                lightboxClose =
                document
                .getElementById(
                    "lightbox-close"
                );
            const
                lightboxPrev =
                document
                .getElementById(
                    "lightbox-prev"
                );
            const
                lightboxNext =
                document
                .getElementById(
                    "lightbox-next"
                );
            const
                fullscreenButton =
                document
                .getElementById(
                    "fullscreen-button"
                );

            function showLightboxImage() {
                if (!
                    currentLightboxImages
                    .length
                )
                    return;
                if (currentLightboxIndex <
                    0
                )
                    currentLightboxIndex =
                    currentLightboxImages
                    .length -
                    1;
                if (currentLightboxIndex >=
                    currentLightboxImages
                    .length
                )
                    currentLightboxIndex =
                    0;
                lightboxImage
                    .src =
                    currentLightboxImages[
                        currentLightboxIndex
                    ];
            }

            // Lightbox navigation event handlers
            if (
                lightboxPrev
            ) {
                lightboxPrev
                    .addEventListener(
                        "click",
                        function(
                            e
                        ) {
                            e
                                .stopPropagation();
                            if (!
                                currentLightboxImages
                                .length
                            )
                                return;
                            currentLightboxIndex =
                                (currentLightboxIndex -
                                    1 +
                                    currentLightboxImages
                                    .length
                                ) %
                                currentLightboxImages
                                .length;
                            showLightboxImage
                                ();
                        }
                    );
            }

            if (
                lightboxNext
            ) {
                lightboxNext
                    .addEventListener(
                        "click",
                        function(
                            e
                        ) {
                            e
                                .stopPropagation();
                            if (!
                                currentLightboxImages
                                .length
                            )
                                return;
                            currentLightboxIndex =
                                (currentLightboxIndex +
                                    1
                                ) %
                                currentLightboxImages
                                .length;
                            showLightboxImage
                                ();
                        }
                    );
            }

            if (lightboxClose &&
                imageLightbox
            ) {
                lightboxClose
                    .addEventListener(
                        "click",
                        function() {
                            imageLightbox
                                .classList
                                .add(
                                    "hidden"
                                );
                        }
                    );
            }

            // Main image click handler
            if (
                mainImage
            ) {
                mainImage
                    .addEventListener(
                        "click",
                        function(
                            e
                        ) {
                            e
                                .stopPropagation();
                            if (!
                                currentLightboxImages
                                .length
                            )
                                return;
                            currentLightboxIndex =
                                currentLightboxImages
                                .findIndex(
                                    (
                                        img
                                    ) =>
                                    img ===
                                    mainImage
                                    .src
                                );
                            if (currentLightboxIndex <
                                0
                            )
                                currentLightboxIndex =
                                0;
                            showLightboxImage
                                ();
                            imageLightbox
                                .classList
                                .remove(
                                    "hidden"
                                );
                        }
                    );
            }

            // Fullscreen button handler
            if (
                fullscreenButton
            ) {
                fullscreenButton
                    .addEventListener(
                        "click",
                        function(
                            e
                        ) {
                            e
                                .stopPropagation();
                            if (!
                                currentLightboxImages
                                .length
                            )
                                return;
                            currentLightboxIndex =
                                currentLightboxImages
                                .findIndex(
                                    (
                                        img
                                    ) =>
                                    img ===
                                    mainImage
                                    .src
                                );
                            if (currentLightboxIndex <
                                0
                            )
                                currentLightboxIndex =
                                0;
                            showLightboxImage
                                ();
                            imageLightbox
                                .classList
                                .remove(
                                    "hidden"
                                );
                        }
                    );
            }

            // Thumbnail click handler for lightbox
            if (
                thumbnailContainer
            ) {
                thumbnailContainer
                    .addEventListener(
                        "click",
                        function(
                            e
                        ) {
                            const
                                btn =
                                e
                                .target
                                .closest(
                                    "button"
                                );
                            if (!
                                btn
                            )
                                return;

                            // Check if this is a double-click or special key combination for lightbox
                            if (e
                                .detail ===
                                2 ||
                                e
                                .ctrlKey ||
                                e
                                .metaKey
                            ) {
                                const
                                    idx =
                                    Array
                                    .from(
                                        thumbnailContainer
                                        .children
                                    )
                                    .indexOf(
                                        btn
                                    );
                                if (idx >=
                                    0 &&
                                    currentLightboxImages
                                    .length
                                ) {
                                    currentLightboxIndex =
                                        idx;
                                    showLightboxImage
                                        ();
                                    imageLightbox
                                        .classList
                                        .remove(
                                            "hidden"
                                        );
                                }
                            }
                        }
                    );
            }

            // Close lightbox when clicking outside the image
            if (
                imageLightbox
            ) {
                imageLightbox
                    .addEventListener(
                        "click",
                        function(
                            e
                        ) {
                            if (e
                                .target ===
                                imageLightbox
                            ) {
                                imageLightbox
                                    .classList
                                    .add(
                                        "hidden"
                                    );
                            }
                        }
                    );
            }

            // Keyboard navigation for lightbox
            document
                .addEventListener(
                    "keydown",
                    function(
                        e
                    ) {
                        if (!
                            imageLightbox ||
                            imageLightbox
                            .classList
                            .contains(
                                "hidden"
                            )
                        )
                            return;

                        switch (
                            e
                            .key
                        ) {
                            case "Escape":
                                imageLightbox
                                    .classList
                                    .add(
                                        "hidden"
                                    );
                                break;
                            case "ArrowLeft":
                                if (
                                    lightboxPrev
                                )
                                    lightboxPrev
                                    .click();
                                break;
                            case "ArrowRight":
                                if (
                                    lightboxNext
                                )
                                    lightboxNext
                                    .click();
                                break;
                        }
                    }
                );

        });

        // Check for saved template on dashboard load (jQuery ready)
        $(
                document
            )
            .ready(
                function() {
                    // This should only run on dashboard pages
                    if (window
                        .location
                        .pathname
                        .includes(
                            '/dashboard'
                        )
                    ) {
                        checkAndSaveTemplate
                            ();
                    }
                }
            );

        function checkAndSaveTemplate() {
            const
                savedTemplate =
                localStorage
                .getItem(
                    'selectedTemplate'
                );

            if (
                savedTemplate
            ) {
                const
                    templateData =
                    JSON
                    .parse(
                        savedTemplate
                    );

                // Send template data to backend to save in database
                $.ajax({
                    url: '/api/save-template-purchase',
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $(
                                'meta[name="csrf-token"]'
                            )
                            .attr(
                                'content'
                            )
                    },
                    data: JSON
                        .stringify({
                            template_name: templateData
                                .templateName,
                            template_type: templateData
                                .templateType,
                            price: templateData
                                .price,
                            status: 'pending',
                            features: templateData
                                .features,
                            purchase_date: templateData
                                .timestamp
                        }),
                    success: function(
                        response
                    ) {
                        console
                            .log(
                                'Template purchase saved:',
                                response
                            );
                        // Clear localStorage after successful save
                        localStorage
                            .removeItem(
                                'selectedTemplate'
                            );

                        // Show success notification
                        showNotification
                            ('Template purchase saved successfully!',
                                'success'
                            );
                    },
                    error: function(
                        xhr,
                        status,
                        error
                    ) {
                        console
                            .error(
                                'Error saving template purchase:',
                                error
                            );
                        showNotification
                            ('Error saving template purchase. Please try again.',
                                'error'
                            );
                    }
                });
            }
        }

        function showNotification(
            message,
            type
        ) {
            // Create notification element
            const
                notification =
                $(`
                    <div class="fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full">
                        <div class="flex items-center gap-3">
                            <i data-lucide="${type === 'success' ? 'check-circle' : 'alert-circle'}" class="h-5 w-5"></i>
                            <span>${message}</span>
                        </div>
                    </div>
                `);

            // Add appropriate styling based on type
            if (type ===
                'success'
            ) {
                notification
                    .addClass(
                        'bg-green-500 text-white'
                    );
            } else {
                notification
                    .addClass(
                        'bg-red-500 text-white'
                    );
            }

            // Add to page
            $('body')
                .append(
                    notification
                );

            // Animate in
            setTimeout(
                () => {
                    notification
                        .removeClass(
                            'translate-x-full'
                        );
                },
                100
            );

            // Remove after 5 seconds
            setTimeout(
                () => {
                    notification
                        .addClass(
                            'translate-x-full'
                        );
                    setTimeout(
                        () => {
                            notification
                                .remove();
                        },
                        300
                    );
                },
                5000
            );
        }


        $(document).ready(
            function() {
                // Page initialization
            }
        );
    </script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-komputer',
    ])

</body>

</html>
