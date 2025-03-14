<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta données -->
    <meta charset="UTF-8">
    <title>Mes cours | UTBM</title>
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="icon" href="images/moodle.png">

</head>

<body>
    <!-- Corps de la page -->

    <!-- Menu de navigation -->
    <nav class="menu-nav">
        <div class="menu-gauche">
            <div class="logo-blanc">
                <a href="#"><img src="images/logo_utbm_blanc.png" alt="logo utbm"></a>
            </div>

            <ul class="lien-nav">
                <li><a href="tableaudebord.html">Tableau de bord</a></li>
                <li><a href="mescours.html">Mes cours</a></li>
                <li><a href="recherche.html">Recherche de cours</a></li>
            </ul>

            <div class="dropdown">
                <button class="dropbtn">Sites UTBM ⌵</button>
                <div class="dropdown-content">
                    <a href="#">MyUTBM</a>
                    <a href="#">Outlook</a>
                    <a href="#">Bibliothèque</a>
                    <a href="#">Association des Etudiants</a>
                    <a href="#">UTBM</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Semestre à l'UTBM ⌵</button>
                <div class="dropdown-content">
                    <a href="#">Annales</a>
                    <a href="#">Guide UE</a>
                    <a href="#">Découvrir l'UTBM</a>
                    <a href="#">Calendriers/Plannings</a>
                    <a href="#">Formulaire de scolarité</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Stages/S.E.E ⌵</button>
                <div class="dropdown-content">
                    <a href="#">Stages</a>
                    <a href="#">Career Center</a>
                    <a href="#">S.E.E</a>
                    <a href="#">Summer School</a>
                </div>
            </div>
        </div>

        <div class="logo-blanc">
            <a href="#"><img src="images/notification.png" alt="Notifications"></a>
            <a href="#"><img src="images/chat.png" alt="Messages"></a>
        </div>
    </nav>

    <div class="mescours">
        <main class="contenu">
            
                <h1>Mes cours</h1>

                <h2>Vue d'ensemble des cours</h2>

                <hr>

                <form>
                    <select class="gris">
                        <option>Tout</option>
                        <hr>
                        <option>En cours</option>
                        <option>A venir</option>
                        <option>Passés</option>
                        <hr>
                        <option>Favoris</option>
                        <hr>
                        <option>Retirés de l'affichage</option>
                    </select>
                    <input type="text" name="search" class="champ-recherche" placeholder="Rechercher">
                    <select class="gris">
                        <option>Trier par nom de cours</option>
                        <option>Trier par dernier accès</option>
                    </select>
                    <select class="gris">
                        <option>Carte</option>
                        <option>Liste</option>
                        <option>Résumé</option>
                    </select>
                </form>

                <br>

                <div class="cours-block1">
                    <div class="encadrement">
                        <img src="images/cours1.png" alt="cours1">
                        <a href="#">Cours 1</a>
                    </div>  
                    <div class="encadrement">
                        <img src="images/cours2.png" alt="cours2">
                        <a href="#">Cours 2</a>
                    </div> 
                    <div class="encadrement">
                        <img src="images/cours3.png" alt="cours3">
                        <a href="#">Cours 3</a>
                    </div>                   
                </div>

                <br>

                <div class="cours-block1">
                    <div class="encadrement">
                        <img src="images/cours1.png" alt="cours1">
                        <a href="#">Cours 4</a>
                    </div>  
                    <div class="encadrement">
                        <img src="images/cours2.png" alt="cours2">
                        <a href="#">Cours 5</a>
                    </div> 
                    <div class="encadrement">
                        <img src="images/cours3.png" alt="cours3">
                        <a href="#">Cours 6</a>
                    </div>                   
                </div>

                <br>

                <form>
                    <label>Afficher</label>
                    <select class="gris">
                        <option>6</option>
                        <option selected>Tout</option>
                    </select>
                </form>
            
        </main>

        <aside class="sidebar-right">
            <div class="espace">
                <h2>Bienvenue sur la plateforme Moodle de l'UTBM.</h2>
            <p>Vous êtes sur votre tableau de bord. Vous pouvez le configurer selon vos besoins.</p>
            </div>
            <div class="espace">
                <h2>Compétences Numériques</h2>
                <img src="images/pix.png" alt="pix">
                <p>L'UTBM est Centre de certification <strong>Pix</strong>.
                    Il s'agit du service public en ligne pour évaluer, développer et certifier ses <strong>compétences numériques</strong></p>
                    <button class="info">Information</button>
            </div>
            <div class="espace">
                <h2>Navigations</h2>                
            </div>
            
    </div>




</body>

</html>