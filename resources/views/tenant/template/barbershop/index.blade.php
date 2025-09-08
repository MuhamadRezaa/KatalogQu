<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/barbershop/styles.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body>
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-overlay"></div>

        <!-- Background Slider Container -->
        <div class="hero-background-slider">
            <div class="bg-slide active" data-slide="0">
                <div class="bg-image"
                    style="background-image: url('{{ asset('assets/demo/barbershop/img/bgg.jpg') }}')"></div>
            </div>
            <div class="bg-slide" data-slide="1">
                <div class="bg-image"
                    style="background-image: url('{{ asset('assets/demo/barbershop/img/bgg1.jpg') }}')"></div>
            </div>
            <div class="bg-slide" data-slide="2">
                <div class="bg-image"
                    style="background-image: url('{{ asset('assets/demo/barbershop/img/bg.jpeg') }}')"></div>
            </div>
        </div>

        <!-- Static Hero Content -->
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-text">✨ Barbershop Premium</span>
            </div>
            <div class="hero-icon">
                <i class="fas fa-cut"></i>
            </div>
            <h1 class="hero-title">
                <span class="title-main">{{ $userStore->store_name }}</span>
                <span class="title-sub">Professional Style</span>
            </h1>
            <p class="hero-subtitle">
                Transformasi penampilan Anda dengan sentuhan profesional dan
                gaya modern yang memukau
            </p>
            <div class="hero-features">
                <div class="feature-item">
                    <i class="fas fa-award"></i>
                    <span>Kualitas Premium</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <span>Layanan Cepat</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-star"></i>
                    <span>Hasil Memuaskan</span>
                </div>
            </div>
            {{-- <div class="hero-buttons">
                <a href="#gallery" class="btn btn-secondary btn-large">
                    <i class="fas fa-images"></i>
                    Lihat Portfolio
                </a>
            </div> --}}
        </div>

        <!-- Slider Navigation -->
        <div class="slider-nav">
            <button class="slider-btn prev" aria-label="Slide sebelumnya">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-btn next" aria-label="Slide selanjutnya">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Slider Dots -->
        <div class="slider-dots">
            <button class="dot active" data-slide="0" aria-label="Slide 1"></button>
            <button class="dot" data-slide="1" aria-label="Slide 2"></button>
            <button class="dot" data-slide="2" aria-label="Slide 3"></button>
        </div>
    </section>

    <!-- Style Recommendation Section -->
    <section id="style-recommendation" class="style-recommendation">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Rekomendasi Style</h2>
                <p class="section-subtitle">
                    Pilih bentuk wajah Anda untuk mendapatkan rekomendasi
                    style pangkas yang paling cocok
                </p>
            </div>

            <div class="face-shape-container">
                <div class="face-shape-buttons">
                    <button class="face-shape-btn" data-shape="oval">
                        <i class="fas fa-circle"></i>
                        <span>Oval</span>
                    </button>
                    <button class="face-shape-btn" data-shape="round">
                        <i class="fas fa-circle"></i>
                        <span>Round</span>
                    </button>
                    <button class="face-shape-btn" data-shape="square">
                        <i class="fas fa-square"></i>
                        <span>Square</span>
                    </button>
                    <button class="face-shape-btn" data-shape="heart">
                        <i class="fas fa-heart"></i>
                        <span>Heart</span>
                    </button>
                    <button class="face-shape-btn" data-shape="diamond">
                        <i class="fas fa-gem"></i>
                        <span>Diamond</span>
                    </button>
                    <button class="face-shape-btn" data-shape="triangle">
                        <i class="fas fa-play"></i>
                        <span>Triangle</span>
                    </button>
                </div>

                <div class="recommendation-result" id="recommendationResult">
                    <div class="result-placeholder">
                        <i class="fas fa-hand-pointer"></i>
                        <p>
                            Pilih bentuk wajah Anda di atas untuk melihat
                            rekomendasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <!-- Modal -->
        <div id="serviceModal" class="modal">
            <div class="modal-content">
                <button class="modal-close" onclick="closeModal()">
                    &times;
                </button>
                <img id="modalImage" src="" alt="Service Image" />
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
            </div>
        </div>

        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Service</h2>
                <p class="section-subtitle">
                    Dapatkan pelayanan terbaik dengan standar internasional
                    dan teknik modern
                </p>
            </div>

            <div class="services-grid">
                @forelse ($products as $product)
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{ $product->image ? route('tenant.asset', ['path' => $product->image]) : asset('assets/demo/barbershop/img/klasik.png') }}"
                                alt="{{ $product->name }}" />
                            <div class="service-overlay">
                                <div class="service-duration">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $product->duration ?? '30 min' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h3 class="service-name">{{ $product->name }}</h3>
                            <div class="service-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <button class="service-btn"
                                onclick="showModal('{{ $product->name }}', '{{ $product->description ?? 'Layanan barbershop profesional dengan kualitas terbaik.' }}', '{{ $product->image ? route('tenant.asset', ['path' => $product->image]) : asset('assets/demo/barbershop/img/klasik.png') }}')">
                                Detail Layanan
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{ asset('assets/demo/barbershop/img/klasik.png') }}" alt="No Services" />
                            <div class="service-overlay">
                                <div class="service-duration">
                                    <i class="fas fa-clock"></i>
                                    <span>-</span>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h3 class="service-name">Belum Ada Layanan</h3>
                            <div class="service-price">-</div>
                            <button class="service-btn" disabled>
                                Layanan Segera Tersedia
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    {{-- <section id="gallery" class="gallery">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Portfolio Karya</h2>
                <p class="section-subtitle">
                    Lihat hasil kerja terbaik kami dan dapatkan inspirasi
                    untuk gaya rambut Anda
                </p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="{{ asset('assets/demo/barbershop/img/mohawk.jpg') }}" alt="Mohawk" />
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Mohawk Style</h3>
                        <button class="gallery-btn">Lihat Detail</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/demo/barbershop/img/buzzcut.jpg') }}" alt="Buzzcut" />
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Buzz Cut</h3>
                        <button class="gallery-btn">Lihat Detail</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/demo/barbershop/img/mullet.jpg') }}" alt="Mullet" />
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Mullet Modern</h3>
                        <button class="gallery-btn">Lihat Detail</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/demo/barbershop/img/comma.JPG') }}" alt="Comma Hair" />
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Comma Hair</h3>
                        <button class="gallery-btn">Lihat Detail</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/demo/barbershop/img/undercut.jpg') }}" alt="Undercut Modern" />
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Undercut Modern</h3>
                        <button class="gallery-btn">Lihat Detail</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/demo/barbershop/img/kids.jpg') }}" alt="Kids Cuts" />
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Kids Style</h3>
                        <button class="gallery-btn">Lihat Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="hero-icon"
                        style="
                                background: none !important;
                                border: none !important;
                                box-shadow: none !important;
                            ">
                        <i class="fas fa-cut"
                            style="
                                    background: none !important;
                                    padding: 0 !important;
                                    margin: 0 !important;
                                    width: auto !important;
                                    height: auto !important;
                                "></i>
                    </div>
                    <h1>{{ $userStore->store_name }}</h1>
                </div>
                <div class="footer-contact">
                    <h3 class="footer-title">Kontak Kami</h3>
                    <ul class="footer-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $userStore->store_address ?? 'Alamat toko akan segera diperbarui' }}
                        </li>
                        <li>
                            <i class="fas fa-phone"></i> {{ $userStore->store_phone ?? '+62 813-8549-7404' }}
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            {{ $userStore->store_email ?? 'info@' . strtolower(str_replace(' ', '', $userStore->store_name)) . '.com' }}
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            {{ $userStore->operating_hours ?? 'Sen-Sab: 09:00 - 21:00 | Minggu: 10:00 - 18:00' }}
                        </li>
                    </ul>
                    <div class="footer-social" style="margin-top: 15px">
                        @if ($userStore->instagram_url)
                            <a href="{{ $userStore->instagram_url }}" class="social-link" aria-label="Instagram"
                                target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($userStore->facebook_url)
                            <a href="{{ $userStore->facebook_url }}" class="social-link" aria-label="Facebook"
                                target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Barber. PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>

    <script>
        // contoh: https://domainmu.com/
        window.ASSET_BASE = "{{ asset('') }}";
        window.assetUrl = function(p) {
            return (window.ASSET_BASE.replace(/\/$/, '') + '/' + String(p).replace(/^\//, ''));
        };
    </script>
    <script src="{{ asset('assets/demo/barbershop/script.js') }}"></script>
    <script>
        function toggleDetail(btn) {
            const detail = btn.nextElementSibling;
            if (
                detail.style.display === "none" ||
                detail.style.display === ""
            ) {
                detail.style.display = "block";
                btn.textContent = "Tutup Detail";
            } else {
                detail.style.display = "none";
                btn.textContent = "Detail Layanan";
            }
        }
    </script>



</body>

</html>
