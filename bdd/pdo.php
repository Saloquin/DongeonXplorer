<?php

//CONNECTION A LA BASE : $base_conn
//REQUETE SELECT : lireBase($base_conn, <requete sql>, <tableau>)
//REQUETE INSERT_UPDATE_DELETE : modifieBase($base_conn, <requete sql>)
//require_once('connnexion_bdd.php');
$utilisateur = "saloquin";
$mot_de_passe = "1234";
$baseMySQL = "mysql:host=localhost;port=3306;dbname=dongeon;charset=utf8mb4";
 

try {
    $base_conn = new PDO($baseMySQL, $utilisateur, $mot_de_passe);
} catch (PDOException $erreur) {
    echo "Erreur de connexion : " . $erreur->getMessage();
}

	
	/* Requête select
	 * 
	 * 
	 * @return le nombre de ligne lu
	 * 
	 * @param base_conn -> toujour utiliser $base_conn     
	 * @param sql -> votre requete sql comportant un select
	 * @param tableau -> tableau à remplir par la requete
	 */
	function lireBase($base_conn, $sql, &$tableau){
		$i=0;
		foreach  ($base_conn->query($sql,PDO::FETCH_ASSOC) as $ligne)     
			$tableau[$i++] = $ligne;
		$nbLignes = $i;
		return $nbLignes;	
	}
	
	
	
	/* Requête insert, update, delete 
	 * /!\ modifie la base et commit /!\
	 * 
	 * 
	 * @return 1 si la requete c'est executer correctement, O sinon
	 * 
	 * $base_conn  -> toujour utiliser $base_conn     
	 * $sql        -> votre requete sql comportant un select
	 */
	function modifieBase($base_conn,$sql){
		$reussi = $base_conn->exec($sql);
		return $reussi;
		
		
	}
?>