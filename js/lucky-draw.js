// Lucky Draw JavaScript

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('luckyDrawForm');
    
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const messageDiv = this.querySelector('.form-message');
            const submitBtn = this.querySelector('.btn-enter-draw');
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Entering...</span>';
            
            try {
                const response = await fetch('../php/enter_lucky_draw.php', {
                    method: 'POST'
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
                    submitBtn.innerHTML = 'Enter Lucky Draw Now <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
                }
            } catch (error) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'An error occurred. Please try again.';
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Enter Lucky Draw Now <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>';
            }
        });
    }
});
