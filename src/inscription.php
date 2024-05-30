<?php 
session_start();
require_once('connect.php');
try {
    $pdo = new PDO($dsn, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('La connexion à la base de données a échoué : ' . $e->getMessage());
}

if (isset($_POST['envoi'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']); // Corrected the variable name and argument
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Use password_hash instead of hash

        try {
            $insertUser = $pdo->prepare('INSERT INTO stage.espace_membre (pseudo, mdp) VALUES (?, ?)');
            $insertUser->execute(array($pseudo, $mdp)); // Corrected the variable name and function name
            $recupUser = $pdo->prepare('SELECT id FROM stage.espace_membre WHERE pseudo = ?');
            $recupUser->execute(array($pseudo));
            $user = $recupUser->fetch();
            if($user) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $user['id'];
            
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez compléter les champs"; // Added the missing semicolon here
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
</head>
<body>
    <h1>Inscrivez-vous ici</h1>
    <div class="container"><form method="POST" action="">
        <input type="text" name="pseudo" id="" placeholder="Pseudo" autocomplete="off">
        <input type="password" name="mdp" id="" placeholder="Mot de passe" autocomplete="off">
        <input type="submit" name="envoi">
    </form></div>
</body>
</html>
