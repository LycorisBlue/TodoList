<!DOCTYPE html>
<html>
<head>
    <title>WhatsApp Clone</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>WhatsApp Clone</h1>
        <hr>

        <?php
        // Inclure les fichiers de classe et les fonctions
        require_once 'config.php';
        require_once 'functions.php';

        session_start();

        // Vérifier si l'utilisateur est déjà connecté
        if (isset($_SESSION['user_id'])) {
            include 'chat.php';
        } else {
            include 'login.php';
        }
        ?>
    </div>
</body>
</html>
