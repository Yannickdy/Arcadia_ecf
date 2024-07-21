<?php
session_start();
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


// Récupérer toutes les informations vétérinaires depuis la base de données
$requeteInfoVeto = $bdd->query('SELECT * FROM info_veterinaire');
$info_veterinaires = $requeteInfoVeto->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations des animaux correspondants
foreach ($info_veterinaires as &$info_veto) {
    $animal_id = $info_veto['animal_id'];
    $requeteAnimal = $bdd->prepare('SELECT * FROM animaux WHERE id = ?');
    $requeteAnimal->execute([$animal_id]);
    $animal = $requeteAnimal->fetch(PDO::FETCH_ASSOC);

    // Ajouter les informations de l'animal correspondant
    $info_veto['animal'] = $animal;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="animaux-style.css">
    <title>Informations Vétérinaires</title>
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
            <!-- Affichage de toutes les informations vétérinaires -->
            <?php foreach($info_veterinaires as $info_veto): ?>
            <div class="animal">
                <h3>Informations Vétérinaires</h3>
                <ul>
                    <li><strong>Nom de l'animal :</strong> <?php echo htmlspecialchars($info_veto['animal']['nom_a']); ?></li>
                    <li><strong>Race :</strong> <?php echo htmlspecialchars($info_veto['animal']['race_a']); ?></li>
                    <li><strong>État :</strong> <?php echo htmlspecialchars($info_veto['etat_animal']); ?></li>
                    <li><strong>Nourriture :</strong> <?php echo htmlspecialchars($info_veto['nourriture']); ?></li>
                    <li><strong>Quantité nourriture :</strong> <?php echo htmlspecialchars($info_veto['g_nourriture']); ?></li>
                    <li><strong>Date de passage :</strong> <?php echo htmlspecialchars(date("d/m/Y H:i:s", strtotime($info_veto['date_passage']))); ?></li>
                    <li><strong>Détails :</strong> <?php echo nl2br(htmlspecialchars($info_veto['detail_animal'])); ?></li>
                </ul>

                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'veterinaire')): ?> 
                    <!-- Boutons de modification, suppression et redirection pour les administrateurs et vétérinaires -->
                    <form method="GET" action="modifier_info_veterinaire.php" style="display: inline;">
                        <input type="hidden" name="info_veto_id" value="<?php echo $info_veto['id']; ?>">
                        <input type="submit" name="modifier" value="Modifier">
                    </form>
                    <form method="POST" action="supprimer_info_veterinaire.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ces informations vétérinaires ?');" style="display: inline;">
                        <input type="hidden" name="info_veto_id" value="<?php echo $info_veto['id']; ?>">
                        <input type="submit" name="supprimer" value="Supprimer">
                    </form>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <!-- Formulaire d'ajout d'information vétérinaire -->
            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'veterinaire')): ?> 
            <div class="ajout_info_veterinaire">
                <h2>Ajouter des informations vétérinaires</h2>
                <form method="POST" action="ajouter_info_veterinaire.php" enctype="multipart/form-data">
                    <p><label>Animal : </label>
                        <select name="animal_id">
                            <?php 
                            $animaux = $bdd->query('SELECT * FROM animaux')->fetchAll(PDO::FETCH_ASSOC);
                            foreach($animaux as $animal):
                            ?>
                                <option value="<?php echo $animal['id']; ?>"><?php echo htmlspecialchars($animal['nom_a']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p><label>État : </label><input type="text" name="etat_animal"></p>
                    <p><label>Nourriture : </label><input type="text" name="nourriture"></p>
                    <p><label>Quantité nourriture : </label><input type="text" name="g_nourriture"></p>
                    <p><label>Détails : </label><textarea name="detail_animal"></textarea></p>
                    <input type="submit" name="envoi" value="Ajouter">
                </form>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
