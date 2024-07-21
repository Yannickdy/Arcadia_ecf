<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="service_style.css">
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

    <div class="d1"></div>
    </div>   
    <div class="container">
        <h1>Services proposés dans un zoo</h1>

        <h2>Services éducatifs</h2>
        <ul>
            <li>Visites guidées : Accompagnées par des experts ou des guides.</li>
            <li>Programmes éducatifs : Ateliers pour enfants, conférences, et programmes scolaires.</li>
            <li>Panneaux d'information : Explications sur les animaux et leurs habitats.</li>
            <li>Centres d'interprétation : Expositions interactives et multimédias sur la faune et la conservation.</li>
        </ul>

        <h2>Activités et expériences</h2>
        <ul>
            <li>Rencontres avec les animaux : Séances de nourrissage, interactions directes avec certains animaux.</li>
            <li>Spectacles et démonstrations : Présentations de vol d'oiseaux, spectacles de dauphins, etc.</li>
            <li>Aires de jeux pour enfants : Espaces récréatifs thématiques pour les plus jeunes.</li>
            <li>Safaris en zoo : Tours en véhicules pour voir les animaux de plus près.</li>
        </ul>

        <h2>Services de restauration</h2>
        <ul>
            <li>Restaurants et cafés : Options de restauration variées sur place.</li>
            <li>Aires de pique-nique : Espaces pour manger en plein air.</li>
            <li>Stands de collations : Ventes de glaces, boissons, snacks.</li>
        </ul>

        <h2>Services de commodité</h2>
        <ul>
            <li>Boutiques de souvenirs : Ventes de peluches, livres, et autres articles liés aux animaux.</li>
            <li>Accès pour personnes handicapées : Chemins adaptés, fauteuils roulants disponibles.</li>
            <li>Aires de repos et bancs : Espaces pour se détendre.</li>
            <li>Services de toilettes et de change : Toilettes propres et espaces pour changer les bébés.</li>
        </ul>

        <h2>Services de soutien</h2>
        <ul>
            <li>Personnel de sécurité : Surveillance pour assurer la sécurité des visiteurs.</li>
            <li>Infirmerie : Premiers soins en cas de besoin.</li>
            <li>Service de location de poussettes : Location de poussettes et chariots pour les jeunes enfants.</li>
        </ul>

        <h2>Services pour la conservation</h2>
        <ul>
            <li>Programmes de conservation : Initiatives de reproduction et de protection des espèces menacées.</li>
            <li>Recherche scientifique : Collaboration avec des institutions pour des projets de recherche.</li>
            <li>Partenariats avec d'autres zoos et réserves naturelles : Échanges d'animaux et de connaissances pour la conservation.</li>
        </ul>
    </div>
</body>
</html>
