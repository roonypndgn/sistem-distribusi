<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - PT. Mardua Holong</title>
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
            background: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
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
        
        .user-dept {
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
        
        /* Payment badge */
        .payment-badge {
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
        
        /* Attendance Card */
        .attendance-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .attendance-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .attendance-time {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .attendance-date {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .attendance-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .attendance-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .attendance-btn-in {
            background-color: white;
            color: var(--primary);
        }
        
        .attendance-btn-in:hover {
            background-color: #f8f9fa;
        }
        
        .attendance-btn-out {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .attendance-btn-out:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        /* Form Styles */
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
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
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
        
        /* Buttons */
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
        
        /* Schedule List */
        .schedule-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .schedule-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background-color: var(--bg-light);
            border-radius: 10px;
            border-left: 4px solid var(--primary);
        }
        
        .schedule-day {
            font-weight: 700;
            color: var(--primary);
            min-width: 80px;
            font-size: 14px;
        }
        
        .schedule-time {
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .schedule-desc {
            font-size: 13px;
            color: var(--text-light);
        }
        
        /* Salary Card */
        .salary-card {
            background: linear-gradient(135deg, #FF9800 0%, #FFB74D 100%);
            color: white;
            border-radius: 16px;
            padding: 24px;
        }
        
        .salary-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .salary-amount {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .salary-period {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .salary-detail {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
        }
        
        .salary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .salary-row:last-child {
            margin-bottom: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            padding-top: 8px;
            font-weight: 600;
        }
        
        /* Packing Stats */
        .packing-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        
        .packing-stat {
            background-color: var(--bg-light);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }
        
        .packing-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .packing-label {
            font-size: 12px;
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
        
        /* Progress Bar */
        .progress-bar {
            height: 8px;
            background-color: var(--border);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
        }
        
        .progress-fill {
            height: 100%;
            background-color: var(--primary);
            border-radius: 4px;
            transition: width 0.3s ease;
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
            
            .attendance-actions {
                flex-direction: column;
            }
            
            .packing-stats {
                grid-template-columns: 1fr;
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
            <div class="avatar">KP</div>
            <div class="user-info">
                <div class="user-name">Karyawan Packing</div>
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
                        <a href="#" class="nav-link active">
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
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-fingerprint"></i></span>
                            <span class="nav-text">Absensi Harian</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                            <span class="nav-text">Lihat Jadwal Kerja</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
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
                        <a href="#" class="nav-link">
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
                        <a href="#" class="nav-link">
                            <span class="nav-icon"><i class="fas fa-file-invoice-dollar"></i></span>
                            <span class="nav-text">Lihat Slip Gaji</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
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
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div>
                <div class="page-title">Dashboard Karyawan <span class="page-subtitle">Divisi Packing</span></div>
                <div style="font-size: 14px; color: var(--text-light);">Selamat bekerja, Karyawan!</div>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari riwayat atau gaji...">
                </div>
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">3</span>
                </div>
            </div>
        </header>
        
        <!-- Content -->
        <div class="content-wrapper">
            <!-- Attendance Card -->
            <div class="attendance-card">
                <div class="attendance-title">Absensi Hari Ini</div>
                <div class="attendance-time" id="currentTime">--:--</div>
                <div class="attendance-date" id="currentDate">-- --- ----</div>
                
                <div class="attendance-actions">
                    <button class="attendance-btn attendance-btn-in" id="btnCheckIn">
                        <i class="fas fa-sign-in-alt"></i> CHECK IN
                    </button>
                    <button class="attendance-btn attendance-btn-out" id="btnCheckOut" disabled>
                        <i class="fas fa-sign-out-alt"></i> CHECK OUT
                    </button>
                </div>
            </div>
            
            <!-- Statistik Cards -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-title">
                        <span>Jam Kerja Bulan Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-number">168 jam</div>
                    <div class="stat-label">Target: 176 jam</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 95%"></div>
                    </div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Hasil Packing Hari Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                    <div class="stat-number">245 box</div>
                    <div class="stat-label">Target: 300 box</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 82%"></div>
                    </div>
                </div>
                
                <div class="content-card">
                    <div class="card-title">
                        <span>Gaji Bulan Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <div class="stat-number">Rp 4.2 Jt</div>
                    <div class="stat-label">Akan cair: 25 Des 2024</div>
                </div>
            </div>
            
            <!-- Packing Input & Salary -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-title">
                        <span>Input Hasil Packing</span>
                        <div class="card-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    
                    <form id="packingForm">
                        <div class="form-group">
                            <label class="form-label">Jenis Packing</label>
                            <select class="form-select" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="jeruk-besar">Jeruk Besar (5kg)</option>
                                <option value="jeruk-sedang">Jeruk Sedang (3kg)</option>
                                <option value="jeruk-kecil">Jeruk Kecil (2kg)</option>
                                <option value="premium">Premium Grade A</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Jumlah Box</label>
                            <input type="number" class="form-control" placeholder="Contoh: 50" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Kualitas</label>
                            <select class="form-select" required>
                                <option value="A">A (Sempurna)</option>
                                <option value="B">B (Baik)</option>
                                <option value="C">C (Standar)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" rows="2" placeholder="Masukkan catatan khusus..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Simpan Hasil Packing
                        </button>
                    </form>
                    
                    <div class="packing-stats">
                        <div class="packing-stat">
                            <div class="packing-number">120</div>
                            <div class="packing-label">Box Jeruk Besar</div>
                        </div>
                        <div class="packing-stat">
                            <div class="packing-number">125</div>
                            <div class="packing-label">Box Jeruk Sedang</div>
                        </div>
                    </div>
                </div>
                
                <div class="content-card" style="grid-column: span 2;">
                    <div class="card-title">
                        <span>Detail Gaji & Keuangan</span>
                        <div class="card-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                    
                    <div class="salary-card">
                        <div class="salary-title">Estimasi Gaji Bulan Desember 2024</div>
                        <div class="salary-amount">Rp 4,250,000</div>
                        <div class="salary-period">Periode: 1 - 31 Desember 2024</div>
                        
                        <div class="salary-detail">
                            <div class="salary-row">
                                <span>Gaji Pokok</span>
                                <span>Rp 3,500,000</span>
                            </div>
                            <div class="salary-row">
                                <span>Insentif Packing</span>
                                <span>Rp 750,000</span>
                            </div>
                            <div class="salary-row">
                                <span>Tunjangan Makan</span>
                                <span>Rp 250,000</span>
                            </div>
                            <div class="salary-row">
                                <span>Potongan Pajak</span>
                                <span>- Rp 250,000</span>
                            </div>
                            <div class="salary-row">
                                <span>Total Bersih</span>
                                <span>Rp 4,250,000</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <h4 style="margin-bottom: 15px; color: var(--text-dark); font-size: 15px;">Slip Gaji Terbaru</h4>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Slip Gaji November 2024</div>
                                    <div class="activity-time">Rp 4,150,000 - Sudah dibayar</div>
                                </div>
                                <button class="btn" style="padding: 5px 10px; font-size: 12px;">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Slip Gaji Oktober 2024</div>
                                    <div class="activity-time">Rp 3,950,000 - Sudah dibayar</div>
                                </div>
                                <button class="btn" style="padding: 5px 10px; font-size: 12px;">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Jadwal & Aktivitas -->
            <div class="content-grid">
                <div class="content-card">
                    <div class="card-title">
                        <span>Jadwal Kerja Minggu Ini</span>
                        <div class="card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    
                    <div class="schedule-list">
                        <div class="schedule-item">
                            <div class="schedule-day">Senin</div>
                            <div>
                                <div class="schedule-time">08:00 - 17:00</div>
                                <div class="schedule-desc">Shift Pagi - Area Packing A</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-day">Selasa</div>
                            <div>
                                <div class="schedule-time">08:00 - 17:00</div>
                                <div class="schedule-desc">Shift Pagi - Area Packing A</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-day">Rabu</div>
                            <div>
                                <div class="schedule-time">08:00 - 17:00</div>
                                <div class="schedule-desc">Shift Pagi - Area Packing B</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-day">Kamis</div>
                            <div>
                                <div class="schedule-time">13:00 - 22:00</div>
                                <div class="schedule-desc">Shift Sore - Quality Control</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-day">Jumat</div>
                            <div>
                                <div class="schedule-time">08:00 - 17:00</div>
                                <div class="schedule-desc">Shift Pagi - Area Packing A</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="content-card" style="grid-column: span 2;">
                    <div class="card-title">
                        <span>Aktivitas & Notifikasi</span>
                        <div class="card-icon">
                            <i class="fas fa-history"></i>
                        </div>
                    </div>
                    
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon" style="background-color: #D4EDDA; color: #155724;">
                                <i class="fas fa-money-check-alt"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Pembayaran Gaji November</div>
                                <div class="activity-time">Rp 4,150,000 telah ditransfer ke rekening Anda</div>
                                <div style="font-size: 11px; color: #155724;">2 hari yang lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background-color: #FFF3CD; color: #856404;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Insentif Packing Tambahan</div>
                                <div class="activity-time">Anda mendapatkan bonus Rp 150,000 untuk performa packing bulan lalu</div>
                                <div style="font-size: 11px; color: #856404;">1 minggu yang lalu</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-fingerprint"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Check In Pagi Ini</div>
                                <div class="activity-time">Anda check in pada 07:58 - Tidak terlambat</div>
                                <div style="font-size: 11px; color: var(--text-light);">Hari ini, 07:58</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Target Packing Tercapai</div>
                                <div class="activity-time">Anda telah mencapai 95% target packing minggu ini</div>
                                <div style="font-size: 11px; color: var(--text-light);">Kemarin, 16:30</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px; padding: 15px; background-color: var(--primary-lighter); border-radius: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                            <div>
                                <div style="font-weight: 600; color: var(--text-dark);">Info Penting:</div>
                                <div style="font-size: 13px; color: var(--text-light);">Gaji bulan Desember akan dibayarkan pada tanggal 25 Desember 2024 melalui transfer bank.</div>
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
            
            // Update current time and date
            function updateDateTime() {
                const now = new Date();
                const timeStr = now.toLocaleTimeString('id-ID', { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: false 
                });
                const dateStr = now.toLocaleDateString('id-ID', { 
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                
                document.getElementById('currentTime').textContent = timeStr;
                document.getElementById('currentDate').textContent = dateStr;
            }
            
            // Update time every second
            updateDateTime();
            setInterval(updateDateTime, 1000);
            
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
            
            // Check In / Check Out functionality
            const btnCheckIn = document.getElementById('btnCheckIn');
            const btnCheckOut = document.getElementById('btnCheckOut');
            
            let isCheckedIn = false;
            let checkInTime = null;
            
            btnCheckIn.addEventListener('click', function() {
                if (!isCheckedIn) {
                    isCheckedIn = true;
                    checkInTime = new Date();
                    
                    btnCheckIn.disabled = true;
                    btnCheckIn.innerHTML = '<i class="fas fa-check"></i> SUDAH CHECK IN';
                    btnCheckIn.style.backgroundColor = '#4CAF50';
                    btnCheckIn.style.color = 'white';
                    
                    btnCheckOut.disabled = false;
                    
                    // Show notification
                    showNotification('Check In berhasil dicatat pada ' + checkInTime.toLocaleTimeString('id-ID'));
                    
                    // Update activity list
                    updateActivityList('Check In', checkInTime);
                }
            });
            
            btnCheckOut.addEventListener('click', function() {
                if (isCheckedIn) {
                    const checkOutTime = new Date();
                    const workDuration = Math.round((checkOutTime - checkInTime) / (1000 * 60 * 60)); // in hours
                    
                    isCheckedIn = false;
                    
                    btnCheckIn.disabled = false;
                    btnCheckIn.innerHTML = '<i class="fas fa-sign-in-alt"></i> CHECK IN';
                    btnCheckIn.style.backgroundColor = '';
                    btnCheckIn.style.color = '';
                    
                    btnCheckOut.disabled = true;
                    
                    // Show notification
                    showNotification('Check Out berhasil. Durasi kerja: ' + workDuration + ' jam');
                    
                    // Update activity list
                    updateActivityList('Check Out', checkOutTime);
                }
            });
            
            // Packing form submission
            document.getElementById('packingForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const packingType = this.querySelector('select').value;
                const quantity = this.querySelector('input[type="number"]').value;
                
                showNotification('Hasil packing ' + quantity + ' box berhasil disimpan!');
                this.reset();
                
                // Update packing stats
                updatePackingStats(packingType, parseInt(quantity));
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
            
            // Helper functions
            function showNotification(message) {
                // Create notification element
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 30px;
                    background-color: var(--primary);
                    color: white;
                    padding: 15px 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 1000;
                    animation: slideIn 0.3s ease-out;
                `;
                
                notification.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle"></i>
                        <div>${message}</div>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease-out';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
                
                // Add animation styles
                const style = document.createElement('style');
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                    @keyframes slideOut {
                        from { transform: translateX(0); opacity: 1; }
                        to { transform: translateX(100%); opacity: 0; }
                    }
                `;
                document.head.appendChild(style);
            }
            
            function updateActivityList(activity, time) {
                // In a real app, this would update the server
                console.log(`${activity} at ${time.toLocaleTimeString('id-ID')}`);
            }
            
            function updatePackingStats(type, quantity) {
                // In a real app, this would update the server
                console.log(`Added ${quantity} boxes of ${type} to packing stats`);
            }
        });
    </script>
</body>
</html>