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

    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $recupID = $_GET['id'];
        $recupUser = $bdd ->prepare('SELECT * FROM membres WHERE id = ?');
        $recupUser ->execute(array($recupID));
        if($recupUser->rowCount() > 0){
            $bannirUser = $bdd ->prepare('DELETE FROM membres WHERE id = ?');
            $bannirUser->execute(array($recupID));
            header('Location: admin.php');
            exit();
            
        } else{
            echo "Aucun membre n'a été trouvé";
        }

    }else{
        echo "L'identifiant n'a pas été récupéré";
    }

    ?>

