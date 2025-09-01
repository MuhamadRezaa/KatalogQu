// Enhanced Product Data with luxury fashion items
const products = [
    {
        id: 1,
        name: "Classic Silk Blouse",
        category: "wanita",
        sub_category: "atasan",
        price: 180000,
        description: "Exquisitely crafted from 100% pure mulberry silk, this timeless blouse features French seams and mother-of-pearl buttons for ultimate luxury.",
        image: "https://i.etsystatic.com/22155391/r/il/38715a/5664198753/il_1080xN.5664198753_5x2u.jpg",
        featured: true,
        tags: ["luxury", "silk", "classic", "professional"]
    },
    {
        id: 2,
        name: "High-Waist Denim Jeans",
        category: "wanita",
        sub_category: "bawahan",
        price: 145000,
        description: "Premium Japanese denim with a flattering high-waist silhouette. Crafted with organic cotton and a touch of elastane for the perfect fit.",
        image: "https://i.pinimg.com/originals/ab/b9/6a/abb96a8fc3d95e951d5b749a104891a1.jpg",
        featured: false,
        tags: ["denim", "high-waist", "premium", "sustainable"]
    },
    {
        id: 3,
        name: "Elegant Floral Maxi Dress",
        category: "wanita",
        sub_category: "dresses",
        price: 285000,
        description: "Hand-painted floral motifs on flowing silk chiffon create this ethereal maxi dress, perfect for garden parties and evening soirées.",
        image: "https://img.kwcdn.com/product/1d658609d8/166ba08a-1c44-4937-b8f7-9d1606314f5f_1350x1800.jpeg.a.jpg",
        featured: true,
        tags: ["floral", "maxi", "evening wear", "silk chiffon"]
    },
    {
        id: 4,
        name: "Italian Leather Crossbody",
        category: "aksesoris",
        sub_category: "bags",
        price: 320000,
        description: "Handcrafted in Florence from buttery-soft Nappa leather, featuring gold-plated hardware and multiple compartments for sophisticated organization.",
        image: "https://image.invaluable.com/housePhotos/calauctioncompany/44/769244/H5863-L369629919_original.jpg",
        featured: false,
        tags: ["italian leather", "handcrafted", "luxury", "crossbody"]
    },
    {
        id: 5,
        name: "Cashmere V-Neck Sweater",
        category: "pria",
        sub_category: "atasan",
        price: 280000,
        description: "Ultra-luxurious 100% cashmere from Inner Mongolia, featuring a flattering V-neckline and ribbed details for timeless sophistication.",
        image: "https://cdna.lystit.com/photos/f4b9-2015/10/22/line-brown-cashmere-v-neck-sweater-product-2-727832326-normal.jpeg",
        featured: true,
        tags: ["cashmere", "luxury", "knitwear", "v-neck"]
    },
    {
        id: 6,
        name: "Tailored Linen Trousers",
        category: "pria",
        sub_category: "bawahan",
        price: 165000,
        description: "European linen tailored to perfection with a relaxed fit and clean lines. Ideal for sophisticated casual elegance in warm weather.",
        image: "https://content.moss.co.uk/images/original/966350269_01.jpg",
        featured: false,
        tags: ["linen", "tailored", "summer", "european"]
    },
    {
        id: 7,
        name: "Little Black Dress",
        category: "wanita",
        sub_category: "dresses",
        price: 245000,
        description: "The quintessential LBD reimagined in Italian crepe with architectural seaming and a universally flattering silhouette.",
        image: "https://cdn.luxe.digital/media/2021/02/24170750/best-little-black-dresses-grace-karin-review-luxe-digital@2x.jpg",
        featured: true,
        tags: ["LBD", "italian crepe", "architectural", "cocktail"]
    },
    {
        id: 8,
        name: "Gold-Plated Hoop Earrings",
        category: "aksesoris",
        sub_category: "jewelry",
        price: 125000,
        description: "Minimalist 18k gold-plated hoops with a brushed finish, designed for everyday luxury and hypoallergenic comfort.",
        image: "https://www.roamans.com/on/demandware.static/-/Sites-masterCatalog_Roamans/default/dw6d75d46b/images/hi-res/0555_09066_mc_4417.jpg",
        featured: false,
        tags: ["18k gold", "hoops", "minimalist", "hypoallergenic"]
    },
    {
        id: 9,
        name: "Wool Blend Overcoat",
        category: "pria",
        sub_category: "kemeja",
        price: 485000,
        description: "Sophisticated double-breasted overcoat in premium wool blend, featuring horn buttons and a timeless silhouette that transcends seasons.",
        image: "https://cdn.lookastic.com/dark-green-herringbone-overcoat/stone-herringbone-wool-blend-overcoat-original-10647811.jpg",
        featured: true,
        tags: ["wool blend", "overcoat", "double-breasted", "timeless"]
    },
    {
        id: 10,
        name: "Pleated Midi Skirt",
        category: "wanita",
        sub_category: "bawahan",
        price: 155000,
        description: "Accordion-pleated midi skirt in lustrous satin, offering graceful movement and versatile styling from day to evening.",
        image: "https://img.lilysilk.com/cdn-cgi/image/width=1800,quality=80/media/catalog/product/m2_custom/10060/394BR/2.jpg",
        featured: false,
        tags: ["pleated", "midi", "satin", "versatile"]
    },
    {
        id: 11,
        name: "Cocktail Evening Dress",
        category: "wanita",
        sub_category: "dresses",
        price: 385000,
        description: "Show-stopping cocktail dress featuring hand-sewn sequin details and a figure-flattering silhouette perfect for special occasions.",
        image: "http://d3mna48k5fyuxs.cloudfront.net/upimg/jjshouse/s1140/24/bf/2ea057c424c81158baac7f0fa17224bf.jpg",
        featured: true,
        tags: ["cocktail", "sequins", "evening wear", "special occasion"]
    },
    {
        id: 12,
        name: "Designer Sunglasses",
        category: "aksesoris",
        sub_category: "jewelry",
        price: 245000,
        description: "Italian-crafted sunglasses with polarized lenses and acetate frames, offering both UV protection and timeless style.",
        image: "https://image.made-in-china.com/2f0j00jrvcQDRIgBql/Women-Sunglass-2023-Designer-Sunglasses-Famous-Luxury-Brand-Logo-Sunglasses.jpg",
        featured: false,
        tags: ["italian", "polarized", "acetate", "UV protection"]
    }
];

// Application State
let currentCategory = 'all';
let filteredProducts = [...products];
let isLoading = false;

// DOM Elements
const navbar = document.querySelector('.navbar');
const categoriesGrid = document.getElementById('categoriesGrid');
const productsGrid = document.getElementById('productsGrid');
const searchInput = document.getElementById('searchInput');
const priceFilter = document.getElementById('priceFilter');
const sortFilter = document.getElementById('sortFilter');
const productsCount = document.getElementById('productsCount');
const productModal = document.getElementById('productModal');
const modalBody = document.getElementById('modalBody');

// Initialize Application
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    setupNavigation();
    setupEventListeners();
    updateCategoryCounts();
    renderProducts();
    setupScrollEffects();
    setupFilterButtons();
    setupSearchBarScroll();
}

// Fungsi untuk hide/show search bar berdasarkan arah scroll
function setupSearchBarScroll() {
    const throttle = (func, time = 100) => {
        let lastTime = 0;
        return () => {
            const now = new Date();
            if (now - lastTime >= time) {
                func();
                lastTime = now;
            }
        };
    };

    const searchSection = document.querySelector('.search-section');
    let lastScroll = 0;

    const validateSearchBar = () => {
        const windowY = window.scrollY;

        if (windowY > lastScroll) {
            searchSection.classList.add('hidden');
        } else {
            searchSection.classList.remove('hidden');
        }

        lastScroll = windowY;
    };

    window.addEventListener('scroll', throttle(validateSearchBar, 100));
}

// Navigation
function setupNavigation() {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth scroll for navigation links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Update active nav link
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    });
}

// Event Listeners
function setupEventListeners() {
    // Category selection
    categoriesGrid.addEventListener('click', (e) => {
        const categoryItem = e.target.closest('.category-item');
        if (categoryItem) {
            handleCategorySelection(categoryItem);
        }
    });

    // Search functionality
    searchInput.addEventListener('input', debounce(filterProducts, 300));
    
    // Filter changes
    priceFilter.addEventListener('change', filterProducts);
    sortFilter.addEventListener('change', filterProducts);

    // View controls
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', () => handleViewChange(btn));
    });

    // Product interactions
    productsGrid.addEventListener('click', (e) => {
        const productCard = e.target.closest('.product-card');
        const moreInfoBtn = e.target.closest('.more-info-btn');
        
        if (moreInfoBtn) {
            e.stopPropagation();
            const productId = parseInt(productCard.dataset.productId);
            showProductModal(productId);
        } else if (productCard) {
            const productId = parseInt(productCard.dataset.productId);
            showProductPreview(productId);
        }
    });

    // Modal controls
    productModal.addEventListener('click', (e) => {
        if (e.target === productModal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
}

// Filter Buttons Setup
function setupFilterButtons() {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const select = btn.querySelector('select');
            if (select) {
                select.click();
            }
        });
    });
}

// Category Management
function updateCategoryCounts() {
    const counts = {
        all: products.length,
        pria: products.filter(p => p.category === 'pria').length,
        wanita: products.filter(p => p.category === 'wanita').length,
        'anak-anak': products.filter(p => p.category === 'anak-anak').length,
        aksesoris: products.filter(p => p.category === 'aksesoris').length
    };

    document.querySelectorAll('.category-item').forEach(item => {
        const category = item.dataset.category;
        const countElement = item.querySelector('.category-count');
        if (countElement && counts[category] !== undefined) {
            countElement.textContent = `${counts[category]} items`;
        }
    });
}

function handleCategorySelection(categoryItem) {
    // Remove active state from all categories
    document.querySelectorAll('.category-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Add active state to selected category
    categoryItem.classList.add('active');
    
    // Update current category
    currentCategory = categoryItem.dataset.category;
    
    // Update products title
    const categoryName = categoryItem.querySelector('.category-name').textContent;
    document.querySelector('.products-title').textContent = 
        categoryName === 'All Items' ? 'All Products' : `${categoryName} Collection`;
    
    // Filter and render products
    filterProducts();
    
    // Smooth scroll to products
    document.querySelector('.products-section').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Product Filtering and Rendering
function filterProducts() {
    if (isLoading) return;
    
    showLoadingState();
    
    setTimeout(() => {
        let filtered = [...products];

        // Category filter
        if (currentCategory !== 'all') {
            filtered = filtered.filter(product => product.category === currentCategory);
        }

        // Search filter
        const searchTerm = searchInput.value.toLowerCase().trim();
        if (searchTerm) {
            filtered = filtered.filter(product => 
                product.name.toLowerCase().includes(searchTerm) ||
                product.description.toLowerCase().includes(searchTerm) ||
                product.tags.some(tag => tag.toLowerCase().includes(searchTerm))
            );
        }

        // Price filter
        const priceRange = priceFilter.value;
        if (priceRange) {
            filtered = filtered.filter(product => {
                const price = product.price;
                switch(priceRange) {
                    case '0-50':
                        return price <= 50000;
                    case '50-100':
                        return price > 50000 && price <= 100000;
                    case '100-200':
                        return price > 100000 && price <= 200000;
                    case '200+':
                        return price > 200000;
                    default:
                        return true;
                }
            });
        }

        // Sort filter
        const sortBy = sortFilter.value;
        if (sortBy) {
            filtered.sort((a, b) => {
                switch(sortBy) {
                    case 'name-asc':
                        return a.name.localeCompare(b.name);
                    case 'name-desc':
                        return b.name.localeCompare(a.name);
                    case 'price-asc':
                        return a.price - b.price;
                    case 'price-desc':
                        return b.price - a.price;
                    default:
                        // Featured items first
                        return b.featured - a.featured;
                }
            });
        } else {
            // Default: featured items first
            filtered.sort((a, b) => b.featured - a.featured);
        }

        filteredProducts = filtered;
        renderProducts();
        updateProductCount();
        isLoading = false;
    }, 500);
}

function showLoadingState() {
    isLoading = true;
    productsGrid.innerHTML = `
        <div class="loading" style="grid-column: 1 / -1;">
            <span>Discovering luxury pieces...</span>
        </div>
    `;
}

function renderProducts() {
    if (filteredProducts.length === 0) {
        productsGrid.innerHTML = `
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; color: var(--text-secondary);">
                <div style="font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.3;">🔍</div>
                <h3 style="font-family: var(--font-primary); font-size: 2rem; margin-bottom: 1rem; color: var(--primary-color);">No products found</h3>
                <p style="font-size: 1.1rem; margin-bottom: 2rem;">Try adjusting your search or filter criteria</p>
                <button onclick="clearAllFilters()" class="btn btn-primary">
                    <span>Clear All Filters</span>
                </button>
            </div>
        `;
        return;
    }

    productsGrid.innerHTML = filteredProducts.map(product => `
        <div class="product-card" data-product-id="${product.id}" style="animation-delay: ${Math.random() * 0.3}s">
            <div class="product-image">
                <img src="${product.image}" alt="${product.name}" 
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    loading="lazy">
                <div class="placeholder-image" style="display: none;">
                    <div style="font-size: 3rem; opacity: 0.3;">👗</div>
                    <span>Luxury Fashion</span>
                </div>
                ${product.featured ? '<div class="product-badge">Featured</div>' : ''}
            </div>
            <div class="product-info">
                <span class="product-category">${formatCategory(product.category)} - ${product.sub_category}</span>
                <h3 class="product-name">${product.name}</h3>
                <span class="product-price">Rp. ${product.price.toLocaleString('id-ID')}</span>
                <p class="product-description">${product.description}</p>
                <div class="product-footer">
                    <button class="more-info-btn" onclick="event.stopPropagation(); showProductModal(${product.id});">
                        <span>View Details</span>
                    </button>
                    <a href="https://wa.me/+6281375307821?text=Saya%20tertarik%20dengan%20${encodeURIComponent(product.name)}" class="contact-btn">
                        <span>Hubungi</span>
                    </a>
                </div>
            </div>
        </div>
    `).join('');

    // Add featured badge styling
    const style = document.createElement('style');
    style.textContent = `
        .product-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--gradient-accent);
            color: var(--primary-color);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 3;
        }
    `;
    
    if (!document.head.querySelector('style[data-product-badges]')) {
        style.setAttribute('data-product-badges', 'true');
        document.head.appendChild(style);
    }

    // Setup product card animations
    setupProductAnimations();
}

function setupProductAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.product-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
}

function updateProductCount() {
    const count = filteredProducts.length;
    productsCount.textContent = `Showing ${count} ${count === 1 ? 'item' : 'items'}`;
}

// View Management
function handleViewChange(button) {
    document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');
    
    const view = button.dataset.view;
    // View change logic can be implemented here
    console.log('View changed to:', view);
}

// Product Modal
function showProductModal(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    modalBody.innerHTML = `
        <div class="modal-product">
            <div class="modal-image">
                <img src="${product.image}" alt="${product.name}" 
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="placeholder-image" style="display: none;">
                    <div style="font-size: 4rem; opacity: 0.3;">👗</div>
                    <span>Luxury Fashion</span>
                </div>
            </div>
            <div class="modal-details">
                <span class="product-category">${formatCategory(product.category)} - ${product.sub_category}</span>
                <h2 class="modal-title">${product.name}</h2>
                <div class="modal-price">Rp. ${product.price.toLocaleString('id-ID')}</div>
                <p class="modal-description">${product.description}</p>
                <div class="product-tags">
                    ${product.tags.map(tag => `<span class="tag">#${tag}</span>`).join('')}
                </div>
                <div class="modal-actions">
                    <a href="https://wa.me/+6281375307821?text=Saya%20tertarik%20dengan%20${encodeURIComponent(product.name)}" class="btn btn-accent">
                        <span>Hubungi Penjual</span>
                    </a>
                </div>
            </div>
        </div>
    `;

    // Add modal styles
    const modalStyle = document.createElement('style');
    modalStyle.textContent = `
        .modal-product {
            display: grid;
            grid-template-columns: 1fr 1.5fr; /* Adjusted for better desktop layout */
            gap: 2rem;
            padding: 1.5rem;
            max-width: 700px; /* Slightly reduced max-width for desktop */
        }
        
        .modal-image {
            width: 100%;
            height: 400px; /* Adjusted height for desktop image */
            border-radius: 16px;
            overflow: hidden;
            background: var(--background-secondary);
        }
        
        .modal-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .modal-details {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            padding: 1rem 0;
        }
        
        .modal-title {
            font-family: var(--font-primary);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .modal-price {
            font-family: var(--font-primary);
            font-size: 1.5rem;

        @media (max-width: 768px) {
            .modal-product {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 1.5rem;
            }

            .modal-image {
                height: 300px;
            }

            .modal-details {
                gap: 1rem;
            }

            .modal-title {
                font-size: 1.3rem;
            }

            .modal-price {
                font-size: 2rem;
            }
        }
            font-weight: 700;
            color: var(--accent-color);
        }
        
        .modal-description {
            color: var(--text-secondary);
            line-height: 1.5;
            font-size: 0.8rem;
            text-align: justify;
        }
        
        .product-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .tag {
            background: var(--background-tertiary);
            color: var(--text-secondary);
            padding: 0.2rem 0.6rem;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        .modal-actions {
            display: flex;
            gap: 0.8rem;
            margin-top: 0.8rem;
            flex-wrap: wrap;
        }
        
        .btn-accent {
            background: var(--gradient-accent);
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .modal-product {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 1.5rem;
            }
            
            .modal-image {
                height: 300px;
            }
            
            .modal-actions {
                flex-direction: column;
            }
        }
    `;
    
    if (!document.head.querySelector('style[data-modal-styles]')) {
        modalStyle.setAttribute('data-modal-styles', 'true');
        document.head.appendChild(modalStyle);
    }

    productModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function showProductPreview(productId) {
    const product = products.find(p => p.id === productId);
    if (product) {
        // Add visual feedback
        const card = document.querySelector(`[data-product-id="${productId}"]`);
        card.style.transform = 'scale(0.98)';
        setTimeout(() => {
            card.style.transform = '';
        }, 150);
    }
}

function closeModal() {
    productModal.classList.remove('active');
    document.body.style.overflow = '';
}

// Utility Functions
function formatCategory(category) {
    const categoryMap = {
        'pria': 'Pria',
        'wanita': 'Wanita',
        'anak-anak': 'Anak-anak',
        'aksesoris': 'Aksesoris'
    };
    return categoryMap[category] || category;
}

function clearAllFilters() {
    searchInput.value = '';
    priceFilter.value = '';
    sortFilter.value = '';
    
    // Reset to all categories
    document.querySelectorAll('.category-item').forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector('[data-category="all"]').classList.add('active');
    currentCategory = 'all';
    
    document.querySelector('.products-title').textContent = 'All Products';
    filterProducts();
}

function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Scroll Effects
function setupScrollEffects() {
    // Parallax effect for hero elements
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelectorAll('.float-element');
        
        parallax.forEach((element, index) => {
            const speed = (index + 1) * 0.1;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Fade in animation for sections
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.categories-section, .products-section').forEach(section => {
        sectionObserver.observe(section);
    });
}

// Performance and Error Handling
window.addEventListener('error', (e) => {
    console.error('Application error:', e.error);
});

window.addEventListener('load', () => {
    console.log('FashionFlow loaded successfully');
});

// Hero title animation
document.addEventListener('DOMContentLoaded', () => {
    const titleLines = document.querySelectorAll('.title-line');
    titleLines.forEach((line, index) => {
        line.style.animationDelay = `${index * 0.2}s`;
    });
});

// Smooth scroll for hero button
function smoothScrollTo(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}