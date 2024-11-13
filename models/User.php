<?php

class User {
    private $id;
    private $pseudo;
    private $password;

    public function __construct($id, $pseudo, $password) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getPassword() {
        return $this->password;
    }
}