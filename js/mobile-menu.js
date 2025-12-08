/**
 * Mobile Menu Functionality
 * The Management Gurus
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileNav = document.querySelector('.mobile-nav');
        const body = document.body;
        
        if (!mobileMenuToggle || !mobileNav) {
            return;
        }

        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = mobileNav.classList.contains('active');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close menu when clicking on nav items
        const mobileNavItems = mobileNav.querySelectorAll('.mobile-nav-item');
        mobileNavItems.forEach(item => {
            item.addEventListener('click', function() {
                closeMobileMenu();
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileNav.classList.contains('active') && 
                !mobileNav.contains(e.target) && 
                !mobileMenuToggle.contains(e.target)) {
                closeMobileMenu();
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Prevent body scroll when menu is open
        function openMobileMenu() {
            mobileNav.classList.add('active');
            mobileMenuToggle.classList.add('active');
            body.classList.add('mobile-menu-open');
            body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileNav.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
            body.classList.remove('mobile-menu-open');
            body.style.overflow = '';
        }

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth > 767 && mobileNav.classList.contains('active')) {
                    closeMobileMenu();
                }
            }, 250);
        });

        // Header scroll effect
        const siteHeader = document.querySelector('.site-header');
        if (siteHeader) {
            let lastScroll = 0;
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 50) {
                    siteHeader.classList.add('scrolled');
                } else {
                    siteHeader.classList.remove('scrolled');
                }
                
                lastScroll = currentScroll;
            });
        }
    });
})();
