<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajer Lapangan - PT. Mardua Holong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2D6A4F;
            --primary-light: #40916C;
            --primary-lighter: #E8F5F0;
            --secondary: #FF8C42;
            --secondary-light: #FFB884;
            --text-dark: #1A237E;
            --text-light: #546E7A;
            --text-lighter: #90A4AE;
            --bg-light: #F5F7FA;
            --border: #CFD8DC;
            --white: #FFFFFF;
            --success: #4CAF50;
            --warning: #FFC107;
            --danger: #F44336;
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
            background: linear-gradient(135deg, #FF9800 0%, #FFB74D 100%);
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
        
        .user-location {
            font-size: 12px;
            color: var(--secondary);
            font-weight: 500;
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
        
        /* Input badge for pending inputs */
        .input-badge {
            background-color: var(--success);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 20px;
            text-align: center;
        }
        
        /* Logout button specific styles */
        #logoutBtn .nav-icon {
            color: #F44336;
        }
        
        #logoutBtn:hover {
            background-color: #FFEBEE;
            color: #F44336;
        }
        
        #logoutBtn:hover .nav-icon {
            color: #F44336;
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
        
        .page-subtitle {
            font-size: 14px;
            color: var(--text-light);
            margin-left: 10px;
            font-weight: 400;
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
            width: 250px;
            background-color: var(--bg-light);
            transition: var(--transition);
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary);
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
        
        /* Stat Cards */
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
        
        /* Input Forms */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.1);
        }
        
        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            background-color: white;
            cursor: pointer;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-light);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: var(--secondary-light);
        }
        
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #45a049;
        }
        
        .btn-block {
            width: 100%;
        }
        
        /* File Upload */
        .file-upload {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .file-upload:hover {
            border-color: var(--primary);
            background-color: var(--primary-lighter);
        }
        
        .file-upload i {
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .file-upload-text {
            font-size: 14px;
            color: var(--text-light);
        }
        
        /* Activity List */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background-color: var(--bg-light);
            border-radius: 8px;
        }
        
        .activity-icon {
            width: 36px;
            height: 36px;
            background-color: var(--primary-lighter);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 16px;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
        }
        
        .activity-time {
            font-size: 12px;
            color: var(--text-light);
        }
        
        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }
        
        .status-verified {
            background-color: #D4EDDA;
            color: #155724;
        }
        
        .status-rejected {
            background-color: #F8D7DA;
            color: #721C24;
        }
        
        /* Quick Input Cards */
        .quick-input-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            transition: var(--transition);
            cursor: pointer;
        }
        
        .quick-input-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }
        
        .quick-input-icon {
            width: 50px;
            height: 50px;
            background-color: var(--primary-lighter);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 22px;
            margin-bottom: 15px;
        }
        
        .quick-input-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }
        
        .quick-input-desc {
            font-size: 13px;
            color: var(--text-light);
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
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
        }
        
        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .modal-body {
            padding: 20px;
            max-height: 60vh;
            overflow-y: auto;
        }
        
        .modal-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
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
            
            .page-subtitle {
                display: none;
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
            
            .header-actions {
                gap: 10px;
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
                <h3 class="modal-title">Konfirmasi Logout</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin keluar dari sistem?</p>
            </div>
            <div class="modal-footer">
                <button class="btn" id="cancelLogout">Batal</button>
                <button class="btn btn-primary" id="confirmLogout">Ya, Logout</button>
            </div>
        </div>
    </div>
    
    <!-- Form Logout Laravel -->
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
            <div class="avatar">ML</div>
            <div class="user-info">
                <div class="user-name">Manajer Lapangan</div>
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
                        <a href="#" class="nav-link active">
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
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <span class="nav-text">Input Harga Pembelian</span>
                            <span class="input-badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-seedling"></i></span>
                            <span class="nav-text">Input Data Panen</span>
                            <span class="input-badge">5</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-box"></i></span>
                            <span class="nav-text">Input Data Pengemasan</span>
                            <span class="input-badge">2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
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
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-sync-alt"></i></span>
                            <span class="nav-text">Update Status Distribusi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-camera"></i></span>
                            <span class="nav-text">Upload Bukti Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
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
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                            <span class="nav-text">Data Petani & Ladang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
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
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div>
                <div class="page-title">Dashboard Lapangan <span class="page-subtitle">Berastagi</span></div>
                <div style="font-size: 14px; color: var(--text-light);">Selamat datang, Manajer Lapangan</div>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari data atau petani...">
                </div>
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">8</span>
                </div>
            </div>
        </header>
        
        <!-- Content -->
        <div class="content-wrapper">
            <!-- Statistik Cards -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-title">
                        <span>Panen Hari Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                    </div>
                    <div class="stat-number">1,850 kg</div>
                    <div class="stat-label">Dari 8 ladang aktif</div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Pembelian Tertunda</span>
                        <div class="card-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <div class="stat-number">3</div>
                    <div class="stat-label">Menunggu verifikasi pusat</div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Pengiriman Aktif</span>
                        <div class="card-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                    <div class="stat-number">4</div>
                    <div class="stat-label">Dalam perjalanan</div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Cuaca Hari Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-cloud-sun"></i>
                        </div>
                    </div>
                    <div class="stat-number">Cerah</div>
                    <div class="stat-label">Suhu: 24°C, Kelembapan: 75%</div>
                </div>
            </div>
            
            <!-- Quick Input Section -->
            <div class="content-grid">
                <div class="content-card" style="grid-column: span 3;">
                    <div class="card-title">
                        <span>Input Data Cepat</span>
                        <div class="card-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 15px;">
                        <!-- Harga Pembelian -->
                        <div class="quick-input-card" id="inputHarga">
                            <div class="quick-input-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="quick-input-title">Input Harga Pembelian</div>
                            <div class="quick-input-desc">Catat harga beli jeruk dari petani</div>
                        </div>
                        
                        <!-- Data Panen -->
                        <div class="quick-input-card" id="inputPanen">
                            <div class="quick-input-icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="quick-input-title">Input Data Panen</div>
                            <div class="quick-input-desc">Catat hasil panen per ladang</div>
                        </div>
                        
                        <!-- Pengemasan -->
                        <div class="quick-input-card" id="inputPengemasan">
                            <div class="quick-input-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="quick-input-title">Input Pengemasan</div>
                            <div class="quick-input-desc">Data packing & kualitas jeruk</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Form Input Harga (Hidden by default) -->
            <div class="content-card" id="hargaForm" style="display: none;">
                <div class="card-title">
                    <span>Form Input Harga Pembelian Jeruk</span>
                    <button class="btn" onclick="closeForm('hargaForm')">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                </div>
                <form id="formHarga">
                    <div class="form-group">
                        <label class="form-label">Tanggal Pembelian</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pilih Petani</label>
                        <select class="form-select" required>
                            <option value="">-- Pilih Petani --</option>
                            <option value="1">Sitorus - Ladang Simalungun</option>
                            <option value="2">Sinaga - Ladang Berastagi</option>
                            <option value="3">Sihombing - Ladang Kabanjahe</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Harga per Kg (Rp)</label>
                        <input type="number" class="form-control" placeholder="Contoh: 12000" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Jumlah (Kg)</label>
                        <input type="number" class="form-control" placeholder="Contoh: 500" step="0.1" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Kualitas Jeruk</label>
                        <select class="form-select" required>
                            <option value="A">A (Terbaik)</option>
                            <option value="B">B (Baik)</option>
                            <option value="C">C (Standar)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Upload Bukti Pembelian</label>
                        <div class="file-upload">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-upload-text">Klik untuk upload foto kwitansi</div>
                            <input type="file" accept="image/*" style="display: none;">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-paper-plane"></i> Kirim ke Pusat
                    </button>
                </form>
            </div>
            
            <!-- Form Input Panen (Hidden by default) -->
            <div class="content-card" id="panenForm" style="display: none;">
                <div class="card-title">
                    <span>Form Input Data Panen</span>
                    <button class="btn" onclick="closeForm('panenForm')">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                </div>
                <form id="formPanen">
                    <div class="form-group">
                        <label class="form-label">Tanggal Panen</label>
                        <input type="datetime-local" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Ladang</label>
                        <select class="form-select" required>
                            <option value="">-- Pilih Ladang --</option>
                            <option value="1">Ladang Simalungun (Petani Sitorus)</option>
                            <option value="2">Ladang Berastagi (Petani Sinaga)</option>
                            <option value="3">Ladang Kabanjahe (Petani Sihombing)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Batch Panen</label>
                        <input type="text" class="form-control" placeholder="Contoh: PAN-2024-001" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Jumlah Panen (Kg)</label>
                        <input type="number" class="form-control" placeholder="Contoh: 850" step="0.1" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Kualitas</label>
                        <select class="form-select" required>
                            <option value="A">A (95% bagus)</option>
                            <option value="B">B (80-94% bagus)</option>
                            <option value="C">C (60-79% bagus)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Kondisi Cuaca Saat Panen</label>
                        <select class="form-select" required>
                            <option value="cerah">Cerah</option>
                            <option value="mendung">Mendung</option>
                            <option value="hujan-ringan">Hujan Ringan</option>
                            <option value="hujan-lebat">Hujan Lebat</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Data Panen
                    </button>
                </form>
            </div>
            
            <!-- Aktivitas Terbaru & Rekap -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-title">
                        <span>Aktivitas Hari Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-history"></i>
                        </div>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Input Harga Pembelian</div>
                                <div class="activity-time">Petani Sinaga - 500 kg</div>
                                <span class="status-badge status-pending">Pending</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Data Panen Ladang Simalungun</div>
                                <div class="activity-time">750 kg - Kualitas A</div>
                                <span class="status-badge status-verified">Terverifikasi</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Pengiriman ke Jakarta</div>
                                <div class="activity-time">1.2 ton - Dalam perjalanan</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-cloud-sun"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Laporan Cuaca</div>
                                <div class="activity-time">Cerah, 24°C, Kelembapan 75%</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content-card" style="grid-column: span 2;">
                    <div class="card-title">
                        <span>Rekap Harian Kegiatan</span>
                        <div class="card-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                        <div>
                            <h4 style="margin-bottom: 15px; color: var(--text-dark); font-size: 15px;">Status Verifikasi</h4>
                            <div style="background-color: #D4EDDA; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
                                <div style="font-weight: 600; color: #155724;">Terverifikasi: 8</div>
                                <div style="font-size: 12px; color: #155724;">Data sudah disetujui pusat</div>
                            </div>
                            <div style="background-color: #FFF3CD; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
                                <div style="font-weight: 600; color: #856404;">Pending: 3</div>
                                <div style="font-size: 12px; color: #856404;">Menunggu verifikasi</div>
                            </div>
                            <div style="background-color: #F8D7DA; padding: 15px; border-radius: 8px;">
                                <div style="font-weight: 600; color: #721C24;">Ditolak: 1</div>
                                <div style="font-size: 12px; color: #721C24;">Perlu perbaikan data</div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 style="margin-bottom: 15px; color: var(--text-dark); font-size: 15px;">Target Harian</h4>
                            <div style="margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <span style="font-size: 14px;">Panen (2,000 kg)</span>
                                    <span style="font-weight: 600; color: var(--primary);">92%</span>
                                </div>
                                <div style="height: 8px; background-color: var(--border); border-radius: 4px; overflow: hidden;">
                                    <div style="width: 92%; height: 100%; background-color: var(--success);"></div>
                                </div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <span style="font-size: 14px;">Pengiriman (5 truk)</span>
                                    <span style="font-weight: 600; color: var(--primary);">80%</span>
                                </div>
                                <div style="height: 8px; background-color: var(--border); border-radius: 4px; overflow: hidden;">
                                    <div style="width: 80%; height: 100%; background-color: var(--warning);"></div>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <span style="font-size: 14px;">Input Data (100%)</span>
                                    <span style="font-weight: 600; color: var(--primary);">85%</span>
                                </div>
                                <div style="height: 8px; background-color: var(--border); border-radius: 4px; overflow: hidden;">
                                    <div style="width: 85%; height: 100%; background-color: var(--primary);"></div>
                                </div>
                            </div>
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
            
            // Quick Input Cards
            document.getElementById('inputHarga').addEventListener('click', function() {
                document.getElementById('hargaForm').style.display = 'block';
                document.getElementById('panenForm').style.display = 'none';
                document.getElementById('hargaForm').scrollIntoView({ behavior: 'smooth' });
            });
            
            document.getElementById('inputPanen').addEventListener('click', function() {
                document.getElementById('panenForm').style.display = 'block';
                document.getElementById('hargaForm').style.display = 'none';
                document.getElementById('panenForm').scrollIntoView({ behavior: 'smooth' });
            });
            
            document.getElementById('inputPengemasan').addEventListener('click', function() {
                alert('Fitur Input Pengemasan akan segera tersedia!');
            });
            
            // Form submission
            document.getElementById('formHarga').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Data harga pembelian berhasil dikirim ke pusat!');
                this.reset();
                closeForm('hargaForm');
            });
            
            document.getElementById('formPanen').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Data panen berhasil disimpan!');
                this.reset();
                closeForm('panenForm');
            });
            
            // File upload
            document.querySelector('.file-upload').addEventListener('click', function() {
                this.querySelector('input[type="file"]').click();
            });
            
            // Logout functionality
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');
            const logoutForm = document.getElementById('laravel-logout-form');
            
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
            
            // Handle logout confirmation
            if (confirmLogout) {
                confirmLogout.addEventListener('click', function() {
                    if (logoutForm) {
                        logoutForm.submit();
                    }
                });
            }
            
            // Close modal when clicking outside
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && logoutModal.style.display === 'flex') {
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });
        
        function closeForm(formId) {
            document.getElementById(formId).style.display = 'none';
        }
    </script>
</body>
</html>