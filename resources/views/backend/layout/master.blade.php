<!DOCTYPE html>
<html lang="en" data-footer="true"
    data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Acorn Admin Template | @yield('page-title')</title>
    <meta name="description" content="Ecommerce Dashboard" />
    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{ asset('backend/assets/img/favicon/apple-touch-icon-57x57.png') }}" />

    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('backend/assets/img/favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('backend/assets/img/favicon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo"
        content="{{ asset('backend/assets/img/favicon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo"
        content="{{ asset('backend/assets/img/favicon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo"
        content="{{ asset('backend/assets/img/favicon/mstile-310x310.png') }}" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/font/CS-Interface/style.css') }}" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendor/OverlayScrollbars.min.css') }}" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.css') }}" />
    <!-- Template Base Styles End -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}" />

    @stack('style')
</head>

<body>
    <div id="root">
        @include('backend.body.sidebar')

        <main>
            @yield('body')
        </main>
        <!-- Layout Footer Start -->
        @include('backend.body.footer')
        <!-- Layout Footer End -->
    </div>

    <!-- Theme Settings Modal Start -->

    <!-- Theme Settings Modal End -->

    <!-- Search Modal Start -->
    @include('backend.component.search')
    <!-- Search Modal End -->

    <!-- Vendor Scripts Start -->
    <script src="{{ asset('backend/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="{{ asset('backend/assets/font/CS-Line/csicons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/base/helpers.js') }}"></script>
    <script src="{{ asset('backend/assets/js/base/globals.js') }}"></script>
    <script src="{{ asset('backend/assets/js/base/nav.js') }}"></script>
    <script src="{{ asset('backend/assets/js/base/settings.js') }}"></script>
    <script src="{{ asset('backend/assets/js/base/init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <!-- Template Base Scripts End -->

    <!-- Page Specific Scripts Start -->
    @stack('script')
    <script src="{{ asset('backend/assets/js/common.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
    <!-- Page Specific Scripts End -->

</body>

</html>
