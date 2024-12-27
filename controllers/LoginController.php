<?php
require_once 'bdd/Database.php';

class LoginController
{
    public function index()
    {
        require_once 'views/login.php';
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            session_destroy(); // Détruire la session
            session_start();   // Redémarrer la session
            header('Location: home');
            exit();
        } else {
            header('Location: profil');
            exit();
        }
    }

    public function login()
    {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Logic to authenticate user
        if ($this->authenticate($username, $password)) {
            // Démarrer la session si elle n'est pas déjà démarrée
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Récupérer l'ID de l'utilisateur après la connexion
            $db = connexionDb();
            $sql_user = "SELECT user_id FROM users WHERE username = :username";
            $stmt = $db->prepare($sql_user);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $user['user_id'];

            header('Location: profil');
            exit();
        } else {
            $_SESSION['error'] = "Pseudo ou mot de passe incorrect";
            header('Location: login');
            exit();
        }
    }

    private function authenticate($username, $password)
    {
        $db = connexionDb();
        // Requête préparée pour vérifier les informations d'identification
        $sql_verif = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql_verif);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }
}
?>
