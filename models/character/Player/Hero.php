<?php

require_once("bdd/Database.php");
require_once("models/character/Player/Classe.php");
require_once("models/character/Player/Inventaire.php");
require_once("models/character/Item/Item.php");


class Hero
{
    private $id_joueur;
    private $id_hero;
    private $name;
    private $class;
    private $image;
    private $pv;
    private $mana;
    private $strength;
    private $initiative; //vitesse
    private $armor;
    private $primary_weapon;
    private $secondary_weapon;
    private $shield;
    private $spell_list=array();
    private $xp;
    private $current_level;
    private $chapter;
    private $money;

    private $inventory;
    public function __construct($id_joueur)
    {   
        $this->id_joueur = $id_joueur;
        $query = "SELECT hero_id,chapter_id, hero_name, class_id, image, pv, mana, strength, initiative, armor, primary_weapon, secondary_weapon, xp, current_level,money FROM hero WHERE user_id=" . $id_joueur;
        $tab = lireBase(connexionDb(), $query);
        
        $this->chapter = $tab[0]["chapter_id"];
        $this->id_hero = $tab[0]['hero_id']; 
        $this->name = $tab[0]['hero_name'];
        $this->class = new Classe($tab[0]['class_id']);
        $this->image = $tab[0]['image'];
        $this->pv = $tab[0]['pv'];
        $this->mana = $tab[0]['mana'];
        $this->strength = $tab[0]['strength'];
        $this->initiative = $tab[0]['initiative'];
        $this->armor = $tab[0]['armor'];
        $this->primary_weapon = $tab[0]['primary_weapon'];
        $this->secondary_weapon = $tab[0]['secondary_weapon'];
        $this->xp = $tab[0]['xp'];
        $this->current_level = $tab[0]['current_level'];
        $this->money = $tab[0]['money'];
        $this->inventory = new Inventaire($this->id_hero);
        // Ajout de la logique pour récupérer les sorts
        $query = "SELECT spell_id FROM spell WHERE class_id = " . $this->class->getId();
        $tab = lireBase(connexionDb(), $query);
        foreach ($tab as $spell) {
            $spell = new Spell($spell['spell_id']);
            if ($spell->getLearningLevel() <= $this->current_level) {
                $this->spell_list[] = $spell;
            }
        }
    }


    

    public function addExp($nb_xp){
        $this->xp+=$nb_xp;
        $tab=lireBase(connexionDb(), "SELECT  required_xp FROM hero join class using(class_id) join level using(class_id)  WHERE id_user=" . $this->id_joueur." and level = ".$this->current_level);
      
        if($nb_xp>$this->getXpRequired()){
            $this->xp -= $this->getXpRequired();
            $this->addLevel();
        }
        modifieBase(connexionDb(),"update hero set xp=". $this->xp); 
    }

    public function addLevel(){
        $this->current_level+=1;
        modifieBase(connexionDb(),"update hero set current_level=". $this->current_level);
        $tab = lireBase(connexionDb(), "SELECT strength_bonus,initiative_bonus,mana_bonus,pv_bonus FROM level join class using(class_id) WHERE level = ".$this->current_level." and class_id = ".$this->class->getId());
        $this->pv+=$tab[0]['pv_bonus'];
        $this->mana+=$tab[0]['mana_bonus'];
        $this->strength+=$tab[0]['strength_bonus'];
        $this->initiative+=$tab[0]['initiative_bonus'];
        modifieBase(connexionDb(),"update hero set pv=". $this->pv);
        modifieBase(connexionDb(),"update hero set mana=". $this->mana);
        modifieBase(connexionDb(),"update hero set strength=". $this->strength);
        modifieBase(connexionDb(),"update hero set initiative=". $this->initiative);
    }
    public function getHeroId() {
        return $this->id_hero;
    }
    public function getIdJoueur() {
        return $this->id_joueur;
    }

    public function getName() {
        return $this->name;
    }

    public function getClass() {
        return $this->class;
    }

    public function getImage() {
        return $this->image;
    }

    public function getPv() {
        return $this->pv;
    }

    public function getMana() {
        return $this->mana;
    }

    public function getStrength() {
        return $this->strength;
    }

    public function getInitiative() {
        return $this->initiative;
    }

    public function getArmor() {
        return $this->armor;
    }

    public function getPrimaryWeapon() {
        return $this->primary_weapon;
    }

    public function getSecondaryWeapon() {
        return $this->secondary_weapon;
    }


    public function getSpellList() {
        return $this->spell_list;
    }

    public function getXp() {
        return $this->xp;
    }

    public function getCurrentLevel() {
        return $this->current_level;
    }

    public function getXpRequired() {
        $tab=lireBase(connexionDb(), "SELECT  required_xp FROM hero join class using(class_id) join level using(class_id)  WHERE user_id=" . $this->id_joueur." and level = ".$this->current_level+1);
        if (isset($tab[0]['required_xp']))
            return $tab[0]['required_xp'];
        else return 1000000;
    }

    public function getChapter() {
        return $this->chapter;
    }   

    public function getMoney() {
        return $this->money;
    }

    public function getInventory() {
        return $this->inventory;
    }   
    
    
    
    
    
}
