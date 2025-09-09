@extends('admin-main.layouts.app')
@section('title', 'Manajemen Menu Kategori Toko')

@section('content')
    <div class="card">
        <div class="card-header p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data @yield('title')</h4>
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
                            <th>Nama Kategori Toko</th>
                            <th>Menu Terkait</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($storeCategories as $storeCategory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $storeCategory->name }}</td>
                                <td>
                                    @forelse ($storeCategory->menus as $menu)
                                        <span class="badge badge-primary">{{ $menu->name }}</span>
                                    @empty
                                        <span class="badge badge-secondary">Tidak ada menu terkait</span>
                                    @endforelse
                                </td>
                                <td>
                                    <ul class="action">
                                        <li class="edit">
                                            <a href="#" class="btn-edit" data-id="{{ $storeCategory->id }}"
                                                data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Menu Kategori Toko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Pilih Menu:</label>
                            @foreach ($allMenus as $menu)
                                <div class="form-check">
                                    <input class="form-check-input menu-checkbox" type="checkbox" name="menus[]"
                                        value="{{ $menu->id }}" id="menu-{{ $menu->id }}">
                                    <label class="form-check-label" for="menu-{{ $menu->id }}">
                                        {{ $menu->name }}
                                    </label>
                                </div>
                            @endforeach
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
        const allStoreCategoriesData = @json($storeCategories->map(function($sc) { return ['id' => $sc->id, 'menus' => $sc->menus->pluck('id')]; }));

        $(function() {
            // DataTable initialization
            if ($.fn.DataTable) {
                const sel = '#table-1';
                if ($.fn.DataTable.isDataTable(sel)) {
                    $(sel).DataTable().destroy();
                }
                $(sel).DataTable({
                    responsive: true,
                    paging: true,
                    info: true,
                    searching: true
                });
            }

            // Handle Edit Modal
            $('.btn-edit').on('click', function() {
                const id = $(this).data('id');
                const editForm = $('#editForm');
                const editModal = $('#editModal');

                // Find the store category from the embedded data
                const storeCategory = allStoreCategoriesData.find(sc => sc.id == id);

                if (storeCategory) {
                    // Uncheck all checkboxes first
                    editForm.find('.menu-checkbox').prop('checked', false);

                    // Check the menus associated with this store category
                    storeCategory.menus.forEach(menuId => {
                        editForm.find(`#menu-${menuId}`).prop('checked', true);
                    });

                    // Set form action URL
                    let actionUrl = `{{ route('store-category-menus.update', '') }}/${id}`;
                    editForm.attr('action', actionUrl);
                } else {
                    console.error("Store Category not found in embedded data:", id);
                    alert('Gagal mengambil data. Silakan coba lagi.');
                }
            });

            // Clear form on modal close (optional, as we uncheck all on open)
            $('#editModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    </script>
@endpush
