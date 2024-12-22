<?php
// controllers/ChapterController.php
require_once 'bdd/Database.php';
require_once 'models/Chapter.php';
require_once 'models/character/monster/Monster.php';
class CombatController
{




    public function attack()
    {
        $user = new User($_SESSION['user']);
        $hero = $user->getHero();
        $chapter = new Chapter($user->getHero()->getChapter());

        // Récupérer un monstre de l'instance actuelle du chapitre
        $monster_id = lireBase(connexionDb(), "SELECT monster_id FROM monster join encounter using (encounter_id) WHERE chapter_id = " . $chapter->getId())[0]['monster_id'];
        $monster = new Monster($monster_id);

        // L'attaque du héros
        $damage = $hero->attack($monster); // Calcul des dégâts de l'attaque
        // L'attaque du monstre
        $monsterDamage = $monster->attack($hero);

        // Mise à jour des PV du héros sans toucher au monstre
        modifieBase(connexionDb(), "UPDATE hero SET pv = " . $hero->getPv() . " WHERE hero_id = " . $hero->getHeroId());

        // Réactualiser l'interface de combat
        include 'views/combat_view.php';
    }


    public function castSpell()
    {
        $user = new User($_SESSION['user']);
        $hero = $user->getHero();
        $chapter = new Chapter($user->getHero()->getChapter());
        $spell_id = $_POST['spell_id'];

        $monster_id = lireBase(connexionDb(), "SELECT monster_id FROM monster join encounter using (encounter_id) WHERE chapter_id = " . $chapter->getId())[0]['monster_id'];
        $monster = new Monster($monster_id);

        $spells = $hero->getSpellList();
        foreach ($spells as $spell) {
            if ($spell->getId() == $spell_id) {
                $spell_cast = $spell;
                break;
            }
        }
        if ($user->getHero()->getMana() >= $spell_cast->getManaCost()) {
            $damage = $hero->castSpell($monster, $spell_cast);

            $monsterDamage = $monster->attack($hero);

            modifieBase(connexionDb(), "UPDATE hero SET pv = " . $hero->getPv() . " WHERE hero_id = " . $hero->getHeroId());
        }
        include 'views/combat_view.php';
    }

}
