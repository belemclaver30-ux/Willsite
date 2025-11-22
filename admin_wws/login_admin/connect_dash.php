<?php
session_start();

include __DIR__ . '/../function/db_connection.php';
//include ("../fonctions/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if (!empty($email) && !empty($password)) {
        // Requête SQL avec paramètre nommé
        $stmt = $conn->prepare("SELECT * FROM administrateurs WHERE email = :email");
        $stmt->execute(['email' => $email]); 
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            $_SESSION['id'] = $admin['id'];
            $_SESSION['nom'] = $admin['nom'];
            $_SESSION['statut'] = $admin['statut']; 
            $_SESSION['etat'] = "connecte"; 


            header("Location: /Willsite/admin_wws/index.php");
            exit;
        } else {
            echo "<script>alert('Email ou mot de passe incorrect'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Veuillez remplir tous les champs'); window.history.back();</script>";
    }
}
?>
