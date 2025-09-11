@extends('tenant.admin.layouts.app')

@section('title', 'Pengaturan Toko')

@section('content')
    <form action="{{ route('tenant.admin.settings.update', ['tenant' => $userStore->tenant_id]) }}" method="POST"
        enctype="multipart/form-data" id="settingsForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-8">
                <!-- Informasi Toko -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Informasi Toko</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Nama Toko -->
                        <div class="mb-3">
                            <label for="store_name" class="form-label">Nama Toko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('store_name') is-invalid @enderror"
                                id="store_name" name="store_name" value="{{ old('store_name', $userStore->store_name) }}"
                                required>
                            @error('store_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi Toko -->
                        <div class="mb-3">
                            <label for="store_description" class="form-label">Deskripsi Toko</label>
                            <textarea class="form-control @error('store_description') is-invalid @enderror" id="store_description"
                                name="store_description" rows="4">{{ old('store_description', $userStore->store_description) }}</textarea>
                            @error('store_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subdomain Toko -->
                        <div class="mb-3">
                            <label for="subdomain" class="form-label">URL Toko</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="subdomain"
                                    value="{{ $userStore->subdomain }}" readonly>
                                <span class="input-group-text">.{{ config('app.domain', 'localhost') }}</span>
                            </div>
                            <div class="form-text">URL toko Anda tidak dapat diubah setelah pengaturan awal</div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Informasi Kontak</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Email Toko -->
                            <div class="col-md-6 mb-3">
                                <label for="store_email" class="form-label">Email Toko</label>
                                <input type="email" class="form-control @error('store_email') is-invalid @enderror"
                                    id="store_email" name="store_email"
                                    value="{{ old('store_email', $userStore->store_email) }}">
                                @error('store_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Telepon Toko -->
                            <div class="col-md-6 mb-3">
                                <label for="store_phone" class="form-label">Telepon Toko</label>
                                <input type="text" class="form-control @error('store_phone') is-invalid @enderror"
                                    id="store_phone" name="store_phone"
                                    value="{{ old('store_phone', $userStore->store_phone) }}">
                                @error('store_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat Toko -->
                        <div class="mb-3">
                            <label for="store_address" class="form-label">Alamat Toko</label>
                            <textarea class="form-control @error('store_address') is-invalid @enderror" id="store_address" name="store_address"
                                rows="3">{{ old('store_address', $userStore->store_address) }}</textarea>
                            @error('store_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Media Sosial</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Facebook -->
                            <div class="col-md-6 mb-3">
                                <label for="facebook_url" class="form-label">URL Facebook</label>
                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                                    id="facebook_url" name="facebook_url"
                                    value="{{ old('facebook_url', $userStore->facebook_url) }}">
                                @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instagram -->
                            <div class="col-md-6 mb-3">
                                <label for="instagram_url" class="form-label">URL Instagram</label>
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
                            {{-- <div class="col-md-6 mb-3">
                                <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror"
                                    id="whatsapp_number" name="whatsapp_number"
                                    value="{{ old('whatsapp_number', $userStore->whatsapp_number) }}">
                                @error('whatsapp_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format: 628123456789 (tanpa tanda +)</div>
                            </div> --}}

                            <!-- Twitter -->
                            <div class="col-md-6 mb-3">
                                <label for="twitter_url" class="form-label">URL Twitter</label>
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
                <!-- Status Toko -->
                {{-- <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Status Toko</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Status Toko -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $userStore->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Toko Aktif
                                </label>
                            </div>
                            <div class="form-text">Saat tidak aktif, toko Anda tidak akan dapat diakses oleh pelanggan
                            </div>
                        </div>

                        <!-- Mode Pemeliharaan -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode"
                                    name="maintenance_mode" value="1"
                                    {{ old('maintenance_mode', $userStore->maintenance_mode) ? 'checked' : '' }}>
                                <label class="form-check-label" for="maintenance_mode">
                                    Mode Pemeliharaan
                                </label>
                            </div>
                            <div class="form-text">Tampilkan halaman pemeliharaan kepada pengunjung</div>
                        </div>
                    </div>
                </div> --}}

                <!-- Logo Toko -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Logo Toko</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Logo Saat Ini -->
                        @if ($userStore->store_logo)
                            <div class="mb-3">
                                <label class="form-label">Logo Saat Ini</label>
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $userStore->store_logo) }}"
                                        alt="{{ $userStore->store_name }}" class="img-fluid rounded"
                                        style="max-height: 150px;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="store_logo" class="form-label">
                                {{ $userStore->store_logo ? 'Ganti Logo' : 'Unggah Logo' }}
                            </label>
                            <input type="file" class="form-control @error('store_logo') is-invalid @enderror"
                                id="store_logo" name="store_logo" accept="image/*">
                            @error('store_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Ukuran yang disarankan: 200x200px. Ukuran file maksimal: 2MB</div>
                        </div>

                        <!-- Pratinjau Logo Baru -->
                        <div id="logoPreview" style="display: none;">
                            <label class="form-label">Pratinjau Logo Baru</label>
                            <div class="text-center">
                                <img id="previewImg" src="" alt="Pratinjau" class="img-fluid rounded"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Toko -->
                <div class="card">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h4>Info Toko</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="f-light">
                            <div class="mb-2">
                                <strong>Tanggal Pengaturan:</strong><br>
                                {{ $userStore->setup_completed_at ? $userStore->setup_completed_at->format('d F Y H:i') : 'N/A' }}
                            </div>
                            <div class="mb-2">
                                <strong>Terakhir Diperbarui:</strong><br>
                                {{ $userStore->updated_at->format('d F Y H:i') }}
                            </div>
                            {{-- <div class="mb-2">
                                <strong>ID Toko:</strong><br>
                                {{ $userStore->id }}
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('tenant.admin.dashboard', ['tenant' => $userStore->tenant_id]) }}"
                                class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali ke Dashboard
                            </a>
                            <a href="http://{{ $userStore->subdomain }}.{{ config('app.domain', 'localhost') }}"
                                target="_blank" class="btn btn-info">
                                <i class="fa fa-external-link"></i> Pratinjau Toko
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

        // Validasi Form
        $('#settingsForm').on('submit', function(e) {
            let isValid = true;

            // Periksa kolom yang wajib diisi
            if (!$('#store_name').val().trim()) {
                $('#store_name').addClass('is-invalid');
                isValid = false;
            } else {
                $('#store_name').removeClass('is-invalid');
            }

            // Validasi format email jika disediakan
            const email = $('#store_email').val();
            if (email && !isValidEmail(email)) {
                $('#store_email').addClass('is-invalid');
                isValid = false;
            } else {
                $('#store_email').removeClass('is-invalid');
            }

            // Validasi URL jika disediakan
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

            // Validasi format nomor WhatsApp
            const whatsapp = $('#whatsapp_number').val();
            if (whatsapp && !isValidWhatsApp(whatsapp)) {
                $('#whatsapp_number').addClass('is-invalid');
                alert('Nomor WhatsApp harus dalam format: 628123456789 (tanpa tanda +)');
                isValid = false;
            } else {
                $('#whatsapp_number').removeClass('is-invalid');
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Fungsi pembantu validasi
        function isValidEmail(email) {
            const emailRegex = /^[^\]+@[^\]+\.[^\]+$/;
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

        // Format otomatis nomor WhatsApp
        $('#whatsapp_number').on('input', function() {
            let value = $(this).val().replace(/\D/g, ''); // Hapus non-digit
            if (value.startsWith('0')) {
                value = '62' + value.substring(1); // Ganti 0 di awal dengan 62
            } else if (!value.startsWith('62')) {
                value = '62' + value; // Tambahkan awalan 62
            }
            $(this).val(value);
        });

        // Tampilkan konfirmasi saat mengubah status toko
        $('#is_active').on('change', function() {
            if (!this.checked) {
                if (!confirm(
                        'Apakah Anda yakin ingin menonaktifkan toko Anda? Pelanggan tidak akan dapat mengaksesnya.'
                    )) {
                    this.checked = true;
                }
            }
        });

        $('#maintenance_mode').on('change', function() {
            if (this.checked) {
                if (!confirm(
                        'Apakah Anda yakin ingin mengaktifkan mode pemeliharaan? Pengunjung akan melihat halaman pemeliharaan.'
                    )) {
                    this.checked = false;
                }
            }
        });
    </script>
@endpush
