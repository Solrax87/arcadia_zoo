<?php 
    require '../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur', 'veterinaire'];
    
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || !in_array($_SESSION['role'], $roles_autorises)) {
        header("Location: /erreur_acces.php");
        exit;
    }
    // Importation du connection
    require '../includes/config/database.php';
    $db = connectDB();

    //Le Query
    $query = "SELECT * FROM services";
    
    //Consultation du DB
    $resultatConsult = mysqli_query($db, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

           //Supprimer le fichier
           $query = "SELECT image_path FROM services WHERE id = {$id}";
        
           $resultat = mysqli_query($db, $query);
           $service = mysqli_fetch_assoc($resultat);
        
            // Vérifier si l'image existe avant de la supprimer
            if (!empty($service['image_path']) && file_exists('../images/' . $service["image_path"])) {
                unlink('../images/' . $service["image_path"]);
            }
        
            //Supprimer service
            $query = "DELETE FROM services WHERE id = {$id}";
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

    incluTemplate('header');
    ?>

<main>
    <div class="p-3">
        <h1 class="text-center">Services</h1>
    </div>
    <section>
  <div class="mb-3 d-flex justify-content-evenly">
        <a href="<?php echo $lienRetour; ?>" class="btn btn-success m-1">Revenir</a>
        <a href="/admin/form/new_service.php" class="btn btn-warning ms-4">Service (+)</a>
  </div>
  <div class="card mb-3 container formeLine">
      
      <table class="table">
          <thead>
              <tr>
              <th scope="col">Id</th>
              <th scope="col">Titre</th>
              <th scope="col">Image</th>
              <th scope="col">Type</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody> <!-- Montrer les info de la BD -->
              <tr>
            <?php while($service = mysqli_fetch_assoc($resultatConsult)): ?>
              <th scope="row"><?php echo $service['id'];?></th>
              <td><?php echo $service['titre'];?></td>
              <td><img src="/images/<?php echo $service['image_path']; ?>" height="40" width="40" alt="Image service en famille"></td>
              <td><?php echo $service['type'];?></td>
              <td><?php echo $service['description'];?></td>
              <td><a href="/admin/actualisation/act_services.php?id=<?php echo $service['id']; ?>" class="text-center text-info">Modifier</a>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
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