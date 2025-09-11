<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-bangunan/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
            /* A nice blue */
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
    </style>
</head>

<body>
    <div class="header-section">
        <div class="header-container">
            <div class="header-top">
                <div class="logo">
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="Logo Toko" class="logo-image"
                        style="width: 50px; height: 50px; background: transparent;">
                    <div class="logo-text">{{ $userStore->store_name }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="carousel-section">
        <div class="carousel">
            <div class="carousel-inner" id="carouselInner">
                @forelse ($banners as $banner)
                    <div class="carousel-item">
                        <img src="{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                            alt="{{ $banner->title ?? 'Banner' }}">
                        <div class="carousel-caption">
                            <h3>{{ $banner->title ?? 'Banner Title' }}</h3>
                            <p>{{ $banner->subtitle ?? 'Banner Sub Title' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                            alt="Peralatan Konstruksi">
                        <div class="carousel-caption">
                            <h3>Peralatan Kebersihan Modern</h3>
                            <p>Tingkatkan efisiensi pekerjaan dengan peralatan kebersihan yang modern dan handal</p>
                        </div>
                    </div>
                @endforelse
            </div>
            {{-- PERBAIKAN: Tombol carousel dipindah ke luar loop agar tidak terduplikasi --}}
            @if (isset($banners) && $banners->count() > 1)
                <button class="carousel-control prev" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-control next" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            @endif
        </div>
    </div>

    <div class="category-section">
        <div class="category-container">
            <h2 class="category-title">Kategori Produk</h2>
            <div class="category-grid">
                @if (isset($categories) && $categories->isNotEmpty())
                    @foreach ($categories as $category)
                        {{-- PERBAIKAN: onclick memanggil slug kategori yang dinamis --}}
                        <div class="category-item" onclick="filterByCategory('{{ $category->slug ?? '' }}')">
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description ?? 'Tidak Ada Deskripsi' }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center col-span-full">Tidak Ada Kategori Tersedia</p>
                @endif
            </div>
            <div class="view-all-container">
                <button class="view-all-button" onclick="filterByCategory('all')">Lihat Semua Produk</button>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h2 class="section-title">Produk Kami</h2>

            <div class="filter-section">
                <div class="filter-container">
                    <input type="text" class="search-box" placeholder="Cari produk..." id="searchBox">
                    <select id="priceRangeFilter" class="search-box" style="min-width: 200px;">
                        <option value="">Rentang Harga Produk</option>
                        @if (isset($priceRanges) && $priceRanges->isNotEmpty())
                            @foreach ($priceRanges as $range)
                                <option data-min="{{ $range->min ?? 0 }}" data-max="{{ $range->max ?? '' }}">
                                    {{ $range->name }}
                                </option>
                            @endforeach
                        @endif
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
                {{-- PERUBAHAN UTAMA: Produk sekarang ditampilkan menggunakan Blade Loop dari backend --}}
                @forelse ($products as $product)
                    <div class="product-card" data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                        data-category="{{ $product->category->slug ?? 'uncategorized' }}"
                        data-unit="{{ $product->unit->unit_name }}" data-description="{{ $product->description }}"
                        @php $src = $product->primary_image_src; @endphp data-image="{{ $src }}"
                        data-whatsapp="{{ $userStore->store_phone }}"
                        data-is-new="{{ $product->is_new ? 'true' : 'false' }}"
                        data-created-at="{{ $product->created_at->timestamp }}">

                        @if ($product->is_new)
                            <div class="new-badge">New</div>
                        @endif
                        @php $src = $product->primary_image_src; @endphp
                        @if ($src)
                            <img src="{{ $src }}" alt="{{ $product->name }}" class="product-image"
                                onerror="this.style.display='none';">
                        @endif
                        <div class="product-content">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="product-price">Rp
                                {{ number_format($product->price, 0, ',', '.') }}/{{ $product->unit->unit_name }}
                            </div>
                            <p class="product-description">{{ Str::limit($product->description, 120) }}</p>
                            <div class="button-group">
                                <button class="detail-btn" onclick="showDetail(this)">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                    </svg>
                                    Lihat Detail
                                </button>
                                <button class="chat-btn"
                                    onclick="chatWhatsApp('{{ $userStore->store_phone }}', '{{ $product->name }}')">
                                    <svg class="whatsapp-icon" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                    </svg>
                                    Chat WA
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #666; grid-column: 1 / -1; font-size: 1.1em; margin: 40px 0;">
                        Tidak ada produk yang tersedia saat ini.
                    </p>
                @endforelse
            </div>
            {{-- Pesan ini akan muncul jika filter tidak menemukan hasil --}}
            <div id="noResultsMessage"
                style="display: none; text-align: center; color: #666; grid-column: 1 / -1; font-size: 1.1em; margin: 40px 0;">
                Tidak ada produk yang ditemukan.
            </div>

            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="modal-title" id="modalTitle"></div>
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

    <footer class="footer">
        {{-- Footer content remains the same --}}
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="Logo Toko"
                        class="footer-logo-image" style="width: 150px; height: 150px; background: transparent;">
                    <h3 class="footer-logo-text">{{ $userStore->store_name }}</h3>
                </div>
            </div>

            <div class="footer-section footer-contact">
                <h3>Kontak</h3>
                <div class="address-container">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="address-text">
                        <div>{{ $userStore->store_address }}</div>
                    </div>
                </div>
                <p><i class="fas fa-phone"></i> {{ $userStore->store_phone }}</p>
                <p><i class="fas fa-envelope"></i> {{ $userStore->store_email }}</p>
                <div class="social-media">
                    <a href="{{ $userStore->instagram_url }}" target="_blank" class="social-icon"><i
                            class="fab fa-instagram"></i></a>
                    <a href="{{ $userStore->facebook_url }}" target="_blank" class="social-icon"><i
                            class="fab fa-facebook"></i></a>
                    <a href="{{ $userStore->twitter_url }}" target="_blank" class="social-icon"><i
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

    {{-- PERUBAHAN UTAMA: Seluruh script di bawah ini telah disesuaikan --}}
    <script>
        // Data produk tidak lagi disimpan di sini. JavaScript hanya menangani interaksi.
        let currentProductForModal = null;

        // Fungsi untuk format angka ke Rupiah
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        // Menampilkan detail produk di modal, membaca data dari atribut HTML
        function showDetail(buttonElement) {
            const card = buttonElement.closest('.product-card');
            const productData = card.dataset;

            // Simpan data produk untuk tombol WA di modal
            currentProductForModal = {
                name: productData.name,
                whatsapp: productData.whatsapp
            };

            // Isi modal dengan data dari atribut `data-*` kartu
            document.getElementById('modalTitle').textContent = productData.name;
            document.getElementById('modalImage').src = productData.image;
            document.getElementById('modalImage').alt = productData.name;
            document.getElementById('modalCategory').textContent = getCategoryName(productData.category);
            document.getElementById('modalUnit').textContent = `Unit: ${productData.unit}`;
            document.getElementById('modalDescription').textContent = productData.description;
            document.getElementById('modalPriceDetail').textContent =
                `${formatRupiah(productData.price)} / ${productData.unit}`;

            document.getElementById('productModal').style.display = 'block';
        }

        // Mendapatkan nama kategori dari slug
        function getCategoryName(categorySlug) {
            const categoryMap = {
                'cat': 'Cat & Finishing',
                'keramik': 'Keramik & Lantai',
                'listrik': 'Listrik & Kabel',
                'sanitair': 'Sanitair & Plambing',
                'alat': 'Alat & Mesin',
                'semen': 'Semen & Material',
                'besi': 'Besi & Baja',
                'genteng': 'Genteng & Atap',
                'uncategorized': 'Belum Berkategori'
            };
            return categoryMap[categorySlug] || categorySlug;
        }

        // Menutup modal
        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
            currentProductForModal = null;
        }

        // Fungsi chat WhatsApp
        function chatWhatsApp(phone, productName) {
            const message = `Halo, saya tertarik dengan produk ${productName}. Mohon info lebih lanjut.`;
            const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        // Fungsi chat WhatsApp dari dalam modal
        function chatWhatsAppFromModal() {
            if (currentProductForModal) {
                chatWhatsApp(currentProductForModal.whatsapp, currentProductForModal.name);
                closeModal();
            }
        }

        // Fungsi utama untuk filter dan sorting produk
        function applyFiltersAndSort() {
            const grid = document.getElementById('productsGrid');
            const productCards = Array.from(grid.getElementsByClassName('product-card'));

            const searchTerm = document.getElementById('searchBox').value.toLowerCase();
            const priceFilterSelect = document.getElementById('priceRangeFilter');
            const selectedOption = priceFilterSelect.options[priceFilterSelect.selectedIndex];
            const sortBy = document.getElementById('sortBy').value;

            let visibleCards = [];

            // 1. Proses Filter
            productCards.forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const price = parseFloat(card.dataset.price);

                const matchesSearch = name.includes(searchTerm);

                let matchesPrice = true;
                // Check if a meaningful option is selected (index > 0)
                if (priceFilterSelect.selectedIndex > 0) {
                    const minPrice = selectedOption.dataset.min ? parseFloat(selectedOption.dataset.min) : 0;
                    const maxPrice = selectedOption.dataset.max ? parseFloat(selectedOption.dataset.max) : Infinity;
                    matchesPrice = price >= minPrice && (maxPrice === Infinity || price <= maxPrice);
                }

                if (matchesSearch && matchesPrice) {
                    card.style.display = '';
                    visibleCards.push(card);
                } else {
                    card.style.display = 'none';
                }
            });

            // 2. Proses Sorting
            if (sortBy) {
                visibleCards.sort((a, b) => {
                    switch (sortBy) {
                        case 'price-asc':
                            return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                        case 'price-desc':
                            return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                        case 'name-asc':
                            return a.dataset.name.localeCompare(b.dataset.name);
                        case 'name-desc':
                            return b.dataset.name.localeCompare(a.dataset.name);
                        case 'newest':
                            return parseInt(b.dataset.createdAt) - parseInt(a.dataset.createdAt);
                        default:
                            return 0;
                    }
                });
            }

            // 3. Tampilkan kembali kartu yang sudah diurutkan
            visibleCards.forEach(card => grid.appendChild(card));

            // 4. Tampilkan pesan jika tidak ada hasil
            document.getElementById('noResultsMessage').style.display = visibleCards.length === 0 ? 'block' : 'none';
        }

        // Fungsi filter berdasarkan kategori
        function filterByCategory(categorySlug) {
            document.getElementById('searchBox').value = ''; // Reset filter lain
            document.getElementById('priceRangeFilter').value = '';
            document.getElementById('sortBy').value = '';

            const productCards = document.querySelectorAll('#productsGrid .product-card');
            let visibleCount = 0;

            productCards.forEach(card => {
                if (categorySlug === 'all' || card.dataset.category === categorySlug) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('noResultsMessage').style.display = visibleCount === 0 ? 'block' : 'none';
            document.querySelector('.products-grid').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // --- Logika Carousel ---
        let currentSlide = 0;
        const carouselItems = document.querySelectorAll('.carousel-item');
        const totalSlides = carouselItems.length;

        function updateCarousel() {
            if (totalSlides > 0) {
                document.getElementById('carouselInner').style.transform = `translateX(-${currentSlide * 100}%)`;
            }
        }

        function nextSlide() {
            if (totalSlides > 1) {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            }
        }

        function prevSlide() {
            if (totalSlides > 1) {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateCarousel();
            }
        }

        // --- Event Listeners (dijalankan setelah halaman siap) ---
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchBox').addEventListener('input', applyFiltersAndSort);
            document.getElementById('priceRangeFilter').addEventListener('change', applyFiltersAndSort);
            document.getElementById('sortBy').addEventListener('change', applyFiltersAndSort);

            if (totalSlides > 1) {
                setInterval(nextSlide, 5000);
            }

            window.onclick = function(event) {
                if (event.target == document.getElementById('productModal')) {
                    closeModal();
                }
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
</body>

</html>
