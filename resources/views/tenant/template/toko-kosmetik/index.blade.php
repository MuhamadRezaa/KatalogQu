{{--
====================================================================================================
| KONTEN DINAMIS DARI DATABASE                                                                     |
====================================================================================================
| Halaman ini dikelola dari Admin Panel. Termasuk info toko, banner, kategori, dan produk.         |
====================================================================================================
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ $userStore->store_logo ? asset('storage/' . $userStore->store_logo) : asset('assets/images/katalogqu_icon.png') }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'Toko Kosmetik' }} - E-Katalog Premium</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- CSS dari file eksternal akan digunakan, pastikan path-nya benar --}}
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-kosmetik/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if ($userStore->store_logo)
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="Logo" class="brand-logo me-2"
                        style="height: 30px; border-radius: 50%;">
                @else
                    <div class="brand-icon"><i class="fas fa-gem"></i></div>
                @endif
                <span class="brand-text">{{ $userStore->store_name ?? 'Beauty Store' }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span
                    class="navbar-toggler-icon"></span></button>
        </div>
    </nav>

    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            @if ($banners->count() > 0)
                <div class="carousel-indicators">
                    @foreach ($banners as $index => $banner)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"></button>
                    @endforeach
                </div>
            @endif
            <div class="carousel-inner">
                @forelse ($banners as $index => $banner)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="hero-slide">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="hero-content">
                                            <h1 class="hero-title">{{ $banner->title }}</h1>
                                            <p class="hero-subtitle">{{ $banner->subtitle }}</p>
                                            @if ($banner->link)
                                                <a href="{{ $banner->link }}"
                                                    class="btn btn-primary mt-3">{{ $banner->button_text ?? 'Lihat Sekarang' }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="hero-image">
                                            <img src="{{ route('tenant.asset', ['path' => $banner->image_url]) }}"
                                                alt="{{ $banner->title }}" class="img-fluid"
                                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=80';">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="hero-slide">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="hero-content">
                                            <h1 class="hero-title">Selamat Datang di {{ $userStore->store_name }}</h1>
                                            <p class="hero-subtitle">Temukan produk kecantikan terbaik untuk Anda.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="hero-image">
                                            <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?auto=format&fit=crop&w=800&q=80"
                                                alt="Cosmetics Collection" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            @if ($banners->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                    data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
            @endif
        </div>
    </section>

    @if ($featuredProducts->count() > 0)
        <section class="featured-products-section py-5 bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="section-title">Produk Unggulan</h2>
                        <p class="section-subtitle">Produk unggulan pilihan terbaik untuk Anda</p>
                    </div>
                </div>
                <div class="swiper-container featured-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($featuredProducts as $product)
                            <div class="swiper-slide">
                                <div class="product-card" data-product-id="{{ $product->id }}">
                                    @if ($product->is_new)
                                        <div class="badge-new">Baru</div>
                                    @endif
                                    <div class="product-image-container"><img
                                            src="{{ $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png') }}"
                                            alt="{{ $product->name }}" class="product-image"></div>
                                    <div class="product-info">
                                        <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}
                                        </p>
                                        <h5 class="product-title">{{ $product->name }}</h5>
                                        <div class="product-price">
                                            <span class="current-price">{{ $product->price_idr }}</span>
                                            @if ($product->old_price_idr)
                                                <span class="old-price">{{ $product->old_price_idr }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <section class="search-filter-section py-5" id="products">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Semua Produk</h2>
                <p class="section-subtitle">Pilih kategori produk yang sesuai dengan selera Anda</p>
            </div>
            <div class="row align-items-center g-3">
                <div class="col-lg-4"><input type="text" id="searchInput" class="form-control filter-control"
                        placeholder="Cari produk..." value="{{ request('search') }}"></div>
                <div class="col-lg-2 col-md-3"><select id="categoryFilter" class="form-select filter-control">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select></div>
                <div class="col-lg-2 col-md-3"><select id="priceFilter" class="form-select filter-control">
                        <option value="">Semua Harga</option>
                        @foreach ($priceRanges as $range)
                            <option data-min="{{ $range->min ?? '' }}" data-max="{{ $range->max ?? '' }}"
                                {{ request('price_min') == $range->min && request('price_max') == $range->max ? 'selected' : '' }}>
                                {{ $range->name }}</option>
                        @endforeach
                    </select></div>
                <div class="col-lg-2 col-md-3"><select id="sortFilter" class="form-select filter-control">
                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Terbaru
                        </option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga
                            Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga
                            Tertinggi</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select></div>
                <div class="col-lg-2 col-md-3"><a href="{{ url()->current() }}#products"
                        class="btn btn-outline-secondary w-100">Reset</a></div>
            </div>
        </div>
    </section>

    <section class="products-content-section pt-0 pb-5">
        <div class="container">
            <div class="row g-4" id="productsGrid">
                @forelse ($products as $product)
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card" data-product-id="{{ $product->id }}">
                            @if ($product->discount_percentage)
                                <div class="badge-promo">-{{ $product->discount_percentage }}%</div>
                            @elseif ($product->is_new)
                                <div class="badge-new">Baru</div>
                            @endif
                            <div class="product-image-container"><img
                                    src="{{ $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png') }}"
                                    alt="{{ $product->name }}" class="product-image"></div>
                            <div class="product-info">
                                <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <div class="product-price">
                                    <span class="current-price">{{ $product->price_idr }}</span>
                                    @if ($product->old_price_idr)
                                        <span class="old-price">{{ $product->old_price_idr }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="fs-4 text-muted">Produk tidak ditemukan.</p>
                        <p>Coba ubah kata kunci atau filter Anda.</p><a href="{{ url()->current() }}#products"
                            class="btn btn-primary mt-3">Reset Filter</a>
                    </div>
                @endforelse
            </div>
            <div class="mt-5 d-flex justify-content-center" id="paginationContainer"
                style="display: none !important;">
            </div>
        </div>
    </section>

    <footer id="contact" class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        @if ($userStore->store_logo)
                            <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="Logo"
                                class="footer-logo mb-3" width="150">
                        @else<h4 class="text-white">{{ $userStore->store_name }}</h4>
                        @endif
                        <p class="footer-description">{{ $userStore->store_description }}</p>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6 mb-4 footer-contact-section">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="contact-info">
                        @if ($userStore->store_address)
                            <p class="contact-address">{!! nl2br(e($userStore->store_address)) !!}</p>
                        @endif
                        @if ($userStore->store_email)
                            <p class="contact-email">{{ $userStore->store_email }}</p>
                        @endif
                        @if ($userStore->store_phone)
                            <p class="contact-phone">{{ $userStore->store_phone }}</p>
                        @endif
                        <div class="social-links mt-3">
                            @if ($userStore->facebook_url)
                                <a href="{{ $userStore->facebook_url }}" target="_blank" class="social-link"><i
                                        class="fab fa-facebook"></i></a>
                            @endif
                            @if ($userStore->instagram_url)
                                <a href="{{ $userStore->instagram_url }}" target="_blank" class="social-link"><i
                                        class="fab fa-instagram"></i></a>
                            @endif
                            @if ($userStore->twitter_url)
                                <a href="{{ $userStore->twitter_url }}" target="_blank" class="social-link"><i
                                        class="fab fa-twitter"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="mb-0 small text-white">&copy; {{ date('Y') }} {{ $userStore->store_name }}. Powered
                        by PT. Era Cipta Digital.</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row m-0">
                        <div class="col-lg-6 p-4">
                            <div id="modalCarousel" class="carousel slide">
                                <div class="carousel-inner" id="modalCarouselInner"></div><button
                                    class="carousel-control-prev" type="button" data-bs-target="#modalCarousel"
                                    data-bs-slide="prev"><span
                                        class="carousel-control-prev-icon"></span></button><button
                                    class="carousel-control-next" type="button" data-bs-target="#modalCarousel"
                                    data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                            </div>
                        </div>
                        <div class="col-lg-6 p-4">
                            <h3 id="modalProductName">Nama Produk</h3>
                            <p class="text-muted" id="modalProductCategory">Kategori</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fw-bold me-3" id="modalProductPrice">Rp 0</h4>
                                <h5 class="text-muted text-decoration-line-through" id="modalProductOldPrice">Rp 0
                                </h5>
                            </div>
                            <h5>Deskripsi</h5>
                            <p id="modalProductDescription">Deskripsi produk...</p>
                            <h5>Spesifikasi</h5>
                            <div id="modalProductSpecs"></div>
                            <div class="d-grid mt-4"><a id="chatButton" href="#" target="_blank"
                                    class="btn btn-success btn-lg"><i class="fab fa-whatsapp me-2"></i> Chat Toko</a>
                            </div>
                            <hr>
                            <div id="related-products-section">
                                <h6 class="mb-3">Anda Mungkin Juga Suka</h6>
                                <div id="related-products-container" class="row g-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    @php
        use Illuminate\Pagination\AbstractPaginator;
        $allProducts = $products->getCollection()->merge($featuredProducts);
        $productsForJs = $allProducts
            ->unique('id')
            ->map(function ($product) {
                $images = $product->images
                    ? $product->images
                        ->sortBy('position')
                        ->map(fn($img) => route('tenant.asset', ['path' => ltrim($img->image_url, '/')]))
                        ->values()
                        ->all()
                    : [];
                if ($product->primary_image_src) {
                    array_unshift($images, $product->primary_image_src);
                }
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category_id' => $product->product_category_id,
                    'category' => $product->category->name ?? 'Uncategorized',
                    'price_formatted' => $product->price_idr,
                    'old_price_formatted' => $product->old_price_idr,
                    'description' => $product->description,
                    'specs' => $product->specification,
                    'images' => array_unique($images),
                    'image' => $product->primary_image_src ?: asset('assets/demo/toko-kosmetik/img/placeholder.png'),
                ];
            })
            ->values();
    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const allProductsData = @json($productsForJs);
            const productModal = new bootstrap.Modal(document.getElementById('productModal'));
            const storePhoneNumber = "{{ $userStore->store_phone ?? '' }}";

            if (document.querySelector('.featured-swiper')) {
                new Swiper('.featured-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 3
                        },
                        1024: {
                            slidesPerView: 4
                        }
                    }
                });
            }

            function populateModal(product) {
                if (!product) return;
                document.getElementById('modalProductName').textContent = product.name;
                document.getElementById('modalProductCategory').textContent = product.category;
                document.getElementById('modalProductPrice').textContent = product.price_formatted;
                const oldPriceEl = document.getElementById('modalProductOldPrice');
                oldPriceEl.style.display = product.old_price_formatted ? 'inline' : 'none';
                oldPriceEl.textContent = product.old_price_formatted || '';
                document.getElementById('modalProductDescription').innerHTML = product.description ||
                    'Tidak ada deskripsi.';

                const carouselInner = document.getElementById('modalCarouselInner');
                carouselInner.innerHTML = product.images && product.images.length > 0 ?
                    product.images.map((src, i) =>
                        `<div class="carousel-item ${i === 0 ? 'active' : ''}"><img src="${src}" class="d-block w-100" alt="Gambar produk"></div>`
                    ).join('') :
                    `<div class="carousel-item active"><img src="{{ asset('assets/demo/toko-kosmetik/img/placeholder.png') }}" class="d-block w-100" alt="Placeholder"></div>`;

                const specsContainer = document.getElementById('modalProductSpecs');
                specsContainer.innerHTML = '';
                if (product.specs && Object.keys(product.specs).length > 0) {
                    let listHtml = '<ul class="list-unstyled">';
                    for (const [key, value] of Object.entries(product.specs)) {
                        listHtml += `<li><strong>${key}:</strong> ${value}</li>`;
                    }
                    specsContainer.innerHTML = listHtml + '</ul>';
                } else {
                    specsContainer.innerHTML = '<p>Tidak ada spesifikasi.</p>';
                }

                const message = `Halo, saya tertarik dengan produk "${product.name}".`;
                document.getElementById('chatButton').href =
                    `https://wa.me/${storePhoneNumber}?text=${encodeURIComponent(message)}`;

                // Populate Related Products
                const relatedContainer = document.getElementById('related-products-container');
                relatedContainer.innerHTML = '';
                const relatedProducts = allProductsData.filter(p => p.category_id === product.category_id && p
                    .id !== product.id).slice(0, 3);

                if (relatedProducts.length > 0) {
                    document.getElementById('related-products-section').style.display = 'block';
                    relatedProducts.forEach(rp => {
                        const col = document.createElement('div');
                        col.className = 'col-4';
                        col.innerHTML = `
                            <div class="related-product-card" data-product-id="${rp.id}">
                                <img src="${rp.image}" alt="${rp.name}" class="img-fluid">
                                <div class="related-product-title">${rp.name}</div>
                            </div>
                        `;
                        relatedContainer.appendChild(col);
                    });
                } else {
                    document.getElementById('related-products-section').style.display = 'none';
                }
            }

            function setupProductCardListeners() {
                document.querySelectorAll('.product-card, .related-product-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const productId = parseInt(this.dataset.productId, 10);
                        const product = allProductsData.find(p => p.id === productId);
                        populateModal(product);
                        if (!productModal._isShown) productModal.show();
                    });
                });
            }
            setupProductCardListeners();

            // Re-setup listeners for related products after they are created
            document.getElementById('related-products-container').addEventListener('click', function(e) {
                const card = e.target.closest('.related-product-card');
                if (card) {
                    const productId = parseInt(card.dataset.productId, 10);
                    const product = allProductsData.find(p => p.id === productId);
                    populateModal(product);
                }
            });

            // CLIENT-SIDE FILTERING - NO PAGE RELOAD
            const filterControls = document.querySelectorAll('.filter-control');
            let debounceTimer;

            function filterProducts() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                const categoryId = document.getElementById('categoryFilter').value;
                const sortBy = document.getElementById('sortFilter').value;
                const priceFilter = document.getElementById('priceFilter').options[document.getElementById(
                    'priceFilter').selectedIndex];
                const priceMin = priceFilter.dataset.min ? parseFloat(priceFilter.dataset.min) : null;
                const priceMax = priceFilter.dataset.max ? parseFloat(priceFilter.dataset.max) : null;

                let filtered = allProductsData.filter(product => {
                    // Filter berdasarkan pencarian
                    const matchesSearch = !searchTerm ||
                        product.name.toLowerCase().includes(searchTerm) ||
                        product.category.toLowerCase().includes(searchTerm);

                    // Filter berdasarkan kategori
                    const matchesCategory = !categoryId || product.category_id == categoryId;

                    // Filter berdasarkan harga (perlu parsing dari format Rp)
                    let matchesPrice = true;
                    if (priceMin !== null || priceMax !== null) {
                        const priceStr = product.price_formatted.replace(/[^0-9]/g, '');
                        const price = parseFloat(priceStr);
                        matchesPrice = (!priceMin || price >= priceMin) && (!priceMax || price <= priceMax);
                    }

                    return matchesSearch && matchesCategory && matchesPrice;
                });

                // Sorting
                filtered.sort((a, b) => {
                    switch (sortBy) {
                        case 'price_low':
                            const priceA = parseFloat(a.price_formatted.replace(/[^0-9]/g, ''));
                            const priceB = parseFloat(b.price_formatted.replace(/[^0-9]/g, ''));
                            return priceA - priceB;
                        case 'price_high':
                            const priceA2 = parseFloat(a.price_formatted.replace(/[^0-9]/g, ''));
                            const priceB2 = parseFloat(b.price_formatted.replace(/[^0-9]/g, ''));
                            return priceB2 - priceA2;
                        case 'name':
                            return a.name.localeCompare(b.name);
                        case 'newest':
                        default:
                            return b.id - a.id;
                    }
                });

                displayProducts(filtered);
            }

            function displayProducts(products) {
                const productsGrid = document.getElementById('productsGrid');

                if (products.length === 0) {
                    productsGrid.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <p class="fs-4 text-muted">Produk tidak ditemukan.</p>
                            <p>Coba ubah kata kunci atau filter Anda.</p>
                            <button class="btn btn-primary mt-3" onclick="resetFilters()">Reset Filter</button>
                        </div>
                    `;
                    return;
                }

                productsGrid.innerHTML = products.map(product => `
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card" data-product-id="${product.id}">
                            ${product.is_new ? '<div class="badge-new">Baru</div>' : ''}
                            <div class="product-image-container">
                                <img src="${product.image}" alt="${product.name}" class="product-image">
                            </div>
                            <div class="product-info">
                                <p class="product-category">${product.category}</p>
                                <h5 class="product-title">${product.name}</h5>
                                <div class="product-price">
                                    <span class="current-price">${product.price_formatted}</span>
                                    ${product.old_price_formatted ? `<span class="old-price">${product.old_price_formatted}</span>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');

                // Re-setup product card listeners untuk produk yang baru ditampilkan
                setupProductCardListeners();
            }

            // Global reset function
            window.resetFilters = function() {
                document.getElementById('searchInput').value = '';
                document.getElementById('categoryFilter').value = '';
                document.getElementById('priceFilter').value = '';
                document.getElementById('sortFilter').value = 'newest';
                filterProducts();
            }

            // Event listeners untuk filtering tanpa reload
            filterControls.forEach(control => {
                control.addEventListener('change', filterProducts);
                if (control.id === 'searchInput') {
                    control.addEventListener('input', () => {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(filterProducts, 300);
                    });
                }
            });

            // PERBAIKAN: Panggil fungsi filter saat halaman dimuat
            // Ini akan memastikan produk langsung tampil saat pertama kali membuka halaman.
            filterProducts();
        });
    </script>
</body>

</html>
