<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/' . $userStore->store_logo) }}" type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'E-Katalog Fashion' }}</title>

    <meta name="description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta name="keywords" content="fashion, clothing, style, trends, catalog, online shopping, apparel, accessories">
    <meta name="author" content="Fashion E-Catalog Demo">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Fashion E-Catalog Demo">
    <meta property="og:description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/og-image.jpg">

    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/demo/fashion/style.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <div class="brand-icon">
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}" alt="{{ $userStore->store_name }}">
                </div>
                <span class="brand-text">{{ $userStore->store_name }}</span>
            </a>
            <div class="nav-actions">
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="slider-container" id="slider-container">
            <div class="slider-wrapper" id="slider-wrapper">
                <div class="slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
                <div class="slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
                <div class="slide"
                    style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
            </div>
        </div>

        <button class="slider-nav prev">
            <svg viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
        </button>
        <button class="slider-nav next">
            <svg viewBox="0 0 24 24">
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
            </svg>
        </button>

        <div class="slider-indicators" id="slider-indicators">
            <div class="slider-indicator active"></div>
            <div class="slider-indicator"></div>
            <div class="slider-indicator"></div>
        </div>

        <div class="hero-content">
            <h1 class="hero-title">Katalog Fashion</h1>
            <p class="hero-subtitle">Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti</p>
        </div>
    </section>

    <main class="container">
        <section class="section">
            <div class="section-title">
                <h2>Kategori</h2>
                <p>Pilih kategori produk yang Anda inginkan</p>
            </div>

            <div class="category-grid" id="categoryGrid">
                <div class="category-card active" data-category-id="all">
                    <div class="category-name">Semua Produk</div>
                    <div class="category-description">Lihat semua produk yang tersedia</div>
                </div>
                @foreach ($categories as $category)
                    <div class="category-card" data-category-id="{{ $category->id }}"> {{-- Use category ID --}}
                        <div class="category-name">{{ $category->name }}</div>
                        <div class="category-description">{{ $category->description }}</div>
                    </div>
                @endforeach
            </div>

            <div class="subcategory-section" id="subcategorySection" style="display: none;">
                <div class="section-title">
                    <h3>Sub Kategori</h3>
                    <p>Pilih sub kategori untuk filter lebih spesifik</p>
                </div>
                <div class="subcategory-grid" id="subcategoryGrid">
                    {{-- Subcategories will be loaded here by JavaScript --}}
                </div>
            </div>

            <div id="searchContainer" class="search-container">
                <div class="search-and-filters-wrapper">
                    <div class="search-wrapper">
                        <input type="text" id="searchInput" placeholder="Cari produk...">
                    </div>

                    <div class="filters-section">
                        <div class="filter-group">
                            <label for="sortPrice">Urutkan Harga:</label>
                            <select id="sortPrice">
                                <option value="">-- Pilih --</option>
                                <option value="low-high">Harga Terendah</option>
                                <option value="high-low">Harga Tertinggi</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortName">Urutkan Nama:</label>
                            <select id="sortName">
                                <option value="">-- Pilih --</option>
                                <option value="a-z">A - Z</option>
                                <option value="z-a">Z - A</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortDate">Urutkan Tanggal:</label>
                            <select id="sortDate">
                                <option value="">-- Pilih --</option>
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-title">
                <h2>Semua Produk</h2>
                <p>Jelajahi koleksi lengkap kami</p>
            </div>

            <div class="products-grid" id="productsGrid">
            </div>

            <div id="noResults" class="no-results" style="display: none;">
                <h3>Produk yang Anda cari tidak ditemukan</h3>
                <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left-content">
                <div class="footer-logo-section">
                    <div class="footer-brand-icon">
                        <img src="{{ asset('storage/' . $userStore->store_logo) }}"
                            alt="{{ $userStore->store_name }}">
                    </div>
                </div>
                <div class="footer-section footer-text-content">
                    <h3>{{ $userStore->store_name }}</h3>
                    <p>{{ $userStore->store_description }}</p>
                </div>
            </div>
            <div class="footer-middle-space">
            </div>
            <div class="footer-section footer-contact">
                <h3>Informasi Kontak</h3>
                <div class="contact-item">
                    <i class="contact-icon">📞</i>
                    <span>{{ $userStore->store_phone }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">✉️</i>
                    <span>{{ $userStore->store_phone }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">📍</i>
                    <span>{{ $userStore->store_address }}</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Powered by PT. Era Cipta Digital</p>
        </div>
    </footer>

    <div id="productModal" class="product-modal">
        <div class="modal-container">
            <span class="modal-close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <p>Memuat data...</p>
    </div>

    <script>
        const allCategories = @json($categories);
        const allSubcategories = @json($subCategories);
        const initialProducts = @json($products->items()); // Assuming $products is paginated
        let allProducts = initialProducts;

        const ASSET_URL = "{{ asset('storage/') }}";


        const categoryCards = document.querySelectorAll('.category-card');
        const subcategorySection = document.getElementById('subcategorySection');
        const subcategoryGrid = document.getElementById('subcategoryGrid');

        let currentCategory = 'all'; // Default to all products
        let currentSubcategory = null; // Default to no subcategory filter

        // Function to update active category card
        function updateActiveCategoryCard(element) {
            document.querySelectorAll('.category-card').forEach(card => {
                card.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Function to show subcategories based on selected category
        function showSubcategoriesForCategory(categoryId) {
            subcategoryGrid.innerHTML = ''; // Clear previous subcategories

            // Add "All" subcategory card
            const allSubcategoryCard = document.createElement('div');
            allSubcategoryCard.className = 'subcategory-card active';
            allSubcategoryCard.innerHTML = `<div class="subcategory-name">Semua Sub Kategori</div>`;
            allSubcategoryCard.onclick = () => filterBySubcategory(null, allSubcategoryCard);
            subcategoryGrid.appendChild(allSubcategoryCard);

            let relevantSubcategories = [];
            if (categoryId === 'all') {
                relevantSubcategories = allSubcategories;
            } else {
                relevantSubcategories = allSubcategories.filter(sub => sub.category_id == categoryId);
            }

            relevantSubcategories.forEach(subcategory => {
                const subcategoryCard = document.createElement('div');
                subcategoryCard.className = 'subcategory-card';
                subcategoryCard.onclick = () => filterBySubcategory(subcategory.id, subcategoryCard);

                subcategoryCard.innerHTML = `
                    <div class="subcategory-name">${subcategory.name}</div>
                    <div class="subcategory-description">${subcategory.description || ''}</div>
                `;
                subcategoryGrid.appendChild(subcategoryCard);
            });

            subcategorySection.style.display = 'block';
        }

        // Hide subcategories
        function hideSubcategories() {
            subcategorySection.style.display = 'none';
        }

        // Event listeners for category cards
        categoryCards.forEach(card => {
            card.addEventListener('click', function() {
                updateActiveCategoryCard(this);
                const categoryId = this.dataset.categoryId;
                currentCategory = categoryId;

                // Reset subcategory filter when category changes
                currentSubcategory = null;

                if (categoryId === 'all') {
                    hideSubcategories(); // Hide subcategories if "All Products" is selected
                } else {
                    showSubcategoriesForCategory(categoryId);
                }

                // Trigger product filtering based on selected category and reset subcategory
                filterProducts();
            });
        });

        // Initial load: hide subcategories section
        hideSubcategories();

        // Modify filterBySubcategory to use subcategory ID
        function filterBySubcategory(subcategoryId, element) {
            document.querySelectorAll('.subcategory-card').forEach(card => {
                card.classList.remove('active');
            });
            element.classList.add('active');

            currentSubcategory = subcategoryId;
            filterProducts(); // Re-filter products
        }

        // Modify filterProducts to include subcategory filter
        function filterProducts() {
            let filteredProducts = initialProducts; // Start with all initial products

            // Apply category filter
            if (currentCategory !== 'all') {
                filteredProducts = filteredProducts.filter(product =>
                    product.product_category_id == currentCategory
                );
            }

            // Apply subcategory filter
            if (currentSubcategory !== null) {
                filteredProducts = filteredProducts.filter(product =>
                    product.sub_category_id == currentSubcategory
                );
            }

            // Apply search filter
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            if (searchTerm) {
                filteredProducts = filteredProducts.filter(product =>
                    product.name.toLowerCase().includes(searchTerm) ||
                    product.description.toLowerCase().includes(searchTerm) ||
                    product.sku.toLowerCase().includes(searchTerm)
                );
            }

            // Apply price sorting
            const sortPrice = document.getElementById('sortPrice').value;
            if (sortPrice === 'low-high') {
                filteredProducts.sort((a, b) => a.price - b.price);
            } else if (sortPrice === 'high-low') {
                filteredProducts.sort((a, b) => b.price - a.price);
            }

            // Apply name sorting
            const sortName = document.getElementById('sortName').value;
            if (sortName === 'a-z') {
                filteredProducts.sort((a, b) => a.name.localeCompare(b.name));
            } else if (sortName === 'z-a') {
                filteredProducts.sort((a, b) => b.name.localeCompare(a.name));
            }

            // Apply date sorting
            const sortDate = document.getElementById('sortDate').value;
            if (sortDate === 'newest') {
                filteredProducts.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (sortDate === 'oldest') {
                filteredProducts.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            }

            renderProducts(filteredProducts);
        }

        // Event listeners for sorting and search
        document.getElementById('searchInput').addEventListener('keyup', filterProducts);
        document.getElementById('sortPrice').addEventListener('change', filterProducts);
        document.getElementById('sortName').addEventListener('change', filterProducts);
        document.getElementById('sortDate').addEventListener('change', filterProducts);

        // Initial render of products
        filterProducts();

        // Placeholder for renderProducts and loading functions (if not already defined)
        function renderProducts(products) {
            const productsGrid = document.getElementById('productsGrid');
            productsGrid.innerHTML = '';
            if (products.length === 0) {
                document.getElementById('noResults').style.display = 'block';
                return;
            }
            document.getElementById('noResults').style.display = 'none';

            products.forEach(product => {
                console.log('ASSET_URL:', ASSET_URL);
                console.log('Rendered Image URL:', ASSET_URL + '/' + product.primary_image_src);
                const productCard = document.createElement('div');
                productCard.className = 'product-card';
                // productCard.setAttribute('data-category', product.category.toLowerCase()); // Removed as not directly used for filtering
                productCard.setAttribute('data-product-id', product.id);
                productCard.onclick = () => showProductDetails(product.id);

                // Format price
                const formattedPrice = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(product.price);

                // Generate tags HTML (assuming colors are from specification)
                let tagsHTML = '';
                const colors = product.specification && product.specification.colors ? product.specification
                    .colors : [];
                if (colors.length > 0) {
                    const displayColors = colors.slice(0, 3);
                    tagsHTML = `
                <div class="product-tags">
                    ${displayColors.map(color => `<span class="tag">${color}</span>`).join('')}
                    ${colors.length > 3 ? `<span class="tag">+${colors.length - 3}</span>` : ''}
                </div>
            `;
                }

                productCard.innerHTML = `
            <div class="product-image">
                <img src="${ASSET_URL}/${product.primary_image_src}"
                     alt="${product.name}"
                     loading="lazy"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                     onload="this.style.opacity='1';"
                     style="opacity: 0; transition: opacity 0.3s ease;">
                <div class="no-image" style="display: none;">📷 Image Not Available</div>
            </div>
            <div class="product-info">
                <div class="product-category">${product.category ? product.category.name : ''}${product.sub_category ? ' - ' + product.sub_category.name : ''}</div>
                <div class="product-name">${product.name}</div>
                <div class="product-price">${formattedPrice}</div>
                ${tagsHTML}
            </div>
        `;

                productsGrid.appendChild(productCard);
            });
        }

        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }
    </script>

    <script>
        // Show product details in modal
        function showProductDetails(productId) {
            const product = allProducts.find(p => p.id === productId);
            if (!product) return;

            console.log('ASSET_URL:', ASSET_URL);
            console.log('Modal Image URL:', `${ASSET_URL}/${product.primary_image_src}`);

            // Format price
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(product.price);

            // Accessing specification properties
            const material = product.specification && product.specification.material ? product.specification.material : '';
            const sizes = product.specification && product.specification.sizes ? product.specification.sizes : [];
            const colors = product.specification && product.specification.colors ? product.specification.colors : [];

            // Generate sizes HTML
            let sizesHTML = '';
            if (sizes.length > 0) {
                sizesHTML = `
            <div class="modal-section">
                <h4>Ukuran Tersedia:</h4>
                <div class="sizes-list">
                    ${sizes.map(size => `<span class="size-tag">${size}</span>`).join('')}
                </div>
            </div>
        `;
            }

            // Generate colors HTML
            let colorsHTML = '';
            if (colors.length > 0) {
                colorsHTML = `
            <div class="modal-section">
                <h4>Warna Tersedia:</h4>
                <div class="colors-list">
                    ${colors.map(color => `<span class="color-tag">${color}</span>`).join('')}
                </div>
            </div>
        `;
            }

            // Use primary_image_src
            const imageUrl = `${ASSET_URL}/${product.primary_image_src}`;

            modalContent.innerHTML = `
        <div class="modal-product-details">
            <div class="modal-product-image">
                <img src="${imageUrl}"
                     alt="${product.name}"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                     style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;">
                <div class="no-image" style="display: none; height: 400px; background: #f0f0f0; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.2rem; color: #999;">📷 Image Not Available</div>
            </div>
            <div class="modal-product-info">
                <div class="modal-product-category">${product.category ? product.category.name : ''}${product.sub_category ? ' - ' + product.sub_category.name : ''}</div>
                <h2 class="modal-product-name">${product.name}</h2>
                <div class="modal-product-price">${formattedPrice}</div>
                <div class="modal-product-description">
                    <h4>Deskripsi:</h4>
                    <p>${product.description}</p>
                </div>
                ${material ? `
                                                                <div class="modal-section">
                                                                    <h4>Material:</h4>
                                                                    <p>${material}</p>
                                                                </div>
                                                            ` : ''}
                ${product.brand ? `
                                                                <div class="modal-section">
                                                                    <h4>Brand:</h4>
                                                                    <p>${product.brand.name}</p>
                                                                </div>
                                                            ` : ''}
                ${sizesHTML}
                ${colorsHTML}
            </div>
        </div>
    `;

            productModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        // Close modal
        function closeModal() {
            productModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        productModal.addEventListener('click', function(event) {
            if (event.target === productModal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && productModal.style.display === 'block') {
                closeModal();
            }
        });
    </script>

    <style>
        .modal-product-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        .modal-product-category {
            font-size: 0.9rem;
            color: #777;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .modal-product-name {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .modal-product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #999;
            margin-bottom: 1.5rem;
        }

        .modal-section {
            margin-bottom: 1.5rem;
        }

        .modal-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .modal-section p {
            line-height: 1.6;
            color: #555;
        }

        .sizes-list,
        .colors-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .size-tag,
        .color-tag {
            background: #f0f0f0;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid #ddd;
        }

        .stock-info.in-stock {
            color: #28a745;
        }

        .stock-info.low-stock {
            color: #ffc107;
        }

        .stock-info.out-of-stock {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .modal-product-details {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1rem;
            }

            .modal-product-name {
                font-size: 1.5rem;
            }

            .modal-product-price {
                font-size: 1.4rem;
            }
        }
    </style>
</body>

</html>
