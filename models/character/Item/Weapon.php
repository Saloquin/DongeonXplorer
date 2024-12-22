<?php

require_once("bdd/Database.php");
class Weapon extends Item {
    private $damage;
    private $defense;
    private $mana;
    private $isTwoHanded;

    public function __construct($item_id) {
        
        $query = "SELECT item_id, item_name, item_description,item_image, item_type, damage, defense, mana, isTwoHanded 
                  FROM weapon 
                  JOIN item using(item_id)  where item_id=".$item_id;
        $tab = lireBase(connexionDb(), $query);
        parent::__construct($tab[0]['item_id'], $tab[0]['item_name'], $tab[0]['item_description'],$tab[0]['item_image'], $tab[0]['item_type']);
        $this->damage = $tab[0]['damage'];
        $this->defense = $tab[0]['defense'];
        $this->mana = $tab[0]['mana'];
        $this->isTwoHanded = (bool) $tab[0]['isTwoHanded']; 
    }

   

    public function getDamage() {
        return $this->damage;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function getMana() {
        return $this->mana;
    }

    public function isTwoHanded() {
        return $this->isTwoHanded;
    }
    public function getStats() {
        return "Dégats: {$this->damage}, Defense: {$this->defense}, Mana: {$this->mana}, " . ($this->isTwoHanded ? "épée à deux main" : "épée a une main");
    }
    
}
