<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('dashboard.supir') }}" class="brand-logo">
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
        <div class="avatar">BS</div>
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name ?? 'Budi Santoso' }}</div>
            <div class="user-role">Sopir Logistik</div>
            <div class="user-vehicle">
                <i class="fas fa-truck"></i> B 1234 ABC (Hino)
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
                    <a href="{{ route('dashboard.supir') }}" class="nav-link {{ request()->routeIs('dashboard.supir') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-text">Dashboard Sopir</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Pengiriman & Tracking -->
        <div class="nav-section">
            <div class="nav-title">Pengiriman & Tracking</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('supir.daftar-pengiriman') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-truck-loading"></i></span>
                        <span class="nav-text">Daftar Pengiriman</span>
                        <span class="delivery-badge">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('supir.update-status') ? 'active' : '' }}" id="updateStatusBtn">
                        <span class="nav-icon"><i class="fas fa-sync-alt"></i></span>
                        <span class="nav-text">Update Status Pengiriman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('supir.tracking') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="nav-text">Tracking Lokasi (GPS)</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Waktu & Riwayat -->
        <div class="nav-section">
            <div class="nav-title">Waktu & Riwayat</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('supir.input-waktu') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-clock"></i></span>
                        <span class="nav-text">Input Waktu Berangkat & Tiba</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('supir.riwayat') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-history"></i></span>
                        <span class="nav-text">Riwayat Pengiriman</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Notifikasi -->
        <div class="nav-section">
            <div class="nav-title">Notifikasi</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('supir.notifikasi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-bell"></i></span>
                        <span class="nav-text">Notifikasi Tugas</span>
                        <span class="nav-badge">2</span>
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