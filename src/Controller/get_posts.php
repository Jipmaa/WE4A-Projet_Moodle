<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    // Rediriger si l'étudiant n'est pas connecté
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id']; // ID de l'étudiant connecté



try {
    $pdo = new PDO("mysql:host=localhost;dbname=we4a_projet;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}


// Récupérer les posts du plus récent au plus ancien
$sql = "SELECT p.id, p.title, p.content, p.date, p.priority, 
       IF(p.priority = 0, 'importance_soft.png', 'haute_importance.png') AS image
FROM post p
JOIN bloc b ON p.id_bloc = b.id
JOIN ue u ON b.id_ue = u.id
JOIN inscription i ON u.id = i.id_ue
WHERE i.id_student = :student_id
ORDER BY p.date DESC;
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['student_id' => $student_id]);

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Renvoyer les résultats en JSON
echo json_encode($posts);
?>