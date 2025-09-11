{{--
====================================================================================================
| KONTEN DINAMIS DARI DATABASE                                                                     |
====================================================================================================
| Halaman ini dikelola dari Admin Panel. Termasuk info toko, banner, kategori, dan produk/layanan.  |
====================================================================================================
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon"
        href="{{ $userStore->store_logo ? route('tenant.asset.domain', ['path' => $userStore->store_logo]) : asset('assets/demo/barbershop/img/klasik.png') }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'Classic Cuts Barbershop' }}</title>
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
    </style>
</head>

<body>
    {{-- Bagian Hero (Slider Banner) --}}
    <section id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-background-slider">
            @forelse ($banners as $banner)
                <div class="bg-slide {{ $loop->first ? 'active' : '' }}" data-slide="{{ $loop->index }}">
                    <div class="bg-image"
                        style="background-image: url('{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}')">
                    </div>
                </div>
            @empty
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
            @endforelse
        </div>
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
                {{ $userStore->store_description ?? 'Transformasi penampilan Anda dengan sentuhan profesional dan gaya modern yang memukau' }}
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
            @if ($banners->count() > 0)
                @foreach ($banners as $banner)
                    <button class="dot {{ $loop->first ? 'active' : '' }}" data-slide="{{ $loop->index }}"
                        aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            @else
                <button class="dot active" data-slide="0" aria-label="Slide 1"></button>
                <button class="dot" data-slide="1" aria-label="Slide 2"></button>
                <button class="dot" data-slide="2" aria-label="Slide 3"></button>
            @endif
        </div>
    </section>

    {{-- Layanan & Gaya Rambut Dinamis --}}
    <section id="services-and-styles" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Layanan & Gaya Rambut</h2>
                <p class="section-subtitle">
                    Pilih layanan atau temukan inspirasi gaya rambut yang paling cocok untuk Anda.
                </p>
            </div>

            <div class="category-cards-container">
                <button class="card-category active" data-filter="all">
                    <div class="card-content">
                        <img src="{{ asset('assets/demo/barbershop/img/allkategori.png') }}" alt="Semua Kategori"
                            class="card-image-icon">
                        <h3 class="card-title">Semua Kategori</h3>
                    </div>
                </button>

                @if (isset($categories) && $categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <button class="card-category" data-filter="{{ $category->slug ?? $category->id }}">
                            <img src="{{ $category->image
                                ? route('tenant.asset.domain', ['path' => ltrim($category->image, '/')])
                                : asset('assets/images/no-image-icon.png') }}"
                                alt="{{ $category->name }}" class="card-image">
                            <div class="card-content">
                                <h3 class="card-title">{{ $category->name }}</h3>
                            </div>
                        </button>
                    @endforeach
                @else
                    <p class="text-gray-500">Belum ada kategori</p>
                @endif
            </div>

            <style>
                /* Gaya untuk wadah kartu utama */
                .category-cards-container {
                    display: flex;
                    /* Kunci untuk membuat kartu-kartu berjejer horizontal */
                    flex-wrap: wrap;
                    /* Agar kartu turun ke baris baru pada layar kecil */
                    gap: 1.5rem;
                    /* Jarak antara setiap kartu */
                    justify-content: center;
                    /* Memusatkan kartu-kartu di tengah */
                    padding: 1.5rem 0;
                }

                /* Gaya dasar untuk setiap kartu kategori */
                .card-category {
                    display: flex;
                    flex-direction: column;
                    /* Mengatur konten di dalam kartu secara vertikal */
                    align-items: center;
                    /* Memusatkan konten secara horizontal */
                    text-align: center;
                    cursor: pointer;
                    border: 2px solid transparent;
                    border-radius: 15px;
                    padding: 1rem;
                    background-color: #2c3e50;
                    color: #ecf0f1;
                    transition: all 0.3s ease;
                    width: 150px;
                    /* Lebar tetap untuk setiap kartu */
                    min-height: 180px;
                    /* Tinggi minimum agar semua kartu seragam */
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                }

                .card-category:hover {
                    transform: translateY(-5px);
                    /* Efek mengangkat saat di-hover */
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
                    /* Tinggi gambar tetap */
                    object-fit: cover;
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
                    /* Atur lebar gambar sesuai ukuran ikon yang Anda inginkan */
                    height: 60px;
                    /* Atur tinggi gambar agar sama dengan lebarnya */
                    object-fit: contain;
                    /* Memastikan gambar pas tanpa terpotong */
                    margin-bottom: 0.5rem;
                    /* Memberi jarak di bawah gambar, sesuai dengan jarak yang ada */
                }
            </style>

            {{-- Panel Filter Baru --}}
            <div class="filter-container">
                <input type="text" id="search-input" placeholder="Cari nama layanan..."
                    class="search-input service-btn" />



                <select id="price-filter" class="filter-dropdown service-btn">
                    <option value="all">Semua Harga</option>
                    @isset($priceRanges)
                        @foreach ($priceRanges as $range)
                            <option value="{{ $range->min ?? '0' }}-{{ $range->max ?? '99999999' }}">{{ $range->name }}
                            </option>
                        @endforeach
                    @endisset
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

            {{-- Pagination akan disembunyikan saat filter client-side aktif --}}
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
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
    </style>

    {{-- Our Service (Dynamic from Database) --}}
    <section class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Service</h2>
                <p class="section-subtitle">
                    Dapatkan pelayanan terbaik dengan standar internasional
                    dan teknik modern
                </p>
            </div>

            <div class="services-grid">
                @forelse ($featuredProducts ?? $products->take(4) as $product)
                    <div class="service-card">
                        <div class="service-image">
                            <img src="{{ $product->primary_image_src ?? asset('assets/demo/barbershop/img/klasik.png') }}"
                                alt="{{ $product->name }}" />
                            <div class="service-overlay">
                                <div class="service-duration">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $product->estimasi_waktu ?? '45 min' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="service-content">
                            <h3 class="service-name">{{ $product->name }}</h3>
                            <div class="service-price">{{ $product->price_idr }}</div>
                            @if ($product->old_price && $product->old_price > $product->price)
                                <div class="service-old-price">{{ $product->old_price_idr }}</div>
                            @endif
                            <button class="service-btn" onclick="showDynamicModal({{ $product->id }})">
                                Detail Layanan
                            </button>
                        </div>
                    </div>
                @empty
                    {{-- Fallback to static content if no products available --}}
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
                                onclick="showStaticModal('Classic Cut', 'Classic Cut adalah potongan rambut klasik yang cocok untuk semua usia.', '{{ asset('assets/demo/barbershop/img/klasik.png') }}')">
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
                                onclick="showStaticModal('Modern Fade', 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.', '{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}')">
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
                                onclick="showStaticModal('Beard Trim', 'Perapian jenggot agar tampak rapi, bersih, dan sesuai bentuk wajah untuk tampilan yang maskulin.', '{{ asset('assets/demo/barbershop/img/beardtrim.jpg') }}')">
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
                                onclick="showStaticModal('Premium Package', 'Paket perawatan lengkap mulai dari potong rambut, perapian jenggot, hingga styling premium untuk tampilan maksimal.', '{{ asset('assets/demo/barbershop/img/premiun.jpg') }}')">
                                Detail Layanan
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <style>
            /* --- General Section Styles --- */
            .services {
                padding: 60px 0;
                background-color: #121212;
                /* Warna background gelap yang solid */
                color: #e0e0e0;
            }

            /* --- Section Header Styles --- */
            .section-header {
                text-align: center;
                margin-bottom: 3rem;
                position: relative;
            }

            .section-header::after {
                content: '';
                display: block;
                width: 60px;
                height: 3px;
                background-color: #f39c12;
                /* Garis pemisah oranye di bawah judul */
                margin: 1rem auto 0;
            }

            .section-title {
                font-size: 2.5rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.5rem;
            }

            .section-subtitle {
                font-size: 1rem;
                color: #b0b0b0;
                max-width: 600px;
                margin: 0 auto;
            }

            /* --- Services Grid & Card Styles --- */
            .services-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                /* Menggunakan grid responsif */
                gap: 2rem;
                justify-content: center;
                align-items: stretch;
            }

            .service-card {
                background-color: #1c1c1c;
                /* Warna kartu lebih terang dari background section */
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                display: flex;
                flex-direction: column;
            }

            .service-card:hover {
                transform: translateY(-10px);
                /* Efek mengangkat saat di-hover */
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5);
            }

            .service-image {
                position: relative;
                height: 200px;
                /* Tinggi gambar tetap */
                overflow: hidden;
            }

            .service-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .service-card:hover .service-image img {
                transform: scale(1.1);
                /* Efek zoom saat di-hover */
            }

            .service-overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
                /* Gradien transparan di bagian bawah gambar */
                padding: 1rem;
                display: flex;
                justify-content: flex-end;
                /* Memindahkan durasi ke pojok kanan bawah */
            }

            .service-duration {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                background-color: rgba(0, 0, 0, 0.5);
                padding: 0.3rem 0.8rem;
                border-radius: 20px;
                color: #ffffff;
                font-size: 0.875rem;
            }

            .service-content {
                padding: 1.5rem;
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                flex-grow: 1;
                /* Konten mengisi sisa ruang */
            }

            .service-name {
                font-size: 1.5rem;
                font-weight: 600;
                color: #f39c12;
                /* Warna judul layanan oranye */
                margin-bottom: 0.5rem;
            }

            .service-price {
                font-size: 1.25rem;
                font-weight: 700;
                color: #e0e0e0;
                margin-top: 0.5rem;
            }

            .service-old-price {
                font-size: 1rem;
                color: #888888;
                text-decoration: line-through;
                margin-top: -0.25rem;
            }

            .service-btn {
                background-color: #f39c12;
                color: #121212;
                padding: 0.75rem 1.5rem;
                border: none;
                border-radius: 50px;
                font-weight: 600;
                text-transform: uppercase;
                cursor: pointer;
                margin-top: 1rem;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            .service-btn:hover {
                background-color: #e67e22;
                transform: translateY(-2px);
            }
        </style>
    </section>



    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="hero-icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <h1>{{ $userStore->store_name ?? 'Classic Cuts Barbershop' }}</h1>
                </div>
                <div class="footer-contact">
                    <h3 class="footer-title">Kontak Kami</h3>
                    <ul class="footer-list">
                        <li><i class="fas fa-map-marker-alt"></i>
                            {{ $userStore->store_address ?? 'Alamat lengkap belum diatur.' }}</li>
                        <li><i class="fas fa-phone"></i>
                            {{ $userStore->store_phone ?? 'Nomor telepon belum diatur.' }}</li>
                        <li><i class="fas fa-envelope"></i> {{ $userStore->store_email ?? 'Email belum diatur.' }}
                        </li>
                        <li><i class="fas fa-clock"></i> {{ $userStore->operating_hours ?? 'Sen-Sab: 09:00 - 21:00' }}
                        </li>
                    </ul>
                    <div class="footer-social" style="margin-top: 15px">
                        @if ($userStore->instagram_url ?? null)
                            <a href="{{ $userStore->instagram_url }}" class="social-link" aria-label="Instagram"
                                target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if ($userStore->facebook_url ?? null)
                            <a href="{{ $userStore->facebook_url }}" class="social-link" aria-label="Facebook"
                                target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $userStore->store_name ?? 'Classic Cuts Barbershop' }}. Diberdayakan
                    oleh KatalogQu</p>
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

    <script>
        // ===================================================================================
        // SCRIPT UTAMA
        // ===================================================================================

        // 1. PERSIAPAN DATA PRODUK DARI PHP KE JAVASCRIPT
        // =================================================
        @php
            use Illuminate\Pagination\AbstractPaginator;
            $rawProducts = $products instanceof AbstractPaginator ? $products->getCollection() : collect($products ?? []);

            $productsForJs = $rawProducts
                ->map(function ($product) {
                    $imagesCollection = $product->images ?? ($product->productimgs ?? collect());
                    $allImages = $imagesCollection->sortBy('position')->map(fn($img) => route('tenant.asset.domain', ['path' => ltrim($img->image_url ?? ($img->image_path ?? ''), '/')]))->values()->all();

                    $primaryImage = null;
                    if ($product->primary_image_src) {
                        $primaryImage = $product->primary_image_src;
                    } elseif ($product->image) {
                        $primaryImage = route('tenant.asset.domain', ['path' => ltrim($product->image, '/')]);
                    }

                    if ($primaryImage && !in_array($primaryImage, $allImages)) {
                        array_unshift($allImages, $primaryImage);
                    }

                    if (empty($allImages)) {
                        $allImages[] = asset('assets/demo/barbershop/img/klasik.png');
                    }

                    $category = $product->category ?? null;
                    $specs = $product->specification ?? ($product->specs ?? []);
                    if (is_string($specs)) {
                        $specs = json_decode($specs, true) ?? [];
                    }

                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug ?? null,
                        'price' => $product->price ?? 0,
                        'old_price' => $product->old_price ?? null,
                        'description' => $product->description ?? 'Layanan berkualitas tinggi untuk penampilan terbaik Anda.',
                        'category_slug' => $category->slug ?? ($category->id ?? 'uncategorized'),
                        'category_name' => $category->name ?? 'Uncategorized',
                        'images' => $allImages,
                        'specs' => (object) $specs,
                    ];
                })
                ->values();
        @endphp
        window.productsData = @json($productsForJs);

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

                // Mengambil filter dari kartu kategori yang aktif
                const activeCategoryCard = document.querySelector('.card-category.active');
                const selectedCategory = activeCategoryCard ? activeCategoryCard.dataset.filter : 'all';

                const priceRange = priceFilter ? priceFilter.value.split('-') : ['all'];
                const minPrice = priceRange[0] !== 'all' ? parseFloat(priceRange[0]) : 0;
                const maxPrice = priceRange[0] !== 'all' ? parseFloat(priceRange[1]) : Infinity;
                const sortBy = sortFilter ? sortFilter.value : 'default';

                let filtered = window.productsData.filter(p => {
                    const nameMatch = p.name.toLowerCase().includes(searchTerm);
                    const categoryMatch = selectedCategory === 'all' || p.category_slug ===
                        selectedCategory;
                    const priceMatch = p.price >= minPrice && p.price <= maxPrice;
                    return nameMatch && categoryMatch && priceMatch;
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
                        // Hapus kelas 'active' dari semua kartu
                        categoryCards.forEach(c => c.classList.remove('active'));

                        // Tambahkan kelas 'active' ke kartu yang sedang diklik
                        this.classList.add('active');

                        // Panggil fungsi filter utama untuk memperbarui tampilan
                        applyFiltersAndSort();
                    });
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
                    const phoneNumber = '{{ $userStore->store_phone ?? '' }}';
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

            window.showDynamicModal = function(productId) {
                const product = window.productsData.find(p => p.id === productId);
                if (product) {
                    openProductModal(product);
                } else {
                    console.warn('Product not found:', productId);
                }
            }

            window.showStaticModal = function(title, description, imageUrl) {
                if (titleEl) titleEl.textContent = title;
                if (descEl) descEl.innerHTML = description;
                if (mainImage) mainImage.src = imageUrl;

                if (categoryEl) categoryEl.textContent = 'Layanan Populer';
                if (priceEl) priceEl.textContent = '';
                if (oldPriceEl) oldPriceEl.style.display = 'none';
                if (thumbContainer) thumbContainer.innerHTML = '';
                if (specsEl) specsEl.innerHTML = '<li>Detail lebih lanjut tersedia di barbershop kami.</li>';
                if (chatButton) chatButton.style.display = 'none';

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
        });
    </script>
</body>

</html>
