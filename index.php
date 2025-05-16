<?php 

require_once __DIR__ . '/includes/config/database.php';
require_once __DIR__ . '/includes/functions.php';

  /** Temoignages */
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier le token CSRF
    if (empty($_POST['csrf_token'])
        || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Requête invalide (CSRF)"); 
    }

    $nomPrenom = $_POST['prenom'] ?? '';
    $qualification = $_POST['options'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validation des donnes
    if (!empty($nomPrenom) && !empty($qualification) && !empty($message)) {

      // BD
      require 'includes/config/database.php';
      $db = connectDB();

      // Preparation de consulte
      $query = "INSERT INTO temoignages (nom_prenom, qualification, message) VALUES (?, ?, ?)";
      $stmt = $db->prepare($query);
      $stmt->bind_param("sss", $nomPrenom, $qualification, $message);

      if ($stmt->execute()) {
          echo "<div class='alert alert-success'>Témoignage ajouté avec succès!</div>";
      } else {
          echo "<div class='alert alert-danger'>Erreur : " . $stmt->error . "</div>";
      }

      $stmt->close();
      $db->close();
      } else {
          echo "<div class='alert alert-warning'>Tous les champs sont requis.</div>";
      }
}
  
  incluTemplate('header');
?>
  <div class="shadow p-3 mb-5">
    <h1 class="text-center"><strong>ARCADIA</strong> Zoo</h1>
    <h3 class="text-center">"Découvrez la magie de la nature à chaque coin de notre zoo."</h3>
  </div>


  <div id="carouselExampleDark" class="container carousel carousel-dark slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <!-- SAVANE -->
      <div class="carousel-item active" data-bs-interval="10000">
          <a href="#"><img src="/img/carousel/1 savane.jpg" class="d-block w-100" alt="savane"></a>
        <div class="carousel-caption d-none d-md-block bg-text">
          <h2 class="text-light ">SAVANE</h2>
        </div>
      </div>
      <!-- FORET -->
      <div class="carousel-item" data-bs-interval="2000">
        <a href="#"><img src="/img/carousel/2 foret.jpg" class="d-block w-100" alt="habitat foret"></a>
        <div class="carousel-caption d-none d-md-block bg-text">
          <h2 class="text-light">FORET</h2>
        </div>
      </div>
      <!-- MARAIS -->
      <div class="carousel-item">
        <a href="#"><img src="/img/carousel/3 marais.jpg" class="d-block w-100" alt="Habitat marais"></a>
        <div class="carousel-caption d-none d-md-block bg-text">
          <h2 class="text-light">MARAIS</h2>
        </div>
      </div>
      <!-- MONTAGNE -->
      <div class="carousel-item">
        <a href="#"><img src="/img/carousel/4 montagne.jpg" class="d-block w-100" alt="Habitat montagne"></a>
        <div class="carousel-caption d-none d-md-block bg-text">
          <h2 class="text-light">MONTAGNE</h2>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container mt-4 mb-4 d-flex justify-content-center">
  <a href="/habitats.php" class="btn btn-warning">Plus d'info</a>

  </div>

  <div class="text-success">
    <hr>
  </div>
  <!-- 3 cards animaux -->
  <?php incluTemplate('animal_card'); ?>


  
  <div class="shadow p-3 mb-5">
      <h1 class="text-center"><strong>NOS SERVICES</strong></h1>
  </div>
  <!-- Insertoin des templates -->
  <?php incluTemplate('services'); ?>
  <?php incluTemplate('restauration'); ?>
  <?php incluTemplate('temoignages'); ?>
  <?php incluTemplate('footer'); ?>
  
  