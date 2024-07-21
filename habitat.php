<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8', 'root', '');
$bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');

// Récupérer les informations sur les animaux en fonction de l'habitat sélectionné
$habitat = $_GET['habitat'] ?? ''; // Assurez-vous que l'habitat est fourni via une requête GET
$animaux = [];

if ($habitat) {
    $requeteAnimaux = $bdd->prepare('SELECT * FROM animaux WHERE habitat_a = ?');
    $requeteAnimaux->execute([$habitat]);
    $animaux = $requeteAnimaux->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="habitat_style.css">
    <link rel="stylesheet" href="all.css">
    <title>Habitat</title>
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
        <div class="habitat">
            <div class='habitsavane'><a href="?habitat=Savane"><img src='./images/savane.jpg' alt='savane'></a></div>
            <div class='habitforet'><a href="?habitat=Forêt"><img src='./images/foret.jpg' alt='foret'></a></div>
            <div class='prairie'><a href="?habitat=Prairie"><img src='./images/prairie.jpeg' alt='prairie'></a></div>
            <div class='habittoundra'><a href="?habitat=Toundra"><img src='./images/toundra.jpg' alt='toundra'></a></div>
        </div>

        <?php if ($habitat && $animaux): ?>
            <div class="animaux-info">
                <h2>Animaux de la <?= htmlspecialchars($habitat); ?></h2>
                <div class="animaux-container">
                    <?php foreach ($animaux as $animal): ?>
                        <div class="animal">
                            <div class="animal-img">
                                <img src="./images/<?php echo htmlspecialchars($animal['image_a']); ?>" alt="<?php echo htmlspecialchars($animal['nom_a']); ?>">
                            </div>
                            <div class="animal-details">
                                <p><strong>Nom :</strong> <?php echo htmlspecialchars($animal['nom_a']); ?></p>
                                <p><strong>Race :</strong> <?php echo htmlspecialchars($animal['race_a']); ?></p>
                                <p><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($animal['description'])); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <script src="script_habitat.js"></script>
</body>
</html>
