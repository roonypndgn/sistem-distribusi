<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('dashboard.pusat') }}" class="brand-logo">
            <div class="logo-icon">
                <i class="fas fa-lemon" style="color:orange"></i>
            </div>
            <div class="logo-text">
                PT. <span>Mardua Holong</span>
            </div>
        </a>
    </div>
    
    <!-- User Profile -->
    <div class="user-profile">
        <div class="avatar">K2</div>
        <div class="user-info">
            <div class="user-name">Kelompok 2</div>
            <div class="user-role">Manajemen Pusat</div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <!-- Menu Utama -->
        <div class="nav-section">
            <div class="nav-title">Menu Utama</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{ route('dashboard.pusat') }}" class="nav-link {{ request()->routeIs('dashboard.pusat') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-text">Dashboard Utama</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Monitoring & Tracking -->
        <div class="nav-section">
            <div class="nav-title">Monitoring Jeruk</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{route('pusat.monitoring-distribusi')}}" class="nav-link {{ request()->routeIs('pusat.monitoring-distribusi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Monitor Distribusi</span>
                        <span class="nav-badge">3</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Laporan -->
        <div class="nav-section">
            <div class="nav-title">Laporan</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{route('pusat.laporan-harga')}}" class="nav-link {{ request()->routeIs('pusat.laporan-harga') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-text">Laporan Harga Beli</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pusat.laporan-produksi')}}" class="nav-link {{ request()->routeIs('pusat.laporan-produksi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-seedling"></i></span>
                        <span class="nav-text">Laporan Produksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pusat.laporan-pengiriman')}}" class="nav-link {{ request()->routeIs('pusat.laporan-pengiriman') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-shipping-fast"></i></span>
                        <span class="nav-text">Laporan Pengiriman</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Analitik & Grafik -->
        <div class="nav-section">
            <div class="nav-title">Analitik & Grafik</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{route('pusat.analitik-harga')}}" class="nav-link {{ request()->routeIs('pusat.analitik-harga') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="nav-text">Analitik Tren Harga</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Sistem & Manajemen -->
        <div class="nav-section">
            <div class="nav-title">Sistem & Manajemen</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{route('pusat.manajemen-pengguna')}}" class="nav-link {{ request()->routeIs('pusat.manajemen-pengguna') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-users-cog"></i></span>
                        <span class="nav-text">Manajemen Pengguna</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Data Master -->
        <div class="nav-section">
            <div class="nav-title">Data Master</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{route('pusat.data-petani')}}" class="nav-link {{ request()->routeIs('pusat.data-petani') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                        <span class="nav-text">Data Petani</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pusat.data-ladang')}}" class="nav-link {{ request()->routeIs('pusat.data-ladang') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-tractor"></i></span>
                        <span class="nav-text">Data Ladang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pusat.data-karyawan')}}" class="nav-link {{ request()->routeIs('pusat.data-karyawan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-text">Data Gaji Karyawan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pusat.data-kendaraan')}}" class="nav-link {{ request()->routeIs('pusat.data-kendaraan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Data Kendaraan</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Tools & Export -->
        <div class="nav-section">
            <div class="nav-title">Tools</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link" id="logoutBtn">
                        <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Toggle Sidebar Button -->
    <button class="toggle-sidebar" id="toggleSidebar">
        <i class="fas fa-chevron-left"></i>
    </button>
</aside>