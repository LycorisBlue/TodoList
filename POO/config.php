<?php
// Configuration de la base de données
$dbHost = 'localhost';
$dbUsername = 'votre_nom_utilisateur';
$dbPassword = 'votre_mot_de_passe';
$dbName = 'nom_de_votre_base_de_donnees';

// Connexion à la base de données
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Vérification des erreurs de connexion
if ($db->connect_error) {
    die("Erreur de connexion à la base de données: " . $db->connect_error);
}
?>
