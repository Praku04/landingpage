// Profile Update JavaScript

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageDiv = this.querySelector('.form-message');
            const submitBtn = this.querySelector('.btn-update-profile');
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Updating...';
            
            try {
                const response = await fetch('../php/update_profile.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    messageDiv.className = 'form-message success';
                    messageDiv.textContent = result.message;
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    messageDiv.className = 'form-message error';
                    messageDiv.textContent = result.message;
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Update Profile';
                }
            } catch (error) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'An error occurred. Please try again.';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Update Profile';
            }
        });
    }
});
