<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8', 'root', '');
$bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');

// Vérifier que l'utilisateur est connecté et a les droits nécessaires
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'veterinaire')) {
    header('Location: index.php');
    exit();
}

// Vérifier si l'ID de l'information vétérinaire est fourni
if (isset($_GET['info_veto_id'])) {
    $info_veto_id = intval($_GET['info_veto_id']);
    
    // Récupérer les informations vétérinaires actuelles
    $requete = $bdd->prepare('SELECT * FROM info_veterinaire WHERE id = ?');
    $requete->execute([$info_veto_id]);
    $info_veto = $requete->fetch(PDO::FETCH_ASSOC);
    
    // Récupérer la liste des animaux pour le formulaire
    $animaux = $bdd->query('SELECT * FROM animaux')->fetchAll(PDO::FETCH_ASSOC);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Traiter le formulaire de modification
        $animal_id = intval($_POST['animal_id']);
        $etat_animal = htmlspecialchars($_POST['etat_animal']);
        $nourriture = htmlspecialchars($_POST['nourriture']);
        $g_nourriture = htmlspecialchars($_POST['g_nourriture']);
        $detail_animal = htmlspecialchars($_POST['detail_animal']);
        
        $requeteUpdate = $bdd->prepare('UPDATE info_veterinaire SET animal_id = ?, etat_animal = ?, nourriture = ?, g_nourriture = ?, detail_animal = ? WHERE id = ?');
        $requeteUpdate->execute([$animal_id, $etat_animal, $nourriture, $g_nourriture, $detail_animal, $info_veto_id]);
        
        header('Location: veterinaire.php');
        exit();
    }
} else {
    header('Location: veterinaire.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="animaux-style.css">
    <title>Modifier Information Vétérinaire</title>
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
            </div>
            <div class="utilisateur">
                <?php 
                // Afficher l'identifiant de l'utilisateur et son rôle
                if (isset($_SESSION['identifiant']) && !empty($_SESSION['identifiant'])) {
                    echo "Identifiant: " . htmlspecialchars($_SESSION['identifiant']) . " | Rôle: " . htmlspecialchars($_SESSION['role']);
                    echo '<a href="deconnexion.php">Déconnexion</a>';
                } else {
                    echo '<a href="connexion.php">Connexion</a>';
                }
                ?>
            </div>
        </div>
    </header>

    <main>
        <div class="d1"></div>
        <div class="animauxgrid">
            <div class="animal">
                <h2>Modifier les Informations Vétérinaires</h2>
                <form method="POST" action="">
                    <p><label>Animal :</label>
                        <select name="animal_id">
                            <?php foreach($animaux as $animal): ?>
                                <option value="<?php echo $animal['id']; ?>" <?php if ($animal['id'] == $info_veto['animal_id']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($animal['nom_a']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p><label>État :</label><input type="text" name="etat_animal" value="<?php echo htmlspecialchars($info_veto['etat_animal']); ?>"></p>
                    <p><label>Nourriture :</label><input type="text" name="nourriture" value="<?php echo htmlspecialchars($info_veto['nourriture']); ?>"></p>
                    <p><label>Quantité nourriture :</label><input type="text" name="g_nourriture" value="<?php echo htmlspecialchars($info_veto['g_nourriture']); ?>"></p>
                    <p><label>Détails :</label><textarea name="detail_animal"><?php echo htmlspecialchars($info_veto['detail_animal']); ?></textarea></p>
                    <input type="submit" value="Enregistrer les modifications">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
