<?php
require_once 'bdd/Database.php';

class RegisterController {
    public function index() {
        require_once 'views/register.php';
    }

    public function register(){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $sql_verif="select count(*)as nb from Users where username = '". $username."'";
        $db = connexionDb();
        $tab = lireBase($db, $sql_verif);
        if($tab[0]['nb'] > 0){
            $error = "Ce Pseudo est déja utilisé !";
            header('Location:  register');
            $_SESSION['error']=$error;
            return ;
        }
        else {
            $sql="insert into users(username,password) values ('".$username."', '".password_hash($password, PASSWORD_DEFAULT)."')";
            echo $sql;
            modifieBase($db,$sql);
            $_SESSION['user'] = $username;
            header('Location:  profil');
        }
        exit();
    }
}