<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Management Gurus - Expert mock interviews, interview preparation, and placement assistance for top colleges and companies.">
    <meta name="theme-color" content="#1e40af">
    <title><?php echo isset($page_title) ? $page_title : 'The Management Gurus'; ?> | Mock Interviews & Placement Assistance</title>
    
    <!-- DNS Prefetch & Preconnect for faster external resource loading -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Critical CSS - Inline for instant render -->
    <style>
        :root{--color-primary:#1e40af;--color-primary-dark:#1e3a8a;--color-text-primary:#111827;--color-background:#FFFFFF;--color-surface:#F9FAFB}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
        body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,sans-serif;color:var(--color-text-primary);background:var(--color-background);line-height:1.5;overflow-x:hidden}
        img{max-width:100%;height:auto;display:block}
        .site-header{position:fixed;top:0;left:0;right:0;z-index:1000;background:rgba(255,255,255,0.95);backdrop-filter:blur(20px);box-shadow:0 2px 20px rgba(0,0,0,0.05)}
    </style>
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="css/style.css?v=4.0" as="style">
    <link rel="preload" href="css/homepage.css?v=4.0" as="style">
    
    <!-- Critical Stylesheets - Load immediately -->
    <link rel="stylesheet" href="css/style.css?v=4.0">
    <link rel="stylesheet" href="css/homepage.css?v=4.0">
    
    <!-- Non-Critical Stylesheets - Defer loading -->
    <link rel="stylesheet" href="css/pages.css?v=4.0" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="css/modern-form.css?v=4.0" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="css/animations.css?v=4.0" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="css/responsive.css?v=4.0">
    
    <!-- Fonts - Async load with fallback -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap"></noscript>
</head>
<body>
    <!-- Site Header -->
    <header class="site-header">
        <div class="header-container">
            <!-- Logo -->
            <a href="index.php" class="site-logo">
                <div class="logo-icon">TMG</div>
                <div class="logo-text">
                    <span class="main">The Management Gurus</span>
                    <span class="sub">YOUR CAREER PARTNER</span>
                </div>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="main-nav">
                <a href="index.php" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>
                <a href="about.php" class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>">About</a>
                <a href="services.php" class="nav-link <?php echo ($current_page == 'services') ? 'active' : ''; ?>">Services</a>
                <!-- <a href="roadmap.php" class="nav-link <?php echo ($current_page == 'roadmap') ? 'active' : ''; ?>">Roadmap</a> -->
                <a href="testimonials.php" class="nav-link <?php echo ($current_page == 'testimonials') ? 'active' : ''; ?>">Testimonials</a>
                <!-- <a href="colleges.php" class="nav-link <?php echo ($current_page == 'colleges') ? 'active' : ''; ?>">Colleges</a> -->
                <a href="contact.php" class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>">Contact</a>
                <button class="btn btn-primary open-modal" data-modal="inquiry-modal">Get Started</button>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>
    
    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <a href="index.php" class="mobile-nav-item <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>
        <a href="about.php" class="mobile-nav-item <?php echo ($current_page == 'about') ? 'active' : ''; ?>">About</a>
        <a href="services.php" class="mobile-nav-item <?php echo ($current_page == 'services') ? 'active' : ''; ?>">Services</a>
        <!-- <a href="roadmap.php" class="mobile-nav-item <?php echo ($current_page == 'roadmap') ? 'active' : ''; ?>">Roadmap</a> -->
        <a href="testimonials.php" class="mobile-nav-item <?php echo ($current_page == 'testimonials') ? 'active' : ''; ?>">Testimonials</a>
        <!-- <a href="colleges.php" class="mobile-nav-item <?php echo ($current_page == 'colleges') ? 'active' : ''; ?>">Colleges</a> -->
        <a href="contact.php" class="mobile-nav-item <?php echo ($current_page == 'contact') ? 'active' : ''; ?>">Contact</a>
        <button class="btn btn-primary open-modal" data-modal="inquiry-modal" style="margin-top: 16px; width: 100%;">Get Started</button>
    </nav>
