<?php 
    require '../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur', 'veterinaire'];
    
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || !in_array($_SESSION['role'], $roles_autorises)) {
        header("Location: /erreur_acces.php");
        exit;
    }
    // Définir la redirection en fonction du rôle
    if (isset($_SESSION['role'])) {
        switch ($_SESSION['role']) {
            case 'administrateur':
                $lienRetour = "/admin/index.php";
                break;
            case 'veterinaire':
                $lienRetour = "/admin/indexVeterinaire.php";
                break;
            case 'employe':
                $lienRetour = "/admin/indexEmployer.php";
                break;
            default:
                $lienRetour = "/login.php"; // Par défaut, redirection vers la connexion si le rôle est inconnu
        }
    } else {
        $lienRetour = "/login.php"; // Redirige vers login si aucun rôle défini
    }
    // Importation du connection
    require '../includes/config/database.php';
    $db = connectDB();

    //Le Query
    $query = "SELECT * FROM habitats";

    //Consultation du DB
    $resultatConsult = mysqli_query($db, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);

      if($id) {

        // Vérifier si l'animal a des rapports associés
        $query = "SELECT COUNT(*) as total FROM rapports WHERE habitat_id = {$id}";
        $resultat = mysqli_query($db, $query);
        $data = mysqli_fetch_assoc($resultat);
    
        if ($data['total'] > 0) {
            echo "<div class='alert alert-danger text-center p-3'>
                     <strong>Erreur :</strong> Impossible de supprimer cet habitat. Il a des animaux et rapports vétérinaires associés.
                  </div>";
        } else {
            // Récupérer l'image avant de supprimer l'animal
            $query = "SELECT image_path FROM habitats WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);
            $habitat = mysqli_fetch_assoc($resultat);
    
            // Vérifier si l'image existe et la supprimer
            if (!empty($habitat["image_path"]) && file_exists("../images/" . $habitat["image_path"])) {
                unlink("../images/" . $habitat["image_path"]);
            }
    
            // Supprimer l'animal de la base de données
            $query = "DELETE FROM habitats WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);
    
            if($resultat) {
                // Si la suppression de l'animal est réussie
                switch ($_SESSION['role']) {
                    case 'administrateur':
                        // Si l'utilisateur est administrateur, rediriger vers la page d'administration
                        header('Location: /admin/index.php?resultat=3');
                        break;
                    case 'veterinaire':
                        // Si l'utilisateur est vétérinaire, rediriger vers le tableau de bord vétérinaire
                        header('Location: /admin/indexVeterinaire.php?resultat=3');
                        break;
                    default:
                        // Si le rôle est inconnu, rediriger vers la page d'accueil ou de connexion
                        header('Location: /login.php');
                        break;
                }
                exit; // Assurez-vous de sortir après la redirection pour éviter l'exécution du script
            }
        }
    }
    

      // if($id) {

      //     //Effacer le fichier
      //     $query = "SELECT image_path FROM habitats WHERE id = {$id}";

      //     $resultat = mysqli_query($db, $query);
      //     $habitat = mysqli_fetch_assoc($resultat);

      //     unlink('../images/' . $habitat["image_path"]);

      //     //Effacer animal
      //     $query = "DELETE FROM habitats WHERE id = {$id}";
      //     $resultat = mysqli_query($db, $query);

      //     if($resultat) {
      //         header('location: /admin?resultat=3');
      //     }
      // }
  }


  incluTemplate('header');
?>

<main>
    <div class="p-3">
        <h1 class="text-center">Habitats</h1>
    </div>
    <section>
  <div class="mb-3 d-flex justify-content-evenly">
        <a href="<?php echo $lienRetour; ?>" class="btn btn-success m-1">Revenir</a>
        <a href="/admin/form/new_habitat.php" class="btn btn-warning ms-4">Habitat (+)</a>
  </div>
  <div class="card mb-3 container formeLine">
      
      <table class="table">
          <thead>
              <tr>
              <th scope="col">Id</th>
              <th scope="col">Nom</th>
              <th scope="col">Image</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody><!-- Montrer les infor de las BD -->
              <tr>
                <?php while($habitat = mysqli_fetch_assoc($resultatConsult)): ?>
              <th scope="row"><?php echo $habitat['id']; ?></th>
              <td><?php echo $habitat['nom']; ?></td>
              <td><img src="/images/<?php echo $habitat['image_path']; ?>" height="30" width="80" alt="Image savane"></td>
              <td><?php echo $habitat['description']; ?></td>
              <td><a href="/admin/actualisation/act_habitat.php?id=<?php echo $habitat['id']; ?>" class="text-center text-info">Modifier</a>
                  <form method="POST">
                      <input type="hidden" name="id" value="<?php echo $habitat['id']; ?>">
                      <input type="submit" class="text-center text-danger" value="Effacer">
                  </form>
              </td>
              </tr>
                <?php endwhile; ?>
          </tbody>
      </table>
  </div>

</section>

</main>






<?php  
  //Fermer la connection
  mysqli_close($db);
  incluTemplate('footer'); 
?>
