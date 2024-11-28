<?php
class Consumable extends Item {
    private $soin;
    private $mana;

    public function __construct($item_id) {
        $tab = array();
        $query = "SELECT item_id, item_name, item_description, item_type, health, mana 
                  FROM consomable 
                  JOIN item using(item_id)  where item_id=".$item_id;
        lireBase(connexionDb(), $query, $tab);
        parent::__construct($tab[0]['item_id'], $tab[0]['item_name'], $tab[0]['item_description'], $tab[0]['item_type']);
        $this->soin = $tab[0]['health'];
        $this->mana = $tab[0]['mana'];
    }

    
    public function getSoin() {
        return $this->soin;
    }

    
    public function getMana() {
        return $this->mana;
    }
}
