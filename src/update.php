<?php
//nous allons vérifier la présence de $_POST
if($_POST){ 
    if (
        isset($_POST['etat']) && !empty($_POST['etat']) &&
        isset($_POST['entreprise']) && !empty($_POST['entreprise'])&&
        isset($_POST['envoi']) && !empty($_POST['envoi'])&&
        isset($_POST['relance']) && !empty($_POST['relance'])&&
        isset($_POST['candidature']) && !empty($_POST['candidature'])&&
        isset($_POST['methode']) && !empty($_POST['methode'])&&
        isset($_POST['contrat']) && !empty($_POST['contrat'])&&
        isset($_POST['poste']) && !empty($_POST['poste'])&&
        isset($_POST['email']) && !empty($_POST['email'])&&
        isset($_POST['commentaire']) && !empty($_POST['commentaire'])
    ) { //Si ça existe bien on fait en sorte de modifier les données
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
        
        $sql = "UPDATE stage SET entreprise = :entreprise, envoi = :envoi, relance = :relance, candidature= :candidature, methode = :methode, 
        contrat = :contrat, poste = :poste, email = :email, commentaire = :commenaire WHERE id= :id";
    

        $query = $db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":entreprise", $entreprise, PDO::PARAM_STR); 
        $query->bindValue(":candidature", $candidature, PDO::PARAM_STR);
        $query->bindValue(":methode", $methode, PDO::PARAM_STR); 
        $query->bindValue(":contrat", $contrat, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR); 
        $query->bindValue(":poste", $poste, PDO::PARAM_STR);
        $query->bindValue(":commenaire", $commentaire, PDO::PARAM_STR);

        $query->bindValue(":envoi", $envoi, PDO::PARAM_INT);
        $query->bindValue(":relance", $relance, PDO::PARAM_INT);
        $query->execute();
        header("Location: index.php"); 
    } else { 
        echo "remplissez le formulaire";
    }

}
if (isset($_GET['id']) && !empty($_GET['id'])) //si l'id de l'url existe et est rempli
 {
require_once("connect.php");
// echo $_GET["id"];
$id = strip_tags($_GET["id"]);
$sql = "SELECT * FROM stage WHERE id = :id";
$query = $db->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);

$query->execute();
$stage = $query->fetch(); 
if(!$stage) {
    header('Location: index.php');
}  else {   require_once("disconnect.php");
}

} else { header('Location: index.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de mise à jour</title>
</head>
<body><title><?= $stage['entreprise'] ?></title>
</head>
<body>
    <h1>Modification de <?= $stage['entreprise'] . ' ' . $stage['poste'] ?></h1>
<form method="post">  
    <label for="entreprise">
        Entreprise
    </label>
    <input type="text" name='entreprise' value="<?= $stage['entreprise'] ?>" required>

    <label for="last_name">
        Nom
    </label>
    
    <button>Modifier</button>
    </form>
    <a href="index.php">Retour</a> 
    <?php echo print_r($_POST);?>
</body>
</html>