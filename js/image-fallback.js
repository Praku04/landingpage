// Image Fallback Handler - Fixes broken images
(function() {
    'use strict';
    
    // Handle image load errors
    function handleImageError(img) {
        // Create a placeholder with initials or icon
        var alt = img.alt || 'Image';
        var initials = alt.split(' ').map(function(word) {
            return word.charAt(0).toUpperCase();
        }).join('').substring(0, 2);
        
        // Create SVG placeholder
        var svg = '<svg width="100%" height="100%" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">' +
                  '<rect width="200" height="200" fill="#e5e7eb"/>' +
                  '<text x="50%" y="50%" font-family="Arial, sans-serif" font-size="60" font-weight="bold" ' +
                  'fill="#9ca3af" text-anchor="middle" dominant-baseline="middle">' + initials + '</text>' +
                  '</svg>';
        
        // Convert SVG to data URL
        var dataUrl = 'data:image/svg+xml;base64,' + btoa(svg);
        img.src = dataUrl;
        img.style.backgroundColor = '#f3f4f6';
    }
    
    // Add error handler to all images
    function initImageFallback() {
        var images = document.querySelectorAll('img');
        images.forEach(function(img) {
            // Skip if already has error handler
            if (img.dataset.fallbackAdded) return;
            
            img.addEventListener('error', function() {
                handleImageError(this);
            });
            
            img.dataset.fallbackAdded = 'true';
            
            // Check if image is already broken
            if (!img.complete || img.naturalHeight === 0) {
                handleImageError(img);
            }
        });
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initImageFallback);
    } else {
        initImageFallback();
    }
    
    // Re-check after page load
    window.addEventListener('load', initImageFallback);
    
    // Watch for dynamically added images
    if ('MutationObserver' in window) {
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.tagName === 'IMG') {
                        node.addEventListener('error', function() {
                            handleImageError(this);
                        });
                    }
                });
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
})();
