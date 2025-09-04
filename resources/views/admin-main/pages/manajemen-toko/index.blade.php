@extends('admin-main.layouts.app')
@section('title', 'Manajemen Toko')

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
                            <th>Domain</th>
                            <th>Nama Toko</th>
                            <th>Pemilik</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stores as $item)
                            <tr>
                                <td>{{ $loop->iteration + $stores->firstItem() - 1 }}</td>
                                <td>
                                    <a href="http://{{ $item->subdomain }}.{{ $centralDomain }}" target="_blank">
                                        {{ $item->subdomain }}.{{ $centralDomain }}
                                    </a>
                                </td>
                                <td>{{ $item->store_name }}</td>
                                <td>{{ $item->user->name ?? 'N/A' }}</td>
                                <td>
                                    @if ($item->is_active)
                                        <span class="badge badge-light-success">Aktif</span>
                                    @else
                                        <span class="badge badge-light-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('toko.toggle-status', $item->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        @if ($item->is_active)
                                            <button type="submit" class="btn btn-sm btn-danger">Nonaktifkan</button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success">Aktifkan</button>
                                        @endif
                                    </form>
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
            <div class="d-flex justify-content-end mt-4">
                {{ $stores->links() }}
            </div>
        </div>
    </div>
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
    </script>
@endpush
