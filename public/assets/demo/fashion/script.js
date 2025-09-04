// Embedded Data
const categoriesData = {
  "categories": [
    {
      "id": 1,
      "name": "Pakaian Pria",
      "slug": "pakaian-pria",
      "description": "Koleksi lengkap pakaian pria untuk berbagai kesempatan",
      "image": "demo/images/category-pakaian-pria.svg",
      "subcategories": [
        {
          "id": 1,
          "name": "Kemeja",
          "slug": "kemeja",
          "description": "Kemeja formal dan casual untuk pria"
        },
        {
          "id": 2,
          "name": "Celana",
          "slug": "celana",
          "description": "Celana panjang dan pendek untuk pria"
        },
        {
          "id": 3,
          "name": "Kaos",
          "slug": "kaos",
          "description": "Kaos dan polo shirt untuk pria"
        }
      ]
    },
    {
      "id": 2,
      "name": "Pakaian Wanita",
      "slug": "pakaian-wanita",
      "description": "Koleksi fashion wanita yang trendy dan elegant",
      "image": "demo/images/category-pakaian-wanita.svg",
      "subcategories": [
        {
          "id": 4,
          "name": "Dress",
          "slug": "dress",
          "description": "Dress untuk berbagai acara"
        },
        {
          "id": 5,
          "name": "Blouse",
          "slug": "blouse",
          "description": "Blouse dan atasan wanita"
        },
        {
          "id": 6,
          "name": "Rok",
          "slug": "rok",
          "description": "Rok dengan berbagai model dan panjang"
        }
      ]
    },
    {
      "id": 3,
      "name": "Sepatu",
      "slug": "sepatu",
      "description": "Koleksi sepatu untuk pria dan wanita",
      "image": "demo/images/category-sepatu.svg",
      "subcategories": [
        {
          "id": 7,
          "name": "Sneakers",
          "slug": "sneakers",
          "description": "Sepatu sneakers casual dan sport"
        },
        {
          "id": 8,
          "name": "Formal",
          "slug": "formal",
          "description": "Sepatu formal untuk acara resmi"
        },
        {
          "id": 9,
          "name": "Sandal",
          "slug": "sandal",
          "description": "Sandal dan flip flop"
        }
      ]
    },
    {
      "id": 4,
      "name": "Aksesoris",
      "slug": "aksesoris",
      "description": "Aksesoris fashion untuk melengkapi penampilan",
      "image": "demo/images/category-aksesoris.svg",
      "subcategories": [
        {
          "id": 10,
          "name": "Tas",
          "slug": "tas",
          "description": "Tas untuk pria dan wanita"
        },
        {
          "id": 11,
          "name": "Jam Tangan",
          "slug": "jam-tangan",
          "description": "Jam tangan fashion dan sport"
        },
        {
          "id": 12,
          "name": "Perhiasan",
          "slug": "perhiasan",
          "description": "Perhiasan dan aksesoris fashion"
        }
      ]
    }
  ]
};

const productsData = {
  "products": [
    {
      "id": 1,
      "name": "Kemeja Pria",
      "description": "Kemeja pria berkualitas tinggi dengan bahan katun premium. Cocok untuk acara formal dan kantor. Tersedia dalam berbagai ukuran dengan desain yang modern.",
      "price": 299000,
      "category": "Pakaian Pria",
      "subcategory": "Kemeja",
      "image": "images/KemejaPria.jpeg",
      "stock": 25,
      "sizes": ["S", "M", "L", "XL", "XXL"],
      "colors": ["Putih", "Biru Muda", "Abu-abu"],
      "material": "100% Katun",
      "brand": "Fashion Elite"
    },
    {
      "id": 2,
      "name": "Blouse Wanita",
      "description": "Blouse wanita yang nyaman dan stylish untuk aktivitas sehari-hari. Bahan yang adem dan tidak mudah kusut. Desain yang timeless dan cocok untuk berbagai acara.",
      "price": 189000,
      "category": "Pakaian Wanita",
      "subcategory": "Blouse",
      "image": "images/BlouseWanita.jpeg",
      "stock": 18,
      "sizes": ["XS", "S", "M", "L", "XL"],
      "colors": ["Merah", "Navy", "Hitam", "Cream"],
      "material": "Polyester Blend",
      "brand": "Bella Fashion"
    },
    {
      "id": 3,
      "name": "Celana Pendek Pria",
      "description": "Celana pendek pria yang nyaman untuk aktivitas kasual. Bahan berkualitas tinggi yang tahan lama. Cocok untuk gaya santai dan olahraga.",
      "price": 149000,
      "category": "Pakaian Pria",
      "subcategory": "Celana",
      "image": "images/CelanaPendekPria.jpg",
      "stock": 30,
      "sizes": ["28", "30", "32", "34", "36", "38"],
      "colors": ["Navy", "Khaki", "Black"],
      "material": "Cotton Blend",
      "brand": "Casual Wear"
    },
    {
      "id": 4,
      "name": "Kemeja Wanita",
      "description": "Kemeja wanita elegan dengan desain profesional. Bahan yang breathable dan mudah dirawat. Perfect untuk meeting dan presentasi.",
      "price": 225000,
      "category": "Pakaian Wanita",
      "subcategory": "Kemeja",
      "image": "images/KemejaWanita.jpeg",
      "stock": 22,
      "sizes": ["XS", "S", "M", "L", "XL"],
      "colors": ["Putih", "Cream", "Light Pink", "Light Blue"],
      "material": "Polyester Crepe",
      "brand": "Office Chic"
    },
    {
      "id": 5,
      "name": "Tas Wanita",
      "description": "Tas wanita dengan desain elegant dan sophisticated. Ukuran yang pas untuk kebutuhan sehari-hari. Dilengkapi dengan tali panjang yang bisa dilepas.",
      "price": 389000,
      "category": "Aksesoris",
      "subcategory": "Tas",
      "image": "images/TasWanita.jpeg",
      "stock": 12,
      "sizes": ["One Size"],
      "colors": ["Hitam", "Coklat", "Cream", "Burgundy"],
      "material": "PU Leather",
      "brand": "Elegant Bags"
    },
    {
      "id": 6,
      "name": "Kaos Pria",
      "description": "Kaos pria yang nyaman untuk aktivitas sehari-hari. Bahan yang adem dan menyerap keringat. Desain modern yang cocok untuk berbagai outfit casual.",
      "price": 89000,
      "category": "Pakaian Pria",
      "subcategory": "Kaos",
      "image": "images/KaosPria.jpeg",
      "stock": 35,
      "sizes": ["S", "M", "L", "XL", "XXL"],
      "colors": ["Putih", "Hitam", "Abu-abu", "Navy"],
      "material": "100% Cotton",
      "brand": "Casual Wear"
    },
    {
      "id": 7,
      "name": "Kacamata",
      "description": "Kacamata dengan desain modern dan stylish. Lensa berkualitas tinggi dengan perlindungan UV. Cocok untuk aktivitas outdoor dan fashion.",
      "price": 179000,
      "category": "Aksesoris",
      "subcategory": "Kacamata",
      "image": "images/Kacamata.jpg",
      "stock": 20,
      "sizes": ["One Size"],
      "colors": ["Hitam", "Coklat", "Gold"],
      "material": "Metal & Plastic",
      "brand": "Style Vision"
    },
    {
      "id": 8,
      "name": "Batik Pria",
      "description": "Batik pria dengan motif tradisional yang elegan. Bahan katun berkualitas tinggi. Cocok untuk acara formal maupun semi formal.",
      "price": 249000,
      "category": "Pakaian Pria",
      "subcategory": "Batik",
      "image": "images/BatikPria.jpeg",
      "stock": 28,
      "sizes": ["S", "M", "L", "XL", "XXL"],
      "colors": ["Biru", "Coklat", "Hijau", "Maroon"],
      "material": "100% Cotton",
      "brand": "Heritage Style"
    },
    {
      "id": 9,
      "name": "Casual Pria",
      "description": "Pakaian casual pria dengan desain modern dan nyaman. Bahan berkualitas tinggi yang cocok untuk aktivitas sehari-hari.",
      "price": 159000,
      "category": "Pakaian Pria",
      "subcategory": "Casual",
      "image": "images/CasualPria.jpeg",
      "stock": 40,
      "sizes": ["S", "M", "L", "XL", "XXL"],
      "colors": ["Putih", "Navy", "Merah", "Hijau", "Abu-abu"],
      "material": "Cotton Blend",
      "brand": "Casual Style"
    },
    {
      "id": 10,
      "name": "Cincin Pria",
      "description": "Cincin pria dengan desain elegant dan maskulin. Bahan berkualitas tinggi yang tahan lama. Cocok untuk gaya formal maupun casual.",
      "price": 199000,
      "category": "Aksesoris",
      "subcategory": "Perhiasan",
      "image": "images/CincinPria.jpeg",
      "stock": 15,
      "sizes": ["6", "7", "8", "9", "10"],
      "colors": ["Silver", "Gold", "Black"],
      "material": "Stainless Steel",
      "brand": "Jewelry Style"
    }
  ]
};

// Global variables
let allProducts = [];
let allCategories = [];
let currentFilter = 'all';
let currentSubcategory = null;

// DOM Elements
const loadingOverlay = document.getElementById('loadingOverlay');
const categoryGrid = document.getElementById('categoryGrid');
const subcategorySection = document.getElementById('subcategorySection');
const subcategoryGrid = document.getElementById('subcategoryGrid');
const productsGrid = document.getElementById('productsGrid');
const noResults = document.getElementById('noResults');
const searchInput = document.getElementById('searchInput');
const sortPrice = document.getElementById('sortPrice');
const sortName = document.getElementById('sortName');
const sortDate = document.getElementById('sortDate');
const productModal = document.getElementById('productModal');
const modalContent = document.getElementById('modalContent');

// Initialize the application
document.addEventListener('DOMContentLoaded', function() {
    showLoading();
    loadData();
    initHeroSlider();
});

// Show loading overlay
function showLoading() {
    loadingOverlay.style.display = 'flex';
}

// Hide loading overlay
function hideLoading() {
    loadingOverlay.style.display = 'none';
}

// Load data from embedded objects
function loadData() {
    try {
        allCategories = categoriesData.categories;
        allProducts = productsData.products;

        // Initialize the UI
        renderCategories();
        renderProducts(allProducts);
        updateStatistics();

        hideLoading();
    } catch (error) {
        console.error('Error processing data:', error);
        hideLoading();
        showError('Gagal memproses data.');
    }
}

// Show error message
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #ff4444;
        color: white;
        padding: 1rem;
        border-radius: 8px;
        z-index: 10000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    `;
    errorDiv.textContent = message;
    document.body.appendChild(errorDiv);

    setTimeout(() => {
        errorDiv.remove();
    }, 5000);
}

// Render categories
function renderCategories() {
    // Clear existing categories except default ones
    const defaultCards = categoryGrid.querySelectorAll('.category-card');

    // Add dynamic categories
    allCategories.forEach(category => {
        const categoryCard = document.createElement('div');
        categoryCard.className = 'category-card';
        categoryCard.setAttribute('data-category-id', category.id);
        categoryCard.onclick = (event) => filterProducts(category.id, event);

        categoryCard.innerHTML = `
            <div class="category-name">${category.name}</div>
            <div class="category-description">${category.description}</div>
        `;

        categoryGrid.appendChild(categoryCard);
    });
}

// Render products
function renderProducts(products) {
    productsGrid.innerHTML = '';

    if (products.length === 0) {
        noResults.style.display = 'block';
        return;
    }

    noResults.style.display = 'none';

    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.setAttribute('data-category', product.category.toLowerCase());
        productCard.setAttribute('data-product-id', product.id);
        productCard.onclick = () => showProductDetails(product.id);

        // Format price
        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(product.price);

        // Generate tags HTML
        let tagsHTML = '';
        if (product.colors && product.colors.length > 0) {
            const displayColors = product.colors.slice(0, 3);
            tagsHTML = `
                <div class="product-tags">
                    ${displayColors.map(color => `<span class="tag">${color}</span>`).join('')}
                    ${product.colors.length > 3 ? `<span class="tag">+${product.colors.length - 3}</span>` : ''}
                </div>
            `;
        }

        const imageUrl = `${ASSET_URL}/${product.image}`;

        productCard.innerHTML = `
            <div class="product-image">
                <img src="${imageUrl}"
                     alt="${product.name}"
                     loading="lazy"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                     onload="this.style.opacity='1';"
                     style="opacity: 0; transition: opacity 0.3s ease;">
                <div class="no-image" style="display: none;">📷 Image Not Available</div>
            </div>
            <div class="product-info">
                <div class="product-category">${product.category}${product.subcategory ? ' - ' + product.subcategory : ''}</div>
                <div class="product-name">${product.name}</div>
                <div class="product-price">${formattedPrice}</div>
                ${tagsHTML}
            </div>
        `;

        productsGrid.appendChild(productCard);
    });
}

// Filter products by category
function filterProducts(categoryId, event) {
    // Update active category
    document.querySelectorAll('.category-card').forEach(card => {
        card.classList.remove('active');
    });

    if (event) {
        event.currentTarget.classList.add('active');
    }

    currentFilter = categoryId;
    currentSubcategory = null;

    // Clear search and sorting
    searchInput.value = '';
    sortPrice.value = '';
    sortName.value = '';
    sortDate.value = '';

    let filteredProducts = [];

    if (categoryId === 'all') {
        filteredProducts = allProducts;
        hideSubcategories();
    } else if (categoryId === 'new') {
        filteredProducts = allProducts.filter(product => isProductNew(product));
        hideSubcategories();
    } else {
        const category = allCategories.find(cat => cat.id == categoryId);
        if (category) {
            filteredProducts = allProducts.filter(product =>
                product.category.toLowerCase() === category.name.toLowerCase()
            );
            showSubcategories(category);
        }
    }

    renderProducts(filteredProducts);
}

// Check if product is new (has 'new' or 'baru' in colors/materials)
function isProductNew(product) {
    const newKeywords = ['new', 'baru', 'terbaru'];

    // Check in colors
    if (product.colors) {
        for (let color of product.colors) {
            if (newKeywords.some(keyword => color.toLowerCase().includes(keyword))) {
                return true;
            }
        }
    }

    // Check in material
    if (product.material) {
        if (newKeywords.some(keyword => product.material.toLowerCase().includes(keyword))) {
            return true;
        }
    }

    // Check if product ID is high (assuming newer products have higher IDs)
    return product.id > (allProducts.length * 0.7);
}

// Show subcategories
function showSubcategories(category) {
    if (!category.subcategories || category.subcategories.length === 0) {
        hideSubcategories();
        return;
    }

    subcategoryGrid.innerHTML = '';

    // Add "All" subcategory
    const allSubcategoryCard = document.createElement('div');
    allSubcategoryCard.className = 'subcategory-card active';
    allSubcategoryCard.onclick = () => filterBySubcategory(null, allSubcategoryCard);
    allSubcategoryCard.innerHTML = `
        <div class="subcategory-name">Semua ${category.name}</div>
    `;
    subcategoryGrid.appendChild(allSubcategoryCard);

    // Add subcategories
    category.subcategories.forEach(subcategory => {
        const subcategoryCard = document.createElement('div');
        subcategoryCard.className = 'subcategory-card';
        subcategoryCard.onclick = () => filterBySubcategory(subcategory.name, subcategoryCard);

        subcategoryCard.innerHTML = `
            <div class="subcategory-name">${subcategory.name}</div>
            <div class="subcategory-description">${subcategory.description}</div>
        `;

        subcategoryGrid.appendChild(subcategoryCard);
    });

    subcategorySection.style.display = 'block';
}

// Hide subcategories
function hideSubcategories() {
    subcategorySection.style.display = 'none';
}

// Filter by subcategory
function filterBySubcategory(subcategoryName, element) {
    // Update active subcategory
    document.querySelectorAll('.subcategory-card').forEach(card => {
        card.classList.remove('active');
    });
    element.classList.add('active');

    currentSubcategory = subcategoryName;

    let filteredProducts = [];

    if (currentFilter === 'all') {
        filteredProducts = allProducts;
    } else if (currentFilter === 'new') {
        filteredProducts = allProducts.filter(product => isProductNew(product));
    } else {
        const category = allCategories.find(cat => cat.id == currentFilter);
        if (category) {
            filteredProducts = allProducts.filter(product =>
                product.category.toLowerCase() === category.name.toLowerCase()
            );
        }
    }

    // Apply subcategory filter
    if (subcategoryName) {
        filteredProducts = filteredProducts.filter(product =>
            product.subcategory && product.subcategory.toLowerCase() === subcategoryName.toLowerCase()
        );
    }

    renderProducts(filteredProducts);
}

// Search products
function searchProducts() {
    const searchTerm = searchInput.value.toLowerCase().trim();

    if (searchTerm === '') {
        // If search is empty, show filtered products based on current category
        filterProducts(currentFilter, null);
        return;
    }

    const filteredProducts = allProducts.filter(product => {
        return product.name.toLowerCase().includes(searchTerm) ||
               product.description.toLowerCase().includes(searchTerm) ||
               product.category.toLowerCase().includes(searchTerm) ||
               (product.subcategory && product.subcategory.toLowerCase().includes(searchTerm)) ||
               (product.brand && product.brand.toLowerCase().includes(searchTerm)) ||
               (product.material && product.material.toLowerCase().includes(searchTerm)) ||
               (product.colors && product.colors.some(color => color.toLowerCase().includes(searchTerm)));
    });

    renderProducts(filteredProducts);
}

// Sort products
function sortProducts(sortType) {
    // Clear other sort selects
    if (event.target.id === 'sortPrice') {
        sortName.value = '';
        sortDate.value = '';
    } else if (event.target.id === 'sortName') {
        sortPrice.value = '';
        sortDate.value = '';
    } else if (event.target.id === 'sortDate') {
        sortPrice.value = '';
        sortName.value = '';
    }

    if (!sortType) return;

    const visibleProducts = Array.from(document.querySelectorAll('.product-card:not([style*="display: none"])'));
    const productsData = visibleProducts.map(card => {
        const productId = parseInt(card.getAttribute('data-product-id'));
        return allProducts.find(p => p.id === productId);
    });

    productsData.sort((a, b) => {
        switch (sortType) {
            case 'low-high':
                return a.price - b.price;
            case 'high-low':
                return b.price - a.price;
            case 'a-z':
                return a.name.localeCompare(b.name);
            case 'z-a':
                return b.name.localeCompare(a.name);
            case 'newest':
                return b.id - a.id;
            case 'oldest':
                return a.id - b.id;
            default:
                return 0;
        }
    });

    renderProducts(productsData);
}

// Show product details in modal
function showProductDetails(productId) {
    const product = allProducts.find(p => p.id === productId);
    if (!product) return;

    // Format price
    const formattedPrice = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(product.price);

    // Generate sizes HTML
    let sizesHTML = '';
    if (product.sizes && product.sizes.length > 0) {
        sizesHTML = `
            <div class="modal-section">
                <h4>Ukuran Tersedia:</h4>
                <div class="sizes-list">
                    ${product.sizes.map(size => `<span class="size-tag">${size}</span>`).join('')}
                </div>
            </div>
        `;
    }

    // Generate colors HTML
    let colorsHTML = '';
    if (product.colors && product.colors.length > 0) {
        colorsHTML = `
            <div class="modal-section">
                <h4>Warna Tersedia:</h4>
                <div class="colors-list">
                    ${product.colors.map(color => `<span class="color-tag">${color}</span>`).join('')}
                </div>
            </div>
        `;
    }

    const imageUrl = `${ASSET_URL}/${product.image}`;

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
                <div class="modal-product-category">${product.category}${product.subcategory ? ' - ' + product.subcategory : ''}</div>
                <h2 class="modal-product-name">${product.name}</h2>
                <div class="modal-product-price">${formattedPrice}</div>
                <div class="modal-product-description">
                    <h4>Deskripsi:</h4>
                    <p>${product.description}</p>
                </div>
                ${product.material ? `
                    <div class="modal-section">
                        <h4>Material:</h4>
                        <p>${product.material}</p>
                    </div>
                ` : ''}
                ${product.brand ? `
                    <div class="modal-section">
                        <h4>Brand:</h4>
                        <p>${product.brand}</p>
                    </div>
                ` : ''}
                ${sizesHTML}
                ${colorsHTML}
                ${product.stock ? `
                    <div class="modal-section">
                        <h4>Stok:</h4>
                        <p class="stock-info ${product.stock > 10 ? 'in-stock' : product.stock > 0 ? 'low-stock' : 'out-of-stock'}">
                            ${product.stock > 0 ? `${product.stock} unit tersedia` : 'Stok habis'}
                        </p>
                    </div>
                ` : ''}
            </div>
        </div>

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

            .sizes-list, .colors-list {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .size-tag, .color-tag {
                background: #f0f0f0;
                padding: 0.4rem 0.8rem;
                border-radius: 20px;
                font-size: 0.9rem;
                font-weight: 500;
                border: 1px solid #ddd;
            }

            .stock-info.in-stock { color: #28a745; }
            .stock-info.low-stock { color: #ffc107; }
            .stock-info.out-of-stock { color: #dc3545; }

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

// Update statistics
function updateStatistics() {
    const totalProductsElement = document.getElementById('totalProducts');
    const totalCategoriesElement = document.getElementById('totalCategories');
    const newProductsElement = document.getElementById('newProducts');

    if (totalProductsElement) {
        totalProductsElement.textContent = allProducts.length;
    }

    if (totalCategoriesElement) {
        totalCategoriesElement.textContent = allCategories.length;
    }

    if (newProductsElement) {
        const newProductsCount = allProducts.filter(product => isProductNew(product)).length;
        newProductsElement.textContent = newProductsCount;
    }
}

// Smooth scrolling for navigation
function smoothScrollTo(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Add scroll effect to navbar
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        navbar.style.background = 'rgba(255, 255, 255, 0.98)';
        navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    } else {
        navbar.style.background = 'rgba(255, 255, 255, 0.95)';
        navbar.style.boxShadow = 'none';
    }
});

// Lazy loading for images
function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });

        document.querySelectorAll('img[loading="lazy"]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// Initialize lazy loading after products are rendered
function initializeAfterRender() {
    initLazyLoading();
}

// Hero Slider Functionality
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function initHeroSlider() {
    if (totalSlides <= 1) return;

    // Auto-advance slides
    setInterval(() => {
        nextSlide();
    }, 5000);

    // Initialize first slide
    updateSlider();
}

function updateSlider() {
    const sliderWrapper = document.getElementById('slider-wrapper');
    const indicators = document.querySelectorAll('.slider-indicator');

    // Move slider
    sliderWrapper.style.transform = `translateX(-${currentSlideIndex * 100}%)`;

    // Update indicators
    indicators.forEach((indicator, index) => {
        indicator.classList.toggle('active', index === currentSlideIndex);
    });
}

function nextSlide() {
    currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
    updateSlider();
}

function previousSlide() {
    currentSlideIndex = (currentSlideIndex - 1 + totalSlides) % totalSlides;
    updateSlider();
}

function goToSlide(index) {
    currentSlideIndex = index;
    updateSlider();
}

// Call after products are rendered
setInterval(() => {
    if (allProducts.length > 0) {
        initializeAfterRender();
    }
}, 1000);

// Touch support for mobile
function addTouchSupport() {
    const heroSection = document.querySelector('.hero');
    let startX = 0;
    let endX = 0;

    heroSection.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    heroSection.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });

    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                previousSlide();
            }
        }
    }
}

// Initialize touch support
addTouchSupport();

// Checkout bubble button functionality
function openCheckout() {
    // Placeholder untuk fungsi checkout
    alert('Fitur checkout akan segera hadir! 🛒\n\nDemo ini menampilkan bubble button checkout yang dapat dikustomisasi sesuai kebutuhan.');
    // Nanti bisa diarahkan ke halaman checkout atau modal
    // window.location.href = '/checkout';
    // atau bisa membuka modal checkout
    // showCheckoutModal();
}
