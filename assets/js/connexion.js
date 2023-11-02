const passwordSub = document.querySelector(".enterPW");
const eye = document.querySelector(".fa-eye");
eye.addEventListener('click', () => {
    if (passwordSub.type === "password") {
        passwordSub.type = "text";
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    } else {
        passwordSub.type = "password";
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
    }
    console.log(eye)
});

passwordSub.addEventListener("input", () => {
    // Récupère la valeur saisie dans le champ
    const passwd = passwordSub.value;
    showPasswordErrors(passwd);
});

