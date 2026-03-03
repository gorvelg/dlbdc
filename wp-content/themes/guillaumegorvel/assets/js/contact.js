document.addEventListener("DOMContentLoaded", function() {
    console.log('coucou');
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