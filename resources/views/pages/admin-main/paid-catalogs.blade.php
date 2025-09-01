@extends('layouts.admin-main.app')
@section('content')
<div class="row size-column">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Katalog yang Sudah Dibayar</h4>
                <div class="card-header-right">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="filterStatus('all')">Semua</button>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="filterStatus('paid')">Lunas</button>
                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="filterStatus('pending')">Pending</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="paidCatalogsTable">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Nama Customer</th>
                                <th>Email</th>
                                <th>Template</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paidCatalogs as $catalog)
                            <tr class="catalog-row" data-status="paid">
                                <td>#{{ $catalog->order_id }}</td>
                                <td>{{ $catalog->user->name }}</td>
                                <td>{{ $catalog->user->email }}</td>
                                <td>{{ $catalog->catalogTemplate->name }}</td>
                                <td>{{ $catalog->catalogTemplate->category }}</td>
                                <td>Rp {{ number_format($catalog->total_amount, 0, ',', '.') }}</td>
                                <td>{{ $catalog->payment ? $catalog->payment->payment_method : '-' }}</td>
                                <td><span class="badge bg-success">Lunas</span></td>
                                <td>{{ $catalog->payment && $catalog->payment->paid_at ? $catalog->payment->paid_at->format('d/m/Y H:i') : '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewDetails('{{ $catalog->order_id }}')" title="Lihat Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success" onclick="downloadTemplate('{{ $catalog->order_id }}')" title="Download Template">
                                            <i class="fa fa-download"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-info" onclick="sendTemplate('{{ $catalog->order_id }}')" title="Kirim ke Email">
                                            <i class="fa fa-envelope"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                            @foreach($pendingPayments as $payment)
                            <tr class="catalog-row" data-status="pending">
                                <td>#{{ $payment->templatePurchase->order_id }}</td>
                                <td>{{ $payment->templatePurchase->user->name }}</td>
                                <td>{{ $payment->templatePurchase->user->email }}</td>
                                <td>{{ $payment->templatePurchase->catalogTemplate->name }}</td>
                                <td>{{ $payment->templatePurchase->catalogTemplate->category }}</td>
                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewDetails('{{ $payment->templatePurchase->order_id }}')" title="Lihat Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-warning" onclick="confirmPayment('{{ $payment->templatePurchase->order_id }}')" title="Konfirmasi Pembayaran">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="cancelOrder('{{ $payment->templatePurchase->order_id }}')" title="Batalkan Pesanan">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pesanan -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailModalLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetailContent">
                <!-- Content akan dimuat via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
// Filter berdasarkan status
function filterStatus(status) {
    const rows = document.querySelectorAll('.catalog-row');
    const buttons = document.querySelectorAll('.btn-group button');
    
    // Reset button states
    buttons.forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline-primary');
    });
    
    // Set active button
    event.target.classList.remove('btn-outline-primary');
    event.target.classList.add('btn-primary');
    
    rows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Lihat detail pesanan
function viewDetails(orderId) {
    fetch(`{{ url('/admin/api/order-details') }}/${orderId}`)
        .then(response => response.json())
        .then(order => {
            const content = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Customer</h6>
                        <table class="table table-borderless">
                            <tr><td><strong>Nama:</strong></td><td>${order.customer}</td></tr>
                            <tr><td><strong>Email:</strong></td><td>${order.email}</td></tr>
                            <tr><td><strong>Telepon:</strong></td><td>${order.phone}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Pesanan</h6>
                        <table class="table table-borderless">
                            <tr><td><strong>ID Pesanan:</strong></td><td>${order.id}</td></tr>
                            <tr><td><strong>Template:</strong></td><td>${order.template}</td></tr>
                            <tr><td><strong>Kategori:</strong></td><td>${order.category}</td></tr>
                            <tr><td><strong>Harga:</strong></td><td>${order.price}</td></tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Informasi Pembayaran</h6>
                        <table class="table table-borderless">
                            <tr><td><strong>Metode Pembayaran:</strong></td><td>${order.paymentMethod}</td></tr>
                            <tr><td><strong>Status:</strong></td><td><span class="badge ${order.status === 'Lunas' ? 'bg-success' : 'bg-warning'}">${order.status}</span></td></tr>
                            <tr><td><strong>Tanggal Pembayaran:</strong></td><td>${order.paymentDate}</td></tr>
                            <tr><td><strong>Catatan:</strong></td><td>${order.notes}</td></tr>
                        </table>
                    </div>
                </div>
            `;
            
            document.getElementById('orderDetailContent').innerHTML = content;
            new bootstrap.Modal(document.getElementById('orderDetailModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memuat detail pesanan');
        });
}

// Download template
function downloadTemplate(orderId) {
    fetch(`{{ url('/admin/api/download-template') }}/${orderId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // In real implementation, trigger actual download
                // window.open(data.download_url, '_blank');
            } else {
                alert('Gagal download template');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal download template');
        });
}

// Kirim template ke email
function sendTemplate(orderId) {
    if (confirm(`Kirim template ke email customer untuk pesanan ${orderId}?`)) {
        fetch(`{{ url('/admin/api/send-template') }}/${orderId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
            } else {
                alert('Gagal mengirim template');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengirim template');
        });
    }
}

// Konfirmasi pembayaran
function confirmPayment(orderId) {
    if (confirm(`Konfirmasi pembayaran untuk pesanan ${orderId}?`)) {
        fetch(`{{ url('/admin/api/confirm-payment') }}/${orderId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Reload page to update table
                location.reload();
            } else {
                alert('Gagal konfirmasi pembayaran');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal konfirmasi pembayaran');
        });
    }
}

// Batalkan pesanan
function cancelOrder(orderId) {
    if (confirm(`Batalkan pesanan ${orderId}? Tindakan ini tidak dapat dibatalkan.`)) {
        fetch(`{{ url('/admin/api/cancel-order') }}/${orderId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Reload page to update table
                location.reload();
            } else {
                alert('Gagal membatalkan pesanan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal membatalkan pesanan');
        });
    }
}
</script>
@endsection