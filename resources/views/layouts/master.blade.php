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
    @yield('css')

    <link href="{{ asset('js/toastr/toastr.min.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <div class="wallpaper">
            <header>
                <div class="main-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="logo">
                                    <a href="{{ route('home') }}" style="text-decoration: none">
                                        <h4 style="color: #1F1F1F; font-weight: bold">スポーツ医科学プロジェクト</h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9">
                                @if (Auth::check())
                                    <ul class="nav navbar-nav float-right">
                                        <li class="dropdown dropdown-user nav-item"><a
                                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                                data-toggle="dropdown">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ auth()->user()->avatar ? url(auth()->user()->avatar) : url('/images/default_avatar.png') }}"
                                                        alt="avatar">
                                                    <i></i>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if (Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                                                    <a class="dropdown-item" href="/students">管理者ダッシュボード</a>
                                                @elseif(Auth::user()->role === \App\Models\User::ROLE_TEACHER)
                                                    <a class="dropdown-item"
                                                        href="{{ '/students' }}">プロフィール</a>
                                                @else
                                                    <a class="dropdown-item"
                                                        href="{{ '/students' . '/' . Auth::user()->id }}">プロフィール</a>
                                                @endif
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('auths.logout') }}" style="color:red"><svg
                                                        style="margin-right: 5px" xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor"
                                                        class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                                        <path fill-rule="evenodd"
                                                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                                    </svg>
                                                    ログアウト</a>
                                            </div>
                                        </li>
                                    </ul>
                                @else
                                    <div class="banner">
                                        <a href="{{ route('auths.getLogin') }}" class="login">ログイン</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-nav">
                    <div class="container">
                        <div class="menu-header" style="height: 280px">
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.0/dist/xlsx.full.min.js"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/owl/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/toastr/toastr.min.js') }}"></script>

    <script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    @yield('js')

</body>

</html>
