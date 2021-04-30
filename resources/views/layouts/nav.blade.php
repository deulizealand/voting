<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <img src="{{ asset('images/adpilogo.png') }}" class="logo" width="42px" height="42px"/>
            <span class="align-middle me-3">eVoting</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link collapsed">
                    <i class="align-middle"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->role_id != 3)
            <li class="sidebar-item active">
                <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Master</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('positions') }}">Posisi</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('participants') }}">Peserta</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('schedule') }}" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Jadwal Pemilihan</span>
                </a>
                <a href="{{ route('members') }}" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Daftar Pemilih</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Monitoring</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>