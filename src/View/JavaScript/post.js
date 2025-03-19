let texte = document.getElementById("texte")
let fichier = document.getElementById("fichier")
let formulaire = document.getElementById("formulaire")
let titreFormulaire = document.getElementById("titreFormulaire");
let selectFichier = document.getElementById("selectFichier");

// Fonction pour afficher le formulaire avec le bon contenu
function afficherFormulaire(type) {
    formulaire.style.display = "block"; // Afficher le formulaire
    titreFormulaire.innerText = type === "texte" ? "Message Texte" : "Partager un fichier";
    selectFichier.style.display = type === "fichier" ? "block" : "none";
}

texte.addEventListener("click", () => { afficherFormulaire("texte")});
fichier.addEventListener("click", () => { afficherFormulaire("fichier")});

