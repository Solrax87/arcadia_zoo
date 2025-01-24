<?php 
    session_start();

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: /login.php"); // Redirige vers la page de connexion
        exit;
    }

    // Rôles autorisés pour cette page
    $roles_autorises = ['administrateur'];

    // Vérifier si l'utilisateur a accès
    if (!in_array($_SESSION['role'], $roles_autorises)) {
        header("Location: /erreur_acces.php"); // Rediriger si pas autorisé
        exit;
    }

    $resultat = $_GET['resultat'] ?? null;

    require '../includes/functions.php';
    incluTemplate('header');
?>

<div class="p-3">
    <h1 class="text-center">Administrateur</h1>
    <h3 class="text-center">Gérer vos données</h3>
</div>
<?php if (intval($resultat) === 1) : ?> 
    <div class="card p-3 mb-1 text-center text-light mx-auto bande">
        <p class="mb-0">Enregistrement avec succès</p>
    </div>
<?php elseif(intval($resultat) === 2) : ?>
    <div class="card p-3 mb-1 text-center text-light mx-auto bande">
        <p class="mb-0">Modification réussie</p>
    </div>
<?php elseif(intval($resultat) === 3) : ?>
    <div class="card p-3 mb-1 text-center text-light mx-auto bande">
        <p class="mb-0">Effacement réussi !</p>
    </div>
<?php endif; ?>

<main>
    <div class="d-flex justify-content-evenly mb-3">
        <div class="list-group text-center" style="width: 18rem;">
            <a href="/admin/habitats.php" class="list-group-item list-group-item-action list-group-item-info">HABITATS</a>
            <a href="/admin/les_animaux.php" class="list-group-item list-group-item-action list-group-item-info">LES ANIMAUX</a>
            <a href="/admin/rapport_veterinaire.php" class="list-group-item list-group-item-action list-group-item-info">RAPPORT VÉTÉRIANIRE</a>
            <a href="/admin/services.php" class="list-group-item list-group-item-action list-group-item-info">SERVICES</a>
            <a href="/admin/temoignages.php" class="list-group-item list-group-item-action list-group-item-info">TÉMOIGNAGES</a>
            <a href="/admin/roles.php" class="list-group-item list-group-item-action list-group-item-info">RÔLES</a>
        </div>
    </div>
</main>

<?php  incluTemplate('footer'); ?>
  