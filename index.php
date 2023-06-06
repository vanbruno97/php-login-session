<?php
// Démarrer la session
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier si les informations d'identification sont correctes
    if ($username === 'van' && $password === 'chiot') {
        // Stocker les informations de l'utilisateur dans des variables de session
        $_SESSION['username'] = $username;

        // Rediriger vers la page de bienvenue
        header('Location: bienvenue.php');
        exit();
    } else {
        // Rediriger vers la page d'enregistrement si l'utilisateur n'a pas de compte
        header('Location: enregistrement.php');
        exit();
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
            <h2>Connexion</h2>
            <div class="form-group">
              <input type="text" id="username" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
              <input type="password" id="password" name="password" placeholder="password" required>
            </div>
            <button class="login" type="submit">Se connecter</button>
            <div class="no-account">
                <div>
                    <span class="not-logged">Pas encore membre?</span>
                </div>
                <div>
                    <a href="enregistrement.php">Créer un compte!</a>
                </div>
            </div>
          </form>
        </div>
    </div>
    
</body>
</html>