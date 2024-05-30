<?php
session_start();
require_once('connect.php');

try {
    $pdo = new PDO($dsn, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('La connexion à la base de données a échoué : ' . $e->getMessage());
}

if (isset($_POST['connexion'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = $_POST['mdp'];

        try {
            $recupUser = $pdo->prepare('SELECT * FROM stage.espace_membre WHERE pseudo = ?');
            $recupUser->execute(array($pseudo));
            $user = $recupUser->fetch();

            if ($user && password_verify($mdp, $user['mdp'])) {
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['id'] = $user['id'];
                header('Location: index.php');
            } else {
                echo "Pseudo ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez compléter les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.6/dist/bootstrap-table.min.css">
</head>
<body>
    <h1>Connexion de l'utilisateurice</h1>
    <form method="POST" action="">
        <input type="text" name="pseudo" placeholder="Pseudo" autocomplete="off">
        <input type="password" name="mdp" placeholder="Mot de passe" autocomplete="off">
        <input type="submit" name="connexion" value="Connexion">
    </form>
</body>
</html>
