<?php
if ($_POST) {
    if (
        isset($_POST['etat']) && !empty($_POST['etat']) &&
        isset($_POST['entreprise']) && !empty($_POST['entreprise']) &&
        isset($_POST['envoi']) && !empty($_POST['envoi']) &&
        isset($_POST['relance']) && !empty($_POST['relance']) &&
        isset($_POST['candidature']) && !empty($_POST['candidature']) &&
        isset($_POST['methode']) && !empty($_POST['methode']) &&
        isset($_POST['contrat']) && !empty($_POST['contrat']) &&
        isset($_POST['poste']) && !empty($_POST['poste']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['commentaire']) && !empty($_POST['commentaire'])
    ) {
        require_once('connect.php');
        $entreprise = strip_tags($_POST['entreprise']);
        $envoi = strip_tags($_POST['envoi']);
        $relance = strip_tags($_POST['relance']);
        $candidature = strip_tags($_POST['candidature']);
        $methode = strip_tags($_POST['methode']);
        $contrat = strip_tags($_POST['contrat']);
        $poste = strip_tags($_POST['poste']);
        $email = strip_tags($_POST['email']);
        $commentaire = strip_tags($_POST['commentaire']);
        $etat = strip_tags($_POST['etat']);
        
        $sql = "UPDATE stage SET entreprise = :entreprise, envoi = :envoi, relance = :relance, candidature = :candidature, methode = :methode, 
        contrat = :contrat, poste = :poste, email = :email, commentaire = :commentaire, etat = :etat WHERE id = :id";
    
        $query = $db->prepare($sql);
        $query->bindValue(":id", $_GET['id'], PDO::PARAM_INT);
        $query->bindValue(":entreprise", $entreprise, PDO::PARAM_STR);
        $query->bindValue(":envoi", $envoi, PDO::PARAM_STR);
        $query->bindValue(":relance", $relance, PDO::PARAM_STR);
        $query->bindValue(":candidature", $candidature, PDO::PARAM_STR);
        $query->bindValue(":methode", $methode, PDO::PARAM_STR);
        $query->bindValue(":contrat", $contrat, PDO::PARAM_STR);
        $query->bindValue(":poste", $poste, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->bindValue(":commentaire", $commentaire, PDO::PARAM_STR);
        $query->bindValue(":etat", $etat, PDO::PARAM_STR);

        $query->execute();
        header("Location: index.php");
        exit;
    } else {
        echo "Remplissez le formulaire";
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once("connect.php");
    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM stage WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $stage = $query->fetch();
    if (!$stage) {
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de mise à jour</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
</head>
<body>
    <h1><?= htmlspecialchars($stage['entreprise']) ?></h1>
    <div class="card">
  <div class="card-header">
  Modification de la candidature
  </div>
  <div class="card-body"><form method="post">
    <label for="etat">État</label>
        <input type="text" name='etat' value="<?= htmlspecialchars($stage['etat']) ?>" required>
<br>
    <label for="entreprise">Entreprise</label>
        <input type="text" name='entreprise' value="<?= htmlspecialchars($stage['entreprise']) ?>" required>
<br>
        <label for="envoi">Envoi</label>
        <input type="date" name='envoi' value="<?= htmlspecialchars($stage['envoi']) ?>" required>
<br>
        <label for="relance">Relance</label>
        <input type="date" name='relance' value="<?= htmlspecialchars($stage['relance']) ?>" required>
<br>
        <label for="candidature">Type de candidature</label>
        <select name="candidature" id="candidature" value=""<?= htmlspecialchars($stage['candidature']) ?>required>
            <option value="candidature spontanée">Candidature spontanée</option>
            <option value="réponse à une offre d'emploi">Réponse à une offre d'emploi</option>
        </select>
<br>
        <label for="methode">Méthode d'envoi</label>
        <select name="methode" id="methode" value="<?= htmlspecialchars($stage['methode']) ?>" required>
            <option value="email">Email</option>
            <option value="courrier">Courrier</option>
            <option value="remise en main propre">Remise en main propre</option>
        </select>       
    <br>
        <label for="contrat">Type de contrat</label>
        <select name="contrat" id="contrat" value="<?= htmlspecialchars($stage['contrat']) ?>" required>
            <option value="cdd">CDD</option>
            <option value="cdi">CDI</option>
            <option value="interim">Intérim</option>
            <option value="stage">Stage</option>
            <option value="apprentissage">Apprentissage</option>
        </select>
<br>
        <label for="poste">Intitulé du Poste</label>
        <input type="text" name='poste' value="<?= htmlspecialchars($stage['poste']) ?>" required>
<br>
        <label for="email">Email</label>
        <input type="email" name='email' value="<?= htmlspecialchars($stage['email']) ?>" required>
<br>
        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" required><?= htmlspecialchars($stage['commentaire']) ?></textarea>

        <button>Modifier</button>     <a href="index.php">Retour</a>
    </form></div></div>
</body>
</html>
