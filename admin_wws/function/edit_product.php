<?php
include(realpath(__DIR__ . '\\function\db_connection.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $product_id = $_POST['product_id'] ?? '';
  $name = $_POST['produit_name'] ?? '';
  $processeur = $_POST['produit_processeur'] ?? '';
  $stockage = $_POST['produit_stockage'] ?? '';
  $ecran = $_POST['produit_ecran'] ?? '';
  $ram = $_POST['produit_ram'] ?? '';
  $prix = $_POST['produit_prix'] ?? 0;
  $category_id = $_POST['category_id'] ?? '';
  $imagePath = $_POST['existing_image'] ?? '';

  // Gestion du fichier image
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }
    $tmpName = $_FILES['image']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $imagePath = $uploadDir . $fileName;
    move_uploaded_file($tmpName, $imagePath);
  }

  if (!empty($product_id)) {
    // Mise à jour du produit existant
    $stmt = $conn->prepare("UPDATE products SET name = :name, processeur = :processeur,stockage = :stockage,ecran = :ecran,ram = :ram, prix = :prix, category_id = :category_id, image_url = :image WHERE product_id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':processeur', $processeur);
    $stmt->bindParam(':stockage', $stockage);
    $stmt->bindParam(':ecran', $ecran);
    $stmt->bindParam(':ram', $ram);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':image', $imagePath);
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
  }

  header("Location: ../liste_articles.php");
  exit();
}
?>
