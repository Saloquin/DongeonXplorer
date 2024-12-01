<?php
// controllers/ChapterController.php
require_once 'bdd/Database.php';
require_once 'models/Chapter.php';

class ChapterController
{
    private $chapters = [];

    public function __construct()
    {
        
        $tab=lireBase(connexionDb(), 'SELECT chapter_id FROM chapter');
        foreach ($tab as $row) {
            $chapter = new Chapter($row['chapter_id']);
            $this->chapters[] = $chapter;
        }
    }

    public function show()
    {
        $user = new User($_SESSION['user']);
        if(isset($_POST['chapter_id']))
        {   
            modifieBase(connexionDb(),'update hero set chapter_id='.$_POST['chapter_id'].' where user_id='.$user->getId());
            $chapter= $this->getChapter($user->getHero()->getChapter());
        }
        else
            $chapter = $this->getChapter($user->getHero()->getChapter());
        if ($chapter) {
            include 'views/chapter_view.php'; 
        } else {
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
