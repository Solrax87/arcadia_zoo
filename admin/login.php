<?php 
  session_start(); // Toujours au début

  // Connexion à la base de données
  require '../includes/config/database.php';
  $db = connectDB();

  $erreurs = [];

  // Authentification de l'utilisateur
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
      // Valider et nettoyer l'email
      $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      if ($email) {
          $email = mysqli_real_escape_string($db, $email);
      } else {
          $erreurs[] = "L'email est invalide";
      }

      // Obtenir le mot de passe
      $password = $_POST['password'];

      // Vérifier si les champs sont vides
      if (!$email) {
          $erreurs[] = "L'email est obligatoire";
      }
      if (!$password) {
          $erreurs[] = "Le mot de passe est obligatoire";
      }

      if (empty($erreurs)) {
          // Vérifier si l'utilisateur existe avec une requête préparée
          $query = "SELECT * FROM utilisateurs WHERE email = ?";
          $stmt = mysqli_prepare($db, $query);
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
          $resultat = mysqli_stmt_get_result($stmt);
          mysqli_stmt_close($stmt);

          if ($resultat->num_rows) {
              // Récupérer les données de l'utilisateur
              $utilisateur = mysqli_fetch_assoc($resultat);

              // Vérifier si le mot de passe est correct
              if (password_verify($password, $utilisateur['password'])) {
                  // Authentifier l'utilisateur
                  $_SESSION['utilisateur'] = $utilisateur['email'];
                  $_SESSION['login'] = true;
                  $_SESSION['role'] = $utilisateur['role']; // Stocker le rôle

                  // Redirection selon le rôle
                  switch ($_SESSION['role']) {
                      case 'administrateur':
                          header("Location: /admin/index.php");
                          break;
                      case 'veterinaire':
                          header("Location: /admin/indexVeterinaire.php");
                          break;
                      case 'employe':
                          header("Location: /admin/indexEmployer.php");
                          break;
                      default:
                          header("Location: /");
                  }
                  exit;

              } else {
                  $erreurs[] = "Le mot de passe est incorrect";
              }
          } else {
              $erreurs[] = "L'utilisateur n'existe pas";
          }
      }
  }

  // Fermer la connexion à la BD
  mysqli_close($db);

  // Header
  require '../includes/functions.php';
  incluTemplate('header');
?>


<main class="mt-4">
  <h1 class="text-center">Connection</h1>
  <?php foreach($erreurs as $erreur): ?>
    <div class="col">
      <div class="card p-3 mb-1 text-center bg-danger text-light container bande">
          <?php echo $erreur; ?>
      </div>
    </div>
   
  <?php endforeach; ?>
  <div class="card text-bg-secondary mb-3 container container-fluide" style="max-width: 30rem;">
    <form method="POST" class="m-4">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mot de Passe</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <input type="submit" class="btn btn-warning" value="Connecter"></input>
    </form>
  </div>
</main>



<?php  incluTemplate('footer'); ?>
  