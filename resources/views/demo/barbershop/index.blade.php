<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Low Barber - Barbershop Premium</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/barbershop/styles.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Midtrans Snap CDN (Sandbox for Demo) -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
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
                <span class="title-main">Low Barber</span>
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
            <div class="hero-buttons">
                <a href="#gallery" class="btn btn-secondary btn-large">
                    <i class="fas fa-img"></i>
                    Lihat Portfolio
                </a>
            </div>
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
                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/klasik.png') }}" alt="Classic Cut" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>45 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Classic Cut</h3>
                        <div class="service-price">Rp 75,000</div>
                        <button class="service-btn"
                            onclick="showModal('Classic Cut', 'Classic Cut adalah potongan rambut klasik yang cocok untuk semua usia.', 'img/klasik.png')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}" alt="Modern Fade" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>50 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Modern Fade</h3>
                        <div class="service-price">Rp 85,000</div>
                        <button class="service-btn"
                            onclick="showModal('Modern Fade', 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.', 'img/moderncut.jpg')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/beardtrim.jpg') }}" alt="Beard Trim" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>30 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Beard Trim</h3>
                        <div class="service-price">Rp 45,000</div>
                        <button class="service-btn"
                            onclick="showModal('Beard Trim', 'Perapian jenggot agar tampak rapi, bersih, dan sesuai bentuk wajah untuk tampilan yang maskulin.', 'img/beardtrim.jpg')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/premiun.jpg') }}" alt="Premium Package" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>90 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Premium Package</h3>
                        <div class="service-price">Rp 150,000</div>
                        <button class="service-btn"
                            onclick="showModal('Premium Package', 'Paket perawatan lengkap mulai dari potong rambut, perapian jenggot, hingga styling premium untuk tampilan maksimal.', 'img/premiun.jpg')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/hairwash.jpeg') }}" alt="Hair Wash & Style" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>25 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Hair Wash & Style</h3>
                        <div class="service-price">Rp 35,000</div>
                        <button class="service-btn"
                            onclick="showModal('Hair Wash & Style', 'Cuci rambut menyegarkan dilanjutkan dengan penataan stylish untuk tampilan rapi dan percaya diri sepanjang hari.', 'img/hairwash.jpeg')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/kids.jpg') }}" alt="Kids Cut" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>35 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Kids Cut</h3>
                        <div class="service-price">Rp 50,000</div>
                        <button class="service-btn"
                            onclick="showModal('Kids Cut', 'Potongan rambut rapi dan nyaman untuk anak-anak, dengan gaya yang lucu dan mudah diatur.', 'img/kids.jpg')">
                            Detail Layanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
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
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Hubungi Kami</h2>
                <p class="section-subtitle">
                    Siap untuk mendapatkan potongan rambut terbaik? Hubungi
                    kami sekarang!
                </p>
            </div>

            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="contact-title">Lokasi</h3>
                    <p class="contact-text">
                        Jl. Perjuangan No. 13<br />Kota Medan, 10220
                    </p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3 class="contact-title">Telepon</h3>
                    <p class="contact-text">
                        +62 813-8549-7404<br />+62 21-1234-5678
                    </p>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="contact-title">Jam Buka</h3>
                    <p class="contact-text">
                        Sen - Sab: 09:00 - 21:00<br />Minggu: 10:00 - 18:00
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-social">
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>
                <div class="footer-grid-container">
                    <div class="footer-links">
                        <h3 class="footer-title">Layanan</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="#services" class="footer-link">Classic Cut</a>
                            </li>
                            <li>
                                <a href="#services" class="footer-link">Modern Fade</a>
                            </li>
                            <li>
                                <a href="#services" class="footer-link">Beard Trim</a>
                            </li>
                            <li>
                                <a href="#services" class="footer-link">Premium Package</a>
                            </li>
                            <li>
                                <a href="#services" class="footer-link">Hair Wash & Style</a>
                            </li>
                            <li>
                                <a href="#services" class="footer-link">Kids Cut</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-contact">
                        <h3 class="footer-title">Kontak</h3>
                        <ul class="footer-list">
                            <li>Jl. Perjuangan No. 13</li>
                            <li>Kota Medan 10220</li>
                            <li>+62 813-8549-7404</li>
                            <li>info@barber.com</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Barber. PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'barbershop',
    ])

    <script src="{{ asset('assets/demo/barbershop/script.js') }}"></script>
    <script>
        // Face shape recommendation data
        const hairStyles = {
            oval: [{
                    name: "Classic Cut",
                    description: "Potongan klasik yang cocok untuk wajah oval",
                    image: "{{ asset('assets/demo/barbershop/img/klasik.png') }}",
                },
                {
                    name: "Modern Fade",
                    description: "Fade modern yang elegan",
                    image: "{{ asset('assets/demo/barbershop/img/modern.jpg') }}",
                },
                {
                    name: "Textured Crop",
                    description: "Crop dengan tekstur yang menarik",
                    image: "{{ asset('assets/demo/barbershop/img/comma.JPG') }}",
                },
            ],
            round: [{
                    name: "Pompadour",
                    description: "Style pompadour untuk wajah bulat",
                    image: "{{ asset('assets/demo/barbershop/img/comma.JPG') }}",
                },
                {
                    name: "Textured Crop",
                    description: "Crop dengan tekstur yang menarik",
                    image: "{{ asset('assets/demo/barbershop/img/premiun.jpg') }}",
                },
                {
                    name: "Side Part",
                    description: "Side part yang formal",
                    image: "{{ asset('assets/demo/barbershop/img/bursfade.jpg') }}",
                },
            ],
            square: [{
                    name: "Side Part",
                    description: "Side part yang formal",
                    image: "{{ asset('assets/demo/barbershop/img/bursfade.jpg') }}",
                },
                {
                    name: "Quiff",
                    description: "Quiff yang stylish",
                    image: "{{ asset('assets/demo/barbershop/img/kids.jpg') }}",
                },
                {
                    name: "Classic Short",
                    description: "Potongan pendek klasik",
                    image: "{{ asset('assets/demo/barbershop/img/modern.jpg') }}",
                },
            ],
            heart: [{
                    name: "Swept Back",
                    description: "Rambut disisir ke belakang",
                    image: "{{ asset('assets/demo/barbershop/img/hairwash.jpeg') }}",
                },
                {
                    name: "Textured Fringe",
                    description: "Fringe dengan tekstur",
                    image: "{{ asset('assets/demo/barbershop/img/klasik.png') }}",
                },
            ],
            diamond: [{
                    name: "Textured Fringe",
                    description: "Fringe dengan tekstur",
                    image: "{{ asset('assets/demo/barbershop/img/klasik.png') }}",
                },
                {
                    name: "Classic Short",
                    description: "Potongan pendek klasik",
                    image: "{{ asset('assets/demo/barbershop/img/modern.jpg') }}",
                },
            ],
            triangle: [{
                    name: "Classic Short",
                    description: "Potongan pendek klasik",
                    image: "{{ asset('assets/demo/barbershop/img/modern.jpg') }}",
                },
                {
                    name: "Textured Crop",
                    description: "Crop dengan tekstur yang menarik",
                    image: "{{ asset('assets/demo/barbershop/img/comma.JPG') }}",
                },
            ],
        };

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
