<?php

// Démarre la session
session_start();

$chemin = realpath(__DIR__ . '/../fonctions/db_connection.php');


if ($chemin) {
    echo "Chemin trouvé : $chemin <br>";
} else {
    echo "Fichier non trouvé !";
}
?>
