<?php
session_start();

// Connexion à la base de données avec PDO
try {
    // Tentative de connexion à la première base de données locale
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données locale réussie.";
} catch(Exception $e) {
    echo 'Erreur de connexion à la base de données locale : '.$e->getMessage()."\n";

    try {
        // Tentative de connexion à la deuxième base de données distante
        $bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8;', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connexion à la base de données distante réussie.";
    } catch(Exception $e) {
        die('Erreur de connexion à la base de données distante : '.$e->getMessage());
    }
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
    <link rel="stylesheet" href="all.css">
    <title>Avis</title>
</head>
<body>

<header>
        <div class="header_container">
            <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
            <div class="principale">
                <a href="index.php">Accueil</a>
                <a href="habitat.php">Habitat</a>
                <a href="animaux.php">Animaux</a>
                <a href="services.php">Services</a>
                <a href="avis.php">Avis</a>
                <?php if(isset($_SESSION['identifiant'])): ?>
                    <a href="staff.php">Employé</a>
                <?php endif; ?>
            </div>
            <div class="utilisateur">
                <?php if(isset($_SESSION['identifiant'])): ?>
                    Identifiant: <?= htmlspecialchars($_SESSION['identifiant']); ?> | Rôle: <?= htmlspecialchars($_SESSION['role']); ?>
                    <a href="deconnexion.php">Déconnexion</a>
                <?php else: ?>
                    <a href="connexion.php">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <main>
        <div class="d1"></div>

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
