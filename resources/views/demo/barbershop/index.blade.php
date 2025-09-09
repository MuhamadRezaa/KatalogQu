<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Low Barber - Barbershop Premium</title>
    <link rel="stylesheet" href="{{ asset('assets/demo/barbershop/styles.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body>
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-overlay"></div>

        <!-- Background Slider Container -->
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

        <!-- Static Hero Content -->
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-text">✨ Barbershop Premium</span>
            </div>
            <div class="hero-icon">
                <i class="fas fa-cut"></i>
            </div>
            <h1 class="hero-title">
                <span class="title-main">Low Barber</span>
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

        <!-- Slider Navigation -->
        <div class="slider-nav">
            <button class="slider-btn prev" aria-label="Slide sebelumnya">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-btn next" aria-label="Slide selanjutnya">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Slider Dots -->
        <div class="slider-dots">
            <button class="dot active" data-slide="0" aria-label="Slide 1"></button>
            <button class="dot" data-slide="1" aria-label="Slide 2"></button>
            <button class="dot" data-slide="2" aria-label="Slide 3"></button>
        </div>
    </section>

    <!-- Style Recommendation Section -->
    <section id="style-recommendation" class="style-recommendation">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Rekomendasi Style</h2>
                <p class="section-subtitle">
                    Pilih bentuk wajah Anda untuk mendapatkan rekomendasi
                    style pangkas yang paling cocok
                </p>
            </div>

            <div class="face-shape-container">
                <div class="face-shape-buttons">
                    <button class="face-shape-btn" data-shape="oval">
                        <i class="fas fa-circle"></i>
                        <span>Oval</span>
                    </button>
                    <button class="face-shape-btn" data-shape="round">
                        <i class="fas fa-circle"></i>
                        <span>Round</span>
                    </button>
                    <button class="face-shape-btn" data-shape="square">
                        <i class="fas fa-square"></i>
                        <span>Square</span>
                    </button>
                    <button class="face-shape-btn" data-shape="heart">
                        <i class="fas fa-heart"></i>
                        <span>Heart</span>
                    </button>
                    <button class="face-shape-btn" data-shape="diamond">
                        <i class="fas fa-gem"></i>
                        <span>Diamond</span>
                    </button>
                    <button class="face-shape-btn" data-shape="triangle">
                        <i class="fas fa-play"></i>
                        <span>Triangle</span>
                    </button>
                </div>

                <div class="recommendation-result" id="recommendationResult">
                    <div class="result-placeholder">
                        <i class="fas fa-hand-pointer"></i>
                        <p>
                            Pilih bentuk wajah Anda di atas untuk melihat
                            rekomendasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <!-- Modal -->
        <div id="serviceModal" class="modal">
            <div class="modal-content">
                <button class="modal-close" onclick="closeModal()">
                    &times;
                </button>
                <img id="modalImage" src="" alt="Service Image" />
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
            </div>
        </div>

        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Service</h2>
                <p class="section-subtitle">
                    Dapatkan pelayanan terbaik dengan standar internasional
                    dan teknik modern
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/klasik.png') }}" alt="Classic Cut" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>45 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Classic Cut</h3>
                        <div class="service-price">Rp 75,000</div>
                        <button class="service-btn"
                            onclick="showModal('Classic Cut', 'Classic Cut adalah potongan rambut klasik yang cocok untuk semua usia.', '{{ asset('assets/demo/barbershop/img/klasik.png') }}')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}" alt="Modern Fade" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>50 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Modern Fade</h3>
                        <div class="service-price">Rp 85,000</div>
                        <button class="service-btn"
                            onclick="showModal('Modern Fade', 'Potongan rambut stylish dengan gradasi rapi dari tipis ke tebal, memberi tampilan modern dan segar.', '{{ asset('assets/demo/barbershop/img/moderncut.jpg') }}')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/beardtrim.jpg') }}" alt="Beard Trim" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>30 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Beard Trim</h3>
                        <div class="service-price">Rp 45,000</div>
                        <button class="service-btn"
                            onclick="showModal('Beard Trim', 'Perapian jenggot agar tampak rapi, bersih, dan sesuai bentuk wajah untuk tampilan yang maskulin.', '{{ asset('assets/demo/barbershop/img/beardtrim.jpg') }}')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/premiun.jpg') }}" alt="Premium Package" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>90 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Premium Package</h3>
                        <div class="service-price">Rp 150,000</div>
                        <button class="service-btn"
                            onclick="showModal('Premium Package', 'Paket perawatan lengkap mulai dari potong rambut, perapian jenggot, hingga styling premium untuk tampilan maksimal.', '{{ asset('assets/demo/barbershop/img/premiun.jpg') }}')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/hairwash.jpeg') }}" alt="Hair Wash & Style" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>25 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Hair Wash & Style</h3>
                        <div class="service-price">Rp 35,000</div>
                        <button class="service-btn"
                            onclick="showModal('Hair Wash & Style', 'Cuci rambut menyegarkan dilanjutkan dengan penataan stylish untuk tampilan rapi dan percaya diri sepanjang hari.', '{{ asset('assets/demo/barbershop/img/hairwash.jpeg') }}')">
                            Detail Layanan
                        </button>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('assets/demo/barbershop/img/kids.jpg') }}" alt="Kids Cut" />
                        <div class="service-overlay">
                            <div class="service-duration">
                                <i class="fas fa-clock"></i>
                                <span>35 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-name">Kids Cut</h3>
                        <div class="service-price">Rp 50,000</div>
                        <button class="service-btn"
                            onclick="showModal('Kids Cut', 'Potongan rambut rapi dan nyaman untuk anak-anak, dengan gaya yang lucu dan mudah diatur.', '{{ asset('assets/demo/barbershop/img/kids.jpg') }}')">
                            Detail Layanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
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
                    <h1>LowBarber</h1>
                </div>
                <div class="footer-contact">
                    <h3 class="footer-title">Kontak Kami</h3>
                    <ul class="footer-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i> Jl.
                            Perjuangan No. 13, Medan 10220
                        </li>
                        <li>
                            <i class="fas fa-phone"></i> +62 813-8549-7404
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i> info@barber.com
                        </li>
                        <li>
                            <i class="fas fa-clock"></i> Sen-Sab: 09:00 -
                            21:00 | Minggu: 10:00 - 18:00
                        </li>
                    </ul>
                    <div class="footer-social" style="margin-top: 15px">
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Barber. PT. Era Cipta Digital</p>
            </div>
        </div>
    </footer>

    <script>
        // contoh: https://domainmu.com/
        window.ASSET_BASE = "{{ asset('') }}";
        window.assetUrl = function(p) {
            return (window.ASSET_BASE.replace(/\/$/, '') + '/' + String(p).replace(/^\//, ''));
        };
    </script>
    <script src="{{ asset('assets/demo/barbershop/script.js') }}"></script>
    <script>
        function toggleDetail(btn) {
            const detail = btn.nextElementSibling;
            if (
                detail.style.display === "none" ||
                detail.style.display === ""
            ) {
                detail.style.display = "block";
                btn.textContent = "Tutup Detail";
            } else {
                detail.style.display = "none";
                btn.textContent = "Detail Layanan";
            }
        }
    </script>

    @include('demo.universal-checkout-bubble', [
        'templateSlug' => 'barbershop',
    ])

    <script>
        // Navbar functionality dihapus sesuai permintaan

        // Smooth scrolling for navigation links
        const navLinks = document.querySelectorAll('a[href^="#"]');

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                const targetId = link.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Service modal functionality
        function showModal(title, description, imageUrl) {
            const modal = document.getElementById('serviceModal');
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
        }

        function closeModal() {
            const modal = document.getElementById('serviceModal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            const modal = document.getElementById('serviceModal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Intersection Observer for animations
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

        // Animate elements on scroll
        const animateElements = document.querySelectorAll(
            '.service-card, .stat-item, .contact-item, .capster-card');

        animateElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Counter animation for stats
        const animateCounters = () => {
            const counters = document.querySelectorAll('.stat-value');

            counters.forEach(counter => {
                const target = counter.textContent;
                const isNumber = !isNaN(parseFloat(target));

                if (isNumber) {
                    const finalValue = parseFloat(target);
                    let currentValue = 0;
                    const increment = finalValue / 50;
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= finalValue) {
                            counter.textContent = target;
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(currentValue) + (target.includes('+') ?
                                '+' : '');
                        }
                    }, 30);
                }
            });
        };

        // Trigger counter animation when stats section is visible
        const statsSection = document.querySelector('.stats');
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        if (statsSection) {
            statsObserver.observe(statsSection);
        }

        // Service card interactions
        const serviceCards = document.querySelectorAll('.service-card');

        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Hero Background Slider Functionality
        class HeroSlider {
            constructor() {
                this.bgSlides = document.querySelectorAll('.bg-slide');
                this.dots = document.querySelectorAll('.dot');
                this.prevBtn = document.querySelector('.slider-btn.prev');
                this.nextBtn = document.querySelector('.slider-btn.next');
                this.currentSlide = 0;
                this.totalSlides = this.bgSlides.length;
                this.autoPlayInterval = null;
                this.autoPlayDelay = 2000; // 2 detik

                this.init();
            }

            init() {
                if (this.bgSlides.length === 0) return;

                this.bindEvents();
                this.startAutoPlay();
                this.addTouchSupport();
            }

            bindEvents() {
                // Navigation buttons
                if (this.prevBtn) {
                    this.prevBtn.addEventListener('click', () => this.prevSlide());
                }

                if (this.nextBtn) {
                    this.nextBtn.addEventListener('click', () => this.nextSlide());
                }

                // Dot navigation
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => this.goToSlide(index));
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') this.prevSlide();
                    if (e.key === 'ArrowRight') this.nextSlide();
                });

                // Pause on hover
                const heroSection = document.querySelector('.hero-background-slider');
                if (heroSection) {
                    heroSection.addEventListener('mouseenter', () => this.pauseAutoPlay());
                    heroSection.addEventListener('mouseleave', () => this.startAutoPlay());
                }

                // Pause when tab is not active
                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) {
                        this.pauseAutoPlay();
                    } else {
                        this.startAutoPlay();
                    }
                });
            }

            goToSlide(index) {
                if (index < 0) index = this.totalSlides - 1;
                if (index >= this.totalSlides) index = 0;

                // Remove active class from all background slides and dots
                this.bgSlides.forEach(slide => slide.classList.remove('active'));
                this.dots.forEach(dot => dot.classList.remove('active'));

                // Add active class to current background slide and dot
                this.bgSlides[index].classList.add('active');
                this.dots[index].classList.add('active');

                // Update dynamic text content
                const dynamicTexts = document.querySelectorAll('.dynamic-text');
                const dynamicBtns = document.querySelectorAll('.dynamic-btn');

                dynamicTexts.forEach((text, index) => {
                    text.style.display = index === this.currentSlide ? 'block' : 'none';
                });

                dynamicBtns.forEach((btn, index) => {
                    btn.style.display = index === this.currentSlide ? 'block' : 'none';
                });

                this.currentSlide = index;
            }

            nextSlide() {
                this.goToSlide(this.currentSlide + 1);
            }

            prevSlide() {
                this.goToSlide(this.currentSlide - 1);
            }

            startAutoPlay() {
                this.pauseAutoPlay(); // Clear existing interval
                this.autoPlayInterval = setInterval(() => {
                    this.nextSlide();
                }, this.autoPlayDelay);
            }

            pauseAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
            }

            addTouchSupport() {
                const heroSection = document.querySelector('.hero-background-slider');
                if (!heroSection) return;

                let touchStartX = 0;
                let touchEndX = 0;

                heroSection.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                });

                heroSection.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    this.handleSwipe();
                });

                const handleSwipe = () => {
                    const swipeThreshold = 50;
                    const diff = touchStartX - touchEndX;

                    if (Math.abs(diff) > swipeThreshold) {
                        if (diff > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }
                };

                // Bind handleSwipe to the instance
                this.handleSwipe = handleSwipe;
            }
        }

        // Enhanced parallax effect for hero slider
        function initParallaxEffect() {
            const slides = document.querySelectorAll('.slide-bg');
            if (slides.length === 0) return;

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.3;

                slides.forEach(slide => {
                    if (slide.closest('.slide').classList.contains('active')) {
                        slide.style.transform = `translateY(${rate}px)`;
                    }
                });
            });
        }

        // Initialize hero slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize hero slider
            const heroSlider = new HeroSlider();

            // Initialize parallax effect
            initParallaxEffect();

            console.log('Hero slider initialized successfully');
        });

        // Parallax effect for hero section (legacy - will be replaced by new implementation)
        const heroBg = document.querySelector('.hero-bg');
        if (heroBg) {
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                heroBg.style.transform = `translateY(${rate}px)`;
            });
        }

        // Set active navigation item based on scroll position
        function setActiveNavItem() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        }

        // Face shape recommendation data
        const hairStyles = {
            oval: [{
                    name: "Classic Cut",
                    description: "Potongan klasik yang cocok untuk wajah oval",
                    image: assetUrl("assets/demo/barbershop/img/klasik.png")
                },
                {
                    name: "Modern Fade",
                    description: "Fade modern yang elegan",
                    image: assetUrl("assets/demo/barbershop/img/modern.jpg")
                },
                {
                    name: "Textured Crop",
                    description: "Crop dengan tekstur yang menarik",
                    image: assetUrl("assets/demo/barbershop/img/comma.JPG")
                }
            ],
            round: [{
                    name: "Pompadour",
                    description: "Style pompadour untuk wajah bulat",
                    image: assetUrl("assets/demo/barbershop/img/comma.JPG")
                },
                {
                    name: "Textured Crop",
                    description: "Crop dengan tekstur yang menarik",
                    image: assetUrl("assets/demo/barbershop/img/premiun.jpg")
                },
                {
                    name: "Side Part",
                    description: "Side part yang formal",
                    image: assetUrl("assets/demo/barbershop/img/bursfade.jpg")
                }
            ],
            square: [{
                    name: "Side Part",
                    description: "Side part yang formal",
                    image: assetUrl("assets/demo/barbershop/img/bursfade.jpg")
                },
                {
                    name: "Quiff",
                    description: "Quiff yang stylish",
                    image: assetUrl("assets/demo/barbershop/img/kids.jpg")
                },
                {
                    name: "Classic Short",
                    description: "Potongan pendek klasik",
                    image: assetUrl("assets/demo/barbershop/img/modern.jpg")
                }
            ],
            heart: [{
                    name: "Swept Back",
                    description: "Rambut disisir ke belakang",
                    image: assetUrl("assets/demo/barbershop/img/hairwash.jpeg")
                },
                {
                    name: "Textured Fringe",
                    description: "Fringe dengan tekstur",
                    image: assetUrl("assets/demo/barbershop/img/klasik.png")
                }
            ],
            diamond: [{
                    name: "Textured Fringe",
                    description: "Fringe dengan tekstur",
                    image: assetUrl("assets/demo/barbershop/img/klasik.png")
                },
                {
                    name: "Classic Short",
                    description: "Potongan pendek klasik",
                    image: assetUrl("assets/demo/barbershop/img/modern.jpg")
                }
            ],
            triangle: [{
                    name: "Classic Short",
                    description: "Potongan pendek klasik",
                    image: assetUrl("assets/demo/barbershop/img/modern.jpg")
                },
                {
                    name: "Textured Crop",
                    description: "Crop dengan tekstur yang menarik",
                    image: assetUrl("assets/demo/barbershop/img/comma.JPG")
                }
            ]
        };

        function displayRecommendations(faceShape) {
            console.log('Displaying recommendations for:', faceShape);

            const resultContainer = document.getElementById('recommendationResult');
            const recommendations = hairStyles[faceShape] || [];

            console.log('Recommendations found:', recommendations.length);

            if (recommendations.length === 0) {
                resultContainer.innerHTML = `
            <div class="result-placeholder">
                <i class="fas fa-info-circle"></i>
                <p>Tidak ada rekomendasi untuk bentuk wajah ini</p>
            </div>
        `;
                return;
            }

            let recommendationsHTML = `
        <div class="recommendation-content">
            <div class="recommendation-header">
                <h3 class="recommendation-title">Rekomendasi untuk Wajah ${faceShape.charAt(0).toUpperCase() + faceShape.slice(1)}</h3>
                <p class="recommendation-description">Berikut adalah style yang cocok untuk bentuk wajah Anda</p>
            </div>
            <div class="recommendation-styles">
    `;

            recommendations.forEach(style => {
                recommendationsHTML += `
            <div class="style-card" onclick="showStyleModal('${style.name}', '${style.description}', '${style.image}')">
                <img src="${style.image}" alt="${style.name}" onerror="this.src='assets/demo/barbershop/img/klasik.png'">
                <div class="style-info">
                    <h4 class="style-name">${style.name}</h4>
                    <p class="style-description">${style.description}</p>
                    <button class="style-view-btn">Lihat Detail</button>
                </div>
            </div>
        `;
            });

            recommendationsHTML += `
            </div>
        </div>
    `;

            resultContainer.innerHTML = recommendationsHTML;
            console.log('Recommendations displayed');
        }

        function showStyleModal(title, description, imageUrl) {
            console.log('Showing modal for:', title);

            // Create modal if it doesn't exist
            let styleModal = document.getElementById('styleModal');
            if (!styleModal) {
                styleModal = document.createElement('div');
                styleModal.id = 'styleModal';
                styleModal.className = 'modal';
                styleModal.innerHTML = `
            <div class="modal-content">
                <button class="modal-close" onclick="closeStyleModal()">&times;</button>
                <img src="${imageUrl}" alt="${title}" onerror="this.src='assets/demo/barbershop/img/klasik.png'">
                <h3>${title}</h3>
                <p>${description}</p>
            </div>
        `;
                document.body.appendChild(styleModal);
            } else {
                // Update existing modal
                const modalImg = styleModal.querySelector('img');
                const modalTitle = styleModal.querySelector('h3');
                const modalDesc = styleModal.querySelector('p');

                modalImg.src = imageUrl;
                modalImg.alt = title;
                modalTitle.textContent = title;
                modalDesc.textContent = description;
            }

            // Show modal
            styleModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            // Add ESC key listener
            const handleEscKey = (event) => {
                if (event.key === 'Escape') {
                    closeStyleModal();
                }
            };
            document.addEventListener('keydown', handleEscKey);

            // Store the handler for removal
            styleModal._escHandler = handleEscKey;
        }

        function closeStyleModal() {
            console.log('Closing style modal');

            const styleModal = document.getElementById('styleModal');
            if (styleModal) {
                styleModal.style.display = 'none';
                document.body.style.overflow = 'auto';

                // Remove ESC key listener
                if (styleModal._escHandler) {
                    document.removeEventListener('keydown', styleModal._escHandler);
                }
            }
        }

        // Initialize style recommendation system
        function initStyleRecommendation() {
            console.log('Initializing style recommendation system...');

            // Gunakan event delegation untuk menangani klik pada tombol bentuk wajah
            const container = document.querySelector('.face-shape-buttons');
            if (!container) {
                console.warn('Face shape buttons container not found');
                return;
            }

            // Tambahkan event listener ke container untuk event delegation
            container.addEventListener('click', function(e) {
                const button = e.target.closest('.face-shape-btn');
                if (button) {
                    console.log('Button clicked:', button.getAttribute('data-shape'));

                    // Hapus kelas active dari semua tombol
                    const allButtons = document.querySelectorAll('.face-shape-btn');
                    allButtons.forEach(btn => btn.classList.remove('active'));

                    // Tambahkan kelas active ke tombol yang diklik
                    button.classList.add('active');

                    // Tampilkan rekomendasi
                    const faceShape = button.getAttribute('data-shape');
                    displayRecommendations(faceShape);

                    // Scroll ke hasil rekomendasi
                    const resultContainer = document.getElementById('recommendationResult');
                    if (resultContainer) {
                        resultContainer.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });

            console.log('Style recommendation system initialized');

            // Tampilkan rekomendasi untuk bentuk wajah oval secara default
            // Pilih tombol oval dan tandai sebagai aktif
            const ovalButton = document.querySelector('.face-shape-btn[data-shape="oval"]');
            if (ovalButton) {
                ovalButton.classList.add('active');
                displayRecommendations('oval');
            }
        }

        // Close style modal when clicking outside
        window.addEventListener('click', (event) => {
            const styleModal = document.getElementById('styleModal');
            if (event.target === styleModal) {
                closeStyleModal();
            }
        });

        // Initialize all functions when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded - Starting initialization');

            // Set active nav item
            setActiveNavItem();

            // Initialize style recommendation with delay
            setTimeout(() => {
                initStyleRecommendation();
            }, 100);

            console.log('All functions initialized successfully');
        });

        // Add scroll event listener for active nav
        window.addEventListener('scroll', setActiveNavItem);
    </script>

</body>

</html>
