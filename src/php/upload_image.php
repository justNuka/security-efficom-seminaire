<?php

    session_start();
    include('../assets/bdd/bdd.php');

    error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body class="bodyform">

    <?php 
        include('navbar.html');
    ?>

    <div class="container-home">
        <h1>Upload Image</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input class="inputform" type="text" name="title" placeholder="Title" required><br>
            <textarea name="description" placeholder="Description" required></textarea><br>
            <input class="inputform" type="file" name="image" required><br>
            <button class="submitbutton" type="submit" name="upload_image">Upload Image</button>
        </form>
    </div>
    
</body>
</html>

<style>
    form{
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 400px;
    }
    .submitbutton{
        border-radius: 20px;
        border: 1px solid #FF4B2B;
        background-color: #FF4B2B;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }
    .inputform{
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }
    .bodyform{
        background: #f6f5f7;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
    }
    .container-home{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 300px;
    }
    h1{
        font-weight: bold;
        margin: 0;
    }
</style>

<?php
    
    if (isset($_POST['upload_image'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image'];
        $blacklist = ['php', 'exe', 'bat'];
        $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $uploadDirectory = "/uploads/";
        $imageName = uniqid('', true) . "." . $fileExtension;
        $imageSize = $image['size'];
        $originalName = $image['name'];
        $user = $_SESSION['user_id'];
        echo $user;

        if (!in_array($fileExtension, $blacklist)) {
            if ($image['error'] === 0) {
                if ($image['size'] < 5000000) {
                    $uploadPath = $uploadDirectory . basename($imageName);
                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0755, true);
                    }
                    if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                        $query = "INSERT INTO images (title, description, path, original_name, size, user) VALUES ('$title', '$description', '$uploadPath', '$originalName', '$imageSize', '$user')";
                        $stmt = $Bdd->prepare($query);

                        if ($stmt->execute()) {
                            echo "<script>Swal.fire('Upload réussi !').then(() => window.location.href = 'home.php');</script>";
                        } else {
                            echo "<script>Swal.fire('Erreur lors de l'enregistrement des métadonnées.');</script>";
                        }
                    } else {
                        echo "<script>Swal.fire('Erreur lors du déplacement du fichier.');</script>";
                    }
                } else {
                    echo "<script>Swal.fire('Fichier trop volumineux.');</script>";
                }
            } else {
                echo "<script>Swal.fire('Erreur lors de l'upload.');</script>";
            }
        } else {
            echo "<script>Swal.fire('Type de fichier non autorisé.');</script>";
        }
    }

?>