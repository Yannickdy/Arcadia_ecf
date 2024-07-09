<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');

if(isset($_POST['envoi'])){
    if(!empty($_POST['nom_a']) AND !empty($_POST['race_a']) AND !empty($_POST['habitat_a']) AND !empty($_POST['description'])){
        $nom_a = htmlspecialchars($_POST['nom_a']);
        $race_a = htmlspecialchars($_POST['race_a']);
        $habitat_a = htmlspecialchars($_POST['habitat_a']);
        $description = nl2br(htmlspecialchars($_POST['description']));

        $insertAnimal = $bdd->prepare('INSERT INTO animaux(nom_a, race_a, habitat_a, description) VALUES(?, ?, ?, ?)');
        $insertAnimal ->execute(array($nom_a, $race_a, $habitat_a, $description));
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="admin_style.css">
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
            </div>
        </div>
    </header>

    <main>
        <form method="POST" action="">
            <br />
            <p class="inline">Nom : </p><input type="text" name="nom_a" ><br /><br />
            <p class="inline">Race : </p><input type="text" name="race_a" ><br /><br />
            <p class="inline">habitat : </p><input type="text" name="habitat_a" ><br /><br />
            <p class="inline">Description : <textarea name="description"></textarea></p><br /><br />
            <input type="submit" name="envoi">
        </form>
    </main>
</body>
</html>
