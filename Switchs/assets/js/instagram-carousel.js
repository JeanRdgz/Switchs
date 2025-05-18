document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('instagram-carousel');
    const leftBtn = document.getElementById('insta-arrow-left');
    const rightBtn = document.getElementById('insta-arrow-right');
    let images = Array.from(carousel.querySelectorAll('.instagram-carousel-image'));
    let current = 0;

    function duplicateImages() {
        if (carousel.dataset.duplicated) return;
        images.forEach(img => {
            const clone = img.cloneNode(true);
            carousel.appendChild(clone);
        });
        carousel.dataset.duplicated = "true";
        images = Array.from(carousel.querySelectorAll('.instagram-carousel-image'));
    }

    function getVisibleCount() {
        return window.innerWidth <= 900 ? 2 : 6;
    }

    function updateCarousel() {
        const visible = getVisibleCount();
        const total = images.length;
        const max = total / 2; 
        if (current < 0) current = max - 1;
        if (current >= max) current = 0;
        const imageWidth = images[0].offsetWidth + 5; // 5px gap
        carousel.style.transform = `translateX(-${current * imageWidth}px)`;
    }

    leftBtn.addEventListener('click', () => {
        current--;
        updateCarousel();
    });

    rightBtn.addEventListener('click', () => {
        current++;
        updateCarousel();
    });

    window.addEventListener('resize', updateCarousel);

    duplicateImages();
    updateCarousel();
});
