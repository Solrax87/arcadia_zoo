<?php 

    require '../../includes/functions.php';
    session_start();

    // Seuls les administrateurs peuvent accéder
    $roles_autorises = ['administrateur'];

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || !in_array($_SESSION['role'], $roles_autorises)) {
        header("Location: /erreur_acces.php");
        exit;
    }
    /** BD */
    require '../../includes/config/database.php';
    $db = connectDB();

    //Consultation pour avoir les utilisateurs
    $consult4 = "SELECT * FROM utilisateurs WHERE role IN ('veterinaire', 'employe', 'administrateur')";
    $resultat4 = mysqli_query($db, $consult4); 

    //Array avec erreur
    $erreur = [];

    $nom = '';
    $email = '';
    $password = '';
    $role = '';

    //Executer le code après avoir envoyé le formulaire
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nom = mysqli_real_escape_string($db, $_POST['nom']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = $_POST['password'];
        $role = mysqli_real_escape_string($db, $_POST['rol']);

        if(!$nom) {
            $erreur[] = 'Le Nom est obligatoire';
        }
        if(!$email) {
            $erreur[] = 'Le Email est obligatoire';
        }
        if(!$password) {
            $erreur[] = 'Le Mot de passe est obligatoire';
        }
        if(!$role) {
            $erreur[] = 'Le Rol est obligatoire';
        }

        if(empty($erreur)) {
            // Hashear le mot de passe
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la bd
            $query = "INSERT INTO utilisateurs (nom, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $nom, $email, $password_hash, $role);
            $resultat = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($resultat) {
                header('Location: /admin?resultat=1');
                exit;
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
            <a href="/admin/roles.php" class="btn btn-success m-1">Revenir</a>
        </div>

        <?php foreach($erreur as $erreurs) : ?>
            <div class="col">
             <div class="card h-100 p-3 mb-1 text-center bg-danger text-light">
                <?php echo $erreurs; ?>
            </div>

        <?php endforeach; ?>

        <div class="formeLine rounded mt-4 shadow p-3 mb-5">
                <form method="POST" action="/admin/form/new_rol.php">
                    <legend class="mb-2 ">Insérer nouveau role</legend>
                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom ou prènom de la person" value="<?php echo $nom; ?>">
                    </div>    

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Le mot de passe" value="<?php echo $password; ?>">
                    </div>

                    <!-- Rol -->
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rôle</label>
                        <select class="form-control" name="rol" id="rol">
                            <option value="" selected>Sélectionnez un rôle</option>
                            <option value="veterinaire" <?php echo $role === 'veterinaire' ? 'selected' : ''; ?>>Vétérinaire</option>
                            <option value="employe" <?php echo $role === 'employe' ? 'selected' : ''; ?>>Employé</option>
                            <option value="administrateur" <?php echo $role === 'administrateur' ? 'selected' : ''; ?>>Administrateur</option>
                        </select>
                    </div>

                    
                    <!-- Button envoyer -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning mt-2 mb-2 ">Envoyer</button>
                    </div>
                                   
                </form>
            </div>
    </section>


 

  <?php incluTemplate('footer'); ?>
  
  