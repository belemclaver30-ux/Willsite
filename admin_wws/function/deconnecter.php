<?php
session_start();

$_SESSION['etat'] = "deconnecte"; 

session_destroy();

header("Location: ../login_admin/login.php"); // Redirection vers login

exit();

