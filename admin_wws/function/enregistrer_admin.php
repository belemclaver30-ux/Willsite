<?php
include('./db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['form_admin_nom'] ?? '';
  $prenom = $_POST['form_admin_prenom'] ?? '';
  $email = $_POST['form_admin_email'] ?? '';
  $Mot_de_passe = $_POST['form_admin_Mot_de_passe'] ?? '';
  $Poste = $_POST['form_admin_poste'] ?? '';
  $sexe = $_POST['form_admin_sexe'] ?? '';
  $statut = $_POST['form_admin_statut'] ?? '';




  if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($Mot_de_passe) && !empty($Poste) && !empty($sexe) && !empty($statut)) {
    // Hachage du mot de passe
    $motDePasse = password_hash($Mot_de_passe, PASSWORD_DEFAULT);
    // Insertion du nouvel administrateur
    $stmt = $conn->prepare("INSERT INTO administrateurs (nom, prenom, email, mot_de_passe, Poste, sexe, statut) VALUES (:nom, :prenom, :email, :motDePasse, :Poste, :sexe, :statut)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':motDePasse', $motDePasse);
    $stmt->bindParam(':Poste', $Poste);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':statut', $statut);

    $stmt->execute();
  }

  header("Location: ../liste_admin.php");
  exit();
}
