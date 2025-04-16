<?php 
    require '../../includes/functions.php';
    session_start();
    
    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur', 'veterinaire'];
    
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
    $consult = "SELECT * FROM rapports WHERE id = {$id}";
    $resultat = mysqli_query($db, $consult);
    $rapport = mysqli_fetch_assoc($resultat);

    //Consultation pour avoir les habitat
    $consult = "SELECT * FROM habitats";
    $resultat = mysqli_query($db, $consult);

    //Consultation pour avoir les utilisateurs
    $consult2 = "SELECT * FROM utilisateurs WHERE role = 'veterinaire'";
    $resultat2 = mysqli_query($db, $consult2);   
    
    //Consultation pour avoir les animaux
    $consult3 = "SELECT * FROM animaux";
    $resultat3 = mysqli_query($db, $consult3);

    //Array avec erreur
    $erreur = [];

    $veterinaire_id = $rapport['veterinaire_id'];
    $date = $rapport['date'];
    $animal_id = $rapport['animal_id'];
    $habitat_id = $rapport['habitat_id'];
    $etat = $rapport['etat'];
    $nourriture = $rapport['nourriture'];
    $grammage = $rapport['grammage'];
    $commentaire = $rapport['commentaire'];


    // Execute le code après avoir envoyé le formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $veterinaire_id = mysqli_real_escape_string($db, $_POST['veterinaire']);
        $date = mysqli_real_escape_string($db, $_POST['date']);
        $animal_id = mysqli_real_escape_string($db, $_POST['animal_id']);
        $habitat_id = mysqli_real_escape_string($db, $_POST['habitat']);
        $etat = mysqli_real_escape_string($db, $_POST['etat']);
        $nourriture = mysqli_real_escape_string($db, $_POST['nourriture']);
        $grammage = mysqli_real_escape_string($db, $_POST['grammage']);
        $commentaire = mysqli_real_escape_string($db, $_POST['commentaire']);

        if(!$veterinaire_id) {
            $erreur[] = 'Le Vétérinaire est obligatoire';
        }
        if(!$date) {
            $erreur[] = 'La date est obligatoire';
        }
        if(!$animal_id) {
            $erreur[] = 'Choisissez un animal';
        }
        if(!$habitat_id) {
            $erreur[] = 'Habitat est obligatoire';
        }
        if(!$etat) {
            $erreur[] = 'Etat est obligatoire';
        }
        if(!$nourriture) {
            $erreur[] = 'Nourriture est obligatoire';
        }
        if(!$grammage) {
            $erreur[] = 'Grammage est obligatoire';
        }
        if(!$commentaire) {
            $erreur[] = 'Commentaire est obligatoire';
        }

        // echo "<pre>";
        // var_dump($erreur);
        // echo "</pre>";

        // Verification d'array soit pas vide
        if(empty($erreur)) {
              // Insertion dans la Base de donne
            $query = "UPDATE rapports SET veterinaire_id = {$veterinaire_id}, date = '{$date}', animal_id = {$animal_id}, habitat_id = {$habitat_id}, etat = '{$etat}', nourriture = '{$nourriture}', grammage = {$grammage}, commentaire = '{$commentaire}' WHERE id = {$id} ";

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
            <a href="/admin/rapport_veterinaire.php" class="btn btn-success m-1">Revenir</a>
        </div>

        <!-- Message avec erreures -->
        <?php foreach($erreur as $erreurs): ?>
            <div class="col">
                <div class="class='card h-100 p-3 mb-1 text-center bg-danger text-light">
                    <?php echo $erreurs; ?>
                </div>
            </div>
                
        <?php endforeach; ?>

        <div class="formeLine rounded mt-4 shadow p-3 mb-5">
                <form method="POST">
                    <legend class="mb-2 ">Insérer nouvel rapport</legend>

                    <!-- Vétérinaire -->
                    <div class="mb-3">
                        <label for="veterinaire" class="form-label">Vétérinaire</label>
                        <select class="form-control" name="veterinaire" id="veterinaire">
                            <option value="" selected>-- Sélectionnez le vétérinaire --</option>
                            <?php while($utilisateurs = mysqli_fetch_assoc($resultat2)) : ?>
                                <option <?php echo $veterinaire_id === $utilisateurs['id'] ? 'selected' : ''; ?> 
                                    value="<?php echo $utilisateurs['id']; ?>">
                                    <?php echo $utilisateurs['nom']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="date" placeholder="Date d'insertion" value="<?php echo $date; ?>">
                    </div>  

                    <!-- Animal -->
                    <div class="mb-3">
                        <label for="animal_id" class="form-label">Nom de l'animal</label>
                        <select class="form-control" name="animal_id" id="animal_id">
                            <option value="" selected>-- Sélectionnez l'animal --</option>
                            <?php while($animaux = mysqli_fetch_assoc($resultat3)) : ?>
                                <option <?php echo $animal_id === $animaux['id'] ? 'selected' : ''; ?> 
                                    value="<?php echo $animaux['id']; ?>">
                                    <?php echo $animaux['nom']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
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

                    <!-- État de l'animal -->
                    <div class="mb-3">
                        <label for="etat" class="form-label">Son état</label>
                        <input type="text" class="form-control" name="etat" id="etat" placeholder="L'état de l'amis" value="<?php echo $etat; ?>">
                    </div>

                    <!-- Nourriture -->
                    <div class="mb-3">
                        <label for="nourriture" class="form-label">Nourriture proposée</label>
                        <input type="text" class="form-control" name="nourriture" id="nourriture" placeholder="Nourriture pour l'amis" value="<?php echo $nourriture; ?>">
                    </div>

                    <!-- Quantité de nourriture -->
                    <div class="mb-3">
                        <label for="grammage" class="form-label">Quantité (gr)</label>
                        <input type="number" class="form-control" name="grammage" id="grammage" placeholder="Quantité en gramme" value="<?php echo $grammage; ?>">
                    </div>

                    <!-- Commentaires -->
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire</label>
                        <input type="text" class="form-control" name="commentaire" id="commentaire" placeholder="Laissai un commentaire" value="<?php echo $commentaire; ?>">
                    </div>

                    <!-- Button envoyer -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning mt-2 mb-2 ">Mettre à jour</button>
                    </div>
                             
                </form>
            </div>
    </section>


 

  <?php incluTemplate('footer'); ?>
  
