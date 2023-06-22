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

// Mise à jour du statut de connexion de l'utilisateur
$sql = "UPDATE users SET last_seen=NOW() WHERE username='$username'";
mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messagerie</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue, <?php echo $user['name']; ?>!</h1>
        <h3>Pseudo: <?php echo $user['username']; ?></h3>
        <h4>Statut de connexion: <?php echo $user['last_seen']; ?></h4>
        <a href="update_profile.php?username=<?php echo $username; ?>" class="btn btn-primary">Modifier le profil</a>
        <a href="logout.php" class="btn btn-primary">Se déconnecter</a>
    </div>
</body>
</html>
