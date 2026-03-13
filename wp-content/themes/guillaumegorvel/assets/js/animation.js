document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(
        ".wp-block-group.scroll-reveal-left, .wp-block-group.scroll-reveal-up, .wp-block-group.scroll-reveal-right"
    );

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                obs.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });

    elements.forEach(el => observer.observe(el));
});

document.addEventListener('DOMContentLoaded', function () {
    const bubbles = document.querySelectorAll('.bubble');

    console.log('parallax ok');
    console.log(bubbles);

    if (!bubbles.length) return;

    function updateParallax() {
        bubbles.forEach(function (bubble) {
            const speed = parseFloat(bubble.dataset.speed || '0.2');
            const container = bubble.closest('.hero');
            if (!container) return;

            const rect = container.getBoundingClientRect();
            const moveY = rect.top * speed;

            bubble.style.transform = 'translate3d(0,' + moveY + 'px,0)';
        });
    }

    let ticking = false;

    function requestTick() {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                updateParallax();
                ticking = false;
            });
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick, { passive: true });
    window.addEventListener('resize', requestTick);

    updateParallax();
});