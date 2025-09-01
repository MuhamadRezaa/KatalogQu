<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Katalog Aksesoris Mobil Premium</title>
    <link rel="stylesheet" href="{{asset('assets/demo/aksesoris_mobil/style.css')}}">
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="container">
                <h1>E-Katalog Aksesoris Mobil</h1>
                <p>Koleksi Aksesoris Mobil Premium Terlengkap di Indonesia</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="search-filter-container">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Cari produk aksesoris mobil..." class="search-input">
                <button onclick="searchProducts()" class="search-btn">🔍 Cari</button>
            </div>

            <div class="filter-container">
                <select id="categoryFilter" onchange="filterByCategory()" class="filter-select">
                    <option value="">🏷️ Semua Kategori</option>
                    <option value="Interior">🪑 Interior</option>
                    <option value="Audio">🔊 Audio</option>
                    <option value="Performance">⚡ Performance</option>
                    <option value="Lighting">💡 Lighting</option>
                    <option value="Protection">🛡️ Protection</option>
                    <option value="Exterior">🎨 Exterior</option>
                    <option value="Wheels">⭕ Wheels</option>
                    <option value="Safety">🚨 Safety</option>
                </select>
            </div>
        </div>

        <div id="noResults" class="no-results hidden">
            <h3>😔 Tidak ada produk yang ditemukan</h3>
            <p>Coba kata kunci lain atau pilih kategori yang berbeda.</p>
        </div>
    </div>

    <div class="catalog-container" id="catalogContainer">
        <div class="product-card" data-category="Interior" data-name="sarung jok kulit premium">
            <div class="product-image">
                <img src="https://cf.shopee.co.id/file/f00f7d91125d97cd63a3bc84eae5e9d2" alt="Sarung Jok Kulit Premium" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Interior</span>
                <h3 class="product-name">Sarung Jok Kulit Premium</h3>
                <p class="product-description">Sarung jok kulit asli berkualitas tinggi dengan desain ergonomis dan jahitan presisi. Memberikan kenyamanan maksimal dan tampilan mewah.</p>
                <ul class="product-features">
                    <li>100% kulit asli grade A</li>
                    <li>Tahan air dan mudah dibersihkan</li>
                    <li>Ventilasi udara optimal</li>
                    <li>Garansi 2 tahun</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 2.850.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.9)</span>
                    </div>
                </div>
                <button onclick="showDetail('Sarung Jok Kulit Premium')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Interior" data-name="dashboard cover premium">
            <div class="product-image">
                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/83/MTA-111225106/oem_oem_full01.jpg" alt="Dashboard Cover Premium" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Interior</span>
                <h3 class="product-name">Dashboard Cover Premium</h3>
                <p class="product-description">Cover dashboard berbahan dasar karpet berkualitas tinggi dengan lapisan anti slip. Melindungi dashboard dari sinar UV dan memberikan tampilan interior yang lebih elegan.</p>
                <ul class="product-features">
                    <li>Bahan karpet premium grade A</li>
                    <li>Anti slip dan anti UV</li>
                    <li>Custom fit untuk berbagai model</li>
                    <li>Mudah dipasang tanpa tools</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 385.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.5)</span>
                    </div>
                </div>
                <button onclick="showDetail('Dashboard Cover Premium')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Audio" data-name="speaker component set">
            <div class="product-image">
                <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/91/MTA-4166344/jbl_jbl_cs760c_component_set_speaker_split_pintu_mobil_-6-5_inch-_full02.jpg" alt="Speaker Component Set" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Audio</span>
                <h3 class="product-name">Speaker Component Set</h3>
                <p class="product-description">Sistem audio komponen 3-way dengan teknologi terdepan. Menghadirkan kualitas suara hi-fi yang jernih dan bass yang menggelegar.</p>
                <ul class="product-features">
                    <li>Power 200W RMS</li>
                    <li>Frekuensi 20Hz - 25kHz</li>
                    <li>Tweeter titanium dome</li>
                    <li>Crossover external</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 1.450.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.7)</span>
                    </div>
                </div>
                <button onclick="showDetail('Speaker Component Set')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Audio" data-name="car audio subwoofer">
    <div class="product-image">
        <img src="https://www.bassheadspeakers.com/wp-content/uploads/2018/07/Pioneer-TS-SWX2505-Car-Subwoofer.jpg" alt="Car Audio Subwoofer" class="product-img">
    </div>
    <div class="product-info">
        <span class="product-category">Audio</span>
        <h3 class="product-name">Car Audio Subwoofer</h3>
        <p class="product-description">Subwoofer 15 inci dengan kekuatan bass luar biasa, dirancang untuk meningkatkan kualitas suara audio mobil Anda ke level yang lebih tinggi.</p>
        <ul class="product-features">
            <li>15-Inch Subwoofer</li>
            <li>Power 1000W RMS</li>
            <li>Deep bass dengan frekuensi rendah</li>
            <li>Struktur kokoh dan tahan lama</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 3.850.000</div>
            <div class="product-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">(4.8)</span>
            </div>
        </div>
        <button onclick="showDetail('Car Audio Subwoofer')" class="detail-btn">Lihat Detail</button>
    </div>
</div>

        <div class="product-card" data-category="Performance" data-name="remote start system">
            <div class="product-image">
                <img src="https://www.tintingwausau.com/wp-content/uploads/arctic-start-2-way-flex-2-remote-starter-keyless-entry.jpg" alt="Remote Start System" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Performance</span>
                <h3 class="product-name">Remote Start System</h3>
                <p class="product-description">Sistem remote start untuk memulai mobil dari jarak jauh, memberikan kenyamanan saat cuaca dingin atau panas, serta meningkatkan keamanan kendaraan.</p>
                <ul class="product-features">
                    <li>Jarak jangkauan hingga 100 meter</li>
                    <li>Kompatibel dengan mobil berbagai merek</li>
                    <li>Mudah dipasang dan digunakan</li>
                    <li>Fitur pengamanan ganda</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 2.500.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.7)</span>
                    </div>
                </div>
                <button onclick="showDetail('Remote Start System')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>


        <div class="product-card" data-category="Performance" data-name="cold air intake system">
            <div class="product-image">
                <img src="https://www.autoaccessoriesgarage.com/img/group/main/49/4989_1_lg.jpg" alt="Cold Air Intake System" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Performance</span>
                <h3 class="product-name">Cold Air Intake System</h3>
                <p class="product-description">Sistem intake udara dingin untuk meningkatkan performa mesin. Dirancang khusus untuk memberikan aliran udara optimal dan suara mesin yang sporty.</p>
                <ul class="product-features">
                    <li>Filter udara high-flow</li>
                    <li>Pipa aluminium 6061-T6</li>
                    <li>Meningkatkan HP hingga 15%</li>
                    <li>Easy installation</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 3.200.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.8)</span>
                    </div>
                </div>
                <button onclick="showDetail('Cold Air Intake System')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Lighting" data-name="led headlight kit">
            <div class="product-image">
                <img src="https://d114hh0cykhyb0.cloudfront.net/images/uploads/led-headlight-conversion-kit-9004.jpg" alt="LED Headlight Kit" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Lighting</span>
                <h3 class="product-name">LED Headlight Kit</h3>
                <p class="product-description">Lampu LED ultra bright dengan teknologi COB terbaru. Memberikan pencahayaan 300% lebih terang dari lampu halogen standar.</p>
                <ul class="product-features">
                    <li>Brightness 12000 lumens</li>
                    <li>Color temperature 6500K</li>
                    <li>Waterproof IP67</li>
                    <li>Lifetime 50.000 jam</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 950.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.6)</span>
                    </div>
                </div>
                <button onclick="showDetail('LED Headlight Kit')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Lighting" data-name="LED Fog Light Kit">
            <div class="product-image">
             <img src="https://bestheadlightbulbs.com/wp-content/uploads/2017/01/OPT7-Fluxbeam-LED-Fog-Light-Kit.jpg" alt="LED Fog Light Kit" class="product-img">
            </div>
    <div class="product-info">
        <span class="product-category">Lighting</span>
        <h3 class="product-name">LED Fog Light Kit</h3>
        <p class="product-description">Lampu kabut LED dengan desain kompak, memberikan pencahayaan ekstra yang tajam dan terang, cocok untuk pengemudi yang membutuhkan visibilitas lebih baik dalam cuaca buruk.</p>
        <ul class="product-features">
            <li>Brightness 6000 lumens</li>
            <li>Color temperature 6000K</li>
            <li>Waterproof IP68</li>
            <li>Lifetime 30.000 jam</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 650.000</div>
            <div class="product-rating">
                <span class="stars">★★★★☆</span>
                <span class="rating-text">(4.7)</span>
            </div>
        </div>
        <button onclick="showDetail('LED Fog Light Kit')" class="detail-btn">Lihat Detail</button>
    </div>
</div>


        <div class="product-card" data-category="Protection" data-name="paint protection film">
            <div class="product-image">
                <img src="https://lirp.cdn-website.com/19820020/dms3rep/multi/opt/paint+protection+film-4843b5b1-1920w.jpg" alt="Paint Protection Film" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Protection</span>
                <h3 class="product-name">Paint Protection Film</h3>
                <p class="product-description">Film pelindung cat transparan dengan teknologi self-healing. Melindungi cat mobil dari goresan, batu kerikil, dan kerusakan akibat cuaca.</p>
                <ul class="product-features">
                    <li>Teknologi self-healing</li>
                    <li>UV protection 99%</li>
                    <li>Transparansi tinggi</li>
                    <li>Garansi 10 tahun</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 8.500.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(5.0)</span>
                    </div>
                </div>
                <button onclick="showDetail('Paint Protection Film')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Protection" data-name="Ceramic Coating">
    <div class="product-image">
        <img src="https://m.media-amazon.com/images/I/71OfO20OlBL.jpg" alt="Ceramic Coating" class="product-img">
    </div>
    <div class="product-info">
        <span class="product-category">Protection</span>
        <h3 class="product-name">Ceramic Coating</h3>
        <p class="product-description">Pelapis keramik premium yang memberikan perlindungan maksimal pada cat mobil, menjaga keindahan dan kilau kendaraan lebih lama, serta melindungi dari kotoran dan air.</p>
        <ul class="product-features">
            <li>Pelindung tahan lama</li>
            <li>Melindungi dari goresan ringan</li>
            <li>Perlindungan UV dan tahan air</li>
            <li>Garansi 5 tahun</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 6.750.000</div>
            <div class="product-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">(4.9)</span>
            </div>
        </div>
        <button onclick="showDetail('Ceramic Coating')" class="detail-btn">Lihat Detail</button>
    </div>
</div>


        <div class="product-card" data-category="Wheels" data-name="performance tires">
            <div class="product-image">
                <img src="https://tirecraft.com/owen-sound-tirecraft/wp-content/uploads/sites/116/2018/01/Toyo-High-Performance-Tire.jpg" alt="Performance Tires" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Wheels</span>
                <h3 class="product-name">Performance Tires</h3>
                <p class="product-description">Ban performa tinggi yang dirancang untuk memberikan traksi luar biasa pada jalan basah maupun kering. Ideal untuk pengemudi yang mengutamakan keamanan dan performa.</p>
                <ul class="product-features">
                    <li>Grip luar biasa pada berbagai kondisi jalan</li>
                    <li>Desain untuk kecepatan tinggi</li>
                    <li>Struktur anti-aquaplaning</li>
                    <li>Umur pakai panjang</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 4.000.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.9)</span>
                    </div>
                </div>
                <button onclick="showDetail('Performance Tires')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Wheels" data-name="Alloy Wheels 18 Inch">
    <div class="product-image">
        <img src="https://image.made-in-china.com/2f0j00OcVWYUHLgARD/Factory-18-Inch-5X114-3-Alloy-Car-Wheels-Rims-for-Toyota-Camry.jpg" alt="Alloy Wheels 18 Inch" class="product-img">
    </div>
    <div class="product-info">
        <span class="product-category">Wheels</span>
        <h3 class="product-name">Alloy Wheels 18 Inch</h3>
        <p class="product-description">Velg alloy 18 inci yang stylish dan ringan. Memberikan tampilan elegan sekaligus meningkatkan performa handling kendaraan Anda.</p>
        <ul class="product-features">
            <li>Material forged alloy</li>
            <li>Desain 5-spoke modern</li>
            <li>Berat ringan, meningkatkan performa</li>
            <li>Universal fitment</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 6.750.000</div>
            <div class="product-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">(5.0)</span>
            </div>
        </div>
        <button onclick="showDetail('Alloy Wheels 18 Inch')" class="detail-btn">Lihat Detail</button>
    </div>
</div>


        <div class="product-card" data-category="Exterior" data-name="carbon fiber spoiler">
            <div class="product-image">
                <img src="https://static.summitracing.com/global/images/prod/xlarge/ngi-carb-a690_xl.jpg" alt="Carbon Fiber Spoiler" class="product-img">
            </div>
            <div class="product-info">
                <span class="product-category">Exterior</span>
                <h3 class="product-name">Carbon Fiber Spoiler</h3>
                <p class="product-description">Spoiler carbon fiber asli dengan desain aerodinamis. Meningkatkan downforce dan memberikan tampilan sporty yang aggressive pada kendaraan Anda.</p>
                <ul class="product-features">
                    <li>100% real carbon fiber</li>
                    <li>Desain aerodinamis</li>
                    <li>UV resistant coating</li>
                    <li>Universal fitment</li>
                </ul>
                <div class="product-footer">
                    <div class="product-price">Rp 4.750.000</div>
                    <div class="product-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-text">(4.5)</span>
                    </div>
                </div>
                <button onclick="showDetail('Carbon Fiber Spoiler')" class="detail-btn">Lihat Detail</button>
            </div>
        </div>

        <div class="product-card" data-category="Exterior" data-name="LED Tail Light Kit">
    <div class="product-image">
        <img src="https://m.media-amazon.com/images/I/71TnNVQvWzS._AC_SL1500_.jpg" alt="LED Tail Light Kit" class="product-img">
    </div>
    <div class="product-info">
        <span class="product-category">Exterior</span>
        <h3 class="product-name">LED Tail Light Kit</h3>
        <p class="product-description">Lampu belakang LED dengan desain modern, memberikan pencahayaan lebih terang dan tampilan lebih stylish untuk mobil Anda.</p>
        <ul class="product-features">
            <li>Pencahayaan LED terang dan efisien</li>
            <li>Desain tipis dan elegan</li>
            <li>Waterproof dan tahan lama</li>
            <li>Universal fitment untuk banyak model mobil</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 2.350.000</div>
            <div class="product-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">(4.8)</span>
            </div>
        </div>
        <button onclick="showDetail('LED Tail Light Kit')" class="detail-btn">Lihat Detail</button>
    </div>
</div>

        <div class="product-card" data-category="Safety" data-name="car security alarm system">
    <div class="product-image">
        <img src="https://cache3.pakwheels.com/ad_pictures/1134/liuhawk-car-security-alarm-system-with-immobilizer-key-113449171.webp" alt="Car Security Alarm System" class="product-img">
    </div>
    <div class="product-info">
        <span class="product-category">Safety</span>
        <h3 class="product-name">Car Security Alarm System</h3>
        <p class="product-description">Sistem alarm keamanan mobil dengan sensor gerak dan deteksi pintu yang canggih, menjaga mobil Anda tetap aman dari pencurian dan kerusakan.</p>
        <ul class="product-features">
            <li>Sensor gerak dengan teknologi terbaru</li>
            <li>Pendeteksi pintu otomatis</li>
            <li>Remote control dengan jarak jauh</li>
            <li>Fitur pelaporan via smartphone</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 1.800.000</div>
            <div class="product-rating">
                <span class="stars">★★★★☆</span>
                <span class="rating-text">(4.6)</span>
            </div>
        </div>
        <button onclick="showDetail('Car Security Alarm System')" class="detail-btn">Lihat Detail</button>
    </div>
</div>

<div class="product-card" data-category="Safety" data-name="dash camera">
    <div class="product-image">
        <img src="https://m.media-amazon.com/images/I/71dk7bMLtEL.jpg" alt="Dash Camera" class="product-img">
    </div>
    <div class="product-info">
        <span class="product-category">Safety</span>
        <h3 class="product-name">Dash Camera (Car DVR)</h3>
        <p class="product-description">Kamera dashboard mobil dengan kualitas rekaman HD, membantu Anda merekam perjalanan dan memberikan bukti rekaman dalam keadaan darurat atau insiden.</p>
        <ul class="product-features">
            <li>Resolusi HD 1080p</li>
            <li>Fitur night vision untuk rekaman di malam hari</li>
            <li>Perekaman otomatis saat kendaraan menyala</li>
            <li>Sudut pandang 170 derajat</li>
        </ul>
        <div class="product-footer">
            <div class="product-price">Rp 1.950.000</div>
            <div class="product-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">(5.0)</span>
            </div>
        </div>
        <button onclick="showDetail('Dash Camera (Car DVR)')" class="detail-btn">Lihat Detail</button>
    </div>
</div>



    <script>
        let allProducts = [];
        let filteredProducts = [];

        function initializeProducts() {
            const productCards = document.querySelectorAll('.product-card');
            allProducts = Array.from(productCards).map(card => ({
                element: card,
                name: card.getAttribute('data-name').toLowerCase(),
                category: card.getAttribute('data-category'),
                productName: card.querySelector('.product-name').textContent,
                description: card.querySelector('.product-description').textContent.toLowerCase()
            }));
            filteredProducts = [...allProducts];
        }

        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const categoryFilter = document.getElementById('categoryFilter').value;

            filterAndDisplay(searchTerm, categoryFilter);
        }

        function filterByCategory() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const categoryFilter = document.getElementById('categoryFilter').value;

            filterAndDisplay(searchTerm, categoryFilter);
        }

        function filterAndDisplay(searchTerm, categoryFilter) {
            filteredProducts = allProducts.filter(product => {
                const matchesSearch = !searchTerm ||
                    product.name.includes(searchTerm) ||
                    product.description.includes(searchTerm) ||
                    product.productName.toLowerCase().includes(searchTerm);

                const matchesCategory = !categoryFilter || product.category === categoryFilter;

                return matchesSearch && matchesCategory;
            });

            displayProducts();
        }

        function displayProducts() {
            const catalogContainer = document.getElementById('catalogContainer');
            const noResults = document.getElementById('noResults');

            allProducts.forEach(product => {
                product.element.classList.add('hidden');
                product.element.style.display = '';
                product.element.style.opacity = '';
                product.element.style.transform = '';
                product.element.style.transition = '';
            });

            if (filteredProducts.length === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');

                filteredProducts.forEach((product, index) => {
                    setTimeout(() => {
                        product.element.classList.remove('hidden');
                        product.element.style.opacity = '0';
                        product.element.style.transform = 'translateY(20px)';

                        setTimeout(() => {
                            product.element.style.transition = 'all 0.3s ease';
                            product.element.style.opacity = '1';
                            product.element.style.transform = 'translateY(0)';
                        }, 10);
                    }, index * 50);
                });
            }
        }

        function showDetail(productName) {
            alert(`Detail produk: ${productName}\n\nFitur ini akan menampilkan informasi lengkap tentang produk, termasuk spesifikasi detail, gambar tambahan, dan opsi pembelian.`);
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeProducts();

            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const categoryFilter = document.getElementById('categoryFilter').value;

                if (searchTerm.length >= 2 || searchTerm.length === 0) {
                    filterAndDisplay(searchTerm, categoryFilter);
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchProducts();
                }
            });
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        const originalFilterByCategory = filterByCategory;
        filterByCategory = function() {
            originalFilterByCategory();
            if (window.scrollY > 100) {
                setTimeout(scrollToTop, 100);
            }
        };
    </script>
</body>
</html>
