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

    document.addEventListener('wpcf7mailsent', function (event) {
        const form = event.target;
        let notice = form.querySelector('.form-success-message');

        if (!notice) {
            notice = document.createElement('div');
            notice.className = 'form-success-message is-hidden';
            form.appendChild(notice);
        }

        notice.textContent = 'Votre message a bien été envoyé.';
        notice.classList.remove('is-hidden');
        notice.classList.add('is-visible');

        if (notice.hideTimeout) {
            clearTimeout(notice.hideTimeout);
        }

        notice.hideTimeout = setTimeout(() => {
            notice.classList.remove('is-visible');
            notice.classList.add('is-hidden');
        }, 5000);
    }, false);

});

