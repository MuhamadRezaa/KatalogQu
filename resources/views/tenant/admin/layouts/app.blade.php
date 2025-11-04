<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $userStore->store_description ?? 'Admin panel for ' . ($userStore->store_name ?? 'store') }}">
    <meta name="keywords" content="admin template, store admin, {{ $userStore->store_name ?? 'store' }}, dashboard">
    <meta name="author" content="{{ $userStore->user->name ?? 'Store Owner' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        @if (auth()->user())
            {{-- Tambahan keamanan jika auth user null --}}
            <meta name="api-token" content="{{ auth()->user()->createToken('dashboard')->plainTextToken }}">
        @endif
    @endauth

    {{-- PERBAIKAN: Cek jika logo toko ada sebelum membuat URL favicon --}}
    @if (isset($userStore) && $userStore->store_logo)
        <link rel="icon"
            href="{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
            type="image/x-icon">
        <link rel="shortcut icon"
            href="{{ route('tenant.asset.path', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) }}"
            type="image/x-icon">
    @else
        {{-- Fallback jika logo tidak ada (Anda bisa ganti path default favicon jika punya) --}}
        {{-- <link rel="icon" href="{{ asset('assets/images/default-favicon.ico') }}" type="image/x-icon"> --}}
        {{-- <link rel="shortcut icon" href="{{ asset('assets/images/default-favicon.ico') }}" type="image/x-icon"> --}}
    @endif
    {{-- AKHIR PERBAIKAN --}}

    <title>{{ $userStore->store_name ?? 'Store' }} - Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/echart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/riho-asset/css/color-1.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/responsive.css') }}">
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader4"></div>
        </div>
    </div>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('tenant.admin.layouts.header')
        <div class="page-body-wrapper">
            @include('tenant.admin.layouts.sidebar')
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h4>@yield('title')</h4>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('tenant.admin.dashboard', ['tenant' => $userStore->tenant_id]) }}">
                                            <svg class="stroke-icon">
                                                <use
                                                    href="{{ asset('assets/riho-asset/svg/icon-sprite.svg#stroke-home') }}">
                                                </use>
                                            </svg></a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('tenant.admin.layouts.footer')
        </div>
    </div>
    <script src="{{ asset('assets/riho-asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/config.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/header-slick.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    {{-- PERBAIKAN: Pastikan path ini benar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/esl.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/config.js') }}"></script>
    {{-- PERBAIKAN: Path typo 'assetsM' diubah menjadi 'assets' --}}
    <script src="{{ asset('assets/riho-asset/js/chart/echart/pie-chart/facePrint.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/pie-chart/testHelper.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/pie-chart/custom-transition-texture.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/data/symbols.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/datepicker/date-picker/datepicker.js') }}"></script>
    {{-- PERBAIKAN: Path typo 'assetsStorage' diubah menjadi 'assets' --}}
    <script src="{{ asset('assets/riho-asset/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/dashboard/dashboard_3.js') }}"></script>
    <!-- Sweet Alert 2 js-->
    <script src="{{ asset('assets/riho-asset/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/sweet-alert/app.js') }}"></script>

    <script src="{{ asset('assets/riho-asset/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
