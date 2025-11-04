@extends('admin-main.layouts.app')
@section('title', 'Pesan Masuk')

@section('content')
    <div class="card">
        <div class="card-header p-4">
            <h4 class="card-title mb-0">Data @yield('title')</h4>
        </div>
        <div class="card-body">
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Tanggal Kirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $item)
                            <tr>
                                <td>{{ $loop->iteration + $contacts->firstItem() - 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->subjek }}</td>
                                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit">
                                            <a href="#" class="btn-view" data-id="{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-target="#viewModal">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <form action="{{ route('admin.contacts.destroy', $item->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-delete"
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
                                <td colspan="6" class="text-center">Tidak ada pesan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9" id="contact-name"></dd>

                        <hr>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9" id="contact-email"></dd>

                        <hr>

                        <dt class="col-sm-3">No. Telepon</dt>
                        <dd class="col-sm-9" id="contact-no_telp"></dd>

                        <hr>

                        <dt class="col-sm-3">Subjek</dt>
                        <dd class="col-sm-9" id="contact-subjek"></dd>

                        <hr>

                        <dt class="col-sm-3">Pesan</dt>
                        <dd class="col-sm-9">
                            <p id="contact-text" style="white-space: pre-wrap;"></p>
                        </dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // DataTable initialization
            $('#table-1').DataTable({
                responsive: true,
                paging: false, // Disable paging because Laravel pagination is used
                info: false,
                searching: false
            });

            // Handle View Modal
            $('.btn-view').on('click', function() {
                const id = $(this).data('id');
                const viewModal = $('#viewModal');

                // AJAX call to get contact details
                $.get(`/admin/contacts/${id}`, function(data) {
                    if (data) {
                        viewModal.find('#contact-name').text(data.name);
                        viewModal.find('#contact-email').text(data.email);
                        viewModal.find('#contact-no_telp').text(data.no_telp || '-');
                        viewModal.find('#contact-subjek').text(data.subjek);
                        viewModal.find('#contact-text').text(data.text);
                    }
                }).fail(function() {
                    alert('Gagal mengambil detail pesan.');
                });
            });

            // SweetAlert for delete confirmation
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                swal({
                    title: 'Apakah Anda yakin?',
                    text: 'Setelah dihapus, Anda tidak akan dapat mengembalikan pesan ini!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
