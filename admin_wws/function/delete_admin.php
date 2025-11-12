<?php
include(realpath(__DIR__ . '\\function\db_connection.php'));



if (isset($_GET['a_supprimer_id'])) {
  $id = (int) $_GET['a_supprimer_id'];

  // 3. Supprimer le produit de la base de données
  $stmt = $conn->prepare("DELETE FROM administrateurs WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  header("Location: ../liste_admin.php"); // Redirection après suppression
  exit();
  
}

?>

