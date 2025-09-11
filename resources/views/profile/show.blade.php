<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/katalogqu_icon.png') }}" type="image/x-icon">
    <title>Profil Saya - KatalogQu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #4A5568;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .05);
        }

        .profile-container {
            padding-top: 100px;
            padding-bottom: 50px;
        }

        .profile-sidebar .card,
        .profile-content .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .05);
            margin-bottom: 1.5rem;
        }

        .profile-avatar-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            margin: -60px auto 1rem;
            border: 4px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, #478413 0%, #2c5a08 100%);
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

        .profile-nav .list-group-item {
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 500;
            color: #4A5568;
            border-left: 3px solid transparent;
            border-radius: 0;
        }

        .profile-nav .list-group-item.active {
            background-color: #e6fffa;
            color: #478413;
            border-left-color: #478413;
            font-weight: 600;
        }

        .profile-nav .list-group-item i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
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
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #2D3748;
        }

        .table>:not(caption)>*>* {
            padding: 1rem;
            vertical-align: middle;
        }
    </style>
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
                                        style="width: 24px; height: 24px; background: #478413; color: white; font-size: 12px; display: none !important;">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 24px; height: 24px; background: #478413; color: white; font-size: 12px;">
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
                <div class="col-md-4 profile-sidebar">
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
                            <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="card profile-nav">
                        <div class="list-group list-group-flush" id="profile-tabs" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                href="#profile" role="tab">
                                <i class="fas fa-user-edit"></i> Edit Profil
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#stores"
                                role="tab">
                                <i class="fas fa-store"></i> Katalog Saya
                            </a>
                            {{-- AWAL PERUBAHAN --}}
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                href="#pending-setups" role="tab">
                                <i class="fas fa-pause-circle"></i> Setup Tertunda
                            </a>
                            {{-- AKHIR PERUBAHAN --}}
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#purchases"
                                role="tab">
                                <i class="fas fa-history"></i> Riwayat Pembelian
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 profile-content">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title">Informasi Akun</h5>
                                    <form method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name"
                                                    name="name" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Alamat Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" value="{{ old('email', $user->email) }}" required>
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
                                        <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="stores" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title mb-4">Katalog Saya</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nama Toko</th>
                                                    <th>Status</th>
                                                    <th class="text-end" style="width: 240px;">Aksi</th>
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
                                                                class="badge rounded-pill text-bg-{{ $store->is_active ? 'success' : 'warning' }} bg-opacity-50 text-{{ $store->is_active ? 'success' : 'warning' }}-emphasis">
                                                                {{ $store->is_active ? 'Aktif' : 'Nonaktif' }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="btn-group">
                                                                <a href="{{ request()->getScheme() }}://{{ $store->subdomain }}.{{ config('app.domain') }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-primary btn-sm">
                                                                    <i class="fas fa-eye me-1"></i> Kunjungi Toko
                                                                </a>
                                                                <a href="{{ route('tenant.admin.dashboard', ['tenant' => $store->tenant_id]) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-primary btn-sm">Kelola
                                                                    Toko
                                                                </a>
                                                            </div>
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

                        {{-- AWAL PERUBAHAN --}}
                        <div class="tab-pane fade" id="pending-setups" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title mb-4">Setup Toko Tertunda</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Template</th>
                                                    <th>Tanggal Pembelian</th>
                                                    <th>Status Setup</th>
                                                    <th class="text-end">Aksi</th>
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
                                                            <span
                                                                class="badge rounded-pill text-bg-info bg-opacity-50 text-info-emphasis">
                                                                {{ str_replace('_', ' ', Str::title($setup->setup_status)) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="{{ route('store.setup.form', ['order_id' => $setup->payment_transaction_id]) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fas fa-arrow-right me-1"></i> Lanjutkan Setup
                                                            </a>
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
                        {{-- AKHIR PERUBAHAN --}}

                        <div class="tab-pane fade" id="purchases" role="tabpanel">
                            <div class="card">
                                <div class="card-body p-4 p-md-5">
                                    <h5 class="section-title">Riwayat Pembelian</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>ID Transaksi</th>
                                                    <th>Template</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($purchases as $purchase)
                                                    <tr>
                                                        <td><strong>#{{ substr($purchase->transaction_id, -6) }}</strong>
                                                        </td>
                                                        <td>{{ $purchase->catalogTemplate->name ?? 'N/A' }}</td>
                                                        <td>Rp
                                                            {{ number_format($purchase->final_amount, 0, ',', '.') }}
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge rounded-pill text-bg-{{ $purchase->isPaid() ? 'success' : 'warning' }} bg-opacity-10 text-{{ $purchase->isPaid() ? 'success' : 'warning' }}-emphasis">{{ ucfirst($purchase->payment_status) }}</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="{{ route('profile.invoice.show', $purchase->transaction_id) }}"
                                                                class="btn btn-light btn-sm">Lihat Struk</a>
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
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $purchases->links('pagination::bootstrap-5') }}
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
            var tabEl = document.querySelector('a[data-bs-toggle="list"][href="' + hash + '"]');
            if (tabEl) {
                var tab = new bootstrap.Tab(tabEl);
                tab.show();
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
            function fixPaginationLinks(tabPaneId, hash) {
                const tabPane = document.getElementById(tabPaneId);
                if (tabPane) {
                    const paginationLinks = tabPane.querySelectorAll('.pagination a');
                    paginationLinks.forEach(function(link) {
                        if (link.href.indexOf('#') === -1) {
                            link.href += hash;
                        }
                    });
                }
            }

            // Apply the fix for both tabs that have pagination
            fixPaginationLinks('stores', '#stores');
            fixPaginationLinks('purchases', '#purchases');
        });
    </script>
</body>

</html>
