<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Karyawan - PT. Mardua Holong')</title>
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
        
        /* ==================== SIDEBAR STYLES ==================== */
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
        
        /* ==================== MAIN CONTENT STYLES ==================== */
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
    @stack('styles')
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
    @include('partials.sidebarkaryawan')
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div>
                <div class="page-title">@yield('page-title', 'Dashboard Karyawan') <span class="page-subtitle">@yield('page-subtitle', 'Divisi Packing')</span></div>
                <div style="font-size: 14px; color: var(--text-light);">@yield('welcome-message', 'Selamat bekerja, Karyawan!')</div>
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
        
        <!-- Content Area -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleSidebar = document.getElementById('toggleSidebar');
            const toggleIcon = toggleSidebar?.querySelector('i');
            
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
                
                const currentTimeEl = document.getElementById('currentTime');
                const currentDateEl = document.getElementById('currentDate');
                
                if (currentTimeEl) currentTimeEl.textContent = timeStr;
                if (currentDateEl) currentDateEl.textContent = dateStr;
            }
            
            // Update time every second
            updateDateTime();
            setInterval(updateDateTime, 1000);
            
            // Toggle sidebar
            if (toggleSidebar && sidebar && toggleIcon) {
                toggleSidebar.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    
                    if (sidebar.classList.contains('collapsed')) {
                        toggleIcon.className = 'fas fa-chevron-right';
                    } else {
                        toggleIcon.className = 'fas fa-chevron-left';
                    }
                });
            }
            
            // Mobile menu toggle
            function handleMobileMenu() {
                if (window.innerWidth <= 1200) {
                    sidebar?.classList.remove('collapsed');
                    sidebar?.classList.add('open');
                    if (toggleIcon) toggleIcon.className = 'fas fa-times';
                } else {
                    sidebar?.classList.remove('open');
                }
            }
            
            // Initialize mobile menu
            handleMobileMenu();
            window.addEventListener('resize', handleMobileMenu);
            
            // Navigation active state
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') === '#') {
                        e.preventDefault();
                    }
                    
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // On mobile, close sidebar after clicking a link
                    if (window.innerWidth <= 1200) {
                        sidebar?.classList.remove('open');
                        if (toggleIcon) toggleIcon.className = 'fas fa-bars';
                    }
                });
            });
            
            // Check In / Check Out functionality
            const btnCheckIn = document.getElementById('btnCheckIn');
            const btnCheckOut = document.getElementById('btnCheckOut');
            
            if (btnCheckIn && btnCheckOut) {
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
                    }
                });
            }
            
            // Packing form submission
            const packingForm = document.getElementById('packingForm');
            if (packingForm) {
                packingForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const packingType = this.querySelector('select').value;
                    const quantity = this.querySelector('input[type="number"]').value;
                    
                    showNotification('Hasil packing ' + quantity + ' box berhasil disimpan!');
                    this.reset();
                });
            }
            
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
            if (logoutModal) {
                logoutModal.addEventListener('click', function(e) {
                    if (e.target === logoutModal) {
                        logoutModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });
            }
            
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && logoutModal.style.display === 'flex') {
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Helper function for notifications
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
                        if (notification.parentNode) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>