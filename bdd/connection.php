<?php
session_start();
require_once("pdo.php");

// Vérifie si le pseudo est défini
if (isset($_POST['pseudo'])) {
    // Sécurise le pseudo avant de l'utiliser
    $pseudo = htmlspecialchars($_POST['pseudo']);

    $sql_verif="select count(*) as cou from utilisateur where pseudo = '".$_POST['pseudo']."'";
    $tab = array();
    lireBase($base_conn, $sql_verif, $tab);
    if($tab[0]['cou']==0){
        $sql="insert into utilisateur(pseudo)values ('".$_POST['pseudo']."')";
        modifieBase($base_conn,$sql);
    }

    // Stocke le pseudo dans la session
    $_SESSION['pseudo'] = $pseudo;

    // Redirige vers index.php
    header("Location: index.php");
    exit();
}
header("Location: index.php");
?>
