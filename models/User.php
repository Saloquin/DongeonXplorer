<?php
require_once    'models/character/Player/Hero.php';
class User
{

    private $id;
    private $pseudo;
    private $hero;
    private $possedeHero;
    private $image;

    public function __construct($id)
    {
        $this->id = $id;
        $query = "SELECT username, users_image FROM users WHERE user_id='" . $id . "'";
        $tab1 = lireBase(connexionDb(), $query);


        $this->pseudo = $tab1[0]['username'];
        if (!empty($tab1[0]['users_image'])) {
            $this->image = $tab1[0]['users_image'];
        }


        $tab2 = lireBase(connexionDb(), "SELECT count(*) as nb FROM hero WHERE user_id=" . $this->id);
        if ($tab2[0]['nb'] > 0) {
            $this->possedeHero = true;
            $this->setHero($this->id);
        } else {
            $this->possedeHero = false;
            $this->hero = null;
        }
    }


    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHero()
    {
        return $this->hero;
    }

    public function possedeHero()
    {
        return $this->possedeHero;
    }
    public function setHero($id_joueur)
    {
        $this->hero = new Hero($id_joueur);
        if (!isset($this->image)) {
            $this->image = $this->hero->getImage();
        }
    }

    public function getImage()
    {
        return $this->getHero()->getImage();
    }



}