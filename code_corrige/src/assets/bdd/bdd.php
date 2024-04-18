<?php
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "vulnerable_app";
    $host = "localhost";

    try
    {
        $Bdd = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
        $Bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
        echo ("Erreur : Impossible de se connecter à la bdd. Veuillez vérifier les paramètres de connexion.");
    }
?>