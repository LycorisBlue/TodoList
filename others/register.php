<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "nom_utilisateur", "mot_de_passe", "messaging_system");

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Traitement du formulaire d'inscription
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dateOfBirth = $_POST['date_of_birth'];

    // Insertion des données d'inscription dans la table "users"
    $sql = "INSERT INTO users (name, username, email, password, date_of_birth) VALUES ('$name', '$username', '$email', '$password', '$dateOfBirth')";
    mysqli_query($conn, $sql);

    // Redirection vers la page de connexion après l'inscription réussie
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="username">Pseudo:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date de naissance:</label>
                <input type="date" class="form-control" name="date_of_birth" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</body>
</html>
