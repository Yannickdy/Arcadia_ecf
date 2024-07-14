<?php
session_start();

// Connexion à la base de données avec PDO
try {
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté et a le rôle approprié
if (!isset($_SESSION['id']) || ($_SESSION['role'] != 'employe' && $_SESSION['role'] != 'admin')) {
    die("Accès refusé.");
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
