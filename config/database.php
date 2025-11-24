<?php
/**
 * Configuration et connexion à la base de données
 */

// Empêcher l'accès direct
if (!defined('APP_ACCESS')) {
    die('Accès direct non autorisé');
}

/**
 * Fonction de connexion à la base de données
 * Retourne une instance PDO
 */
function getDbConnection() {
    static $conn = null;
    
    if ($conn === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $conn = new PDO($dsn, DB_USER, DB_PASS, $options);
            
        } catch (PDOException $e) {
            if (APP_DEBUG) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            } else {
                die("Erreur de connexion à la base de données. Veuillez réessayer plus tard.");
            }
        }
    }
    
    return $conn;
}

// Créer la connexion globale pour compatibilité avec l'ancien code
$conn = getDbConnection();
