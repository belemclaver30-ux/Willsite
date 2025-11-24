<?php
/**
 * Configuration centrale de l'application
 * Ce fichier contient tous les paramètres de configuration du site
 */

// Empêcher l'accès direct
if (!defined('APP_ACCESS')) {
    define('APP_ACCESS', true);
}

// ================================
// CONFIGURATION DE BASE
// ================================

// URL de base du site
define('BASE_URL', 'http://localhost/Willsite');

// Chemins absolus
define('ROOT_PATH', __DIR__ . '/..');
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('UPLOADS_PATH', ROOT_PATH . '/assets/img/uploads');

// ================================
// CONFIGURATION DE LA BASE DE DONNÉES
// ================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'boutique_informatique');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// ================================
// CONFIGURATION DE SÉCURITÉ
// ================================

// Mode debug
define('APP_DEBUG', true);

// Clé de sécurité pour les tokens CSRF
define('SECURITY_KEY', 'willsite_secure_key_2024');

// Durée de vie de la session (en secondes)
define('SESSION_LIFETIME', 7200); // 2 heures

// ================================
// CONFIGURATION DE L'APPLICATION
// ================================

// Nom du site
define('SITE_NAME', 'Willsite - Boutique Informatique');

// Email de contact
define('CONTACT_EMAIL', 'contact@willsite.com');

// Nombre de produits par page
define('PRODUCTS_PER_PAGE', 12);

// Taille maximale des fichiers uploadés (en octets)
define('MAX_UPLOAD_SIZE', 5242880); // 5 MB

// Extensions autorisées pour les images
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// ================================
// TIMEZONE
// ================================

date_default_timezone_set('Africa/Abidjan');

// ================================
// GESTION DES ERREURS
// ================================

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// ================================
// CHARGEMENT DES DÉPENDANCES
// ================================

// Chargement de la connexion à la base de données
require_once CONFIG_PATH . '/database.php';

// Chargement des fonctions helpers
if (file_exists(INCLUDES_PATH . '/helpers.php')) {
    require_once INCLUDES_PATH . '/helpers.php';
}

// Chargement de l'autoloader
if (file_exists(INCLUDES_PATH . '/autoload.php')) {
    require_once INCLUDES_PATH . '/autoload.php';
}

// ================================
// CONFIGURATION DE LA SESSION
// ================================

// Définir la durée de vie de la session AVANT de démarrer la session
ini_set('session.gc_maxlifetime', SESSION_LIFETIME);

// Démarrer la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ================================
// FONCTIONS UTILITAIRES GLOBALES
// ================================

/**
 * Obtenir l'URL complète d'un chemin
 */
if (!function_exists('url')) {
    function url($path = '') {
        return BASE_URL . '/' . ltrim($path, '/');
    }
}

/**
 * Obtenir le chemin d'un asset
 */
if (!function_exists('asset')) {
    function asset($path = '') {
        return BASE_URL . '/assets/' . ltrim($path, '/');
    }
}

/**
 * Rediriger vers une URL
 */
if (!function_exists('redirect')) {
    function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
}

/**
 * Échapper les données pour l'affichage HTML
 */
if (!function_exists('e')) {
    function e($value) {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Vérifier si l'utilisateur est connecté
 */
if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
}

/**
 * Obtenir l'utilisateur connecté
 */
if (!function_exists('currentUser')) {
    function currentUser() {
        return $_SESSION['user'] ?? null;
    }
}

/**
 * Définir un message flash
 */
if (!function_exists('setFlash')) {
    function setFlash($type, $message) {
        $_SESSION['flash'][$type] = $message;
    }
}

/**
 * Obtenir et supprimer un message flash
 */
if (!function_exists('getFlash')) {
    function getFlash($type) {
        if (isset($_SESSION['flash'][$type])) {
            $message = $_SESSION['flash'][$type];
            unset($_SESSION['flash'][$type]);
            return $message;
        }
        return null;
    }
}

/**
 * Formater un prix
 */
if (!function_exists('formatPrice')) {
    function formatPrice($price) {
        return number_format($price, 0, ',', ' ') . ' FCFA';
    }
}

/**
 * Générer un token CSRF
 */
if (!function_exists('generateCsrfToken')) {
    function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

/**
 * Vérifier un token CSRF
 */
if (!function_exists('verifyCsrfToken')) {
    function verifyCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}

// ================================
// FIN DE LA CONFIGURATION
// ================================
