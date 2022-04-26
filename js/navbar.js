const navbar = document.querySelector(".nav-items");
const menu = document.querySelector(".nav-mobile-menu-container");
const main = document.querySelector("main");


function showMenu() {
    if(navbar.style.display === "flex") {
        navbar.style.display = "none";
        menu.style.background = "transparent";
    }
    else {
        navbar.style.display = "flex";
        menu.style.background = "var(--text-highlight)";
    }
}