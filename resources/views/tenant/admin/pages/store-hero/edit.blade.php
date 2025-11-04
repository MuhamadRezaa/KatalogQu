@extends('tenant.admin.layouts.app')

@section('title', 'Edit Store Hero')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Edit Store Hero</h4>
                        <a href="{{ route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id]) }}"
                            class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tenant.admin.store-heroes.update', ['tenant' => $userStore->tenant_id, 'store_hero' => $storeHero->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="image" class="form-label">Ganti Image</label>
                            @if ($storeHero->image_url)
                                <div class="mb-2">
                                    <img src="{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $storeHero->image_url]) }}"
                                        alt="Current Hero Image" class="img-fluid rounded" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/jpeg,image/png,image/jpg">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar. Rasio gambar
                                direkomendasikan 16:9 (misal: 1920x1080 piksel). Format: JPG, PNG. Maks: 10MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title" rows="3">{{ old('title', $storeHero->title) }}</textarea>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Sub Judul</label>
                            <textarea class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" rows="3">{{ old('subtitle', $storeHero->subtitle) }}</textarea>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-3">
                        <small>Tombol akan muncul di banner jika Anda mengisi kolom 'Nama Tombol'. Isi
                            'Tautan Tombol' untuk
                            menentukan tautan (Direct Link) pada tombol tersebut.</small>

                        <div class="my-3">
                            <label for="button_text" class="form-label">Nama Tombol</label>
                            <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                                id="button_text" name="button_text" value="{{ old('button_text', $storeHero->button_text) }}">
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Tautan Tombol</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" id="link"
                                name="link" value="{{ old('link', $storeHero->link) }}">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $storeHero->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Aktif</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Hero</button>
                        <a href="{{ route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id]) }}"
                            class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/{{ config('app.tiny_api_key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#title, #subtitle',
            plugins: 'forecolor bold',
            toolbar: 'forecolor bold',
            menubar: false,
            height: 150,
            content_style: 'body { font-family: Poppins, sans-serif; font-size: 14px; }'
        });
    </script>
@endpush