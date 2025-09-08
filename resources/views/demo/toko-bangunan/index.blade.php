<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>E-Katalog Toko Bangunan</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-bangunan/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-container">
            <div class="header-top">
                <div class="logo">
                    <img src="{{ asset('assets/demo/toko-bangunan/image/logo_helm.png') }}" alt="Logo Helm"
                        class="logo-image" style="width: 50px; height: 50px; background: transparent;">
                    <div class="logo-text">E-KATALOG TOKO BANGUNAN</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel Section -->
    <div class="carousel-section">
        <div class="carousel">
            <div class="carousel-inner" id="carouselInner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                        alt="Material Bangunan">
                    <div class="carousel-caption">
                        <h3>Material Bangunan Berkualitas</h3>
                        <p>Temukan berbagai pilihan material bangunan terbaik untuk proyek konstruksi Anda</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                        alt="Peralatan Konstruksi">
                    <div class="carousel-caption">
                        <h3>Peralatan Kebersihan Modern</h3>
                        <p>Tingkatkan efisiensi pekerjaan dengan peralatan kebersihan yang modern dan handal</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                        alt="Cat dan Finishing">
                    <div class="carousel-caption">
                        <h3>Instalasi Listrik Handal</h3>
                        <p>Dilengkapi peralatan standar tinggi untuk menjamin kualitas instalasi dan keselamatan
                            bangunan</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control prev" onclick="prevSlide()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-control next" onclick="nextSlide()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Category Section -->
    <div class="category-section">
        <div class="category-container">
            <h2 class="category-title">Kategori Produk</h2>
            <div class="category-grid">
                <div class="category-item" onclick="filterByCategory('cat')">
                    <h3>Cat & Finishing</h3>
                    <p>Berbagai jenis cat berkualitas tinggi untuk interior dan eksterior</p>
                </div>
                <div class="category-item" onclick="filterByCategory('keramik')">
                    <h3>Keramik & Lantai</h3>
                    <p>Keramik dan material lantai dengan berbagai motif dan ukuran</p>
                </div>
                <div class="category-item" onclick="filterByCategory('listrik')">
                    <h3>Listrik & Kabel</h3>
                    <p>Peralatan instalasi listrik dan kabel berkualitas standar SNI</p>
                </div>
                <div class="category-item" onclick="filterByCategory('sanitair')">
                    <h3>Sanitair & Plambing</h3>
                    <p>Perlengkapan kamar mandi dan sistem plambing modern</p>
                </div>
                <div class="category-item" onclick="filterByCategory('alat')">
                    <h3>Alat & Mesin</h3>
                    <p>Peralatan konstruksi dan mesin untuk berbagai kebutuhan</p>
                </div>
                <div class="category-item" onclick="filterByCategory('semen')">
                    <h3>Semen & Material</h3>
                    <p>Material dasar bangunan berkualitas untuk konstruksi</p>
                </div>
                <div class="category-item" onclick="filterByCategory('besi')">
                    <h3>Besi & Baja</h3>
                    <p>Struktur besi dan baja untuk rangka bangunan yang kuat</p>
                </div>
                <div class="category-item" onclick="filterByCategory('genteng')">
                    <h3>Genteng & Atap</h3>
                    <p>Material penutup atap tahan cuaca dan berkualitas</p>
                </div>
                <div class="category-item" onclick="filterByCategory('new')">
                    <h3>Produk Terbaru</h3>
                    <p>Koleksi produk terbaru dengan teknologi dan desain modern</p>
                </div>
            </div>
            <div class="view-all-container">
                <button class="view-all-button" onclick="filterByCategory('all')">Lihat Semua Produk</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2 class="section-title">Produk Kami</h2>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-container">
                    <input type="text" class="search-box" placeholder="Cari produk..." id="searchBox">
                    <select id="priceRangeFilter" class="search-box" style="min-width: 200px;">
                        <option value="">Rentang Harga Produk</option>
                        <option value="0-100000">Di bawah Rp 100.000</option>
                        <option value="100000-200000">Rp 100.000 - Rp 200.000</option>
                        <option value="200000-300000">Rp 200.000 - Rp 300.000</option>
                        <option value="300000-500000">Rp 300.000 - Rp 500.000</option>
                        <option value="500000-999999999">Di atas Rp 500.000</option>
                    </select>
                    <select id="sortBy" class="search-box" style="min-width: 200px;">
                        <option value="">Urutkan</option>
                        <option value="newest">Terbaru</option>
                        <option value="price-asc">Harga: Termurah</option>
                        <option value="price-desc">Harga: Termahal</option>
                        <option value="name-asc">Nama: A–Z</option>
                        <option value="name-desc">Nama: Z–A</option>
                    </select>
                </div>
            </div>

            <div class="products-grid" id="productsGrid">
                <!-- Products will be populated by JavaScript -->
            </div>
            <script>
                // Initialize products on page load
                document.addEventListener('DOMContentLoaded', function() {
                    renderProducts(products);
                });
            </script>
        </div>
    </div>

    <!-- Modal for Product Detail -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="modal-title" id="modalTitle"></div>
                <div class="modal-price" id="modalPrice"></div>
            </div>
            <div class="modal-body">
                <img id="modalImage" class="modal-image" alt="">
                <div style="margin-bottom: 15px;">
                    <span id="modalCategory"
                        style="display: inline-block; background: #3498db; color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.9em; margin-right: 10px;"></span>
                    <span id="modalUnit"
                        style="display: inline-block; background: #2ecc71; color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.9em;"></span>
                </div>
                <div class="modal-price" id="modalPriceDetail"
                    style="margin-bottom: 15px; font-size: 1.2em; color: #e74c3c;"></div>
                <div class="modal-description" id="modalDescription"></div>
            </div>
            <div class="modal-actions">
                <button class="modal-whatsapp" onclick="chatWhatsAppFromModal()">
                    <svg class="whatsapp-icon" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                    </svg>
                    Chat WhatsApp
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="{{ asset('assets/demo/toko-bangunan/image/logo_helm.png') }}" alt="Logo Helm"
                        class="footer-logo-image" style="width: 150px; height: 150px; background: transparent;">
                    <h3 class="footer-logo-text">E-Katalog Toko Bangunan</h3>
                </div>
            </div>

            <div class="footer-section footer-contact">
                <h3>Kontak</h3>
                <div class="address-container">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="address-text">
                        <div>Jl. Cycas Raya Jl. Taman Setia Budi Indah</div>
                        <div>Blok VV No.172 Kompleks, Asam Kumbang</div>
                        <div>Kec. Medan Selayang, Kota Medan</div>
                        <div>Sumatera Utara 20133</div>
                    </div>
                </div>
                <p><i class="fas fa-phone"></i> 08116584545</p>
                <p><i class="fas fa-envelope"></i> pteraciptadigital@gmail.com</p>
                <div class="social-media">
                    <a href="https://www.instagram.com/fauzy900_" target="_blank" class="social-icon"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/tokobangunan" target="_blank" class="social-icon"><i
                            class="fab fa-facebook"></i></a>
                    <a href="https://www.twitter.com/@m29641376" target="_blank" class="social-icon"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                <span>© 2025 PT. Era Cipta Digital</span>
            </div>
        </div>
    </footer>

    <script>
        // Product data based on the images provided
        const products = [{
                id: 1,
                name: "Cat Tembok Dulux 25kg",
                price: "Rp 250.000",
                unit: "kaleng",
                description: "Cat tembok berkualitas tinggi merk Dulux dengan daya tutup yang baik dan tahan lama. Cocok untuk interior rumah dengan berbagai pilihan warna.",
                image: "https://images.unsplash.com/photo-1562259949-e8e7689d7828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                category: "cat",
                whatsapp: "6287897325612"
            },
            {
                id: 2,
                name: "Cat Kayu Biovarnish 1L",
                price: "Rp 85.000",
                unit: "kaleng",
                description: "Cat kayu ramah lingkungan Biovarnish berbasis air. Memberikan hasil finishing natural dan melindungi kayu dari cuaca.",
                image: "https://image.tokocatsurabaya.com/s3/productimages/webp/co64191/p519282/w600-h600/5839c5ac-44ee-437c-911e-51f35ded17cdw.jpg",
                category: "cat",
                whatsapp: "6287897325612"
            },
            {
                id: 3,
                name: "Keramik Lantai 60x60",
                price: "Rp 45.000",
                unit: "m²",
                description: "Keramik lantai berkualitas untuk rumah dan bangunan komersial. Tersedia berbagai motif dan warna. Tahan lama dan mudah perawatan.",
                image: "https://media.dekoruma.com/article/2021/08/20105033/ukr2a-ukuran-keramik-lantai-kecil-dengan-aneka-motif.jpg?fit=300%2C201&ssl=1",
                category: "keramik",
                whatsapp: "6287897325612"
            },
            {
                id: 4,
                name: "Granit Tile 60x60",
                price: "Rp 125.000",
                unit: "m²",
                description: "Granit tile ukuran 60x60 cm dengan permukaan glossy. Cocok untuk ruang tamu, dapur, dan area komersial. Tahan gores dan mudah dibersihkan.",
                image: "https://tiperumah.id/blog/wp-content/uploads/2023/05/Marmer-Vs-Granit-1.png",
                category: "keramik",
                whatsapp: "6287897325612"
            },
            {
                id: 5,
                name: "Kabel NYM 3x2.5",
                price: "Rp 15.000",
                unit: "meter",
                description: "Kabel listrik NYM 3x2.5 mm² berkualitas SNI untuk instalasi listrik rumah. Isolasi ganda untuk keamanan maksimal.",
                image: "https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/105/MTA-177518571/brd-44261_kabel-listrik-nym-2x1-5-mm-kawat-tunggal_full01-d6a4d945.jpg",
                category: "listrik",
                whatsapp: "6287897325612"
            },
            {
                id: 6,
                name: "Saklar Ganda Broco",
                price: "Rp 18.000",
                unit: "biji",
                description: "Saklar ganda merk Broco dengan kualitas terbaik. Desain modern dan tahan lama. Cocok untuk berbagai kebutuhan instalasi listrik.",
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCeoIFPPIWAK67kiqICcK6WXx_WECkyJQfzQ&s",
                category: "listrik",
                whatsapp: "6287897325612"
            },
            {
                id: 7,
                name: "Kloset Duduk TOTO",
                price: "Rp 850.000",
                unit: "set",
                description: "Kloset duduk berkualitas merk TOTO dengan sistem dual flush. Hemat air dan mudah dibersihkan. Termasuk tutup dudukan soft close.",
                image: "https://media.monotaro.id/mid01/big/Bahan%20Bangunan%2C%20Perlengkapan%20Rumah%20%26%20Cat/Peralatan%20Rumah/Toilet/TOTO%20Kloset%20Duduk%20One%20Piece/l2P103783758-2.jpg",
                category: "sanitair",
                whatsapp: "6287897325612"
            },
            {
                id: 8,
                name: "Wastafel Keramik Modern",
                price: "Rp 450.000",
                unit: "biji",
                description: "Wastafel keramik dengan desain modern dan elegan. Cocok untuk kamar mandi minimalis. Mudah perawatan dan tahan lama.",
                image: "https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/MTA-23985698/brand_wastafel_keramik_wikea_k95_full01_fj5hynh2.jpg",
                category: "sanitair",
                whatsapp: "6287897325612"
            },
            {
                id: 9,
                name: "Mesin Bor Impact",
                price: "Rp 650.000",
                unit: "unit",
                description: "Mesin bor impact untuk konstruksi dan pekerjaan berat. Dilengkapi dengan baterai rechargeable dan berbagai mata bor.",
                image: "https://images.unsplash.com/photo-1572981779307-38b8cabb2407?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
                category: "alat",
                whatsapp: "6287897325612",
                isNew: true
            },
            {
                id: 10,
                name: "Gergaji Kayu 24 inch",
                price: "Rp 95.000",
                unit: "biji",
                description: "Gergaji kayu ukuran 24 inch dengan mata gergaji tajam. Cocok untuk memotong kayu berbagai ukuran. Handle ergonomis untuk kenyamanan penggunaan.",
                image: "https://media.monotaro.id/mid01/big/Batu%20Potong%20Mesin%20%26%20Gerinda/Perkakas%20Potong/Gergaji%20Pita%2C%20Mata%20Gergaji/Pisau%20Gergaji/Kenmaster%20Gergaji%20Kayu/5vP105691211-1.jpg",
                category: "alat",
                whatsapp: "6287897325612"
            },
            {
                id: 11,
                name: "Semen 50kg",
                price: "Rp 65.000",
                unit: "sak",
                description: "Semen berkualitas tinggi untuk konstruksi berat. Cocok untuk pondasi, kolom, dan struktur bangunan. Daya rekat kuat dan cepat mengeras.",
                image: "https://smb-padiumkm-images-public-prod.oss-ap-southeast-5.aliyuncs.com/product/image/18032024/631a57ba7255a77e0e709682/65f7a57a11aafaeddf8f9537/bf16956915b66114830d2384ad068d.jpg?x-oss-process=image/resize,m_pad,w_432,h_432/quality,Q_70",
                category: "semen",
                whatsapp: "6287897325612"
            },
            {
                id: 12,
                name: "Pasir",
                price: "Rp 350.000",
                unit: "m³",
                description: "Pasir berkualitas untuk adukan beton dan plesteran dinding. Pasir ini telah melalui proses penyaringan untuk hasil terbaik.",
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcggBOkQ5iUep5RyDd-JuWt68F_r-I4j36RA&s",
                category: "semen",
                whatsapp: "6287897325612"
            },
            {
                id: 13,
                name: "Besi Beton",
                price: "Rp 15.000",
                unit: "batang",
                description: "Besi beton SNI untuk struktur bangunan dengan panjang 12 meter. Memiliki kekuatan tarik tinggi dan tahan korosi. Berbagai diameter tersedia.",
                image: "https://siopen.hulusungaiselatankab.go.id/storage/merchant/products/2024/06/11/7c8cd931dd319e7ed2bb2a2020b9a5ff.jpg",
                category: "besi",
                whatsapp: "6287897325612"
            },
            {
                id: 14,
                name: "Besi Hollow 4x4",
                price: "Rp 95.000",
                unit: "batang",
                description: "Besi hollow galvanis anti karat untuk rangka dan konstruksi ringan. Memiliki ketebalan dinding yang seragam untuk kekuatan optimal.",
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkLrDdW_HMEs5xt3LZmYeHz7_YGdJxppTaFQ&s",
                category: "besi",
                whatsapp: "6287897325612"
            },
            {
                id: 15,
                name: "Genteng Keramik Glazur",
                price: "Rp 9.000",
                unit: "biji",
                description: "Genteng keramik glazur tahan lama dengan berbagai pilihan warna. Memiliki lapisan glazur yang mengkilap dan tahan cuaca ekstrem.",
                image: "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjtQoOdeAw7bX7nBmhiFMXkgAhbmdHGpoDKY2tvDkzxM00oShzRs8HilLCxo9xkqmGVTarO9n3xsvFLickMXXNK8-Temul8t2puu2197_RuK5DSwVycM9ctnvANRBosLG04NH7p_-XLu6Y5/s640/Harga-Jual-Genteng-Keramik.jpg",
                category: "genteng",
                whatsapp: "6287897325612"
            }
        ];

        let filteredProducts = [...products];
        let currentProduct = null;

        // Render products to the grid
        function renderProducts(productsToRender) {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';

            if (productsToRender.length === 0) {
                grid.innerHTML =
                    '<p style="text-align: center; color: #666; grid-column: 1 / -1; font-size: 1.1em; margin: 40px 0;">Tidak ada produk yang ditemukan.</p>';
                return;
            }

            productsToRender.forEach((product, index) => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';

                // Membatasi deskripsi produk agar tidak terlalu panjang
                let shortDescription = product.description;
                if (shortDescription.length > 120) {
                    shortDescription = shortDescription.substring(0, 120) + '...';
                }

                productCard.innerHTML = `
                    ${product.isNew ? '<div class="new-badge">New</div>' : ''}
                    <img src="${product.image}" alt="${product.name}" class="product-image"
                         onerror="this.style.display='none';">
                    <div class="product-content">
                        <h3 class="product-name">${product.name}</h3>
                        <div class="product-price">${product.price}/${product.unit}</div>
                        <p class="product-description">${shortDescription}</p>
                        <div class="button-group">
                            <button class="detail-btn" onclick="showDetail(${index})">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                Lihat Detail
                            </button>
                            <button class="chat-btn" onclick="chatWhatsApp('${product.whatsapp}', '${product.name}')">
                                <svg class="whatsapp-icon" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                Chat WA
                            </button>
                        </div>
                    </div>
                `;
                grid.appendChild(productCard);
            });
        }

        // Show product detail in modal
        function showDetail(index) {
            const product = filteredProducts[index];
            currentProduct = product;

            document.getElementById('modalTitle').textContent = product.name;
            document.getElementById('modalPrice').textContent = product.price;
            document.getElementById('modalUnit').textContent = product.unit ? `Unit: ${product.unit}` : '';
            document.getElementById('modalImage').src = product.image;
            document.getElementById('modalImage').alt = product.name;
            document.getElementById('modalCategory').textContent = getCategoryName(product.category);
            document.getElementById('modalDescription').textContent = product.description;
            document.getElementById('modalPriceDetail').textContent = `${product.price}/${product.unit}`;

            document.getElementById('productModal').style.display = 'block';
        }

        // Get category display name
        function getCategoryName(category) {
            const categoryMap = {
                'cat': 'Cat & Finishing',
                'keramik': 'Keramik & Lantai',
                'listrik': 'Listrik & Kabel',
                'sanitair': 'Sanitair & Plambing',
                'alat': 'Alat & Mesin',
                'semen': 'Semen & Material',
                'besi': 'Besi & Baja',
                'genteng': 'Genteng & Atap',
                'new': 'New'
            };
            return categoryMap[category] || category;
        }

        // Close modal
        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        // WhatsApp chat function
        function chatWhatsApp(phone, productName) {
            const message = `Halo, saya tertarik dengan produk ${productName}. Mohon info lebih lanjut.`;
            const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        // WhatsApp chat from modal
        function chatWhatsAppFromModal() {
            if (currentProduct) {
                chatWhatsApp(currentProduct.whatsapp, currentProduct.name);
                closeModal();
            }
        }

        // Filter products based on search and price range
        function filterProducts() {
            const searchTerm = document.getElementById('searchBox').value.toLowerCase();
            const selectedPriceRange = document.getElementById('priceRangeFilter').value;

            let filtered = products.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchTerm) ||
                    product.description.toLowerCase().includes(searchTerm);

                // Check if product matches selected price range
                let matchesPriceRange = true;
                if (selectedPriceRange !== '') {
                    const [minPrice, maxPrice] = selectedPriceRange.split('-').map(Number);
                    const productPrice = Number(product.price.replace(/[^0-9]/g, ''));
                    matchesPriceRange = productPrice >= minPrice && productPrice <= maxPrice;
                }

                return matchesSearch && matchesPriceRange;
            });

            filteredProducts = filtered;
            renderProducts(filtered);
        }

        // Filter by category from footer - filter products and scroll to them
        function filterByCategory(category) {
            // Filter products by category
            if (category === 'all') {
                // Show all products when 'all' is selected
                filteredProducts = [...products];
            } else {
                filteredProducts = products.filter(product => {
                    if (category === 'new') {
                        return product.isNew === true;
                    }
                    return product.category === category;
                });
            }

            // Render filtered products
            renderProducts(filteredProducts);

            // Scroll to products section
            document.querySelector('.products-grid').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Carousel functionality
        let currentSlide = 0;
        const totalSlides = document.querySelectorAll('.carousel-item').length;

        function updateCarousel() {
            const carouselInner = document.getElementById('carouselInner');
            carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Search and filter functionality
        document.getElementById('searchBox').addEventListener('input', filterProducts);
        document.getElementById('priceRangeFilter').addEventListener('change', filterProducts);

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('productModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Navbar link functionality
        const kategoriLink = document.getElementById('kategori-link');
        if (kategoriLink) {
            kategoriLink.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryFilter = document.getElementById('categoryFilter');
                if (categoryFilter) categoryFilter.focus();
                const headerSection = document.querySelector('.header-section');
                if (headerSection) headerSection.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        }

        const produkLink = document.getElementById('produk-link');
        if (produkLink) {
            produkLink.addEventListener('click', function(e) {
                e.preventDefault();
                const searchBox = document.getElementById('searchBox');
                if (searchBox) searchBox.focus();
                const mainContent = document.querySelector('.main-content');
                if (mainContent) mainContent.scrollIntoView({
                    behavior: 'smooth'
                });
                const navbarNav = document.getElementById('navbarNav');
                if (navbarNav) navbarNav.classList.remove('active');
            });
        }

        const kontakLink = document.getElementById('kontak-link');
        if (kontakLink) {
            kontakLink.addEventListener('click', function(e) {
                e.preventDefault();
                const footer = document.querySelector('.footer');
                if (footer) footer.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                const navbarNav = document.getElementById('navbarNav');
                if (navbarNav) navbarNav.classList.toggle('active');
            });
        }

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.navbar-nav .nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                document.getElementById('navbarNav').classList.remove('active');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar');
            const navbarNav = document.getElementById('navbarNav');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');

            if (!navbar.contains(event.target) && navbarNav.classList.contains('active')) {
                navbarNav.classList.remove('active');
            }
        });
    </script>
    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-bangunan',
    ])
</body>

</html>
