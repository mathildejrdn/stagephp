<?php
session_start();
require_once('connect.php');

if (!isset($_SESSION['id'])) {
  header("Location: connexion.php");
  exit;
}

// const DBHOST = 'db';
// const DBNAME = 'stage';
// const DBUSER = 'test';
// const DBPASS = 'test';

// $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    // Définir l'attribut d'erreur PDO pour générer des exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM stage WHERE user_id = :user_id";
    
    $query = $db->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $stages = $query->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recherches de stage</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
  </head>
  <body><h1>Recherches de stage</h1>
  <a href='form.php?id=<?= htmlspecialchars($stage["id"]) ?>' target="_blank">Ajouter un stage</a>

    <table data-toggle="table">
      <thead>
        <tr>
          <!-- <th>ID</th> -->
          <th>Etat</th>
          <th>Entreprise</th>
          <th>Date d'envoi</th>
          <th>Relance</th>
          <th>Candidature</th>          
          <th>Méthode d'envoi</th>          
          <th>Contrat</th>
          <th>Poste</th>
          <th>e-mail</th>
          <th>Commentaires</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach($stages as $stage){
        ?>
        <tr>
          <!-- <td>//<?= htmlspecialchars($stage['id']) ?></td> -->
          <td><?= htmlspecialchars($stage['etat']) ?></td> 
          <td><?= htmlspecialchars($stage['entreprise']) ?></td> 
          <td><?= htmlspecialchars($stage['envoi']) ?></td> 
          <td><?= htmlspecialchars($stage['relance']) ?></td> 
          <td><?= htmlspecialchars($stage['candidature']) ?></td> 
          <td><?= htmlspecialchars($stage['methode']) ?></td> 
          <td><?= htmlspecialchars($stage['contrat']) ?></td> 
          <td><?= htmlspecialchars($stage['poste']) ?></td> 
          <td><?= htmlspecialchars($stage['email']) ?></td> 
          <td><?= htmlspecialchars($stage['commentaire']) ?></td> 
          <td>
          <a href='update.php?id=<?= htmlspecialchars($stage["id"]) ?>'>MàJ</a>
            <a href='delete.php?id=<?= htmlspecialchars($stage["id"]) ?>'>Supprimer</a>
           
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.js"></script>
  </body>
</html>
