<?php

header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=we4a_projet;charset=utf8", "root", ""); // Connexion à la BDD
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        exit();
    }
    $sql = "
        SELECT ue.id, ue.code, ue.type, ue.capacity - COALESCE(inscrits.nb_inscrits, 0) AS places_restantes
        FROM ue
        LEFT JOIN (
            SELECT id_ue, COUNT(*) AS nb_inscrits 
            FROM inscription 
            GROUP BY id_ue
        ) inscrits ON ue.id = inscrits.id_ue
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ues = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($ues);
?>
