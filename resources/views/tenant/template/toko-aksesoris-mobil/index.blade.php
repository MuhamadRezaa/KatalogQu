<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
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
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="AutoParts Pro Logo">
                </div>
                <div class="logo-text">
                    <span class="logo-main">{{ $userStore->store_name }}</span>
                </div>
            </div>

            <div class="mobile-menu" id="mobileMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="slider">
            @forelse ($banners as $banner)
                <div class="slide {{ $loop->first ? 'active' : '' }}" style="position:relative;">
                    <img src="{{ route('tenant.asset', ['path' => $banner->image_url]) }}"
                        alt="{{ $banner->alt_text ?? ($banner->title ?? 'Banner') }}" loading="lazy" decoding="async"
                        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                    <!-- overlay gelap -->
                    <div style="position:absolute;inset:0;background:linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.3));">
                    </div>

                    <!-- konten tetap -->
                    <div class="slide-content" style="position:relative;z-index:1;">
                        <h1>{{ $banner->title }}</h1>
                        <p>{{ $banner->subtitle }}</p>
                    </div>
                </div>
            @empty
                <div class="slide active" style="position:relative;">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1920&q=80"
                        alt="Banner {{ $userStore->store_name }}"
                        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                    <div style="position:absolute;inset:0;background:linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.3));">
                    </div>
                    <div class="slide-content" style="position:relative;z-index:1;">
                        <h1>Banner {{ $userStore->store_name }}</h1>
                        <p>Temukan koleksi lengkap aksesoris mobil berkualitas tinggi untuk semua jenis kendaraan Anda
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="slider-nav">
            @php $count = ($banners ?? collect())->count() ?: 1; @endphp
            @for ($i = 1; $i <= $count; $i++)
                <div class="nav-dot {{ $i === 1 ? 'active' : '' }}" onclick="currentSlide({{ $i }})"></div>
            @endfor
        </div>
    </section>

    <section class="categories" id="categories">
        <div class="container">
            <h2 class="section-title">Kategori Produk</h2>

            <div class="category-grid">
                {{-- FIX: Hapus `onclick` dan biarkan JavaScript menangani event. Tambahkan `data-category` jika belum ada. --}}
                @if (isset($categories) && $categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="category-card" data-category="{{ strtolower($category->name) }}">
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description ?? 'Tidak Ada Deskripsi' }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center col-span-full">No categories available</p>
                @endif
            </div>
        </div>
    </section>

    <section class="featured-products" id="products">
        <div class="container">
            <div class="filter-container">
                <div class="search-filter">
                    <input type="text" id="productSearchInput" placeholder="Cari produk...">
                    <button id="searchProductBtn"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-options">
                    <select id="categoryFilter">
                        <option value="all">Semua Kategori</option>
                        @if (isset($categories) && $categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <select id="priceFilter">
                        <option value="all">Semua Harga</option>
                        @if (isset($priceRanges) && $priceRanges->isNotEmpty())
                            @foreach ($priceRanges as $range)
                                <option value="{{ $range->name }}" data-min="{{ $range->min ?? 0 }}"
                                    data-max="{{ $range->max ?? '' }}">
                                    {{ $range->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <button id="resetFilterBtn"><i class="fas fa-undo"></i> Reset</button>
                </div>
            </div>

            <h2 class="section-title">Produk Unggulan</h2>

            <div class="products-grid" id="productsGrid">

                @foreach ($products as $product)
                    @php $src = $product->primary_image_src; @endphp
                    {{-- FIX: Tambahkan atribut `data-name`, `data-description`, dan `data-image` --}}
                    <div class="product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                        data-category="{{ strtolower($product->category->name ?? 'general') }}"
                        data-price="{{ $product->price }}" data-description="{{ $product->description }}"
                        data-image="{{ $src }}">
                        <div class="product-image">
                            <img src="{{ $src }}" alt="{{ $product->name }}" class="product-img">
                        </div>
                        <div class="product-info">
                            <div class="product-category">{{ $product->category->name ?? 'General' }}</div>
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <p>{{ Str::limit($product->description, 150) }}</p>
                            <div class="product-buttons">
                                <button class="btn btn-detail" onclick="showProductDetail({{ $product->id }})">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>
                                <button class="btn btn-whatsapp" onclick="orderViaWhatsApp({{ $product->id }})">
                                    <i class="fab fa-whatsapp"></i> Pesan
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($products->isEmpty())
                    <div class="no-products">
                        <p>Belum ada produk yang tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

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

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            <img src="{{ asset('storage/' . $userStore->store_logo) }}"
                                alt="{{ $userStore->store_name }}">
                        </div>
                        <div class="footer-logo-text">
                            <span class="footer-logo-main">{{ $userStore->store_name }}</span>
                        </div>
                    </div>
                    <p>{{ $userStore->store_description }}</p>
                    <div class="social-links">
                        <a href="{{ $userStore->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $userStore->twitter_url }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $userStore->instagram_url }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Kontak</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> {{ $userStore->store_address }}</li>
                        <li><i class="fas fa-phone"></i> {{ $userStore->store_phone }}</li>
                        <li><i class="fas fa-envelope"></i> {{ $userStore->store_email }}</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>

    {{-- Script JavaScript di pindahkan ke bawah body --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productsGrid = document.getElementById('productsGrid');
            const allProducts = Array.from(document.querySelectorAll('.product-card'));

            let currentSlideIndex = 0;
            let slideInterval;

            // --- FUNGSI SLIDER ---
            function startSlider() {
                const slides = document.querySelectorAll('.slide');
                const dots = document.querySelectorAll('.nav-dot');

                if (slides.length === 0) return;

                const showSlide = (index) => {
                    slides.forEach((slide, i) => {
                        slide.classList.toggle('active', i === index);
                    });
                    dots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === index);
                    });
                };

                const nextSlide = () => {
                    currentSlideIndex = (currentSlideIndex + 1) % slides.length;
                    showSlide(currentSlideIndex);
                };

                showSlide(currentSlideIndex);
                slideInterval = setInterval(nextSlide, 5000);
            }

            // Fungsi ini global agar bisa diakses dari atribut onclick di HTML
            window.currentSlide = function(n) {
                clearInterval(slideInterval);
                const slides = document.querySelectorAll('.slide');
                const dots = document.querySelectorAll('.nav-dot');
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));
                currentSlideIndex = n - 1;
                slides[currentSlideIndex].classList.add('active');
                dots[currentSlideIndex].classList.add('active');
                startSlider();
            }

            // --- FUNGSI FILTER & SORT ---
            function resetFilter() {
                document.getElementById('productSearchInput').value = '';
                document.getElementById('categoryFilter').value = 'all';
                document.getElementById('priceFilter').value = 'all';
                applyFilters();
            }

            function setupProductFilters() {
                document.getElementById('searchProductBtn').addEventListener('click', applyFilters);
                document.getElementById('productSearchInput').addEventListener('keyup', applyFilters);
                document.getElementById('categoryFilter').addEventListener('change', applyFilters);
                document.getElementById('priceFilter').addEventListener('change', applyFilters);
                document.getElementById('resetFilterBtn').addEventListener('click', resetFilter);

                // FIX: Ubah selektor dari .category-btn menjadi .category-card
                const categoryCards = document.querySelectorAll('.category-card');
                categoryCards.forEach(card => {
                    card.addEventListener('click', function() {
                        document.getElementById('categoryFilter').value = this.getAttribute(
                            'data-category');
                        applyFilters();
                    });
                });
            }

            function applyFilters() {
                const searchInput = document.getElementById('productSearchInput').value.toLowerCase();
                const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
                const priceFilterSelect = document.getElementById('priceFilter');
                const selectedPriceOption = priceFilterSelect.options[priceFilterSelect.selectedIndex];
                const priceMin = selectedPriceOption.getAttribute('data-min');
                const priceMax = selectedPriceOption.getAttribute('data-max');

                let visibleCards = [];
                const existingMessage = document.querySelector('.no-products-message');
                if (existingMessage) {
                    existingMessage.remove();
                }

                allProducts.forEach(card => {
                    const productName = card.getAttribute('data-name').toLowerCase();
                    const productCategory = card.getAttribute('data-category').toLowerCase();
                    const productPrice = parseInt(card.getAttribute('data-price'));
                    const productDesc = card.getAttribute('data-description').toLowerCase();

                    const matchesSearch = searchInput === '' || productName.includes(searchInput) ||
                        productDesc.includes(searchInput);
                    const matchesCategory = categoryFilter === 'all' || productCategory === categoryFilter;
                    const matchesPrice = checkPriceRange(productPrice, priceMin, priceMax);

                    if (matchesSearch && matchesCategory && matchesPrice) {
                        card.style.display = 'flex';
                        visibleCards.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                updateSectionTitle(searchInput, categoryFilter, selectedPriceOption.value, visibleCards.length);
                if (visibleCards.length === 0) {
                    displayNoProductsMessage();
                }
            }

            function checkPriceRange(price, min, max) {
                if (min === null || isNaN(price)) return true;
                const minVal = parseInt(min);
                const maxVal = max ? parseInt(max) : Infinity;
                return price >= minVal && (maxVal === Infinity || price <= maxVal);
            }

            function updateSectionTitle(searchInput, categoryFilter, priceFilter, count) {
                const sectionTitle = document.querySelector('#products .section-title');
                if (!sectionTitle) return;
                const categoryNames = {
                    'interior': 'Produk Interior',
                    'exterior': 'Produk Eksterior',
                    'electronics': 'Produk Elektronik',
                    'maintenance': 'Produk Perawatan',
                    'safety': 'Produk Keamanan',
                    'lighting': 'Produk Pencahayaan',
                    'general': 'Produk Umum'
                };
                const priceRangeNames = {
                    '0-200000': 'Produk Rp 0 - 200rb',
                    '200000-500000': 'Produk Rp 200rb - 500rb',
                    '500000-1000000': 'Produk Rp 500rb - 1jt',
                    '1000000-2000000': 'Produk Rp 1jt - 2jt',
                    '2000000+': 'Produk Rp 2jt+'
                };
                let titleText = 'Produk Unggulan';
                if (searchInput !== '') {
                    titleText = `Hasil Pencarian: "${searchInput}"`;
                } else if (categoryFilter !== 'all') {
                    titleText = categoryNames[categoryFilter] || titleText;
                } else if (priceFilter !== 'all') {
                    titleText = priceRangeNames[priceFilter] || titleText;
                }
                sectionTitle.textContent = `${titleText} (${count} produk)`;
            }

            function displayNoProductsMessage() {
                const productsGrid = document.getElementById('productsGrid');
                if (!productsGrid) return;
                const noProductsMessage = document.createElement('div');
                noProductsMessage.className = 'no-products-message';
                noProductsMessage.innerHTML =
                    `<i class="fas fa-search"></i><h3>Tidak ada produk yang ditemukan</h3><p>Coba kata kunci lain atau reset filter</p>`;
                productsGrid.appendChild(noProductsMessage);
            }

            // --- FUNGSI MODAL & WHATSAPP ---
            // Jadikan fungsi ini global agar bisa diakses oleh atribut onclick pada HTML
            window.showProductDetail = function(productId) {
                const productCard = document.querySelector(`.product-card[data-id="${productId}"]`);
                if (!productCard) return;

                const modal = document.getElementById('detailModal');
                const modalBody = document.getElementById('detailModalBody');

                const data = {
                    name: productCard.getAttribute('data-name'),
                    price: parseInt(productCard.getAttribute('data-price')),
                    description: productCard.getAttribute('data-description'),
                    category: productCard.getAttribute('data-category'),
                    image: productCard.getAttribute('data-image')
                };

                const formattedPrice = `Rp ${new Intl.NumberFormat('id-ID').format(data.price)}`;
                const categoryColors = {
                    'interior': '#8e44ad',
                    'exterior': '#e74c3c',
                    'electronics': '#3498db',
                    'maintenance': '#27ae60',
                    'safety': '#34495e',
                    'lighting': '#f39c12',
                    'general': '#95a5a6'
                };
                const categoryColor = categoryColors[data.category.toLowerCase()] || '#95a5a6';

                let detailHTML = `
                    <div class="product-detail-container">
                        <div class="product-detail-image">
                            ${data.image ? `<img src="${data.image}" alt="${data.name}" class="detail-product-img">` : '<div class="detail-no-image"><i class="fas fa-image"></i></div>'}
                        </div>
                        <div class="product-basic-info">
                            <div class="product-detail-category" style="background-color: ${categoryColor};"><i class="fas fa-tag"></i> ${data.category}</div>
                            <h3 class="product-detail-title">${data.name}</h3>
                            <div class="product-detail-price">${formattedPrice}</div>
                        </div>
                        <div class="product-detail-info">
                            <div class="product-detail-description"><h4>Deskripsi Produk</h4><p>${data.description}</p></div>
                            <div class="product-features"><h4><i class="fas fa-check-circle"></i> Keunggulan Produk</h4>
                                <div class="features-grid">
                                    <div class="feature-item"><i class="fas fa-thumbs-up"></i><span>Kualitas Premium</span></div>
                                    <div class="feature-item"><i class="fas fa-tools"></i><span>Mudah Dipasang</span></div>
                                    <div class="feature-item"><i class="fas fa-clock"></i><span>Tahan Lama</span></div>
                                    <div class="feature-item"><i class="fas fa-award"></i><span>Bergaransi</span></div>
                                </div>
                            </div>
                            <div class="product-detail-action">
                                <button class="btn btn-whatsapp btn-detail-order" onclick="orderViaWhatsApp(${productId})">
                                    <i class="fab fa-whatsapp"></i><span>Pesan Sekarang</span>
                                    <div class="btn-shine"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                modalBody.innerHTML = detailHTML;
                modal.classList.add('active');
            }

            // Jadikan fungsi ini global
            window.closeDetailModal = function() {
                document.getElementById('detailModal').classList.remove('active');
            }

            // Jadikan fungsi ini global
            window.orderViaWhatsApp = function(productId) {
                const productCard = document.querySelector(`.product-card[data-id="${productId}"]`);
                if (!productCard) return;
                const productName = productCard.getAttribute('data-name');
                const productPrice = parseInt(productCard.getAttribute('data-price'));
                const formattedPrice = `Rp ${new Intl.NumberFormat('id-ID').format(productPrice)}`;
                const phoneNumber = '6285273147673';
                const message =
                    `Halo AutoParts\n\nSaya tertarik untuk memesan produk:\n📦 *${productName}*\n💰 Harga: ${formattedPrice}\n\nBisakah Anda berikan informasi lebih lanjut mengenai:\n- Ketersediaan stock\n- Estimasi pengiriman\n- Metode pembayaran\n\nTerima kasih!`;
                const encodedMessage = encodeURIComponent(message);
                const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                window.open(whatsappURL, '_blank');
            }

            // --- SETUP EVENT LISTENERS & ANIMASI ---
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
                                index === 1 ? 'opacity(0)' : 'rotate(-45deg) translate(7px, -6px)';
                        });
                    });
                }

                document.getElementById('detailModal').addEventListener('click', (e) => {
                    if (e.target.id === 'detailModal') {
                        closeDetailModal();
                    }
                });

                // Perbaikan: Hapus event listener di sini karena sudah ada onclick di HTML
                // document.querySelectorAll('.product-card .show-modal').forEach(button => {
                //     ...
                // });
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
                if (header) {
                    if (scrollTop > lastScrollTop && scrollTop > 100) {
                        header.style.transform = 'translateY(-100%)';
                    } else {
                        header.style.transform = 'translateY(0)';
                    }
                }
                lastScrollTop = scrollTop;
            });

            // Panggil semua fungsi utama
            startSlider();
            setupEventListeners();
            animateElements();
            setupProductFilters();
            applyFilters();
        });
    </script>
</body>

</html>
