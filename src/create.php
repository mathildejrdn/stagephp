<?php
session_start();

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

        $user_id = $_SESSION['id'];
        $etat = strip_tags($_POST['etat']);
        $entreprise = strip_tags($_POST['entreprise']);
        $envoi = strip_tags($_POST['envoi']);
        $relance = strip_tags($_POST['relance']);
        $candidature = strip_tags($_POST['candidature']);
        $methode = strip_tags($_POST['methode']);
        $contrat = strip_tags($_POST['contrat']);
        $poste = strip_tags($_POST['poste']);
        $email = strip_tags($_POST['email']);
        $commentaire = strip_tags($_POST['commentaire']);

        $sql = "INSERT INTO stage (user_id, etat, entreprise, envoi, relance, candidature, methode, contrat, poste, email, commentaire) 
                VALUES (:user_id, :etat, :entreprise, :envoi, :relance, :candidature, :methode, :contrat, :poste, :email, :commentaire)";

        $query = $db->prepare($sql);

        // Bind values
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":etat", $etat);
        $query->bindValue(":entreprise", $entreprise);
        $query->bindValue(":envoi", $envoi);
        $query->bindValue(":relance", $relance);
        $query->bindValue(":candidature", $candidature);
        $query->bindValue(":methode", $methode);
        $query->bindValue(":contrat", $contrat);
        $query->bindValue(":poste", $poste);
        $query->bindValue(":email", $email);
        $query->bindValue(":commentaire", $commentaire);
        
        // Execute the query
        $query->execute();

        // Stocker le message de succès dans la session
        $_SESSION['message'] = "Stage ajouté";

        // Redirect to another page after successful insertion
        header('Location: index.php');
        exit();
    } else {
        // Handle case where required fields are missing
        $_SESSION['message'] = "Veuillez remplir tous les champs";
    }
}
?>

