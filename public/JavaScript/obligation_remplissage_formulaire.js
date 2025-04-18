document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".creation").addEventListener("submit", function (event) {
        let role = document.getElementById("role").value;
        let pole = document.querySelector("input[name='pole']").value.trim();

        if (role === "null" || department === "null") {
            alert("Veuillez remplir tous les champs.");
            event.preventDefault(); // Empêche l'envoi du formulaire
        }
    });
});
