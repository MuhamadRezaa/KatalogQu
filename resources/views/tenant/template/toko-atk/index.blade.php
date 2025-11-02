<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'E-Katalog ATK' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/toko-atk/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Header styles - sama persis dengan demo */
        header {
            background: linear-gradient(135deg, #8d6e63, #a1887f, #bcaaa4, #d7ccc8) !important;
            color: white !important;
            padding: 0.5rem 0 !important;
            margin-bottom: 0 !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3) !important;
            position: relative;
            overflow: hidden;
        }

        header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-content {
            display: flex !important;
            justify-content: flex-start !important;
            align-items: center !important;
        }

        .logo-section {
            display: flex !important;
            align-items: center !important;
            gap: 1rem !important;
        }

        .logo-image {
            height: 80px !important;
            width: auto !important;
            border-radius: 15px !important;
        }

        .header-text h1 {
            font-size: 1.5rem !important;
            margin-bottom: 0.3rem !important;
            font-weight: 600 !important;
            color: white !important;
        }

        .header-text p {
            font-size: 0.95rem !important;
            opacity: 0.9 !important;
            color: white !important;
            margin: 0 !important;
        }

        .related-products {
            margin-top: 2rem;
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
        }

        .related-products h4 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .related-products h4 i {
            color: white;
            margin-right: 0.5rem;
        }

        .related-products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .related-product-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
        }

        .related-product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #8d6e63;
        }

        .related-product-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .related-product-card h5 {
            font-size: 0.9rem;
            margin: 0.5rem 0;
            color: #333;
            line-height: 1.3;
            max-height: 2.6em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .related-product-card p {
            font-size: 0.9rem;
            font-weight: bold;
            color: #8d6e63;
            margin: 0;
        }

        /* Pagination styles */
        .pagination-container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .pagination-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .pagination-btn {
            padding: 0.5rem 1.5rem;
            border: 1px solid #ddd;
            background: #e0e0e0;
            color: #333;
            border-radius: 25px; 
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #8d6e63;
            color: white;
            border-color: #8d6e63;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-numbers {
            display: flex;
            gap: 0.5rem;
        }

        .page-number {
            padding: 0.5rem;
            width: 2.5rem; /* tambah width tetap */
            height: 2.5rem; /* tambah height tetap */
            border: none; /* hilangkan border */
            background: transparent;
            color: #666;
            border-radius: 50%; /* ← ubah jadi bulat sempurna */
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            display: flex; /* untuk center text */
            align-items: center;
            justify-content: center;
        }

        .page-number:hover {
            background: #8d6e63;
            color: white;
            border-color: #8d6e63;
        }

        .page-number.active {
            background: #8d6e63;
            color: white;
            border-color: #8d6e63;
        }

        .page-ellipsis {
            padding: 0.5rem 0.75rem;
            color: #666;
        }

        /* Additional styles for promo badge in related products */
        .related-product-card .promo-badge {
            font-size: 10px;
            padding: 2px 6px;
            top: 4px;
            left: 4px;
        }

        .related-price-section {
            margin-bottom: 0.5rem;
        }

        .related-old-price {
            font-size: 0.8rem;
            color: #999;
            text-decoration: line-through;
            font-weight: 400;
            margin: 0;
        }

        /* Footer brand styles */
        .brand-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .brand-description {
            color: white !important;
            line-height: 1.6;
            max-width: 300px;
        }

        @media (max-width: 768px) {
            .related-products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .related-products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>


</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="Logo {{ $userStore->store_name ?? 'Toko ATK' }}" class="logo-image">
                    <div class="header-text">
                        <h1>{{ $userStore->store_name ?? 'Tinta Cipta' }}</h1>
                        <p>{{ $userStore->store_description ?? 'E-Katalog ATK - Pilihan lengkap alat tulis kantor berkualitas' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Carousel Section -->
    <div class="carousel-container">
        <div class="carousel">
            @forelse ($banners as $banner)
                <div class="carousel-slide">
                    <img src="{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                        alt="{{ $banner->title ?? 'Banner' }}">
                    <div class="carousel-content">
                        <h3>{{ $banner->title }}</h3>
                        <p>{{ $banner->subtitle }}</p>
                    </div>
                </div>
            @empty
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
            @endforelse
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
                <h3>Cari & Filter Produk</h3>
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
                    <label for="subcategory-filter">Filter Sub Kategori:</label>
                    <select id="subcategory-filter">
                        <option value="all">Semua Sub Kategori</option>
                        @php
                            if (isset($subCategories)) {
                                echo '<!-- Debug: ' . count($subCategories) . " subcategories found -->\n";
                            } else {
                                echo "<!-- Debug: subCategories variable is not set -->\n";
                            }
                        @endphp
                        @if (isset($subCategories) && $subCategories->isNotEmpty())
                            @foreach ($subCategories as $subcategory)
                                <option value="{{ $subcategory->slug }}">{{ $subcategory->name }}</option>
                            @endforeach
                        @else
                            @php
                                if (isset($subCategories)) {
                                    echo '<!-- Debug: subCategories is set but empty -->';
                                } else {
                                    echo '<!-- Debug: subCategories is not set -->';
                                }
                                if (isset($subcategories)) {
                                    echo '<!-- Debug: lowercase subcategories is set with ' .
                                        count($subcategories) .
                                        ' items -->';
                                }
                            @endphp
                            <option value="all">Semua Sub Kategori</option>
                        @endif
                    </select>
                </div>
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
                    data-category="{{ $product->category->slug ?? 'lainnya' }}"
                    data-subcategory="{{ optional($product->subCategory)->slug ?? 'none' }}"
                    data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                    data-image="{{ $src }}">
                    <div class="product-image">
                        @if($product->is_promo)
                            <span class="promo-badge">PROMO</span>
                        @endif
                        <img src="{{ $src }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <div class="price-section">
                            <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            @if ($product->old_price && $product->old_price > $product->price)
                                <p class="old-price">Rp {{ number_format($product->old_price, 0, ',', '.') }}</p>
                            @endif
                        </div>
                        <div class="product-actions">
                            <button class="btn-detail" onclick="showDetail(this)">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-products">Belum ada produk yang tersedia.</p>
            @endforelse
        </div>

        <div class="pagination-container">
            <div class="pagination-controls">
                <button id="atkPrevBtn" class="pagination-btn" onclick="atkPreviousPage()" disabled>
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <div id="atkPageNumbers" class="page-numbers"></div>
                <button id="atkNextBtn" class="pagination-btn" onclick="atkNextPage()">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div id="product-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modal-body"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <!-- Column 1: Brand -->
        <div class="footer-brand">
            <div class="brand-info">
                <div class="brand-header">
                    <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="{{ $userStore->store_name ?? 'Toko ATK' }} Logo" class="footer-logo">
                    <span class="brand-name">{{ $userStore->store_name ?? 'Toko ATK' }}</span>
                </div>
                <p class="brand-description">
                    {{ $userStore->store_description ?? 'Solusi lengkap alat tulis kantor berkualitas tinggi' }}
                </p>
            </div>
        </div>

        <!-- Column 2: Contact -->
        <div class="footer-section">
            <h4>Kontak</h4>
            <div class="contact-info">
                <p>{{ $userStore->store_address ?? 'Jl. Cysca Raya II, Taman Setia Budi Indah, Blok VV No.172 Kompleks, Asam Kumbang, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20133' }}</p>
                <br>
                <p>{{ $userStore->store_email ?? 'ptenciptadigital@gmail.com' }}</p>
                <p>{{ $userStore->store_phone ?? '+62 815-7250-5989' }}</p>
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
                                'image_url' => route('tenant.asset.domain', ['path' => ltrim($img->image_url, '/')]),
                            ],
                        )
                        ->values()
                        ->all()
                    : [];

                $primary =
                    $product->primary_image_src ?:
                    ($product->image
                        ? route('tenant.asset.domain', ['path' => ltrim($product->image, '/')])
                        : null);

                if ($primary) {
                    $already = collect($imgs)->contains(fn($x) => rtrim($x['image_url'], '/') === rtrim($primary, '/'));
                    if (!$already) {
                        array_unshift($imgs, ['image_url' => $primary]);
                    }
                }

                $cat = $product->category;
                $subcat = $product->sub_category;

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
                    'is_promo' => $product->is_promo, // Tambahkan ini
                    'specs' => $specs, // ← penting
                    'category' => $cat ? ['id' => $cat->id, 'name' => $cat->name, 'slug' => $cat->slug] : null,
                    'subcategory' => $subcat
                        ? ['id' => $subcat->id, 'name' => $subcat->name, 'slug' => $subcat->slug]
                        : null,
                    'productimgs' => $imgs,
                ];
            })
            ->values();
    @endphp
    <script>
        window.productsData = @json($productsForJs);
        window.categorySubcategoryMap = @json($categorySubcategoryMap ?? []);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // PERUBAHAN UTAMA: Data detail produk (productDetails) dihapus dari sini.
            const productsGrid = document.getElementById('products-grid');
            const ALL_CARDS = Array.from(productsGrid.querySelectorAll('.product-card'));
            // --- FUNGSI INTERAKSI ---
            function renderRelatedProducts(product) {
                if (!product || !product.category) return '';

                // Find products in the same category, excluding the current product
                const related = (window.productsData || [])
                    .filter(p =>
                        p.id !== product.id &&
                        p.category &&
                        p.category.id === product.category.id
                    );

                // Shuffle and take up to 3 (sama seperti toko-komputer)
                const shuffledRelated = related.sort(() => 0.5 - Math.random());
                const selectedRelated = shuffledRelated.slice(0, 3);

                if (selectedRelated.length === 0) {
                    return '<p class="text-sm text-gray-500 col-span-3">Tidak ada produk serupa.</p>';
                }

                return selectedRelated.map(p => {
                    const image = (p.productimgs && p.productimgs.length) ? p.productimgs[0].image_url : '';
                    const harga = (p.price != null) ? Number(p.price).toLocaleString('id-ID') : '0';
                    const promoBadge = p.is_promo ? '<span class="promo-badge">PROMO</span>' : '';

                    return `
                        <div class="related-product-card" onclick="showDetail(this)" data-product-id="${p.id}">
                            <div style="position: relative;">
                                ${promoBadge}
                                <img src="${image}" alt="${p.name}">
                            </div>
                            <h5>${p.name}</h5>
                            <div class="related-price-section">
                                <p>Rp ${harga}</p>
                                ${p.old_price && p.old_price > p.price ? `<p class="related-old-price">Rp ${Number(p.old_price).toLocaleString('id-ID')}</p>` : ''}
                            </div>
                        </div>
                    `;
                }).join('');
            }

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
                const promoBadge = p.is_promo ? '<span class="promo-badge">PROMO</span>' : '';

                modalBody.innerHTML = `
                <div class="modal-product">
                    <div style="position: relative;">
                        ${promoBadge}
                        <img src="${image}" alt="${p.name}" class="modal-image">
                    </div>
                    <div class="modal-info">
                        <h2><i class="fas fa-box"></i> ${p.name}</h2>
                        <div class="modal-price-section">
                            <p class="modal-price"><i class="fas fa-tag"></i> Rp ${harga}</p>
                            ${p.old_price && p.old_price > p.price ? `<p class="modal-old-price">Rp ${Number(p.old_price).toLocaleString('id-ID')}</p>` : ''}
                        </div>
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

                        <div class="related-products" id="related-products">
                            <h4><i class="fas fa-project-diagram"></i> Produk Terkait</h4>
                            <div class="related-products-grid" id="related-products-grid">
                                ${renderRelatedProducts(p)}
                            </div>
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

                const subcategory = document.getElementById('subcategory-filter').value;
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
                    const cardSubcategory = card.dataset.subcategory || 'none';
                    const cardName = (card.dataset.name || '').toLowerCase();
                    const cardPrice = parseInt(card.dataset.price || '0', 10);

                    // Debug log for subcategory filtering
                    console.log('Card:', {
                        name: cardName,
                        category: cardCategory,
                        subcategory: cardSubcategory,
                        selectedSubcategory: subcategory
                    });

                    const categoryMatch = category === 'all' || cardCategory === category;
                    const subcategoryMatch = subcategory === 'all' || cardSubcategory === subcategory;
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

                    return categoryMatch && subcategoryMatch && searchMatch && priceMatch;
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
            document.getElementById('subcategory-filter').addEventListener('change', applyFilters);

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

            // --- Panggil fungsi global carousel ---
            window.changeSlide = changeSlide;
            window.currentSlide = currentSlide;

            showSlide(0); // Initialize carousel

            // Pagination system
            const ITEMS_PER_PAGE = 12;
            let atkCurrentPage = 1;
            let atkTotalPages = 1;

            function setupAtkPagination() {
                const grid = document.getElementById('products-grid');
                if (!grid) return;

                const allCards = Array.from(grid.querySelectorAll('.product-card'));
                if (allCards.length === 0) return;

                atkTotalPages = Math.ceil(allCards.length / ITEMS_PER_PAGE);

                if (atkTotalPages > 1) {
                    showAtkPage(1);
                    updateAtkPaginationControls();
                } else {
                    // Hide pagination if only one page
                    const paginationContainer = document.querySelector('.pagination-container');
                    if (paginationContainer) {
                        paginationContainer.style.display = 'none';
                    }
                }
            }

            function showAtkPage(page) {
                const grid = document.getElementById('products-grid');
                const allCards = Array.from(grid.querySelectorAll('.product-card'));

                atkCurrentPage = page;

                allCards.forEach((card, idx) => {
                    const pageNumber = Math.floor(idx / ITEMS_PER_PAGE) + 1;
                    card.style.display = pageNumber === page ? 'block' : 'none';
                });

                updateAtkPaginationControls();
                // Smooth scroll to top of products
                grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            function updateAtkPaginationControls() {
                const prevBtn = document.getElementById('atkPrevBtn');
                const nextBtn = document.getElementById('atkNextBtn');
                const pageNumbers = document.getElementById('atkPageNumbers');

                // Update Previous button
                if (prevBtn) {
                    prevBtn.disabled = atkCurrentPage === 1;
                }

                // Update Next button
                if (nextBtn) {
                    nextBtn.disabled = atkCurrentPage === atkTotalPages;
                }

                // Update page numbers
                if (pageNumbers) {
                    pageNumbers.innerHTML = '';

                    // Show max 5 page numbers
                    let startPage = Math.max(1, atkCurrentPage - 2);
                    let endPage = Math.min(atkTotalPages, startPage + 4);

                    if (endPage - startPage < 4) {
                        startPage = Math.max(1, endPage - 4);
                    }

                    // Add first page and ellipsis if needed
                    if (startPage > 1) {
                        addAtkPageNumber(1);
                        if (startPage > 2) {
                            addAtkEllipsis();
                        }
                    }

                    // Add page numbers
                    for (let i = startPage; i <= endPage; i++) {
                        addAtkPageNumber(i);
                    }

                    // Add ellipsis and last page if needed
                    if (endPage < atkTotalPages) {
                        if (endPage < atkTotalPages - 1) {
                            addAtkEllipsis();
                        }
                        addAtkPageNumber(atkTotalPages);
                    }
                }
            }

            function addAtkPageNumber(pageNum) {
                const pageNumbers = document.getElementById('atkPageNumbers');
                if (!pageNumbers) return;

                const pageBtn = document.createElement('button');
                pageBtn.className = `page-number ${pageNum === atkCurrentPage ? 'active' : ''}`;
                pageBtn.textContent = pageNum;
                pageBtn.onclick = () => showAtkPage(pageNum);
                pageNumbers.appendChild(pageBtn);
            }

            function addAtkEllipsis() {
                const pageNumbers = document.getElementById('atkPageNumbers');
                if (!pageNumbers) return;

                const ellipsis = document.createElement('span');
                ellipsis.className = 'page-ellipsis';
                ellipsis.textContent = '...';
                pageNumbers.appendChild(ellipsis);
            }

            function atkPreviousPage() {
                if (atkCurrentPage > 1) {
                    showAtkPage(atkCurrentPage - 1);
                }
            }

            function atkNextPage() {
                if (atkCurrentPage < atkTotalPages) {
                    showAtkPage(atkCurrentPage + 1);
                }
            }

            // Initialize pagination
            setupAtkPagination();

            // Make pagination functions global
            window.atkPreviousPage = atkPreviousPage;
            window.atkNextPage = atkNextPage;
        });

        // Checkout bubble (jika ada) bisa ditambahkan di sini
        // Contoh: document.getElementById('checkoutBubble').addEventListener(...)
    </script>
<!-- Universal Checkout Bubble -->
@include('demo.universal-checkout-bubble', [
    'templateSlug' => 'toko-atk',
])
</body>

</html>
