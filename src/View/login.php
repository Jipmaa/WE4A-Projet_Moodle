<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta données -->
    <meta charset="UTF-8">
    <title>Login | UTBM</title>
    <link rel="icon" href="images/moodle.png" class="moodle">
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="Styles/authentification.css">
</head>

<body>
<!-- Corps de la page -->

<div class="authentification">

    <img src="images/logo_utbm.png" alt="logo utbm" class="logo-utbm">

    <script>
        //Fonction pour vérifier le formulaire
        function CheckLoginForm(){
            var nom = document.getElementById("name").value;
            var pass = document.getElementById("password").value;

            if(nom.length == 0){
                alert("Le champ du addresse mail ne doit pas être vide!")
                return false;
            }
            else if(pass.length == 0){
                alert("Le champ du mot de passe ne doit pas être vide!")
                return false;
            }
            else {
                return true;
            }
        }

        //Fonction pour montrer/cacher le mot de passe
        function TogglePass(icone){
            var field = document.getElementById("password");
            if (field.type == "password"){
                icone.src="images/password_show.png";
                field.type="text";
            }
            else {
                icone.src="images/password_hide.png";
                field.type="password";
            }
        }
    </script>

    <form action="" method="post" onsubmit="return CheckLoginForm()">
        <h1>Connexion</h1>
        <div>
            <div class="input-container">
                <label for="username" class="hidden-label">Login</label>
                <input type="text" id="username" name="username" placeholder="Adresse email" required> <br><br>
            </div>
            <br>
            <div class="input-container">
                <label for="password" class="hidden-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required> <br><br>
                <img id="passHide" onclick="TogglePass(this)"
                     src="images/password_hide.png" alt="Show/hide password" class="show-password" width=32 height=32>
            </div>
        </div>
        <br>
        <input type="submit" value="Connexion" id="connexion"> <br><br>
    </form>
    <a href="#" id="mdp">Mot de passe perdu ?</a>
</div>



</body>

</html>