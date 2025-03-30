let utilisateurs = document.getElementById("utilisateurs")
let ue = document.getElementById("ue")
let titreAdmin = document.getElementById("titreadmin")
let divAdministrateur = document.getElementById("divadministrateur")
let creer = document.getElementById("creer")
let typeActuel = "";
let afficherTableau = document.getElementById("afficherTableau");

function afficher(type) {
    divAdministrateur.style.display = "block";
    titreAdmin.innerText = type === "utilisateurs" ? "Utilisateurs" : "Unités d'Enseignement";
    creer.innerText = type === "utilisateurs" ? "créer un nouvel utilisateur" : "créer une UE";
    chargerListe(type); // Appeler la fonction pour charger et afficher les données
    typeActuel = type;
}

// Fonction pour charger les données en fonction du type actif
function chargerListe(type) {
    afficherTableau.style.display = "block";
    
    fetch("AJAX/utilisateurs.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `typeActuel=${type}` // Envoyer le type (utilisateurs ou ue)
    })
        .then(response => response.json())
        .then(data => {
            afficherTableau.innerHTML = ""; // Réinitialiser le contenu

            if (data.error) {
                afficherTableau.innerHTML = `<p class="error">${data.error}</p>`;
                return;
            }

            // Créer un tableau HTML
            let tableau = document.createElement("table");
            tableau.className = "data-table";

            // Ajouter une ligne d'en-tête
            let thead = tableau.createTHead();
            let headerRow = thead.insertRow();
            if (type === "utilisateurs") {
                headerRow.innerHTML = "<th>Id</th><th>Surname</th><th>Name</th><th>Rôles</th><th>Birthdate</th><th>Email</th><th>Phone Number</th><th>Department</th><th>Password</th>";
            } else if (type === "ue") {
                headerRow.innerHTML = "<th>Id</th><th>Name</th><th>Type</th><th>Capacity</th>";
            }

            // Ajouter les lignes de données
            let tbody = tableau.createTBody();
            data.forEach(item => {
                let row = tbody.insertRow();

                if (type === "utilisateurs") {
                    row.innerHTML = `<td>${item.id}</td><td>${item.surname}</td><td>${item.name}</td><td>${item.role}</td><td>${item.birthdate}</td><td>${item.email}</td><td>${item.phone_number}</td><td>${item.department}</td><td>${item.password}</td>`;
                } else if (type === "ue") {
                    row.innerHTML = `<td>${item.id}</td><td>${item.name}</td><td>${item.type}</td><td>${item.capacity}</td>`;
                }

                // Ajouter les boutons "Modifier" et "Supprimer"
                let actionsCell = row.insertCell();
                actionsCell.innerHTML = `
                <button class="edit-btn" data-id="<?= $user['id'] ? >" data-role="${item.role}" onclick="boutonModifier(${item.id}, '${item.role}', '${type}')">Modifier</button>             
                <button class="delete-btn" data-id="<?= $user['id'] ? >" data-role="${item.role}" onclick="boutonSupprimer(${item.id}, '${item.role}', '${type}')">Supprimer</button>
            `;
            });

            afficherTableau.appendChild(tableau); // Insérer le tableau dans la div
        })
        .catch(error => {
            console.error("Erreur :", error);
            document.getElementById("afficherTableau").innerHTML = `<p class="error">Une erreur est survenue.</p>`;
        });
}

// Fonctions à implémenter pour les boutons
function boutonModifier(id, role, type) {
    if (type) {
        modifierElement(id, role, type);
    }
}

function boutonSupprimer(id, role, type) {
    //supprimer.innerText = type === "utilisateurs" ? "supprimer un utilisateur" : "supprimer une UE";
    if (type) {
        supprimerElement(id, role, type);
    }
}

utilisateurs.addEventListener("click", () => { afficher("utilisateurs") });
ue.addEventListener("click", () => { afficher("ue") });

function creerNouvelElement(type) {
    console.log("Création d'un nouvel élément.");
    // Indiquer qu'il s'agit d'une création
    localStorage.setItem("isModification", false); // Pas de modification
    localStorage.removeItem("userData"); // Supprimer les données résiduelles

    // Vérification des valeurs stockées
    console.log("isModification :", localStorage.getItem("isModification"));
    console.log("userData :", localStorage.getItem("userData"));

    let page = type === "utilisateurs" ? "creationuser.html" : "creationue.html";
    //window.location.href = page; //remplacer la page actuelle
    window.open(page, "_blank");//ouvrir dans un nouvel onglet
}

creer.addEventListener("click", () => {
    if (typeActuel) {
        creerNouvelElement(typeActuel);
    }
});

function modifierElement(id, role, type) {
    // Indiquer qu'il s'agit d'une modification
    localStorage.setItem("isModification", true); // Modification active

    let page = type === "utilisateurs" ? "creationuser.html" : "creationue.html";
    //window.location.href = page; //remplacer la page actuelle
    window.open(page, "_blank");//ouvrir dans un nouvel onglet

    //récupérer les données et les stocker
    fetch("AJAX/getUser.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ id, role, type }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Données reçues du serveur :", data);

            if (data.error) {
                console.error("Erreur :", data.error);
            } else {
                // Stocker les données dans localStorage
                localStorage.setItem("userData", JSON.stringify(data));
                localStorage.setItem("isModification", true); // Indiquer qu'il s'agit d'une modification
                window.location.href = page; // Redirection
            }
        })
        .catch((error) => console.error("Erreur lors de la récupération des données :", error));
}

function supprimerElement(id, role, type) {
    // Afficher une pop-up de confirmation
    if (confirm(`Êtes-vous sûr de vouloir supprimer cet élément (${type}) ?`)) {
        // Envoi de la requête AJAX pour la suppression
        fetch("AJAX/effaceruser.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ id, role, type }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Élément supprimé avec succès !");
                    // Supprimer la ligne correspondante dans le tableau
                    let row = document.querySelector(`[data-id='${id}'][data-type='${type}']`).closest("tr");
                    row.remove();
                } else {
                    alert(`Erreur lors de la suppression : ${data.error}`);
                }
            })
            .catch(error => console.error("Erreur réseau :", error));
    }
}
