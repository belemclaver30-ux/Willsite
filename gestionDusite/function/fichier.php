<?php
function uploadImageFile($fileInput, $uploadDir = "../static/images/") {
    // Vérifie si le fichier est présent
    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES[$fileInput];
        
        // Vérifie l'extension et le type MIME
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Extensions autorisées
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($fileExtension, $allowedExtensions) || !in_array($file['type'], $allowedMimeTypes)) {
            return "Erreur : Le fichier doit être une image (JPG, PNG, GIF, WEBP).";
        }

        // Génère un nom de fichier unique
        $randomFileName = uniqid('img_', true) . '.' . $fileExtension;

        // Crée le répertoire d'upload s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $destination = $uploadDir . $randomFileName;

        // Déplace le fichier uploadé vers le dossier cible
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $randomFileName;
        } else {
            return "Erreur : Impossible de déplacer le fichier.";
        }
    } else {
        return "Erreur : Aucun fichier n'a été uploadé.";
    }
}

// Exemple d'utilisation dans un script PHP
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     echo uploadImageFile('image_file');
// }
?>
