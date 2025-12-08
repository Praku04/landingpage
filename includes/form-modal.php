<!-- Modern Contact Form Modal -->
<div id="inquiry-modal" class="modern-form-modal">
    <div class="modern-form-overlay"></div>
    
    <div class="modern-form-container">
        <!-- Close Button -->
        <button class="modern-form-close" aria-label="Close form">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        
        <!-- Form Header -->
        <div class="modern-form-header">
            <div class="form-header-icon">✨</div>
            <h2>Let's Start Your Journey</h2>
            <p>Fill in your details and we'll get back to you within 24 hours</p>
        </div>
        
        <!-- Form Content -->
        <form id="tmg-contact-form" class="modern-form-content">
            <div class="form-row">
                <div class="modern-form-group">
                    <label for="student-name">Your Name *</label>
                    <input type="text" id="student-name" name="name" required placeholder="Enter your full name">
                </div>
                
                <div class="modern-form-group">
                    <label for="student-email">Email Address *</label>
                    <input type="email" id="student-email" name="email" required placeholder="your.email@example.com">
                </div>
            </div>
            
            <div class="form-row">
                <div class="modern-form-group">
                    <label for="student-phone">Phone Number *</label>
                    <input type="tel" id="student-phone" name="phone" required placeholder="+91 98765 43210">
                </div>
                
                <div class="modern-form-group">
                    <label for="student-location">Location *</label>
                    <input type="text" id="student-location" name="location" required placeholder="City, State">
                </div>
            </div>
            
            <div class="form-row">
                <div class="modern-form-group">
                    <label for="father-name">Father's Name</label>
                    <input type="text" id="father-name" name="father_name" placeholder="Enter father's name">
                </div>
                
                <div class="modern-form-group">
                    <label for="father-phone">Father's Phone Number</label>
                    <input type="tel" id="father-phone" name="father_phone" placeholder="+91 98765 43210">
                </div>
            </div>
            
            <div class="modern-form-group full-width">
                <label for="student-query">Your Query / Message *</label>
                <textarea id="student-query" name="query" required rows="4" placeholder="Tell us about your goals, questions, or how we can help you..."></textarea>
            </div>
            
            <div class="modern-form-actions">
                <button type="submit" class="btn btn-primary btn-lg modern-submit-btn">
                    Submit Application
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            
            <div class="form-success-message" style="display: none;">
                <div class="success-icon">✓</div>
                <h3>Thank You!</h3>
                <p>Your application has been submitted successfully. We'll contact you soon.</p>
            </div>
            
            <div class="form-error-message" style="display: none;">
                <p>Something went wrong. Please try again.</p>
            </div>
        </form>
    </div>
</div>
