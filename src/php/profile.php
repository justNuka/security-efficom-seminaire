<?php
    session_start();
    include('../assets/bdd/bdd.php');

    $userId = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE id_users = '$userId'";
    $stmt = $Bdd->prepare($query);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Utilisateur non trouvé.");
    }

    $spaceLeft = null;
    if (isset($_GET['check_space'])) {
        $command = escapeshellcmd($_GET['check_space']);
        $spaceLeft = shell_exec($command);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>

    <?php 
        include 'navbar.html';
    ?>

    <h1>Profil de l'utilisateur</h1>
    <p>Nom : <?php echo htmlspecialchars($user['name']); ?></p>
    <p>Email : <?php echo htmlspecialchars($user['email']); ?></p>

    <!-- Bouton pour afficher l'espace restant -->
    <a href="?check_space=df -h">Afficher l'espace restant pour les images</a>

    <?php if ($spaceLeft) : ?>
        <pre><?php echo ($spaceLeft); ?></pre>
    <?php endif; ?>
</body>
</html>
