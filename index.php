<?php
// Démarrer la session
session_start();
// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Rediriger l'utilisateur vers la page de bienvenue
    header('Location: bienvenue.php');
    exit();
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', 'root', 'login_session');

    // Vérifier si la connexion a réussi
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour récupérer les informations d'utilisateur à partir de la base de données
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Récupérer les résultats de la requête SQL
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($result->num_rows === 1) {
        // Récupérer les informations d'utilisateur de la base de données
        $row = $result->fetch_assoc();
        $password_hash = $row['password'];

        // Vérifier si le mot de passe est correct
        if (password_verify($password, $password_hash)) {
            // Stocker les informations d'utilisateur dans des variables de session
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $row['email'];

            // Rediriger l'utilisateur vers la page de bienvenue
            header('Location: bienvenue.php');
            exit();
        }
    }

    // Afficher un message d'erreur si les informations d'authentification sont incorrectes
    $error = "Nom d'utilisateur ou mot de passe incorrect.";
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
          <form class="login-form" action="index.php" method="POST">
            <h2>Connexion</h2>
            <div class="form-group">
              <input type="text" id="username" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
              <input type="password" id="password" name="password" placeholder="password" required>
            </div>
            <button class="login" type="submit" name = "login">Se connecter</button>
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