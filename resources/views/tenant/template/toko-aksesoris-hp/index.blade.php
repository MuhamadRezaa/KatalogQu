<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-aksesoris-hp/styles.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .filter-section {
            background-color: #f7fafc;
        }

        .filter-btn {
            @apply flex items-center px-4 py-2 rounded-full border text-sm font-medium transition-all duration-300 ease-in-out;
            /* Default state for non-active buttons */
            @apply bg-white text-gray-700 border-gray-300;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            /* Subtle shadow */
        }

        .filter-btn.active {
            @apply bg-teal-500 text-white border-teal-500;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            /* More prominent shadow for active */
        }

        .filter-btn:not(.active):hover {
            @apply bg-gray-100 border-gray-400;
            /* Lighter background and slightly darker border on hover */
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.03);
            /* Slightly more shadow on hover */
        }

        .dropdown-select {
            @apply appearance-none px-4 py-2 rounded-full border border-gray-300 text-sm font-medium text-gray-700 transition-all duration-300 ease-in-out cursor-pointer;
        }
    </style>
</head>

<body class="bg-gray-100">

    <header class="bg-white  py-4">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                @if ($userStore->store_logo)
                    <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="{{ $userStore->store_name }}" class="rounded-full w-16 h-16 object-cover">
                @else
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">{{ substr($userStore->store_name, 0, 1) }}</span>
                    </div>
                @endif
                <h1 class="text-2xl font-bold text-teal-600">{{ $userStore->store_name }}</h1>
            </div>


        </div>
    </header>

    <section class="relative text-white text-center py-5 overflow-hidden" style="max-width: 1920px; margin: 0 auto;">
        {{-- Container dengan aspect ratio 16:9 --}}
        {{-- <div aria-hidden="true" class="h-90"></div> --}}
        <div style="aspect-ratio: 16 / 9; position: relative;">
            <div id="hero-slider" class="absolute inset-0">
                @php
                    $fallbacks = collect([
                        [
                            'image_url' => asset('assets/demo/toko-aksesoris-hp/images/Bag.webp'),
                            'title' => 'Banner 1',
                            'subtitle' => 'sub 1',
                        ],
                        [
                            'image_url' => asset('assets/demo/toko-aksesoris-hp/images/Bag2.jpg'),
                            'title' => 'Banner 2',
                            'subtitle' => 'Kartecsgcgsj',
                        ],
                        [
                            'image_url' => asset('assets/demo/toko-aksesoris-hp/images/Bag3.jpg'),
                            'title' => 'Banner 3',
                            'subtitle' => 'sub 3',
                        ],
                    ]);

                    $slides = isset($banners) && $banners->isNotEmpty() ? collect($banners)->take(3) : collect();
                    if ($slides->count() < 3) {
                        $slides = $slides->concat($fallbacks->take(3 - $slides->count()));
                    }
                @endphp

                @foreach ($slides as $i => $bn)
                    @php
                        $isObj = is_object($bn);
                        $imgSrc = $isObj ? route('tenant.asset.domain', ['path' => $bn->image_url]) : $bn['image_url'];
                        $title = $isObj ? $bn->title ?? 'Banner' : $bn['title'];
                        $subtitle = $isObj ? $bn->subtitle ?? '' : $bn['subtitle'];
                    @endphp

                    <div
                        class="slide absolute inset-0 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-1000">
                        <img src="{{ $imgSrc }}" alt="{{ $title }}"
                            class="w-full h-full object-cover brightness-75 absolute inset-0">
                        <div class="absolute inset-0 bg-teal-800 opacity-50"></div>

                        <div
                            class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center">
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">{{ $title }}</h1>
                            <p class="text-lg md:text-xl font-light mb-6">{{ $subtitle }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="absolute bottom-4 left-0 right-0 z-20">
                    <div class="flex justify-center space-x-3">
                        @for ($i = 0; $i < $slides->count(); $i++)
                            <span
                                class="dot w-3 h-3 rounded-full bg-white {{ $i === 0 ? 'opacity-100' : 'opacity-50' }} transition-all duration-500"></span>
                        @endfor
                    </div>
                </div>
            </div>
    </section>


    <div class="my-8 container mx-auto px-4 filter-section rounded-xl shadow-md p-6">
        <h2 class="text-xl md:text-2xl font-bold text-center mb-2 text-teal-700">Kategori</h2>

        <div class="flex flex-wrap gap-2 md:gap-4 justify-center" id="category-filter-container">

            <button
                class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                       bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                       hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                data-category="all" data-category-id="all">
                Semua
            </button>
            @foreach ($categories as $category)
                <button
                    class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                       bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                       hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                    data-category="{{ strtolower($category->name) }}" data-category-id="{{ $category->id }}">
                    </i> {{ $category->name }}
                </button>
            @endforeach
            <button
                class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                       bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                       hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                data-category="accessory" data-category-id="accessory">
                Lainnya
            </button>
        </div>

        {{-- SUB KATEGORI --}}
        <div class="my-8 container mx-auto px-4 filter-section rounded-xl">
            <h2 class="text-lg md:text-2xl font-bold text-center mt-6 mb-2 text-teal-600">Sub Kategori</h2>
            <div class="flex flex-wrap justify-center gap-2 md:gap-4 max-w-3xl mx-auto"
                id="subcategory-filter-container">
                <button
                    class="filter-btn subcategory-btn inline-flex items-center whitespace-nowrap px-4 md:px-5 py-2 rounded-full text-sm font-medium bg-white text-gray-700 ring-1 ring-gray-200 transition-all hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                    data-subcategory="all" data-category="all" data-category-id="all">
                    Semua
                </button>

                @if (isset($subCategories) && $subCategories->isNotEmpty())
                    @foreach ($subCategories as $subCategory)
                        <button
                            class="filter-btn subcategory-btn inline-flex items-center whitespace-nowrap px-4 md:px-5 py-2 rounded-full text-sm font-medium bg-white text-gray-700 ring-1 ring-gray-200 transition-all hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                            data-subcategory="{{ strtolower($subCategory->name) }}"
                            data-category="{{ strtolower(optional($subCategory->category)->name ?? 'general') }}"
                            data-category-id="{{ optional($subCategory->category)->id ?? '0' }}">
                            {{ $subCategory->name }}
                        </button>
                    @endforeach
                @else
                    <p class="text-gray-500 text-sm text-center mt-2 no-sub-msg">Tidak ada subkategori tersedia</p>
                @endif
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 mt-6 justify-center items-center">
            {{-- Dropdown Urutkan --}}
            <div class="relative w-full md:w-auto">
                <select id="sortDropdown"
                    class="block appearance-none w-auto bg-white border border-teal-500 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-teal-500 inline-block"
                    style="width: auto; min-width: 9rem;">
                    <option value="baru">Barang Baru</option>
                    <option value="lama">Barang Lama</option>
                    {{-- <option value="date_asc">Tanggal Naik (Lama ke Baru)</option>
                    <option value="date_desc">Tanggal Turun (Baru ke Lama)</option> --}}
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            {{-- Dropdown Harga --}}
            <div class="relative w-full md:w-auto">
                <select id="priceDropdown"
                    class="block appearance-none w-auto bg-white border border-teal-500 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-teal-500 inline-block"
                    style="width: auto; min-width: 9rem;">
                    <option value="all">Semua Harga</option>
                    @if (isset($priceRanges) && $priceRanges->isNotEmpty())
                        @foreach ($priceRanges as $range)
                            <option value="{{ $range->name }}" data-min="{{ $range->min ?? 0 }}"
                                data-max="{{ $range->max ?? '' }}">
                                {{ $range->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <div class="flex items-center md:ml-4">
                <span id="activePriceLabel" class="text-sm text-teal-700 font-semibold"></span>
            </div>
        </div>

        {{-- Kolom Pencarian (diletakkan di bawah dropdown) --}}
        <div class="flex justify-center mt-4">
            <div class="w-full sm:w-96">
                <div class="relative flex items-center border border-gray-300 rounded-full overflow-hidden">
                    <input type="text" id="searchInput" placeholder="Cari produk..."
                        class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500" />
                    <button id="searchBtn"
                        class="bg-teal-500 text-white px-4 py-2 hover:bg-teal-600 transition-all duration-300">
                        Cari
                    </button>
                </div>
            </div>
        </div>


        @php
            use Illuminate\Support\Str;
        @endphp

        <section class="products-section pb-16 mt-4">
            <div class="container mx-auto px-4">
                <h2 class="section-title text-3xl font-bold text-center mb-8">Produk Unggulan</h2>

                {{-- HAPUS @dd($products) DARI SINI SETELAH ANDA MENGGUNAKAN KODE INI --}}

                <div class="products-grid grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"
                    id="productsGrid">
                    @forelse ($products as $product)
                        @php
                            // Tentukan sumber gambar utama
                            $src = $product->primary_image_src
                                ? (Str::startsWith($product->primary_image_src, ['http', 'https'])
                                    ? $product->primary_image_src
                                    : asset('storage/' . $product->primary_image_src))
                                : asset('assets/images/no-image-icon.png');
                        @endphp

                        <div class="product-card bg-white rounded-2xl overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105"
                            {{-- [FIX 1] Menggunakan optional() untuk mencegah error jika relasi null --}}
                            data-category="{{ strtolower(optional($product->category)->name ?? 'general') }}"
                            data-subcategory="{{ strtolower(optional($product->subCategory)->name ?? 'general') }}"
                            data-name="{{ strtolower($product->name) }}" data-price="{{ $product->price }}"
                            data-created-at="{{ $product->created_at }}">

                            {{-- Gambar Produk --}}
                            <div class="aspect-w-1 aspect-h-1 w-full bg-gray-50">
                                <img src="{{ $src }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain p-3">
                            </div>

                            {{-- Informasi Produk --}}
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
                                    {{ $product->name }}
                                </h3>
                                <div class="text-center mt-auto">
                                    @if ($product->original_price && $product->original_price > $product->price)
                                        <div class="flex items-center justify-center space-x-1 mb-1">
                                            <span class="text-gray-400 line-through text-base">
                                                Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                            </span>
                                            <span class="text-xs text-gray-500">(Harga Lama)</span>
                                        </div>
                                        <div class="flex items-center justify-center space-x-2">
                                            <span class="text-red-600 font-bold text-lg product-price">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                            <span class="bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">
                                                -{{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-red-600 font-bold text-lg product-price">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Tombol Detail --}}
                            <div class="p-4 pt-0">
                                <button
                                    class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal hover:bg-teal-600 transition"
                                    data-modal-title="{{ $product->name }}"
                                    data-modal-content='
                            <div class="text-center mb-4">
                                <img src="{{ $src }}" alt="{{ $product->name }}" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                            </div>

                            <p class="text-gray-700 mb-2">
                                {{ $product->description ?? 'Produk berkualitas tinggi dengan harga terjangkau.' }}
                            </p>

                            <div class="text-center mt-2">
                                @if ($product->original_price && $product->original_price > $product->price)
<div class="flex items-center justify-center space-x-1 mb-2">
                                        <span class="text-gray-400 line-through text-lg">
                                            Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-xs text-gray-500">(Harga Lama)</span>
                                    </div>
                                    <div class="flex items-center justify-center space-x-2">
                                        <span class="text-teal-500 font-bold text-2xl">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                        <span class="bg-red-100 text-red-600 text-sm px-2 py-0.5 rounded-full">
                                            Hemat {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                                        </span>
                                    </div>
@else
<span class="text-teal-500 font-bold text-xl">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
@endif
                            </div>

                            <div class="text-center mt-3 mb-6">
                                <a href="https://wa.me/{{ $userStore->whatsapp ?? '6282392184679' }}?text=Halo%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}"
                                    target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">
                                    Chat Penjual
                                </a>
                            </div>

                            {{-- [FIX 2] Logika produk serupa dihapus dari view untuk performa dan perbaikan.
                                 Ini sebaiknya ditangani di Controller jika diperlukan. --}}
                            '>
                                    Detail
                                </button>
                            </div>
                        </div>
                    @empty
                        {{-- Jika tidak ada produk --}}
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">📦</div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Produk</h3>
                            <p class="text-gray-500">Produk akan segera ditambahkan. Silakan kembali lagi nanti!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Pagination (Kode pagination Anda sudah benar) --}}
            <div class="container mx-auto px-4">
                <div class="flex flex-col sm:flex-row justify-between items-center mt-8 text-sm text-gray-600">
                    <div id="pagination-info" class="mb-4 sm:mb-0">
                        Menampilkan <span id="showing-start">1</span> - <span id="showing-end">10</span> dari <span
                            id="total-entries">{{ $products->total() }}</span> produk
                    </div>

                    <div class="flex items-center space-x-1">
                        {{-- Kode ini akan dirender ulang oleh JavaScript, tapi kita biarkan sebagai fallback --}}
                        {!! $products->links('pagination::tailwind') !!}
                    </div>
                </div>
            </div>
        </section>

        <div id="universalModal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 id="universalModalTitle" class="text-xl font-bold"></h2>
                    <button id="closeUniversalModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="universalModalContent"></div>
            </div>
        </div>

        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center mb-4 md:mb-0">
                        @if ($userStore->store_logo)
                            <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                alt="{{ 'Gambar:' . $userStore->store_name }}" class="w-10 h-10 rounded-full mr-3">
                        @else
                            <div
                                class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                {{ strtoupper(substr($userStore->store_name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-bold">{{ $userStore->store_name }}</h3>
                            <p class="text-sm text-gray-400">
                                {{ $userStore->store_description ?? 'Toko Aksesoris HP Terpercaya' }}</p>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-sm">Alamat: {{ $userStore->store_address }}</p>
                        <p class="text-sm">Phone: {{ $userStore->store_phone }}</p>
                        <p class="text-sm">Email: {{ $userStore->store_email }}</p>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // --- Page state and elements ---
                const productsGrid = document.getElementById('productsGrid');
                const allProducts = productsGrid ? Array.from(productsGrid.querySelectorAll('.product-card')) : [];
                const PRODUCTS_PER_PAGE = 10;
                let currentPage = 1;
                const categoryButtons = document.querySelectorAll('.category-btn');
                const subcategoryButtons = document.querySelectorAll('.subcategory-btn');

                // State
                let currentCategory = 'all';
                let currentSubcategory = 'all';
                let currentSort = 'baru';
                let currentPriceMin = 0;
                let currentPriceMax = Infinity;
                let currentSearchTerm = '';
                // helper: normalize strings for stable matching
                const normalize = s => String(s || '').toLowerCase().trim().replace(/[^a-z0-9]/g, '');

                // build a map category -> [button elements] for fast lookup
                const subcategoryMap = {};
                document.querySelectorAll('.subcategory-btn').forEach(btn => {
                    const btnCat = normalize(btn.getAttribute('data-category') || '');
                    if (!subcategoryMap[btnCat]) subcategoryMap[btnCat] = [];
                    subcategoryMap[btnCat].push(btn);
                    // annotate for quick inspection (title tooltip)
                    try {
                        const catAttr = btn.getAttribute('data-category') || '';
                        const idAttr = btn.getAttribute('data-category-id') || '';
                        btn.setAttribute('title', `cat:${catAttr} id:${idAttr}`);
                    } catch (e) {}
                });

                function updateSubcategories(categoryName, categoryId) {
                    // Mark (highlight) which subcategories belong to the selected category.
                    // Do not fully hide or disable non-matching subcategories — just visually indicate matches.
                    console.log('Updating subcategories for:', {
                        categoryName,
                        categoryId
                    });

                    const subcategorySection = document.getElementById('subcategory-filter-container').parentElement;
                    if (subcategorySection) {
                        subcategorySection.style.display = '';
                    }

                    const subBtns = Array.from(document.querySelectorAll('.subcategory-btn'));
                    const noSubMsg = document.querySelector('#subcategory-filter-container .no-sub-msg');

                    // Normalize categoryId to string for safe comparison
                    const catIdStr = String(categoryId || 'all');

                    let anyMatches = false;

                    subBtns.forEach(btn => {
                        const btnSub = btn.getAttribute('data-subcategory') || '';
                        const btnCatId = String(btn.getAttribute('data-category-id') || '');

                        // Keep the 'Semua' button visible and clear any marker
                        if (btnSub === 'all') {
                            btn.style.display = '';
                            btn.classList.remove('ring-2', 'ring-teal-500', 'matching');
                            return;
                        }

                        if (catIdStr === 'all') {
                            // Reset: clear highlight from all subcategories
                            btn.style.display = '';
                            btn.classList.remove('ring-2', 'ring-teal-500', 'matching');
                        } else if (btnCatId === catIdStr) {
                            // This subcategory belongs to the selected category -> mark it
                            btn.style.display = '';
                            btn.classList.add('ring-2', 'ring-teal-500', 'matching');
                            // make sure it's not visually de-emphasized
                            btn.classList.remove('opacity-50');
                            anyMatches = true;
                        } else {
                            // Not a match: remove matching marker if present
                            btn.classList.remove('ring-2', 'ring-teal-500', 'matching');
                            // optionally slightly de-emphasize without disabling
                            btn.classList.remove('opacity-50');
                        }
                    });

                    if (noSubMsg) {
                        // Show message only if there are no matching subcategories (excluding 'Semua')
                        noSubMsg.style.display = anyMatches ? 'none' : 'block';
                    }
                }

                // --- Pagination renderer ---
                function renderPagination(totalPages) {
                    const paginationContainer = document.querySelector('.flex.items-center.space-x-1');
                    if (!paginationContainer) return;
                    paginationContainer.innerHTML = '';
                    // Prev
                    if (currentPage === 1) {
                        paginationContainer.innerHTML +=
                            '<span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400">Previous</span>';
                    } else {
                        paginationContainer.innerHTML +=
                            `<a href="#" class="px-3 py-1 rounded-md bg-white border text-teal-600 hover:bg-teal-50" data-page="${currentPage - 1}">Previous</a>`;
                    }
                    // Pages
                    for (let page = 1; page <= totalPages; page++) {
                        if (page === currentPage) paginationContainer.innerHTML +=
                            `<span class="px-3 py-1 rounded-md bg-teal-600 text-white font-semibold">${page}</span>`;
                        else paginationContainer.innerHTML +=
                            `<a href="#" class="px-3 py-1 rounded-md bg-white border text-gray-600 hover:bg-gray-50" data-page="${page}">${page}</a>`;
                    }
                    // Next
                    if (currentPage === totalPages || totalPages === 0) paginationContainer.innerHTML +=
                        '<span class="px-3 py-1 rounded-md bg-gray-100 text-gray-400">Next</span>';
                    else paginationContainer.innerHTML +=
                        `<a href="#" class="px-3 py-1 rounded-md bg-white border text-teal-600 hover:bg-teal-50" data-page="${currentPage + 1}">Next</a>`;

                    paginationContainer.querySelectorAll('a[data-page]').forEach(link => link.addEventListener('click',
                        function(e) {
                            e.preventDefault();
                            currentPage = parseInt(this.getAttribute('data-page'));
                            applyFilters();
                        }));
                }

                // --- Apply filters ---
                function applyFilters() {
                    let filteredProducts = allProducts.slice();
                    if (currentCategory !== 'all') filteredProducts = filteredProducts.filter(product => product.dataset
                        .category === currentCategory);
                    if (currentSubcategory !== 'all') filteredProducts = filteredProducts.filter(product => product
                        .dataset.subcategory === currentSubcategory);
                    if (currentSearchTerm) filteredProducts = filteredProducts.filter(product => (product.dataset
                        .name || '').includes(currentSearchTerm));
                    filteredProducts = filteredProducts.filter(product => {
                        const price = parseInt(product.dataset.price) || 0;
                        return price >= currentPriceMin && price <= currentPriceMax;
                    });
                    // Sort products based on created_at date
                    filteredProducts.sort((a, b) => {
                        const dateA = new Date(a.getAttribute('data-created-at'));
                        const dateB = new Date(b.getAttribute('data-created-at'));

                        switch (currentSort) {
                            case 'lama':
                            case 'date_asc':
                                return dateA - dateB; // Oldest to newest
                            case 'baru':
                            case 'date_desc':
                                return dateB - dateA; // Newest to oldest
                            default:
                                return dateB - dateA; // Default: newest first
                        }
                    });

                    const totalEntries = filteredProducts.length;
                    const totalPages = Math.ceil(totalEntries / PRODUCTS_PER_PAGE) || 1;
                    if (currentPage > totalPages) currentPage = totalPages || 1;
                    const startIdx = (currentPage - 1) * PRODUCTS_PER_PAGE;
                    const endIdx = startIdx + PRODUCTS_PER_PAGE;
                    const paginatedProducts = filteredProducts.slice(startIdx, endIdx);

                    if (productsGrid) {
                        productsGrid.innerHTML = '';
                        if (paginatedProducts.length > 0) paginatedProducts.forEach(product => productsGrid.appendChild(
                            product));
                        else productsGrid.innerHTML =
                            `<div class="col-span-full text-center py-12"><div class="text-gray-400 text-6xl mb-4">📦</div><h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Produk</h3><p class="text-gray-500">Tidak ada produk yang sesuai dengan filter yang dipilih.</p></div>`;
                    }

                    const showingStartEl = document.getElementById('showing-start');
                    const showingEndEl = document.getElementById('showing-end');
                    const totalEntriesEl = document.getElementById('total-entries');
                    if (showingStartEl) showingStartEl.textContent = totalEntries === 0 ? 0 : startIdx + 1;
                    if (showingEndEl) showingEndEl.textContent = Math.min(endIdx, totalEntries);
                    if (totalEntriesEl) totalEntriesEl.textContent = totalEntries;

                    renderPagination(totalPages);
                }

                // --- Category / Subcategory events ---
                categoryButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        const categoryName = this.getAttribute('data-category');
                        const categoryId = this.getAttribute('data-category-id');

                        console.log('Category clicked:', {
                            name: categoryName,
                            id: categoryId,
                            text: this.textContent.trim()
                        });

                        // 1. Update UI for category buttons
                        categoryButtons.forEach(btn => {
                            btn.classList.remove('active', 'bg-teal-500', 'text-white');
                            btn.classList.add('bg-white', 'text-gray-700');
                        });
                        this.classList.add('active', 'bg-teal-500', 'text-white');
                        this.classList.remove('bg-white', 'text-gray-700');

                        // 2. Update category state
                        currentCategory = categoryName;

                        // 3. Update subcategory selections
                        currentSubcategory = 'all';
                        const allSubBtn = document.querySelector(
                            '.subcategory-btn[data-subcategory="all"]');

                        // Reset all subcategory button styles first
                        subcategoryButtons.forEach(btn => {
                            btn.classList.remove('active', 'bg-teal-500', 'text-white');
                            btn.classList.add('bg-white', 'text-gray-700');
                        });

                        // Activate "Semua" subcategory button
                        if (allSubBtn) {
                            allSubBtn.classList.add('active', 'bg-teal-500', 'text-white');
                            allSubBtn.classList.remove('bg-white', 'text-gray-700');
                        }

                        // 4. Update subcategories visibility and styling
                        updateSubcategories(categoryName,
                            categoryId); // Apply filters and update display
                        applyFilters();
                    });
                });

                subcategoryButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Update subcategory buttons UI
                        subcategoryButtons.forEach(btn => {
                            btn.classList.remove('active', 'bg-teal-500', 'text-white');
                            btn.classList.add('bg-white', 'text-gray-700');
                        });

                        // Activate clicked subcategory
                        this.classList.add('active', 'bg-teal-500', 'text-white');
                        this.classList.remove('bg-white', 'text-gray-700');

                        // Update state
                        currentSubcategory = this.getAttribute('data-subcategory');

                        // If clicking a subcategory from a different category, update the category selection
                        const subCategoryId = this.getAttribute('data-category-id');
                        const subCategory = this.getAttribute('data-category');
                        if (subCategoryId !== 'all' && currentCategory !== subCategory) {
                            const matchingCategoryBtn = Array.from(categoryButtons).find(btn =>
                                btn.getAttribute('data-category-id') === subCategoryId
                            );
                            if (matchingCategoryBtn) {
                                // Update category buttons UI
                                categoryButtons.forEach(btn => {
                                    btn.classList.remove('active', 'bg-teal-500', 'text-white');
                                    btn.classList.add('bg-white', 'text-gray-700');
                                });
                                matchingCategoryBtn.classList.add('active', 'bg-teal-500',
                                    'text-white');
                                matchingCategoryBtn.classList.remove('bg-white', 'text-gray-700');
                                currentCategory = subCategory;
                            }
                        }

                        // Apply filters and scroll to products
                        applyFilters();
                        const grid = document.getElementById('productsGrid');
                        if (grid) {
                            grid.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });

                // --- Sort / Price / Search ---
                const sortEl = document.getElementById('sortDropdown');
                if (sortEl) sortEl.addEventListener('change', function() {
                    currentSort = this.value;
                    applyFilters();
                });

                const priceDropdownEl = document.getElementById('priceDropdown');
                const activePriceLabelEl = document.getElementById('activePriceLabel');

                function updateActivePriceLabel() {
                    // Tidak menampilkan label rentang harga yang dipilih
                    if (activePriceLabelEl) {
                        activePriceLabelEl.textContent = '';
                    }
                }
                if (priceDropdownEl) priceDropdownEl.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (this.value === 'all') {
                        currentPriceMin = 0;
                        currentPriceMax = Infinity;
                    } else {
                        currentPriceMin = parseInt(selectedOption.dataset.min) || 0;
                        currentPriceMax = selectedOption.dataset.max ? (selectedOption.dataset.max === '' ?
                            Infinity : parseInt(selectedOption.dataset.max)) : Infinity;
                    }
                    updateActivePriceLabel();
                    applyFilters();
                });
                updateActivePriceLabel();

                const searchBtn = document.getElementById('searchBtn');
                const searchInput = document.getElementById('searchInput');
                if (searchBtn) searchBtn.addEventListener('click', function() {
                    currentSearchTerm = (searchInput ? searchInput.value : '').toLowerCase();
                    applyFilters();
                });
                if (searchInput) searchInput.addEventListener('keyup', function() {
                    currentSearchTerm = this.value.toLowerCase();
                    applyFilters();
                });

                // --- Similar products helper and modal wiring ---
                function getSimilarProducts(baseProduct, limit = 4) {
                    if (!baseProduct) return [];
                    const baseSub = baseProduct.dataset.subcategory || '';
                    const baseCat = baseProduct.dataset.category || '';
                    const basePrice = parseFloat(baseProduct.dataset.price) || 0;
                    let candidates = allProducts.filter(p => p !== baseProduct);
                    let primary = candidates.filter(p => (p.dataset.subcategory || '') === baseSub);
                    if (primary.length < limit) {
                        const secondary = candidates.filter(p => (p.dataset.category || '') === baseCat && (p.dataset
                            .subcategory || '') !== baseSub);
                        primary = primary.concat(secondary);
                    }
                    primary.sort((a, b) => Math.abs((parseFloat(a.dataset.price) || 0) - basePrice) - Math.abs((
                        parseFloat(b.dataset.price) || 0) - basePrice));
                    return primary.slice(0, limit);
                }

                document.querySelectorAll('.show-modal').forEach(el => el.addEventListener('click', function() {
                    const modal = document.getElementById('universalModal');
                    const modalTitle = document.getElementById('universalModalTitle');
                    const modalContent = document.getElementById('universalModalContent');
                    if (modalTitle) modalTitle.textContent = this.getAttribute('data-modal-title') || '';
                    let mainContent = this.getAttribute('data-modal-content') || '';
                    const productCard = this.closest('.product-card');
                    const similar = getSimilarProducts(productCard, 4);
                    if (similar.length > 0) {
                        mainContent +=
                            `\n<hr class="my-4"/>\n<h3 class="text-lg font-semibold mb-2">Produk Serupa</h3>\n<div class="grid grid-cols-2 gap-3">`;
                        similar.forEach(p => {
                            const imgEl = p.querySelector('img');
                            const imgSrc = imgEl ? imgEl.src : '';
                            const title = p.querySelector('.product-title') ? p.querySelector(
                                '.product-title').textContent.trim() : (p.dataset.name ||
                                'Produk');
                            let priceText = '-';
                            if (p.dataset.price) {
                                let num = parseInt(p.dataset.price);
                                priceText = 'Rp ' + (isNaN(num) ? p.dataset.price : num
                                    .toLocaleString('id-ID'));
                            }
                            const targetName = (p.dataset.name || '').replace(/"/g, '&quot;');
                            mainContent +=
                                `\n<div class="similar-item cursor-pointer border rounded p-2 flex items-center" data-target="${targetName}">\n  <img src="${imgSrc}" class="w-16 h-16 object-contain mr-3" alt="${title}"/>\n  <div class="flex-1">\n    <div class="text-sm font-medium">${title}</div>\n    <div class="text-sm text-red-600">${priceText}</div>\n  </div>\n</div>`;
                        });
                        mainContent += `\n</div>`;
                    }
                    if (modalContent) modalContent.innerHTML = mainContent;
                    // attach similar-item clicks
                    modalContent && modalContent.querySelectorAll('.similar-item').forEach(si => si
                        .addEventListener('click', function() {
                            const target = this.getAttribute('data-target') || '';
                            const targetProduct = allProducts.find(p => (p.dataset.name || '') ===
                                target);
                            if (targetProduct) {
                                const btn = targetProduct.querySelector('.show-modal');
                                if (btn) {
                                    modal && modal.classList.add('hidden');
                                    setTimeout(() => btn.click(), 80);
                                }
                            }
                        }));
                    modal && modal.classList.remove('hidden');
                }));

                const closeUniversalModalBtn = document.getElementById('closeUniversalModal');
                if (closeUniversalModalBtn) closeUniversalModalBtn.addEventListener('click', function() {
                    document.getElementById('universalModal').classList.add('hidden');
                });
                const universalModalEl = document.getElementById('universalModal');
                if (universalModalEl) universalModalEl.addEventListener('click', function(e) {
                    if (e.target === this) this.classList.add('hidden');
                });

                // --- Hero slider (scoped) ---
                (function heroSliderScoped() {
                    const heroEl = document.getElementById('hero-slider');
                    if (!heroEl) return;
                    const heroSlides = Array.from(heroEl.querySelectorAll('.slide'));
                    const heroDots = Array.from(document.querySelectorAll('.dot'));
                    if (!heroSlides.length) return;

                    let hs_index = 0;
                    let hs_timer = null;
                    const HS_AUTOPLAY_MS = 2000;

                    function hs_goTo(i) {
                        hs_index = ((i % heroSlides.length) + heroSlides.length) % heroSlides.length;
                        heroSlides.forEach((s, idx) => {
                            s.style.opacity = idx === hs_index ? '1' : '0';
                            s.classList.toggle('opacity-100', idx === hs_index);
                            s.classList.toggle('opacity-0', idx !== hs_index);
                        });
                        heroDots.forEach((d, idx) => {
                            d.style.opacity = idx === hs_index ? '1' : '0.5';
                        });
                    }

                    function hs_next() {
                        hs_goTo(hs_index + 1);
                    }

                    function hs_prev() {
                        hs_goTo(hs_index - 1);
                    }

                    function hs_start() {
                        hs_stop();
                        hs_timer = setInterval(hs_next, HS_AUTOPLAY_MS);
                    }

                    function hs_stop() {
                        if (hs_timer) {
                            clearInterval(hs_timer);
                            hs_timer = null;
                        }
                    }

                    heroDots.forEach((d, idx) => d.addEventListener('click', function() {
                        hs_goTo(idx);
                        hs_stop();
                    }));
                    heroEl.addEventListener('mouseenter', hs_stop);
                    heroEl.addEventListener('mouseleave', hs_start);

                    // prev/next controls (create if missing)
                    if (!document.querySelector('.hero-prev')) {
                        const prevBtn = document.createElement('button');
                        prevBtn.type = 'button';
                        prevBtn.className =
                            'hero-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2';
                        prevBtn.innerHTML = '<i class="fas fa-chevron-left text-gray-800"></i>';
                        prevBtn.addEventListener('click', function() {
                            hs_prev();
                            hs_stop();
                        });
                        heroEl.parentElement.appendChild(prevBtn);
                    }
                    if (!document.querySelector('.hero-next')) {
                        const nextBtn = document.createElement('button');
                        nextBtn.type = 'button';
                        nextBtn.className =
                            'hero-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2';
                        nextBtn.innerHTML = '<i class="fas fa-chevron-right text-gray-800"></i>';
                        nextBtn.addEventListener('click', function() {
                            hs_next();
                            hs_stop();
                        });
                        heroEl.parentElement.appendChild(nextBtn);
                    }

                    hs_goTo(0);
                    hs_start();
                })();

                // --- Initialize page ---
                updateSubcategories('all');
                applyFilters();
            });
        </script>
</body>

</html>
