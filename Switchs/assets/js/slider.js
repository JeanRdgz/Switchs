const slides = document.querySelectorAll('.slide');
let currentIndex = 0;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = i === index ? 'block' : 'none';
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

// Mostrar el primer slide al cargar la página
showSlide(currentIndex);

setInterval(nextSlide, 5000);
