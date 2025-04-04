let utilisateurs = document.getElementById("utilisateurs");
let ue = document.getElementById("ue");
let titreAdmin = document.getElementById("titreadmin");
let divAdministrateur = document.getElementById("divadministrateur");
let creer = document.getElementById("creer");
let typeActuel = "";
let afficherTableau = document.getElementById("afficherTableau");
let formulaireRecherche = document.getElementById("formulaire-recherche");

utilisateurs.addEventListener("click", () => { afficher("utilisateurs") });
ue.addEventListener("click", () => { afficher("ue") });
function afficher(type) {
    divAdministrateur.style.display = "block";
    titreAdmin.innerText = type === "utilisateurs" ? "Utilisateurs" : "Unités d'Enseignement";
    rechercher(type); // Appeler la fonction pour afficher des champs de recherche
    creer.innerText = type === "utilisateurs" ? "créer un nouvel utilisateur" : "créer une UE";
    chargerListe(type); // Appeler la fonction pour charger et afficher les données
    typeActuel = type;
}

// Fonction pour afficher les champs de recherche
function rechercher(type) {
    formulaireRecherche.style.display = "block";
    formulaireRecherche.innerHTML = ""; // Réinitialiser le contenu

    //Créer le formulaire
    let formulaire = document.createElement("form");
    formulaire.method = "POST";
    formulaire.className = "search-form";

    if (type === "utilisateurs") {
        formulaire.innerHTML = `
            <label for="id"></label>
            <input id="id" type="text" name="id" placeholder="ID"/>
            
            <label for="name"></label>
            <input id="name" type="text" name="name" placeholder="Nom"/>
            
            <label for="first_name"></label>
            <input id="first_name" type="text" name="first_name" placeholder="First Name"/>
            
            <label for="email"></label>
            <input id="email" type="text" name="email" placeholder="Email"/>
            
            <select id="role" name="role" required>
                <option value="null">Choisir...</option>
                <option value="etudiant">Etudiant</option>
                <option value="prof">Enseignant</option>
                <option value="secretaire">Secrétaire</option>
                <option value="gestion_edt">Service gestion edt</option>
                <option value="directeur_pole">Directeur pôle</option>
                <option value="responsable_sde">Responsable service des études</option>
                <option value="directeur_si">Directeur des systèmes d'information</option>
                <option value="responsable_snp">Responsable service numérique et pédagogique</option>
            </select>
            <button type="submit" class="search-btn">Rechercher</button>
            <a href="" class="reset-btn">Rénitialiser</a>
            `;
    } else if (type === "ue") {
        formulaire.innerHTML = `
                <label for="id"></label>
                <input id="id" type="text" name="id" placeholder="ID"/>
                
                <label for="code"></label>
                <input id="code" type="text" name="code" placeholder="Code"/>
                
                <label for="name"></label>
                <input id="name" type="text" name="name" placeholder="Intitulé"/>
                
                <label for="category"></label>
                <input id="category" type="text" name="category" placeholder="Catégorie"/>
              
                <button type="submit" class="search-btn">Rechercher</button>
                <a href="" class="reset-btn">Rénitialiser</a>
                `;
    }
    formulaireRecherche.appendChild(formulaire); // Insérer le formulaire dans la div
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
                const headers = ["Id", "Surname", "Name", "Rôles", "Birthdate", "Email", "Phone Number", "Department"];
                headers.forEach(headerText => {
                    let th = document.createElement("th");
                    th.textContent = headerText;
                    headerRow.appendChild(th);
                });
            } else if (type === "ue") {
                const headers = ["Id", "Code", "Intitulé", "Type", "Capacity"];
                headers.forEach(headerText => {
                    let th = document.createElement("th");
                    th.textContent = headerText;
                    headerRow.appendChild(th);
                });
            } else {
                console.error("Type inconnu :", type);
            }


            // Ajouter les lignes de données
            let tbody = tableau.createTBody();
            data.forEach(item => {
                let row = tbody.insertRow();

                if (type === "utilisateurs") {
                    row.innerHTML = `<td>${item.id}</td><td>${item.surname}</td><td>${item.name}</td>
                            <td>${item.role}</td><td>${item.birthdate}</td><td>${item.email}</td>
                            <td>${item.phone_number}</td><td>${item.department}</td>`;
                } else if (type === "ue") {
                    row.innerHTML = `<td>${item.id}</td><td>${item.code}</td><td>${item.name}</td>
                            <td>${item.type}</td><td>${item.capacity}</td>`;
                } else {
                    console.error("Type inconnu :", type);
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
    if (type) {
        supprimerElement(id, role, type);
    }
}

function creerNouvelElement(type) {
    // Indiquer qu'il s'agit d'une création
    localStorage.setItem("isModification", false); // Pas de modification
    localStorage.removeItem("userData"); // Supprimer les données résiduelles

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
                //window.location.href = page; // Redirection
                window.open(page, "_blank");//ouvrir dans un nouvel onglet
            }
        })
        .catch((error) => console.error("Erreur lors de la récupération des données :", error));
}

function supprimerElement(id, role, type) {
    let main = document.querySelector("main");

    // Récupérer les éléments de la modale
    modal = document.getElementById("modal-popup");
    modalTitle = document.getElementById("modal-title");
    modalMessage = document.getElementById("modal-message");
    confirmBtn = document.getElementById("confirm-btn");
    cancelBtn = document.getElementById("cancel-btn");

    const button = event.target;

    // Calculer la position du bouton
    const buttonRect = button.getBoundingClientRect();//obtenir les coordonnées et dimensions du bouton
    modal.style.left = `${buttonRect.right + 10}px`; // Positionner à droite du bouton
    modal.style.top = `${buttonRect.top}px`;

    modalTitle.innerText = type === "utilisateurs" ? "Supprimer un utilisateur" : "Supprimer une UE";
    modalMessage.innerText = type === "utilisateurs" ? `Êtes-vous sûr de vouloir supprimer cet utilisateur ?`: `Êtes-vous sûr de vouloir supprimer cet UE ?`;

    modal.style.display = "block";

    // Gérer le bouton "Confirmer"
    confirmBtn.addEventListener("click", () => {
        // Masquer la modale
        modal.style.display = "none";

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
    });

    // Gérer le bouton "Annuler"
    cancelBtn.addEventListener("click", () => {
        modal.style.display = "none"; // Masquer la modale sans effectuer la suppression
    });
}
