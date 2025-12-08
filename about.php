<?php 
$current_page = 'about';
$page_title = 'About Us';
include 'includes/header.php'; 
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="page-header-content">
            <span class="page-badge">About Us</span>
            <h1>Why We Started <span class="gradient-text">The Management Gurus</span></h1>
            <p>Born from personal experience and a deep understanding of the challenges management students face</p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="about-content-section">
    <div class="container">
        <!-- Our Story -->
        <div class="about-story-modern">
            <div class="story-hero">
                <h2>Our Story</h2>
                <p class="story-lead">
                    TMG – The Management Gurus was built on a simple belief: <strong>Great leaders aren't born. They are shaped, guided, and empowered.</strong>
                </p>
            </div>
            
            <div class="story-content-grid">
                <div class="story-card">
                    <div class="story-icon">💼</div>
                    <p>
                        At TMG, we don't just train students — we help them discover the leader inside them.
                    </p>
                </div>
                <div class="story-card">
                    <div class="story-icon">🎯</div>
                    <p>
                        Our journey began with a mission to bridge the gap between raw potential and real-world success. 
                        We realized that thousands of talented individuals lacked direction, mentorship, and platforms that 
                        could launch them into the business world with confidence and clarity.
                    </p>
                </div>
                <div class="story-card">
                    <div class="story-icon">⚡</div>
                    <p>
                        So we created TMG — a place where <strong>Talent becomes Strength, Strength becomes Skill, and Skill becomes Leadership.</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Our Promise -->
        <div class="promise-section">
            <div class="promise-content">
                <h2>Our Promise</h2>
                <p class="promise-lead">
                    TMG is not just an institute or a platform — it is a <strong>movement</strong> that transforms knowledge into action and action into success.
                </p>
                <div class="promise-pillars">
                    <div class="pillar">
                        <span class="pillar-icon">🎓</span>
                        <h4>We Guide</h4>
                    </div>
                    <div class="pillar">
                        <span class="pillar-icon">🤝</span>
                        <h4>We Mentor</h4>
                    </div>
                    <div class="pillar">
                        <span class="pillar-icon">🚀</span>
                        <h4>We Elevate</h4>
                    </div>
                </div>
                <p class="promise-tagline">
                    From the strong foundation <strong>("The")</strong>, to shaping future managers <strong>("Management")</strong>, 
                    and celebrating the achievers <strong>("Gurus")</strong>, TMG is where leaders rise.
                </p>
            </div>
        </div>

        <!-- Core Values -->
        <div class="values-section-modern">
            <h2 class="section-title-center">Our Core Values</h2>
            <div class="values-grid-modern">
                <div class="value-card">
                    <div class="value-icon-modern">💡</div>
                    <h4>Integrity</h4>
                    <p>Honest insights about colleges, placements, and career prospects</p>
                </div>
                <div class="value-card">
                    <div class="value-icon-modern">🤝</div>
                    <h4>Student-First</h4>
                    <p>Every decision we make prioritizes student success</p>
                </div>
                <div class="value-card">
                    <div class="value-icon-modern">📈</div>
                    <h4>Excellence</h4>
                    <p>Committed to delivering the highest quality guidance</p>
                </div>
                <div class="value-card">
                    <div class="value-icon-modern">🌟</div>
                    <h4>Innovation</h4>
                    <p>Staying ahead with modern methodologies</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Transform Your Career?</h2>
            <p>Let's work together to achieve your goals</p>
            <button class="btn btn-primary btn-lg open-modal" data-modal="inquiry-modal">
                Get Started
            </button>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
