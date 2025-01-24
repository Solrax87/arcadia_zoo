<?php 
    require '../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur', 'veterinaire', 'employe'];
    
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
    $query = "SELECT animaux.id, animaux.nom, animaux.espece, animaux.image_path, animaux.detail, habitats.nom AS habitat_nom
              FROM animaux
              LEFT JOIN habitats ON animaux.habitat_id = habitats.id";
    
    //Consultation du DB
    $resultatConsult = mysqli_query($db, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            // Vérifier si l'animal a des rapports associés
            $query = "SELECT COUNT(*) as total FROM rapports WHERE animal_id = {$id}";
            $resultat = mysqli_query($db, $query);
            $data = mysqli_fetch_assoc($resultat);
        
            if ($data['total'] > 0) {
                echo "<div class='alert alert-danger text-center p-3'>
                         <strong>Erreur :</strong> Impossible de supprimer cet animal. Il a des rapports vétérinaires associés.
                      </div>";
            } else {
                // Récupérer l'image avant de supprimer l'animal
                $query = "SELECT image_path FROM animaux WHERE id = {$id}";
                $resultat = mysqli_query($db, $query);
                $animal = mysqli_fetch_assoc($resultat);
        
                // Vérifier si l'image existe et la supprimer
                if (!empty($animal["image_path"]) && file_exists("../images/" . $animal["image_path"])) {
                    unlink("../images/" . $animal["image_path"]);
                }
        
                // Supprimer l'animal de la base de données
                $query = "DELETE FROM animaux WHERE id = {$id}";
                $resultat = mysqli_query($db, $query);
        
                if($resultat) {
                    header('location: /admin?resultat=3');
                    exit();
                }
            }
        }
        

    //     if($id) {

    //         //Effacer le fichier
    //         $query = "SELECT image_path FROM animaux WHERE id = {$id}";

    //         $resultat = mysqli_query($db, $query);
    //         $animal = mysqli_fetch_assoc($resultat);

    //         unlink('../images/' . $animal["image_path"]);

    //         //Effacer animal
    //         $query = "DELETE FROM animaux WHERE id = {$id}";
    //         $resultat = mysqli_query($db, $query);

    //         if($resultat) {
    //             header('location: /admin?resultat=3');
    //         }
    //     }
    }
    incluTemplate('header');
?>

<div class="p-3">
    <h1 class="text-center">Les animaux</h1>
</div>

<section>
    <div class="mb-3 d-flex justify-content-evenly">
        <a href="<?php echo $lienRetour; ?>" class="btn btn-success m-1">Revenir</a>
        <a href="/admin/form/nouvel_animal.php" class="btn btn-warning ms-4">Animal (+)</a>
    </div>
    <div class="card mb-3 container formeLine">       
        <table class="table"> 
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Animal</th>
                <th scope="col">Image</th>
                <th scope="col">Habitat</th>
                <th scope="col">Descrition</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody><!-- Montrer les infor de las BD -->
                <tr>
                <?php while($animal = mysqli_fetch_assoc($resultatConsult)): ?>
                <th scope="row"><?php echo $animal['id']; ?></th>
                <td><?php echo $animal['nom']; ?></td>
                <td><?php echo $animal['espece']; ?></td>
                <td><img src="/images/<?php echo $animal['image_path']; ?>" height="40" width="40" alt="Image animal"></td>
                <td><?php echo $animal['habitat_nom']; ?></td>
                <td><?php echo $animal['detail']; ?></td>
                <td><a href="/admin/actualisation/act_les_animaux.php?id=<?php echo $animal['id']; ?>" class="text-center text-info">Modifier</a>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $animal['id']; ?>">
                        <input type="submit" class="text-center text-danger" value="Effacer">
                    </form>
                </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
 
</section>

<?php  
    //Fermer la connection
    mysqli_close($db);
    incluTemplate('footer'); 
?>
  