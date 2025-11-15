<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"
    href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id,'path' => $userStore->store_favicon ?? 'default.png']) }}"
    type="image/x-icon">
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
                    @if ($userStore && $userStore->store_logo)
                        <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => ltrim($userStore->store_logo, '/')]) }}"
                             alt="{{ $userStore->store_name }}"
                             loading="lazy" decoding="async"
                             style="width:80px;height:80px;object-fit:contain;background:transparent;border-radius:6px;">
                    @else
                        <img src="{{ asset('assets/demo/toko-aksesoris-mobil/images/icon.png') }}"
                             alt="Logo"
                             loading="lazy" decoding="async"
                             style="width:72px;height:72px;object-fit:contain;border-radius:6px;">
                    @endif
                </div>
                <div class="logo-text">
                    <span class="logo-main">{{ $userStore->store_name }}</span>
                    <span class="logo-sub">PREMIUM AKSESORIS</span>
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

        @php
            // SEMUA BANNER MURNI URL EXTERNAL (tidak pakai DB)
            $bannerItems = [
                [
                    'image_url' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=1920&q=80',
                    'title'     => 'Selamat Datang di ' . $userStore->store_name,
                    'subtitle'  => 'Temukan koleksi lengkap aksesoris mobil berkualitas tinggi',
                    'alt_text'  => 'Banner 1',
                ],
            ];
        @endphp

        {{-- RENDER SLIDER --}}
        @foreach ($bannerItems as $idx => $item)
            <div class="slide {{ $idx === 0 ? 'active' : '' }}" style="position:relative;">
                
                <img src="{{ $item['image_url'] }}"
                     alt="{{ $item['alt_text'] }}"
                     loading="lazy"
                     decoding="async"
                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">

                <div style="position:absolute;inset:0;background:linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.3));"></div>

                <div class="slide-content" style="position:relative;z-index:1;transform: translateY(-60px);">
                    <h1>{!! $item['title'] !!}</h1>
                    <p>{!! $item['subtitle'] !!}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="slider-nav">
        @for ($i = 1; $i <= count($bannerItems); $i++)
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
                    {{-- Fallback kategori default untuk tenant (mirip demo) --}}
                    <div class="category-card" data-category="interior">
                        <h3>Interior</h3>
                        <p>Sarung jok, karpet, dashboard cover, dan aksesoris interior lainnya</p>
                    </div>
                    <div class="category-card" data-category="exterior">
                        <h3>Eksterior</h3>
                        <p>Body kit, spoiler, emblem, dan aksesoris luar mobil</p>
                    </div>
                    <div class="category-card" data-category="electronics">
                        <h3>Elektronik</h3>
                        <p>Audio system, GPS, kamera parkir, dan gadget mobil</p>
                    </div>
                    <div class="category-card" data-category="maintenance">
                        <h3>Perawatan</h3>
                        <p>Oli, filter, busi, dan produk perawatan mobil</p>
                    </div>
                    <div class="category-card" data-category="safety">
                        <h3>Keamanan</h3>
                        <p>Alarm, immobilizer, kaca film, dan perangkat keamanan</p>
                    </div>
                    <div class="category-card" data-category="lighting">
                        <h3>Lampu</h3>
                        <p>LED, HID, lampu fog, dan sistem pencahayaan</p>
                    </div>
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
                        @else
                            {{-- Fallback opsi kategori mirip demo --}}
                            <option value="interior">Interior</option>
                            <option value="exterior">Eksterior</option>
                            <option value="electronics">Elektronik</option>
                            <option value="maintenance">Perawatan</option>
                            <option value="safety">Keamanan</option>
                            <option value="lighting">Lampu</option>
                        @endif
                    </select>
                    <select id="subCategoryFilter">
                        <option value="all">Semua Subkategori</option>
                        @if (isset($subCategories) && $subCategories->isNotEmpty())
                            @foreach ($subCategories as $sub)
                                <option value="{{ strtolower($sub->name) }}">{{ $sub->name }}</option>
                            @endforeach
                        @else
                            {{-- Fallback opsi subkategori umum (sinkron dengan updateSectionTitle) --}}
                            <option value="jok">Jok</option>
                            <option value="dashboard">Dashboard</option>
                            <option value="spoiler">Spoiler</option>
                            <option value="body kit">Body Kit</option>
                            <option value="kamera">Kamera</option>
                            <option value="oli">Oli</option>
                            <option value="filter">Filter</option>
                            <option value="alarm">Alarm</option>
                            <option value="dashcam">Dashcam</option>
                            <option value="headlight">Headlight</option>
                            <option value="foglamp">Foglamp</option>
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
                        @else
                            {{-- Fallback range harga standar --}}
                            <option value="0-200000" data-min="0" data-max="200000">Rp 0 - 200rb</option>
                            <option value="200000-500000" data-min="200000" data-max="500000">Rp 200rb - 500rb</option>
                            <option value="500000-1000000" data-min="500000" data-max="1000000">Rp 500rb - 1jt</option>
                            <option value="1000000-2000000" data-min="1000000" data-max="2000000">Rp 1jt - 2jt</option>
                            <option value="2000000+" data-min="2000000" data-max="">Rp 2jt+</option>
                        @endif
                    </select>
                    <button id="resetFilterBtn"><i class="fas fa-undo"></i> Reset</button>
                </div>
            </div>

            <h2 class="section-title">Produk Unggulan</h2>

            <div class="products-grid" id="productsGrid">

                @foreach ($products as $product)
                    @php $src = $product->primary_image_src ?: 'https://via.placeholder.com/600x400?text=Produk'; @endphp
                    {{-- FIX: Tambahkan atribut `data-name`, `data-description`, dan `data-image` --}}
                    <div class="product-card" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                        data-category="{{ strtolower($product->category->name ?? 'general') }}"
                        data-subcategory="{{ strtolower($product->subCategory->name ?? 'lainnya') }}"
                        data-price="{{ $product->price }}" data-description="{{ $product->description }}"
                        data-image="{{ $src }}" data-old-price="{{ $product->old_price ?? '' }}"
                        data-is-promo="{{ ($product->is_promo ?? false) || (($product->old_price ?? 0) > ($product->price ?? 0)) ? 1 : 0 }}"
                        data-brand="{{ optional($product->brand)->name }}">
                        <div class="product-image">
                            <img src="{{ $src }}" alt="{{ $product->name }}" class="product-img">
                            @if(($product->is_promo ?? false) || (($product->old_price ?? 0) > ($product->price ?? 0)))
                                <div class="promo-flag"><span class="promo-text">PROMO</span></div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-category">{{ $product->category->name ?? 'General' }}</div>
                            <h4>{{ $product->name }}</h4>
                            @if(optional($product->brand)->name)
                                <div class="product-brand" style="font-size:0.85rem;color:#6b7280;margin-top:2px;">Brand: {{ optional($product->brand)->name }}</div>
                            @endif
                            <div class="product-price-wrapper">
                                @if(($product->old_price ?? 0) > ($product->price ?? 0))
                                    <div class="product-price-original">{{ $product->old_price_idr }}</div>
                                    <div class="product-price">{{ $product->price_idr }}</div>
                                    <div class="product-savings"><i class="fas fa-tag"></i> Hemat {{ 'Rp ' . number_format((int)(($product->old_price ?? 0) - ($product->price ?? 0)), 0, ',', '.') }}</div>
                                @else
                                    <div class="product-price">{{ $product->price_idr }}</div>
                                @endif
                            </div>
                            <p>{{ Str::limit($product->description, 150) }}</p>
                            <div class="product-buttons">
                                <button class="btn btn-detail" onclick="showProductDetail({{ $product->id }})">
                                    <i class="fas fa-info-circle"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($products->isEmpty())
                    @php
                        $sampleProducts = [
                            [
                                'id' => 1001,
                                'name' => 'Sarung Jok Premium',
                                'category' => 'interior',
                                'subcategory' => 'jok',
                                'price' => 350000,
                                'old_price' => 450000,
                                'brand' => 'AutoLux',
                                'image' => 'assets/images/products/interior.svg',
                                'description' => 'Sarung jok bahan kulit sintetis yang nyaman dan elegan.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1002,
                                'name' => 'Spoiler Sport',
                                'category' => 'exterior',
                                'subcategory' => 'spoiler',
                                'price' => 520000,
                                'old_price' => 0,
                                'brand' => 'Speedo',
                                'image' => 'assets/images/products/spoiler.svg',
                                'description' => 'Spoiler sport ringan untuk tampilan agresif.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1003,
                                'name' => 'Dashcam Full HD',
                                'category' => 'electronics',
                                'subcategory' => 'dashcam',
                                'price' => 690000,
                                'old_price' => 790000,
                                'brand' => 'RoadCam',
                                'image' => 'assets/images/products/dashcam.svg',
                                'description' => 'Kamera dashboard resolusi Full HD dengan perekaman loop.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1004,
                                'name' => 'Oli Sintetis 1L',
                                'category' => 'perawatan',
                                'subcategory' => 'oli',
                                'price' => 120000,
                                'old_price' => 0,
                                'brand' => 'LubeX',
                                'image' => 'assets/images/products/oil.svg',
                                'description' => 'Oli mesin sintetis untuk performa dan perlindungan optimal.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1005,
                                'name' => 'Alarm Mobil Pro',
                                'category' => 'keamanan',
                                'subcategory' => 'alarm',
                                'price' => 430000,
                                'old_price' => 500000,
                                'brand' => 'SecureCar',
                                'image' => 'assets/images/products/alarm.svg',
                                'description' => 'Sistem alarm dengan sensor getar dan pintu.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1006,
                                'name' => 'Headlight LED',
                                'category' => 'lampu',
                                'subcategory' => 'headlight',
                                'price' => 380000,
                                'old_price' => 0,
                                'brand' => 'BrightBeam',
                                'image' => 'assets/images/products/headlight.svg',
                                'description' => 'Lampu depan LED terang, hemat energi, dan tahan lama.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1007,
                                'name' => 'Foglamp Crystal',
                                'category' => 'lampu',
                                'subcategory' => 'foglamp',
                                'price' => 260000,
                                'old_price' => 320000,
                                'brand' => 'ClearView',
                                'image' => 'assets/images/products/foglamp.svg',
                                'description' => 'Foglamp dengan cahaya fokus untuk kondisi berkabut.',
                                'is_promo' => true,
                            ],
                             [
                                 'id' => 1008,
                                 'name' => 'Dashboard Cover',
                                 'category' => 'interior',
                                 'subcategory' => 'dashboard',
                                 'price' => 210000,
                                 'old_price' => 0,
                                 'brand' => 'DashGuard',
                                 'image' => 'assets/images/products/interior.svg',
                                 'description' => 'Pelindung dashboard untuk mengurangi silau dan panas.',
                                 'is_promo' => false,
                             ],
                            [
                                'id' => 1009,
                                'name' => 'Body Kit Street',
                                'category' => 'exterior',
                                'subcategory' => 'body kit',
                                'price' => 850000,
                                'old_price' => 950000,
                                'brand' => 'StreetX',
                                'image' => 'assets/images/products/exterior.svg',
                                'description' => 'Body kit ringan untuk tampilan sporty.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1010,
                                'name' => 'Kamera Mundur HD',
                                'category' => 'electronics',
                                'subcategory' => 'kamera',
                                'price' => 410000,
                                'old_price' => 0,
                                'brand' => 'RearView',
                                'image' => 'assets/images/products/electronics.svg',
                                'description' => 'Kamera mundur dengan panduan garis parkir.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1011,
                                'name' => 'Filter Udara Sport',
                                'category' => 'perawatan',
                                'subcategory' => 'filter',
                                'price' => 175000,
                                'old_price' => 220000,
                                'brand' => 'AirMax',
                                'image' => 'assets/images/products/care.svg',
                                'description' => 'Filter udara meningkatkan aliran dan efisiensi.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1012,
                                'name' => 'Sirene Keamanan',
                                'category' => 'keamanan',
                                'subcategory' => 'alarm',
                                'price' => 190000,
                                'old_price' => 0,
                                'brand' => 'SafeSound',
                                'image' => 'assets/images/products/security.svg',
                                'description' => 'Sirene keras untuk sistem keamanan mobil.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1013,
                                'name' => 'Lampu Kabin LED',
                                'category' => 'lampu',
                                'subcategory' => 'headlight',
                                'price' => 95000,
                                'old_price' => 120000,
                                'brand' => 'LiteRoom',
                                'image' => 'assets/images/products/lamp.svg',
                                'description' => 'LED kabin putih hangat hemat energi.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1014,
                                'name' => 'Sarung Setir Kulit',
                                'category' => 'interior',
                                'subcategory' => 'dashboard',
                                'price' => 135000,
                                'old_price' => 0,
                                'brand' => 'GripPro',
                                'image' => 'assets/images/products/interior.svg',
                                'description' => 'Sarung setir kulit sintetis anti selip.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1015,
                                'name' => 'Diffuser Aerodinamis',
                                'category' => 'exterior',
                                'subcategory' => 'spoiler',
                                'price' => 620000,
                                'old_price' => 720000,
                                'brand' => 'AeroFlow',
                                'image' => 'assets/images/products/spoiler.svg',
                                'description' => 'Meningkatkan stabilitas dan gaya mobil.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1016,
                                'name' => 'Dashcam 2K Wide',
                                'category' => 'electronics',
                                'subcategory' => 'dashcam',
                                'price' => 980000,
                                'old_price' => 0,
                                'brand' => 'RoadCam X',
                                'image' => 'assets/images/products/dashcam.svg',
                                'description' => 'Perekaman lebar 140° resolusi 2K.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1017,
                                'name' => 'Oli Gear 1L',
                                'category' => 'perawatan',
                                'subcategory' => 'oli',
                                'price' => 145000,
                                'old_price' => 180000,
                                'brand' => 'GearLube',
                                'image' => 'assets/images/products/oil.svg',
                                'description' => 'Oli transmisi untuk perpindahan halus.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1018,
                                'name' => 'Sensor Pintu',
                                'category' => 'keamanan',
                                'subcategory' => 'alarm',
                                'price' => 99000,
                                'old_price' => 0,
                                'brand' => 'SecureSense',
                                'image' => 'assets/images/products/security.svg',
                                'description' => 'Sensor pintu untuk sistem alarm mobil.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1019,
                                'name' => 'Lampu Kabut Pro',
                                'category' => 'lampu',
                                'subcategory' => 'foglamp',
                                'price' => 340000,
                                'old_price' => 380000,
                                'brand' => 'FogPro',
                                'image' => 'assets/images/products/foglamp.svg',
                                'description' => 'Foglamp fokus tinggi untuk visibilitas maksimal.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1020,
                                'name' => 'Karpet Lantai Premium',
                                'category' => 'interior',
                                'subcategory' => 'jok',
                                'price' => 160000,
                                'old_price' => 0,
                                'brand' => 'FloorFit',
                                'image' => 'assets/images/products/interior.svg',
                                'description' => 'Karpet anti air dan mudah dibersihkan.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1021,
                                'name' => 'Emblem Krom',
                                'category' => 'exterior',
                                'subcategory' => 'body kit',
                                'price' => 75000,
                                'old_price' => 0,
                                'brand' => 'ShineMark',
                                'image' => 'assets/images/products/exterior.svg',
                                'description' => 'Emblem dekoratif bahan krom tahan karat.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1022,
                                'name' => 'Adaptor USB Mobil',
                                'category' => 'electronics',
                                'subcategory' => 'kamera',
                                'price' => 65000,
                                'old_price' => 80000,
                                'brand' => 'ChargeIt',
                                'image' => 'assets/images/products/electronics.svg',
                                'description' => 'Adaptor USB fast-charging untuk mobil.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1023,
                                'name' => 'Pembersih Interior',
                                'category' => 'perawatan',
                                'subcategory' => 'filter',
                                'price' => 89000,
                                'old_price' => 0,
                                'brand' => 'CleanCar',
                                'image' => 'assets/images/products/care.svg',
                                'description' => 'Pembersih serbaguna untuk interior mobil.',
                                'is_promo' => false,
                            ],
                            [
                                'id' => 1024,
                                'name' => 'Kunci Roda Anti Maling',
                                'category' => 'keamanan',
                                'subcategory' => 'alarm',
                                'price' => 220000,
                                'old_price' => 250000,
                                'brand' => 'WheelLock',
                                'image' => 'assets/images/products/security.svg',
                                'description' => 'Pengaman roda untuk mencegah pencurian.',
                                'is_promo' => true,
                            ],
                            [
                                'id' => 1025,
                                'name' => 'Headlight Projector',
                                'category' => 'lampu',
                                'subcategory' => 'headlight',
                                'price' => 760000,
                                'old_price' => 0,
                                'brand' => 'BeamX',
                                'image' => 'assets/images/products/headlight.svg',
                                'description' => 'Headlight projector fokus tajam dan terang.',
                                'is_promo' => false,
                            ],
                        ];
                    @endphp
                    @foreach ($sampleProducts as $p)
                        @php
                            $img = url('/' . ltrim($p['image'], '/'));
                            $priceStr = 'Rp ' . number_format($p['price'], 0, ',', '.');
                            $oldStr = ($p['old_price'] ?? 0) > 0 ? 'Rp ' . number_format($p['old_price'], 0, ',', '.') : null;
                        @endphp
                        <div class="product-card" data-id="{{ $p['id'] }}" data-name="{{ $p['name'] }}"
                            data-category="{{ strtolower($p['category']) }}"
                            data-subcategory="{{ strtolower($p['subcategory']) }}"
                            data-price="{{ $p['price'] }}" data-description="{{ $p['description'] }}"
                            data-image="{{ $img }}" data-old-price="{{ $p['old_price'] ?? '' }}"
                            data-is-promo="{{ ($p['is_promo'] ?? false) || (($p['old_price'] ?? 0) > ($p['price'] ?? 0)) ? 1 : 0 }}"
                            data-brand="{{ $p['brand'] }}">
                            <div class="product-image">
                                <img src="{{ $img }}" alt="{{ $p['name'] }}" class="product-img">
                                @if(($p['is_promo'] ?? false) || (($p['old_price'] ?? 0) > ($p['price'] ?? 0)))
                                    <div class="promo-flag"><span class="promo-text">PROMO</span></div>
                                @endif
                            </div>
                            <div class="product-info">
                                <div class="product-category">{{ ucfirst($p['category']) }}</div>
                                <h4>{{ $p['name'] }}</h4>
                                @if($p['brand'])
                                    <div class="product-brand" style="font-size:0.85rem;color:#6b7280;margin-top:2px;">Brand: {{ $p['brand'] }}</div>
                                @endif
                                <div class="product-price-wrapper">
                                    @if(($p['old_price'] ?? 0) > ($p['price'] ?? 0))
                                        <div class="product-price-original">{{ $oldStr }}</div>
                                    @endif
                                    <div class="product-price">{{ $priceStr }}</div>
                                    @if(($p['old_price'] ?? 0) > ($p['price'] ?? 0))
                                        <div class="product-savings"><i class="fas fa-tag"></i> Hemat {{ 'Rp ' . number_format((int)(($p['old_price'] ?? 0) - ($p['price'] ?? 0)), 0, ',', '.') }}</div>
                                    @endif
                                </div>
                                <p>{{ Str::limit($p['description'], 150) }}</p>
                                <div class="product-buttons">
                                    <button class="btn btn-detail" onclick="showProductDetail({{ $p['id'] }})">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <nav class="pagination" id="paginationControls" aria-label="Navigasi halaman"></nav>
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

    <footer class="tenant-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">
                            @if ($userStore && $userStore->store_logo)
                                <img src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => ltrim($userStore->store_logo, '/')]) }}"
                                     alt="{{ $userStore->store_name }}"
                                     loading="lazy" decoding="async"
                                     style="width:100px;height:100px;object-fit:contain;background:transparent;border-radius:8px;">
                            @else
                                <img src="{{ asset('assets/demo/toko-aksesoris-mobil/images/icon.png') }}"
                                     alt="Logo"
                                     loading="lazy" decoding="async"
                                     style="width:100px;height:100px;object-fit:contain;border-radius:8px;">
                            @endif
                        </div>
                        <div class="footer-logo-text">
                            <span class="footer-logo-main">TOKO AKSESORIS MOBIL</span>
                            <span class="footer-logo-sub">PREMIUM ACCESSORIES</span>
                        </div>
                    </div>
                    <p>{{ $userStore->store_description }}</p>
                    <div class="social-links">
                        <a href="{{ $userStore->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $userStore->twitter_url }}"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $userStore->instagram_url }}"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="footer-divider"></div>
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

    <style>
        /* Pagination modern & konsisten dengan tema */
        .pagination { 
            display: flex; 
            gap: 10px; 
            align-items: center; 
            justify-content: center; 
            margin-top: 24px; 
            flex-wrap: wrap;
        }
        .page-btn, .page-number {
            background: #ffffff;
            color: #111827; /* slate-900 */
            border: 1px solid #d1d5db; /* gray-300 */
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            min-width: 38px;
            line-height: 1;
            box-shadow: 0 1px 2px rgba(0,0,0,0.06);
        }
        .page-number.active {
            background: #1f2937; /* gray-800 */
            color: #ffffff;
            border-color: #1f2937;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .page-btn:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
        .page-btn:hover:not(:disabled), .page-number:hover {
            background: #111827; /* slate-900 */
            color: #ffffff;
            border-color: #111827;
        }
        /* Footer styling sesuai referensi */
        .tenant-footer { background: #0f172a; color: #e5e7eb; padding-top: 32px; }
        .tenant-footer .footer-content { display:flex; gap:32px; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; }
        .tenant-footer .footer-section { flex: 1 1 280px; }
        .tenant-footer .footer-logo { display:flex; align-items:center; gap:12px; margin-bottom:10px; }
        .tenant-footer .footer-logo-icon img { width:100px; height:100px; object-fit:contain; border-radius:8px; background:transparent; }
        .tenant-footer .footer-logo-text { display:flex; flex-direction:column; }
        .tenant-footer .footer-logo-main { font-weight:700; font-size:24px; color:#fff; letter-spacing:.5px; }
        .tenant-footer .footer-logo-sub { font-weight:600; font-size:12px; letter-spacing:1.6px; color:#93c5fd; }
        .tenant-footer .footer-desc { margin:8px 0 12px; color:#cbd5e1; }
        .tenant-footer .social-links { display:flex; gap:12px; margin-top:12px; }
        .tenant-footer .social-links a { width:38px; height:38px; display:flex; align-items:center; justify-content:center; border-radius:50%; background:#1e293b; color:#e5e7eb; border:1px solid #334155; transition:all .2s ease; }
        .tenant-footer .social-links a:hover { background:#1f2937; color:#fff; }
        .tenant-footer .footer-divider { border-top:1px solid #334155; opacity:.6; margin:16px 0 0; }
        .tenant-footer .footer-section h3 { color:#fff; font-weight:700; margin-bottom:8px; }
        .tenant-footer .footer-section h3::after { content:""; display:block; width:60px; height:2px; background:#93c5fd; margin-top:8px; border-radius:2px; }
        .tenant-footer .footer-contact ul { list-style:none; padding:0; margin:0; }
        .tenant-footer .footer-contact li { display:flex; gap:10px; align-items:flex-start; margin-bottom:8px; color:#cbd5e1; }
        .tenant-footer .footer-contact i { width:16px; text-align:center; margin-top:3px; color:#93c5fd; }
        .tenant-footer .footer-bottom { border-top:1px solid #1f2937; margin-top:22px; padding:14px 0; text-align:center; color:#94a3b8; }
        @media (max-width: 640px) { .tenant-footer .footer-content { gap:20px; } .tenant-footer .social-links a { width:32px; height:32px; } }
    </style>

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
                document.getElementById('subCategoryFilter').addEventListener('change', applyFilters);
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

            // Pagination state
            let itemsPerPage = 12;
            let currentPage = 1;
            let lastFilteredCards = [];

            function applyFilters() {
                const searchInput = document.getElementById('productSearchInput').value.toLowerCase();
                const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
                const priceFilterSelect = document.getElementById('priceFilter');
                const subCategoryFilter = document.getElementById('subCategoryFilter').value.toLowerCase();
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
                    const productSubCategory = (card.getAttribute('data-subcategory') || '').toLowerCase();
                    const productDesc = card.getAttribute('data-description').toLowerCase();

                    const matchesSearch = searchInput === '' || productName.includes(searchInput) ||
                        productDesc.includes(searchInput);
                    const matchesCategory = categoryFilter === 'all' || productCategory === categoryFilter;
                    const matchesPrice = checkPriceRange(productPrice, priceMin, priceMax);
                    const matchesSubCategory = subCategoryFilter === 'all' || productSubCategory === subCategoryFilter;

                    if (matchesSearch && matchesCategory && matchesSubCategory && matchesPrice) {
                        // Tunda penampilan: akan ditentukan oleh pagination
                        card.style.display = 'none';
                        visibleCards.push(card);
                    } else {
                        card.style.display = 'none';
                    }
                });

                updateSectionTitle(searchInput, categoryFilter, subCategoryFilter, selectedPriceOption.value, visibleCards.length);
                lastFilteredCards = visibleCards;
                currentPage = 1;
                renderPage(currentPage);
                renderPagination();
                if (visibleCards.length === 0) displayNoProductsMessage();
            }

            function checkPriceRange(price, min, max) {
                if (min === null || isNaN(price)) return true;
                const minVal = parseInt(min);
                const maxVal = max ? parseInt(max) : Infinity;
                return price >= minVal && (maxVal === Infinity || price <= maxVal);
            }

            function updateSectionTitle(searchInput, categoryFilter, subCategoryFilter, priceFilter, count) {
                const sectionTitle = document.querySelector('#products .section-title');
                if (!sectionTitle) return;
                const categoryNames = {
                    'interior': 'Produk Interior',
                    'exterior': 'Produk Eksterior',
                    'electronics': 'Produk Elektronik',
                    'perawatan': 'Produk Perawatan',
                    'keamanan': 'Produk Keamanan',
                    'lampu': 'Produk Pencahayaan',
                    'general': 'Produk Umum'
                };
                const subCategoryNames = {
                    'jok': 'Subkategori: Jok',
                    'dashboard': 'Subkategori: Dashboard',
                    'spoiler': 'Subkategori: Spoiler',
                    'body kit': 'Subkategori: Body Kit',
                    'kamera': 'Subkategori: Kamera',
                    'oli': 'Subkategori: Oli',
                    'filter': 'Subkategori: Filter',
                    'alarm': 'Subkategori: Alarm',
                    'dashcam': 'Subkategori: Dashcam',
                    'headlight': 'Subkategori: Headlight',
                    'foglamp': 'Subkategori: Foglamp',
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
                } else if (subCategoryFilter !== 'all') {
                    titleText = subCategoryNames[subCategoryFilter] || `Subkategori: ${subCategoryFilter}`;
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

            function renderPage(page) {
                const total = lastFilteredCards.length;
                const totalPages = Math.max(1, Math.ceil(total / itemsPerPage));
                currentPage = Math.min(Math.max(page, 1), totalPages);
                const start = (currentPage - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                lastFilteredCards.forEach((card, idx) => {
                    card.style.display = (idx >= start && idx < end) ? 'flex' : 'none';
                });
            }

            function renderPagination() {
                const container = document.getElementById('paginationControls');
                if (!container) return;
                const total = lastFilteredCards.length;
                const totalPages = Math.ceil(total / itemsPerPage);
                if (totalPages <= 1) { container.style.display = 'none'; container.innerHTML = ''; return; }
                container.style.display = 'flex';

                let html = '';
                const prevDisabled = currentPage === 1 ? 'disabled' : '';
                const nextDisabled = currentPage === totalPages ? 'disabled' : '';
                html += `<button class="page-btn" ${prevDisabled} onclick="changePage(${currentPage - 1})" aria-label="Sebelumnya">Sebelumnya</button>`;

                // tampilkan maksimal 5 nomor halaman di sekitar current
                const windowSize = 5;
                let start = Math.max(1, currentPage - Math.floor(windowSize / 2));
                let end = Math.min(totalPages, start + windowSize - 1);
                if (end - start + 1 < windowSize) start = Math.max(1, end - windowSize + 1);

                for (let p = start; p <= end; p++) {
                    const activeClass = p === currentPage ? 'active' : '';
                    html += `<button class="page-number ${activeClass}" onclick="changePage(${p})" aria-label="Halaman ${p}">${p}</button>`;
                }

                html += `<button class="page-btn" ${nextDisabled} onclick="changePage(${currentPage + 1})" aria-label="Berikutnya">Berikutnya</button>`;
                container.innerHTML = html;
            }

            window.changePage = function(n) {
                renderPage(n);
                renderPagination();
                // scroll ke atas grid
                const grid = document.getElementById('productsGrid');
                if (grid) grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
                    image: productCard.getAttribute('data-image'),
                    brand: productCard.getAttribute('data-brand') || '',
                    oldPrice: parseInt(productCard.getAttribute('data-old-price')) || null,
                    isPromo: productCard.getAttribute('data-is-promo') === '1'
                };

                const formattedPrice = `Rp ${new Intl.NumberFormat('id-ID').format(data.price)}`;
                const formattedOldPrice = data.oldPrice && data.oldPrice > data.price ? `Rp ${new Intl.NumberFormat('id-ID').format(data.oldPrice)}` : null;
                const savings = (data.oldPrice && data.oldPrice > data.price) ? (data.oldPrice - data.price) : 0;
                const formattedSavings = savings > 0 ? `Rp ${new Intl.NumberFormat('id-ID').format(savings)}` : null;
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
                        <div class="product-detail-image" style="position:relative;">
                            ${data.image ? `<img src="${data.image}" alt="${data.name}" class="detail-product-img">` : '<div class="detail-no-image"><i class="fas fa-image"></i></div>'}
                            ${data.isPromo ? `<div class=\"promo-flag\" style=\"position:absolute;top:12px;left:12px;right:auto;\"><span class=\"promo-text\">PROMO</span></div>` : ''}
                        </div>
                        <div class="product-basic-info">
                            <div class="product-detail-category" style="background-color: ${categoryColor};"><i class="fas fa-tag"></i> ${data.category}</div>
                            ${data.brand ? `<div class="product-detail-brand" style="font-size:.9rem;color:#666;margin-top:6px;"><i class="fas fa-industry"></i> Brand: ${data.brand}</div>` : ''}
                            <h3 class="product-detail-title">${data.name}</h3>
                            <div class="product-detail-price">
                                ${formattedOldPrice ? `<span class=\"product-price-original\" style=\"margin-right:8px;\">${formattedOldPrice}</span>` : ''}
                                <span class=\"product-price\">${formattedPrice}</span>
                                ${formattedSavings ? `<span class=\"product-savings\" style=\"margin-left:10px;\"><i class=\"fas fa-tag\"></i> Hemat ${formattedSavings}</span>` : ''}
                            </div>
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
                            <div class="similar-products" style="margin-top:24px;">
                                <h4><i class="fas fa-star"></i> Produk Serupa</h4>
                                <div class="similar-grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;">
                                    ${(() => {
                                        const similar = Array.from(allProducts)
                                            .filter(c => c.getAttribute('data-category') === data.category && c.getAttribute('data-id') !== String(productId))
                                            .slice(0, 4);
                                        return similar.map(c => {
                                            const sid = c.getAttribute('data-id');
                                            const sname = c.getAttribute('data-name');
                                            const sprice = parseInt(c.getAttribute('data-price')) || 0;
                                            const sold = parseInt(c.getAttribute('data-old-price')) || null;
                                            const simg = c.getAttribute('data-image');
                                            const sPriceStr = `Rp ${new Intl.NumberFormat('id-ID').format(sprice)}`;
                                            const sOldStr = sold && sold > sprice ? `Rp ${new Intl.NumberFormat('id-ID').format(sold)}` : null;
                                            return `
                                                <div class=\"similar-item\" onclick=\"showProductDetail(${sid})\" style=\"cursor:pointer;border:1px solid #eee;border-radius:12px;padding:10px;background:#fff;\">
                                                    <div class=\"similar-image\" style=\"width:100%;height:120px;overflow:hidden;border-radius:8px;background:#f6f6f6;display:flex;align-items:center;justify-content:center;\">
                                                        ${simg ? `<img src='${simg}' alt='${sname}' style='width:100%;height:100%;object-fit:cover;'>` : `<i class='fas fa-image' style='color:#999;'></i>`}
                                                    </div>
                                                    <div class=\"similar-info\" style=\"margin-top:8px;\">
                                                        <div class=\"similar-name\" style=\"font-weight:600;font-size:.95rem;\">${sname}</div>
                                                        <div class=\"similar-price\" style=\"font-size:.9rem;\">
                                                            ${sOldStr ? `<span class='product-price-original' style='margin-right:6px;'>${sOldStr}</span>` : ''}
                                                            <span class='product-price'>${sPriceStr}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                        }).join('');
                                    })()}
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
                const phoneNumber = '{{ $userStore->store_phone ?? '' }}';
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
