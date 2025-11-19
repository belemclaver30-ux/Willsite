<?php
/**
 * Autoloader pour les classes de l'application
 */

spl_autoload_register(function ($class) {
    // Préfixe du namespace du projet
    $prefix = '';
    
    // Répertoire de base pour les classes
    $base_dir = APP_PATH . '/';
    
    // Remplacer le préfixe du namespace par le répertoire de base
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Obtenir le nom relatif de la classe
    $relative_class = substr($class, $len);
    
    // Remplacer les séparateurs de namespace par des séparateurs de répertoire
    // et ajouter .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // Si le fichier existe, le charger
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * Charger automatiquement les modèles
 */
function loadModel($modelName) {
    $modelFile = APP_PATH . '/models/' . $modelName . '.php';
    if (file_exists($modelFile)) {
        require_once $modelFile;
        return true;
    }
    return false;
}

/**
 * Charger automatiquement les contrôleurs
 */
function loadController($controllerName) {
    $controllerFile = APP_PATH . '/controllers/' . $controllerName . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return true;
    }
    return false;
}
