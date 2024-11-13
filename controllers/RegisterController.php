<?php
require_once 'bdd/Database.php';

class RegisterController {
    public function index() {
        require_once 'views/register.php';
    }

    public function register(){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $sql_verif="select count(*) from User where username = '". $username."'";
        $db = connexionDb();
        $tab = lireBase($db, $sql_verif);

        if(count($tab) > 0){
            $error = "Cet utilisateur existe déjà";
            require_once 'views/register.php';
            return;
        }
        
        $sql="insert into User(username,password) values ('".$username."', '".password_hash($password, PASSWORD_DEFAULT)."')";
        modifieBase($db,$sql);

        $_SESSION['username'] = $username;
        header('Location: ' . URL_ROOT);


    }
}