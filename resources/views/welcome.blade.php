<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="KatalogKu adalah platform terbaik untuk membuat katalog digital yang menarik dan profesional dalam hitungan menit.">
    <meta name="keywords" content="katalog digital, e-katalog, template katalog, katalog online, bisnis digital">
    <meta name="author" content="KatalogKu">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/katalogqu_icon.png') }}">
    <title>KatalogQu - Platform Katalog Digital Terbaik</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- --- AWAL PERUBAHAN: Menambahkan Swiper JS CSS --- --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    {{-- --- AKHIR PERUBAHAN --- --}}

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    <style>
        .tutorial-section {
            padding: 80px 0;
            position: relative;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        /* --- AWAL PERUBAHAN: CSS untuk Video Preview & Modal --- */
        .video-preview-container {
            position: relative;
            cursor: pointer;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease;
        }

        .video-preview-container:hover {
            transform: scale(1.03);
        }

        .video-preview-container img {
            width: 100%;
            display: block;
        }

        .play-button-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #478413;
            transition: all 0.3s ease;
        }

        .video-preview-container:hover .play-button-overlay {
            transform: translate(-50%, -50%) scale(1.1);
            background-color: white;
        }

        #tutorialModal .modal-content {
            border: none;
            border-radius: 15px;
        }

        #tutorialModal .modal-header {
            background-color: #478413;
            color: white;
            border-bottom: 5px solid #f99a07;
        }

        #tutorialModal .modal-body {
            padding: 0;
        }

        .video-responsive {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio */
        }

        .video-responsive iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .tutorial-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            border: 1px solid #e9ecef;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .swiper-slide {
            height: auto;
            padding: 20px 10px 40px 10px;
        }

        .tutorial-icon-wrapper {
            margin: 0 auto 20px auto;
            width: 70px;
            height: 70px;
        }

        .tutorial-icon {
            font-size: 30px;
        }

        .tutorial-number {
            width: 28px;
            height: 28px;
            font-size: 14px;
        }

        .tutorial-title {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .tutorial-description {
            font-size: 14px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #478413;
        }

        .swiper-pagination-bullet-active {
            background-color: #f99a07 !important;
        }

        .slider-container {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        /* --- AKHIR PERUBAHAN --- */
    </style>
</head>

<body class="landing-page">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#home">
                <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                    style="max-height: 50px; width: auto; object-fit: contain;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#demo">Template</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tutorial">Cara Pakai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#applications">Aplikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#support">Support</a>
                    </li>
                </ul>
                <div class="d-flex gap-2 auth-buttons">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle d-flex align-items-center gap-2"
                                type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->avatar && !empty(Auth::user()->avatar))
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle"
                                        style="width: 24px; height: 24px;"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="rounded-circle d-none align-items-center justify-content-center"
                                        style="width: 24px; height: 24px; background: #478413; color: white; font-size: 12px; display: none !important;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px; background: #478413; color: white; font-size: 12px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li>
                                    <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                            class="fas fa-user me-2"></i>Profil Saya</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="/login" class="btn btn-outline-success">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <!-- Background: Carousel -->
        <div class="hero-bg">
            <div id="heroBgCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/gambar1.jpg') }}" alt="slide-1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/gambar2.jpg') }}" alt="slide-2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/gambar1.jpg') }}" alt="slide-3">
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay hijau -->
        <div class="hero-overlay"></div>

        <!-- Dekorasi yang sudah ada -->
        <div class="hero-pattern"></div>
        <div class="floating-element floating-1"></div>
        <div class="floating-element floating-2"></div>
        <div class="floating-element floating-3"></div>
        <div class="floating-element floating-4"></div>
        <div class="floating-element floating-5"></div>

        <!-- Konten -->
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-10 d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="hero-content">
                        <h1 class="hero-title animate__animated animate__fadeInUp">
                            Platform Katalog Digital <span style="color: #f99a07;">Terdepan</span>
                        </h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                            Hanya dengan Rp 150.000/tahun, Anda sudah dapat memiliki katalog atau menu digital yang
                            professional untuk bisnis anda
                        </p>
                        <div class="hero-buttons animate__animated animate__fadeInUp animate__delay-2s">
                            <a href="#demo" class="btn-hero btn-hero-primary">
                                <i class="fas fa-rocket"></i> Miliki Sekarang
                            </a>
                            <a href="#features" class="btn-hero btn-hero-outline">Features</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Demo Section -->
    <section id="demo" class="demo-section">
        <div class="container">
            <div class="section-title">
                <div class="section-subtitle">Template Trending & Desain Bersih</div>
                <h2 class="section-main-title">Koleksi Template Katalog dan Menu Yang Bisa Anda Miliki</h2>
            </div>

            <div class="row">
                <!-- Template -->
                @if ($templates->isEmpty())
                    <div class="col-12">
                        <p class="text-center">Tidak ada template yang tersedia saat ini. Silakan cek kembali nanti.
                        </p>
                    </div>
                @else
                    @foreach ($templates as $template)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="demo-card">
                                <div class="demo-header">
                                    <div class="demo-dots">
                                        <div class="demo-dot"></div>
                                        <div class="demo-dot"></div>
                                        <div class="demo-dot"></div>
                                    </div>
                                    <h5 class="demo-title">{{ $template->name }}</h5>
                                </div>
                                <div class="demo-image">
                                    @if (!$template->preview_image)
                                        <img src="{{ asset('assets/images/no-image-icon.png') }}"
                                            alt="{{ $template->name }}">
                                    @else
                                        <img src="{{ asset('storage/' . $template->preview_image) }}"
                                            alt="{{ $template->name }}">
                                    @endif
                                </div>
                                <div class="demo-buttons-external">
                                    <a href="/demo/{{ $template->slug }}" class="btn-demo btn-demo-primary"
                                        onclick="showDemo('{{ $template->name }}')">Visit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-title">
                <div class="section-subtitle">Mengenal Lebih Dekat</div>
                <h2 class="section-main-title">Tentang KatalogKu</h2>
                <p class="section-description">Platform inovatif yang memungkinkan bisnis untuk membuat katalog digital
                    yang menarik, profesional, dan mudah diakses oleh pelanggan di mana saja.</p>
            </div>

            <!-- About Content -->
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="about-content">
                        <h3 class="about-subtitle">Misi Kami</h3>
                        <h4 class="about-title">Memudahkan Bisnis Berkembang di Era Digital</h4>
                        <p class="about-text">
                            KatalogQu hadir untuk membantu setiap bisnis, dari UMKM hingga perusahaan besar, dalam
                            menciptakan
                            katalog digital yang profesional dan menarik. Kami percaya bahwa setiap produk memiliki
                            cerita yang
                            layak untuk diceritakan dengan cara yang terbaik.
                        </p>
                        <p class="about-text">
                            Dengan teknologi terdepan dan desain yang user-friendly, kami memungkinkan siapa saja untuk
                            membuat
                            katalog digital yang tidak hanya indah dipandang, tetapi juga efektif dalam meningkatkan
                            penjualan
                            dan engagement pelanggan.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <div class="image-wrapper">
                            <div class="floating-card card-1">
                                <i class="fas fa-chart-line"></i>
                                <span>Peningkatan Penjualan</span>
                            </div>
                            <div class="floating-card card-2">
                                <i class="fas fa-users"></i>
                                <span>Engagement Tinggi</span>
                            </div>
                            <div class="floating-card card-3">
                                <i class="fas fa-mobile-alt"></i>
                                <span>Mobile Friendly</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <!-- Key Features Grid -->
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h5 class="feature-title">Mudah & Cepat</h5>
                        <p class="feature-description">Buat katalog digital profesional dalam hitungan menit tanpa
                            perlu keahlian teknis khusus.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h5 class="feature-title">Template Beragam</h5>
                        <p class="feature-description">Pilihan template yang disesuaikan untuk berbagai jenis bisnis
                            dan industri.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5 class="feature-title">Responsif</h5>
                        <p class="feature-description">Katalog yang sempurna di semua perangkat, dari desktop hingga
                            smartphone.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <h5 class="feature-title">Mudah Dibagikan</h5>
                        <p class="feature-description">Bagikan katalog Anda melalui link, media sosial, atau embed di
                            website.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h5 class="feature-title">Analytics</h5>
                        <p class="feature-description">Pantau performa katalog dengan analytics mendalam dan insights
                            yang actionable.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5 class="feature-title">Support 24/7</h5>
                        <p class="feature-description">Tim support yang siap membantu Anda kapan saja untuk kesuksesan
                            bisnis Anda.</p>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="row g-4 mt-5">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">{{ $templateCount }}</div>
                        <div class="stat-label">Katalog Dibuat</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">{{ $user_stores }}</div>
                        <div class="stat-label">Bisnis Terdaftar</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">{{ $templateCount }}</div>
                        <div class="stat-label">Template Tersedia</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- --- AWAL PERUBAHAN: Merombak seksi Tutorial --- --}}
    <!-- Tutorial Section -->
    <section id="tutorial" class="tutorial-section">
        <div class="container">
            <div class="section-title">
                <div class="section-subtitle">Panduan Cepat & Interaktif</div>
                <h2 class="section-main-title">Lihat Cara Kerja KatalogKu</h2>
                <p class="section-description">Klik video di bawah untuk melihat panduan lengkap, atau jelajahi setiap
                    langkahnya dalam slider interaktif di dalamnya.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="video-preview-container" data-bs-toggle="modal" data-bs-target="#tutorialModal">
                        <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="Video Tutorial KatalogKu">
                        <div class="play-button-overlay">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- --- AKHIR PERUBAHAN --- --}}

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-4">
                    <div class="footer-section">
                        <div class="footer-brand">
                            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                                class="footer-logo-img" style="width: 200px; height: auto;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-section">
                        <h5>Pages</h5>
                        <ul class="footer-links">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#features">Template</a></li>
                            <li><a href="#demo">Fitur</a></li>
                            <li><a href="#applications">Aplikasi</a></li>
                            <li><a href="#support">Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-section">
                        <h5>Contact</h5>
                        <div class="contact-info">
                            <p>Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV No.172 Kompleks,
                                Asam Kumbang, Kec. Medan Selayang,
                                Kota Medan, Sumatera Utara 20133</p>
                            <p><a href="mailto:info@katalogqu.com">pteraciptadigital@gmail.com</a><br>
                                08116584545</p>
                        </div>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/people/PT-Era-Cipta-Digital/61571510908596/"
                                title="Facebook" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/eracipta.digital/" title="Instagram"
                                target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://pteraciptadigital.id/news" title="News" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="https://www.youtube.com/watch?si=yKam4Cr8TZpLHwl5&v=lLnvxPIqDp8&feature=youtu.be"
                                title="YouTube" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <hr>
                <div class="click">
                    <a href="https://pteraciptadigital.id/about" target="_blank">
                        © 2025 PT. Era Cipta Digital
                    </a>
                </div>

            </div>
        </div>
    </footer>

    {{-- --- AWAL PERUBAHAN: Menambahkan Modal untuk Tutorial --- --}}
    <!-- Tutorial Modal -->
    <div class="modal fade" id="tutorialModal" tabindex="-1" aria-labelledby="tutorialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tutorialModalLabel">Panduan Cepat KatalogKu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- YouTube Video -->
                    <div class="video-responsive">
                        <iframe id="youtubeVideo"
                            src="https://www.youtube.com/embed/lLnvxPIqDp8?si=yKam4Cr8TZpLHwl5&enablejsapi=1"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>

                    <!-- Slider Container -->
                    <div class="slider-container">
                        <div class="swiper-container tutorial-slider-modal">
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    <div class="tutorial-card">
                                        <div class="tutorial-icon-wrapper">
                                            <div class="tutorial-number">1</div>
                                            <i class="fas fa-credit-card tutorial-icon"></i>
                                        </div>
                                        <h5 class="tutorial-title">Selesaikan Pembayaran</h5>
                                        <p class="tutorial-description">Pilih template dan selesaikan pembayaran
                                            melalui metode yang aman.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tutorial-card">
                                        <div class="tutorial-icon-wrapper">
                                            <div class="tutorial-number">2</div>
                                            <i class="fas fa-store tutorial-icon"></i>
                                        </div>
                                        <h5 class="tutorial-title">Setup Toko Digital</h5>
                                        <p class="tutorial-description">Isi informasi dasar toko seperti nama,
                                            deskripsi, dan subdomain unik.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tutorial-card">
                                        <div class="tutorial-number">3</div>
                                        <i class="fas fa-box-open tutorial-icon"></i>
                                    </div>
                                    <h5 class="tutorial-title">Kelola Produk Anda</h5>
                                    <p class="tutorial-description">Masuk ke dasbor admin untuk menambah produk,
                                        kategori, dan lainnya.</p>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tutorial-card">
                                        <div class="tutorial-icon-wrapper">
                                            <div class="tutorial-number">4</div>
                                            <i class="fas fa-qrcode tutorial-icon"></i>
                                        </div>
                                        <h5 class="tutorial-title">Dapatkan QR Code</h5>
                                        <p class="tutorial-description">Unduh QR Code dalam format template menarik
                                            untuk dicetak atau dibagikan.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tutorial-card">
                                        <div class="tutorial-number">5</div>
                                        <i class="fas fa-share-alt tutorial-icon"></i>
                                    </div>
                                    <h5 class="tutorial-title">Bagikan & Jangkau Pelanggan</h5>
                                    <p class="tutorial-description">Bagikan link atau QR Code di media sosial dan toko
                                        fisik Anda.</p>
                                </div>
                            </div>
                            <!-- Navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- --- AKHIR PERUBAHAN --- --}}


    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const scrollTop = document.getElementById('scrollTop');

            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
                scrollTop.classList.add('show');
            } else {
                navbar.classList.remove('scrolled');
                scrollTop.classList.remove('show');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top
        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Active nav link
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        {{-- --- AWAL PERUBAHAN: Logika untuk Modal dan Slider di dalamnya --- --}}
        document.addEventListener('DOMContentLoaded', function() {
            const tutorialModal = document.getElementById('tutorialModal');
            const youtubeVideo = document.getElementById('youtubeVideo');
            let tutorialSlider;

            tutorialModal.addEventListener('shown.bs.modal', function() {
                // Inisialisasi slider HANYA ketika modal terbuka
                tutorialSlider = new Swiper('.tutorial-slider-modal', {
                    loop: true,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 1,
                            spaceBetween: 10
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 20
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 20
                        },
                    }
                });
            });

            tutorialModal.addEventListener('hide.bs.modal', function() {
                // Hentikan video YouTube saat modal ditutup
                youtubeVideo.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}',
                    '*');

                // Hancurkan instance slider untuk membersihkan memori
                if (tutorialSlider) {
                    tutorialSlider.destroy(true, true);
                }
            });
        });
        {{-- --- AKHIR PERUBAHAN --- --}}

        // SweetAlert functions
        function showLogin() {
            Swal.fire({
                html: `
                    <div style="background: linear-gradient(135deg, #478413 0%, #F99A07 100%); padding: 40px 30px; border-radius: 20px; text-align: center; color: white; position: relative; overflow: hidden;">
                        <!-- Background Pattern -->
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: radial-gradient(circle at 20% 50%, white 2px, transparent 2px), radial-gradient(circle at 80% 50%, white 2px, transparent 2px); background-size: 30px 30px;"></div>

                        <!-- Logo -->
                        <div style="position: relative; z-index: 2;">
                            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu" style="height: 60px; margin-bottom: 20px;">

                            <!-- Welcome Text -->
                            <h2 style="margin: 0 0 8px 0; font-size: 24px; font-weight: 600;">Selamat datang kembali!</h2>
                            <p style="margin: 0 0 30px 0; opacity: 0.9; font-size: 14px;">Masuk dengan email</p>

                            <!-- Login Form -->
                            <form id="loginForm" style="text-align: left;">
                                <div style="margin-bottom: 20px;">
                                    <div style="position: relative;">
                                        <i class="fas fa-envelope" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #666; font-size: 16px;"></i>
                                        <input type="email" id="email" placeholder="Email" required style="
                                            width: 100%;
                                            padding: 15px 15px 15px 45px;
                                            border: none;
                                            border-radius: 10px;
                                            background: rgba(255,255,255,0.95);
                                            font-size: 14px;
                                            color: #333;
                                            box-sizing: border-box;
                                            outline: none;
                                        ">
                                    </div>
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <div style="position: relative;">
                                        <i class="fas fa-lock" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #666; font-size: 16px;"></i>
                                        <input type="password" id="password" placeholder="Password" required style="
                                            width: 100%;
                                            padding: 15px 15px 15px 45px;
                                            border: none;
                                            border-radius: 10px;
                                            background: rgba(255,255,255,0.95);
                                            font-size: 14px;
                                            color: #333;
                                            box-sizing: border-box;
                                            outline: none;
                                        ">
                                    </div>
                                </div>

                                <div style="text-align: right; margin-bottom: 25px;">
                                    <a href="#" style="color: rgba(255,255,255,0.9); font-size: 12px; text-decoration: none;">Ingat saya</a>
                                </div>

                                <!-- Login Button -->
                                <button type="submit" style="
                                    width: 100%;
                                    padding: 15px;
                                    background: linear-gradient(135deg, #34571E 0%, #F99A07 100%);
                                    border: none;
                                    border-radius: 10px;
                                    color: white;
                                    font-size: 16px;
                                    font-weight: 600;
                                    cursor: pointer;
                                    transition: all 0.3s ease;
                                    margin-bottom: 20px;
                                    box-shadow: 0 4px 15px rgba(52, 87, 30, 0.3);
                                " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(52, 87, 30, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(52, 87, 30, 0.3)';">
                                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                                    Masuk
                                </button>
                            </form>

                            <!-- Google Login -->
                            <a href="{{ route('google.login') }}" style="
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                width: 100%;
                                padding: 12px 20px;
                                background: white;
                                border: 2px solid #478413;
                                border-radius: 10px;
                                color: #478413;
                                text-decoration: none;
                                font-weight: 500;
                                font-size: 14px;
                                transition: all 0.3s ease;
                                margin-bottom: 20px;
                            " onmouseover="this.style.background='#478413'; this.style.color='white'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(71, 132, 19, 0.3)';" onmouseout="this.style.background='white'; this.style.color='#478413'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                <svg width="18" height="18" viewBox="0 0 24 24" style="margin-right: 10px;">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Masuk dengan Google
                            </a>

                            <!-- Footer Links -->
                            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; opacity: 0.9;">
                                <a href="#" style="color: white; text-decoration: none;">Lupa password?</a>
                                <span>Belum punya akun? <a href="#" onclick="showRegister()" style="color: white; text-decoration: none; font-weight: 600;">Daftar sekarang</a></span>
                            </div>
                        </div>
                    </div>
                `,
                showConfirmButton: false,
                showCancelButton: false,
                width: '420px',
                padding: '0',
                background: 'transparent',
                backdrop: 'rgba(0,0,0,0.4)',
                customClass: {
                    popup: 'login-popup-new'
                }
            });

            // Handle form submission
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                if (email && password) {
                    // Here you would typically send the login request
                    window.location.href = '{{ route('login') }}';
                }
            });
        }

        function showRegister() {
            Swal.fire({
                title: '',
                html: `
                    <div class="register-popup-new" style="padding: 25px;">
                        <div style="text-align: center; margin-bottom: 25px;">
                            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogQu" style="height: 50px; margin-bottom: 15px;">
                            <p style="color: #666; margin: 0; font-size: 13px;">Bergabunglah dengan ribuan pebisnis sukses</p>
                        </div>

                        <div style="margin-bottom: 20px; text-align: center; color: #666; font-size: 13px; position: relative;">
                            <span style="background: white; padding: 0 12px; position: relative; z-index: 1;">Daftar dengan email</span>
                            <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #ddd; z-index: 0;"></div>
                        </div>

                        <form id="registerForm" style="text-align: left;">
                            <div style="position: relative; margin-bottom: 15px;">
                                <i class="fas fa-user" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999; z-index: 2; font-size: 14px;"></i>
                                <input type="text" id="register_name" placeholder="Nama Lengkap" required style="
                                    width: 100%;
                                    padding: 12px 12px 12px 38px;
                                    border: 1px solid #ddd;
                                    border-radius: 8px;
                                    font-size: 14px;
                                    transition: all 0.3s ease;
                                    box-sizing: border-box;
                                    background: #fafafa;
                                ">
                            </div>
                            <div style="position: relative; margin-bottom: 15px;">
                                <i class="fas fa-envelope" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999; z-index: 2; font-size: 14px;"></i>
                                <input type="email" id="register_email" placeholder="Email" required style="
                                    width: 100%;
                                    padding: 12px 12px 12px 38px;
                                    border: 1px solid #ddd;
                                    border-radius: 8px;
                                    font-size: 14px;
                                    transition: all 0.3s ease;
                                    box-sizing: border-box;
                                    background: #fafafa;
                                ">
                            </div>
                            <div style="position: relative; margin-bottom: 15px;">
                                <i class="fas fa-lock" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999; z-index: 2; font-size: 14px;"></i>
                                <input type="password" id="register_password" placeholder="Password" required style="
                                    width: 100%;
                                    padding: 12px 12px 12px 38px;
                                    border: 1px solid #ddd;
                                    border-radius: 8px;
                                    font-size: 14px;
                                    transition: all 0.3s ease;
                                    box-sizing: border-box;
                                    background: #fafafa;
                                ">
                            </div>
                            <div style="position: relative; margin-bottom: 15px;">
                                <i class="fas fa-lock" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999; z-index: 2; font-size: 14px;"></i>
                                <input type="password" id="register_password_confirmation" placeholder="Konfirmasi Password" required style="
                                    width: 100%;
                                    padding: 12px 12px 12px 38px;
                                    border: 1px solid #ddd;
                                    border-radius: 8px;
                                    font-size: 14px;
                                    transition: all 0.3s ease;
                                    box-sizing: border-box;
                                    background: #fafafa;
                                ">
                            </div>
                            <div style="margin-bottom: 20px; display: flex; align-items: flex-start; gap: 8px;">
                                <input type="checkbox" id="register_terms" required style="margin-top: 2px;">
                                <label for="register_terms" style="font-size: 12px; color: #666; line-height: 1.3;">
                                    Saya setuju dengan <a href="#" style="color: #667eea; text-decoration: none;">syarat dan ketentuan</a>
                                </label>
                            </div>
                            <button type="submit" style="
                                width: 100%;
                                padding: 12px;
                                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                color: white;
                                border: none;
                                border-radius: 8px;
                                font-size: 14px;
                                font-weight: 600;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                margin-bottom: 15px;
                            ">
                                <i class="fas fa-user-plus" style="margin-right: 6px;"></i>
                                BUAT AKUN
                            </button>
                        </form>

                        <div style="margin: 15px 0; text-align: center; color: #666; font-size: 13px; position: relative;">
                            <span style="background: white; padding: 0 12px; position: relative; z-index: 1;">atau</span>
                            <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #ddd; z-index: 0;"></div>
                        </div>

                        <a href="{{ route('google.login') }}" style="
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            width: 100%;
                            padding: 12px;
                            background: white;
                            color: #333;
                            text-decoration: none;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            font-weight: 500;
                            transition: all 0.3s ease;
                            margin-bottom: 15px;
                            box-sizing: border-box;
                            font-size: 14px;
                        " onmouseover="this.style.backgroundColor='#f8f9fa'; this.style.borderColor='#667eea';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#ddd';">
                            <i class="fab fa-google" style="margin-right: 8px; color: #4285f4;"></i>
                            Daftar dengan Google
                        </a>

                        <p style="text-align: center; margin: 0; font-size: 13px; color: #666;">
                            Sudah punya akun? <a href="#" onclick="showLogin()" style="color: #667eea; text-decoration: none; font-weight: 500;">Masuk sekarang</a>
                        </p>
                    </div>
                `,
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonText: 'Tutup',
                width: '400px',
                padding: '0',
                background: '#fff',
                customClass: {
                    popup: 'register-popup-new',
                    cancelButton: 'swal2-cancel-custom'
                }
            });

            // Handle form submission
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('register_name').value;
                const email = document.getElementById('register_email').value;
                const password = document.getElementById('register_password').value;
                const passwordConfirmation = document.getElementById('register_password_confirmation').value;
                const terms = document.getElementById('register_terms').checked;

                if (password !== passwordConfirmation) {
                    alert('Password dan konfirmasi password tidak sama!');
                    return;
                }

                if (!terms) {
                    alert('Anda harus menyetujui syarat dan ketentuan!');
                    return;
                }

                if (name && email && password && passwordConfirmation && terms) {
                    // Here you would typically send the register request
                    window.location.href = '{{ route('register') }}';
                }
            });
        }

        function selectTemplate(type) {
            const templates = {
                'fnb': 'Template Food & Beverage',
                'tech': 'Template Tech Store',
                'barber': 'Template Barbershop',
                'aksesoris-mobil': 'Template Aksesoris Mobil',
                'aksesoris-hp': 'Template Aksesoris HP',
                'fashion': 'Template Fashion',
                'kosmetik': 'Template Kosmetik',
                'atk': 'Template ATK',
                'toko-bangunan': 'Template Toko Bangunan',
                'salon': 'Template Salon'
            };

            Swal.fire({
                title: 'Template Dipilih!',
                text: `Anda memilih ${templates.name}. Lanjutkan ke halaman kustomisasi?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#667eea'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengalihkan...',
                        text: 'Mengarahkan ke halaman kustomisasi',
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        function showDemo(type) {
            const demos = {
                'Katalog_FnB': 'Demo Katalog F&B',
                'KatalogTokoKomputer': 'Demo Katalog Tech Store',
                'BARBER1': 'Demo Katalog Barbershop',
                'AksesorisMobil': 'Demo Katalog Aksesoris Mobil',
                'Aksesoris_HP': 'Demo Katalog Aksesoris HP',
                'Fashion': 'Demo Katalog Fashion',
                'demo/toko_kosmetik': 'Demo Katalog Kosmetik',
                'e-katalog-ATK-detailed': 'Demo Katalog ATK',
                'e-katalog-toko-bangunan': 'Demo Katalog Toko Bangunan',
                'salon': 'Demo Katalog Salon'
            };

            Swal.fire({
                title: demos[type] || 'Demo Katalog',
                text: 'Membuka demo di tab baru...',
                icon: 'info',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                // Untuk demo kosmetik, gunakan route Laravel
                if (type === 'demo/toko_kosmetik') {
                    window.open('/demo/toko-kosmetik', '_blank');
                } else {
                    // Buka folder katalog di tab baru untuk demo lainnya
                    window.open(`/${type}/index.html`, '_blank');
                }
            });
        }
    </script>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>
