<?php
/**
 * Traitement du formulaire de contact
 */

// Inclure la configuration (la session est démarrée automatiquement)
require_once __DIR__ . '/../config/config.php';

// Connexion à la base de données
$conn = getDbConnection();

// Vérifier si la requête est POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: ' . url('contact.php'));
    exit();
}

// Récupérer et nettoyer les données
$email = trim($_POST['email'] ?? '');
$msg = trim($_POST['msg'] ?? '');

// Validation
$errors = [];

if (empty($email)) {
    $errors[] = "L'email est requis.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "L'email n'est pas valide.";
}

if (empty($msg)) {
    $errors[] = "Le message est requis.";
} elseif (strlen($msg) < 10) {
    $errors[] = "Le message doit contenir au moins 10 caractères.";
}

// Si erreurs, rediriger avec message d'erreur
if (!empty($errors)) {
    $_SESSION['contact_errors'] = $errors;
    $_SESSION['contact_old'] = ['email' => $email, 'msg' => $msg];
    header('Location: ' . url('contact.php'));
    exit();
}

// Insérer dans la base de données
try {
    $stmt = $conn->prepare("INSERT INTO messages (email, message, date_envoi) VALUES (:email, :message, NOW())");
    $success = $stmt->execute([
        ':email' => $email,
        ':message' => $msg
    ]);
    
    if ($success) {
        $_SESSION['contact_success'] = "Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.";
    } else {
        $_SESSION['contact_errors'] = ["Une erreur est survenue lors de l'envoi de votre message."];
    }
} catch (PDOException $e) {
    if (APP_DEBUG) {
        $_SESSION['contact_errors'] = ["Erreur de base de données : " . $e->getMessage()];
    } else {
        $_SESSION['contact_errors'] = ["Une erreur est survenue. Veuillez réessayer plus tard."];
    }
}

// Rediriger vers la page de contact
header('Location: ' . url('contact.php'));
exit();
