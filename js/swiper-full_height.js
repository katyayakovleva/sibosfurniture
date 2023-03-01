const swiper_full_height = new Swiper(".swiper-full-height", {
    direction: "horizontal",
    loop: !0,
    pagination: {
        el: ".swiper-pagination",
        clickable: !0
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
});