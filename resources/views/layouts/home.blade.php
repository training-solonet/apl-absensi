<!doctype html>
<html lang="en">
<!-- Mirrored from themesbrand.com/skote-django/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2023 05:06:27 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('skote/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link rel="shortcut icon" href="{{ url('skote/assets/css/bootstrap.min.css') }}">
    <!-- Icons Css -->

    <link rel="shortcut icon" href="{{ url('skote/assets/css/icons.min.css') }}">
    <!-- App Css-->
    <link rel="shortcut icon" href="{{ url('skote/assets/css/app.min.css') }}">
    @yield('css')
</head>

<body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            @include('layouts.partials.header')
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            @include('layouts.partials.sidebar')
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')

            <footer class="footer">
                @include('layouts.partials.footer')
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ url('skote/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('skote/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('skote/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ url('skote/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('skote/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ url('skote/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ url('skote/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ url('skote/assets/js/app.js') }}"></script>

    @yield('js')
</body>


<!-- Mirrored from themesbrand.com/skote-django/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2023 05:07:09 GMT -->

</html>
