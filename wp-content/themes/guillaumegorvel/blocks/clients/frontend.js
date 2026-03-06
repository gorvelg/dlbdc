document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".gg-clients-swiper").forEach((el) => {
        if (el.dataset.swiperInitialized === "1") return;
        el.dataset.swiperInitialized = "1";

        new Swiper(el, {
            slidesPerGroup: 1,
            slidesPerView: 1,
            spaceBetween: 8,
            watchOverflow: false,
            // loop: true,
            // autoplay: {
            //     delay: 2500,
            //     disableOnInteraction: false,
            //     pauseOnMouseEnter: true,
            // },
            // speed: 600,

            breakpoints: {
                // when window width is >= 480px
                480: {
                    slidesPerGroup: 1,
                    slidesPerView: 1.2,
                    spaceBetween: 8
                },
                550: {
                    slidesPerGroup: 2,
                    slidesPerView: 1.5,
                    spaceBetween: 8
                },
                768: {
                    slidesPerGroup: 2,
                    slidesPerView: 2.2,
                    spaceBetween: 8
                },
                1120: {
                    slidesPerGroup: 3,
                    slidesPerView: 3.2,
                    spaceBetween: 8
                },
                1400: {
                    slidesPerGroup: 4,
                    slidesPerView: 4,
                    spaceBetween: 8
                },
            },
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