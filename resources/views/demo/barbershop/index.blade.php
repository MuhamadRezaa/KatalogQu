{{--
====================================================================================================
| KONTEN STATIS UNTUK DEMO                                                                         |
====================================================================================================
| Halaman ini menggunakan data statis untuk keperluan demo.                                        |
====================================================================================================
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/demo/barbershop/img/klasik.png') }}" type="image/x-icon">
    <title>Low Barber - Barbershop Premium</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/barbershop/styles.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    {{-- CSS TAMBAHAN UNTUK MODAL SIDE-BY-SIDE & UI LAINNYA --}}
    <style>
        .modal-body {
            display: flex;
            flex-direction: column;
            /* Default untuk mobile: gambar di atas, teks di bawah */
            gap: 1.5rem;
        }

        .modal-image-container,
        .modal-info-container {
            width: 100%;
        }

        @media (min-width: 768px) {

            /* Tampilan untuk tablet dan desktop */
            .modal-body {
                flex-direction: row;
                /* Ubah menjadi layout berdampingan */
                align-items: flex-start;
            }

            .modal-image-container {
                width: 40%;
                /* Lebar untuk gambar */
                flex-shrink: 0;
            }

            .modal-info-container {
                width: 60%;
                /* Lebar untuk info */
            }
        }

        .pagination-container {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 10px 15px;
            background-color: #fff;
            color: #555;
            border-right: 1px solid #ddd;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9em;
        }

        .pagination li:first-child a,
        .pagination li:first-child span {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .pagination li:last-child a,
        .pagination li:last-child span {
            border-right: 0;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .pagination li.active span {
            background-color: #4A90E2;
            color: #fff;
            border-color: #4A90E2;
            cursor: default;
        }

        .pagination li.disabled span {
            color: #aaa;
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .pagination li a:hover {
            background-color: #f0f0f0;
        }

        /* Style untuk Filter Container */
        .filter-container {
            background-color: #13120e;
            /* Warna background diubah di sini */
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(255, 1, 1, 0.08);
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            flex-grow: 1;
            min-width: 200px;
        }

        .filter-dropdown {
            min-width: 180px;
        }

        /* Style untuk old price */
        .service-old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9em;
            margin-top: 4px;
        }

        .service-price+.service-old-price {

            margin-top: -5px;

        }



        /* Gaya untuk thumbnail di modal */

        .thumbnail-container {

            display: flex;

            gap: 10px;

            margin-top: 15px;

            flex-wrap: wrap;

        }



        .thumbnail {

            border: 2px solid transparent;

            border-radius: 8px;

            cursor: pointer;

            padding: 0;

            background: none;

            width: 80px;

            height: 80px;

            overflow: hidden;

            transition: border-color 0.3s;

        }



        .thumbnail.active,

        .thumbnail:hover {

            border-color: #f39c12;

            /* Oranye */

        }



        .thumbnail-image {

            width: 100%;

            height: 100%;

            object-fit: cover;

        }
    </style>

    <style>
        /* Navbar Styles */
        .navbar {
            background-color: rgba(18, 18, 18, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.3s ease, padding 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar.scrolled {
            background-color: #121212;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            padding: 0.5rem 2rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: rotate(-15deg);
        }

        .navbar-nav {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: #e0e0e0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
            padding-bottom: 5px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #f39c12;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background-color: #f39c12;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .navbar-toggler {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive Navbar */
        @media (max-width: 992px) {
            .navbar {
                padding: 1rem;
            }

            .navbar.scrolled {
                padding: 0.75rem 1rem;
            }

            .navbar-nav {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: #1c1c1c;
                flex-direction: column;
                align-items: center;
                gap: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s ease-in-out, padding 0.3s ease-in-out;
                padding: 0;
            }

            .navbar-nav.active {
                max-height: 500px;
                /* Or a large enough value */
                padding: 1rem 0;
                border-top: 1px solid #333;
            }

            .nav-link {
                padding: 1rem;
                width: 100%;
                text-align: center;
            }

            .nav-link:hover::after,
            .nav-link.active::after {
                width: 0;
            }

            .navbar-toggler {
                display: block;
            }
        }
    </style>
    <style>
        @media (max-width: 992px) {
            .footer-content {
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: flex-start !important;
                gap: 1.5rem;
            }

            .footer-brand {
                flex-shrink: 0;
            }

            .footer-contact .footer-list {
                padding: 0;
                list-style: none;
                margin: 0;
            }

            .footer-contact .footer-list li {
                display: flex;
                align-items: flex-start;
                gap: 0.75rem;
                margin-bottom: 0.5rem;
            }

            .footer-contact .footer-list li i {
                width: 1.2em;
                text-align: center;
                margin-top: 0.15em;
            }

            .footer-social {
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <a href="#home" class="navbar-brand">
            <img src="{{ asset('assets/demo/barbershop/img/klasik.png') }}" alt="Low Barber Logo">
            <span>Low Barber</span>
        </a>
        <button class="navbar-toggler" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    {{-- Bagian Hero (Slider Banner) --}}
    <section id="home" class="hero" style="padding-top: 80px;">

        <div class="hero-overlay"></div>

        <div class="hero-background-slider">

            {{-- Data Banner Statis --}}

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

        <div class="hero-content">

            <div class="hero-badge">

                <span class="badge-text">✨ Barbershop Premium</span>

            </div>

            <h1 class="hero-title">

                <span class="title-main">Low Barber</span>

                <span class="title-sub">Professional Style</span>

            </h1>

            <p class="hero-subtitle">

                Transformasi penampilan Anda dengan sentuhan profesional dan gaya modern yang memukau

            </p>

            <div class="hero-features">

                <div class="feature-item"><i class="fas fa-award"></i><span>Kualitas Premium</span></div>

                <div class="feature-item"><i class="fas fa-clock"></i><span>Layanan Cepat</span></div>

                <div class="feature-item"><i class="fas fa-star"></i><span>Hasil Memuaskan</span></div>

            </div>

        </div>

        <div class="slider-nav">

            <button class="slider-btn prev" aria-label="Slide sebelumnya"><i class="fas fa-chevron-left"></i></button>

            <button class="slider-btn next" aria-label="Slide selanjutnya"><i class="fas fa-chevron-right"></i></button>

        </div>

        <div class="slider-dots">

            {{-- Dots Statis --}}

            <button class="dot active" data-slide="0" aria-label="Slide 1"></button>

            <button class="dot" data-slide="1" aria-label="Slide 2"></button>

            <button class="dot" data-slide="2" aria-label="Slide 3"></button>

        </div>

    </section>



    {{-- Layanan & Gaya Rambut Statis --}}

    <section id="services-and-styles" class="services">

        <div class="container">

            <div class="section-header">

                <h2 class="section-title">Kategori</h2>

                <p class="section-subtitle">

                    Pilih layanan atau temukan inspirasi gaya rambut yang paling cocok untuk Anda.

                </p>

            </div>



            <div class="category-cards-container">



                <button class="card-category active" data-filter="all">



                    <div class="card-content">



                        <img src="{{ asset('assets/demo/barbershop/img/all.jpg') }}" alt="Semua Kategori"
                            class="card-image-icon">



                        <h3 class="card-title">Semua Kategori</h3>



                    </div>



                </button>







                {{-- Kategori Statis --}}



                <button class="card-category" data-filter="potong-rambut">



                    <img src="{{ asset('assets/demo/barbershop/img/klasik.png') }}" alt="Potong Rambut"
                        class="card-image">



                    <div class="card-content">



                        <h3 class="card-title">Potong Rambut</h3>



                    </div>



                </button>



                <button class="card-category" data-filter="perawatan-jenggot">



                    <img src="{{ asset('assets/demo/barbershop/img/beardtrim.jpg') }}" alt="Perawatan Jenggot"
                        class="card-image">



                    <div class="card-content">



                        <h3 class="card-title">Perawatan Jenggot</h3>



                    </div>



                </button>



                <button class="card-category" data-filter="paket-premium">



                    <img src="{{ asset('assets/demo/barbershop/img/premiun.jpg') }}" alt="Paket Premium"
                        class="card-image">



                    <div class="card-content">



                        <h3 class="card-title">Paket Premium</h3>



                    </div>



                </button>



            </div>







            <style>
                /* Gaya untuk wadah kartu utama */



                .category-cards-container {



                    display: flex;



                    flex-wrap: wrap;



                    gap: 1.5rem;



                    justify-content: center;



                    padding: 1.5rem 0;



                }







                /* Gaya dasar untuk setiap kartu kategori */



                .card-category {



                    display: flex;



                    flex-direction: column;



                    align-items: center;



                    text-align: center;



                    cursor: pointer;



                    border: 2px solid transparent;



                    border-radius: 15px;



                    padding: 1rem;



                    background-color: #2c3e50;



                    color: #ecf0f1;



                    transition: all 0.3s ease;



                    width: 150px;



                    min-height: 180px;



                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);



                }







                .card-category:hover {



                    transform: translateY(-5px);



                    background-color: #34495e;



                    border-color: #f39c12;



                }







                .card-category.active {



                    background-color: #f39c12;



                    border-color: #f39c12;



                    color: #2c3e50;



                    box-shadow: 0 4px 20px rgba(243, 156, 18, 0.5);



                }







                .card-category.active .card-title,



                .card-category.active .fa-tags {



                    color: #2c3e50;



                }







                /* Gaya untuk gambar di dalam kartu */



                .card-image {



                    width: 100%;



                    max-width: 120px;



                    height: 100px;



                    object-fit: contain;



                    /* Corrected value */



                    border-radius: 10px;



                    margin-bottom: 0.5rem;



                }







                /* Gaya untuk konten di dalam kartu (ikon dan teks) */



                .card-content {



                    display: flex;



                    flex-direction: column;



                    align-items: center;



                    justify-content: center;



                    height: 100%;



                }







                .card-title {



                    margin: 0;



                    font-size: 1rem;



                    font-weight: 600;



                }







                /* Gaya untuk gambar yang menggantikan ikon */



                .card-image-icon {



                    width: 60px;



                    height: 60px;



                    object-fit: contain;



                    margin-bottom: 0.5rem;



                }
            </style>



            {{-- Container for Sub-Category Filters (will be populated by JS) --}}

            <div id="sub-category-filters" class="sub-category-container" style="display: none;"></div>



            <style>
                .sub-category-container {

                    display: flex;

                    justify-content: center;

                    flex-wrap: wrap;

                    gap: 0.75rem;

                    margin-top: 1.5rem;

                    padding: 1rem 0;

                    transition: all 0.5s ease-in-out;

                }



                .sub-category-btn {

                    background-color: #3e3d3b;

                    color: #e0e0e0;

                    padding: 0.5rem 1rem;

                    border: 1px solid #575757;

                    border-radius: 20px;

                    font-size: 0.9rem;

                    cursor: pointer;

                    transition: all 0.3s ease;

                }



                .sub-category-btn.active,

                .sub-category-btn:hover {

                    background-color: #f39c12;

                    color: #121212;

                    border-color: #f39c12;

                }
            </style>



            {{-- Panel Filter Baru --}}

            <div class="filter-container">

                <input type="text" id="search-input" placeholder="Cari nama layanan..."
                    class="search-input service-btn" />



                <select id="price-filter" class="filter-dropdown service-btn">

                    <option value="all">Semua Harga</option>

                    {{-- Harga Statis --}}

                    <option value="0-50000">Di bawah Rp 50.000</option>

                    <option value="50000-100000">Rp 50.000 - Rp 100.000</option>

                    <option value="100000-9999999">Di atas Rp 100.000</option>

                </select>



                <select id="sort-filter" class="filter-dropdown service-btn">

                    <option value="default">Urutkan</option>

                    <option value="price-asc">Harga Terendah</option>

                    <option value="price-desc">Harga Tertinggi</option>

                    <option value="name-asc">Nama A-Z</option>

                    <option value="name-desc">Nama Z-A</option>

                </select>

            </div>



            <style>
                /* --- Gaya untuk Wadah Filter Utama --- */

                .filter-container {

                    background-color: #2c2b29;

                    /* Warna latar belakang gelap */

                    padding: 2rem;

                    border-radius: 10px;

                    display: flex;

                    /* Menggunakan Flexbox untuk tata letak yang rapi */

                    flex-wrap: wrap;

                    gap: 1rem;

                    /* Jarak antar elemen filter */

                    align-items: center;

                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);

                }



                /* --- Gaya untuk Input Pencarian dan Dropdown --- */

                .search-input,

                .filter-dropdown {

                    font-family: 'Poppins', sans-serif;

                    font-size: 1rem;

                    padding: 0.75rem 1.25rem;

                    border: 2px solid #575757;

                    /* Border abu-abu tua */

                    border-radius: 50px;

                    /* Sudut membulat penuh */

                    background-color: #3e3d3b;

                    /* Warna latar belakang elemen */

                    color: #e0e0e0;

                    /* Warna teks */

                    transition: all 0.3s ease;

                    -webkit-appearance: none;

                    -moz-appearance: none;

                    appearance: none;

                    outline: none;

                    cursor: pointer;

                }



                /* Mengatur lebar input pencarian */

                .search-input {

                    flex-grow: 1;

                    min-width: 200px;

                    /* Lebar minimum pada layar kecil */

                }



                /* Mengatur lebar dropdown */

                .filter-dropdown {

                    min-width: 180px;

                }



                /* Efek saat elemen filter di-hover atau difokuskan */

                .search-input:hover,

                .filter-dropdown:hover,

                .search-input:focus,

                .filter-dropdown:focus {

                    border-color: #f39c12;

                    /* Warna border oranye saat di-hover/fokus */

                    box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.4);

                    /* Efek bayangan saat fokus */

                }



                /* Gaya untuk panah dropdown yang disesuaikan */

                .filter-dropdown {

                    background-image: url('data:image/svg+xml;utf8,<svg fill="%23e0e0e0" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');

                    background-repeat: no-repeat;

                    background-position: right 1rem center;

                    background-size: 1.5em;

                    padding-right: 2.5rem;

                    /* Memberi ruang untuk ikon panah */

                }



                /* Gaya untuk opsi di dalam dropdown */

                .filter-dropdown option {

                    background-color: #3e3d3b;

                    color: #e0e0e0;

                }
            </style>



            {{-- Grid Produk/Layanan --}}

            <div class="services-grid" id="product-grid">

                {{-- Konten diisi oleh JavaScript --}}

            </div>



            {{-- Pesan tidak ada hasil --}}

            <div id="no-results-message" style="display: none; text-align: center; color: #666; margin: 40px 0;">

                Tidak ada layanan yang ditemukan dengan filter tersebut.

            </div>



            {{-- Pagination dihilangkan untuk demo client-side --}}

        </div>

    </section>



    <style>
        /* Gaya untuk section utama */

        #services-and-styles {

            position: relative;

            /* Penting untuk penempatan overlay */

            background-image: url('{{ asset('assets/images/barbershop-bg.jpg') }}');

            background-size: cover;

            background-position: center;

            background-attachment: fixed;

            /* Memberikan efek parallax */

            color: #f0f0f0;

            /* Mengubah warna teks agar terlihat jelas di atas background gelap */

            padding: 60px 0;

            /* Menambah ruang di atas dan bawah section */

        }



        /* Membuat overlay gelap untuk membuat teks lebih menonjol */

        #services-and-styles::before {

            content: '';

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;

            background-color: rgba(0, 0, 0, 0.7);

            /* Warna overlay hitam dengan transparansi 70% */

        }



        /* Memastikan konten di dalam section berada di atas overlay */

        #services-and-styles .container,

        #services-and-styles .section-header {

            position: relative;

            z-index: 2;

            /* Meletakkan konten di atas pseudo-element ::before */

        }



        /* Memperbaiki gaya teks di atas background gelap */

        .section-header h2.section-title,

        .section-header p.section-subtitle {

            color: #ffffff;

            /* Pastikan judul dan subtitle berwarna putih */

            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);

            /* Menambahkan bayangan teks agar lebih mudah dibaca */

        }
    </style>



    <style>
        /* ... kode CSS yang sudah ada ... */



        /* Tambahkan gaya ini untuk memberi jarak di bawah section Hero */

        .hero {

            margin-bottom: 3rem;

            /* Memberikan ruang kosong di bawah elemen Hero */

        }



        /* Atau, jika mau, tambahkan ruang di atas section Services */

        .services {

            margin-top: 3rem;

            margin-bottom: 3rem;

            /* Memberikan ruang kosong di atas elemen Services */

        }



        /* ... kode CSS yang sudah ada ... */

        /* Gaya untuk Grid Layanan */
        .services-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            /* Consistent gap between items */
            justify-content: center;
            /* Center the grid items */
            margin-top: 2rem;
            /* Space above the grid */
        }

        .services-grid>* {
            /* Target all direct children (service cards) */
            flex: 1 1 280px;
            /* Allow growing/shrinking, with a preferred base width of 280px */
            max-width: calc(33.333% - 1rem);
            /* Max 3 items per row on larger screens, considering gap */
            box-sizing: border-box;
            /* Include padding and border in the element's total width and height */

            /* Basic card styling to ensure consistency */
            background-color: #2c3e50;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #ecf0f1;
            transition: all 0.3s ease;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {

            /* For tablets and smaller desktops */
            .services-grid>* {
                max-width: calc(50% - 0.75rem);
                /* 2 items per row */
            }
        }

        @media (max-width: 600px) {

            /* For mobile devices */
            .services-grid>* {
                max-width: 100%;
                /* 1 item per row */
            }
        }
    </style>



    {{-- Footer --}}

    <footer id="contact" class="footer">

        <div class="container">

            <div class="footer-content">

                <div class="footer-brand" style="display: flex; flex-direction: column; align-items: center;">

                    <div class="hero-icon">
                        <img src="{{ asset('assets/demo/barbershop/img/klasik.png') }}" alt="Barbershop Logo"
                            style="width: 40px; height: 40px; object-fit: contain;">
                    </div>

                    <h1 style="margin-top: 0.5rem;">Low Barber</h1>

                </div>
                <div class="footer-contact">

                    <h3 class="footer-title">Kontak Kami</h3>

                    <ul class="footer-list">

                        <li><i class="fas fa-map-marker-alt"></i> Jl. Perjuangan No. 13, Medan 10220</li>

                        <li><i class="fas fa-phone"></i> +62 815-7250-5989</li>

                        <li><i class="fas fa-envelope"></i> info@barber.com</li>

                        <li><i class="fas fa-clock"></i> Sen-Sab: 09:00 - 21:00 | Minggu: 10:00 - 18:00</li>

                    </ul>

                    <div class="footer-social" style="margin-top: 15px">

                        <a href="#" class="social-link" aria-label="Instagram" target="_blank"><i
                                class="fab fa-instagram"></i></a>

                        <a href="#" class="social-link" aria-label="Facebook" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>

                    </div>

                </div>

            </div>

            <div class="footer-bottom">

                <p>&copy; {{ date('Y') }} Low Barber. Diberdayakan oleh KatalogQu</p>

            </div>

        </div>

    </footer>



    {{-- Modal Detail --}}

    <div id="product-modal" class="modal" style="display: none;">

        <div class="modal-content large">

            <button class="modal-close" id="modal-close">×</button>

            <div class="modal-body">

                <div class="modal-image-container">

                    <img id="modal-main-image" src="" alt="Detail Gambar" />

                    <div id="modal-thumbnail-container" class="thumbnail-container">

                    </div>

                </div>

                <div class="modal-info-container">

                    <h2 id="modal-title" class="modal-title"></h2>

                    <p id="modal-category" class="modal-category"></p>

                    <p id="modal-price" class="modal-price"></p>

                    <p id="modal-old-price" style="color:#999; text-decoration:line-through;"
                        class="modal-old-price"></p>

                    <h3 class="modal-subtitle">Deskripsi</h3>

                    <p id="modal-description" class="modal-description"></p>

                    <h3 class="modal-subtitle">Spesifikasi / Detail</h3>

                    <ul id="modal-specs" class="modal-specs">

                    </ul>

                    <a id="chat-button" href="#" target="_blank" class="modal-chat-button">

                        <i class="fab fa-whatsapp "></i> Hubungi Kami

                    </a>

                </div>

            </div>

        </div>

    </div>



    <template id="thumbnail-template">

        <button class="thumbnail"><img class="thumbnail-image" src="" alt="thumbnail" /></button>

    </template>



    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'barbershop',
    ])



    <script>
        // ===================================================================================

        // SCRIPT UTAMA

        // ===================================================================================



        // 1. PERSIAPAN DATA PRODUK STATIS UNTUK DEMO

        // =================================================

        window.productsData = [

            {

                id: 1,

                name: 'Classic Cut',

                slug: 'classic-cut',

                price: 75000,

                description: 'Classic Cut adalah potongan rambut klasik yang tak lekang oleh waktu, cocok untuk semua usia dan memberikan tampilan rapi serta profesional.',

                category_slug: 'potong-rambut',

                category_name: 'Potong Rambut',

                sub_category_slug: 'potongan-classic',

                sub_category_name: 'Potongan Classic',

                images: [

                    "{{ asset('assets/demo/barbershop/img/klasik.png') }}",


                ],

                specs: {

                    'Durasi': '45 Menit',

                    'Termasuk': 'Cuci rambut, pijat kepala ringan, styling dengan pomade',

                    'Cocok untuk': 'Semua jenis rambut'

                },

            },


            {
                id: 2,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },
            {
                id: 3,
                name: 'Beard Trim',
                slug: 'beard-trim',
                price: 45000,
                old_price: null,
                description: 'Perapian jenggot agar tampak rapi, bersih, dan sesuai bentuk wajah untuk tampilan yang maskulin.',
                category_slug: 'perawatan-jenggot',
                category_name: 'Perawatan Jenggot',
                sub_category_slug: null,
                sub_category_name: null,
                images: [
                    "{{ asset('assets/demo/barbershop/img/beardtrim.jpg') }}",
                ],
                specs: {
                    'Durasi': '30 Menit',
                    'Termasuk': 'Shaping, trimming, dan aplikasi beard oil',
                },
            },
            {
                id: 4,
                name: 'Premium Package',
                slug: 'premium-package',
                price: 150000,
                description: 'Paket perawatan lengkap mulai dari potong rambut, perapian jenggot, hingga styling premium untuk tampilan maksimal.',
                category_slug: 'paket-premium',
                category_name: 'Paket Premium',
                sub_category_slug: null,
                sub_category_name: null,
                images: [
                    "{{ asset('assets/demo/barbershop/img/premiun.jpg') }}",
                ],
                specs: {
                    'Durasi': '90 Menit',
                    'Termasuk': 'Haircut, Beard Trim, Hair Wash, Creambath, Hot Towel, Styling',
                },
            },
            {
                id: 5,
                name: 'Hair Wash & Style',
                slug: 'hair-wash-style',
                price: 35000,
                old_price: null,
                description: 'Cuci rambut menyegarkan dilanjutkan dengan penataan stylish untuk tampilan rapi dan percaya diri sepanjang hari.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'lainnya',
                sub_category_name: 'Lainnya',
                images: [
                    "{{ asset('assets/demo/barbershop/img/hairwash.jpeg') }}",
                ],
                specs: {
                    'Durasi': '25 Menit',
                    'Termasuk': 'Cuci, pengeringan, dan styling',
                },
            },
            {
                id: 6,
                name: 'Kids Cut',
                slug: 'kids-cut',
                price: 50000,
                old_price: null,
                description: 'Potongan rambut rapi dan nyaman untuk anak-anak, dengan gaya yang lucu dan mudah diatur.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'anak-anak',
                sub_category_name: 'Anak-anak',
                images: [
                    "{{ asset('assets/demo/barbershop/img/kids.jpg') }}",
                ],
                specs: {
                    'Durasi': '35 Menit',
                    'Usia': 'Di bawah 10 tahun',
                },
            },

            {
                id: 7,
                name: 'Coloring',
                slug: 'coloring',
                price: 100000,
                old_price: null,
                description: 'pewarnaan rambut yang sangat rapi dan bergradasi.',
                category_slug: 'warna-rambut',
                category_name: 'Warna Rambut',
                sub_category_slug: 'lainnya',
                sub_category_name: 'Lainnya',
                images: [
                    "{{ asset('assets/demo/barbershop/img/coloring.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 8,
                name: 'Perm',
                slug: 'perm',
                price: 200000,
                old_price: null,
                description: 'Perming Rambut Terbaik.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'lainnya',
                sub_category_name: 'Lainnya',
                images: [
                    "{{ asset('assets/demo/barbershop/img/perm.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 9,
                name: 'Smoothing',
                slug: 'smoothing',
                price: 50000,
                old_price: null,
                description: 'Smoothing ternyaman dan sangat recomended.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'lainnya',
                sub_category_name: 'Lainnya',
                images: [
                    "{{ asset('assets/demo/barbershop/img/smoot.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 10,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 11,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 12,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 13,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 14,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 15,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 16,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 17,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 18,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 19,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            },

            {
                id: 20,
                name: 'Modern Fade',
                slug: 'modern-fade',
                price: 85000,
                old_price: null,
                description: 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.',
                category_slug: 'potong-rambut',
                category_name: 'Potong Rambut',
                sub_category_slug: 'potongan-modern',
                sub_category_name: 'Potongan Modern',
                images: [
                    "{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}",
                ],
                specs: {
                    'Durasi': '50 Menit',
                    'Termasuk': 'Cuci rambut, hair tonic, styling',
                    'Gaya': 'Low Fade, High Fade, Skin Fade'
                },
            }


        ];

        // 2. LOGIKA UNTUK MODAL DETAIL, FILTER, DAN LAINNYA
        // =================================================
        document.addEventListener('DOMContentLoaded', function() {
            const productGrid = document.getElementById('product-grid');
            const modal = document.getElementById('product-modal');
            if (!modal) return;

            const modalClose = document.getElementById('modal-close');
            const mainImage = document.getElementById('modal-main-image');
            const thumbContainer = document.getElementById('modal-thumbnail-container');
            const thumbTemplate = document.getElementById('thumbnail-template');
            const titleEl = document.getElementById('modal-title');
            const categoryEl = document.getElementById('modal-category');
            const priceEl = document.getElementById('modal-price');
            const oldPriceEl = document.getElementById('modal-old-price');
            const descEl = document.getElementById('modal-description');
            const specsEl = document.getElementById('modal-specs');
            const chatButton = document.getElementById('chat-button');
            const noResultsMessage = document.getElementById('no-results-message');
            const paginationContainer = document.querySelector('.pagination-container');

            // Elemen Filter
            const searchInput = document.getElementById('search-input');
            const priceFilter = document.getElementById('price-filter');
            const sortFilter = document.getElementById('sort-filter');

            // Elemen Filter Kategori (menggunakan card)
            const categoryCards = document.querySelectorAll('.card-category');
            const subCategoryContainer = document.getElementById('sub-category-filters');

            function updateSubCategoryFilters(selectedCategorySlug) {
                if (!subCategoryContainer) return;
                subCategoryContainer.innerHTML = '';
                subCategoryContainer.style.display = 'none';

                if (selectedCategorySlug === 'all') {
                    return;
                }

                const productsInCat = window.productsData.filter(p => p.category_slug === selectedCategorySlug);
                const subCategories = {};
                productsInCat.forEach(p => {
                    if (p.sub_category_slug && p.sub_category_name) {
                        subCategories[p.sub_category_slug] = p.sub_category_name;
                    }
                });

                const subCategoryEntries = Object.entries(subCategories);

                if (subCategoryEntries.length > 0) {
                    const allBtn = document.createElement('button');
                    allBtn.className = 'sub-category-btn active';
                    allBtn.dataset.filter = 'all';
                    allBtn.textContent = 'Semua';
                    subCategoryContainer.appendChild(allBtn);

                    subCategoryEntries.forEach(([slug, name]) => {
                        const btn = document.createElement('button');
                        btn.className = 'sub-category-btn';
                        btn.dataset.filter = slug;
                        btn.textContent = name;
                        subCategoryContainer.appendChild(btn);
                    });
                    subCategoryContainer.style.display = 'flex';
                }
            }

            function formatRupiah(angka) {
                if (angka === null || typeof angka === 'undefined' || isNaN(Number(angka))) return 'Hubungi Kami';
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function renderProducts(productsToRender) {
                if (!productGrid) return;
                productGrid.innerHTML = '';
                if (productsToRender.length === 0) {
                    if (noResultsMessage) noResultsMessage.style.display = 'block';
                    return;
                }

                if (noResultsMessage) noResultsMessage.style.display = 'none';

                productsToRender.forEach(product => {
                    const imageSrc = product.images.length > 0 ? product.images[0] :
                        '{{ asset('assets/demo/barbershop/img/klasik.png') }}';

                    let priceHtml = `<div class="service-price">${formatRupiah(product.price)}</div>`;
                    if (product.old_price && Number(product.old_price) > Number(product.price)) {
                        priceHtml +=
                            `<div class="service-old-price">${formatRupiah(product.old_price)}</div>`;
                    }

                    const productHtml = `
                    <div class="service-card product-card"
                         data-product-id="${product.id}">
                        <div class="service-image">
                            <img src="${imageSrc}" alt="${product.name}" />
                            <div class="service-overlay">
                                <div class="service-duration">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Lihat Detail</span>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h3 class="service-name">${product.name}</h3>
                            ${priceHtml}
                            <p class="line-clamp-2 text-sm text-gray-500 mt-2">
                                ${(product.description || '').substring(0, 50)}${(product.description || '').length > 50 ? '...' : ''}
                            </p>
                        </div>
                    </div>
                `;
                    productGrid.insertAdjacentHTML('beforeend', productHtml);
                });
            }

            // Fungsi utama untuk filter dan sorting
            function applyFiltersAndSort() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
                const activeCategoryCard = document.querySelector('.card-category.active');
                const selectedCategory = activeCategoryCard ? activeCategoryCard.dataset.filter : 'all';
                const activeSubCategoryBtn = subCategoryContainer ? subCategoryContainer.querySelector(
                    '.sub-category-btn.active') : null;
                const selectedSubCategory = activeSubCategoryBtn ? activeSubCategoryBtn.dataset.filter : 'all';
                const priceRange = priceFilter ? priceFilter.value.split('-') : ['all'];
                const minPrice = priceRange[0] !== 'all' ? parseFloat(priceRange[0]) : 0;
                const maxPrice = priceRange[0] !== 'all' ? parseFloat(priceRange[1]) : Infinity;
                const sortBy = sortFilter ? sortFilter.value : 'default';

                let filtered = window.productsData.filter(p => {
                    const nameMatch = p.name.toLowerCase().includes(searchTerm);
                    const categoryMatch = selectedCategory === 'all' || p.category_slug ===
                        selectedCategory;
                    const subCategoryMatch = selectedSubCategory === 'all' || p.sub_category_slug ===
                        selectedSubCategory;
                    const priceMatch = p.price >= minPrice && p.price <= maxPrice;
                    return nameMatch && categoryMatch && subCategoryMatch && priceMatch;
                });

                // Sorting
                filtered.sort((a, b) => {
                    switch (sortBy) {
                        case 'price-asc':
                            return a.price - b.price;
                        case 'price-desc':
                            return b.price - a.price;
                        case 'name-asc':
                            return a.name.localeCompare(b.name);
                        case 'name-desc':
                            return b.name.localeCompare(a.name);
                        default:
                            return 0;
                    }
                });

                renderProducts(filtered);

                if (paginationContainer) {
                    paginationContainer.style.display = 'none';
                }
            }

            // Tambahkan event listener untuk kartu-kartu kategori
            if (categoryCards) {
                categoryCards.forEach(card => {
                    card.addEventListener('click', function() {
                        categoryCards.forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                        const categorySlug = this.dataset.filter;
                        updateSubCategoryFilters(categorySlug);
                        applyFiltersAndSort();

                        // Scroll ke grid produk setelah filter
                        const productGrid = document.getElementById('product-grid');
                        if (productGrid) {
                            setTimeout(() => {
                                productGrid.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 300);
                        }
                    });
                });
            }

            // Tambahkan event listener untuk tombol sub-kategori
            if (subCategoryContainer) {
                subCategoryContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('sub-category-btn')) {
                        subCategoryContainer.querySelector('.sub-category-btn.active')?.classList.remove(
                            'active');
                        e.target.classList.add('active');
                        applyFiltersAndSort();

                        // Scroll ke grid produk setelah filter
                        const productGrid = document.getElementById('product-grid');
                        if (productGrid) {
                            setTimeout(() => {
                                productGrid.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 300);
                        }
                    }
                });
            }

            // Tambahkan event listener ke filter lainnya
            if (searchInput) searchInput.addEventListener('input', applyFiltersAndSort);
            if (priceFilter) priceFilter.addEventListener('change', applyFiltersAndSort);
            if (sortFilter) sortFilter.addEventListener('change', applyFiltersAndSort);

            // Modal untuk produk dinamis
            if (productGrid) {
                productGrid.addEventListener('click', function(event) {
                    const card = event.target.closest('[data-product-id]');
                    if (!card) return;

                    const productId = parseInt(card.dataset.productId, 10);
                    const product = window.productsData.find(p => p.id === productId);
                    if (!product) return;

                    openProductModal(product);
                });
            }

            function openProductModal(product) {
                if (titleEl) titleEl.textContent = product.name;
                if (categoryEl) categoryEl.textContent = product.category_name;
                if (priceEl) priceEl.textContent = formatRupiah(product.price);
                if (descEl) descEl.innerHTML = product.description || '<i>Tidak ada deskripsi.</i>';

                if (oldPriceEl) {
                    if (product.old_price && Number(product.old_price) > Number(product.price)) {
                        oldPriceEl.textContent = formatRupiah(product.old_price);
                        oldPriceEl.style.display = 'inline';
                    } else {
                        oldPriceEl.style.display = 'none';
                    }
                }

                if (mainImage && product.images.length > 0) {
                    mainImage.src = product.images[0];
                }

                if (thumbContainer) {
                    thumbContainer.innerHTML = '';
                    if (product.images.length > 1) {
                        product.images.forEach((imgSrc, index) => {
                            if (thumbTemplate) {
                                const thumbNode = thumbTemplate.content.cloneNode(true);
                                const thumbBtn = thumbNode.querySelector('.thumbnail');
                                const thumbImg = thumbNode.querySelector('.thumbnail-image');
                                thumbImg.src = imgSrc;
                                thumbBtn.dataset.fullSrc = imgSrc;
                                if (index === 0) thumbBtn.classList.add('active');
                                thumbContainer.appendChild(thumbNode);
                            }
                        });
                    }
                }

                if (specsEl) {
                    specsEl.innerHTML = '';
                    if (product.specs && Object.keys(product.specs).length > 0) {
                        for (const [key, value] of Object.entries(product.specs)) {
                            const li = document.createElement('li');
                            li.innerHTML = `<strong>${key}:</strong> ${value}`;
                            specsEl.appendChild(li);
                        }
                    } else {
                        specsEl.innerHTML = '<li>Konsultasikan dengan barber kami untuk detail lebih lanjut.</li>';
                    }
                }

                if (chatButton) {
                    const phoneNumber = '6281572505989'; // Nomor telepon statis
                    if (phoneNumber) {
                        const message = `Halo, saya tertarik dengan layanan "${product.name}".`;
                        chatButton.href =
                            `https://wa.me/${phoneNumber.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`;
                        chatButton.style.display = 'flex';
                    } else {
                        chatButton.style.display = 'none';
                    }
                }

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            if (modalClose) modalClose.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });

            if (thumbContainer) {
                thumbContainer.addEventListener('click', function(e) {
                    const btn = e.target.closest('.thumbnail');
                    if (!btn) return;
                    if (mainImage) mainImage.src = btn.dataset.fullSrc;
                    document.querySelectorAll('#modal-thumbnail-container .thumbnail').forEach(el => el
                        .classList.remove('active'));
                    btn.classList.add('active');
                });
            }

            // Panggil filter saat pertama kali halaman dimuat
            applyFiltersAndSort();

            // Hero slider
            class HeroSlider {
                constructor() {
                    this.bgSlides = document.querySelectorAll('.bg-slide');
                    this.dots = document.querySelectorAll('.dot');
                    this.prevBtn = document.querySelector('.slider-btn.prev');
                    this.nextBtn = document.querySelector('.slider-btn.next');
                    this.currentSlide = 0;
                    this.totalSlides = this.bgSlides.length;
                    this.autoPlayInterval = null;
                    this.autoPlayDelay = 5000;
                    this.init();
                }

                init() {
                    if (this.totalSlides <= 1) {
                        if (this.prevBtn) this.prevBtn.style.display = 'none';
                        if (this.nextBtn) this.nextBtn.style.display = 'none';
                        if (document.querySelector('.slider-dots')) document.querySelector('.slider-dots').style
                            .display = 'none';
                        return;
                    }
                    this.bindEvents();
                    this.startAutoPlay();
                    this.goToSlide(this.currentSlide);
                }

                bindEvents() {
                    if (this.prevBtn) this.prevBtn.addEventListener('click', () => this.prevSlide());
                    if (this.nextBtn) this.nextBtn.addEventListener('click', () => this.nextSlide());
                    this.dots.forEach((dot) => {
                        dot.addEventListener('click', () => this.goToSlide(parseInt(dot.dataset
                            .slide)));
                    });
                }

                goToSlide(index) {
                    if (index < 0) index = this.totalSlides - 1;
                    if (index >= this.totalSlides) index = 0;
                    this.bgSlides.forEach(slide => slide.classList.remove('active'));
                    this.dots.forEach(dot => dot.classList.remove('active'));
                    if (this.bgSlides[index]) this.bgSlides[index].classList.add('active');
                    if (this.dots[index]) this.dots[index].classList.add('active');
                    this.currentSlide = index;
                    this.resetAutoPlay();
                }

                nextSlide() {
                    this.goToSlide(this.currentSlide + 1);
                }

                prevSlide() {
                    this.goToSlide(this.currentSlide - 1);
                }

                startAutoPlay() {
                    if (this.totalSlides > 1) {
                        this.autoPlayInterval = setInterval(() => this.nextSlide(), this.autoPlayDelay);
                    }
                }

                resetAutoPlay() {
                    if (this.autoPlayInterval) {
                        clearInterval(this.autoPlayInterval);
                    }
                    this.startAutoPlay();
                }
            }
            new HeroSlider();

            // Navbar scroll effect and mobile toggle
            const navbar = document.querySelector('.navbar');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarNav = document.querySelector('.navbar-nav');
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section');

            if (navbar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }

                    // Active link highlighting on scroll
                    let current = '';
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        if (pageYOffset >= sectionTop - 100) {
                            current = section.getAttribute('id');
                        }
                    });

                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href').includes(current)) {
                            link.classList.add('active');
                        }
                    });
                });
            }

            if (navbarToggler && navbarNav) {
                navbarToggler.addEventListener('click', () => {
                    navbarNav.classList.toggle('active');
                    const icon = navbarToggler.querySelector('i');
                    if (navbarNav.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });

                // Close menu when a link is clicked
                navLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        document.querySelector(link.getAttribute('href')).scrollIntoView({
                            behavior: 'smooth'
                        });
                        if (navbarNav.classList.contains('active')) {
                            navbarNav.classList.remove('active');
                            navbarToggler.querySelector('i').classList.remove('fa-times');
                            navbarToggler.querySelector('i').classList.add('fa-bars');
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>
