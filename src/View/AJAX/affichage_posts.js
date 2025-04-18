$(document).ready(function () {
    $.ajax({
        url: '../Controller/get_posts.php', // Fichier PHP pour récupérer les posts
        method: 'GET',
        dataType: 'json',
        success: function (posts) {
            posts.forEach(function (post) {
                var iconeHTML = post.priority == 0 ?
                    `<ion-icon name="alert-outline"></ion-icon>` :
                    `<ion-icon name="warning-outline"></ion-icon>`;
                var zipLink = post.zip_file ? `<a href="uploads/${post.zip_file}" download>Télécharger le ZIP</a>` : '';

                var postHtml = `
    <div class="post">
        <div class="ue-name">
            <h2>${post.code}</h2> <!-- Nom de l'UE -->
        </div>
        <div class="post-image">
            ${iconeHTML} <!-- L'icône est insérée ici -->
        </div>
        <div class="post-content">
            <h3>${post.title}</h3>
            <p>${post.content}</p>
            <p class="post-date">
                ${post.date} — par ${post.surname} ${post.name} <!-- Date + Auteur -->
            </p>
            <p class="post-zip">${zipLink}</p>
        </div>
    </div>
`;
                $('#posts-container').append(postHtml);
            });
        }
    });
});