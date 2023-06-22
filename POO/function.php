<?php
// Classe Utilisateur
class User {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    // Inscription d'un utilisateur
    public function register($name, $username, $email, $password, $birthdate) {
        // Vérifier si l'utilisateur existe déjà
        $existingUser = $this->getUserByUsername($username);
        if ($existingUser) {
            return "Le nom d'utilisateur existe déjà.";
        }

        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer les informations de l'utilisateur dans la base de données
        $query = "INSERT INTO users (name, username, email, password, birthdate) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->db->prepare($query);
        $statement->bind_param("sssss", $name, $username, $email, $hashedPassword, $birthdate);
        if ($statement->execute()) {
            return "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            return "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
        }
    }

    // Connexion d'un utilisateur
    public function login($username, $password) {
        // Récupérer les informations de l'utilisateur
        $user = $this->getUserByUsername($username);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            // Démarrer la session de l'utilisateur
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        } else {
            return false;
        }
    }

    // Récupérer les informations d'un utilisateur par son nom d'utilisateur
    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $statement = $this->db->prepare($query);
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    // Vérifier si un utilisateur est en ligne
    public function isUserOnline($username) {
        // Vérifier si l'utilisateur est dans la session active
        return isset($_SESSION['username']) && $_SESSION['username'] == $username;
    }
}

// Utilisation de la classe User
$user = new User($db);
?>
