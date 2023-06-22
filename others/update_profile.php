<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "nom_utilisateur", "mot_de_passe", "messaging_system");

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérification du statut de connexion de l'utilisateur
if (!isset($_GET['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_GET['username'];

// Récupération des informations de l'utilisateur connecté
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Traitement du formulaire de mise à jour du profil
if (isset($_POST['update'])) {
    $newUsername = $_POST['username'];

    // Mise à jour du pseudo de l'utilisateur dans la table "users"
    $sql = "UPDATE users SET username='$newUsername' WHERE username='$username'";
    mysqli_query($conn, $sql);

    // Redirection vers la page de messagerie après la mise à jour réussie
    header("Location: messaging.php?username=$newUsername");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le profil</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Modifier le profil</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?username=' . $username; ?>">
            <div class="form-group">
                <label for="username">Nouveau pseudo:</label>
                <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
