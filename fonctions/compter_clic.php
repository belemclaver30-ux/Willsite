<?php
include('db_connection.php'); // adapte le chemin si besoin

if (isset($_GET['product_id']) && isset($_GET['text'])) {
    $product_id = intval($_GET['product_id']);
    $message = urlencode($_GET['text']);

    try {
        $stmt = $conn->prepare("INSERT INTO clics_whatsapp (product_id, date_clic) VALUES (:product_id, NOW())");
        $stmt->execute(['product_id' => $product_id]);

        // Redirection vers WhatsApp
        header("Location: https://wa.me/+22655108607?text=" . $message);
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Paramètres manquants.";
}

