<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Aksesoris HP</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <!-- Header -->
  <header class="bg-white shadow-md py-4">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4">
      <div class="flex items-center space-x-4 mb-4 md:mb-0">
        <img src="{{asset('assets/demo/aksesoris_hp/images/LOGO.png')}}" alt="Logo Toko" class="rounded-full w-16 h-16">
        <h1 class="text-2xl font-bold text-teal-600">Katalog Aksesoris HP</h1>
      </div>
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

  <!-- Hero -->
  <section class="relative text-white text-center py-20">
    <div class="absolute inset-0">
      <img src="{{asset('assets/demo/aksesoris_hp/images/Bag.webp')}}" alt="Background" class="w-full h-full object-cover brightness-75">
      <div class="absolute inset-0 bg-teal-800 opacity-50"></div>
    </div>
    <div class="relative z-10 container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Temukan aksesoris handphone kamu disini</h1>
      <p class="text-lg md:text-xl font-light">Koleksi aksesoris handphone terlengkap dengan harga terjangkau</p>
    </div>
  </section>

  <!-- Filter kategori -->
  <div class="container my-8">
    <div class="flex flex-wrap gap-2 md:gap-4 justify-center">
      <button class="category-btn active px-6 py-2 rounded-full border border-gray-300 text-sm font-medium transition-colors"
        onclick="filterProducts('all', event)">Semua</button>
      <button class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium hover:bg-gray-200"
        onclick="filterProducts('case', event)">Case</button>
      <button class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium hover:bg-gray-200"
        onclick="filterProducts('charger', event)">Charger</button>
      <button class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium hover:bg-gray-200"
        onclick="filterProducts('audio', event)">Audio</button>
      <button class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium hover:bg-gray-200"
        onclick="filterProducts('kamera', event)">Kamera & Pencahayaan</button>
      <button class="category-btn px-6 py-2 rounded-full border border-gray-300 bg-white text-sm font-medium hover:bg-gray-200"
        onclick="filterProducts('accessory', event)">Lainnya</button>
    </div>
  </div>

  <!-- Produk -->
  <section class="products-section pb-16">
    <div class="container">
      <h2 class="section-title text-3xl font-bold text-center mb-8">Produk Unggulan</h2>
      <div class="products-grid grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" id="productsGrid">

        <!-- Semua produk dari index.html -->
        <!-- ...produk case, charger, audio, kamera, accessory dari file pertama... -->

        <!-- Tambahan produk case dari case.html -->
        <div class="product-card bg-white p-6 rounded-2xl shadow-md" data-category="case" data-name="Case Silikon Premium">
          <div class="product-image text-center mb-4">
            <img src="{{asset('assets/demo/aksesoris_hp/images/CaseHpp.jpg')}}" alt="Case Silikon Premium" class="mx-auto w-32 h-32 object-cover rounded-lg">
          </div>
          <h3 class="product-title text-xl font-semibold mb-2">Case Silikon Premium</h3>
          <p class="product-description text-gray-500 text-sm mb-4">Case silikon berkualitas tinggi dengan perlindungan maksimal</p>
          <div class="rating flex items-center mb-4"><span class="stars text-yellow-400">⭐⭐⭐⭐⭐</span><span class="text-gray-500 text-xs ml-2">(4.8/5) 150 review</span></div>
          <ul class="features list-disc list-inside text-gray-600 text-sm space-y-1 mb-4"><li>Material silikon premium</li><li>Anti-slip dan fingerprint</li><li>Perlindungan drop 2 meter</li><li>Berbagai pilihan warna</li></ul>
          <div class="product-price text-2xl font-bold text-teal-500 mb-4">Rp 85.000</div>
          <button class="add-to-cart w-full bg-teal-500 text-white py-3 rounded-xl font-medium hover:bg-teal-600">Tambah ke Keranjang</button>
        </div>

        <div class="product-card bg-white p-6 rounded-2xl shadow-md" data-category="case" data-name="Case Unik">
          <div class="product-image text-center mb-4">
            <img src="{{asset('assets/demo/aksesoris_hp/images/CaseUnik.jpg')}}" alt="Case Unik" class="mx-auto w-32 h-32 object-cover rounded-lg">
          </div>
          <h3 class="product-title text-xl font-semibold mb-2">Case Unik</h3>
          <p class="product-description text-gray-500 text-sm mb-4">Case dengan desain unik dan perlindungan baik</p>
          <div class="rating flex items-center mb-4"><span class="stars text-yellow-400">⭐⭐⭐⭐⭐</span><span class="text-gray-500 text-xs ml-2">(4.9/5) 89 review</span></div>
          <ul class="features list-disc list-inside text-gray-600 text-sm space-y-1 mb-4"><li>Standar militer MIL-STD-810G</li><li>Tahan benturan</li><li>Built-in kickstand</li><li>Akses port mudah</li></ul>
          <div class="product-price text-2xl font-bold text-teal-500 mb-4">Rp 150.000</div>
          <button class="add-to-cart w-full bg-teal-500 text-white py-3 rounded-xl font-medium hover:bg-teal-600">Tambah ke Keranjang</button>
        </div>

        <div class="product-card bg-white p-6 rounded-2xl shadow-md" data-category="case" data-name="Case Iphone">
          <div class="product-image text-center mb-4">
            <img src="{{asset('assets/demo/aksesoris_hp/images/CaseIphone.jpg')}}" alt="Case Iphone" class="mx-auto w-32 h-32 object-cover rounded-lg">
          </div>
          <h3 class="product-title text-xl font-semibold mb-2">Case Iphone</h3>
          <p class="product-description text-gray-500 text-sm mb-4">Case transparan yang mempertahankan desain original HP</p>
          <div class="rating flex items-center mb-4"><span class="stars text-yellow-400">⭐⭐⭐⭐</span><span class="text-gray-500 text-xs ml-2">(4.6/5) 203 review</span></div>
          <ul class="features list-disc list-inside text-gray-600 text-sm space-y-1 mb-4"><li>Material PC transparan</li><li>Anti-yellowing technology</li><li>Ultra-thin 1.2mm</li><li>Precise cutouts</li></ul>
          <div class="product-price text-2xl font-bold text-teal-500 mb-4">Rp 65.000</div>
          <button class="add-to-cart w-full bg-teal-500 text-white py-3 rounded-xl font-medium hover:bg-teal-600">Tambah ke Keranjang</button>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-8">
    <div class="container text-center md:text-left grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div>
        <h4 class="text-xl font-semibold text-white mb-4">Tentang TechStore</h4>
        <p>Klasifikasi Usaha: Aksesoris HP</p>
        <p>TechStore menyediakan koleksi aksesoris handphone terlengkap dan berkualitas untuk melindungi dan melengkapi perangkat Anda.</p>
      </div>
      <div>
        <h4 class="text-xl font-semibold text-white mb-4">Hubungi Kami</h4>
        <p>Owner: Hans</p>
        <p>Telp/WhatsApp: <a href="https://wa.me/628123456789" class="text-teal-400 hover:text-teal-300">+62 812-3456-789</a></p>
        <p>Email: <a href="mailto:info@techstore.com" class="text-teal-400 hover:text-teal-300">info@techstore.com</a></p>
      </div>
      <div>
        <h4 class="text-xl font-semibold text-white mb-4">Alamat Kami</h4>
        <address>Jl. Cycas Raya Jl. Taman Setia Budi Indah Blok VV No.172 Kompleks, Asam Kumbang, Kota Medan, Sumatera Utara 20133</address>
      </div>
      <div>
        <h4 class="text-xl font-semibold text-white mb-4">Catatan Penting</h4>
        <p>Semua harga tertera adalah harga satuan dan dapat berubah sewaktu-waktu. Untuk ketersediaan produk, silakan hubungi kami via WhatsApp.</p>
      </div>
    </div>
    <div class="text-center mt-8 pt-4 border-t border-gray-700">
      <p>&copy; 2024 TechStore - Katalog Aksesoris HP Terlengkap</p>
    </div>
  </footer>

  <!-- Script -->
  <script>
    function filterProducts(category, event) {
      const products = document.querySelectorAll('.product-card');
      const buttons = document.querySelectorAll('.category-btn');
      buttons.forEach(btn => btn.classList.remove('active', 'bg-teal-500', 'text-white'));
      buttons.forEach(btn => btn.classList.add('bg-white', 'hover:bg-gray-200'));
      event.target.classList.add('active', 'bg-teal-500', 'text-white', 'hover:bg-teal-600');
      event.target.classList.remove('bg-white', 'hover:bg-gray-200');
      products.forEach(product => {
        if (category === 'all' || product.dataset.category === category) {
          product.style.display = 'block';
        } else {
          product.style.display = 'none';
        }
      });
    }

    function searchProducts() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const products = document.querySelectorAll('.product-card');
      products.forEach(product => {
        const title = product.querySelector('.product-title').textContent.toLowerCase();
        const description = product.querySelector('.product-description').textContent.toLowerCase();
        const category = product.dataset.category.toLowerCase();
        if (title.includes(searchTerm) || description.includes(searchTerm) || category.includes(searchTerm)) {
          product.style.display = 'block';
        } else {
          product.style.display = 'none';
        }
      });
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
      button.addEventListener('click', function () {
        const productCard = this.closest('.product-card');
        const productTitle = productCard.dataset.name;
        this.textContent = 'Ditambahkan!';
        this.classList.remove('bg-teal-500', 'hover:bg-teal-600');
        this.classList.add('bg-green-500');
        setTimeout(() => {
          this.textContent = 'Tambah ke Keranjang';
          this.classList.remove('bg-green-500');
          this.classList.add('bg-teal-500', 'hover:bg-teal-600');
        }, 1500);
        console.log(`${productTitle} ditambahkan ke keranjang.`);
      });
    });

    document.getElementById('searchInput').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        searchProducts();
      }
    });

    document.addEventListener('DOMContentLoaded', () => {
      const allButton = document.querySelector('.category-btn[onclick*="all"]');
      if (allButton) {
        allButton.classList.add('active', 'bg-teal-500', 'text-white', 'hover:bg-teal-600');
        allButton.classList.remove('bg-white', 'hover:bg-gray-200');
      }
    });
  </script>
</body>
</html>
