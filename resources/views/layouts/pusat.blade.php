<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Sistem Distribusi PT. Mardua Holong')</title>
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
    @stack('styles')
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
    @include('partials.sidebarpusat')
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="page-title">@yield('page-title', 'Dashboard Utama')</div>
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
            
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.addEventListener('focus', function() {
                    this.parentElement.style.zIndex = '102';
                });
                
                searchInput.addEventListener('blur', function() {
                    this.parentElement.style.zIndex = 'auto';
                });
            }
            
            // Notification bell click
            const notificationBell = document.querySelector('.notification-bell');
            const notificationCount = document.querySelector('.notification-count');
            
            if (notificationBell && notificationCount) {
                notificationBell.addEventListener('click', function() {
                    // In a real app, this would show notifications
                    notificationCount.textContent = '0';
                    notificationCount.style.backgroundColor = 'var(--text-light)';
                });
            }
            
            // ========== LOGOUT FUNCTIONALITY ==========
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');
            const logoutToast = document.getElementById('logoutToast');
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
                    // Show toast notification
                    logoutToast.classList.add('show');
                    
                    // Close modal
                    logoutModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                    
                    // Submit logout form after delay
                    setTimeout(() => {
                        if (logoutForm) {
                            logoutForm.submit();
                        }
                    }, 1500);
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
        });
    </script>
    
    @stack('scripts')
</body>
</html>