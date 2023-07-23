<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="{{ url('/') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @can('laporan-penerimaan')
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
                    @can('data-penerimaan')
                        <li>
                            <a href="{{ url('/data-penerimaan') }}">
                                <i class="bi bi-circle"></i>
                                <span>Data Penerimaan</span>
                            </a>
                        </li>
                    @endcan
                    @can('laporan-penerimaan')
                        <li>
                            <a href="{{ url('/laporan-penerimaan') }}">
                                <i class="bi bi-circle"></i>
                                <span>Laporan penerimaan</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('laporan-penjualan')
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
                    @can('data-penjualan')
                        <li>
                            <a href="{{ url('/data-penjualan') }}">
                                <i class="bi bi-circle"></i>
                                <span>Data Penjualan</span>
                            </a>
                        </li>
                    @endcan
                    @can('laporan-penjualan')
                        <li>
                            <a href="{{ url('/laporan-penjualan') }}">
                                <i class="bi bi-circle"></i>
                                <span>Laporan Penjualan</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('laporan-persediaan')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('data-persediaan') || request()->is('laporan-persediaan') ? '' : 'collapsed' }}"
                    data-bs-target="#persediaan" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-newspaper"></i>
                    <span>Persediaan</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="persediaan"
                    class="nav-content collapse {{ request()->is('data-persediaan') || request()->is('laporan-persediaan') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('data-persediaan')
                        <li>
                            <a href="{{ url('/data-persediaan') }}">
                                <i class="bi bi-circle"></i>
                                <span>Data Persediaan</span>
                            </a>
                        </li>
                    @endcan
                    @can('laporan-persediaan')
                        <li>
                            <a href="{{ url('/laporan-persediaan') }}">
                                <i class="bi bi-circle"></i>
                                <span>Laporan Persediaan</span>
                            </a>
                        </li>
                    @endcan
                </ul>
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
