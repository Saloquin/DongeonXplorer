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
            session_destroy();
            session_start();
            header('Location:  home');
            exit();
        } else {
            header('Location:  profil');
            exit();
        }

    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Logic to authenticate user
        if ($this->authenticate($username, $password)) {
            $_SESSION['user'] = lireBase(connexionDb(), "select user_id from users where username = '" . $username . "'")[0]["user_id"];
            header('Location:  profil');

        } else {
            // Handle login failure
            $_SESSION['error'] = "Peusdo ou mot de passe incorrect";
            header('Location:  login');
        }

    }

    private function authenticate($username, $password)
    {
        $password = htmlspecialchars($password);
        $sql_verif = "select * from users where username = '" . $username . "'";
        $db = connexionDb();
        $tab = lireBase($db, $sql_verif);

        if (count($tab) == 1 && password_verify($password, $tab[0]['password'])) {
            return true;
        } else {
            return false;
        }

    }

}