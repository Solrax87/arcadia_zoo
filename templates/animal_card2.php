<?php
// 1. On inclut la DB et l’Escaper
require_once __DIR__ . '/../includes/config/database.php';
require_once __DIR__ . '/../includes/Utils/Escaper.php';

use Utils\Escaper;

// 2. On récupère l’ID d’habitat depuis l’URL, en forcant en int
$habitatId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;

// 3. Connexion et requête
$db = connectDB();
$query = "
    SELECT a.id, a.nom, a.espece, a.image_path,
           h.nom AS habitat_nom,
           u.nom AS veterinaire_nom
    FROM animaux a
    LEFT JOIN habitats h ON a.habitat_id = h.id
    LEFT JOIN utilisateurs u ON a.veterinaire_id = u.id
    WHERE a.habitat_id = ?
    LIMIT 4
";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $habitatId);
$stmt->execute();
$resultat = $stmt->get_result();
?>

<section class="container-fluid row justify-content-sm-center">
  <h2 class="text-center mt-4">Nos amis de cet habitat</h2>

  <?php while ($animal = $resultat->fetch_assoc()) :
    // On nettoie chaque champ
    $id     = Escaper::i($animal['id']);
    $nom    = Escaper::e($animal['nom']);
    $espece = Escaper::e($animal['espece']);
    $habitat = Escaper::e($animal['habitat_nom']);
    $img    = Escaper::e($animal['image_path']);
    $veto   = Escaper::e($animal['veterinaire_nom']);
  ?>
    <a href="/habitats/rapportAnimal.php?id=<?php echo $id; ?>"
       class="text-decoration-none text-reset col-lg-2 m-3"
       style="max-width:18rem;">
      <div class="card shadow p-3 mb-5 cardZoom">
        <img src="/images/<?php echo $img; ?>"
             class="card-img-top"
             alt="Image de <?php echo $nom; ?>">
        <div class="card-body">
          <h5 class="card-title text-center"><?php echo $nom; ?></h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Espèce - <?php echo $espece; ?></li>
            <li class="list-group-item">Habitat - <?php echo $habitat; ?></li>
            <li class="list-group-item">Vétérinaire - <?php echo $veto; ?></li>
          </ul>
        </div>
        
      </div>
    </a>
  <?php endwhile; ?>
</section>

<?php
$stmt->close();
$db->close();
?>
