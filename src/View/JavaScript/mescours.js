let cours = document.getElementById("cours");

document.addEventListener("DOMContentLoaded", () => {
    fetch("../Controller/get_UE.php") // Simple requête GET
        .then(response => response.json())
        .then(data => {
            console.log(data);
            afficherUE(data); // Appelle une fonction pour afficher les cours
        })
        .catch(error => {
            console.error("Erreur :", error);
        });
});

function afficherUE(data){
    cours.style.display = "block";

    cours.innerHTML = "";

    for (let i = 0; i < data.length; i += 3) {
        let divCours = document.createElement("div");
        divCours.className = "cours-block1";

        for (let j = i; j < i + 3 && j < data.length; j++) {
            let divEncadrement = document.createElement("div");
            divEncadrement.className = "encadrement";

            // Utilisation de (j % 3) + 1 pour boucler sur 1, 2, 3
            const imageIndex = (j % 3) + 1;

            divEncadrement.innerHTML = `
                <a href="tableaudebord.html">
                    <img src="images/cours${imageIndex}.png" alt="cours${imageIndex}">
                </a>
                <a href="tableaudebord.html">${data[j].code}</a>              
                <p>${data[j].name}</p>
            `;
            divCours.appendChild(divEncadrement);
        }

        // Si c'est le dernier bloc et qu'il contient moins de 3 éléments
        if (data.length - i <= 3) {
            divCours.style.justifyContent = "flex-start"; // Aligner les éléments à gauche
        }

        cours.appendChild(divCours); // Ajouter le bloc au conteneur principal
    }
}