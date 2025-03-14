<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta données -->
    <meta charset="UTF-8">
    <title>UTBM</title>
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="icon" href="images/moodle.png">
    <link rel="stylesheet" href="Styles/authentification.css">
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


    <div class="menu-droite">
        <form action="" method="post" class="form-langue-accueil">
            <select name="langue" class="select-langue-accueil">
                <option value="de">Deutsh (de)</option>
                <option value="en">English (en)</option>
                <option value="es">Español - Internacional (es)</option>
                <option value="fr" selected>Français (fr)</option>
                <option value="it">Italiano (it)</option>
                <option value="ch">简体中文(zh_cn)</option>
            </select>
        </form>

        <div class="barre_verticale"></div>

        <ul class="lien-nav">
            <li><a href="#">Connexion</a></li>
        </ul>

    </div>

</nav>

</body>

</html>