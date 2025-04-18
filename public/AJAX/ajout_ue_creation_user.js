document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.getElementById("role");
    const ueContainer = document.getElementById("ue-container");
    const ueList = document.getElementById("ue-list");
    let selectedUEs = new Set(); // Pour gérer la sélection max de 6 UE

    roleSelect.addEventListener("change", function () {
        if (roleSelect.value === "etudiant") {
            ueContainer.style.display = "block";
            loadUEs(); // Charger les UE via AJAX
        } else {
            ueContainer.style.display = "none";
            ueList.innerHTML = ""; // Vider la liste des UE si on change de rôle
            selectedUEs.clear();
        }
    });

    function loadUEs() {
        fetch("../Controller/get_ue.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP ${response.status} - ${response.statusText}`);
                }
                return response.json(); // Essaye de convertir la réponse en JSON
            })
            .then(data => {
                ueList.innerHTML = ""; // Nettoyer la liste avant d'afficher

                if (!Array.isArray(data)) {
                    throw new Error("Réponse JSON invalide : " + JSON.stringify(data));
                }

                if (data.length === 0) {
                    ueList.innerHTML = `<p style="color:orange;">Aucune UE disponible.</p>`;
                    return;
                }

                data.forEach(ue => {
                    if (!ue.id || !ue.code || !ue.type || typeof ue.places_restantes !== "number") {
                        console.warn("UE invalide détectée:", ue);
                        return; // On ignore cette UE si elle est mal formatée
                    }

                    const checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.code = "ue[]";
                    checkbox.value = ue.id;
                    checkbox.id = `ue-${ue.id}`;

                    const label = document.createElement("label");
                    label.htmlFor = checkbox.id;
                    label.innerHTML = `${ue.code} (${ue.type}) - Places restantes: ${ue.places_restantes}`;

                    checkbox.addEventListener("change", function () {
                        if (checkbox.checked) {
                            if (selectedUEs.size >= 6) {
                                alert("Vous ne pouvez sélectionner que 6 UE.");
                                checkbox.checked = false;
                            } else {
                                selectedUEs.add(checkbox.value);
                            }
                        } else {
                            selectedUEs.delete(checkbox.value);
                        }
                    });

                    const div = document.createElement("div");
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    ueList.appendChild(div);
                });
            })
            .catch(error => {
                ueList.innerHTML = `<p style="color:red;">Erreur du chargement des UE : ${error.message}</p>`;
                console.error("Erreur AJAX:", error);
            });
    }
});