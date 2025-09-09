// // Navbar functionality dihapus sesuai permintaan

// // Smooth scrolling for navigation links
// const navLinks = document.querySelectorAll('a[href^="#"]');

// navLinks.forEach(link => {
//     link.addEventListener('click', () => {
//         const targetId = link.getAttribute('href');
//         const targetSection = document.querySelector(targetId);

//         if (targetSection) {
//             targetSection.scrollIntoView({
//                 behavior: 'smooth'
//             });
//         }
//     });
// });

// // Service modal functionality
// function showModal(title, description, imageUrl) {
//     const modal = document.getElementById('serviceModal');
//     const modalImage = document.getElementById('modalImage');
//     const modalTitle = document.getElementById('modalTitle');
//     const modalDescription = document.getElementById('modalDescription');

//     if (modal && modalImage && modalTitle && modalDescription) {
//         modalImage.src = imageUrl;
//         modalTitle.textContent = title;
//         modalDescription.textContent = description;
//         modal.style.display = 'flex';
//         document.body.style.overflow = 'hidden';
//     }
// }

// function closeModal() {
//     const modal = document.getElementById('serviceModal');
//     if (modal) {
//         modal.style.display = 'none';
//         document.body.style.overflow = 'auto';
//     }
// }

// // Close modal when clicking outside
// window.addEventListener('click', (event) => {
//     const modal = document.getElementById('serviceModal');
//     if (event.target === modal) {
//         closeModal();
//     }
// });

// // Intersection Observer for animations
// const observerOptions = {
//     threshold: 0.1,
//     rootMargin: '0px 0px -50px 0px'
// };

// const observer = new IntersectionObserver((entries) => {
//     entries.forEach(entry => {
//         if (entry.isIntersecting) {
//             entry.target.style.opacity = '1';
//             entry.target.style.transform = 'translateY(0)';
//         }
//     });
// }, observerOptions);

// // Animate elements on scroll
// const animateElements = document.querySelectorAll('.service-card, .gallery-item, .stat-item, .contact-item, .capster-card');

// animateElements.forEach(el => {
//     el.style.opacity = '0';
//     el.style.transform = 'translateY(30px)';
//     el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
//     observer.observe(el);
// });

// // Counter animation for stats
// const animateCounters = () => {
//     const counters = document.querySelectorAll('.stat-value');

//     counters.forEach(counter => {
//         const target = counter.textContent;
//         const isNumber = !isNaN(parseFloat(target));

//         if (isNumber) {
//             const finalValue = parseFloat(target);
//             let currentValue = 0;
//             const increment = finalValue / 50;
//             const timer = setInterval(() => {
//                 currentValue += increment;
//                 if (currentValue >= finalValue) {
//                     counter.textContent = target;
//                     clearInterval(timer);
//                 } else {
//                     counter.textContent = Math.floor(currentValue) + (target.includes('+') ? '+' : '');
//                 }
//             }, 30);
//         }
//     });
// };

// // Trigger counter animation when stats section is visible
// const statsSection = document.querySelector('.stats');
// const statsObserver = new IntersectionObserver((entries) => {
//     entries.forEach(entry => {
//         if (entry.isIntersecting) {
//             animateCounters();
//             statsObserver.unobserve(entry.target);
//         }
//     });
// }, { threshold: 0.5 });

// if (statsSection) {
//     statsObserver.observe(statsSection);
// }

// // Service card interactions
// const serviceCards = document.querySelectorAll('.service-card');

// serviceCards.forEach(card => {
//     card.addEventListener('mouseenter', () => {
//         card.style.transform = 'translateY(-10px) scale(1.02)';
//     });

//     card.addEventListener('mouseleave', () => {
//         card.style.transform = 'translateY(0) scale(1)';
//     });
// });

// // Gallery lightbox effect
// const galleryItems = document.querySelectorAll('.gallery-item');

// galleryItems.forEach(item => {
//     const img = item.querySelector('img');
//     const btn = item.querySelector('.gallery-btn');

//     if (btn && img) {
//         btn.addEventListener('click', () => {
//             // Create lightbox overlay
//             const lightbox = document.createElement('div');
//             lightbox.style.cssText = `
//                 position: fixed;
//                 top: 0;
//                 left: 0;
//                 width: 100%;
//                 height: 100%;
//                 background: rgba(0, 0, 0, 0.9);
//                 display: flex;
//                 align-items: center;
//                 justify-content: center;
//                 z-index: 9999;
//                 cursor: pointer;
//             `;

//             // Create lightbox content container
//             const lightboxContent = document.createElement('div');
//             lightboxContent.style.cssText = `
//                 position: relative;
//                 background: #1f2937;
//                 border-radius: 12px;
//                 padding: 24px;
//                 max-width: 90%;
//                 max-height: 90%;
//                 display: flex;
//                 flex-direction: column;
//                 align-items: center;
//                 gap: 16px;
//             `;

//             // Create haircut name element
//             const haircutName = document.createElement('h3');
//             haircutName.textContent = img.alt;
//             haircutName.style.cssText = `
//                 color: #fbbf24;
//                 font-size: 1.5rem;
//                 font-weight: bold;
//                 margin: 0;
//                 text-align: center;
//             `;

//             // Create image element
//             const lightboxImg = document.createElement('img');
//             lightboxImg.src = img.src;
//             lightboxImg.alt = img.alt;
//             lightboxImg.style.cssText = `
//                 max-width: 100%;
//                 max-height: 70vh;
//                 object-fit: contain;
//                 border-radius: 8px;
//             `;

//             // Create close button
//             const closeBtn = document.createElement('button');
//             closeBtn.textContent = 'Tutup';
//             closeBtn.style.cssText = `
//                 background: #fbbf24;
//                 color: #000000;
//                 border: none;
//                 padding: 10px 20px;
//                 border-radius: 8px;
//                 font-weight: 600;
//                 cursor: pointer;
//                 margin-top: 16px;
//             `;

//             // Add elements to lightbox
//             lightboxContent.appendChild(haircutName);
//             lightboxContent.appendChild(lightboxImg);
//             lightboxContent.appendChild(closeBtn);
//             lightbox.appendChild(lightboxContent);
//             document.body.appendChild(lightbox);

//             // Close lightbox on click outside or close button
//             const closeLightbox = () => {
//                 document.body.removeChild(lightbox);
//             };

//             lightbox.addEventListener('click', (e) => {
//                 if (e.target === lightbox) {
//                     closeLightbox();
//                 }
//             });

//             closeBtn.addEventListener('click', closeLightbox);

//             // Close with ESC key
//             const handleEscKey = (e) => {
//                 if (e.key === 'Escape') {
//                     closeLightbox();
//                 }
//             };
//             document.addEventListener('keydown', handleEscKey);

//             // Store handler for cleanup
//             lightbox._escHandler = handleEscKey;
//         });
//     }
// });

// // Hero Background Slider Functionality
// class HeroSlider {
//     constructor() {
//         this.bgSlides = document.querySelectorAll('.bg-slide');
//         this.dots = document.querySelectorAll('.dot');
//         this.prevBtn = document.querySelector('.slider-btn.prev');
//         this.nextBtn = document.querySelector('.slider-btn.next');
//         this.currentSlide = 0;
//         this.totalSlides = this.bgSlides.length;
//         this.autoPlayInterval = null;
//         this.autoPlayDelay = 2000; // 2 detik

//         this.init();
//     }

//     init() {
//         if (this.bgSlides.length === 0) return;

//         this.bindEvents();
//         this.startAutoPlay();
//         this.addTouchSupport();
//     }

//     bindEvents() {
//         // Navigation buttons
//         if (this.prevBtn) {
//             this.prevBtn.addEventListener('click', () => this.prevSlide());
//         }

//         if (this.nextBtn) {
//             this.nextBtn.addEventListener('click', () => this.nextSlide());
//         }

//         // Dot navigation
//         this.dots.forEach((dot, index) => {
//             dot.addEventListener('click', () => this.goToSlide(index));
//         });

//         // Keyboard navigation
//         document.addEventListener('keydown', (e) => {
//             if (e.key === 'ArrowLeft') this.prevSlide();
//             if (e.key === 'ArrowRight') this.nextSlide();
//         });

//         // Pause on hover
//         const heroSection = document.querySelector('.hero-background-slider');
//         if (heroSection) {
//             heroSection.addEventListener('mouseenter', () => this.pauseAutoPlay());
//             heroSection.addEventListener('mouseleave', () => this.startAutoPlay());
//         }

//         // Pause when tab is not active
//         document.addEventListener('visibilitychange', () => {
//             if (document.hidden) {
//                 this.pauseAutoPlay();
//             } else {
//                 this.startAutoPlay();
//             }
//         });
//     }

//     goToSlide(index) {
//         if (index < 0) index = this.totalSlides - 1;
//         if (index >= this.totalSlides) index = 0;

//         // Remove active class from all background slides and dots
//         this.bgSlides.forEach(slide => slide.classList.remove('active'));
//         this.dots.forEach(dot => dot.classList.remove('active'));

//         // Add active class to current background slide and dot
//         this.bgSlides[index].classList.add('active');
//         this.dots[index].classList.add('active');

//         // Update dynamic text content
//         const dynamicTexts = document.querySelectorAll('.dynamic-text');
//         const dynamicBtns = document.querySelectorAll('.dynamic-btn');

//         dynamicTexts.forEach((text, index) => {
//             text.style.display = index === this.currentSlide ? 'block' : 'none';
//         });

//         dynamicBtns.forEach((btn, index) => {
//             btn.style.display = index === this.currentSlide ? 'block' : 'none';
//         });

//         this.currentSlide = index;
//     }

//     nextSlide() {
//         this.goToSlide(this.currentSlide + 1);
//     }

//     prevSlide() {
//         this.goToSlide(this.currentSlide - 1);
//     }

//     startAutoPlay() {
//         this.pauseAutoPlay(); // Clear existing interval
//         this.autoPlayInterval = setInterval(() => {
//             this.nextSlide();
//         }, this.autoPlayDelay);
//     }

//     pauseAutoPlay() {
//         if (this.autoPlayInterval) {
//             clearInterval(this.autoPlayInterval);
//             this.autoPlayInterval = null;
//         }
//     }

//     addTouchSupport() {
//         const heroSection = document.querySelector('.hero-background-slider');
//         if (!heroSection) return;

//         let touchStartX = 0;
//         let touchEndX = 0;

//         heroSection.addEventListener('touchstart', (e) => {
//             touchStartX = e.changedTouches[0].screenX;
//         });

//         heroSection.addEventListener('touchend', (e) => {
//             touchEndX = e.changedTouches[0].screenX;
//             this.handleSwipe();
//         });

//         const handleSwipe = () => {
//             const swipeThreshold = 50;
//             const diff = touchStartX - touchEndX;

//             if (Math.abs(diff) > swipeThreshold) {
//                 if (diff > 0) {
//                     this.nextSlide();
//                 } else {
//                     this.prevSlide();
//                 }
//             }
//         };

//         // Bind handleSwipe to the instance
//         this.handleSwipe = handleSwipe;
//     }
// }

// // Enhanced parallax effect for hero slider
// function initParallaxEffect() {
//     const slides = document.querySelectorAll('.slide-bg');
//     if (slides.length === 0) return;

//     window.addEventListener('scroll', () => {
//         const scrolled = window.pageYOffset;
//         const rate = scrolled * -0.3;

//         slides.forEach(slide => {
//             if (slide.closest('.slide').classList.contains('active')) {
//                 slide.style.transform = `translateY(${rate}px)`;
//             }
//         });
//     });
// }

// // Initialize hero slider when DOM is loaded
// document.addEventListener('DOMContentLoaded', () => {
//     // Initialize hero slider
//     const heroSlider = new HeroSlider();

//     // Initialize parallax effect
//     initParallaxEffect();

//     console.log('Hero slider initialized successfully');
// });

// // Parallax effect for hero section (legacy - will be replaced by new implementation)
// const heroBg = document.querySelector('.hero-bg');
// if (heroBg) {
//     window.addEventListener('scroll', () => {
//         const scrolled = window.pageYOffset;
//         const rate = scrolled * -0.5;
//         heroBg.style.transform = `translateY(${rate}px)`;
//     });
// }

// // Set active navigation item based on scroll position
// function setActiveNavItem() {
//     const sections = document.querySelectorAll('section[id]');
//     const navLinks = document.querySelectorAll('.nav-link');

//     let current = '';
//     sections.forEach(section => {
//         const sectionTop = section.offsetTop;
//         const sectionHeight = section.clientHeight;
//         if (window.pageYOffset >= sectionTop - 200) {
//             current = section.getAttribute('id');
//         }
//     });

//     navLinks.forEach(link => {
//         link.classList.remove('active');
//         if (link.getAttribute('href') === `#${current}`) {
//             link.classList.add('active');
//         }
//     });
// }

// // Face shape recommendation data
// const hairStyles = {
//     oval: [
//         {
//             name: "Classic Cut",
//             description: "Potongan klasik yang cocok untuk wajah oval",
//             image: assetUrl("assets/demo/barbershop/img/klasik.png")
//         },
//         {
//             name: "Modern Fade",
//             description: "Fade modern yang elegan",
//             image: assetUrl("assets/demo/barbershop/img/modern.jpg")
//         },
//         {
//             name: "Textured Crop",
//             description: "Crop dengan tekstur yang menarik",
//             image: assetUrl("assets/demo/barbershop/img/comma.JPG")
//         }
//     ],
//     round: [
//         {
//             name: "Pompadour",
//             description: "Style pompadour untuk wajah bulat",
//             image: assetUrl("assets/demo/barbershop/img/comma.JPG")
//         },
//         {
//             name: "Textured Crop",
//             description: "Crop dengan tekstur yang menarik",
//             image: assetUrl("assets/demo/barbershop/img/premiun.jpg")
//         },
//         {
//             name: "Side Part",
//             description: "Side part yang formal",
//             image: assetUrl("assets/demo/barbershop/img/bursfade.jpg")
//         }
//     ],
//     square: [
//         {
//             name: "Side Part",
//             description: "Side part yang formal",
//             image: assetUrl("assets/demo/barbershop/img/bursfade.jpg")
//         },
//         {
//             name: "Quiff",
//             description: "Quiff yang stylish",
//             image: assetUrl("assets/demo/barbershop/img/kids.jpg")
//         },
//         {
//             name: "Classic Short",
//             description: "Potongan pendek klasik",
//             image: assetUrl("assets/demo/barbershop/img/modern.jpg")
//         }
//     ],
//     heart: [
//         {
//             name: "Swept Back",
//             description: "Rambut disisir ke belakang",
//             image: assetUrl("assets/demo/barbershop/img/hairwash.jpeg")
//         },
//         {
//             name: "Textured Fringe",
//             description: "Fringe dengan tekstur",
//             image: assetUrl("assets/demo/barbershop/img/klasik.png")
//         }
//     ],
//     diamond: [
//         {
//             name: "Textured Fringe",
//             description: "Fringe dengan tekstur",
//             image: assetUrl("assets/demo/barbershop/img/klasik.png")
//         },
//         {
//             name: "Classic Short",
//             description: "Potongan pendek klasik",
//             image: assetUrl("assets/demo/barbershop/img/modern.jpg")
//         }
//     ],
//     triangle: [
//         {
//             name: "Classic Short",
//             description: "Potongan pendek klasik",
//             image: assetUrl("assets/demo/barbershop/img/modern.jpg")
//         },
//         {
//             name: "Textured Crop",
//             description: "Crop dengan tekstur yang menarik",
//             image: assetUrl("assets/demo/barbershop/img/comma.JPG")
//         }
//     ]
// };

// function displayRecommendations(faceShape) {
//     console.log('Displaying recommendations for:', faceShape);

//     const resultContainer = document.getElementById('recommendationResult');
//     const recommendations = hairStyles[faceShape] || [];

//     console.log('Recommendations found:', recommendations.length);

//     if (recommendations.length === 0) {
//         resultContainer.innerHTML = `
//             <div class="result-placeholder">
//                 <i class="fas fa-info-circle"></i>
//                 <p>Tidak ada rekomendasi untuk bentuk wajah ini</p>
//             </div>
//         `;
//         return;
//     }

//     let recommendationsHTML = `
//         <div class="recommendation-content">
//             <div class="recommendation-header">
//                 <h3 class="recommendation-title">Rekomendasi untuk Wajah ${faceShape.charAt(0).toUpperCase() + faceShape.slice(1)}</h3>
//                 <p class="recommendation-description">Berikut adalah style yang cocok untuk bentuk wajah Anda</p>
//             </div>
//             <div class="recommendation-styles">
//     `;

//     recommendations.forEach(style => {
//         recommendationsHTML += `
//             <div class="style-card" onclick="showStyleModal('${style.name}', '${style.description}', '${style.image}')">
//                 <img src="${style.image}" alt="${style.name}" onerror="this.src='assets/demo/barbershop/img/klasik.png'">
//                 <div class="style-info">
//                     <h4 class="style-name">${style.name}</h4>
//                     <p class="style-description">${style.description}</p>
//                     <button class="style-view-btn">Lihat Detail</button>
//                 </div>
//             </div>
//         `;
//     });

//     recommendationsHTML += `
//             </div>
//         </div>
//     `;

//     resultContainer.innerHTML = recommendationsHTML;
//     console.log('Recommendations displayed');
// }

// function showStyleModal(title, description, imageUrl) {
//     console.log('Showing modal for:', title);

//     // Create modal if it doesn't exist
//     let styleModal = document.getElementById('styleModal');
//     if (!styleModal) {
//         styleModal = document.createElement('div');
//         styleModal.id = 'styleModal';
//         styleModal.className = 'modal';
//         styleModal.innerHTML = `
//             <div class="modal-content">
//                 <button class="modal-close" onclick="closeStyleModal()">&times;</button>
//                 <img src="${imageUrl}" alt="${title}" onerror="this.src='assets/demo/barbershop/img/klasik.png'">
//                 <h3>${title}</h3>
//                 <p>${description}</p>
//             </div>
//         `;
//         document.body.appendChild(styleModal);
//     } else {
//         // Update existing modal
//         const modalImg = styleModal.querySelector('img');
//         const modalTitle = styleModal.querySelector('h3');
//         const modalDesc = styleModal.querySelector('p');

//         modalImg.src = imageUrl;
//         modalImg.alt = title;
//         modalTitle.textContent = title;
//         modalDesc.textContent = description;
//     }

//     // Show modal
//     styleModal.style.display = 'flex';
//     document.body.style.overflow = 'hidden';

//     // Add ESC key listener
//     const handleEscKey = (event) => {
//         if (event.key === 'Escape') {
//             closeStyleModal();
//         }
//     };
//     document.addEventListener('keydown', handleEscKey);

//     // Store the handler for removal
//     styleModal._escHandler = handleEscKey;
// }

// function closeStyleModal() {
//     console.log('Closing style modal');

//     const styleModal = document.getElementById('styleModal');
//     if (styleModal) {
//         styleModal.style.display = 'none';
//         document.body.style.overflow = 'auto';

//         // Remove ESC key listener
//         if (styleModal._escHandler) {
//             document.removeEventListener('keydown', styleModal._escHandler);
//         }
//     }
// }

// // Initialize style recommendation system
// function initStyleRecommendation() {
//     console.log('Initializing style recommendation system...');

//     // Gunakan event delegation untuk menangani klik pada tombol bentuk wajah
//     const container = document.querySelector('.face-shape-buttons');
//     if (!container) {
//         console.warn('Face shape buttons container not found');
//         return;
//     }

//     // Tambahkan event listener ke container untuk event delegation
//     container.addEventListener('click', function (e) {
//         const button = e.target.closest('.face-shape-btn');
//         if (button) {
//             console.log('Button clicked:', button.getAttribute('data-shape'));

//             // Hapus kelas active dari semua tombol
//             const allButtons = document.querySelectorAll('.face-shape-btn');
//             allButtons.forEach(btn => btn.classList.remove('active'));

//             // Tambahkan kelas active ke tombol yang diklik
//             button.classList.add('active');

//             // Tampilkan rekomendasi
//             const faceShape = button.getAttribute('data-shape');
//             displayRecommendations(faceShape);

//             // Scroll ke hasil rekomendasi
//             const resultContainer = document.getElementById('recommendationResult');
//             if (resultContainer) {
//                 resultContainer.scrollIntoView({ behavior: 'smooth' });
//             }
//         }
//     });

//     console.log('Style recommendation system initialized');

//     // Tampilkan rekomendasi untuk bentuk wajah oval secara default
//     // Pilih tombol oval dan tandai sebagai aktif
//     const ovalButton = document.querySelector('.face-shape-btn[data-shape="oval"]');
//     if (ovalButton) {
//         ovalButton.classList.add('active');
//         displayRecommendations('oval');
//     }
// }

// // Close style modal when clicking outside
// window.addEventListener('click', (event) => {
//     const styleModal = document.getElementById('styleModal');
//     if (event.target === styleModal) {
//         closeStyleModal();
//     }
// });

// // Initialize all functions when DOM is loaded
// document.addEventListener('DOMContentLoaded', function () {
//     console.log('DOM Content Loaded - Starting initialization');

//     // Set active nav item
//     setActiveNavItem();

//     // Initialize style recommendation with delay
//     setTimeout(() => {
//         initStyleRecommendation();
//     }, 100);

//     console.log('All functions initialized successfully');
// });

// // Add scroll event listener for active nav
// window.addEventListener('scroll', setActiveNavItem);

