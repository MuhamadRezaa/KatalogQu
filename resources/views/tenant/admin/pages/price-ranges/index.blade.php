@extends('tenant.admin.layouts.app')

@section('title', 'Price Ranges')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Manajemen Price Ranges</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addPriceRangeModal">
                            <i class="fa fa-plus"></i> Tambah Price Range Baru
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Harga Minimum</th>
                                    <th scope="col">Harga Maksimum</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($priceRanges as $priceRange)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="user-info">
                                                <h6>{{ $priceRange->name }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $priceRange->min !== null ? 'Rp ' . number_format($priceRange->min, 0, ',', '.') : 'Tidak ada minimum' }}
                                        </td>
                                        <td>
                                            {{ $priceRange->max !== null ? 'Rp ' . number_format($priceRange->max, 0, ',', '.') : 'Tidak ada maksimum' }}
                                        </td>
                                        <td>
                                            @if ($priceRange->is_active)
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="editPriceRange({{ $priceRange->id }})" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deletePriceRange({{ $priceRange->id }})" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h5 class="f-light">Belum ada price range.</h5>
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

    <!-- Add Price Range Modal -->
    <div class="modal fade" id="addPriceRangeModal" tabindex="-1" aria-labelledby="addPriceRangeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPriceRangeModalLabel">Tambah Price Range Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addPriceRangeForm" action="{{ route('tenant.admin.price-ranges.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_name" class="form-label">Nama Price Range <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="add_min" class="form-label">Harga Minimum (Rp)</label>
                                    <input type="number" class="form-control" id="add_min" name="min" min="0"
                                        step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="add_max" class="form-label">Harga Maksimum (Rp)</label>
                                    <input type="number" class="form-control" id="add_max" name="max" min="0"
                                        step="0.01">
                                </div>
                            </div>
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
                        <button type="submit" class="btn btn-primary">Simpan Price Range</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Price Range Modal -->
    <div class="modal fade" id="editPriceRangeModal" tabindex="-1" aria-labelledby="editPriceRangeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPriceRangeModalLabel">Edit Price Range</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPriceRangeForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama Price Range <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_min" class="form-label">Harga Minimum (Rp)</label>
                                    <input type="number" class="form-control" id="edit_min" name="min"
                                        min="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_max" class="form-label">Harga Maksimum (Rp)</label>
                                    <input type="number" class="form-control" id="edit_max" name="max"
                                        min="0" step="0.01">
                                </div>
                            </div>
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
                        <button type="submit" class="btn btn-primary">Update Price Range</button>
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

        const showUrlTemplate = '{{ route('tenant.admin.price-ranges.show', ['price_range' => ':id']) }}';
        const updateUrlTemplate = '{{ route('tenant.admin.price-ranges.update', ['price_range' => ':id']) }}';
        const destroyUrlTemplate = '{{ route('tenant.admin.price-ranges.destroy', ['price_range' => ':id']) }}';

        function editPriceRange(priceRangeId) {
            const fetchUrl = showUrlTemplate.replace(':id', priceRangeId);

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const priceRange = data.priceRange;
                        const form = document.getElementById('editPriceRangeForm');

                        form.action = updateUrlTemplate.replace(':id', priceRangeId);
                        form.querySelector('#edit_name').value = priceRange.name;
                        form.querySelector('#edit_min').value = priceRange.min;
                        form.querySelector('#edit_max').value = priceRange.max;
                        form.querySelector('#edit_is_active').checked = priceRange.is_active;

                        new bootstrap.Modal(document.getElementById('editPriceRangeModal')).show();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching price range data:', error);
                    alert('Gagal memuat data price range. Silakan coba lagi.');
                });
        }

        function deletePriceRange(priceRangeId) {
            if (confirm('Anda yakin ingin menghapus price range ini? Tindakan ini tidak dapat dibatalkan.')) {
                const form = document.getElementById('deleteForm');
                form.action = destroyUrlTemplate.replace(':id', priceRangeId);
                form.submit();
            }
        }

        document.getElementById('addPriceRangeModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('addPriceRangeForm').reset();
        });
    </script>
@endpush
