<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- @if(env('IS_DEMO'))  --}}
        {{-- <link rel="canonical" href="https://themesberg.com/product/laravel/volt-admin-dashboard-template">
        <meta  name="keywords" content="themesberg, updivision, html dashboard, laravel, livewire, laravel livewire, alpine.js, html css dashboard laravel, Volt Laravel Admin Dashboard, livewire volt dashboard, volt admin, livewire dashboard, livewire admin, web dashboard, bootstrap 5 dashboard laravel, bootstrap 5, css3 dashboard, bootstrap 5 admin laravel, volt dashboard bootstrap 5 laravel, frontend, responsive bootstrap 5 dashboard, volt dashboard, volt laravel bootstrap 5 dashboard"></meta>
        <meta  name="description" content="Volt Laravel Admin Dashboard features dozens of UI components and a Laravel backend with Livewire & Alpine.js"></meta>
        <meta  itemprop="name" content="Volt Laravel Admin Dashboard by Themesberg & UPDIVISION"></meta>
        <meta  itemprop="description" content="Volt Laravel Admin Dashboard features dozens of UI components and a Laravel backend with Livewire & Alpine.js"></meta>
        <meta  itemprop="image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-laravel-dashboard/volt-free-laravel-dashboard.jpg"></meta>
        <meta  name="twitter:card" content="product"></meta>
        <meta  name="twitter:site" content="@themesberg"></meta>
        <meta  name="twitter:title" content="Volt Laravel Admin Dashboard by Themesberg & UPDIVISION"></meta>
        <meta  name="twitter:description" content="Volt Laravel Admin Dashboard features dozens of UI components and a Laravel backend with Livewire & Alpine.js"></meta>
        <meta  name="twitter:creator" content="@themesberg"></meta>
        <meta  name="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-laravel-dashboard/volt-free-laravel-dashboard.jpg"></meta>
        <meta  property="fb:app_id" content="655968634437471"></meta>
        <meta  property="og:title" content="Volt Laravel Admin Dashboard by Themesberg & UPDIVISION"></meta>
        <meta  property="og:type" content="article"></meta>
        <meta  property="og:url" content="https://themesberg.com/product/laravel/volt-admin-dashboard-template/preview"></meta>
        <meta  property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/volt-laravel-dashboard/volt-free-laravel-dashboard.jpg"></meta>
        <meta  property="og:description" content="Volt Laravel Admin Dashboard features dozens of UI components and a Laravel backend with Livewire & Alpine.js"></meta>
        <meta  property="og:site_name" content="Themesberg"></meta> --}}
    {{-- @endif --}}

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../../assets/img/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="../../assets/img/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="../../assets/img/favicon/favicon-16x16.png" sizes="16x16" type="image/png">

    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="../../assets/img/favicon/favicon-32x32.png">
    <meta name="msapplication-config" content="../../assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    
    <!-- Apex Charts -->
    <link type="text/css" href="/vendor/apexcharts/apexcharts.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker-bs4.min.css">

    <!-- Fontawesome -->
    <link type="text/css" href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    
    <!-- Sweet Alert -->
    <link type="text/css" href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Notyf -->
    <link type="text/css" href="/vendor/notyf/notyf.min.css" rel="stylesheet">
    
    <!-- Volt CSS -->
    <link type="text/css" href="/css/volt.css" rel="stylesheet">






    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Vendor JS -->
    <script src="/assets/js/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="/assets/js/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="/assets/js/smooth-scroll.polyfills.min.js"></script>

    <!-- Apex Charts -->
    <script src="/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Charts -->
    <script src="/assets/js/chartist.min.js"></script>
    <script src="/assets/js/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker.min.js"></script> --}}

    <!-- Sweet Alerts 2 -->
    <script src="/assets/js/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script> --}}

    <!-- Notyf -->
    <script src="/vendor/notyf/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="/assets/js/simplebar.min.js"></script>



    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <!-- Volt JS -->
    <script src="/assets/js/volt.js"></script>

    <script src="/assets/js/jquery.min.js"></script>

    <!-- jam -->
    <script src="/assets/js/jam.js"></script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #print-area, #print-area * {
                visibility: visible;
            }
            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
    
            /* Sembunyikan tombol download saat print */
            .no-print {
                display: none !important;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}


    @livewireStyles
</head>

<body onload="realtimeClock()">
    @livewireScripts
        {{ $slot }}

    <!-- Stack untuk scripts -->
    @stack('scripts')
</body>

</html>