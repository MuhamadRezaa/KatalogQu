@extends('admin-main.layouts.app')
@section('title', 'Manajemen Menu')

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
                            <th>Nama Menu</th>
                            <th>Kode Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->code }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit">
                                            <a href="#" class="btn-edit" data-id="{{ $menu->id }}"
                                                data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST"
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
                                <td colspan="4" class="text-center">Data tidak ditemukan.</td>
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
                    <h5 class="modal-title" id="createModalLabel">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('menu.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_create" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_create"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code_create" class="form-label">Kode Menu</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                id="code_create" name="code" value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_edit" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name_edit"
                                name="name" value="">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code_edit" class="form-label">Kode Menu</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                id="code_edit" name="code" value="">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
        const allMenus = @json($menus);

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

                // Find the menu from the embedded data
                const menu = allMenus.find(m => m.id == id); // Menggunakan 'menu'

                if (menu) {
                    // Populate form
                    editForm.find('#name_edit').val(menu.name);
                    editForm.find('#code_edit').val(menu.code);

                    // Set form action URL
                    let actionUrl = `{{ route('menu.update', '') }}/${id}`;
                    editForm.attr('action', actionUrl);
                } else {
                    console.error("Menu not found in embedded data:", id);
                    alert('Gagal mengambil data. Silakan coba lagi.');
                }
            });

            // Clear form on modal close
            $('#createModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });

            $('#editModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    </script>
@endpush
