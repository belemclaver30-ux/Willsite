<?php
include(realpath(__DIR__ . '\\function\db_connection.php'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? '';
  $nom = $_POST['form_admin_nom'] ?? '';
  $prenom = $_POST['form_admin_prenom'] ?? '';
  $email = $_POST['form_admin_email'] ?? '';
  $Poste = $_POST['form_admin_poste'] ?? '';
  $sexe = $_POST['form_admin_sexe'] ?? '';
  $statut = $_POST['form_admin_statut'] ?? '';


  if (!empty($id)) {
    // Mise à jour du produit existant
    $stmt = $conn->prepare("UPDATE administrateurs SET nom = :nom, prenom = :prenom, email = :email, Poste = :Poste, sexe = :sexe, statut = :statut WHERE id = :id");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':Poste', $Poste);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  header("../Location: liste_admin.php");
  exit();
}

