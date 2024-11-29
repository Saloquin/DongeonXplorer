<?php


class Paladin extends Classe {
    public function __construct() {
        
        $query = "SELECT class_name, class_description , base_mana, base_pv, strength, initiative, max_items FROM class WHERE lower(class_name)='paladin'";
        $tab= lireBase(connexionDb(), $query);
        parent::__construct($tab[0]['class_name'], $tab[0]['class_description'], $tab[0]['base_pv'], $tab[0]['base_mana'], $tab[0]['strength'], $tab[0]['initiative'], $tab[0]['max_items'],'/DongeonXplorer/Images/classe/paladin.jpg');
    }

    public function attack() {
        return rand(1, 6) + $this->strength + ($this->base_mana / 20);
    }
}