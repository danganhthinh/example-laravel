@if (auth()->user()->role === \App\Models\User::ROLE_ADMIN)
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header" style="background: #ffffff">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <h6 class="" style="color: #1F1F1F;">スポーツ医科学プロジェクト</h6>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="fa fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main  hidden-xs"
                                style="padding: 1.1rem 0.8rem 1rem 1rem;" href="#"><img
                                    src="{{ asset('/backend/images/icons/ant-design_menu-fold-outlined.svg') }}"
                                    alt=""></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->avatar ? url(auth()->user()->avatar) : url('/images/default_avatar.png') }}"
                                        alt="avatar">
                                    <i></i>
                                </div>
                                <span class="user-name">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('auths.logout') }}"><i
                                        class="feather icon-power"></i>
                                    ログアウト</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
@else
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper pl-4 pr-4 d-flex justify-content-between ">
            <div class="navbar-header" style="background: #ffffff">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <h3 class="font-weight-bold" style="color: #1F1F1F;">スポーツ医科学プロジェクト</h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="fa fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container" style="padding: 0">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->avatar ? url(auth()->user()->avatar) : url('/images/default_avatar.png') }}"
                                        alt="avatar">
                                    <i></i>
                                </div>
                                <span class="user-name">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('auths.logout') }}"><i
                                        class="feather icon-power"></i>
                                    ログアウト</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
@endif
