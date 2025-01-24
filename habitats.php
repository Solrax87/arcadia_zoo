<?php 
// Importation de la base de données
require_once __DIR__ . '/includes/config/database.php';
$db = connectDB();

// Récupérer tous les habitats
$query = "SELECT * FROM habitats";
$resultat = mysqli_query($db, $query);

// Inclusion des fonctions
require 'includes/functions.php';
incluTemplate('header');
?>

<div class="shadow p-3 mb-5">
    <h1 class="text-center"><strong>NOS HABITATS</strong></h1>
</div>

<section class="container container-fluide">
    <div class="container text-center m-2">
        <p>Le zoo d'Arcadia est un véritable sanctuaire pour la faune, offrant une diversité d'habitats qui reflète les écosystèmes les plus fascinants de notre planète.</p>
        <p>En visitant le zoo d'Arcadia, explorez ces habitats distincts et découvrez la biodiversité exceptionnelle qu'ils abritent.</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php while($habitat = mysqli_fetch_assoc($resultat)) : ?>
            <a href="/habitats/habitat.php?id=<?php echo $habitat['id']; ?>" class="text-decoration-none">
                <div class="col shadow p-3 mb-5 cardZoom">
                    <div class="card">
                        <img src="/images/<?php echo htmlspecialchars($habitat['image_path']); ?>" class="card-img-top" alt="Image de <?php echo htmlspecialchars($habitat['nom']); ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?php echo htmlspecialchars($habitat['nom']); ?> Arcadia</h5>
                        </div>
                    </div>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</section>

<?php 
    // Deconnecter
    mysqli_close($db);

    incluTemplate('footer'); 
?>
