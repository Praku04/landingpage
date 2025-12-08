<?php 
$current_page = 'contact';
$page_title = 'Contact Us';
include 'includes/header.php'; 
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="page-header-content">
            <span class="page-badge">Get in Touch</span>
            <h1>Contact <span class="gradient-text">Us</span></h1>
            <p>We're here to help you succeed</p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="contact-simple-section">
    <div class="container">
        <div class="contact-simple-grid">
            <!-- Contact Info Cards -->
            <div class="contact-card-modern">
                <div class="contact-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <h3>Email Us</h3>
                <p>info@themanagementgurus.com</p>
            </div>
            
            <div class="contact-card-modern">
                <div class="contact-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </div>
                <h3>Call Us</h3>
                <p>+91 98765 43210</p>
            </div>
            
            <div class="contact-card-modern">
                <div class="contact-card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3>Visit Us</h3>
                <p>Pune, Maharashtra, India</p>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div class="contact-cta-center">
            <button class="btn btn-primary btn-lg open-modal" data-modal="inquiry-modal">
                Send Us a Message
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
