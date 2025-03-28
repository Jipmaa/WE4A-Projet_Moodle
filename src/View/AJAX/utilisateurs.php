<?php

try {
    // Connexion à la base de données avec PDO
    $liste = new PDO("mysql:host=localhost;dbname=we4e_projet;charset=utf8", "root", "");
    $liste->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer et valider le type depuis POST
    $type = $_POST['typeActuel'];

    // Préparer la requête en fonction du type
    if ($type === "utilisateurs") {
        $requete = $liste->prepare("SELECT * FROM student");
    } else{
        $requete = $liste->prepare("SELECT * FROM ue");
    }

    // Exécuter la requête
    $requete->execute();
    //récupere le résultat
    $data = $requete->fetchAll();

    // Retour des données JSON
    echo json_encode($data);

} catch (PDOException $e) {
    //gestion des erreurs
    echo json_encode(["error" => "Erreur de connexion ou de requête : " . $e->getMessage()]);
}

?>