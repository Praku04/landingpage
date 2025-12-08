<?php 
$current_page = 'home';
$page_title = 'Home';
$body_class = 'homepage';
include 'includes/header.php'; 
?>

<script>
document.body.classList.add('homepage');
</script>

<!-- Hero Section -->
<section class="hero section">
    <div class="container">
        <div class="hero-container">
            <div class="hero-content">
                <span class="hero-badge">Your Career Partner</span>
                <h1 class="hero-title">
                    Build Your <span class="gradient-text">Career</span> With
                    <span class="text-accent">The Management Gurus</span>
                </h1>
                <p class="hero-subtitle">
                    Expert mock interviews, interview preparation, and placement assistance 
                    to help you land positions at top colleges and companies.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">100+</span>
                        <span class="stat-label">Students Placed</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">20+</span>
                        <span class="stat-label">Partner Companies</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                </div>
                <div class="hero-cta">
                    <button class="btn btn-primary open-modal" data-modal="inquiry-modal">
                        Get Started Today
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <a href="about.php" class="btn btn-secondary">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-image-container">
                    <img src="images/hero/heroimage.png" alt="Career Success" class="hero-main-img" loading="eager" fetchpriority="high">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Services Section
<section class="quick-services">
    <div class="container">
        <div class="section-header-center">
            <span class="section-badge">What We Offer</span>
            <h2>Your Complete <span class="gradient-text">Career Solution</span></h2>
        </div>
        <div class="services-quick-grid">
            <a href="services.php#mock-interviews" class="service-quick-card">
                <div class="service-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h3>Mock Interviews</h3>
                <p>Real-world practice with industry experts</p>
                <span class="service-arrow">→</span>
            </a>
            <a href="services.php#counselling" class="service-quick-card">
                <div class="service-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                    </svg>
                </div>
                <h3>Career Counselling</h3>
                <p>Personalized guidance for your path</p>
                <span class="service-arrow">→</span>
            </a>
            <a href="services.php#cat-prep" class="service-quick-card">
                <div class="service-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </div>
                <h3>CAT & Exam Prep</h3>
                <p>Master competitive exams</p>
                <span class="service-arrow">→</span>
            </a>
            <a href="services.php#placement" class="service-quick-card">
                <div class="service-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
                <h3>Placement Support</h3>
                <p>Land your dream job</p>
                <span class="service-arrow">→</span>
            </a>
        </div>
        <div class="section-cta">
            <a href="services.php" class="btn btn-primary">View All Services</a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section 
<section class="why-choose-us">
    <div class="container">
        <div class="why-grid">
            <div class="why-content">
                <span class="section-badge">Why Choose Us</span>
                <h2>Your Success is <span class="text-accent">Our Mission</span></h2>
                <p class="lead-text">
                    We bridge the gap between academic knowledge and industry requirements, 
                    ensuring you're not just educated, but truly employable.
                </p>
                <div class="why-features">
                    <div class="why-feature">
                        <div class="why-icon">✓</div>
                        <div>
                            <h4>Industry Experts</h4>
                            <p>Learn from professionals with real-world experience</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-icon">✓</div>
                        <div>
                            <h4>Proven Track Record</h4>
                            <p>100+ successful placements in top companies</p>
                        </div>
                    </div>
                    <div class="why-feature">
                        <div class="why-icon">✓</div>
                        <div>
                            <h4>Personalized Approach</h4>
                            <p>Tailored guidance for your unique career path</p>
                        </div>
                    </div>
                </div>
                <a href="about.php" class="btn btn-primary">Learn More About Us</a>
            </div>
            <div class="why-visual">
                <div class="why-image-grid">
                    <div class="why-img why-img-1">
                        <img src="images/hero/1668790630107.jpeg" alt="Success Story">
                    </div>
                    <div class="why-img why-img-2">
                        <img src="images/hero/Screenshot_20200216-123516.png" alt="Success Story">
                    </div>
                    <div class="why-img why-img-3">
                        <img src="images/hero/1748776971244.jpeg" alt="Success Story">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- CTA Section - Hidden for single page layout -->
<!-- <section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Start Your Journey?</h2>
            <p>Join 100+ students who have successfully launched their careers with us</p>
            <button class="btn btn-primary btn-lg open-modal" data-modal="inquiry-modal">
                Get Started Now
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</section> -->

<?php include 'includes/footer.php'; ?>
