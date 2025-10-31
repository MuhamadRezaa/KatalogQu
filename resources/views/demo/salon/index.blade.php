<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Glamour Salon - Pengalaman Kecantikan Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Global & Reset yang disederhanakan karena menggunakan Tailwind */
        * {
            box-sizing: border-box;
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
            scroll-behavior: smooth;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Penyesuaian Font Scale agar lebih konsisten di berbagai ukuran layar */
        .text-header-lg {
            font-size: clamp(2rem, 6vw, 4rem);
        }

        .text-body-lg {
            font-size: clamp(1rem, 3vw, 1.25rem);
        }

        /* Gaya Khusus untuk Carousel */
        .hero-carousel {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 1;
            /* Di bawah overlay (z-10) dan teks (z-50) */
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
            flex-shrink: 0;
        }

        /* hero-caption sekarang hanya sebagai styling konten, bukan positioning */
        .hero-caption {
            color: white;
            text-align: center;
            padding: 2rem;
            text-shadow: 0 8px 32px rgba(0, 0, 0, 0.8);
        }

        /* Overlay pada Kartu Hairstyle */
        .hairstyle-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
        }

        .hairstyle-card:hover .hairstyle-overlay {
            opacity: 1;
        }

        /* Gaya Tombol Filter Kategori Utama */
        .filter-btn {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background-color: #ec4899 !important;
            color: white !important;
            border-color: #ec4899 !important;
        }

        /* CLASS BARU UNTUK ANIMASI PANAH */
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
    <script>
        // Konfigurasi Tailwind CSS (Tidak Berubah)
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
                    /* Animasi tetap dipertahankan */
                    keyframes: {
                        fadeIn: {
                            "0%": {
                                opacity: "0",
                                transform: "translateY(30px)"
                            },
                            "100%": {
                                opacity: "1",
                                transform: "translateY(0)"
                            },
                        },
                        slideIn: {
                            "0%": {
                                opacity: "0",
                                transform: "translateX(-30px)"
                            },
                            "100%": {
                                opacity: "1",
                                transform: "translateX(0)"
                            },
                        },
                        bounceIn: {
                            "0%": {
                                opacity: "0",
                                transform: "scale(0.3)"
                            },
                            "50%": {
                                opacity: "1",
                                transform: "scale(1.05)"
                            },
                            "70%": {
                                transform: "scale(0.9)"
                            },
                            "100%": {
                                opacity: "1",
                                transform: "scale(1)"
                            },
                        },
                        float: {
                            "0%, 100%": {
                                transform: "translateY(0px)"
                            },
                            "50%": {
                                transform: "translateY(-20px)"
                            },
                        },
                        pulseGlow: {
                            "0%, 100%": {
                                boxShadow: "0 0 20px rgba(236, 72, 153, 0.4)"
                            },
                            "50%": {
                                boxShadow: "0 0 40px rgba(236, 72, 153, 0.8)"
                            },
                        },
                        shimmer: {
                            "0%": {
                                backgroundPosition: "-200% 0"
                            },
                            "100%": {
                                backgroundPosition: "200% 0"
                            },
                        },
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 min-h-screen">
    <header>
        <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-gradient-to-r from-primary-500 to-rose-500 shadow-xl"
            id="navbar">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="/" class="flex items-center space-x-3 group">
                        <div
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                            <span class="text-primary-600 font-bold text-lg">G</span>
                        </div>
                        <span class="text-3xl md:text-4xl font-semibold tracking-wide text-white drop-shadow-md"
                            style="font-family: 'Freestyle Script', cursive">
                            Glamour Salon
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="pt-16">
        <section class="hero-gradient min-h-[55vh] flex items-center relative overflow-hidden">

            <div class="absolute inset-0 z-50 flex items-center justify-center pointer-events-none">
                <div class="hero-caption max-w-4xl px-4">
                    <h2 class="text-header-lg font-bold">Selamat datang di salon kami</h2>
                    <p class="mt-2 text-body-lg">Kecantikan dimulai di sini</p>
                    <div class="mt-8">
                        <a href="#hairstyles"
                            class="inline-block bg-gradient-to-r from-pink-500 via-pink-600 to-purple-500 text-white text-base font-medium py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out hover:from-pink-600 hover:via-pink-500 hover:to-purple-600 border-2 border-white pointer-events-auto">
                            Lihat Layanan Kami
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-carousel" aria-hidden="false">
                <div class="hero-carousel-track" id="heroTrack">
                    <div class="hero-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1600&q=80')">
                    </div>
                    <div class="hero-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1600&q=80')">
                    </div>
                    <div class="hero-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=1600&q=80')">
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-black/40 z-10"></div>
            <div id="heroIndicators" class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-40"></div>
        </section>
        <section id="hairstyles" class="py-16 md:py-24 bg-gradient-to-br from-pink-100 via-white to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


                <div class="flex flex-wrap justify-center gap-2 sm:gap-4 mb-8 max-w-5xl mx-auto">
                    <button
                        class="filter-btn text-sm md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600 active"
                        data-filter="hairstyle" data-category-type="main">HairStyle</button>
                    <button
                        class="filter-btn text-sm md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600 hover:bg-primary-500 hover:text-white transition duration-300"
                        data-filter="nailart" data-category-type="main">Nail Art</button>
                    <button
                        class="filter-btn text-sm md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600 hover:bg-primary-500 hover:text-white transition duration-300"
                        data-filter="spa" data-category-type="main">Spa & Body</button>
                    <button
                        class="filter-btn text-sm md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600 hover:bg-primary-500 hover:text-white transition duration-300"
                        data-filter="product" data-category-type="main">Produk</button>
                </div>

                <div class="mb-12 max-w-[18rem] mx-auto relative" id="subCategoryFilterContainer">
                    <div id="subCategoryDropdown" class="w-full relative">
                        <button id="subCategoryToggle"
                            class="w-full flex items-center justify-center px-6 py-2 text-sm md:text-base font-medium text-primary-600 bg-white border border-primary-500 rounded-full shadow-md hover:bg-primary-50 transition duration-300 transform hover:scale-[1.01] focus:outline-none focus:ring-2 focus:ring-primary-300">
                            <span id="subCategoryLabel">Kategori</span>
                            <svg id="dropdownArrow"
                                class="w-4 h-4 ml-2 text-primary-600 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div id="subCategoryList"
                            class="absolute top-full mt-2 w-full bg-white rounded-lg shadow-2xl py-2 z-30 opacity-0 scale-95 invisible transition-all duration-300 transform origin-top border border-gray-100">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6" id="item-container">

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-panjang">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80','Gaya Rambut Panjang Wave')">👁</span>
                            <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Panjang Wave</h3>
                                    <p class="text-sm opacity-90">Rambut Panjang</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 200.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-pendek">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80','Potongan Bob Klasik')">👁</span>
                            <img src="https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80"
                                alt="Potongan Bob Klasik"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Bob Klasik</h3>
                                    <p class="text-sm opacity-90">Rambut Pendek</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="warna-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80','Warna Rambut Ombre')">👁</span>
                            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80"
                                alt="Warna Rambut Ombre"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Warna Ombre</h3>
                                    <p class="text-sm opacity-90">Pewarnaan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 500.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80','Hair Spa Anti Ketombe')">👁</span>
                            <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80"
                                alt="Hair Spa Anti Ketombe"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Hair Spa</h3>
                                    <p class="text-sm opacity-90">Perawatan Khusus</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-panjang">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80','Gaya Rambut Panjang Wave')">👁</span>
                            <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Panjang Wave</h3>
                                    <p class="text-sm opacity-90">Rambut Panjang</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 200.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-pendek">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80','Potongan Bob Klasik')">👁</span>
                            <img src="https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80"
                                alt="Potongan Bob Klasik"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Bob Klasik</h3>
                                    <p class="text-sm opacity-90">Rambut Pendek</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="warna-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80','Warna Rambut Ombre')">👁</span>
                            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80"
                                alt="Warna Rambut Ombre"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Warna Ombre</h3>
                                    <p class="text-sm opacity-90">Pewarnaan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 500.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80','Hair Spa Anti Ketombe')">👁</span>
                            <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80"
                                alt="Hair Spa Anti Ketombe"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Hair Spa</h3>
                                    <p class="text-sm opacity-90">Perawatan Khusus</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-panjang">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80','Gaya Rambut Panjang Wave')">👁</span>
                            <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Panjang Wave</h3>
                                    <p class="text-sm opacity-90">Rambut Panjang</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 200.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-pendek">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80','Potongan Bob Klasik')">👁</span>
                            <img src="https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80"
                                alt="Potongan Bob Klasik"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Bob Klasik</h3>
                                    <p class="text-sm opacity-90">Rambut Pendek</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="warna-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80','Warna Rambut Ombre')">👁</span>
                            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80"
                                alt="Warna Rambut Ombre"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Warna Ombre</h3>
                                    <p class="text-sm opacity-90">Pewarnaan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 500.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80','Hair Spa Anti Ketombe')">👁</span>
                            <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80"
                                alt="Hair Spa Anti Ketombe"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Hair Spa</h3>
                                    <p class="text-sm opacity-90">Perawatan Khusus</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-panjang">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80','Gaya Rambut Panjang Wave')">👁</span>
                            <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Panjang Wave</h3>
                                    <p class="text-sm opacity-90">Rambut Panjang</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 200.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="rambut-pendek">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80','Potongan Bob Klasik')">👁</span>
                            <img src="https://images.unsplash.com/photo-1595475884562-073c30d45670?auto=format&fit=crop&w=800&q=80"
                                alt="Potongan Bob Klasik"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Bob Klasik</h3>
                                    <p class="text-sm opacity-90">Rambut Pendek</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="warna-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80','Warna Rambut Ombre')">👁</span>
                            <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80"
                                alt="Warna Rambut Ombre"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Warna Ombre</h3>
                                    <p class="text-sm opacity-90">Pewarnaan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 500.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="hairstyle" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80','Hair Spa Anti Ketombe')">👁</span>
                            <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=800&q=80"
                                alt="Hair Spa Anti Ketombe"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Hair Spa</h3>
                                    <p class="text-sm opacity-90">Perawatan Khusus</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80','Nail Art Glitter Pink')">👁</span>
                            <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Glitter Pink"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Gel Art Glitter</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 120.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="manicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80','Manicure Standar')">👁</span>
                            <img src="https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80"
                                alt="Manicure Standar"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Manicure</h3>
                                    <p class="text-sm opacity-90">Manicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 80.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="pedicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80','Pedicure Spa')">👁</span>
                            <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80"
                                alt="Pedicure Spa"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pedicure Spa</h3>
                                    <p class="text-sm opacity-90">Pedicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 100.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80','Nail Art Minimalis')">👁</span>
                            <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Minimalis"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minimalis</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 110.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80','Nail Art Glitter Pink')">👁</span>
                            <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Glitter Pink"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Gel Art Glitter</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 120.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="manicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80','Manicure Standar')">👁</span>
                            <img src="https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80"
                                alt="Manicure Standar"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Manicure</h3>
                                    <p class="text-sm opacity-90">Manicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 80.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="pedicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80','Pedicure Spa')">👁</span>
                            <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80"
                                alt="Pedicure Spa"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pedicure Spa</h3>
                                    <p class="text-sm opacity-90">Pedicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 100.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80','Nail Art Minimalis')">👁</span>
                            <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Minimalis"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minimalis</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 110.000</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80','Nail Art Glitter Pink')">👁</span>
                            <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Glitter Pink"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Gel Art Glitter</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 120.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="manicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80','Manicure Standar')">👁</span>
                            <img src="https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80"
                                alt="Manicure Standar"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Manicure</h3>
                                    <p class="text-sm opacity-90">Manicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 80.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="pedicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80','Pedicure Spa')">👁</span>
                            <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80"
                                alt="Pedicure Spa"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pedicure Spa</h3>
                                    <p class="text-sm opacity-90">Pedicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 100.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80','Nail Art Minimalis')">👁</span>
                            <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Minimalis"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minimalis</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 110.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80','Nail Art Glitter Pink')">👁</span>
                            <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Glitter Pink"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Gel Art Glitter</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 120.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="manicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80','Manicure Standar')">👁</span>
                            <img src="https://images.unsplash.com/photo-1610992015732-2449b76344bc?auto=format&fit=crop&w=800&q=80"
                                alt="Manicure Standar"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Manicure</h3>
                                    <p class="text-sm opacity-90">Manicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 80.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="pedicure">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80','Pedicure Spa')">👁</span>
                            <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&w=800&q=80"
                                alt="Pedicure Spa"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pedicure Spa</h3>
                                    <p class="text-sm opacity-90">Pedicure</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 100.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="nailart" data-sub-category="gel-art">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80','Nail Art Minimalis')">👁</span>
                            <img src="https://images.unsplash.com/photo-1632345031435-8727f6897d53?auto=format&fit=crop&w=800&q=80"
                                alt="Nail Art Minimalis"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minimalis</h3>
                                    <p class="text-sm opacity-90">Gel Art</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 110.000</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="pijat">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=800&q=80','Spa Relaksasi Aromaterapi')">👁</span>
                            <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Relaksasi Aromaterapi"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Aromaterapi</h3>
                                    <p class="text-sm opacity-90">Pijat</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 250.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=800&q=80','Spa Wajah Premium')">👁</span>
                            <img src="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Wajah Premium"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Wajah Premium</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 320.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="perawatan-badan">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80','Spa Lulur Tradisional')">👁</span>
                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Lulur Tradisional"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Lulur Tradisional</h3>
                                    <p class="text-sm opacity-90">Perawatan Badan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 280.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="pijat">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80','Spa Pijat Bali')">👁</span>
                            <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Pijat Bali"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pijat Bali</h3>
                                    <p class="text-sm opacity-90">Pijat</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 380.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="pijat">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=800&q=80','Spa Relaksasi Aromaterapi')">👁</span>
                            <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Relaksasi Aromaterapi"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Aromaterapi</h3>
                                    <p class="text-sm opacity-90">Pijat</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 250.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=800&q=80','Spa Wajah Premium')">👁</span>
                            <img src="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Wajah Premium"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Wajah Premium</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 320.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="perawatan-badan">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80','Spa Lulur Tradisional')">👁</span>
                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Lulur Tradisional"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Lulur Tradisional</h3>
                                    <p class="text-sm opacity-90">Perawatan Badan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 280.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="pijat">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80','Spa Pijat Bali')">👁</span>
                            <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Pijat Bali"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pijat Bali</h3>
                                    <p class="text-sm opacity-90">Pijat</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 380.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="pijat">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=800&q=80','Spa Relaksasi Aromaterapi')">👁</span>
                            <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Relaksasi Aromaterapi"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Aromaterapi</h3>
                                    <p class="text-sm opacity-90">Pijat</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 250.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=800&q=80','Spa Wajah Premium')">👁</span>
                            <img src="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Wajah Premium"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Wajah Premium</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 320.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="perawatan-badan">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80','Spa Lulur Tradisional')">👁</span>
                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Lulur Tradisional"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Lulur Tradisional</h3>
                                    <p class="text-sm opacity-90">Perawatan Badan</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 280.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="spa" data-sub-category="pijat">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalUniversal('https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80','Spa Pijat Bali')">👁</span>
                            <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=800&q=80"
                                alt="Spa Pijat Bali"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Pijat Bali</h3>
                                    <p class="text-sm opacity-90">Pijat</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 380.000</p>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80','Shampoo Keratin','edieusjwj','Rp 150.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80"
                                alt="Shampoo Keratin"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Shampoo Keratin</h3>
                                    <p class="text-sm opacity-90">Perawatan Rambut</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80','Serum Vitamin C','Glamour Admin','Rp 185.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80"
                                alt="Serum Vitamin C"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Serum Vitamin C</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 185.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80','Minyak Argan','Global Store','Rp 220.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80"
                                alt="Minyak Argan"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minyak Argan</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80','Parfum Floral','Beauty Shop','Rp 225.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80"
                                alt="Parfum Floral"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Parfum Floral</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 225.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80','Shampoo Keratin','edieusjwj','Rp 150.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80"
                                alt="Shampoo Keratin"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Shampoo Keratin</h3>
                                    <p class="text-sm opacity-90">Perawatan Rambut</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80','Serum Vitamin C','Glamour Admin','Rp 185.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80"
                                alt="Serum Vitamin C"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Serum Vitamin C</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 185.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80','Minyak Argan','Global Store','Rp 220.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80"
                                alt="Minyak Argan"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minyak Argan</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80','Parfum Floral','Beauty Shop','Rp 225.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80"
                                alt="Parfum Floral"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Parfum Floral</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 225.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80','Shampoo Keratin','edieusjwj','Rp 150.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80"
                                alt="Shampoo Keratin"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Shampoo Keratin</h3>
                                    <p class="text-sm opacity-90">Perawatan Rambut</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80','Serum Vitamin C','Glamour Admin','Rp 185.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80"
                                alt="Serum Vitamin C"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Serum Vitamin C</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 185.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80','Minyak Argan','Global Store','Rp 220.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80"
                                alt="Minyak Argan"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minyak Argan</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80','Parfum Floral','Beauty Shop','Rp 225.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80"
                                alt="Parfum Floral"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Parfum Floral</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 225.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-rambut">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80','Shampoo Keratin','edieusjwj','Rp 150.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=800&q=80"
                                alt="Shampoo Keratin"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Shampoo Keratin</h3>
                                    <p class="text-sm opacity-90">Perawatan Rambut</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 150.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="perawatan-wajah">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80','Serum Vitamin C','Glamour Admin','Rp 185.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80"
                                alt="Serum Vitamin C"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Serum Vitamin C</h3>
                                    <p class="text-sm opacity-90">Perawatan Wajah</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 185.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80','Minyak Argan','Global Store','Rp 220.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80"
                                alt="Minyak Argan"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Minyak Argan</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 220.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hairstyle-card group shadow-md hover:shadow-xl transition-shadow duration-300 bg-white rounded-3xl"
                        data-category="product" data-sub-category="lain-lain">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-2 shadow-md hover:bg-primary-500 hover:text-white transition-colors cursor-pointer text-base"
                                onclick="bukaModalProduk('https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80','Parfum Floral','Beauty Shop','Rp 225.000')">🛒</span>
                            <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80"
                                alt="Parfum Floral"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold mb-1">Parfum Floral</h3>
                                    <p class="text-sm opacity-90">Lain-lain</p>
                                    <p class="text-xs mt-1 opacity-75 font-semibold">Rp 225.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-full flex justify-center mt-12 mb-8">
                    <div id="pagination-controls"
                        class="flex flex-wrap justify-center items-center mx-auto space-x-1 md:space-x-2 text-center">
                    </div>
                </div>

            </div>
        </section>

    </main>

    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 border-b border-gray-700 pb-8">
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">G</span>
                        </div>
                        <span class="text-2xl font-bold">Glamour Salon</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed max-w-sm">
                        Rasakan perawatan kecantikan mewah di salon modern kami dengan
                        layanan premium dan stylist ahli.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4 border-b-2 border-primary-500 inline-block">Kontak</h3>
                    <div class="space-y-3 text-sm text-gray-300">
                        <p class="flex items-center">
                            <span class="w-5 mr-2">📍</span> Jl. Setiabudi No. 17
                        </p>
                        <p class="flex items-center">
                            <span class="w-5 mr-2">📞</span> +62 815-7250-5989
                        </p>
                        <p class="flex items-center">
                            <span class="w-5 mr-2">✉</span> info@glamoursalon.com
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center pt-6">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Glamour Salon. Powered by PT. Era Cipta Digital
                </p>
            </div>
        </div>
    </footer>


    <div id="modalUniversal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden"
        onclick="tutupModalUniversal()">
        <div class="relative max-w-4xl w-full mx-4" onclick="event.stopPropagation()">
            <div class="relative inline-block">
                <img id="modalUniversalImg" src="" alt="Preview"
                    class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-2xl" />
                <button onclick="tutupModalUniversal()"
                    class="absolute top-3 right-3 bg-white/90 rounded-full p-2 shadow-lg hover:bg-red-500 hover:text-white transition-all duration-200 z-10 text-xl font-bold">✕</button>
            </div>
            <div class="text-center text-white text-xl font-bold mt-4" id="modalUniversalTitle"></div>
        </div>
    </div>

    <div id="modal-produk" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden"
        onclick="tutupModalProduk()">
        <div class="bg-white rounded-xl max-w-lg w-full mx-4 relative shadow-2xl overflow-hidden"
            onclick="event.stopPropagation()">

            <button onclick="tutupModalProduk()"
                class="absolute top-2 right-2 bg-gray-200/80 rounded-full p-1.5 hover:bg-red-500 hover:text-white transition-all text-xl font-bold z-10">
                <svg class="w-6 h-6 text-gray-700 hover:text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="md:flex md:h-96">
                <div class="md:w-1/2 p-4 flex items-center justify-center bg-gray-50 border-r border-gray-100">
                    <img id="modal-img" src="" alt="Produk"
                        class="w-full h-auto max-h-80 object-contain rounded-lg shadow-inner" />
                </div>

                <div class="md:w-1/2 p-6 flex flex-col justify-start">
                    <h3 id="modal-title" class="text-3xl font-bold text-gray-800 mb-1 leading-tight"></h3>
                    <p id="modal-desc" class="text-gray-500 text-sm mb-4"></p>

                    <p id="modal-price" class="text-xl font-extrabold text-primary-600 mb-6"></p>

                    <a id="chat-btn" href="#" target="_blank"
                        class="mt-auto block w-full text-center bg-green-500 text-white py-3 rounded-full font-semibold hover:bg-green-600 transition shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.04 2c-5.51 0-9.96 4.49-9.96 10.02 0 1.77.49 3.48 1.43 4.96L2.01 22l5.12-1.47c1.4.77 2.94 1.18 4.91 1.18 5.5 0 9.95-4.5 9.95-10.03C22 6.49 17.55 2 12.04 2zm3.32 12.98c-.2-.09-1.2-.47-1.39-.55-.18-.09-.32-.13-.45.14-.14.28-.54.67-.66.8-.13.14-.26.15-.49.07-.24-.07-1.02-.38-1.95-1.2-.72-.6-1.2-1.33-1.34-1.57-.14-.24 0-.37.1-.5.09-.12.21-.29.3-.43.09-.14.12-.24.18-.36.06-.11.03-.21-.01-.3-.04-.09-.45-1.08-.61-1.48-.16-.39-.32-.34-.45-.34-.12 0-.25-.01-.39-.01-.14 0-.37.04-.56.24-.19.2-.72.7-1.02 1.03-.3.33-.5.75-.8 1.1-.3.34-.6.76-.32 1.48.28.71.8 1.37 1.34 1.83.54.46 1.13.84 1.95 1.16 1.05.4 2.15.58 2.87.58.26 0 .44-.03.58-.06.31-.07.9-.37 1.03-.49.13-.12.23-.29.35-.43.12-.14.22-.24.32-.36.09-.12.18-.24.26-.37.08-.13.11-.27.11-.42 0-.17-.06-.3-.18-.4z" />
                            </svg>
                            Chat via WhatsApp
                        </span>
                    </a>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100">
                <h4 class="text-lg font-bold text-gray-800 mb-4">Rekomendasi Produk Serupa</h4>
                <div class="flex justify-around items-center space-x-2 overflow-x-auto">
                    <div class="flex-shrink-0 w-24 h-24 p-1 bg-white border rounded-lg shadow-sm">
                        <img src="LINK_URL_SPESIFIK_ANDA_13" class="w-full h-full object-contain" alt="Rekomendasi 1">
                    </div>
                    <div class="flex-shrink-0 w-24 h-24 p-1 bg-white border rounded-lg shadow-sm">
                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=160&h=160&q=80"
                            class="w-full h-full object-cover" alt="Rekomendasi 2">
                    </div>
                    <div class="flex-shrink-0 w-24 h-24 p-1 bg-white border rounded-lg shadow-sm">
                        <img src="LINK_URL_SPESIFIK_ANDA_14" class="w-full h-full object-contain" alt="Rekomendasi 3">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        // Hero Carousel Control (Tidak Berubah)
        (function () {
            const track = document.getElementById('heroTrack');
            const slides = track ? Array.from(track.querySelectorAll('.hero-slide')) : [];
            const indicators = document.getElementById('heroIndicators');
            let currentSlide = 0;
            const totalSlides = slides.length;
            let autoplayInterval;

            function updateSlidePosition() {
                if (track) {
                    track.style.transform = `translateX(-${currentSlide * 100}%)`;
                    updateIndicators();
                }
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlidePosition();
            }

            function goToSlide(index) {
                currentSlide = index;
                updateSlidePosition();
            }

            function updateIndicators() {
                if (!indicators) return;

                indicators.innerHTML = '';
                slides.forEach((_, index) => {
                    const dot = document.createElement('button');
                    dot.className = `w-3 h-3 rounded-full transition-all duration-300 ${index === currentSlide ? 'bg-white scale-110' : 'bg-white/50 hover:bg-white/75'
                        }`;
                    dot.addEventListener('click', () => {
                        goToSlide(index);
                        resetAutoplay();
                    });
                    indicators.appendChild(dot);
                });
            }

            function startAutoplay() {
                stopAutoplay();
                autoplayInterval = setInterval(nextSlide, 5000); // Slide setiap 5 detik
            }

            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            }

            function resetAutoplay() {
                stopAutoplay();
                startAutoplay();
            }

            // Initialize
            if (track && slides.length > 0) {
                updateSlidePosition();
                startAutoplay();

                // Pause on hover
                track.addEventListener('mouseenter', stopAutoplay);
                track.addEventListener('mouseleave', startAutoplay);
            }
        })();

        // ==============================================
        // LOGIKA FILTER DAN PAGINASI (Tidak Berubah)
        // ==============================================
        (function () {
            // --- KONSTANTA & VARIABEL GLOBAL ---
            const allCards = Array.from(document.querySelectorAll('.hairstyle-card'));
            const filterBtns = document.querySelectorAll(".filter-btn[data-category-type='main']");
            const itemContainer = document.getElementById('item-container');
            const controlsContainer = document.getElementById('pagination-controls');

            // Elemen Sub-kategori
            const subCategoryList = document.getElementById('subCategoryList');
            const subCategoryToggle = document.getElementById('subCategoryToggle');
            const subCategoryLabel = document.getElementById('subCategoryLabel');
            const subCategoryContainer = document.getElementById('subCategoryFilterContainer');
            const dropdownArrow = document.getElementById('dropdownArrow');

            let currentCategory = 'hairstyle';
            let currentSubCategory = 'all';
            const pageSize = 12;
            let currentPage = 1;

            // Definisi Sub-Kategori (Tetap sama)
            const subCategories = {
                'hairstyle': {
                    'all': 'Semua Hairstyle',
                    'rambut-panjang': 'Rambut Panjang',
                    'rambut-pendek': 'Rambut Pendek',
                    'warna-rambut': 'Pewarnaan',
                    'perawatan-rambut': 'Perawatan Khusus'
                },
                'nailart': {
                    'all': 'Semua Nail Art',
                    'gel-art': 'Gel Art',
                    'manicure': 'Manicure',
                    'pedicure': 'Pedicure'
                },
                'spa': {
                    'all': 'Semua Spa',
                    'pijat': 'Pijat',
                    'perawatan-wajah': 'Perawatan Wajah',
                    'perawatan-badan': 'Perawatan Badan'
                },
                'product': {
                    'all': 'Semua Produk',
                    'perawatan-rambut': 'Perawatan Rambut',
                    'perawatan-wajah': 'Perawatan Wajah',
                    'lain-lain': 'Lain-lain'
                }
            };


            // --- FUNGSI UTAMA ---
            function renderPage() {
                if (!allCards || !controlsContainer || !itemContainer) return;

                let visibleCards = allCards.filter(card => {
                    const cardCategory = card.dataset.category;
                    const cardSubCategory = card.dataset.subCategory || 'all';
                    const isMainMatch = cardCategory === currentCategory;
                    const isSubMatch = currentSubCategory === 'all' || cardSubCategory === currentSubCategory;
                    return isMainMatch && isSubMatch;
                });

                const totalItems = visibleCards.length;
                const totalPages = Math.max(1, Math.ceil(totalItems / pageSize));

                if (currentPage > totalPages) {
                    currentPage = totalPages;
                }
                if (currentPage < 1) {
                    currentPage = 1;
                }

                const start = (currentPage - 1) * pageSize;
                const end = start + pageSize;

                allCards.forEach(card => card.style.display = 'none');

                visibleCards.slice(start, end).forEach(card => {
                    card.style.display = 'block';
                });

                renderPaginationControls(totalPages);

                const container = document.getElementById('hairstyles');
                if (container && window.scrollY > container.offsetTop - 100) {
                    window.scrollTo({
                        top: container.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }

            function renderSubCategoryButtons() {
                const currentSubCats = subCategories[currentCategory] || {
                    'all': 'Pilih Sub-Kategori'
                };

                if (Object.keys(currentSubCats).length <= 1) {
                    subCategoryContainer.classList.add('hidden');
                } else {
                    subCategoryContainer.classList.remove('hidden');
                }

                subCategoryList.innerHTML = '';
                subCategoryList.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdownArrow.classList.remove('rotate-180');

                const defaultLabel = currentSubCats['all'] || 'Pilih Sub-Kategori';
                subCategoryLabel.textContent = defaultLabel;
                currentSubCategory = 'all';

                for (const key in currentSubCats) {
                    const name = currentSubCats[key];

                    const btn = document.createElement('button');
                    btn.className = `block w-full text-left px-4 py-2 text-sm md:text-base text-gray-700 hover:bg-primary-100 transition-colors duration-200`;
                    btn.textContent = name;
                    btn.setAttribute('data-sub-filter', key);

                    if (key === 'all') {
                        btn.classList.add('font-semibold', 'bg-primary-100', 'text-primary-600');
                    }

                    btn.addEventListener('click', function () {
                        currentSubCategory = key;
                        currentPage = 1;
                        subCategoryLabel.textContent = name;

                        document.querySelectorAll('#subCategoryList button').forEach(b => {
                            b.classList.remove('font-semibold', 'bg-primary-100', 'text-primary-600');
                        });
                        this.classList.add('font-semibold', 'bg-primary-100', 'text-primary-600');

                        subCategoryList.classList.add('opacity-0', 'invisible', 'scale-95');
                        dropdownArrow.classList.remove('rotate-180');
                        renderPage();
                    });

                    subCategoryList.appendChild(btn);
                }
            }

            function renderPaginationControls(totalPages) {
                if (!controlsContainer) return;

                controlsContainer.innerHTML = '';
                if (totalPages <= 1) return;

                const btnClass = 'flex items-center justify-center min-w-[2.5rem] w-10 h-10 mx-1 text-sm font-medium transition-colors duration-300 rounded-md';
                const defaultBtnClass = `${btnClass} text-gray-700 bg-white shadow-sm hover:bg-primary-500 hover:text-white`;
                const activeBtnClass = `${btnClass} text-white bg-primary-500 shadow-md`;
                const disabledBtnClass = `${btnClass} text-gray-400 bg-gray-100 cursor-not-allowed`;

                const prev = document.createElement('button');
                prev.className = currentPage === 1 ? disabledBtnClass : defaultBtnClass;
                prev.innerHTML = '‹ Prev';
                prev.style.width = 'auto';
                prev.style.minWidth = '80px';
                prev.disabled = currentPage === 1;
                prev.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        renderPage();
                    }
                });
                controlsContainer.appendChild(prev);

                const maxVisiblePages = window.innerWidth < 640 ? 5 : 7;
                let startPage = Math.max(2, currentPage - Math.floor(maxVisiblePages / 2) + 1);
                let endPage = Math.min(totalPages - 1, currentPage + Math.floor(maxVisiblePages / 2) - 1);

                if (currentPage <= Math.ceil(maxVisiblePages / 2)) {
                    endPage = Math.min(totalPages - 1, maxVisiblePages - 1);
                } else if (currentPage > totalPages - Math.ceil(maxVisiblePages / 2)) {
                    startPage = Math.max(2, totalPages - maxVisiblePages + 2);
                }

                startPage = Math.max(1, startPage);
                endPage = Math.min(totalPages, endPage);


                function addPageButton(pageNum) {
                    const btn = document.createElement('button');
                    btn.className = pageNum === currentPage ? activeBtnClass : defaultBtnClass;
                    btn.textContent = pageNum;
                    btn.addEventListener('click', () => {
                        currentPage = pageNum;
                        renderPage();
                    });
                    controlsContainer.appendChild(btn);
                }

                if (totalPages > 0) addPageButton(1);

                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = `${btnClass} text-gray-500 bg-transparent cursor-default`;
                    ellipsis.textContent = '...';
                    controlsContainer.appendChild(ellipsis);
                }

                for (let i = startPage; i <= endPage; i++) {
                    if (i > 1 && i < totalPages) {
                        addPageButton(i);
                    }
                }

                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = `${btnClass} text-gray-500 bg-transparent cursor-default`;
                    ellipsis.textContent = '...';
                    controlsContainer.appendChild(ellipsis);
                }

                if (totalPages > 1) addPageButton(totalPages);


                const next = document.createElement('button');
                next.className = currentPage === totalPages ? disabledBtnClass : defaultBtnClass;
                next.innerHTML = 'Next ›';
                next.style.width = 'auto';
                next.style.minWidth = '80px';
                next.disabled = currentPage === totalPages;
                next.addEventListener('click', () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        renderPage();
                    }
                });
                controlsContainer.appendChild(next);
            }

            // --- EVENT LISTENERS ---
            filterBtns.forEach(btn => {
                btn.addEventListener("click", function () {
                    const newFilter = this.getAttribute("data-filter");
                    if (!newFilter) return;

                    filterBtns.forEach(b => {
                        b.classList.remove("active");
                    });
                    this.classList.add("active");

                    currentCategory = newFilter;
                    currentPage = 1;
                    currentSubCategory = 'all';

                    renderSubCategoryButtons();
                    renderPage();
                });
            });

            subCategoryToggle.addEventListener('click', function () {
                const isHidden = subCategoryList.classList.contains('invisible');

                if (isHidden) {
                    subCategoryList.classList.remove('opacity-0', 'invisible', 'scale-95');
                    dropdownArrow.classList.add('rotate-180');
                } else {
                    subCategoryList.classList.add('opacity-0', 'invisible', 'scale-95');
                    dropdownArrow.classList.remove('rotate-180');
                }
            });

            document.addEventListener('click', function (event) {
                const isClickInside = subCategoryContainer.contains(event.target);
                if (!isClickInside && !subCategoryList.classList.contains('invisible')) {
                    subCategoryList.classList.add('opacity-0', 'invisible', 'scale-95');
                    dropdownArrow.classList.remove('rotate-180');
                }
            });

            // --- INISIALISASI ---
            document.addEventListener('DOMContentLoaded', () => {
                const defaultBtn = document.querySelector(`.filter-btn[data-filter="${currentCategory}"]`);
                if (defaultBtn) {
                    filterBtns.forEach(b => b.classList.remove("active"));
                    defaultBtn.classList.add("active");
                }

                renderSubCategoryButtons();
                renderPage();
            });
        })();

        // --- Modal Functions --- (Perubahan pada bukaModalProduk untuk menerima data penjual/deskripsi singkat)
        function bukaModalUniversal(img, title) {
            document.getElementById("modalUniversalImg").src = img;
            document.getElementById("modalUniversalTitle").innerText = title;
            document.getElementById("modalUniversal").classList.remove("hidden");
        }

        function tutupModalUniversal() {
            document.getElementById("modalUniversal").classList.add("hidden");
        }

        function bukaModalProduk(img, title, desc, price) {
            document.getElementById("modal-img").src = img;
            document.getElementById("modal-title").textContent = title;
            // 'desc' di sini digunakan untuk menampilkan nama penjual/deskripsi singkat
            document.getElementById("modal-desc").textContent = desc;
            document.getElementById("modal-price").textContent = price;

            const nomorWA = "6281572505989";
            const pesan = `Halo, saya tertarik dengan produk ${title} seharga ${price} dari ${desc}. Bisa jelaskan lebih lanjut?`;
            document.getElementById("chat-btn").href = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;

            document.getElementById("modal-produk").classList.remove("hidden");
        }

        function tutupModalProduk() {
            document.getElementById("modal-produk").classList.add("hidden");
        }

        const modalProduk = document.getElementById("modal-produk");
        modalProduk.addEventListener('click', function (event) {
            if (event.target === modalProduk) {
                tutupModalProduk();
            }
        });
    </script>

    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'salon',
    ])
</body>
</html>
