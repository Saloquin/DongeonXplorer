<?php
// controllers/ChapterController.php
require_once 'bdd/Database.php';
require_once 'models/Chapter.php';
require_once 'models/character/monster/Monster.php';
class CombatController
{

    public function show()
    {
        include 'views/combat_view.php';
    }


    public function attack()
    {
        $user = new User($_SESSION['user']);
        $hero = $user->getHero();
        $chapter = new Chapter($user->getHero()->getChapter());

        // Récupérer un monstre de l'instance actuelle du chapitre
        $monster_id = lireBase(connexionDb(), "SELECT monster_id FROM monster join encounter using (encounter_id) WHERE chapter_id = " . $chapter->getId())[0]['monster_id'];
        $monster = new Monster($monster_id);

        // L'attaque du héros
        $monsterDamage = $hero->attack($monster); // Calcul des dégâts de l'attaque
        // L'attaque du monstre
        $heroDamage = $monster->attack($hero);

        $_SESSION['heroDamage'] = $heroDamage;
        $_SESSION['monsterDamage'] = $monsterDamage;

        // Mise à jour des PV du héros sans toucher au monstre

        // Réactualiser l'interface de combat
        include 'views/combat_view.php';
    }


    public function castSpell()
    {
        $user = new User($_SESSION['user']);
        $hero = $user->getHero();
        $_SESSION['heroLife'] = $hero->getPv();
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
            $monsterDamage = $hero->castSpell($monster, $spell_cast);

            $heroDamage = $monster->attack($hero);

            $_SESSION['spellCost'] = $spell_cast->getManaCost();
            $_SESSION['heroDamage'] = $heroDamage;
            $_SESSION['monsterDamage'] = $monsterDamage;

        }
        include 'views/combat_view.php';
    }

    public function useItem()
    {
        $user = new User($_SESSION['user']);
        $hero = $user->getHero();
        $chapter = new Chapter($user->getHero()->getChapter());
        $consumable = new Consumable($_POST['item_id']);

        if ($consumable->getMana()>0)
            $hero->mana_heal($consumable->getMana());
        if ($consumable->getSoin()>0)
            $hero->heal($consumable->getSoin());
        $hero->getInventory()->removeItem($consumable->getItemId());
        $monster_id = lireBase(connexionDb(), "SELECT monster_id FROM monster join encounter using (encounter_id) WHERE chapter_id = " . $chapter->getId())[0]['monster_id'];
        $monster = new Monster($monster_id);
        $monsterDamage = $monster->attack($hero);
        
        include 'views/combat_view.php';
    }

}
