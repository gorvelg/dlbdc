document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".gg-clients-swiper").forEach((el) => {
        if (el.dataset.swiperInitialized === "1") return;
        el.dataset.swiperInitialized = "1";

        new Swiper(el, {
            slidesPerGroup: 3,
            slidesPerView: 3,
            spaceBetween: 8,
            watchOverflow: false,
            loop: true,
            autoplay: {
                delay: 2500,              // temps entre chaque mouvement
                disableOnInteraction: false, // continue après interaction
                pauseOnMouseEnter: true,  // pause au survol (optionnel)
            },
            speed: 600,
            navigation: {
                nextEl: el.querySelector(".swiper-button-next"),
                prevEl: el.querySelector(".swiper-button-prev"),
            },
            pagination: {
                el: el.querySelector(".swiper-pagination"),
                clickable: true,
            },
        });
    });
});