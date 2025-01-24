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
    
    //Consultation pour avoir les habitat
    $consult3 = "SELECT * FROM services";
    $resultat3 = mysqli_query($db, $consult3);
    
    //Array avec erreur
    $erreur = [];
    $titre = '';
    $type = '';
    $description = '';

    // Execute le code après avoir envoyé le formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = mysqli_real_escape_string($db, $_POST['titre']);
        $type = mysqli_real_escape_string($db, $_POST['type']);
        $description = mysqli_real_escape_string($db, $_POST['description']);

        //Files ver une variable
        $image = $_FILES['image'] ?? null;

        if(!$titre) {
            $erreur[] = 'Le Titre est obligatoire';
        }
        if(!$type) {
            $erreur[] = 'Le Type est obligatoire';
        }
        if(!$description) {
            $erreur[] = 'La Description est obligatoire';
        }
        if(!$image['name']) {
            $erreur[] = 'Image obligatoire';
        }
        // Validation par volume des fichiers
        $size = 2000 * 2000;

        if($image['size'] > $size ) {
            $erreurs[] = 'Image très lourde';
        }

        //Verification dans la bd
        if(empty($erreur)) {
            /** upload fichiers */

            //creation du chemise
            $chemiseImage = '../../images/';

            // Rename aux fichiers "nom unique"
            $nomImage = md5( uniqid( rand(), true)) . ".jpg";

            //upload img
            move_uploaded_file($image['tmp_name'], $chemiseImage . $nomImage);

            //Insertion dans la bd
            $query = " INSERT INTO services (titre, type, description, image_path) VALUES ('$titre', '$type', '$description', '$nomImage')";

            $resultat = mysqli_query($db, $query);

            if($resultat) {
                header('Location: /admin?resultat=1');
            }
        }
    }

    incluTemplate('header');
?>

    <div class="shadow p-3 mb-5">
        <h1 class="text-center">Nos amis</h1>
        <h3 class="text-center">"Les ambassadeurs de la nature"</h3>
    </div>
  
    <section class="container">
        <div class="mb-3">
            <a href="/admin/services.php" class="btn btn-success m-1">Revenir</a>
        </div>

        <!-- Message avec erreures -->
        <?php foreach($erreur as $erreurs): ?>
            <div class="col">
                <div class="card h-100 p-3 mb-1 text-center bg-danger text-light">
                    <?php echo $erreurs; ?>
                </div>
            </div>
                
        <?php endforeach; ?>

        <div class="formeLine rounded mt-4 shadow p-3 mb-5">
            <form method="POST" action="/admin/form/new_service.php" enctype="multipart/form-data">
                <legend class="mb-2 ">Insérer nouveau service</legend>
                <!-- Titre -->
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre du service" value="<?php echo $titre; ?>">
                </div>   
                    
                <!-- Type -->
                <!-- <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" name="type" id="type">
                        <option value="" selected>-- Sélectionnez --</option>
                        <?php //while($services = mysqli_fetch_assoc($resultat3)) : ?>
                            <option <?php //echo $type === $services['id'] ? 'selected' : ''; ?> 
                                value="<?php //echo $services['id']; ?>"><?php //echo $services['type']; ?></option>
                        <?php //endwhile; ?>
                    </select>
                </div> -->

                <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="" selected>-- Sélectionnez --</option>
                            <option value="ACTIVITÉS EN FAMILLE" <?php echo $type === 'ACTIVITÉS EN FAMILLE' ? 'selected' : ''; ?>>ACTIVITÉS EN FAMILLE</option>
                            <option value="RESTAURATION" <?php echo $type === 'RESTAURATION' ? 'selected' : ''; ?>>RESTAURATION</option>
                        </select>
                    </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" 
                           class="form-control" 
                           name="description" 
                           id="description" 
                           placeholder="Description du service" 
                           value="<?php echo $description; ?>">
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" accept="image/jpeg, image/jpg, image/png, image/webp"  id="image" placeholder="L'image du service">
                </div>

                <!-- Button envoyer -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning mt-2 mb-2 " >Envoyer</button>
                </div>
                                
            </form>
        </div>
    </section>


 

  <?php incluTemplate('footer'); ?>
  
  