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

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    <style>
        .tutorial-section {
            padding: 80px 0;
            position: relative;
            background-color: #ffffff;
            overflow: hidden;
            border-top: 1px solid #e9ecef;
        }

        .show-tutorial-btn {
            display: inline-block;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            padding: 18px 45px;
            border-radius: 50px;
            background: linear-gradient(45deg, #478413, #6a9c3b);
            border: none;
            color: white;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(71, 132, 19, 0.2);
            transition: all 0.3s ease-in-out;
            margin-bottom: 40px;
        }

        .show-tutorial-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 30px rgba(71, 132, 19, 0.3);
            color: white;
        }

        .show-tutorial-btn .fas {
            font-size: 1.3rem;
            vertical-align: middle;
        }

        .tutorial-content {
            margin-top: 20px;
        }

        .video-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .video-responsive {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 */
        }

        .video-responsive-portrait {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding-top: 177.77%;
            /* 9:16 */
        }

        .video-responsive iframe,
        .video-responsive-portrait iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* --- AWAL PERUBAHAN: CSS untuk Timeline Vertikal --- */
        .vertical-timeline {
            position: relative;
            padding-left: 50px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-left: 3px solid #e9ecef;
            margin-left: -28px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            left: -28px;
            top: 0;
            width: 50px;
            height: 50px;
            background-color: #478413;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 3px #478413;
        }

        .timeline-content {
            padding-left: 40px;
        }

        .timeline-content h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .timeline-content p {
            font-size: 0.95rem;
            color: #6c757d;
            line-height: 1.6;
        }

        /* --- AKHIR PERUBAHAN --- */
    </style>
</head>

<body class="landing-page">
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
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#demo">Template</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tutorial">Panduan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="d-flex gap-2 auth-buttons">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle d-flex align-items-center gap-2"
                                type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->avatar && !empty(Auth::user()->avatar))
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle"
                                        style="width: 24px; height: 24px;">
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
                                    <h6 class="dropdown-header">{{ Auth::user()->email }}</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                            class="fas fa-user me-2"></i>Profil Saya</a></li>
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

    <section id="home" class="hero-section">
        <div class="hero-bg">
            <div id="heroBgCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img
                            src="{{ asset('https://aici-umg.com/wp-content/uploads/2024/09/Perkembangan-AI-Inovasi-Terbaru-dan-Ke-Depan.webp') }}"
                            alt="slide-1"></div>
                    <div class="carousel-item"><img
                            src="{{ asset('https://omghcontent.affino.com/AcuCustom/Sitename/DAM/235/SINGLE_USE_AI_BING.jpg') }}"
                            alt="slide-2">
                    </div>
                    <div class="carousel-item"><img
                            src="{{ asset('https://resources-public-blog.modulabs.co.kr/blog/prd/content/266100/ai-agents-the-future-of-work.jpg') }}"
                            alt="slide-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>
        <div class="floating-element floating-1"></div>
        <div class="floating-element floating-2"></div>
        <div class="floating-element floating-3"></div>
        <div class="floating-element floating-4"></div>
        <div class="floating-element floating-5"></div>
        <div class="container h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-10 d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="hero-content">
                        <h1 class="hero-title animate__animated animate__fadeInUp">Platform Katalog Digital <span
                                style="color: #f99a07;">Terdepan</span></h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                            Mulai dari Rp 15.000/bulan, Anda sudah dapat memiliki katalog atau menu digital yang
                            professional untuk bisnis anda. Dapatkan gratis 2 Bulan langganan untuk satu tahun
                            pembelian hanya Rp 150.000/tahun.
                        </p>
                        <div class="hero-buttons animate__animated animate__fadeInUp animate__delay-2s">
                            <a href="#demo" class="btn-hero btn-hero-primary"><i class="fas fa-rocket"></i> Miliki
                                Sekarang</a>
                            <a href="#features" class="btn-hero btn-hero-outline">Features</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="demo" class="demo-section">
        <div class="container">
            <div class="section-title">
                <div class="section-subtitle">Template Trending & Desain Bersih</div>
                <h2 class="section-main-title">Koleksi Template Katalog dan Menu Yang Bisa Anda Miliki</h2>
            </div>
            <div class="row">
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
                                        onclick="showDemo('{{ $template->name }}')" target="_blank">Demo</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section id="features" class="features-section">
        <div class="container">
            <div class="section-title">
                <div class="section-subtitle">Mengenal Lebih Dekat</div>
                <h2 class="section-main-title">Tentang KatalogQu</h2>
                <p class="section-description">Platform inovatif yang memungkinkan bisnis untuk membuat katalog digital
                    yang menarik, profesional, dan mudah diakses oleh pelanggan di mana saja.</p>
            </div>
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="about-content">
                        <h3 class="about-subtitle">Misi Kami</h3>
                        <h4 class="about-title">Memudahkan Bisnis Berkembang di Era Digital</h4>
                        <p class="about-text">KatalogQu hadir untuk membantu setiap bisnis, dari UMKM hingga perusahaan
                            besar, dalam menciptakan katalog digital yang profesional dan menarik. Kami percaya bahwa
                            setiap produk memiliki cerita yang layak untuk diceritakan dengan cara yang terbaik.</p>
                        <p class="about-text">Dengan teknologi terdepan dan desain yang user-friendly, kami
                            memungkinkan siapa saja untuk membuat katalog digital yang tidak hanya indah dipandang,
                            tetapi juga efektif dalam meningkatkan penjualan dan engagement pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <div class="image-wrapper">
                            <div class="floating-card card-1"><i class="fas fa-chart-line"></i><span>Peningkatan
                                    Penjualan</span></div>
                            <div class="floating-card card-2"><i class="fas fa-users"></i><span>Engagement
                                    Tinggi</span></div>
                            <div class="floating-card card-3"><i class="fas fa-mobile-alt"></i><span>Mobile
                                    Friendly</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-rocket"></i></div>
                        <h5 class="feature-title">Mudah & Cepat</h5>
                        <p class="feature-description">Buat katalog digital profesional dalam hitungan menit tanpa
                            perlu keahlian teknis khusus.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-palette"></i></div>
                        <h5 class="feature-title">Template Beragam</h5>
                        <p class="feature-description">Pilihan template yang disesuaikan untuk berbagai jenis bisnis
                            dan industri.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                        <h5 class="feature-title">Responsif</h5>
                        <p class="feature-description">Katalog yang sempurna di semua perangkat, dari desktop hingga
                            smartphone.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-share-alt"></i></div>
                        <h5 class="feature-title">Mudah Dibagikan</h5>
                        <p class="feature-description">Bagikan katalog Anda melalui link, media sosial, atau embed di
                            website.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
                        <h5 class="feature-title">Analytics</h5>
                        <p class="feature-description">Pantau performa katalog dengan analytics mendalam dan insights
                            yang actionable.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-headset"></i></div>
                        <h5 class="feature-title">Support 24/7</h5>
                        <p class="feature-description">Tim support yang siap membantu Anda kapan saja untuk kesuksesan
                            bisnis Anda.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-5">
                {{-- <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">{{ $templateCount }}</div>
                        <div class="stat-label">Katalog Dibuat</div>
                    </div>
                </div> --}}
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">{{ $user_stores }}</div>
                        <div class="stat-label">Bisnis Terdaftar</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">{{ $templateCount }}</div>
                        <div class="stat-label">Template Tersedia</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tutorial" class="tutorial-section">
        <div class="container">
            <div class="section-title text-center">
                <div class="section-subtitle">Panduan Cepat & Interaktif</div>
                <h2 class="section-main-title">Cara Pakai KatalogQu</h2>
                <p class="section-description">Membuat katalog digital profesional kini lebih mudah dari sebelumnya.
                    Klik tombol di bawah untuk melihat panduan lengkapnya.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <a class="show-tutorial-btn" data-bs-toggle="collapse" href="#tutorialCollapseContent"
                        role="button" aria-expanded="false" aria-controls="tutorialCollapseContent">
                        <i class="fas fa-play-circle me-2"></i> Panduan
                    </a>
                    <div class="collapse" id="tutorialCollapseContent">
                        <div class="tutorial-content">
                            <div class="row g-5 align-items-center">
                                <div class="col-lg-6">
                                    <div class="video-container">
                                        <div class="video-responsive-portrait">
                                            <iframe id="youtubeVideo"
                                                src="https://youtube.com/embed/k_ZXMZJFMQo?rel=0"
                                                title="Panduan KatalogQu" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen loading="lazy"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="vertical-timeline">
                                        <div class="timeline-item">
                                            <div class="timeline-icon">1</div>
                                            <div class="timeline-content">
                                                <h5>Selesaikan Pembayaran</h5>
                                                <p>Pilih template dan selesaikan pembayaran melalui metode yang aman.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-icon">2</div>
                                            <div class="timeline-content">
                                                <h5>Setup Toko Digital</h5>
                                                <p>Isi informasi dasar toko seperti nama, deskripsi, dan subdomain unik.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-icon">3</div>
                                            <div class="timeline-content">
                                                <h5>Kelola Produk Anda</h5>
                                                <p>Masuk ke dasbor admin untuk menambah produk, kategori, dan lainnya.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-icon">4</div>
                                            <div class="timeline-content">
                                                <h5>Dapatkan QR Code</h5>
                                                <p>Unduh QR Code dalam format template menarik untuk dicetak atau
                                                    dibagikan.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-icon">5</div>
                                            <div class="timeline-content">
                                                <h5>Bagikan & Jangkau Pelanggan</h5>
                                                <p>Bagikan link atau QR Code di media sosial dan toko fisik Anda.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fab-container">
        <div class="fab-dropdown" id="fab-dropdown">
            <a href="https://wa.me/6281572505989?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20KatalogQu."
                target="_blank">
                <i class="fab fa-whatsapp whatsapp-icon"></i>
                <span>Contact via WhatsApp</span>
            </a>
        </div>
        <button class="fab-button" id="fab-toggle">
            <i class="fas fa-comments"></i>
        </button>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-4">
                    <div class="footer-section">
                        <div class="footer-brand">
                            <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                                class="footer-logo-img" style="width: 120px; height: auto;">
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
                            <li><a href="#tutorial">Panduan</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-section">
                        <h5>Contact</h5>
                        <div class="contact-info">
                            <p>Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV No.172 Kompleks, Asam Kumbang, Kec.
                                Medan Selayang, Kota Medan, Sumatera Utara 20133</p>
                            <p><a href="mailto:info@katalogqu.com">pteraciptadigital@gmail.com</a><br>08116584545</p>
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
                    <a href="https://pteraciptadigital.id/about" target="_blank">&copy; 2025 PT. Era Cipta
                        Digital</a>
                </div>
            </div>
        </div>
    </footer>

    <button class="scroll-top" id="scrollTop"><i class="fas fa-chevron-up"></i></button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
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

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                // Handle active class on navbar link click for immediate feedback
                if (this.closest('.navbar-nav')) {
                    document.querySelectorAll('.navbar-nav .nav-link').forEach(navLink => {
                        navLink.classList.remove('active');
                    });
                    this.classList.add('active');
                }

                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            const navHeight = document.getElementById('navbar').offsetHeight;
            let currentId = 'home'; // Default to home

            sections.forEach(section => {
                const sectionTop = section.offsetTop - navHeight - 50; // Add a 50px buffer
                if (window.scrollY >= sectionTop) {
                    currentId = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + currentId) {
                    link.classList.add('active');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const collapseElement = document.getElementById('tutorialCollapseContent');
            const youtubeVideo = document.getElementById('youtubeVideo');

            collapseElement.addEventListener('hidden.bs.collapse', function() {
                youtubeVideo.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}',
                    '*');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
        // --- JavaScript untuk Tombol WhatsApp Mengambang ---
        document.addEventListener('DOMContentLoaded', function() {
            const fabToggle = document.getElementById('fab-toggle');
            const fabDropdown = document.getElementById('fab-dropdown');

            if (fabToggle && fabDropdown) {
                fabToggle.addEventListener('click', function(event) {
                    event.stopPropagation(); // Mencegah event 'click' menyebar ke window
                    fabDropdown.classList.toggle('show');
                });

                // Menutup dropdown jika pengguna mengklik di luar area tombol
                window.addEventListener('click', function(event) {
                    if (!fabToggle.contains(event.target) && !fabDropdown.contains(event.target)) {
                        fabDropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>

    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const scrollTop = document.getElementById('scrollTop');

            if (window.scrollY > 100) {
                // Navbar berubah solid
                navbar.style.background = "#ffffff";
                navbar.style.boxShadow = "0 2px 6px rgba(0,0,0,0.1)";

                // Tombol scrollTop muncul
                if (scrollTop) {
                    scrollTop.style.display = "block";
                }
            } else {
                // Navbar transparan
                navbar.style.background = "transparent";
                navbar.style.boxShadow = "none";

                // Tombol scrollTop hilang
                if (scrollTop) {
                    scrollTop.style.display = "none";
                }
            }
        });
    </script>


</body>

</html>
