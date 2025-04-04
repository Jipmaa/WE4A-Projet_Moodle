document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.getElementById("role");
    const admin = document.getElementById("admin");

    roleSelect.addEventListener("change", function () {
        if (roleSelect.value === "etudiant") {
            admin.style.display = "none"; // ✅ Masquer si étudiant
        } else {
            admin.style.display = "block"; // ✅ Afficher sinon
        }
    });
});
