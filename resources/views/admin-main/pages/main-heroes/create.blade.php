@extends('admin-main.layouts.app')

@section('title', 'Tambah Banner Utama Baru')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Formulir Tambah Banner Utama</h4>

                            <form action="{{ route('main-heroes.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Banner</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image">
                                    <div class="form-text">Rasio gambar direkomendasikan 16:9 (misal: 1920x1080 piksel).
                                        Format: JPG, PNG. Maks: 10MB.</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Banner</label>
                                    <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title" rows="3">{{ old('title') }}</textarea>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subjudul Banner</label>
                                    <textarea class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" rows="3">{{ old('subtitle') }}</textarea>
                                    @error('subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="button_text_{{ $i }}" class="form-label">Teks Tombol
                                                {{ $i }}</label>
                                            <input type="text"
                                                class="form-control @error('button_text_' . $i) is-invalid @enderror"
                                                id="button_text_{{ $i }}" name="button_text_{{ $i }}"
                                                value="{{ old('button_text_' . $i) }}">
                                            @error('button_text_' . $i)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="button_link_{{ $i }}" class="form-label">Link Tombol
                                                {{ $i }}</label>
                                            <input type="url"
                                                class="form-control @error('button_link_' . $i) is-invalid @enderror"
                                                id="button_link_{{ $i }}"
                                                name="button_link_{{ $i }}"
                                                value="{{ old('button_link_' . $i) }}">
                                            @error('button_link_' . $i)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor

                                <div class="mb-3 form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Banner</button>
                                <a href="{{ route('main-heroes.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/{{ config('app.tiny_api_key') }}/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#title, #subtitle',
            plugins: 'forecolor bold italic underline lists',
            toolbar: 'forecolor bold italic underline',
            menubar: false,
            height: 150,
            content_style: 'body { font-family: Poppins, sans-serif; font-size: 14px; }'
        });
    </script>
@endpush
