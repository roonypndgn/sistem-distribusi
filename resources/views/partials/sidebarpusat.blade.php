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
            <div class="nav-title">Monitoring & Tracking</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.monitoring-distribusi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Monitoring Distribusi</span>
                        <span class="nav-badge">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.tracking-real-time') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="nav-text">Tracking Jeruk Real-time</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Laporan -->
        <div class="nav-section">
            <div class="nav-title">Laporan</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.laporan-harga') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-text">Laporan Harga Pembelian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.laporan-produksi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-seedling"></i></span>
                        <span class="nav-text">Laporan Produksi & Panen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.laporan-pengiriman') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-shipping-fast"></i></span>
                        <span class="nav-text">Laporan Pengiriman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.laporan-keuangan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                        <span class="nav-text">Laporan Keuangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.laporan-penggajian') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-money-check-alt"></i></span>
                        <span class="nav-text">Laporan Penggajian</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Analitik & Grafik -->
        <div class="nav-section">
            <div class="nav-title">Analitik & Grafik</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.analitik-tren-harga') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="nav-text">Analitik Tren Harga</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.analitik-volume-produksi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-pie"></i></span>
                        <span class="nav-text">Analitik Volume Produksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.analitik-biaya-distribusi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-chart-area"></i></span>
                        <span class="nav-text">Analitik Biaya Distribusi</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Sistem & Manajemen -->
        <div class="nav-section">
            <div class="nav-title">Sistem & Manajemen</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.log-aktivitas') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-history"></i></span>
                        <span class="nav-text">Log Aktivitas Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.manajemen-pengguna') ? 'active' : '' }}">
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
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.data-petani') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                        <span class="nav-text">Data Petani</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.data-ladang') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-tractor"></i></span>
                        <span class="nav-text">Data Ladang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.data-karyawan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-text">Data Karyawan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.data-kendaraan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Data Kendaraan</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Tools & Export -->
        <div class="nav-section">
            <div class="nav-title">Tools & Export</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.export-pdf') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-file-pdf"></i></span>
                        <span class="nav-text">Export PDF</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.export-excel') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-file-excel"></i></span>
                        <span class="nav-text">Export Excel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('pusat.pengaturan-sistem') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-cogs"></i></span>
                        <span class="nav-text">Pengaturan Sistem</span>
                    </a>
                </li>
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