<?php
session_start();

// Connexion à la base de données avec PDO
try {
    // Tentative de connexion à la première base de données locale
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

    try {
        // Tentative de connexion à la deuxième base de données distante
        $bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8;', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

// Approuver ou supprimer un avis
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] == 'approuver') {
        $infoAvis = $bdd->prepare('UPDATE avis SET approuve = 1 WHERE id = ?');
        $infoAvis->execute(array($id));
    } elseif ($_GET['action'] == 'supprimer') {
        $infoAvis = $bdd->prepare('DELETE FROM avis WHERE id = ?');
        $infoAvis->execute(array($id));
    }
}

// Récupérer tous les avis non approuvés
$infoAvis = $bdd->prepare('SELECT * FROM avis WHERE approuve = 0');
$infoAvis->execute();
$avis = $infoAvis->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Avis</title>
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

<h2>Gérer les Avis</h2>

<?php
if (empty($avis)) {
    echo "<p>Aucun avis en attente d'approbation.</p>";
} else {
    foreach ($avis as $av) {
        echo "<p><strong>{$av['pseudo']}</strong>: {$av['avis']} 
        <a href='gestion_avis.php?action=approuver&id={$av['id']}'>Approuver</a> 
        <a href='gestion_avis.php?action=supprimer&id={$av['id']}'>Supprimer</a></p>";
    }
}
?>

</body>
</html>
