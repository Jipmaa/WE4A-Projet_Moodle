<?php
header("Content-Type: application/json");

try {
    // Connexion à la base de données
    $bdd = new PDO("mysql:host=localhost;dbname=we4e_projet;charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données envoyées par AJAX
    $input = json_decode(file_get_contents("php://input"), true);
    $id = $input['id'] ?? null;
    $type = $input['type'] ?? null;
    $role = $input['role'] ?? null;

    // Vérifier les données reçues
    if (!$id || !$type || !$role) {
        echo json_encode(["error" => "ID, role ou type manquant."]);
        exit;
    }

    // Supprimer l'entrée dans la base de données en fonction du type
    if ($type === "utilisateurs") {
        if($role === "student"){
            $stmt = $bdd->prepare("DELETE FROM student WHERE id = :id");
        }elseif ($role === "teacher"){
            $stmt = $bdd->prepare("DELETE FROM teacher WHERE id = :id");
        }else{
            $stmt = $bdd->prepare("DELETE FROM employee WHERE id = :id");
        }

    } elseif ($type === "ue") {
        $stmt = $bdd->prepare("DELETE FROM ue WHERE id = :id");
    } else {
        echo json_encode(["error" => "Type non valide."]);
        exit;
    }

    // Exécuter la requête
    $stmt->execute(['id' => $id]);

    // Vérification du succès
    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Échec de la suppression. ID introuvable."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion ou de requête : " . $e->getMessage()]);
}
?>
