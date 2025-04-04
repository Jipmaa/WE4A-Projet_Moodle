$(document).ready(function() {
    $.ajax({
        url: 'get_posts.php', // Fichier PHP pour récupérer les posts
        method: 'GET',
        dataType: 'json',
        success: function(posts) {
            posts.forEach(function(post) {
                var image = post.priority == 0 ? 'importance_soft.png' : 'haute_importance.png';
                var zipLink = post.zip_file ? `<a href="uploads/${post.zip_file}" download>Télécharger le ZIP</a>` : '';

                var postHtml = `
                    <div class="post">
                        <div class="post-image">
                            <img src="images/${image}" alt="importance">
                        </div>
                        <div class="post-content">
                            <h2>${post.title}</h2>
                            <p>${post.content}</p>
                            <p class="post-date">${post.date}</p>
                            <p class="post-zip">${zipLink}</p>
                        </div>
                    </div>
                `;
                $('#posts-container').append(postHtml);
            });
        }
    });
});