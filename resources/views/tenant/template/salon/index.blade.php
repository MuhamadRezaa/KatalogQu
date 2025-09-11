<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ $userStore->store_logo ? asset('storage/' . $userStore->store_logo) : '' }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-gray-200-to-b from-[#1a2333] to-[#0f1624]"
        id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-3 group">
                    @if ($userStore->store_logo)
                        <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="{{ $userStore->store_name }}"
                            class="w-10 h-10 rounded-full object-cover shadow-md">
                    @else
                        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-lg">{{ substr($userStore->store_name, 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-3xl md:text-4xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                        style="font-family: 'Freestyle Script', cursive;">
                        {{ $userStore->store_name }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <section class="h-[60vh] md:h-[70vh] w-full pt-16 relative">
        <div class="swiper-container h-full">
            <div class="swiper-wrapper">
                @forelse ($banners as $banner)
                    <div class="swiper-slide relative">
                        <img src="{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                            alt="{{ $banner->title }}" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-4">
                            <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $banner->title }}</h1>
                            <p class="text-md md:text-xl max-w-2xl">{{ $banner->subtitle }}</p>
                            @if ($banner->link)
                                <a href="{{ $banner->link }}"
                                    class="mt-6 bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded-full transition-colors">
                                    {{ $banner->button_text ?? 'Lihat Penawaran' }}
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide relative bg-pink-200">
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4 bg-black/40">
                            <h1 class="text-3xl md:text-5xl font-bold mb-4">Wujudkan Kecantikan Impian Anda</h1>
                            <p class="text-md md:text-xl max-w-2xl">Atur banner Anda melalui admin panel untuk
                                menampilkan promo terbaik.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section id="services" class="py-20 bg-gradient-to-br from-pink-100 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-semibold tracking-wide text-pink-600 drop-shadow-sm"
                    style="font-family: 'Freestyle Script', cursive">
                    Layanan
                </h2>
                <p class="text-xl text-black max-w-3xl mx-auto font-medium leading-relaxed mt-5">
                    Temukan gaya rambut yang sempurna untuk Anda. Dari potongan modern
                    hingga klasik, kami memiliki berbagai pilihan yang akan membuat Anda
                    terlihat menakjubkan.
                </p>
            </div>

            {{-- Filter Kategori --}}
            <div class="flex flex-wrap gap-2 md:gap-4 justify-center" id="category-filter-container">
                @foreach ($categories as $category)
                    <button
                        class="filter-btn category-btn px-4 md:px-5 py-2 rounded-full text-sm font-medium
                                bg-white text-gray-700 ring-1 ring-gray-200 transition-all
                                hover:bg-gray-50 hover:text-gray-900 hover:ring-gray-300 hover:-translate-y-0.5"
                        data-category="{{ strtolower($category->name) }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
                @forelse ($products as $product)
                    <div class="hairstyle-card group" data-name="{{ strtolower($product->name) }}"
                        data-category="{{ strtolower($product->category->name ?? 'general') }}"
                        data-price="{{ $product->price }}">
                        <div class="aspect-[3/4] rounded-3xl overflow-hidden relative">
                            <span
                                class="absolute top-2 right-2 z-10 bg-white/70 rounded-full p-1 shadow hover:bg-pink-500 hover:text-white transition-colors cursor-pointer"
                                onclick="openProductModal('{{ $product->name }}', '{{ addslashes($product->description) }}', '{{ $product->primary_image_src }}', '{{ $product->price_idr }}', '{{ strtolower($product->category->name ?? 'general') }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                    <circle cx="12" cy="12" r="3" fill="currentColor" />
                                </svg>
                            </span>
                            {{-- Cek jika ada gambar utama --}}
                            @if ($product->primary_image_src)
                                <img src="{{ $product->primary_image_src }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />>
                            @else
                                {{-- Tampilkan placeholder jika tidak ada gambar --}}
                                <img src="{{ asset('assets/images/no-image-icon.png') }}" alt="No Image"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                            @endif
                            <div class="hairstyle-overlay">
                                <div class="text-white">
                                    <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                                    <p class="text-xs mt-1 opacity-75">{{ $product->price_idr }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada layanan atau produk yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
            <div id="no-results" class="hidden col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada layanan atau produk yang cocok dengan pencarian/filter ini.
                </p>
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="md:col-span-1">
                    <a href="/" class="flex items-center space-x-2 mb-4">
                        @if ($userStore->store_logo)
                            <img src="{{ asset('storage/' . $userStore->store_logo) }}"
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

    {{-- Perbaikan: Tambahkan ID dan struktur yang lebih jelas untuk modal --}}
    <div id="product-modal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-[999] hidden p-4">
        <div class="relative bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
            <img id="modal-image" src="" alt="Detail Gambar" class="w-full object-cover rounded-t-lg" />

            {{-- Bagian detail yang bisa disembunyikan/ditampilkan --}}
            <div id="modal-details" class="p-6">
                <h3 id="modal-title" class="text-2xl font-bold mb-2"></h3>
                <p id="modal-price" class="text-xl font-bold text-pink-600 mb-4"></p>
                <p id="modal-description" class="text-gray-600 mb-4"></p>
                <a id="whatsapp-link" href="#" target="_blank"
                    class="block w-full text-center bg-green-500 text-white px-4 py-3 rounded-lg hover:bg-green-600 font-semibold">Hubungi
                    via WhatsApp</a>
            </div>

            <button onclick="closeProductModal()"
                class="absolute top-3 right-3 bg-white/50 rounded-full p-1 text-gray-800 hover:bg-white">&times;</button>
        </div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Swiper untuk bagian banner
            const swiper = new Swiper('.swiper-container', {
                loop: false,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            // Ambil elemen grid produk dan semua kartu produk
            const productGrid = document.getElementById('product-grid');
            const allProductCards = Array.from(productGrid.querySelectorAll('.hairstyle-card'));
            const noResultsMessage = document.getElementById('no-results');
            const categoryButtons = document.querySelectorAll('.category-btn');

            // Fungsi untuk menerapkan filter kategori
            function applyCategoryFilter(category) {
                let found = false;
                allProductCards.forEach(card => {
                    const cardCategory = card.dataset.category;
                    const matches = category === 'all' || cardCategory === category;

                    card.style.display = matches ? 'block' : 'none';

                    if (matches) {
                        found = true;
                    }
                });

                noResultsMessage.classList.toggle('hidden', found);
            }

            // Tambahkan event listener ke setiap tombol kategori
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    categoryButtons.forEach(btn => {
                        btn.classList.remove('active');
                        btn.classList.remove('bg-pink-500', 'text-white', 'ring-pink-500',
                            'hover:bg-pink-600', 'hover:ring-pink-600');
                        btn.classList.add('bg-white', 'text-gray-700', 'ring-gray-200',
                            'hover:bg-gray-50', 'hover:text-gray-900',
                            'hover:ring-gray-300');
                    });

                    this.classList.add('active');
                    this.classList.remove('bg-white', 'text-gray-700', 'ring-gray-200',
                        'hover:bg-gray-50', 'hover:text-gray-900', 'hover:ring-gray-300');
                    this.classList.add('bg-pink-500', 'text-white', 'ring-pink-500',
                        'hover:bg-pink-600', 'hover:ring-pink-600');

                    const selectedCategory = this.dataset.category;
                    applyCategoryFilter(selectedCategory);
                });
            });

            // Fungsionalitas modal produk
            window.openProductModal = function(name, description, imageUrl, price, category) {
                const modal = document.getElementById('product-modal');
                const modalImage = document.getElementById('modal-image');
                const modalDetails = document.getElementById('modal-details');

                // Atur gambar modal
                modalImage.src = imageUrl;

                // Cek kategori. Jika 'product', tampilkan detail lengkap. Jika tidak, sembunyikan.
                if (category === 'product') {
                    modalImage.classList.remove('h-full');
                    modalImage.classList.add('h-64');
                    modalDetails.style.display = 'block';
                    document.getElementById('modal-title').innerText = name;
                    document.getElementById('modal-description').innerText = description;
                    document.getElementById('modal-price').innerText = price;

                    const phoneNumber = '{{ $userStore->store_phone }}';
                    const message = encodeURIComponent(
                        `Halo, saya tertarik dengan produk "${name}" yang seharga ${price}.`
                    );
                    document.getElementById('whatsapp-link').href =
                        `https://wa.me/${phoneNumber}?text=${message}`;
                } else {
                    modalImage.classList.remove('h-64');
                    modalImage.classList.add('h-full');
                    modalDetails.style.display = 'none';
                }

                modal.classList.remove('hidden');
            };

            window.closeProductModal = function() {
                document.getElementById('product-modal').classList.add('hidden');
            };

            // Terapkan filter awal pada saat halaman dimuat
            const allButton = document.querySelector('.category-btn[data-category="all"]');
            if (allButton) {
                allButton.click();
            } else {
                applyCategoryFilter('all');
            }
        });
    </script>
</body>

</html>
