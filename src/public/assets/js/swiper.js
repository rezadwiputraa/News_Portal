const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1.5,
    spaceBetween: 20,
    centeredSlides: true,
    loop: true,
    loopedSlides: 3,
    initialSlide: 1,
    autoplay: {
        delay: 3000, // waktu tunggu antar slide (ms) - di sini 3 detik
        disableOnInteraction: false, // tetap autoplay meskipun user menggeser manual
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1.2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2.5,
            spaceBetween: 20,
        },
    },
    on: {
        beforeInit: function () {
            const swiperContainer = document.querySelector(
                ".mySwiper .swiper-wrapper"
            );
            const slides = swiperContainer.querySelectorAll(".swiper-slide");

            if (slides.length === 3) {
                slides.forEach((slide) => {
                    const clone = slide.cloneNode(true);
                    swiperContainer.appendChild(clone);
                });
            }
        },
        init: function () {
            const swiperContainer = document.querySelector(
                ".mySwiper .swiper-wrapper"
            );
            const slides = swiperContainer.querySelectorAll(".swiper-slide");
            if (slides.length > 3) {
                slides.forEach((slide, index) => {
                    if (index >= 3 && index < slides.length - 3) {
                        slide.remove();
                    }
                });
            }
        },
    },
});

document.addEventListener("DOMContentLoaded", function () {
    // Tampilkan form balasan ketika tombol 'Reply' diklik
    document.querySelectorAll(".reply-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const commentId = this.dataset.commentId;
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle("hidden");
        });
    });

    // Sembunyikan form balasan ketika tombol 'Cancel' diklik
    document.querySelectorAll(".cancel-reply").forEach((button) => {
        button.addEventListener("click", function () {
            const commentId = this.dataset.commentId;
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.add("hidden");
        });
    });
});
