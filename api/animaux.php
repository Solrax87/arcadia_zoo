<?php
require_once __DIR__ . '/../vendor/autoload.php';

$client = new MongoDB\Client("mongodb://mongo:27017");
$db = $client->a_zoo;

$collectionAnimaux = $db->animaux;

$animaux = $collectionAnimaux->find([], ['limit' => 5])->toArray();

// Formatear para respuesta JSON
$result = [];
foreach ($animaux as $animal) {
    $result[] = [
        'nom' => $animal['nom'],
        'espece' => $animal['espece'],
        'image_path' => $animal['image_path']
    ];
}

header('Content-Type: application/json');
echo json_encode($result);
?>
