<?php

    session_start();
    include('../bdd/bdd.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login / Register</title>
</head>
<body>
    <h1 style="margin-bottom: 20px">Bienvenue sur l'application vulnérable</h1>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="">
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
            <form action="">
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



?>