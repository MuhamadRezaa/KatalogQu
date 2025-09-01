<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $userStore->store_name ?? 'Store' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body class="min-h-screen bg-white">
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 flex items-center justify-center lg:justify-start h-16">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img class="rounded h-8 w-8 sm:h-10 sm:w-10" src="{{ asset('assets/img/temp/logo-toko.png') }}"
                    alt="{{ $userStore->store_name ?? 'Store' }} Logo" loading="lazy" decoding="async" />
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-blue-500">
                    {{ $userStore->store_name ?? 'Store' }}
                </h1>
            </a>
        </div>
    </header>

    <!-- Slider Banner -->
    <div class="mx-auto">
        <div class="swiper-container h-80 md:h-96 lg:h-[36rem] overflow-hidden">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide relative">
                        <img src="{{ asset($banner->image_url) }}" class="w-full h-full object-cover"
                            alt="{{ $banner->alt_text }}">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="text-center text-white p-4">
                                <h2 class="text-2xl md:text-4xl font-bold mb-2">{{ $banner->title }}</h2>
                                <p class="text-lg md:text-xl mb-4">{{ $banner->subtitle }}</p>
                                <a href="{{ $banner->link }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">Learn
                                    More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach ($categories as $category)
                    <div
                        class="category-card bg-white rounded-xl p-4 border border-gray-200 hover:border-blue-300 hover:shadow-lg transition-all duration-300 cursor-pointer group">
                        <div class="text-center">
                            <h3
                                class="category-name font-semibold text-gray-800 group-hover:text-blue-600 transition-colors mb-2">
                                {{ $category->name }}</h3>
                            <p class="category-count text-sm text-gray-500 group-hover:text-blue-500 transition-colors">
                                {{ $category->products_count }} Products</p>
                        </div>
                    </div>
                @endforeach
            </div>
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
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all text-sm" />
                </div>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-4">Filters</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                <div>
                    <h3 class="font-semibold mb-2 text-gray-700">
                        Category
                    </h3>
                    <select id="category-filter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="all">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <h3 class="font-semibold mb-2 text-gray-700">
                        Price Range
                    </h3>
                    <select id="price-range"
                        class="w-full py-2 px-3 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">All Prices</option>
                        <option data-min="0" data-max="100000">
                            Under Rp 100k
                        </option>
                        <option data-min="100000" data-max="500000">
                            Rp 100k - Rp 500k
                        </option>
                        <option data-min="500000" data-max="1000000">
                            Rp 500k - Rp 1M
                        </option>
                        <option data-min="1000000" data-max="5000000">
                            Rp 1M - Rp 5M
                        </option>
                        <option data-min="5000000" data-max="">
                            Rp 5M and above
                        </option>
                    </select>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="font-semibold mb-2 text-gray-700">Brand</h3>
                <div class="relative">
                    <div class="relative">
                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 h-4 w-4 z-10"></i>
                        <input type="text" id="brand-search" placeholder="Search brand..."
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-t-lg focus:ring-blue-500 focus:border-blue-500 transition text-sm" />
                        <button id="brand-dropdown-toggle"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition">
                            <i data-lucide="chevron-down" class="h-4 w-4"></i>
                        </button>
                    </div>
                    <div id="brand-dropdown"
                        class="hidden absolute top-full left-0 right-0 bg-white border border-t-0 border-gray-300 rounded-b-lg shadow-lg max-h-60 overflow-y-auto z-20">
                        <div id="brand-options" class="py-2">
                            @foreach ($brands as $brand)
                                <div
                                    class="brand-option px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center justify-between">
                                    <span class="brand-name text-sm">{{ $brand->name }}</span>
                                    <i data-lucide="check" class="brand-check h-4 w-4 text-blue-500 hidden"></i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="selected-brands" class="mt-2 flex flex-wrap gap-2 hidden">
                    </div>
                </div>
            </div>
            <button id="reset-filters"
                class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors">
                Reset Filters
            </button>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-gray-600">
                <span id="result-count">Showing {{ $products->count() }} of {{ $products->total() }}
                    products</span>
            </div>
            <div class="flex items-center gap-2">
                <label for="sort-select" class="text-sm text-gray-600">Sort by:</label>
                <select id="sort-select"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="relevance">Relevance</option>
                    <option value="price-asc">Price: Lowest</option>
                    <option value="price-desc">Price: Highest</option>
                    <option value="name-asc">Name: A-Z</option>
                    <option value="name-desc">Name: Z-A</option>
                    <option value="newest">Newest</option>
                </select>
            </div>
        </div>

        <div id="product-grid"
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
            @foreach ($products as $product)
                <div class="product-card bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 group border border-gray-200 relative cursor-pointer"
                    data-product-id="{{ $product->id }}">
                    <div class="product-image-container relative overflow-hidden aspect-square bg-gray-100">
                        <img class="product-image w-full h-full object-contain transform transition-transform duration-300 group-hover:scale-105"
                            loading="lazy" decoding="async" src="{{ asset($product->images[0]) }}"
                            alt="{{ $product->name }}" />
                        @if ($product->discount_percentage)
                            <span
                                class="discount-badge absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif
                        @if ($product->stock <= 0)
                            <div class="stock-overlay absolute inset-0 bg-black/50 flex items-center justify-center">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm font-semibold">Out of
                                    Stock</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="product-name text-base font-semibold text-gray-800 line-clamp-2">
                            {{ $product->name }}</h3>
                        <p class="product-category text-xs text-gray-500 mb-2">{{ $product->category->name }}</p>
                        <div class="flex flex-col gap-1">
                            <div class="flex flex-wrap items-baseline gap-x-1">
                                <span class="product-price font-bold text-gray-900">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if ($product->old_price)
                                    <span class="product-old-price text-gray-500 line-through">Rp
                                        {{ number_format($product->old_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($products->isEmpty())
            <div id="no-results" class="text-center py-16">
                <i data-lucide="search-x" class="mx-auto h-16 w-16 text-gray-400"></i>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">
                    No Products Found
                </h3>
                <p class="mt-1 text-gray-500">
                    Try adjusting your filters to find what you're looking for.
                </p>
            </div>
        @endif

        <!-- Pagination -->
        <div id="pagination-container" class="flex flex-wrap justify-center items-center gap-2 mt-8">
            {{ $products->links() }}
        </div>
    </main>

    <!-- Product Modal -->
    <div id="product-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    </div>

    <footer class="bg-gray-900 text-gray-300">
        <!-- Main Footer -->
        <div class="container mx-auto px-4 sm:px-6 py-12 lg:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <!-- Column 1: Brand -->
                <div class="space-y-4 mr-6">
                    <a href="{{ url('/') }}" class="flex items-center space-x-4 mb-4">
                        <img class="h-16 w-16 rounded" src="{{ asset('assets/img/temp/logo-toko.png') }}"
                            alt="{{ $userStore->store_name ?? 'Store' }} Logo" loading="lazy" decoding="async" />
                        <span class="text-4xl font-bold text-white">{{ $userStore->store_name ?? 'Store' }}</span>
                    </a>
                    <p class="text-base text-gray-400">
                        Your trusted store for quality products.
                    </p>
                </div>

                <!-- Column 2: Customer Help -->
                <div class="space-y-4 mr-6">
                    <h3 class="text-white font-semibold text-lg lg:text-xl mb-4 lg:mb-6">
                        Contact
                    </h3>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="map-pin" class="h-4 w-4 lg:h-5 lg:w-5 text-blue-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">
                                Store Address
                            </p>
                            <p class="text-xs lg:text-sm text-gray-400">
                                Jl. Store No. 123, Business District, Jakarta 12345, Indonesia
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i data-lucide="phone" class="h-4 w-4 lg:h-5 lg:w-5 text-blue-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">
                                Phone & WhatsApp
                            </p>
                            <p class="text-xs lg:text-sm text-gray-400">
                                +62 812-3456-7890
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <i data-lucide="mail" class="h-4 w-4 lg:h-5 lg:w-5 text-blue-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">
                                Email
                            </p>
                            <p class="text-xs lg:text-sm text-gray-400">
                                info@{{ strtolower(str_replace(' ', '', $userStore->store_name ?? 'store')) }}.co.id
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
                            © {{ date('Y') }} {{ $userStore->store_name ?? 'Store' }}. All rights reserved.
                        </p>
                    </div>

                    <div class="flex space-x-4 lg:space-x-6">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300"
                            aria-label="Follow us on Facebook">
                            <i data-lucide="facebook" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300"
                            aria-label="Follow us on Instagram">
                            <i data-lucide="instagram" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300"
                            aria-label="Follow us on YouTube">
                            <i data-lucide="youtube" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300"
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
</body>

</html>