<?php

// Inclure le fichier de session si besoin
require_once __DIR__ . '/session.php';

// Fonction pour connecter la base de données
function connectDB(): mysqli {
    // Utiliser les variables d'environnement Docker OU fallback local
    $host = getenv('DB_HOST') ?: 'mysql';           // "mysql" est le nom du service dans Docker
    $user = getenv('DB_USER') ?: 'zoo_user';
    $password = getenv('DB_PASSWORD') ?: 'zoo_pass';
    $database = getenv('DB_NAME') ?: 'a_zoo';

    // Connexion à MySQL
    $db = mysqli_connect($host, $user, $password, $database);

    // Vérification de la connexion
    if (!$db) {
        echo "Erreur : Connexion impossible à la base de données.";
        exit;
    }
    //nDéfinir le jeu de caractères    
    mysqli_set_charset($db, "utf8mb4");

    return $db;
}
?>
