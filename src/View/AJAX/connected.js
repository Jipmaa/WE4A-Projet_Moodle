function updateAuthStatus() {
    const authStatus = document.getElementById('auth-status');
    let divMenuLateral = document.getElementById("menu-lateral");//div entière button + form

    // Vérifier si l'utilisateur est connecté
    const name = sessionStorage.getItem('name');
    const id = sessionStorage.getItem('id');
    const isAdmin = sessionStorage.getItem('admin') === 'true'; // Vérifie si admin est 'true'


    if (name && id) {
        authStatus.innerHTML = `
            <a href="../View/gestionducompte.html">Bienvenue, ${name}</a>
        `;

        divMenuLateral.style.display = "block";

        // Afficher les éléments admin si l'utilisateur est admin
        if (isAdmin) {
            document.getElementById('admin-gestion').style.display = 'list-item';
            document.querySelectorAll('.entre').forEach(element => {
                element.style.display = 'inline-block'; // Ou 'block' selon ton design
            });
        }
    } else {
        authStatus.innerHTML = `
            <a href="../view/login.html">Connexion</a>
        `;
        divMenuLateral.style.display = "none";
    }
}

// Fonction pour se déconnecter
function logout() {
    sessionStorage.removeItem('name');
    sessionStorage.removeItem('id');
    sessionStorage.removeItem('admin'); // Supprimer admin aussi

    updateAuthStatus();
}

// Appeler la fonction au chargement de la page
updateAuthStatus();
