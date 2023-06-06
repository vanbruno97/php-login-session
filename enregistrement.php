<?php
// Définition des variables
$nomComplet = 'Bagnolok van';
$email = 'vbagnolok@yahoo.com';
$username = 'van';
$password = 'chiot';
// Démarrer la session
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification du remplissage de tous les champs
    if(isset($_POST['nom-complet']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
 // Recupérer les données du formulaire
 $nomComplet = $_POST['nom-complet'];
 $email = $_POST['email'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 // Stocker les informations de l'utilisateur dans des variables de session
$_SESSION['nomComplet'] = $nomComplet;
$_SESSION['email'] = $email;
$_SESSION['username'] = $username;
$_SESSION['logged_in'] = true;
// Rediriger vers la page de bienvenue
header('Location: bienvenue.php');
exit();
    } else {
        // Afficher un message d'erreur
        echo 'Veuillez remplir tous les champs';
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
          <form class="login-form" action="login.php" method="POST">
            <h2>S'enregistrer</h2>
            <div class="form-group">
              <input type="text" id="nom-complet" name="nom-complet" placeholder="Nom complet" required>
            </div>
            <div class="form-group">
              <input type="text" id="email" name="email" placeholder="email" required>
            </div>
            <div class="form-group">
              <input type="text" id="username" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
              <input type="password" id="password" name="password" placeholder="password" required>
            </div>
            <button class="login" type="submit">Créer un compte</button>
            <div class="no-account">
                <div>
                    <span class="not-logged">Déjà membre?</span>
                </div>
                <div>
                    <a href="index.php">Connectez-vous!</a>
                </div>
            </div>
          </form>
        </div>
    </div>
    
</body>
</html>