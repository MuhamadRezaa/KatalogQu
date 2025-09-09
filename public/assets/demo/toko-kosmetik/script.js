// Cosmetics E-Catalog JavaScript
// Enhanced with SweetAlert, Navigation, and Interactive Features

// Product Data - Cosmetics Theme (Expanded Collection)
const products = [
    // SKINCARE PRODUCTS
    {
        id: 1,
        name: "Vitamin C Serum",
        brand: "Canu Skincare",
        category: "skincare",
        price: 125000,
        originalPrice: 150000,
        description: "Serum vitamin C 20% yang membantu mencerahkan kulit dan mengurangi tanda-tanda penuaan. Formula stabil dengan antioksidan tinggi.",
        image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&q=80",
        rating: 4.9,
        reviews: 312,
        tags: ["brightening", "anti-aging", "vitamin-c"],
        badge: "sale",
        stock: 42
    },
    {
        id: 2,
        name: "Moisturizing Cream",
        brand: "Canu Skincare",
        category: "skincare",
        price: 95000,
        originalPrice: 115000,
        description: "Pelembab wajah dengan formula ringan yang cepat menyerap. Mengandung ceramide dan niacinamide untuk kulit sehat dan lembab.",
        image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&q=80",
        rating: 4.5,
        reviews: 203,
        tags: ["moisturizing", "lightweight", "ceramide"],
        badge: "  ",
        stock: 35
    },
    {
        id: 3,
        name: "Sunscreen SPF 50",
        brand: "Canu Protect",
        category: "skincare",
        price: 95000,
        originalPrice: 120000,
        description: "Sunscreen dengan SPF 50 PA++++ yang melindungi dari sinar UV. Formula lightweight dan tidak meninggalkan white cast.",
        image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&q=80",
        rating: 4.8,
        reviews: 289,
        tags: ["spf-50", "lightweight", "no-white-cast"],
        badge: "  ",
        stock: 45
    },
    {
        id: 4,
        name: "Cleansing Oil",
        brand: "Canu Skincare",
        category: "skincare",
        price: 110000,
        originalPrice: 135000,
        description: "Cleansing oil yang efektif mengangkat makeup dan kotoran. Formula gentle yang tidak membuat kulit kering.",
        image: "https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?w=400&q=80",
        rating: 4.8,
        reviews: 267,
        tags: ["gentle", "effective", "makeup-remover"],
        badge: "  ",
        stock: 31
    },
    {
        id: 5,
        name: "Retinol Night Serum",
        brand: "Canu Advanced",
        category: "skincare",
        price: 185000,
        originalPrice: 220000,
        description: "Serum malam dengan retinol untuk anti-aging dan regenerasi kulit. Formula gentle untuk pemula.",
        image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400",
        rating: 4.7,
        reviews: 156,
        tags: ["retinol", "anti-aging", "night-serum"],
        badge: "new",
        stock: 28
    },
    {
        id: 6,
        name: "Niacinamide 10% Serum",
        brand: "Canu Skincare",
        category: "skincare",
        price: 98000,
        originalPrice: 115000,
        description: "Serum niacinamide untuk mengontrol minyak dan memperkecil pori. Cocok untuk kulit berminyak dan berjerawat.",
        image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400",
        rating: 4.6,
        reviews: 234,
        tags: ["niacinamide", "oil-control", "pore-minimizer"],
        badge: "sale",
        stock: 38
    },
    {
        id: 7,
        name: "Hyaluronic Acid Serum",
        brand: "Canu Hydra",
        category: "skincare",
        price: 135000,
        originalPrice: 160000,
        description: "Serum hyaluronic acid untuk hidrasi intensif. Memberikan kelembaban hingga 72 jam.",
        image: "https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400",
        rating: 4.8,
        reviews: 189,
        tags: ["hyaluronic-acid", "hydrating", "plumping"],
        badge: "  ",
        stock: 33
    },
    {
        id: 8,
        name: "AHA BHA Exfoliating Toner",
        brand: "Canu Exfoliate",
        category: "skincare",
        price: 115000,
        originalPrice: 140000,
        description: "Toner eksfoliasi dengan AHA BHA untuk mengangkat sel kulit mati dan mencerahkan kulit.",
        image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&q=80",
        rating: 4.5,
        reviews: 167,
        tags: ["aha-bha", "exfoliating", "brightening"],
        badge: "new",
        stock: 25
    },

    // MAKEUP PRODUCTS
    {
        id: 9,
        name: "Matte Liquid Lipstick",
        brand: "Canu Beauty",
        category: "lipstick",
        price: 89000,
        originalPrice: 120000,
        description: "Long-lasting matte liquid lipstick dengan formula tahan hingga 12 jam. Tersedia dalam berbagai warna cantik yang cocok untuk semua tone kulit.",
        image: "https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&q=80",
        rating: 4.8,
        reviews: 245,
        tags: ["matte", "long-lasting", "waterproof"],
        badge: "  ",
        stock: 25
    },
    {
        id: 10,
        name: "Hydrating Foundation",
        brand: "Canu Pro",
        category: "foundation",
        price: 165000,
        originalPrice: 200000,
        description: "Foundation dengan coverage medium to full yang memberikan hasil natural dan tahan lama. Diperkaya dengan hyaluronic acid untuk kelembaban ekstra.",
        image: "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400&q=80",
        rating: 4.7,
        reviews: 189,
        tags: ["hydrating", "medium-coverage", "natural"],
        badge: "new",
        stock: 18
    },
    {
        id: 11,
        name: "Eyeshadow Palette",
        brand: "Canu Colors",
        category: "eyeshadow",
        price: 145000,
        originalPrice: 180000,
        description: "Palette eyeshadow dengan 12 warna pigmented yang mudah di-blend. Kombinasi matte dan shimmer untuk berbagai look.",
        image: "https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400&q=80",
        rating: 4.6,
        reviews: 156,
        tags: ["pigmented", "blendable", "versatile"],
        badge: "",
        stock: 8
    },
    {
        id: 12,
        name: "Waterproof Mascara",
        brand: "Canu Lashes",
        category: "mascara",
        price: 75000,
        originalPrice: 95000,
        description: "Maskara waterproof yang memberikan volume dan panjang maksimal. Formula tahan air dan tidak mudah luntur.",
        image: "https://images.unsplash.com/photo-1631214540242-3cd8c4b6b9e8?w=400&q=80",
        rating: 4.4,
        reviews: 178,
        tags: ["waterproof", "volumizing", "lengthening"],
        badge: "new",
        stock: 22
    },
    {
        id: 13,
        name: "Blush Powder",
        brand: "Canu Glow",
        category: "blush",
        price: 68000,
        originalPrice: 85000,
        description: "Blush powder dengan formula buildable yang memberikan warna natural. Tersedia dalam berbagai shade yang cocok untuk semua skin tone.",
        image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&q=80",
        rating: 4.7,
        reviews: 134,
        tags: ["buildable", "natural", "long-lasting"],
        badge: "sale",
        stock: 28
    },
    {
        id: 14,
        name: "Lip Gloss Set",
        brand: "Canu Lips",
        category: "lipstick",
        price: 125000,
        originalPrice: 160000,
        description: "Set lip gloss dengan 3 warna berbeda. Formula non-sticky yang memberikan kilau natural dan kelembaban.",
        image: "https://images.unsplash.com/photo-1571781926291-c477ebfd024b?w=400&q=80",
        rating: 4.6,
        reviews: 198,
        tags: ["non-sticky", "moisturizing", "glossy"],
        badge: "",
        stock: 12
    },
    {
        id: 15,
        name: "Setting Spray",
        brand: "Canu Pro",
        category: "foundation",
        price: 85000,
        originalPrice: 105000,
        description: "Setting spray yang membuat makeup tahan lama hingga 16 jam. Formula refreshing yang tidak membuat makeup cakey.",
        image: "https://images.unsplash.com/photo-1583241800698-9c2e0c3e9e3e?w=400&q=80",
        rating: 4.5,
        reviews: 156,
        tags: ["long-lasting", "refreshing", "makeup-setter"],
        badge: "new",
        stock: 19
    },
    {
        id: 16,
        name: "Highlighter Palette",
        brand: "Canu Glow",
        category: "highlighter",
        price: 135000,
        originalPrice: 165000,
        description: "Palette highlighter dengan 4 shade berbeda untuk berbagai skin tone. Formula buttery yang mudah di-blend.",
        image: "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400",
        rating: 4.7,
        reviews: 142,
        tags: ["buttery", "blendable", "multi-shade"],
        badge: "sale",
        stock: 16
    },
    {
        id: 17,
        name: "Concealer Full Coverage",
        brand: "Canu Cover",
        category: "foundation",
        price: 95000,
        originalPrice: 115000,
        description: "Concealer dengan coverage penuh untuk menyamarkan noda dan dark circle. Formula creamy yang mudah di-blend.",
        image: "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400",
        rating: 4.6,
        reviews: 123,
        tags: ["full-coverage", "concealer", "long-lasting"],
        badge: "  ",
        stock: 32
    },
    {
        id: 18,
        name: "Eyeliner Gel Precision",
        brand: "Canu Eyes",
        category: "eyeliner",
        price: 65000,
        originalPrice: 80000,
        description: "Eyeliner gel dengan aplikator presisi untuk garis mata sempurna. Tahan air dan tidak mudah luntur.",
        image: "https://images.unsplash.com/photo-1631214540242-3cd8c4b6b9e8?w=400",
        rating: 4.5,
        reviews: 167,
        tags: ["gel", "precision", "waterproof"],
        badge: "new",
        stock: 24
    },
    {
        id: 19,
        name: "Lip Tint Natural",
        brand: "Canu Lips",
        category: "lipstick",
        price: 55000,
        originalPrice: 70000,
        description: "Lip tint dengan warna natural yang memberikan efek gradient. Formula ringan dan tahan lama.",
        image: "https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400",
        rating: 4.4,
        reviews: 189,
        tags: ["natural", "gradient", "lightweight"],
        badge: "sale",
        stock: 41
    },
    {
        id: 20,
        name: "Bronzer Contour",
        brand: "Canu Sculpt",
        category: "contour",
        price: 105000,
        originalPrice: 125000,
        description: "Bronzer untuk contouring dengan formula buildable. Memberikan efek sculpted yang natural.",
        image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400",
        rating: 4.6,
        reviews: 98,
        tags: ["bronzer", "contour", "buildable"],
        badge: "new",
        stock: 27
    },

    // FRAGRANCE PRODUCTS
    {
        id: 21,
        name: "Parfum Floral Elegance",
        brand: "Canu Fragrance",
        category: "fragrance",
        price: 285000,
        originalPrice: 340000,
        description: "Parfum dengan aroma floral yang elegan dan tahan lama. Notes bunga mawar, jasmine, dan vanilla.",
        image: "https://images.unsplash.com/photo-1541643600914-78b084683601?w=400",
        rating: 4.8,
        reviews: 156,
        tags: ["floral", "elegant", "long-lasting"],
        badge: "  ",
        stock: 15
    },
    {
        id: 22,
        name: "Body Mist Fresh Citrus",
        brand: "Canu Fresh",
        category: "fragrance",
        price: 85000,
        originalPrice: 105000,
        description: "Body mist dengan aroma citrus segar untuk sepanjang hari. Formula ringan dan menyegarkan.",
        image: "https://images.unsplash.com/photo-1541643600914-78b084683601?w=400",
        rating: 4.5,
        reviews: 203,
        tags: ["citrus", "fresh", "lightweight"],
        badge: "new",
        stock: 36
    },
    {
        id: 23,
        name: "Eau de Toilette Vanilla",
        brand: "Canu Scent",
        category: "fragrance",
        price: 195000,
        originalPrice: 230000,
        description: "Eau de toilette dengan aroma vanilla yang hangat dan menenangkan. Perfect untuk daily wear.",
        image: "https://images.unsplash.com/photo-1541643600914-78b084683601?w=400",
        rating: 4.6,
        reviews: 134,
        tags: ["vanilla", "warm", "daily-wear"],
        badge: "sale",
        stock: 22
    },

    // HAIR CARE PRODUCTS
    {
        id: 24,
        name: "Shampoo Keratin Repair",
        brand: "Canu Hair",
        category: "haircare",
        price: 75000,
        originalPrice: 95000,
        description: "Shampoo dengan keratin untuk memperbaiki rambut rusak dan kering. Formula sulfate-free.",
        image: "https://images.unsplash.com/photo-1583241800698-9c2e0c3e9e3e?w=400&q=80",
        rating: 4.5,
        reviews: 178,
        tags: ["keratin", "repair", "sulfate-free"],
        badge: "  ",
        stock: 44
    },
    {
        id: 25,
        name: "Hair Mask Argan Oil",
        brand: "Canu Hair",
        category: "haircare",
        price: 95000,
        originalPrice: 115000,
        description: "Masker rambut dengan argan oil untuk nutrisi mendalam. Membuat rambut halus dan berkilau.",
        image: "https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?w=400&q=80",
        rating: 4.7,
        reviews: 145,
        tags: ["argan-oil", "nourishing", "shine"],
        badge: "new",
        stock: 29
    },
    {
        id: 26,
        name: "Conditioner Silk Protein",
        brand: "Canu Hair",
        category: "haircare",
        price: 68000,
        originalPrice: 85000,
        description: "Conditioner dengan silk protein untuk rambut halus dan mudah diatur. Formula lightweight.",
        image: "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400&q=80",
        rating: 4.4,
        reviews: 167,
        tags: ["silk-protein", "smooth", "lightweight"],
        badge: "sale",
        stock: 38
    },
    {
        id: 27,
        name: "Hair Serum Anti Frizz",
        brand: "Canu Smooth",
        category: "haircare",
        price: 115000,
        originalPrice: 140000,
        description: "Serum rambut untuk mengatasi rambut kusut dan memberikan kilau natural. Heat protection formula.",
        image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&q=80",
        rating: 4.6,
        reviews: 123,
        tags: ["anti-frizz", "shine", "heat-protection"],
        badge: "new",
        stock: 31
    },

    // BODY CARE PRODUCTS
    {
        id: 28,
        name: "Body Lotion Vanilla",
        brand: "Canu Body",
        category: "bodycare",
        price: 65000,
        originalPrice: 80000,
        description: "Body lotion dengan aroma vanilla yang menenangkan. Formula melembabkan untuk kulit halus sepanjang hari.",
        image: "https://images.unsplash.com/photo-1570194065650-d99fb4bedf0a?w=400&q=80",
        rating: 4.5,
        reviews: 189,
        tags: ["vanilla", "moisturizing", "soothing"],
        badge: "  ",
        stock: 42
    },
    {
        id: 29,
        name: "Body Scrub Coffee",
        brand: "Canu Exfoliate",
        category: "bodycare",
        price: 85000,
        originalPrice: 105000,
        description: "Scrub tubuh dengan coffee untuk eksfoliasi dan menghaluskan kulit. Mengandung natural oils.",
        image: "https://images.unsplash.com/photo-1583241800698-9c2e0c3e9e3e?w=400&q=80",
        rating: 4.6,
        reviews: 134,
        tags: ["coffee", "exfoliating", "natural-oils"],
        badge: "new",
        stock: 26
    },
    {
        id: 30,
        name: "Hand Cream Intensive",
        brand: "Canu Care",
        category: "bodycare",
        price: 45000,
        originalPrice: 55000,
        description: "Krim tangan intensif untuk melembabkan dan melindungi kulit tangan dari kekeringan.",
        image: "https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400&q=80",
        rating: 4.4,
        reviews: 203,
        tags: ["intensive", "moisturizing", "protection"],
        badge: "sale",
        stock: 55
    },

    // TOOLS & ACCESSORIES
    {
        id: 31,
        name: "Makeup Brush Set Professional",
        brand: "Canu Tools",
        category: "tools",
        price: 165000,
        originalPrice: 200000,
        description: "Set kuas makeup profesional dengan 12 kuas berbeda untuk semua kebutuhan makeup.",
        image: "https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400",
        rating: 4.7,
        reviews: 156,
        tags: ["professional", "brush-set", "complete"],
        badge: "  ",
        stock: 18
    },
    {
        id: 32,
        name: "Beauty Blender Original",
        brand: "Canu Blend",
        category: "tools",
        price: 75000,
        originalPrice: 95000,
        description: "Beauty blender original untuk aplikasi makeup yang flawless. Latex-free dan hypoallergenic.",
        image: "https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400",
        rating: 4.6,
        reviews: 234,
        tags: ["beauty-blender", "flawless", "hypoallergenic"],
        badge: "new",
        stock: 47
    },
    {
        id: 33,
        name: "Eyelash Curler Premium",
        brand: "Canu Lash",
        category: "tools",
        price: 55000,
        originalPrice: 70000,
        description: "Penjepit bulu mata premium dengan design ergonomis untuk hasil curl yang sempurna.",
        image: "https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400",
        rating: 4.5,
        reviews: 167,
        tags: ["eyelash-curler", "premium", "ergonomic"],
        badge: "sale",
        stock: 33
    },

    // NAIL CARE PRODUCTS
    {
        id: 34,
        name: "Nail Polish Classic Red",
        brand: "Canu Nails",
        category: "nailcare",
        price: 35000,
        originalPrice: 45000,
        description: "Cat kuku warna merah klasik dengan formula tahan lama dan quick dry.",
        image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400",
        rating: 4.4,
        reviews: 189,
        tags: ["classic-red", "long-lasting", "quick-dry"],
        badge: "  ",
        stock: 62
    },
    {
        id: 35,
        name: "Cuticle Oil Vitamin E",
        brand: "Canu Nails",
        category: "nailcare",
        price: 45000,
        originalPrice: 55000,
        description: "Minyak kutikula dengan vitamin E untuk perawatan kuku sehat dan kutikula lembut.",
        image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400",
        rating: 4.6,
        reviews: 123,
        tags: ["cuticle-oil", "vitamin-e", "nail-care"],
        badge: "new",
        stock: 38
    },
    {
        id: 36,
        name: "Base Coat Strengthening",
        brand: "Canu Nails",
        category: "nailcare",
        price: 42000,
        originalPrice: 52000,
        description: "Base coat untuk memperkuat kuku dan membuat cat kuku lebih tahan lama.",
        image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400",
        rating: 4.5,
        reviews: 145,
        tags: ["base-coat", "strengthening", "long-lasting"],
        badge: "sale",
        stock: 44
    }
];

// Global Variables
let currentProducts = [...products];
// Shopping cart feature removed
let wishlist = JSON.parse(localStorage.getItem('cosmeticWishlist')) || [];
let currentCategory = 'all';
let currentSearchTerm = '';
let currentSort = 'name';
let currentView = 'grid';

// DOM Elements
const productGrid = document.getElementById('productsGrid');
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const sortFilter = document.getElementById('sortFilter');
// Shopping cart feature removed
const wishlistCount = document.getElementById('wishlistCount');
const productsGrid = document.getElementById('productsGrid');
const productModal = document.getElementById('productModal');
const loadingScreen = document.getElementById('loadingScreen');
const scrollToTopBtn = document.getElementById('scrollToTop');

// Initialize Application
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // Hide loading screen
    setTimeout(() => {
        if (loadingScreen) {
            loadingScreen.classList.add('hidden');
        }
    }, 1500);

    // Initialize components
    filterProducts(); // Use filterProducts instead of renderProducts
    // Shopping cart feature removed
    updateWishlistCount();
    initializeEventListeners();
    initializeNavigation();
    initializeScrollEffects();

    // Show welcome message
    showWelcomeMessage();
}

// Event Listeners
function initializeEventListeners() {
    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
    }

    // Filter functionality
    if (categoryFilter) {
        categoryFilter.addEventListener('change', handleCategoryFilter);
    }

    if (sortFilter) {
        sortFilter.addEventListener('change', handleSort);
    }

    // View toggle
    document.querySelectorAll('.view-toggle .btn').forEach(btn => {
        btn.addEventListener('click', handleViewToggle);
    });

    // Category cards
    document.querySelectorAll('.category-card').forEach(card => {
        card.addEventListener('click', handleCategoryClick);
    });

    // Scroll to top button
    if (scrollToTopBtn) {
        scrollToTopBtn.addEventListener('click', scrollToTop);
    }

    // Modal close events
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal') || e.target.classList.contains('btn-close')) {
            closeModal();
        }
    });

    // Keyboard events
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
}

// Navigation Effects
function initializeNavigation() {
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
            if (scrollToTopBtn) {
                scrollToTopBtn.classList.add('visible');
            }
        } else {
            navbar.classList.remove('scrolled');
            if (scrollToTopBtn) {
                scrollToTopBtn.classList.remove('visible');
            }
        }
    });
}

// Scroll Effects
function initializeScrollEffects() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeInUp');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.category-card, .product-card, .accordion-item').forEach(el => {
        observer.observe(el);
    });
}

// Product Rendering
function renderProducts() {
    const grid = document.getElementById('productsGrid');
    if (!grid) {
        console.error('Products grid element not found');
        return;
    }

    if (currentProducts.length === 0) {
        grid.innerHTML = `
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Produk tidak ditemukan</h4>
                <p class="text-muted">Coba ubah kata kunci pencarian atau filter yang digunakan.</p>
            </div>
        `;
        return;
    }

    const productsHTML = currentProducts.map(product => {
        const discountPercent = Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100);
        const stars = generateStars(product.rating);

        return `
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="product-card h-100" data-aos="fade-up">
                    <div class="product-image">
                        <img src="${product.image}" alt="${product.name}" class="img-fluid" loading="lazy">
                        <div class="product-badge ${product.badge}">
                            ${getBadgeText(product.badge)}
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-brand">${product.brand}</div>
                        <h3>${product.name}</h3>

                        <div class="product-price">
                            <span class="current-price">Rp ${formatPrice(product.price)}</span>
                            ${product.originalPrice > product.price ?
                                `<span class="original-price">Rp ${formatPrice(product.originalPrice)}</span>` :
                                ''
                            }
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary" onclick="showProductDetail(${product.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-outline-danger" onclick="toggleWishlist(${product.id})">
                                <i class="${isInWishlist(product.id) ? 'fas' : 'far'} fa-heart"></i>
                            </button>
                            <a href="https://wa.me/6287796712317?text=Halo, saya tertarik dengan produk ${encodeURIComponent(product.name)} - ${encodeURIComponent(product.brand)} seharga Rp ${formatPrice(product.price)}. Bisakah Anda memberikan informasi lebih lanjut?" target="_blank" class="btn btn-success flex-fill">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }).join('');

    grid.innerHTML = productsHTML;
    updateResultsCount();
    console.log(`Rendered ${currentProducts.length} products`);
}

// Helper Functions
function generateStars(rating, size = 'normal') {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let stars = '';
    const sizeClass = size === 'small' ? ' style="font-size: 0.8em;"' : '';

    for (let i = 0; i < fullStars; i++) {
        stars += `<i class="fas fa-star"${sizeClass}></i>`;
    }

    if (hasHalfStar) {
        stars += `<i class="fas fa-star-half-alt"${sizeClass}></i>`;
    }

    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        stars += `<i class="far fa-star"${sizeClass}></i>`;
    }

    return stars;
}

function getBadgeText(badge) {
    const badges = {
        'new': 'Baru',
        'sale': 'Promo',
    };
    return badges[badge] || badge;
}

function formatPrice(price) {
    return new Intl.NumberFormat('id-ID').format(price);
}

// Search and Filter Functions
function handleSearch() {
    currentSearchTerm = searchInput ? searchInput.value.toLowerCase() : '';
    filterProducts();
}

// Filter products by category
function filterByCategory(category) {
    currentCategory = category;
    filterProducts();
    updateCategoryButtons();
}

// Update category buttons active state
function updateCategoryButtons() {
    const categoryButtons = document.querySelectorAll('.category-btn');
    categoryButtons.forEach(btn => {
        if (btn.dataset.category === currentCategory) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

function handleCategoryFilter() {
    currentCategory = categoryFilter.value;
    filterProducts();
}

// Categories data
const categories = [
    { id: 'all', name: 'Semua Produk', count: products.length },
    { id: 'skincare', name: 'Skincare', count: products.filter(p => p.category === 'skincare').length },
    { id: 'lipstick', name: 'Lipstick', count: products.filter(p => p.category === 'lipstick').length },
    { id: 'foundation', name: 'Foundation', count: products.filter(p => p.category === 'foundation').length },
    { id: 'eyeshadow', name: 'Eyeshadow', count: products.filter(p => p.category === 'eyeshadow').length },
    { id: 'mascara', name: 'Mascara', count: products.filter(p => p.category === 'mascara').length },
    { id: 'blush', name: 'Blush', count: products.filter(p => p.category === 'blush').length },
    { id: 'highlighter', name: 'Highlighter', count: products.filter(p => p.category === 'highlighter').length },
    { id: 'fragrance', name: 'Fragrance', count: products.filter(p => p.category === 'fragrance').length },
    { id: 'haircare', name: 'Hair Care', count: products.filter(p => p.category === 'haircare').length },
    { id: 'bodycare', name: 'Body Care', count: products.filter(p => p.category === 'bodycare').length },
    { id: 'nailcare', name: 'Nail Care', count: products.filter(p => p.category === 'nailcare').length },
    { id: 'tools', name: 'Tools & Accessories', count: products.filter(p => p.category === 'tools').length }
];

function handleSort() {
    currentSort = sortFilter.value;
    sortProducts();
    renderProducts();
}

function handleViewToggle(e) {
    const viewType = e.target.dataset.view;
    if (viewType) {
        currentView = viewType;
        document.querySelectorAll('.view-toggle .btn').forEach(btn => {
            btn.classList.remove('active');
        });
        e.target.classList.add('active');

        // Update grid classes based on view
        if (productGrid) {
            if (viewType === 'list') {
                productGrid.className = 'row';
                // Add list view styling
            } else {
                productGrid.className = 'row';
            }
        }
        renderProducts();
    }
}

function handleCategoryClick(e) {
    const category = e.currentTarget.dataset.category;
    if (category) {
        currentCategory = category;
        if (categoryFilter) {
            categoryFilter.value = category;
        }
        filterProducts();

        // Scroll to products section
        document.getElementById('products').scrollIntoView({
            behavior: 'smooth'
        });
    }
}

function filterProducts() {
    currentProducts = products.filter(product => {
        const matchesSearch = product.name.toLowerCase().includes(currentSearchTerm) ||
                            product.brand.toLowerCase().includes(currentSearchTerm) ||
                            product.description.toLowerCase().includes(currentSearchTerm) ||
                            product.tags.some(tag => tag.toLowerCase().includes(currentSearchTerm));

        let matchesCategory;
        if (currentCategory === 'all') {
            matchesCategory = true;
        } else if (currentCategory === 'makeup') {
            // Include all makeup-related categories
            matchesCategory = ['foundation', 'eyeliner', 'lipstick', 'contour', 'eyeshadow', 'mascara', 'blush', 'highlighter'].includes(product.category);
        } else if (currentCategory === 'tools') {
            matchesCategory = product.category === 'tools';
        } else if (currentCategory === 'nailcare') {
            matchesCategory = product.category === 'nailcare';
        } else if (currentCategory === 'bodycare') {
            matchesCategory = product.category === 'bodycare';
        } else if (currentCategory === 'haircare') {
            matchesCategory = product.category === 'haircare';
        } else {
            matchesCategory = product.category === currentCategory;
        }

        return matchesSearch && matchesCategory;
    });

    sortProducts();
    renderProducts();
}

function sortProducts() {
    currentProducts.sort((a, b) => {
        switch (currentSort) {
            case 'name':
                return a.name.localeCompare(b.name);
            case 'price-low':
                return a.price - b.price;
            case 'price-high':
                return b.price - a.price;
            case 'rating':
                return b.rating - a.rating;
            case 'newest':
                return b.id - a.id;
            default:
                return 0;
        }
    });
}

function updateResultsCount() {
    const resultsCount = document.getElementById('resultsCount');
    if (resultsCount) {
        resultsCount.textContent = `Menampilkan ${currentProducts.length} dari ${products.length} produk`;
    }

    // Control load more button visibility
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        if (currentProducts.length >= products.length) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'block';
        }
    }
}

// Product Detail Modal
function showProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const modalContent = `
        <div class="modal fade" id="productDetailModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${product.name}</h5>
                        <button type="button" class="btn-close" onclick="closeModal()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="${product.image}" alt="${product.name}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <div class="product-brand text-muted mb-2">${product.brand}</div>
                                <h4 class="mb-3">${product.name}</h4>
                                <div class="product-rating mb-3">
                                    ${generateStars(product.rating)}
                                    <span class="ms-2">(${product.reviews} ulasan)</span>
                                </div>
                                <div class="product-price mb-3">
                                    <span class="current-price h4">Rp ${formatPrice(product.price)}</span>
                                    ${product.originalPrice > product.price ?
                                        `<span class="original-price ms-2">Rp ${formatPrice(product.originalPrice)}</span>` :
                                        ''
                                    }
                                </div>
                                <p class="mb-3">${product.description}</p>
                                <div class="mb-3">
                                    <strong>Stok:</strong> ${product.stock} tersedia
                                </div>
                                <div class="mb-3">
                                    <strong>Tags:</strong>
                                    ${product.tags.map(tag => `<span class="badge bg-secondary me-1">${tag}</span>`).join('')}
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="https://wa.me/6287796712317?text=Halo, saya tertarik dengan produk ${product.name} - ${product.brand} seharga Rp ${formatPrice(product.price)}. Bisakah Anda memberikan informasi lebih lanjut?" class="btn btn-success btn-lg" target="_blank">
                                        <i class="fab fa-whatsapp me-2"></i>Hubungi via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                        ${getSimilarProducts(product.id, product.category)}
                    </div>
                </div>
            </div>
        </div>
    `;

    // Close existing modal properly if it exists
    const existingModal = document.getElementById('productDetailModal');
    if (existingModal) {
        const bootstrapModal = bootstrap.Modal.getInstance(existingModal);
        if (bootstrapModal) {
            bootstrapModal.hide();
        }
        // Remove modal backdrop and body classes
        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
        existingModal.remove();
    }

    // Add new modal
    document.body.insertAdjacentHTML('beforeend', modalContent);

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('productDetailModal'));
    modal.show();
}

function getSimilarProducts(currentProductId, category) {
    // Get products from the same category, excluding current product
    const similarProducts = products.filter(p =>
        p.category === category && p.id !== currentProductId
    ).slice(0, 4); // Limit to 4 products

    if (similarProducts.length === 0) {
        return '';
    }

    return `
        <div class="mt-4">
            <h5 class="mb-3">Produk Serupa</h5>
            <div class="row">
                ${similarProducts.map(product => `
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card h-100 similar-product-card" onclick="showProductDetail(${product.id})" style="cursor: pointer;">
                            <img src="${product.image}" class="card-img-top" alt="${product.name}" style="height: 120px; object-fit: cover;">
                            <div class="card-body p-2">
                                <h6 class="card-title mb-1" style="font-size: 0.8rem;">${product.name}</h6>
                                <p class="card-text text-muted mb-1" style="font-size: 0.7rem;">${product.brand}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-primary fw-bold">Rp ${formatPrice(product.price)}</small>
                                    <small class="text-warning">
                                        ${generateStars(product.rating, 'small')}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
}

function closeModal() {
    const modal = document.getElementById('productDetailModal');
    if (modal) {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) {
            bsModal.hide();
        }
        setTimeout(() => modal.remove(), 300);
    }
}

// Cart Functions
// Shopping cart feature removed

// Shopping cart feature removed

// Wishlist functions
function toggleWishlist(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const index = wishlist.findIndex(item => item.id === productId);

    if (index > -1) {
        wishlist.splice(index, 1);
        showSuccessMessage(`${product.name} dihapus dari wishlist!`);
    } else {
        wishlist.push(product);
        showSuccessMessage(`${product.name} ditambahkan ke wishlist!`);
    }

    updateWishlistStorage();
    updateWishlistCount();
    renderProducts();
}

function isInWishlist(productId) {
    return wishlist.some(item => item.id === productId);
}

function updateWishlistStorage() {
    localStorage.setItem('cosmeticWishlist', JSON.stringify(wishlist));
}

function updateWishlistCount() {
    if (wishlistCount) {
        wishlistCount.textContent = wishlist.length;
        wishlistCount.style.display = wishlist.length > 0 ? 'block' : 'none';
    }
}

function showWishlist() {
    if (wishlist.length === 0) {
        Swal.fire({
            title: 'Wishlist Kosong',
            text: 'Belum ada produk dalam wishlist Anda.',
            icon: 'info',
            confirmButtonText: 'Mulai Belanja',
            confirmButtonColor: '#d63384'
        });
        return;
    }

    const wishlistItems = wishlist.map(item => {
        return `
            <div class="d-flex align-items-center mb-3 p-3 border rounded">
                <img src="${item.image}" alt="${item.name}" class="me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                <div class="flex-grow-1">
                    <h6 class="mb-1">${item.name}</h6>
                    <small class="text-muted">${item.brand}</small>
                    <div class="mt-1">
                        <span class="fw-bold text-primary">Rp ${formatPrice(item.price)}</span>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="https://wa.me/6287796712317?text=Halo, saya tertarik dengan produk ${item.name} - ${item.brand} seharga Rp ${formatPrice(item.price)}. Bisakah Anda memberikan informasi lebih lanjut?" class="btn btn-sm btn-success" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger" onclick="removeFromWishlist(${item.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    }).join('');

    Swal.fire({
        title: 'Wishlist Saya',
        html: `
            <div class="text-start">
                ${wishlistItems}
            </div>
        `,
        showConfirmButton: false,
        width: '600px',
        customClass: {
            popup: 'rounded-custom'
        }
    });
}

function removeFromWishlist(productId) {
    wishlist = wishlist.filter(item => item.id !== productId);
    updateWishlistStorage();
    updateWishlistCount();
    showSuccessMessage('Produk berhasil dihapus dari wishlist!');

    // Refresh wishlist modal if open
    if (document.querySelector('.swal2-container')) {
        showWishlist();
    }

    renderProducts();
}

function saveCart() {
    localStorage.setItem('cosmeticsCart', JSON.stringify(cart));
}

// Shopping cart feature removed

// Shopping cart feature removed

// Checkout feature removed

// Utility Functions
function showSuccessMessage(message) {
    Swal.fire({
        title: 'Berhasil!',
        text: message,
        icon: 'success',
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        customClass: {
            popup: 'rounded-custom'
        }
    });
}

function showErrorMessage(message) {
    Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        customClass: {
            popup: 'rounded-custom'
        }
    });
}

// Product sharing feature removed

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Newsletter Subscription
function subscribeNewsletter() {
    Swal.fire({
        title: 'Berlangganan Newsletter',
        html: `
            <div class="mb-3">
                <input type="email" class="form-control" id="newsletterEmail" placeholder="Masukkan email Anda">
            </div>
            <p class="text-muted small">Dapatkan update produk terbaru dan penawaran eksklusif!</p>
        `,
        showCancelButton: true,
        confirmButtonText: 'Berlangganan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d63384',
        preConfirm: () => {
            const email = document.getElementById('newsletterEmail').value;
            if (!email) {
                Swal.showValidationMessage('Email harus diisi!');
                return false;
            }
            if (!isValidEmail(email)) {
                Swal.showValidationMessage('Format email tidak valid!');
                return false;
            }
            return email;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            showSuccessMessage('Terima kasih! Anda berhasil berlangganan newsletter.');
        }
    });
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Contact Form
function submitContactForm() {
    Swal.fire({
        title: 'Hubungi Kami',
        html: `
            <form id="contactForm">
                <div class="mb-3">
                    <input type="text" class="form-control" id="contactName" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="contactEmail" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="contactMessage" rows="4" placeholder="Pesan Anda" required></textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Kirim Pesan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d63384',
        preConfirm: () => {
            const name = document.getElementById('contactName').value;
            const email = document.getElementById('contactEmail').value;
            const message = document.getElementById('contactMessage').value;

            if (!name || !email || !message) {
                Swal.showValidationMessage('Semua field harus diisi!');
                return false;
            }

            if (!isValidEmail(email)) {
                Swal.showValidationMessage('Format email tidak valid!');
                return false;
            }

            return { name, email, message };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            showSuccessMessage('Pesan Anda berhasil dikirim! Kami akan segera merespons.');
        }
    });
}

// Initialize carousel auto-play
function initializeCarousel() {
    const carousel = document.querySelector('#heroCarousel');
    if (carousel) {
        const bsCarousel = new bootstrap.Carousel(carousel, {
            interval: 5000,
            wrap: true
        });
    }
}

// Call initialize carousel when DOM is loaded
document.addEventListener('DOMContentLoaded', initializeCarousel);

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
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

// Add loading states for better UX
function showLoading() {
    if (productGrid) {
        productGrid.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat produk...</p>
            </div>
        `;
    }
}

// Export functions for global access
// Load More Products Function
function loadMoreProducts() {
    // For now, just show all products
    filterProducts();

    // Hide the load more button since we're showing all products
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.style.display = 'none';
    }
}

// Clear All Filters Function
function clearAllFilters() {
    currentCategory = 'all';
    currentSearchTerm = '';
    currentSort = 'name';

    // Reset form elements
    if (searchInput) searchInput.value = '';
    if (categoryFilter) categoryFilter.value = 'all';
    if (sortFilter) sortFilter.value = 'name';

    // Reset category buttons
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector('.category-btn[data-category="all"]')?.classList.add('active');

    filterProducts();
}

// Change View Function
function changeView(viewType) {
    currentView = viewType;

    // Update view toggle buttons
    document.querySelectorAll('.view-toggle .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`.view-toggle .btn[onclick="changeView('${viewType}')"]`)?.classList.add('active');

    // Apply view changes (for future implementation)
    const grid = document.getElementById('productsGrid');
    if (grid) {
        grid.className = viewType === 'list' ? 'row list-view' : 'row';
    }
}

// Additional Modal Functions
function openSearchModal() {
    const searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
    searchModal.show();
}

function openCartModal() {
    showCart();
}

function openVideoModal() {
    Swal.fire({
        title: 'Video Produk',
        html: '<p>Video produk akan segera tersedia!</p>',
        icon: 'info',
        confirmButtonText: 'OK'
    });
}

function openContactForm() {
    Swal.fire({
        title: 'Hubungi Kami',
        html: `
            <form id="contactForm">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" rows="4" placeholder="Pesan Anda" required></textarea>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Kirim Pesan',
        cancelButtonText: 'Batal',
        preConfirm: () => {
            return Swal.fire({
                title: 'Pesan Terkirim!',
                text: 'Terima kasih, kami akan segera menghubungi Anda.',
                icon: 'success'
            });
        }
    });
}

function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}

// Global function exports
window.showProductDetail = showProductDetail;
window.subscribeNewsletter = subscribeNewsletter;
window.submitContactForm = submitContactForm;
window.closeModal = closeModal;
window.scrollToTop = scrollToTop;
window.toggleWishlist = toggleWishlist;
window.showWishlist = showWishlist;
window.removeFromWishlist = removeFromWishlist;
window.filterByCategory = filterByCategory;
window.loadMoreProducts = loadMoreProducts;
window.clearAllFilters = clearAllFilters;
window.changeView = changeView;
window.openSearchModal = openSearchModal;
// Cart modal removed
window.openVideoModal = openVideoModal;
window.openContactForm = openContactForm;
window.scrollToSection = scrollToSection;
