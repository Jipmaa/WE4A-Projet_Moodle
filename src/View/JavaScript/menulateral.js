let boutonMenuLateral = document.getElementById("bouton-lateral");//boutton
let formulaireMenuLateral = document.getElementById("formulaire-lateral");//div du formulaire

boutonMenuLateral.addEventListener("click", () => {
    formulaireMenuLateral.classList.toggle('active');
});
