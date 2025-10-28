<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Katalog Aksesoris HP</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-aksesoris-hp/styles.css') }}" />
    <!-- Menghubungkan ke Tailwind CSS CDN untuk gaya modern -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">
    <script src="{{ asset('assets/demo/toko-aksesoris-hp/script.js') }}"></script>
    <!-- Konten HTML -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <!-- Logo Toko -->
                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/LOGO.png') }}" alt="Logo Toko"
                    class="rounded-full w-16 h-16">
                <h1 class="text-2xl font-bold text-teal-600">Katalog Aksesoris HP</h1>
            </div>

            <!-- Header right area (kept minimal) -->
            <div class="w-full md:w-auto">
                <div class="flex items-center space-x-4 justify-end">
                    <!-- placeholder: search moved below next to price controls -->
                </div>
            </div>
        </div>
    </header>

 <section class="relative text-white text-center overflow-hidden w-full"
    style="aspect-ratio: 16 / 9; max-width: 1920px; margin: 0 auto;">

    <!-- Wrapper Slider -->
    <div id="hero-slider" class="absolute inset-0">

        <!-- SLIDE 1 -->
        <div class="slide absolute inset-0 opacity-100 transition-opacity duration-1000">
            <div class="relative w-full h-full">
                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Bag.webp') }}" alt="Background 1"
                    class="absolute inset-0 w-full h-full object-cover object-center transform scale-105 transition-transform duration-[7000ms] hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-b from-teal-900/70 to-teal-800/50"></div>
                <div
                    class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 md:mb-6 leading-tight animate-fade-in">
                        Temukan Aksesoris <br><span class="text-teal-300">Handphone Impianmu</span>
                    </h1>
                    <p
                        class="text-base sm:text-lg md:text-xl lg:text-2xl font-light mb-6 md:mb-8 max-w-2xl animate-fade-in-delay">
                        Koleksi lengkap case, charger, dan aksesori premium untuk semua tipe HP
                    </p>
                    <a href="#productsGrid"
                        class="bg-teal-500 hover:bg-teal-600 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full text-base sm:text-lg font-medium transition-all duration-300 transform hover:scale-105 animate-bounce-subtle">
                        Lihat Koleksi
                    </a>
                </div>
            </div>
        </div>

        <!-- SLIDE 2 -->
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000">
            <div class="relative w-full h-full">
                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Bag2.jpg') }}" alt="Background 2"
                    class="absolute inset-0 w-full h-full object-cover object-center transform scale-105 transition-transform duration-[7000ms] hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-b from-teal-900/70 to-teal-800/50"></div>
                <div
                    class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 md:mb-6 leading-tight animate-fade-in">
                        Promo Spesial & Diskon<br><span class="text-teal-300">Minggu Ini</span>
                    </h1>
                    <p
                        class="text-base sm:text-lg md:text-xl lg:text-2xl font-light mb-6 md:mb-8 max-w-2xl animate-fade-in-delay">
                        Dapatkan penawaran terbaik untuk produk pilihan kami
                    </p>
                    <a href="#productsGrid"
                        class="bg-teal-500 hover:bg-teal-600 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full text-base sm:text-lg font-medium transition-all duration-300 transform hover:scale-105 animate-bounce-subtle">
                        Lihat Promo
                    </a>
                </div>
            </div>
        </div>

        <!-- SLIDE 3 -->
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000">
            <div class="relative w-full h-full">
                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Bag3.jpg') }}" alt="Background 3"
                    class="absolute inset-0 w-full h-full object-cover object-center transform scale-105 transition-transform duration-[7000ms] hover:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-b from-teal-900/70 to-teal-800/50"></div>
                <div
                    class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 md:mb-6 leading-tight animate-fade-in">
                        Kualitas Premium<br><span class="text-teal-300">Garansi Resmi</span>
                    </h1>
                    <p
                        class="text-base sm:text-lg md:text-xl lg:text-2xl font-light mb-6 md:mb-8 max-w-2xl animate-fade-in-delay">
                        Semua produk terjamin kualitasnya dan dilengkapi garansi resmi
                    </p>
                    <a href="#productsGrid"
                        class="bg-teal-500 hover:bg-teal-600 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-full text-base sm:text-lg font-medium transition-all duration-300 transform hover:scale-105 animate-bounce-subtle">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dot Indicators -->
    <div id="hero-dots" class="absolute left-0 right-0 bottom-4 sm:bottom-6 md:bottom-8 z-20 flex justify-center">
        <div class="flex justify-center space-x-3 sm:space-x-4">
            <button
                class="dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white opacity-50 transition-all duration-300 hover:opacity-100"></button>
            <button
                class="dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white opacity-50 transition-all duration-300 hover:opacity-100"></button>
            <button
                class="dot w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-white opacity-50 transition-all duration-300 hover:opacity-100"></button>
        </div>
    </div>
</section>

<style>
/* Animasi fade dan bounce */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1.5s ease-out;
}

@keyframes bounceSubtle {
    0%, 100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-5px);
    }
}

.animate-bounce-subtle {
    animation: bounceSubtle 3s infinite;
}

/* Responsif tinggi minimum untuk layar kecil */
@media (max-width: 640px) {
    section[style*="aspect-ratio"] {
        aspect-ratio: auto;
        height: 80vh;
    }
}
</style>

<script>
// Auto Slide
const slides = document.querySelectorAll('#hero-slider .slide');
const dots = document.querySelectorAll('#hero-dots .dot');
let currentSlide = 0;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.opacity = i === index ? '1' : '0';
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('opacity-100', i === index);
        dot.classList.toggle('opacity-50', i !== index);
    });
}

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentSlide = index;
        showSlide(currentSlide);
    });
});

setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}, 5000);
</script>


    <div class="my-8">
    <!-- Judul Kategori -->
    <h2 class="text-xl md:text-2xl font-bold text-center mb-2 text-teal-700">Kategori</h2>

    <!-- Tombol filter kategori -->
    <div class="flex flex-wrap gap-2 md:gap-4 justify-center">
            <button
                class="category-btn active px-6 py-2 rounded-full border border-gray-300 text-sm font-medium transition-colors"
                onclick="filterProducts('all', event)">Semua</button>
            <button
                class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-gray-200"
                onclick="filterProducts('case', event)">Case</button>
            <button
                class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-gray-200"
                onclick="filterProducts('charger', event)">Charger</button>
            <button
                class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-gray-200"
                onclick="filterProducts('audio', event)">Audio</button>
            <button
                class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-gray-200"
                onclick="filterProducts('kamera', event)">Kamera & Pencahayaan</button>
            <button
                class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-gray-200"
                onclick="filterProducts('powerbank', event)">Powerbank</button>
            <button
                class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-gray-200"
                onclick="filterProducts('accessory', event)">Lainnya</button>
        </div>


    <!-- Judul Sub Kategori -->

    <h2 class="text-lg md:text-2xl font-bold text-center mt-6 mb-2 text-teal-600">Sub Kategori</h2>
    <!-- Button Subkategori Case & Charger -->
        <div id="subCategoryCaseWrapper" class="mt-4 hidden">
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('case', ['Case Transparan Clear','Case Transparan untuk iPhone 13','Case Transparan untuk Android'])">Case Transparan Clear</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('case', ['Casing Couple','Case Couple Kartun Motor','Case Love Couple'])">Casing Couple</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('case', 'Casing HP Panda Lucu & Unik')">Casing HP Panda Lucu & Unik</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('case', 'Case Silikon Premium')">Case Silikon Premium</button>
            </div>
        </div>

        <div id="subCategoryChargerWrapper" class="mt-4 hidden">
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('charger', ['Fast Charger 65W','Charger 65W QC 3.0'])">Fast Charger 65W</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('charger', ['Kabel Data Lucu Karakter','Kabel Charger Karakter Dinosaurus'])">Kabel Data Lucu Karakter</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('charger', ['Wireless Charger Stand','Wireless Charger Stand putih'])">Wireless Charger Stand</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('charger', 'Charger USB-C 20W')">Charger USB-C 20W</button>
            </div>
        </div>

        <div id="subCategoryKameraWrapper" class="mt-4 hidden">
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('kamera', ['Ring Light LED 26cm Tripod Stand',' Dual Ring Light with Tripod Stand'])">Ring Light LED Tripod Stand</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('kamera', ['Lampu Selfie Clip-On LED Rokeet','Lighting HP Mini'])">Lampu Selfie Clip-On LED</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('kamera', 'Lensa Makro & Wide Clip-On 3-in-1')">Lensa Makro & Wide Clip-On 3in1</button>
            </div>
        </div>

        <div id="subCategoryAudioWrapper" class="mt-4 hidden">
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('audio', ['Earphone Kabel In-Ear','Earphone GROTIC Type-C','KBEAR Flash Type-C',])">Earphone Kabel In-Ear</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('audio', ['TWS Earbuds Pro','Nothing CMF Buds Pro TWS','Samsung Galaxy Buds Pro'])">TWS Earbuds Pro</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('audio', 'Headphone Bluetooth KVIDIO')">Headphone Bluetooth</button>
            </div>
        </div>

        <div id="subCategoryPowerbankWrapper" class="mt-4 hidden">
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('powerbank', ['Power Bank 20000mAh','Power Bank 20000mAh 130W','Anker Zolo Power Bank 30W'])">EPower Bank 20000mAh</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('powerbank', ['Power Bank Wireless','Powerbank Wireless JETE A11 10000 mAh'])">Power Bank Wireless</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('powerbank', 'Power Bank Vivan Wireless')">Power Bank Vivan Wireless</button>
                <button class="subcat-btn px-4 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium transition-colors hover:bg-teal-100" onclick="filterSubCategory('powerbank', 'Mini Power Bank LED Display')">Mini Power Bank LED</button>
            </div>
        </div>

        <script>
        // Tampilkan subkategori jika kategori Case atau Charger dipilih
        var caseBtn = document.querySelector('button[onclick*="filterProducts(\'case\'"]');
        var chargerBtn = document.querySelector('button[onclick*="filterProducts(\'charger\'"]');

        function handleCategorySubcat() {
            setTimeout(function() {
                var activeCat = document.querySelector('.category-btn.active');
                var subCatCase = document.getElementById('subCategoryCaseWrapper');
                var subCatCharger = document.getElementById('subCategoryChargerWrapper');
                var subCatKamera = document.getElementById('subCategoryKameraWrapper');
                var subCatAudio = document.getElementById('subCategoryAudioWrapper');
                var subCatPowerbank = document.getElementById('subCategoryPowerbankWrapper');

                if (activeCat) {
                    var text = activeCat.textContent.trim();
                    if (text === 'Case') {
                        subCatCase.classList.remove('hidden');
                        subCatCharger.classList.add('hidden');
                        subCatKamera.classList.add('hidden');
                        subCatCase.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else if (text === 'Charger') {
                        subCatCharger.classList.remove('hidden');
                        subCatCase.classList.add('hidden');
                        subCatKamera.classList.add('hidden');
                        subCatCharger.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else if (text === 'Kamera & Pencahayaan') {
                        subCatKamera.classList.remove('hidden');
                        subCatCase.classList.add('hidden');
                        subCatCharger.classList.add('hidden');
                        subCatAudio.classList.add('hidden');
                        subCatKamera.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else if (text === 'Audio') {
                        subCatAudio.classList.remove('hidden');
                        subCatCase.classList.add('hidden');
                        subCatCharger.classList.add('hidden');
                        subCatKamera.classList.add('hidden');
                        subCatPowerbank.classList.add('hidden');
                        subCatAudio.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else if (text === 'Powerbank') {
                        subCatPowerbank.classList.remove('hidden');
                        subCatAudio.classList.add('hidden');
                        subCatCase.classList.add('hidden');
                        subCatCharger.classList.add('hidden');
                        subCatKamera.classList.add('hidden');
                        subCatPowerbank.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        subCatCase.classList.add('hidden');
                        subCatCharger.classList.add('hidden');
                        subCatKamera.classList.add('hidden');
                        subCatAudio.classList.add('hidden');
                        subCatPowerbank.classList.add('hidden');
                    }
                }
            }, 100);
        }

    var audioBtn = document.querySelector('button[onclick*="filterProducts(\'audio\'"]');
    var powerbankBtn = document.querySelector('button[onclick*="filterProducts(\'powerbank\'"]');
    if (caseBtn) caseBtn.addEventListener('click', handleCategorySubcat);
    if (chargerBtn) chargerBtn.addEventListener('click', handleCategorySubcat);
    if (audioBtn) audioBtn.addEventListener('click', handleCategorySubcat);
    if (powerbankBtn) powerbankBtn.addEventListener('click', handleCategorySubcat);

        // Sembunyikan subkategori jika kategori lain dipilih
        document.querySelectorAll('.category-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // allow handler to show the right one
                setTimeout(handleCategorySubcat, 120);
            });
        });
        </script>



    </div>
    <div class="mt-6 mb-4">
        <!-- Row 1: centered sort and price controls -->
        <div class="flex justify-center space-x-3 mb-3">
            <select id="sortDropdown" class="border border-teal-400 rounded-full px-4 py-2 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-teal-500" onchange="sortProducts(this.value)">
                <option value="lama">Barang Baru</option>
                <option value="baru">Barang Lama</option>
            </select>

            <select id="priceDropdown" class="border border-teal-400 rounded-full px-4 py-2 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-teal-500" onchange="filterByPrice(this.value)">
                <option value="all">Semua Harga</option>
                <option value="0-50000">Rp 0 - Rp 50.000</option>
                <option value="50001-100000">Rp 50.001 - Rp 100.000</option>
                <option value="100001-200000">Rp 100.001 - Rp 200.000</option>
                <option value="200001-9999999">Rp 200.001+</option>
            </select>
        </div>

        <!-- Row 2: centered search below the controls -->
        <div class="flex justify-center">
            <div class="w-full sm:w-96">
                <div class="relative flex items-center border border-gray-300 rounded-full overflow-hidden">
                    <input type="text" id="searchInput" placeholder="Cari produk..." class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500" />
                    <button id="searchBtn" onclick="searchProducts()" class="bg-teal-500 text-white px-4 py-2 hover:bg-teal-600 transition-all duration-300">Cari</button>
                </div>
            </div>
        </div>
    </div>
    <section class="products-section pb-16">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-center mb-8">Produk Unggulan</h2>
            <div class="products-grid grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"
                id="productsGrid">

                <!-- Pagination controls will be injected here -->
                <div id="paginationControls" class="col-span-full"></div>


                <!-- Produk Case -->
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="case" data-name="Case Silikon Premium">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/CaseHpp.jpg') }}"
                            alt="Case Silikon Premium" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
                            Case Silikon Premium
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 85.000</span><br>
                            <span class="text-gray-400 line-through text-sm">Rp 120.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Case Silikon Premium"
                            data-modal-content='
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/CaseHpp.jpg') }}" alt="Case Silikon Premium" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                            </div>
                            <p class="text-gray-700 mb-2">Case silikon berkualitas tinggi yang dirancang untuk memberikan perlindungan maksimal pada smartphone Anda.</p>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                <li>Material silikon premium</li>
                                <li>Anti-slip dan anti-fingerprint</li>
                                <li>Perlindungan terhadap benturan hingga 2 meter</li>
                                <li>Tersedia dalam berbagai pilihan warna</li>
                            </ul>
                            <div class="text-center">
                                <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded-full mb-2">Promo</span>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-teal-500 font-bold text-xl">Rp 85.000</span><br>
                                <span class="text-gray-400 line-through mr-2">Rp 120.000</span>
                            </div>
                            <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo%20saya%20tertarik%20dengan%20produk%20Case%20Silikon%20Premium" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                        '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="case" data-name="Casing HP Panda Lucu & Unik">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Panda.webp') }}"
                            alt="Casing HP Panda Lucu & Unik" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Casing HP Panda Lucu
                            & Unik</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 85.000</span><br>
                            <span class="text-gray-400 line-through text-sm">Rp 110.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Casing HP Panda Lucu & Unik"
                            data-modal-content='
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Panda.webp') }}" alt="Casing HP Panda Lucu & Unik" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                            </div>
                            <p class="text-gray-700 mb-2">Casing HP berbulu dengan desain panda imut, cocok untuk kamu yang ingin tampil beda dan gemas!</p>
                            <div class="text-yellow-600 text-sm mb-2 text-center">⭐⭐⭐⭐⭐ (128 review)</div>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                <li>Desain panda 3D imut</li>
                                <li>Bahan lembut dan nyaman digenggam</li>
                                <li>Melindungi dari goresan dan benturan</li>
                                <li>Cocok untuk berbagai tipe HP</li>
                            </ul>
                            <div class="text-center">
                                <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded-full mb-2">Promo</span>
                            </div>
                            <div class="text-center mt-2">
                                <span class="text-teal-500 font-bold text-xl">Rp 85.000</span><br>
                                <span class="text-gray-400 line-through mr-2">Rp 110.000</span>
                            </div>
                            <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo%20saya%20tertarik%20dengan%20produk%20Casing%20HP%20Panda%20Lucu%20dan%20Unik" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="case" data-name="Casing Couple Kupu-Kupu Tecno Pova 6 5G">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Couple.jpg') }}"
                            alt="Casing Couple Kupu-Kupu Tecno Pova 6 5G" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Casing Couple</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 99.000</span><br>
                            <span class="text-gray-400 line-through text-sm">Rp 130.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Casing Couple"
                            data-modal-content='
                                <div class="text-center mb-4">
                                    <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Couple.jpg') }}" alt="Casing Couple" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                                </div>
                                <p class="text-gray-700 mb-2">Cocok untuk pasangan stylish yang ingin tampil serasi dengan casing kupu-kupu dan love.</p>
                                <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                    <li>Motif kupu-kupu & love transparan</li>
                                    <li>Bahan silikon lentur dan ringan</li>
                                    <li>Kompatibel dengan Tecno Pova 6 5G</li>
                                    <li>Desain couple romantis dan modern</li>
                                </ul>
                                <div class="text-center">
                                    <span class="inline-block bg-red-500 text-white text-xs px-2 py-1 rounded-full mb-2">Promo</span>
                                </div>
                                <div class="text-center mt-2">
                                    <span class="text-teal-500 font-bold text-xl">Rp 99.000</span><br>
                                    <span class="text-gray-400 line-through mr-2">Rp 130.000</span>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="https://wa.me/6282392184679?text=Halo%20saya%20tertarik%20dengan%20produk%20Casing%20Couple" target="_blank"
                                        class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                                </div>
                        '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="case" data-name="Case Couple Kartun Motor" id="caseCoupleMotor">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/casmotoran.png') }}"
            alt="Case Couple Kartun Motor" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Case Couple Kartun Motor</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 85.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Case Couple Kartun Motor"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/casmotoran.png') }}" alt="Case Couple Kartun Motor" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Case couple lucu dengan desain kartun cewek naik motor, cocok buat pasangan yang suka tampil kompak dan estetik.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Motif kartun eksklusif, tahan lama tidak mudah pudar</li>
            <li>Material silikon premium lembut dan anti bentur</li>
            <li>Desain tebal dan bertekstur, nyaman digenggam</li>
            <li>Tersedia untuk berbagai tipe HP (iPhone & Android)</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 85.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Case Couple Kartun Motor" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>
<div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="case" data-name="Case Love Couple" id="caseLoveCouple">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/love.png') }}"
            alt="Case Love Couple" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Case Love Couple</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 90.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Case Love Couple"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/love.png') }}" alt="Case Love Couple" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Case bertema love couple yang romantis dan lucu, cocok buat pasangan biar kelihatan kompak dan estetik.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Motif cinta couple eksklusif</li>
            <li>Bahan silikon premium lembut dan anti jatuh</li>
            <li>Desain tebal, tahan gores dan nyaman digenggam</li>
            <li>Tersedia untuk iPhone dan Android</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 90.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Case Love Couple" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>



                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="case" data-name="Case Transparan Clear" id="caseTransparanClear">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/CaseTransparan.webp') }}"
                            alt="Case Transparan Clear" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Case Transparan
                            Clear</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 65.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Case Transparan Clear"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/CaseTransparan.webp') }}" alt="Case Transparan Clear" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Case transparan yang mempertahankan desain original HP.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Material PC transparan</li>
                            <li>Anti-yellowing technology</li>
                            <li>Ultra-thin 1.2mm</li>
                            <li>Precise cutouts</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 65.000</div>
                        <div class="text-center mt-3">
                            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Case Transparan Clear " target="_blank"
                                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                        </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="case" data-name="Case Transparan untuk iPhone 13" id="caseTransparanIphone13">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/transparan 13.jpg') }}"
            alt="Case Transparan untuk iPhone 13" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Case Transparan untuk iPhone 13</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 75.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Case Transparan untuk iPhone 13"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/transparan 13.jpg') }}" alt="Case Transparan untuk iPhone 13" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Case transparan premium yang dirancang khusus untuk iPhone 13, menjaga tampilan elegan tanpa mengurangi perlindungan.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Material PC transparan berkualitas tinggi</li>
            <li>Anti-yellowing technology</li>
            <li>Desain ultra tipis 1.2mm</li>
            <li>Presisi untuk semua port dan tombol iPhone 13</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 75.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Case Transparan untuk iPhone 13" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>
<div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="case" data-name="Case Transparan untuk Android" id="caseTransparanAndroid">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/clear aandroid.png') }}"
            alt="Case Transparan untuk Android" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Case Transparan untuk Android</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 70.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Case Transparan untuk Android"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/clear aandroid.png') }}" alt="Case Transparan untuk Android" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Case transparan serbaguna yang cocok untuk berbagai tipe Android, menjaga tampilan tetap elegan dan terlindungi.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Material PC transparan tahan benturan</li>
            <li>Anti-yellowing dan anti gores</li>
            <li>Desain tipis dan ringan</li>
            <li>Kompatibel dengan berbagai tipe Android</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 70.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Case Transparan untuk Android" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>



                <!-- Produk Charger -->
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="charger" data-name="Fast Charger 65W">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Casrger.jpg') }}"
                            alt="Fast Charger 65W" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Fast Charger 65W
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 275.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Fast Charger 65W"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Casrger.jpg') }}" alt="Fast Charger 65W" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Charger cepat dengan teknologi GaN untuk pengisian efisien.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Fast charging 65W PD</li>
                            <li>Teknologi GaN terbaru</li>
                            <li>Multi-device charging</li>
                            <li>Proteksi keamanan lengkap</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 275.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo Saya tertarik dengan Fast Charger 65W" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="charger" data-name="Charger 65W QC 3.0" id="charger65WQC3">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/65watkuning.png') }}"
            alt="Charger 65W QC 3.0" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Charger 65W QC 3.0</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 120.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Charger 65W QC 3.0"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/65watkuning.png') }}" alt="Charger 65W QC 3.0" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Charger cepat dengan output daya hingga 65W, mendukung teknologi QC 3.0 dan PD 3.0, cocok untuk berbagai perangkat seperti smartphone, tablet, dan laptop.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Daya output hingga 65W</li>
            <li>Mendukung Quick Charge 3.0 dan Power Delivery 3.0</li>
            <li>Port USB-C dan USB-A ganda</li>
            <li>Desain compact dan ringan, mudah dibawa</li>
            <li>Cocok untuk Android, iPhone, laptop, dan tablet</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 120.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Charger 65W QC 3.0" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>


                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="charger" data-name="Kabel Data Lucu Karakter">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/hiasan.jpg') }}"
                            alt="Kabel Data Lucu Karakter" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Kabel Data Lucu
                            Karakter</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 45.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Kabel Data Lucu Karakter"
                            data-modal-content='
                                <div class="text-center mb-4">
                                    <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/hiasan.jpg') }}" alt="Kabel Data Lucu Karakter" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                                </div>
                                <p class="text-gray-700 mb-2"> Kabel data dengan pelindung spiral dan hiasan karakter lucu yang cocok untuk berbagai jenis smartphone.</p>
                                <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                    <li>Desain karakter lucu seperti Hello Kitty, Panda, Bunny, dan lainnya</li>
                                    <li>Pelindung kabel spiral untuk mencegah kerusakan</li>
                                    <li>Kabel berkualitas dengan daya tahan tinggi</li>
                                    <li>Cocok untuk berbagai perangkat (Lightning, USB-C, dll)</li>
                                </ul>
                                <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 45.000</div>
                                <div class="text-center mt-3">
                                    <a href="https://wa.me/6282392184679?text=Halo, saya tertarik dengan Kabel Data Lucu Karakter" target="_blank"
                                        class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                                </div>
                            '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="charger" data-name="Kabel Charger Karakter Dinosaurus" id="kabelDinoLucu">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/kaabeldatabon.png') }}"
            alt="Kabel Charger Karakter Dinosaurus" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Kabel Charger Karakter Dinosaurus</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 45.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Kabel Charger Karakter Dinosaurus"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/kaabeldatabon.png') }}" alt="Kabel Charger Karakter Dinosaurus" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Kabel charger lucu dengan pelindung kepala dinosaurus, menjaga kabel tetap awet sekaligus tampil menggemaskan. Cocok untuk pengguna Android maupun iPhone.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Desain karakter dinosaurus unik dan lucu</li>
            <li>Dilengkapi pelindung kabel anti tekuk</li>
            <li>Material berkualitas tinggi, fleksibel dan tahan lama</li>
            <li>Tersedia berbagai warna (acak)</li>
            <li>Kompatibel untuk Android & iPhone</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 45.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Kabel Charger Karakter Dinosaurus" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>


                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="charger" data-name="Wireless Charger Stand">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/casewairles.webp') }}"
                            alt="Wireless Charger Stand" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Wireless Charger
                            Stand</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 180.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Wireless Charger Stand"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/casewairles.webp') }}" alt="Wireless Charger Stand" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Charging stand nirkabel dengan LED indicator untuk kenyamanan dan efisiensi.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Wireless charging 15W</li>
                            <li>Adjustable viewing angle</li>
                            <li>LED status indicator</li>
                            <li>Compatible dengan perangkat Qi</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 189.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Wireless Charger Stand" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="charger" data-name="Wireless Charger Stand" id="wirelessChargerStand">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/cargerdiri.png') }}"
            alt="Wireless Charger Stand" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Wireless Charger Stand putih</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 225.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Wireless Charger Stand"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/cargerdiri.png') }}" alt="Wireless Charger Stand" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Wireless charger multifungsi dengan desain modern. Dapat digunakan untuk mengisi daya smartphone, smartwatch, dan earphone secara bersamaan. Mendukung fast charging dan tampilan elegan.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Mendukung pengisian daya nirkabel hingga 15W</li>
            <li>Kompatibel untuk iPhone, Samsung, dan perangkat Qi</li>
            <li>Dilengkapi slot khusus untuk smartwatch & TWS</li>
            <li>Desain lipat, mudah dibawa & hemat ruang</li>
            <li>Material premium dengan warna silver elegan</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 225.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Wireless Charger Stand" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>


                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="charger" data-name="Charger USB-C 20W">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/typec.jpg') }}" alt="Charger USB-C"
                            class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Charger USB-C 20W
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 135.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Charger USB-C 20W"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/typec.jpg') }}" alt="Charger USB-C 20W" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Charger USB-C 20W adalah pengisi daya dinding yang mendukung pengisian cepat untuk perangkat iPhone dan Android, ideal untuk pengguna modern.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Daya 20W dengan teknologi Fast Charging</li>
                            <li>Dukungan untuk perangkat iPhone & Android</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 135.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Charger USB-C 20W" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>

                <!-- Produk Audio -->
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="audio" data-name="Earphone Kabel In-Ear">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Headsed.webp') }}"
                            alt="Earphone Kabel In-Ear" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Earphone Kabel
                            In-Ear</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 55.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Earphone Kabel In-Ear"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Headsed.webp') }}" alt="Earphone Kabel In-Ear" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Earphone berkabel dengan kualitas suara jernih dan bass mendalam. Desain ergonomis untuk kenyamanan pemakaian sehari-hari.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Suara stereo berkualitas tinggi</li>
                            <li>Desain in-ear yang nyaman dan pas</li>
                            <li>Kabel anti kusut & tahan lama</li>
                            <li>Kompatibel dengan berbagai perangkat audio 3.5mm</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 55.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text="Halo Saya tertarik dengan Earphone Kabel In-Ear" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="audio" data-name="Earphone GROTIC Type-C" id="earphoneGrotic">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/groticputih.png') }}"
            alt="Earphone GROTIC Type-C" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Earphone GROTIC Type-C</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 89.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Earphone GROTIC Type-C"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/groticputih.png') }}" alt="Earphone GROTIC Type-C" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Earphone berkualitas tinggi dengan konektor Type-C, dirancang untuk menghasilkan suara jernih dan bass yang kuat. Dilengkapi dengan mikrofon dan tombol kontrol volume.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Konektor Type-C, kompatibel dengan berbagai smartphone Android</li>
            <li>Desain ergonomis, nyaman digunakan lama</li>
            <li>Dilengkapi tombol volume dan mikrofon</li>
            <li>Suara jernih dengan bass mendalam</li>
            <li>Kabel anti kusut dan kuat</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 89.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Earphone GROTIC Type-C" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>
<div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="audio" data-name="KBEAR Flash Type-C" id="kbearFlash">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/flash.png') }}"
            alt="KBEAR Flash Type-C" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">KBEAR Flash Type-C</h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 299.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="KBEAR Flash Type-C"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/flash.png") }}" alt="KBEAR Flash Type-C" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Earphone KBEAR Flash Type-C menghadirkan kualitas audio premium dengan detail tinggi dan bass yang kuat. Desain ergonomis serta kabel braided yang tahan lama membuatnya ideal untuk musik dan gaming.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Konektor Type-C, kompatibel dengan Android modern</li>
            <li>Desain ergonomis, nyaman digunakan lama</li>
            <li>Kabel braided anti kusut dan kuat</li>
            <li>Suara jernih dengan bass dalam</li>
            <li>Dilengkapi mikrofon dan tombol kontrol</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 299.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan KBEAR Flash Type-C" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>



                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="audio" data-name="TWS Earbuds Pro">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/TWS.webp') }}" alt="TWS Earbuds Pro"
                            class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">TWS Earbuds Pro</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 450.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="TWS Earbuds Pro"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/TWS.webp') }}" alt="TWS Earbuds Pro" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">TWS Earbuds Pro adalah earbuds nirkabel berkualitas tinggi dengan Active Noise Cancelling dan daya tahan baterai hingga 30 jam. Tahan air IPX7 dan kontrol sentuh yang responsif membuatnya ideal untuk aktivitas harian.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Active Noise Cancelling</li>
                            <li>30 jam battery life</li>
                            <li>IPX7 waterproof</li>
                            <li>Touch control</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 450.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Earbuds Pro" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="audio" data-name="Nothing CMF Buds Pro TWS" id="nothingCmfBudsPro">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/cmf.png') }}"
            alt="Nothing CMF Buds Pro TWS Headset Earphone Bluetooth - Light Grey" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
            Nothing CMF Buds Pro TWS
        </h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 1.099.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Nothing CMF Buds Pro TWS - Light Grey"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/cmf.png") }}" alt="Nothing CMF Buds Pro TWS - Light Grey" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Nothing CMF Buds Pro menghadirkan kualitas audio premium dengan ANC (Active Noise Cancellation), bass bertenaga, dan daya tahan baterai hingga 39 jam. Desainnya minimalis dan modern dengan warna Light Grey yang elegan.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Active Noise Cancellation (ANC) hingga 45dB</li>
            <li>Driver Dinamis 10mm Bass Boost</li>
            <li>Daya tahan baterai hingga 39 jam dengan case</li>
            <li>Bluetooth 5.3 koneksi stabil</li>
            <li>Mode Transparansi & Gaming Low Latency</li>
            <li>Warna: Light Grey</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 1.099.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Nothing CMF Buds Pro TWS" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>
<div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="audio" data-name="Samsung Galaxy Buds Pro" id="galaxyBudsPro">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/samsung.png') }}"
            alt="Samsung Galaxy Buds Pro – Earbud" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
            Samsung Galaxy Buds Pro
        </h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 2.499.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Samsung Galaxy Buds Pro – Earbud"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/samsung.png") }}" alt="Samsung Galaxy Buds Pro" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Samsung Galaxy Buds Pro menghadirkan pengalaman audio premium dengan Active Noise Cancelling, kualitas suara jernih, serta desain ergonomis untuk kenyamanan sepanjang hari.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Active Noise Cancelling (ANC) hingga 35dB</li>
            <li>Audio 360° dengan Dolby Head Tracking</li>
            <li>Mode Transparansi & Ambient Sound</li>
            <li>IPX7 tahan air dan keringat</li>
            <li>Baterai hingga 18 jam (dengan casing)</li>
            <li>Warna: Phantom Black</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 2.499.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Samsung Galaxy Buds Pro – Earbud" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>



                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="audio" data-name="Headphone Bluetooth KVIDIO">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Headphone.jpg') }}"
                            alt="Headphone Bluetooth KVIDIO" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Headphone Bluetooth
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 225.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Headphone Bluetooth"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Headphone.jpg') }}" alt="Headphone Bluetooth" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Headphone Bluetooth KVIDIO adalah headphone over-ear dengan kualitas suara HD, desain nyaman, dan konektivitas yang andal. Cocok untuk mendengarkan musik, bermain game, dan panggilan suara.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Koneksi Bluetooth 5.3 stabil & cepat</li>
                            <li>Baterai tahan hingga 55 jam</li>
                            <li>Desain lipat & bantalan empuk</li>
                            <li>Mendukung kabel AUX & Micro SD</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 225.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Headphone Bluetooth" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="kamera" data-name="Ring Light LED 26cm Tripod Stand">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ringligt.jpg') }}"
                            alt="Ring Light LED 26cm Tripod Stand" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Ring Light LED
                            Tripod Stand</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 135.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Ring Light LED Tripod Stand"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ringligt.jpg') }}" alt="Ring Light LED 26cm Tripod Stand" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Ring Light LED Tripod Stand memiliki diameter 26cm dan dilengkapi tripod serta holder HP, ideal untuk pencahayaan profesional saat live streaming, makeup, dan konten kreatif.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>3 Mode cahaya: putih, natural, hangat</li>
                            <li>Dilengkapi tripod & holder HP fleksibel</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 135.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Ring Light LED Tripod Stand" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="kamera" data-name=" Dual Ring Light with Tripod Stand">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ringligtpanjang.png') }}"
                            alt=" Dual Ring Light with Tripod Stand" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2"> Dual Ring Light with Tripod Stand</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 135.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Ring Light LED Tripod Stand"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ringligtpanjang.png') }}" alt=" Dual Ring Light with Tripod Stand" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                       <p class="text-gray-700 mb-2">Dual Ring Light dengan Tripod Stand dan 2 Holder HP ini memberikan pencahayaan ekstra terang untuk kebutuhan konten, live streaming, atau fotografi. Desainnya fleksibel dengan tinggi tripod yang dapat disesuaikan dan dua dudukan HP untuk sudut yang sempurna.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Dual LED Ring Light untuk pencahayaan ganda</li>
            <li>Tripod adjustable hingga 2 meter</li>
            <li>2 dudukan HP fleksibel</li>
            <li>3 mode warna: Warm, Cool, Natural</li>
            <li>Kontrol kecerahan melalui remote kabel</li>
            <li>Daya USB universal</li>
        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 135.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Ring Light LED Tripod Stand" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="kamera" data-name="Lampu Selfie Clip-On LED Rokeet">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ringlightmini.jpeg') }}"
                            alt="Lampu Selfie Clip-On LED Rokeet" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Lampu Selfie Clip-On
                            LED</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 25.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Lampu Selfie Clip-On LED Rokeet"
                            data-modal-content='
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ringlightmini.jpeg') }}" alt="Lampu Selfie Clip-On LED Rokeet" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                            </div>
                            <p class="text-gray-700 mb-2">Lampu LED selfie portabel dengan desain clip-on, cocok untuk kamu yang suka membuat konten atau selfie dalam pencahayaan minim.</p>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                <li>Desain clip-on, mudah dipasang ke HP</li>
                                <li>Cahaya putih terang & lembut</li>
                                <li>Ukuran ring kecil, praktis dibawa</li>
                                <li>Daya tahan baterai baik</li>
                            </ul>
                            <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 25.000</div>
                            <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Lampu Selfie Clip-On LED Rokeet" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                        '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="cahaya" data-name="Lighting HP Mini" id="lightingHpMini">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/lightmini.png') }}"
            alt="Lighting HP Mini" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
            Lighting HP Mini
        </h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 89.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Lighting HP Mini"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/lightmini.png") }}" alt="Lighting HP Mini" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">Lighting HP Mini adalah lampu portabel yang praktis untuk meningkatkan pencahayaan saat foto selfie, video call, atau membuat konten. Desainnya kecil, ringan, dan mudah dibawa ke mana pun.</p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Cocok untuk semua jenis smartphone</li>
            <li>3 level kecerahan yang dapat diatur</li>
            <li>Daya tahan baterai hingga 2 jam</li>
            <li>Pengisian cepat via kabel USB</li>
            <li>Desain ringan dan mudah dipasang di HP</li>
            <li>Warna: Putih</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 89.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Lighting HP Mini" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>


                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="kamera" data-name="Lensa Makro & Wide Clip-On 3-in-1">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="images/Lensa.avif" alt="Lensa Makro & Wide Clip-On 3-in-1"
                            class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Lensa Makro & Wide
                            Clip-On 3in1</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 95.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Lensa Makro & Wide Clip-On 3-in-1"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="images/Lensa.avif" alt="Lensa Makro & Wide Clip-On 3-in-1" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Set lensa clip-on 3-in-1 untuk smartphone, meliputi lensa makro, wide-angle, dan fish-eye.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>Lensa makro untuk foto close-up detail tajam</li>
                            <li>Fish-eye efek melengkung artistik</li>
                            <li>Clip-on mudah dipasang tanpa alat tambahan</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 95.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Lensa Makro & Wide Clip-On 3-in-1" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>

                <!-- Produk Aksesoris powerbank -->
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="powerbank" data-name="Power Bank 20000mAh">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Powerbank.jpg') }}"
                            alt="Power Bank 20000mAh" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Power Bank 20000mAh
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 375.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Power Bank 20000mAh"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Powerbank.jpg') }}" alt="Power Bank 20000mAh" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Power bank kapasitas besar dengan fitur-fitur canggih.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>20000mAh high capacity</li>
                            <li>22.5W fast charging</li>
                            <li>Digital LED display</li>
                            <li>Multiple output ports</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 375.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Power Bank 20000mAh" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="powerbank" data-name="Power Bank 20000mAh 130W" id="powerBank20000">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/powerbankugrin.png') }}"
            alt="Power Bank 20000mAh 130W" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
            Power Bank 20000mAh 130W
        </h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 499.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Power Bank 20000mAh 130W"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/powerbankugrin.png") }}" alt="Power Bank 20000mAh 130W" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">
            Power Bank 20000mAh 130W memiliki kapasitas besar dengan daya keluaran tinggi yang mampu mengisi ulang laptop, smartphone, dan perangkat lainnya dengan cepat. Didesain elegan dengan material premium dan teknologi pengisian cepat.
        </p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Kapasitas besar 20.000mAh</li>
            <li>Dukungan fast charging hingga 130W</li>
            <li>Output multiple port (USB-A & Type-C)</li>
            <li>Dilengkapi layar indikator daya digital</li>
            <li>Material kokoh & desain elegan</li>
            <li>Warna: Hitam</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 499.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Power Bank 20000mAh 130W" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>
<div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="powerbank" data-name="Anker Zolo Power Bank 30W" id="ankerZolo30w">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/ankerzolo.png') }}"
            alt="Anker Zolo Power Bank 30W" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
            Anker Zolo Power Bank 30W
        </h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 429.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Anker Zolo Power Bank 30W"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/ankerzolo.png") }}" alt="Anker Zolo Power Bank 30W" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">
            Anker Zolo Power Bank 30W menghadirkan kombinasi antara portabilitas dan kecepatan pengisian. Dilengkapi teknologi PowerIQ 3.0, mampu mengisi perangkat dengan efisiensi tinggi dan perlindungan maksimal dari overcharge atau overheat.
        </p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Kapasitas 10.000mAh</li>
            <li>Daya output hingga 30W</li>
            <li>Teknologi PowerIQ 3.0 untuk pengisian cepat</li>
            <li>Dual port (USB-A & Type-C)</li>
            <li>Desain ringan dan mudah dibawa</li>
            <li>Warna: Hitam</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 429.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Anker Zolo Power Bank 30W" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>



                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="powerbank" data-name="Power Bank Wireless">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/powerwairless.webp') }}"
                            alt="Power Bank Wireless" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Power Bank Wireless
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 425.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Power Bank Wireless"
                            data-modal-content="
                            <div class='text-center mb-4'>
                                <img src='{{ asset('assets/demo/toko-aksesoris-hp/images/powerwairless.webp') }}' alt='Power Bank Wireless' class='mx-auto w-60 h-60 object-contain rounded-lg mb-2'>
                            </div>
                            <p class='text-gray-700 mb-2'>Power bank wireless dengan desain stylish dan teknologi pengisian nirkabel yang cepat dan aman.</p>
                            <ul class='list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left'>
                                <li>Kompatibel dengan MagSafe dan Qi charging</li>
                                <li>Kapasitas baterai 10000mAh</li>
                                <li>Desain slim dan elegan</li>
                                <li>Dukungan pengisian cepat 15W wireless dan 20W wired</li>
                            </ul>
                            <div class='text-teal-500 font-bold text-lg mt-4 text-center'>Rp 425.000</div>
                            <div class='text-center mt-3'>
                                <a href='https://wa.me/6282392184679?text=Hallo, saya tertarik dengan Power Bank Wireless' target='_blank'
                                    class='inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full'>Chat Penjual</a>
                            </div>
                        ">Detail</button>
                    </div>
                </div>
                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
    data-category="powerbank" data-name="Powerbank Wireless JETE A11 10000 mAh" id="jeteA11">
    <div class="aspect-w-1 aspect-h-1 w-full">
        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/jete.png') }}"
            alt="Powerbank Wireless JETE A11 10000 mAh" class="w-full h-full object-contain p-2">
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">
            Powerbank Wireless JETE A11 10000 mAh
        </h3>
        <div class="text-center mt-auto">
            <span class="text-red-600 font-bold text-lg">Rp 299.000</span>
        </div>
    </div>
    <div class="p-4 pt-0">
        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
            data-modal-title="Powerbank Wireless JETE A11 10000 mAh"
            data-modal-content='
        <div class="text-center mb-4">
            <img src="{{ asset("assets/demo/toko-aksesoris-hp/images/jete.png") }}" alt="Powerbank Wireless JETE A11 10000 mAh" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
        </div>
        <p class="text-gray-700 mb-2">
            Powerbank Wireless JETE A11 berkapasitas 10000 mAh yang mendukung pengisian cepat dengan dan tanpa kabel. Didesain modern dan praktis, cocok untuk menemani aktivitas harian kamu tanpa khawatir kehabisan daya.
        </p>
        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
            <li>Kapasitas 10000 mAh</li>
            <li>Mendukung pengisian wireless & kabel</li>
            <li>Output hingga 22.5W</li>
            <li>Dilengkapi port USB-A dan Type-C</li>
            <li>Proteksi overcharge, overheat, dan short circuit</li>
            <li>Warna: Hitam</li>
        </ul>
        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 299.000</div>
        <div class="text-center mt-3">
            <a href="https://wa.me/6282392184679?text=Halo saya tertarik dengan Powerbank Wireless JETE A11 10000 mAh" target="_blank"
                class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
        </div>
    '>Detail</button>
    </div>
</div>


                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="powerbank" data-name="Power Bank Vivan Wireless">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/powerbankvivan.jpg') }}"
                            alt="Power Bank Vivan Wireless" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Power Bank Vivan
                            Wireless</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 395.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Power Bank Vivan Wireless"
                            data-modal-content="
                            <div class='text-center mb-4'>
                                <img src='{{ asset('assets/demo/toko-aksesoris-hp/images/powerbankvivan.jpg') }}' alt='Power Bank Vivan Wireless' class='mx-auto w-60 h-60 object-contain rounded-lg mb-2'>
                            </div>
                            <p class='text-gray-700 mb-2'>Power Bank Vivan 10000mAh dengan pengisian cepat 20W dan pengisian nirkabel 15W, cocok untuk pengguna modern yang menginginkan efisiensi dan mobilitas.</p>
                            <ul class='list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left'>
                                <li>PD 20W + Wireless Charging 15W</li>
                                <li>Kapasitas 10000mAh</li>
                                <li>Desain compact dan ringan</li>
                                <li>Kabel terintegrasi dan kompatibel dengan banyak perangkat</li>
                            </ul>
                            <div class='text-teal-500 font-bold text-lg mt-4 text-center'>Rp 395.000</div>
                            <div class='text-center mt-3'>
                                <a href='https://wa.me/6282392184679?text=Hallo, saya tertarik dengan Power Bank Vivan Wireless' target='_blank'
                                    class='inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full'>Chat Penjual</a>
                            </div>
                        ">Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="powerbank" data-name="Mini Power Bank LED Display">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="images/minipowerbank.avif" alt="Mini Power Bank LED Display"
                            class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Mini Power Bank LED
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 215.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Mini Power Bank LED"
                            data-modal-content="
            <div class='text-center mb-4'>
                <img src='images/minipowerbank.avif' alt='Mini Power Bank LED' class='mx-auto w-60 h-60 object-contain rounded-lg mb-2'>
            </div>
            <p class='text-gray-700 mb-2'>Mini power bank portabel dengan desain elegan, dilengkapi tampilan LED digital dan lampu senter ganda yang cocok untuk penggunaan sehari-hari.</p>
            <ul class='list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left'>
                <li>Kapasitas 10000mAh</li>
                <li>Layar digital penunjuk daya</li>
                <li>Dua lampu senter LED</li>
                <li>Desain compact & ringan</li>
            </ul>
            <div class='text-teal-500 font-bold text-lg mt-4 text-center'>Rp 215.000</div>
            <div class='text-center mt-3'>
                <a href='https://wa.me/6282392184679?text=Hallo, saya tertarik dengan Mini Power Bank LED' target='_blank'
                    class='inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full'>Chat Penjual</a>
            </div>
        ">Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="accessory" data-name="Tempered Glass Screen Protector">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/temperglas.jpg') }}"
                            alt="Tempered Glass Screen Protector" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Tempered Glass
                            Screen Protector</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 35.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Tempered Glass Screen Protector"
                            data-modal-content='
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/temperglas.jpg') }}" alt="Tempered Glass Screen Protector" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                        </div>
                        <p class="text-gray-700 mb-2">Pelindung layar kaca tempered berkualitas tinggi.</p>
                        <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                            <li>9H hardness tempered glass</li>
                            <li>Ultra-thin 0.3mm</li>
                            <li>Bubble-free installation</li>
                            <li>99% HD clarity</li>
                        </ul>
                        <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 35.000</div>
                        <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Tempered Glass Screen Protector" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                    '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="accessory" data-name="Stand HP Lipat Serbaguna">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/HolderHp.jpg') }}"
                            alt="Stand HP Lipat Serbaguna" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Stand HP Lipat
                            Serbaguna</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 45.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Stand HP Lipat Serbaguna"
                            data-modal-content='
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/HolderHp.jpg') }}" alt="Stand HP Lipat Serbaguna" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                            </div>
                            <p class="text-gray-700 mb-2">Stand handphone yang praktis, bisa dilipat dan disesuaikan dengan kebutuhan.</p>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                <li>Desain lipat, mudah dibawa kemana-mana</li>
                                <li>Sudut pandang dapat diatur bebas</li>
                                <li>Stabil dan anti-slip</li>
                                <li>Cocok untuk semua jenis handphone</li>
                            </ul>
                            <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 45.000</div>
                            <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Hallo saya tertarik dengan Stand HP Lipat Serbaguna" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                        '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="accessory" data-name="Stylus Pen Universal">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/StylusPen.jpg') }}"
                            alt="Stylus Pen Universal" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">Stylus Pen Universal
                        </h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 45.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="Stylus Pen Universal"
                            data-modal-content='
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/StylusPen.jpg') }}" alt="Stylus Pen Universal" class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                            </div>
                            <p class="text-gray-700 mb-2">Pena stylus yang responsif dan presisi, kompatibel dengan berbagai layar sentuh smartphone dan tablet.</p>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                <li>Ujung sensitif presisi tinggi</li>
                                <li>Desain ringan dan ergonomis</li>
                                <li>Kompatibel dengan semua layar kapasitif</li>
                                <li>Baterai tahan lama (jika model aktif)</li>
                            </ul>
                            <div class="text-teal-500 font-bold text-lg mt-4 text-center">Rp 45.000</div>
                            <div class="text-center mt-3">
                                <a href="https://wa.me/6282392184679?text=Halo%20saya%20tertarik%20dengan%20produk%20ini" target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                            </div>
                        '>Detail</button>
                    </div>
                </div>

                <div class="product-card bg-white rounded-2xl shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                    data-category="accessory" data-name="SIM Card Tray Ejector Metal">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/jarumsimkart.webp') }}"
                            alt="SIM Card Tray Ejector Metal" class="w-full h-full object-contain p-2">
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-semibold product-title text-center flex-grow mb-2">SIM Card Tray
                            Ejector</h3>
                        <div class="text-center mt-auto">
                            <span class="text-red-600 font-bold text-lg">Rp 8.000</span><br>
                            <span class="text-gray-400 line-through text-sm">Rp 15.000</span>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <button class="w-full mt-auto px-4 py-2 bg-teal-500 text-white rounded-full text-sm show-modal"
                            data-modal-title="SIM Card Tray Ejector"
                            data-modal-content='
                                <div class="text-center mb-4">
                                    <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/jarumsimkart.webp') }}" alt="SIM Card Tray Ejector"
                                        class="mx-auto w-60 h-60 object-contain rounded-lg mb-2">
                                </div>
                                <p class="text-gray-700 mb-2">
                                    Alat kecil berbahan logam untuk membuka tray SIM card dengan mudah dan aman. Cocok untuk semua tipe smartphone.
                                </p>
                                <ul class="list-disc list-inside text-gray-600 text-sm space-y-1 mb-2 text-left">
                                    <li>Bahan metal kuat dan tahan lama</li>
                                    <li>Desain tipis, mudah dibawa</li>
                                    <li>Cocok untuk semua merk hp</li>
                                    <li>Penggunaan mudah dan aman</li>
                                </ul>
                                <div class="text-center mt-4">
                                    <span class="text-teal-500 font-bold text-xl">Rp 8.500</span><br>
                                    <span class="text-gray-400 line-through mr-2">Rp 15.000</span>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="https://wa.me/6282392184679?text=Halo%20saya%20tertarik%20dengan%20produk%20ini" target="_blank"
                                        class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">Chat Penjual</a>
                                </div>
                            '>Detail
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal Universal -->
    <div id="universalModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-all duration-300 px-4 sm:px-0 hidden">
        <!-- Dialog: full-screen on small devices, centered box on md+ -->
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg sm:mx-auto sm:my-8 relative animate-fadeIn flex flex-col overflow-hidden h-full sm:h-auto">
            <!-- Close button (top-right) - on mobile make it more visible and inside header -->
            <button id="closeUniversalModal" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-3xl font-bold focus:outline-none transition-colors duration-200">&times;</button>
            <div class="p-4 sm:p-6 overflow-auto" style="max-height: calc(100vh - 120px);">
                <h3 id="universalModalTitle" class="text-2xl font-extrabold mb-4 text-teal-600 text-center"></h3>
                <div id="universalModalContent" class="text-gray-700"></div>
            </div>
        </div>
        <style>
            .animate-fadeIn {
                animation: fadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Make modal full-screen on very small devices */
            @media (max-width: 639px) {
                #universalModal > div {
                    border-radius: 0.5rem; /* slightly rounded */
                    height: 100vh;
                    max-width: 100%;
                }
                #universalModal .absolute.top-3.right-3 {
                    right: 12px;
                    top: 12px;
                }
            }

            #universalModal::-webkit-scrollbar {
                width: 8px;
            }

            #universalModal::-webkit-scrollbar-thumb {
                background: #38b2ac;
                border-radius: 8px;
            }
        </style>
    </div>
    <!-- Footer dengan informasi toko yang diperbarui -->
    <footer class="bg-gray-800 text-gray-300 py-8">
        <div class="container mx-auto flex flex-col md:flex-row items-center md:items-start justify-between">

            <!-- Logo di kiri -->
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <!-- Logo Toko -->
                <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/LOGO.png') }}" alt="Logo Toko"
                    class="rounded-full w-16 h-16 ml-6">
                <h1 class="text-2xl font-bold text-white">Katalog Aksesoris HP</h1>
            </div>


            <!-- Kotak Hubungi Kami di kanan -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full md:w-1/3">
                <h4 class="text-xl font-semibold text-white mb-4">Hubungi Kami</h4>
                <p>Owner: Hans</p>
                <p>
                    Telp/WhatsApp:
                    <a href="https://wa.me/628123456789" class="text-teal-400 hover:text-teal-300 transition-colors">
                        +62 812-3456-789
                    </a>
                </p>
                <p>
                    Email:
                    <a href="mailto:info@techstore.com" class="text-teal-400 hover:text-teal-300 transition-colors">
                        info@techstore.com
                    </a>
                </p>
            </div>

        </div>
        <div class="text-center mt-4 text-sm">
            &copy; 2023 Katalog Aksesoris HP. All rights reserved.
        </div>
    </footer>

    <script>
        function filterByPrice(range) {
            const products = document.querySelectorAll('.product-card');
            if (!range || range === 'all') {
                products.forEach(product => product.style.display = 'block');
                return;
            }
            const [min, max] = range.split('-').map(Number);
            products.forEach(product => {
                let priceEl = product.querySelector('.product-price');
                if (!priceEl) priceEl = product.querySelector('.text-red-600.font-bold');
                let priceText = priceEl ? priceEl.textContent.replace(/[^\d]/g, '') : '';
                let price = parseInt(priceText) || 0;
                if (price >= min && price <= max) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Event agar filter harga langsung aktif saat dropdown berubah
        document.getElementById('priceDropdown').addEventListener('change', function(e) {
            filterByPrice(e.target.value);
        });

        // JAVASCRIPT FUNCTIONS

        // Modal universal untuk gambar, deskripsi, dan fitur
        function setupUniversalModal() {
            document.querySelectorAll('.show-modal').forEach(el => {
                el.addEventListener('click', function() {
                    const modal = document.getElementById('universalModal');
                    const modalTitle = document.getElementById('universalModalTitle');
                    const modalContent = document.getElementById('universalModalContent');
                    modalTitle.textContent = this.getAttribute('data-modal-title');
                    modalContent.innerHTML = this.getAttribute('data-modal-content');
                    // Tambahkan bagian "Produk Serupa" otomatis berdasarkan kategori produk yang dibuka
                    try {
                        // Cari card produk yang cocok berdasarkan data-name sama dengan modal title
                        var currentName = modalTitle.textContent.trim();
                        var currentCard = document.querySelector('.product-card[data-name="' + CSS.escape(currentName) + '"]');
                        if (!currentCard) {
                            // coba matching case-insensitive jika exact match tidak ditemukan
                            var allCards = Array.from(document.querySelectorAll('.product-card'));
                            currentCard = allCards.find(function(c) { return (c.dataset.name || '').toLowerCase().trim() === currentName.toLowerCase(); });
                        }

                        if (currentCard) {
                            var cat = currentCard.dataset.category;
                            if (cat) {
                                var related = Array.from(document.querySelectorAll('.product-card')).filter(function(c) {
                                    return c.dataset.category === cat && c.dataset.name !== currentCard.dataset.name;
                                }).slice(0,3);

                                if (related.length) {
                                    var relatedHtml = '<hr class="my-4" />';
                                    relatedHtml += '<h4 class="text-lg font-semibold mb-2">Produk Serupa</h4>';
                                    relatedHtml += '<div class="grid grid-cols-2 gap-3">';
                                    related.forEach(function(r) {
                                        var img = r.querySelector('img') ? r.querySelector('img').getAttribute('src') : '';
                                        var name = r.dataset.name || '';
                                        // Try to find a visible price inside card
                                        var priceEl = r.querySelector('.text-red-600') || r.querySelector('.price') || null;
                                        var price = priceEl ? priceEl.textContent.trim() : '';
                                        relatedHtml += '<div class="p-2 border rounded-lg bg-white text-center">';
                                        if (img) {
                                            relatedHtml += '<img src="' + img + '" alt="' + name + '" class="mx-auto w-24 h-24 object-contain mb-2">';
                                        }
                                        relatedHtml += '<div class="text-sm font-medium mb-1">' + name + '</div>';
                                        if (price) relatedHtml += '<div class="text-teal-500 font-bold mb-2">' + price + '</div>';
                                        relatedHtml += '<button class="open-related inline-block bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-xs" data-target="' + name.replace(/"/g, '&quot;') + '">Lihat</button>';
                                        relatedHtml += '</div>';
                                    });
                                    relatedHtml += '</div>';
                                    modalContent.innerHTML += relatedHtml;

                                    // Pasang event handler untuk tombol 'Lihat' pada produk serupa
                                    modalContent.querySelectorAll('.open-related').forEach(function(btn) {
                                        btn.addEventListener('click', function() {
                                            var targetName = this.getAttribute('data-target');
                                            // cari product-card yang memiliki data-name sama
                                            var targetCard = Array.from(document.querySelectorAll('.product-card')).find(function(c) {
                                                return (c.dataset.name || '').trim() === targetName;
                                            });
                                            if (targetCard) {
                                                var targetBtn = targetCard.querySelector('.show-modal');
                                                if (targetBtn) {
                                                    // Tutup modal saat ini lalu buka modal target
                                                    modal.classList.add('hidden');
                                                    setTimeout(function() { targetBtn.click(); }, 80);
                                                }
                                            }
                                        });
                                    });
                                }
                            }
                        }
                    } catch (e) {
                        // jika ada error, jangan ganggu modal utama
                        console.error('Error building related products:', e);
                    }
                    modal.classList.remove('hidden');
                });
            });
            document.getElementById('closeUniversalModal').addEventListener('click', function() {
                document.getElementById('universalModal').classList.add('hidden');
            });
            document.getElementById('universalModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', setupUniversalModal);

        // Mengatur filter produk berdasarkan kategori yang dipilih.
        function filterProducts(category, event) {
            const products = document.querySelectorAll('.product-card');
            const buttons = document.querySelectorAll('.category-btn');

            // Perbarui status tombol aktif
            buttons.forEach(btn => btn.classList.remove('active', 'bg-teal-500', 'text-white'));
            buttons.forEach(btn => btn.classList.add('bg-white', 'hover:bg-gray-200'));
            event.target.classList.add('active', 'bg-teal-500', 'text-white', 'hover:bg-teal-600');
            event.target.classList.remove('bg-white', 'hover:bg-gray-200');

            // Tampilkan atau sembunyikan produk sesuai kategori
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
            // Setelah filter diterapkan, sebelumnya kita melakukan scroll otomatis ke produk pertama.
            // Pengguna meminta agar scrol otomatis dinonaktifkan, jadi tidak melakukan scroll di sini.
        }

        // Scroll ke produk pertama yang terlihat untuk kategori yang dipilih.
        // Jika category === 'all', scroll ke bagian produk (judul section).
        function scrollToFirstVisibleProduct(category) {
            const grid = document.getElementById('productsGrid');
            if (!grid) return;

            if (category === 'all') {
                // Scroll ke judul section Produk Unggulan
                const sectionTitle = document.querySelector('.section-title');
                if (sectionTitle) {
                    sectionTitle.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    return;
                }
            }

            // Temukan elemen product-card pertama yang sedang ditampilkan dan cocok dengan kategori
            const products = Array.from(grid.querySelectorAll('.product-card'));
            const firstVisible = products.find(p => p.style.display !== 'none' && (category === 'all' || p.dataset
                .category === category));
            if (firstVisible) {
                // Scroll ke posisi card, memberi sedikit offset agar tidak tersembunyi di bawah header
                const headerOffset = 20; // pixel
                const rect = firstVisible.getBoundingClientRect();
                const absoluteY = window.pageYOffset + rect.top - headerOffset;
                window.scrollTo({
                    top: absoluteY,
                    behavior: 'smooth'
                });
            }
        }

        // Mencari produk berdasarkan kata kunci dari input pencarian.
        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
            const products = document.querySelectorAll('.product-card');
            if (searchTerm === "") {
                // Jika pencarian kosong, tampilkan semua produk
                products.forEach(product => {
                    product.style.display = 'block';
                });
                return;
            }
            products.forEach(product => {
                const title = product.querySelector('.product-title') && product.querySelector('.product-title')
                    .textContent.toLowerCase() || "";
                const description = product.querySelector('.product-description') && product.querySelector(
                    '.product-description').textContent.toLowerCase() || "";
                const category = product.dataset.category && product.dataset.category.toLowerCase() || "";
                const name = product.dataset.name && product.dataset.name.toLowerCase() || "";
                if (
                    title.includes(searchTerm) ||
                    description.includes(searchTerm) ||
                    category.includes(searchTerm) ||
                    name.includes(searchTerm)
                ) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Fungsionalitas tombol "Tambah ke Keranjang"
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productCard = this.closest('.product-card');
                const productTitle = productCard.dataset.name;

                // Feedback visual pada tombol
                this.textContent = 'Ditambahkan!';
                this.classList.remove('bg-teal-500', 'hover:bg-teal-600');
                this.classList.add('bg-green-500');

                setTimeout(() => {
                    this.textContent = 'Tambah ke Keranjang';
                    this.classList.remove('bg-green-500');
                    this.classList.add('bg-teal-500', 'hover:bg-teal-600');
                }, 1500);

                // console.log(${productTitle} ditambahkan ke keranjang.);

                // Anda bisa menambahkan logika di sini untuk mengirim data produk
                // ke keranjang belanja atau penyimpanan lokal.
            });
        });


        // Memicu fungsi pencarian saat tombol "Enter" ditekan
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchProducts();
            }
        });

        // Debounce utility
        function debounce(fn, delay) {
            var timer = null;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    fn.apply(context, args);
                }, delay);
            };
        }

        // Live search while typing (debounced)
        var searchEl = document.getElementById('searchInput');
        if (searchEl) {
            searchEl.addEventListener('input', debounce(function() {
                // If empty, clear filters (show all)
                var v = this.value.trim();
                if (v === '') {
                    document.querySelectorAll('.product-card').forEach(function(p) { p.style.display = 'block'; });
                } else {
                    searchProducts();
                }
            }, 250));
        }

        // Memastikan tombol kategori awal disorot saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            const allButton = document.querySelector('.category-btn[onclick*="all"]');
            if (allButton) {
                allButton.classList.add('active', 'bg-teal-500', 'text-white', 'hover:bg-teal-600');
                allButton.classList.remove('bg-white', 'hover:bg-gray-200');
            }
        });

        // Simpan urutan asli produk saat pertama kali load
        let originalProductOrder = [];
        window.addEventListener('DOMContentLoaded', function() {
            const grid = document.getElementById('productsGrid');
            originalProductOrder = Array.from(grid.children).filter(el => el.classList.contains(
                'product-card'));
            document.getElementById('sortDropdown').value = 'lama';
            sortProducts('lama');
        });

        function sortProducts(mode) {
            const grid = document.getElementById('productsGrid');
            if (!originalProductOrder.length) {
                originalProductOrder = Array.from(grid.children).filter(el => el.classList.contains('product-card'));
            }
            // Bersihkan grid
            while (grid.firstChild) grid.removeChild(grid.firstChild);

            let sortedCards;
            if (mode === 'baru') {
                // Barang baru di atas (reverse urutan asli)
                sortedCards = [...originalProductOrder].reverse();
            } else {
                // Barang lama di atas (urutan asli)
                sortedCards = [...originalProductOrder];
            }
            sortedCards.forEach(card => grid.appendChild(card));
        }

        // Filter dan scroll ke subkategori untuk kategori tertentu
        // dipanggil dengan filterSubCategory(category, subCategory)
        window.filterSubCategory = function(category, subCategory) {
            // Mendukung multi subkategori: jika subCategory adalah array, filter dengan semua keyword
            var keywords = Array.isArray(subCategory) ? subCategory : [subCategory];
            var allCards = document.querySelectorAll('.product-card');
            allCards.forEach(function(c) { c.style.display = ''; });

            var selector = '.product-card[data-category="' + category + '"]';
            var cards = document.querySelectorAll(selector);
            var found = false;

            allCards.forEach(function(c) {
                if (!c.matches(selector)) c.style.display = 'none';
            });

            cards.forEach(function(card) {
                var name = card.getAttribute('data-name') || '';
                var match = keywords.some(function(kw) {
                    return name.toLowerCase().includes(kw.toLowerCase());
                });
                if (match) {
                    card.style.display = '';
                    found = true;
                } else {
                    card.style.display = 'none';
                }
            });

            if (!found) {
                cards.forEach(function(card) { card.style.display = ''; });
            } else {
                // Scroll to the first matched (visible) card
                setTimeout(function() {
                    var firstVisible = Array.from(cards).find(function(c) { return c.style.display !== 'none'; });
                    if (firstVisible) {
                        firstVisible.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }, 60);
            }
        }
    </script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-aksesoris-hp',
    ])
</body>

</html>
