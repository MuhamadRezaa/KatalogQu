<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Hanya tampilkan link icon jika $userStore->store_logo ada isinya --}}
    @if ($userStore->store_logo)
        <link rel="icon"
            href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
            type="image/x-icon">
    @else
        {{-- Opsional: Tampilkan favicon default jika logo toko tidak ada --}}
        {{-- <link rel="icon" href="{{ asset('assets/images/default-favicon.ico') }}" type="image/x-icon"> --}}
    @endif

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

        /* Style tambahan agar filter lebih rapi */
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            /* Agar bisa turun ke bawah di layar kecil */
            gap: 1rem;
            /* Jarak antar elemen filter */
            align-items: center;
            /* Sejajarkan item secara vertikal */
            margin-bottom: 2rem;
            /* Beri jarak bawah */
        }

        .search-box {
            padding: 0.6rem 1rem;
            border: 1px solid #ccc;
            border-radius: 20px;
            /* Lebih bulat */
            font-size: 0.9em;
            transition: border-color 0.3s, box-shadow 0.3s;
            min-width: 150px;
            /* Lebar minimum */
        }

        .search-box:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }

        #searchBox {
            flex-grow: 1;
            /* Biarkan search box mengisi ruang */
        }

        .filter-container select.search-box {
            flex-grow: 0;
            /* Jangan biarkan select mengisi ruang */
            flex-basis: auto;
            /* Kembalikan ke ukuran konten */
            cursor: pointer;
            background-color: white;
            /* Pastikan background putih */
            -webkit-appearance: none;
            /* Hapus tampilan default */
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23555' viewBox='0 0 20 20'%3E%3Cpath d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1em;
            padding-right: 2.5rem;
            /* Ruang untuk ikon panah */
        }

        /* Style untuk select yang disabled */
        .filter-container select.search-box:disabled {
            background-color: #e9ecef;
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 992px) {

            /* Adjust breakpoint if needed */
            .filter-container select.search-box {
                min-width: 180px;
                /* Sedikit lebih lebar di tablet */
            }
        }

        @media (max-width: 768px) {
            .filter-container {
                flex-direction: column;
                /* Tumpuk filter di layar kecil */
                align-items: stretch;
                /* Lebarkan filter */
            }

            .search-box {
                width: 100%;
                /* Lebar penuh di mobile */
            }

            .filter-container select.search-box {
                min-width: 100%;
                /* Lebar penuh select di mobile */
            }
        }

        /* Placeholder styling */
        .image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            aspect-ratio: 1 / 1;
            /* Atau rasio gambar Anda */
            background-color: #f0f0f0;
            color: #888;
            font-size: 0.9em;
            border-bottom: 1px solid #eee;
        }

        .product-image {
            aspect-ratio: 1 / 1;
            /* Rasio gambar 1:1 */
            object-fit: cover;
            /* Pastikan gambar mengisi area */
            width: 100%;
        }

        .modal-image {
            width: 100%;
            max-height: 400px;
            /* Batasi tinggi gambar modal */
            object-fit: contain;
            /* Tampilkan seluruh gambar di modal */
            margin-bottom: 1rem;
        }

        /* Badge Promo */
        .promo-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            /* Atur posisi sesuai badge 'New' */
            background-color: #e74c3c;
            /* Merah */
            color: white;
            padding: 4px 8px;
            font-size: 0.75em;
            font-weight: bold;
            border-radius: 4px;
            z-index: 10;
        }

        /* Jika badge New dan Promo ada bersamaan, atur posisi */
        .new-badge+.promo-badge {
            top: 40px;
            /* Atur agar tidak tumpang tindih */
        }

        /* Harga Lama yang Dicoret */
        .product-old-price del {
            color: #999;
            font-size: 0.9em;
        }

        /* Styling untuk Modal */
        .modal-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            font-weight: bold;
            color: white;
            margin-right: 10px;
        }

        .modal-badge.new {
            background-color: #2ecc71;
            /* Hijau */
        }

        .modal-badge.promo {
            background-color: #e74c3c;
            /* Merah */
        }

        .modal-price-container {
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .modal-current-price {
            color: #e74c3c;
            /* Merah untuk harga saat ini */
            font-weight: bold;
        }

        .modal-old-price {
            color: #999;
            text-decoration: line-through;
            font-size: 0.9em;
            margin-left: 10px;
        }

        .modal-specs {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .modal-specs h4 {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 10px;
        }

        .modal-specs ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .modal-specs li {
            margin-bottom: 8px;
            color: #555;
            font-size: 0.95em;
            display: flex;
            /* Untuk layout key-value */
            justify-content: space-between;
            /* Pisahkan key dan value */
            padding-bottom: 5px;
            border-bottom: 1px dashed #eee;
            /* Garis pemisah tipis */
        }

        .modal-specs li strong {
            color: #333;
            margin-right: 10px;
            /* Jarak antara key dan value */
            flex-shrink: 0;
            /* Agar key tidak mengecil */
        }

        .modal-specs li span {
            text-align: right;
            /* Value rata kanan */
        }

        .modal-specs li.empty-spec {
            font-style: italic;
            color: #888;
            justify-content: center;
            border-bottom: none;
        }

        .category-item {
            /* Pastikan display flex dan arah kolom untuk layout */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Pusatkan item */
            text-align: center;
            /* Pusatkan teks */
        }

        .category-image {
            width: 120px;
            /* Atur lebar gambar */
            height: auto;
            /* Atur tinggi gambar */
            object-fit: contain;
            /* Agar gambar tidak terdistorsi */
            margin-bottom: 1rem;
            /* Jarak bawah gambar */
            border-radius: 8px;
            /* Sudut sedikit melengkung (opsional) */
            background-color: #f8f9fa;
            /* Warna latar belakang jika gambar transparan */
            padding: 5px;
            /* Sedikit padding di sekitar gambar (opsional) */
            border: 1px solid #eee;
            /* Border tipis (opsional) */
        }

        .category-icon {
            font-size: 48px;
            /* Ukuran ikon fallback */
            color: #4A90E2;
            /* Warna ikon */
            margin-bottom: 1rem;
            /* Jarak bawah ikon */
            width: 120px;
            /* Samakan lebar dengan gambar */
            height: 80px;
            /* Samakan tinggi dengan gambar */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f4f8;
            /* Latar belakang ikon */
            border-radius: 8px;
            /* Samakan radius */
            border: 1px solid #eee;
            /* Samakan border */
        }

        .category-item h3 {
            margin-top: 0;
            /* Hapus margin atas default jika ada */
            margin-bottom: 0.5rem;
            /* Jarak bawah judul */
        }

        .category-item p {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 0;
            /* Hapus margin bawah default */
        }

        .related-products-section {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .related-products-section h4 {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 15px;
            text-align: left;
            /* Sesuaikan jika perlu */
        }

        .related-products-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            /* Grid responsif */
            gap: 15px;
            /* Jarak antar item */
        }

        .related-product-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: box-shadow 0.3s ease;
            background-color: #fff;
        }

        .related-product-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .related-product-image {
            width: 100%;
            height: 80px;
            /* Tinggi gambar tetap */
            object-fit: contain;
            /* Tampilkan seluruh gambar */
            margin-bottom: 8px;
            border-radius: 4px;
        }

        .related-product-name {
            font-size: 0.85em;
            font-weight: 500;
            color: #333;
            /* Batasi teks agar tidak terlalu panjang */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .related-product-price {
            font-size: 0.8em;
            color: #e74c3c;
            /* Warna harga */
            font-weight: bold;
        }

        /* Placeholder jika tidak ada gambar */
        .related-no-image {
            width: 100%;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            color: #aaa;
            border-radius: 4px;
            margin-bottom: 8px;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="header-section">
        <div class="header-container">
            <div class="header-top">
                {{-- Logo di Header --}}
                <div class="logo" style="margin-left: 60px;">
                    @if ($userStore->store_logo)
                        <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                            alt="Logo Toko" class="logo-image"
                            style="width: 50px; height: 50px; object-fit: contain; background: transparent;">
                    @else
                        <div class="logo-placeholder"
                            style="width: 50px; height: 50px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                            <span style="font-size: 10px; color: #aaa;">No Logo</span>
                        </div>
                    @endif
                    <div class="logo-text">{{ $userStore->store_name }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="carousel-section">
        <div class="carousel">
            <div class="carousel-inner" id="carouselInner">
                {{-- Carousel Banner --}}
                @forelse ($banners as $banner)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        @if ($banner->image_url)
                            <img src="{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                                alt="{{ $banner->title ?? 'Banner' }}">
                        @else
                            <img src="https://via.placeholder.com/1200x400?text=Banner+Image+Not+Available"
                                alt="Placeholder Banner">
                        @endif
                        <div class="carousel-caption">
                            <h3>{!! $banner->title ?? 'Banner Title' !!}</h3>
                            <p>{!! $banner->subtitle ?? 'Banner Sub Title' !!}</p>
                        </div>
                    </div>
                @empty
                    {{-- Banner Statis Fallback --}}
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
                            alt="Peralatan Kebersihan Modern">
                        <div class="carousel-caption">
                            <h3>Peralatan Kebersihan Modern</h3>
                            <p>Tingkatkan efisiensi pekerjaan dengan peralatan kebersihan yang modern dan handal</p>
                        </div>
                    </div>
                @endforelse
            </div>
            {{-- Tombol carousel --}}
            @if ((isset($banners) && $banners->count() > 1) || (!isset($banners) || $banners->isEmpty()))
                {{-- Tampilkan jika ada >1 banner ATAU jika fallback aktif --}}
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
                {{-- Tombol Semua Kategori
                <div class="category-item" onclick="filterByCategory('all')">
                    {{-- [BARU] Tambahkan ikon generik untuk 'Semua Kategori' --}}
                {{-- <i class="fas fa-boxes category-icon"></i>
                    <h3>Semua Kategori</h3>
                    <p>Lihat semua produk</p>
                </div> --}}
                {{-- Loop Kategori dari Database --}}
                @if (isset($categories) && $categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="category-item"
                            onclick="filterByCategory('{{ $category->slug ?? $category->id }}')">
                            {{-- [BARU] Tambahkan elemen gambar --}}
                            @if ($category->image)
                                <img src="{{ route('tenant.asset.domain', ['path' => $category->image]) }}"
                                    alt="{{ $category->name }}" class="category-image">
                            @else
                                {{-- Fallback jika tidak ada gambar --}}
                                {{-- <i class="fas fa-tag category-icon"></i> Ikon fallback --}}
                            @endif
                            {{-- Akhir penambahan elemen gambar --}}
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description ?? 'Tidak Ada Deskripsi' }}</p>
                        </div>
                    @endforeach
                @else
                    @unless (isset($categories) && $categories->isNotEmpty())
                        <p class="text-gray-500 text-center col-span-full">Tidak Ada Kategori Tersedia</p>
                    @endunless
                @endif
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h2 class="section-title">Produk Kami</h2>

            <div class="filter-section">
                <div class="filter-container">
                    {{-- Input Pencarian (Selalu Tampil) --}}
                    <input type="text" class="search-box" placeholder="Cari produk..." id="searchBox">

                    @if (in_array('subkategoriproduk', $activeMenuCodes ?? []))
                        <select id="subcategoryFilter" class="search-box" style="min-width: 200px;" disabled>
                            <option value="all" data-category-slug="">Semua Sub Kategori</option>
                            @if (isset($subCategories) && $subCategories->isNotEmpty())
                                @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->slug ?? $subCategory->id }}"
                                        data-category-slug="{{ $subCategory->category->slug ?? '' }}">
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    @endif
                    {{-- Filter Kategori (Selalu Tampil karena diperlukan Sub Kategori) --}}
                    <select id="categoryFilter" class="search-box" style="min-width: 200px;">
                        <option value="all">Semua Kategori</option>
                        @if (isset($categories) && $categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug ?? $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>

                    {{-- === PERUBAHAN: Filter Brand Produk (Kondisional) === --}}
                    @if (in_array('brandproduk', $activeMenuCodes ?? []))
                        <select id="brandFilter" class="search-box" style="min-width: 200px;">
                            <option value="all">Semua Brand</option>
                            @if (isset($brands) && $brands->isNotEmpty())
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->slug ?? $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    @endif
                    {{-- === AKHIR PERUBAHAN === --}}

                    {{-- Filter Rentang Harga (Selalu Tampil - Kecuali ada menu 'rentangharga') --}}
                    {{-- @if (in_array('rentangharga', $activeMenuCodes ?? [])) --}}
                    <select id="priceRangeFilter" class="search-box" style="min-width: 200px;">
                        <option value="">Rentang Harga</option>
                        @if (isset($priceRanges) && $priceRanges->isNotEmpty())
                            @foreach ($priceRanges as $range)
                                <option data-min="{{ $range->min ?? 0 }}" data-max="{{ $range->max ?? '' }}">
                                    {{ $range->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    {{-- @endif --}}

                    {{-- Urutkan (Selalu Tampil) --}}
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
                @forelse ($products as $product)
                    <div class="product-card" data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                        {{-- [PERBARUAN] Tambahkan data harga lama, promo, dan spesifikasi --}} data-old-price="{{ $product->old_price ?? '' }}"
                        data-is-promo="{{ $product->is_promo ? 'true' : 'false' }}"
                        data-specification='@json($product->specification)' {{-- Encode spec ke JSON --}} {{-- Data lainnya sudah ada --}}
                        data-category="{{ $product->category->slug ?? 'uncategorized' }}"
                        data-subcategory="{{ $product->subCategory->slug ?? '' }}"
                        data-brand="{{ $product->brand->slug ?? '' }}"
                        data-unit="{{ $product->unit->unit_name ?? 'Unit' }}"
                        data-description="{{ $product->description }}"
                        @php $src = $product->primary_image_src; @endphp data-image="{{ $src }}"
                        data-whatsapp="{{ $userStore->store_phone }}"
                        data-is-new="{{ $product->is_new ? 'true' : 'false' }}"
                        data-created-at="{{ $product->created_at->timestamp }}">

                        {{-- Badge 'New' di kartu (sudah ada) --}}
                        @if ($product->is_new)
                            <div class="new-badge">New</div>
                        @endif
                        {{-- [BARU] Tambahkan badge 'Promo' di kartu jika ada harga lama --}}
                        @if ($product->old_price && $product->old_price > $product->price)
                            <div class="promo-badge">Promo</div>
                        @endif
                        @php $src = $product->primary_image_src; @endphp
                        @if ($src)
                            <img src="{{ $src }}" alt="{{ $product->name }}" class="product-image"
                                onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="image-placeholder" style="display: none;">Gagal memuat gambar</div>
                        @else
                            <div class="image-placeholder">Tidak ada gambar</div>
                        @endif
                        <div class="product-content">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="product-price">Rp
                                {{ number_format($product->price, 0, ',', '.') }}/{{ $product->unit->unit_name ?? 'Unit' }}
                            </div>
                            {{-- [BARU] Tampilkan harga lama yang dicoret jika ada --}}
                            @if ($product->old_price && $product->old_price > $product->price)
                                <div class="product-old-price">
                                    <del>Rp {{ number_format($product->old_price, 0, ',', '.') }}</del>
                                </div>
                            @endif
                            <p class="product-description">{{ Str::limit($product->description, 120) }}</p>
                            <div class="button-group">
                                <button class="detail-btn" onclick="showDetail(this)">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </button>
                                <button class="chat-btn"
                                    onclick="chatWhatsApp('{{ $userStore->store_phone }}', '{{ $product->name }}')">
                                    <i class="fab fa-whatsapp"></i> Chat WA
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

            {{-- Tampilkan pagination hanya jika $products adalah instance Paginator --}}
            @if ($products instanceof \Illuminate\Pagination\AbstractPaginator)
                <div class="pagination-container">
                    {{-- Render link pagination standar Laravel --}}
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                {{-- [PERBARUAN] Container untuk Judul dan Badge --}}
                <div class="modal-title-container">
                    <span id="modalBadgeNew" class="modal-badge new" style="display: none;">New</span>
                    <span id="modalBadgePromo" class="modal-badge promo" style="display: none;">Promo</span>
                    <span class="modal-title" id="modalTitle"></span>
                </div>
            </div>
            <div class="modal-body">
                <img id="modalImage" class="modal-image" alt="">
                <div style="margin-bottom: 15px;">
                    <span id="modalCategory"
                        style="display: inline-block; background: #3498db; color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.9em; margin-right: 10px;"></span>
                    {{-- Span Brand & Sub Kategori bisa ditambahkan di sini jika perlu --}}
                    <span id="modalBrand"
                        style="display: none; background: #9b59b6; color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.9em; margin-right: 10px;"></span>
                    <span id="modalSubCategory"
                        style="display: none; background: #e67e22; color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.9em; margin-right: 10px;"></span>
                    <span id="modalUnit"
                        style="display: inline-block; background: #2ecc71; color: white; padding: 5px 10px; border-radius: 5px; font-size: 0.9em;"></span>
                </div>
                {{-- [PERBARUAN] Container untuk Harga --}}
                <div class="modal-price-container" id="modalPriceContainer">
                    <span id="modalCurrentPrice" class="modal-current-price"></span>
                    <span id="modalOldPrice" class="modal-old-price" style="display: none;"></span>
                </div>
                <div class="modal-description" id="modalDescription"></div>

                {{-- [BARU] Container untuk Spesifikasi (ditampilkan kondisional) --}}
                @if (in_array('spesifikasi', $activeMenuCodes ?? []))
                    <div class="modal-specs" id="modalSpecsContainer">
                        <h4>Spesifikasi Produk</h4>
                        <ul id="modalSpecsList">
                            {{-- List spesifikasi akan diisi oleh JavaScript --}}
                        </ul>
                    </div>
                @endif

                {{-- [BARU] Bagian Produk Serupa --}}
                <div class="related-products-section" id="related-products-section" style="display: none;">
                    <h4>Produk Serupa</h4>
                    <div class="related-products-container" id="related-products-container">
                        {{-- Produk serupa akan dimuat di sini oleh JavaScript --}}
                    </div>
                </div>
                {{-- Akhir Bagian Produk Serupa --}}

            </div>
            <div class="modal-actions">
                <button class="modal-whatsapp" onclick="chatWhatsAppFromModal()">
                    <i class="fab fa-whatsapp"></i> Chat WhatsApp
                </button>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo">
                    @if ($userStore->store_logo)
                        <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                            alt="Logo Toko" class="footer-logo-image"
                            style="width: 150px; height: 150px; object-fit: contain; background: transparent;">
                    @else
                        <div class="footer-logo-placeholder"
                            style="width: 150px; height: 150px; background: #555; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                            <span style="font-size: 14px; color: #ccc;">No Logo</span>
                        </div>
                    @endif
                    <h3 class="footer-logo-text">{{ $userStore->store_name }}</h3>
                </div>
            </div>

            <div class="footer-section footer-contact">
                <h3>Kontak</h3>
                <div class="address-container">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="address-text">
                        <div>{{ $userStore->store_address ?? 'Alamat belum diatur' }}</div>
                    </div>
                </div>
                <p><i class="fas fa-phone"></i> {{ $userStore->store_phone ?? 'Nomor telepon belum diatur' }}</p>
                <p><i class="fas fa-envelope"></i> {{ $userStore->store_email ?? 'Email belum diatur' }}</p>
                <div class="social-media">
                    <a href="{{ $userStore->instagram_url ?? '#' }}" target="_blank" class="social-icon"><i
                            class="fab fa-instagram"></i></a>
                    <a href="{{ $userStore->facebook_url ?? '#' }}" target="_blank" class="social-icon"><i
                            class="fab fa-facebook"></i></a>
                    <a href="{{ $userStore->twitter_url ?? '#' }}" target="_blank" class="social-icon"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>
                <span>© {{ date('Y') }} PT. Era Cipta Digital</span>
            </div>
        </div>
    </footer>

    <script>
        let currentProductForModal = null;
        const productsGrid = document.getElementById('productsGrid');
        // Ambil semua kartu produk SEKALI saat DOM siap, pastikan grid ada
        const allProductCards = productsGrid ? Array.from(productsGrid.getElementsByClassName('product-card')) : [];
        const noResultsMessage = document.getElementById('noResultsMessage');

        // Cache elemen filter DENGAN pengecekan null
        const categoryFilterSelect = document.getElementById('categoryFilter');
        const subcategoryFilterSelect = document.getElementById('subcategoryFilter'); // Mungkin null
        const brandFilterSelect = document.getElementById('brandFilter'); // Mungkin null
        const priceRangeFilterSelect = document.getElementById('priceRangeFilter'); // Mungkin null
        const sortBySelect = document.getElementById('sortBy');
        const searchBoxInput = document.getElementById('searchBox');

        // Simpan semua opsi subkategori asli (hanya jika elemen ada)
        const originalSubcategoryOptions = subcategoryFilterSelect ? Array.from(subcategoryFilterSelect.options) : [];

        // --- Fungsi Helper ---
        function formatRupiah(number) {
            if (number === null || typeof number === 'undefined' || isNaN(Number(number))) return 'N/A';
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        function getCategoryName(categorySlug) {
            // Cek dulu apakah categoryFilterSelect ada
            if (!categoryFilterSelect) return categorySlug || 'Lainnya';
            const categoryElement = categoryFilterSelect.querySelector(`option[value="${categorySlug}"]`);
            return categoryElement ? categoryElement.textContent : (categorySlug || 'Lainnya');
        }

        function getBrandName(brandSlug) {
            // Cek dulu apakah brandFilterSelect ada
            if (!brandFilterSelect || !brandSlug) return ''; // Tambahkan cek brandSlug
            const brandElement = brandFilterSelect.querySelector(`option[value="${brandSlug}"]`);
            return brandElement ? brandElement.textContent : '';
        }

        function getSubCategoryName(subCategorySlug) {
            // Cari di antara opsi asli (originalSubcategoryOptions sudah handle null)
            if (!subCategorySlug) return ''; // Tambahkan cek subCategorySlug
            const subCategoryOption = originalSubcategoryOptions.find(option => option.value === subCategorySlug);
            return subCategoryOption ? subCategoryOption.textContent : '';
        }

        // Fungsi helper untuk render spesifikasi
        function renderSpecs(specsJsonString) {
            try {
                // Coba parse JSON, fallback ke objek kosong jika tidak valid atau null
                const specs = JSON.parse(specsJsonString || '{}');
                let entries = [];

                // Handle jika specs adalah array objek {key, value} atau objek langsung
                if (Array.isArray(specs)) {
                    specs.forEach(item => {
                        if (item && typeof item === 'object') {
                            if ('key' in item && 'value' in item) {
                                entries.push([item.key, item.value]);
                            } else {
                                // Jika formatnya hanya objek tanpa key/value eksplisit
                                Object.entries(item).forEach(([k, v]) => {
                                    // Hanya tambahkan jika value tidak kosong/null/undefined
                                    if (v !== null && v !== undefined && String(v).trim() !== '') {
                                        entries.push([k, v]);
                                    }
                                });
                            }
                        }
                    });
                } else if (specs && typeof specs === 'object') {
                    // Ambil entries dari objek dan filter yang value-nya kosong
                    entries = Object.entries(specs).filter(([_, v]) => v !== null && v !== undefined && String(v).trim() !==
                        '');
                }

                // Jika setelah diproses tidak ada entri valid
                if (entries.length === 0) {
                    return '<li class="empty-spec">Tidak ada spesifikasi</li>';
                }

                // Format entri menjadi HTML list item
                return entries.map(([k, v]) => {
                    // Format key: Ubah underscore/dash menjadi spasi, kapitalisasi kata
                    const formattedKey = k ? String(k).replace(/_/g, ' ').replace(/-/g, ' ').replace(/\b\w/g, l => l
                        .toUpperCase()) : '';
                    // Jika tidak ada key (mungkin dari array string lama), tampilkan value saja
                    if (!formattedKey) {
                        return `<li><span>${v}</span></li>`; // Value saja, tanpa strong
                    }
                    // Tampilkan key dan value
                    return `<li><strong>${formattedKey}</strong> <span>${v}</span></li>`;
                }).join('');

            } catch (e) {
                // Tangani jika JSON tidak valid
                console.error("Error parsing specification JSON:", e, "Input:", specsJsonString);
                return '<li class="empty-spec">Gagal memuat spesifikasi (format data salah)</li>';
            }
        }


        // --- Fungsi Modal ---
        function showDetail(buttonElement) {
            // Cari elemen card terdekat, bisa jadi button itu sendiri jika event delegation dipakai
            const card = buttonElement.closest ? buttonElement.closest('.product-card, .related-product-card') :
                buttonElement;
            if (!card || !card.dataset) {
                console.error('Card or card data not found for detail view.');
                return;
            }
            const productData = card.dataset;
            const currentProductName = productData.name; // Simpan nama produk saat ini
            const currentCategory = productData.category; // Simpan kategori produk saat ini

            currentProductForModal = {
                name: currentProductName,
                whatsapp: productData.whatsapp || '{{ $userStore->store_phone }}' // Fallback
            };

            // Ambil elemen modal
            const modalTitle = document.getElementById('modalTitle');
            const modalImage = document.getElementById('modalImage');
            const modalCategory = document.getElementById('modalCategory');
            const modalBrand = document.getElementById('modalBrand');
            const modalSubCategory = document.getElementById('modalSubCategory');
            const modalUnit = document.getElementById('modalUnit');
            const modalDescription = document.getElementById('modalDescription');
            const modalCurrentPrice = document.getElementById('modalCurrentPrice');
            const modalOldPrice = document.getElementById('modalOldPrice');
            const modalSpecsList = document.getElementById('modalSpecsList');
            const modalSpecsContainer = document.getElementById('modalSpecsContainer');
            const modalBadgeNew = document.getElementById('modalBadgeNew');
            const modalBadgePromo = document.getElementById('modalBadgePromo');
            const productModal = document.getElementById('productModal');
            const relatedSection = document.getElementById('related-products-section');
            const relatedContainer = document.getElementById('related-products-container');

            // --- Isi modal dengan data produk utama ---
            if (modalTitle) modalTitle.textContent = currentProductName || 'Detail Produk';
            if (modalImage) {
                modalImage.src = productData.image || 'https://via.placeholder.com/400?text=No+Image';
                modalImage.alt = currentProductName || 'Gambar Produk';
            }
            if (modalCategory) modalCategory.textContent = getCategoryName(productData.category);
            if (modalUnit) modalUnit.textContent = `Unit: ${productData.unit || 'N/A'}`;
            if (modalDescription) modalDescription.textContent = productData.description || 'Tidak ada deskripsi.';

            // Tampilkan Brand jika elemen filter brand ada & data brand ada
            if (modalBrand && brandFilterSelect) {
                const brandName = getBrandName(productData.brand);
                if (brandName && productData.brand !== 'all' && productData.brand !== '') {
                    modalBrand.textContent = `Brand: ${brandName}`;
                    modalBrand.style.display = 'inline-block';
                } else {
                    modalBrand.style.display = 'none';
                }
            } else if (modalBrand) {
                modalBrand.style.display = 'none';
            }

            // Tampilkan Sub Kategori jika elemen filter subkategori ada & data subkategori ada
            if (modalSubCategory && subcategoryFilterSelect) {
                const subCategoryName = getSubCategoryName(productData.subcategory);
                if (subCategoryName && productData.subcategory !== 'all' && productData.subcategory !== '') {
                    modalSubCategory.textContent = `Sub: ${subCategoryName}`;
                    modalSubCategory.style.display = 'inline-block';
                } else {
                    modalSubCategory.style.display = 'none';
                }
            } else if (modalSubCategory) {
                modalSubCategory.style.display = 'none';
            }

            // Logika Harga dan Badge
            const price = parseFloat(productData.price);
            const oldPrice = productData.oldPrice ? parseFloat(productData.oldPrice) : null;
            const isNew = productData.isNew === 'true';
            const isPromo = productData.isPromo === 'true';

            if (modalCurrentPrice) modalCurrentPrice.textContent = formatRupiah(price);

            let showPromoBadge = false;
            if (modalOldPrice) {
                if (oldPrice && oldPrice > price) {
                    modalOldPrice.innerHTML = `<del>${formatRupiah(oldPrice)}</del>`;
                    modalOldPrice.style.display = 'inline';
                    showPromoBadge = true;
                } else {
                    modalOldPrice.style.display = 'none';
                }
            }

            if (modalBadgePromo) modalBadgePromo.style.display = (showPromoBadge || isPromo) ? 'inline-block' : 'none';
            if (modalBadgeNew) modalBadgeNew.style.display = isNew ? 'inline-block' : 'none';

            // Logika Spesifikasi (hanya jika elemen dan menu aktif)
            if (modalSpecsList && modalSpecsContainer) {
                const specMenuActive = in_array('spesifikasi', {!! json_encode($activeMenuCodes ?? []) !!});
                if (specMenuActive) {
                    modalSpecsList.innerHTML = renderSpecs(productData.specification);
                    modalSpecsContainer.style.display = 'block';
                } else {
                    modalSpecsContainer.style.display = 'none';
                }
            }

            // --- Logika untuk Produk Serupa ---
            if (relatedSection && relatedContainer) {
                relatedContainer.innerHTML = '';
                let relatedCount = 0;
                const maxRelated = 4;

                allProductCards.forEach(relatedCard => {
                    const relatedData = relatedCard.dataset;
                    if (relatedData.category === currentCategory &&
                        relatedData.name !== currentProductName &&
                        relatedCount < maxRelated) {
                        const relatedName = relatedData.name;
                        const relatedPrice = formatRupiah(relatedData.price);
                        const relatedImage = relatedData.image || '';

                        const cardElement = document.createElement('div');
                        cardElement.className = 'related-product-card';
                        // Salin semua data-*
                        Object.keys(relatedData).forEach(key => {
                            cardElement.dataset[key] = relatedData[key];
                        });
                        // Tambahkan event listener
                        cardElement.onclick = function() {
                            showDetail(this);
                        };

                        let imageHtml = relatedImage ?
                            `<img src="${relatedImage}" alt="${relatedName}" class="related-product-image" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                           <div class="related-no-image" style="display: none;"><i class="fas fa-image"></i></div>` :
                            `<div class="related-no-image"><i class="fas fa-image"></i></div>`;

                        cardElement.innerHTML = `
                        ${imageHtml}
                        <div class="related-product-name">${relatedName}</div>
                        <div class="related-product-price">${relatedPrice}</div>
                    `;
                        relatedContainer.appendChild(cardElement);
                        relatedCount++;
                    }
                });
                relatedSection.style.display = relatedCount > 0 ? 'block' : 'none';
            }
            // --- Akhir Logika Produk Serupa ---

            if (productModal) productModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }


        function closeModal() {
            const productModal = document.getElementById('productModal');
            if (productModal) productModal.style.display = 'none';
            currentProductForModal = null;
            document.body.style.overflow = '';
        }

        // --- Fungsi Chat WhatsApp ---
        function chatWhatsApp(phone, productName) {
            const cleanPhone = String(phone || '').replace(/[^0-9]/g, '');
            if (!cleanPhone) {
                alert('Nomor WhatsApp toko belum diatur.');
                return;
            }
            const message = `Halo, saya tertarik dengan produk ${productName}. Mohon info lebih lanjut.`;
            const whatsappUrl = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        function chatWhatsAppFromModal() {
            if (currentProductForModal) {
                chatWhatsApp(currentProductForModal.whatsapp, currentProductForModal.name);
            }
        }

        // --- Fungsi Filter & Sort ---
        // [PERBARUAN] Fungsi untuk mengupdate opsi subkategori agar SELALU AKTIF
        function updateSubcategoryOptions() {
            if (!categoryFilterSelect || !subcategoryFilterSelect) return;

            const currentSubcategoryValue = subcategoryFilterSelect.value;
            const firstOption = subcategoryFilterSelect.options[0]; // Opsi "Semua Sub Kategori"

            subcategoryFilterSelect.innerHTML = ''; // Kosongkan
            subcategoryFilterSelect.appendChild(firstOption); // Tambahkan "Semua" kembali
            firstOption.selected = true; // Jadikan default

            // Selalu aktifkan
            subcategoryFilterSelect.disabled = false;

            // Tambahkan semua opsi asli (kecuali "Semua")
            originalSubcategoryOptions.forEach(option => {
                if (option.value !== 'all') {
                    subcategoryFilterSelect.appendChild(option.cloneNode(true));
                }
            });

            // Coba pulihkan pilihan sebelumnya
            const existingOption = Array.from(subcategoryFilterSelect.options).find(opt => opt.value ===
                currentSubcategoryValue);
            subcategoryFilterSelect.value = existingOption ? currentSubcategoryValue : 'all';
        }


        function applyFiltersAndSort() {
            if (!productsGrid || !noResultsMessage) return;

            const searchTerm = searchBoxInput ? searchBoxInput.value.toLowerCase() : '';
            const sortBy = sortBySelect ? sortBySelect.value : '';
            const selectedCategory = categoryFilterSelect ? categoryFilterSelect.value : 'all';
            const selectedSubcategory = subcategoryFilterSelect ? subcategoryFilterSelect.value : 'all';
            const selectedBrand = brandFilterSelect ? brandFilterSelect.value : 'all';

            let minPrice = 0;
            let maxPrice = Infinity;
            if (priceRangeFilterSelect && priceRangeFilterSelect.value !== "") {
                const selectedOption = priceRangeFilterSelect.options[priceRangeFilterSelect.selectedIndex];
                if (selectedOption && selectedOption.dataset.min !== undefined) {
                    minPrice = selectedOption.dataset.min ? parseFloat(selectedOption.dataset.min) : 0;
                    maxPrice = selectedOption.dataset.max && selectedOption.dataset.max !== '' ? parseFloat(selectedOption
                        .dataset.max) : Infinity;
                } else {
                    console.warn("Opsi rentang harga tidak valid:", priceRangeFilterSelect.value);
                    if (priceRangeFilterSelect) priceRangeFilterSelect.value = "";
                }
            }

            let visibleCards = [];

            allProductCards.forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                const price = parseFloat(card.dataset.price);
                const cardCategorySlug = card.dataset.category || 'uncategorized';
                const cardSubcategorySlug = card.dataset.subcategory || '';
                const cardBrandSlug = card.dataset.brand || '';

                if (isNaN(price)) return;

                const matchesSearch = name.includes(searchTerm);
                const matchesPrice = !priceRangeFilterSelect || priceRangeFilterSelect.value === "" || (price >=
                    minPrice && (maxPrice === Infinity || price <= maxPrice));
                const matchesCategory = !categoryFilterSelect || selectedCategory === 'all' || cardCategorySlug ===
                    selectedCategory;
                const matchesSubcategory = !subcategoryFilterSelect || selectedSubcategory === 'all' ||
                    cardSubcategorySlug === selectedSubcategory;
                const matchesBrand = !brandFilterSelect || selectedBrand === 'all' || cardBrandSlug ===
                    selectedBrand;

                // [PERBAIKAN LOGIKA] Filter subkategori hanya berlaku jika kategori spesifik dipilih
                let subcategoryMatchFinal = true;
                if (subcategoryFilterSelect && selectedSubcategory !== 'all') {
                    // Jika kategori BUKAN 'all' DAN subkategori BUKAN 'all'
                    if (selectedCategory !== 'all') {
                        // Produk harus cocok dengan subkategori DAN kategori
                        subcategoryMatchFinal = (cardSubcategorySlug === selectedSubcategory && cardCategorySlug ===
                            selectedCategory);
                    } else {
                        // Jika kategori 'all', cukup cocokkan subkategori saja
                        subcategoryMatchFinal = (cardSubcategorySlug === selectedSubcategory);
                    }
                }
                // Jika filter subkategori 'all', maka selalu true (matchesSubcategory sudah 'all')
                // Jika filter subkategori tidak ada, maka selalu true


                if (matchesSearch && matchesPrice && matchesCategory && subcategoryMatchFinal &&
                    matchesBrand) { // Gunakan subcategoryMatchFinal
                    visibleCards.push(card);
                }
            });

            // Sorting
            if (sortBy) {
                visibleCards.sort((a, b) => {
                    const priceA = parseFloat(a.dataset.price);
                    const priceB = parseFloat(b.dataset.price);
                    const nameA = a.dataset.name || '';
                    const nameB = b.dataset.name || '';
                    const dateA = parseInt(a.dataset.createdAt, 10) || 0;
                    const dateB = parseInt(b.dataset.createdAt, 10) || 0;

                    switch (sortBy) {
                        case 'price-asc':
                            return priceA - priceB;
                        case 'price-desc':
                            return priceB - priceA;
                        case 'name-asc':
                            return nameA.localeCompare(nameB);
                        case 'name-desc':
                            return nameB.localeCompare(a.name);
                        case 'newest':
                            return dateB - dateA;
                        default:
                            return 0;
                    }
                });
            }

            // Render Ulang Grid
            productsGrid.innerHTML = '';
            if (visibleCards.length > 0) {
                visibleCards.forEach(card => {
                    card.style.display = '';
                    productsGrid.appendChild(card);
                });
                noResultsMessage.style.display = 'none';
            } else {
                noResultsMessage.style.display = 'block';
            }
        }


        function filterByCategory(categorySlug) {
            if (categoryFilterSelect) categoryFilterSelect.value = categorySlug;
            // [PERBARUAN] JANGAN reset subkategori saat kategori diubah dari tombol
            // if (subcategoryFilterSelect) subcategoryFilterSelect.value = 'all';
            if (brandFilterSelect) brandFilterSelect.value = 'all';
            if (priceRangeFilterSelect) priceRangeFilterSelect.value = '';
            if (sortBySelect) sortBySelect.value = '';
            if (searchBoxInput) searchBoxInput.value = '';

            updateSubcategoryOptions(); // Tetap panggil untuk refresh jika perlu
            applyFiltersAndSort();

            if (productsGrid) {
                productsGrid.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // --- Logika Carousel ---
        let currentSlide = 0;
        const carouselItems = document.querySelectorAll('.carousel-item');
        const totalSlides = carouselItems.length > 0 ? carouselItems.length : document.querySelectorAll(
            '#carouselInner > div').length;

        function updateCarousel() {
            const carouselInner = document.getElementById('carouselInner');
            if (carouselInner && totalSlides > 0) {
                const items = carouselInner.children;
                for (let i = 0; i < items.length; i++) {
                    items[i].classList.remove('active');
                }
                if (items[currentSlide]) {
                    items[currentSlide].classList.add('active');
                }
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
        // --- Akhir Logika Carousel ---

        // --- Event Listeners ---
        document.addEventListener('DOMContentLoaded', function() {
            if (categoryFilterSelect) categoryFilterSelect.addEventListener('change', () => {
                updateSubcategoryOptions(); // Refresh opsi subkategori
                // [PERBARUAN] JANGAN reset subkategori di sini
                // if (subcategoryFilterSelect) subcategoryFilterSelect.value = 'all';
                applyFiltersAndSort(); // Terapkan filter setelah kategori berubah
            });
            if (subcategoryFilterSelect) subcategoryFilterSelect.addEventListener('change',
                applyFiltersAndSort); // Listener tetap
            if (brandFilterSelect) brandFilterSelect.addEventListener('change', applyFiltersAndSort);
            if (searchBoxInput) searchBoxInput.addEventListener('input', applyFiltersAndSort);
            if (priceRangeFilterSelect) priceRangeFilterSelect.addEventListener('change', applyFiltersAndSort);
            if (sortBySelect) sortBySelect.addEventListener('change', applyFiltersAndSort);

            if (totalSlides > 1) {
                setInterval(nextSlide, 5000);
                updateCarousel();
            }

            const productModal = document.getElementById('productModal');
            if (productModal) {
                productModal.addEventListener('click', function(event) {
                    if (event.target === productModal) closeModal();
                });
            }
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') closeModal();
            });

            updateSubcategoryOptions(); // Panggil saat load untuk memastikan opsi terisi
            applyFiltersAndSort();
        });

        // --- Pastikan fungsi global bisa diakses dari HTML onclick ---
        window.showDetail = showDetail;
        window.closeModal = closeModal;
        window.chatWhatsApp = chatWhatsApp;
        window.chatWhatsAppFromModal = chatWhatsAppFromModal;
        window.filterByCategory = filterByCategory;
        window.prevSlide = prevSlide;
        window.nextSlide = nextSlide;

        // Helper in_array for JS
        function in_array(needle, haystack) {
            if (!Array.isArray(haystack)) return false;
            return haystack.indexOf(needle) !== -1;
        }
    </script>
</body>

</html>