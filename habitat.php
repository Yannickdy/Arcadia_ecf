<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
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
            <div class='habitsavane'><img src='./images/savane.jpg' alt='savane' data-info="savane-info"></div>
            <div class='habitforet'><img src='./images/foret.jpg' alt='foret' data-info="foret-info"></div>
            <div class='prairie'><img src='./images/prairie.jpeg' alt='prairie' data-info="prairie-info"></div>
            <div class='habittoundra'><img src='./images/toundra.jpg' alt='toundra' data-info="toundra-info"></div>
        </div>
        <div id="savane-info" class="info-section">
            <h2>Savane</h2>
            <img src='./images/savane.jpg' alt='savane'>
            <p>Description de la savane.</p>
            <ul>
                <li>Lion</li>
                <li>Éléphant</li>
                <li>Zèbre</li>
            </ul>
        </div>
        <div id="foret-info" class="info-section">
            <h2>Forêt</h2>
            <img src='./images/foret.jpg' alt='foret'>
            <p>Description de la forêt.</p>
            <ul>
                <li>Ours</li>
                <li>Cerf</li>
                <li>Renard</li>
            </ul>
        </div>
        <div id="prairie-info" class="info-section">
            <h2>Prairie</h2>
            <img src='./images/prairie.jpeg' alt='prairie'>
            <p>Description de la prairie.</p>
            <ul>
                <li>Bison</li>
                <li>Antilope</li>
                <li>Renard des prairies</li>
            </ul>
        </div>
        <div id="toundra-info" class="info-section">
            <h2>Toundra</h2>
            <img src='./images/toundra.jpg' alt='toundra'>
            <p>Description de la toundra.</p>
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
