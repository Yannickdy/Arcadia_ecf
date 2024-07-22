<?php
session_start();
if (!isset($bdd)) {
    $connected = false;

    try {
        // Tentative de connexion à la première base de données locale
        $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connected = true;
    } catch(Exception $e) {
        echo 'Erreur de connexion à la base de données locale : '.$e->getMessage()."\n";
    }

    if (!$connected) {
        try {
            // Tentative de connexion à la deuxième base de données distante
            $bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            die('Erreur de connexion à la base de données distante : '.$e->getMessage());
        }
    }
} 


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
<<<<<<< HEAD
    <title>Document</title>
=======
    <title>Habitat</title>
>>>>>>> dev
</head>
<body>
    <header>
        <div class="header_container">
            <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
            <div class="principale">
<<<<<<< HEAD
                <a href="index.php">Acceuil</a>
=======
                <a href="index.php">Accueil</a>
>>>>>>> dev
                <a href="habitat.php">Habitat</a>
                <a href="animaux.php">Animaux</a>
                <a href="services.php">Services</a>
                <a href="avis.php">Avis</a>
<<<<<<< HEAD
            </div>
            <div class="utilisateur">
                <a href="connexion.php">connexion</a>
                <a href="inscription.php">inscription</a>
=======
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
>>>>>>> dev
            </div>
        </div>
    </header>
    
    <main>
        <div class="d1"></div>
        <div class="habitat">
<<<<<<< HEAD
            <div class='habitsavane'><img src='./images/savane.jpg' alt='savane' data-info="savane-info"></div>
            <div class='habitforet'><img src='./images/foret.jpg' alt='foret' data-info="foret-info"></div>
            <div class='prairie'><img src='./images/prairie.jpeg' alt='prairie' data-info="prairie-info"></div>
            <div class='habittoundra'><img src='./images/toundra.jpg' alt='toundra' data-info="toundra-info"></div>
        </div>
        <div id="savane-info" class="info-section">
            <h2>Savane</h2>
            <img src='./images/savane.jpg' alt='savane'>
            <p>La savane s'étend à perte de vue sous le soleil ardent, avec son herbe dorée ondulant doucement et quelques acacias offrant de l'ombre. Cet habitat est le royaume des animaux adaptés à la sécheresse et à la chaleur, comme les grands herbivores et les prédateurs qui coexistent dans cet espace ouvert et spectaculaire.</p>
            <ul>
                <li>Lion</li>
                <li>Éléphant</li>
                <li>Zèbre</li>
            </ul>
        </div>
        <div id="foret-info" class="info-section">
            <h2>Forêt</h2>
            <img src='./images/foret.jpg' alt='foret'>
            <p>La dense forêt tropicale du zoo est un monde vibrant où la canopée verdoyante abrite une multitude de vie. Les appels mystérieux d'oiseaux et le chuchotement des feuilles créent une ambiance magique. Les habitants de cette forêt, adaptés à son environnement unique, vivent en harmonie dans ce paysage dense et humide.</p>
            <ul>
                <li>Ours</li>
                <li>Cerf</li>
                <li>Renard</li>
            </ul>
        </div>
        <div id="prairie-info" class="info-section">
            <h2>Prairie</h2>
            <img src='./images/prairie.jpeg' alt='prairie'>
            <p>La prairie du zoo est une étendue ouverte où l'herbe ondule doucement sous la brise et où le ciel immense offre une sensation d'espace infini. Cet habitat est le foyer d'animaux adaptés à ce paysage ouvert, comme les herbivores qui paissent paisiblement et les prédateurs qui se déplacent habilement dans ce vaste territoire.</p>
            <ul>
                <li>Bison</li>
                <li>Antilope</li>
                <li>Renard des prairies</li>
            </ul>
        </div>
        <div id="toundra-info" class="info-section">
            <h2>Toundra</h2>
            <img src='./images/toundra.jpg' alt='toundra'>
            <p>L'habitat de la toundra du zoo est un paysage vaste et ouvert, où l'herbe rase et les lichens s'étendent à perte de vue sous un ciel souvent clair. Cette terre glacée et rocheuse est habitée par des animaux robustes et adaptés aux conditions extrêmes, comme les rennes et les loups arctiques. C'est un monde de vastes espaces et de tranquillité brute.</p>
            <ul>
                <li>Caribou</li>
                <li>Ours polaire</li>
                <li>Renard arctique</li>
            </ul>
=======
            <div class='habitsavane'><a href="?habitat=Savane"><img src='./images/savane.jpg' alt='savane'></a></div>
            <div class='habitforet'><a href="?habitat=Forêt"><img src='./images/foret.jpg' alt='foret'></a></div>
            <div class='prairie'><a href="?habitat=Prairie"><img src='./images/prairie.jpeg' alt='prairie'></a></div>
            <div class='habittoundra'><a href="?habitat=Toundra"><img src='./images/toundra.jpg' alt='toundra'></a></div>
>>>>>>> dev
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
