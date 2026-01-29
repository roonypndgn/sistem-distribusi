<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Distribusi PT. Mardua Holong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2D6A4F;
            --primary-light: #40916C;
            --primary-lighter: #E8F5F0;
            --secondary: #FF8C42;
            --secondary-light: #FFB884;
            --text-dark: #1E3A2C;
            --text-light: #6B7A73;
            --text-lighter: #8A9A93;
            --bg-light: #F8FCFA;
            --border: #E2ECE8;
            --white: #FFFFFF;
            --sidebar-width: 260px;
            --sidebar-collapsed: 70px;
            --header-height: 70px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--white);
            border-right: 1px solid var(--border);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.03);
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }
        
        /* Sidebar Header */
        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid var(--border);
            background-color: var(--white);
        }
        
        .sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 0;
        }
        
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .sidebar.collapsed .brand-logo {
            justify-content: center;
        }
        
        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }
        
        .logo-text {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .logo-text span {
            color: var(--primary);
        }
        
        .sidebar.collapsed .logo-text {
            display: none;
        }
        
        /* User Profile */
        .user-profile {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar.collapsed .user-profile {
            padding: 20px 10px;
            justify-content: center;
        }
        
        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .user-info {
            flex: 1;
            overflow: hidden;
        }
        
        .sidebar.collapsed .user-info {
            display: none;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 15px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .user-role {
            font-size: 13px;
            color: var(--text-light);
            margin-top: 2px;
        }
        
        /* Navigation */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }
        
        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar-nav::-webkit-scrollbar-thumb {
            background-color: var(--border);
            border-radius: 10px;
        }
        
        .nav-section {
            margin-bottom: 24px;
        }
        
        .nav-title {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-lighter);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 20px 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar.collapsed .nav-title {
            display: none;
        }
        
        .nav-items {
            list-style: none;
        }
        
        .nav-item {
            margin-bottom: 4px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: var(--transition);
            position: relative;
        }
        
        .sidebar.collapsed .nav-link {
            padding: 12px;
            justify-content: center;
        }
        
        .nav-link:hover {
            background-color: var(--primary-lighter);
            color: var(--primary);
        }
        
        .nav-link.active {
            background-color: var(--primary-lighter);
            color: var(--primary);
            border-left-color: var(--primary);
        }
        
        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        
        .nav-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .sidebar.collapsed .nav-text {
            display: none;
        }
        
        /* Badge for notifications */
        .nav-badge {
            background-color: var(--secondary);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 20px;
            text-align: center;
        }
        
        .sidebar.collapsed .nav-badge {
            position: absolute;
            top: 8px;
            right: 8px;
        }
        
        /* Logout button specific styles */
        #logoutBtn .nav-icon {
            color: #E74C3C;
        }
        
        #logoutBtn:hover {
            background-color: #FEEFEF;
            color: #E74C3C;
        }
        
        #logoutBtn:hover .nav-icon {
            color: #E74C3C;
        }
        
        /* Submenu */
        .submenu {
            list-style: none;
            padding-left: 44px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .sidebar.collapsed .submenu {
            display: none;
        }
        
        .submenu.open {
            max-height: 500px;
        }
        
        .submenu-item {
            margin-bottom: 2px;
        }
        
        .submenu-link {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 0;
            color: var(--text-light);
            text-decoration: none;
            font-size: 13px;
            transition: var(--transition);
        }
        
        .submenu-link:hover {
            color: var(--primary);
        }
        
        .submenu-link.active {
            color: var(--primary);
            font-weight: 500;
        }
        
        .submenu-icon {
            font-size: 6px;
            color: var(--text-lighter);
        }
        
        /* Toggle Button */
        .toggle-sidebar {
            position: absolute;
            top: 20px;
            right: -12px;
            width: 24px;
            height: 24px;
            background-color: var(--white);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-light);
            font-size: 12px;
            z-index: 101;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }
        
        .toggle-sidebar:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed);
        }
        
        /* Header */
        .main-header {
            height: var(--header-height);
            background-color: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-input {
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            width: 300px;
            background-color: var(--bg-light);
            transition: var(--transition);
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            width: 350px;
            background-color: var(--white);
        }
        
        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 16px;
        }
        
        .notification-bell {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .notification-bell:hover {
            background-color: var(--bg-light);
            color: var(--primary);
        }
        
        .notification-count {
            position: absolute;
            top: 6px;
            right: 6px;
            background-color: var(--secondary);
            color: white;
            font-size: 10px;
            font-weight: 600;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Content Area */
        .content-wrapper {
            padding: 30px;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }
        
        .content-card {
            background-color: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border);
            transition: var(--transition);
        }
        
        .content-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
        }
        
        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-lighter);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
        }
        
        /* Demo Content */
        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }
        
        .stat-label {
            font-size: 14px;
            color: var(--text-light);
        }
        
        .demo-chart {
            height: 200px;
            background: linear-gradient(to right, var(--primary-lighter), #E8F5F0);
            border-radius: 12px;
            margin-top: 20px;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }
        
        .chart-bar {
            flex: 1;
            background-color: var(--primary);
            margin: 0 4px;
            border-radius: 4px 4px 0 0;
            min-height: 20px;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease-out;
        }
        
        .modal-content {
            background-color: var(--white);
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .modal-header {
            padding: 24px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .modal-icon {
            width: 48px;
            height: 48px;
            background-color: #FEEFEF;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #E74C3C;
            font-size: 22px;
        }
        
        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .modal-body {
            padding: 24px;
        }
        
        .modal-body p {
            margin-bottom: 12px;
            color: var(--text-dark);
            line-height: 1.5;
        }
        
        .modal-warning {
            background-color: #FFF9E6;
            border-left: 4px solid #FFC107;
            padding: 12px;
            border-radius: 0 8px 8px 0;
            font-size: 14px;
            color: #856404;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
        }
        
        .modal-footer {
            padding: 16px 24px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            border-top: 1px solid var(--border);
        }
        
        .modal-btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .modal-btn-cancel {
            background-color: var(--bg-light);
            color: var(--text-light);
        }
        
        .modal-btn-cancel:hover {
            background-color: #E8EAED;
        }
        
        .modal-btn-confirm {
            background-color: #E74C3C;
            color: white;
        }
        
        .modal-btn-confirm:hover {
            background-color: #C0392B;
        }
        
        /* Toast Notification */
        .toast {
            position: fixed;
            top: 90px;
            right: 30px;
            background-color: var(--white);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
            max-width: 350px;
            z-index: 1001;
            transform: translateX(400px);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-left: 4px solid var(--primary);
        }
        
        .toast.show {
            transform: translateX(0);
        }
        
        .toast-icon {
            width: 36px;
            height: 36px;
            background-color: var(--primary-lighter);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .toast-content {
            flex: 1;
        }
        
        .toast-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
            font-size: 15px;
        }
        
        .toast-message {
            font-size: 13px;
            color: var(--text-light);
            line-height: 1.4;
        }
        
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background-color: var(--primary);
            width: 100%;
            border-radius: 0 0 12px 12px;
            animation: progressBar 3s linear forwards;
        }
        
        @keyframes progressBar {
            from { width: 100%; }
            to { width: 0%; }
        }
        
        /* Responsiveness */
        @media (max-width: 1200px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .toggle-sidebar {
                right: 20px;
                top: 20px;
            }
            
            .search-input {
                width: 250px;
            }
            
            .search-input:focus {
                width: 300px;
            }
        }
        
        @media (max-width: 768px) {
            .main-header {
                padding: 0 20px;
            }
            
            .content-wrapper {
                padding: 20px;
            }
            
            .search-input {
                width: 200px;
            }
            
            .search-input:focus {
                width: 250px;
            }
            
            .toast {
                right: 20px;
                left: 20px;
                max-width: none;
            }
        }
        
        @media (max-width: 576px) {
            .page-title {
                font-size: 18px;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .search-box {
                display: none;
            }
            
            .modal-content {
                width: 95%;
            }
        }
        
        /* Animation for demo */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .content-card {
            animation: fadeIn 0.4s ease-out forwards;
        }
        
        .content-card:nth-child(2) {
            animation-delay: 0.1s;
        }
        
        .content-card:nth-child(3) {
            animation-delay: 0.2s;
        }
        
        .content-card:nth-child(4) {
            animation-delay: 0.3s;
        }
    </style>
</head>
<body>
   <!-- Modal Logout -->
<div class="modal-overlay" id="logoutModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h3 class="modal-title">Konfirmasi Logout</h3>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin keluar dari sistem?</p>
            <p class="modal-warning"><i class="fas fa-exclamation-circle"></i> Semua perubahan yang belum disimpan akan hilang.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-cancel" id="cancelLogout">Batal</button>
            <button class="modal-btn modal-btn-confirm" id="confirmLogout">
                <i class="fas fa-sign-out-alt"></i> Ya, Logout
            </button>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast" id="logoutToast">
    <div class="toast-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <div class="toast-content">
        <div class="toast-title">Berhasil Logout</div>
        <div class="toast-message">Anda telah keluar dari sistem. Mengarahkan ke halaman login...</div>
    </div>
    <div class="toast-progress"></div>
</div>

<!-- Form Logout Laravel (tersembunyi) -->
<form id="laravel-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="#" class="brand-logo">
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
                        <a href="#" class="nav-link active">
                            <span class="nav-icon"><i class="fas fa-home"></i></span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Data & Distribusi -->
            <div class="nav-section">
                <div class="nav-title">Data & Distribusi</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-truck"></i></span>
                            <span class="nav-text">Data Distribusi</span>
                            <span class="nav-badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-map-marked-alt"></i></span>
                            <span class="nav-text">Tracking Real-time</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-history"></i></span>
                            <span class="nav-text">Riwayat Pengiriman</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Manajemen Keuangan -->
            <div class="nav-section">
                <div class="nav-title">Manajemen Keuangan</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <span class="nav-text">Harga Beli Jeruk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                            <span class="nav-text">Analisis Fluktuasi Harga</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                            <span class="nav-text">Laporan Penggajian</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Manajemen Produksi -->
            <div class="nav-section">
                <div class="nav-title">Manajemen Produksi</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-seedling"></i></span>
                            <span class="nav-text">Data Panen per Ladang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-star"></i></span>
                            <span class="nav-text">Kualitas Jeruk per Batch</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-cloud-sun"></i></span>
                            <span class="nav-text">Pengaruh Cuaca</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Manajemen SDM -->
            <div class="nav-section">
                <div class="nav-title">Manajemen SDM</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-text">Data Karyawan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-calendar-check"></i></span>
                            <span class="nav-text">Absensi Harian</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-hand-holding-usd"></i></span>
                            <span class="nav-text">Penggajian & Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Monitoring -->
            <div class="nav-section">
                <div class="nav-title">Monitoring</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-cloud-sun-rain"></i></span>
                            <span class="nav-text">Dashboard Cuaca</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-exclamation-triangle"></i></span>
                            <span class="nav-text">Laporan Gangguan</span>
                            <span class="nav-badge">5</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Laporan & Audit -->
            <div class="nav-section">
                <div class="nav-title">Laporan & Audit</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-file-contract"></i></span>
                            <span class="nav-text">Laporan Keuangan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                            <span class="nav-text">Log Aktivitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-exchange-alt"></i></span>
                            <span class="nav-text">Histori Transaksi</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Pengaturan -->
            <div class="nav-section">
                <div class="nav-title">Pengaturan</div>
                <ul class="nav-items">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-user-cog"></i></span>
                            <span class="nav-text">Manajemen User & Role</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-cogs"></i></span>
                            <span class="nav-text">Konfigurasi Sistem</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-database"></i></span>
                            <span class="nav-text">Backup Data</span>
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
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="page-title">Dashboard Manajemen Pusat</div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari data, laporan, atau menu...">
                </div>
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">5</span>
                </div>
            </div>
        </header>
        
        <!-- Content -->
        <div class="content-wrapper">
            <!-- Statistik Cards -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-title">
                        <span>Total Pembelian</span>
                        <div class="card-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="stat-number">Rp 2.5 M</div>
                    <div class="stat-label">+12% dari bulan lalu</div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Pengiriman Aktif</span>
                        <div class="card-icon">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                    </div>
                    <div class="stat-number">18</div>
                    <div class="stat-label">Dalam perjalanan ke Jakarta</div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Total Pengeluaran</span>
                        <div class="card-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <div class="stat-number">Rp 1.8 M</div>
                    <div class="stat-label">-5% dari bulan lalu</div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Petani Aktif</span>
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number">124</div>
                    <div class="stat-label">+8 petani baru bulan ini</div>
                </div>
            </div>
            
            <!-- Charts & Notifikasi -->
            <div class="content-grid">
                <div class="content-card" style="grid-column: span 2;">
                    <div class="card-title">
                        <span>Grafik Produksi Bulanan (Ton)</span>
                        <div class="card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                    <div class="demo-chart">
                        <div class="chart-bar" style="height: 80%;"></div>
                        <div class="chart-bar" style="height: 65%;"></div>
                        <div class="chart-bar" style="height: 90%;"></div>
                        <div class="chart-bar" style="height: 75%;"></div>
                        <div class="chart-bar" style="height: 95%;"></div>
                        <div class="chart-bar" style="height: 70%;"></div>
                    </div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Notifikasi Terbaru</span>
                        <div class="card-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <div style="padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; margin-bottom: 10px; font-size: 13px;">
                            <div style="font-weight: 600; color: var(--primary);">Pengiriman #JKT-235</div>
                            <div style="color: var(--text-light);">Tiba di Medan - 10 menit lalu</div>
                        </div>
                        <div style="padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; margin-bottom: 10px; font-size: 13px;">
                            <div style="font-weight: 600; color: var(--primary);">Pembayaran Petani</div>
                            <div style="color: var(--text-light);">15 pembayaran berhasil diproses</div>
                        </div>
                        <div style="padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; font-size: 13px;">
                            <div style="font-weight: 600; color: var(--primary);">Laporan Cuaca</div>
                            <div style="color: var(--text-light);">Hujan diperkirakan di Berastagi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleSidebar = document.getElementById('toggleSidebar');
            const toggleIcon = toggleSidebar.querySelector('i');
            
            // Toggle sidebar
            toggleSidebar.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                
                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.className = 'fas fa-chevron-right';
                } else {
                    toggleIcon.className = 'fas fa-chevron-left';
                }
            });
            
            // Mobile menu toggle
            function handleMobileMenu() {
                if (window.innerWidth <= 1200) {
                    sidebar.classList.remove('collapsed');
                    sidebar.classList.add('open');
                    toggleIcon.className = 'fas fa-times';
                } else {
                    sidebar.classList.remove('open');
                }
            }
            
            // Initialize mobile menu
            handleMobileMenu();
            window.addEventListener('resize', handleMobileMenu);
            
            // Navigation active state
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // On mobile, close sidebar after clicking a link
                    if (window.innerWidth <= 1200) {
                        sidebar.classList.remove('open');
                        toggleIcon.className = 'fas fa-bars';
                    }
                });
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.zIndex = '102';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.zIndex = 'auto';
            });
            
            // Notification bell click
            const notificationBell = document.querySelector('.notification-bell');
            const notificationCount = document.querySelector('.notification-count');
            
            notificationBell.addEventListener('click', function() {
                // In a real app, this would show notifications
                notificationCount.textContent = '0';
                notificationCount.style.backgroundColor = 'var(--text-light)';
            });
            
            // Demo chart animation
            const chartBars = document.querySelectorAll('.chart-bar');
            chartBars.forEach((bar, index) => {
                // Random height for demo
                const height = Math.floor(Math.random() * 60) + 40;
                bar.style.height = `${height}%`;
                
                // Add animation delay
                bar.style.animationDelay = `${index * 0.1}s`;
            });
            
            // ========== LOGOUT FUNCTIONALITY ==========
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');
            const logoutToast = document.getElementById('logoutToast');
            
            // Show logout modal
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    logoutModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            }
            
            // Close modal when cancel is clicked
            if (cancelLogout) {
                cancelLogout.addEventListener('click', function() {
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                });
            }
            
            // Close modal when clicking outside
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Handle logout confirmation
            if (confirmLogout) {
                confirmLogout.addEventListener('click', function() {
                    // Show toast notification
                    logoutToast.classList.add('show');
                    
                    // Close modal
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                    
                    // Simulate logout process
                    setTimeout(() => {
                        // Show success message
                        setTimeout(() => {
                            // Simulate redirect to login page
                            // In a real application, you would redirect to login page:
                            // window.location.href = '/login.html';
                            
                            // For demo purposes, show alert and reload
                            alert('Anda telah berhasil logout. Dalam aplikasi nyata, Anda akan diarahkan ke halaman login.');
                            
                            // Clear any demo session data
                            localStorage.removeItem('demo_session');
                            sessionStorage.removeItem('demo_session');
                            
                            // Reload page for demo
                            window.location.reload();
                        }, 1500);
                    }, 500);
                });
            }
            
            // Close toast after animation
            if (logoutToast) {
                logoutToast.addEventListener('click', function() {
                    this.classList.remove('show');
                });
                
                // Auto-close toast after progress bar finishes
                setTimeout(() => {
                    if (logoutToast.classList.contains('show')) {
                        logoutToast.classList.remove('show');
                    }
                }, 3000);
            }
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && logoutModal.style.display === 'flex') {
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });
    </script>
</body>
</html>