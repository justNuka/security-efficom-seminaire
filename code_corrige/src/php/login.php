<?php

    session_start();
    include('../assets/bdd/bdd.php');

    // Désactivation de l'affichage des erreurs
    // ini_set('display_errors', 0);
    // ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Login / Register corrige</title>
</head>
<body>
    <h1 style="margin-bottom: 20px">Bienvenue sur l'application vulnérable</h1>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="POST">
                <h1>Créer un compte</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>ou utiliser votre mail pour vous enregistrer</span>
                <input type="text" name="name" placeholder="Nom" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Mot de passe" />
                <button type="submit" name="register_user">S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="POST">
                <h1>Se connecter</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>ou utiliser vos identifiants de connexion</span>
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Mot de passe" />
                <a href="#">Mot de passe oublié ?</a>
                <button type="submit" name="login_user">Connexion</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Content de vous revoir !</h1>
                    <p>Pour rester en contact avec nous, veuillez vous connecter avec vos informations personnelles</p>
                    <button class="ghost" id="signIn">Connexion</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bonjour, visiteur !</h1>
                    <p>Entrez vos informations personnelles pour commencer un incoyrable voyage à nos côtés</p>
                    <button class="ghost" id="signUp">Inscription</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>
</html>

<?php

    if (isset($_POST['register_user'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Sécurisation du hachage du mot de passe

        $query_insert_users = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

        $Ores = $Bdd->prepare($query_insert_users);
        $Ores->bindParam(':name', $name);
        $Ores->bindParam(':email', $email);
        $Ores->bindParam(':password', $password);
        $result = $Ores->execute();

        if ($result) {
            echo "
            <script>
                Swal.fire({
                    title: 'Inscription réussie !',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#00a8ff',
                    showLoaderOnConfirm: true,
                }).then(() => 
                    window.location.href = 'home.php')
                );
            </script>
            ";
        } else {
            echo "
                <script>
                    Swal.fire({
                        title: 'Une erreur est survenue lors de votre inscription !',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#red',
                        showLoaderOnConfirm: true,  
                    }).then(() => 
                        window.location.href = '')
                    );
                </script>
            ";
        }
    }

    if (isset($_POST['login_user'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query_login = "SELECT * FROM users WHERE email = :email";

        $Ores = $Bdd->prepare($query_login);
        $Ores->bindParam(':email', $email);
        $Ores->execute();
        $result = $Ores->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            // Le mot de passe est correct
            $_SESSION['user_id'] = $result['id_users'];
            $_SESSION['user_name'] = $result['name'];
                echo "
                <script>
                    Swal.fire({
                        title: 'Connexion réussie !',
                        icon: 'success',
                        confirmButtonText: 'Continuer',
                        confirmButtonColor: '#00a8ff',
                    }).then(() => 
                        window.location.href = 'home.php')
                    );
                </script>
                ";
            } else {
                // Erreur d'identifiants
                echo "
                <script>
                    Swal.fire({
                        title: 'Identifiants incorrects !',
                        icon: 'error',
                        confirmButtonText: 'Réessayer',
                        confirmButtonColor: '#ff7675'
                    });
                </script>
                ";
            }
        }  
    
?>