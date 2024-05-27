<?php
session_start();

const DBHOST = 'db';
const DBNAME = 'stage';
const DBUSER = 'test';
const DBPASS = 'test';

$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    // Définir l'attribut d'erreur PDO pour générer des exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM stage";
    
    $query = $db->prepare($sql);
    $query->execute();
    $stage = $query->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recherches de stage</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
  </head>
  <body>
    <table data-toggle="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Etat</th>
          <th>Entreprise</th>
          <th>Date d'envoi</th>
          <th>Relance</th>
          <th>Candidature</th>          
          <th>Méthode d'envoi</th>          
          <th>Contrat</th>
          <th>Poste</th>
          <th>e-mail</th>
          <th>commentaires</th>
          <th>+</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach($stage as $stage){
        ?>
        <tr>
          <td><?= $stage['id'] ?></td> 
          <td><?= $stage['etat'] ?></td> 
          <td><?= $stage['entreprise'] ?></td> 
          <td><?= $stage['envoi'] ?></td> 
          <td><?= $stage['relance'] ?></td> 
          <td><?= $stage['candidature'] ?></td> 
          <td><?= $stage['methode'] ?></td> 
          <td><?= $stage['contrat'] ?></td> 
          <td><?= $stage['poste'] ?></td> 
          <td><?= $stage['email'] ?></td> 
          <td><?= $stage['commentaire'] ?></td> 
          <td>
            <a href='update.php?id=<?= $stage["id"] ?>'>MàJ</a>
            <a href='delete.php?id=<?= $stage["id"] ?>'>sppr</a>
            <a href='form.php?id=<?= $stage["id"] ?>'>add</a>
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

