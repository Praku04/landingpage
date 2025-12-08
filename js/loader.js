// ============================================
// TMG - OPTIMIZED SCRIPT LOADER
// Async load non-critical JavaScript
// ============================================

(function() {
    'use strict';
    
    // Defer loading of non-critical scripts
    function loadScript(src, callback) {
        var script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.defer = true;
        
        if (callback) {
            script.onload = callback;
        }
        
        document.body.appendChild(script);
    }
    
    // Load scripts after page load
    window.addEventListener('load', function() {
        // Load non-critical scripts
        var scripts = [
            'js/modern-form.js',
            'js/auth.js'
        ];
        
        scripts.forEach(function(src) {
            loadScript(src);
        });
    });
    
    // Lazy load images
    if ('IntersectionObserver' in window) {
        var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });
        
        // Observe all images with data-src
        document.addEventListener('DOMContentLoaded', function() {
            var lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        });
    }
})();
