document.addEventListener("DOMContentLoaded", () => {

    // Initialisation de isModification si non défini
    if (localStorage.getItem("isModification") === null) {
        localStorage.setItem("isModification", JSON.stringify(false)); // Par défaut à "création" (champ vide)
    }

    // Vérifier l'état dans localStorage
    /* Récupérer l'état (true pour modification, false pour création) */
    const isModification = JSON.parse(localStorage.getItem("isModification"));

    if (isModification) {
        // Si c'est une modification, pré-remplir les champs
        const data = JSON.parse(localStorage.getItem("userData"));
        if (data) {
            document.getElementById("nom").value = data.name || "";
            document.getElementById("prenom").value = data.surname || "";
            document.getElementById("birthdate").value = data.birthdate || "";
            document.getElementById("email").value = data.email || "";
            document.getElementById("phone").value = data.phone_number || "";
            document.getElementById("department").value = data.department || "";
            document.getElementById("mdp").value = data.password || "";
        } else {
            console.error("Aucune donnée trouvée dans localStorage pour la modification !");
        }
    } else {
        // Si c'est une création, laisser les champs vides
        document.getElementById("nom").value = "";
        document.getElementById("prenom").value = "";
        document.getElementById("birthdate").value = "";
        document.getElementById("email").value = "";
        document.getElementById("phone").value = "";
        document.getElementById("department").value = "";
        document.getElementById("role").value = "";
        document.getElementById("administrator").value = "";
        document.getElementById("mdp").value = "";
    }

    // Permet la création d'un mot de passe aléatoire instantané après avoir cliqué
    const mdpInput = document.getElementById("mdp");

    mdpInput.addEventListener("focus", function () {
        if (!mdpInput.value) { // Pour vérifier que rien n'est déjà écrit
            mdpInput.value = generatePassword(16);
        }
    });

    function generatePassword(length) {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
        let password = "";
        for (let i = 0; i < length; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return password;
    }
});