<?php
function getRandomImageByCategoryName($categoryName, $conn) {
    try {
        // Requête SQL pour récupérer une image aléatoire basée sur le nom de la catégorie
        $sql = "
            SELECT p.image_url 
            FROM products p
            JOIN categories c ON p.category_id = c.category_id
            WHERE c.name = :categoryName
            ORDER BY RAND() LIMIT 1
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourner l'URL de l'image si elle existe, sinon une image par défaut
        return $result ? $result['image_url'] : 'images/default.jpg';
    } catch (PDOException $e) {
        // Afficher une erreur SQL si nécessaire
        echo "Erreur SQL : " . $e->getMessage();
        return 'images/default.jpg';
    }
}
?>
