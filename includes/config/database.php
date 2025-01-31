<?php

// Inclure le fichier session.php seulement une fois pour éviter les erreurs
require_once 'session.php';

// Fonction pour connecter la base de données
function connectDB(): mysqli {
    // Connexion à la base de données
    $db = mysqli_connect('localhost', 'root', '', 'a_zoo');

    // Vérifier si la connexion a échoué
    if (!$db) {
        echo "Erreur : Connexion impossible à la base de données.";
        exit;
    }
    return $db; // Retourner l'objet de connexion
}
?>
