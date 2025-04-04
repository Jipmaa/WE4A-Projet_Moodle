<?php
// Start a session to handle session variables
session_start();

// Enable error messages for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize email and password variables
$email = "";
$password = "";

// 1. Check if session variables are set
if (isset($_SESSION["email"]) && isset($_SESSION["password"])) {

    // If session variables exist, retrieve email and password
    $email = strtolower(trim($_SESSION["email"])); // Normalize email to lowercase and trim whitespace
    $password = $_SESSION["password"]; // Get password from session

} elseif (isset($_POST["email"]) && isset($_POST["password"])) {

    // Retrieve email and password from POST data
    $email = strtolower(trim($_POST["email"])); // Normalize and clean email
    $password = $_POST["password"]; // Get password from POST data

} else {

    // If neither session nor POST data is available, redirect to login page
    header("Location: ../View/login.html");
    exit();
}

try {

    // Database connection (using PDO)
    $db = new PDO("mysql:host=localhost;dbname=we4a_projet;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error handling mode

    // Prepare SQL query to check if the email exists in the database
    $stmt = $db->prepare("SELECT * FROM student WHERE email = ?");
    $stmt->execute([$email]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si l'email n'existe pas dans la table student, vérifier dans la table teacher
    if ($student && (password_verify($password, $student['password']) || $password == $student['password'])) { //supprimer $password == $student['password'])

        var_dump($student);
        var_dump($email);

        $_SESSION["email"] = $email;
        $_SESSION["name"] = $student["name"];
        $_SESSION["id"] = $student["id"];
        $_SESSION["surname"] = $student["surname"];

        // Une fois que l'utilisateur est connecté avec succès, définissez les informations dans sessionStorage
        echo "<script>
            sessionStorage.setItem('name', '" . addslashes($_SESSION['name']) . "');
            sessionStorage.setItem('id', '" . $_SESSION['id'] . "');
            window.location.href = '../View/mescours.html';
        </script>";

        //header("Location: ../View/mescours.html");
        exit();

    }
        $stmt = $db->prepare("SELECT * FROM teacher WHERE email = ?");
        $stmt->execute([$email]);
        $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
        if($teacher && (password_verify($password, $teacher['password']) || $password == $teacher['password'])) { //supprimer $password == $teacher['password'])

            $id_teacher = $teacher['id']; // Récupérer l'id de l'enseignant
            $stmt = $db->prepare("SELECT id FROM admin WHERE id_teacher = ?");
            $stmt->execute([$id_teacher]);

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($teacher);
            var_dump($email);

            $_SESSION["email"] = $email;
            $_SESSION["name"] = $teacher["name"];
            $_SESSION["id"] = $teacher["id"];
            $_SESSION["surname"] = $teacher["surname"];

            if($admin) {
                $_SESSION["admin"] = $admin;
            }

            // Une fois que l'utilisateur est connecté avec succès, définissez les informations dans sessionStorage
            echo "<script>
                sessionStorage.setItem('name', '" . addslashes($_SESSION['name']) . "');
                sessionStorage.setItem('id', '" . $_SESSION['id'] . "');
                sessionStorage.setItem('admin', '" . (isset($_SESSION['admin']) ? 'true' : 'false') . "');
                window.location.href = '../View/mescours.html';
            </script>";


            //header("Location: ../View/mescours.html");
            exit();

        } else {
                // If email or password is incorrect, display error and redirect to login page with error message
                echo "Incorrect email or password.";
                header("Location: ../View/login.html?error=email/password/");
            }

} catch (Exception $e) {
    // Catch any exceptions (database errors) and display the error message
    echo "Error: " . $e->getMessage();
    exit();
}

?>
