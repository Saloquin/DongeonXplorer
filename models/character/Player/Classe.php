<?php

require_once("models/character/Player/Spell.php");

class Classe
{
    private $id;
    private $name;
    private $image;
    private $description;
    private $base_health;
    private $base_mana;
    private $strength;
    private $initiative; //vitesse
    private $max_item;

    private $spell_list = [];

    public function __construct($class_id)
    {
        $query = "SELECT * FROM class WHERE class_id = ".$class_id;
        $tab = lireBase(connexionDb(), $query);

        
            $this->id = $tab[0]['class_id'];
            $this->name = $tab[0]['class_name'];
            $this->description = $tab[0]['class_description'];
            $this->base_health = $tab[0]['base_pv'];
            $this->base_mana = $tab[0]['base_mana'];
            $this->strength = $tab[0]['strength'];
            $this->initiative = $tab[0]['initiative'];
            $this->max_item = $tab[0]['max_items'];
            $this->image = $tab[0]['class_image'];

        $spellQuery = "SELECT spell_id FROM spell WHERE class_id = ".$this->getId(); ;
        $spells = lireBase(connexionDb(), $spellQuery);

        foreach ($spells as $spell) {
            $spellObject = new Spell($spell['spell_id']); 
            $this->spell_list[] = $spellObject; 
        }

    }
    

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getBaseHealth()
    {
        return $this->base_health;
    }

    public function getMana()
    {
        return $this->base_mana;
    }

    public function getStrenght()
    {
        return $this->strength;
    }

    public function getInitiative()
    {
        return $this->initiative;
    }

    public function getMaxItem()
    {
        return $this->max_item;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function levelUp($levelBonus)
    {
        $this->base_health += $levelBonus['health'];
        $this->base_mana += $levelBonus['mana'];
        $this->strength += $levelBonus['strength'];
        $this->initiative += $levelBonus['initiative'];
    }

    public function getStats()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'health' => $this->base_health,
            'mana' => $this->base_mana,
            'strength' => $this->strength,
            'initiative' => $this->initiative,
            'max_item' => $this->max_item
        ];
    }
}
