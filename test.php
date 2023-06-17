<!-- Page Index -->
<?php
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

<!-- Page Bienvenue.php -->
<?php
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
<!-- Page enregistrement -->
<?php

// Établir une connexion à la base de données
$servername = "localhost"; // 
$username = "root"; // le nom d'utilisateur pour se connecter à MySQL
$password = "root"; // le mot de passe pour se connecter à MySQL
$dbname = "login_session"; // le nom de la base de données dans phpMyAdmin

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si tous les champs ont été remplis
    if (!empty($_POST["nom-complet"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {
        // Récupérer les données soumises dans le formulaire
        $nomComplet = $_POST["nom-complet"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Insérer les données dans la base de données
        $sql = "INSERT INTO users (nom, email, username, password) VALUES ('$nomComplet', '$email', '$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Les données ont été insérées avec succès dans la base de données";
        } else {
            echo "Une erreur s'est produite lors de l'insertion des données : " . $conn->error;
        }
    } else {
        // Afficher un message d'erreur si tous les champs ne sont pas remplis
        echo "Veuillez remplir tous les champs";
    }
}

// Fermer la connexion à la base de données
$conn->close();

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
          <form class="login-form" action="index.php" method="POST">
            <h2>S'enregistrer</h2>
            <div class="form-group">
              <input type="text" id="nom-complet" name="nom" placeholder="Nom complet" required>
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