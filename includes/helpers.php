<?php
/**
 * Fonctions utilitaires globales
 */

/**
 * Échapper les données pour l'affichage HTML
 * @param string $data
 * @return string
 */
function escape($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

/**
 * Rediriger vers une URL
 * @param string $url
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Obtenir l'URL complète
 * @param string $path
 * @return string
 */
function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Obtenir l'URL d'un asset
 * @param string $path
 * @return string
 */
function asset($path) {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

/**
 * Obtenir l'URL d'un upload
 * @param string $path
 * @return string
 */
function upload($path) {
    return UPLOADS_URL . '/' . ltrim($path, '/');
}

/**
 * Vérifier si l'utilisateur est connecté
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Vérifier si l'utilisateur est admin
 * @return bool
 */
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Obtenir un message flash
 * @param string $key
 * @return string|null
 */
function getFlashMessage($key = 'message') {
    if (isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
    return null;
}

/**
 * Définir un message flash
 * @param string $message
 * @param string $key
 */
function setFlashMessage($message, $key = 'message') {
    $_SESSION['flash'][$key] = $message;
}

/**
 * Formater le prix
 * @param float $price
 * @return string
 */
function formatPrice($price) {
    return number_format($price, 0, ',', ' ') . ' FCFA';
}

/**
 * Tronquer un texte
 * @param string $text
 * @param int $length
 * @param string $suffix
 * @return string
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . $suffix;
    }
    return $text;
}

/**
 * Inclure une vue
 * @param string $view
 * @param array $data
 */
function view($view, $data = []) {
    extract($data);
    $viewFile = APP_PATH . '/views/' . $view . '.php';
    
    if (file_exists($viewFile)) {
        require $viewFile;
    } else {
        die("Vue introuvable : " . $view);
    }
}

/**
 * Obtenir la valeur d'une variable POST en toute sécurité
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function post($key, $default = null) {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

/**
 * Obtenir la valeur d'une variable GET en toute sécurité
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function get($key, $default = null) {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

/**
 * Logger un message
 * @param string $message
 * @param string $level
 */
function logMessage($message, $level = 'info') {
    $logFile = STORAGE_PATH . '/logs/app.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[$timestamp] [$level] $message" . PHP_EOL;
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}

/**
 * Générer un token CSRF
 * @return string
 */
function generateCsrfToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifier le token CSRF
 * @param string $token
 * @return bool
 */
function verifyCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Valider une adresse email
 * @param string $email
 * @return bool
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Nettoyer une chaîne
 * @param string $string
 * @return string
 */
function sanitizeString($string) {
    return trim(strip_tags($string));
}
