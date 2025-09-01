@extends('tenant.admin.layouts.app')

@section('title', 'Store Settings')

@section('content')
    <form action="{{ route('tenant.admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-8">
                <!-- Store Information -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Store Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Store Name -->
                        <div class="mb-3">
                            <label for="store_name" class="form-label">Store Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('store_name') is-invalid @enderror"
                                id="store_name" name="store_name" value="{{ old('store_name', $userStore->store_name) }}"
                                required>
                            @error('store_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Store Description -->
                        <div class="mb-3">
                            <label for="store_description" class="form-label">Store Description</label>
                            <textarea class="form-control @error('store_description') is-invalid @enderror" id="store_description"
                                name="store_description" rows="4">{{ old('store_description', $userStore->store_description) }}</textarea>
                            @error('store_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Store Subdomain -->
                        <div class="mb-3">
                            <label for="subdomain" class="form-label">Store URL</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="subdomain"
                                    value="{{ $userStore->subdomain }}" readonly>
                                <span class="input-group-text">.{{ config('app.domain', 'localhost') }}</span>
                            </div>
                            <div class="form-text">Your store URL cannot be changed after setup</div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Contact Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Store Email -->
                            <div class="col-md-6 mb-3">
                                <label for="store_email" class="form-label">Store Email</label>
                                <input type="email" class="form-control @error('store_email') is-invalid @enderror"
                                    id="store_email" name="store_email"
                                    value="{{ old('store_email', $userStore->store_email) }}">
                                @error('store_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Store Phone -->
                            <div class="col-md-6 mb-3">
                                <label for="store_phone" class="form-label">Store Phone</label>
                                <input type="text" class="form-control @error('store_phone') is-invalid @enderror"
                                    id="store_phone" name="store_phone"
                                    value="{{ old('store_phone', $userStore->store_phone) }}">
                                @error('store_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Store Address -->
                        <div class="mb-3">
                            <label for="store_address" class="form-label">Store Address</label>
                            <textarea class="form-control @error('store_address') is-invalid @enderror" id="store_address" name="store_address"
                                rows="3">{{ old('store_address', $userStore->store_address) }}</textarea>
                            @error('store_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Social Media</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Facebook -->
                            <div class="col-md-6 mb-3">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                                    id="facebook_url" name="facebook_url"
                                    value="{{ old('facebook_url', $userStore->facebook_url) }}">
                                @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instagram -->
                            <div class="col-md-6 mb-3">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror"
                                    id="instagram_url" name="instagram_url"
                                    value="{{ old('instagram_url', $userStore->instagram_url) }}">
                                @error('instagram_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- WhatsApp -->
                            <div class="col-md-6 mb-3">
                                <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                                <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror"
                                    id="whatsapp_number" name="whatsapp_number"
                                    value="{{ old('whatsapp_number', $userStore->whatsapp_number) }}">
                                @error('whatsapp_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format: 628123456789 (without + sign)</div>
                            </div>

                            <!-- Twitter -->
                            <div class="col-md-6 mb-3">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror"
                                    id="twitter_url" name="twitter_url"
                                    value="{{ old('twitter_url', $userStore->twitter_url) }}">
                                @error('twitter_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <!-- Store Status -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Store Status</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Store Status -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $userStore->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Store is Active
                                </label>
                            </div>
                            <div class="form-text">When inactive, your store will not be accessible to customers</div>
                        </div>

                        <!-- Maintenance Mode -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode"
                                    name="maintenance_mode" value="1"
                                    {{ old('maintenance_mode', $userStore->maintenance_mode) ? 'checked' : '' }}>
                                <label class="form-check-label" for="maintenance_mode">
                                    Maintenance Mode
                                </label>
                            </div>
                            <div class="form-text">Show maintenance page to visitors</div>
                        </div>
                    </div>
                </div>

                <!-- Store Logo -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Store Logo</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Current Logo -->
                        @if ($userStore->store_logo)
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label>
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $userStore->store_logo) }}"
                                        alt="{{ $userStore->store_name }}" class="img-fluid rounded"
                                        style="max-height: 150px;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="store_logo" class="form-label">
                                {{ $userStore->store_logo ? 'Replace Logo' : 'Upload Logo' }}
                            </label>
                            <input type="file" class="form-control @error('store_logo') is-invalid @enderror"
                                id="store_logo" name="store_logo" accept="image/*">
                            @error('store_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Recommended size: 200x200px. Max file size: 2MB</div>
                        </div>

                        <!-- Logo Preview -->
                        <div id="logoPreview" style="display: none;">
                            <label class="form-label">New Logo Preview</label>
                            <div class="text-center">
                                <img id="previewImg" src="" alt="Preview" class="img-fluid rounded"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Store Information -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Store Info</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="f-light">
                            <div class="mb-2">
                                <strong>Setup Date:</strong><br>
                                {{ $userStore->setup_completed_at ? $userStore->setup_completed_at->format('M d, Y H:i') : 'N/A' }}
                            </div>
                            <div class="mb-2">
                                <strong>Last Updated:</strong><br>
                                {{ $userStore->updated_at->format('M d, Y H:i') }}
                            </div>
                            <div class="mb-2">
                                <strong>Store ID:</strong><br>
                                {{ $userStore->id }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="icofont icofont-check"></i> Save Changes
                            </button>
                            <a href="{{ route('tenant.admin.dashboard') }}" class="btn btn-secondary">
                                <i class="icofont icofont-arrow-left"></i> Back to Dashboard
                            </a>
                            <a href="http://{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}"
                                target="_blank" class="btn btn-info">
                                <i class="icofont icofont-external-link"></i> Preview Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Logo preview
        $('#store_logo').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                    $('#logoPreview').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#logoPreview').hide();
            }
        });

        // Form validation
        $('#settingsForm').on('submit', function(e) {
            let isValid = true;

            // Check required fields
            if (!$('#store_name').val().trim()) {
                $('#store_name').addClass('is-invalid');
                isValid = false;
            } else {
                $('#store_name').removeClass('is-invalid');
            }

            // Validate email format if provided
            const email = $('#store_email').val();
            if (email && !isValidEmail(email)) {
                $('#store_email').addClass('is-invalid');
                isValid = false;
            } else {
                $('#store_email').removeClass('is-invalid');
            }

            // Validate URLs if provided
            const urls = ['facebook_url', 'instagram_url', 'twitter_url'];
            urls.forEach(function(fieldId) {
                const url = $('#' + fieldId).val();
                if (url && !isValidUrl(url)) {
                    $('#' + fieldId).addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#' + fieldId).removeClass('is-invalid');
                }
            });

            // Validate WhatsApp number format
            const whatsapp = $('#whatsapp_number').val();
            if (whatsapp && !isValidWhatsApp(whatsapp)) {
                $('#whatsapp_number').addClass('is-invalid');
                alert('WhatsApp number must be in format: 628123456789 (without + sign)');
                isValid = false;
            } else {
                $('#whatsapp_number').removeClass('is-invalid');
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Validation helper functions
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidUrl(url) {
            try {
                new URL(url);
                return true;
            } catch (e) {
                return false;
            }
        }

        function isValidWhatsApp(number) {
            const whatsappRegex = /^62[0-9]{8,13}$/;
            return whatsappRegex.test(number);
        }

        // Auto-format WhatsApp number
        $('#whatsapp_number').on('input', function() {
            let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
            if (value.startsWith('0')) {
                value = '62' + value.substring(1); // Replace leading 0 with 62
            } else if (!value.startsWith('62')) {
                value = '62' + value; // Add 62 prefix
            }
            $(this).val(value);
        });

        // Show confirmation when changing store status
        $('#is_active').on('change', function() {
            if (!this.checked) {
                if (!confirm(
                        'Are you sure you want to deactivate your store? Customers will not be able to access it.'
                        )) {
                    this.checked = true;
                }
            }
        });

        $('#maintenance_mode').on('change', function() {
            if (this.checked) {
                if (!confirm(
                        'Are you sure you want to enable maintenance mode? Visitors will see a maintenance page.'
                        )) {
                    this.checked = false;
                }
            }
        });
    </script>
@endpush