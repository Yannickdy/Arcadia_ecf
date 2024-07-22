<?php 
session_start();

// Emplacement du fichier de stockage des horaires
$file_path = 'horaires.json';

// Initialiser les horaires par défaut si le fichier n'existe pas
if (!file_exists($file_path)) {
    $default_horaires = [
        'lundi' => '9h - 18h',
        'mardi' => '9h - 18h',
        'mercredi' => '9h - 18h',
        'jeudi' => '9h - 18h',
        'vendredi' => '9h - 18h',
        'samedi' => '10h - 16h',
        'dimanche' => 'Fermé',
    ];
    file_put_contents($file_path, json_encode($default_horaires));
}

// Récupérer les horaires actuels
$horaires = json_decode(file_get_contents($file_path), true);

if(isset($_POST['update_horaires'])) {
    if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'employe') {
        if(!empty($_POST['lundi']) && !empty($_POST['mardi']) && !empty($_POST['mercredi']) && !empty($_POST['jeudi']) && !empty($_POST['vendredi']) && !empty($_POST['samedi']) && !empty($_POST['dimanche'])) {
            $horaires = [
                'lundi' => htmlspecialchars($_POST['lundi']),
                'mardi' => htmlspecialchars($_POST['mardi']),
                'mercredi' => htmlspecialchars($_POST['mercredi']),
                'jeudi' => htmlspecialchars($_POST['jeudi']),
                'vendredi' => htmlspecialchars($_POST['vendredi']),
                'samedi' => htmlspecialchars($_POST['samedi']),
                'dimanche' => htmlspecialchars($_POST['dimanche']),
            ];
            // Mettre à jour les horaires d'ouverture dans le fichier
            if (file_put_contents($file_path, json_encode($horaires))) {
                $success_message = "Horaires d'ouverture mis à jour avec succès.";
            } else {
                $error_message = "Erreur lors de la mise à jour des horaires.";
            }
        } else {
            $error_message = "Tous les champs des horaires d'ouverture doivent être remplis.";
        }
    } else {
        $error_message = "Vous n'avez pas les droits nécessaires pour modifier les horaires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<<<<<<< HEAD
    <main>
        
        <div class="d1"></div>
        <section class="principal">
          <div class="presentation">
=======
<header>
    <div class="header_container">
        <!-- <div class="logo"><a href="index.php"><img src="./images/logo.png" alt="logo"></a></div> -->
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
    <section class="principal">
        <div class="presentation">
>>>>>>> dev
            <h2>Présentation</h2>
            <div class="texte_presentation">
                <img src='./images/pandaroux.jpg' alt=''>
<<<<<<< HEAD
                <p>Bienvenue au Zoo Australien !
                    Plongez dans l'univers unique et fascinant de la faune australienne au Zoo Australien. Niché au cœur d'une nature verdoyante, notre zoo offre une aventure inoubliable à la découverte des espèces emblématiques de l'Australie.
                    
                    Une Faune Unique
                    Venez rencontrer nos kangourous bondissants, nos koalas câlins et nos émeus majestueux. Explorez la diversité étonnante des reptiles australiens, comme les crocodiles et les serpents venimeux, et émerveillez-vous devant les oiseaux colorés tels que les cacatoès et les kookaburras.
                    
                    Conservation et Éducation
                    Le Zoo Australien s'engage activement dans la conservation des espèces menacées et la protection de leurs habitats naturels. Grâce à nos programmes de reproduction et à nos initiatives éducatives, nous contribuons à la préservation de cette biodiversité unique.</p>
            </div>
          </div>
=======
                <p>Bienvenue au Zoo Arcadia
>>>>>>> dev

Situé en Bretagne, près de la forêt de Brocéliande, le zoo Arcadia vous invite à une aventure unique depuis 1960. Découvrez nos habitats diversifiés qui recréent des environnements naturels fascinants. Explorez la prairie, avec ses bisons et chevaux sauvages, la forêt dense où évoluent lynx et cerfs, la savane africaine peuplée de lions et girafes, et la toundra arctique abritant rennes et hiboux des neiges.

Arcadia se consacre à la conservation et à l'éducation, offrant une expérience immersive et informative pour tous les âges. Venez vivre la magie de la nature dans un cadre enchâssé au cœur de la Bretagne !
                </p>
            </div>
        </div>

        <div class="services">
                <h2>Nos services</h2>
                <details>
                    <summary>Services éducatifs</summary>
                    <ul>
                      <li>Visites guidées : Accompagnées par des experts ou des guides.</li>
                      <li>Programmes éducatifs : Ateliers pour enfants, conférences, et programmes scolaires.</li>
                      <li>Panneaux d'information : Explications sur les animaux et leurs habitats.</li>
                      <li>Centres d'interprétation : Expositions interactives et multimédias sur la faune et la conservation.</li>
                    </ul>
                  </details>
                  <details>
                    <summary>Activités et expériences</summary>
                    <ul>
                      <li>Rencontres avec les animaux : Séances de nourrissage, interactions directes avec certains animaux.</li>
                      <li>Spectacles et démonstrations : Présentations de vol d'oiseaux, spectacles de dauphins, etc.</li>
                      <li>Aires de jeux pour enfants : Espaces récréatifs thématiques pour les plus jeunes.</li>
                      <li>Safaris en zoo : Tours en véhicules pour voir les animaux de plus près.</li>
                    </ul>
                  </details>
                  <details>
                    <summary>Services de restauration</summary>
                    <ul>
                      <li>Restaurants et cafés : Options de restauration variées sur place.</li>
                      <li>Aires de pique-nique : Espaces pour manger en plein air.</li>
                      <li>Stands de collations : Ventes de glaces, boissons, snacks.</li>
                    </ul>
                  </details>
                  <details>
                    <summary>Services de commodité</summary>
                    <ul>
                      <li>Boutiques de souvenirs : Ventes de peluches, livres, et autres articles liés aux animaux.</li>
                      <li>Accès pour personnes handicapées : Chemins adaptés, fauteuils roulants disponibles.</li>
                      <li>Aires de repos et bancs : Espaces pour se détendre.</li>
                      <li>Services de toilettes et de change : Toilettes propres et espaces pour changer les bébés.</li>
                    </ul>
                  </details>
                  <details>
                    <summary>Services de soutien</summary>
                    <ul>
                      <li>Personnel de sécurité : Surveillance pour assurer la sécurité des visiteurs.</li>
                      <li>Infirmerie : Premiers soins en cas de besoin.</li>
                      <li>Service de location de poussettes : Location de poussettes et chariots pour les jeunes enfants.</li>
                    </ul>
                  </details>
                  <details>
                    <summary>Services pour la conservation</summary>
                    <ul>
                      <li>Programmes de conservation : Initiatives de reproduction et de protection des espèces menacées.</li>
                      <li>Recherche scientifique : Collaboration avec des institutions pour des projets de recherche.</li>
                      <li>Partenariats avec d'autres zoos et réserves naturelles : Échanges d'animaux et de connaissances pour la conservation.</li>
                    </ul>
                  </details>
                  <a href="services.php"><p>Vous pouvez voir tous les services que nous proposons en cliquant ici</p></a>
            </div>

<<<<<<< HEAD
            <div class="habitat">
                <h2>Habitat</h2>
                <p> Cliquez sur un des habitats afin de se rendre à l'habitat voulu <br><a href="habitat.php"> Cliquez ici afin d'aller sur la page des habitats</a> </p>

              <div class="habitatgrid">
                <div class='habitsavane'>
                    <a href='habitat.php#savane'><img src='./images/savane.jpg' alt='Savane'></a>
                </div>
                <div class='habitforet'>
                    <a href='#foret'><img src='./images/foret.jpg' alt='Forêt'></a>
                </div>
                <div class='prairie'>
                    <a href='#prairie'><img src='./images/prairie.jpeg' alt='Prairie'></a>
                </div>
                <div class='habittoundra'>
                    <a href='#toundra'><img src='./images/toundra.jpg' alt='Toundra'></a>
                </div>
              </div>
            </div>
              <div class="animaux">
                  <h2>Animaux</h2>
                  <p> Cliquez sur un des animaux pour arrifer directement à sa fiche<br><a href="animaux.php">Cliquez ici afin d'aller sur la page des animaux</a> </p>
                      <div class="animauxgrid">
                      <div class='koala'><a href='animaux.php#koala'><img src='./images/koala.jpg' alt=''></a></div>
                      <div class='quokka'><a href='animaux.php#quokka'><img src='./images/quokka.jpg' alt=''></a></div>
                      <div class='taz'><a href='animaux.php#taz'><img src='./images/taz.jpg' alt=''></a></div>
                      <div class='wombat'><a href='animaux.php#wombat'><img src='./images/wombat.jpg' alt=''></a></div>
                  </div>
              </div>
            
            <div class="avis">
              <h2>Votre avis</h2>
              <p>Vi vous voulez laisser un avis n'hésitez pas à utiliser le formulaire ci-dessous</p>
              <h2>Laisser un Avis</h2>
              <form method="post" action="">
                  <p>Pseudo :</p> <input type="text" name="pseudo" required><br />
                  <p>Email :</p> <input type="email" name="email" required><br />
                  <p>Avis :</p> <textarea name="avis" required></textarea><br />
                  <input type="submit" name="submit" value="Envoyer" />
              </form>
=======
        <div class="habitat">
            <h2>Habitat</h2>
            <p> Cliquez sur un des habitats afin de se rendre à l'habitat voulu <br><a href="habitat.php"> Cliquez ici afin d'aller sur la page des habitats</a> </p>
            <div class="habitatgrid">
                <div class='habitsavane'><a href='habitat.php#savane'><img src='./images/savane.jpg' alt='Savane'><p>Savane</p></a></div>
                <div class='habitforet'><a href='#foret'><img src='./images/foret.jpg' alt='Forêt'><p>Foret</p></a></div>
                <div class='prairie'><a href='#prairie'><img src='./images/prairie.jpeg' alt='Prairie'><p>Prairie</p></a></div>
                <div class='habittoundra'><a href='#toundra'><img src='./images/toundra.jpg' alt='Toundra'><p>Toundra</p></a></div>
>>>>>>> dev
            </div>
        </div>
        <div class="animaux">
            <h2>Animaux</h2>
            <p> Cliquez sur un des animaux pour arriver directement à sa fiche<br><a href="animaux.php">Cliquez ici afin d'aller sur la page des animaux</a> </p>
            <div class="animauxgrid">
                <div class='koala'><a href='animaux.php#koala'><img src='./images/koala.jpg' alt=''><p>Koala</p></a></div>
                <div class='quokka'><a href='animaux.php#quokka'><img src='./images/quokka.jpg' alt=''><p>Quokka</p></a></div>
                <div class='kangourou'><a href='animaux.php#kangourou'><img src='./images/kangourou.jpg' alt=''><p>Kangourou</p></a></div>
                <div class='wombat'><a href='animaux.php#wombat'><img src='./images/wombat.jpg' alt=''><p>Wombat</p></a></div>
            </div>
        </div>
        <div class="avis">
            <h2>Votre avis</h2>
            <p>Si vous voulez laisser un avis, n'hésitez pas à utiliser le formulaire ci-dessous</p>
            <h2>Laisser un Avis</h2>
            <form method="post" action="">
                <p>Pseudo :</p> <input type="text" name="pseudo" required><br />
                <p>Email :</p> <input type="email" name="email" required><br />
                <p>Avis :</p> <textarea name="avis" required></textarea><br />
                <input type="submit" name="submit" value="Envoyer" />
            </form>
        </div>
    </section>
</main>

<<<<<<< HEAD

  </main>

  <script src="script_index.js"></script>
    <footer>
        <div class="footer-content">
            <p></p>
=======
<script src="script_index.js"></script>
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <h3>Horaires d'ouverture</h3>
>>>>>>> dev
            <ul>
                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'employe')): ?>
                    <form method="POST" action="">
                        <li>Lundi : <input type="text" name="lundi" value="<?= htmlspecialchars($horaires['lundi']); ?>"></li>
                        <li>Mardi : <input type="text" name="mardi" value="<?= htmlspecialchars($horaires['mardi']); ?>"></li>
                        <li>Mercredi : <input type="text" name="mercredi" value="<?= htmlspecialchars($horaires['mercredi']); ?>"></li>
                        <li>Jeudi : <input type="text" name="jeudi" value="<?= htmlspecialchars($horaires['jeudi']); ?>"></li>
                        <li>Vendredi : <input type="text" name="vendredi" value="<?= htmlspecialchars($horaires['vendredi']); ?>"></li>
                        <li>Samedi : <input type="text" name="samedi" value="<?= htmlspecialchars($horaires['samedi']); ?>"></li>
                        <li>Dimanche : <input type="text" name="dimanche" value="<?= htmlspecialchars($horaires['dimanche']); ?>"></li>
                        <li><input type="submit" name="update_horaires" value="Mettre à jour les horaires"></li>
                    </form>
                    <?php if($error_message): ?>
                        <p style="color: red;"><?= htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <?php if($success_message): ?>
                        <p style="color: green;"><?= htmlspecialchars($success_message); ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <li>Lundi : <?= htmlspecialchars($horaires['lundi']); ?></li>
                    <li>Mardi : <?= htmlspecialchars($horaires['mardi']); ?></li>
                    <li>Mercredi : <?= htmlspecialchars($horaires['mercredi']); ?></li>
                    <li>Jeudi : <?= htmlspecialchars($horaires['jeudi']); ?></li>
                    <li>Vendredi : <?= htmlspecialchars($horaires['vendredi']); ?></li>
                    <li>Samedi : <?= htmlspecialchars($horaires['samedi']); ?></li>
                    <li>Dimanche : <?= htmlspecialchars($horaires['dimanche']); ?></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="footer-right">
            <p>© 2024 Votre Entreprise. Tous droits réservés.</p>
            <p><a href="#">Politique de confidentialité</a> | <a href="#">Mentions légales</a></p>
        </div>
    </div>
</footer>
</body>
</html>