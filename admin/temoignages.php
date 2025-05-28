<?php 
require '../includes/functions.php';
session_start();

// Seuls employe et administrateur peuvent accéder
$roles_autorises = ['employe', 'administrateur'];
if (!($_SESSION['login'] ?? false) || !in_array($_SESSION['role'], $roles_autorises)) {
    header("Location: /erreur_acces.php");
    exit;
}

// Choix du lien de retour selon le rôle
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
        $lienRetour = "/login.php";
}

require_once '../includes/config/database.php';
$db = connectDB();

// Gestion de la suppression
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $db->prepare("DELETE FROM temoignages WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $ok = $stmt->execute();
    $stmt->close();
    $db->close();

    // Redirection vers la page d’accueil admin avec code résultat = 3 (effacement)
    header("Location: {$lienRetour}?result=3");
    exit;
}


incluTemplate('header');
?>
<div class="shadow p-3 mb-5">
  <h1 class="text-center">Temoignages</h1>
</div>
<section class="container">
  
  <div class="mb-3 text-center">
    <a href="<?php echo $lienRetour; ?>" class="btn btn-success">Revenir</a>
  </div>
  <table class="table formeLine">
    <thead>
      <tr>
        <th>Id</th><th>Nom</th><th>Qualification</th><th>Message</th><th>Date</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $res = $db->query("SELECT id, nom_prenom, qualification, message, DATE_FORMAT(date,'%d/%m/%Y') AS datef FROM temoignages ORDER BY date DESC");
      while ($t = $res->fetch_assoc()) {
          echo "<tr>
            <td>{$t['id']}</td>
            <td>{$t['nom_prenom']}</td>
            <td>{$t['qualification']}</td>
            <td>{$t['message']}</td>
            <td>{$t['datef']}</td>
            <td><a href='?delete_id={$t['id']}' class='text-danger'>Supprimer</a></td>
          </tr>";
      }
      ?>
    </tbody>
  </table>
</section>
<?php incluTemplate('footer'); ?>
