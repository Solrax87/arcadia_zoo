<?php 
    // Importation des fonctions et connexion à la base de données
    require '../includes/config/database.php';
    require '../includes/functions.php';

    $db = connectDB();

    // Vérifier si un ID est passé dans l'URL
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($id <= 0) {
        header("Location: /habitats"); // Redirection si l'ID est invalide
        exit;
    }

    // Récupérer les informations de l'habitat
    $query = "SELECT * FROM habitats WHERE id = $id LIMIT 1";
    $resultat = mysqli_query($db, $query);
    $habitat = mysqli_fetch_assoc($resultat);

    if (!$habitat) {
        header("Location: /habitats"); // Redirection si l'habitat n'existe pas
        exit;
    }

    // Inclusion du header
    incluTemplate('header');
?>

<div class="container shadow p-3 mb-5">
    <h1 class="text-center">HABITAT <strong><?php echo strtoupper(htmlspecialchars($habitat['nom'])); ?></strong></h1>
    <img src="/images/<?php echo htmlspecialchars($habitat['image_path']); ?>" class="img-fluid rounded mx-auto d-block" alt="Image de <?php echo htmlspecialchars($habitat['nom']); ?>">
    
    <div class="container mt-3">
        <p class="container card-text"><?php echo htmlspecialchars($habitat['description']); ?></p>
    </div>
</div>

<h2 class="text-center">Nos amis</h2>
<h3 class="text-center ">"Nos amis, les ambassadeurs de la nature"</h3>

<div class="text-center mt-4 p-3">
    <a href="/habitats.php" class="btn btn-primary p-3">Retour aux habitats</a>
</div>

<?php incluTemplate('animal_card2'); ?>

<?php 
    // Deconnecter
    mysqli_close($db);

    incluTemplate('footer'); 
?>