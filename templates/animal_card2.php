<?php 
     $id = $_GET['id'];
     $id = filter_var($id, FILTER_VALIDATE_INT);
 
     if(!$id) {
         header('location: /');
     }

    $db = connectDB();

    // Limite de animal_card 4 pour ne pas invair l'index
    // $limite = isset($limite) ? (int)$limite : 4;

    //Consultation
    $query = "SELECT animaux.id, animaux.nom, animaux.espece, animaux.image_path, 
                habitats.nom AS habitat_nom,
                utilisateurs.nom AS veterinaire_nom
                FROM animaux
                LEFT JOIN habitats ON animaux.habitat_id = habitats.id
                LEFT JOIN utilisateurs ON animaux.veterinaire_id = utilisateurs.id
                WHERE animaux.habitat_id = $id";


    //Les resultats
    $resultat = mysqli_query($db, $query);
?>

<!-- Cartes des animaux -->
<section class="container-fluid row justify-content-sm-center">
    
    <h2 class="text-center mt-4">NOS AMIS LES ANIMAUX</h2>
    
    <!-- 1 -->
    <?php while($animal = mysqli_fetch_assoc($resultat)) : ?>
        <div class="card col-lg-2 m-3 shadow p-3 mb-5 cardZoom" style="width: 18rem;">
            <a href="/habitats/rapportAnimal.php?id=<?php echo $animal['id']; ?>" class="text-decoration-none">
            <img src="/images/<?php echo $animal['image_path'] ?>" class="card-img-top" alt="image animal">
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $animal['nom'] ?></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Animal - <?php echo $animal['espece'] ?></li>
                    <li class="list-group-item">Habitat - <?php echo $animal['habitat_nom'] ?></li>
                    <li class="list-group-item">Vétérinaire - <?php echo $animal['veterinaire_nom'] ?></li>
                </ul>
            </div>
        </a>
        </div>
    <?php endwhile; ?>
    
</section>


<?php
    // Deconnecter
    mysqli_close($db);
?>