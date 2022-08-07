{{-- <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <div class="col col-12 mt-2">
            <img src="../assets/img/logo-GBA-gemar-baca-alkitab.svg" alt="logo" class="img" style="height: 60px" />
        </div>
        <a href="{{ url('home') }}">Gemar Baca Alkitab</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('home') }}">
            <img src="../assets/img/logo-GBA-gemar-baca-alkitab.svg" alt="logo" class="img"
                style="width: 50px" />
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}"><a class="nav-link"
                href="{{ url('admin.dashboard') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
        @if (Auth::user()->can('manage-users'))
            <li class="menu-header">Users</li>
            <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}"><a class="nav-link"
                    href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        @endif
    </ul>
</aside> --}}


<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <div class="col col-12 mt-2">
            <img src="{{ asset('/') }}assets/img/logo-GBA-gemar-baca-alkitab.svg" alt="logo" class="img"
                style="height: 60px" />
        </div>
        <a href="index.html">Gemar Baca Alkitab</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm align-items-center">
        <a href="index.html"><img src="../assets/img/logo-GBA-gemar-baca-alkitab.svg" alt="logo" class="img"
                style="width: 50px; margin-top: 20px" /></a>
    </div>

    @include('layouts.partials.menu')

</aside>
