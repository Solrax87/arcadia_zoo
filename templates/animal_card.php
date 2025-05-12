<?php 
require_once __DIR__ . '/../vendor/autoload.php'; 

try {
    // Connexion à MongoDB
    $client = new MongoDB\Client("mongodb://mongo:27017");
    $db = $client->a_zoo;

    // Collections
    $collectionAnimaux = $db->animaux;
    $collectionHabitats = $db->habitats;
    $collectionUtilisateurs = $db->utilisateurs;

    // Limite d'animaux à afficher
    $limite = isset($limite) ? (int)$limite : 4;

    // Récupérer les animaux
    $animaux = $collectionAnimaux->find([], ['limit' => $limite])->toArray();

    // Récupérer tous les habitats dans un tableau clé=id
    $habitatsData = [];
    $habitats = $collectionHabitats->find();
    foreach ($habitats as $habitat) {
        $habitatsData[$habitat['id']] = $habitat['nom'];
    }

    // Récupérer tous les utilisateurs (vétérinaires ou employés) dans un tableau clé=id
    $utilisateursData = [];
    $utilisateurs = $collectionUtilisateurs->find();
    foreach ($utilisateurs as $utilisateur) {
        $utilisateursData[$utilisateur['id']] = $utilisateur['nom'];
    }

} catch (Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
    exit;
}
?>

<!-- Cartes des animaux -->
<section class="container-fluid row justify-content-sm-center">

    <!-- Bouton fetch -->
    <div class="container my-4 text-center">
  <button id="toggleData" class="btn btn-primary">Afficher les animaux</button>
  <div id="animalData" class="mt-3" style="display: none;">
</div>

</section>

<div class="container mt-2 mb-2 d-flex justify-content-center">
    <a href="/habitats.php" class="btn btn-warning">Plus d'amis</a>
</div>

<div class="text-success">
  <hr>
</div>
