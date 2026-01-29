<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Distribusi PT. Mardua Holong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2D6A4F;
            --primary-light: #40916C;
            --secondary: #FF8C42;
            --secondary-light: #FFB884;
            --text-dark: #1E3A2C;
            --text-light: #6B7A73;
            --bg-light: #F8FCFA;
            --border: #E2ECE8;
            --white: #FFFFFF;
            --error: #DC2626;
            --success: #10B981;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        /* Layout utama */
        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }
        
        /* Panel kiri - Branding */
        .brand-panel {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        
        /* Header brand */
        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 60px;
        }
        
        .brand-logo {
            width: 48px;
            height: 48px;
            background-color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
        }
        
        .brand-name {
            font-size: 20px;
            font-weight: 700;
        }
        
        .brand-name span {
            color: var(--secondary-light);
        }
        
        /* Konten panel kiri */
        .brand-content {
            max-width: 480px;
        }
        
        .brand-tagline {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        .brand-description {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 40px;
        }
        
        /* Stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 40px;
        }
        
        .stat-item {
            text-align: center;
            padding: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }
        
        .stat-number {
            display: block;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--secondary-light);
        }
        
        .stat-label {
            font-size: 13px;
            opacity: 0.85;
        }
        
        /* Dekorasi minimal */
        .brand-decoration {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            background-color: white;
        }
        
        .decoration-1 {
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
        }
        
        .decoration-2 {
            bottom: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
        }
        
        /* Panel kanan - Form login */
        .login-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
            background-color: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.08);
        }
        
        /* Header form */
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            font-size: 15px;
            color: var(--text-light);
        }
        
        /* Form styling */
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .input-container {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            color: var(--text-dark);
            background-color: var(--bg-light);
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 16px;
            pointer-events: none;
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            cursor: pointer;
            font-size: 16px;
        }
        
        /* Pilihan role */
        .role-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236B7A73' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 14px;
            cursor: pointer;
        }
        
        /* Remember me & forgot password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .remember-checkbox {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }
        
        .remember-label {
            font-size: 14px;
            color: var(--text-light);
            cursor: pointer;
        }
        
        .forgot-password {
            font-size: 14px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .forgot-password:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }
        
        /* Tombol submit */
        .submit-button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .submit-button:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 106, 79, 0.2);
        }
        
        .submit-button:active {
            transform: translateY(0);
        }
        
        /* Error message */
        .error-message {
            font-size: 13px;
            color: var(--error);
            margin-top: 6px;
            display: block;
        }
        
        /* Success message */
        .status-message {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border-left: 4px solid var(--success);
        }
        
        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            color: var(--text-light);
            font-size: 14px;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--border);
        }
        
        .divider-text {
            padding: 0 16px;
        }
        
        /* System features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background-color: rgba(64, 145, 108, 0.05);
            border-radius: 8px;
            font-size: 13px;
            color: var(--text-dark);
        }
        
        .feature-icon {
            color: var(--primary);
            font-size: 14px;
        }
        
        /* Responsiveness */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }
            
            .brand-panel {
                padding: 30px;
                min-height: 40vh;
            }
            
            .brand-content {
                max-width: 100%;
            }
            
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }
            
            .stat-item {
                padding: 12px;
            }
        }
        
        @media (max-width: 576px) {
            .brand-panel {
                padding: 24px;
            }
            
            .login-panel {
                padding: 24px;
            }
            
            .login-card {
                padding: 30px 24px;
                box-shadow: none;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .brand-tagline {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Panel kiri: Branding dan informasi -->
        <div class="brand-panel">
            <div>
                <div class="brand-header">
                    <div class="brand-logo">
                        <i class="fas fa-lemon logo" style="color: orange;"></i>
                    </div>
                    <div class="brand-name">PT. <span>Mardua Holong</span></div>
                </div>
                
                <div class="brand-content">
                    <h1 class="brand-tagline">Sistem Distribusi Jeruk Terintegrasi</h1>
                    <p class="brand-description">
                        Mengelola rantai pasok jeruk dari Berastagi ke Jakarta dengan sistem digital yang transparan dan efisien.
                    </p>
                    
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">100+</span>
                            <span class="stat-label">Petani Mitra</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Ton/Tahun</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Tracking</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dekorasi minimal -->
            <div class="brand-decoration decoration-1"></div>
            <div class="brand-decoration decoration-2"></div>
        </div>
        
        <!-- Panel kanan: Form login -->
        <div class="login-panel">
            <div class="login-card">
                <div class="login-header">
                    <h1 class="login-title">Login Sistem</h1>
                    <p class="login-subtitle">Akses dashboard sistem distribusi</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    
                    <!-- Email input -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-container">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" class="form-input" 
                                   placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Password input -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-container">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" class="form-input" 
                                   placeholder="Masukkan password" required>
                            <span class="toggle-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Role selection -->
                    <div class="form-group">
                        <label for="role" class="form-label">Peran Pengguna</label>
                        <div class="input-container">
                            <i class="fas fa-user-tag input-icon"></i>
                            <select id="role" name="role" class="form-input role-select">
                                <option value="">Pilih peran</option>
                                <option value="pusat" {{ old('role') == 'pusat' ? 'selected' : '' }}>Manajemen Pusat (Jakarta)</option>
                                <option value="manajer" {{ old('role') == 'manajer' ? 'selected' : '' }}>Manajer Lapangan (Berastagi)</option>
                                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan Lapangan</option>
                                <option value="petani" {{ old('role') == 'petani' ? 'selected' : '' }}>Petani Mitra</option>
                            </select>
                        </div>
                        @error('role')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Remember me & Forgot password -->
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember" class="remember-checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="remember-label">Ingat saya</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">Lupa password?</a>
                    </div>
                    
                    <!-- Status message -->
                    @if(session('status'))
                        <div class="status-message">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- Submit button -->
                    <button type="submit" class="submit-button" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Sistem
                    </button>
                    
                    <!-- Divider -->
                    <div class="divider">
                        <span class="divider-text">Fitur Sistem</span>
                    </div>
                    
                    <!-- System features -->
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-map-marker-alt feature-icon"></i>
                            <span>Tracking Distribusi</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-chart-line feature-icon"></i>
                            <span>Analisis Produksi</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-file-invoice-dollar feature-icon"></i>
                            <span>Laporan Keuangan</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-users feature-icon"></i>
                            <span>Manajemen SDM</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    const icon = this.querySelector('i');
                    icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
                });
            }
            
            // Form validation and loading state
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const role = document.getElementById('role').value;
                    if (!role) {
                        e.preventDefault();
                        alert('Silakan pilih peran pengguna terlebih dahulu');
                        return false;
                    }
                    
                    if (loginBtn) {
                        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                        loginBtn.disabled = true;
                        loginBtn.style.opacity = '0.8';
                    }
                    
                    return true;
                });
            }
            
            // Input focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const icon = this.parentElement.querySelector('.input-icon');
                    if (icon) {
                        icon.style.color = 'var(--primary)';
                    }
                });
                
                input.addEventListener('blur', function() {
                    const icon = this.parentElement.querySelector('.input-icon');
                    if (icon) {
                        icon.style.color = 'var(--text-light)';
                    }
                });
            });
        });
    </script>
</body>
</html>