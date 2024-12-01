<?php

class User {
    
    private $pseudo;
    private $password;

    public function __construct($pseudo, $password) {
        $this->pseudo = $pseudo;
        $this->password = $password;
    }


    public function getPseudo() {
        return $this->pseudo;
    }

    public function getPassword() {
        return $this->password;
    }
}