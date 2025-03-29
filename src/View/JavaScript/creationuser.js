let nom = document.getElementById("nom")
let prenom = document.getElementById("prenom")
let email = document.getElementById("email")

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM chargé pour creationuser.html");

    // Vérifier l'état dans localStorage
    const isModification = JSON.parse(localStorage.getItem("isModification")); // Récupérer l'état (true pour modification, false pour création)
    console.log("isModification récupéré :", isModification);
    
    if (isModification) {
        // Si c'est une modification, préremplir les champs
        const data = JSON.parse(localStorage.getItem("userData"));
        if (data) {
            console.log("Données récupérées :", data);

            document.getElementById("nom").value = data.name || "";
            document.getElementById("prenom").value = data.surname || "";
            document.getElementById("email").value = data.email || "";
            //document.getElementById("role").value = data.role || "";
            //document.getElementById("mdp").value = data.password || "";
        } else {
            console.error("Aucune donnée trouvée dans localStorage pour la modification !");
        }
    } else {
        // Si c'est une création, laisser les champs vides
        console.log("Création d'un nouvel utilisateur, champs vides.");
        document.getElementById("nom").value = "";
        document.getElementById("prenom").value = "";
        document.getElementById("email").value = "";
        document.getElementById("role").value = "";
        document.getElementById("mdp").value = "";
    }
});

