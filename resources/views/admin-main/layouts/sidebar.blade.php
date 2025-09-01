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
</style>

<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="index.html">
            <img class="img-fluid" src="{{ asset('assets/images/katalogqu_logo.png') }}" alt="KatalogQu" width="150px">
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
                    <a class="sidebar-link sidebar-title link-nav" href="#">
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
                    <a class="sidebar-link sidebar-title link-nav" href="/admin/kategori-toko">
                        <i class="fa fa-tags menu-icon" aria-hidden="true"></i>
                        <span>Kategori Toko</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav" href="/admin/template-katalog">
                        <i class="fa fa-th menu-icon" aria-hidden="true"></i>
                        <span>Template Katalog</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav" href="/admin/users">
                        <i class="fa fa-users menu-icon" aria-hidden="true"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav" href="/admin/stores">
                        <i class="fa fa-building menu-icon" aria-hidden="true"></i>
                        <span>Manajemen Toko</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav" href="/admin/payments">
                        <i class="fa fa-credit-card menu-icon" aria-hidden="true"></i>
                        <span>Manajemen Pembayaran</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title link-nav" href="/admin/settings">
                        <i class="fa fa-cogs menu-icon" aria-hidden="true"></i>
                        <span>Pengaturan Sistem</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i>
                    <a class="sidebar-link sidebar-title" href="#">
                        <i class="fa fa-sliders menu-icon" aria-hidden="true"></i>
                        <span class="lan-6">Widgets</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="general-widget.html">General</a></li>
                        <li><a href="chart-widget.html">Chart</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i class="fa fa-arrow-right"></i></div>
    </nav>
</div>
