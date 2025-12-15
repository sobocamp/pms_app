<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index-2.html">
            <span class="sidebar-brand-text align-middle">
                SIMPMS
                <sup><small class="badge bg-primary text-uppercase">Skansawa</small></sup>
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF"
                style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src={{ asset('img/avatars/avatar.jpg') }} class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="align-middle me-1"
                                data-feather="user"></i> Profile</a>
                        {{-- <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                data-feather="pie-chart"></i>
                            Analytics</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1"
                                data-feather="settings"></i> Settings &
                            Privacy</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i>
                            Help Center</a> --}}
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}">Log out</a> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">Log out</button>
                        </form>
                    </div>
                    <div class="sidebar-user-subtitle">
                        {{ Auth::user()->role }}
                    </div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            {{-- Menu ADMIN --}}
            @if(auth()->user()->role === 'admin')
            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('produk.index') }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Data
                        Produk</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('pengguna.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pengguna.index') }}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Data
                        Pengguna</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('pembelian.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pembelian.index') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Pembelian</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('penjualan.index') }}">
                    <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Penjualan</span>
                </a>
            </li>
            {{--
            <li class="sidebar-item {{ request()->routeIs('periode.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('periode.index') }}">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Periode
                        Pendaftaran</span>
                </a>
            </li> --}}
            {{-- <li class="sidebar-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('siswa.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Siswa</span>
                </a>
            </li> --}}
            @endif

            @if(auth()->user()->role === 'gudang')
            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('extracurricular.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('extracurricular.pembina', auth()->user()->id) }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Ekstrakurikuler
                        Saya</span>
                </a>
            </li>
            {{--
            <li class="sidebar-item {{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('absensi.index') }}">
                    <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Absensi</span>
                </a>
            </li> --}}
            @endif

            @if(auth()->user()->role === 'siswa')
            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('extracurricular.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('extracurricular.siswa', auth()->user()->id) }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Ekstrakurikuler
                        Saya</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('extracurricular') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('extracurricular') }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Semua Ekstrakurikuler</span>
                </a>
            </li>
            @endif

            {{-- <li class="sidebar-item mt-3 active">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboards</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Master
                        Data</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link"
                            href="{{ route('extracurricular.index') }}">Ekstrakurikuler</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('pembina.index') }}">Pembina <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Peserta <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-invoice.html">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Invoice</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-tasks.html">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tasks</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="calendar.html">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Auth</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Sign In</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign Up</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-reset-password.html">Reset
                            Password <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-404.html">404 Page <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-500.html">500 Page <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>
