<aside id="sidebar" class="sidebar">
    <div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @can('data-penerimaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('data-penerimaan') ? '' : 'collapsed' }}"
                        href="{{ url('/data-penerimaan') }}">
                        <i class="bi bi-box-arrow-in-down"></i>
                        <span>Data Penerimaan</span>
                    </a>
                </li>
            @endcan

            @can('data-penjualan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('data-penjualan') ? '' : 'collapsed' }}"
                        href="{{ url('/data-penjualan') }}">
                        <i class="bi bi-box-arrow-in-up"></i>
                        <span>Data Penjualan</span>
                    </a>
                </li>
            @endcan

            @can('data-persediaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('data-persediaan') ? '' : 'collapsed' }}"
                        href="{{ url('/data-persediaan') }}">
                        <i class="bi bi-sd-card"></i>
                        <span>Data Persediaan</span>
                    </a>
                </li>
            @endcan

            @can('laporan-penerimaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('laporan-penerimaan') ? '' : 'collapsed' }}"
                        href="{{ url('/laporan-penerimaan') }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Laporan Penerimaan</span>
                    </a>
                </li>
            @endcan

            @can('laporan-penjualan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('laporan-penjualan') ? '' : 'collapsed' }}"
                        href="{{ url('/laporan-penjualan') }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Laporan Penjualan</span>
                    </a>
                </li>
            @endcan

            @can('laporan-persediaan')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('laporan-persediaan') ? '' : 'collapsed' }}"
                        href="{{ url('/laporan-persediaan') }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Laporan Persediaan</span>
                    </a>
                </li>
            @endcan

            @can('kelola_pengguna')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kelola-pengguna') ? '' : 'collapsed' }}"
                        href="{{ url('/kelola-pengguna') }}">
                        <i class="bi bi-people"></i>
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
            @endcan

        </ul>

        <form action="/logout" method="POST" style="width: 100%">
            @csrf
            <button type="submit" class="btn btn-primary" style="width: 100%">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
