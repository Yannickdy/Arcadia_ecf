<?php
session_start();

// Connexion à la base de données avec PDO
try {
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if(isset($_POST['envoi'])) {
    if(!empty($_POST['identifiant']) && !empty($_POST['mdp'])) {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mdp = $_POST['mdp'];

        $recupUser = $bdd->prepare('SELECT * FROM membres WHERE identifiant = ?');
        $recupUser->execute(array($identifiant));

        if($recupUser->rowCount() > 0) {
            $userInfo = $recupUser->fetch();
            if (hash_equals($userInfo['mdp'], sha1($mdp))) {
                $_SESSION['identifiant'] = $userInfo['identifiant'];
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['role'] = $userInfo['role'];
                header('Location: index.php');
                exit();
            } else {
                echo "<p>Identifiant ou mot de passe incorrect.</p>";
            }
        } else {
            echo "<p>Utilisateur non trouvé.</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>

<h2>Connexion</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p class="inline">Nom :</p> <input type="text" name="identifiant" required><br />
    <p class="inline">Mot de passe :</p> <input type="password" name="mdp" required><br /><br />
    <input class="button" type="submit" name="envoi" value="Connexion" />
</form>

</body>
</html>
