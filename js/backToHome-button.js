const backToTop = document.querySelector('.back-to-top');

window.addEventListener('scroll' , () => {
    if (window.scrollY > 500) {
        backToTop.classList.add("open");
    } else {
        backToTop.classList.remove("open");
    }
})
const header = document.getElementById('header');

function scrollToTop() {
    const header = document.getElementById('header');
    header.scrollIntoView({ behavior: 'smooth' });
}


