<?php

    session_start();
    include('../assets/bdd/bdd.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/login.css?<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Login / Register</title>
</head>
<body>
    <h1 style="margin-bottom: 20px">Bienvenue sur Vulnerable App</h1>
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
        $password = md5($_POST['password']);

        $query_insert_users = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        $Ores = $Bdd->prepare($query_insert_users);

        $result = $Ores->execute();

        if ($result) {
            echo "
            <script>
                Swal.fire({
                    title: 'Inscription réussie !',
                    text: 'Vous pouvez maintenant vous connecter',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#00a8ff',
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'login.php';
                    }
                });
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
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'login.php';
                        }
                    });
                </script>
            ";
        }
    }

    if (isset($_POST['login_user'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $query_login = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $Ores = $Bdd->prepare($query_login);
        $Ores->execute();
        $result = $Ores->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            print_r($result);
            if ($result['password'] == $password) {
                $_SESSION['user_id'] = $result['id_users'];
                $_SESSION['user_name'] = $result['name'];
                $_SESSION['user_email'] = $result['email'];
                echo "
                <script>
                    Swal.fire({
                        title: 'Connexion réussie !',
                        icon: 'success',
                        confirmButtonText: 'Continuer',
                        confirmButtonColor: '#00a8ff',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'home.php';
                        }
                    });
                </script>
                ";
            } else {
                // Mot de passe incorrect
                echo "
                <script>
                    Swal.fire({
                        title: 'Mot de passe incorrect !',
                        icon: 'error',
                        confirmButtonText: 'Réessayer',
                        confirmButtonColor: '#ff7675'
                    });
                </script>
                ";
            }
        } else {
            // Email non trouvé
            echo "
            <script>
                Swal.fire({
                    title: 'Aucun compte trouvé avec cet email',
                    icon: 'error',
                    confirmButtonText: 'Réessayer',
                    confirmButtonColor: '#ff7675'
                });
            </script>
            ";
        }
    }    
    
?>