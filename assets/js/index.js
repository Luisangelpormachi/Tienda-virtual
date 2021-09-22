const navToggle = document.querySelector(".nav-toggle");
const navToggle2 = document.querySelector("nav .nav-toggle");
const navMenu = document.querySelector(".navbar");


navToggle.addEventListener("click", () => {
    navMenu.classList.toggle("nav-menu-visible");
});

navToggle2.addEventListener("click", () => {
    navMenu.classList.toggle("nav-menu-visible");
});