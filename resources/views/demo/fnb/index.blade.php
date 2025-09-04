<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Kopi Seduh Pagi</title>

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
                <!-- Logo -->
                <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                    <img src="{{ asset('assets/demo/fnb/images/capuccino.jpg') }}" alt="Kopi Seduh Pagi"
                        class="w-full h-full object-cover">
                </div>
                <h1 class="text-lg font-bold">Kopi Seduh Pagi</h1>
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

    <div
        class="relative overflow-hidden rounded-none shadow-lg bg-[#2a1a1a] w-screen left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] max-w-none h-96 top-0 z-40">
        <div id="image-carousel" class="absolute inset-0 flex transition-transform duration-1000 ease-in-out">
            <div class="w-screen flex-shrink-0 relative">
                <img src="{{ asset('assets/demo/fnb/images/background4.jpg') }}" alt="Promo Spesial"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center text-center p-12">
                    <div class="relative z-10">
                        <h3 class="text-4xl font-bold text-white drop-shadow-lg">Promo Kopi Spesial</h3>
                        <p class="text-lg text-gray-200 mt-2 drop-shadow-lg">Dapatkan diskon 20% untuk semua varian kopi
                            pilihan.</p>
                    </div>
                </div>
            </div>
            <div class="w-screen flex-shrink-0 relative">
                <img src="{{ asset('assets/demo/fnb/images/background5.jpg') }}" alt="Produk Terbaru"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center text-center p-12">
                    <div class="relative z-10">
                        <h3 class="text-4xl font-bold text-white drop-shadow-lg">Kopi Arabika Gayo</h3>
                        <p class="text-lg text-gray-200 mt-2 drop-shadow-lg">Nikmati sensasi rasa baru dari biji kopi
                            Gayo premium.</p>
                    </div>
                </div>
            </div>
            <div class="w-screen flex-shrink-0 relative">
                <img src="{{ asset('assets/demo/fnb/images/background6.jpg') }}" alt="Event Mendatang"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center text-center p-12">
                    <div class="relative z-10">
                        <h3 class="text-4xl font-bold text-white drop-shadow-lg">Workshop Meracik Kopi</h3>
                        <p class="text-lg text-gray-200 mt-2 drop-shadow-lg">Ikuti workshop kami dan jadi barista
                            handal!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="w-full mx-auto py-8 px-4 space-y-10 pt-5">
        <section class="py-1 px-4">
            <h2 class="text-center text-2xl font-bold mb-8">CATEGORY MENU</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-7xl mx-auto">

                <!-- Card -->
                <div class="card-category">
                    <img src="{{ asset('assets/demo/fnb/images/capuccino.jpg') }}" alt="Minuman"
                        class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="card-title">Minuman</h3>
                        <p class="card-description">Dari minuman tradisional...</p>
                    </div>
                </div>

                <div class="card-category">
                    <img src="{{ asset('assets/demo/fnb/images/nasigoreng.jpg') }}" alt="Makanan"
                        class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="card-title">Makanan</h3>
                        <p class="card-description">Berbagai macam hidangan...</p>
                    </div>
                </div>

                <div class="card-category">
                    <img src="{{ asset('assets/demo/fnb/images/kentanggoreng.jpg') }}" alt="Cemilan"
                        class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="card-title">Cemilan</h3>
                        <p class="card-description">Teman akrab buat ngopi...</p>
                    </div>
                </div>

                <div class="card-category">
                    <img src="{{ asset('assets/demo/fnb/images/brownies.jpg') }}" alt="Dessert"
                        class="w-full h-40 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="card-title">Dessert</h3>
                        <p class="card-description">Sajian manis yang...</p>
                    </div>
                </div>
            </div>
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

                <!-- <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <label class="block text-sm font-bold text-gray-800 mb-3 uppercase tracking-wide">Status Menu<Menu>
                        </Menu></label>
                    <div class="flex flex-wrap gap-2">
                        <div class="flex items-center px-4 py-2 rounded-full border border-gray-300 shadow-sm text-sm">
                            <input id="status-all" name="product-status" type="radio"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                            <label for="status-all" class="ml-2 text-gray-700">Semua Menu</label>
                        </div>
                        <div class="flex items-center px-4 py-2 rounded-full border border-gray-300 shadow-sm text-sm">
                            <input id="status-new" name="product-status" type="radio"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                            <label for="status-new" class="ml-2 text-gray-700">Baru</label>
                        </div>
                        <div class="flex items-center px-4 py-2 rounded-full border border-gray-300 shadow-sm text-sm">
                            <input id="status-old" name="product-status" type="radio"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                            <label for="status-old" class="ml-2 text-gray-700">Lama</label>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <label class="block text-sm font-bold text-gray-800 mb-3 uppercase tracking-wide">Ketersediaan
                        Menu</label>
                    <div class="flex flex-wrap gap-2">
                        <div class="flex items-center px-4 py-2 rounded-full border border-gray-300 shadow-sm text-sm">
                            <input id="stock-all" name="product-stock" type="radio"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                            <label for="stock-all" class="ml-2 text-gray-700">Semua Menu</label>
                        </div>
                        <div class="flex items-center px-4 py-2 rounded-full border border-gray-300 shadow-sm text-sm">
                            <input id="stock-available" name="product-stock" type="radio"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                            <label for="stock-available" class="ml-2 text-gray-700">Tersedia</label>
                        </div>
                        <div class="flex items-center px-4 py-2 rounded-full border border-gray-300 shadow-sm text-sm">
                            <input id="stock-unavailable" name="product-stock" type="radio"
                                class="focus:ring-blue-500 h-4 w-4 text-blue-600">
                            <label for="stock-unavailable" class="ml-2 text-gray-700">Habis</label>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <label for="price-range"
                        class="block text-sm font-bold text-gray-800 mb-2 uppercase tracking-wide">Saring Harga</label>
                    <input type="range" id="price-range" min="0" max="50000" value="50000"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                        <span>Rp0</span>
                        <span id="price-value">Rp50.000</span>
                    </div>
                </div> -->

                <!-- <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <label class="block text-sm font-bold text-gray-800 mb-2 uppercase tracking-wide">Rentang
                        Harga</label>
                    <div class="flex items-center space-x-2">

                        <div class="relative w-1/2">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-xs">Rp</span>
                            <input type="text" id="min-price-input" placeholder="Min"
                                class="w-full rounded-md border-gray-300 shadow-sm text-xs py-2 pl-8 pr-3 focus:ring-blue-500 focus:border-blue-500"
                                step="1000" min="0">
                        </div>

                        <span class="text-gray-500">-</span>

                        <div class="relative w-1/2">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-xs">Rp</span>
                            <input type="text" id="max-price-input" placeholder="Max"
                                class="w-full rounded-md border-gray-300 shadow-sm text-xs py-2 pl-8 pr-3 focus:ring-blue-500 focus:border-blue-500"
                                step="1000" min="0">
                        </div>
                    </div>

                </div> -->

                <div class="mb-5 pb-5 border-b-2 border-gray-300">
                    <h3 class="text-sm font-bold text-gray-800 mb-2 uppercase tracking-wide">Rentang Harga</h3>
                    <select id="price-range-dropdown"
                        class="w-full py-2 px-3 border border-gray-300 rounded-lg text-sm focus:ring-[#994d51] focus:border-[#994d51] transition">
                        <option value="">Semua harga</option>
                        <option data-min="0" data-max="10000">Di bawah Rp 10.000</option>
                        <option data-min="10000" data-max="25000">Rp 10.000 - Rp 25.000</option>
                        <option data-min="25000" data-max="50000">Rp 25.000 - Rp 50.000</option>
                        <option data-min="50000" data-max="75000">Rp 50.000 - Rp 75.000</option>
                        <option data-min="75000" data-max="100000">Rp 75.000 - Rp 100.000</option>
                    </select>
                    <input type="hidden" id="min-price-filter" name="min_price" />
                    <input type="hidden" id="max-price-filter" name="max_price" />
                </div>

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
                <div class="flex flex-col lg:flex-row gap-6 items-center justify-between ">
                    <div class="w-full">
                        <div class="flex items-center gap-4">
                            <div class="relative w-1/2 bg-gray-50 border border-gray-300 rounded-md shadow-sm">
                                <button id="filter-category-btn" type="button"
                                    class="inline-flex justify-between items-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <span id="category-label" class="truncate">Semua Menu</span>
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
                                        <a href="#"
                                            class="category-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-category="all">Semua Menu</a>
                                        <a href="#"
                                            class="category-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-category="minuman">Minuman</a>
                                        <a href="#"
                                            class="category-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-category="makanan">Makanan</a>
                                        <a href="#"
                                            class="category-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-category="cemilan">Cemilan</a>
                                        <a href="#"
                                            class="category-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-category="dessert">Dessert</a>
                                    </div>
                                </div>
                            </div>

                            <div class="relative w-1/2 bg-gray-50 border border-gray-300 rounded-md shadow-sm">
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
                                            data-sort-by="newest">Urutkan menurut yang terbaru</a>
                                        <a href="#"
                                            class="sort-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-sort-by="cheapest">Urutkan dari termurah</a>
                                        <a href="#"
                                            class="sort-option text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100"
                                            data-sort-by="mostexpensive">Urutkan dari termahal</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex border border-gray-300 rounded-md shadow-sm divide-x divide-gray-300 bg-gray-50 border border-gray-300 rounded-md shadow-sm">
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
            // Data menu dan variabel lainnya
            // Data menu dan variabel lainnya
            const menuData = [{
                    id: 'kopisusugulaaren',
                    category: 'minuman',
                    name: 'Kopi Susu Aren',
                    description: 'Perpaduan espresso, susu segar, dan manisnya gula aren alami.',
                    price: 18000,
                    image: '{{ asset('assets/demo/fnb/images/kopisusugulaaren.jpg') }}',
                    isNew: true,
                    isAvailable: true
                },
                {
                    id: 'capuccino',
                    category: 'minuman',
                    name: 'Capuccino',
                    description: 'Paduan sempurna antara espresso, susu hangat, dan busa susu lembut.',
                    price: 20000,
                    image: '{{ asset('assets/demo/fnb/images/capuccino.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'rotibakarcoklat',
                    category: 'makanan',
                    name: 'Roti Bakar Coklat',
                    description: 'Roti panggang isi coklat meleleh dengan taburan meses.',
                    price: 12000,
                    image: '{{ asset('assets/demo/fnb/images/rotibakarcoklat.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'nasigorengkampung',
                    category: 'makanan',
                    name: 'Nasi Goreng Kampung',
                    description: 'Nasi goreng pedas dengan irisan ayam, telur, dan kerupuk.',
                    price: 25000,
                    image: '{{ asset('assets/demo/fnb/images/nasigoreng.jpg') }}',
                    isNew: true,
                    isAvailable: false
                },
                {
                    id: 'sandwich',
                    category: 'makanan',
                    name: 'Sandwich',
                    description: 'Roti isi daging asap, sayuran segar, dan saus mayo.',
                    price: 10000,
                    image: '{{ asset('assets/demo/fnb/images/sandwich.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'salad',
                    category: 'makanan',
                    name: 'Salad Sayur',
                    description: 'Campuran sayuran segar dengan dressing lemon.',
                    price: 18000,
                    image: '{{ asset('assets/demo/fnb/images/salad.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'pasta',
                    category: 'makanan',
                    name: 'Pasta Aglio e Olio',
                    description: 'Pasta dengan saus bawang putih, minyak zaitun, dan cabai.',
                    price: 20000,
                    image: '{{ asset('assets/demo/fnb/images/pasta.jpg') }}',
                    isNew: false,
                    isAvailable: false
                },
                {
                    id: 'croissant',
                    category: 'makanan',
                    name: 'Croissant',
                    description: 'Roti croissant renyah dengan isian selai strawberry.',
                    price: 15000,
                    image: '{{ asset('assets/demo/fnb/images/croissant.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'kentanggoreng',
                    category: 'cemilan',
                    name: 'Kentang Goreng',
                    description: 'Crunchy, gurih, dan pas sebagai teman minum kopi.',
                    price: 15000,
                    image: '{{ asset('assets/demo/fnb/images/kentanggoreng.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'pisangcrispy',
                    category: 'cemilan',
                    name: 'Pisang Crispy',
                    description: 'Potongan pisang yang digoreng hingga renyah, dilapisi saus karamel dan keju.',
                    price: 17000,
                    image: '{{ asset('assets/demo/fnb/images/pisangcrispy.jpg') }}',
                    isNew: true,
                    isAvailable: true
                },
                {
                    id: 'cheesecake',
                    category: 'dessert',
                    name: 'Cheesecake',
                    description: 'Kue keju lembut dengan lapisan biskuit di bawahnya.',
                    price: 30000,
                    image: '{{ asset('assets/demo/fnb/images/cheesecake.jpg') }}',
                    isNew: true,
                    isAvailable: false
                },
                {
                    id: 'moccacino',
                    category: 'minuman',
                    name: 'Moccacino',
                    description: 'Espresso dengan cokelat, susu, dan whipped cream.',
                    price: 22000,
                    image: '{{ asset('assets/demo/fnb/images/moccacino.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'espresso',
                    category: 'minuman',
                    name: 'Espresso',
                    description: 'Kopi hitam pekat dengan aroma yang kuat.',
                    price: 17000,
                    image: '{{ asset('assets/demo/fnb/images/espresso.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'latte',
                    category: 'minuman',
                    name: 'Latte',
                    description: 'Espresso dengan susu panas dan sedikit busa.',
                    price: 22000,
                    image: '{{ asset('assets/demo/fnb/images/latte.jpg') }}',
                    isNew: false,
                    isAvailable: false
                },
                {
                    id: 'americano',
                    category: 'minuman',
                    name: 'Americano',
                    description: 'Espresso yang disajikan dengan air panas.',
                    price: 16000,
                    image: '{{ asset('assets/demo/fnb/images/americano.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'tehtarik',
                    category: 'minuman',
                    name: 'Teh Tarik',
                    description: 'Teh susu klasik yang ditarik hingga berbusa.',
                    price: 15000,
                    image: '{{ asset('assets/demo/fnb/images/tehtarik.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'ayambakarmadu',
                    category: 'makanan',
                    name: 'Ayam Bakar Madu',
                    description: 'Ayam panggang dengan bumbu madu manis dan gurih.',
                    price: 35000,
                    image: '{{ asset('assets/demo/fnb/images/ayambakarmadu.jpg') }}',
                    isNew: false,
                    isAvailable: false
                },
                {
                    id: 'spaghetti',
                    category: 'makanan',
                    name: 'Spaghetti Bolognese',
                    description: 'Spaghetti dengan saus daging cincang dan keju parmesan.',
                    price: 32000,
                    image: '{{ asset('assets/demo/fnb/images/spaghetti.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'tahugejrot',
                    category: 'cemilan',
                    name: 'Tahu Gejrot',
                    description: 'Tahu goreng dengan kuah pedas manis khas Cirebon.',
                    price: 10000,
                    image: '{{ asset('assets/demo/fnb/images/tahugejrot.jpg') }}',
                    isNew: true,
                    isAvailable: true
                },
                {
                    id: 'brownies',
                    category: 'dessert',
                    name: 'Brownies',
                    description: 'Kue cokelat yang padat dan kaya rasa.',
                    price: 28000,
                    image: '{{ asset('assets/demo/fnb/images/brownies.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'redvelvetcake',
                    category: 'dessert',
                    name: 'Red Velvet Cake',
                    description: 'Kue merah dengan lapisan krim keju yang lembut.',
                    price: 35000,
                    image: '{{ asset('assets/demo/fnb/images/redvelvetcake.jpg') }}',
                    isNew: true,
                    isAvailable: false
                },
                {
                    id: 'lemontea',
                    category: 'minuman',
                    name: 'Lemon Tea',
                    description: 'Teh segar dengan perasan lemon.',
                    price: 12000,
                    image: '{{ asset('assets/demo/fnb/images/lemontea.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'chickenwings',
                    category: 'makanan',
                    name: 'Chicken Wings',
                    description: 'Sayap ayam goreng tepung dengan saus pedas.',
                    price: 28000,
                    image: '{{ asset('assets/demo/fnb/images/chickenwings.jpg') }}',
                    isNew: false,
                    isAvailable: true
                },
                {
                    id: 'onionrings',
                    category: 'cemilan',
                    name: 'Onion Rings',
                    description: 'Irisan bawang bombay goreng tepung.',
                    price: 14000,
                    image: '{{ asset('assets/demo/fnb/images/onionrings.jpg') }}',
                    isNew: false,
                    isAvailable: false
                }
            ];

            let currentCategory = 'all';
            let currentSort = 'newest';
            let currentView = 'list';
            let currentPage = 1;
            let searchTerm = '';
            let productStatus = 'all';
            let maxPrice = 50000;
            let productStock = 'all';
            // let minPriceRange = 0;
            // let maxPriceRange = Infinity; // Menggunakan Infinity sebagai nilai awal untuk mempermudah logika
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

                if (currentView === 'list') {
                    // Hapus border-b dan pb-6 dari item, dan gunakan space-y-6 pada kontainer induk
                    menuList.classList.remove('grid', 'grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-5', 'gap-4');
                    menuList.classList.add('space-y-6');
                } else {
                    menuList.classList.remove('space-y-6');
                    menuList.classList.add('grid', 'grid-cols-2', 'md:grid-cols-3', 'lg:grid-cols-5', 'gap-4');
                }

                items.forEach(item => {
                    let itemHTML;
                    if (currentView === 'list') {
                        itemHTML = `
<div class="relative flex justify-between items-start border-b border-gray-200 pb-6 transition duration-200 ease-in-out hover:shadow-md hover:bg-gray-50">
    <div class="flex-grow space-y-2">
        <h3 class="font-semibold text-lg">${item.name}</h3>
        <p class="text-xs text-gray-600">${item.description}</p>
        <p class="text-base font-bold text-[#994d51]">Rp${item.price.toLocaleString('id-ID')}</p>
        <button class="detail-btn mt-2 bg-[#994d51] hover:bg-[#7a3c3f] text-white font-semibold px-4 py-1 text-sm rounded-full shadow transition duration-200" data-modal="product-modal-${item.id}">Detail</button>
    </div>
    <div class="relative w-32 h-32 rounded-lg ml-6">
        <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover rounded-lg ${!item.isAvailable ? 'opacity-50' : ''}" />
        ${!item.isAvailable ? '<div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-lg text-sm">Stok Habis</div>' : ''}
    </div>
</div>
`;
                    } else { // Tampilan Grid
                        itemHTML = `
<div class="relative flex flex-col items-center border border-gray-200 rounded-lg p-4 text-center transition duration-200 ease-in-out hover:scale-105 hover:shadow-md">
    <div class="relative w-24 h-24 rounded-lg mb-2">
        <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover rounded-lg ${!item.isAvailable ? 'opacity-50' : ''}" />
        ${!item.isAvailable ? '<div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-lg text-sm">Stok Habis</div>' : ''}
    </div>
    <h3 class="font-semibold text-sm">${item.name}</h3>
    <p class="text-xs font-bold text-[#994d51]">Rp${item.price.toLocaleString('id-ID')}</p>
    <button class="detail-btn mt-2 bg-[#994d51] hover:bg-[#7a3c3f] text-white font-semibold px-2 py-1 text-xs rounded-full shadow transition duration-200" data-modal="product-modal-${item.id}">Detail</button>
</div>
`;
                    }
                    menuList.innerHTML += itemHTML;
                });

                addModalEventListeners();
            }

            // Fungsi utama untuk mengurutkan, memfilter, dan merender ulang
            function sortAndRender() {
                let itemsToRender;

                // 1. Filter berdasarkan kategori
                if (currentCategory === 'all') {
                    itemsToRender = [...menuData];
                } else {
                    itemsToRender = menuData.filter(item => item.category === currentCategory);
                }

                // 2. Filter berdasarkan pencarian (search term)
                if (searchTerm) {
                    itemsToRender = itemsToRender.filter(item => item.name.toLowerCase().includes(searchTerm.toLowerCase()));
                }

                // 3. Filter berdasarkan status produk
                if (productStatus === 'new') {
                    itemsToRender = itemsToRender.filter(item => item.isNew);
                } else if (productStatus === 'old') {
                    itemsToRender = itemsToRender.filter(item => !item.isNew);
                }

                // 4. Tambahkan filter berdasarkan ketersediaan stok
                if (productStock === 'available') {
                    itemsToRender = itemsToRender.filter(item => item.isAvailable);
                } else if (productStock === 'unavailable') {
                    itemsToRender = itemsToRender.filter(item => !item.isAvailable);
                }

                // 5. Filter berdasarkan harga dari slider
                itemsToRender = itemsToRender.filter(item => item.price <= maxPrice);

                // 6. Tambahkan filter berdasarkan rentang harga (dari input Min-Max atau dropdown)
                // itemsToRender = itemsToRender.filter(item => {
                //     return item.price >= minPriceRange && item.price <= maxPriceRange;
                // });

                // 7. Lanjutkan dengan pengurutan seperti biasa
                let sortedItems = [...itemsToRender];
                sortedItems.sort((a, b) => {
                    // Pindahkan item yang stoknya habis ke bagian bawah
                    if (!a.isAvailable && b.isAvailable) {
                        return 1; // a (stok habis) ke belakang
                    }
                    if (a.isAvailable && !b.isAvailable) {
                        return -1; // b (stok habis) ke belakang
                    }

                    // Jika status ketersediaan sama, urutkan berdasarkan kriteria lain
                    if (currentSort === 'cheapest') {
                        return a.price - b.price;
                    } else if (currentSort === 'mostexpensive') {
                        return b.price - a.price;
                    } else if (currentSort === 'newest') {
                        // Asumsi `isNew` adalah boolean (true/false)
                        // Item baru (true) akan memiliki nilai 1, item lama (false) 0.
                        // `b.isNew - a.isNew` akan menempatkan item baru di depan.
                        return b.isNew - a.isNew;
                    }

                    // Default: tidak diurutkan
                    return 0;
                });

                // 8. Lanjutkan dengan pagination
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const paginatedItems = sortedItems.slice(startIndex, endIndex);

                renderMenu(paginatedItems);
                renderPagination(sortedItems.length);
            }

            function addModalEventListeners() {
                // Ambil semua tombol detail dan modal
                const detailButtons = document.querySelectorAll('.detail-btn');
                const modals = document.querySelectorAll('[id^="product-modal-"]');

                // Tambahkan event listener untuk tombol detail
                detailButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.dataset.modal;
                        const modal = document.getElementById(modalId);

                        // Ambil ID produk dari modalId
                        const productId = modalId.replace('product-modal-', '');
                        // Cari data produk yang sesuai dari array `menuData`
                        const product = menuData.find(item => item.id === productId);

                        if (modal && product) {
                            // Cari elemen gambar dan overlay stok di dalam modal
                            const modalImage = modal.querySelector('img');
                            const stockOverlay = modal.querySelector('.stock-overlay');

                            // Atur visibilitas gambar dan overlay berdasarkan ketersediaan produk
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

                // Tambahkan event listener untuk tombol "Terapkan"
                // Perbaiki logika di tombol "Terapkan"
                // applyPriceBtn.addEventListener('click', () => {
                //     // Ambil nilai dari input yang sudah diformat
                //     const rawMinPrice = minPriceInput.value;
                //     const rawMaxPrice = maxPriceInput.value;

                //     // Bersihkan nilai dari titik sebelum parsing
                //     const cleanedMinPrice = rawMinPrice.replace(/\./g, '');
                //     const cleanedMaxPrice = rawMaxPrice.replace(/\./g, '');

                //     // Konversi string yang sudah bersih ke integer
                //     minPriceRange = cleanedMinPrice ? parseInt(cleanedMinPrice) : 0;
                //     maxPriceRange = cleanedMaxPrice ? parseInt(cleanedMaxPrice) : Infinity;

                //     // Pastikan nilai tidak NaN (Not a Number) sebelum filter
                //     if (isNaN(minPriceRange)) {
                //         minPriceRange = 0;
                //     }
                //     if (isNaN(maxPriceRange)) {
                //         maxPriceRange = Infinity;
                //     }

                //     // Panggil fungsi utama untuk mengurutkan dan me-render ulang
                //     sortAndRender();
                // });

                // Tambahkan event listener untuk tombol tutup modal
                modals.forEach(modal => {
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
                });
            }

            // Tambahkan event listener untuk semua kontrol baru
            document.addEventListener('DOMContentLoaded', () => {
                sortAndRender();
                addModalEventListeners();

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
                if (filterCategoryBtn) {
                    filterCategoryBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        categoryOptions.classList.toggle('hidden');
                    });
                }
                if (categoryOptions) {
                    categoryOptions.addEventListener('click', (e) => {
                        if (e.target.classList.contains('category-option')) {
                            e.preventDefault();
                            currentCategory = e.target.dataset.category;
                            categoryLabel.innerText = e.target.innerText;
                            currentPage = 1;
                            sortAndRender();
                            categoryOptions.classList.add('hidden');
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
                if (priceRangeDropdown) {
                    priceRangeDropdown.addEventListener('change', (e) => {
                        const selectedOption = e.target.options[e.target.selectedIndex];
                        const min = selectedOption.dataset.min;
                        const max = selectedOption.dataset.max;

                        minPriceRange = min ? parseInt(min) : 0;
                        maxPriceRange = max ? parseInt(max) : Infinity;

                        currentPage = 1;
                        sortAndRender();
                    });
                }

                const resetButton = document.getElementById('reset-filters');
                if (resetButton) {
                    resetButton.addEventListener('click', () => {
                        // Reset variabel global
                        currentCategory = 'all';
                        currentSort = 'newest';
                        currentView = 'list';
                        currentPage = 1;
                        searchTerm = '';
                        productStatus = 'all';
                        maxPrice = 100000;
                        productStock = 'all';
                        minPriceRange = 0;
                        maxPriceRange = Infinity;

                        // Reset elemen DOM
                        document.getElementById('search-product').value = '';
                        document.getElementById('status-all').checked = true;
                        document.getElementById('stock-all').checked = true;

                        const priceRangeSlider = document.getElementById('price-range');
                        const priceValueDisplay = document.getElementById('price-value');
                        priceRangeSlider.value = maxPrice;
                        priceValueDisplay.textContent = `Rp${formatRupiah(maxPrice)}`;

                        // document.getElementById('min-price-input').value = '';
                        // document.getElementById('max-price-input').value = '';

                        document.getElementById('price-range-dropdown').value = '';

                        const sortLabel = document.getElementById('sort-label');
                        if (sortLabel) sortLabel.innerText = "Terbaru";

                        const categoryLabel = document.getElementById('category-label');
                        if (categoryLabel) categoryLabel.innerText = "Semua Kategori";

                        const viewListBtn = document.getElementById('view-list');
                        const viewGridBtn = document.getElementById('view-grid');
                        if (viewListBtn && viewGridBtn) {
                            viewListBtn.classList.remove('bg-white', 'border-gray-300', 'hover:bg-gray-50');
                            viewListBtn.classList.add('bg-gray-200');
                            viewGridBtn.classList.remove('bg-gray-200');
                            viewGridBtn.classList.add('bg-white', 'border', 'border-gray-300',
                                'hover:bg-gray-50');
                        }

                        // Panggil fungsi utama untuk me-render ulang dengan filter yang telah direset
                        sortAndRender();
                    });
                }

                // Toggle collapsible filter sections
            });
        </script>



        <!-- Modal untuk Kopi Susu Aren -->
        <div id="product-modal-kopisusugulaaren"
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
                        <img src="{{ asset('assets/demo/fnb/images/kopisusugulaaren.jpg') }}"
                            alt="Kopi Susu Gula Aren" class="w-full h-auto rounded-xl object-cover" />

                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Kopi Susu Gula Aren</h3>
                        <p class="text-sm text-gray-700">Perpaduan espresso, susu segar, dan manisnya gula aren alami.
                        </p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp18.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Capuccino -->
        <div id="product-modal-capuccino"
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
                        <img src="{{ asset('assets/demo/fnb/images/capuccino.jpg') }}" alt="Capuccino"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Capuccino</h3>
                        <p class="text-sm text-gray-700">Paduan sempurna antara espresso kental, susu hangat, dan busa
                            susu yang lembut. Ditaburi bubuk kakao, Capuccino kami menawarkan pengalaman minum kopi yang
                            seimbang, lembut, dan kaya rasa.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp20.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk moccacino -->
        <div id="product-modal-moccacino"
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
                        <img src="{{ asset('assets/demo/fnb/images/moccacino.jpg') }}" alt="Moccacino"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Moccacino</h3>
                        <p class="text-sm text-gray-700">Perpaduan sempurna antara espresso, cokelat, dan susu.
                            Moccacino kami menghadirkan rasa kopi yang kuat dengan manisnya cokelat yang lembut,
                            menciptakan minuman yang kaya dan memuaskan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp22.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Teh Tarik -->
        <div id="product-modal-tehtarik"
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
                        <img src="{{ asset('assets/demo/fnb/images/tehtarik.jpg') }}" alt="Teh Tarik"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Teh Tarik</h3>
                        <p class="text-sm text-gray-700">Minuman teh tradisional yang unik dari perpaduan teh hitam
                            pekat dengan susu kental manis, dituang bolak-balik untuk menghasilkan tekstur yang berbusa
                            dan rasa yang menyatu sempurna. Manis dan creamy, Teh Tarik kami adalah pilihan yang
                            menyegarkan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp18.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Lemon Tea -->
        <div id="product-modal-lemontea"
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
                        <img src="{{ asset('assets/demo/fnb/images/lemontea.jpg') }}" alt="Lemon Tea"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Lemon Tea</h3>
                        <p class="text-sm text-gray-700">Perpaduan teh hitam yang kuat dengan perasan lemon segar.
                            Lemon
                            Tea kami menyajikan sensasi rasa yang seimbang antara segar, asam, dan sedikit manis,
                            menjadikannya pilihan sempurna untuk menyegarkan hari.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp18.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Espresso -->
        <div id="product-modal-espresso"
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
                        <img src="{{ asset('assets/demo/fnb/images/espresso.jpg') }}" alt="Espresso"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Espresso</h3>
                        <p class="text-sm text-gray-700">Espresso adalah inti dari semua minuman kopi kami. Dibuat dari
                            biji kopi pilihan yang disangrai sempurna, diseduh dengan tekanan tinggi untuk menghasilkan
                            sari kopi yang pekat, intens, dan kaya akan crema. Nikmati kemurnian kopi dalam satu
                            tegukan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp17.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Latte -->
        <div id="product-modal-latte"
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
                        <img src="{{ asset('assets/demo/fnb/images/latte.jpg') }}" alt="Latte"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Latte</h3>
                        <p class="text-sm text-gray-700">Latte adalah minuman kopi yang lembut dan creamy, cocok bagi
                            Anda yang menyukai perpaduan rasa kopi yang tidak terlalu kuat. Terdiri dari satu shot
                            espresso yang dicampur dengan susu hangat yang melimpah dan dilapisi busa tipis di atasnya.
                            Kombinasi ini menghasilkan rasa yang seimbang dan menenangkan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp22.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Americano -->
        <div id="product-modal-americano"
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
                        <img src="{{ asset('assets/demo/fnb/images/americano.jpg') }}" alt="Americano"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Americano</h3>
                        <p class="text-sm text-gray-700">Americano adalah minuman kopi hitam yang dibuat dengan
                            menambahkan air panas pada satu shot espresso. Hasilnya adalah cita rasa kopi yang kuat
                            namun lebih ringan dari espresso, sangat pas untuk dinikmati di pagi hari.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp16.000</span>
                            <span class="text-sm text-gray-500">/ cup</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Roti Bakar Coklat (Contoh) -->
        <div id="product-modal-rotibakarcoklat"
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
                        <img src="{{ asset('assets/demo/fnb/images/rotibakarcoklat.jpg') }}" alt="Roti Bakar Coklat"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Roti Bakar Coklat</h3>
                        <p class="text-sm text-gray-700">Roti tawar panggang yang renyah di luar dan lembut di dalam,
                            diisi dengan lelehan coklat premium yang kaya rasa. Ditambah dengan taburan meses dan
                            sentuhan susu kental manis, camilan ini sangat cocok dinikmati bersama kopi.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp12.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal untuk Ayam Bakar Madu  -->
        <div id="product-modal-ayambakarmadu"
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
                        <img src="{{ asset('assets/demo/fnb/images/ayambakarmadu.jpg') }}" alt="Ayam Bakar Madu"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Ayam Bakar Madu</h3>
                        <p class="text-sm text-gray-700">Potongan ayam pilihan yang dibumbui dengan rempah-rempah khas
                            dan dilumuri madu, kemudian dibakar hingga matang sempurna. Menghadirkan cita rasa manis dan
                            gurih yang meresap hingga ke dalam.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp35.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Spaghetti -->
        <div id="product-modal-spaghetti"
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
                        <img src="{{ asset('assets/demo/fnb/images/spaghetti.jpg') }}" alt="Spaghetti"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Spaghetti</h3>
                        <p class="text-sm text-gray-700">Spaghetti klasik dengan saus bolognese otentik yang kaya rasa,
                            terbuat dari daging cincang pilihan, tomat segar, dan rempah-rempah Italia. Disajikan
                            hangat, hidangan ini sempurna untuk memanjakan lidah Anda.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp32.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal untuk Chicken Wings -->
        <div id="product-modal-chickenwings"
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
                        <img src="{{ asset('assets/demo/fnb/images/chickenwings.jpg') }}" alt="Chicken Wings"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Chicken Wings</h3>
                        <p class="text-sm text-gray-700">Potongan sayap ayam renyah yang dibalut dengan saus pedas
                            manis
                            khas. Chicken Wings kami adalah camilan yang sempurna untuk dinikmati bersama teman atau
                            sebagai pelengkap hidangan utama Anda.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp28.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Croissant -->
        <div id="product-modal-croissant"
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
                        <img src="{{ asset('assets/demo/fnb/images/croissant.jpg') }}" alt="Croissant"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Croissant</h3>
                        <p class="text-sm text-gray-700">Roti panggang khas Prancis yang renyah di luar dan lembut
                            berlapis di dalam. Dibuat dengan adonan mentega berkualitas tinggi, croissant ini mengembang
                            sempurna saat dipanggang, menghasilkan tekstur yang ringan dan aroma yang menggoda. Cocok
                            dinikmati dengan kopi di pagi atau sore hari.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp15.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Sandwich -->
        <div id="product-modal-sandwich"
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
                        <img src="{{ asset('assets/demo/fnb/images/sandwich.jpg') }}" alt="Sandwich"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Sandwich</h3>
                        <p class="text-sm text-gray-700">Roti tawar panggang dengan isian daging asap, keju cheddar,
                            selada segar, tomat, dan mayones. Disusun dengan rapi dan dipanggang hingga kecoklatan,
                            sandwich ini menawarkan kombinasi tekstur renyah dan rasa gurih yang sempurna sebagai teman
                            minum kopi Anda.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp10.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Salad -->
        <div id="product-modal-salad"
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
                        <img src="{{ asset('assets/demo/fnb/images/salad.jpg') }}" alt="Salad"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Salad</h3>
                        <p class="text-sm text-gray-700">Campuran sayuran segar seperti lettuce, tomat, mentimun, dan
                            wortel, dilengkapi dengan protein pilihan (ayam panggang atau telur rebus), dan disiram
                            dengan dressing lezat yang ringan. Sajian sehat ini sangat cocok untuk teman minum kopi saat
                            bersantai.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp18.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Pasta -->
        <div id="product-modal-pasta"
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
                        <img src="{{ asset('assets/demo/fnb/images/pasta.jpg') }}" alt="Pasta"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Pasta</h3>
                        <p class="text-sm text-gray-700">Hidangan klasik Italia dengan saus yang kaya rasa dan tekstur
                            yang sempurna. Pasta kami disajikan dengan pilihan saus seperti carbonara, bolognese, atau
                            aglio olio, menggunakan bahan segar dan dimasak al dente untuk memberikan pengalaman
                            bersantap yang autentik dan memuaskan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp20.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Nasi Goreng Kampung -->
        <div id="product-modal-nasigorengkampung"
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
                        <img src="{{ asset('assets/demo/fnb/images/nasigoreng.jpg') }}" alt="Nasi Goreng Kampung"
                            class="w-full h-auto rounded-xl object-cover" />

                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Nasi Goreng Kampung</h3>
                        <p class="text-sm text-gray-700">Nasi goreng klasik dengan sentuhan pedas yang
                            membangkitkan selera. Dilengkapi irisan ayam yang gurih, telur orak-arik yang lembut, dan
                            kerupuk renyah yang menambah tekstur.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp25.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Kentang Goreng -->
        <div id="product-modal-kentanggoreng"
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
                        <img src="{{ asset('assets/demo/fnb/images/kentanggoreng.jpg') }}" alt="Kentang Goreng"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Kentang Goreng</h3>
                        <p class="text-sm text-gray-700">Kentang segar yang dipotong sempurna dan digoreng hingga
                            renyah
                            di luar, lembut di dalam. Disajikan dengan bumbu gurih yang pas, camilan ini sangat cocok
                            menemani secangkir kopi Anda saat bersantai.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp15.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Pisang Crispy -->
        <div id="product-modal-pisangcrispy"
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
                        <img src="{{ asset('assets/demo/fnb/images/pisangcrispy.jpg') }}" alt="Pisang Crispy"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Pisang Crispy</h3>
                        <p class="text-sm text-gray-700">Potongan pisang pilihan yang digoreng garing dengan lapisan
                            renyah. Disajikan dengan lelehan saus karamel, taburan parutan keju, dan tambahan susu
                            kental manis. Camilan manis yang sempurna untuk menemani kopi Anda.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp17.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Tahu Gejrot -->
        <div id="product-modal-tahugejrot"
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
                        <img src="{{ asset('assets/demo/fnb/images/tahugejrot.jpg') }}" alt="Tahu Gejrot"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Tahu Gejrot</h3>
                        <p class="text-sm text-gray-700">Jajanan tradisional yang terdiri dari tahu goreng yang
                            dipotong-potong, disiram dengan kuah cuka, gula merah, dan air, lalu disajikan dengan cabai
                            dan bawang merah segar. Kombinasi rasa pedas, manis, dan asamnya sangat menyegarkan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp10.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Onion Rings -->
        <div id="product-modal-onionrings"
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
                        <img src="{{ asset('assets/demo/fnb/images/onionrings.jpg') }}" alt="Onion Rings"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Onion Rings</h3>
                        <p class="text-sm text-gray-700">Cincin bawang bombay segar yang dibungkus adonan renyah dan
                            digoreng hingga keemasan. Camilan yang sempurna untuk dinikmati bersama saus pilihan Anda,
                            memberikan sensasi rasa gurih dan tekstur yang garing.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp14.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Brownis -->
        <div id="product-modal-brownies"
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
                        <img src="{{ asset('assets/demo/fnb/images/brownies.jpg') }}" alt="Brownis Coklat"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Brownies Coklat</h3>
                        <p class="text-sm text-gray-700">Sajian manis yang sempurna untuk menutup hidangan atau sebagai
                            teman minum kopi Anda. Brownis kami dibuat dari coklat premium dengan tekstur luar yang
                            sedikit renyah dan bagian dalam yang lembut, hampir meleleh di mulut. Setiap gigitan
                            memberikan ledakan rasa coklat yang kaya dan memuaskan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp15.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Red Velvet Cake -->
        <div id="product-modal-redvelvetcake"
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
                        <img src="{{ asset('assets/demo/fnb/images/redvelvetcake.jpg') }}" alt="Red Velvet Cake"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Red Velvet Cake</h3>
                        <p class="text-sm text-gray-700">Kue bolu merah yang lembut dengan sedikit rasa kakao, dilapisi
                            dengan krim keju frosting yang manis dan creamy. Tampilannya yang elegan dan rasanya yang
                            kaya menjadikannya pilihan sempurna untuk penutup hidangan.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp35.000</span>
                            <span class="text-sm text-gray-500">/ potong</span>
                        </div>

                        <button
                            class="order-btn w-full md:w-auto mt-6 bg-[#994d51] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-[#7a3c3f] transition duration-200">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk Cheesecake -->
        <div id="product-modal-cheesecake"
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
                        <img src="{{ asset('assets/demo/fnb/images/cheesecake.jpg') }}" alt="Cheesecake"
                            class="w-full h-auto rounded-xl object-cover" />
                        <div
                            class="stock-overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 text-white font-bold rounded-xl text-xl hidden">
                            Stok Habis
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                        <h3 class="font-bold text-xl md:text-2xl text-[#994d51]">Cheesecake</h3>
                        <p class="text-sm text-gray-700">Kue keju panggang yang kaya rasa, dibuat dari bahan-bahan
                            premium yang menghasilkan tekstur padat namun creamy. Sensasi manis dan gurihnya sangat
                            cocok dinikmati sebagai penutup.</p>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="text-3xl font-extrabold text-[#994d51]">Rp30.000</span>
                            <span class="text-sm text-gray-500">/ porsi</span>
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


            // Fungsi untuk modal (dinamis)
            document.querySelectorAll('.detail-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                });
            });

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

    <footer class="bg-white text-black py-2">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Main Footer Section: Logo, Pages, and Contact -->
            <div class="flex flex-col md:flex-row justify-between items-start space-y-8 md:space-y-0 md:space-x-8">
                <!-- Logo Section -->
                <div class="text-center mb-10">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ asset('assets/demo/fnb/images/capuccino.jpg') }}" alt="Kopi Seduh Pagi"
                                    class="w-full h-full object-cover">
                            </div>
                            <h1 class="text-lg font-bold">Kopi Seduh Pagi</h1>
                        </div>
                    </div>
                </div>

                <!-- Pages Section -->

                <!-- Contact Section -->
                <div class="w-full md:w-1/3 text-left">
                    <h4 class="text-lg font-bold mb-4">Contact</h4>
                    <div class="text-sm text-gray-600 space-y-2">
                        <p class="mb-2 leading-relaxed">Jl. Cycas Raya Jl. Taman Setia Budi Indah<br>Blok VV No.172
                            Kompleks, Asam Kumbang,<br>Kec.
                            Medan Selayang, Kota Medan,<br>Sumatera Utara 20133</p>
                        <p class="mb-2 leading-relaxed">
                            <a href="mailto:pteraciptadigital@gmail.com"
                                class="hover:underline">pteraciptadigital@gmail.com</a>
                        </p>
                        <p class="leading-relaxed">08116584545</p>
                        <div class="flex space-x-4 mt-8 text-black">
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
            <div class="mt-8 pt-4 border-t border-gray-200 text-center text-sm text-gray-600">
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
        class="fixed bottom-8 right-20 z-50 w-12 h-12 rounded-full bg-[#994d51] bg-opacity-10 shadow-lg flex items-center justify-center transition-opacity opacity-20 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                d="M8 14l4-4 4 4" />
        </svg>
    </button>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'fnb',
    ])

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
</body>

</html>
