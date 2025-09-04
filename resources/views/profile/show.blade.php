<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Profil Saya - KatalogKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Poppins', sans-serif;
            color: #4A5568;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        .profile-container {
            padding-top: 120px;
            padding-bottom: 50px;
        }

        .profile-card {
            background-color: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .07);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .profile-header {
            padding: 2.5rem;
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #478413 0%, #2c5a08 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            color: #fff;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-info h4 {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #2D3748;
        }

        .profile-info p {
            margin-bottom: 0;
            color: #718096;
        }

        .card-content {
            padding: 2.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #4A5568;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(71, 132, 19, 0.2);
            border-color: #478413;
        }

        .btn-success {
            background-color: #478413;
            border-color: #478413;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-success:hover {
            background-color: #2c5a08;
            border-color: #2c5a08;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #2D3748;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            border: none;
            color: #718096;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .table tbody tr {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            border-radius: 8px;
        }

        .table tbody td {
            border: none;
            vertical-align: middle;
            padding: 1.25rem 1rem;
        }

        .table tbody tr td:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .table tbody tr td:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .status-badge {
            border-radius: 9999px;
            padding: 0.3rem 0.8rem;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .status-badge.bg-success {
            background-color: #e6fffa !important;
            color: #38a169;
        }

        .status-badge.bg-warning {
            background-color: #fffaf0 !important;
            color: #dd6b20;
        }

        .btn-action {
            background-color: #edf2f7;
            color: #4a5568;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-action:hover {
            background-color: #e2e8f0;
            color: #2d3748;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                    style="max-height: 40px;">
            </a>
            <div class="d-flex gap-2 auth-buttons">
                @auth
                    <div class="dropdown">
                        <button
                            class="btn btn-link dropdown-toggle text-decoration-none text-dark d-flex align-items-center gap-2"
                            type="button" data-bs-toggle="dropdown">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle"
                                    style="width: 32px; height: 32px;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; background: #478413; color: white; font-size: 1rem;">
                                    {{ substr(Auth::user()->name, 0, 1) }}</div>
                            @endif
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header">{{ Auth::user()->name }}</h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                        class="fas fa-user me-2"></i>Profil Saya</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i
                                            class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="profile-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar">
                                @else
                                    {{ substr($user->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="profile-info">
                                <h4>{{ $user->name }}</h4>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <h5 class="section-title">Edit Informasi Akun</h5>
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h5 class="section-title">Ubah Password</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Isi jika ingin diubah">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-card">
                        <div class="card-content">
                            <h5 class="section-title mb-4">Katalog Saya</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Toko</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($userStores as $store)
                                            <tr>
                                                <td>
                                                    <strong>{{ $store->store_name }}</strong><br>
                                                    <small
                                                        class="text-muted">{{ $store->subdomain }}.{{ config('app.domain') }}</small>
                                                </td>
                                                <td>
                                                    <span
                                                        class="status-badge bg-{{ $store->is_active ? 'success' : 'warning' }}">
                                                        {{ $store->is_active ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="http://{{ $store->subdomain }}.{{ config('app.domain') }}"
                                                        target="_blank" class="btn-action">Kunjungi Toko</a>
                                                </td>
                                                <td class="text-end">
                                                    <a href="http://{{ $store->subdomain }}.{{ config('app.domain') }}/admin"
                                                        target="_blank" class="btn-action">Halaman Admin</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center p-4">Anda belum memiliki
                                                    katalog.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $userStores->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center mt-3">
                <div class="col-lg-12">
                    <div class="profile-card">
                        <div class="card-content">
                            <h5 class="section-title">Riwayat Pembelian</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Template</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($purchases as $purchase)
                                            <tr>
                                                <td><strong>{{ $purchase->transaction_id }}</strong></td>
                                                <td>{{ $purchase->catalogTemplate->name ?? 'N/A' }}</td>
                                                <td>{{ $purchase->created_at->format('d M Y') }}</td>
                                                <td>Rp {{ number_format($purchase->final_amount, 0, ',', '.') }}</td>
                                                <td>
                                                    <span
                                                        class="status-badge bg-{{ $purchase->isPaid() ? 'success' : 'warning' }}">{{ ucfirst($purchase->payment_status) }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('profile.invoice.show', $purchase->transaction_id) }}"
                                                        class="btn-action">Lihat Struk</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center bg-white p-5">Anda belum
                                                    memiliki
                                                    riwayat pembelian.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $purchases->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
