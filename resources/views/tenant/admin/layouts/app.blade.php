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
        <meta name="api-token" content="{{ auth()->user()->createToken('dashboard')->plainTextToken }}">
    @endauth
    <link rel="icon" href="{{ asset('storage/' . ($userStore->store_logo ?? 'favicon.png')) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/' . ($userStore->store_logo ?? 'favicon.png')) }}"
        type="image/x-icon">
    <title>{{ $userStore->store_name ?? 'Store' }} - Admin Panel</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/font-awesome.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/echart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/date-picker.css') }}">
    <!-- Plugins css Ends-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/datatables.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/riho-asset/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/riho-asset/css/responsive.css') }}">
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader4"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('tenant.admin.layouts.header')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('tenant.admin.layouts.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h4>@yield('title')</h4>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('tenant.admin.dashboard') }}">
                                            <svg class="stroke-icon">
                                                <use
                                                    href="{{ asset('assets/riho-asset/svg/icon-sprite.svg#stroke-home') }}">
                                                </use>
                                            </svg></a></li>
                                    <!-- <li class="breadcrumb-item">Dashboard</li> -->
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('tenant.admin.layouts.footer')
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/riho-asset/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/riho-asset/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/riho-asset/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/riho-asset/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/riho-asset/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/riho-asset/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/header-slick.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/esl.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/config.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/pie-chart/facePrint.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/pie-chart/testHelper.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/pie-chart/custom-transition-texture.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/chart/echart/data/symbols.js') }}"></script>
    <!-- calendar js-->
    <script src="{{ asset('assets/riho-asset/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/riho-asset/js/dashboard/dashboard_3.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/riho-asset/js/script.js') }}"></script>
    <!-- <script src="{{ asset('assets/riho-asset/js/theme-customizer/customizer.js') }}"></script> -->

    <!-- Page specific scripts -->
    @stack('scripts')
</body>

</html>
