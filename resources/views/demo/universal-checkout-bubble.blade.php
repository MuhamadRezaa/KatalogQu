<!-- Universal Checkout Bubble -->
<!-- This component can be used across different demo templates by setting data attributes -->
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<div id="checkout-bubble" class="fixed bottom-6 right-6 z-40 hidden" data-template-slug="{{ $templateSlug ?? '' }}">
    <div id="checkout-bubble-content"
        class="text-white rounded-full shadow-2xl hover:shadow-3xl transition-all transform hover:scale-105">
        <button id="checkout-btn" class="flex items-center gap-3 px-6 py-4 rounded-full">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8" />
                </svg>
                <span class="font-semibold">Checkout Template</span>
            </div>
            <div class="bg-white/20 rounded-full px-3 py-1">
                <span id="template-price" class="text-sm font-bold">Rp 150.000</span>
            </div>
        </button>
    </div>
</div>

<script>
    // Universal Checkout Bubble Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutBubble = document.getElementById('checkout-bubble');
        const checkoutBtn = document.getElementById('checkout-btn');

        if (!checkoutBubble || !checkoutBtn) {
            console.warn('Checkout bubble elements not found');
            return;
        }

        // Show checkout bubble immediately when page loads
        function showCheckoutBubble() {
            checkoutBubble.classList.remove('hidden');
            checkoutBubble.classList.add('animate-bounce');
            setTimeout(() => {
                checkoutBubble.classList.remove('animate-bounce');
            }, 2000);
        }

        // Initialize the checkout bubble with template data
        function initializeCheckoutBubble() {
            // Get template slug from data attribute
            const templateSlug = checkoutBubble.getAttribute('data-template-slug');

            if (!templateSlug) {
                console.error('Template slug not provided');
                return;
            }

            // Fetch template data from API
            // Use the current origin for API calls to ensure correct port
            const baseUrl = window.location.origin;
            fetch(`${baseUrl}/api/templates/${templateSlug}`)
                .then(response => response.json())
                .then(template => {
                    if (template.error) {
                        console.error('Template not found:', template.error);
                        return;
                    }

                    // Update price display
                    const priceElement = document.getElementById('template-price');
                    if (priceElement) {
                        const price = parseFloat(template.price) || 150000;
                        priceElement.textContent = 'Rp ' + price.toLocaleString('id-ID');
                    }

                    // Set gradient based on template category
                    const bubbleContent = document.getElementById('checkout-bubble-content');
                    if (bubbleContent) {
                        let gradientClass = 'bg-gradient-to-r from-[#478413] to-[#34571E]';
                        // Default

                        // Customize gradient based on template name/category

                        // Remove existing gradient classes and add new one
                        bubbleContent.className = bubbleContent.className.replace(/bg-gradient-to-r[^"]*/g,
                            '');
                        bubbleContent.classList.add(...gradientClass.split(' '));
                    }

                    // Show the bubble
                    showCheckoutBubble();
                })
                .catch(error => {
                    console.error('Error fetching template data:', error);
                    // Show bubble with default values
                    showCheckoutBubble();
                });
        }

        // Checkout button click handler - redirect to checkout page with template slug
        checkoutBtn.addEventListener('click', function() {
            const templateSlug = checkoutBubble.getAttribute('data-template-slug');
            if (templateSlug) {
                window.location.href = `/checkout/template/${templateSlug}`;
            } else {
                window.location.href = '/checkout/template/toko-komputer';
            }
        });

        // Initialize the checkout bubble
        initializeCheckoutBubble();
    });
</script>
