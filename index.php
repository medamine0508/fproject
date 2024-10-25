<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "elbase";

// Connexion à la base de données
$conn = new mysqli($host, $user, $password, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    
    // Recherche de l'utilisateur
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['pass'])) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" name="username" required>
            
            <label for="pass">Mot de passe:</label>
            <input type="password" name="pass" required>
            
            <button type="submit">Se connecter</button>
        </form>
        <?php if(isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>Pas encore inscrit ? <a href="signup.php">Créer un compte</a></p>
    </div>
</body>
</html>

