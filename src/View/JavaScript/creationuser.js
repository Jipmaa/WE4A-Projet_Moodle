let nom = document.getElementById("nom")
let prenom = document.getElementById("prenom")
let email = document.getElementById("email")

document.addEventListener("DOMContentLoaded", () => {

    // Récupérer les données stockées dans localStorage
    const data = JSON.parse(localStorage.getItem('userData'));
    if (data) {

        // Remplir les champs du formulaire
        document.getElementById("nom").value = data.name || '';
        document.getElementById("prenom").value = data.surname || '';
        document.getElementById("email").value = data.email || '';
    } else {
        console.error("Aucune donnée trouvée dans localStorage !");
    }
});
