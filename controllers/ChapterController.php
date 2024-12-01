<?php
// controllers/ChapterController.php
require_once 'bdd/Database.php';
require_once 'models/Chapter.php';

class ChapterController
{
    private $chapters = [];

    public function __construct()
    {
        $tab=array();
        lireBase(connexionDb(), 'SELECT chapter_id FROM chapter', $tab);
        foreach ($tab as $row) {
            $chapter = new Chapter($row['chapter_id']);
            $this->chapters[] = $chapter;
        }
    }

    public function show($id)
    {
        $chapter = $this->getChapter($id);

        if ($chapter) {
            include 'views/chapter_view.php'; // Charge la vue pour le chapitre
        } else {
            // Si le chapitre n'existe pas, redirige vers un chapitre par défaut ou affiche une erreur
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getChapter($id)
    {
        foreach ($this->chapters as $chapter) {
            if ($chapter->getId() == $id) {
                return $chapter;
            }
        }
        return null; // Chapitre non trouvé
    }
}
