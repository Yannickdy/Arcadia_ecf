<?php 

$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
$bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
$error_message = "";
if(isset($_POST['envoi'])){
  if(!empty($_POST['nom']) AND !empty($_POST['mdp']) AND !empty($_POST['role'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = sha1($_POST['mdp']);
    $role;
    // Ajouter le code pour traiter les données du formulaire ici.
  }
  else{
    $error_message = "Tous les champs doivent être remplis";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="connexion.php"> connexion</a>
                <a href="inscription.php">inscription</a>
            </div>
        </div>
    </header>

    <main>
        <input type="text" placeholder="Entrez un pseudo">
        <input type="password" placeholder="mot de passe"> <br>
        <input class="button" type="button" value="Connexion" />

    </main>