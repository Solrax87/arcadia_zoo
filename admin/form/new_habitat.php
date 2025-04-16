<?php 
    require '../../includes/functions.php';
    session_start();

    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur', 'veterinaire'];

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || !in_array($_SESSION['role'], $roles_autorises)) {
        header("Location: /erreur_acces.php");
        exit;
    }
    /** Base de donne */
    require '../../includes/config/database.php';
    $db = connectDB();

    //Array avec erreur
    $erreur = [];
    
    $nom = '';
    $description = '';


    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";


        $nom = mysqli_real_escape_string($db, $_POST['nom']);
        $description = mysqli_real_escape_string($db, $_POST['description']);

        //Files ver une variable
        $image2 = $_FILES['image2'] ?? null;
        
        if(!$nom) {
            $erreur[] = 'Le Nom est obligatoire';
        }
        if(!$description) {
            $erreur[] = 'La description est obligatoire';
        }
        if(!$image2 || !$image2['name']) {
            $erreur[] = 'Image obligatoire';
        } 
        // Validation par volume des fichiers (2m)
        $size = 2000 * 2000;

        if($image2 && $image2['size'] > $size) {
            $erreur[] = 'Image très lourde';
        }

        // echo "<pre>";
        // var_dump($erreur);
        // echo "</pre>";

        // Verification d'array soit pas vide
        if(empty($erreur)) {

            /** upload fichiers */

            //creation du chemise
            $chemiseImage = '../../images/';

            // Rename aux fichiers "nom unique"
            $nomImage = md5( uniqid( rand(), true)) . ".jpg";

            //upload img
            move_uploaded_file($image2['tmp_name'], $chemiseImage . $nomImage);

            // Insertion dans la Base de donne
            $query = " INSERT INTO habitats (nom, description, image_path) 
            VALUES ('$nom', '$description', '$nomImage' )";

            // echo $query;

            $resultat = mysqli_query($db, $query);

            if($resultat) {
                // Redirection en fonction du rôle de l'utilisateur
                switch ($_SESSION['role']) {
                    case 'administrateur':
                        // Si l'utilisateur est un administrateur, redirige vers la page d'administration
                        header('Location: /admin/index.php?resultat=1');
                        break;
                    case 'veterinaire':
                        // Si l'utilisateur est un vétérinaire, redirige vers le tableau de bord du vétérinaire
                        header('Location: /admin/indexVeterinaire.php?resultat=1');
                        break;
                    case 'employe':
                        // Si l'utilisateur est un employé, redirige vers la page d'accueil de l'employé
                        header('Location: /admin/indexEmployer.php?resultat=1');
                        break;
                    default:
                        // Si le rôle n'est pas reconnu, redirige vers la page d'accueil par défaut
                        header('Location: /');
                }

                exit; // Quitter après la redirection pour éviter l'exécution d'autres parties du script
            }
        }
    }

    incluTemplate('header');
?>

    <div class="shadow p-3 mb-5">
        <h1 class="text-center">HABITAT</h1>
    </div>
  

    
    
    <section class="container">
        <div class="mb-3">
            <a href="/admin/habitats.php" class="btn btn-success m-1">Revenir</a>
        </div>

        <?php foreach($erreur as $erreurs): ?>
            <div class="col">
                <div class="card h-100 p-3 mb-1 text-center bg-danger text-light">
                    <?php echo $erreurs; ?>
                </div>
            </div>
                
        <?php endforeach; ?>

        <div class="formeLine rounded mt-4 shadow p-3 mb-5">
                <form method="POST" action="/admin/form/new_habitat.php" enctype="multipart/form-data">
                    <legend class="mb-2 ">Insérer nouvel habitat</legend>
                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom de l'habitat" value="<?php echo $nom; ?>">
                    </div>
                    <!-- Description de l'habitat -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description de l'habitat" value="<?php echo $description; ?>">
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image2" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image2" accept="image/jpeg, image/jpg, image/png, image/webp" id="image2" placeholder="L'image de l'ami">
                    </div>

                    <!-- Button envoyer -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning mt-2 mb-2 ">Envoyer</button>
                    </div>
                   
                    </div>                
                </form>
            </div>
    </section>


 

  <?php incluTemplate('footer'); ?>
  
  