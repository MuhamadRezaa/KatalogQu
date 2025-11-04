<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $userStore->store_name ?? 'Kopi Seduh Pagi' }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="{{ asset('assets/demo/fnb/style.css') }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-[#1b0e0e]">

    <header
        class="fixed top-0 w-full z-50 bg-white border-b border-[#f3e7e8] px-4 sm:px-6 md:px-8 py-4 header-transition">
        <div class="max-w-6xl mx-auto flex justify-between items-center relative">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                    <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="{{ $userStore->store_name ?? 'Kopi Seduh Pagi' }}"
                        class="w-full
                        h-full object-cover">
                </div>
                <h1 class="text-lg font-bold">{{ $userStore->store_name ?? 'Kopi Seduh Pagi' }}</h1>
            </div>
        </div>

        <style>
            /* Gaya dasar untuk card */
            .card-category {
                background-color: #fff;
                border-radius: 1.5rem;
                /* 2xl = 24px */
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                /* shadow-md */
                overflow: hidden;
                transition: transform 0.3s ease-in-out;
            }

            /* Gaya saat di-hover (efek animasi) */
            .card-category:hover {
                transform: scale(1.05);
                /* Memperbesar 5% */
            }

            /* Gaya untuk teks */
            .section-title {
                text-align: center;
                font-size: 1.5rem;
                /* 2xl */
                font-weight: 700;
                /* bold */
                margin-bottom: 2rem;
                /* mb-8 */
            }

            .card-title {
                font-weight: 600;
                /* semibold */
            }

            .card-description {
                font-size: 0.875rem;
                /* sm */
                color: #4b5563;
                /* gray-600 */
            }
        </style>
    </header>

    <div class="relative w-full overflow-hidden bg-[#2a1a1a] z-40">
        <!-- Container dengan aspect ratio 16:9 (1920:1080) -->
        <div class="relative w-full" style="padding-top: 56.25%;">
            <div id="image-carousel"
                class="absolute top-0 left-0 w-full h-full flex transition-transform duration-1000 ease-in-out">
                @forelse ($banners as $banner)
                    <div class="w-full flex-shrink-0 relative">
                        <img src="{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                            alt="{{ $banner->title }}" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-30">
                            <div
                                class="absolute inset-0 flex items-center justify-center text-center p-4 sm:p-8 md:p-12">
                                <div class="relative z-10 max-w-4xl mx-auto">
                                    <h3
                                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
                                        {!! $banner->title !!}</h3>
                                    <p
                                        class="text-sm sm:text-base md:text-lg text-gray-200 mt-2 sm:mt-4 drop-shadow-lg max-w-xl mx-auto">
                                        {!! $banner->subtitle !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full flex-shrink-0 relative">
                        <img src="{{ asset('assets/demo/fnb/images/background4.jpg') }}"
                            alt="{{ $userStore->store_name }}" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-30">
                            <div
                                class="absolute inset-0 flex items-center justify-center text-center p-4 sm:p-8 md:p-12">
                                <div class="relative z-10 max-w-4xl mx-auto">
                                    <h3
                                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
                                        {{ $userStore->store_name }}</h3>
                                    <p
                                        class="text-sm sm:text-base md:text-lg text-gray-200 mt-2 sm:mt-4 drop-shadow-lg max-w-xl mx-auto">
                                        {{ $userStore->store_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Navigation Buttons -->
            <button
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 rounded-full focus:outline-none transition-all duration-200 hidden sm:block"
                id="prevSlide">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 rounded-full focus:outline-none transition-all duration-200 hidden sm:block"
                id="nextSlide">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach ($banners as $index => $banner)
                    <button
                        class="w-2 h-2 rounded-full bg-white {{ $index === 0 ? 'bg-opacity-100' : 'bg-opacity-50' }} hover:bg-opacity-100 transition-all duration-200 dot"></button>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('image-carousel');
            const slides = carousel.children;
            const totalSlides = slides.length;
            let currentSlide = 0;
            let autoplayInterval;

            // Navigation functions
            function updateSlidePosition() {
                carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
                updateDots();
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlidePosition();
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlidePosition();
            }

            // Update dots
            function updateDots() {
                document.querySelectorAll('.dot').forEach((dot, index) => {
                    dot.classList.toggle('bg-opacity-50', index !== currentSlide);
                    dot.classList.toggle('bg-opacity-100', index === currentSlide);
                });
            }

            // Event listeners
            document.getElementById('nextSlide')?.addEventListener('click', () => {
                nextSlide();
                resetAutoplay();
            });

            document.getElementById('prevSlide')?.addEventListener('click', () => {
                prevSlide();
                resetAutoplay();
            });

            // Dot navigation
            document.querySelectorAll('.dot').forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlidePosition();
                    resetAutoplay();
                });
            });

            // Autoplay
            function startAutoplay() {
                autoplayInterval = setInterval(nextSlide, 5000);
            }

            function resetAutoplay() {
                clearInterval(autoplayInterval);
                startAutoplay();
            }

            // Touch support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            });

            carousel.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                    resetAutoplay();
                }
            }

            // Initial setup
            startAutoplay();
        });
    </script>

    <main class="w-full mx-auto py-8 px-4 space-y-10 pt-5">
        <section class="py-1 px-4">
            <h2 class="text-center text-2xl font-bold mb-8">CATEGORY MENU</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <!-- Card -->
                @if (isset($categories) && $categories->isNotEmpty())
                    @php $totalCategories = $categories->count(); @endphp
                    @foreach ($categories as $index => $category)
                        <div class="card-category {{ $index >= 4 ? 'hidden category-hidden' : '' }}">
                            <img src="{{ $category->image
                                ? route('tenant.asset.domain', ['path' => ltrim($category->image, '/')])
                                : asset('assets/images/no-image-icon.png') }}"
                                alt="{{ $category->name }}" class="w-full h-40 object-cover">
                            <div class="p-4 text-center">
                                <h3 class="card-title">{{ $category->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                    @if ($totalCategories > 4)
                        <div class="col-span-2 md:col-span-4 flex justify-center mt-4">
                            <button id="show-more-categories"
                                class="bg-[#994d51] hover:bg-[#7a3c3f] text-white text-sm font-medium py-2 px-6 rounded-full shadow transition duration-200 flex items-center gap-2">
                                <span class="show-more-text">Lihat Semua Kategori</span>
                                <svg class="w-4 h-4 transform transition-transform show-more-icon" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500">Belum ada kategori</p>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const showMoreBtn = document.getElementById('show-more-categories');
                    const hiddenCategories = document.querySelectorAll('.category-hidden');
                    const showMoreText = showMoreBtn?.querySelector('.show-more-text');
                    const showMoreIcon = showMoreBtn?.querySelector('.show-more-icon');
                    let isExpanded = false;

                    if (showMoreBtn) {
                        showMoreBtn.addEventListener('click', function() {
                            isExpanded = !isExpanded;

                            hiddenCategories.forEach(category => {
                                category.classList.toggle('hidden');
                                // Animate opacity
                                if (!category.classList.contains('hidden')) {
                                    category.style.opacity = '0';
                                    setTimeout(() => {
                                        category.style.opacity = '1';
                                    }, 50);
                                }
                            });

                            // Update button text and icon
                            showMoreText.textContent = isExpanded ? 'Sembunyikan Kategori' : 'Lihat Semua Kategori';
                            showMoreIcon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0)';
                        });
                    }
                });
            </script>
            <script>
                // Filter menu sesuai kategori saat card kategori ditekan
                document.querySelectorAll('.card-category').forEach(function(card) {
                    card.addEventListener('click', function() {
                        var categoryText = card.querySelector('.card-title').textContent.trim().toLowerCase();
                        // Mapping kategori agar sesuai dengan data menu
                        var categoryMap = {
                            'minuman': 'minuman',
                            'makanan': 'makanan',
                            'cemilan': 'cemilan',
                            'dessert': 'dessert'
                        };
                        var selectedCategory = categoryMap[categoryText] || 'all';
                        window.currentCategory = selectedCategory;
                        window.currentPage = 1;
                        if (typeof sortAndRender === 'function') sortAndRender();
                        var productSection = document.getElementById('menu-list');
                        if (productSection) {
                            productSection.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                        // Update label kategori jika ada
                        var categoryLabel = document.getElementById('category-label');
                        if (categoryLabel) {
                            switch (selectedCategory) {
                                case 'minuman':
                                    categoryLabel.innerText = 'Minuman';
                                    break;
                                case 'makanan':
                                    categoryLabel.innerText = 'Makanan';
                                    break;
                                case 'cemilan':
                                    categoryLabel.innerText = 'Cemilan';
                                    break;
                                case 'dessert':
                                    categoryLabel.innerText = 'Dessert';
                                    break;
                                default:
                                    categoryLabel.innerText = 'Semua Menu';
                            }
                        }
                    });
                });
            </script>
            <script>
                // Scroll ke produk saat kategori ditekan
                document.querySelectorAll('.card-category').forEach(function(card) {
                    card.addEventListener('click', function() {
                        // Ganti selector berikut sesuai id/section produk utama
                        var productSection = document.getElementById('menu-list');
                        if (productSection) {
                            productSection.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            </script>
        </section>


        <div class="max-w-7xl mx-auto px-4">
            <div class="w-full mt-6 p-6 bg-gray-50 border border-gray-300 rounded-2xl shadow-sm">
                <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Cari Menu</h3>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" id="search-product" placeholder="Cari produk..."
                            class="block w-full rounded-full border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2 pl-10 pr-4">
                    </div>
                </div>

                {{-- <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <h3 class="text-sm font-bold text-gray-800 mb-2 uppercase tracking-wide">Rentang Harga</h3>
                    <select id="price-range-dropdown"
                        class="w-full py-2 px-3 border border-gray-300 rounded-lg text-sm focus:ring-[#994d51] focus:border-[#994d51] transition">
                        <option value="">Semua harga</option>
                        @if (isset($priceRanges) && $priceRanges->isNotEmpty())
                            @foreach ($priceRanges as $range)
                                <option data-min="{{ $range->min ?? 0 }}" data-max="{{ $range->max ?? '' }}">
                                    {{ $range->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <input type="hidden" id="min-price-filter" name="min_price" />
                    <input type="hidden" id="max-price-filter" name="max_price" />
                </div> --}}

                <button id=""
                    class="mt-3 w-full bg-[#994d51] hover:bg-[#7a3c3f] text-white text-sm font-medium py-2 px-4 rounded-md shadow transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Terapkan
                </button>

                <button id="reset-filters"
                    class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors mt-6">
                    Reset Filters
                </button>
            </div>

            <div class="w-full mt-6">
                <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 items-center justify-between">

                    <div class="w-full flex gap-4">

                        <div class="relative w-1/2 bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                            <button id="filter-category-btn" type="button"
                                class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <span id="category-label" class="truncate">Pilih Kategori</span>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="category-options"
                                class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10">
                                <div class="py-1" role="menu" aria-orientation="vertical"
                                    aria-labelledby="filter-category-btn">
                                    {{-- Logika Blade untuk Kategori DIPERTAHANKAN --}}
                                    @if (isset($categories) && $categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                            <a href="#"
                                                class="category-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                                data-category="{{ $category->slug }}">{{ $category->name }}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="relative w-1/2 bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                            <button id="filter-subcategory-btn" type="button"
                                class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <span id="subcategory-label" class="truncate">Pilih Subkategori</span>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="subcategory-options"
                                class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10">
                                <div class="py-1" role="menu" aria-orientation="vertical"
                                    aria-labelledby="filter-subcategory-btn">
                                    {{-- Logika Blade untuk Subkategori DIPERTAHANKAN --}}
                                    @if (isset($subCategories) && $subCategories->isNotEmpty())
                                        @foreach ($subCategories as $subcategory)
                                            <a href="#"
                                                class="subcategory-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                                data-subcategory="{{ $subcategory->name }}"
                                                data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->name }}</a>
                                        @endforeach
                                    @else
                                        <span class="text-xs text-gray-500 px-4 py-2">No subcategories found</span>
                                    @endif
                                    {{-- <a href="#"
                            class="subcategory-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                            data-subcategory="all" data-category-id="all">Semua Subkategori</a> --}}
                                    <script>
                                        console.log('Subcategories data:', @json($subCategories ?? []));
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex gap-4 mt-2 lg:mt-0 lg:w-auto">

                        {{-- Mengubah w-1/2 menjadi w-2/3 agar tombol Grid/List mendapat ruang --}}
                        <div class="relative w-2/3 bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                            <button id="sort-menu-btn" type="button"
                                class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <span id="sort-label" class="truncate">Urutkan menu</span>
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div id="sort-options"
                                class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10">
                                <div class="py-1" role="menu" aria-orientation="vertical"
                                    aria-labelledby="sort-menu-btn">
                                    <a href="#"
                                        class="sort-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        data-sort-by="newest">Urutkan dari yang terbaru</a>
                                    <a href="#"
                                        class="sort-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        data-sort-by="cheapest">Urutkan dari yang termurah</a>
                                    <a href="#"
                                        class="sort-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                        data-sort-by="mostexpensive">Urutkan dari yang termahal</a>
                                </div>
                            </div>
                        </div>

                        {{-- Mengubah div ini agar tombolnya rata kanan dan mengambil sisa lebar (w-1/3) --}}
                        <div class="w-1/3 flex justify-end">
                            <div
                                class="flex border border-gray-300 rounded-md shadow-sm divide-x divide-gray-300 bg-gray-50">
                                <button id="view-grid"
                                    class="p-2 bg-white text-gray-700 hover:bg-gray-50 rounded-l-md active:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M4 4H10V10H4V4ZM14 4H20V10H14V4ZM4 14H10V20H4V14ZM14 14H20V20H14V14Z" />
                                    </svg>
                                </button>
                                <button id="view-list"
                                    class="p-2 bg-white text-gray-700 hover:bg-gray-50 rounded-r-md active:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path d="M4 6H20V8H4V6ZM4 11H20V13H4V11ZM4 16H20V18H4V16Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="w-full mt-6">
                <main class="w-full">
                    <div id="menu-list" class="space-y-6 mt-6 lg:mt-0">
                        <div class="relative flex justify-between items-start border-b border-gray-200 pb-6 **mb-4**">
                        </div>
                        <div class="relative flex justify-between items-start border-b border-gray-200 pb-6 **mb-4**">
                        </div>
                    </div>
                    <div id="pagination-controls" class="flex justify-center items-center space-x-2 mt-6">
                    </div>
                </main>
            </div>
        </div>
        <script>
            // Data menu dari database Laravel
            // Konversi data produk untuk JavaScript
            @php
                // Debug subcategories
                if (isset($subCategories)) {
                    error_log('Subcategories count: ' . $subCategories->count());
                } else {
                    error_log('Subcategories variable is not set');
                }

                $productsForJs = $products
                    ->map(function ($product) {
                        $imgs = [];
                        if ($product->productimgs && $product->productimgs->count() > 0) {
                            foreach ($product->productimgs as $img) {
                                $imgs[] = [
                                    'id' => $img->id,
                                    'image_path' => $img->image_path,
                                    'is_primary' => $img->is_primary,
                                    'full_url' => route('tenant.asset.domain', ['path' => $img->image_path]),
                                ];
                            }
                            // Urutkan agar primary image di index 0
                            usort($imgs, function ($a, $b) {
                                return $b['is_primary'] <=> $a['is_primary'];
                            });
                        }

                        $cat = $product->category;
                        $subcat = $product->subCategory;

                        // Debug category and subcategory
                        if ($cat) {
                            error_log("Product {$product->id} has category: {$cat->name}");
                            if ($subcat) {
                                error_log("Product {$product->id} has subcategory: {$subcat->name}");
                            }
                        }

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
                            'category' => $cat
                                ? [
                                    'id' => $cat->id,
                                    'name' => $cat->name,
                                    'slug' => $cat->slug,
                                ]
                                : null,
                            'sub_category' => $subcat
                                ? [
                                    'id' => $subcat->id,
                                    'name' => $subcat->name,
                                    'slug' => $subcat->slug,
                                    'category_id' => $subcat->category_id,
                                ]
                                : null,
                            'productimgs' => $imgs,
                            'price_idr' => $product->price_idr,
                            'old_price_idr' => $product->old_price_idr,
                            'primary_image_src' => $product->primary_image_src,
                            'is_new' => $product->is_new ?? false,
                            'is_available' => $product->is_available ?? true,
                            'unit' => $product->unit ? ['unit_name' => $product->unit->unit_name] : null,
                        ];
                    })
                    ->values();
            @endphp

            window.productsData = @json($productsForJs);

            // Konversi data untuk format yang dibutuhkan JavaScript
            const processedMenuData = window.productsData.map(product => {
                // Pastikan product dan propertinya ada sebelum diakses
                if (!product) return null;

                // Parse price safely
                let price = 0;
                try {
                    price = parseFloat(product.price);
                    if (isNaN(price)) price = 0;
                } catch (e) {
                    console.error('Error parsing price:', e);
                }

                // Buat objek kategori dan subkategori terlebih dahulu
                const category = product.category || {};
                const subCategory = product.sub_category || {};

                return {
                    id: String(product?.id || ''),
                    name: (product?.name || '').toString(),
                    description: (product?.description || '').toString(),
                    price: price,
                    image: product?.primary_image_src || '{{ asset('assets/images/no-image-icon.png') }}',
                    isNew: Boolean(product?.is_new),
                    isAvailable: product?.is_available !== false,
                    unit: product?.unit?.unit_name || '',
                    // Data kategori dengan null safety
                    category: (category?.name || '').toLowerCase(),
                    categoryId: String(category?.id || ''),
                    categoryName: category?.name || '',
                    categorySlug: category?.slug || '',
                    // Data subkategori dengan null safety
                    subCategoryId: String(subCategory?.id || ''),
                    subCategoryName: subCategory?.name || '',
                    subCategorySlug: subCategory?.slug || '',
                    subCategoryCategoryId: String(subCategory?.category_id || '')
                };
            }).filter(item => item !== null); // Hapus item null jika ada

            let currentCategory = 'all';
            let currentSubcategory = 'all';
            let currentSort = 'newest';
            let currentView = 'list';
            let currentPage = 1;
            let searchTerm = '';
            let productStatus = 'all';
            let productStock = 'all';
            let minPriceRange = 0;
            let maxPriceRange = Infinity; // Menggunakan Infinity sebagai nilai awal untuk mempermudah logika
            const itemsPerPage = 10; // Jumlah item per halaman
            // const minPriceInput = document.getElementById('min-price-input');
            // const maxPriceInput = document.getElementById('max-price-input');
            const applyPriceBtn = document.getElementById('apply-price-btn');
            const resultDisplay = document.getElementById('menu-list');

            function formatRupiah(number) {
                if (isNaN(number) || number === null) return '';
                const formatted = new Intl.NumberFormat('id-ID').format(number);
                return formatted;
            }

            // minPriceInput.addEventListener('input', (e) => {
            //     // Hapus semua karakter non-digit kecuali yang pertama jika itu adalah '-'
            //     let value = e.target.value.replace(/[^\d]/g, '');
            //     e.target.value = formatRupiah(value);
            // });

            // maxPriceInput.addEventListener('input', (e) => {
            //     let value = e.target.value.replace(/[^\d]/g, '');
            //     e.target.value = formatRupiah(value);
            // });

            // Fungsi untuk membuat dan merender tombol pagination
            function renderPagination(totalItems) {
                const paginationControls = document.getElementById('pagination-controls');
                if (!paginationControls) return;

                paginationControls.innerHTML = '';
                const totalPages = Math.ceil(totalItems / itemsPerPage);

                if (totalPages <= 1) {
                    return; // Tidak perlu pagination jika hanya ada satu halaman
                }

                // Tombol Sebelumnya (<)
                const prevButton = document.createElement('button');
                prevButton.innerHTML = '&lt;';
                prevButton.className =
                    `w-8 h-8 flex items-center justify-center rounded-md text-sm transition ${currentPage === 1 ? 'text-gray-400 cursor-not-allowed border border-gray-200' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`;
                prevButton.disabled = currentPage === 1;
                prevButton.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        sortAndRender();
                    }
                });
                paginationControls.appendChild(prevButton);

                // Tombol nomor halaman dan elipsis
                const startPage = Math.max(1, currentPage - 1);
                const endPage = Math.min(totalPages, currentPage + 1);

                if (startPage > 1) {
                    // Tombol halaman 1
                    const pageButton1 = document.createElement('button');
                    pageButton1.innerText = '1';
                    pageButton1.className =
                        `w-8 h-8 flex items-center justify-center rounded-md text-sm transition ${1 === currentPage ? 'bg-[#994d51] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`;
                    pageButton1.addEventListener('click', () => {
                        currentPage = 1;
                        sortAndRender();
                    });
                    paginationControls.appendChild(pageButton1);

                    if (startPage > 2) {
                        // Elipsis pertama
                        const ellipsis1 = document.createElement('span');
                        ellipsis1.innerText = '...';
                        ellipsis1.className = 'text-gray-500 mx-1';
                        paginationControls.appendChild(ellipsis1);
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.innerText = i;
                    pageButton.className =
                        `w-8 h-8 flex items-center justify-center rounded-md text-sm transition ${i === currentPage ? 'bg-[#994d51] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        sortAndRender();
                    });
                    paginationControls.appendChild(pageButton);
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        // Elipsis kedua
                        const ellipsis2 = document.createElement('span');
                        ellipsis2.innerText = '...';
                        ellipsis2.className = 'text-gray-500 mx-1';
                        paginationControls.appendChild(ellipsis2);
                    }
                    // Tombol halaman terakhir
                    const lastPageButton = document.createElement('button');
                    lastPageButton.innerText = totalPages;
                    lastPageButton.className =
                        `w-8 h-8 flex items-center justify-center rounded-md text-sm transition ${totalPages === currentPage ? 'bg-[#994d51] text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`;
                    lastPageButton.addEventListener('click', () => {
                        currentPage = totalPages;
                        sortAndRender();
                    });
                    paginationControls.appendChild(lastPageButton);
                }

                // Tombol Selanjutnya (>)
                const nextButton = document.createElement('button');
                nextButton.innerHTML = '&gt;';
                nextButton.className =
                    `w-8 h-8 flex items-center justify-center rounded-md text-sm transition ${currentPage === totalPages ? 'text-gray-400 cursor-not-allowed border border-gray-200' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`;
                nextButton.disabled = currentPage === totalPages;
                nextButton.addEventListener('click', () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        sortAndRender();
                    }
                });
                paginationControls.appendChild(nextButton);
            }

            // Fungsi untuk merender menu
            function renderMenu(items) {
                const menuList = document.getElementById('menu-list');
                if (!menuList) {
                    console.error("Elemen dengan id 'menu-list' tidak ditemukan.");
                    return;
                }

                menuList.innerHTML = '';

                // Handle view type safely
                const isList = currentView === 'list';
                menuList.classList.remove(...['grid', 'grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-5', 'gap-4', 'space-y-6']);
                menuList.classList.add(...(isList ? ['space-y-6'] : ['grid', 'grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-5',
                    'gap-4'
                ]));

                // Ensure items is an array and filter out any null/undefined items
                const validItems = (Array.isArray(items) ? items : [])
                    .filter(item => item && typeof item === 'object');

                validItems.forEach(item => {
                    // Safely access item properties with defaults
                    const safeItem = {
                        id: String(item?.id || ''),
                        name: String(item?.name || ''),
                        description: String(item?.description || ''),
                        price: parseFloat(item?.price) || 0,
                        image: item?.image || '{{ asset('assets/images/no-image-icon.png') }}',
                        isAvailable: Boolean(item?.isAvailable)
                    };

                    // Format price safely
                    const formattedPrice = (() => {
                        try {
                            const price = parseFloat(safeItem.price);
                            if (isNaN(price)) return '0';
                            return price.toLocaleString('id-ID');
                        } catch (e) {
                            console.error('Error formatting price:', e);
                            return '0';
                        }
                    })();

                    // Create stock status overlay if needed
                    const stockOverlay = !safeItem.isAvailable ?
                        '<div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-lg text-sm">Stok Habis</div>' :
                        '';

                    let itemHTML = isList ?
                        `
<div class="relative flex justify-between items-start border-b border-gray-200 pb-6 transition duration-200 ease-in-out hover:shadow-md hover:bg-gray-50">
    <div class="flex-grow space-y-2">
        <h3 class="font-semibold text-lg">${safeItem.name}</h3>
        <p class="text-xs text-gray-600">${safeItem.description}</p>
        <p class="text-base font-bold text-[#994d51]">Rp${formattedPrice}</p>
        <button class="detail-btn mt-2 bg-[#994d51] hover:bg-[#7a3c3f] text-white font-semibold px-4 py-1 text-sm rounded-full shadow transition duration-200" data-product-id="${safeItem.id}">Detail</button>
    </div>
    <div class="relative w-40 h-50 rounded-lg ml-6 overflow-hidden">
        <div class="relative w-full pb-[125%]">
            <img src="${safeItem.image}" alt="${safeItem.name}" class="absolute inset-0 w-full h-full object-cover rounded-lg ${!safeItem.isAvailable ? 'opacity-50' : ''}" />
            ${stockOverlay}
        </div>
    </div>
</div>` :
                        `
<div class="relative flex flex-col items-center border border-gray-200 rounded-lg p-4 text-center transition duration-200 ease-in-out hover:scale-105 hover:shadow-md">
    <div class="relative w-full overflow-hidden rounded-lg mb-2">
        <div class="relative w-full pb-[125%]">
            <img src="${safeItem.image}" alt="${safeItem.name}" class="absolute inset-0 w-full h-full object-cover rounded-lg ${!safeItem.isAvailable ? 'opacity-50' : ''}" />
            ${stockOverlay}
        </div>
    </div>
    <h3 class="font-semibold text-sm">${safeItem.name}</h3>
    <p class="text-xs font-bold text-[#994d51]">Rp${formattedPrice}</p>
    <button class="detail-btn mt-2 bg-[#994d51] hover:bg-[#7a3c3f] text-white font-semibold px-2 py-1 text-xs rounded-full shadow transition duration-200" data-product-id="${safeItem.id}">Detail</button>
</div>`;

                    menuList.insertAdjacentHTML('beforeend', itemHTML);
                });

                addModalEventListeners();
            }

            // Fungsi utama untuk mengurutkan, memfilter, dan merender ulang
            function sortAndRender() {
                try {
                    // Ensure we have a valid array to work with
                    let itemsToRender = Array.isArray(processedMenuData) ? [...processedMenuData] : [];

                    // 1. Filter based on category and/or subcategory with null safety
                    itemsToRender = itemsToRender.filter(item => {
                        if (!item) return false;

                        // Normalize values for safe comparison
                        const itemCategorySlug = (item.categorySlug || '').toString().trim().toLowerCase();
                        const itemSubCategoryName = (item.subCategoryName || '').toString().trim().toLowerCase();
                        const activeCategory = (currentCategory || 'all').toString().trim().toLowerCase();
                        const activeSubcategory = (currentSubcategory || 'all').toString().trim().toLowerCase();

                        // If a category filter is active, require category match
                        if (activeCategory !== 'all' && itemCategorySlug !== activeCategory) return false;

                        // If a subcategory filter is active, require subcategory match
                        if (activeSubcategory !== 'all' && itemSubCategoryName !== activeSubcategory) return false;

                        return true;
                    });

                    // 2. Filter based on search term with null safety
                    if (searchTerm) {
                        const searchLower = searchTerm.toLowerCase();
                        itemsToRender = itemsToRender.filter(item =>
                            item && typeof item.name === 'string' &&
                            item.name.toLowerCase().includes(searchLower)
                        );
                    }

                    // 3. Filter based on product status
                    if (productStatus === 'new') {
                        itemsToRender = itemsToRender.filter(item => Boolean(item?.isNew));
                    } else if (productStatus === 'old') {
                        itemsToRender = itemsToRender.filter(item => !item?.isNew);
                    }

                    // 4. Filter based on stock availability
                    if (productStock === 'available') {
                        itemsToRender = itemsToRender.filter(item => Boolean(item?.isAvailable));
                    } else if (productStock === 'unavailable') {
                        itemsToRender = itemsToRender.filter(item => !item?.isAvailable);
                    }

                    // 5. Filter based on price range with null safety
                    itemsToRender = itemsToRender.filter(item => {
                        const price = typeof item?.price === 'number' ? item.price : 0;
                        return price >= minPriceRange && price <= maxPriceRange;
                    });

                    // 6. Sort items with null safety
                    let sortedItems = [...itemsToRender];
                    sortedItems.sort((a, b) => {
                        // Handle null/undefined items
                        if (!a || !b) return 0;

                        // Sort by availability
                        if (!a.isAvailable && b.isAvailable) return 1;
                        if (a.isAvailable && !b.isAvailable) return -1;

                        // Sort by other criteria
                        switch (currentSort) {
                            case 'cheapest':
                                return (a.price || 0) - (b.price || 0);
                            case 'mostexpensive':
                                return (b.price || 0) - (a.price || 0);
                            case 'newest':
                                return Number(b.isNew || 0) - Number(a.isNew || 0);
                            default:
                                return 0;
                        }
                    });

                    // 7. Handle pagination safely
                    const pageSize = Math.max(1, itemsPerPage);
                    const totalItems = sortedItems.length;
                    const maxPage = Math.ceil(totalItems / pageSize);
                    currentPage = Math.max(1, Math.min(currentPage, maxPage));

                    const startIndex = (currentPage - 1) * pageSize;
                    const endIndex = Math.min(startIndex + pageSize, totalItems);
                    const paginatedItems = sortedItems.slice(startIndex, endIndex);

                    // 8. Render the results
                    renderMenu(paginatedItems);
                    renderPagination(totalItems);

                } catch (error) {
                    console.error('Error in sortAndRender:', error);
                    // Fallback to showing all items without sorting/filtering
                    const fallbackItems = Array.isArray(processedMenuData) ? processedMenuData : [];
                    renderMenu(fallbackItems.slice(0, itemsPerPage));
                    renderPagination(fallbackItems.length);
                }
            }

            function addModalEventListeners() {
                // Fullscreen functionality
                // Ambil semua tombol detail dan modal
                const detailButtons = document.querySelectorAll('.detail-btn');
                const modals = document.querySelectorAll('[id^="product-modal-"]');

                // Event listener for fullscreen button
                document.getElementById('fullscreen-button')?.addEventListener('click', function() {
                    const modalImage = document.getElementById('modal-product-image');
                    if (modalImage) {
                        const imageUrl = modalImage.src;
                        const imageFullscreenModal = document.getElementById('image-fullscreen-modal');
                        const fullscreenImage = document.getElementById('fullscreen-image');

                        fullscreenImage.src = imageUrl;
                        imageFullscreenModal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }
                });

                // Tambahkan event listener untuk tombol detail
                detailButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const productId = button.getAttribute('data-product-id');
                        const modal = document.getElementById('universal-product-modal');

                        // Cari data produk yang sesuai dari array `processedMenuData`
                        const product = processedMenuData.find(item => String(item.id) === productId);

                        if (modal && product) {
                            // Update konten modal dengan data produk
                            document.getElementById('modal-product-image').src = product.image;
                            document.getElementById('modal-product-image').alt = product.name;
                            document.getElementById('modal-product-name').textContent = product.name;
                            document.getElementById('modal-product-description').textContent = product
                                .description || 'Deskripsi produk tidak tersedia.';

                            // --- Bagian yang Diubah (Kategori dan Subkategori) ---

                            // 1. Ambil nilai kategori dan subkategori
                            const categoryText = product.categoryName || '';
                            const subCategoryText = product.subCategoryName || '';

                            let combinedText = '';

                            if (categoryText && subCategoryText) {
                                // Jika keduanya ada, gunakan pemisah |
                                combinedText = categoryText + ' | ' + subCategoryText;
                            } else if (categoryText) {
                                // Hanya kategori yang ada
                                combinedText = categoryText;
                            } else if (subCategoryText) {
                                // Hanya subkategori yang ada
                                combinedText = subCategoryText;
                            }

                            // 2. Tampilkan teks gabungan ke elemen kategori (dan kosongkan subkategori)
                            document.getElementById('modal-product-category').textContent = combinedText;
                            document.getElementById('modal-product-subcategory').textContent =
                                ''; // Kosongkan elemen subcategory

                            // --- Akhir Bagian yang Diubah ---

                            // Price and unit
                            document.getElementById('modal-product-price').textContent = formatRupiah(product
                                .price) + (product.unit ? ' / ' + product.unit : '');
                            document.getElementById('modal-product-unit').textContent = product.unit_name;

                            // Atur visibilitas overlay stok
                            const stockOverlay = document.getElementById('modal-stock-overlay');
                            const modalImage = document.getElementById('modal-product-image');

                            if (!product.isAvailable) {
                                modalImage.classList.add('opacity-50');
                                if (stockOverlay) {
                                    stockOverlay.classList.remove('hidden');
                                }
                            } else {
                                modalImage.classList.remove('opacity-50');
                                if (stockOverlay) {
                                    stockOverlay.classList.add('hidden');
                                }
                            }

                            modal.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        }
                    });
                });

                // Tambahkan event listener untuk tombol tutup modal universal
                const modal = document.getElementById('universal-product-modal');
                const closeModalButton = modal.querySelector('.close-modal');

                if (closeModalButton) {
                    closeModalButton.addEventListener('click', () => {
                        modal.classList.add('hidden');
                        document.body.style.overflow = '';
                    });
                }

                // Menutup modal jika area di luar modal diklik
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });
            }

            // Tambahkan event listener untuk semua kontrol baru
            document.addEventListener('DOMContentLoaded', () => {
                sortAndRender();
                addModalEventListeners();


                // Delegated event listener untuk tombol 'Pesan Sekarang' — bekerja untuk tombol
                // yang ada sekarang dan tombol yang ditambahkan secara dinamis
                document.addEventListener('click', function(e) {
                    var btn = e.target.closest('.order-btn');
                    if (!btn) return;
                    e.preventDefault();

                    var modal = btn.closest('[id^="product-modal-"]') || document.getElementById(
                        'universal-product-modal');
                    if (!modal) return;

                    var productNameEl = modal.querySelector('#modal-product-name') || modal.querySelector('h3');
                    var productName = productNameEl ? productNameEl.innerText.trim() : '';

                    var priceEl = modal.querySelector('#modal-product-price') || modal.querySelector(
                        'span.text-3xl');
                    var priceSpan = priceEl ? priceEl.innerText.trim() : '';

                    var waMessage = encodeURIComponent('Halo, saya ingin memesan produk: ' + productName + (
                        priceSpan ? ' dengan harga ' + priceSpan : '') + '.');
                    var waNumber = {!! json_encode($userStore->whatsapp ?? ($userStore->store_phone ?? '6281572505989')) !!};
                    var waUrl = 'https://wa.me/' + waNumber + '?text=' + waMessage;
                    window.open(waUrl, '_blank');
                });

                // Event listener untuk sort dropdown
                const sortMenuBtn = document.getElementById('sort-menu-btn');
                const sortOptions = document.getElementById('sort-options');
                const sortLabel = document.getElementById('sort-label');
                if (sortMenuBtn) {
                    sortMenuBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        sortOptions.classList.toggle('hidden');
                    });
                }
                if (sortOptions) {
                    sortOptions.addEventListener('click', (e) => {
                        if (e.target.classList.contains('sort-option')) {
                            e.preventDefault();
                            currentSort = e.target.dataset.sortBy;
                            sortLabel.innerText = e.target.innerText;
                            currentPage = 1;
                            sortAndRender();
                            sortOptions.classList.add('hidden');
                        }
                    });
                }

                // Event listener untuk kategori dropdown
                const filterCategoryBtn = document.getElementById('filter-category-btn');
                const categoryOptions = document.getElementById('category-options');
                const categoryLabel = document.getElementById('category-label');
                const filterSubcategoryBtn = document.getElementById('filter-subcategory-btn');
                const subcategoryOptions = document.getElementById('subcategory-options');
                const subcategoryLabel = document.getElementById('subcategory-label');

                if (filterCategoryBtn) {
                    filterCategoryBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        categoryOptions.classList.toggle('hidden');
                    });
                }

                // Toggle subcategory dropdown
                if (filterSubcategoryBtn) {
                    filterSubcategoryBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        subcategoryOptions.classList.toggle('hidden');
                    });
                }

                if (categoryOptions) {
                    categoryOptions.addEventListener('click', (e) => {
                        const target = e.target;
                        if (target && target.classList.contains('category-option')) {
                            e.preventDefault();
                            const selectedCategory = target.dataset.category || 'all';
                            const matchingProduct = processedMenuData.find(item =>
                                item && item.categorySlug === selectedCategory);
                            const selectedCategoryId = matchingProduct ? matchingProduct.categoryId : '';

                            currentCategory = selectedCategory;
                            if (categoryLabel) {
                                categoryLabel.innerText = target.innerText || 'Pilih Kategori';
                            }

                            // Reset subcategory when category changes
                            currentSubcategory = 'all';
                            if (subcategoryLabel) {
                                subcategoryLabel.innerText = 'Pilih Subkategori';
                            }

                            // Filter subcategories based on selected category
                            const subcategoryItems = document.querySelectorAll('.subcategory-option');
                            subcategoryItems.forEach(option => {
                                if (!option) return;

                                const isAllOption = option.dataset.subcategory === 'all';
                                const categoryId = option.dataset.categoryId;

                                option.style.display = isAllOption || (categoryId ===
                                        selectedCategoryId) ?
                                    'block' :
                                    'none';
                            });

                            currentPage = 1;
                            sortAndRender();
                            categoryOptions.classList.add('hidden');
                        }
                    });
                }

                // Event listener for subcategory selection
                if (subcategoryOptions) {
                    subcategoryOptions.addEventListener('click', (e) => {
                        if (e.target.classList.contains('subcategory-option')) {
                            e.preventDefault();
                            // Normalize selected subcategory for consistent comparisons
                            const rawSub = e.target.dataset.subcategory || '';
                            currentSubcategory = rawSub.toString().trim().toLowerCase();
                            // Keep label as visible text
                            subcategoryLabel.innerText = e.target.innerText;
                            currentPage = 1;
                            sortAndRender();
                            subcategoryOptions.classList.add('hidden');
                        }
                    });
                }

                // Event listener untuk view toggle
                const viewGridBtn = document.getElementById('view-grid');
                const viewListBtn = document.getElementById('view-list');
                if (viewGridBtn) {
                    viewGridBtn.addEventListener('click', () => {
                        currentView = 'grid';
                        sortAndRender();
                    });
                }
                if (viewListBtn) {
                    viewListBtn.addEventListener('click', () => {
                        currentView = 'list';
                        sortAndRender();
                    });
                }

                // Close dropdowns when clicking outside
                window.addEventListener('click', () => {
                    if (sortOptions) sortOptions.classList.add('hidden');
                    if (categoryOptions) categoryOptions.classList.add('hidden');
                });

                // Listener untuk Search Produk
                const searchInput = document.getElementById('search-product');
                if (searchInput) {
                    searchInput.addEventListener('input', (e) => {
                        searchTerm = e.target.value;
                        currentPage = 1;
                        sortAndRender();
                    });
                }

                // Listener untuk Status Produk
                const statusRadios = document.querySelectorAll('input[name="product-status"]');
                statusRadios.forEach(radio => {
                    radio.addEventListener('change', (e) => {
                        productStatus = e.target.id.replace('status-', '');
                        currentPage = 1;
                        sortAndRender();
                    });
                });

                // Listener untuk Ketersediaan Stok
                const stockRadios = document.querySelectorAll('input[name="product-stock"]');
                stockRadios.forEach(radio => {
                    radio.addEventListener('change', (e) => {
                        productStock = e.target.id.replace('stock-', '');
                        currentPage = 1;
                        sortAndRender();
                    });
                });

                // Listener untuk Saring Harga (Slider)
                // const priceRangeInput = document.getElementById('price-range');
                // const priceValueSpan = document.getElementById('price-value');
                // if (priceRangeInput) {
                //     priceRangeInput.addEventListener('input', (e) => {
                //         maxPrice = parseInt(e.target.value);
                //         priceValueSpan.innerText = `Rp${maxPrice.toLocaleString('id-ID')}`;
                //         currentPage = 1;
                //         sortAndRender();
                //     });
                // }

                // ** Tambahan Skrip untuk Dropdown Rentang Harga **
                const priceRangeDropdown = document.getElementById('price-range-dropdown');
                const minPriceFilterInput = document.getElementById('min-price-filter');
                const maxPriceFilterInput = document.getElementById('max-price-filter');
                if (priceRangeDropdown) {
                    priceRangeDropdown.addEventListener('change', (e) => {
                        const selectedOption = e.target.options[e.target.selectedIndex];
                        const min = selectedOption.dataset.min;
                        const max = selectedOption.dataset.max;

                        minPriceRange = min ? parseInt(min) : 0;
                        maxPriceRange = max ? parseInt(max) : Infinity;

                        minPriceFilterInput.value = minPriceRange;
                        maxPriceFilterInput.value = maxPriceRange === Infinity ? '' : maxPriceRange;

                        currentPage = 1;
                        sortAndRender();
                    });
                }

                const resetButton = document.getElementById('reset-filters');
                if (resetButton) {
                    resetButton.addEventListener('click', () => {
                        // Reset variabel global
                        currentCategory = 'all';
                        currentSubcategory = 'all';
                        currentSort = 'newest';
                        currentView = 'list';
                        currentPage = 1;
                        searchTerm = '';
                        productStatus = 'all';
                        productStock = 'all';

                        // Reset subcategory visibility - show all options
                        const subcategoryItems = document.querySelectorAll('.subcategory-option');
                        subcategoryItems.forEach(option => {
                            if (option) option.style.display = 'block';
                        });

                        // **Penting: Reset kedua variabel harga
                        minPriceRange = 0;
                        maxPriceRange = Infinity;
                        maxPrice = 100000; // Kembalikan ke nilai default slider

                        // Reset elemen DOM
                        const searchInput = document.getElementById('search-product');
                        if (searchInput) searchInput.value = '';

                        const statusRadioAll = document.getElementById('status-all');
                        if (statusRadioAll) statusRadioAll.checked = true;

                        const stockRadioAll = document.getElementById('stock-all');
                        if (stockRadioAll) stockRadioAll.checked = true;

                        const priceRangeSlider = document.getElementById('price-range');
                        const priceValueDisplay = document.getElementById('price-value');
                        if (priceRangeSlider) {
                            priceRangeSlider.value = maxPrice;
                            if (priceValueDisplay) {
                                priceValueDisplay.textContent = `Rp${formatRupiah(maxPrice)}`;
                            }
                        }

                        const priceRangeDropdown = document.getElementById('price-range-dropdown');
                        if (priceRangeDropdown) priceRangeDropdown.value = '';

                        const sortLabel = document.getElementById('sort-label');
                        if (sortLabel) sortLabel.innerText = "Urutkan Menu";

                        const categoryLabel = document.getElementById('category-label');
                        if (categoryLabel) categoryLabel.innerText = "Pilih Kategori";

                        const subCategoryLabel = document.getElementById('subcategory-label');
                        if (subCategoryLabel) subCategoryLabel.innerText = "Pilih Subkategori";

                        const viewListBtn = document.getElementById('view-list');
                        const viewGridBtn = document.getElementById('view-grid');
                        if (viewListBtn && viewGridBtn) {
                            // Logika ini untuk visual, pastikan kelas yang dihapus/ditambahkan benar
                            viewListBtn.classList.add('bg-gray-200');
                            viewListBtn.classList.remove('bg-white', 'border-gray-300', 'hover:bg-gray-50');
                            viewGridBtn.classList.remove('bg-gray-200');
                            viewGridBtn.classList.add('bg-white', 'border', 'border-gray-300',
                                'hover:bg-gray-50');
                        }

                        // Panggil fungsi utama untuk me-render ulang
                        sortAndRender();
                    });
                }

                // Toggle collapsible filter sections
            });
        </script>

        <!-- Modal Dinamis Universal untuk Semua Produk -->
        <div id="universal-product-modal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4 md:p-8 lg:p-12">
            <div class="bg-white rounded-2xl p-6 max-w-2xl w-full mx-auto shadow-2xl relative">
                <button
                    class="close-modal absolute top-4 right-4 text-gray-400 hover:text-gray-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-full md:w-1/2 relative">
                        <div class="relative w-full pb-[125%] overflow-hidden rounded-xl">
                            <img id="modal-product-image" src="" alt=""
                                class="absolute inset-0 w-full h-full object-cover rounded-xl cursor-pointer" />
                            <div id="modal-stock-overlay"
                                class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                                Stok Habis
                            </div>
                            <button id="fullscreen-button"
                                class="absolute top-2 right-2 bg-black bg-opacity-50 p-2 rounded-full text-white hover:bg-opacity-75 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 14H5V8h14v10z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 id="modal-product-name" class="font-bold text-xl md:text-2xl text-[#994d51]"></h3>
                        <div class="mb-1 text-muted">
                            <span id="modal-product-category" class="text-sm text-gray-500 mr-3"></span>
                            <span id="modal-product-subcategory" class="text-sm text-gray-500"></span>
                        </div>
                        <p id="modal-product-description" class="text-sm text-gray-700"></p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span id="modal-product-price" class="text-3xl font-extrabold text-[#994d51]"></span>
                            <span id="modal-product-unit" class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Script Fungsi Tab dan Modal (Disederhanakan & Diperbaiki) -->
        <script>
            // Fungsi untuk menampilkan kategori
            function showCategory(category) {
                // Sembunyikan semua konten
                document.querySelectorAll('[id^="content-"]').forEach(el => {
                    el.classList.add('hidden');
                });
                // Reset semua tab
                document.querySelectorAll('[id^="tab-"]').forEach(tab => {
                    tab.classList.remove('border-[#994d51]', 'text-[#994d51]');
                    tab.classList.add('border-transparent', 'text-gray-500');
                });
                // Tampilkan yang dipilih

            }

            // Inisialisasi saat halaman dimuat


            // Event listener untuk modal sudah ditangani di fungsi addModalEventListeners()

            // Tutup modal
            document.querySelectorAll('.close-modal').forEach(button => {
                button.addEventListener('click', () => {
                    const modal = button.closest('.fixed');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });

            // Tutup modal saat klik luar
            document.querySelectorAll('.fixed').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        </script>
    </main>

    <footer class="bg-[#994d51] text-white py-2">
        <div class="max-w-6xl mx-auto px-4 mt-4">
            <!-- Main Footer Section: Logo, Pages, and Contact -->
            <div class="flex flex-col md:flex-row justify-between items-start space-y-8 md:space-y-0 md:space-x-8">
                <!-- Logo Section -->
                <div class="text-center mb-10">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                    alt="{{ $userStore->store_name ?? 'Kopi Seduh Pagi' }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <h1 class="text-lg font-bold">{{ $userStore->store_name ?? 'Kopi Seduh Pagi' }}</h1>
                        </div>
                    </div>
                </div>

                <!-- Pages Section -->

                <!-- Contact Section -->
                <div class="w-full md:w-1/3 text-left">
                    <h4 class="text-lg font-bold mb-4">Contact</h4>
                    <div class="text-sm text-white-600 space-y-2">
                        <p class="mb-2 leading-relaxed">Jl. Cycas Raya Jl. Taman Setia Budi Indah<br>Blok VV No.172
                            Kompleks, Asam Kumbang,<br>Kec.
                            Medan Selayang, Kota Medan,<br>Sumatera Utara 20133</p>
                        <p class="mb-2 leading-relaxed">
                            <a href="mailto:pteraciptadigital@gmail.com"
                                class="hover:underline">pteraciptadigital@gmail.com</a>
                        </p>
                        <p class="leading-relaxed">08116584545</p>
                        <div class="flex space-x-4 mt-8 text-white">
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.897 3.777-3.897 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM4 9h4v12H4z" />
                                    <circle cx="6" cy="4" r="2" />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path
                                        d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm3.623 6.941c-.443.197-.91.332-1.396.402.51-.306.9-1.294.9-1.294s-.52.26-1.07.457c-.45-.478-1.09-1.265-2.074-1.265-1.57 0-2.842 1.272-2.842 2.843 0 .223.02.445.06.666-2.36-.118-4.453-1.258-5.856-3.085-.246.425-.386.915-.386 1.454 0 .984.5 1.84 1.256 2.348-.466-.015-.905-.147-1.288-.358v.03c0 1.378.98 2.52 2.27 2.78-.236.064-.486.098-.74.098-.182 0-.36-.018-.535-.052.36.98 1.408 1.696 2.65 1.716-1.01.79-2.274 1.258-3.652 1.258-.236 0-.47-.014-.7-.04v.02c1.396.88 3.03 1.396 4.796 1.396 5.757 0 8.9-4.767 8.9-8.9 0-.135-.002-.27-.006-.406.61-.43 1.134-.962 1.55-1.56z" />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path
                                        d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm5.728 8.01c-.134-1.21-.524-2.138-1.12-2.732C15.932 5.86 15.013 5.56 13.805 5.426 13.25 5.38 12.632 5.358 12 5.358c-.632 0-1.25.022-1.805.068-1.208.134-2.128.434-2.732 1.028-.596.594-.986 1.522-1.12 2.732-.046.41-.068.868-.068 1.39 0 .522.022.98.068 1.39 0 1.21.39 2.138 1.12 2.732.594.594 1.514.894 2.732 1.028.555.046 1.173.068 1.805.068 1.21-.134 2.138-.434 2.732-1.028.594-.594.984-1.522 1.12-2.732.046-.41.068-.868.068-1.39 0-.522-.022-.98-.068-1.39zM10.824 14.34V9.66L14.4 12l-3.576 2.34z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="mt-8 p-4 border-t border-gray-200 text-center text-sm text-white-600">
                <p>&copy; 2025 PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('.content-section');

            const showSection = (sectionId) => {
                sections.forEach(section => {
                    section.classList.remove('active-section');
                });
                const targetSection = document.querySelector(sectionId);
                if (targetSection) {
                    targetSection.classList.add('active-section');
                }
            };

            const setActiveLink = (linkId) => {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                });
                const targetLink = document.querySelector(`a[href="${linkId}"]`);
                if (targetLink) {
                    targetLink.classList.add('active');
                }
            };

            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = e.target.getAttribute('href');
                    showSection(targetId);
                    setActiveLink(targetId);
                });
            });

            const defaultSection = window.location.hash || '#dashboard';
            showSection(defaultSection);
            setActiveLink(defaultSection);
        });
    </script>

    <script>
        // Kode JavaScript untuk toggle mobile menu
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const carousel = document.getElementById('image-carousel');
            const totalSlides = carousel.children.length;
            let currentIndex = 0;

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    if (mobileMenu.classList.contains('-translate-y-full')) {
                        mobileMenu.classList.remove('hidden', '-translate-y-full');
                        mobileMenu.classList.add('translate-y-0');
                    } else {
                        mobileMenu.classList.remove('translate-y-0');
                        mobileMenu.classList.add('-translate-y-full');
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                        }, 300); // Sesuaikan dengan durasi transisi
                    }
                });

                // Menutup menu jika salah satu link diklik
                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.remove('translate-y-0');
                        mobileMenu.classList.add('-translate-y-full');
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                        }, 300);
                    });
                });
            }

            setInterval(() => {
                currentIndex = (currentIndex + 1) % totalSlides;
                const offset = -currentIndex * 100;
                carousel.style.transform = `translateX(${offset}%)`;
            }, 3000); // 1000 milidetik = 1 detik
        });
    </script>

    <script>
        const header = document.querySelector('header');
        const scrollThreshold = 100; // Jarak gulir (dalam piksel) sebelum animasi dimulai

        window.addEventListener('scroll', () => {
            if (window.scrollY > scrollThreshold) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>

    <button id="scrollToTopBtn"
        class="fixed bottom-8 left-10 z-50 w-12 h-12 rounded-full bg-[#994d51] bg-opacity-100 shadow-lg flex items-center justify-center transition-opacity opacity-20 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M8 14l4-4 4 4" />
        </svg>
    </button>

    <script>
        // Tombol scroll to top
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.add('opacity-100');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.remove('opacity-100');
            }
        });
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    <!-- Fullscreen Image Modal -->
    <div id="image-fullscreen-modal"
        class="fixed inset-0 z-[60] hidden bg-black bg-opacity-90 flex items-center justify-center p-4">
        <div class="relative max-w-full max-h-full">
            <button class="absolute top-4 right-4 text-white hover:text-gray-300 z-50"
                onclick="closeFullscreenImage()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <img id="fullscreen-image" src="" alt=""
                class="max-h-[90vh] max-w-[90vw] object-contain" />
        </div>
    </div>

    <script>
        function closeFullscreenImage() {
            const modal = document.getElementById('image-fullscreen-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close fullscreen image modal when clicking outside the image
        document.getElementById('image-fullscreen-modal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeFullscreenImage();
            }
        });

        // Close fullscreen image modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('image-fullscreen-modal').classList.contains(
                    'hidden')) {
                closeFullscreenImage();
            }
        });
    </script>
</body>

</html>
