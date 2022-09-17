<ul class="sidebar-menu">
    <li class="menu-header"></li>
    <li class="menu-header">Dashboard</li>
    <li class="nav-item {{ Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
    </li>
    <li class="menu-header">Grup Membaca</li>

    {{-- <li class="nav-item {{ request()->is('chat*') ? ' active' : '' }}">
        <a href="{{ route('chat') }}" class="nav-link"><i class="far fa-comment"></i><span>Chat</span></a>
    </li> --}}
    <li class="nav-item dropdown {{ request()->is('chat*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-id-card-alt"></i>
            <span>Chat</span></a>
        <ul class="dropdown-menu">
            <li class="{{ request()->is('chat/group') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('chat') }}">Group</a>
            </li>
            <li class="{{ request()->is('chat/broadcast') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('broadcast') }}">Broadcast</a>
            </li>

        </ul>
    </li>
    </li>

    <li class="nav-item {{ request()->is('group*') ? ' active' : '' }}">
        <a href="{{ route('group') }}" class="nav-link"><i class="fas fa-users"></i><span>Group</span></a>
    </li>
    <li class="nav-item dropdown {{ request()->is('anggota*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-id-card-alt"></i>
            <span>Anggota</span></a>
        <ul class="dropdown-menu">
            <li class="{{ request()->is('anggota/join') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('join') }}">Approve</a>
            </li>
            <li class="{{ request()->is('anggota/leave') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('leave') }}">Leave</a>
            </li>
            <li class="{{ request()->is('anggota/transfer') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('transfer') }}">Transfer</a>
            </li>
        </ul>
    </li>
    {{-- <li class="nav-item {{ request()->is('gereja*') ? ' active' : '' }}">
        <a href="{{ route('gereja') }}" class="nav-link"><i class="fas fa-church"></i><span>Gereja</span></a>
    </li> --}}
    <li class="menu-header">Data Master</li>
    <li class="nav-item {{ request()->is('user*') ? ' active' : '' }}">
        <a href="{{ route('user') }}" class="nav-link"><i class="fas fa-id-card"></i><span>PIC</span></a>
    </li>
    <li class="nav-item dropdown {{ request()->is('gereja*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-church"></i>
            <span>Greja</span></a>
        <ul class="dropdown-menu">
            <li class="{{ request()->is('gereja/pusat') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gereja') }}">Pusat</a>
            </li>
            <li class="{{ request()->is('gereja/cabang') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('gereja.cabang') }}">Cabang</a>
            </li>
        </ul>
    </li>
    <li class="nav-item {{ request()->is('rencana*') ? ' active' : '' }}">
        <a href="{{ route('rencana.baca') }}" class="nav-link"><i class="fas fa-list-ul"></i><span>Rencana
                Baca</span></a>
    </li>

    <li class="menu-header">report</li>

    </li>
    {{-- <li class="nav-item dropdown {{ request()->is('member*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
            <span>member</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">data member</a></li>
            <li class="{{ request()->is('member/data') ? 'active' : '' }}"><a class="nav-link"
                    href="layout-transparent.html">data member</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a>
            </li>
        </ul>
    </li> --}}
    <li class="menu-header">Pengaturan</li>
    <li class="nav-item {{ request()->is('profile*') ? ' active' : '' }}">
        <a href="{{ route('profile') }}" class="nav-link">
            <i class="fas fa-user-check"></i>
            <span>profile</span></a>
    </li>
</ul>
