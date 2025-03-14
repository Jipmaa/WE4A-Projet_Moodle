<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta données -->
    <meta charset="UTF-8">
    <title>Se connecter sur le site | UTBM</title>
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="icon" href="images/moodle.png">
    <link rel="stylesheet" href="Styles/authentification.css">
</head>

<body>
    <!-- Corps de la page -->
    
    
        <div class="authentification">

            <img src="images/logo_utbm.png" alt="logo utbm" class="logo-utbm">

            <form action="" method="post">
                <input type="text" id="username" name="username" placeholder="Nom utilisateur" required> <br><br>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required> <br><br>
                <input type="submit" value="Connexion" id="connexion"> <br><br>
            </form>
            <a href="#" id="mdp">Mot de passe perdu ?</a>

            <hr class="hr-aut">

            <h1>Se connecter au moyen du compte :</h1>

            <div class="bouton"> <!--organise la disposition et l'alignement des boutons-->
                <button type="button" class="aut_btn"> <!--gère le style, l'apparence des boutons-->
                    <img src="images/tour_utbm.png" alt="tour utbm" class="tour"> Authentification UTBM
                </button> <br><br>
                <button type="button" class="aut_btn">Fédération d'identité (UTT, UFC, ...)</button>
            </div>

            <hr class="hr-aut">

            <div class="alignement">
                <form action="" method="post" class="form-langue">
                    <select name="langue" class="select-langue">
                        <option value="de">Deutsh (de)</option>
                        <option value="en">English (en)</option>
                        <option value="es">Español - Internacional (es)</option>
                        <option value="fr" selected>Français (fr)</option>
                        <option value="it">Italiano (it)</option>
                        <option value="ch">简体中文(zh_cn)</option>
                    </select>
                </form>

                <div class="barre_verticale"></div>

                <button type="cookies" class="cookie">Avis relatif aux cookies</button>
                
            </div>

            <br>

        </div>

    

</body>

</html>