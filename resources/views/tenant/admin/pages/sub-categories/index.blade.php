@extends('tenant.admin.layouts.app')

@section('title', 'Sub Kategori Produk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Manajemen Sub Kategori Produk</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addSubCategoryModal">
                            <i class="fa fa-plus"></i> Tambah Sub Kategori Baru
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subCategories as $subCategory)
                                    <tr>
                                        <td>
                                            @if ($subCategory->image)
                                                <img src="{{ route('tenant.asset', ['path' => $subCategory->image]) }}"
                                                    alt="{{ $subCategory->name }}" class="img-fluid rounded"
                                                    style="max-width: 60px;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fa fa-picture-o fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="user-info">
                                                <h6>{{ $subCategory->name }}</h6>
                                                <p class="f-light">Slug: {{ $subCategory->slug }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ Str::limit($subCategory->description, 100) }}</p>
                                        </td>
                                        <td>
                                            @if ($subCategory->is_active)
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="editSubCategory({{ $subCategory->id }})" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteSubCategory({{ $subCategory->id }})" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <h5 class="f-light">Belum ada sub kategori produk.</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Sub Category Modal -->
    <div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-labelledby="addSubCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubCategoryModalLabel">Tambah Sub Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addSubCategoryForm" action="{{ route('tenant.admin.sub-categories.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_name" class="form-label">Nama Sub Kategori <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="add_description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="add_image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="add_image" name="image"
                                accept="image/jpeg,image/png,image/webp">
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="add_is_active" name="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="add_is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Sub Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Sub Category Modal -->
    <div class="modal fade" id="editSubCategoryModal" tabindex="-1" aria-labelledby="editSubCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubCategoryModalLabel">Edit Sub Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSubCategoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama Sub Kategori <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Ganti Gambar</label>
                            <input type="file" class="form-control" id="edit_image" name="image"
                                accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                        </div>
                        <div id="currentImagePreview" class="mb-3" style="display: none;">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div><img id="current_image" src="" class="img-fluid rounded"
                                    style="max-height: 100px;"></div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active"
                                    value="1">
                                <label class="form-check-label" for="edit_is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Sub Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#table-1').DataTable({
                responsive: true,
                paging: true,
                info: true,
                searching: true
            });
        });

        const showUrlTemplate = '{{ route('tenant.admin.sub-categories.show', ['sub_category' => ':id']) }}';
        const updateUrlTemplate = '{{ route('tenant.admin.sub-categories.update', ['sub_category' => ':id']) }}';
        const destroyUrlTemplate = '{{ route('tenant.admin.sub-categories.destroy', ['sub_category' => ':id']) }}';

        function editSubCategory(subCategoryId) {
            const fetchUrl = showUrlTemplate.replace(':id', subCategoryId);

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const subCategory = data.subCategory;
                        const form = document.getElementById('editSubCategoryForm');

                        form.action = updateUrlTemplate.replace(':id', subCategoryId);
                        form.querySelector('#edit_name').value = subCategory.name;
                        form.querySelector('#edit_description').value = subCategory.description;
                        form.querySelector('#edit_is_active').checked = subCategory.is_active;

                        const assetBaseUrl = "{{ url('tenancy/assets') }}/";
                        const preview = document.getElementById('currentImagePreview');
                        const img = document.getElementById('current_image');
                        if (subCategory.image) {
                            img.src = assetBaseUrl + subCategory.image;
                            preview.style.display = 'block';
                        } else {
                            preview.style.display = 'none';
                        }

                        new bootstrap.Modal(document.getElementById('editSubCategoryModal')).show();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching sub-category data:', error);
                    alert('Gagal memuat data sub-kategori. Silakan coba lagi.');
                });
        }

        function deleteSubCategory(subCategoryId) {
            if (confirm('Anda yakin ingin menghapus sub-kategori ini? Tindakan ini tidak dapat dibatalkan.')) {
                const form = document.getElementById('deleteForm');
                form.action = destroyUrlTemplate.replace(':id', subCategoryId);
                form.submit();
            }
        }

        document.getElementById('addSubCategoryModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('addSubCategoryForm').reset();
        });
    </script>
@endpush
