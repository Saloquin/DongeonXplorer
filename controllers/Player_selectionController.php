<?php
class Player_selectionController {
    public function index() {
        require_once 'views/player_selection.php';
    }
    public function CreateHero(){
        $user =new User($_SESSION['user']);
        $name = $_POST['heroName'];
        $id_class = $_POST['classId'];
        $tab= lireBase(connexionDb(),'select base_pv,base_mana,strength,initiative, class_image from class where class_id = '.$id_class);
        $sql = "INSERT INTO hero (user_id, chapter_id, hero_name, class_id, pv, mana, strength, initiative, armor, primary_weapon, secondary_weapon, xp, money, current_level, mana_max, pv_max, image) 
        VALUES (
            '".$user->getId()."',
            1,
            '".$name."',
            '".$id_class."',
            ".$tab[0]['base_pv'].",
            ".$tab[0]['base_mana'].",
            ".$tab[0]['strength'].",
            ".$tab[0]['initiative'].",
            0,
            0,
            0,
            0,
            0,
            1,
            ".$tab[0]['base_mana'].",
            ".$tab[0]['base_pv'].",
            ".(isset($tab[0]['class_image']) ? "'".$tab[0]['class_image']."'" : "NULL")."
        )";

        $db = connexionDb();
        if(lireBase($db,'select count(*) as nb from hero where user_id = '.$user->getId())[0]['nb'] > 0){
            header('Location:  profil');
            exit();
        }
        modifieBase($db, $sql);
        $user->setHero($user->getId());
        header('Location: home');
        exit();
    }
}