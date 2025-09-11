@extends('tenant.admin.layouts.app')

@section('title', 'Satuan Produk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Manajemen Satuan Produk</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addProductUnitModal">
                            <i class="fa fa-plus"></i> Tambah Satuan Baru
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
                                    <th scope="col">Nama Satuan</th>
                                    <th scope="col">Kode Satuan</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($productUnits as $productUnit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $productUnit->unit_name }}</td>
                                        <td>{{ $productUnit->unit_code }}</td>
                                        <td>{{ Str::limit($productUnit->description, 100) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="editProductUnit({{ $productUnit->id }})" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteProductUnit({{ $productUnit->id }})" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h5 class="f-light">Belum ada satuan produk.</h5>
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

    <!-- Add Product Unit Modal -->
    <div class="modal fade" id="addProductUnitModal" tabindex="-1" aria-labelledby="addProductUnitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductUnitModalLabel">Tambah Satuan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addProductUnitForm"
                    action="{{ route('tenant.admin.product-units.store', ['tenant' => $userStore->tenant_id]) }}"
                    method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_unit_name" class="form-label">Nama Satuan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_unit_name" name="unit_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_unit_code" class="form-label">Kode Satuan</label>
                            <input type="text" class="form-control" id="add_unit_code" name="unit_code">
                        </div>
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="add_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Satuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Unit Modal -->
    <div class="modal fade" id="editProductUnitModal" tabindex="-1" aria-labelledby="editProductUnitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductUnitModalLabel">Edit Satuan Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProductUnitForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_unit_name" class="form-label">Nama Satuan <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_unit_name" name="unit_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_unit_code" class="form-label">Kode Satuan</label>
                            <input type="text" class="form-control" id="edit_unit_code" name="unit_code">
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Satuan</button>
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
            '{{ route('tenant.admin.product-units.show', ['tenant' => $userStore->tenant_id, 'product_unit' => ':id']) }}';
        const updateUrlTemplate =
            '{{ route('tenant.admin.product-units.update', ['tenant' => $userStore->tenant_id, 'product_unit' => ':id']) }}';
        const destroyUrlTemplate =
            '{{ route('tenant.admin.product-units.destroy', ['tenant' => $userStore->tenant_id, 'product_unit' => ':id']) }}';

        function editProductUnit(productUnitId) {
            const fetchUrl = showUrlTemplate.replace(':id', productUnitId);

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const productUnit = data.productUnit;
                        const form = document.getElementById('editProductUnitForm');

                        form.action = updateUrlTemplate.replace(':id', productUnitId);
                        form.querySelector('#edit_unit_name').value = productUnit.unit_name;
                        form.querySelector('#edit_unit_code').value = productUnit.unit_code;
                        form.querySelector('#edit_description').value = productUnit.description;

                        new bootstrap.Modal(document.getElementById('editProductUnitModal')).show();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching product unit data:', error);
                    alert('Gagal memuat data satuan produk. Silakan coba lagi.');
                });
        }

        function deleteProductUnit(productUnitId) {
            if (confirm('Anda yakin ingin menghapus satuan produk ini? Tindakan ini tidak dapat dibatalkan.')) {
                const form = document.getElementById('deleteForm');
                form.action = destroyUrlTemplate.replace(':id', productUnitId);
                form.submit();
            }
        }

        document.getElementById('addProductUnitModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('addProductUnitForm').reset();
        });
    </script>
@endpush
