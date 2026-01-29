// Toggle password visibility
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.className = 'fas fa-eye';
            } else {
                icon.className = 'fas fa-eye-slash';
            }
        });
    }
    
    // Form submission loading state
    const loginForm = document.getElementById('loginForm');
    const loginBtn = loginForm ? loginForm.querySelector('.login-btn') : null;
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const role = document.getElementById('role').value;
            if (!role) {
                e.preventDefault();
                alert('Silakan pilih peran login terlebih dahulu');
                return false;
            }
            
            // Add loading state
            if (loginBtn) {
                loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                loginBtn.disabled = true;
            }
            
            // Form will submit normally via Laravel
            return true;
        });
    }
    
    // Input focus effects
    const inputs = document.querySelectorAll('.input-field');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});