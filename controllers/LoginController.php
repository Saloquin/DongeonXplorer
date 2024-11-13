<?php
require_once 'bdd/Database.php';


class LoginController {
    public function index() {
        require_once 'views/login.php';
    }

    public function logout() {
        // Logic for logging out the user
        session_start();
        session_destroy();
        header('Location: ' . URL_ROOT);
        exit();
    }

    public function login() {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Logic to authenticate user
            if ($this->authenticate($username, $password)) {
                session_start();
                $_SESSION['user'] = $username;
                header('Location: ' . URL_ROOT);
                exit();
            } else {
                // Handle login failure
                $error = "Invalid username or password";
                require_once 'views/login.php';
            }
            
    }

    private function authenticate($username, $password) {
        $pseudo = htmlspecialchars($username);
        $password = htmlspecialchars($password);
        $sql_verif="select * from User where username = '". $username."'";
        $db = connexionDb();
        $tab = lireBase($db, $sql_verif);
        var_dump($tab);

        if(count($tab) == 1 && password_verify($password, $tab[0]['password'])){
            return true;
        }
        else{
            return false;
        }
        

    }



   
}