<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body><h1>Ajouter un stage</h1>
<form action="create.php" method="post">  
<input type="text" name='etat' required>
    <label for="etat">
        Etat
    </label>
    <input type="text" name='entreprise' required>
    <label for="entreprise">
        entreprise
    </label>


    <label for="envoi">Date d'envoi</label>

<input
  type="datetime-local"
  id="envoi"
  name="envoi"
  value="2024-05-01T19:30"
  min="2023-06-07T00:00"
  max="2040-06-14T00:00" />

  <label for="envoi">Date de relance</label>

<input
  type="datetime-local"
  id="envoi"
  name="envoi"
  value="2024-05-01T19:30"
  min="2023-06-07T00:00"
  max="2040-06-14T00:00" />

  <label for="candidature">Type de candidature:</label> 
    <select name="candidature" id="candidature"> 
        <option value="candidature spontanée">Canidature spontané</option> 
        <option value="réponse à une offre d'emploi">Réponse à une offre d'emploi</option> 
    </select>

    <label for="methode">Méthode d'envoi:</label> 
    <select name="methode" id="methode"> 
        <option value="email">email</option> 
        <option value="courrier">courier</option> 
        <option value="remise en main propres">remise en main propres</option> 
    </select>

    <label for="contrat">Type de contrat:</label> 
    <select name="contrat" id="contrat"> 
        <option value="cdd">CDD</option> 
        <option value="cdi">CDI</option> 
        <option value="interim">Intérim</option> 
        <option value="stage">Stage</option> 
        <option value="aprentissage">Aprentissage</option> 
    </select>


    <label for="poste">
       Intitulé du poste
    </label>
    <input type="text" name='poste' required>

    <label for="email">
       email
    </label>
    <input type="email" name='email' required>

    <label for="commentaire">commentaires</label>

<textarea id="commentaire" name="commentaire">
Ici vos commentaires/compléments d'info
</textarea>

    <button>Ajouter</button>
    </form>
    <a href="index.php">Retour</a> 
    <?php echo print_r($_POST);?>
</body>
</html>