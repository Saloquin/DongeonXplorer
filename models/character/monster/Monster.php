<?php

// models/Monster.php
include("models/character/monster/Attack.php");
class Monster
{
    private $id;
    private $name;
    private $pv;
    private $pv_max;
    private $mana_max;
    private $mana;
    private $strength;
    private $initiative;
    private $image;
    private $loot;
    private $xp;
    private $attack_list= array();

    public function __construct($monster_id){
        $user = new User($_SESSION['user']);
        $tab = lireBase(connexionDb(),"SELECT * FROM monster WHERE monster_id = ".$monster_id );

        
        $this->id = $tab[0]['monster_id'];
        $this->name = $tab[0]['monster_name'];
        $this->pv_max = $tab[0]['pv'];
        $this->mana_max = $tab[0]['mana'];
        $this->pv = $tab[0]['pv'];
        $this->mana= $tab[0]['mana'];
        $this->strength = $tab[0]['strength'];
        $this->initiative = $tab[0]['initiative'];
        $this->image = $tab[0]['image'];
        $this->loot = $tab[0]['loot_id'];
        $this->xp = $tab[0]['xp'];

        

        $attackQuery = "SELECT attack_id FROM attack WHERE monster_id = ".$this->getId(); ;
        $attacks = lireBase(connexionDb(), $attackQuery);

        foreach ($attacks as $attack) {
            $attackObject = new Attack($attack['attack_id']); 
            $this->attack_list[] = $attackObject; 
        }
    }

    public function attack(Hero $hero) {
        $damage = rollDice(1) + $this->strength; 
        $hero->takeDamage($damage);
        return $damage;
    }
    
    public function isAlive() {
        return $this->pv > 0;
    }
    

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPv()
    {
        return $this->pv;
    }

    public function getMana()
    {
        return $this->mana;
    }
    public function getPvMax()
    {
        return $this->pv_max;
    }

    public function getManaMax()
    {
        return $this->mana_max;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getAttack()
    {
        return $this->attack_list;
    }   

    public function getInitiative()
    {
        return $this->initiative;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function getExperienceValue()
    {
        return $this->xp;
    }

    public function getLoot()
    {
        return $this->loot;
    }

    public function takeDamage($damage)
    {
        $user = new User($_SESSION['user']);
        $this->pv -= $damage;
        $sql="update combat set monster_pv = monster_pv-".$damage." where monster_id = ".$this->id." and hero_id = ".$user->getHero()->getHeroId()." and chapter_id = ".$user->getHero()->getChapter()." and ongoing = 1 ";
        modifieBase(connexionDb(),$sql);
    }

    public function setPv($pv)
    {
        $this->pv = $pv;
    }
    public function setMana($mana)
    {
        $this->mana = $mana;
    }

    

    
}
