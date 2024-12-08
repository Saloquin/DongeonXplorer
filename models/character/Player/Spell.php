<?php
include_once "models/fonction_utilitaire.php";
class Spell {
    private $id;
    private $name;
    private $description;
    private $diceCount;
    private $manaCost;
    private $learningLevel;

    public function __construct($spell_id) {
        $query = "SELECT spell_name, spell_description, dice_count, mana_cost, learning_level 
                  FROM spell WHERE spell_id = $spell_id";
        $result = lireBase(connexionDb(), $query);
            $this->id = $spell_id;
            $this->name = $result[0]['spell_name'];
            $this->description = $result[0]['spell_description'];
            $this->diceCount = $result[0]['dice_count'];
            $this->manaCost = $result[0]['mana_cost'];
            $this->learningLevel = $result[0]['learning_level'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDiceCount() {
        return $this->diceCount;
    }

    public function getManaCost() {
        return $this->manaCost;
    }

    public function getLearningLevel() {
        return $this->learningLevel;
    }

    
    public function cast($hero) {
        $hero->setMana($hero->getMana() - $this->manaCost);
        modifieBase(connexionDb(), "UPDATE hero SET mana = ".$hero->getMana()." WHERE hero_id = ".$hero->getHeroId());
        $damage = rollDice($this->diceCount) + $hero->getStrength();
        return $damage; 
    }
}

