@extends('admin-main.layouts.app')
@section('title', 'Manajemen Template')

@section('content')
    <div class="card">
        <div class="card-header p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data @yield('title')</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops! Ada beberapa masalah dengan input Anda.</strong><br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive custom-scrollbar">
                <table class="display" id="table-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Nama Template</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($templates as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($item->preview_image)
                                        <img src="{{ Storage::url($item->preview_image) }}" alt="Preview" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name ?? 'N/A' }}</td>
                                <td>{{ Str::limit($item->description ?? 'Tidak ada deskripsi', 50) }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit">
                                            <a href="#" class="btn-edit" data-id="{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <form action="{{ route('template.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('template.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Template</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="categories_store_id" class="form-label">Kategori Toko</label>
                            <select class="form-select" name="categories_store_id" required>
                                <option selected disabled value="">Pilih Kategori...</option>
                                @foreach ($kategoriTokos as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ old('categories_store_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}" required
                                min="0" step="any">
                        </div>
                        <div class="mb-3">
                            <label for="preview_image" class="form-label">Gambar Preview</label>
                            <input class="form-control" type="file" name="preview_image"
                                accept="image/jpeg,image/png,image/webp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_edit" class="form-label">Nama Template</label>
                            <input type="text" class="form-control" id="name_edit" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="categories_store_id_edit" class="form-label">Kategori Toko</label>
                            <select class="form-select" id="categories_store_id_edit" name="categories_store_id">
                                <option selected disabled value="">Pilih Kategori...</option>
                                @foreach ($kategoriTokos as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description_edit" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description_edit" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price_edit" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price_edit" name="price" min="0"
                                step="any">
                        </div>
                        <div class="mb-3">
                            <label for="preview_image_edit" class="form-label">Gambar Preview Baru</label>
                            <input class="form-control" type="file" name="preview_image"
                                accept="image/jpeg,image/png,image/webp">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                        </div>
                        <div class="mb-3">
                            <label>Preview Saat Ini:</label>
                            <div id="current_preview_image">
                                <!-- Image will be loaded here by JS -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const allTemplates = @json($templates->items());

        $(function() {
            // DataTable initialization
            $('#table-1').DataTable({
                responsive: true,
                paging: true,
                info: true,
                searching: true
            });

            // Handle Edit Modal
            $('.btn-edit').on('click', function() {
                const id = $(this).data('id');
                const editForm = $('#editForm');
                const editModal = $('#editModal');

                // Find the template from the embedded data
                const template = allTemplates.find(t => t.id == id);

                if (template) {
                    // Populate form
                    editForm.find('#name_edit').val(template.name);
                    editForm.find('#categories_store_id_edit').val(template.categories_store_id);
                    editForm.find('#description_edit').val(template.description || '');
                    editForm.find('#price_edit').val(template.price);

                    // Set form action URL
                    let actionUrl = `{{ route('template.update', '') }}/${id}`;
                    editForm.attr('action', actionUrl);

                    // Display current image
                    let imagePreviewContainer = editModal.find('#current_preview_image');
                    imagePreviewContainer.html('<p>Tidak ada gambar.</p>'); // Default text
                    if (template.preview_image) {
                        let imageUrl = `{{ Storage::url('') }}${template.preview_image}`.replace(
                            'public/', '');
                        imagePreviewContainer.html(
                            `<img src="${imageUrl}" alt="Preview" width="150">`);
                    }
                } else {
                    console.error("Template not found in embedded data:", id);
                    alert('Gagal mengambil data. Silakan coba lagi.');
                }
            });

            // Clear form on modal close
            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    </script>
@endpush
