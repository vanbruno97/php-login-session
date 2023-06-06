<?php
// Définition des variables
$nomComplet = 'Bagnolok van';
$email = 'vbagnolok@yahoo.com';
$username = 'van';
$password = 'chiot';
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Afficher le message de bienvenue à l'utilisateur
   if(isset($_SESSION['nomComplet']) && isset($_SESSION['email'])){
    echo 'Bienvenue,' . $_SESSION['nomComplet'] . '! Votre nom utilisateur est' . $_SESSION['username'] . 'et votre adresse e-mail est :' . $_SESSION['email'] . '.';
    } 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <img src="logged.jpg" alt="utilisateur connecté">
                <div class="form-group"> 
                <b><?php echo   'Bienvenue dans votre compte, ' . $_SESSION['username'] . '!';?></b>
                <form action="deconnexion.php" method="post">
                        <button class="logout" type="submit"> Déconnexion </button>
                    </form>
                </div>
    </div>
</div>
</body>
</html>