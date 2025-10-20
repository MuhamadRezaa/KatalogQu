<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Profil Saya - KatalogQu</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* === AWAL PERUBAHAN UI === */

        :root {
            --primary-color: #10b981;
            /* Warna hijau baru yang lebih segar */
            --primary-color-dark: #0f9a6d;
            --primary-color-light: #f0fdf4;
            --text-color-dark: #1f2937;
            --text-color-light: #6b7280;
            --border-color: #e5e7eb;
            --background-color: #f9fafb;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color-light);
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: none;
            border-bottom: 1px solid var(--border-color);
        }

        /* Layout Utama */
        .profile-container {
            padding-top: 100px;
            padding-bottom: 50px;
        }

        /* Kartu (Card) */
        .profile-sidebar .card,
        .profile-content .card {
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            /* Sudut lebih tumpul */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        /* Avatar Profil */
        .profile-avatar-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            margin: -40px auto 1rem;
            /* Ditarik sedikit ke atas */
            border: 6px solid #fff;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-color-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 600;
            color: #fff;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Navigasi Samping */
        .profile-nav .list-group-item {
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: var(--text-color-light);
            margin-bottom: 0.5rem;
            border-radius: 0.75rem;
            /* Style seperti pil */
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .profile-nav .list-group-item:hover {
            background-color: var(--primary-color-light);
            color: var(--primary-color-dark);
        }

        .profile-nav .list-group-item.active {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.3);
        }

        .profile-nav .list-group-item i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        /* Form Input */
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            border-color: var(--primary-color);
        }

        /* Tombol (Button) */
        .btn {
            border-radius: 0.5rem;
            padding: 0.65rem 1.25rem;
            font-weight: 500;
        }

        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .btn-success:hover {
            background-color: var(--primary-color-dark);
            border-color: var(--primary-color-dark);
        }

        /* Judul Section */
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-color-dark);
        }

        /* Tabel */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            font-weight: 600;
            color: var(--text-color-dark);
            background-color: var(--background-color);
            border-bottom: 2px solid var(--border-color);
            border-top: 1px solid var(--border-color);
            padding: 1rem;
        }

        .table thead th:first-child {
            border-top-left-radius: 0.75rem;
        }

        .table thead th:last-child {
            border-top-right-radius: 0.75rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: var(--text-color-light);
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table strong {
            color: var(--text-color-dark);
            font-weight: 500;
        }

        /* Badge Status */
        .badge {
            padding: 0.4em 0.8em;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Custom Badge Colors */
        .badge-status-success {
            color: #059669;
            background-color: #d1fae5;
        }

        .badge-status-warning {
            color: #d97706;
            background-color: #fef3c7;
        }

        .badge-status-info {
            color: #0ea5e9;
            background-color: #e0f2fe;
        }

        .badge-status-paid {
            color: #166534;
            background-color: #dcfce7;
        }

        .badge-status-danger {
            color: #be123c;
            background-color: #fee2e2;
        }

        /* Pagination */
        .pagination .page-link {
            color: var(--primary-color);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff !important;
            /* Ensure text is white */
        }

        /* === AKHIR PERUBAHAN UI === */
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogKu Logo"
                    style="max-height: 50px; width: auto; object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="d-flex gap-2 auth-buttons">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle d-flex align-items-center gap-2"
                                type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->avatar && !empty(Auth::user()->avatar))
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded-circle"
                                        style="width: 24px; height: 24px;"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="rounded-circle d-none align-items-center justify-content-center"
                                        style="width: 24px; height: 24px; background: var(--primary-color); color: white; font-size: 12px; display: none !important;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px; background: var(--primary-color); color: white; font-size: 12px;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
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
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="/login" class="btn btn-outline-success">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="profile-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 profile-sidebar">
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <div class="profile-avatar-wrapper">
                                <div class="profile-avatar">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="Avatar">
                                    @else
                                        {{ substr($user->name, 0, 1) }}
                                    @endif
                                </div>
                            </div>
                            <h5 class="fw-bold mb-1 mt-3" style="color: var(--text-color-dark);">{{ $user->name }}
                            </h5>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="card profile-nav">
                        <div class="card-body">
                            <div class="list-group list-group-flush" id="profile-tabs" role="tablist">
                                <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                    href="#profile" role="tab">
                                    <i class="fas fa-user-edit"></i> Edit Profil
                                </a>
                                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#stores"
                                    role="tab">
                                    <i class="fas fa-store"></i> Katalog Saya
                                </a>
                                <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                    href="#pending-setups" role="tab">
                                    <i class="fas fa-pause-circle"></i> Setup Tertunda
                                </a>
                                <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                    href="#purchases" role="tab">
                                    <i class="fas fa-history"></i> Riwayat Pembelian
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 profile-content">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-4">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success mb-4">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <h5 class="section-title">Informasi Akun</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name"
                                                    name="name" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" value="{{ old('email', $user->email) }}" disabled>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" value="{{ old('email', $user->email) }}" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone_number" class="form-label">Nomor Telepon
                                                    (WhatsApp)</label>
                                                <input type="text" class="form-control" id="phone_number"
                                                    name="phone_number"
                                                    value="{{ old('phone_number', $user->phone_number) }}"
                                                    placeholder="Gunakan format 628...">
                                                <div class="form-text">Gunakan format 628XXX...</div>
                                            </div>
                                        </div>
                                        <hr class="my-4">
                                        <h5 class="section-title">Ubah Password</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="password" class="form-label">Password Baru</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Isi jika ingin diubah">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="password_confirmation" class="form-label">Konfirmasi
                                                    Password</label>
                                                <input type="password" class="form-control"
                                                    id="password_confirmation" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success mt-3">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="stores" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title mb-4">Katalog Saya</h5>
                                    <div class="table-responsive">
                                        <table class="table" id="stores-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Nama Toko</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Masa Aktif</th>
                                                    <th class="text-center">Aksi</th>
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
                                                        <td class="text-center">
                                                            <span
                                                                class="badge rounded-pill {{ $store->is_active ? 'badge-status-success' : 'badge-status-warning' }}">
                                                                {{ $store->is_active ? 'Aktif' : 'Nonaktif' }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            @php
                                                                $durationText = '-';
                                                                if ($store->expires_at) {
                                                                    $expires = \Carbon\Carbon::parse(
                                                                        $store->expires_at,
                                                                    );

                                                                    if ($expires->isPast()) {
                                                                        $durationText = 'Telah Berakhir';
                                                                    } else {
                                                                        $diff = now()->diff($expires);

                                                                        $parts = [];
                                                                        if ($diff->y > 0) {
                                                                            $parts[] = $diff->y . ' tahun';
                                                                        }
                                                                        if ($diff->m > 0) {
                                                                            $parts[] = $diff->m . ' bulan';
                                                                        }
                                                                        if ($diff->d > 0) {
                                                                            $parts[] = $diff->d . ' hari';
                                                                        }

                                                                        if (empty($parts)) {
                                                                            $durationText = 'Kurang dari sehari';
                                                                        } else {
                                                                            $durationText = implode(' ', $parts);
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <small class="text-muted mb-3">
                                                                Berakhir pada:
                                                                {{ $store->expires_at ? \Carbon\Carbon::parse($store->expires_at)->format('d M Y') : 'N/A' }}
                                                            </small>
                                                            {{-- <br>
                                                            <small class="text-muted">
                                                                (Durasi :{{ $durationText }})
                                                            </small> --}}
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="btn-group btn-group-sm" role="group">
                                                                <a href="{{ request()->getScheme() }}://{{ $store->subdomain }}.{{ config('app.domain') }}"
                                                                    target="_blank" class="btn btn-outline-secondary"
                                                                    title="Lihat Toko">
                                                                    <i class="fas fa-eye"></i> Lihat
                                                                </a>
                                                                <a href="{{ route('tenant.admin.dashboard', ['tenant' => $store->tenant_id]) }}"
                                                                    target="_blank" class="btn btn-outline-primary"
                                                                    title="Kelola Toko">
                                                                    <i class="fas fa-cogs"></i> Kelola
                                                                </a>
                                                                <a href="{{ route('checkout.show-renewal', ['tenant' => $store->tenant_id]) }}"
                                                                    class="btn btn-outline-success"
                                                                    title="Perpanjang Toko">
                                                                    <i class="fas fa-sync-alt"></i> Perpanjang
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center p-4">Anda belum memiliki
                                                            katalog.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pending-setups" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title mb-4">Setup Toko Tertunda</h5>
                                    <div class="table-responsive">
                                        <table class="table" id="pending-setups-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Template</th>
                                                    <th class="text-center">Tanggal Pembelian</th>
                                                    <th class="text-center">Status Setup</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pendingSetups as $setup)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $setup->catalogTemplate->name ?? 'Template Tidak Ditemukan' }}</strong><br>
                                                            <small class="text-muted">ID Transaksi:
                                                                {{ $setup->payment_transaction_id }}</small>
                                                        </td>
                                                        <td>{{ $setup->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <span class="badge rounded-pill badge-status-info">
                                                                {{ str_replace('_', ' ', Str::title($setup->setup_status)) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            @if (optional($setup->templatePurchase)->payment_status === 'paid' &&
                                                                    optional($setup->templatePurchase->payment)->status === 'paid')
                                                                <a href="{{ route('store.setup.form', ['order_id' => $setup->payment_transaction_id]) }}"
                                                                    class="btn btn-primary btn-sm">
                                                                    Lanjutkan Setup
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center p-4">Tidak ada proses
                                                            setup toko yang tertunda.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="purchases" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title">Riwayat Pembelian</h5>
                                    <div class="table-responsive">
                                        <table class="table" id="purchases-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID Transaksi</th>
                                                    <th class="text-center">Nama Template</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($purchases as $purchase)
                                                    <tr id="purchase-row-{{ $purchase->transaction_id }}">
                                                        <td><strong>#{{ substr($purchase->transaction_id, -6) }}</strong>
                                                        </td>
                                                        <td>{{ $purchase->catalogTemplate->name ?? 'N/A' }}</td>
                                                        <td>Rp
                                                            {{ number_format($purchase->final_amount, 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span id="status-badge-{{ $purchase->transaction_id }}"
                                                                class="badge rounded-pill {{ $purchase->payment_status === 'paid'
                                                                    ? 'badge-status-paid'
                                                                    : ($purchase->payment_status === 'cancelled'
                                                                        ? 'badge-status-danger'
                                                                        : 'badge-status-warning') }}">
                                                                {{ ucfirst($purchase->payment_status) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            @if ($purchase->payment_status === 'pending' && optional($purchase->payment)->status !== 'paid')
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm cancel-btn"
                                                                    data-order-id="{{ $purchase->transaction_id }}"
                                                                    onclick="cancelOrder(this)">
                                                                    Batalkan
                                                                </button>
                                                            @else
                                                                @if ($purchase->payment_status !== 'cancelled')
                                                                    <a href="{{ route('profile.invoice.show', $purchase->transaction_id) }}"
                                                                        class="btn btn-light btn-sm">Lihat Struk</a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center p-5">Anda belum memiliki
                                                            riwayat pembelian.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle tab persistence on page reload
            var hash = window.location.hash;
            if (hash) {
                var tabEl = document.querySelector('a[data-bs-toggle="list"][href="' + hash + '"]');
                if (tabEl) {
                    var tab = new bootstrap.Tab(tabEl);
                    tab.show();
                }
            }


            // Update URL hash when a new tab is shown
            var tabTriggerList = [].slice.call(document.querySelectorAll('#profile-tabs a'));
            tabTriggerList.forEach(function(tabTriggerEl) {
                tabTriggerEl.addEventListener('shown.bs.tab', function(event) {
                    var newHash = event.target.getAttribute('href');
                    // Use history.pushState to change hash without jumping
                    if (history.pushState) {
                        history.pushState(null, null, newHash);
                    } else {
                        window.location.hash = newHash;
                    }
                });
            });

            // --- FIX FOR PAGINATION ---
            // This function ensures that when you click a pagination link,
            // the page reloads on the correct tab.
            function fixPaginationLinks() {
                const activeTabPane = document.querySelector('.tab-pane.active');
                if (!activeTabPane) return;

                const currentHash = '#' + activeTabPane.id;
                const paginationLinks = document.querySelectorAll('.pagination a');

                paginationLinks.forEach(function(link) {
                    // Avoid adding hash multiple times
                    if (link.href.indexOf('#') === -1) {
                        link.href += currentHash;
                    }
                });
            }

            // Initial fix on page load
            fixPaginationLinks();

            // Re-apply the fix whenever a tab is shown
            tabTriggerList.forEach(function(tabTriggerEl) {
                tabTriggerEl.addEventListener('shown.bs.tab', fixPaginationLinks);
            });
            // New function for canceling orders
            window.cancelOrder = function(buttonElement) {
                const orderId = buttonElement.dataset.orderId;
                if (!confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                    return;
                }

                buttonElement.disabled = true;
                buttonElement.textContent = 'Membatalkan...';

                fetch('{{ route('checkout.cancel') }}', { // Use named route for consistency
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            order_id: orderId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Pesanan berhasil dibatalkan!');
                            // Update UI: change status badge and remove/disable button
                            const statusBadge = document.getElementById(`status-badge-${orderId}`);
                            if (statusBadge) {
                                statusBadge.textContent = 'Dibatalkan';
                                statusBadge.classList.remove('badge-status-warning');
                                statusBadge.classList.add(
                                    'badge-status-danger'); // Assuming you have a danger style
                            }
                            buttonElement.remove(); // Remove the button after successful cancellation
                        } else {
                            alert('Gagal membatalkan pesanan: ' + (data.message || 'Terjadi kesalahan.'));
                            buttonElement.disabled = false;
                            buttonElement.textContent = 'Batalkan';
                        }
                    })
                    .catch(error => {
                        console.error('Error canceling order:', error);
                        alert('Terjadi kesalahan saat membatalkan pesanan. Silakan coba lagi.');
                        buttonElement.disabled = false;
                        buttonElement.textContent = 'Batalkan';
                    });
            };
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#stores-table').DataTable({
                responsive: true,
                paging: true,
                info: true,
                searching: true
            });
            $('#pending-setups-table').DataTable({
                responsive: true,
                paging: true,
                info: true,
                searching: true
            });
            $('#purchases-table').DataTable({
                responsive: true,
                paging: true,
                info: true,
                searching: true
            });
        });
    </script>
</body>

</html>
