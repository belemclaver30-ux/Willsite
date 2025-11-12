<?php
include('./db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['produit_name'] ?? '';
  $processeur = $_POST['produit_processeur'] ?? '';
  $stockage = $_POST['produit_stockage'] ?? '';
  $ecran = $_POST['produit_ecran'] ?? '';
  $ram = $_POST['produit_ram'] ?? '';
  $prix = $_POST['produit_prix'] ?? 0;
  $category_id = $_POST['category_id'] ?? null;

  // Répertoire de stockage des images
  $uploadDir = '../../assets/img/uploads/';
  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  // Fonctions d'upload
  function uploadImage($fileInputName, $uploadDir) {
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
      $tmpName = $_FILES[$fileInputName]['tmp_name'];
      $fileName = basename($_FILES[$fileInputName]['name']);
      $destination = $uploadDir . $fileName;
      move_uploaded_file($tmpName, $destination);
      return $fileName;
    }
    return '';
  }

  // Upload des 4 images
  $image_principale = uploadImage('image', $uploadDir);
  $first_image = uploadImage('first_image', $uploadDir);
  $second_image = uploadImage('second_image', $uploadDir);
  $third_image = uploadImage('third_image', $uploadDir);

  
  // Validation
  if (!empty($name) && !empty($processeur) && !empty($stockage) && is_numeric($ecran) && !empty($ram) && is_numeric($prix) && is_numeric($category_id) && !empty($image_principale)) {
    $stmt = $conn->prepare("INSERT INTO products 
      (name, processeur, stockage, ecran, ram, prix, image_url, first_image, second_image, third_image, category_id)
      VALUES 
      (:name, :processeur, :stockage, :ecran, :ram, :prix, :image_url, :first_image, :second_image, :third_image, :category_id)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':processeur', $processeur);
    $stmt->bindParam(':stockage', $stockage);
    $stmt->bindParam(':ecran', $ecran);
    $stmt->bindParam(':ram', $ram);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':image_url', $image_principale);
    $stmt->bindParam(':first_image', $first_image);
    $stmt->bindParam(':second_image', $second_image);
    $stmt->bindParam(':third_image', $third_image);
    $stmt->bindParam(':category_id', $category_id);

    $stmt->execute();
    echo "Produit inséré avec succès.<br>";

    header("Location: ../liste_articles.php");
    exit();
  } else {
    echo "Erreur : Tous les champs sont obligatoires et les champs numériques doivent être valides.";
  }
}
?>
