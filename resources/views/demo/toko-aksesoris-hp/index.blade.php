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

            <!-- Bagian Pencarian -->
            <div class="w-full md:w-auto">
                <div class="relative flex items-center border border-gray-300 rounded-full overflow-hidden">
                    <input type="text" id="searchInput" placeholder="Cari produk..."
                        class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <button onclick="searchProducts()"
                        class="bg-teal-500 text-white px-6 py-2 hover:bg-teal-600 transition-all duration-300">Cari</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section dengan Background Gambar Blur -->
    <section class="relative text-white text-center py-20 overflow-hidden">
        <!-- Wrapper untuk slider -->
        <div id="hero-slider" class="absolute inset-0">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Bag.webp') }}" alt="Background"
                class="slide w-full h-full object-cover brightness-75 absolute inset-0 opacity-100 transition-opacity duration-1000">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Bag2.jpg') }}" alt="Background"
                class="slide w-full h-full object-cover brightness-75 absolute inset-0 opacity-0 transition-opacity duration-1000">
            <img src="{{ asset('assets/demo/toko-aksesoris-hp/images/Bag3.jpg') }}" alt="Background"
                class="slide w-full h-full object-cover brightness-75 absolute inset-0 opacity-0 transition-opacity duration-1000">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-teal-800 opacity-50"></div>
        </div>

        <!-- Konten -->
        <div class="relative z-10 container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Temukan aksesoris handphone kamu disini</h1>
            <p class="text-lg md:text-xl font-light mb-6">Koleksi aksesoris handphone terlengkap dengan harga terjangkau
            </p>

            <!-- Dot Indicator -->
            <div class="flex justify-center space-x-3">
                <span class="dot w-3 h-3 rounded-full bg-white opacity-50 transition-all duration-500"></span>
                <span class="dot w-3 h-3 rounded-full bg-white opacity-50 transition-all duration-500"></span>
                <span class="dot w-3 h-3 rounded-full bg-white opacity-50 transition-all duration-500"></span>
            </div>
        </div>
    </section>


    <div class="my-8">
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
        <div class="flex justify-center mt-6 mb-4 space-x-3">
            <select id="sortDropdown"
                class="border border-teal-400 rounded-full px-4 py-2 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-teal-500"
                onchange="sortProducts(this.value)">
                <option value="lama">Barang Baru</option>
                <option value="baru">Barang Lama</option>

            </select>

            <!-- Dropdown Rentang Harga -->
            <select id="priceDropdown"
                class="border border-teal-400 rounded-full px-4 py-2 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-teal-500"
                onchange="filterByPrice(this.value)">
                <option value="all">Semua Harga</option>
                <option value="0-50000">Rp 0 - Rp 50.000</option>
                <option value="50001-100000">Rp 50.001 - Rp 100.000</option>
                <option value="100001-200000">Rp 100.001 - Rp 200.000</option>
                <option value="200001-9999999">Rp 200.001+</option>
            </select>
        </div>

    </div>

    <section class="products-section pb-16">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-3xl font-bold text-center mb-8">Produk Unggulan</h2>
            <div class="products-grid grid gap-6 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"
                id="productsGrid">


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
                    data-category="case" data-name="Case Transparan Clear">
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
    <div id="universalModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-all duration-300 px-4 sm:px-0 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-0 relative animate-fadeIn">
            <button id="closeUniversalModal"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-3xl font-bold focus:outline-none transition-colors duration-200">&times;</button>
            <div class="p-6 md:p-8">
                <h3 id="universalModalTitle" class="text-2xl font-extrabold mb-4 text-teal-600 text-center"></h3>
                <div id="universalModalContent" class="text-gray-700"></div>
            </div>
        </div>
        <style>
            .animate-fadeIn {
                animation: fadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
        <div class="text-center mt-8 pt-4 border-t border-gray-700">
            <p>&copy; 2025 PT. Era Cipta Digital</p>
        </div>
    </footer>

    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll("#hero-slider .slide");
        const dots = document.querySelectorAll(".dot");

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? "1" : "0";
            });
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add("w-6", "opacity-100"); // titik aktif lebih panjang & jelas
                    dot.classList.remove("w-3", "opacity-50");
                } else {
                    dot.classList.add("w-3", "opacity-50");
                    dot.classList.remove("w-6", "opacity-100");
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        // Tampilkan pertama kali
        showSlide(currentIndex);

        // Ganti setiap 3 detik
        setInterval(nextSlide, 2000);

        // ================== FILTER HARGA ==================
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
    </script>

    <!-- Universal Checkout Bubble -->
    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'toko-aksesoris-hp',
    ])
</body>

</html>
