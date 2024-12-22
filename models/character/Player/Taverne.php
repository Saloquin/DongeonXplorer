<?php
require_once "models/character/Player/Classe.php";
require_once "bdd/Database.php";
class Taverne
{
    private $classes = [];

    public function __construct()
    {
        $tab=lireBase(connexionDb(),'select * from class');
        foreach($tab as $row){
            $this->classes[$row['class_name']] = new Classe($row['class_id']);
        }
    }

    public function getClass($className)
    {
        if (isset($this->classes[$className])) {
            return $this->classes[$className];
        }
        throw new \Exception("Class not found: " . $className);
    }

    public function getAllClasses()
    {
        return $this->classes;
    }
}