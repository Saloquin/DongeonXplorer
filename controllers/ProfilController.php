<?php
require_once 'bdd/Database.php';
class ProfilController
{
    public function index()
    {
        require_once 'views/profil.php';
    }

    public function changePP()
    {   
        $user= new User($_SESSION['user']);
        $image = $_POST['avatarUrl'];
        $image = htmlspecialchars($image);
        $req = "select count(*) as nb from users where users_image = '" . $image . "' and user_id = " . $user->getId();
        $db = connexionDb();
        if (lireBase($db, $req)[0]['nb'] != 1) {
            $stmt = $db->prepare("UPDATE users SET users_image = :image WHERE user_id = :id");
            $stmt->execute([
                ':image' => $image,
                ':id' => $user->getId(),
            ]);
        }
        $user->setImage($image);
        header('Location: profil');
    }

    public function deleteHero(){
        if(lireBase(connexionDb(), "select count(*) from inventory where hero_id = (select hero_id from hero where user_id = ".$_SESSION['user'].")")[0]['nb']>0)
            modifieBase(connexionDb(), "delete from inventory where hero_id = (select hero_id from hero where user_id = ".$_SESSION['user'].")");
        modifieBase(connexionDb(), "delete from hero where user_id = ".$_SESSION['user']);
        header('Location: profil');
    }
}