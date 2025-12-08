<?php 
$current_page = 'services';
$page_title = 'Our Services';
include 'includes/header.php'; 
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="page-header-content">
            <span class="page-badge">Our Services</span>
            <h1>Comprehensive <span class="gradient-text">Career Services</span></h1>
            <p>Everything you need to succeed in your management career</p>
        </div>
    </div>
</section>

<!-- Services Content -->
<section class="services-modern-section">
    <div class="container">
        
        <div class="services-modern-grid">
            <!-- Mock Interviews -->
            <div class="service-modern-card">
                <div class="service-modern-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <h3>Mock Interview Sessions</h3>
                <p>Industry-standard mock interviews with real-time feedback to build confidence and improve your performance.</p>
                <ul class="service-modern-features">
                    <li>One-on-one sessions with industry experts</li>
                    <li>Real-world interview scenarios</li>
                    <li>Detailed feedback and improvement plan</li>
                    <li>Technical and HR interview practice</li>
                </ul>
                <div class="service-modern-stats">
                    <div class="stat-mini">
                        <span class="stat-mini-number">95%</span>
                        <span class="stat-mini-label">Success Rate</span>
                    </div>
                    <div class="stat-mini">
                        <span class="stat-mini-number">500+</span>
                        <span class="stat-mini-label">Sessions</span>
                    </div>
                </div>
                <button class="btn btn-primary open-modal" data-modal="inquiry-modal">Book Now</button>
            </div>

            <!-- Career Counselling -->
            <div class="service-modern-card featured">
                <div class="featured-badge-service">Most Popular</div>
                <div class="service-modern-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Career Counselling</h3>
                <p>Personalized guidance on college selection, fee structures, career prospects, and choosing the right specialization.</p>
                <ul class="service-modern-features">
                    <li>College selection guidance</li>
                    <li>Fee structure analysis and ROI</li>
                    <li>Specialization recommendations</li>
                    <li>Career path planning</li>
                </ul>
                <div class="service-modern-stats">
                    <div class="stat-mini">
                        <span class="stat-mini-number">100+</span>
                        <span class="stat-mini-label">Students</span>
                    </div>
                    <div class="stat-mini">
                        <span class="stat-mini-number">20+</span>
                        <span class="stat-mini-label">Colleges</span>
                    </div>
                </div>
                <button class="btn btn-primary open-modal" data-modal="inquiry-modal">Get Started</button>
            </div>

            <!-- Placement Support -->
            <div class="service-modern-card">
                <div class="service-modern-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
                <h3>Placement Support</h3>
                <p>End-to-end placement assistance from resume building to final offer negotiation.</p>
                <ul class="service-modern-features">
                    <li>Resume and cover letter optimization</li>
                    <li>LinkedIn profile enhancement</li>
                    <li>Company-specific preparation</li>
                    <li>Salary negotiation guidance</li>
                </ul>
                <div class="service-modern-stats">
                    <div class="stat-mini">
                        <span class="stat-mini-number">100+</span>
                        <span class="stat-mini-label">Placements</span>
                    </div>
                    <div class="stat-mini">
                        <span class="stat-mini-number">50+</span>
                        <span class="stat-mini-label">Companies</span>
                    </div>
                </div>
                <button class="btn btn-primary open-modal" data-modal="inquiry-modal">Apply Now</button>
            </div>
        </div>

        <!-- Scholarship & Lucky Draw Section -->
        <div class="opportunities-section">
            <h2 class="section-title-center">Special Opportunities</h2>
            
            <div class="opportunities-grid">
                <!-- Scholarship Programme -->
                <div class="opportunity-card">
                    <div class="opportunity-icon">🎓</div>
                    <h3>Scholarship Programme</h3>
                    <p>Test your knowledge and win scholarships through our online quiz competition.</p>
                    <a href="auth/login.php" class="btn btn-secondary">Apply for Scholarship</a>
                </div>

                <!-- Lucky Draw -->
                <div class="opportunity-card highlight">
                    <div class="opportunity-icon">🎁</div>
                    <h3>Weekly Lucky Draw</h3>
                    <p>Every week, first 100 applicants enter our lucky draw. Winners announced via email or phone.</p>
                    <a href="auth/login.php" class="btn btn-primary">Enter Lucky Draw</a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Pricing Teaser -->
<section class="pricing-teaser">
    <div class="container">
        <div class="pricing-teaser-content">
            <h2>Flexible Packages for Every Need</h2>
            <p>Choose from individual services or comprehensive packages</p>
            <button class="btn btn-primary btn-lg open-modal" data-modal="inquiry-modal">
                Get Custom Quote
            </button>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
