<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
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

    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                @if ($userStore->store_logo)
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="{{ $userStore->store_name }}"
                        class="rounded-full w-16 h-16 object-cover">
                @else
                    <div class="w-16 h-16 bg-teal-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-2xl">{{ substr($userStore->store_name, 0, 1) }}</span>
                    </div>
                @endif
                <h1 class="text-2xl font-bold text-teal-600">{{ $userStore->store_name }}</h1>
            </div>

            <div class="w-full md:w-auto">
                <div class="relative flex items-center border border-gray-300 rounded-full overflow-hidden">
                    <input type="text" id="searchInput" placeholder="Cari produk..."
                        class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <button id="searchButton"
                        class="bg-teal-500 text-white px-6 py-2 hover:bg-teal-600 transition-all duration-300">Cari</button>
                </div>
            </div>
        </div>
    </header>

    <section class="relative text-white text-center py-5 overflow-hidden">
        {{-- Spacer agar section punya tinggi yang pas --}}
        <div aria-hidden="true" class="h-60"></div>

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
                        'subtitle' => 'sub 2',
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
                    $imgSrc = $isObj ? route('tenant.asset', ['path' => $bn->image_url]) : $bn['image_url'];
                    $title = $isObj ? $bn->title ?? 'Banner' : $bn['title'];
                    $subtitle = $isObj ? $bn->subtitle ?? '' : $bn['subtitle'];
                @endphp

                <div
                    class="slide absolute inset-0 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-1000">
                    <img src="{{ $imgSrc }}" alt="{{ $title }}"
                        class="w-full h-full object-cover brightness-75 absolute inset-0">
                    <div class="absolute inset-0 bg-teal-800 opacity-50"></div>

                    <div class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center">
                        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">{{ $title }}</h1>
                        <p class="text-lg md:text-xl font-light mb-6">{{ $subtitle }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="relative z-10 container mx-auto px-4">
            <div class="flex justify-center space-x-3">
                @for ($i = 0; $i < $slides->count(); $i++)
                    <span
                        class="dot w-3 h-3 rounded-full bg-white {{ $i === 0 ? 'opacity-100' : 'opacity-50' }} transition-all duration-500"></span>
                @endfor
            </div>
        </div>
    </section>


    <div class="my-8 container mx-auto px-4 filter-section rounded-xl shadow-md p-6">
        <div class="flex flex-wrap gap-2 md:gap-4 justify-center" id="category-filter-container">
            <button
                class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                       bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                       hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                data-category="all">
                Semua
            </button>
            @foreach ($categories as $category)
                <button
                    class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                       bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                       hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                    data-category="{{ strtolower($category->name) }}">
                    </i> {{ $category->name }}
                </button>
            @endforeach
            <button
                class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                       bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                       hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                data-category="accessory">
                Lainnya
            </button>
        </div>
        <div class="flex flex-col md:flex-row gap-4 mt-6 justify-center items-center">
            <div class="relative w-full md:w-auto">
                <select id="sortDropdown"
                    class="block appearance-none w-full bg-white border border-teal-500 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-teal-500">
                    <option value="baru">Urutkan: Terbaru</option>
                    <option value="lama">Urutkan: Terlama</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

            <div class="relative w-full md:w-auto">
                <select id="priceDropdown"
                    class="block appearance-none w-full bg-white border border-teal-500 text-gray-700 py-2 px-4 pr-8 rounded-full leading-tight focus:outline-none focus:bg-white focus:border-teal-500">
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
        </div>
    </div>

    <section class="products-section pb-16">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-center mb-8">Produk Unggulan</h2>
            <div class="products-grid grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"
                id="productsGrid">

                @forelse ($products as $product)
                    @php $src = $product->primary_image_src; @endphp
                    <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                        data-category="{{ strtolower($product->category->name ?? 'general') }}"
                        data-name="{{ strtolower($product->name) }}" data-price="{{ $product->price }}"
                        data-created-at="{{ $product->created_at }}">
                        <div class="aspect-w-1 aspect-h-1 w-full">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ $src }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain p-2">
                            @else
                                <img src="{{ asset('assets/images/no-image-icon.png') }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain p-2">
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
                                {{ $product->name }}
                            </h3>
                            <div class="text-center mt-auto">
                                <span class="text-red-600 font-bold text-lg product-price">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if ($product->original_price && $product->original_price > $product->price)
                                    <br><span class="text-gray-400 line-through text-sm">Rp
                                        {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4 pt-0">
                            <button
                                class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                                data-modal-title="{{ $product->name }}"
                                data-modal-content='
                        <div class="text-center mb-4">
                            @if ($product->images->isNotEmpty())
<img src="{{ $src }}" alt="{{ $product->name }}" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
@else
<img src="{{ asset('assets/images/no-image-icon.png') }}" alt="{{ $product->name }}" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
@endif
                        </div>
                        <p class="text-gray-700 mb-2">{{ $product->description ?? 'Produk berkualitas tinggi dengan harga terjangkau.' }}</p>
                        <div class="text-center mt-2">
                            <span class="text-teal-500 font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if ($product->original_price && $product->original_price > $product->price)
<br><span class="text-gray-400 line-through mr-2">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
@endif
                        </div>
                        <div class="text-center mt-3">
                            <a href="https://wa.me/{{ $userStore->whatsapp ?? '6282392184679' }}?text=Halo%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}" target="_blank"
                                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                        </div>
                        '>Detail</button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-400 text-6xl mb-4">📦</div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Produk</h3>
                        <p class="text-gray-500">Produk akan segera ditambahkan. Silakan kembali lagi nanti!</p>
                    </div>
                @endforelse

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
                        <img src="{{ Storage::url($userStore->store_logo) }}" alt="{{ $userStore->store_name }}"
                            class="w-10 h-10 rounded-full mr-3">
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
            // Slider Hero
            let currentIndex = 0;
            const slides = document.querySelectorAll("#hero-slider .slide");
            const dots = document.querySelectorAll(".dot");

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-teal-500', i === index);
                    dot.classList.toggle('bg-white', i !== index);
                    dot.classList.toggle('opacity-100', i === index);
                    dot.classList.toggle('opacity-50', i !== index);
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % slides.length;
                showSlide(currentIndex);
            }
            showSlide(currentIndex);
            setInterval(nextSlide, 3000);

            // Filter & Sort Produk
            const productsGrid = document.getElementById('productsGrid');
            const allProducts = Array.from(productsGrid.querySelectorAll('.product-card'));

            // Global filter state
            let currentCategory = 'all';
            let currentSort = 'baru';
            let currentPriceMin = 0;
            let currentPriceMax = Infinity; // Use Infinity for no upper limit
            let currentSearchTerm = '';

            function applyFilters() {
                let filteredProducts = allProducts.slice(); // Start with a fresh copy

                // 1. Apply Search Filter
                if (currentSearchTerm) {
                    filteredProducts = filteredProducts.filter(product => {
                        const productName = product.dataset.name.toLowerCase();
                        return productName.includes(currentSearchTerm);
                    });
                }

                // 2. Apply Category Filter
                if (currentCategory !== 'all') {
                    filteredProducts = filteredProducts.filter(product => {
                        const productCategory = product.dataset.category;
                        return productCategory === currentCategory;
                    });
                }

                // 3. Apply Price Filter
                if (currentPriceMin !== 0 || currentPriceMax !== Infinity) {
                    filteredProducts = filteredProducts.filter(product => {
                        const price = parseInt(product.dataset.price);
                        return price >= currentPriceMin && price <= currentPriceMax;
                    });
                }

                // 4. Apply Sorting
                if (currentSort === 'lama') {
                    filteredProducts.sort((a, b) => new Date(a.dataset.createdAt) - new Date(b.dataset.createdAt));
                } else if (currentSort === 'baru') {
                    filteredProducts.sort((a, b) => new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt));
                }

                // 5. Render Products
                productsGrid.innerHTML = ''; // Clear current products

                if (filteredProducts.length > 0) {
                    filteredProducts.forEach(product => productsGrid.appendChild(product));
                } else {
                    // Display "Belum Ada Produk" message
                    productsGrid.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">📦</div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Produk</h3>
                            <p class="text-gray-500">Tidak ada produk yang cocok dengan filter Anda.</p>
                        </div>
                    `;
                }
            }

            // Universal Modal
            function setupUniversalModal() {
                document.querySelectorAll('.show-modal').forEach(el => {
                    el.addEventListener('click', function() {
                        const modal = document.getElementById('universalModal');
                        const modalTitle = document.getElementById('universalModalTitle');
                        const modalContent = document.getElementById('universalModalContent');
                        modalTitle.textContent = this.getAttribute('data-modal-title');
                        modalContent.innerHTML = this.getAttribute('data-modal-content');
                        modal.classList.remove('hidden');
                    });
                });
                document.getElementById('closeUniversalModal').addEventListener('click', function() {
                    document.getElementById('universalModal').classList.add('hidden');
                });
                document.getElementById('universalModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            }
            setupUniversalModal();

            // Event Listeners
            const categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-teal-500', 'text-white');
                        btn.classList.add('bg-white',
                            'text-gray-700'
                        ); // Ensure non-active buttons revert to default style
                    });
                    this.classList.add('active', 'bg-teal-500', 'text-white');
                    this.classList.remove('bg-white',
                        'text-gray-700'); // Remove default style from active button

                    currentCategory = this.getAttribute('data-category');
                    applyFilters();
                });
            });

            document.getElementById('sortDropdown').addEventListener('change', function() {
                currentSort = this.value;
                applyFilters();
            });

            document.getElementById('priceDropdown').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (this.value === 'all') {
                    currentPriceMin = 0;
                    currentPriceMax = Infinity;
                } else {
                    currentPriceMin = parseInt(selectedOption.dataset.min);
                    currentPriceMax = selectedOption.dataset.max ? parseInt(selectedOption.dataset.max) :
                        Infinity;
                }
                applyFilters();
            });

            document.getElementById('searchButton').addEventListener('click', function() {
                currentSearchTerm = document.getElementById('searchInput').value.toLowerCase();
                applyFilters();
            });
            document.getElementById('searchInput').addEventListener('keyup', function() {
                currentSearchTerm = this.value.toLowerCase();
                applyFilters();
            });

            // Initial filter application
            const allButton = document.querySelector('.category-btn[data-category="all"]');
            if (allButton) {
                allButton.click(); // Simulate click to activate "Semua" and apply initial filters
            } else {
                applyFilters(); // If "Semua" button is not found, just apply filters
            }
        });
    </script>
</body>

</html>
