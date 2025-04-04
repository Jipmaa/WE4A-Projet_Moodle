let bouttonHamburger = document.getElementById("boutton-hamburger");//boutton
let formulaireHamburger = document.getElementById("formulaire-hamburger");//div du formulaire

bouttonHamburger.addEventListener("click", () => {
    formulaireHamburger.classList.toggle('active');
});
