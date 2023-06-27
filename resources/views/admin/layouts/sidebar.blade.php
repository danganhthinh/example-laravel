<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @php
                $user = \Illuminate\Support\Facades\Auth::user();
            @endphp
            @if ($user->role === \App\Models\User::ROLE_ADMIN || $user->role === \App\Models\User::ROLE_TEACHER)
                <li class=" nav-item {{ Request::is('students*') ? 'active' : '' }}">
                    <a href="/students" class="">
                        <i class="ft-users"></i><span class="menu-title" data-i18n="">学生リスト</span>
                    </a>
                </li>
            @endif
            @if ($user->role === \App\Models\User::ROLE_ADMIN)
                <li class=" nav-item {{ Request::is('teachers*') ? 'active' : '' }}">
                    <a href="/teachers" class="">
                        <i class="ft-user-check"></i><span class="menu-title" data-i18n="">教師リスト</span>
                    </a>
                </li>
                <li class=" nav-item {{ Request::is('posts*') ? 'active' : '' }}">
                    <a href="/posts" class="">
                        <i class="ft-file-text"></i><span class="menu-title" data-i18n="">ブログ </span>
                    </a>
                </li>

                <li class=" nav-item {{ Request::is('categories*') ? 'active' : '' }}">
                    <a href="/categories" class="">
                        <i class="ft-file-text"></i><span class="menu-title" data-i18n="">カテゴリー管理</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
