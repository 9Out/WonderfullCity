<aside class="sidebar" id="sidebar">
    <ul>
        <li class="side-item" title="Dashboard">
            <a href="{{ route('dashboard.index') }}">
                <span class="side-icon"><i class="fa fa-dashboard"></i>Dashboard</span>
            </a>
        </li>
        <li class="side-item" title="UMKM">
            <a href="{{ route('umkm.admin') }}">
                <span class="side-icon"><i class="fa fa-file-lines"></i>UMKM</span>
            </a>
        </li>
        <li class="side-item" title="Wisata">
            <a href="{{ route('wisata.admin') }}">
                <span class="side-icon"><i class="fa fa-file-lines"></i>Wisata</span>
            </a>
        </li>
        <li class="side-item" title="Informasi Landing">
            <a href="{{ route('landing.show') }}">
                <span class="side-icon"><i class="fa fa-gear"></i>Landing Page</span>
            </a>
        </li>
        <li class="side-item" title="Logout">
            <form id="logout-form" action="{{ route('logout') }}" method="post">
                @csrf
                <a class="logout" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="side-icon"><i class="fa fa-right-from-bracket"></i>Logout</span>
                </a>
            </form>
        </li>
    </ul>
</aside>