<h2>Bienvenue, <?php echo $_SESSION['username']; ?></h2>
<p><a href="logout.php">Se déconnecter</a></p>

<!-- Afficher la liste des utilisateurs en ligne -->
<h3>Utilisateurs en ligne:</h3>
<ul>
    <?php
    // Récupérer la liste des utilisateurs depuis la base de données
    $query = "SELECT * FROM users";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        // Vérifier si l'utilisateur est en ligne
        $onlineStatus = $user->isUserOnline($row['username']) ? 'En ligne' : 'Hors ligne';
        echo "<li>{$row['username']} - $onlineStatus</li>";
    }
    ?>
</ul>
