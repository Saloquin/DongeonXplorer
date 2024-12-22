<?php

// models/Chapter.php
require_once 'bdd/Database.php';
class Chapter
{
    private $id;
    private $title;
    private $description;
    private $image;
    private $choices = [];

    public function __construct($id)
    {
        $tab = lireBase(connexionDb(), 'SELECT chapter_id,chapter_title,content,image FROM chapter where chapter_id=' . $id);
        $this->id = $tab[0]['chapter_id'];
        $this->title = $tab[0]['chapter_title'];
        $this->description = $tab[0]['content'];
        $this->image = $tab[0]['image'];

        $tab = lireBase(connexionDb(), 'SELECT chapter_id,next_chapter_id,link_description,victory FROM link where chapter_id=' . $id);

        foreach ($tab as $row) {
            $this->choices[] = [
                'chapter_id' => $row['next_chapter_id'],
                'link_description' => $row['link_description'],
                'victory' => $row['victory']
            ];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getChoices()
    {
        return $this->choices;
    }

}
