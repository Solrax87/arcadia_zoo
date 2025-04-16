<?php 
    require '../../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur', 'veterinaire', 'employe'];
    
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || !in_array($_SESSION['role'], $roles_autorises)) {
        header("Location: /erreur_acces.php");
        exit;
    }

    // Validation de URL par ID valide
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin');
    }

    /** Base de donne */
    require '../../includes/config/database.php';
    $db = connectDB();

    // Obtention des donnes
    $consult3 = "SELECT * FROM animaux WHERE id = {$id}";
    $resultat = mysqli_query($db, $consult3);
    $animal = mysqli_fetch_assoc($resultat);

    //Consultation pour avoir les habitat
    $consult = "SELECT * FROM habitats";
    $resultat = mysqli_query($db, $consult);

    //Consultation pour avoir les utilisateur
    $consult2 = "SELECT * FROM utilisateurs";
    $resultat2 = mysqli_query($db, $consult2);

    /** Pour choisir seulement les veterinaires */
    // //Consultation pour avoir les utilisateurs
    // $consult2 = "SELECT * FROM utilisateurs WHERE role = 'veterinaire'";
    // $resultat2 = mysqli_query($db, $consult2);    

    //Array avec erreur
    $erreur = [];

    $nom = $animal['nom'];
    $espece = $animal['espece'];
    $habitat_id = $animal['habitat_id'];
    $veterinaire_id = $animal['veterinaire_id'];
    $etat = $animal['etat'];
    $date = $animal['date'];
    $detail = $animal['detail'];
    $imageAnimal = $animal['image_path'];


    // Execute le code après avoir envoyé le formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        $nom = mysqli_real_escape_string($db, $_POST['nom']);
        $espece = mysqli_real_escape_string($db, $_POST['espece']);
        $habitat_id = mysqli_real_escape_string($db, $_POST['habitat']);
        $veterinaire_id = mysqli_real_escape_string($db, $_POST['veterinaire']);
        $date = mysqli_real_escape_string($db, $_POST['date']);
        $detail = mysqli_real_escape_string($db, $_POST['detail']);

        //Files ver une variable
        $image = $_FILES['image'] ?? null;

        if(!$nom) {
            $erreur[] = 'Le Nom est obligatoire';
        }
        if(!$espece) {
            $erreur[] = 'Espece est obligatoire';
        }
        if(!$habitat_id) {
            $erreur[] = 'Habitat est obligatoire';
        }
        if(!$veterinaire_id) {
            $erreur[] = 'Choisissez un vétérinaire ou employer';
        }
        if(!$date) {
            $erreur[] = 'La date est obligatoire';
        }
      
        // Validation par volume des fichiers
        $size = 2000 * 2000;
        if($image['size'] > $size ) {
            $erreurs[] = 'Image très lourde';
        }

        // echo "<pre>";
        // var_dump($erreur);
        // echo "</pre>";

        // Verification d'array soit pas vide
        if(empty($erreur)) {

            //creation du chemise
            $chemiseImage = '../../images/';

            if(!is_dir($chemiseImage)) {
            mkdir($chemiseImage);
            }

            $nomImage = '';

            /** upload fichiers */

            if($image['name']) {
                // Pour efface l'ancien photo
                unlink($chemiseImage . $animal['image_path']);

                // Rename aux fichiers "nom unique"
                $nomImage = md5( uniqid( rand(), true)) . ".jpg";

                // //upload img
                move_uploaded_file($image['tmp_name'], $chemiseImage . $nomImage);
            } else {
                $nomImage = $animal['image_path'];
            }

          
              // Insertion dans la Base de donne
            $query = " UPDATE animaux SET nom = '{$nom}', espece = '{$espece}', habitat_id = {$habitat_id}, veterinaire_id = {$veterinaire_id}, date = '{$date}', detail = '{$detail}', image_path = '{$nomImage}' WHERE id = {$id} ";

            // echo $query;

            $resultat = mysqli_query($db, $query);

            // Si la mise à jour a réussi
            if($resultat) {
                // Redirection en fonction du rôle de l'utilisateur
                switch ($_SESSION['role']) {
                    case 'administrateur':
                        // Si l'utilisateur est un administrateur, redirige vers la page d'administration
                        header('Location: /admin/index.php?resultat=2');
                        break;
                    case 'veterinaire':
                        // Si l'utilisateur est un vétérinaire, redirige vers le tableau de bord du vétérinaire
                        header('Location: /admin/indexVeterinaire.php?resultat=2');
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
        <h1 class="text-center">Nos amis</h1>
        <h3 class="text-center">"Les ambassadeurs de la nature"</h3>
    </div>
  
    <section class="container">
        <div class="mb-3">
            <a href="/admin/les_animaux.php" class="btn btn-success m-1">Revenir</a>
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
                <form method="POST" enctype="multipart/form-data">
                    <legend class="mb-2 ">Modification de l'animal</legend>
                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom de l'animal" value="<?php echo $nom; ?>">
                    </div>    
                    <!-- Race -->
                    <div class="mb-3">
                        <label for="espece" class="form-label">Animal</label>
                        <input type="text" class="form-control" name="espece" id="espece" placeholder="Nom animal" value="<?php echo $espece; ?>">
                    </div>
                    <!-- Habitat -->
                    <div class="mb-3">
                        <label for="habitat" class="form-label">Habitat</label>
                        <select class="form-control" name="habitat" id="habitat">
                            <option value="" selected>-- Sélectionnez l'habitat --</option>
                            <?php while($habitats = mysqli_fetch_assoc($resultat)) : ?>
                                <option <?php echo $habitat_id === $habitats['id'] ? 'selected' : ''; ?> 
                                    value="<?php echo $habitats['id']; ?>"><?php echo $habitats['nom']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Vétérinaire -->
                    <div class="mb-3">
                        <label for="veterinaire" class="form-label">Vétérinaire ou employer</label>
                        <select class="form-control" name="veterinaire" id="veterinaire">
                            <option value="" selected>-- Sélectionnez --</option>
                            <?php while($utilisateurs = mysqli_fetch_assoc($resultat2)) : ?>
                                <option <?php echo $veterinaire_id === $utilisateurs['id'] ? 'selected' : ''; ?> 
                                    value="<?php echo $utilisateurs['id']; ?>">
                                    <?php echo $utilisateurs['nom']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Date d'insertion -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date d'insertion</label>
                        <input type="date" class="form-control" name="date" id="date" placeholder="La date d'arrivege ou insertion" value="<?php echo $date; ?>">
                    </div>

                    <!-- Détail -->
                    <div class="mb-3">
                        <label for="detail" class="form-label">Détail de l'état de l'animal</label>
                        <input type="text" class="form-control" name="detail" id="detail" placeholder="(** facultative **)" value="<?php echo $detail; ?>">
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" accept="image/jpeg, image/jpg, image/png, image/webp"  id="image" placeholder="L'image de l'ami">
                        <img src="/images/<?php echo $imageAnimal; ?>" class="card col-lg-2 m-3 shadow p-3 mb-5">
                    </div>
                    

                    <!-- Button envoyer -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning mt-2 mb-2 " id="liveToastBtn">Mettre à jour</button>
                    </div>

                </form>
            </div>
    </section>

  <?php incluTemplate('footer'); ?>
  
  