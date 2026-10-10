<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop </title>

    <!-- SEO Optimization -->
    <meta name="description" content="Spark Admin - Premium Bootstrap 5 Admin Dashboard Template">
    <meta name="author" content="Spark Admin Team">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('adminFiles/assets/css/main.css')}}">

    <!-- Local Third-Party Libraries (100% Offline Compatible) -->
    <link rel="stylesheet" href="{{asset('adminFiles/assets/libs/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminFiles/assets/libs/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('adminFiles/assets/libs/apexcharts/apexcharts.css')}}">
    <link rel="stylesheet" href="{{asset('adminFiles/assets/libs/flatpickr/flatpickr.min.css')}}">

    <!-- Main Design System & Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('adminFiles/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('adminFiles/assets/css/custom.css')}}">
</head>

<body>

    <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green sticky navigation
         ========================================== -->
    @include('admin.includes.sidebar')
    <!-- ==========================================
         END: Sidebar Component
         ========================================== -->


    <!-- ==========================================
         START: Main Content Area
         ========================================== -->
    <div class="main-wrapper">

        <!-- START: Top Navbar Component -->
        @include('admin.includes.header')
        <!-- END: Top Navbar Component -->


        @yield('mainPart')

        <!-- START: Footer Component -->
        @include('admin.includes.footer')
        <!-- END: Footer Component -->

    </div>
    <!-- ==========================================
         END: Main Content Area
         ========================================== -->

    <!-- Local Third-Party Libraries Script dependencies -->
    <script src="{{asset('adminFiles/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('adminFiles/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('adminFiles/assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    <!-- Local dashboard interactions controller -->
    <script src="{{asset('adminFiles/assets/js/dashboard.js')}}"></script>
</body>

</html>