<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
</head>
<body>
<div class="card">
  <div class="card-header">
  Ajoutez un nouveau stage
  </div>
  <div class="card-body">
    <form action="create.php" method="post">
        <label for="etat">État</label>
        <input type="text" name="etat" required>

        <label for="entreprise">Entreprise</label>
        <input type="text" name="entreprise" required>

        <label for="envoi">Date d'envoi</label>
        <input type="datetime-local" id="envoi" name="envoi" value="2024-05-01T19:30" min="2023-06-07T00:00" max="2040-06-14T00:00" required>

        <label for="relance">Date de relance</label>
        <input type="datetime-local" id="relance" name="relance" value="2024-05-01T19:30" min="2023-06-07T00:00" max="2040-06-14T00:00" required>

        <label for="candidature">Type de candidature</label>
        <select name="candidature" id="candidature" required>
            <option value="candidature spontanée">Candidature spontanée</option>
            <option value="réponse à une offre d'emploi">Réponse à une offre d'emploi</option>
        </select>

        <label for="methode">Méthode d'envoi</label>
        <select name="methode" id="methode" required>
            <option value="email">Email</option>
            <option value="courrier">Courrier</option>
            <option value="remise en main propre">Remise en main propre</option>
        </select>

        <label for="contrat">Type de contrat</label>
        <select name="contrat" id="contrat" required>
            <option value="cdd">CDD</option>
            <option value="cdi">CDI</option>
            <option value="interim">Intérim</option>
            <option value="stage">Stage</option>
            <option value="apprentissage">Apprentissage</option>
        </select>

        <label for="poste">Intitulé du poste</label>
        <input type="text" name="poste" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="commentaire">Commentaires</label>
        <textarea id="commentaire" name="commentaire" required>Ici vos commentaires/compléments d'info</textarea>

        <button type="submit">Ajouter</button></div></div>
    </form>
    <a href="index.php">Retour</a>
</body>
</html>
