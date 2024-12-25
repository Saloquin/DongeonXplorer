<?php

require_once("bdd/Database.php");
class Loot extends Item
{
    private $qte;

    public function __construct($item_id)
    {
        $query = "SELECT item_id, item_name, item_description, item_image,item_type, quantite 
                  FROM loot 
                  JOIN item using(item_id)  where item_id=" . $item_id;
        $tab = lireBase(connexionDb(), $query);
        parent::__construct($tab[0]['item_id'], $tab[0]['item_name'], $tab[0]['item_description'], $tab[0]['item_image'], $tab[0]['item_type']);
        $this->qte = $tab[0]['quantite'];
    }


    public function getStats()
    {
        return "";
    }
}