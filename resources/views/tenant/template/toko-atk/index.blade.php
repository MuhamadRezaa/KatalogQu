<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'E-Katalog ATK' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-atk/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <img src="{{ $userStore->store_logo ? asset('storage/' . $userStore->store_logo) : asset('assets/demo/toko-atk/images/20250819_1904_Logo_E-Catalog_Alat_Tulis_simple_compose_01k313dfh6e1xtcnhs1atfdnt3-removebg-preview.png') }}"
                        alt="Logo Toko" class="logo-image">
                    <div class="header-text">
                        <h1>{{ $userStore->store_name ?? 'Tinta Cipta' }}</h1>
                        <p>{{ $userStore->store_description ?? 'E-Katalog ATK - Pilihan lengkap alat tulis kantor berkualitas' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="carousel-container">
        <div class="carousel">
            {{-- Carousel items can be made dynamic from a $banners variable if needed --}}
            @forelse ($banners as $banner)
                <div class="carousel-slide">
                    <img src="{{ route('tenant.asset', ['path' => $banner->image_url]) }}"
                        alt="{{ $banner->title ?? 'Banner' }}">
                    <div class="carousel-content">
                        <h3>{{ $banner->title }}</h3>
                        <p>{{ $banner->subtitle }}</p>
                    </div>
                </div>
            @empty
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                        alt="Koleksi Alat Tulis Terlengkap">
                    <div class="carousel-content">
                        <h3>Banner Toko {{ $userStore->store_name ?? 'Our Store' }}</h3>
                        <p>Temukan berbagai macam alat tulis berkualitas untuk kebutuhan kantor dan sekolah</p>
                    </div>
                </div>
            @endforelse
        </div>
        <button class="carousel-btn prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-btn next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
        <div class="carousel-dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <div class="container">
        <div class="category-filter">
            <button class="category-btn active" data-category="all">Semua Produk</button>
            @if (isset($categories))
                @foreach ($categories as $category)
                    <button class="category-btn" data-category="{{ $category->slug }}">{{ $category->name }}</button>
                @endforeach
            @endif
            <button class="category-btn" data-category="lainnya">Lainnya</button>
        </div>

        <div class="search-filter-section">
            <div class="section-header">
                <h3>🔍 Cari & Filter Produk</h3>
                <p>Temukan produk alat tulis yang Anda butuhkan dengan mudah</p>
            </div>
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Ketik nama produk yang dicari...">
                </div>
            </div>
            <div class="filter-container">
                <div class="filter-group">
                    <label for="sort-filter">Urutkan Berdasarkan:</label>
                    <select id="sort-filter">
                        <option value="default">Default</option>
                        <option value="name-asc">Nama A-Z</option>
                        <option value="name-desc">Nama Z-A</option>
                        <option value="price-asc">Harga Terendah</option>
                        <option value="price-desc">Harga Tertinggi</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="price-filter">Filter Rentang Harga:</label>
                    <select id="price-filter">
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
                </div>
            </div>
        </div>

        <div class="products-grid" id="products-grid">
            @forelse ($products as $product)
                @php $src = $product->primary_image_src; @endphp
                <div class="product-card" data-product-id="{{ $product->id }}"
                    data-category="{{ $product->category->slug ?? 'lainnya' }}" data-name="{{ $product->name }}"
                    data-price="{{ $product->price }}" data-image="{{ $src }}">
                    <div class="product-image">
                        <img src="{{ $src }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="product-actions">
                            <button class="btn-detail" onclick="showDetail(this)">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                            <button class="btn-whatsapp"
                                onclick="chatWhatsApp('{{ $product->name }}', '{{ number_format($product->price, 0, ',', '.') }}')">
                                <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-products">Belum ada produk yang tersedia.</p>
            @endforelse
        </div>

        <div id="product-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modal-body"></div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="{{ $userStore->store_logo ? asset('storage/' . $userStore->store_logo) : asset('assets/demo/toko-atk/images/20250819_1904_Logo_E-Catalog_Alat_Tulis_simple_compose_01k313dfh6e1xtcnhs1atfdnt3-removebg-preview.png') }}"
                    alt="Logo Toko" class="footer-logo">
            </div>
            <div class="footer-section">
                <h4>Kontak</h4>
                <div class="contact-info">
                    <p>{{ $userStore->store_address ?? 'Alamat belum diatur' }}</p>
                    <br>
                    <p>{{ $userStore->store_email ?? 'email@toko.com' }}</p>
                    <p>{{ $userStore->store_phone ?? '08123456789' }}</p>
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

    @php
        use Illuminate\Pagination\AbstractPaginator;

        $raw = $products instanceof AbstractPaginator ? $products->getCollection() : collect($products ?? []);

        $productsForJs = $raw
            ->map(function ($product) {
                // Ambil specs aman (mendukung berbagai format)
                $rawSpecs = $product->specs ?? ($product->specification ?? null);

                if (is_string($rawSpecs)) {
                    $specs = json_decode($rawSpecs, true) ?: [];
                } elseif (is_array($rawSpecs)) {
                    $specs = $rawSpecs;
                } elseif (is_object($rawSpecs)) {
                    $specs = (array) $rawSpecs;
                } else {
                    $specs = [];
                }

                // Kumpulan gambar (opsional, kalau kamu punya relasi images)
                $imgs = $product->images
                    ? $product->images
                        ->sortBy('position')
                        ->map(
                            fn($img) => [
                                'image_url' => route('tenant.asset', ['path' => ltrim($img->image_url, '/')]),
                            ],
                        )
                        ->values()
                        ->all()
                    : [];

                $primary =
                    $product->primary_image_src ?:
                    ($product->image
                        ? route('tenant.asset', ['path' => ltrim($product->image, '/')])
                        : null);

                if ($primary) {
                    $already = collect($imgs)->contains(fn($x) => rtrim($x['image_url'], '/') === rtrim($primary, '/'));
                    if (!$already) {
                        array_unshift($imgs, ['image_url' => $primary]);
                    }
                }

                $cat = $product->category;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'old_price' => $product->old_price,
                    'description' => $product->description,
                    'notes' => $product->notes,
                    'stock' => $product->stock,
                    'discount_percentage' => $product->discount_percentage,
                    'specs' => $specs, // ← penting
                    'category' => $cat ? ['id' => $cat->id, 'name' => $cat->name, 'slug' => $cat->slug] : null,
                    'productimgs' => $imgs,
                ];
            })
            ->values();
    @endphp
    <script>
        window.productsData = @json($productsForJs);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // PERUBAHAN UTAMA: Data detail produk (productDetails) dihapus dari sini.
            const productsGrid = document.getElementById('products-grid');
            const ALL_CARDS = Array.from(productsGrid.querySelectorAll('.product-card'));
            // --- FUNGSI INTERAKSI ---
            function renderSpecs(specs) {

                let entries = [];

                if (Array.isArray(specs)) {
                    specs.forEach(item => {
                        if (item && typeof item === 'object') {
                            if ('key' in item && 'value' in item) {
                                entries.push([item.key, item.value]);
                            } else {
                                Object.entries(item).forEach(([k, v]) => {
                                    if (v !== null && v !== undefined && String(v).trim() !== '') {
                                        entries.push([k, v]);
                                    }
                                });
                            }
                        } else if (typeof item === 'string') {
                            entries.push([null, item]);
                        }
                    });
                } else if (specs && typeof specs === 'object') {
                    entries = Object.entries(specs).filter(([_, v]) => v !== null && v !== undefined && String(v)
                        .trim() !== '');
                }

                if (entries.length === 0) {
                    return '<li class="empty-spec">Tidak ada spesifikasi</li>';
                }

                return entries.map(([k, v]) => {
                    if (k === null) {
                        // list biasa
                        return `<li>${v}</li>`;
                    }
                    return `<li><strong>${k}</strong>: ${v}</li>`;
                }).join('');
            }

            function showDetail(button) {
                const card = button.closest('.product-card');
                const id = parseInt(card.dataset.productId, 10);
                const p = (window.productsData || []).find(x => x.id === id);
                if (!p) return;

                const image = (p.productimgs && p.productimgs.length) ? p.productimgs[0].image_url : card.dataset
                    .image;
                const harga = (p.price != null) ? Number(p.price).toLocaleString('id-ID') : card.dataset.price;

                const modalBody = document.getElementById('modal-body');
                modalBody.innerHTML = `
                <div class="modal-product">
                    <img src="${image}" alt="${p.name}" class="modal-image">
                    <div class="modal-info">
                    <h2><i class="fas fa-box"></i> ${p.name}</h2>
                    <p class="modal-price"><i class="fas fa-tag"></i> Rp ${harga}</p>
                    <p class="modal-description">${p.description || ''}</p>
                    <h4><i class="fas fa-list"></i> Spesifikasi:</h4>
                    <ul class="modal-specs">
                        ${renderSpecs(p.specs)}
                    </ul>
                    <div class="modal-actions">
                        <button class="btn-whatsapp" onclick="chatWhatsApp('${p.name}', '${harga}')">
                        <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                        </button>
                    </div>
                    </div>
                </div>
                `;
                document.getElementById('product-modal').style.display = 'block';
            }


            function closeModal() {
                document.getElementById('product-modal').style.display = 'none';
            }

            function chatWhatsApp(productName, price) {
                const phoneNumber = '{{ $userStore->store_phone ?? '628123456789' }}'; // Ambil nomor dari backend
                const message =
                    `Halo, saya tertarik dengan produk ${productName} dengan harga Rp ${price}. Bisa info lebih lanjut?`;
                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            }

            // --- FUNGSI FILTER & SORT ---

            function applyFilters() {
                const categoryBtnActive = document.querySelector('.category-btn.active');
                const category = categoryBtnActive ? categoryBtnActive.dataset.category : 'all';

                const searchTerm = document.getElementById('search-input').value.toLowerCase();
                const priceFilterSelect = document.getElementById('price-filter');
                const selectedOption = (priceFilterSelect && priceFilterSelect.selectedOptions[0]) ?
                    priceFilterSelect.selectedOptions[0] : {
                        value: 'all'
                    };
                const sortValue = document.getElementById('sort-filter').value;

                // ⬇️ selalu pakai snapshot semua kartu
                const productCards = ALL_CARDS.slice();

                // 1) Filter
                let visibleCards = productCards.filter(card => {
                    const cardCategory = card.dataset.category || 'lainnya';
                    const cardName = (card.dataset.name || '').toLowerCase();
                    const cardPrice = parseInt(card.dataset.price || '0', 10);

                    const categoryMatch = category === 'all' || cardCategory === category;
                    const searchMatch = cardName.includes(searchTerm);

                    let priceMatch = true;
                    if (selectedOption.value !== 'all') {
                        const min = selectedOption.dataset.min ? parseInt(selectedOption.dataset.min, 10) :
                            0;
                        const max = selectedOption.dataset.max ? parseInt(selectedOption.dataset.max, 10) :
                            null;
                        priceMatch = (max === null) ? (cardPrice >= min) : (cardPrice >= min && cardPrice <=
                            max);
                    }

                    return categoryMatch && searchMatch && priceMatch;
                });

                // 2) Sort
                visibleCards.sort((a, b) => {
                    const nameA = a.dataset.name || '';
                    const nameB = b.dataset.name || '';
                    const priceA = parseInt(a.dataset.price || '0', 10);
                    const priceB = parseInt(b.dataset.price || '0', 10);

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
                            return 0; // default "Default"
                    }
                });

                // 3) Render: replaceChildren lebih aman & cepat
                if (visibleCards.length > 0) {
                    productsGrid.replaceChildren(...visibleCards);
                } else {
                    productsGrid.replaceChildren();
                    const p = document.createElement('p');
                    p.className = 'no-products';
                    p.textContent = 'Produk tidak ditemukan.';
                    productsGrid.appendChild(p);
                }
            }

            // --- EVENT LISTENERS ---

            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const prev = document.querySelector('.category-btn.active');
                    if (prev) prev.classList.remove('active');
                    this.classList.add('active');
                    applyFilters();
                });
            });

            document.getElementById('search-input').addEventListener('keyup', applyFilters);
            document.getElementById('sort-filter').addEventListener('change', applyFilters);
            document.getElementById('price-filter').addEventListener('change', applyFilters);

            // Initialize filters on page load
            applyFilters();

            // --- Panggil fungsi global agar bisa diakses dari onclick HTML ---
            window.showDetail = showDetail;
            window.closeModal = closeModal;
            window.chatWhatsApp = chatWhatsApp;

            window.onclick = function(event) {
                const modal = document.getElementById('product-modal');
                if (event.target == modal) {
                    closeModal();
                }
            }

            // Carousel Functionality
            let currentSlideIndex = 0;
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.dot');
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));
                slides[index].classList.add('active');
                dots[index].classList.add('active');
            }

            function changeSlide(direction) {
                currentSlideIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
                showSlide(currentSlideIndex);
            }

            function currentSlide(index) {
                currentSlideIndex = index - 1;
                showSlide(currentSlideIndex);
            }

            let autoSlideInterval = setInterval(() => changeSlide(1), 5000);

            // --- Panggil fungsi global carousel ---
            window.changeSlide = changeSlide;
            window.currentSlide = currentSlide;

            showSlide(0); // Initialize carousel
        });

        // Checkout bubble (jika ada) bisa ditambahkan di sini
        // Contoh: document.getElementById('checkoutBubble').addEventListener(...)
    </script>
</body>

</html>
