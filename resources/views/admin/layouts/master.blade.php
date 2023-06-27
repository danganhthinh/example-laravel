<!DOCTYPE html>
<html>

<head>
    @include('admin.layouts.head')
    @yield('head')
</head>

<body class="vertical-layout vertical-menu 2-columns fixed-navbar menu-expanded pace-done" data-open="click"
    data-menu="vertical-menu" data-col="2-columns">
    <style>
        a,
        input:not(.email),
        label,
        .card-title,
        .breadcrumb,
        td,
        th {
            text-transform: capitalize !important;
        }

        .disabled {
            opacity: 0.5;
        }
    </style>
    <!-- Header -->
    <header>
        @include('admin.layouts.header')
    </header>

    <!-- Sidebar -->
    @if (auth()->user()->role === \App\Models\User::ROLE_ADMIN)
        @include('admin.layouts.sidebar')
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="app-content {{ auth()->user()->role === \App\Models\User::ROLE_ADMIN ? 'content' : 'p-4' }}">
        <div class="content-wrapper">
            @if (session('status'))
                <div class="alert-message">{{ session('status') }}</div>
            @endif
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
    </div>

    @if (auth()->user()->role === \App\Models\User::ROLE_ADMIN)
        <!-- Footer -->
        <footer class="footer footer-static footer-light navbar-border">
            @include('admin.layouts.footer')
        </footer>
    @endif

    @include('admin.layouts.scripts')
    @yield('scripts')
</body>

</html>
