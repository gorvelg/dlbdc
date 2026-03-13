document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".wpcf7-form input, .wpcf7-form textarea").forEach(function(input) {
        input.addEventListener("focus", function() {
            var label = this.closest('.input-contact').querySelector('label.in-input');
            if (label) {
                label.classList.add('has-value');
            }
        });

        input.addEventListener("blur", function() {
            var text_val = this.value;
            var label = this.closest('.input-contact').querySelector('label.in-input');
            if (label && text_val === "") {
                label.classList.remove('has-value');
            }
        });
    });

    document.querySelectorAll(".page-template-template-tunnel input").forEach(function(input) {
        input.addEventListener("focus", function() {
            var label = this.closest('.input-contact').querySelector('label.in-input');
            if (label) {
                label.classList.add('has-value');
            }
        });

        input.addEventListener("blur", function() {
            var text_val = this.value;
            var label = this.closest('.input-contact').querySelector('label.in-input');
            if (label && text_val === "") {
                label.classList.remove('has-value');
            }
        });
    });
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