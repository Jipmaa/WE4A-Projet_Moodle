<?php
header("Content-Type: application/json");

try {
    $bdd = new PDO("mysql:host=localhost;dbname=we4a_projet;charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifiez si les données POST sont transmises
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['id']) && isset($input['type']) && isset($input['role'])) {
        $id = $input['id'];
        $type = $input['type'];
        $role = $input['role'];

        if ($type === "utilisateurs") {
            if($role === "student"){
                $stmt = $bdd->prepare("SELECT * FROM student WHERE id = :id");
            }elseif ($role === "teacher") {
                $stmt = $bdd->prepare("SELECT * FROM teacher WHERE id = :id");
            }else{
                $stmt = $bdd->prepare("SELECT * FROM employee WHERE id = :id");
            }
        } elseif ($type === "ue") {
            $stmt = $bdd->prepare("SELECT * FROM ue WHERE id = :id");
        } else {
            echo json_encode(['error' => 'Type non valide']);
            exit;
        }

        // Exécuter la requête
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'Aucun élément trouvé pour cet ID']);
        }
    } else {
        echo json_encode(['error' => 'Données POST manquantes']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion : ' . $e->getMessage()]);
}
