<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        /* Cross-Browser CSS Reset */
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: box-sizing;
        }

        html,
        body {
            font-size: 16px;
            line-height: 1.5;
            overflow-x: hidden;
            max-width: 100vw;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Hero Carousel Styles - FIXED */
        .hero-carousel {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 1;
            /* PENTING: Memperbaiki tinggi wadah */
            height: 100%;
        }

        .hero-carousel-track {
            display: flex;
            height: 100%;
            transition: transform 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
            z-index: 2;
        }

        .hero-slide {
            min-width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            /* Mencegah tumpahan konten */
        }

        .hero-caption {
            position: relative;
            color: white;
            text-align: center;
            padding: 2rem;
            text-shadow: 0 8px 32px rgba(0, 0, 0, 0.8);
            z-index: 30;
            pointer-events: all;
        }

        .hero-slide.active .hero-caption {
            animation: slideInText 1s ease-out forwards;
        }

        @keyframes slideInText {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        /* Filter Buttons (Untuk Kategori Utama) */
        .filter-btn {
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            border: 1px solid #ec4899;
            background: transparent;
            color: #ec4899;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background-color: #ec4899 !important;
            border-color: #ec4899 !important;
            color: white !important;
        }

        /* Tambahkan style untuk tombol yang sedang tidak aktif agar terlihat konsisten */
        .filter-btn:not(.active) {
            background-color: white;
            color: #4b5563;
            /* gray-700 */
            border-color: #e5e7eb;
            /* gray-200 */
            transition: all 0.3s ease;
        }

        /* Product Card Styles */
        .hairstyle-card {
            background: #fff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 100%;
            margin: 0 auto;
        }

        .hairstyle-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.2);
        }

        .hairstyle-card img {
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hairstyle-card:hover img {
            transform: scale(1.1);
        }

        .hairstyle-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: end;
            padding: 1rem;
        }

        .hairstyle-card:hover .hairstyle-overlay {
            opacity: 1;
        }

        /* Paginasi */
        #pagination-controls {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        #pagination-controls button,
        #pagination-controls span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            width: 2.5rem;
            height: 2.5rem;
            margin: 0 0.125rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-align: center;
        }
    </style>
    <script>
        // Fungsi untuk menebak kategori produk (Digunakan untuk potensi filter/utilitas lain)
        function guessProductCategory(title, desc) {
            const keywords = {
                wajah: ['serum', 'masker', 'krim', 'toner', 'mist', 'facial', 'wajah'],
                rambut: ['shampoo', 'conditioner', 'rambut', 'hair', 'pomade'],
                body: ['body', 'tubuh', 'scrub', 'lotion', 'gel', 'sabun', 'krim tangan'],
                aromaterapi: ['minyak', 'parfum', 'aroma', 'esensial', 'essential'],
                nailart: ['kuku', 'nail', 'kutek', 'manicure', 'pedicure'],
                spa: ['massage', 'pijat', 'lulur', 'spa', 'relaksasi']
            };

            const lowerTitle = title.toLowerCase();
            const lowerDesc = desc.toLowerCase();

            for (const [category, words] of Object.entries(keywords)) {
                if (words.some(word => lowerTitle.includes(word) || lowerDesc.includes(word))) {
                    return category;
                }
            }
            return 'other';
        }

        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: "#fdf2f8",
                            100: "#fce7f3",
                            200: "#fbcfe8",
                            300: "#f9a8d4",
                            400: "#f472b6",
                            500: "#ec4899",
                            600: "#db2777",
                            700: "#be185d",
                            800: "#9d174d",
                            900: "#831843",
                        },
                        rose: {
                            50: "#fff1f2",
                            100: "#ffe4e6",
                            200: "#fecdd3",
                            300: "#fda4af",
                            400: "#fb7185",
                            500: "#f43f5e",
                            600: "#e11d48",
                            700: "#be123c",
                            800: "#9f1239",
                            900: "#881337",
                        },
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 min-h-screen overflow-x-hidden">
    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-gradient-to-r from-pink-500 to-rose-500 shadow-xl"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-3 group">
                    @if ($userStore->store_logo)
                        <div
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                            <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                alt="{{ $userStore->store_name }}" class="w-8 h-8 rounded-full object-cover">
                        </div>
                    @else
                        <div
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                            <span
                                class="text-pink-600 font-bold text-lg">{{ substr($userStore->store_name, 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-3xl md:text-4xl font-semibold tracking-wide text-white drop-shadow-md"
                        style="font-family: 'Freestyle Script', cursive">
                        {{ $userStore->store_name }}
                    </span>
                </a>

                <button class="md:hidden p-2 rounded-lg text-white hover:bg-pink-600/50 transition-colors"
                    id="mobile-menu-button">

                </button>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    <div class="h-16"></div>

    {{-- Hero Section --}}
    <section class="hero-gradient min-h-screen flex items-center pt-8 relative overflow-hidden">
        <div class="hero-carousel" aria-hidden="false">
            <div class="hero-carousel-track" id="heroTrack">
                @forelse ($banners as $banner)
                    <div class="hero-slide"
                        style="background-image: url('{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $banner->image_url]) }}')"
                        data-caption="{{ $banner->title }} — {{ $banner->subtitle }}">
                        <div class="hero-caption">
                            <h2 class="text-2xl sm:text-3xl font-bold">{!! $banner->title !!}</h2>
                            <p class="mt-1">{!! $banner->subtitle !!}</p>
                            @if ($banner->link)
                                <div class="mt-8">
                                    <a href="{{ $banner->link }}"
                                        class="inline-block bg-gradient-to-r from-pink-500 via-pink-600 to-purple-500 text-white
                                        text-sm font-medium py-2 px-6 rounded-full shadow-lg hover:shadow-xl
                                        transform hover:scale-105 transition-all duration-300 ease-in-out
                                        hover:from-pink-600 hover:via-pink-500 hover:to-purple-600">
                                        {{ $banner->button_text ?? 'Lihat Penawaran' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="hero-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1600&q=80')"
                        data-caption="Selamat datang di salon kami — kecantikan dimulai di sini">
                        <div class="hero-caption">
                            <h2 class="text-2xl sm:text-3xl font-bold">Selamat datang di {{ $userStore->store_name }}
                            </h2>
                            <p class="mt-1">Kecantikan dimulai di sini</p>
                            <div class="mt-8">
                                <a href="#services"
                                    class="inline-block bg-gradient-to-r from-pink-500 via-pink-600 to-purple-500 text-white
                                        text-sm font-medium py-2 px-6 rounded-full shadow-lg hover:shadow-xl
                                        transform hover:scale-105 transition-all duration-300 ease-in-out
                                        hover:from-pink-600 hover:via-pink-500 hover:to-purple-600">
                                    Mulai Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="absolute inset-0 bg-black/25"></div>

        <div id="heroIndicators" class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-20"></div>
    </section>

    {{-- Services & Product Section --}}
    <section id="services" class="py-20 bg-gradient-to-br from-pink-100 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Filter Kategori (Filter Utama) --}}
            <div class="flex flex-wrap gap-2 md:gap-4 justify-center" id="category-filter-container">
                @foreach ($categories as $category)
                    <button
                        class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                                             bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                                             hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                        data-filter="{{ strtolower($category->name) }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            {{-- DROPDOWN FILTER SUB-KATEGORI --}}
            <div class="mt-4 flex justify-center w-full">
                <div id="subcategory-dropdown-container" class="relative inline-block text-left w-auto min-w-[200px]">
                    <button type="button" id="subcategory-dropdown-button"
                        class="inline-flex justify-center items-center w-full rounded-full shadow-sm px-6 py-2 bg-white text-sm font-medium text-primary-500 hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 transition-all border border-primary-500">
                        <span id="dropdown-current-text">Kategori</span>
                        <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div id="subcategory-dropdown-menu"
                        class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-40 max-h-60 overflow-y-auto"
                        role="menu">
                        {{-- Opsi Sub-Kategori akan di-inject oleh JavaScript di sini --}}
                    </div>
                </div>
            </div>
            {{-- AKHIR DROPDOWN FILTER SUB-KATEGORI --}}

            {{-- Product Grid Container (DENGAN LOGIKA PROMO) --}}
            <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
                @forelse ($products as $product)
                    @php
                        // 🔥 Logika Harga
                        $oldPrice = $product->price_idr ?? 'Rp 0';
                        $newPrice = $product->discount_price_idr ?? $oldPrice;
                        // Perbandingan harga harus dilakukan setelah memastikan formatnya sama (misal, tanpa 'Rp ')
                        $rawOldPrice = (float) str_replace(['Rp ', '.'], '', $oldPrice);
                        $rawNewPrice = (float) str_replace(['Rp ', '.'], '', $newPrice);

                        $isPromo = ($rawOldPrice > $rawNewPrice); // Pengecekan promo lebih akurat

                        // MODIFIKASI: Semua item diperlakukan sama dalam hal tampilan/promo
                        $categoryName = strtolower($product->category->name ?? 'general');

                        // 🔥 ASUMSI: DATA SPESIFIKASI DIBENTUK DI SINI 🔥
                        $productSpecs = '';
                        if (isset($product->duration)) {
                            $productSpecs .= 'Durasi: ' . $product->duration . '|';
                        }
                        if (isset($product->inclusions)) {
                            $productSpecs .= 'Termasuk: ' . $product->inclusions . '|';
                        }
                        if (isset($product->style_options)) {
                            $productSpecs .= 'Gaya: ' . $product->style_options . '|';
                        }
                        $productSpecs = rtrim($productSpecs, '|'); // Hapus | terakhir
                    @endphp

                    <div class="hairstyle-card group" data-name="{{ strtolower($product->name) }}"
                        data-category="{{ $categoryName }}"
                        data-sub-category="{{ strtolower($product->subCategory->name ?? 'all') }}"
                        data-price="{{ $newPrice }}">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative bg-gray-100">

                            @if ($isPromo)
                                {{-- LABEL PROMO DI KIRI ATAS (Sekarang tampil untuk SEMUA item jika diskon) --}}
                                <span
                                    class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold py-1 px-3 rounded-full shadow-md animate-pulse">
                                    PROMO
                                </span>
                            @endif

                            @if ($product->primary_image_src)
                                <img src="{{ $product->primary_image_src }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                    <svg class="w-16 h-1-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            {{-- Overlay dan Detail Ringkas --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex flex-col justify-end p-4">
                                <h3 class="text-white font-semibold text-lg">{{ $product->name }}</h3>
                                <p class="text-white text-sm">
                                    @if ($isPromo)
                                        {{-- TAMPILAN HARGA PROMO DI OVERLAY CARD --}}
                                        <span class="line-through text-gray-400 mr-2">{{ $oldPrice }}</span>
                                        <span class="font-bold">{{ $newPrice }}</span>
                                    @else
                                        {{ $newPrice }}
                                    @endif
                                </p>
                            </div>

                            {{-- Tombol Modal Detail/Universal selalu menggunakan ikon MATA (👁) --}}
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                                onclick="openUniversalModal(
                                        '{{ $product->primary_image_src }}',
                                        '{{ $product->name }}',
                                        '{{ $product->description }}',
                                        '{{ $oldPrice }}',
                                        '{{ $newPrice }}',
                                        '{{ $categoryName }}',
                                        '{{ $productSpecs }}'
                                    )">
                                👁
                            </span>

                            <div
                                class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada layanan atau produk yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pesan No Results --}}
            <div id="no-results" class="hidden col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada layanan atau produk yang cocok dengan filter ini.</p>
            </div>

            {{-- Pagination Controls --}}
            <div class="w-full flex justify-center mt-12 mb-8">
                <div id="pagination-controls"
                    class="flex flex-wrap justify-center items-center mx-auto space-x-1 md:space-x-2 text-center">
                    {{-- Pagination controls will be generated here by JS --}}
                </div>
            </div>

        </div>
    </section>

    {{-- Footer (Sama seperti Code Tenant) --}}
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="md:col-span-1">
                    <a href="/" class="flex items-center space-x-2 mb-4">
                        @if ($userStore->store_logo)
                            <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                alt="{{ $userStore->store_name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center"><span
                                    class="text-white font-bold text-lg">{{ substr($userStore->store_name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="text-2xl font-bold">{{ $userStore->store_name }}</span>
                    </a>
                </div>
                <div class="md:col-span-1 md:col-start-3">
                    <h3 class="text-lg font-bold mb-2">Kontak</h3>
                    <div class="space-y-1 text-sm text-gray-300">
                        @if ($userStore->store_address)
                            <p>📍 {{ $userStore->store_address }}</p>
                        @endif
                        @if ($userStore->store_phone)
                            <p>📞 {{ $userStore->store_phone }}</p>
                        @endif
                        @if ($userStore->store_email)
                            <p>✉️ {{ $userStore->store_email }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 border-t border-gray-700">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} {{ $userStore->store_name }}. Powered by
                    PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>


    {{-- ================================================================= --}}
    {{-- MODAL SECTION --}}
    {{-- ================================================================= --}}

    <div id="product-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
        {{-- Overlay hitam/gelap --}}
        <div class="absolute inset-0 bg-black/80 transition-opacity duration-300" onclick="closeProductModal()"></div>

        <div id="product-modal-content"
            {{-- Menggunakan max-w-xl (640px) untuk lebar yang lebih nyaman di desktop. --}}
            class="relative bg-white text-gray-800 rounded-xl shadow-2xl max-w-xl w-full max-h-[95vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300 ease-out p-6 md:p-8 border border-primary-100">

            {{-- Tombol Tutup (X di kanan atas) --}}
            <button onclick="closeProductModal()"
                class="absolute top-4 right-4 z-30 text-gray-600 hover:text-red-600 transition-all text-2xl font-semibold">
                ✕
            </button>

            {{-- KONTEN UTAMA DUA KOLOM (Desktop) --}}
            <div class="flex flex-col md:flex-row gap-6">

                {{-- KOLOM KIRI: GAMBAR (30% Lebar Desktop) --}}
                <div class="relative w-full md:w-1/3 flex-shrink-0">
                    <div class="aspect-[3/4] relative bg-gray-200"> {{-- 🔥 MODIFIKASI: aspect-[4/3] diganti aspect-[3/4] --}}
                        <img id="modal-image" src="" alt="Item Preview"
                            class="w-full h-full object-cover rounded-xl shadow-lg border border-gray-100" />

                        {{-- PROMO TAG (Sudut Kiri Atas) --}}
                        <span id="modal-promo-tag"
                            class="hidden absolute top-3 left-3 z-20 bg-red-600 text-white text-xs font-extrabold py-1 px-3 rounded-full shadow-lg animate-pulse">DISKON</span>

                        {{-- BLOK HARGA SEBAGAI OVERLAY (Sudut Kiri Bawah) --}}
                        <div id="modal-price-display-overlay" class="absolute bottom-0 left-0 p-3 bg-black/50 rounded-tr-xl z-20">
                            <p class="text-sm font-normal line-through text-gray-300 hidden" id="modal-old-price-container-overlay">
                                <span id="modal-old-price-overlay"></span>
                            </p>
                            <p class="text-xl font-extrabold text-white" id="modal-new-price-container-overlay">
                                <span id="modal-new-price-overlay"></span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: DETAIL (70% Lebar Desktop) --}}
                <div class="flex-1 space-y-4 pt-1">
                    {{-- Nama Produk/Layanan --}}
                    <h2 id="modal-title" class="text-3xl font-bold text-gray-900 leading-tight"></h2>

                    {{-- 1. DESKRIPSI (Sesuai Referensi: Heading 'Deskripsi' + Konten) --}}
                    <div id="modal-description-block" class="hidden">
                        <h3 class="text-lg font-bold text-primary-600 mt-4 mb-2">Deskripsi</h3>
                        <p id="modal-description" class="text-gray-700 text-base whitespace-pre-line leading-relaxed">
                        </p>
                    </div>

                    {{-- BLOK SPESIFIKASI DIHAPUS --}}
                </div>
            </div>

            <hr class="border-primary-100 my-6">

            {{-- TOMBOL WA DIPINDAHKAN KE BAWAH SEKALI (LEBAR PENUH) --}}
            <div class="pt-4" id="whatsapp-container">
                <a id="whatsapp-link" href="#" target="_blank"
                    class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-3 rounded-xl transition-all duration-300 w-full text-base shadow-lg transform hover:scale-[1.01]">
                    {{-- Ikon Telepon --}}
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.21-2.21c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.74 21 3 13.26 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.24.2 2.45.57 3.57.12.35.03.75-.25 1.02L6.62 10.79z"/>
                    </svg>
                    <span id="whatsapp-button-text">Pesan via WhatsApp</span>
                </a>
            </div>

            {{-- BLOK REKOMENDASI DIHAPUS/DISEMBUNYIKAN PERMANEN --}}
            <div class="modal-recommendations-section pt-4 hidden" id="recommendation-block">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-l-4 border-primary-500 pl-3">Rekomendasi Produk
                    Serupa</h3>
                <div id="rekomendasi-produk" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Hero Carousel Controls - Diperbaiki untuk tampilan
        (function() {
            const track = document.getElementById('heroTrack');
            if (!track) return;

            const slides = Array.from(track.querySelectorAll('.hero-slide'));
            const indicators = document.getElementById('heroIndicators');

            let current = 0;
            let autoplay = true;
            let timer = null;
            const interval = 4500;

            function updateSlidePosition() {
                const offset = -current * 100;
                track.style.transform = `translateX(${offset}%)`;
            }

            function goTo(index) {
                current = (index + slides.length) % slides.length;
                updateSlidePosition(); // Memanggil fungsi perbaikan
                updateIndicators();
            }

            function next() {
                goTo(current + 1);
            }

            function stopAutoplay() {
                if (timer) {
                    clearInterval(timer);
                    timer = null;
                }
            }

            function startAutoplay() {
                stopAutoplay();
                timer = setInterval(() => {
                    next();
                }, interval);
            }

            function updateIndicators() {
                if (!indicators) return;
                indicators.innerHTML = '';
                slides.forEach((s, i) => {
                    const btn = document.createElement('button');
                    btn.className = 'w-3 h-3 rounded-full bg-white/60';
                    if (i === current) btn.className = 'w-3 h-3 rounded-full bg-white';
                    btn.addEventListener('click', () => {
                        goTo(i);
                        stopAutoplay();
                    });
                    indicators.appendChild(btn);
                });
            }

            const carouselRoot = track.parentElement;
            if (carouselRoot) {
                carouselRoot.addEventListener('mouseenter', () => {
                    stopAutoplay();
                });
                carouselRoot.addEventListener('mouseleave', () => {
                    if (autoplay) startAutoplay();
                });
            }

            goTo(0);
            updateIndicators();
            if (autoplay) startAutoplay();
        })();

        // FUNGSI MODAL UNIVERSAL BARU (Menangani Layanan & Produk)
        window.openUniversalModal = function(imageUrl, name, description, oldPrice, newPrice, category,
            specifications = '') {

            // Ambil semua elemen penting dari modal
            const modal = document.getElementById('product-modal');
            const modalContent = document.getElementById('product-modal-content');
            const modalTitle = document.getElementById('modal-title');
            const modalImage = document.getElementById('modal-image');
            const modalDescription = document.getElementById('modal-description');

            // Elemen CTA WhatsApp
            const whatsappLink = document.getElementById('whatsapp-link');
            const whatsappButtonText = document.getElementById('whatsapp-button-text');

            // Elemen Harga Overlay
            const priceBlockOverlay = document.getElementById('modal-price-display-overlay');
            const oldPriceElContainerOverlay = document.getElementById('modal-old-price-container-overlay');
            const oldPriceElOverlay = document.getElementById('modal-old-price-overlay');
            const newPriceElOverlay = document.getElementById('modal-new-price-overlay');

            // Elemen lain
            const promoTag = document.getElementById('modal-promo-tag');
            const descriptionBlock = document.getElementById('modal-description-block');
            const recommendationBlock = document.getElementById('recommendation-block');

            // Membersihkan description
            const cleanDescription = (description ? String(description) : '').replace(/<br\s*[\/]?>/gi, "\n")
                .trim();

            // isProduct selalu TRUE untuk menyamakan tampilan CTA
            const isProduct = true;

            // 1. Isi Konten Dasar
            modalImage.src = imageUrl;
            modalTitle.textContent = name;

            // 2. Logika Deskripsi
            descriptionBlock.classList.remove('hidden');
            if (cleanDescription.length > 5) {
                modalDescription.textContent = cleanDescription;
            } else {
                modalDescription.textContent = 'Tidak ada deskripsi rinci untuk layanan atau produk ini.';
            }

            // Logika Spesifikasi Dihapus

            // 4. Logika Penanganan Harga (Mengisi Elemen Overlay)
            const priceToNumber = (price) => {
                if (!price) return 0;
                return parseFloat(price.replace(/[^0-9]/g, '')) || 0;
            };

            const hasValidPrice = priceToNumber(newPrice) > 0;

            if (hasValidPrice) {
                priceBlockOverlay.classList.remove('hidden');

                const isPromoActive = (oldPrice && newPrice && priceToNumber(oldPrice) > priceToNumber(
                    newPrice));

                if (isPromoActive) {
                    oldPriceElContainerOverlay.classList.remove('hidden');
                    oldPriceElOverlay.textContent = oldPrice;
                    newPriceElOverlay.textContent = newPrice;
                    promoTag.classList.remove('hidden');
                } else {
                    oldPriceElContainerOverlay.classList.add('hidden');
                    newPriceElOverlay.textContent = newPrice;
                    promoTag.classList.add('hidden');
                }
            } else {
                priceBlockOverlay.classList.add('hidden');
                promoTag.classList.add('hidden');
            }

            // 5. Logika CTA WhatsApp
            const itemType = isProduct ? 'produk' : 'layanan';
            const ctaText = 'Pesan via WhatsApp';
            const waMessage =
                `Halo, saya tertarik dengan ${itemType}: ${name} (${newPrice}). Bisakah saya mendapatkan detail lebih lanjut?`;

            const waNumber = '{{ $userStore->store_phone ?? '' }}'.replace(/[^0-9]/g, '');

            whatsappButtonText.textContent = (waNumber.length > 8) ? ctaText : 'Hubungi Kami';

            const waLink = `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`;

            whatsappLink.href = waLink;
            document.getElementById('whatsapp-container').classList.remove('hidden');


            // Hapus Logika Penanganan Rekomendasi
            recommendationBlock.classList.add('hidden');

            // 7. Tampilkan modal dengan animasi
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-100');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        };

        window.closeProductModal = function() {
            const modal = document.getElementById('product-modal');
            const modalContent = document.getElementById('product-modal-content');

            // Animasi keluar
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 300);
        };

        // --- FUNGSI FILTER DAN PAGINASI (TIDAK BERUBAH) ---

        // Variabel global untuk filter & pagination
        const allProductCards = Array.from(document.querySelectorAll('.hairstyle-card'));
        const filterBtns = document.querySelectorAll(".category-btn");
        const controlsContainer = document.getElementById('pagination-controls');
        const subcategoryDropdownContainer = document.getElementById('subcategory-dropdown-container');
        const subcategoryDropdownButton = document.getElementById('subcategory-dropdown-button');
        const subcategoryDropdownMenu = document.getElementById('subcategory-dropdown-menu');
        const dropdownCurrentText = document.getElementById('dropdown-current-text');
        const pageSize = 10;

        let currentCategory = 'hairstyle';
        let currentSubCategory = 'all';
        let currentPage = 1;

        // FUNGSI TOGGLE DROPDOWN
        function toggleDropdown() {
            if (subcategoryDropdownMenu) {
                subcategoryDropdownMenu.classList.toggle('hidden');
            }
        }

        // Event listener untuk tombol utama dropdown
        if (subcategoryDropdownButton) {
            subcategoryDropdownButton.addEventListener('click', toggleDropdown);
        }

        // Event listener untuk menutup dropdown jika klik di luar
        document.addEventListener('click', function(event) {
            const isClickInside = subcategoryDropdownContainer && subcategoryDropdownContainer.contains(event.target);
            if (subcategoryDropdownMenu && !isClickInside) {
                subcategoryDropdownMenu.classList.add('hidden');
            }
        });


        // Fungsi untuk merender Opsi Sub-Kategori ke Dropdown
        function renderSubCategoryButtons() {
            if (!subcategoryDropdownMenu) return;

            // 1. Bersihkan kontainer
            subcategoryDropdownMenu.innerHTML = '';

            // 2. Kumpulkan sub-kategori unik dari produk yang sedang aktif (sesuai currentCategory)
            const uniqueSubCategories = new Set();

            allProductCards.forEach(card => {
                if (card.dataset.category === currentCategory) {
                    const sub = card.dataset.subCategory;
                    if (sub && sub !== 'all') {
                        uniqueSubCategories.add(sub);
                    }
                }
            });

            // 3. Sembunyikan kontainer Dropdown jika tidak ada sub-kategori unik
            if (uniqueSubCategories.size === 0) {
                subcategoryDropdownContainer.classList.add('hidden');
                return;
            } else {
                subcategoryDropdownContainer.classList.remove('hidden');
            }

            // --- 4. Tambahkan Opsi 'Semua' ---
            const allOption = document.createElement('a');
            allOption.href = "#";
            allOption.className =
                'block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors';
            allOption.textContent = 'Semua (Reset Filter)';
            allOption.setAttribute('data-filter', 'all');
            subcategoryDropdownMenu.appendChild(allOption);

            // --- 5. Render opsi untuk setiap sub-kategori ---
            Array.from(uniqueSubCategories).forEach(sub => {
                const option = document.createElement('a');
                option.href = "#";
                option.className =
                    'block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors';
                // Kapitalisasi huruf pertama setiap kata
                option.textContent = sub.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');
                option.setAttribute('data-filter', sub);
                subcategoryDropdownMenu.appendChild(option);
            });

            // --- 6. Atur event listener untuk Opsi Sub-Kategori ---
            const subFilterOptions = subcategoryDropdownMenu.querySelectorAll("a");
            subFilterOptions.forEach(option => {
                option.addEventListener("click", function(e) {
                    e.preventDefault(); // Mencegah pindah halaman

                    const newSubFilter = this.getAttribute("data-filter");
                    const newText = this.textContent;

                    // 7. Update status filter dan teks tombol
                    currentSubCategory = newSubFilter;
                    currentPage = 1;

                    // Perbarui teks tombol dropdown utama
                    dropdownCurrentText.textContent = (newSubFilter === 'all') ? 'Pilih Sub-Kategori' :
                        newText;

                    renderPage();
                    toggleDropdown(); // Tutup dropdown setelah memilih
                });
            });

            // 8. Set ulang teks default dan filter
            dropdownCurrentText.textContent = 'Pilih Sub-Kategori';
            currentSubCategory = 'all';
        }


        function renderPage() {
            const noResultsMessage = document.getElementById('no-results');

            if (!allProductCards || !controlsContainer) return;

            // MODIFIKASI: Filter Berdasarkan Category DAN Sub-Category
            let visibleCards = allProductCards.filter(card => {
                const isCategoryMatch = card.dataset.category === currentCategory;

                // Periksa Sub-Category: Jika 'all' atau cocok dengan data-sub-category
                const isSubCategoryMatch = currentSubCategory === 'all' || card.dataset.subCategory ===
                    currentSubCategory;

                return isCategoryMatch && isSubCategoryMatch;
            });


            const totalItems = visibleCards.length;
            const totalPages = Math.max(1, Math.ceil(totalItems / pageSize));

            // Pastikan halaman berada dalam batas yang valid
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const start = (currentPage - 1) * pageSize;
            const end = start + pageSize;

            allProductCards.forEach(card => card.style.display = 'none');
            visibleCards.forEach((card, idx) => {
                if (idx >= start && idx < end) {
                    card.style.display = 'block';
                }
            });

            noResultsMessage.classList.toggle('hidden', totalItems > 0);

            renderPaginationControls(totalPages);

            const container = document.getElementById('services');
            if (container) {
                container.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        function renderPaginationControls(totalPages) {
            if (!controlsContainer) return;

            controlsContainer.innerHTML = '';
            if (totalPages <= 1) return;

            const isMobile = window.innerWidth < 640;
            const maxVisiblePages = isMobile ? 3 : 7;
            const containerClass =
                'px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md hover:bg-pink-500 hover:text-white';
            const activeClass =
                'px-4 py-2 mx-1 text-white transition-colors duration-300 transform bg-pink-500 rounded-md';
            const disabledClass =
                'px-4 py-2 mx-1 text-gray-400 transition-colors duration-300 transform bg-white rounded-md cursor-not-allowed opacity-50';

            // Tombol Sebelumnya
            const prev = document.createElement('button');
            prev.className = currentPage === 1 ? disabledClass : containerClass;
            prev.innerHTML = '‹ Previous';
            prev.style.width = 'auto';
            prev.style.minWidth = '100px';
            prev.disabled = currentPage === 1;
            prev.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderPage();
                }
            });
            controlsContainer.appendChild(prev);

            function addPageButton(pageNum) {
                const btn = document.createElement('button');
                btn.className = pageNum === currentPage ? activeClass : containerClass;
                btn.textContent = pageNum;
                btn.style.width = '2.5rem';
                btn.style.height = '2.5rem';
                btn.style.padding = '0';
                btn.style.display = 'inline-flex';
                btn.style.alignItems = 'center';
                btn.style.justifyContent = 'center';

                btn.addEventListener('click', () => {
                    currentPage = pageNum;
                    renderPage();
                });
                controlsContainer.appendChild(btn);
            }

            if (totalPages <= maxVisiblePages) {
                for (let i = 1; i <= totalPages; i++) {
                    addPageButton(i);
                }
            } else {
                addPageButton(1);

                let showEllipsis1 = currentPage > 3;
                let showEllipsis2 = currentPage < totalPages - 2;

                if (showEllipsis1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'px-4 py-2 mx-1 text-gray-700';
                    ellipsis.textContent = '...';
                    ellipsis.style.width = '2.5rem';
                    ellipsis.style.height = '2.5rem';
                    ellipsis.style.padding = '0';
                    ellipsis.style.display = 'inline-flex';
                    ellipsis.style.alignItems = 'center';
                    ellipsis.style.justifyContent = 'center';
                    controlsContainer.appendChild(ellipsis);
                }

                const startPage = Math.max(2, currentPage - 1);
                const endPage = Math.min(totalPages - 1, currentPage + 1);

                for (let i = startPage; i <= endPage; i++) {
                    addPageButton(i);
                }

                if (showEllipsis2 && (endPage < totalPages - 1)) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'px-4 py-2 mx-1 text-gray-700';
                    ellipsis.textContent = '...';
                    ellipsis.style.width = '2.5rem';
                    ellipsis.style.height = '2.5rem';
                    ellipsis.style.padding = '0';
                    ellipsis.style.display = 'inline-flex';
                    ellipsis.style.alignItems = 'center';
                    ellipsis.style.justifyContent = 'center';
                    controlsContainer.appendChild(ellipsis);
                }

                if (totalPages > 1 && totalPages !== 1) {
                    addPageButton(totalPages);
                }
            }

            // Tombol Selanjutnya
            const next = document.createElement('button');
            next.className = currentPage === totalPages ? disabledClass : containerClass;
            next.innerHTML = 'Next ›';
            next.style.width = 'auto';
            next.style.minWidth = '100px';
            next.disabled = currentPage === totalPages;
            next.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderPage();
                }
            });
            controlsContainer.appendChild(next);
        }

        // --- EVENT LISTENERS FILTER KATEGORI (TIDAK BERUBAH) ---
        filterBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                const newFilter = this.getAttribute("data-filter");
                if (!newFilter) return;

                // Perbarui tombol active (Category)
                filterBtns.forEach(b => {
                    b.classList.remove("active", "bg-pink-500", "text-white", "ring-pink-500");
                    b.classList.add("bg-white", "text-gray-700", "ring-1", "ring-gray-200");
                });
                this.classList.remove("bg-white", "text-gray-700", "ring-1", "ring-gray-200");
                this.classList.add("active", "bg-pink-500", "text-white", "ring-pink-500");

                currentCategory = newFilter;
                currentSubCategory = 'all';
                currentPage = 1;

                // MODIFIKASI: Render ulang Dropdown Sub-Category
                renderSubCategoryButtons();
                renderPage();
            });
        });

        // --- INISIALISASI (TIDAK BERUBAH) ---
        document.addEventListener('DOMContentLoaded', () => {
            const defaultBtn = document.querySelector('.category-btn[data-filter="hairstyle"]');
            if (defaultBtn) {
                currentCategory = defaultBtn.dataset.filter;
                defaultBtn.classList.add("active", "bg-pink-500", "text-white", "ring-pink-500");
                defaultBtn.classList.remove("bg-white", "text-gray-700", "ring-1", "ring-gray-200");
            } else {
                const firstBtn = document.querySelector('.category-btn');
                if (firstBtn) {
                    currentCategory = firstBtn.dataset.filter;
                    firstBtn.classList.add("active", "bg-pink-500", "text-white", "ring-pink-500");
                    firstBtn.classList.remove("bg-white", "text-gray-700", "ring-1", "ring-gray-200");
                }
            }

            currentSubCategory = 'all';
            currentPage = 1;

            // MODIFIKASI: Inisialisasi tombol sub-kategori saat halaman dimuat
            renderSubCategoryButtons();
            renderPage();

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    renderPage();
                }, 250);
            });
        });
    </script>
</body>

</html>
