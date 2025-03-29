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
    //console.log("Type envoyé au serveur :", type);
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
                headerRow.innerHTML = "<th>Name</th><th>Surname</th><th>Rôles</th><th>Birthdate</th><th>Email</th><th>Phone Number</th><th>Department</th><th>Password</th>";
            } else if (type === "ue") {
                headerRow.innerHTML = "<th>Name</th><th>Type</th><th>Capacity</th>";
            }

            // Ajouter les lignes de données
            let tbody = tableau.createTBody();
            data.forEach(item => {
                let row = tbody.insertRow();

                if (type === "utilisateurs") {
                    row.innerHTML = `<td>${item.name}</td><td>${item.surname}</td><td>${item.role}</td><td>${item.birthdate}</td><td>${item.email}</td><td>${item.phone_number}</td><td>${item.department}</td><td>${item.password}</td>`;
                } else if (type === "ue") {
                    row.innerHTML = `<td>${item.name}</td><td>${item.type}</td><td>${item.capacity}</td>`;
                }

                // Ajouter les boutons "Modifier" et "Supprimer"
                let actionsCell = row.insertCell();
                actionsCell.innerHTML = `
                <button class="edit-btn" onclick="boutonModifier(${item.id}, '${type}')">Modifier</button>
                <button class="delete-btn" onclick="boutonSupprimer(${item.id}, '${type}')">Supprimer</button>
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
function boutonModifier(id, type) {
    if (type) {
        creerNouvelElement(type);
    }
}

function boutonSupprimer(id, type) {
    supprimer.innerText = type === "utilisateurs" ? "supprimer un utilisateur" : "supprimer une UE";
}

utilisateurs.addEventListener("click", () => { afficher("utilisateurs") });
ue.addEventListener("click", () => { afficher("ue") });

function creerNouvelElement(type) {
    let page = type === "utilisateurs" ? "creationuser.html" : "creationue.html";
    //window.location.href = page; //remplacer la page actuelle
    window.open(page, "_blank");//ouvrir dans un nouvel onglet
}

creer.addEventListener("click", () => {
    if (typeActuel) {
        creerNouvelElement(typeActuel);
    }
});
