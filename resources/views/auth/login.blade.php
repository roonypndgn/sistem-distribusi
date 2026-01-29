<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT. Mardua Holong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2D6A4F;
            --primary-light: #40916C;
            --primary-lighter: #E8F5F0;
            --secondary: #FF8C42;
            --text-dark: #1E293B;
            --text-light: #64748B;
            --text-lighter: #94A3B8;
            --bg-light: #F8FAFC;
            --border: #E2E8F0;
            --white: #FFFFFF;
            --error: #EF4444;
            --success: #10B981;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-light);
            padding: 20px;
            color: var(--text-dark);
        }
        
        /* Main Container */
        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 1200px;
            min-height: 700px;
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        /* Left Panel - Minimal Brand */
        .left-panel {
            background: linear-gradient(135deg, #1E3A2C 0%, #2D6A4F 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        
        .brand-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
        }
        
        .logo {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .brand-text h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 4px;
        }
        
        .brand-text p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .quote-container {
            margin-top: 40px;
            max-width: 400px;
        }
        
        .quote {
            font-size: 20px;
            font-weight: 500;
            color: var(--white);
            line-height: 1.5;
            margin-bottom: 20px;
        }
        
        .author {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .author::before {
            content: "";
            width: 20px;
            height: 1px;
            background: rgba(255, 255, 255, 0.5);
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 40px;
        }
        
        .stat {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .stat-number {
            display: block;
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 4px;
        }
        
        .stat-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Background Elements */
        .bg-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }
        
        .circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
        }
        
        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
        }
        
        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
        }
        
        /* Right Panel - Clean Form */
        .right-panel {
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .form-header {
            margin-bottom: 48px;
            text-align: center;
        }
        
        .form-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }
        
        .form-header p {
            font-size: 16px;
            color: var(--text-light);
            max-width: 400px;
            margin: 0 auto;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .form-input {
            width: 100%;
            padding: 16px 20px 16px 48px;
            font-size: 16px;
            color: var(--text-dark);
            background: var(--bg-light);
            border: 2px solid var(--border);
            border-radius: var(--radius);
            transition: var(--transition);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px var(--primary-lighter);
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 18px;
        }
        
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
            transition: var(--transition);
        }
        
        .toggle-password:hover {
            color: var(--primary);
        }
        
        /* Role Selection */
        .role-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='%2364748B' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            background-size: 16px;
            cursor: pointer;
        }
        
        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        
        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        
        .remember-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid var(--border);
            background: var(--white);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .remember-checkbox:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .remember-label {
            font-size: 14px;
            color: var(--text-light);
            user-select: none;
        }
        
        .forgot-link {
            font-size: 14px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .forgot-link:hover {
            color: var(--primary-light);
        }
        
        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 18px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .submit-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45, 106, 79, 0.2);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        /* Features Grid */
        .features {
            margin-top: 48px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
        }
        
        .features h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-light);
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--primary-lighter);
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .feature:hover {
            transform: translateY(-2px);
            background: #d4e9e0;
        }
        
        .feature-icon {
            width: 32px;
            height: 32px;
            background: var(--white);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 14px;
        }
        
        .feature-text {
            font-size: 13px;
            color: var(--text-dark);
            font-weight: 500;
        }
        
        /* Error Messages */
        .error-message {
            font-size: 13px;
            color: var(--error);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .error-message::before {
            content: "⚠";
            font-size: 12px;
        }
        
        .status-message {
            padding: 16px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: var(--radius);
            font-size: 14px;
            color: var(--success);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .status-message::before {
            content: "✓";
            font-size: 16px;
            font-weight: bold;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 600px;
            }
            
            .left-panel {
                padding: 40px 30px;
            }
            
            .right-panel {
                padding: 40px 30px;
            }
            
            .stats {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .login-wrapper {
                border-radius: 16px;
            }
            
            .left-panel {
                padding: 30px 20px;
            }
            
            .right-panel {
                padding: 30px 20px;
            }
            
            .form-header h2 {
                font-size: 24px;
            }
            
            .stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .right-panel > * {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .right-panel > *:nth-child(2) { animation-delay: 0.1s; }
        .right-panel > *:nth-child(3) { animation-delay: 0.2s; }
        .right-panel > *:nth-child(4) { animation-delay: 0.3s; }
        .right-panel > *:nth-child(5) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Panel: Minimal Branding -->
        <div class="left-panel">
            <div class="bg-elements">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
            </div>
            
            <div class="brand-header">
                <div class="logo">
                    <i class="fas fa-lemon" style="color:orange"></i>
                </div>
                <div class="brand-text">
                    <h1>PT. Mardua Holong</h1>
                    <p>Sistem Distribusi Terintegrasi</p>
                </div>
            </div>
            
            <div class="quote-container">
                <div class="quote">
                    "Menghubungkan kualitas terbaik dari Berastagi ke seluruh Indonesia dengan transparansi digital"
                </div>
                <div class="author">Manajemen Pusat</div>
            </div>
            
            <div class="stats">
                <div class="stat">
                    <span class="stat-number">124</span>
                    <span class="stat-label">Petani Mitra</span>
                </div>
                <div class="stat">
                    <span class="stat-number">850+</span>
                    <span class="stat-label">Ton/Tahun</span>
                </div>
                <div class="stat">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Tracking</span>
                </div>
            </div>
        </div>
        
        <!-- Right Panel: Clean Login Form -->
        <div class="right-panel">
            <div class="form-header">
                <h2>Selamat Datang</h2>
                <p>Masuk untuk mengakses dashboard sistem distribusi</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                
                <!-- Status Message -->
                @if(session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif
                
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="nama@email.com" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                        >
                    </div>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Password Input -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="Masukkan password" 
                            required
                        >
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Role Selection -->
                <div class="form-group">
                    <label for="role" class="form-label">Peran Pengguna</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user-tag input-icon"></i>
                        <select id="role" name="role" class="form-input role-select">
                            <option value="">Pilih peran Anda</option>
                            <option value="pusat" {{ old('role') == 'pusat' ? 'selected' : '' }}>Manajemen Pusat</option>
                            <option value="manajer" {{ old('role') == 'manajer' ? 'selected' : '' }}>Manajer Lapangan</option>
                            <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan Lapangan</option>
                            <option value="supir" {{ old('role') == 'supir' ? 'selected' : '' }}>Supir Logistik</option>
                        </select>
                    </div>
                    @error('role')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Form Options -->
                <div class="form-options">
                    <label class="remember">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="remember-checkbox"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span class="remember-label">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Lupa password?
                    </a>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="submit-btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk ke Sistem
                </button>
            </form>
            
            <!-- Features -->
            <div class="features">
                <h4>Sistem Terintegrasi</h4>
                <div class="features-grid">
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="feature-text">Real-time Tracking</div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="feature-text">Analisis Data</div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="feature-text">Laporan Otomatis</div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-text">Manajemen SDM</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Password Visibility
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
            
            // Form Validation
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const role = document.getElementById('role').value;
                    if (!role) {
                        e.preventDefault();
                        showError('Silakan pilih peran pengguna terlebih dahulu');
                        return false;
                    }
                    
                    // Show loading state
                    if (loginBtn) {
                        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                        loginBtn.disabled = true;
                    }
                    
                    return true;
                });
            }
            
            // Input Focus Effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                const icon = input.parentElement.querySelector('.input-icon');
                
                input.addEventListener('focus', function() {
                    if (icon) icon.style.color = 'var(--primary)';
                    this.style.borderColor = 'var(--primary)';
                });
                
                input.addEventListener('blur', function() {
                    if (icon) icon.style.color = 'var(--text-light)';
                    this.style.borderColor = 'var(--border)';
                });
            });
            
            // Custom checkbox styling
            const checkboxes = document.querySelectorAll('.remember-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    this.style.backgroundColor = this.checked ? 'var(--primary)' : 'var(--white)';
                    this.style.borderColor = this.checked ? 'var(--primary)' : 'var(--border)';
                });
                
                // Initialize state
                checkbox.style.backgroundColor = checkbox.checked ? 'var(--primary)' : 'var(--white)';
                checkbox.style.borderColor = checkbox.checked ? 'var(--primary)' : 'var(--border)';
            });
            
            // Error display function
            function showError(message) {
                // Remove existing error
                const existingError = document.querySelector('.custom-error');
                if (existingError) existingError.remove();
                
                // Create error element
                const errorDiv = document.createElement('div');
                errorDiv.className = 'status-message';
                errorDiv.style.background = 'rgba(239, 68, 68, 0.1)';
                errorDiv.style.borderColor = 'rgba(239, 68, 68, 0.2)';
                errorDiv.style.color = 'var(--error)';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                
                // Insert after form header
                const formHeader = document.querySelector('.form-header');
                if (formHeader) {
                    formHeader.parentNode.insertBefore(errorDiv, formHeader.nextSibling);
                }
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.style.opacity = '0';
                        errorDiv.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            if (errorDiv.parentNode) errorDiv.parentNode.removeChild(errorDiv);
                        }, 300);
                    }
                }, 5000);
            }
            
            // Add CSS for smooth transitions
            const style = document.createElement('style');
            style.textContent = `
                .custom-error {
                    transition: all 0.3s ease;
                }
                .remember-checkbox {
                    transition: var(--transition);
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>