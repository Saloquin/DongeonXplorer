<?php
// controllers/ChapterController.php
require_once 'bdd/Database.php';
require_once 'models/Chapter.php';
require_once 'models/character/monster/Monster.php';


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

    public function show(){
    $user = new User($_SESSION['user']);

    if (isset($_POST['chapter_id']) && is_numeric($_POST['chapter_id'])) {   
        if (isset($_POST['end_combat']) && is_numeric($_POST['end_combat'])) {
            modifieBase(connexionDb(), "update combat set ongoing = 0 where hero_id = " . $user->getHero()->getHeroId() . " and chapter_id = " . $user->getHero()->getChapter());
        }
        if (isset($_POST['xp']) && is_numeric($_POST['xp'])) {
            $user->getHero()->addExp($_POST['xp']);
        }
        if(isset($_POST['loot']) && is_numeric($_POST['loot'])){
            $item_id = lireBase(connexionDb(),"select item_id from loot where loot_id=".$_POST['loot'])[0]['item_id'];
            $user->getHero()->getInventory()->addItem($item_id);
        }
        $chapterId = intval($_POST['chapter_id']);
        $result = modifieBase(
            connexionDb(), 
            'UPDATE hero SET chapter_id=' . $chapterId . ' WHERE user_id=' . $user->getId()
        );

        if (!$result) {
            echo "Erreur : impossible de mettre à jour le chapitre.";
            return;
        }
        $user->getHero()->setChapter($chapterId);
    }
    
    $chapter = $this->getChapter($user->getHero()->getChapter());
    

    if (!$chapter) {
        echo "Erreur : chapitre non trouvé.";
        return;
    }

    if ($chapter->getId() == 1) {
        modifieBase(connexionDb(),"update hero set pv = ".$user->getHero()->getPvMax().", mana = ".$user->getHero()->getManaMax()." where hero_id = " . $user->getHero()->getHeroId());
    }

    $req = "SELECT COUNT(*) as nb FROM encounter WHERE chapter_id=" . $chapter->getId();
    $tab = lireBase(connexionDb(), $req);

    if ($tab[0]['nb'] == 0) {
        include 'views/chapter_view.php';
    } else {
        // Récupérer le type de la première rencontre
        $encReq = "SELECT entity_type FROM encounter WHERE chapter_id=" . $chapter->getId();
        $enc = lireBase(connexionDb(), $encReq);

        if ($enc[0]["entity_type"] == "npc") {
            include 'views/npc_view.php';
        } else {
            $this->startCombat();
        }
    }
}

public function startCombat()
{
    // Récupérer le héros et le monstre
    $user = new User($_SESSION['user']);
    $hero = $user->getHero();
    $chapter = new Chapter($user->getHero()->getChapter());

    // Récupérer un monstre de l'instance actuelle du chapitre
    $monster_id = lireBase(connexionDb(), "SELECT monster_id FROM monster JOIN encounter USING (encounter_id) WHERE chapter_id=" . $chapter->getId())[0]['monster_id'];
    $monster = new Monster($monster_id);
    $combatExists = lireBase(connexionDb(), "SELECT COUNT(*) as nb FROM combat where hero_id = ".$user->getHero()->getHeroId()." and chapter_id = ".$user->getHero()->getChapter()." and ongoing = 1 ")[0]['nb'];

    if ($combatExists > 0) {
        include 'views/combat_view.php';
        return;
    }
    $sql="INSERT INTO combat (user_id, hero_id, monster_id, chapter_id, monster_pv,monster_mana,ongoing) 
                                VALUES (" . $_SESSION['user'] . ", " . $hero->getHeroId() . ", " . $monster->getId() . ", 
                                " . $hero->getChapter() . ", " . $monster->getPvMax() .", " . $monster->getManaMax() . ",1)";
    
    modifieBase(connexionDb(), $sql);    
    
    include 'views/combat_view.php'; 
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
