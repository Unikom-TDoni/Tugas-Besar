var swiper = new Swiper('.swiper-container', {
    slidesPerView: 5,
    spaceBetween: 24,
    slidesPerGroup: 2,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
    el: '.swiper-pagination',
    clickable: true,
    },
    navigation: {
    nextEl: '.slide-next',
    prevEl: '.slide-prev',
    },
});