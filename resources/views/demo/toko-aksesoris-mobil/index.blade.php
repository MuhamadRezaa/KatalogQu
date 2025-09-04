<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>AutoParts Pro - E-Katalog Aksesoris Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-aksesoris-mobil/style.css') }}">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <div class="logo-icon">
                    <img src="{{ asset('assets/demo/toko-aksesoris-mobil/images/icon.png') }}" alt="AutoParts Pro Logo">
                </div>
                <div class="logo-text">
                    <span class="logo-main">AutoParts</span>
                    <span class="logo-sub">PREMIUM ACCESSORIES</span>
                </div>
            </div>

            <div class="mobile-menu" id="mobileMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <!-- Hero Section with Slider -->
    <section class="hero" id="home">
        <div class="slider">
            <div class="slide slide1 active">
                <div class="slide-content">
                    <h1>Aksesoris Mobil Terbaik</h1>
                    <p>Temukan koleksi lengkap aksesoris mobil berkualitas tinggi untuk semua jenis kendaraan Anda</p>
                </div>
            </div>

            <div class="slide slide2">
                <div class="slide-content">
                    <h1>Kualitas Premium</h1>
                    <p>Produk original dan bergaransi dengan harga terjangkau untuk kepuasan driving experience Anda</p>
                </div>
            </div>

            <div class="slide slide3">
                <div class="slide-content">
                    <h1>Pengiriman Gratis</h1>
                    <p>Nikmati layanan pengiriman gratis ke seluruh Indonesia untuk pembelian minimal Rp 500.000</p>
                </div>
            </div>
        </div>

        <div class="slider-nav">
            <div class="nav-dot active" onclick="currentSlide(1)"></div>
            <div class="nav-dot" onclick="currentSlide(2)"></div>
            <div class="nav-dot" onclick="currentSlide(3)"></div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <h2 class="section-title">Kategori Produk</h2>

            <div class="category-grid">
                <div class="category-card" onclick="filterProducts('interior')">
                    <h3>Interior</h3>
                    <p>Sarung jok, karpet, dashboard cover, dan aksesoris interior lainnya</p>
                </div>

                <div class="category-card" onclick="filterProducts('exterior')">
                    <h3>Eksterior</h3>
                    <p>Body kit, spoiler, emblem, dan aksesoris luar mobil</p>
                </div>

                <div class="category-card" onclick="filterProducts('electronics')">
                    <h3>Elektronik</h3>
                    <p>Audio system, GPS, kamera parkir, dan gadget mobil</p>
                </div>

                <div class="category-card" onclick="filterProducts('maintenance')">
                    <h3>Perawatan</h3>
                    <p>Oli, filter, busi, dan produk perawatan mobil</p>
                </div>

                <div class="category-card" onclick="filterProducts('safety')">
                    <h3>Keamanan</h3>
                    <p>Alarm, immobilizer, kaca film, dan perangkat keamanan</p>
                </div>

                <div class="category-card" onclick="filterProducts('lighting')">
                    <h3>Lampu</h3>
                    <p>LED, HID, lampu fog, dan sistem pencahayaan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products" id="products">
        <div class="container">
            <!-- Filter dan Search Bar -->
            <div class="filter-container">
                <div class="search-filter">
                    <input type="text" id="productSearchInput" placeholder="Cari produk...">
                    <button id="searchProductBtn"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-options">
                    <select id="categoryFilter">
                        <option value="all">Semua Kategori</option>
                        <option value="interior">Interior</option>
                        <option value="exterior">Eksterior</option>
                        <option value="electronics">Elektronik</option>
                        <option value="maintenance">Perawatan</option>
                        <option value="safety">Keamanan</option>
                        <option value="lighting">Lampu</option>
                    </select>
                    <select id="priceFilter">
                        <option value="all">Semua Harga</option>
                        <option value="0-200000">Rp 0 - 200rb</option>
                        <option value="200000-500000">Rp 200rb - 500rb</option>
                        <option value="500000-1000000">Rp 500rb - 1jt</option>
                        <option value="1000000-2000000">Rp 1jt - 2jt</option>
                        <option value="2000000+">Rp 2jt+</option>
                    </select>
                    <button id="resetFilterBtn"><i class="fas fa-undo"></i> Reset</button>
                </div>
            </div>

            <h2 class="section-title">Produk Unggulan</h2>

            <div class="products-grid" id="productsGrid">
                <!-- Products dengan gambar -->
                <div class="product-card" data-id="1" data-category="interior" data-price="1250000">
                    <div class="product-image">
                        <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/95/MTA-40163476/oscar_sarung_jok_mobil_ertiga_bahan_kulit_syntetic_original_full_3_baris_full01_m057pk2o.jpg"
                            alt="Sarung Jok Kulit Premium" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Interior</div>
                        <h4>Sarung Jok Kulit Premium</h4>
                        <div class="product-price">Rp 1.250.000</div>
                        <p>Sarung jok kulit synthetic premium dengan desain elegant untuk kenyamanan maksimal. Tahan
                            lama, mudah dibersihkan, tersedia berbagai warna dengan garansi 2 tahun.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(1)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(1)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="2" data-category="lighting" data-price="350000">
                    <div class="product-image">
                        <img src="https://image.made-in-china.com/2f0j00YsKkiavzYuqg/Auto-Parts-Car-Light-Bulb-400W-H7-Automotive-Headlamp-H4-LED-Headlight.webp"
                            alt="LED Headlight H4" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Pencahayaan</div>
                        <h4>LED Headlight H4</h4>
                        <div class="product-price">Rp 350.000</div>
                        <p>Lampu LED super terang 6000 lumens dengan teknologi terbaru untuk visibilitas maksimal. Tahan
                            air IP67, hemat energi 35W, mudah dipasang plug and play dengan heat sink aluminum.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(2)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(2)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="3" data-category="exterior" data-price="2100000">
                    <div class="product-image">
                        <img src="https://tiimg.tistatic.com/fp/1/573/carbon-fiber-car-spoiler-192.jpg"
                            alt="Spoiler Carbon Fiber" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Eksterior</div>
                        <h4>Spoiler Carbon Fiber</h4>
                        <div class="product-price">Rp 2.100.000</div>
                        <p>Spoiler carbon fiber 100% original untuk performa aerodinamis dan tampilan sporty.
                            Meningkatkan downforce dan stabilitas, desain universal untuk sedan dan hatchback.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(3)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(3)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="4" data-category="electronics" data-price="1800000">
                    <div class="product-image">
                        <img src="https://5.imimg.com/data5/UE/BJ/CZ/SELLER-53335017/car-speaker-1000x1000.jpg"
                            alt="Audio System Pioneer" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Elektronik</div>
                        <h4>Audio System Pioneer</h4>
                        <div class="product-price">Rp 1.800.000</div>
                        <p>System audio premium dengan head unit 2DIN layar 7 inci, 4 speaker, dan subwoofer 10 inci.
                            Mendukung Bluetooth, USB, AUX, radio FM/AM dengan equalizer 7 band, garansi 3 tahun.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(4)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(4)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="5" data-category="maintenance" data-price="285000">
                    <div class="product-image">
                        <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rbm6-lohq87slpvy490"
                            alt="Oli Mesin Synthetic" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Perawatan</div>
                        <h4>Oli Mesin Synthetic</h4>
                        <div class="product-price">Rp 285.000</div>
                        <p>Oli mesin fully synthetic 5W-30 dengan teknologi advanced additive untuk perlindungan
                            optimal. Interval penggantian 10.000 km, standar API SN/CF dan ACEA A3/B4 untuk mesin
                            modern.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(5)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(5)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="6" data-category="safety" data-price="650000">
                    <div class="product-image">
                        <img src="https://images.squarespace-cdn.com/content/v1/661bf67da1652b3d5d587880/208af2c3-fb7d-47f4-b5ad-e34d657998f3/Pro+2WG180W.jpg"
                            alt="Alarm System Advanced" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Keamanan</div>
                        <h4>Alarm System Advanced</h4>
                        <div class="product-price">Rp 650.000</div>
                        <p>Sistem keamanan canggih dengan remote 50 meter, central lock, siren 120dB, dan shock sensor.
                            Dilengkapi rolling code encryption, panic button, dan silent arm mode dengan instalasi
                            mudah.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(6)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(6)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="7" data-category="interior" data-price="420000">
                    <div class="product-image">
                        <img src="https://www.carcoverusa.com/images/carhartt/carhartt-dashboard-covers-black.webp"
                            alt="Dashboard Cover Premium" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Interior</div>
                        <h4>Dashboard Cover Premium</h4>
                        <div class="product-price">Rp 420.000</div>
                        <p>Pelindung dashboard anti UV dari material PVC premium dengan lapisan anti-slip. Desain custom
                            fit berbagai model mobil, mudah dipasang dengan velcro adhesive tanpa bekas.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(7)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(7)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="8" data-category="exterior" data-price="3200000">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                            alt="Body Kit Sport" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Eksterior</div>
                        <h4>Body Kit Sport</h4>
                        <div class="product-price">Rp 3.200.000</div>
                        <p>Body kit lengkap 4 pieces dari PU plastic fleksibel dengan finishing carbon fiber pattern.
                            Meningkatkan tampilan sporty dan aerodinamika, instalasi mudah dengan 3M adhesive tape.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(8)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(8)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Produk tambahan untuk testing filter -->
                <div class="product-card" data-id="9" data-category="electronics" data-price="450000">
                    <div class="product-image">
                        <img src="https://down-id.img.susercontent.com/file/id-11134207-7rash-m13z3bkwc4si9f"
                            alt="Kamera Parkir HD" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Elektronik</div>
                        <h4>Kamera Parkir HD</h4>
                        <div class="product-price">Rp 450.000</div>
                        <p>Kamera parkir HD 1080P dengan night vision dan wide angle 170 derajat. Dilengkapi monitor LCD
                            4.3 inci, wireless transmitter, parking grid lines dan auto switch gear mundur.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(9)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(9)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="10" data-category="lighting" data-price="150000">
                    <div class="product-image">
                        <img src="https://brainboxcar.com/pictures/product/534-02301-FOG-ANGEL-(4).jpg"
                            alt="Lampu Fog LED" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Pencahayaan</div>
                        <h4>Lampu Fog LED</h4>
                        <div class="product-price">Rp 150.000</div>
                        <p>Lampu fog LED 2000 lumens dengan housing aluminum die-cast untuk kondisi berkabut optimal.
                            Konsumsi daya 15W, 3x lebih terang dari halogen, plug and play dengan bracket universal.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(10)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(10)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="11" data-category="maintenance" data-price="85000">
                    <div class="product-image">
                        <img src="https://images.tokopedia.net/img/cache/700/VqbcmM/2024/5/15/fc5f8d1a-536f-40b5-813f-7ce305e378d9.jpg"
                            alt="Filter Udara Sport" class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Perawatan</div>
                        <h4>Filter Udara Sport</h4>
                        <div class="product-price">Rp 85.000</div>
                        <p>Filter udara sport cotton gauze untuk peningkatan performa dan efisiensi bahan bakar. Dapat
                            dicuci dan digunakan kembali hingga 50.000 km, meningkatkan horsepower hingga 5%.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(11)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(11)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-id="12" data-category="safety" data-price="950000">
                    <div class="product-image">
                        <img src="https://m.media-amazon.com/images/I/81gIn+MXtyL._AC_.jpg" alt="Dashcam 4K Pro"
                            class="product-img">
                    </div>
                    <div class="product-info">
                        <div class="product-category">Keamanan</div>
                        <h4>Dashcam 4K Pro</h4>
                        <div class="product-price">Rp 950.000</div>
                        <p>Dashcam 4K Ultra HD dengan GPS, G-sensor tri-axis, dan memory card 64GB included. Fitur
                            parking mode 24/7, LCD touchscreen 3 inci dengan WiFi connectivity untuk remote viewing.</p>
                        <div class="product-buttons">
                            <button class="btn btn-detail" onclick="showProductDetail(12)">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                            <button class="btn btn-whatsapp" onclick="orderViaWhatsApp(12)">
                                <i class="fab fa-whatsapp"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Modal -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-info-circle"></i> Detail Produk</h2>
                <button class="close-modal" onclick="closeDetailModal()">&times;</button>
            </div>
            <div class="modal-body" id="detailModalBody">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <img src="{{ asset('assets/demo/toko-aksesoris-mobil/images/icon.png') }}"
                                alt="AutoParts Pro Logo">
                        </div>
                        <div class="footer-logo-text">
                            <span class="footer-logo-main">AutoParts</span>
                            <span class="footer-logo-sub">PREMIUM ACCESSORIES</span>
                        </div>
                    </div>
                    <p>Toko online terpercaya untuk semua kebutuhan aksesoris mobil Anda. Kualitas terjamin dengan harga
                        terbaik.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Kontak</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV
                            No.172 Kompleks, Asam Kumbang, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20133</li>
                        <li><i class="fas fa-phone"></i> 08116584545</li>
                        <li><i class="fas fa-envelope"></i> pteraciptadigital@gmail.com</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>

    <script>
        let currentSlideIndex = 0;
        let slideInterval;

        document.addEventListener('DOMContentLoaded', function() {
            startSlider();
            setupEventListeners();
            animateElements();
            setupProductFilters();
            setupCheckoutBubble();
        });

        function startSlider() {
            slideInterval = setInterval(() => {
                nextSlide();
            }, 5000);
        }

        function nextSlide() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.nav-dot');

            slides[currentSlideIndex].classList.remove('active');
            dots[currentSlideIndex].classList.remove('active');

            currentSlideIndex = (currentSlideIndex + 1) % slides.length;

            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');
        }

        function currentSlide(n) {
            clearInterval(slideInterval);
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.nav-dot');

            slides[currentSlideIndex].classList.remove('active');
            dots[currentSlideIndex].classList.remove('active');

            currentSlideIndex = n - 1;

            slides[currentSlideIndex].classList.add('active');
            dots[currentSlideIndex].classList.add('active');

            startSlider();
        }

        function filterProducts(category) {
            document.getElementById('products').scrollIntoView({
                behavior: 'smooth'
            });

            document.getElementById('categoryFilter').value = category;

            applyFilters();

            const sectionTitle = document.querySelector('#products .section-title');
            const categoryNames = {
                'interior': 'Produk Interior',
                'exterior': 'Produk Eksterior',
                'electronics': 'Produk Elektronik',
                'maintenance': 'Produk Perawatan',
                'safety': 'Produk Keamanan',
                'lighting': 'Produk Pencahayaan'
            };

            if (category !== 'all') {
                sectionTitle.textContent = categoryNames[category] || 'Produk Unggulan';
            } else {
                sectionTitle.textContent = 'Produk Unggulan';
            }
        }

        function resetFilter() {
            document.getElementById('productSearchInput').value = '';
            document.getElementById('categoryFilter').value = 'all';
            document.getElementById('priceFilter').value = 'all';

            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.style.display = 'flex';
            });

            const noProductsMessage = document.querySelector('.no-products-message');
            if (noProductsMessage) {
                noProductsMessage.remove();
            }

            document.querySelector('#products .section-title').textContent = 'Produk Unggulan';
        }

        function setupProductFilters() {
            document.getElementById('searchProductBtn').addEventListener('click', function() {
                applyFilters();
            });

            document.getElementById('productSearchInput').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    applyFilters();
                } else {
                    applyFilters();
                }
            });

            document.getElementById('categoryFilter').addEventListener('change', function() {
                applyFilters();
            });

            document.getElementById('priceFilter').addEventListener('change', function() {
                applyFilters();
            });

            document.getElementById('resetFilterBtn').addEventListener('click', function() {
                resetFilter();
            });
        }

        function applyFilters() {
            const searchInput = document.getElementById('productSearchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const priceFilter = document.getElementById('priceFilter').value;

            const productCards = Array.from(document.querySelectorAll('.product-card'));
            let visibleCards = [];

            const existingMessage = document.querySelector('.no-products-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            productCards.forEach(card => {
                const productName = card.querySelector('h4').textContent.toLowerCase();
                const productDesc = card.querySelector('p').textContent.toLowerCase();
                const productCategory = card.getAttribute('data-category');
                const productPrice = parseInt(card.getAttribute('data-price'));

                const matchesSearch = searchInput === '' ||
                    productName.includes(searchInput) ||
                    productDesc.includes(searchInput);
                const matchesCategory = categoryFilter === 'all' || productCategory === categoryFilter;
                const matchesPrice = checkPriceRange(productPrice, priceFilter);

                if (matchesSearch && matchesCategory && matchesPrice) {
                    card.style.display = 'flex';
                    visibleCards.push(card);
                } else {
                    card.style.display = 'none';
                }
            });

            const sectionTitle = document.querySelector('#products .section-title');
            if (searchInput !== '') {
                sectionTitle.textContent = `Hasil Pencarian: "${searchInput}" (${visibleCards.length} produk)`;
            } else if (categoryFilter !== 'all') {
                const categoryNames = {
                    'interior': 'Produk Interior',
                    'exterior': 'Produk Eksterior',
                    'electronics': 'Produk Elektronik',
                    'maintenance': 'Produk Perawatan',
                    'safety': 'Produk Keamanan',
                    'lighting': 'Produk Pencahayaan'
                };
                sectionTitle.textContent = `${categoryNames[categoryFilter]} (${visibleCards.length} produk)`;
            } else if (priceFilter !== 'all') {
                const priceRangeNames = {
                    '0-200000': 'Produk Rp 0 - 200rb',
                    '200000-500000': 'Produk Rp 200rb - 500rb',
                    '500000-1000000': 'Produk Rp 500rb - 1jt',
                    '1000000-2000000': 'Produk Rp 1jt - 2jt',
                    '2000000+': 'Produk Rp 2jt+'
                };
                sectionTitle.textContent = `${priceRangeNames[priceFilter]} (${visibleCards.length} produk)`;
            } else {
                sectionTitle.textContent = 'Produk Unggulan';
            }

            if (visibleCards.length === 0) {
                const productsGrid = document.getElementById('productsGrid');
                const noProductsMessage = document.createElement('div');
                noProductsMessage.className = 'no-products-message';
                noProductsMessage.innerHTML = `
                    <i class="fas fa-search"></i>
                    <h3>Tidak ada produk yang ditemukan</h3>
                    <p>Coba kata kunci lain atau reset filter</p>
                `;
                productsGrid.appendChild(noProductsMessage);
            }
        }

        function checkPriceRange(price, priceFilter) {
            if (priceFilter === 'all') return true;

            switch (priceFilter) {
                case '0-200000':
                    return price >= 0 && price <= 200000;
                case '200000-500000':
                    return price > 200000 && price <= 500000;
                case '500000-1000000':
                    return price > 500000 && price <= 1000000;
                case '1000000-2000000':
                    return price > 1000000 && price <= 2000000;
                case '2000000+':
                    return price > 2000000;
                default:
                    return true;
            }
        }

        function sortProductsByPrice(sortOrder, visibleCards) {
            const productsGrid = document.getElementById('productsGrid');

            visibleCards.sort((a, b) => {
                const priceA = parseInt(a.getAttribute('data-price'));
                const priceB = parseInt(b.getAttribute('data-price'));

                if (sortOrder === 'low-to-high') {
                    return priceA - priceB;
                } else {
                    return priceB - priceA;
                }
            });

            visibleCards.forEach(card => {
                productsGrid.appendChild(card);
            });
        }

        function showProductDetail(productId) {
            const productCard = document.querySelector(`.product-card[data-id="${productId}"]`);
            if (!productCard) return;

            const modal = document.getElementById('detailModal');
            const modalBody = document.getElementById('detailModalBody');
            const productName = productCard.querySelector('h4').textContent;
            const productPrice = productCard.querySelector('.product-price').textContent;
            const productDesc = productCard.querySelector('p').textContent;
            const productCategory = productCard.querySelector('.product-category').textContent;
            const productImg = productCard.querySelector('.product-img');
            const productImgSrc = productImg ? productImg.getAttribute('src') : '';
            const categoryColors = {
                'Interior': '#8e44ad',
                'Pencahayaan': '#f39c12',
                'Eksterior': '#e74c3c',
                'Elektronik': '#3498db',
                'Perawatan': '#27ae60',
                'Keamanan': '#34495e'
            };

            const categoryColor = categoryColors[productCategory] || '#95a5a6';

            let detailHTML = `
                <div class="product-detail-container">
                    <div class="product-detail-image">
                        ${productImgSrc ? `<img src="${productImgSrc}" alt="${productName}" class="detail-product-img">` : '<div class="detail-no-image"><i class="fas fa-image"></i></div>'}
                    </div>

                    <div class="product-basic-info">
                        <div class="product-detail-category" style="background-color: ${categoryColor};">
                            <i class="fas fa-tag"></i> ${productCategory}
                        </div>
                        <h3 class="product-detail-title">${productName}</h3>
                        <div class="product-detail-price">${productPrice}</div>
                    </div>

                    <div class="product-detail-info">
                        <div class="product-detail-description">
                            <h4>Deskripsi Produk</h4>
                            <p>${productDesc}</p>
                        </div>

                        <div class="product-features">
                            <h4><i class="fas fa-check-circle"></i> Keunggulan Produk</h4>
                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>Kualitas Premium</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-tools"></i>
                                    <span>Mudah Dipasang</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Tahan Lama</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-award"></i>
                                    <span>Bergaransi</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-detail-action">
                            <button class="btn btn-whatsapp btn-detail-order" onclick="orderViaWhatsApp(${productId})">
                                <i class="fab fa-whatsapp"></i>
                                <span>Pesan Sekarang</span>
                                <div class="btn-shine"></div>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            modalBody.innerHTML = detailHTML;
            modal.classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        function orderViaWhatsApp(productId) {
            const productCard = document.querySelector(`.product-card[data-id="${productId}"]`);
            if (!productCard) return;

            const productName = productCard.querySelector('h4').textContent;
            const productPrice = productCard.querySelector('.product-price').textContent;

            const phoneNumber = '6285273147673';
            const message = `Halo AutoParts

Saya tertarik untuk memesan produk:
📦 *${productName}*
💰 Harga: ${productPrice}

Bisakah Anda berikan informasi lebih lanjut mengenai:
- Ketersediaan stock
- Estimasi pengiriman
- Metode pembayaran

Terima kasih!`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
            window.open(whatsappURL, '_blank');
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;

            if (type === 'error') {
                notification.style.background = '#e74c3c';
            }

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        function setupEventListeners() {
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

            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileMenu) {
                mobileMenu.addEventListener('click', () => {
                    const spans = mobileMenu.querySelectorAll('span');
                    spans.forEach((span, index) => {
                        span.style.transform = span.style.transform ? '' :
                            index === 0 ? 'rotate(45deg) translate(5px, 5px)' :
                            index === 1 ? 'opacity(0)' :
                            'rotate(-45deg) translate(7px, -6px)';
                    });
                });
            }

            document.getElementById('detailModal').addEventListener('click', (e) => {
                if (e.target.id === 'detailModal') {
                    closeDetailModal();
                }
            });
        }

        function animateElements() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.category-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(50px)';
                card.style.transition = `all 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });

            document.querySelectorAll('.product-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `all 0.5s ease ${index * 0.05}s`;
                observer.observe(card);
            });
        }

        let lastScrollTop = 0;
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop && scrollTop > 100) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }

            lastScrollTop = scrollTop;
        });

        window.addEventListener('load', () => {
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.transition = 'opacity 0.5s ease';
                document.body.style.opacity = '1';
            }, 100);
        });

        // Checkout Bubble Functionality
        function setupCheckoutBubble() {
            const checkoutBubble = document.getElementById('checkoutBubble');
            if (checkoutBubble) {
                checkoutBubble.addEventListener('click', function() {
                    // Button disabled - no action
                });
            }
        }

        function handleCheckout() {
            // Sample checkout data - replace with your actual product data
            const checkoutData = {
                transaction_details: {
                    order_id: 'ORDER-' + Math.random().toString(36).substr(2, 9),
                    gross_amount: 150000
                },
                item_details: [{
                    id: 'template-001',
                    price: 150000,
                    quantity: 1,
                    name: 'Checkout Template'
                }],
                customer_details: {
                    first_name: 'Customer',
                    last_name: 'AutoParts',
                    email: 'customer@autoparts.com',
                    phone: '08116584545'
                }
            };

            // Check if Midtrans Snap is loaded
            if (typeof snap !== 'undefined') {
                // Call Midtrans Snap
                snap.pay(checkoutData.transaction_details.order_id, {
                    // Replace with your actual snap token from backend
                    onSuccess: function(result) {
                        console.log('Payment success:', result);
                        showNotification('Pembayaran berhasil! Terima kasih atas pembelian Anda.', 'success');
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        showNotification('Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.',
                            'info');
                    },
                    onError: function(result) {
                        console.log('Payment error:', result);
                        showNotification('Terjadi kesalahan dalam pembayaran. Silakan coba lagi.', 'error');
                    }
                });
            } else {
                // Fallback if Midtrans is not loaded - redirect to WhatsApp
                const message = `Halo AutoParts Pro!

Saya ingin membeli:
📦 *Checkout Template*
💰 Harga: Rp 150.000

Mohon informasi lebih lanjut untuk proses pembelian.

Terima kasih!`;

                const encodedMessage = encodeURIComponent(message);
                const whatsappURL = `https://wa.me/6285273147673?text=${encodedMessage}`;
                window.open(whatsappURL, '_blank');
            }
        }
    </script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-aksesoris-mobil',
    ])
</body>

</html>
