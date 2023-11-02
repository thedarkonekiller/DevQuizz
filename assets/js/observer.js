let blocText = document.querySelector("#sect1");
let imgMain = document.querySelector("#img_right");

const observer = new IntersectionObserver(elements => {
    elements.forEach(el => {
        if (el.isIntersecting) {
            el.target.classList.add("visible");

            let src = el.target.getAttribute("data-src");

            el.target.setAttribute("src", src);

            el.target.removeAttribute("data-src");
            observer.unobserve(el.target);   
        }
    });
});

observer.observe(imgMain); // Observer l'image directement
observer.observe(blocText);
console.log(imgMain);
// Vous pouvez également ajouter un gestionnaire d'événement pour l'image chargée paresseusement
imgMain.addEventListener('load', () =>{
    // Vous pouvez ajouter un code ici pour gérer l'effet après le chargement
    console.log("L'image a été chargée paresseusement.");
});

console.log(imgMain);


