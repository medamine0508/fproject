<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleN.css">
    <script src="java.js"></script>
    <title>Bienvenue</title>
</head>
<body>
    <div class="abc">
        <h1>Bienvenue, <?php echo $_SESSION['username']; ?>!</h1>
        <h2>note List :</h2><br>
        <form id="task-form">
            <input type="text" id="new-task" name="task" placeholder="Ajouter une tâche..." required>
            <button type="submit">+</button>
        </form>
        <ul id="task-list"></ul>
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>
