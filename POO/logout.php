<?php
// Déconnecter l'utilisateur et détruire la session
session_start();
session_destroy();

// Rediriger vers la page de connexion après la déconnexion
header("Location: index.php");
?>
