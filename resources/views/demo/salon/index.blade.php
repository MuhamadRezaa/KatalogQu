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


    <!-- Hairstyles Section -->
    <section id="hairstyles" class="py-24 bg-gradient-to-br from-pink-100 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h4 class="text-4xl md:text-5xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                    style="font-family: 'Freestyle Script', cursive">
                    Layanan
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
                    class="filter-btn active text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="hairstyle">HairStyle</button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="nailart">Nail Art</button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="spa">Spa</button>
                <button
                    class="filter-btn text-xs md:text-base px-4 py-2 rounded-full border border-primary-500 text-primary-600"
                    data-filter="product">Product</button>
            </div>

            <!-- Hairstyles Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Hairstyle Example -->
                <div class="hairstyle-card group" data-category="hairstyle">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalUniversal('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80','Gaya Rambut Panjang Wave')">
                            👁
                        </span>
                        <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                            alt="Gaya Rambut Panjang Wave"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Gaya Rambut Panjang Wave</h3>
                                <p class="text-sm opacity-90">Rambut panjang dengan wave natural yang romantis
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 200.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hairstyle Example -->
                <div class="hairstyle-card group" data-category="hairstyle">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalUniversal('https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80','Gaya Rambut Panjang Wave')">
                            👁
                        </span>
                        <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&w=800&q=80"
                            alt="Gaya Rambut Panjang Wave"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Gaya Rambut Panjang Wave</h3>
                                <p class="text-sm opacity-90">Rambut panjang dengan wave natural yang romantis
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 200.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nail Art Example -->
                <div class="hairstyle-card group" data-category="nailart">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalUniversal('https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80','Nail Art Glitter Pink')">👁</span>
                        <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=800&q=80"
                            alt="Nail Art Glitter Pink"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Nail Art Glitter Pink</h3>
                                <p class="text-sm opacity-90">
                                    Desain kuku cantik dengan glitter pink elegan
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 120.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spa Example -->
                <div class="hairstyle-card group" data-category="spa">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalUniversal('https://images.unsplash.com/photo-1556228720-195a672e1c90?auto=format&fit=crop&w=800&q=80','Spa Relaksasi Aromaterapi')">👁</span>
                        <img src="https://images.unsplash.com/photo-1556228720-195a672e1c90?auto=format&fit=crop&w=800&q=80"
                            alt="Spa Relaksasi Aromaterapi"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">
                                    Spa Relaksasi Aromaterapi
                                </h3>
                                <p class="text-sm opacity-90">
                                    Perawatan tubuh dengan pijat aromaterapi menenangkan
                                </p>
                                <p class="text-xs mt-1 opacity-75">Rp 250.000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Example -->
                <div class="hairstyle-card group" data-category="product">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                        <span
                            class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-primary-500 hover:text-white transition-colors cursor-pointer"
                            onclick="bukaModalProduk('https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80','Shampoo Keratin','Shampoo perawatan rambut untuk kilau alami','Rp 150.000')">
                            🛒
                        </span>
                        <img src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=800&q=80"
                            alt="Shampoo Keratin"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                        <div class="hairstyle-overlay">
                            <div class="text-white">
                                <h3 class="text-xl font-bold mb-2">Shampoo Keratin</h3>
                                <p class="text-sm opacity-90">Perawatan rambut profesional</p>
                                <p class="text-xs mt-1 opacity-75">Rp 150.000</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <p>✉ info@glamoursalon.com</p>
                    </div>
                </div>
            </div>

            <div class="text-center pt-4 border-t border-gray-700">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Glamour Salon. Powered by PT. Era Cipta Digital
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

        document.addEventListener("DOMContentLoaded", function() {
            const filterButtons = document.querySelectorAll(".filter-btn");
            const cards = document.querySelectorAll(".hairstyle-card");

            // Default tampil hanya hairstyle
            cards.forEach(card => {
                if (card.dataset.category !== "hairstyle") {
                    card.style.display = "none";
                }
            });

            // Event klik filter
            filterButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    const filter = btn.getAttribute("data-filter");

                    // ganti tombol active
                    filterButtons.forEach(b => b.classList.remove("bg-pink-500", "text-white"));
                    btn.classList.add("bg-pink-500", "text-white");

                    // tampilkan/ sembunyikan card
                    cards.forEach(card => {
                        if (filter === "all" || card.dataset.category === filter) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            });
        });

        // Modal Functions
        // Universal Modal (Hairstyle, Nail Art, Spa)
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
            document.getElementById("modal-desc").textContent = desc;
            document.getElementById("modal-price").textContent = price;

            // Ubah link WhatsApp sesuai produk
            const nomorWA = "6281234567890"; // ganti dengan nomor kamu
            const pesan = `Halo, saya tertarik dengan produk ${title} seharga ${price}. Bisa jelaskan lebih lanjut?`;
            document.getElementById("chat-btn").href = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;

            document.getElementById("modal-produk").classList.remove("hidden");
        }

        function tutupModalProduk() {
            document.getElementById("modal-produk").classList.add("hidden");
        }
    </script>

    <!-- MODAL UNIVERSAL (Hairstyle, Nail Art, Spa) -->
    <div id="modalUniversal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl w-full mx-4">
            <div class="relative inline-block">
                <img id="modalUniversalImg" src="" alt="Preview"
                    class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-lg" />
                <button onclick="tutupModalUniversal()"
                    class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-lg hover:bg-red-500 hover:text-white transition-all duration-200 z-10">✕</button>
            </div>
            <div class="text-center text-white text-lg font-semibold mt-4" id="modalUniversalTitle"></div>
        </div>
    </div>

    <!-- MODAL PRODUK -->
    <!-- MODAL PRODUK -->
    <div id="modal-produk" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full relative">
            <button onclick="tutupModalProduk()"
                class="absolute top-3 right-3 bg-gray-200 rounded-full p-2 hover:bg-red-500 hover:text-white transition-all">✕</button>

            <img id="modal-img" src="" alt="Produk" class="w-full h-56 object-cover rounded-lg mb-4" />
            <h3 id="modal-title" class="text-xl font-bold mb-2"></h3>
            <p id="modal-desc" class="text-gray-600 mb-2"></p>
            <p id="modal-price" class="text-pink-600 font-semibold text-lg"></p>

            <!-- Tombol Chat -->
            <a id="chat-btn" href="#" target="_blank"
                class="mt-4 block w-full text-center bg-green-500 text-white py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                💬 Chat via WhatsApp
            </a>
        </div>
    </div>



    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'salon',
    ])
</body>

</html>
