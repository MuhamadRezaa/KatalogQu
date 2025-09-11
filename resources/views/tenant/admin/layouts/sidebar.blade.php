<style>
    /* CSS untuk membuat ikon Font Awesome mirip seperti SVG */
    .sidebar-link .menu-icon {
        font-size: 16px;
        /* Mengatur ukuran ikon */
        width: 20px;
        /* Memberi lebar tetap agar semua menu sejajar */
        margin-right: 10px;
        /* Jarak antara ikon dan teks */
        color: rgba(255, 255, 255, 0.8);
        /* Warna dasar ikon (semi-transparan putih) */
        display: inline-block;
        /* Agar width dan text-align berfungsi */
        text-align: center;
        /* Memastikan ikon di tengah area 20px */
        vertical-align: middle;
        /* Posisi vertikal lebih rapi dengan teks */
    }

    /* CSS untuk mengubah warna ikon saat menu aktif */
    .sidebar-link.active .menu-icon,
    .sidebar-link.active span {
        color: #ffffff;
        /* Warna ikon dan teks menjadi putih solid */
    }

    /* CSS untuk toggle icon agar terlihat bagus dan konsisten */
    .sidebar-toggle {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Improve logo wrapper for long store names */
    .logo-wrapper {
        padding: 12px 10px;
        display: flex;
        flex-wrap: wrap;
        position: relative;
    }

    .logo-wrapper a {
        text-decoration: none;
        width: 100%;
    }

    .logo-wrapper .back-btn,
    .logo-wrapper .toggle-sidebar {
        position: absolute;
        top: 12px;
        right: 10px;
    }

    .store-logo-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 100%;
        padding-right: 15px;
        position: relative;
    }

    .store-name {
        display: block;
        width: calc(100% - 60px);
        /* Account for logo width + margin */
        line-height: 1.2;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        max-width: 100%;
        font-size: 14px;
        margin-top: 5px;
    }
</style>

<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="{{ route('tenant.admin.dashboard', ['tenant' => $userStore->tenant_id]) }}" class="store-logo-container">
            <div class="d-flex align-items-center">
                @if (isset($userStore) && $userStore->store_logo)
                    <img src="{{ asset('storage/' . $userStore->store_logo) }}"
                        alt="{{ $userStore->store_name ?? 'Store Logo' }}" class="rounded-circle" width="50"
                        height="50" onerror="this.src='{{ asset('assets/images/no-image-icon.png') }}'">
                @else
                    <img src="{{ asset('assets/images/no-image-icon.png') }}" alt="Default Store Logo"
                        class="rounded-circle" width="50" height="50">
                @endif
            </div>
            @if (isset($userStore) && $userStore->store_name)
                <span class="store-name ms-2 text-white fw-bold">{{ $userStore->store_name }}</span>
            @endif
        </a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar">
            <i class="fa fa-th-large status_toggle middle sidebar-toggle"></i>
        </div>
    </div>

    <div class="logo-icon-wrapper">
        <i class="fa fa-th-large status_toggle middle sidebar-toggle"></i>
    </div>

    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i class="fa fa-arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">

                <li class="back-btn">
                    <div class="mobile-back text-end">
                        <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                </li>

                <li class="pin-title sidebar-main-title">
                    <div>
                        <h6>Pinned</h6>
                    </div>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="lan-1">General</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('tenant.admin.dashboard', ['tenant' => $userStore->tenant_id]) }}">
                        <i class="fa fa-home menu-icon" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="lan-8">MENU</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('tenant.admin.categories.index', ['tenant' => $userStore->tenant_id]) }}">
                        <i class="fa fa-th menu-icon" aria-hidden="true"></i>
                        <span>Kategori Produk</span>
                    </a>
                </li>

                @if (in_array('subkategoriproduk', $menus))
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('tenant.admin.sub-categories.index', ['tenant' => $userStore->tenant_id]) }}">
                            <i class="fa fa-th menu-icon" aria-hidden="true"></i>
                            <span>Sub Kategori Produk</span>
                        </a>
                    </li>
                @endif

                @if (in_array('brandproduk', $menus))
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('tenant.admin.brands.index', ['tenant' => $userStore->tenant_id]) }}">
                            <i class="fa fa-th menu-icon" aria-hidden="true"></i>
                            <span>Brand Produk</span>
                        </a>
                    </li>
                @endif

                @if (in_array('unitproduk', $menus))
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('tenant.admin.product-units.index', ['tenant' => $userStore->tenant_id]) }}">
                            <i class="fa fa-th menu-icon" aria-hidden="true"></i>
                            <span>Unit Produk</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('tenant.admin.products.index', ['tenant' => $userStore->tenant_id]) }}">
                        <i class="fa fa-tags menu-icon" aria-hidden="true"></i>
                        <span>Produk</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('tenant.admin.price-ranges.index', ['tenant' => $userStore->tenant_id]) }}">
                        <i class="fa fa-money menu-icon" aria-hidden="true"></i>
                        <span>Rentang Harga</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('tenant.admin.store-heroes.index', ['tenant' => $userStore->tenant_id]) }}">
                        <i class="fa fa-image menu-icon" aria-hidden="true"></i>
                        <span>Banner Toko</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav"
                        href="{{ route('tenant.admin.settings', ['tenant' => $userStore->tenant_id]) }}">
                        <i class="fa fa-sliders menu-icon" aria-hidden="true"></i>
                        <span>Pengaturan Toko</span>
                    </a>
                </li>

                {{-- <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title" href="#">
                        <i class="fa fa-sliders menu-icon" aria-hidden="true"></i>
                        <span class="lan-6">Settings</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('tenant.admin.settings') }}">Store Settings</a></li>
                        <li><a href="#">Profile Settings</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i class="fa fa-arrow-right"></i></div>
    </nav>
</div>
