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
        // Fungsi untuk membuat card rekomendasi
        function createRecommendationCard(product) {
            return `
                <div class="group cursor-pointer hover:shadow-lg transition-all rounded-lg overflow-hidden"
                    onclick="openProductModal('${product.img}', '${product.title}', '', '${product.oldPrice}', '${product.newPrice}', 'product')">
                    <div class="aspect-[1/1] relative">
                        <img src="${product.img}" alt="${product.title}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="absolute inset-0 bg-black/50 flex flex-col justify-end p-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <h5 class="text-white font-bold line-clamp-2">${product.title}</h5>
                            <p class="text-white/90 text-sm mt-1">${product.newPrice}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        // Fungsi untuk menebak kategori produk (Digunakan untuk rekomendasi)
        function guessProductCategory(title, desc) {
            const keywords = {
                wajah: ['serum', 'masker', 'krim', 'toner', 'mist', 'facial', 'wajah'],
                rambut: ['shampoo', 'conditioner', 'rambut', 'hair'],
                body: ['body', 'tubuh', 'scrub', 'lotion', 'gel', 'sabun', 'krim tangan'],
                aromaterapi: ['minyak', 'parfum', 'aroma', 'esensial', 'essential']
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

        // Fungsi untuk mendapatkan rekomendasi produk dengan Null Check
        function getRecommendations(currentTitle, desc) {
            const allProducts = Array.from(document.querySelectorAll('.hairstyle-card')).map(card => {
                // Mengambil data dari atribut Blade (data-price sudah disetel ke harga baru)
                const titleElement = card.querySelector('.text-white h3');
                const oldPriceEl = card.querySelector('.text-white .line-through');
                const newPriceEl = card.querySelector('.text-white p > span:not(.line-through)');
                const imgElement = card.querySelector('img');

                const title = titleElement ? titleElement.textContent.trim() : 'No Title';
                const newPrice = newPriceEl ? newPriceEl.textContent.trim() : card.dataset.price;
                const oldPrice = oldPriceEl ? oldPriceEl.textContent.trim() : newPrice; // Jika tidak ada coretan, harga lama = harga baru

                const img = imgElement ? imgElement.src : '';
                const category = card.dataset.category || 'general';

                return {
                    title,
                    desc: '',
                    oldPrice,
                    newPrice,
                    img,
                    category
                };
            });

            const category = guessProductCategory(currentTitle, desc);

            const similarProducts = allProducts.filter(p =>
                p.title !== currentTitle && (
                    p.category === category ||
                    guessProductCategory(p.title, p.desc) === category
                )
            );

            return similarProducts.sort(() => Math.random() - 0.5).slice(0, 3);
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
                            <span class="text-pink-600 font-bold text-lg">{{ substr($userStore->store_name, 0, 1) }}</span>
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
    <section class="hero-gradient min-h-[55vh] flex items-center pt-8 relative overflow-hidden">
        <div class="hero-carousel" aria-hidden="false">
            <div class="hero-carousel-track" id="heroTrack">
                @forelse ($banners as $banner)
                    <div class="hero-slide"
                        style="background-image: url('{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $banner->image_url]) }}')"
                        data-caption="{{ $banner->title }} — {{ $banner->subtitle }}">
                        <div class="hero-caption">
                            <h2 class="text-2xl sm:text-3xl font-bold">{{ $banner->title }}</h2>
                            <p class="mt-1">{{ $banner->subtitle }}</p>
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
                            <h2 class="text-2xl sm:text-3xl font-bold">Selamat datang di {{ $userStore->store_name }}</h2>
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

            {{-- 🔥 MODIFIKASI: DROPDOWN FILTER SUB-KATEGORI (Warna Pink) 🔥 --}}
            <div class="mt-4 flex justify-center w-full">
                <div id="subcategory-dropdown-container" class="relative inline-block text-left w-auto min-w-[200px]">
                    <button type="button" id="subcategory-dropdown-button"
                        class="inline-flex justify-center items-center w-full rounded-full shadow-sm px-6 py-2 bg-white text-sm font-medium text-primary-500 hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 transition-all border border-primary-500">
                        <span id="dropdown-current-text">Kategori</span>
                        <svg class="w-4 h-4 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="subcategory-dropdown-menu"
                        class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-40 max-h-60 overflow-y-auto"
                        role="menu">
                        {{-- Opsi Sub-Kategori akan di-inject oleh JavaScript di sini --}}
                    </div>
                </div>
            </div>
            {{-- 🔥 AKHIR DROPDOWN FILTER SUB-KATEGORI 🔥 --}}

            {{-- Product Grid Container (DENGAN LOGIKA PROMO) --}}
            <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
                @forelse ($products as $product)
                    @php
                        // 🔥 Logika Harga (ASUMSI DISKON ADA DI $product->discount_price_idr) 🔥
                        $oldPrice = $product->price_idr ?? 'Rp 0';
                        $newPrice = $product->discount_price_idr ?? $oldPrice;
                        // Perbandingan harga harus dilakukan setelah memastikan formatnya sama (misal, tanpa 'Rp ')
                        $isPromo = (str_replace('Rp ', '', $newPrice) != str_replace('Rp ', '', $oldPrice));
                        $categoryName = strtolower($product->category->name ?? 'general');
                        $isProductCategory = ($categoryName == 'product');
                    @endphp

                    <div class="hairstyle-card group" data-name="{{ strtolower($product->name) }}"
                        data-category="{{ $categoryName }}"
                        data-sub-category="{{ strtolower($product->subCategory->name ?? 'all') }}"
                        data-price="{{ $newPrice }}">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative bg-gray-100">

                            @if ($isProductCategory && $isPromo)
                                {{-- 🔥 LABEL PROMO DI KIRI ATAS 🔥 --}}
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
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
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
                                        {{-- 🔥 TAMPILAN HARGA PROMO DI OVERLAY CARD 🔥 --}}
                                        <span class="line-through text-gray-400 mr-2">{{ $oldPrice }}</span>
                                        <span class="font-bold">{{ $newPrice }}</span>
                                    @else
                                        {{ $newPrice }}
                                    @endif
                                </p>
                            </div>

                            {{-- Tombol Modal Detail/Universal (Kanan Atas) --}}
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                                onclick="openProductModal('{{ $product->primary_image_src }}', '{{ $product->name }}', '{{ $product->description }}', '{{ $oldPrice }}', '{{ $newPrice }}', '{{ $categoryName }}')">
                                @if ($categoryName == 'product')
                                    🛒
                                @else
                                    👁
                                @endif
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

    {{-- MODAL UNIVERSAL (Untuk Hairstyle, Nailart, Spa) --}}
    <div id="universal-modal" class="fixed inset-0 z-[9999] flex items-center justify-center hidden p-4">
        <div class="absolute inset-0 bg-black/80" onclick="tutupModalUniversal()"></div>
        <div class="relative bg-white rounded-xl overflow-hidden max-w-xl w-full max-h-[90vh] flex flex-col">
            <button onclick="tutupModalUniversal()"
                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 hover:bg-primary-500 hover:text-white transition-colors">
                ✕
            </button>
            <div class="p-2 flex-1 overflow-auto">
                <img id="universal-modal-image" src="" alt="Preview"
                    class="w-full h-auto object-contain max-h-[40vh] rounded-lg" />
            </div>
            <div class="text-center text-gray-800 text-lg font-semibold p-4" id="universal-modal-title"></div>
        </div>
    </div>

    {{-- MODAL PRODUK (Untuk Product - DIUBAH UNTUK PROMO) --}}
    <div id="product-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80" onclick="closeProductModal()"></div>
        <div
            class="relative bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto transform transition-transform duration-300">

            <button onclick="closeProductModal()"
                class="absolute top-3 right-3 z-10 bg-white/70 rounded-full p-2 hover:bg-red-500 hover:text-white transition-all">✕</button>

            <div class="p-4 md:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <img id="modal-image" src="" alt="Product"
                            class="w-full h-[300px] md:h-[400px] object-cover rounded-lg shadow-lg" />
                    </div>

                    <div class="modal-details-section">
                        <h2 id="modal-title" class="text-2xl font-bold mb-2"></h2>
                        <p id="modal-description" class="text-gray-600 mb-4"></p>

                        {{-- 🔥 BLOK HARGA DENGAN DUA ELEMEN BARU 🔥 --}}
                        <div class="mb-6">
                            <p class="text-sm text-gray-400 line-through" id="modal-old-price"></p>
                            <p class="text-2xl font-semibold text-primary-600" id="modal-new-price"></p>
                        </div>

                        <a id="whatsapp-link" href="#" target="_blank"
                            class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors w-full">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>

                <div class="modal-recommendations-section mt-8">
                    <h3 class="text-xl font-bold mb-4">Rekomendasi Produk Serupa</h3>
                    <div id="rekomendasi-produk" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                </div>
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


        // --- FUNGSI MODAL ---

        // Fungsi Universal Modal (Untuk Layanan - Sesuai Tampilan Demo)
        window.bukaModalUniversal = function(imageUrl, title) {
            const modal = document.getElementById('universal-modal');
            const modalImage = document.getElementById('universal-modal-image');
            const modalTitle = document.getElementById('universal-modal-title');

            modalImage.src = imageUrl;
            if (title) {
                modalTitle.textContent = title;
            }

            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };

        window.tutupModalUniversal = function() {
            const modal = document.getElementById('universal-modal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
            document.body.style.overflow = '';
        };

        // FUNGSI MODAL PRODUK (Diperbarui untuk Promo/Diskon)
        window.openProductModal = function(imageUrl, name, description, oldPrice, newPrice, category) {

            // Logika pengalihan untuk membedakan LAYANAN dan PRODUK (TIDAK BERUBAH)
            const simpleViewCategories = ['hairstyle', 'spa', 'nail', 'nailart', 'nail art'];
            let categoryLower = category ? category.toLowerCase().trim() : '';
            const isSimpleView = simpleViewCategories.includes(categoryLower);

            if (isSimpleView) {
                // Gunakan modal universal (simple view) untuk layanan
                bukaModalUniversal(imageUrl, name);
                return;
            }

            // Jika 'product', lanjutkan ke modal detail
            const modal = document.getElementById('product-modal');
            const modalImage = document.getElementById('modal-image');
            const modalDetailsSection = modal.querySelector('.modal-details-section');

            // Dapatkan elemen harga
            const oldPriceEl = document.getElementById('modal-old-price');
            const newPriceEl = document.getElementById('modal-new-price');

            const displayPrice = newPrice; // Harga yang digunakan di pesan WA

            // 1. Isi Konten Modal
            modalImage.src = imageUrl;
            if (modalDetailsSection) {
                document.getElementById('modal-title').textContent = name;
                document.getElementById('modal-description').textContent = description;

                // 🔥 LOGIKA HARGA PROMO BARU 🔥
                if (oldPrice && newPrice && oldPrice !== newPrice) {
                    oldPriceEl.textContent = oldPrice; // Harga lama (dicoret)
                    oldPriceEl.classList.remove('hidden');
                    newPriceEl.textContent = newPrice; // Harga baru
                } else {
                    oldPriceEl.textContent = ''; // Sembunyikan harga lama jika tidak ada promo
                    oldPriceEl.classList.add('hidden');
                    newPriceEl.textContent = oldPrice || newPrice; // Tampilkan harga normal
                }

                // 2. Setup WhatsApp link
                const phoneNumber = '{{ $userStore->whatsapp }}';
                const message = encodeURIComponent(
                    `Halo, saya tertarik dengan produk "${name}" yang seharga ${displayPrice}.`
                );
                document.getElementById('whatsapp-link').href = `https://wa.me/${phoneNumber}?text=${message}`;
            }

            // 3. Isi Rekomendasi (TIDAK BERUBAH)
            const rekomendasi = document.getElementById('rekomendasi-produk');
            const recommendations = getRecommendations(name, description);
            rekomendasi.innerHTML = '';

            if (recommendations.length > 0) {
                const recommendationsHTML = recommendations
                    .map(createRecommendationCard)
                    .join('');
                rekomendasi.innerHTML = recommendationsHTML;
            } else {
                rekomendasi.innerHTML = '<p class="text-gray-500 text-center col-span-2">Tidak ada rekomendasi produk serupa saat ini.</p>';
            }

            // 4. Tampilkan modal detail
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };

        window.closeProductModal = function() {
            const modal = document.getElementById('product-modal');
            modal.classList.add('hidden');
            modal.style.display = 'none';
            document.body.style.overflow = '';
        };

        // --- FUNGSI FILTER DAN PAGINASI ---

        // Variabel global untuk filter & pagination
        const allProductCards = Array.from(document.querySelectorAll('.hairstyle-card'));
        const filterBtns = document.querySelectorAll(".category-btn");
        const controlsContainer = document.getElementById('pagination-controls');
        // 🔥 VARIABEL BARU UNTUK DROPDOWN 🔥
        const subcategoryDropdownContainer = document.getElementById('subcategory-dropdown-container');
        const subcategoryDropdownButton = document.getElementById('subcategory-dropdown-button');
        const subcategoryDropdownMenu = document.getElementById('subcategory-dropdown-menu');
        const dropdownCurrentText = document.getElementById('dropdown-current-text');
        // 👇 MODIFIKASI: Mengubah jumlah kartu per halaman menjadi 10
        const pageSize = 10;

        let currentCategory = 'hairstyle';
        let currentSubCategory = 'all'; // Variabel untuk menyimpan filter sub-kategori
        let currentPage = 1;

        // 🔥 FUNGSI TOGGLE DROPDOWN 🔥
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


        // 🔥 MODIFIKASI: Fungsi untuk merender Opsi Sub-Kategori ke Dropdown 🔥
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
            allOption.className = 'block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors';
            allOption.textContent = 'Semua (Reset Filter)';
            allOption.setAttribute('data-filter', 'all');
            subcategoryDropdownMenu.appendChild(allOption);

            // --- 5. Render opsi untuk setiap sub-kategori ---
            Array.from(uniqueSubCategories).forEach(sub => {
                const option = document.createElement('a');
                option.href = "#";
                option.className = 'block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors';
                // Kapitalisasi huruf pertama setiap kata
                option.textContent = sub.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
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
                    dropdownCurrentText.textContent = (newSubFilter === 'all') ? 'Pilih Sub-Kategori' : newText;

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

            // 🔥 MODIFIKASI: Filter Berdasarkan Category DAN Sub-Category 🔥
            let visibleCards = allProductCards.filter(card => {
                const isCategoryMatch = card.dataset.category === currentCategory;

                // Periksa Sub-Category: Jika 'all' atau cocok dengan data-sub-category
                const isSubCategoryMatch = currentSubCategory === 'all' || card.dataset.subCategory === currentSubCategory;

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
            const containerClass = 'px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md hover:bg-pink-500 hover:text-white';
            const activeClass = 'px-4 py-2 mx-1 text-white transition-colors duration-300 transform bg-pink-500 rounded-md';
            const disabledClass = 'px-4 py-2 mx-1 text-gray-400 transition-colors duration-300 transform bg-white rounded-md cursor-not-allowed opacity-50';

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

        // --- EVENT LISTENERS FILTER KATEGORI ---
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

                // 🔥 MODIFIKASI: Render ulang Dropdown Sub-Category 🔥
                renderSubCategoryButtons();
                renderPage();
            });
        });

        // --- INISIALISASI ---
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

            // 🔥 MODIFIKASI: Inisialisasi tombol sub-kategori saat halaman dimuat 🔥
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
