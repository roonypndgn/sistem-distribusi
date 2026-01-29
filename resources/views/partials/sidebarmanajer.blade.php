<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('dashboard.manajer') }}" class="brand-logo">
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
        <div class="avatar">ML</div>
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name ?? 'Manajer Lapangan' }}</div>
            <div class="user-role">Manajer Operasional</div>
            <div class="user-location">
                <i class="fas fa-map-marker-alt"></i> Berastagi
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <!-- Menu Utama -->
        <div class="nav-section">
            <div class="nav-title">Menu Utama</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="{{ route('dashboard.manajer') }}" class="nav-link {{ request()->routeIs('dashboard.manajer') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-text">Dashboard Lapangan</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Input Data Operasional -->
        <div class="nav-section">
            <div class="nav-title">Input Data Operasional</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.harga-pembelian') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-money-bill-wave"></i></span>
                        <span class="nav-text">Input Harga Pembelian</span>
                        <span class="input-badge">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.data-panen') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-seedling"></i></span>
                        <span class="nav-text">Input Data Panen</span>
                        <span class="input-badge">5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.data-pengemasan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-box"></i></span>
                        <span class="nav-text">Input Data Pengemasan</span>
                        <span class="input-badge">2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.pengiriman') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-truck"></i></span>
                        <span class="nav-text">Input Pengiriman</span>
                        <span class="input-badge">1</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Update & Monitoring -->
        <div class="nav-section">
            <div class="nav-title">Update & Monitoring</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.status-distribusi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-sync-alt"></i></span>
                        <span class="nav-text">Update Status Distribusi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.upload-bukti') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-camera"></i></span>
                        <span class="nav-text">Upload Bukti Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.laporan-cuaca') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-cloud-sun"></i></span>
                        <span class="nav-text">Laporan Cuaca Lapangan</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Data Master -->
        <div class="nav-section">
            <div class="nav-title">Data Master</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.data-petani') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                        <span class="nav-text">Data Petani & Ladang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('manajer.rekap-harian') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-file-contract"></i></span>
                        <span class="nav-text">Rekap Harian Kegiatan</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Sistem -->
        <div class="nav-section">
            <div class="nav-title">Sistem</div>
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