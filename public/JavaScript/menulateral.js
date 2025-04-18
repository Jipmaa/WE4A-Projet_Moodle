let boutonMenuLateral = document.getElementById("bouton-lateral");//bouton
let formulaireMenuLateral = document.getElementById("formulaire-lateral");//div du formulaire
let icone = document.getElementById("icone-lateral");

boutonMenuLateral.addEventListener("click", () => {
    formulaireMenuLateral.classList.toggle('active');
    if (formulaireMenuLateral.classList.contains("active")) {
        icone.name = "close";
    }else{
        icone.name = "menu";
    }
});