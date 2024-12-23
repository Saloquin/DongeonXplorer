<?php
function connexionDb(){

    // Chemin vers le fichier .env
    $envFile = DIR_ROOT.'/.env';

    // Vérification de l'existence du fichier .env
    if (!file_exists($envFile)) {
        die("Le fichier .env n'existe pas.");
    }

    // Lecture du fichier .env et récupération des variables d'environnement
    $env = parse_ini_file($envFile);
    //var_dump($env);

    // Récupération des variables d'environnement
    $dbHost = $env['DB_HOST'];
    $dbName = $env['DB_NAME'];
    $dbUser = $env['DB_USER'];
    $dbPassword = $env['DB_PASSWORD'];

    try {
        // Connexion à la base de données
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
        // Définition des attributs de PDO pour afficher les erreurs
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {  
     }
     return null;
}


function lireBase($base_conn, $sql_verif) {
    //$sql_verif = strtolower($sql_verif);
    $stmt = $base_conn->prepare($sql_verif);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function modifieBase($base_conn, $sql) {
    //$sql = strtolower($sql);
    $stmt = $base_conn->prepare($sql);
    return $stmt->execute();
}