<?php
class Armor extends Item {
    private $initiative;
    private $defense;

    public function __construct($item_id) {
        $tab= array();
        $query = "SELECT item_id,item_name,item_description,item_type,defense,initiative FROM armor JOIN item using(item_id)  where item_id=".$item_id ;
        lireBase(connexionDb(), $query, $tab);
        parent::__construct($tab[0]['item_id'], $tab[0]['item_name'], $tab[0]['item_description'], $tab[0]['item_type']);
        $this->initiative=$tab[0]['initiative'];
        $this->defense=$tab[0]['defense'];
    }

     // Getter pour initiative
     public function getInitiative() {
        return $this->initiative;
    }

    // Getter pour defense
    public function getDefense() {
        return $this->defense;
    }
}