@extends('admin-main.layouts.app')

@section('title', 'Manajemen Banner Utama')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Daftar Banner Utama</h4>
                                @if (count($mainHeroes) < 3)
                                    <a href="{{ route('main-heroes.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Banner Baru
                                    </a>
                                @else
                                    <span class="badge bg-primary">Sudah Mencapai Maksimal 3 Banner Utama</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="table-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Subjudul</th>
                                            <th scope="col">Aktif</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mainHeroes as $hero)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($hero->image_url)
                                                        <img src="{{ asset('storage/' . $hero->image_url) }}"
                                                            alt="{{ $hero->title }}" class="img-fluid rounded"
                                                            style="max-width: 100px;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                            style="width: 100px; height: 60px;">
                                                            <i class="fa fa-picture-o fa-2x text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="user-info">
                                                        <h6>{!! $hero->title ?? '-' !!}</h6>
                                                    </div>
                                                </td>
                                                <td>{!! \Illuminate\Support\Str::words(strip_tags($hero->subtitle ?? '-'), 50, '...') !!}</td>
                                                <td>
                                                    @if ($hero->is_active)
                                                        <span class="badge badge-light-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-light-secondary">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('main-heroes.edit', $hero->id) }}"
                                                            class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteHero({{ $hero->id }})" title="Hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    <h5 class="f-light">Belum ada banner utama.</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
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
            // Initialize DataTables
            $('#table-1').DataTable({
                responsive: true,
                paging: false,
                info: true,
                searching: false
            });
        });

        const destroyUrlTemplate = '{{ route('main-heroes.destroy', ':id') }}';

        function deleteHero(heroId) {
            swal({
                title: 'Apakah Anda yakin?',
                text: 'Setelah dihapus, Anda tidak akan dapat mengembalikan banner ini!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    const form = document.getElementById('deleteForm');
                    form.action = destroyUrlTemplate.replace(':id', heroId);
                    form.submit();
                }
            });
        }
    </script>
@endpush
