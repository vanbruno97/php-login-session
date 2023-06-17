<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: index.php');
    exit();
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'root', 'login_session');

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer les informations de l'utilisateur à partir de la table utilisateurs
$stmt = $conn->prepare("SELECT nom, email FROM users WHERE username = ?");
if (!$stmt) {
    die("La requête préparée a échoué : " . $conn->error);
}
$stmt->bind_param("s", $_SESSION['username']);
if (!$stmt->execute()) {
    die("L'exécution de la requête a échoué : " . $stmt->error);
}
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Afficher les informations de l'utilisateur
if (isset($row['nom']) && isset($row['email'])) {
    $message = 'Bienvenue, ' . $row['nom'] . '! Votre nom d\'utilisateur est ' . $_SESSION['username'] . ' et votre adresse e-mail est : ' . $row['email'] . '.';
} else {
    $message = 'Bienvenue, ' . $_SESSION['username'] . '!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bienvenue</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="logged.jpg" alt="utilisateur connecté">
            <div class="form-group"> 
                <b><?php echo $message; ?></b>
                <form action="deconnexion.php" method="post">
                    <button class="logout" type="submit">Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>