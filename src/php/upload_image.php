<?php
    session_start();

    include('../assets/bdd/bdd.php');

    $user_id = $_SESSION['user_id'] ?? null; // Utiliser l'ID utilisateur connecté
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/security-efficom-seminaire/src/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h1>Upload Image</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="file" name="image" required><br>
        <button type="submit" name="upload_image">Upload Image</button>
    </form>
</body>
</html>


<?php
    if (isset($_POST['upload_image'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image'];
        $blacklist = ['php', 'exe', 'bat'];
        $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $uploadDirectory = "/security-efficom-seminaire/src/uploads/";
        $imageName = uniqid('', true) . "." . $fileExtension; // Generates a unique name for the image

        if (!in_array($fileExtension, $blacklist)) {
            if ($image['error'] === 0) {
                if ($image['size'] < 5000000) { // Limit file size to 5MB
                    $uploadPath = $uploadDirectory . basename($imageName);
                    if (!is_dir($uploadDirectory)) {
                        mkdir($uploadDirectory, 0755, true); // Create the directory if it does not exist
                    }
                    if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                        echo "<p>Image uploaded successfully to '$uploadPath'.</p>";
                    } else {
                        echo "<p>Failed to move uploaded file.</p>";
                    }
                } else {
                    echo "<p>File size is too large. Limit is 5MB.</p>";
                }
            } else {
                echo "<p>Error uploading file. Error code: " . $image['error'] . "</p>";
            }
        } else {
            echo "<p>File type not allowed.</p>";
        }
    }
?>