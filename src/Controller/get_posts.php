<?php
session_start();
if (!isset($_SESSION['id'])) { // à différencier plus tard de l'id teacher
    // Rediriger si l'étudiant n'est pas connecté
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['id']; // ID de l'étudiant connecté



try {
    $pdo = new PDO("mysql:host=localhost;dbname=we4a_projet;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}


// Récupérer les posts du plus récent au plus ancien

$sql = "SELECT * FROM post 
    INNER JOIN ue ON post.id_ue = ue.id 
    INNER JOIN teacher ON post.id_teacher = teacher.id 
    INNER JOIN inscription ON ue.id = inscription.id_ue
    WHERE inscription.id_student = :student_id
    ORDER BY post.date DESC;
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['student_id' => $student_id]);

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Renvoyer les résultats en JSON
echo json_encode($posts);
?>