<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "nom_utilisateur", "mot_de_passe", "messaging_system");

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Traitement du formulaire de connexion
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations de connexion dans la table "users"
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Mise à jour du statut de connexion de l'utilisateur
        $sql = "UPDATE users SET last_seen=NOW() WHERE username='$username'";
        mysqli_query($conn, $sql);

        // Redirection vers la page de messagerie après la connexion réussie
        header("Location: messaging.php?username=$username");
        exit();
    } else {
        echo "Pseudo ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Pseudo:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</body>
</html>
