// Service Booking JavaScript

function openBookingModal(serviceType) {
    const modal = document.getElementById('bookingModal');
    const serviceTypeInput = document.getElementById('serviceType');
    const modalTitle = document.getElementById('modalTitle');
    
    serviceTypeInput.value = serviceType;
    modalTitle.textContent = 'Book ' + serviceType.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    
    modal.classList.add('active');
}

function closeBookingModal() {
    const modal = document.getElementById('bookingModal');
    modal.classList.remove('active');
    document.getElementById('bookingForm').reset();
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageDiv = this.querySelector('.form-message');
            const submitBtn = this.querySelector('.btn-submit-booking');
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Booking...';
            
            try {
                const response = await fetch('../php/book_service.php', {
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
                    submitBtn.textContent = 'Confirm Booking';
                }
            } catch (error) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'An error occurred. Please try again.';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Confirm Booking';
            }
        });
    }
});
