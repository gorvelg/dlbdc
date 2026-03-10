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
