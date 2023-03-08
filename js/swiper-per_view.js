const swiper_per_view = new Swiper(".swiper-per-view", {
    direction: "horizontal",
    loop: false,
    slidesPerView: "auto",
    spaceBetween: 60,
    pagination: {
        el: ".swiper-pagination",
        clickable: !0
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
});