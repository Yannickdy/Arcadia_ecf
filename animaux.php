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



// Récupérer tous les animaux depuis la base de données
$requeteAnimaux = $bdd->query('SELECT * FROM animaux');
$animaux = $requeteAnimaux->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations vétérinaires pour chaque animal
foreach ($animaux as &$animal) {
    $animal_id = $animal['id'];
    $requeteInfoVeto = $bdd->prepare('SELECT * FROM info_veterinaire WHERE animal_id = ?');
    $requeteInfoVeto->execute([$animal_id]);
    $info_veto = $requeteInfoVeto->fetch(PDO::FETCH_ASSOC);

    // Ajouter les informations vétérinaires à l'animal correspondant
    $animal['info_veterinaire'] = $info_veto;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="animaux-style.css">
    <title>Animaux</title>
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
            <!-- Affichage de tous les animaux -->
            <?php foreach($animaux as $animal): ?>
            <div class="animal">
                <h3>Information sur l'animal</h3>
                <?php if(isset($animal['image_a']) && !empty($animal['image_a'])): ?>
                <img src="./images/<?php echo htmlspecialchars($animal['image_a']); ?>" alt="<?php echo htmlspecialchars($animal['race_a']); ?>">
                <?php else: ?>
                <img src="./images/default.jpg" alt="Image par défaut">
                <?php endif; ?>
                <ul>
                    <li><strong>Nom :</strong> <?php echo htmlspecialchars($animal['nom_a']); ?></li>
                    <li><strong>Race :</strong> <?php echo htmlspecialchars($animal['race_a']); ?></li>
                    <li><strong>Habitat :</strong> <?php echo htmlspecialchars($animal['habitat_a']); ?></li>
                    <li><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($animal['description'])); ?></li>
                    <h3>Information vétérinaire</h3>
                    <!-- Affichage des informations vétérinaires s'il y en a -->
                    <?php if (!empty($animal['info_veterinaire'])): ?>
                        <hr>
                        <li><strong>État :</strong> <?php echo htmlspecialchars($animal['info_veterinaire']['etat_animal']); ?></li>
                        <li><strong>Nourriture :</strong> <?php echo htmlspecialchars($animal['info_veterinaire']['nourriture']); ?></li>
                        <li><strong>Quantité nourriture :</strong> <?php echo htmlspecialchars($animal['info_veterinaire']['g_nourriture']); ?></li>
                        <li><strong>Date de passage :</strong> <?php echo htmlspecialchars(date("d/m/Y H:i:s", strtotime($animal['info_veterinaire']['date_passage']))); ?></li>
                        <li><strong>Détails :</strong> <?php echo nl2br(htmlspecialchars($animal['info_veterinaire']['detail_animal'])); ?></li>
                    <?php endif; ?>
                </ul>

                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'veterinaire')): ?> 
                    <!-- Boutons de modification, suppression et redirection pour les administrateurs et vétérinaires -->
                    <form method="GET" action="modifier_animal.php" style="display: inline;">
                        <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                        <input type="submit" name="modifier" value="Modifier">
                    </form>
                    <form method="POST" action="supprimer_animal.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');" style="display: inline;">
                        <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                        <input type="submit" name="supprimer" value="Supprimer">
                    </form>
                    <form method="GET" action="veterinaire.php" style="display: inline;">
                        <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                        <input type="submit" value="Page Vétérinaire">
                    </form>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <!-- Formulaire d'ajout d'animal -->
            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'veterinaire')): ?> 
            <div class="ajout_animal">
                <h2>Ajouter un animal</h2>
                <form method="POST" action="veterinaire.php" enctype="multipart/form-data">
                    <p><label>Nom : </label><input type="text" name="nom_a"></p>
                    <p><label>Race : </label><input type="text" name="race_a"></p>
                    <p><label>Habitat : </label>
                        <select name="habitat_a">
                            <option value="Savane">Savane</option>
                            <option value="Prairie">Prairie</option>
                            <option value="Forêt">Forêt</option>
                            <option value="Toundra">Toundra</option>
                        </select>
                    </p>
                    <p><label>Description : </label><textarea name="description"></textarea></p>
                    <p><label>Image : </label><input type="file" name="image_a"></p>
                    <input type="submit" name="envoi" value="Ajouter">
                </form>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
