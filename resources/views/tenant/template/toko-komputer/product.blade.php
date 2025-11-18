<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon"
        href="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
        type="image/x-icon">
    {{-- SEO Meta Tags for Product --}}
    <title>{{ $userStore->store_name ?? 'TechZone' }} - Detail Produk - {{ $product->name }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($product->description), 155) }}">
    <meta name="keywords"
        content="{{ $product->name }}, {{ $product->category->name ?? '' }}, {{ $userStore->store_name ?? '' }}">
    <meta property="og:title" content="{{ $product->name }} - {{ $userStore->store_name ?? 'TechZone' }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 155) }}" />
    <meta property="og:image" content="{{ $product->primary_image_src }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="product" />

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="min-h-screen bg-white">
    {{-- Header --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 flex items-center justify-center lg:justify-start h-16">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                @if ($userStore->store_logo)
                    <img class="rounded h-8 w-8 sm:h-10 sm:w-10"
                        src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                        alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy" decoding="async" />
                @else
                    <img class="rounded h-8 w-8 sm:h-10 sm:w-10"
                        src="{{ asset('assets/demo/toko-komputer/img/temp/logo-toko.png') }}"
                        alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy" decoding="async" />
                @endif
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-cyan-500">
                    {{ $userStore->store_name ?? 'TechZone' }}
                </h1>
            </a>
        </div>
    </header>

    {{-- Main Product Content --}}
    <main class="container mx-auto px-4 sm:px-6 py-8">
        <div class="p-6 md:p-8">
            <a href="{{ route('tenant.store.index') }}"
                class="inline-flex items-center px-3 py-1.5 border border-cyan-500 text-cyan-500 text-sm rounded-full hover:bg-sky-50 transition mb-4">
                <i class="fas fa-arrow-left mr-1"></i> Ke halaman Toko
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Images -->
                <div class="space-y-4">
                    <div class="relative aspect-square bg-gray-100 rounded-xl overflow-hidden">
                        <img id="main-image"
                            src="{{ $product->primary_image_src ?: asset('assets/images/no-image-icon.png') }}"
                            alt="{{ $product->name }}" class="w-full h-full object-contain cursor-zoom-in" />

                        <button id="fullscreen-button"
                            class="absolute top-3 right-3 bg-gray-900/50 p-2 rounded-full text-white hover:bg-gray-900 transition-colors"
                            title="Lihat gambar penuh">
                            <i data-lucide="maximize" class="h-6 w-6"></i>
                        </button>

                        @if ($product->is_promo)
                            <div class="absolute top-2 left-2">
                                <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Promo
                                </span>
                            </div>
                        @endif

                        {{-- @if ($product->stock <= 0)
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                <span class="bg-red-500 text-white px-6 py-3 rounded-lg text-lg font-medium">
                                    Stok Habis
                                </span>
                            </div>
                        @endif --}}
                    </div>

                    <!-- Thumbnail Images -->
                    <div id="thumbnail-container" class="grid grid-cols-4 gap-3">
                        @php
                            // Logic to prepare images, ensuring primary is first, mirroring index.blade.php logic
                            $all_images = $product->images
                                ? $product->images
                                    ->sortBy('position')
                                    ->map(
                                        fn($img) => route('tenant.asset.domain', [
                                            'path' => ltrim($img->image_url, '/'),
                                        ]),
                                    )
                                    ->values()
                                    ->all()
                                : [];
                            $primary_image = $product->primary_image_src;
                            if ($primary_image) {
                                $is_already_in_list = collect($all_images)->contains(function ($url) use (
                                    $primary_image,
                                ) {
                                    return rtrim($url, '/') === rtrim($primary_image, '/');
                                });
                                if (!$is_already_in_list) {
                                    // Prepend primary image if it's not already in the list
                                    array_unshift($all_images, $primary_image);
                                }
                            }
                        @endphp
                        @forelse ($all_images as $index => $image_url)
                            <button
                                class="thumbnail aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 {{ $index == 0 ? 'border-blue-600' : 'border-transparent' }} hover:border-gray-300"
                                data-full-src="{{ $image_url }}">
                                <img class="thumbnail-image w-full h-full object-cover" loading="lazy" decoding="async"
                                    src="{{ $image_url }}" alt="Thumbnail {{ $index + 1 }}" />
                            </button>
                        @empty
                            {{-- No thumbnails to show if there are no images at all --}}
                        @endforelse
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 leading-tight">
                            {{ $product->name }}
                        </h1>
                        <p class="text-blue-600 font-medium mt-2">
                            {{ $product->category->name ?? 'Uncategorized' }}
                            @if ($product->subcategory)
                                > {{ $product->subcategory->name }}
                            @endif
                        </p>
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <div class="flex items-baseline space-x-3 flex-wrap">
                            <span class="text-2xl font-bold text-gray-900">
                                {{ $product->price_idr }}
                            </span>
                            @if ($product->old_price && $product->old_price > $product->price)
                                <span class="text-sm text-gray-500 line-through">
                                    {{ $product->old_price_idr }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Deskripsi
                        </h3>
                        <div class="text-gray-700 leading-relaxed prose">
                            @if ($product->description)
                                {!! $product->description !!}
                            @else
                                <span>Tidak Ada Deskripsi</span>
                            @endif
                        </div>
                    </div>

                    <!-- Specifications -->
                    @if ($product->specification && count($product->specification) > 0)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                Spesifikasi
                            </h3>
                            <ul class="space-y-2">
                                @foreach ($product->specification as $key => $value)
                                    @if ($value)
                                        <li class="flex justify-between py-1">
                                            <span class="text-gray-600">{{ $key }}</span>
                                            <span class="font-medium text-right">{{ $value }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Chat Button -->
                    <div class="pt-6 border-t border-gray-200">
                        <a href="https://wa.me/{{ $userStore->store_phone }}?text=Halo, saya tertarik dengan produk {{ urlencode($product->name) }}"
                            target="_blank"
                            class="w-full flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                            <i data-lucide="message-circle" class="h-5 w-5 mr-2"></i>
                            Chat Toko
                        </a>
                    </div>
                    <!-- Share buttons -->
                    <div class="pt-4">
                        <div class="flex flex-wrap gap-2">
                            <button id="share-button"
                                class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm">
                                <i data-lucide="share-2" class="h-4 w-4"></i>
                                Share Produk
                            </button>
                            <button id="copy-link-button"
                                class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm">
                                <i data-lucide="copy" class="h-4 w-4"></i>
                                Salin Link
                            </button>
                            @if (in_array('barcodeproduk', $menus))
                                <button id="show-barcode-button"
                                    class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm">
                                    <i data-lucide="barcode" class="h-4 w-4"></i>
                                    Tampilkan Barcode
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Similar Products Section (AJAX-powered) -->
        <div id="similar-products-section" class="pt-12 mt-12 border-t border-gray-200 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Produk Serupa</h2>
            <div id="similar-products-container"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 max-w-screen-lg mx-auto gap-4 md:gap-6">
                <!-- Products will be loaded here by AJAX -->
            </div>
        </div>
    </main>

    {{-- Image Lightbox --}}
    <div id="image-lightbox"
        class="hidden fixed inset-0 bg-black bg-opacity-80 z-[60] flex items-center justify-center p-4">
        <img id="lightbox-image" src="" alt="Fullscreen product image"
            class="max-w-full max-h-full object-contain" />
        <button id="lightbox-close" class="absolute top-4 right-4 text-white/80 hover:text-white">
            <i data-lucide="x" class="h-8 w-8"></i>
        </button>
        <button id="lightbox-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-gray-900/50 p-2 rounded-full text-white hover:bg-gray-900 transition-colors">
            <i data-lucide="chevron-left" class="h-8 w-8"></i>
        </button>
        <button id="lightbox-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-gray-900/50 p-2 rounded-full text-white hover:bg-gray-900 transition-colors">
            <i data-lucide="chevron-right" class="h-8 w-8"></i>
        </button>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300">
        <div class="container mx-auto px-4 sm:px-6 py-12 lg:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="space-y-4 mr-6">
                    <a href="{{ url('/') }}" class="flex items-center space-x-4 mb-4">
                        @if (isset($userStore->store_logo))
                            <img class="h-16 w-16 rounded"
                                src="{{ route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
                                alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy"
                                decoding="async" />
                        @else
                            <img class="h-16 w-16 rounded" src="{{ asset('assets/images/no-image-icon.png') }}"
                                alt="{{ $userStore->store_name ?? 'TechZone' }} Logo" loading="lazy"
                                decoding="async" />
                        @endif
                        <span class="text-4xl font-bold text-white">{{ $userStore->store_name ?? 'TechZone' }}</span>
                    </a>
                    <p class="text-base text-gray-400">
                        {{ $userStore->store_description ?? 'Your one-stop solution for all things tech.' }}
                    </p>
                </div>
                <div class="space-y-4 mr-6">
                    <h3 class="text-white font-semibold text-lg lg:text-xl mb-4 lg:mb-6">Contact</h3>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="map-pin" class="h-4 w-4 lg:h-5 lg:w-5 text-cyan-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">Store Address</p>
                            <p class="text-xs lg:text-sm text-gray-400">{{ $userStore->store_address ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="phone" class="h-4 w-4 lg:h-5 lg:w-5 text-cyan-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">Phone & WhatsApp</p>
                            <p class="text-xs lg:text-sm text-gray-400">{{ $userStore->store_phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i data-lucide="mail" class="h-4 w-4 lg:h-5 lg:w-5 text-cyan-400 mt-1 flex-shrink-0"></i>
                        <div>
                            <p class="font-medium text-white text-sm lg:text-base">Email</p>
                            <p class="text-xs lg:text-sm text-gray-400">{{ $userStore->store_email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-4 sm:px-6 py-4 lg:py-6">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0">
                    <div class="text-center sm:text-left">
                        <p class="text-xs lg:text-sm text-gray-400">
                            &copy; {{ date('Y') }} {{ $userStore->store_name ?? 'TechZone' }}. All rights
                            reserved. - Powered by KatalogQu
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Barcode Modal -->
    <div id="barcode-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-md p-6 text-center relative">
            <button id="barcode-modal-close" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Barcode Produk</h3>
            <div class="w-full">
                <svg id="barcode" class="mx-auto"
                    style="height: auto !important; width: 100% !important; max-width: 100% !important;"></svg>
            </div>
            <p class="text-sm text-gray-500 mt-2">SKU: {{ $product->sku ?: 'N/A' }}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        // Icon
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('main-image');
            const thumbnailContainer = document.getElementById('thumbnail-container');
            const imageLightbox = document.getElementById('image-lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxClose = document.getElementById('lightbox-close');
            const lightboxPrev = document.getElementById('lightbox-prev');
            const lightboxNext = document.getElementById('lightbox-next');
            const fullscreenButton = document.getElementById('fullscreen-button');

            const shareButton = document.getElementById('share-button');
            const copyLinkButton = document.getElementById('copy-link-button');

            const allImages = Array.from(document.querySelectorAll('.thumbnail')).map(t => t.dataset.fullSrc);
            let currentLightboxIndex = 0;

            // Thumbnail click
            if (thumbnailContainer) {
                thumbnailContainer.addEventListener('click', function(e) {
                    const btn = e.target.closest('.thumbnail');
                    if (!btn) return;
                    mainImage.src = btn.dataset.fullSrc;
                    document.querySelectorAll('#thumbnail-container .thumbnail').forEach(el => el.classList
                        .remove('border-blue-600'));
                    btn.classList.add('border-blue-600');
                });
            }


            // Lightbox logic
            function showLightbox(index) {
                if (allImages.length === 0) return;
                currentLightboxIndex = index;
                lightboxImage.src = allImages[currentLightboxIndex];
                imageLightbox.classList.remove('hidden');
            }

            function closeLightbox() {
                imageLightbox.classList.add('hidden');
            }

            function showNextImage() {
                if (allImages.length === 0) return;
                currentLightboxIndex = (currentLightboxIndex + 1) % allImages.length;
                lightboxImage.src = allImages[currentLightboxIndex];
            }

            function showPrevImage() {
                if (allImages.length === 0) return;
                currentLightboxIndex = (currentLightboxIndex - 1 + allImages.length) % allImages.length;
                lightboxImage.src = allImages[currentLightboxIndex];
            }

            if (mainImage) {
                mainImage.addEventListener('click', () => {
                    const currentIndex = allImages.indexOf(mainImage.src);
                    if (currentIndex !== -1) {
                        showLightbox(currentIndex);
                    }
                });
            }

            if (fullscreenButton) {
                fullscreenButton.addEventListener('click', () => {
                    const currentIndex = allImages.indexOf(mainImage.src);
                    if (currentIndex !== -1) {
                        showLightbox(currentIndex);
                    }
                });
            }


            lightboxClose.addEventListener('click', closeLightbox);
            lightboxNext.addEventListener('click', showNextImage);
            lightboxPrev.addEventListener('click', showPrevImage);

            // Share & copy link logic
            const productUrl = window.location.href;
            copyLinkButton.onclick = () => {
                navigator.clipboard.writeText(productUrl).then(() => alert('Link produk disalin!'));
            };
            shareButton.onclick = () => {
                if (navigator.share) {
                    navigator.share({
                        title: '{{ $product->name }}',
                        text: 'Lihat produk ini: {{ $product->name }}',
                        url: productUrl
                    });
                } else {
                    alert('Fitur share tidak didukung di browser ini.');
                }
            };

            // --- Barcode Modal Logic ---
            const showBarcodeBtn = document.getElementById('show-barcode-button');
            const barcodeModal = document.getElementById('barcode-modal');
            const barcodeModalClose = document.getElementById('barcode-modal-close');
            const barcodeValue = '{{ $product->sku ?: $product->id }}';

            if (showBarcodeBtn && barcodeModal && barcodeModalClose && barcodeValue) {
                showBarcodeBtn.addEventListener('click', () => {
                    try {
                        JsBarcode("#barcode", barcodeValue, {
                            format: "CODE128",
                            lineColor: "#000",
                            displayValue: true
                        });

                        // Explicitly set width and height attributes after generation
                        const svgElement = document.getElementById('barcode');
                        if (svgElement) {
                            svgElement.setAttribute('width', '100%');
                            svgElement.setAttribute('height', 'auto');
                            svgElement.style.maxWidth = '100%'; // Ensure max-width is also applied
                        }

                        barcodeModal.classList.remove('hidden');
                        // Re-render icons in the modal if they weren't picked up initially
                        lucide.createIcons({
                            nodes: [barcodeModal.querySelector('[data-lucide="x"]')]
                        });
                    } catch (e) {
                        console.error("Error generating barcode:", e);
                        // Fallback for invalid barcode data
                        document.getElementById('barcode').parentElement.innerHTML =
                            '<p class="text-red-500">Error: Gagal membuat barcode. Data tidak valid.</p>';
                    }
                });

                const closeBarcodeModal = () => {
                    barcodeModal.classList.add('hidden');
                };

                barcodeModalClose.addEventListener('click', closeBarcodeModal);
                barcodeModal.addEventListener('click', (e) => {
                    if (e.target === barcodeModal) {
                        closeBarcodeModal();
                    }
                });
            }
        });

        // --- Similar Products AJAX Logic ---
        const similarProductsSection = document.getElementById('similar-products-section');
        const similarProductsContainer = document.getElementById('similar-products-container');
        const currentProductId = {{ $product->id }};
        const currentCategoryId = {{ $product->product_category_id ?? 'null' }};

        if (similarProductsContainer && currentCategoryId && currentCategoryId !== 'null') {
            // Show a loading state
            similarProductsSection.classList.remove('hidden');
            similarProductsContainer.innerHTML = '<p class="text-center col-span-full text-gray-500">Memuat produk serupa...</p>';

            $.ajax({
                url: "{{ route('tenant.products.similar') }}",
                type: 'GET',
                data: {
                    category_id: currentCategoryId,
                    product_id: currentProductId
                },
                success: function(response) {
                    similarProductsContainer.innerHTML = ''; // Clear loading text

                    if (response && Array.isArray(response) && response.length > 0 && !response.debug) {
                        response.forEach(similarProd => {
                            const productUrl = `{{ url('/produk') }}/${similarProd.slug || similarProd.id}`;
                            const imageUrl = (similarProd.productimgs && similarProd.productimgs.length > 0)
                                ? similarProd.productimgs[0].image_url
                                : "{{ asset('assets/images/no-image-icon.png') }}";
                            const priceFormatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(similarProd.price);

                            const cardHtml = `
                                <a href="${productUrl}" class="product-card bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 group border border-gray-200 relative">
                                    <div class="relative overflow-hidden bg-gray-100" style="aspect-ratio: 5 / 4;">
                                        <img class="w-full h-full object-contain transform transition-transform duration-300 group-hover:scale-105"
                                            loading="lazy" decoding="async"
                                            src="${imageUrl}"
                                            alt="${similarProd.name}" />
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-base font-semibold text-gray-800 line-clamp-2">${similarProd.name}</h3>
                                        <div class="flex flex-wrap items-baseline gap-x-1 mt-2">
                                            <span class="text-lg font-bold text-gray-900">${priceFormatted}</span>
                                        </div>
                                    </div>
                                </a>
                            `;
                            similarProductsContainer.innerHTML += cardHtml;
                        });
                    } else {
                        // If no similar products, hide the whole section
                        similarProductsSection.classList.add('hidden');
                    }
                },
                error: function() {
                    // On error, just hide the section
                    similarProductsSection.classList.add('hidden');
                    console.error('Gagal memuat produk serupa.');
                }
            });
        }
    </script>
</body>

</html>
