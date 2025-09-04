<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Glamour Salon - Pengalaman Kecantikan Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Cross-Browser CSS Reset */
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
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

        /* Cross-Browser Flexbox */
        .flex {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }

        .justify-center {
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .items-center {
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
        }

        /* Cross-Browser Grid */
        .grid {
            display: -ms-grid;
            display: grid;
        }

        .grid-cols-6 {
            grid-template-columns: repeat(6, 1fr);
            -ms-grid-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        }

        /* Container Max Width */
        .max-w-7xl {
            max-width: min(80rem, 95vw);
            margin-left: auto;
            margin-right: auto;
        }

        /* Text Scale Fix */
        .text-4xl,
        .text-5xl {
            font-size: 2.25rem;
            font-size: clamp(1.5rem, 4vw, 3rem);
        }

        .text-xl {
            font-size: 1.25rem;
            font-size: clamp(1rem, 3vw, 1.25rem);
        }

        /* Filter Buttons Cross-Browser Fix */
        .filter-btn {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            border: 1px solid #ec4899;
            background: transparent;
            color: #ec4899;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
            text-align: center;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background-color: #ec4899 !important;
            color: white !important;
        }

        /* Responsive Breakpoints */
        @media (max-width: 640px) {
            html {
                font-size: 14px;
            }

            .grid-cols-6 {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.5rem;
            }
        }

        @media (min-width: 768px) {
            .grid-cols-6 {
                grid-template-columns: repeat(6, 1fr);
            }
        }

        @media (min-width: 1440px) {
            html {
                font-size: 16px;
            }
        }

        /* Edge Specific Fixes */
        @supports (-ms-ime-align: auto) {
            .grid {
                display: -ms-grid;
            }

            .flex {
                display: -ms-flexbox;
            }
        }

        html {
            scroll-behavior: smooth;
        }

        /* Slideshow Background */
        .bg-slideshow {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            animation: slideshow 18s infinite;
        }

        @keyframes slideshow {
            0% {
                background-image: url("https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1600&q=80");
            }

            33% {
                background-image: url("https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1600&q=80");
            }

            66% {
                background-image: url("https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=1600&q=80");
            }

            100% {
                background-image: url("https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1600&q=80");
            }
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
    </style>
    <script>
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
                    animation: {
                        "fade-in": "fadeIn 0.6s ease-out",
                        "slide-in": "slideIn 0.8s ease-out",
                        "bounce-in": "bounceIn 0.6s ease-out",
                        float: "float 6s ease-in-out infinite",
                        "pulse-glow": "pulseGlow 2s ease-in-out infinite",
                        shimmer: "shimmer 2s linear infinite",
                    },
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

<body class="bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 min-h-screen overflow-x-hidden">
    <!-- Navigasi -->
    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-gray-200-to-b from-[#1a2333] to-[#0f1624]"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <!-- Icon bulat -->
                    <div
                        class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center shadow-md transform group-hover:scale-110 transition duration-300">
                        <span class="text-white font-bold text-lg">G</span>
                    </div>
                    <!-- Teks -->
                    <span class="text-3xl md:text-4xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                        style="font-family: 'Freestyle Script', cursive">
                        Glamour Salon
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- HOME PAGE -->
    <div id="home-page" class="page-section active">
        <!-- Hero Section -->
        <section class="hero-gradient min-h-[55vh] flex items-center pt-8 relative overflow-hidden">
            <!-- Background Slideshow -->
            <div class="absolute inset-0">
                <div class="bg-slideshow"></div>
            </div>
            <!-- Overlay agar teks tetap jelas -->
            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="fade-in-up text-white">
                        <h1 class="text-4xl md:text-6xl font-bold mb-6">
                            Wujudkan
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-purple-500">
                                Kecantikan
                            </span>
                            Impian Anda
                        </h1>
                        <p class="text-lg md:text-xl mb-8 leading-relaxed">
                            Rasakan pengalaman salon premium dengan layanan tata rambut,
                            perawatan wajah, nail art, dan spa yang akan membuat Anda tampil
                            percaya diri dan memukau.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Layanan Salon Section -->
    <section id="layanan" class="py-24 bg-gradient-to-br from-pink-50 via-white to-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-4xl md:text-5xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                    style="font-family: 'Freestyle Script', cursive">
                    Layanan Salon Kami
                </h4>
                <br />
                <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
                    Pilih layanan terbaik dari kami dan rasakan pengalaman salon yang
                    memanjakan diri Anda dengan profesional.
                </p>
            </div>

            <!-- Grid Layanan -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Hairstyle -->
                <div
                    class="relative group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=600&q=80"
                        alt="Hairstyle"
                        class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center text-white opacity-0 group-hover:opacity-100 transition duration-500">
                        <h3 class="text-3xl font-bold mb-3">Hairstyle</h3>
                        <a href="#hairstyles"
                            class="inline-block px-6 py-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-full font-semibold shadow hover:opacity-90 transition">
                            Lihat Layanan
                        </a>
                    </div>
                </div>

                <!-- Nail Art -->
                <div
                    class="relative group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=600&q=80"
                        alt="Nail Art"
                        class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center text-white opacity-0 group-hover:opacity-100 transition duration-500">
                        <h3 class="text-3xl font-bold mb-3">Nail Art</h3>
                        <a href="#nailart"
                            class="inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-full font-semibold shadow hover:opacity-90 transition">
                            Lihat Layanan
                        </a>
                    </div>
                </div>

                <!-- Spa -->
                <div
                    class="relative group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=600&q=80"
                        alt="Spa"
                        class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center text-white opacity-0 group-hover:opacity-100 transition duration-500">
                        <h3 class="text-3xl font-bold mb-3">Spa & Relaksasi</h3>
                        <a href="#spa"
                            class="inline-block px-6 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full font-semibold shadow hover:opacity-90 transition">
                            Lihat Layanan
                        </a>
                    </div>
                </div>

                <!-- Products -->
                <div
                    class="relative group rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                    <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=600&q=80"
                        alt="Products"
                        class="w-full h-96 object-cover group-hover:scale-110 transition-transform duration-700" />
                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center text-white opacity-0 group-hover:opacity-100 transition duration-500">
                        <h3 class="text-3xl font-bold mb-3">Beauty Products</h3>
                        <a href="#products"
                            class="inline-block px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full font-semibold shadow hover:opacity-90 transition">
                            Lihat Layanan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section List Layanan Salon -->
            <div
                style="
            background: #ffffff;
            padding: 40px 20px;
            margin-top: 40px;
            border-radius: 20px;
          ">
                <h1 style="text-align: center; margin-bottom: 30px; color: #d63384">
                    ✨ Layanan & Harga Salon ✨
                </h1>

                <div
                    style="
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
              gap: 30px;
            ">
                    <!-- List Services -->
                    <div
                        style="
                border: 2px solid #f8d7e5;
                padding: 20px;
                width: 350px;
                background: rgba(255, 240, 245, 0.8);
                border-radius: 10px;
              ">
                        <h2
                            style="
                  text-align: center;
                  border-bottom: 2px solid #f8d7e5;
                  padding-bottom: 10px;
                  color: #d63384;
                ">
                            Daftar Layanan
                        </h2>
                        <ul
                            style="
                  list-style: none;
                  padding: 0;
                  margin: 20px 0 0 0;
                  font-size: 16px;
                  color: #333;
                ">
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Haircut</span><span>100k - 250k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Smoothing / Rebonding</span><span>400k - 800k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Hair Coloring</span><span>350k - 1.000k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Hair Spa</span><span>150k - 250k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Hair Mask</span><span>150k - 250k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Hairdo / Styling</span><span>100k - 200k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Pijat Relaksasi</span><span>100k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Refleksi Kaki</span><span>120k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Nail Art</span><span>80k - 200k</span>
                            </li>
                            <li
                                style="
                    display: flex;
                    justify-content: space-between;
                    margin: 10px 0;
                  ">
                                <span>Cukur Alis</span><span>30k</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hairstyles Section -->
    <section id="hairstyles" class="py-24 bg-gradient-to-br from-pink-100 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-4xl md:text-5xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                    style="font-family: 'Freestyle Script', cursive">
                    Hairstyle
                </h4>
                <br />
                <p class="text-xl text-black max-w-3xl mx-auto font-medium leading-relaxed">
                    Temukan gaya rambut yang sempurna untuk Anda. Dari potongan modern
                    hingga klasik, kami memiliki berbagai pilihan yang akan membuat Anda
                    terlihat menakjubkan.
                </p>
            </div>

            <!-- Filter Buttons -->
            <div class="grid grid-cols-4 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-12 max-w-3xl mx-auto">
                <button
                    class="filter-btn active text-xs md:text-base px-4 py-2 rounded-full font-bold bg-primary-500 text-white"
                    data-filter="all">
                    Semua
                </button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="panjang">
                    Panjang
                </button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="pendek">
                    Pendek
                </button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="lurus">
                    Lurus
                </button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="keriting">
                    Keriting
                </button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="pewarnaan">
                    Pewarnaan
                </button>
            </div>

            <!-- Hairstyles Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Hairstyle 1 -->
                <div class="hairstyle-card group" data-category="panjang">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80', 'Gaya Rambut Panjang Wave')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                            alt="Gaya Rambut Panjang Wave"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">
                                    Gaya Rambut Panjang Wave
                                </h3>
                                <p class="text-sm opacity-90">
                                    Rambut panjang dengan wave natural yang romantis
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 2 -->
                <div class="hairstyle-card group" data-category="panjang">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80', 'Gaya Rambut Panjang Lurus')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80"
                            alt="Gaya Rambut Panjang Lurus"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">
                                    Gaya Rambut Panjang Lurus
                                </h3>
                                <p class="text-sm opacity-90">
                                    Rambut panjang lurus yang elegan dan modern
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 3 -->
                <div class="hairstyle-card group" data-category="keriting">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80', 'Gaya Rambut Keriting Natural')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80"
                            alt="Gaya Rambut Keriting Natural"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">
                                    Gaya Rambut Keriting Natural
                                </h3>
                                <p class="text-sm opacity-90">
                                    Keriting alami yang memberikan volume maksimal
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 4 -->
                <div class="hairstyle-card group" data-category="pendek">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1560264357-8d9202250f21?auto=format&fit=crop&w=800&q=80', 'Bob Cut Modern')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1560264357-8d9202250f21?auto=format&fit=crop&w=800&q=80"
                            alt="Bob Cut Modern"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Bob Cut Modern</h3>
                                <p class="text-sm opacity-90">
                                    Potongan bob yang trendy dan praktis
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 5 -->
                <div class="hairstyle-card group" data-category="pewarnaan">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80', 'Highlight Blonde')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80"
                            alt="Highlight Blonde"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Highlight Blonde</h3>
                                <p class="text-sm opacity-90">
                                    Pewarnaan highlight blonde yang cantik
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 6 -->
                <div class="hairstyle-card group" data-category="lurus">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=800&q=80', 'Straight Hair Classic')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=800&q=80"
                            alt="Straight Hair Classic"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Straight Hair Classic</h3>
                                <p class="text-sm opacity-90">
                                    Rambut lurus klasik yang selalu in style
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 7 -->
                <div class="hairstyle-card group" data-category="pendek">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1574015974293-817f0ebebb74?auto=format&fit=crop&w=800&q=80', 'Pixie Cut Stylish')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1574015974293-817f0ebebb74?auto=format&fit=crop&w=800&q=80"
                            alt="Pixie Cut Stylish"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Pixie Cut Stylish</h3>
                                <p class="text-sm opacity-90">
                                    Potongan pixie yang berani dan stylish
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle 8 -->
                <div class="hairstyle-card group" data-category="pewarnaan">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalHairstyle('https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?auto=format&fit=crop&w=800&q=80', 'Ombre Hair Color')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?auto=format&fit=crop&w=800&q=80"
                            alt="Ombre Hair Color"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Ombre Hair Color</h3>
                                <p class="text-sm opacity-90">
                                    Gradasi warna ombre yang stunning
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nail Art Section -->
    <section id="nailart" class="py-24 bg-gradient-to-br from-purple-100 via-white to-pink-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-4xl md:text-5xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                    style="font-family: 'Freestyle Script', cursive">
                    Nail Art Gallery
                </h4>
                <br />
                <p class="text-xl text-black max-w-3xl mx-auto font-medium leading-relaxed">
                    Ekspresikan kepribadian Anda dengan desain nail art yang unik dan
                    menawan. Dari desain minimalis hingga yang kompleks, kami siap
                    mewujudkan keinginan Anda.
                </p>
            </div>

            <!-- Nail Art Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Nail Art 1 -->
                <div class="nailart-card group" data-category="glitter">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalNailart('https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=80', 'Glitter Sparkle')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=80"
                            alt="Glitter Sparkle"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Glitter Sparkle</h3>
                                <p class="text-sm opacity-90">
                                    Nail art dengan kilauan glitter yang memukau
                                </p>
                                <p class="text-xs mt-1 opacity-75">Glitter</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nail Art 2 -->
                <div class="nailart-card group" data-category="french">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalNailart('https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?auto=format&fit=crop&w=800&q=80', 'French Manicure')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?auto=format&fit=crop&w=800&q=80"
                            alt="French Manicure"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">French Manicure</h3>
                                <p class="text-sm opacity-90">
                                    French manicure klasik yang elegan
                                </p>
                                <p class="text-xs mt-1 opacity-75">Classic</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nail Art 3 -->
                <div class="nailart-card group" data-category="classic">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalNailart('https://images.unsplash.com/photo-1522338242992-e1a54906a8da?auto=format&fit=crop&w=800&q=80', 'Nude Elegance')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1522338242992-e1a54906a8da?auto=format&fit=crop&w=800&q=80"
                            alt="Nude Elegance"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Nude Elegance</h3>
                                <p class="text-sm opacity-90">
                                    Warna nude yang sopan dan elegan
                                </p>
                                <p class="text-xs mt-1 opacity-75">Classic</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nail Art 4 -->
                <div class="nailart-card group" data-category="floral">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalNailart('https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?auto=format&fit=crop&w=800&q=80', 'Cherry Blossom')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1584464491033-06628f3a6b7b?auto=format&fit=crop&w=800&q=80"
                            alt="Cherry Blossom"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Cherry Blossom</h3>
                                <p class="text-sm opacity-90">
                                    Desain bunga sakura yang romantis
                                </p>
                                <p class="text-xs mt-1 opacity-75">Floral</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nail Art 5 -->
                <div class="nailart-card group" data-category="artistic">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalNailart('https://images.unsplash.com/photo-1583516801810-4e9094680a5c?auto=format&fit=crop&w=800&q=80', 'Abstract Art')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1583516801810-4e9094680a5c?auto=format&fit=crop&w=800&q=80"
                            alt="Abstract Art"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Abstract Art</h3>
                                <p class="text-sm opacity-90">
                                    Seni abstrak yang unik dan kreatif
                                </p>
                                <p class="text-xs mt-1 opacity-75">Artistic</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nail Art 6 -->
                <div class="nailart-card group" data-category="ombre">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalNailart('https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80', 'Sunset Ombre')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" />
                            </svg>
                        </span>
                        <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80"
                            alt="Sunset Ombre"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Sunset Ombre</h3>
                                <p class="text-sm opacity-90">
                                    Gradasi warna layaknya sunset
                                </p>
                                <p class="text-xs mt-1 opacity-75">Ombre</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Nail Art Details -->
            <div id="modal-nailart" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
                <div class="relative max-w-4xl w-full mx-4">
                    <div class="relative inline-block">
                        <img id="modal-nailart-img" src="" alt="Nail Art"
                            class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-lg" />
                        <button onclick="tutupModalNailart()"
                            class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-lg hover:bg-red-500 hover:text-white transition-all duration-200 z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-center text-white text-lg font-semibold mt-4" id="modal-nailart-title"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Spa Section -->
    <section id="spa" class="py-24 bg-gradient-to-br from-blue-50 via-white to-cyan-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-4xl md:text-5xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                    style="font-family: 'Freestyle Script', cursive">
                    Spa & Wellness
                </h4>
                <br />
                <p class="text-xl text-black max-w-3xl mx-auto font-medium leading-relaxed">
                    Rasakan ketenangan dan kenyamanan dengan perawatan tubuh menyegarkan
                    di spa kami.
                </p>
            </div>

            <!-- Spa Services Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Spa Service 1 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=600&q=80"
                            alt="Hot Stone Massage"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Hot Stone Massage</h3>
                                <p class="text-sm opacity-90">
                                    Pijat dengan batu panas untuk relaksasi total
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 200.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 2 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=600&q=80"
                            alt="Aromatherapy"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Aromatherapy</h3>
                                <p class="text-sm opacity-90">
                                    Terapi aroma untuk menenangkan pikiran
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 150.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 3 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1591343395082-e120087004b4?auto=format&fit=crop&w=600&q=80"
                            alt="Deep Tissue Massage"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Deep Tissue Massage</h3>
                                <p class="text-sm opacity-90">
                                    Pijat dalam untuk melepas ketegangan otot
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 250.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 4 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1552084117-56a987666449?auto=format&fit=crop&w=600&q=80"
                            alt="Body Scrub"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Body Scrub</h3>
                                <p class="text-sm opacity-90">
                                    Peeling alami untuk kulit halus
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 180.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 5 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1560750588-73207b1ef5b8?auto=format&fit=crop&w=600&q=80"
                            alt="Facial Treatment"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Facial Treatment</h3>
                                <p class="text-sm opacity-90">
                                    Perawatan wajah untuk kulit cerah
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 120.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 6 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=600&q=80"
                            alt="Foot Reflexology"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Foot Reflexology</h3>
                                <p class="text-sm opacity-90">
                                    Pijat refleksi kaki untuk kesehatan
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 100.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 7 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?auto=format&fit=crop&w=600&q=80"
                            alt="Hair Spa Treatment"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Hair Spa Treatment</h3>
                                <p class="text-sm opacity-90">
                                    Perawatan rambut dengan nutrisi lengkap
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 220.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Service 8 -->
                <div class="group">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1596178065887-1198b6148b2b?auto=format&fit=crop&w=600&q=80"
                            alt="Swedish Massage"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <h3 class="text-lg font-bold mb-1">Swedish Massage</h3>
                                <p class="text-sm opacity-90">
                                    Pijat Swedia untuk relaksasi maksimal
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 300.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products"
        class="py-24 relative bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-4xl md:text-5xl font-normal tracking-wide text-black drop-shadow-md"
                    style="font-family: 'Freestyle Script', cursive">
                    Produk Salon kami
                </h4>
                <br />
                <p class="text-xl text-black max-w-3xl mx-auto font-medium leading-relaxed">
                    Temukan Produk yang anda cari Dari Salon kami.Rawat rambutmu dengan
                    produk premium yang aman dan berkualitas.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div
                    class="bg-white rounded-3xl p-4 flex flex-col shadow-lg hover:shadow-2xl transition-all duration-300 group relative h-full">
                    <div>
                        <div class="aspect-square w-full overflow-hidden mb-2">
                            <img src="images/products/product-1.jpg" alt="Shampoo Premium"
                                class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-300"
                                onerror="this.src='https://images.unsplash.com/photo-1556228720-195a672e8a03?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'" />
                        </div>
                        <h3 class="text-base md:text-xl font-bold text-gray-800 mb-1">
                            Shampoo Premium
                        </h3>
                        <span class="text-lg md:text-2xl font-bold text-primary-600 block mb-0">
                            Rp 150.000
                        </span>
                    </div>
                    <div class="flex-1 flex flex-col justify-end">
                        <button
                            class="bg-primary-600 text-white text-xs px-3 py-1.5 rounded-full hover:bg-primary-700 transition-colors md:text-base md:px-4 md:py-2 self-end mt-4"
                            onclick="bukaModalProduk('https://images.unsplash.com/photo-1556228720-195a672e8a03?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80','Shampoo Premium','Shampoo dengan formula khusus untuk rambut sehat dan berkilau', 'Rp 150.000')">
                            Detail
                        </button>
                    </div>
                </div>

                <!-- Additional products... -->
                <!-- (Previous product cards remain the same) -->
            </div>
        </div>

        <!-- Product Modal -->
        <div id="modal-produk" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
            <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl relative">
                <button onclick="tutupModalProduk()"
                    class="absolute top-3 right-3 text-gray-400 hover:text-primary-600 text-2xl">
                    &times;
                </button>
                <img id="modal-img" src="" alt=""
                    class="w-full h-48 object-cover rounded-xl mb-4" />
                <h3 id="modal-title" class="text-xl font-bold mb-2"></h3>
                <p id="modal-desc" class="text-gray-600 mb-4"></p>
                <span id="modal-price" class="block text-lg font-bold text-primary-600 mb-4"></span>
                <button onclick="tutupModalProduk()"
                    class="bg-primary-600 text-white px-4 py-2 rounded-full hover:bg-primary-700 w-full">
                    Tutup
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
                    <h3 class="text-lg font-bold mb-2">Kontak</h3>
                    <div class="space-y-1 text-sm text-gray-300">
                        <p>📍 Jl. Setiabudi No. 17</p>
                        <p>📞 (021) 555-0123</p>
                        <p>✉️ info@glamoursalon.com</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-2">Jam Operasional</h3>
                    <div class="space-y-1 text-sm text-gray-300">
                        <p>Senin - Jumat: 09:00 - 21:00</p>
                        <p>Sabtu - Minggu: 08:00 - 22:00</p>
                    </div>
                </div>
            </div>

            <div class="text-center pt-4 border-t border-gray-700">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Glamour Salon. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        console.log("🎨 Starting Salon Website...");

        document.addEventListener("DOMContentLoaded", function() {
            console.log("✅ DOM Content Loaded");

            // Navbar blur on scroll
            const navbar = document.getElementById("navbar");
            window.addEventListener("scroll", function() {
                if (navbar) {
                    if (window.scrollY > 50) {
                        navbar.classList.add("navbar-scrolled");
                    } else {
                        navbar.classList.remove("navbar-scrolled");
                    }
                }
            });

            // Hairstyle Filter
            const filterBtns = document.querySelectorAll(".filter-btn");
            const hairstyleCards = document.querySelectorAll(".hairstyle-card");

            filterBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    // Remove active class from all buttons
                    filterBtns.forEach((b) => {
                        b.classList.remove("active", "bg-primary-500", "text-white");
                        b.classList.add(
                            "border",
                            "border-primary-500",
                            "text-primary-600"
                        );
                    });

                    // Add active class to clicked button
                    btn.classList.remove(
                        "border",
                        "border-primary-500",
                        "text-primary-600"
                    );
                    btn.classList.add("active", "bg-primary-500", "text-white");

                    const filter = btn.getAttribute("data-filter");

                    hairstyleCards.forEach((card) => {
                        if (filter === "all") {
                            card.style.display = "block";
                        } else {
                            const categories = card.getAttribute("data-category");
                            if (categories && categories.includes(filter)) {
                                card.style.display = "block";
                            } else {
                                card.style.display = "none";
                            }
                        }
                    });
                });
            });

            console.log("✅ Salon Website Ready!");
        });

        // Modal Functions
        function bukaModalHairstyle(imageSrc, title) {
            document.getElementById("modalImageHairstyle").src = imageSrc;
            document.getElementById("modalTitleHairstyle").innerText = title;
            document.getElementById("modalHairstyle").classList.remove("hidden");
        }

        function tutupModalHairstyle() {
            document.getElementById("modalHairstyle").classList.add("hidden");
        }

        function bukaModalNailart(imageSrc, title) {
            document.getElementById("modal-nailart-img").src = imageSrc;
            document.getElementById("modal-nailart-title").innerText = title;
            document.getElementById("modal-nailart").classList.remove("hidden");
        }

        function tutupModalNailart() {
            document.getElementById("modal-nailart").classList.add("hidden");
        }

        function bukaModalProduk(img, title, desc, price) {
            document.getElementById("modal-img").src = img;
            document.getElementById("modal-title").textContent = title;
            document.getElementById("modal-desc").textContent = desc;
            document.getElementById("modal-price").textContent = price;
            document.getElementById("modal-produk").classList.remove("hidden");
        }

        function tutupModalProduk() {
            document.getElementById("modal-produk").classList.add("hidden");
        }
    </script>

    <!-- MODAL Hairstyle -->
    <div id="modalHairstyle" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl w-full mx-4">
            <div class="relative inline-block">
                <img id="modalImageHairstyle" src="" alt="Hairstyle"
                    class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-lg" />
                <button onclick="tutupModalHairstyle()"
                    class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-lg hover:bg-red-500 hover:text-white transition-all duration-200 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="text-center text-white text-lg font-semibold mt-4" id="modalTitleHairstyle"></div>
        </div>
    </div>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'salon',
    ])
</body>

</html>
