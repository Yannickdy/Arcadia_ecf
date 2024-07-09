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
        $stmt = $bdd->prepare('UPDATE avis SET approuve = 1 WHERE id = ?');
        $stmt->execute(array($id));
    } elseif ($_GET['action'] == 'supprimer') {
        $stmt = $bdd->prepare('DELETE FROM avis WHERE id = ?');
        $stmt->execute(array($id));
    }
}

// Récupérer tous les avis non approuvés
$stmt = $bdd->prepare('SELECT * FROM avis WHERE approuve = 0');
$stmt->execute();
$avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Avis</title>
</head>
<body>

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
