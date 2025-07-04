import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Preload critical resources
document.addEventListener('DOMContentLoaded', function() {
    // Preload next likely pages
    const links = document.querySelectorAll('a[href^="/"]');
    links.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const url = this.href;
            if (!window.preloadedPages) window.preloadedPages = new Set();
            
            if (!window.preloadedPages.has(url)) {
                const linkEl = document.createElement('link');
                linkEl.rel = 'prefetch';
                linkEl.href = url;
                document.head.appendChild(linkEl);
                window.preloadedPages.add(url);
            }
        });
    });
});