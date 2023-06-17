<?php
// Vérifier si le formulaire d'enregistrement a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', 'root', 'login_session');

    // Vérifier si la connexion a réussi
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Insérer les informations utilisateur dans la base de données
    $stmt = $conn->prepare("INSERT INTO users (nom, email, username, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("La requête préparée a échoué : " . $conn->error);
    }
    $stmt->bind_param("ssss", $nom, $email, $username, $password);
    if (!$stmt->execute()) {
        die("L'exécution de la requête a échoué : " . $stmt->error);
    }

    // Rediriger l'utilisateur vers la page de connexion
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulaire d'enregistrement</title>
</head>
<body>
<div class="login-container">
        <div class="login-box">
  <form class = "login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <h2>S'enregistrer</h2>
  <div class="form-group">
  <input type="text"  name="nom" placeholder="Nom complet" required>
            </div>
            <div class="form-group">
              <input type="text"  name="email" placeholder="email" required>
            </div>
            <div class="form-group">
              <input type="text" name="username" placeholder="username" required>
            </div>
            <div class="form-group">
              <input type="password"  name="password" placeholder="password" required>
            </div>
            <button class="login" type="submit" name="register">Créer un compte</button>
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
