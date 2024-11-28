<?php

require_once("/DongeonXplorer/bdd/Database.php");
class Magicien extends Classe {
    public function __construct() {
        $tab= array();
        $query = "SELECT name, class_description as description, health, mana, pv, mana, strength, initiative, max_item FROM class WHERE lower(name)='magicien'";
        lireBase(connexionDb(), $query, $tab);
        parent::__construct($tab[0]['name'], $tab[0]['description'], $tab[0]['base_health'], $tab[0]['base_mana'], $tab[0]['strength'], $tab[0]['initiative'], $tab[0]['max_item']);
    }

    public function attack() {
        return rand(1, 6) + rand(1, 6) + $this->base_mana / 10;
    }
}