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
        <div class="input-container">
            <input type="text" id="username" name="username" placeholder="Nom utilisateur" required> <br><br>
        </div>
        <div class="input-container">
            <input type="password" id="password" name="password" placeholder="Mot de passe" required> <br><br>
            <img src="images/password_show.png" alt="show password" class="show-password">
        </div>
        <input type="submit" value="Connexion" id="connexion"> <br><br>
    </form>
    <a href="#" id="mdp">Mot de passe perdu ?</a>

</div>



</body>

</html>