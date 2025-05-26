<?php 
require_once __DIR__ . '/../vendor/autoload.php'; 

try {
    // Connexion à MongoDB
    $client = new MongoDB\Client("mongodb://mongo:27017");
    $db = $client->a_zoo;

    // Collections
    $collectionAnimaux = $db->animaux;

    // Limite d'animaux à afficher
    $limite = isset($limite) ? (int)$limite : 4;

    // Récupérer les animaux
    $animaux = $collectionAnimaux->find([], ['limit' => $limite])->toArray();


} catch (Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
    exit;
}
?>

<!-- Cartes des animaux -->
<!-- Bouton de bascule -->
<div class="text-center my-3">
  <button id="toggleData" class="btn btn-primary">Masquer les animaux</button>
</div>

<!-- Conteneur qu’on va montrer/cacher -->
<div id="animalCardContainer" class="row justify-content-sm-center">
  <?php foreach($animaux as $animal): ?>
    <div class="card col-lg-2 m-3 shadow p-3 mb-5 cardZoom" style="width: 18rem;">
      <img src="/images/<?php echo htmlspecialchars($animal['image_path']); ?>" 
           class="card-img-top" 
           alt="Image de <?php echo htmlspecialchars($animal['nom']); ?>">
      <div class="card-body">
        <h5 class="card-title text-center"><?php echo htmlspecialchars($animal['nom']); ?></h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Espèce : <?php echo htmlspecialchars($animal['espece']); ?></li>

        </ul>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- javascript-->
<script src="/js/main.js"></script>
