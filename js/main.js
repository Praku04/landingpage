// Main JavaScript - The Management Gurus
// Core functionality initialization

(function() {
    'use strict';

    // Testimonials Carousel
    const carousel = document.querySelector('.testimonials-carousel');
    const track = document.querySelector('.testimonials-track');
    const cards = document.querySelectorAll('.testimonial-card');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    const dots = document.querySelectorAll('.carousel-dots .dot');
    
    let currentIndex = 0;
    const totalCards = cards.length;
    
    function getCardsPerView() {
        if (window.innerWidth < 768) return 1;
        if (window.innerWidth < 1024) return 2;
        return 3;
    }
    
    function updateCarousel() {
        if (!track || !cards.length) return;
        
        const cardsPerView = getCardsPerView();
        const maxIndex = Math.max(0, totalCards - cardsPerView);
        
        if (currentIndex > maxIndex) currentIndex = maxIndex;
        if (currentIndex < 0) currentIndex = 0;
        
        const cardWidth = cards[0].offsetWidth;
        const gap = 24; // var(--space-lg)
        const offset = currentIndex * (cardWidth + gap);
        
        track.style.transform = `translateX(-${offset}px)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex--;
            if (currentIndex < 0) currentIndex = 0;
            updateCarousel();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            const cardsPerView = getCardsPerView();
            const maxIndex = Math.max(0, totalCards - cardsPerView);
            currentIndex++;
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            updateCarousel();
        });
    }
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });
    
    // Handle resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateCarousel, 100);
    });
    
    // Initialize
    updateCarousel();
})();


// Scroll Reveal Animation
(function() {
    'use strict';

    // Add reveal classes to elements
    function addRevealClasses() {
        // Section headers
        document.querySelectorAll('.section-header').forEach(el => {
            el.classList.add('reveal');
        });

        // About section
        const aboutContent = document.querySelector('.about-content');
        const aboutVisual = document.querySelector('.about-visual');
        if (aboutContent) aboutContent.classList.add('reveal-left');
        if (aboutVisual) aboutVisual.classList.add('reveal-right');

        // Roadmap stages
        const roadmapStages = document.querySelector('.roadmap-stages');
        if (roadmapStages) roadmapStages.classList.add('reveal-stagger');

        // Testimonial cards
        document.querySelectorAll('.testimonial-card').forEach(el => {
            el.classList.add('reveal');
        });

        // Pricing cards
        const pricingGrid = document.querySelector('.pricing-grid');
        if (pricingGrid) pricingGrid.classList.add('reveal-stagger');

        // Footer
        const footerGrid = document.querySelector('.footer-grid');
        if (footerGrid) footerGrid.classList.add('reveal');
    }

    // Intersection Observer for scroll reveal
    function initScrollReveal() {
        const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .reveal-stagger');

        if (!revealElements.length) return;

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        revealElements.forEach(el => {
            revealObserver.observe(el);
        });
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            addRevealClasses();
            initScrollReveal();
        });
    } else {
        addRevealClasses();
        initScrollReveal();
    }
})();


// Animated Counter for Stats
(function() {
    'use strict';

    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.floor(current);
                element.classList.add('counting');
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
                element.classList.remove('counting');
            }
        };

        updateCounter();
    }

    // Intersection Observer for counter animation
    const statNumbers = document.querySelectorAll('.stat-number[data-target]');
    
    if (statNumbers.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    animateCounter(entry.target);
                    statsObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        statNumbers.forEach(stat => {
            statsObserver.observe(stat);
        });
    }
})();


// Colleges Carousel
(function() {
    'use strict';

    const carousel = document.querySelector('.colleges-carousel');
    const track = document.querySelector('.colleges-track');
    const cards = document.querySelectorAll('.colleges-track .college-card');
    const prevBtn = document.querySelector('.carousel-prev-college');
    const nextBtn = document.querySelector('.carousel-next-college');
    const dots = document.querySelectorAll('.colleges-dots .dot');
    
    let currentIndex = 0;
    const totalCards = cards.length;
    
    function getCardsPerView() {
        if (window.innerWidth < 768) return 1;
        if (window.innerWidth < 1024) return 2;
        return 3;
    }
    
    function updateCollegeCarousel() {
        if (!track || !cards.length) return;
        
        const cardsPerView = getCardsPerView();
        const maxIndex = Math.max(0, totalCards - cardsPerView);
        
        if (currentIndex > maxIndex) currentIndex = maxIndex;
        if (currentIndex < 0) currentIndex = 0;
        
        const cardWidth = cards[0].offsetWidth;
        const gap = 32; // var(--space-xl)
        const offset = currentIndex * (cardWidth + gap);
        
        track.style.transform = `translateX(-${offset}px)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
        
        // Update button states
        if (prevBtn) {
            prevBtn.disabled = currentIndex === 0;
            prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
        }
        if (nextBtn) {
            nextBtn.disabled = currentIndex >= maxIndex;
            nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
        }
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex--;
            if (currentIndex < 0) currentIndex = 0;
            updateCollegeCarousel();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            const cardsPerView = getCardsPerView();
            const maxIndex = Math.max(0, totalCards - cardsPerView);
            currentIndex++;
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            updateCollegeCarousel();
        });
    }
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCollegeCarousel();
        });
    });
    
    // Handle resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(updateCollegeCarousel, 100);
    });
    
    // Auto-scroll every 4 seconds
    let autoScrollInterval = setInterval(() => {
        const cardsPerView = getCardsPerView();
        const maxIndex = Math.max(0, totalCards - cardsPerView);
        
        currentIndex++;
        if (currentIndex > maxIndex) {
            currentIndex = 0;
        }
        updateCollegeCarousel();
    }, 4000);
    
    // Pause auto-scroll on hover
    if (carousel) {
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoScrollInterval);
        });
        
        carousel.addEventListener('mouseleave', () => {
            autoScrollInterval = setInterval(() => {
                const cardsPerView = getCardsPerView();
                const maxIndex = Math.max(0, totalCards - cardsPerView);
                
                currentIndex++;
                if (currentIndex > maxIndex) {
                    currentIndex = 0;
                }
                updateCollegeCarousel();
            }, 4000);
        });
    }
    
    // Initialize
    updateCollegeCarousel();
})();
