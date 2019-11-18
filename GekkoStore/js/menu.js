//when document has completely loaded
window.addEventListener("load", function() {
    var nav = document.querySelector("#menu nav:last-child");
    
    nav.addEventListener("click", function(event) {
        //if clicked element is not (!) a link
        if(!event.target.matches("a")) {
            //add or remove class 'visible'
           document.querySelector("#menu nav:last-child ul").classList.toggle("visible");
        }
    }, false);
}, false);
