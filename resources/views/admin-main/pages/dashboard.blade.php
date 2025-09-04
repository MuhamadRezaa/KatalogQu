    @extends('admin-main.layouts.app')
    @section('title', 'Dashboard Admin')
    @section('content')
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Selamat Datang, Admin!</h4>
                        <p class="text-muted">Berikut adalah gambaran umum aktivitas platform Anda.</p>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            {{-- Stat Cards --}}
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Pengguna</h6>
                                    <h4 class="mb-0">{{ $totalUsers ?? 'N/A' }}</h4>
                                </div>
                                <i class="fa fa-users fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Toko</h6>
                                    <h4 class="mb-0">{{ $totalStores ?? 'N/A' }}</h4>
                                </div>
                                <i class="fa fa-address-card fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Template Terjual</h6>
                                    <h4 class="mb-0">{{ $templatesSold ?? 'N/A' }}</h4>
                                </div>
                                <i class="fa fa-shopping-basket fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Pendapatan</h6>
                                    <h4 class="mb-0">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h4>
                                </div>
                                <i class="fa fa-usd fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activities & Popular Templates --}}
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pendaftaran Pengguna Terbaru</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Terdaftar Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentUsers as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada pengguna baru baru ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pembuatan Toko Terbaru</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama Toko</th>
                                            <th>Domain</th>
                                            <th>Dibuat Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentStores as $store)
                                            <tr>
                                                <td>{{ $store->store_name }}</td>
                                                <td>
                                                    @if ($store->tenant && $store->tenant->domains->isNotEmpty())
                                                        {{ $store->tenant->domains->first()->domain }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $store->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada toko baru baru ini.</td>
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
    @endsection
