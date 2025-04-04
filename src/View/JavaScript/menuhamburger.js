let bouttonhamburger = document.getElementById("boutton-hamburger");//boutton
let formulairehamburger = document.getElementById("formulaire-hamburger");//formulaire
let menuhamburger = document.getElementById("menu-hamburger");//formulaire

bouttonhamburger.addEventListener("click", () => {
    formulairehamburger.style.display = "block";
    menuhamburger.style.backgroundColor = "green";
});
