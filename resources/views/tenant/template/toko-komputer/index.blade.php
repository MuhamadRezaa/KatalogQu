{{-- Menggunakan layout dasar dari kode pertama --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $userStore->store_name ?? 'TechZone' }} - Modern Computer Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body class="min-h-screen bg-white">
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 flex items-center justify-center lg:justify-start h-16">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                @if ($userStore->store_logo)
                    <img class="rounded h-8 w-8 sm:h-10 sm:w-10" src="{{ asset('storage/' . $userStore->store_logo) }}"
                        alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy" decoding="async" />
                @else
                    <img class="rounded h-8 w-8 sm:h-10 sm:w-10"
                        src="{{ asset('assets/demo/toko-komputer/img/temp/logo-toko.png') }}"
                        alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy" decoding="async" />
                @endif
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-cyan-500">
                    {{ $userStore->store_name ?? 'TechZone' }}
                </h1>
            </a>
        </div>
    </header>

    {{-- Slider Banner dari kode pertama --}}
    <div class="mx-auto">
        <div class="swiper-container h-80 md:h-96 lg:h-[36rem] overflow-hidden">
            <div class="swiper-wrapper">
                @forelse ($banners as $banner)
                    <div class="swiper-slide relative">
                        <img src="{{ route('tenant.asset', ['path' => $banner->image_url]) }}"
                            class="w-full h-full object-cover" alt="{{ $banner->title ?? 'Banner' }}">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="text-center text-white p-4">
                                <h2 class="text-2xl md:text-4xl font-bold mb-2">{{ $banner->title ?? 'Special Offer' }}
                                </h2>
                                <p class="text-lg md:text-xl mb-4 px-4">
                                    {{ $banner->subtitle ?? 'Check out our latest deals' }}</p>
                                @if ($banner->link)
                                    <a href="{{ $banner->link }}"
                                        class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">{{ $banner->button_text ?? 'Learn More' }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide relative">
                        <div
                            class="w-full h-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center">
                            <div class="text-center text-white p-4">
                                <h2 class="text-2xl md:text-4xl font-bold mb-2">Welcome to
                                    {{ $userStore->store_name ?? 'Our Store' }}</h2>
                                <p class="text-lg md:text-xl mb-4">Discover our amazing products</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="swiper-pagination relative text-center py-4"></div>
    </div>

    {{-- Main Content dari kode pertama --}}
    <main class="container mx-auto px-4 sm:px-6 py-8">
        <!-- Category Display Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Cari Berdasarkan Kategori
            </h2>
            <div id="category-display"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @if (isset($categories) && $categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div
                            class="category-card bg-white rounded-xl p-4 border border-gray-200 hover:border-cyan-300 hover:shadow-lg transition-all duration-300 cursor-pointer group">
                            <div class="text-center">
                                <h3
                                    class="category-name font-semibold text-gray-800 group-hover:text-cyan-600 transition-colors mb-2">
                                    {{ $category->name }}</h3>
                                <p
                                    class="category-count text-sm text-gray-500 group-hover:text-cyan-500 transition-colors">
                                    {{ $category->products_count ?? 0 }} Products</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center col-span-full">No categories available</p>
                @endif
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white p-6 rounded-lg shadow-md top-24 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                Cari Produk
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                <div>
                    <h3 class="font-semibold mb-2 text-gray-700">
                        Kategori
                    </h3>
                    <select id="category-filter"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-cyan-500 focus:border-cyan-500 transition">
                        <option value="all">Semua</option>
                        @if (isset($categories) && $categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <h3 class="font-semibold mb-2 text-gray-700">
                        Rentang Harga
                    </h3>
                    <select id="price-range"
                        class="w-full py-2 px-3 border border-gray-300 rounded-lg text-sm focus:ring-cyan-500 focus:border-cyan-500 transition">
                        <option value="">Semua Harga</option>
                        @if (isset($priceRanges) && $priceRanges->isNotEmpty())
                            @foreach ($priceRanges as $range)
                                <option data-min="{{ $range->min ?? 0 }}" data-max="{{ $range->max ?? '' }}">
                                    {{ $range->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
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
                    <div id="brand-dropdown"
                        class="hidden absolute top-full left-0 right-0 bg-white border border-t-0 border-gray-300 rounded-b-lg shadow-lg max-h-60 overflow-y-auto z-20">
                        <div id="brand-options" class="py-2">
                            @if (isset($brands) && $brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <div
                                        class="brand-option px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center justify-between">
                                        <span class="brand-name text-sm">{{ $brand->name }}</span>
                                        <i data-lucide="check" class="brand-check h-4 w-4 text-green-500 hidden"></i>
                                    </div>
                                @endforeach
                            @else
                                <div class="px-3 py-2 text-gray-500 text-sm">No brands available</div>
                            @endif
                        </div>
                    </div>
                    <div id="selected-brands" class="mt-2 flex flex-wrap gap-2 hidden">
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <button id="reset-filters"
                    class="w-full sm:w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors">
                    Reset
                </button>
                <button id="apply-filters"
                    class="w-full sm:w-1/2 bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    Terapkan
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-gray-600">
                <span id="result-count">
                    @if (isset($products))
                        Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk
                    @else
                        Menampilkan 0 produk
                    @endif
                </span>
            </div>
            <div class="flex items-center gap-2">
                <label for="sort-select" class="text-sm text-gray-600">Urutkan:</label>
                <select id="sort-select"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-cyan-500 focus:border-cyan-500">
                    <option value="relevance">Paling Relevan</option>
                    <option value="price-asc">Harga: Terendah</option>
                    <option value="price-desc">Harga: Tertinggi</option>
                    <option value="name-asc">Nama: A-Z</option>
                    <option value="name-desc">Nama: Z-A</option>
                    <option value="newest">Terbaru</option>
                </select>
            </div>
        </div>

        {{-- Product Grid dari kode pertama --}}
        <div id="product-grid"
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
            @forelse ($products as $product)
                {{-- Kartu produk menggunakan style dari kode pertama, tetapi harus punya data-product-id --}}
                <div class="product-card bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 group border border-gray-200 relative cursor-pointer"
                    data-product-id="{{ $product->id }}">
                    <div class="relative overflow-hidden aspect-square bg-gray-100">
                        {{-- Logika gambar disesuaikan agar bisa menangani koleksi 'productimgs' --}}
                        @php $src = $product->primary_image_src; @endphp
                        @if ($src)
                            <img class="product-image w-full h-full object-contain transform transition-transform duration-300 group-hover:scale-105"
                                loading="lazy" decoding="async" src="{{ $src }}"
                                alt="{{ $product->name }}" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        @if ($product->discount_percentage)
                            <span
                                class="absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                -{{ $product->discount_percentage }}%
                            </span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-base font-semibold text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-500 mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-gray-900">{{ $product->price_idr }}</span>
                            @if ($product->old_price_idr)
                                <span class="text-sm text-gray-500 line-through">{{ $product->old_price_idr }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No products found.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination dari kode pertama --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </main>

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

                                <div id="promo-badge" class="absolute top-2 left-2 hidden">
                                    <span id="promo-badge-text"
                                        class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">
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
                                    class="thumbnail aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300">
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

                            <!-- Notes -->
                            <div id="product-notes" class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="font-medium text-blue-900 mb-1">
                                    Catatan
                                </h4>
                                <p class="text-blue-800 text-sm">
                                    Garansi resmi 2 tahun, free mouse gaming
                                </p>
                            </div>

                            <!-- Features -->
                            <div class="grid grid-cols-3 gap-4 pt-6 border-t border-gray-200">
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-lucide="shield" class="text-blue-600"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">
                                        Garansi Resmi
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        Bergaransi resmi
                                    </p>
                                </div>

                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-lucide="truck" class="text-green-600"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">
                                        Gratis Ongkir
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        Medan & sekitarnya
                                    </p>
                                </div>

                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i data-lucide="undo-2" class="text-orange-600"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">
                                        Retur Mudah
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        7 hari retur
                                    </p>
                                </div>
                            </div>

                            <!-- Chat Button -->
                            <div class="pt-6 border-t border-gray-200">
                                <a href="{{ 'https://wa.me/' . $userStore->store_phone }}" target="_blank"
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
    {{-- Footer dari kode pertama --}}
    <footer class="bg-gray-900 text-gray-300">
        <!-- Main Footer -->
        <div class="container mx-auto px-4 sm:px-6 py-12 lg:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <!-- Column 1: Brand -->
                <div class="space-y-4 mr-6">
                    <a href="{{ url('/') }}" class="flex items-center space-x-4 mb-4">
                        @if (isset($userStore->store_logo))
                            <img class="h-16 w-16 rounded" src="{{ asset('/storage/' . $userStore->store_logo) }}"
                                alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy"
                                decoding="async" />
                        @else
                            <img class="h-16 w-16 rounded" src="{{ asset('assets/images/no-image-icon.png') }}"
                                alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy"
                                decoding="async" />
                        @endif
                        <span class="text-4xl font-bold text-white">{{ $userStore->store_name ?? 'TechZone' }}</span>
                    </a>
                    <p class="text-base text-gray-400">
                        {{ $userStore->store_description ?? 'Your one-stop solution for all things tech. High-quality components and expert service.' }}
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
                                {{ $userStore->store_address ?? '123 Tech Street, Computer District, Medan 20111, Indonesia' }}
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
                                {{ $userStore->store_phone ?? '+62 812-3456-7890' }}
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
                                {{ $userStore->store_email ?? 'info@techzone.co.id' }}
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
                            &copy; {{ date('Y') }} {{ $userStore->store_name ?? 'TechZone' }}. All rights
                            reserved. - Powered by KatalogQu
                        </p>
                    </div>

                    <div class="flex space-x-4 lg:space-x-6">
                        @if (isset($userStore->social_media) && is_array($userStore->social_media))
                            @foreach ($userStore->social_media as $platform => $url)
                                <a href="{{ $url }}"
                                    class="text-gray-400 hover:text-cyan-400 transition-colors duration-300"
                                    aria-label="Follow us on {{ ucfirst($platform) }}">
                                    <i data-lucide="{{ $platform }}" class="h-5 w-5 lg:h-6 lg:w-6"></i>
                                </a>
                            @endforeach
                        @else
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Icon
        lucide.createIcons();

        // Slider banner
        const swiper = new Swiper(".swiper-container", {
            loop: true,
            autoplay: {
                delay: 5000
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
        });
    </script>

    {{-- ====== DATA & MODAL / LIGHTBOX LOGIC ====== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ====== Siapkan data produk aman untuk JS ======
            @php
                use Illuminate\Pagination\AbstractPaginator;
                use Illuminate\Support\Str;

                $raw = $products instanceof AbstractPaginator ? $products->getCollection() : collect($products ?? []);

                $productsForJs = $raw
                    ->map(function ($product) {
                        // specs aman
                        $rawSpecs = $product->specs ?? ($product->specification ?? null);

                        if (is_string($rawSpecs)) {
                            $specs = json_decode($rawSpecs, true) ?: [];
                        } elseif (is_array($rawSpecs)) {
                            $specs = $rawSpecs;
                        } elseif (is_object($rawSpecs)) {
                            $specs = (array) $rawSpecs;
                        } else {
                            $specs = [];
                        }

                        // 1) Ambil semua gambar dari relasi `images`
                        $imgs = $product->images
                            ? $product->images
                                ->sortBy('position')
                                ->map(
                                    fn($img) => [
                                        'image_url' => route('tenant.asset', ['path' => ltrim($img->image_url, '/')]),
                                    ],
                                )
                                ->values()
                                ->all()
                            : [];

                        // 2) Dapatkan URL foto utama (kartu)
                        $primary = $product->primary_image_src ?: ($product->image ? route('tenant.asset', ['path' => ltrim($product->image, '/')]) : null);

                        // 3) SELALU masukkan foto utama sebagai item pertama,
                        //    selama belum ada di daftar (hindari duplikat)
                        if ($primary) {
                            $already = collect($imgs)->contains(function ($x) use ($primary) {
                                return rtrim($x['image_url'], '/') === rtrim($primary, '/');
                            });
                            if (!$already) {
                                array_unshift($imgs, ['image_url' => $primary]);
                            }
                        }

                        $cat = $product->category;

                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'slug' => $product->slug,
                            'price' => $product->price,
                            'old_price' => $product->old_price,
                            'description' => $product->description,
                            'notes' => $product->notes,
                            'stock' => $product->stock,
                            'discount_percentage' => $product->discount_percentage,
                            'specs' => $specs,
                            'category' => $cat ? ['id' => $cat->id, 'name' => $cat->name] : null,
                            'productimgs' => $imgs, // sekarang index 0 pasti foto utama
                        ];
                    })
                    ->values();
            @endphp

            window.productsData = @json($productsForJs);

            // ====== Elemen ======
            const modal = document.getElementById('product-modal');
            const modalClose = document.getElementById('modal-close');
            const productGrid = document.getElementById('product-grid');

            // Elemen modal detail
            const mainImage = document.getElementById('main-image');
            const fullscreenButton = document.getElementById('fullscreen-button');
            const promoBadge = document.getElementById('promo-badge');
            const promoBadgeText = document.getElementById('promo-badge-text');
            const stockOverlay = document.getElementById('stock-overlay');
            const thumbnailContainer = document.getElementById('thumbnail-container');
            const thumbnailTemplate = document.getElementById('thumbnail-template');
            const productTitle = document.getElementById('product-title');
            const productCategoryText = document.getElementById('product-category-text');
            const currentPrice = document.getElementById('current-price');
            const originalPrice = document.getElementById('original-price');
            const productDescription = document.getElementById('product-description');
            const productSpecsList = document.getElementById('product-specs');
            const productSpecTemplate = document.getElementById('product-spec-template');
            const productNotes = document.getElementById('product-notes');
            const chatButton = modal.querySelector('a[href*="wa.me"]');
            const shareButton = document.getElementById('share-button');
            const copyLinkButton = document.getElementById('copy-link-button');

            // Lightbox
            const imageLightbox = document.getElementById('image-lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxClose = document.getElementById('lightbox-close');
            const lightboxPrev = document.getElementById('lightbox-prev');
            const lightboxNext = document.getElementById('lightbox-next');

            let currentLightboxImages = [];

            if (!modal || !productGrid) return;

            function formatRupiah(angka) {
                if (angka === null || typeof angka === 'undefined' || isNaN(Number(angka))) return '';
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            // helper untuk URL asset tenant
            const tenantAssetBase = "{{ url('tenancy/assets') }}/";

            const tenantAssetUrl = (p) => {
                let path = (p || '')
                    .replace(/^storage\/+/i, '') // buang "storage/" kalau ada
                    .replace(/^\/+/, '') // buang slash depan
                    .replaceAll('\\', '/'); // normalize backslash Windows
                return tenantAssetBase + encodeURI(path);
            };

            productGrid.addEventListener('click', function(event) {
                const card = event.target.closest('[data-product-id]');
                if (!card) return;

                const productId = parseInt(card.dataset.productId, 10);
                const product = productsData.find(p => p.id === productId);
                if (!product) return;

                // Judul & kategori
                productTitle.textContent = product.name || 'Nama Produk';
                productCategoryText.textContent = product.category ? product.category.name :
                    'Tanpa Kategori';

                // Deskripsi
                productDescription.innerHTML = product.description || 'Tidak ada deskripsi.';

                // Harga & promo
                currentPrice.textContent = formatRupiah(product.price);
                if (product.old_price && Number(product.old_price) > Number(product.price)) {
                    originalPrice.textContent = formatRupiah(product.old_price);
                    originalPrice.classList.remove('hidden');
                } else {
                    originalPrice.classList.add('hidden');
                }

                if (product.discount_percentage && product.discount_percentage > 0) {
                    promoBadgeText.textContent = `-${product.discount_percentage}%`;
                    promoBadge.classList.remove('hidden');
                } else {
                    promoBadge.classList.add('hidden');
                }

                // Stok
                const habis = (product.stock !== null && typeof product.stock !== 'undefined' && Number(
                    product.stock) <= 0);
                stockOverlay.classList.toggle('hidden', !habis);

                // Catatan
                if (product.notes) {
                    productNotes.querySelector('p').textContent = product.notes;
                    productNotes.classList.remove('hidden');
                } else {
                    productNotes.classList.add('hidden');
                }

                // Gambar & thumbnail
                thumbnailContainer.innerHTML = '';
                currentLightboxImages = [];

                const images = (product.productimgs || []);
                if (images.length > 0) {
                    mainImage.src = images[0].image_url;
                    fullscreenButton.classList.remove('hidden');

                    images.forEach((img, idx) => {
                        const full = img.image_url;
                        currentLightboxImages.push(full);

                        const node = thumbnailTemplate.content.cloneNode(true);
                        const btn = node.querySelector('.thumbnail');
                        const th = node.querySelector('.thumbnail-image');

                        th.src = full;
                        th.alt = `Thumbnail ${idx + 1}`;
                        btn.dataset.fullSrc = full;

                        if (idx === 0) btn.classList.add('border-blue-600');
                        thumbnailContainer.appendChild(node);
                    });
                } else {
                    // seharusnya tidak masuk sini karena ada fallback,
                    // tapi tetap aman kalau sampai kosong
                    mainImage.src = '';
                    fullscreenButton.classList.add('hidden');
                }

                // Spesifikasi
                productSpecsList.innerHTML = '';
                if (product.specs) {
                    // Handle specs whether it's an array of objects or a direct object
                    let specsEntries = [];

                    if (Array.isArray(product.specs)) {
                        // If specs is an array, check for different formats
                        product.specs.forEach(spec => {
                            if (spec && typeof spec === 'object') {
                                // Format 1: Array of {key, value} objects
                                if ('key' in spec && 'value' in spec) {
                                    specsEntries.push([spec.key, spec.value]);
                                } else {
                                    // Format 2: Array of objects with multiple properties
                                    Object.entries(spec).forEach(([key, value]) => {
                                        if (value !== null && value !== undefined &&
                                            value !== '') {
                                            specsEntries.push([key, value]);
                                        }
                                    });
                                }
                            }
                        });
                    } else if (typeof product.specs === 'object') {
                        // Format 3: Direct object with key-value pairs
                        specsEntries = Object.entries(product.specs).filter(([_, value]) =>
                            value !== null && value !== undefined && value !== '');
                    }

                    if (specsEntries.length > 0) {
                        specsEntries.forEach(([key, value]) => {
                            if (value !== null && value !== undefined && value.toString()
                                .trim() !== '') {
                                const li = document.createElement('li');
                                li.className = 'flex justify-between py-1';
                                li.innerHTML = `
                                        <span class="text-gray-600">${key}</span>
                                        <span class="font-medium">${value}</span>
                                    `;
                                productSpecsList.appendChild(li);
                            }
                        });
                    } else {
                        productSpecsList.innerHTML =
                            '<li class="text-gray-500 italic">Tidak ada spesifikasi</li>';
                    }
                } else {
                    productSpecsList.innerHTML =
                        '<li class="text-gray-500 italic">Tidak ada spesifikasi</li>';
                }

                // Tombol chat
                const phoneNumber = '{{ $userStore->store_phone ?? '' }}';
                const message = `Halo, saya tertarik dengan produk "${product.name}".`;
                chatButton.href = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

                // Share & salin link
                const productUrl = `${window.location.origin}/produk/${product.slug || product.id}`;
                copyLinkButton.onclick = () => {
                    navigator.clipboard.writeText(productUrl).then(() => alert('Link produk disalin!'));
                };
                shareButton.onclick = () => {
                    if (navigator.share) {
                        navigator.share({
                            title: product.name,
                            text: `Lihat produk ini: ${product.name}`,
                            url: productUrl
                        });
                    } else {
                        alert('Fitur share tidak didukung di browser ini.');
                    }
                };

                // Tampilkan modal
                modal.classList.remove('hidden');
                lucide.createIcons();
            });

            // Tutup modal
            function closeModal() {
                modal.classList.add('hidden');
            }
            modalClose.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            // Ganti gambar utama via thumbnail
            thumbnailContainer.addEventListener('click', function(e) {
                const btn = e.target.closest('.thumbnail');
                if (!btn) return;
                mainImage.src = btn.dataset.fullSrc;
                document.querySelectorAll('#thumbnail-container .thumbnail').forEach(el => el.classList
                    .remove('border-blue-600'));
                btn.classList.add('border-blue-600');
            });

            // Lightbox
            function showLightbox(src) {
                lightboxImage.src = src;
                imageLightbox.classList.remove('hidden');
            }
            if (mainImage) {
                mainImage.addEventListener('click', () => {
                    if (mainImage.src) showLightbox(mainImage.src);
                });
            }
            if (fullscreenButton) {
                fullscreenButton.addEventListener('click', () => {
                    if (mainImage.src) showLightbox(mainImage.src);
                });
            }
            lightboxClose.addEventListener('click', () => imageLightbox.classList.add('hidden'));
            lightboxNext.addEventListener('click', () => {
                const i = currentLightboxImages.indexOf(lightboxImage.src);
                if (i === -1) return;
                const next = (i + 1) % currentLightboxImages.length;
                lightboxImage.src = currentLightboxImages[next];
            });
            lightboxPrev.addEventListener('click', () => {
                const i = currentLightboxImages.indexOf(lightboxImage.src);
                if (i === -1) return;
                const prev = (i - 1 + currentLightboxImages.length) % currentLightboxImages.length;
                lightboxImage.src = currentLightboxImages[prev];
            });

            // ESC untuk close
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (!modal.classList.contains('hidden')) closeModal();
                    if (!imageLightbox.classList.contains('hidden')) imageLightbox.classList.add('hidden');
                }
            });

            // ==================================================
            // ====== FILTER & SORT LOGIC (WITH APPLY BUTTON) ===
            // ==================================================

            const searchInput = document.getElementById('search-input');
            const categoryFilter = document.getElementById('category-filter');
            const priceRangeFilter = document.getElementById('price-range');
            const sortSelect = document.getElementById('sort-select');
            const applyFiltersButton = document.getElementById('apply-filters');
            const resetFiltersButton = document.getElementById('reset-filters');

            // Brand filter elements
            const brandSearchInput = document.getElementById('brand-search');
            const brandDropdownToggle = document.getElementById('brand-dropdown-toggle');
            const brandDropdown = document.getElementById('brand-dropdown');
            const brandOptionsContainer = document.getElementById('brand-options');
            const selectedBrandsContainer = document.getElementById('selected-brands');
            const brandOptions = Array.from(brandOptionsContainer.querySelectorAll('.brand-option'));
            const brandFilterWrapper = brandSearchInput.parentElement.parentElement;

            const currentUrl = new URL(window.location.href);

            // --- State Management ---
            let selectedBrands = new Set(currentUrl.searchParams.get('brands')?.split(',').filter(Boolean) || []);

            // --- Initialization from URL ---
            function initializeFilters() {
                // Search
                searchInput.value = currentUrl.searchParams.get('search') || '';

                // Category
                categoryFilter.value = currentUrl.searchParams.get('category') || 'all';

                // Price Range
                const minPrice = currentUrl.searchParams.get('price_min');
                const maxPrice = currentUrl.searchParams.get('price_max');
                if (minPrice || maxPrice) {
                    for (const option of priceRangeFilter.options) {
                        if (option.dataset.min == minPrice && option.dataset.max == maxPrice) {
                            option.selected = true;
                            break;
                        }
                    }
                }

                // Sort
                sortSelect.value = currentUrl.searchParams.get('sort') || 'relevance';

                // Brands
                updateBrandSelectionUI();
            }

            // --- Update URL and Reload ---
            function applyFilters() {
                const params = new URLSearchParams(); // Start fresh

                // Set search
                if (searchInput.value) {
                    params.set('search', searchInput.value);
                }

                // Set category
                if (categoryFilter.value && categoryFilter.value !== 'all') {
                    params.set('category', categoryFilter.value);
                }

                // Set price
                const selectedPriceOption = priceRangeFilter.options[priceRangeFilter.selectedIndex];
                if (selectedPriceOption && selectedPriceOption.value) {
                    const minPrice = selectedPriceOption.dataset.min;
                    const maxPrice = selectedPriceOption.dataset.max;
                    if (minPrice && minPrice !== "0") {
                        params.set('price_min', minPrice);
                    }
                    if (maxPrice) {
                        params.set('price_max', maxPrice);
                    }
                }

                // Set brands
                if (selectedBrands.size > 0) {
                    params.set('brands', Array.from(selectedBrands).join(','));
                }

                // Set sort
                if (sortSelect.value && sortSelect.value !== 'relevance') {
                    params.set('sort', sortSelect.value);
                }

                // Keep other existing params
                const oldParams = new URLSearchParams(window.location.search);
                oldParams.forEach((value, key) => {
                    if (!['search', 'category', 'price_min', 'price_max', 'brands', 'sort', 'page']
                        .includes(key)) {
                        params.set(key, value);
                    }
                });

                window.location.href = window.location.pathname + '?' + params.toString();
            }

            // --- Event Listeners ---
            if (applyFiltersButton) {
                applyFiltersButton.addEventListener('click', applyFilters);
            }
            sortSelect.addEventListener('change', applyFilters); // Sorting is applied instantly
            resetFiltersButton.addEventListener('click', () => {
                window.location.href = window.location.pathname;
            });

            // --- Brand Filter Logic (No immediate apply) ---
            function updateBrandSelectionUI() {
                brandOptions.forEach(option => {
                    const brandName = option.querySelector('.brand-name').textContent.trim();
                    const check = option.querySelector('.brand-check');
                    if (selectedBrands.has(brandName)) {
                        check.classList.remove('hidden');
                    } else {
                        check.classList.add('hidden');
                    }
                });

                selectedBrandsContainer.innerHTML = '';
                if (selectedBrands.size > 0) {
                    selectedBrandsContainer.classList.remove('hidden');
                    selectedBrands.forEach(brandName => {
                        const pill = document.createElement('div');
                        pill.className =
                            'flex items-center bg-cyan-100 text-cyan-800 text-xs font-semibold px-2.5 py-1 rounded-full';
                        pill.innerHTML = `
                            <span>${brandName}</span>
                            <button type="button" class="ml-2 -mr-1 p-0.5 rounded-full text-cyan-600 hover:bg-cyan-200 hover:text-cyan-800" data-brand="${brandName}">&times;</button>
                        `;
                        selectedBrandsContainer.appendChild(pill);
                    });
                } else {
                    selectedBrandsContainer.classList.add('hidden');
                }
            }

            brandDropdownToggle.addEventListener('click', (e) => {
                e.preventDefault();
                brandDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (brandFilterWrapper && !brandFilterWrapper.contains(e.target)) {
                    brandDropdown.classList.add('hidden');
                }
            });

            brandSearchInput.addEventListener('input', () => {
                const searchTerm = brandSearchInput.value.toLowerCase();
                brandOptions.forEach(option => {
                    const brandName = option.querySelector('.brand-name').textContent.toLowerCase();
                    if (brandName.includes(searchTerm)) {
                        option.style.display = 'flex';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });

            brandOptionsContainer.addEventListener('click', (e) => {
                const option = e.target.closest('.brand-option');
                if (!option) return;

                const brandName = option.querySelector('.brand-name').textContent.trim();
                if (selectedBrands.has(brandName)) {
                    selectedBrands.delete(brandName);
                } else {
                    selectedBrands.add(brandName);
                }
                updateBrandSelectionUI(); // Just update UI
            });

            selectedBrandsContainer.addEventListener('click', (e) => {
                const button = e.target.closest('button');
                if (button && button.dataset.brand) {
                    const brandName = button.dataset.brand;
                    if (selectedBrands.has(brandName)) {
                        selectedBrands.delete(brandName);
                        updateBrandSelectionUI(); // Just update UI
                    }
                }
            });

            // --- Category Cards Click ---
            const categoryCards = document.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                card.addEventListener('click', () => {
                    const categoryName = card.querySelector('.category-name').textContent.trim();
                    const categoryOption = Array.from(categoryFilter.options).find(opt => opt
                        .text === categoryName);
                    if (categoryOption) {
                        categoryFilter.value = categoryOption.value;
                        applyFilters(); // Clicking a category card is an immediate action
                    }
                });
            });

            // Initialize filters on page load
            initializeFilters();
        });
    </script>
</body>

</html>
