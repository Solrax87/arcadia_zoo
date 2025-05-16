<?php
// 1) Session sécurisée et configuration
require_once __DIR__ . '/../includes/config/session.php';
require_once __DIR__ . '/../includes/config/database.php';
require_once __DIR__ . '/../includes/Utils/Escaper.php';

use Utils\Escaper;

// 2) Récupération et validation de l’ID
$animalId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$animalId) {
    header('Location: /habitats');
    exit;
}

// 3) Connexion et requête préparée
$db = connectDB();
$sql = "
    SELECT 
      r.date, r.etat, r.nourriture, r.grammage, r.commentaire,
      h.id AS habitat_id, h.nom AS habitat_nom,
      u.nom AS veterinaire_nom,
      a.nom AS animal_nom, a.espece AS animal_espece, a.image_path AS image_animal
    FROM rapports AS r
    LEFT JOIN habitats    AS h ON r.habitat_id    = h.id
    LEFT JOIN utilisateurs AS u ON r.veterinaire_id = u.id
    LEFT JOIN animaux    AS a ON r.animal_id      = a.id
    WHERE a.id = ?
    ORDER BY r.date DESC
    LIMIT 1
";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $animalId);
$stmt->execute();
$result = $stmt->get_result();

// 4) Vérification du résultat
if ($result->num_rows === 0) {
    echo "<p class='text-center'>Aucun rapport trouvé pour cet animal.</p>";
    exit;
}
$rapport = $result->fetch_assoc();

// 5) Affichage
require_once __DIR__ . '/../includes/functions.php';
incluTemplate('header');
?>

<div class="shadow p-3 mb-5">
  <h1 class="text-center">Nos amis</h1>
  <h3 class="text-center">« Nos amis, les ambassadeurs de la nature »</h3>
</div>

<div class="text-center mt-4 p-3">
  <a href="/habitats/habitat.php?id=<?php echo Escaper::i($rapport['habitat_id']); ?>"
     class="btn btn-primary p-3">
    Retour aux animaux
  </a>
</div>

<section class="container container-fluid">
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <div class="card shadow p-3 mb-5">
        <img src="/images/<?php echo Escaper::e($rapport['image_animal']); ?>"
             class="card-img-top"
             alt="Image de <?php echo Escaper::e($rapport['animal_nom']); ?>">
        <div class="card-body">
          <h5 class="card-title text-center">
            <?php echo Escaper::e($rapport['animal_nom']); ?>
          </h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              Animal – <?php echo Escaper::e($rapport['animal_espece']); ?>
            </li>
            <li class="list-group-item">
              Habitat – <?php echo Escaper::e($rapport['habitat_nom']); ?>
            </li>
            <li class="list-group-item">
              Vétérinaire – <?php echo Escaper::e($rapport['veterinaire_nom']); ?>
            </li>
            <li class="list-group-item">
              État – <?php echo Escaper::e($rapport['etat']); ?>
            </li>
            <li class="list-group-item">
              Nourriture – <?php echo Escaper::e($rapport['nourriture']); ?>
            </li>
            <li class="list-group-item">
              Grammage – <?php echo Escaper::i($rapport['grammage']); ?> gr
            </li>
            <li class="list-group-item">
              Date de passage – <?php echo Escaper::e($rapport['date']); ?>
            </li>
            <li class="list-group-item">
              Commentaire – <?php echo Escaper::e($rapport['commentaire']); ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$stmt->close();
$db->close();
incluTemplate('footer');
