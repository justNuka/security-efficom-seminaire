<?php
    session_start();
    include('../assets/bdd/bdd.php');

    $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté

    $query = "SELECT original_name, size FROM images WHERE user = '$userId'";
    $stmt = $Bdd->prepare($query);

    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <?php 
        include('navbar.html');
    ?>

    <div class="last-images">
        <h1>Dernières images enregistrées</h1>
        <ul>
            <?php
            // Injection XSS à travers un paramètre GET non nettoyé
            if (isset($_GET['username'])) {
                echo "<p>Bonjour, " . $_GET['username'] . "!</p>";
            }

            if ($images) {
                foreach ($images as $image) {
                    echo "<li>" . $image['original_name'] . " - " . round($image['size'] / 1024, 2) . " KB</li>"; 
                }
            } else {
                echo "<p>Aucune image trouvée.</p>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<style>
    .last-images{
        margin-top: 200px;
    }
</style>