<?php 
session_start();
// if($_SESSION)
echo "Identifiant: " . htmlspecialchars($_SESSION['identifiant']) . " | Rôle: " . htmlspecialchars($_SESSION['role']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>
<body>
    <header>
            <div class="header_container">
                <div class="logo"><a href="index.php"><img src="logo.png" alt="logo"></a></div>
 
                <div class="principale">
                  <a href="index.html">Acceuil</a>
                  <a href="habitat.html">Habitat</a>
                  <a href="animaux.html">Animaux</a>
                  <a href="services.html">Services</a>
                  <a href="avis.html">Avis</a>
                </div>
        
            <div class="utilisateur">
                <a href="connexion.php"> connexion</a>
                <a href="inscription.php">inscription</a>
            </div>
        </div>
    </header>

    <main>
        
        <div class="d1"></div>
        </div>   
        <section class="principal">
          <div class="presentation">
            <h2>Présentation</h2>
            <div class="texte_presentation">
                
                <img src='./images/pandaroux.jpg' alt=''>
                <p>Bienvenue au Zoo Australien !
                    Plongez dans l'univers unique et fascinant de la faune australienne au Zoo Australien. Niché au cœur d'une nature verdoyante, notre zoo offre une aventure inoubliable à la découverte des espèces emblématiques de l'Australie.
                    
                    Une Faune Unique
                    Venez rencontrer nos kangourous bondissants, nos koalas câlins et nos émeus majestueux. Explorez la diversité étonnante des reptiles australiens, comme les crocodiles et les serpents venimeux, et émerveillez-vous devant les oiseaux colorés tels que les cacatoès et les kookaburras.
                    
                    Conservation et Éducation
                    Le Zoo Australien s'engage activement dans la conservation des espèces menacées et la protection de leurs habitats naturels. Grâce à nos programmes de reproduction et à nos initiatives éducatives, nous contribuons à la préservation de cette biodiversité unique.</p>
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
                  <p><a href="services.php">Vous pouvez voir tous les services que nous proposons en cliquant ici</a></p>
            </div>

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
            </div>
        </section>


  </main>

  <script src="script_index.js"></script>
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Votre Entreprise. Tous droits réservés.</p>
            <ul>
              <li><a href="#">Accueil</a></li>
              <li><a href="#">À propos</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </div>
    </footer>
</body>
</html>
