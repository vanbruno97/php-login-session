<?php
session_start();
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Vérifions si les infos d'identification sont correctes
}if($username === 'van' && $password ==='chiot'){
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = true;
    // Vers la page de bienvenue
    header('Location: bienvenue.php');
    exit();
} else{
    // Message d'erreur
    echo'Identifiants incorrects';

}

?>