<?php
/**
 * Configuration de la base de données
 */

// Paramètres de connexion
define('DB_HOST', 'localhost');
define('DB_NAME', 'boutique_informatique');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

/**
 * Obtenir une connexion PDO à la base de données
 * @return PDO
 */
function getDbConnection() {
    static $conn = null;
    
    if ($conn === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $conn = new PDO($dsn, DB_USER, DB_PASS);
            
            // Définir le mode d'erreur de PDO pour qu'il lance une exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Retourner les résultats sous forme de tableaux associatifs par défaut
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            if (APP_DEBUG) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            } else {
                die("Erreur de connexion à la base de données. Veuillez contacter l'administrateur.");
            }
        }
    }
    
    return $conn;
}

// Créer une instance globale pour la compatibilité avec l'ancien code
$conn = getDbConnection();
