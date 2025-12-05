// Full-Page Interactive Form - The Management Gurus
// Typeform-style slide-based form with smooth transitions

(function() {
    'use strict';

    // DOM Elements
    const modal = document.getElementById('inquiry-modal');
    const closeBtn = modal?.querySelector('.form-close-btn');
    const slidesContainer = modal?.querySelector('.form-slides-container');
    const progressDots = modal?.querySelectorAll('.progress-dot');
    const prevBtn = modal?.querySelector('.prev-btn');
    const openModalBtns = document.querySelectorAll('.open-modal');

    // Form state
    let currentStep = 0;
    let formData = {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        message: ''
    };

    // Form steps configuration
    const steps = [
        {
            emoji: '👋',
            question: "Hi there! Let's get started. What's your first name?",
            field: 'first_name',
            type: 'text',
            placeholder: 'Type your first name...',
            validation: (value) => {
                if (!value || value.trim().length < 2) {
                    return 'Please enter a valid first name (at least 2 characters)';
                }
                return null;
            }
        },
        {
            emoji: '😊',
            question: "Nice to meet you, {first_name}! What's your last name?",
            field: 'last_name',
            type: 'text',
            placeholder: 'Type your last name...',
            validation: (value) => {
                if (!value || value.trim().length < 2) {
                    return 'Please enter a valid last name (at least 2 characters)';
                }
                return null;
            }
        },
        {
            emoji: '📧',
            question: "Great! What's your email address?",
            field: 'email',
            type: 'email',
            placeholder: 'your.email@example.com',
            validation: (value) => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!value || !emailRegex.test(value)) {
                    return 'Please enter a valid email address';
                }
                return null;
            }
        },
        {
            emoji: '📱',
            question: "Perfect! What's the best phone number to reach you?",
            field: 'phone',
            type: 'tel',
            placeholder: '9876543210',
            validation: (value) => {
                const phoneDigits = value.replace(/[^0-9]/g, '');
                if (!phoneDigits || phoneDigits.length !== 10) {
                    return 'Please enter a valid 10-digit phone number';
                }
                // Check if it starts with valid Indian mobile prefix (6-9)
                if (phoneDigits[0] < '6' || phoneDigits[0] > '9') {
                    return 'Phone number should start with 6, 7, 8, or 9';
                }
                return null;
            }
        },
        {
            emoji: '💬',
            question: "Almost done! Tell us how we can help you.",
            field: 'message',
            type: 'text',
            placeholder: 'I need help with interview preparation...',
            validation: (value) => {
                // Message is optional
                if (value && value.length > 1000) {
                    return 'Message must be less than 1000 characters';
                }
                return null;
            }
        }
    ];

    // Initialize form
    function initForm() {
        currentStep = 0;
        formData = {
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            message: ''
        };
        
        if (slidesContainer) {
            slidesContainer.innerHTML = '';
        }
        
        updateProgressDots();
        renderSlide(currentStep);
        updateNavigation();
    }

    // Render a slide
    function renderSlide(stepIndex) {
        if (stepIndex >= steps.length) {
            return;
        }
        
        const step = steps[stepIndex];
        const slideDiv = document.createElement('div');
        slideDiv.className = 'form-slide active';
        slideDiv.dataset.step = stepIndex;
        
        // Replace placeholders with actual values
        let questionText = step.question;
        Object.keys(formData).forEach(key => {
            questionText = questionText.replace(`{${key}}`, formData[key]);
        });
        
        slideDiv.innerHTML = `
            <div class="slide-content">
                <span class="slide-number">Question ${stepIndex + 1} of ${steps.length}</span>
                <span class="slide-emoji">${step.emoji}</span>
                <h2 class="slide-question">${questionText}</h2>
                <div class="slide-input-container">
                    <div class="slide-input-wrapper">
                        <input 
                            type="${step.type}" 
                            class="slide-input" 
                            placeholder="${step.placeholder}"
                            value="${formData[step.field] || ''}"
                            autocomplete="off"
                            autofocus
                        >
                    </div>
                    <div class="input-hint">
                        Press <span class="enter-key">Enter ↵</span> to continue
                    </div>
                    <span class="form-error-inline"></span>
                </div>
            </div>
        `;
        
        slidesContainer.appendChild(slideDiv);
        
        // Add event listeners
        const input = slideDiv.querySelector('.slide-input');
        const errorSpan = slideDiv.querySelector('.form-error-inline');
        
        // Focus input
        setTimeout(() => input.focus(), 100);
        
        // Handle Enter key
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleNext(input.value, step, errorSpan);
            }
        });
        
        // Clear error on input
        input.addEventListener('input', () => {
            errorSpan.textContent = '';
        });
    }

    // Handle next step
    function handleNext(value, step, errorSpan) {
        // Validate
        const error = step.validation(value);
        if (error) {
            errorSpan.textContent = error;
            return;
        }
        
        // Save data
        formData[step.field] = value.trim();
        
        // Mark current dot as completed
        if (progressDots[currentStep]) {
            progressDots[currentStep].classList.add('completed');
        }
        
        // Move to next step
        currentStep++;
        
        if (currentStep >= steps.length) {
            // Submit form
            submitForm();
        } else {
            // Transition to next slide
            transitionSlide('next');
        }
    }

    // Transition between slides
    function transitionSlide(direction) {
        const currentSlide = slidesContainer.querySelector('.form-slide.active');
        
        if (currentSlide) {
            currentSlide.classList.remove('active');
            currentSlide.classList.add(direction === 'next' ? 'prev' : 'next');
            
            setTimeout(() => {
                currentSlide.remove();
            }, 600);
        }
        
        updateProgressDots();
        renderSlide(currentStep);
        updateNavigation();
    }

    // Update progress dots
    function updateProgressDots() {
        progressDots.forEach((dot, index) => {
            dot.classList.remove('active');
            if (index === currentStep) {
                dot.classList.add('active');
            }
        });
    }

    // Update navigation buttons
    function updateNavigation() {
        if (prevBtn) {
            prevBtn.style.display = currentStep > 0 ? 'flex' : 'none';
        }
    }

    // Handle previous step
    function handlePrevious() {
        if (currentStep > 0) {
            currentStep--;
            
            // Remove completed status from current dot
            if (progressDots[currentStep]) {
                progressDots[currentStep].classList.remove('completed');
            }
            
            transitionSlide('prev');
        }
    }

    // Submit form to backend
    async function submitForm() {
        // Show loading slide
        showLoadingSlide();
        
        try {
            // Prepare form data for backend
            const submitData = new FormData();
            submitData.append('full_name', `${formData.first_name} ${formData.last_name}`);
            submitData.append('email', formData.email);
            submitData.append('phone', formData.phone);
            submitData.append('message', formData.message || '');
            
            const response = await fetch('php/submit-inquiry.php', {
                method: 'POST',
                body: submitData
            });
            
            // Remove loading slide
            const loadingSlide = slidesContainer.querySelector('.loading-slide');
            if (loadingSlide) {
                loadingSlide.remove();
            }
            
            // Check if response is ok
            if (!response.ok) {
                console.error('Server error:', response.status, response.statusText);
                showErrorSlide(`Server error: ${response.status}`);
                return;
            }
            
            // Try to parse JSON
            let result;
            try {
                result = await response.json();
            } catch (parseError) {
                console.error('JSON parse error:', parseError);
                const text = await response.text();
                console.error('Response text:', text);
                showErrorSlide('Invalid server response');
                return;
            }
            
            if (result.success) {
                showSuccessSlide();
            } else {
                console.error('Submission failed:', result);
                showErrorSlide(result.message || 'Submission failed');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            
            // Remove loading slide
            const loadingSlide = slidesContainer.querySelector('.loading-slide');
            if (loadingSlide) {
                loadingSlide.remove();
            }
            
            showErrorSlide(error.message || 'Network error');
        }
    }

    // Show loading slide
    function showLoadingSlide() {
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'form-slide active loading-slide';
        
        loadingDiv.innerHTML = `
            <div class="slide-content">
                <span class="slide-emoji">⏳</span>
                <h2 class="slide-question">Submitting your inquiry...</h2>
                <div style="margin-top: 2rem;">
                    <div class="typing-dots" style="display: inline-flex; padding: 1rem 2rem; background: rgba(255,255,255,0.2); border-radius: 50px;">
                        <span class="typing-dot" style="width: 12px; height: 12px; background: white; border-radius: 50%; animation: typingBounce 1.4s infinite;"></span>
                        <span class="typing-dot" style="width: 12px; height: 12px; background: white; border-radius: 50%; animation: typingBounce 1.4s infinite; animation-delay: 0.2s; margin-left: 8px;"></span>
                        <span class="typing-dot" style="width: 12px; height: 12px; background: white; border-radius: 50%; animation: typingBounce 1.4s infinite; animation-delay: 0.4s; margin-left: 8px;"></span>
                    </div>
                </div>
            </div>
        `;
        
        slidesContainer.appendChild(loadingDiv);
    }

    // Show success slide
    function showSuccessSlide() {
        const successDiv = document.createElement('div');
        successDiv.className = 'form-slide active success-slide';
        
        successDiv.innerHTML = `
            <div class="slide-content">
                <div class="success-animation">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <h3>Thank You, ${formData.first_name}! 🎉</h3>
                <p>Your inquiry has been submitted successfully. We'll get back to you within 24 hours at ${formData.email}</p>
                <button class="btn btn-primary" onclick="document.getElementById('inquiry-modal').classList.remove('active'); document.body.style.overflow = '';">Close</button>
            </div>
        `;
        
        slidesContainer.appendChild(successDiv);
        
        // Hide navigation
        if (prevBtn) prevBtn.style.display = 'none';
        
        // Update all dots to completed
        progressDots.forEach(dot => dot.classList.add('completed'));
    }

    // Show error slide
    function showErrorSlide(errorMessage = '') {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'form-slide active success-slide';
        
        const errorDetails = errorMessage ? `<p style="font-size: 14px; color: #EF4444; margin-top: 10px;">Error: ${errorMessage}</p>` : '';
        
        errorDiv.innerHTML = `
            <div class="slide-content">
                <span class="slide-emoji">😔</span>
                <h3>Oops! Something went wrong</h3>
                <p>We couldn't submit your inquiry. Please try again or contact us directly at info@themanagementgurus.com</p>
                ${errorDetails}
                <button class="btn btn-primary" onclick="location.reload()">Try Again</button>
            </div>
        `;
        
        slidesContainer.appendChild(errorDiv);
        
        // Hide navigation
        if (prevBtn) prevBtn.style.display = 'none';
    }

    // Open modal
    function openModal() {
        if (!modal) return;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Initialize form
        initForm();
    }

    // Close modal
    function closeModal() {
        if (!modal) return;
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Event Listeners
    openModalBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });
    });

    closeBtn?.addEventListener('click', closeModal);
    prevBtn?.addEventListener('click', handlePrevious);

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal?.classList.contains('active')) {
            closeModal();
        }
    });

    // Progress dot click navigation
    progressDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            if (index < currentStep) {
                // Allow going back to previous steps
                currentStep = index;
                transitionSlide('prev');
            }
        });
    });
})();
