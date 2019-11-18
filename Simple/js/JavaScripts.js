
function openSmartphoneMenu() {
    document.getElementById("menu-close").classList.toggle("change");
    document.getElementById("smart-drp").classList.toggle("toggle-show-smart-menu");
}

window.onscroll = function () {
    stickyNav()
};


function scrollToTop() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}
function stickyNav() {
    let navbar = document.getElementById("pc-header");
    var topButton = document.getElementById("scrolToTop");
    let sticky = navbar.offsetTop;
    var elements = document.querySelectorAll(".pc-text");
    if (window.pageYOffset > 0) {
        navbar.classList.add("sticky");
        topButton.style.display = "block";

        for (var i = 0; i < elements.length; i++) {
            elements[i].style.color = "#236A10";
        }

    } else {
        topButton.style.display = "none";
        navbar.classList.remove("sticky");
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.color = "white";
        }
    }
}



