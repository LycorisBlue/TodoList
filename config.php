<?php
// config.php

    define('DB_HOST', 'localhost');
    define('DB_NAME', 'todolist');
    define('DB_USER', 'votre_utilisateur');
    define('DB_PASSWORD', 'votre_mot_de_passe');

    // Établir la connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Vérifier les erreurs de connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }
?>
