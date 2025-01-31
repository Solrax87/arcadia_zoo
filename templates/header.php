<?php
  

  if(!isset($_SESSION)) {
    session_start();
  }
  
  $auth = $_SESSION['login'] ?? false;
  

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Sources bootstrap -->
    <link rel="stylesheet" href="/src/main.css">
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="/../css/styles.css" as="style">
    <!-- normalize -->
    <link rel="preload" href="/node_modules/normalize.css/normalize.css">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/img/logo/favicon.ico">
    
    <!-- Titre onglets du navigateur -->
    <title>Arcadia Zoo</title>
</head>

<body>
  
  <header>

    <!-- Barre nav menu header -->
    <nav class="navbar navbar-expand-lg nav-bg ">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a href="/"><img class="m-2 rounded" src="/img/logo/logo_zoo_arcadia.png" width="80" height="80" alt="logo arcadia zoo" ></a>
            </li>
          </ul>
          
          <div class="d-flex row pe-4 nav-links">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link col-sm p-3" href="/">ACCUEIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link col-sm p-3" href="/services.php">SERVICES</a>
                </li>
                <li class="nav-item dropdown">
                    <!-- Enlace principal HABITATS -->
                    <a class="nav-link col-sm p-3" href="/habitats.php" id="habitatsDropdown" role="button" aria-expanded="false">
                        HABITATS
                    </a>
                    <!-- Submenú (dropdown) -->
                    <!-- <ul class="dropdown-menu bg-dark" aria-labelledby="habitatsDropdown">
                        <li><a class="dropdown-item text-warning" href="/habitats/savane.php">Savane</a></li>
                        <li><a class="dropdown-item text-warning" href="/habitats/foret.php">Forêt</a></li>
                        <li><a class="dropdown-item text-warning" href="/habitats/montagne.php">Montagne</a></li>
                        <li><a class="dropdown-item text-warning" href="/habitats/marais.php">Marais</a></li>
                    </ul> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link col-sm p-3" href="/admin/login.php">CONNEXION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link col-sm p-3" href="/contact.php">CONTACT</a>
                </li>
                <?php if($auth) :  ?>
                  <li class="nav-item">
                    <a class="nav-link col-sm p-3" href="/deconnection.php">DÉCONNECTION</a>
                </li>
                <?php endif; ?>
              </ul>
          </div>
        </div>
      </div>
    </nav>

  </header>
   