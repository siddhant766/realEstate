<?php
// Enhanced Animations and Premium Effects
?>
<style>
/* Premium animation classes with refined timing functions */
.fade-in {
    opacity: 0;
    transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: opacity;
}

.fade-in.visible {
    opacity: 1;
}

.slide-up {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform, opacity;
}

.slide-up.visible {
    opacity: 1;
    transform: translateY(0);
}

.slide-right {
    opacity: 0;
    transform: translateX(-30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform, opacity;
}

.slide-right.visible {
    opacity: 1;
    transform: translateX(0);
}

.slide-left {
    opacity: 0;
    transform: translateX(30px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform, opacity;
}

.slide-left.visible {
    opacity: 1;
    transform: translateX(0);
}

.scale-up {
    opacity: 0;
    transform: scale(0.98);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform, opacity;
}

.scale-up.visible {
    opacity: 1;
    transform: scale(1);
}

/* Elegant hover effects */
.hover-lift {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-lift:hover {
    transform: translateY(-4px);
}

.hover-scale {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-scale:hover {
    transform: scale(1.02);
}

/* Refined animation delay utilities */
.delay-100 { transition-delay: 100ms; }
.delay-200 { transition-delay: 200ms; }
.delay-300 { transition-delay: 300ms; }
.delay-400 { transition-delay: 400ms; }
.delay-500 { transition-delay: 500ms; }

/* Smooth button transitions */
.btn-transition {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Premium card hover effect */
.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>

<script>
// Enhanced Intersection Observer with progressive loading
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.fade-in, .slide-up, .slide-right, .slide-left, .scale-up');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Optional: Unobserve after animation
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2,
        rootMargin: '0px 0px -10% 0px'
    });

    // Add progressive delay to elements
    animatedElements.forEach((element, index) => {
        const baseDelay = 100;
        const progressiveDelay = index * 50;
        element.style.transitionDelay = `${Math.min(baseDelay + progressiveDelay, 1000)}ms`;
        observer.observe(element);
    });

    // Smooth scroll behavior for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>