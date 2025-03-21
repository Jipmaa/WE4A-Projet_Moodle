let utilisateurs = document.getElementById("utilisateurs")
let ue = document.getElementById("ue")
let titreAdmin = document.getElementById("titreadmin")
let divAdministrateur = document.getElementById("divadministrateur")
let creer = document.getElementById("creer")
let modifier = document.getElementById("modifier")
let supprimer = document.getElementById("supprimer")

function afficher(type) {
    divAdministrateur.style.display = "block";
    titreAdmin.innerText = type === "utilisateurs" ? "Utilisateurs" : "Unités d'Enseignement";
    creer.innerText = type === "utilisateurs" ? "créer un nouvel utilisateur" : "créer une UE";
    modifier.innerText = type === "utilisateurs" ? "modifier un utilisateur" : "modifier une UE";
    supprimer.innerText = type === "utilisateurs" ? "supprimer un utilisateur" : "supprimer une UE";
}
utilisateurs.addEventListener("click", () => { afficher("utilisateurs")});
ue.addEventListener("click", () => { afficher("ue")});