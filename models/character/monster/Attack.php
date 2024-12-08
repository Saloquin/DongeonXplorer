<?php
class Attack {
    private $id;
    private $name;
    private $diceCount;
    private $manaCost;

    public function __construct($attack_id) {
        $query = "SELECT attack_name, dice_count, mana_cost 
                  FROM Attack WHERE attack_id = $attack_id";
        $result = lireBase(connexionDb(), $query);
            $this->id = $attack_id;
            $this->name = $result[0]['attack_name'];
            $this->diceCount = $result[0]['dice_count'];
            $this->manaCost = $result[0]['mana_cost'];
    }

    

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDiceCount() {
        return $this->diceCount;
    }

    public function getManaCost() {
        return $this->manaCost;
    }

    
    public function cast($monster) {
        $monster->setMana($monster->getMana() - $this->manaCost); 
        return rollDice($this->diceCount) + $monster->getStrength(); 
    }
}

