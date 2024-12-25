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
        $sql_verif = "select count(*)as nb from Users where username = '" . $username . "'";
        $db = connexionDb();
        $tab = lireBase($db, $sql_verif);
        if ($tab[0]['nb'] > 0) {
            header('Location:  register');
            $_SESSION['error'] = "Ce Pseudo est déja utilisé !";
            return;
        } else {
            $sql = "INSERT INTO users (username, password) 
            VALUES ('" . $username . "', '" . password_hash($password, PASSWORD_DEFAULT) . "')";    
            modifieBase($db, $sql);
            $_SESSION['user'] = lireBase(connexionDb(), "select user_id from users where username = '" . $username . "'")[0]["user_id"];
            header('Location:  profil');
        }
        exit();
    }
}