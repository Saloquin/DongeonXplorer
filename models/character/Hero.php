<?php

require_once("/DongeonXplorer/bdd/Database.php");

abstract class Hero
{
    private $id_joueur;
    private $name;
    private $class;
    private $image;
    private $biographie;
    private $pv;
    private $mana;
    private $strength;
    private $initiative; //vitesse
    private $armor;
    private $primary_weapon;
    private $secondary_weapon;
    private $shield;
    private $spell_list;
    private $xp;
    private $current_level;

    public function __construct($id_joueur)
    {   
        $this->id_joueur=$id_joueur;
        $tab= array();
        $query = "SELECT name, class_id, image, biography, pv, mana, strength, initiative, armor, primary_weapon, secondary_weapon, shield, spell_list, xp, current_level FROM hero WHERE user_id=" . $id_joueur;
        lireBase(connexionDb(), $query, $tab);
        
        $this->name = $tab[0]['name'];
        $this->class = $tab[0]['class_id'];
        $this->image = $tab[0]['image'];
        $this->biographie = $tab[0]['biography'];
        $this->pv = $tab[0]['pv'];
        $this->mana = $tab[0]['mana'];
        $this->strength = $tab[0]['strength'];
        $this->initiative = $tab[0]['initiative'];
        $this->armor = $tab[0]['armor'];
        $this->primary_weapon = $tab[0]['primary_weapon'];
        $this->secondary_weapon = $tab[0]['secondary_weapon'];
        $this->shield = $tab[0]['shield'];
        $this->spell_list = $tab[0]['spell_list'];
        $this->xp = $tab[0]['xp'];
        $this->current_level = $tab[0]['current_level'];
        
    }

    public function addExp($nb_xp){
        $this->xp+=$nb_xp;
        $tab= array();
        lireBase(connexionDb(), "SELECT  required_xp FROM hero join class using(class_id) join level using(class_id)  WHERE id_user=" . $this->id_joueur." and level = ".$this->current_level, $tab);
      
        if($nb_xp>$tab[0]['required_xp']){
            $this->xp -= $tab[0]['required_xp'];
            $this->current_level+=1;
            modifieBase(connexionDb(),"update hero set current_level=". $this->current_level);
        }
        modifieBase(connexionDb(),"update hero set xp=". $this->xp); 
    }
}
