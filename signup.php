<?php
$host = "localhost";
$user = "root";
$db = "elbase";

$conn = new mysqli($host, $user, "", $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    
    $query = "INSERT INTO users ( username , pass) VALUES ('$username', '$password')";
    
    if ($conn->query($query) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <form method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" name="username" required>
            
            <label for="pass">Mot de passe:</label>
            <input type="password" name="pass" required>
            
            <button type="submit">S'inscrire</button>
        </form>
        <?php if(isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>Déjà un compte ? <a href="index.php">Se connecter</a></p>
    </div>
</body>
</html>
