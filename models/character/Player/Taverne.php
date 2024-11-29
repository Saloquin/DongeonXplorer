<?php
require_once "models/character/Player/Classe.php";

require_once "models/character/Player/Guerrier.php";

require_once "models/character/Player/Magicien.php";

require_once "models/character/Player/Paladin.php";

require_once "models/character/Player/Voleur.php";
class Taverne
{
    private $classes = [];

    public function __construct()
    {
        $directory = __DIR__;
        $files = scandir($directory);
        foreach ($files as $file) {
            if ($file !== 'Taverne.php' && $file !== 'Classe.php' && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $className = pathinfo($file, PATHINFO_FILENAME);
                if (class_exists($className)) {
                    $this->classes[$className] = new $className();
                }
                
            }
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