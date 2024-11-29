<?php



abstract class Classe
{
    protected $name;
    protected $image;
    protected $description;
    protected $base_health;
    protected $base_mana;
    protected $strength;
    protected $initiative; //vitesse
    protected $max_item;

    public function __construct($name, $description, $health, $mana, $strenght,$initiative, $max_item,$image)
    {
        $this->name = $name;
        $this->description = $description;
        $this->base_health = $health;
        $this->base_mana = $mana;
        $this->strength = $strenght;
        $this->initiative=$initiative;
        $this->max_item = $max_item;
        $this->image = $image;
    }

    abstract public function attack();

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
