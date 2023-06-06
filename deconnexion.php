<?php
// Détruire la session en cours
session_start();
session_destroy();

// Rediriger vers la page de connexion
header('Location: index.php');
exit;
?>