<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>E-Katalog ATK</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-atk/styles.css') }}">
    <!-- Font Awesome untuk icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <img src="{{ asset('assets/demo/toko-atk/images/20250819_1904_Logo_E-Catalog_Alat_Tulis_simple_compose_01k313dfh6e1xtcnhs1atfdnt3-removebg-preview.png') }}"
                        alt="Logo Tinta Cipta" class="logo-image">
                    <div class="header-text">
                        <h1>Tinta Cipta</h1>
                        <p>E-Katalog ATK - Pilihan lengkap alat tulis kantor berkualitas</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Carousel Section -->
    <div class="carousel-container">
        <div class="carousel">
            <div class="carousel-slide active">
                <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    alt="Koleksi Alat Tulis Terlengkap">
                <div class="carousel-content">
                    <h3>Koleksi Alat Tulis Terlengkap</h3>
                    <p>Temukan berbagai macam alat tulis berkualitas untuk kebutuhan kantor dan sekolah</p>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    alt="Kualitas Terjamin">
                <div class="carousel-content">
                    <h3>Kualitas Terjamin</h3>
                    <p>Produk pilihan dengan standar kualitas tinggi dan harga terjangkau</p>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    alt="Layanan Terpercaya">
                <div class="carousel-content">
                    <h3>Layanan Terpercaya</h3>
                    <p>Pelayanan profesional dengan pengiriman cepat dan aman</p>
                </div>
            </div>
        </div>

        <!-- Navigation buttons -->
        <button class="carousel-btn prev" onclick="changeSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-btn next" onclick="changeSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Dots indicator -->
        <div class="carousel-dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <div class="container">
        <!-- Filter Kategori -->
        <div class="category-filter">
            <button class="category-btn active" data-category="all">
                Semua Produk
            </button>
            <button class="category-btn" data-category="alat-tulis">
                Alat Tulis
            </button>
            <button class="category-btn" data-category="penjilidan">
                Penjilidan & Penyimpanan
            </button>
            <button class="category-btn" data-category="kertas">
                Produk Kertas
            </button>
            <button class="category-btn" data-category="label">
                Label & Perekat
            </button>
            <button class="category-btn" data-category="pemotong">
                Pemotong Kertas
            </button>
        </div>
        <!-- Subcategory chips dihapus sesuai permintaan -->

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="section-header">
                <h3>Cari & Filter Produk</h3>
                <p>Temukan produk alat tulis yang Anda butuhkan dengan mudah</p>
            </div>

            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Ketik nama produk yang dicari..."
                        onkeyup="searchProducts()">
                </div>
            </div>

            <div class="filter-container">
                <div class="filter-group">
                    <label for="subcategory-filter">Filter Sub Kategori:</label>
                    <select id="subcategory-filter" onchange="filterBySubcategoryDropdown()">
                        <option value="all">Semua Sub Kategori</option>
                        <!-- Opsi akan diisi melalui JavaScript agar konsisten dengan kategori -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="sort-filter">Urutkan Berdasarkan:</label>
                    <select id="sort-filter" onchange="sortProducts()">
                        <option value="default">Default</option>
                        <option value="name-asc">Nama A-Z</option>
                        <option value="name-desc">Nama Z-A</option>
                        <option value="price-asc">Harga Terendah</option>
                        <option value="price-desc">Harga Tertinggi</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="price-filter">Filter Rentang Harga:</label>
                    <select id="price-filter" onchange="filterByPrice()">
                        <option value="all">Semua Harga</option>
                        <option value="0-5000">Di bawah Rp 5.000</option>
                        <option value="5000-10000">Rp 5.000 - Rp 10.000</option>
                        <option value="10000-25000">Rp 10.000 - Rp 25.000</option>
                        <option value="25000-50000">Rp 25.000 - Rp 50.000</option>
                        <option value="50000-up">Di atas Rp 50.000</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="products-grid" id="products-grid">
            <!-- Alat Tulis -->
            <div class="product-card" data-category="alat-tulis" data-subcategory="pulpen" data-brand="Standard" data-promo="true">
                <div class="promo-badge">Promo</div>
                <div class="product-image">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-22120-x9646mj3swkv99"
                        alt="Pulpen Standard">
                </div>
                <div class="product-info">
                    <h3>Pulpen Standard</h3>
                    <div class="brand-chip">Standard</div>
                    <p class="price">Rp 3.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('pulpen')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>

                    </div>
                </div>
            </div>

            <div class="product-card" data-category="alat-tulis" data-subcategory="pensil" data-brand="Faber-Castell" data-promo="false">
                <div class="product-image">
                    <img src="https://ecs7.tokopedia.net/img/cache/700/product-1/2017/11/16/14804937/14804937_ba9679e5-ce11-4477-b3d6-1e986af7f137_550_550.jpg"
                        alt="Pensil 2B Faber-Castell">
                </div>
                <div class="product-info">
                    <h3>Pensil 2B Faber-Castell</h3>
                    <div class="brand-chip">Faber-Castell</div>
                    <p class="price">Rp 2.500</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('pensil')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>

                    </div>
                </div>
            </div>

            <div class="product-card" data-category="alat-tulis" data-subcategory="spidol" data-brand="Snowman" data-promo="true">
                <div class="promo-badge">Promo</div>
                <div class="product-image">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-23020-7ejr1jcczcnv2e"
                        alt="Spidol Snowman">
                </div>
                <div class="product-info">
                    <h3>Spidol Snowman</h3>
                    <div class="brand-chip">Snowman</div>
                    <p class="price">Rp 7.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('spidol')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="alat-tulis" data-subcategory="correction" data-brand="Kenko" data-promo="false">
                <div class="product-image">
                    <img src="https://siplahtelkom.com/public/products/172981/3165338/correction-tape.1640252042.jpg"
                        alt="Correction Tape Kenko">
                </div>
                <div class="product-info">
                    <h3>Correction Tape Kenko</h3>
                    <div class="brand-chip">Kenko</div>
                    <p class="price">Rp 8.500</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('correction')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Penjilidan & Penyimpanan -->
            <div class="product-card" data-category="penjilidan" data-subcategory="stapler" data-brand="Kenko" data-promo="false">
                <div class="product-image">
                    <img src="https://img.mbizmarket.co.id/products/thumbs/800x800/2023/02/22/bda9f2e8f40a7ed0b71ff944102149d2.jpg"
                        alt="Stapler Kenko HD-10">
                </div>
                <div class="product-info">
                    <h3>Stapler Kenko HD-10</h3>
                    <div class="brand-chip">Kenko</div>
                    <p class="price">Rp 15.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('staplerKenkoHD10')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="penjilidan" data-subcategory="map">
                <div class="product-image">
                    <img src="https://siplahtelkom.com/public/products/177340/3709436/mapplastik.1659042409.jpg"
                        alt="Map Plastik A4">
                </div>
                <div class="product-info">
                    <h3>Map Plastik A4</h3>
                    <p class="price">Rp 5.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('map')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="penjilidan" data-subcategory="ordner">
                <div class="product-image">
                    <img src="https://cdn-images.otto-office.com/oode/b2b/deu/mediadatacat/art/1200/OODE_ART_288/OODE_ART_288280HT_01.jpg"
                        alt="Ordner Besar A4">
                </div>
                <div class="product-info">
                    <h3>Ordner Besar A4</h3>
                    <p class="price">Rp 22.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('ordnerBesarA4')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="penjilidan" data-subcategory="sheet">
                <div class="product-image">
                    <img src="https://m.media-amazon.com/images/S/aplus-media/sota/371f59f9-8062-4839-b959-203f2e332085.__CR0,0,300,300_PT0_SX300_V1___.png"
                        alt="Sheet Protector A4">
                </div>
                <div class="product-info">
                    <h3>Sheet Protector A4</h3>
                    <p class="price">Rp 1.200</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('sheetProtectorA4')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Produk Kertas -->
            <div class="product-card" data-category="kertas" data-subcategory="hvs">
                <div class="product-image">
                    <img src="https://img.mbizmarket.co.id/products/thumbs/800x800/2022/06/01/af2a84879a3206a9e90517f1d52a5290.jpg"
                        alt="Kertas HVS A4">
                </div>
                <div class="product-info">
                    <h3>Kertas HVS A4</h3>
                    <p class="price">Rp 45.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('hvs')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="kertas" data-subcategory="sticky">
                <div class="product-image">
                    <img src="https://i5.walmartimages.com/asr/af9eba15-4297-4bf4-b58c-527f317ead58.a904b07756f5d5ed53aeba6935e9567e.jpeg"
                        alt="Sticky Notes 3x3">
                </div>
                <div class="product-info">
                    <h3>Sticky Notes 3x3</h3>
                    <p class="price">Rp 6.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('stickyNotes3x3')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="kertas" data-subcategory="kertas-warna">
                <div class="product-image">
                    <img src="https://siplahtelkom.com/public/products/196935/4176520/277697.f6c2d839-2aab-4319-af5f-26ff475f9125.IMG_202304.jpg"
                        alt="Kertas Warna A4 Campuran">
                </div>
                <div class="product-info">
                    <h3>Kertas Warna A4 Campuran</h3>
                    <p class="price">Rp 18.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('kertasWarnaA4Campuran')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="kertas" data-subcategory="memo">
                <div class="product-image">
                    <img src="https://m.media-amazon.com/images/I/71At1Mi7mCL._AC_.jpg" alt="Memo Pad Spiral Kecil">
                </div>
                <div class="product-info">
                    <h3>Memo Pad Spiral Kecil</h3>
                    <p class="price">Rp 4.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('memoPadSpiralKecil')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Label & Perekat -->
            <div class="product-card" data-category="label" data-subcategory="lem">
                <div class="product-image">
                    <img src="https://down-id.img.susercontent.com/file/id-11134207-7r98u-llabjnr2sgp028"
                        alt="Lem Kertas UHU Stick 21gr">
                </div>
                <div class="product-info">
                    <h3>Lem Kertas UHU Stick 21gr</h3>
                    <p class="price">Rp 12.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('lemKertasUHUStick21gr')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="label" data-subcategory="label">
                <div class="product-image">
                    <img src="https://www.crownlabels.com/wp-content/uploads/2017/11/A4-65.jpg"
                        alt="Label Nama A4 65 Label">
                </div>
                <div class="product-info">
                    <h3>Label Nama A4 65 Label</h3>
                    <p class="price">Rp 15.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('labelNamaA465Label')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="label" data-subcategory="double-tape">
                <div class="product-image">
                    <img src="https://cf.shopee.co.id/file/2d756bd6d10f107e153c3c38d91aed50" alt="Double Tape 1 Inch">
                </div>
                <div class="product-info">
                    <h3>Double Tape 1 Inch</h3>
                    <p class="price">Rp 8.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('doubleTape1Inch')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="label" data-subcategory="lakban">
                <div class="product-image">
                    <img src="https://down-id.img.susercontent.com/file/id-11134207-7r98x-lm8ajqbvs87i17"
                        alt="Lakban Bening 2 Inch">
                </div>
                <div class="product-info">
                    <h3>Lakban Bening 2 Inch</h3>
                    <p class="price">Rp 10.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('lakbanBening2Inch')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pemotong Kertas -->
            <div class="product-card" data-category="pemotong" data-subcategory="cutter">
                <div class="product-image">
                    <img src="https://atkqita.com/wp-content/uploads/Cutter-kecil-JOYKO-A300.jpg"
                        alt="Cutter Kecil Joyko">
                </div>
                <div class="product-info">
                    <h3>Cutter Kecil Joyko</h3>
                    <p class="price">Rp 5.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('cutterKecilJoyko')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="pemotong" data-subcategory="gunting">
                <div class="product-image">
                    <img src="https://lzd-img-global.slatic.net/g/p/598ef8b6d52d3d918b68dd8d89686657.jpg_720x720q80.jpg"
                        alt="Gunting Kertas Stainless">
                </div>
                <div class="product-info">
                    <h3>Gunting Kertas Stainless</h3>
                    <p class="price">Rp 8.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('guntingKertasStainless')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="pemotong" data-subcategory="trimmer">
                <div class="product-image">
                    <img src="https://images.nexusapp.co/assets/f4/61/79/164903640.jpg" alt="Paper Trimmer A4">
                </div>
                <div class="product-info">
                    <h3>Paper Trimmer A4</h3>
                    <p class="price">Rp 125.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('paperTrimmerA4')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-card" data-category="pemotong" data-subcategory="cutter">
                <div class="product-image">
                    <img src="https://id-test-11.slatic.net/p/0b0995e37dcdf81614a96c7c660829c7.jpg"
                        alt="Pisau Cutter Besar">
                </div>
                <div class="product-info">
                    <h3>Pisau Cutter Besar</h3>
                    <p class="price">Rp 9.000</p>
                    <div class="product-actions">
                        <button class="btn-detail" onclick="showDetail('pisauCutterBesar')">
                            <i class="fas fa-eye"></i>
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="show-more-container">
            <button id="atkShowMoreBtn" class="show-more-button" onclick="atkShowMore()">Lihat Selengkapnya</button>
        </div>

        <!-- Modal Detail Produk -->
        <div id="product-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modal-body"></div>
            </div>
        </div>



        <script>
            // Data produk detail
            const productDetails = {
                pulpen: {
                    name: 'Pulpen Standard',
                    price: 'Rp 3.000',
                    image: 'https://down-id.img.susercontent.com/file/sg-11134201-22120-x9646mj3swkv99',
                    description: 'Pulpen berkualitas dengan tinta yang lancar dan tahan lama. Cocok untuk kebutuhan sehari-hari kantor maupun sekolah.',
                    brand: 'Standard',
                    subcategory: 'pulpen',
                    specs: [
                        'Warna tinta: Biru, Hitam, Merah',
                        'Ujung ballpoint 0.7mm',
                        'Body plastik berkualitas',
                        'Grip ergonomis'
                    ]
                },
                pensil: {
                    name: 'Pensil 2B Faber-Castell',
                    price: 'Rp 2.500',
                    image: 'https://ecs7.tokopedia.net/img/cache/700/product-1/2017/11/16/14804937/14804937_ba9679e5-ce11-4477-b3d6-1e986af7f137_550_550.jpg',
                    description: 'Pensil 2B dari Faber-Castell dengan kualitas premium. Grafit berkualitas tinggi menghasilkan goresan yang halus.',
                    brand: 'Faber-Castell',
                    subcategory: 'pensil',
                    specs: [
                        'Tingkat kekerasan: 2B',
                        'Body kayu cedar berkualitas',
                        'Mudah dihapus',
                        'Tidak mudah patah'
                    ]
                },
                spidol: {
                    name: 'Spidol Whiteboard Snowman',
                    price: 'Rp 7.000',
                    image: 'https://down-id.img.susercontent.com/file/sg-11134201-23020-7ejr1jcczcnv2e',
                    description: 'Spidol khusus untuk papan tulis putih dengan tinta yang mudah dihapus dan tidak meninggalkan noda.',
                    brand: 'Snowman',
                    subcategory: 'spidol',
                    specs: [
                        'Cocok untuk whiteboard',
                        'Tinta mudah dihapus',
                        'Ujung bullet tip',
                        'Tersedia berbagai warna'
                    ]
                },
                correction: {
                    name: 'Correction Tape Kenko',
                    price: 'Rp 8.500',
                    image: 'https://siplahtelkom.com/public/products/172981/3165338/correction-tape.1640252042.jpg',
                    description: 'Correction tape berkualitas untuk mengoreksi kesalahan tulisan dengan hasil yang rapi dan bersih.',
                    brand: 'Kenko',
                    subcategory: 'correction',
                    specs: [
                        'Lebar tape: 5mm',
                        'Panjang: 12 meter',
                        'Aplikasi mudah dan halus',
                        'Hasil koreksi rapi'
                    ]
                },
                staplerKenkoHD10: {
                    name: 'Stapler Kenko HD-10',
                    price: 'Rp 15.000',
                    image: 'https://img.mbizmarket.co.id/products/thumbs/800x800/2023/02/22/bda9f2e8f40a7ed0b71ff944102149d2.jpg',
                    description: 'Stapler mini berkualitas yang mampu menjilid hingga 20 lembar kertas.',
                    brand: 'Kenko',
                    subcategory: 'stapler',
                    specs: [
                        'Mampu menjilid hingga 20 lembar kertas',
                        'Desain mini dan mudah digunakan',
                        'Material berkualitas untuk ketahanan lama'
                    ]
                },
                ordnerBesarA4: {
                    name: 'Ordner Besar A4',
                    price: 'Rp 22.000',
                    image: 'https://cdn-images.otto-office.com/oode/b2b/deu/mediadatacat/art/1200/OODE_ART_288/OODE_ART_288280HT_01.jpg',
                    description: 'Ordner kuat dengan tuas pengunci logam, cocok untuk arsip volume besar.',
                    subcategory: 'ordner',
                    specs: [
                        'Tuas pengunci logam yang kokoh',
                        'Bahan kuat dan tahan lama',
                        'Cocok untuk arsip volume besar',
                        'Ukuran A4'
                    ]
                },
                sheetProtectorA4: {
                    name: 'Sheet Protector A4',
                    price: 'Rp 1.200',
                    image: 'https://m.media-amazon.com/images/S/aplus-media/sota/371f59f9-8062-4839-b959-203f2e332085.__CR0,0,300,300_PT0_SX300_V1___.png',
                    description: 'Plastik pelindung lembaran dokumen, mencegah kertas rusak atau sobek.',
                    subcategory: 'sheet',
                    specs: [
                        'Bahan plastik transparan berkualitas tinggi',
                        'Ukuran A4, cocok untuk dokumen standar',
                        'Melindungi dokumen dari kerusakan dan sobekan',
                        'Ideal untuk penggunaan di kantor atau sekolah'
                    ]
                },
                map: {
                    name: 'Map Plastik A4',
                    price: 'Rp 5.000',
                    image: 'https://siplahtelkom.com/public/products/177340/3709436/mapplastik.1659042409.jpg',
                    description: 'Map plastik transparan ukuran A4 untuk menyimpan dan melindungi dokumen penting.',
                    subcategory: 'map',
                    specs: [
                        'Ukuran: A4',
                        'Material: PP berkualitas',
                        'Transparansi tinggi',
                        'Tahan lama dan fleksibel'
                    ]
                },
                hvs: {
                    name: 'Kertas HVS A4',
                    price: 'Rp 45.000',
                    image: 'https://img.mbizmarket.co.id/products/thumbs/800x800/2022/06/01/af2a84879a3206a9e90517f1d52a5290.jpg',
                    description: 'Kertas HVS A4 berkualitas tinggi, cocok untuk fotokopi, print, dan berbagai kebutuhan kantor.',
                    subcategory: 'hvs',
                    specs: [
                        'Ukuran: A4 (21 x 29.7 cm)',
                        'Gramatur: 70 gsm',
                        'Isi: 500 lembar per rim',
                        'Putih bersih, cocok untuk print'
                    ]
                },
                stickyNotes3x3: {
                    name: 'Sticky Notes 3x3',
                    price: 'Rp 6.000',
                    image: 'https://i5.walmartimages.com/asr/af9eba15-4297-4bf4-b58c-527f317ead58.a904b07756f5d5ed53aeba6935e9567e.jpeg',
                    description: 'Kertas tempel warna-warni untuk catatan cepat dan pengingat.',
                    subcategory: 'sticky',
                    specs: [
                        'Ukuran 3x3 inci, cocok untuk catatan singkat',
                        'Warna-warni untuk membedakan catatan',
                        'Tahan lama dan mudah ditempelkan',
                        'Cocok untuk kebutuhan kantor, sekolah, atau rumah'
                    ]
                },
                kertasWarnaA4Campuran: {
                    name: 'Kertas Warna A4 Campuran',
                    price: 'Rp 18.000',
                    image: 'https://siplahtelkom.com/public/products/196935/4176520/277697.f6c2d839-2aab-4319-af5f-26ff475f9125.IMG_202304.jpg',
                    description: 'Kertas warna-warni untuk keperluan kreatif atau presentasi.',
                    subcategory: 'kertas-warna',
                    specs: [
                        'Ukuran A4, cocok untuk berbagai aplikasi kreatif',
                        'Berbagai warna yang menarik untuk membuat presentasi atau karya seni lebih hidup',
                        'Kertas berkualitas tinggi untuk hasil cetak yang optimal',
                        'Cocok digunakan untuk dokumen, presentasi, dan proyek kreatif'
                    ]
                },
                memoPadSpiralKecil: {
                    name: 'Memo Pad Spiral Kecil',
                    price: 'Rp 4.000',
                    image: 'https://m.media-amazon.com/images/I/71At1Mi7mCL._AC_.jpg',
                    description: 'Buku catatan kecil spiral, praktis dibawa untuk mencatat ide cepat.',
                    subcategory: 'memo',
                    specs: [
                        'Ukuran kecil dan praktis dibawa kemana saja',
                        'Spiral di bagian atas untuk memudahkan pembukaan',
                        'Cocok untuk mencatat ide cepat, to-do list, atau catatan harian',
                        'Kertas berkualitas untuk menulis dengan nyaman'
                    ]
                },
                lemKertasUHUStick21gr: {
                    name: 'Lem Kertas UHU Stick 21gr',
                    price: 'Rp 12.000',
                    image: 'https://down-id.img.susercontent.com/file/id-11134207-7r98u-llabjnr2sgp028',
                    description: 'Lem stik berkualitas untuk menempelkan kertas tanpa berantakan.',
                    subcategory: 'lem',
                    specs: [
                        'Kemasan praktis dalam bentuk stik',
                        'Mudah digunakan dan tidak berantakan',
                        'Cocok untuk menempelkan kertas, foto, atau dokumen ringan',
                        'Aman digunakan untuk keperluan sekolah, kantor, dan DIY'
                    ]
                },
                labelNamaA465Label: {
                    name: 'Label Nama A4 65 Label',
                    price: 'Rp 15.000',
                    image: 'https://www.crownlabels.com/wp-content/uploads/2017/11/A4-65.jpg',
                    description: 'Label stiker ukuran kecil yang dapat dicetak untuk keperluan pengarsipan.',
                    subcategory: 'label',
                    specs: [
                        'Ukuran A4 dengan 65 label per lembar',
                        'Cocok untuk keperluan pengarsipan atau pemberian label pada berbagai produk',
                        'Dapat dicetak dengan printer inkjet atau laser',
                        'Mudah digunakan dan melekat dengan kuat'
                    ]
                },
                doubleTape1Inch: {
                    name: 'Double Tape 1 Inch',
                    price: 'Rp 8.000',
                    image: 'https://cf.shopee.co.id/file/2d756bd6d10f107e153c3c38d91aed50',
                    description: 'Perekat dua sisi untuk proyek seni atau kebutuhan tempel kuat.',
                    subcategory: 'double-tape',
                    specs: [
                        'Ukuran 1 inch, ideal untuk berbagai keperluan tempel',
                        'Perekat dua sisi untuk menempelkan berbagai material dengan kuat',
                        'Cocok untuk proyek seni, kerajinan, dan penggunaan sehari-hari',
                        'Mudah digunakan dan tahan lama'
                    ]
                },
                lakbanBening2Inch: {
                    name: 'Lakban Bening 2 Inch',
                    price: 'Rp 10.000',
                    image: 'https://down-id.img.susercontent.com/file/id-11134207-7r98x-lm8ajqbvs87i17',
                    description: 'Selotip bening kuat untuk pengemasan atau pelindung dokumen.',
                    subcategory: 'lakban',
                    specs: [
                        'Ukuran 2 inch, cocok untuk pengemasan dan pelindung dokumen',
                        'Transparan dan kuat untuk menempelkan berbagai jenis material',
                        'Ideal untuk penggunaan di kantor, gudang, dan keperluan rumah tangga',
                        'Tahan lama dan mudah digunakan'
                    ]
                },
                cutterKecilJoyko: {
                    name: 'Cutter Kecil Joyko',
                    price: 'Rp 5.000',
                    image: 'https://atkqita.com/wp-content/uploads/Cutter-kecil-JOYKO-A300.jpg',
                    description: 'Cutter kecil dengan pisau tajam, cocok untuk kebutuhan kantor dan sekolah.',
                    subcategory: 'cutter',
                    specs: [
                        'Pisau tajam yang mudah digunakan untuk memotong kertas dan bahan tipis lainnya',
                        'Desain kecil dan ergonomis, nyaman digunakan',
                        'Cocok untuk kebutuhan di kantor, sekolah, atau DIY',
                        'Dilengkapi dengan sistem pengaman untuk mencegah cedera'
                    ]
                },
                guntingKertasStainless: {
                    name: 'Gunting Kertas Stainless',
                    price: 'Rp 8.000',
                    image: 'https://lzd-img-global.slatic.net/g/p/598ef8b6d52d3d918b68dd8d89686657.jpg_720x720q80.jpg',
                    description: 'Gunting presisi dengan pegangan nyaman dan mata pisau tahan lama.',
                    subcategory: 'gunting',
                    specs: [
                        'Mata pisau stainless yang tajam dan tahan lama',
                        'Pegangan ergonomis untuk kenyamanan saat digunakan',
                        'Ideal untuk memotong kertas, karton, dan bahan tipis lainnya',
                        'Desain presisi untuk potongan yang rapi dan akurat'
                    ]
                },
                paperTrimmerA4: {
                    name: 'Paper Trimmer A4',
                    price: 'Rp 125.000',
                    image: 'https://images.nexusapp.co/assets/f4/61/79/164903640.jpg',
                    description: 'Alat pemotong kertas presisi dengan penggaris ukuran, cocok untuk dokumen.',
                    subcategory: 'trimmer',
                    specs: [
                        'Pemotong kertas dengan ukuran A4',
                        'Dilengkapi dengan penggaris presisi untuk pemotongan yang akurat',
                        'Cocok untuk memotong dokumen, foto, dan kertas dalam jumlah banyak',
                        'Desain aman dan mudah digunakan untuk pemotongan rapi'
                    ]
                },
                pisauCutterBesar: {
                    name: 'Pisau Cutter Besar',
                    price: 'Rp 9.000',
                    image: 'https://id-test-11.slatic.net/p/0b0995e37dcdf81614a96c7c660829c7.jpg',
                    description: 'Cutter besar untuk potong kardus atau kertas tebal dengan aman.',
                    subcategory: 'cutter',
                    specs: [
                        'Pisau besar yang tajam, ideal untuk memotong kardus atau bahan tebal lainnya',
                        'Pegangan ergonomis yang nyaman digunakan',
                        'Desain aman dengan pelindung pisau untuk mencegah cedera',
                        'Cocok untuk keperluan rumah tangga, kantor, atau proyek DIY'
                    ]
                }
            };

            // Filter kategori
            // Peta subkategori per kategori ATK
            const atkSubcategoryMap = {
                'alat-tulis': ['pulpen','pensil','spidol','correction'],
                'penjilidan': ['stapler','map','ordner','sheet'],
                'kertas': ['hvs','sticky','kertas-warna','memo'],
                'label': ['lem','label','double-tape','lakban'],
                'pemotong': ['cutter','gunting','trimmer']
            };
            const atkSubcategoryLabels = {
                'pulpen':'Pulpen','pensil':'Pensil','spidol':'Spidol','correction':'Correction Tape',
                'stapler':'Stapler','map':'Map','ordner':'Ordner','sheet':'Sheet Protector',
                'hvs':'Kertas HVS','sticky':'Sticky Notes','kertas-warna':'Kertas Warna','memo':'Memo Pad',
                'lem':'Lem','label':'Label','double-tape':'Double Tape','lakban':'Lakban',
                'cutter':'Cutter','gunting':'Gunting','trimmer':'Paper Trimmer'
            };

            // State kategori saat ini untuk sinkronisasi dropdown subkategori
            let currentAtkCategory = 'all';

            // Render opsi subkategori pada dropdown sesuai kategori aktif
            function renderAtkSubcategorySelect(category) {
                const select = document.getElementById('subcategory-filter');
                if (!select) return;
                const list = category === 'all'
                    ? Object.keys(atkSubcategoryLabels)
                    : (atkSubcategoryMap[category] || []);
                // Bangun opsi
                let optionsHtml = '<option value="all">Semua Sub Kategori</option>';
                optionsHtml += list.map(sc => `<option value="${sc}">${atkSubcategoryLabels[sc] || sc}</option>`).join('');
                select.innerHTML = optionsHtml;
                select.value = 'all';
            }
            // Helper: smooth scroll to element by id with header offset
            function smoothScrollToId(id) {
                const el = document.getElementById(id);
                if (!el) return;
                const y = el.getBoundingClientRect().top + window.pageYOffset - 80;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }

            // Helper: find ATK category by subcategory for related fallback
            function getAtkCategoryBySubcategory(subcat) {
                for (const [cat, subs] of Object.entries(atkSubcategoryMap)) {
                    if (subs.includes(subcat)) return cat;
                }
                return null;
            }

            // renderAtkSubcategoryChips dihapus: gunakan dropdown untuk memilih sub kategori

            // Filter kategori + render chips
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const category = this.dataset.category;
                    document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    document.querySelectorAll('.product-card').forEach(card => {
                        card.style.display = (category === 'all' || card.dataset.category === category) ? 'block' : 'none';
                    });

                    // Simpan kategori aktif dan render ulang opsi dropdown subkategori
                    currentAtkCategory = category;
                    renderAtkSubcategorySelect(category);

                    // Smooth scroll langsung ke grid produk karena chips dihapus
                    smoothScrollToId('products-grid');
                });
            });

            // Show product detail with brand and related products
            function showDetail(productId) {
                const product = productDetails[productId];
                if (!product) return;

                const modalBody = document.getElementById('modal-body');
                const currentPrice = product.price;
                const oldPrice = getOldPrice(currentPrice);
                modalBody.innerHTML = `
                <div class="modal-product">
                    <img src="${product.image}" alt="${product.name}" class="modal-image">
                    <div class="modal-info">
                        <h2><i class="fas fa-box"></i> ${product.name}</h2>
                        <p class="modal-price"><i class="fas fa-tag"></i> ${oldPrice ? `<span class='old-price'>${oldPrice}</span>` : ''} <span>${currentPrice}</span></p>
                        ${product.brand ? '<div class="brand-chip">' + product.brand + '</div>' : ''}
                        <p class="modal-description">${product.description}</p>
                        <h4><i class="fas fa-list"></i> Spesifikasi:</h4>
                        <ul class="modal-specs">
                            ${product.specs.map(spec => `<li>${spec}</li>`).join('')}
                        </ul>
                        <div class="related-title">Produk Serupa</div>
                        <div id="atkRelatedGrid" class="related-products-grid"></div>
                        <div class="modal-actions">
                            <button class="btn-whatsapp" onclick="chatWhatsApp('${product.name}', '${product.price}')">
                                <i class="fab fa-whatsapp"></i>
                                Chat via WhatsApp
                            </button>
                        </div>
                    </div>
                </div>
            `;

                buildAtkRelated(product);

                document.getElementById('product-modal').style.display = 'block';
            }

            // Close modal
            function closeModal() {
                document.getElementById('product-modal').style.display = 'none';
            }

            // Chat WhatsApp
            function chatWhatsApp(productName, price) {
                const phoneNumber = '6281572505989';
                const message =
                    `Halo, saya tertarik dengan produk ${productName} dengan harga ${price}. Bisa info lebih lanjut?`;
                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('product-modal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            // Search Products
            function searchProducts() {
                const searchTerm = document.getElementById('search-input').value.toLowerCase();
                const productCards = document.querySelectorAll('.product-card');

                productCards.forEach(card => {
                    const productName = card.querySelector('h3').textContent.toLowerCase();
                    if (productName.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // Sort Products
            function sortProducts() {
                const sortValue = document.getElementById('sort-filter').value;
                const productsGrid = document.getElementById('products-grid');
                const productCards = Array.from(document.querySelectorAll('.product-card'));

                productCards.sort((a, b) => {
                    const nameA = a.querySelector('h3').textContent;
                    const nameB = b.querySelector('h3').textContent;
                    const priceA = parseInt(a.querySelector('.price').textContent.replace(/[^0-9]/g, ''));
                    const priceB = parseInt(b.querySelector('.price').textContent.replace(/[^0-9]/g, ''));

                    switch (sortValue) {
                        case 'name-asc':
                            return nameA.localeCompare(nameB);
                        case 'name-desc':
                            return nameB.localeCompare(nameA);
                        case 'price-asc':
                            return priceA - priceB;
                        case 'price-desc':
                            return priceB - priceA;
                        default:
                            return 0;
                    }
                });

                // Clear and re-append sorted cards
                productsGrid.innerHTML = '';
                productCards.forEach(card => productsGrid.appendChild(card));
            }

            // Filter by Price
            function filterByPrice() {
                const priceFilter = document.getElementById('price-filter').value;
                const productCards = document.querySelectorAll('.product-card');

                productCards.forEach(card => {
                    const priceText = card.querySelector('.price').textContent;
                    const price = parseInt(priceText.replace(/[^0-9]/g, ''));
                    let showCard = true;

                    switch (priceFilter) {
                        case '0-5000':
                            showCard = price < 5000;
                            break;
                        case '5000-10000':
                            showCard = price >= 5000 && price <= 10000;
                            break;
                        case '10000-25000':
                            showCard = price >= 10000 && price <= 25000;
                            break;
                        case '25000-50000':
                            showCard = price >= 25000 && price <= 50000;
                            break;
                        case '50000-up':
                            showCard = price > 50000;
                            break;
                        case 'all':
                        default:
                            showCard = true;
                            break;
                    }

                    card.style.display = showCard ? 'block' : 'none';
                });
            }

            // Filter by subcategory
            function filterBySubcategory(subcat) {
                const cards = document.querySelectorAll('.product-card');
                // Sinkronkan dropdown saat chip ditekan
                const select = document.getElementById('subcategory-filter');
                if (select) {
                    // Pastikan opsi tersedia sesuai kategori subcat
                    const cat = getAtkCategoryBySubcategory(subcat);
                    if (cat && cat !== currentAtkCategory) {
                        currentAtkCategory = cat;
                        renderAtkSubcategorySelect(cat);
                    }
                    select.value = subcat;
                }

                cards.forEach(card => {
                    const sc = card.dataset.subcategory || '';
                    card.style.display = (sc === subcat) ? 'block' : 'none';
                });
                smoothScrollToId('products-grid');
            }

            // Filter subkategori dari dropdown
            function filterBySubcategoryDropdown() {
                const subcat = document.getElementById('subcategory-filter').value;
                const cards = document.querySelectorAll('.product-card');
                cards.forEach(card => {
                    const sc = card.dataset.subcategory || '';
                    const matchesCategory = (currentAtkCategory === 'all' || card.dataset.category === currentAtkCategory);
                    const matchesSubcat = (subcat === 'all' || sc === subcat);
                    card.style.display = (matchesCategory && matchesSubcat) ? 'block' : 'none';
                });
                smoothScrollToId('products-grid');
            }

            // Build related products grid based on subcategory
            function buildAtkRelated(product) {
                const entries = Object.entries(productDetails);
                const related = entries
                    .filter(([key, p]) => (p.subcategory && product.subcategory && p.subcategory === product.subcategory) && p.name !== product.name)
                    .slice(0, 6);
                // Fallback: jika tidak ada produk serupa dalam subkategori yang sama
                if (!related.length) {
                    const cat = getAtkCategoryBySubcategory(product.subcategory);
                    if (cat) {
                        const inCat = entries.filter(([key, p]) => p.subcategory && (atkSubcategoryMap[cat] || []).includes(p.subcategory) && p.name !== product.name);
                        related.push(...inCat.slice(0, 6));
                    }
                }
                const grid = document.getElementById('atkRelatedGrid');
                if (!grid) return;
                grid.innerHTML = '';
                related.forEach(([key, r]) => {
                    const div = document.createElement('div');
                    div.className = 'related-card';
                    div.innerHTML = `
                        <img src="${r.image}" alt="${r.name}" class="related-image" onerror="this.style.display='none';">
                        <div class="related-name">${r.name}</div>
                        <div class="related-price">${r.price}</div>
                    `;
                    div.style.cursor = 'pointer';
                    div.addEventListener('click', () => showDetail(key));
                    grid.appendChild(div);
                });
            }

            // Harga lama untuk promo (estimasi 15% lebih tinggi)
            function getOldPrice(priceStr) {
                const num = parseInt((priceStr || '').replace(/[^0-9]/g, ''));
                if (!num || num <= 0) return '';
                const old = Math.round(num * 1.15);
                return 'Rp ' + old.toLocaleString('id-ID');
            }

            // Terapkan harga coret pada kartu produk yang promo
            function applyOldPriceToCards() {
                document.querySelectorAll('.product-card[data-promo="true"]').forEach(card => {
                    const priceEl = card.querySelector('.price');
                    if (!priceEl) return;
                    if (priceEl.dataset.enhanced === 'true') return;
                    const current = priceEl.textContent.trim();
                    const old = getOldPrice(current);
                    if (old) {
                        priceEl.innerHTML = `<span class="old-price">${old}</span> <span class="current-price">${current}</span>`;
                        priceEl.dataset.enhanced = 'true';
                    }
                });
            }

            // Show more with dummy: clone cards to reach 50 and reveal gradually
            let atkVisibleCount = 20;
            function setupAtkShowMoreWithDummy() {
                const grid = document.getElementById('products-grid');
                if (!grid) return;
                const currentCards = Array.from(grid.querySelectorAll('.product-card'));
                // Clone until 50
                let i = 0;
                while (grid.querySelectorAll('.product-card').length < 50) {
                    const base = currentCards[i % currentCards.length].cloneNode(true);
                    grid.appendChild(base);
                    i++;
                }
                // Hide beyond visibleCount
                const allCards = Array.from(grid.querySelectorAll('.product-card'));
                allCards.forEach((card, idx) => {
                    card.style.display = (idx < atkVisibleCount) ? 'block' : 'none';
                });
                // Toggle button
                const btn = document.getElementById('atkShowMoreBtn');
                if (btn) btn.style.display = 'inline-block';
            }

            function atkShowMore() {
                const grid = document.getElementById('products-grid');
                const cards = Array.from(grid.querySelectorAll('.product-card'));
                atkVisibleCount = Math.min(atkVisibleCount + 10, cards.length);
                cards.forEach((card, idx) => {
                    card.style.display = (idx < atkVisibleCount) ? 'block' : 'none';
                });
                if (atkVisibleCount >= cards.length) {
                    const btn = document.getElementById('atkShowMoreBtn');
                    if (btn) btn.style.display = 'none';
                }
            }

            // Carousel Functionality
            let currentSlideIndex = 0;
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.dot');
            const totalSlides = slides.length;

            function showSlide(index) {
                // Remove active class from all slides and dots
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                // Add active class to current slide and dot
                slides[index].classList.add('active');
                dots[index].classList.add('active');
            }

            function changeSlide(direction) {
                currentSlideIndex += direction;

                if (currentSlideIndex >= totalSlides) {
                    currentSlideIndex = 0;
                } else if (currentSlideIndex < 0) {
                    currentSlideIndex = totalSlides - 1;
                }

                showSlide(currentSlideIndex);
            }

            function currentSlide(index) {
                currentSlideIndex = index - 1;
                showSlide(currentSlideIndex);
            }

            // Auto-slide functionality
            function autoSlide() {
                currentSlideIndex++;
                if (currentSlideIndex >= totalSlides) {
                    currentSlideIndex = 0;
                }
                showSlide(currentSlideIndex);
            }

            // Start auto-slide every 5 seconds
            let autoSlideInterval = setInterval(autoSlide, 5000);

            // Pause auto-slide on hover
            const carouselContainer = document.querySelector('.carousel-container');
            if (carouselContainer) {
                carouselContainer.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                });

                carouselContainer.addEventListener('mouseleave', () => {
                    autoSlideInterval = setInterval(autoSlide, 5000);
                });
            }

            // Initialize carousel
            document.addEventListener('DOMContentLoaded', function() {
                showSlide(0);
                setupAtkShowMoreWithDummy();
                // Chips dihapus; cukup render opsi dropdown
                renderAtkSubcategorySelect('all');
                currentAtkCategory = 'all';
                applyOldPriceToCards();
            });
        </script>
</body>

</html>
<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <img src="{{ asset('assets/demo/toko-atk/images/20250819_1904_Logo_E-Catalog_Alat_Tulis_simple_compose_01k313dfh6e1xtcnhs1atfdnt3-removebg-preview.png') }}"
                alt="E-Katalog ATK Logo" class="footer-logo">
        </div>

        <div class="footer-section">
            <h4>Contact</h4>
            <div class="contact-info">
                <p>Jl. Cysca Raya II, Taman Setia Budi Indah</p>
                <p>Blok VV No.172 Kompleks, Asam Kumbang,</p>
                <p>Kec. Medan Selayang, Kota Medan,</p>
                <p>Sumatera Utara 20133</p>
                <br>
                <p>ptenciptadigital@gmail.com</p>
                <p>+62 815-7250-5989</p>
                <br>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 PT. Era Cipta Digital</p>
    </div>
</footer>



<!-- Universal Checkout Bubble -->
@include('demo.universal-checkout-bubble', [
    'templateSlug' => 'toko-atk',
])
</body>

</html>
