<?php 
//revérifie qu'il y a bien une ID dans l'URL et que l'utilisateur correspondant existe
if (isset($_GET['id']) && !empty($_GET['id'])) 
 {
require_once("connect.php");
$id = strip_tags($_GET["id"]);
$sql = "SELECT * FROM stage WHERE id = :id";
//On prépare la requête dans $sql,donc récupérer l'id unique
$query = $db->prepare($sql);
//on accroche la valeur id de la requête à celle de la variable $id
$query->bindValue(':id', $id, PDO::PARAM_INT);
//exécuter la requête
$query->execute();
//besoin d'une seule donnée donc fetch uniquement et non pas fetchAll
$stage = $query->fetch(); 


if(!$stage) {
    header('Location: stage.php');
}  else {
//on gère la suppression de l'utilisateur
$sql = "DELETE FROM stage WHERE id = :id";
$query = $db->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
header('Location: index.php');
}

} else { header('Location: index.php');

} //si ça a foiré avec un mauvais ID ce else là sert à ça
?>