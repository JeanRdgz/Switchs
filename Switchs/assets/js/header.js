const nav = document.getElementById('nav');
const menuToggle = document.getElementById('menu-toggle');
const header = document.querySelector('.main-header');

window.addEventListener('scroll', () => {
    if (window.scrollY > 10) {
        nav.classList.add('scrolled');
        header.classList.add('sticky');
    } else {
        nav.classList.remove('scrolled');
        header.classList.remove('sticky');
    }
});

menuToggle.addEventListener('click', () => {
    nav.classList.toggle('active');
});