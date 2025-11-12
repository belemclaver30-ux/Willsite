<?php


include(realpath(__DIR__ . '\\function\db_connection.php'));


if (isset($_GET['a_supprimer_id'])) {
  $id = (int) $_GET['a_supprimer_id'];


  // 1. Récupérer le chemin de l'image
  $stmt = $conn->prepare("SELECT image_url FROM products WHERE product_id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $product = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($product && !empty($product['image_url'])) {
    $imagePath = '../website_wws/uploads/' . $product['image_url'];
    // 2. Supprimer le fichier si il existe
    if (file_exists($imagePath)) {
      unlink($imagePath);


    }
  }


  // 3. Supprimer le produit de la base de données
  $stmt = $conn->prepare("DELETE FROM products WHERE product_id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  header("Location: ../liste_articles.php"); // Redirection après suppression
  exit();
  
}

?>

