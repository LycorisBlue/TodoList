<h2>Connexion</h2>
<form method="post" action="">
    <div class="form-group">
        <label>Pseudo</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
    <a href="register.php" class="btn btn-link">S'inscrire</a>
</form>

<?php
// Gérer la soumission du formulaire de connexion
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier les informations de connexion
    if ($user->login($username, $password)) {
        // Rediriger vers la page de chat après la connexion réussie
        header("Location: index.php");
    } else {
        echo "<p class='text-danger'>Nom d'utilisateur ou mot de passe incorrect.</p>";
    }
}
?>
