<?php 
    require '../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['employe', 'administrateur'];
    
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
    
    require_once '../includes/config/database.php';
    $db = connectDB();

    // Verification pour effacer
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']); // Sanitizar el ID
        
        // Executer la consulte d'effacer
        $delete_query = "DELETE FROM temoignages WHERE id = ?";
        $stmt = $db->prepare($delete_query);
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Le témoignage a été supprimé avec succès!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de la suppression : " . $stmt->error . "</div>";
        }

        $stmt->close();

        // Rediriger 
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    incluTemplate('header');
?>


<div class="p-3">
    <h1 class="text-center">Témoignages</h1>
</div>

<section>
    <div class="mb-3 d-flex justify-content-evenly">
        <a href="<?php echo $lienRetour; ?>" class="btn btn-success m-1">Revenir</a>
    </div>
    <div class="card mb-3 container formeLine">
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT id, nom_prenom, qualification, message, DATE_FORMAT(date, '%d/%m/%Y') AS date_formatee 
                          FROM temoignages 
                          ORDER BY date DESC";

                $result = $db->query($query);

                while ($temoignage = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <th scope='row'>{$temoignage['id']}</th>
                        <td>{$temoignage['nom_prenom']}</td>
                        <td>{$temoignage['qualification']}</td>
                        <td>{$temoignage['message']}</td>
                        <td>{$temoignage['date_formatee']}</td>
                        <td>
                            <a href='?delete_id={$temoignage['id']}' class='text-center text-danger ms-3'>Supprimer</a>
                        </td>
                    </tr>";
                }

                $db->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php  
    
    incluTemplate('footer'); 
?>