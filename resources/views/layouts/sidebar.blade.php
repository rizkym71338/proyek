<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @can('penerimaan')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('data-penerimaan') || request()->is('laporan-penerimaan') ? '' : 'collapsed' }}"
                    data-bs-target="#penerimaan" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-arrow-in-down"></i>
                    <span>Penerimaan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="penerimaan"
                    class="nav-content collapse {{ request()->is('data-penerimaan') || request()->is('laporan-penerimaan') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/data-penerimaan') }}">
                            <i class="bi bi-circle"></i>
                            <span>Data Penerimaan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/laporan-penerimaan') }}">
                            <i class="bi bi-circle"></i>
                            <span>Laporan penerimaan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('penjualan')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('data-penjualan') || request()->is('laporan-penjualan') ? '' : 'collapsed' }}"
                    data-bs-target="#penjualan" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-arrow-in-up"></i>
                    <span>Penjualan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="penjualan"
                    class="nav-content collapse {{ request()->is('data-penjualan') || request()->is('laporan-penjualan') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/data-penjualan') }}">
                            <i class="bi bi-circle"></i>
                            <span>Data Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/laporan-penjualan') }}">
                            <i class="bi bi-circle"></i>
                            <span>Laporan Penjualan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('persediaan')
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
</aside>
