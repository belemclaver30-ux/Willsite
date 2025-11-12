<?php
// Définir les informations de connexion
$host = "localhost"; // Hôte (ici, localhost pour XAMPP)
$dbname = "boutique_informatique"; // Nom de votre base de données
$username = "root"; // Nom d'utilisateur (par défaut pour XAMPP)
$password = ""; // Mot de passe (par défaut vide sur XAMPP)

try {
    // Créer une nouvelle instance PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Définir le mode d'erreur de PDO pour qu'il lance une exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
