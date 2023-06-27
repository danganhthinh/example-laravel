<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/owl/dist/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('/owl/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/toastr/toastr.min.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>
    <div id="app">
        <main id="site-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.0/dist/xlsx.full.min.js"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/owl/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    <script src="{{ asset('/js/toastr/toastr.min.js') }}"></script>

    @yield('js')

</body>

</html>
