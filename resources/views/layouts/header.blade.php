<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <a href="{{ url('/') }}" class="logo d-flex align-items-center ms-3">
            <img src="assets/img/desalogo.png" alt="">
            <span class="d-none d-lg-block">BUMDes Jaya Sakti</span>
        </a>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->username }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->username }}</h6>
                        <span>{{ auth()->user()->role }}</span>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
