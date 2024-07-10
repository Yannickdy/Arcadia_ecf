<?php 
session_start();
echo "Identifiant: " . htmlspecialchars($_SESSION['identifiant']) . " | Rôle: " . htmlspecialchars($_SESSION['role']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="habitat_style.css">
    <link rel="stylesheet" href="all.css">
    <title>Document</title>
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
                <a href="connexion.php">connexion</a>
                <a href="inscription.php">inscription</a>
            </div>
        </div>
    </header>
    <main>
        <div class="d1"></div>
        <div class="habitat">
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
        </div>
    </main>
    <script src="script_habitat.js"></script>
</body>
</html>
