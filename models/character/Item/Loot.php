<?php
class Loot extends Item {
    private $qte;

    public function __construct($item_id) {
        $tab = array();
        $query = "SELECT item_id, item_name, item_description, item_type, quantite 
                  FROM consomable 
                  JOIN item using(item_id)  where item_id=".$item_id;
        lireBase(connexionDb(), $query, $tab);
        parent::__construct($tab[0]['item_id'], $tab[0]['item_name'], $tab[0]['item_description'], $tab[0]['item_type']);
        $this->qte = $tab[0]['quantite'];
    }

    
    public function getQuantite() {
        return $this->qte;
    }
}