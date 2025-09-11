@extends('tenant.admin.layouts.app')

@section('title', 'Brand Produk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Manajemen Brand Produk</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                            <i class="fa fa-plus"></i> Tambah Brand Baru
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
                                    <th scope="col">No</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($brand->image)
                                                <img src="{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $brand->image]) }}"
                                                    alt="{{ $brand->name }}" class="img-fluid rounded"
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
                                                <h6>{{ $brand->name }}</h6>
                                                <p class="f-light">Slug: {{ $brand->slug }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($brand->is_active)
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="editBrand({{ $brand->id }})" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteBrand({{ $brand->id }})" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h5 class="f-light">Belum ada brand produk.</h5>
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

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Tambah Brand Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addBrandForm"
                    action="{{ route('tenant.admin.brands.store', ['tenant' => $userStore->tenant_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_name" class="form-label">Nama Brand <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_image" class="form-label">Logo</label>
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
                        <button type="submit" class="btn btn-primary">Simpan Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Brand Modal -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBrandForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama Brand <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Ganti Logo</label>
                            <input type="file" class="form-control" id="edit_image" name="image"
                                accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah logo.</div>
                        </div>
                        <div id="currentImagePreview" class="mb-3" style="display: none;">
                            <label class="form-label">Logo Saat Ini</label>
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
                        <button type="submit" class="btn btn-primary">Update Brand</button>
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

        const showUrlTemplate =
            '{{ route('tenant.admin.brands.show', ['tenant' => $userStore->tenant_id, 'brand' => ':id']) }}';
        const updateUrlTemplate =
            '{{ route('tenant.admin.brands.update', ['tenant' => $userStore->tenant_id, 'brand' => ':id']) }}';
        const destroyUrlTemplate =
            '{{ route('tenant.admin.brands.destroy', ['tenant' => $userStore->tenant_id, 'brand' => ':id']) }}';

        function editBrand(brandId) {
            const fetchUrl = showUrlTemplate.replace(':id', brandId);

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const brand = data.brand;
                        const form = document.getElementById('editBrandForm');

                        form.action = updateUrlTemplate.replace(':id', brandId);
                        form.querySelector('#edit_name').value = brand.name;
                        form.querySelector('#edit_is_active').checked = brand.is_active;

                        const assetBaseUrl =
                            '{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => ':path']) }}';

                        const preview = document.getElementById('currentImagePreview');
                        const img = document.getElementById('current_image');

                        if (brand.image) {
                            img.src = assetBaseUrl.replace(':path', brand.image);
                            preview.style.display = 'block';
                        } else {
                            preview.style.display = 'none';
                        }

                        new bootstrap.Modal(document.getElementById('editBrandModal')).show();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching brand data:', error);
                    alert('Gagal memuat data brand. Silakan coba lagi.');
                });
        }

        function deleteBrand(brandId) {
            if (confirm('Anda yakin ingin menghapus brand ini? Tindakan ini tidak dapat dibatalkan.')) {
                const form = document.getElementById('deleteForm');
                form.action = destroyUrlTemplate.replace(':id', brandId);
                form.submit();
            }
        }

        document.getElementById('addBrandModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('addBrandForm').reset();
        });
    </script>
@endpush
