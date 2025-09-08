<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name }}</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/barbershop/styles.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body>
    <style>
        .hairstyles-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .hairstyle-card {
            flex: 0 0 250px;
            min-width: 250px;
        }

        @media (max-width: 768px) {
            .hairstyles-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-background-slider">
            <div class="bg-slide active" data-slide="0">
                <div class="bg-image"
                    style="background-image: url('{{ asset('assets/demo/barbershop/img/bgg.jpg') }}')"></div>
            </div>
            <div class="bg-slide" data-slide="1">
                <div class="bg-image"
                    style="background-image: url('{{ asset('assets/demo/barbershop/img/bgg1.jpg') }}')"></div>
            </div>
            <div class="bg-slide" data-slide="2">
                <div class="bg-image"
                    style="background-image: url('{{ asset('assets/demo/barbershop/img/bg.jpeg') }}')"></div>
            </div>
        </div>
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-text">✨ Barbershop Premium</span>
            </div>
            <div class="hero-icon">
                <i class="fas fa-cut"></i>
            </div>
            <h1 class="hero-title">
                <span class="title-main">{{ $userStore->store_name }}</span>
                <span class="title-sub">Professional Style</span>
            </h1>
            <p class="hero-subtitle">
                Transformasi penampilan Anda dengan sentuhan profesional dan
                gaya modern yang memukau
            </p>
            <div class="hero-features">
                <div class="feature-item">
                    <i class="fas fa-award"></i>
                    <span>Kualitas Premium</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clock"></i>
                    <span>Layanan Cepat</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-star"></i>
                    <span>Hasil Memuaskan</span>
                </div>
            </div>
        </div>
        <div class="slider-nav">
            <button class="slider-btn prev" aria-label="Slide sebelumnya">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-btn next" aria-label="Slide selanjutnya">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        <div class="slider-dots">
            <button class="dot active" data-slide="0" aria-label="Slide 1"></button>
            <button class="dot" data-slide="1" aria-label="Slide 2"></button>
            <button class="dot" data-slide="2" aria-label="Slide 3"></button>
        </div>
    </section>

    <section id="style-recommendation" class="style-recommendation">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Rekomendasi Style</h2>
                <p class="section-subtitle">Pilih bentuk wajah Anda untuk mendapatkan rekomendasi style pangkas yang
                    paling cocok</p>
            </div>

            <div class="face-shape-container">
                <div class="face-shape-buttons">
                    <button class="face-shape-btn active" data-category="semua">Semua</button>
                    @foreach ($categories as $category)
                        <button class="face-shape-btn" data-category="{{ strtolower($category->name) }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <div class="recommendation-result" id="recommendationResult">
                    <div class="result-placeholder" id="placeholder">
                        <i class="fas fa-hand-pointer"></i>
                        <p>Pilih bentuk wajah Anda di atas untuk melihat rekomendasi</p>
                    </div>

                    <div id="recommendationContent" style="display: none;">
                        <div class="recommendation-header">
                            <h3 class="recommendation-title">Rekomendasi untuk Wajah <span
                                    id="selectedCategoryTitle"></span></h3>
                            <p class="recommendation-subtitle">Berikut adalah style yang cocok untuk bentuk wajah Anda
                            </p>
                        </div>

                        <div class="hairstyles-grid" id="hairstylesGrid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="productModal" class="modal" style="display: none;">
        <div class="modal-content">
            <button class="modal-close" onclick="closeProductModal()">×</button>
            <img id="modalImage" src="" alt="Hairstyle Image" />
            <h3 id="modalTitle"></h3>
            <p id="modalDescription"></p>
        </div>
    </div>

    <div class="container mt-6">
        <div class="section-header">
            <h2 class="section-title mt-6">Our Hairstyle</h2>
            <p class="section-subtitle">
                Temukan gaya rambut yang sempurna untuk Anda. Dari potongan modern hingga klasik.
            </p>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="hero-icon"
                        style="
                            background: none !important;
                            border: none !important;
                            box-shadow: none !important;
                        ">
                        <i class="fas fa-cut"
                            style="
                                background: none !important;
                                padding: 0 !important;
                                margin: 0 !important;
                                width: auto !important;
                                height: auto !important;
                            "></i>
                    </div>
                    <h1>{{ $userStore->store_name }}</h1>
                </div>
                <div class="footer-contact">
                    <h3 class="footer-title">Kontak Kami</h3>
                    <ul class="footer-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $userStore->store_address ?? 'Alamat toko akan segera diperbarui' }}
                        </li>
                        <li>
                            <i class="fas fa-phone"></i> {{ $userStore->store_phone ?? '+62 813-8549-7404' }}
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            {{ $userStore->store_email ?? 'info@' . strtolower(str_replace(' ', '', $userStore->store_name)) . '.com' }}
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            {{ $userStore->operating_hours ?? 'Sen-Sab: 09:00 - 21:00 | Minggu: 10:00 - 18:00' }}
                        </li>
                    </ul>
                    <div class="footer-social" style="margin-top: 15px">
                        @if ($userStore->instagram_url)
                            <a href="{{ $userStore->instagram_url }}" class="social-link" aria-label="Instagram"
                                target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($userStore->facebook_url)
                            <a href="{{ $userStore->facebook_url }}" class="social-link" aria-label="Facebook"
                                target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Barber. PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allProducts = [
                @foreach ($products as $product)
                    {
                        name: "{{ addslashes($product->name ?? 'Tidak Ada Nama') }}",
                        description: "{{ addslashes($product->description ?? '') }}",
                        image: "{{ addslashes($product->image ?? '') }}",
                        price: {{ $product->price ?? 0 }},
                        duration: "{{ $product->duration ?? '30 min' }}",
                        category: "{{ strtolower($product->category->name ?? 'Lainnya') }}",
                    },
                @endforeach
            ];

            window.ASSET_BASE = "{{ asset('') }}";
            window.assetUrl = function(p) {
                return (window.ASSET_BASE.replace(/\/$/, '') + '/' + String(p).replace(/^\//, ''));
            };

            window.openProductModal = function(title, description, imageUrl) {
                const modal = document.getElementById('productModal');
                const modalImage = document.getElementById('modalImage');
                const modalTitle = document.getElementById('modalTitle');
                const modalDescription = document.getElementById('modalDescription');

                if (modal && modalImage && modalTitle && modalDescription) {
                    modalImage.src = imageUrl;
                    modalTitle.textContent = title;
                    modalDescription.textContent = description;

                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeProductModal = function() {
                const modal = document.getElementById('productModal');
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            };

            window.addEventListener('click', (event) => {
                const modal = document.getElementById('productModal');
                if (event.target === modal) {
                    window.closeProductModal();
                }
            });

            window.toggleDetail = function(btn) {
                const detail = btn.nextElementSibling;
                if (detail.style.display === "none" || detail.style.display === "") {
                    detail.style.display = "block";
                    btn.textContent = "Tutup Detail";
                } else {
                    detail.style.display = "none";
                    btn.textContent = "Detail Layanan";
                }
            };

            const faceShapeButtons = document.querySelectorAll('.face-shape-btn');
            const placeholder = document.getElementById('placeholder');
            const recommendationContent = document.getElementById('recommendationContent');
            const selectedCategoryTitle = document.getElementById('selectedCategoryTitle');
            const hairstylesGrid = document.getElementById('hairstylesGrid');

            function renderProducts(products) {
                hairstylesGrid.innerHTML = '';
                if (products.length === 0) {
                    hairstylesGrid.innerHTML =
                        '<p class="text-center text-gray-500">Tidak ada gaya rambut yang cocok untuk kategori ini.</p>';
                } else {
                    products.forEach(product => {
                        let imageUrl;
                        // Jika ada gambar produk, gunakan URL-nya
                        if (product.image) {
                            imageUrl = window.assetUrl('storage/' + product.image);
                        } else {
                            // Jika tidak ada, gunakan gambar default
                            imageUrl = window.assetUrl('assets/demo/barbershop/img/klasik.png');
                        }

                        const sanitizedDescription = product.description.replace(/'/g, "\\'").replace(/"/g,
                            '\\"');
                        const productHtml = `
            <div class="hairstyle-card">
                <div class="hairstyle-image">
                    <img src="${imageUrl}" alt="${product.name}" />
                    <div class="hairstyle-overlay">
                        <div class="hairstyle-duration"><i class="fas fa-clock"></i><span>${product.duration ?? '30 min'}</span></div>
                    </div>
                </div>
                <div class="hairstyle-content">
                    <h3 class="hairstyle-name">${product.name}</h3>
                    <div class="hairstyle-price">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</div>
                    <button class="hairstyle-btn" onclick="openProductModal('${product.name}', '${sanitizedDescription}', '${imageUrl}')">
                        Detail Gaya Rambut
                    </button>
                </div>
            </div>
            `;
                        hairstylesGrid.innerHTML += productHtml;
                    });
                }
            }

            faceShapeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    faceShapeButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const selectedCategory = button.getAttribute('data-category');
                    const titleText = selectedCategory.charAt(0).toUpperCase() + selectedCategory
                        .slice(1);
                    selectedCategoryTitle.textContent = titleText;

                    placeholder.style.display = 'none';
                    recommendationContent.style.display = 'block';

                    let filteredProducts;
                    if (selectedCategory === 'semua') {
                        filteredProducts = allProducts;
                    } else {
                        filteredProducts = allProducts.filter(product => {
                            return product.category.toLowerCase() === selectedCategory;
                        });
                    }

                    renderProducts(filteredProducts);
                });
            });

            const allButton = document.querySelector('.face-shape-btn[data-category="semua"]');
            if (allButton) {
                allButton.click();
            } else {
                renderProducts(allProducts);
            }
        });
    </script>


</body>

</html>
