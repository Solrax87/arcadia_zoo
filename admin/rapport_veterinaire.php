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

    // Le query
    $query = "SELECT 
                rapports.id,
                rapports.date,
                rapports.etat,
                rapports.nourriture,
                rapports.grammage,
                rapports.commentaire,
                utilisateurs.nom AS veterinaire,
                animaux.nom AS animal,
                habitats.nom AS habitat_nom
            FROM rapports
            LEFT JOIN animaux ON rapports.animal_id = animaux.id
            LEFT JOIN habitats ON animaux.habitat_id = habitats.id
            LEFT JOIN utilisateurs ON rapports.veterinaire_id = utilisateurs.id";

    //Consultation du DB
    $resultatConsult = mysqli_query($db, $query);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            //Effacer le rapport
            $query = "DELETE FROM rapports WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);
        
            if($resultat) {
                header('location: /admin?resultat=3');
            }
        }
    }
  incluTemplate('header');
?>

<div class="p-3">
    <h1 class="text-center">Rapports Vétérinaire</h1>
</div>

<section>
    <div class="mb-3 d-flex justify-content-evenly">
        <a href="<?php echo $lienRetour; ?>" class="btn btn-success m-1">Revenir</a>
        <a href="/admin/form/new_rapport.php" class="btn btn-warning ms-4">Rapport (+)</a>
    </div>
    <div class="card mb-3 formeLine">
        
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Date</th>
                <th scope="col">Veterinaire</th>
                <th scope="col">Animal</th>
                <th scope="col">Habitat</th>
                <th scope="col">État</th>
                <th scope="col">Nourriture</th>
                <th scope="col">Quantité(gr)</th>
                <th scope="col">Commentaires</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody><!-- Montrer les resultat -->
                <?php while($rapport = mysqli_fetch_assoc($resultatConsult)): ?>
                <tr>
                    <th scope="row"><?php echo $rapport['id']; ?></th>
                    <td><?php echo $rapport['date']; ?></td>
                    <td><?php echo $rapport['veterinaire']; ?></td>
                    <td><?php echo $rapport['animal']; ?></td>
                    <td><?php echo $rapport['habitat_nom']; ?></td>
                    <td><?php echo $rapport['etat']; ?></td>
                    <td><?php echo $rapport['nourriture']; ?></td>
                    <td><?php echo $rapport['grammage']; ?></td>
                    <td><?php echo $rapport['commentaire']; ?></td>
                <td><a href="/admin/actualisation/act_rapport_veterinaire.php?id=<?php echo $rapport['id']; ?> " class="text-center text-info">Modifier</a>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $rapport['id']; ?>">
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
  