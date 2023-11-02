const passwordSub = document.querySelector(".enterPW");
const eye =  document.querySelector(".fa-solid, fa-eye-slash")
eye.addEventListener('click', () => {
    if (passwordSub.type === "password") {
        passwordSub.type = "text";
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    }
        else{
            passwordSub.type = "password"
            eye.classList.remove("fa-eye-slash");
            eye.classList.add("fa-eye");
        }

        console.log(eye)
})



passwordSub.addEventListener("input", () => {
    // Récupère la valeur saisie dans le champ
    const passwd = passwordSub.value;
    showPasswordErrors(passwd);
    
});






// Fonction qui permet de contrôler l'intégrité d'un mot de passe
function integrityChecker(saisie){

    let errors = [];

    if(saisie.length < 8){
        errors["size"] = "fait moins de 8 caractères";
    }

    if(saisie.length > 30){
        errors["size"] = "fait plus de 30 caractères";
    }

    if(!/\d/.test(saisie)){
        errors["digit"] = "doit contenir un chiffre";    
    }

    if(!saisie.match(/[A-Z]/)){
        errors["uppercase"] = "doit contenir une lettre majuscule";    
    }

    if(!saisie.match(/[a-z]/)){
        errors["lowercase"] = "doit contenir une lettre minuscule";    
    }

    if(!saisie.match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)){
        errors["specialchar"] = "doit contenir un caractère spécial";    
    }

    return errors;
}

function showPasswordErrors(passwd){

    // Récupère le formulaire dont l'identifiant est registerForm
    const registerForm = document.querySelector(".form");

    // Vérifie si un bloc d'erreurs existant doit être supprimé
    const existingErrorsDiv = registerForm.querySelector(".errors-container");
    if (existingErrorsDiv) {
        registerForm.removeChild(existingErrorsDiv);
    }

    // Object.values permet de convertir le tableau avec les clés en Objet JS itérable 
    // (c'est à dire une variable sur laquelle tu peux boucler)
    let toutesLesErreurs = Object.values(integrityChecker(passwd));

    // Si il y a au moins une erreur à chaque saisie
    if (toutesLesErreurs.length > 0) {
        // Crée la div.errors-container
        let errorsDiv = document.createElement("div");
        errorsDiv.classList.add("errors-container");
        registerForm.appendChild(errorsDiv); // Ajoute le nouveau bloc d'erreurs au formulaire
        
        // Ensuite on y ajoute un titre HTML
        let errorTitle = document.createElement("h2");
        errorTitle.id = "titleError";
        errorTitle.innerText = "Votre mot de passe ne respecte pas une ou plusieurs règles de validation :";
        errorsDiv.appendChild(errorTitle);

        // Ensuite on crée la liste des erreurs
        let errorsList = document.createElement("ul");
        errorsList.id = "blocListPassword"
        errorsDiv.appendChild(errorsList);

        // Parcours de l'ensemble des erreurs afin de pouvoir les afficher une à une dans le bloc d'erreur
        toutesLesErreurs.forEach(erreur => {
            let error = document.createElement("li");
            error.classList.add("listPassword")
            error.innerText = erreur;
            errorsList.appendChild(error);
        });
    }

}