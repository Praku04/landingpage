// Modern Form Handler
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('inquiry-modal');
    const overlay = document.querySelector('.modern-form-overlay');
    const closeBtn = document.querySelector('.modern-form-close');
    const form = document.getElementById('tmg-contact-form');
    const openButtons = document.querySelectorAll('.open-modal');
    
    // Open modal
    openButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        form.reset();
        document.querySelector('.form-success-message').style.display = 'none';
        document.querySelector('.form-error-message').style.display = 'none';
        form.style.display = 'block';
    }
    
    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        // Show loading state
        const submitBtn = form.querySelector('.modern-submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span>Submitting...</span>';
        submitBtn.disabled = true;
        
        // Send to PHP backend
        fetch('php/submit_contact_form.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                form.style.display = 'none';
                document.querySelector('.form-success-message').style.display = 'block';
                
                // Reset after 3 seconds
                setTimeout(() => {
                    closeModal();
                }, 3000);
            } else {
                document.querySelector('.form-error-message').style.display = 'block';
                document.querySelector('.form-error-message').textContent = result.message || 'Failed to submit form';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.querySelector('.form-error-message').style.display = 'block';
            document.querySelector('.form-error-message').textContent = 'An error occurred. Please try again.';
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
    
    // Input animations
    const inputs = form.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});
