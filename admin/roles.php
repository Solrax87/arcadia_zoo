<?php 
    require '../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur'];
    
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
    $query = "SELECT * FROM utilisateurs";
    
    //Consultation du DB
    $resultatConsult = mysqli_query($db, $query);
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if($id) {
            
            //supprimer un role
            $query = "DELETE FROM utilisateurs WHERE id = {$id}";
            $resultat = mysqli_query($db, $query);
            
            if($resultat) {
                header('location: /admin?resultat=3');
            }
        }
    }
    
    incluTemplate('header');
    ?>

<div class="shadow p-3 mb-5">
    <h1 class="text-center">Nos amis</h1>
    <h3 class="text-center">""Nos amis, les ambassadeurs de la nature""</h3>
</div>

<section>
    <div class="mb-3 d-flex justify-content-evenly">
        <a href="<?php echo $lienRetour; ?>" class="btn btn-success m-1">Revenir</a>
        <a href="/admin/form/new_rol.php" class="btn btn-warning ms-4">Role (+)</a>
    </div>
    <div class="card mb-3 container formeLine">
        <h2 class="text-center m-4">Équipe de travail</h2>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> <!-- Montrer les info de la bd-->
                <tr>
                <?php while($role = mysqli_fetch_assoc($resultatConsult)): ?>
                <th scope="row"><?php echo $role['id']; ?></th>
                <td><?php echo $role['nom'];?></td>
                <td><?php echo $role['email'];?></td>
                <td><?php echo $role['role'];?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $role['id']; ?>">
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