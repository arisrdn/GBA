<ul class="sidebar-menu">
    <li class="menu-header"></li>
    <li class="menu-header">Dashboard</li>
    <li class="nav-item {{ Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
        <a href="{{ route('chat') }}" class="nav-link"><i class="far fa-comment"></i><span>Chat</span></a>
    </li>
    <li class="menu-header">Starter</li>
    <li class="nav-item dropdown {{ request()->is('member*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
            <span>member</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">data member</a></li>
            <li class="{{ request()->is('member/data') ? 'active' : '' }}"><a class="nav-link"
                    href="layout-transparent.html">data member</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a>
            </li>
        </ul>
    </li>
</ul>
