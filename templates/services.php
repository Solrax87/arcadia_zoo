<?php 
    // Importation de la db
    require_once __DIR__ . '/../includes/config/database.php';
    $db = connectDB();

    // Limite de animal_card 4 pour ne pas invair l'index
    $limite = isset($limite) ? (int)$limite : 4;

    //Consultation
    $query = "SELECT * FROM services 
    /* Limitateur en cas de plus des 5 services */
    LIMIT {$limite}
    ";

    //Les resultats
    $resultat = mysqli_query($db, $query);
?>

<section class="container container-fluide">

    

    <!-- Cartes Services -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Restaurantes -->
        <!-- <div class="col">
            <div class="card h-100 shadow p-3 mb-5">
            <img src="/img/servicios/service_1.jpg" class="card-img-top" alt="service restauration">
            <div class="card-body">
                <h5 class="card-title">RESTAURATION</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div class="card-footer">
                <small class="text-body-secondary">Last updated 3 mins ago</small>
            </div>
            </div>
        </div> -->
        <!-- Activites en Famille -->
        <?php while($service = mysqli_fetch_assoc($resultat)) : ?>
        <a href="/services.php"><div class="col">
            <div class="card h-100 shadow p-3 mb-5 cardZoom">
                <img src="/images/<?php echo $service['image_path'] ?>" class="card-img-top" alt="service activites en famille">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4"><?php echo $service['titre'] ?></h5>
                    <p class="card-text"><?php echo $service['description'] ?></p>
                </div>
            </div>
        </div></a>
        <?php endwhile; ?>
 
</section>

