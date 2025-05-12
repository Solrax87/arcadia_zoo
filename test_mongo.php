<?php
require 'vendor/autoload.php'; // Carga automática de Composer

try {
    // Connexion MongoDB
    $client = new MongoDB\Client("mongodb://mongo:27017");

    // Sélectionner la base et la collection
    $database = $client->selectDatabase('a_zoo');
    $collection = $database->selectCollection('animaux');

    // Récupérer les documents (équivalent SELECT * FROM animaux)
    $documents = $collection->find();

    echo "<h1>Liste des animaux :</h1>";
    echo "<ul>";

    foreach ($documents as $doc) {
        echo "<li>";
        echo "Nom : " . ($doc['nom'] ?? 'Inconnu') . " - ";
        echo "Espèce : " . ($doc['espece'] ?? 'Inconnue');
        echo "</li>";
    }

    echo "</ul>";

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
