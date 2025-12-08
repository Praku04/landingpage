// Authentication JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Register Form
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageDiv = this.querySelector('.form-message');
            const submitBtn = this.querySelector('.btn-auth');
            
            // Validate passwords match
            if (formData.get('password') !== formData.get('confirm_password')) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'Passwords do not match!';
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating Account...';
            
            try {
                const response = await fetch('../php/register_process.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    messageDiv.className = 'form-message success';
                    messageDiv.textContent = result.message;
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                } else {
                    messageDiv.className = 'form-message error';
                    messageDiv.textContent = result.message;
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Create Account';
                }
            } catch (error) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'An error occurred. Please try again.';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Create Account';
            }
        });
    }
    
    // Login Form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageDiv = this.querySelector('.form-message');
            const submitBtn = this.querySelector('.btn-auth');
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Logging in...';
            
            try {
                const response = await fetch('../php/login_process.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    messageDiv.className = 'form-message success';
                    messageDiv.textContent = 'Login successful! Redirecting...';
                    setTimeout(() => {
                        window.location.href = '../dashboard/index.php';
                    }, 1000);
                } else {
                    messageDiv.className = 'form-message error';
                    messageDiv.textContent = result.message;
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Login';
                }
            } catch (error) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'An error occurred. Please try again.';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Login';
            }
        });
    }
});
