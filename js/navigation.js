// Navigation JavaScript - The Management Gurus
// Bottom nav and scroll detection

(function() {
    'use strict';

    const bottomNav = document.querySelector('.bottom-nav');
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id], footer[id]');

    // Set active navigation link
    function setActiveNav(sectionId) {
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            }
        });
    }

    // Intersection Observer for scroll detection
    const observerOptions = {
        root: null,
        rootMargin: '-40% 0px -40% 0px',
        threshold: 0
    };

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const sectionId = entry.target.getAttribute('id');
                setActiveNav(sectionId);
            }
        });
    }, observerOptions);

    // Observe all sections
    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // Smooth scroll on nav link click (only for anchor links, not page links)
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            
            // Only prevent default for anchor links (starting with #)
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const targetId = href.substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    setActiveNav(targetId);
                    
                    // Scroll the clicked nav item into view (for mobile horizontal scroll)
                    link.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            }
            // For page links (.php files), let the default behavior happen
        });
    });

    // Show/hide nav based on scroll position (only if bottomNav exists)
    if (bottomNav) {
        let ticking = false;

        function updateNavVisibility() {
            const heroSection = document.getElementById('hero');
            const heroBottom = heroSection ? heroSection.offsetHeight : 0;
            
            if (window.scrollY > heroBottom * 0.3) {
                bottomNav.classList.add('visible');
            } else {
                bottomNav.classList.remove('visible');
            }
            ticking = false;
        }

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateNavVisibility);
                ticking = true;
            }
        });

        // Initial check
        updateNavVisibility();
    }
    
    // Set first link as active initially (only for bottom nav)
    if (bottomNav && navLinks.length > 0) {
        navLinks[0].classList.add('active');
    }
})();
