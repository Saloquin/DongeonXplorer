<?php
require_once 'bdd/Database.php';

class RegisterController
{
    public function index()
    {
        require_once 'views/register.php';
    }

    public function register()
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        // Utilisation de la requête préparée
        $db = connexionDb();
        $sql_verif = "SELECT COUNT(*) AS nb FROM users WHERE username = :username";
        $stmt = $db->prepare($sql_verif);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $tab = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tab['nb'] > 0) {
            // Utilisation de la session pour afficher l'erreur
            $_SESSION['error'] = "Ce Pseudo est déjà utilisé !";
            header('Location: register');
            exit();
        } else {
            // Insertion du nouvel utilisateur
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);
            $stmt->execute();

            // Récupérer l'ID de l'utilisateur pour la session
            $sql_user = "SELECT user_id FROM users WHERE username = :username";
            $stmt = $db->prepare($sql_user);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $user['user_id'];

            header('Location: profil');
            exit();
        }
    }
}
?>
