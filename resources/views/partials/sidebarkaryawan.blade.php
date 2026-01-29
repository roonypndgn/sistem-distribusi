<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <a href="{{ route('dashboard.karyawan') }}" class="brand-logo">
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
        <div class="avatar">KP</div>
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name ?? 'Karyawan Packing' }}</div>
            <div class="user-role">Karyawan Lapangan</div>
            <div class="user-dept">
                <i class="fas fa-box"></i> Divisi Packing
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
                    <a href="{{ route('dashboard.karyawan') }}" class="nav-link {{ request()->routeIs('dashboard.karyawan') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-text">Dashboard Karyawan</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Absensi & Jadwal -->
        <div class="nav-section">
            <div class="nav-title">Absensi & Jadwal</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('karyawan.absensi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-fingerprint"></i></span>
                        <span class="nav-text">Absensi Harian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('karyawan.jadwal') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="nav-text">Lihat Jadwal Kerja</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('karyawan.riwayat') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-history"></i></span>
                        <span class="nav-text">Riwayat Kerja</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Produksi & Packing -->
        <div class="nav-section">
            <div class="nav-title">Produksi & Packing</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('karyawan.packing') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                        <span class="nav-text">Input Hasil Packing</span>
                        <span class="nav-badge">Hari Ini</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Gaji & Pembayaran -->
        <div class="nav-section">
            <div class="nav-title">Gaji & Pembayaran</div>
            <ul class="nav-items">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('karyawan.slip-gaji') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                        <span class="nav-text">Lihat Slip Gaji</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('karyawan.notifikasi') ? 'active' : '' }}">
                        <span class="nav-icon"><i class="fas fa-bell"></i></span>
                        <span class="nav-text">Notifikasi Pembayaran</span>
                        <span class="payment-badge">1</span>
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