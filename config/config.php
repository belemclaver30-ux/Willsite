<?php
/**
 * Configuration générale de l'application
 * Willsite - Boutique Informatique
 */

// Démarrer la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir les chemins de base
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('UPLOAD_PATH', PUBLIC_PATH . '/uploads');

// Configuration de l'application
define('APP_NAME', 'Willsite');
define('APP_ENV', 'development'); // development, production
define('APP_DEBUG', true); // Mettre false en production

// URL de base (à adapter selon votre environnement)
define('BASE_URL', 'http://localhost/Willsite');
define('ASSETS_URL', BASE_URL . '/public/assets');
define('UPLOADS_URL', BASE_URL . '/public/uploads');

// Configuration de sécurité
define('SECURITY_SALT', 'your-random-salt-here-change-this');

// Paramètres de l'application
define('DEFAULT_TIMEZONE', 'Africa/Abidjan');
date_default_timezone_set(DEFAULT_TIMEZONE);

// Gestion des erreurs
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Inclure la configuration de la base de données
require_once CONFIG_PATH . '/database.php';

// Inclure l'autoloader
require_once INCLUDES_PATH . '/autoload.php';

// Inclure les helpers
require_once INCLUDES_PATH . '/helpers.php';
