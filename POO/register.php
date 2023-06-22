<h2>Inscription</h2>
<form method="post" action="">
    <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Pseudo</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Date de naissance</label>
        <input type="date" name="birthdate" class="form-control" required>
    </div>
    <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
</form>

<?php
// Gérer la soumission du formulaire d'inscription
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];

    // Effectuer l'inscription
    $message = $user->register($name, $username, $email, $password, $birthdate);
    echo "<p class='text-success'>$message</p>";
}
?>
