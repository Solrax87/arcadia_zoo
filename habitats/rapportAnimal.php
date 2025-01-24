<?php 

    // Importation des fonctions et connexion à la base de données
    require '../includes/config/database.php';

    // Verifica si el ID está presente en la URL
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    if ($id <= 0) {
        header("Location: /habitats");
        exit;
    }

    // Importar la base de datos
    $db = connectDB();

    // Consulta para obtener los detalles del animal y su informe
    $query = "SELECT 
                rapports.date, 
                rapports.etat, 
                rapports.nourriture, 
                rapports.grammage, 
                rapports.commentaire,
                habitats.id AS habitat_id,
                habitats.nom AS habitat_nom,
                utilisateurs.nom AS veterinaire_nom,
                animaux.nom AS animal_nom,
                animaux.espece AS animal_espece,
                animaux.image_path AS image_animal
            FROM rapports
            LEFT JOIN habitats ON rapports.habitat_id = habitats.id
            LEFT JOIN utilisateurs ON rapports.veterinaire_id = utilisateurs.id
            LEFT JOIN animaux ON rapports.animal_id = animaux.id
            WHERE animaux.id = $id
            ORDER BY rapports.date DESC
            LIMIT 1";

    // Ejecutar consulta
    $resultat = mysqli_query($db, $query);

    // Verificar si hay resultados
    if (mysqli_num_rows($resultat) == 0) {
        echo "<p class='text-center'>Aucun rapport trouvé pour cet animal.</p>";
        exit;
    }

    // Obtener los datos del animal
    $rapport = mysqli_fetch_assoc($resultat);

    require '../includes/functions.php';
    incluTemplate('header');
?>

<div class="shadow p-3 mb-5">
    <h1 class="text-center">Nos amis</h1>
    <h3 class="text-center">""Nos amis, les ambassadeurs de la nature""</h3>
</div>

<!-- Button pour le retour -->
<div class="text-center mt-4 p-3">
    <a href="/habitats/habitat.php?id=<?php echo $rapport['habitat_id']; ?>" class="btn btn-primary p-3">Retour aux animaux</a>
</div>

<section class="container container-fluid">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card shadow p-3 mb-5">
                <img src="/images/<?php echo htmlspecialchars($rapport['image_animal']); ?>" class="card-img-top" alt="image animal">
                <div class="card-body">
                    <!-- Nom d'ami -->
                    <h5 class="card-title text-center"><?php echo htmlspecialchars($rapport['animal_nom']); ?></h5>
                    <!-- Données de l'ami -->
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Animal - <?php echo htmlspecialchars($rapport['animal_espece']); ?></li>
                        <li class="list-group-item">Habitat - <?php echo htmlspecialchars($rapport['habitat_nom']); ?></li>
                        <li class="list-group-item">Vétérinaire - <?php echo htmlspecialchars($rapport['veterinaire_nom']); ?></li>
                        <li class="list-group-item">État - <?php echo htmlspecialchars($rapport['etat']); ?></li>
                        <li class="list-group-item">Nourriture proposée - <?php echo htmlspecialchars($rapport['nourriture']); ?></li>
                        <li class="list-group-item">Nourriture en grammes - <?php echo htmlspecialchars($rapport['grammage']) . ' gr'; ?></li>
                        <li class="list-group-item">Date de passage - <?php echo htmlspecialchars($rapport['date']); ?></li>
                        <li class="list-group-item">Commentaire - <?php echo htmlspecialchars($rapport['commentaire']); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    mysqli_close($db);
    incluTemplate('footer'); 
?>
