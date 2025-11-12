<?php
include(realpath(__DIR__ . '\\function\db_connection.php'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $msg = $_POST['msg'] ?? '';

    if (!empty($email) && !empty($msg)) {
        try {
            $stmt = $conn->prepare("INSERT INTO messages (email, message, date_envoi) VALUES (:email, :message, NOW())");
            $stmt->execute([
                ':email' => $email,
                ':message' => $msg
            ]);
            echo "Message envoyé avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}

