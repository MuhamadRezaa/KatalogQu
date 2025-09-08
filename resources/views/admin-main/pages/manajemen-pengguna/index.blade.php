@extends('admin-main.layouts.app')
@section('title', 'Manajemen Pengguna')

@section('content')
    <div class="card">
        <div class="card-header p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data @yield('title')</h4>
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Tambah Data
                </button> --}}
            </div>
        </div>
        <div class="card-body">

            <div class="tab-content" id="userTabsContent">
                <div class="tab-pane fade show active" role="tabpanel">
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

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="display" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>{{ request('status') == 'trashed' ? 'Tanggal Dihapus' : 'Tanggal Bergabung' }}</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td><span
                                                class="badge {{ $item->role == 'admin' ? 'badge-danger' : 'badge-primary' }}">{{ ucfirst($item->role) }}</span>
                                        </td>
                                        <td>
                                            @if ($item->trashed())
                                                {{ $item->deleted_at ? $item->deleted_at->format('d M Y') : 'N/A' }}
                                            @else
                                                {{ $item->created_at ? $item->created_at->format('d M Y') : 'N/A' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->role !== 'admin')
                                                @if ($item->trashed())
                                                    {{-- Tombol untuk Restore (mengaktifkan) --}}
                                                    <form action="{{ route('users.restore', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success">Aktifkan</button>
                                                    </form>
                                                @else
                                                    {{-- Tombol untuk Soft Delete (menonaktifkan) --}}
                                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Nonaktifkan</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                <option selected disabled value="">Pilih Role...</option>
                                <option value="pengguna">Pengguna</option>
                                <option value="admin">Admin</option>
                            </select>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_edit" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name_edit" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email_edit" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_edit" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="role_edit" class="form-label">Role</label>
                            <select class="form-select" id="role_edit" name="role">
                                <option value="pengguna">Pengguna</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <hr>
                        <p class="text-muted">Kosongkan password jika tidak ingin mengubahnya.</p>
                        <div class="mb-3">
                            <label for="password_edit" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password_edit" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation_edit" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation_edit"
                                name="password_confirmation">
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
        const allUsers = @json($users->items());

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

                const user = allUsers.find(u => u.id == id);

                if (user) {
                    editForm.find('#name_edit').val(user.name);
                    editForm.find('#email_edit').val(user.email);
                    editForm.find('#role_edit').val(user.role);

                    let actionUrl = `{{ route('users.update', '') }}/${id}`;
                    editForm.attr('action', actionUrl);
                } else {
                    console.error("User not found:", id);
                    alert('Gagal mengambil data. Silakan coba lagi.');
                }
            });

            // Clear form on modal close
            $('#createModal, #editModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    </script>
@endpush
