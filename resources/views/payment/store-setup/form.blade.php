<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Setup Your Store - KatalogKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                    <i data-lucide="check" class="h-10 w-10 text-green-600"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Payment Successful!</h2>
                <p class="text-gray-600 mb-8">Now let's set up your store</p>
            </div>

            <div class="bg-white shadow-xl rounded-lg px-6 py-8">
                <form id="storeSetupForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="payment_id" value="{{ $payment->id }}">

                    <!-- Store Name -->
                    <div class="mb-6">
                        <label for="store_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Store Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="store_name" name="store_name"
                            value="{{ old('store_name', $userStore->store_name ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter your store name" required>
                        <div class="text-red-500 text-sm mt-1 hidden" id="store_name_error"></div>
                    </div>

                    <!-- Subdomain -->
                    <div class="mb-6">
                        <label for="subdomain" class="block text-sm font-medium text-gray-700 mb-2">
                            Subdomain <span class="text-red-500">*</span>
                        </label>
                        <div class="flex">
                            <input type="text" id="subdomain" name="subdomain"
                                value="{{ old('subdomain', $userStore->subdomain ?? '') }}"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="yourstore" pattern="[a-zA-Z0-9-]+"
                                title="Only letters, numbers, and hyphens allowed" required>
                            <span
                                class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm rounded-r-md">
                                .{{ config('app.domain', 'localhost') }}
                            </span>
                        </div>
                        <div class="text-sm mt-1" id="subdomain_feedback"></div>
                        <div class="text-red-500 text-sm mt-1 hidden" id="subdomain_error"></div>
                        <p class="text-xs text-gray-500 mt-1">Your store will be accessible at:
                            http://yourstore.{{ config('app.domain', 'localhost') }}</p>
                    </div>

                    <!-- Store Description -->
                    <div class="mb-6">
                        <label for="store_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Store Description
                        </label>
                        <textarea id="store_description" name="store_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Describe your store...">{{ old('store_description', $userStore->store_description ?? '') }}</textarea>
                        <div class="text-red-500 text-sm mt-1 hidden" id="store_description_error"></div>
                    </div>

                    <!-- Store Logo -->
                    <div class="mb-6">
                        <label for="store_logo" class="block text-sm font-medium text-gray-700 mb-2">
                            Store Logo
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors"
                            id="logo_dropzone">
                            <div class="space-y-1 text-center" id="logo_upload_area">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="store_logo"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a logo</span>
                                        <input id="store_logo" name="store_logo" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <div class="hidden" id="logo_preview">
                                <img class="mx-auto h-32 w-32 object-cover rounded-lg" id="logo_preview_img">
                                <button type="button" class="mt-2 text-sm text-red-600 hover:text-red-500"
                                    id="remove_logo">Remove</button>
                            </div>
                        </div>
                        <div class="text-red-500 text-sm mt-1 hidden" id="store_logo_error"></div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Store Phone -->
                            <div>
                                <label for="store_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="tel" id="store_phone" name="store_phone"
                                    value="{{ old('store_phone', $userStore->store_phone ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="+62 812 3456 7890">
                                <div class="text-red-500 text-sm mt-1 hidden" id="store_phone_error"></div>
                            </div>

                            <!-- Store Email -->
                            <div>
                                <label for="store_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input type="email" id="store_email" name="store_email"
                                    value="{{ old('store_email', $userStore->store_email ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="contact@yourstore.com">
                                <div class="text-red-500 text-sm mt-1 hidden" id="store_email_error"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Store Address -->
                    <div class="mb-6">
                        <label for="store_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Store Address
                        </label>
                        <textarea id="store_address" name="store_address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter your store address...">{{ old('store_address', $userStore->store_address ?? '') }}</textarea>
                        <div class="text-red-500 text-sm mt-1 hidden" id="store_address_error"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit" id="submit_btn"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                            <span id="submit_text">Create My Store</span>
                            <svg class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white" id="submit_loading"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="mt-6 bg-white shadow rounded-lg px-6 py-4">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Order Summary</h3>
                <div class="text-sm text-gray-600">
                    <p><strong>Template:</strong> {{ $payment->payment_details['template_name'] ?? 'Store Template' }}
                    </p>
                    <p><strong>Amount:</strong> Rp {{ number_format($payment->final_amount, 0, ',', '.') }}</p>
                    <p><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('storeSetupForm');
            const subdomainInput = document.getElementById('subdomain');
            const subdomainFeedback = document.getElementById('subdomain_feedback');
            const logoInput = document.getElementById('store_logo');
            const logoUploadArea = document.getElementById('logo_upload_area');
            const logoPreview = document.getElementById('logo_preview');
            const logoPreviewImg = document.getElementById('logo_preview_img');
            const removeLogo = document.getElementById('remove_logo');
            const submitBtn = document.getElementById('submit_btn');
            const submitText = document.getElementById('submit_text');
            const submitLoading = document.getElementById('submit_loading');

            let subdomainCheckTimeout;

            // Subdomain validation and availability check
            subdomainInput.addEventListener('input', function() {
                const subdomain = this.value.toLowerCase().replace(/[^a-zA-Z0-9-]/g, '');
                this.value = subdomain;

                clearTimeout(subdomainCheckTimeout);

                if (subdomain.length >= 3) {
                    subdomainCheckTimeout = setTimeout(() => {
                        checkSubdomainAvailability(subdomain);
                    }, 500);
                } else {
                    subdomainFeedback.textContent = '';
                    subdomainFeedback.className = 'text-sm mt-1';
                }
            });

            function checkSubdomainAvailability(subdomain) {
                fetch('/api/store-setup/check-subdomain?subdomain=' + subdomain)
                    .then(response => response.json())
                    .then(data => {
                        if (data.available) {
                            subdomainFeedback.textContent = '✓ Subdomain is available';
                            subdomainFeedback.className = 'text-sm mt-1 text-green-600';
                        } else {
                            subdomainFeedback.textContent = '✗ Subdomain is already taken';
                            subdomainFeedback.className = 'text-sm mt-1 text-red-600';
                        }
                    })
                    .catch(error => {
                        console.error('Error checking subdomain:', error);
                    });
            }

            // Logo upload handling
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreviewImg.src = e.target.result;
                        logoUploadArea.classList.add('hidden');
                        logoPreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeLogo.addEventListener('click', function() {
                logoInput.value = '';
                logoUploadArea.classList.remove('hidden');
                logoPreview.classList.add('hidden');
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                document.querySelectorAll('[id$="_error"]').forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });

                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Creating Store...';
                submitLoading.classList.remove('hidden');

                const formData = new FormData(form);

                fetch('/store-setup/process', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            alert('Store created successfully! Redirecting to your admin panel...');
                            // Redirect to tenant admin
                            window.location.href = data.redirect_url;
                        } else {
                            // Show validation errors
                            if (data.errors) {
                                Object.keys(data.errors).forEach(field => {
                                    const errorEl = document.getElementById(field + '_error');
                                    if (errorEl) {
                                        errorEl.textContent = data.errors[field][0];
                                        errorEl.classList.remove('hidden');
                                    }
                                });
                            } else {
                                alert('Error: ' + data.message);
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    })
                    .finally(() => {
                        // Reset loading state
                        submitBtn.disabled = false;
                        submitText.textContent = 'Create My Store';
                        submitLoading.classList.add('hidden');
                    });
            });
        });
    </script>
</body>

</html>
