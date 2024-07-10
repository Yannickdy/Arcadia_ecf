<?php
session_start();

// Connexion à la base de données avec PDO
try {
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Traitement de l'ajout d'un avis
if (isset($_POST['submit'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['avis'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $avis = htmlspecialchars($_POST['avis']);

        $recupAvis = $bdd->prepare('INSERT INTO avis (pseudo, email, avis) VALUES (?, ?, ?)');
        $recupAvis->execute(array($pseudo, $email, $avis));

        echo "<p>Votre avis a été soumis.</p>";
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}

// Récupération et affichage des avis approuvés
$recupAvis = $bdd->prepare('SELECT pseudo, avis FROM avis WHERE approuve = 1');
$recupAvis->execute();
$avisApprouves = $recupAvis->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Avis</title>
</head>
<body>
    <header>
                <div class="header_container">
                    <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
    
                    <div class="principale">
                    <a href="index.php">Acceuil</a>
                    <a href="habitat.php">Habitat</a>
                    <a href="animaux.php">Animaux</a>
                    <a href="services.php">Services</a>
                    <a href="avis.php">Avis</a>
                    </div>
            
                <div class="utilisateur">
                    <a href="connexion.php"> connexion</a>
                    <a href="inscription.php">inscription</a>
                </div>
            </div>
        </header>


    <main>
        <h2>Laisser un Avis</h2>
        <form method="post" action="">
            <p>Pseudo :</p> <input type="text" name="pseudo" required><br />
            <p>Email :</p> <input type="email" name="email" required><br />
            <p>Avis :</p> <textarea name="avis" required></textarea><br /><br />
            <input type="submit" name="submit" value="Envoyer" />
        </form>

        <hr>

        <h2>Avis Approuvés</h2>
        <?php
        if (empty($avisApprouves)) {
            echo "<p>Aucun avis approuvé n'est disponible pour le moment.</p>";
        } else {
            foreach ($avisApprouves as $avis) {
                echo "<div>";
                echo "<p><strong>{$avis['pseudo']}</strong>: {$avis['avis']}</p>";
                echo "</div>";
            }
        }
        ?>
    </main>
</body>
</html>
