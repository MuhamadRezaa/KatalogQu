@extends('admin-main.layouts.app')
@section('title', 'Riwayat Pembayaran')

@section('content')
    <div class="card">
        <div class="card-header p-4">
            <h4 class="card-title mb-0">Data @yield('title')</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive custom-scrollbar">
                <table class="display" id="table-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Nama Pengguna</th>
                            <th>Nama Toko</th>
                            <th>Kategori Toko</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration + $payments->firstItem() - 1 }}</td>
                                <td>{{ $item->transaction_id }}</td>
                                <td>{{ $item->user->name ?? 'Pengguna Dihapus' }}</td>
                                <td>{{ $item->user->ownedStore->store_name ?? 'N/A' }}</td>
                                <td>{{ $item->catalogTemplate->category->name ?? 'N/A' }}</td>
                                <td>Rp {{ number_format($item->final_amount, 0, ',', '.') }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $item->payment_method)) }}</td>
                                <td>
                                    @php
                                        $badgeClass = 'badge-light-primary';
                                        if ($item->status == 'paid') {
                                            $badgeClass = 'badge-light-success';
                                        } elseif (in_array($item->status, ['failed', 'expired', 'cancelled'])) {
                                            $badgeClass = 'badge-light-danger';
                                        } elseif ($item->status == 'pending') {
                                            $badgeClass = 'badge-light-warning';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                {{ $payments->links() }}
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
                paging: true,
                info: true,
                searching: true
            });
        });
    </script>
@endpush
