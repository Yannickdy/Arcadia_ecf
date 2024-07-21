<?php 
session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = $_GET['id'];
        $recupUser = $bdd ->prepare('SELECT * FROM membres WHERE id = ?');
        $recupUser ->execute(array($getid));
        if($recupUser->rowCount() > 0){
            $bannirUser = $bdd ->prepare('DELETE FROM membres WHERE id = ?');
            $bannirUser->execute(array($getid));
            header('Location: admin.php');
            exit();
            
        } else{
            echo "Aucun membre n'a été trouvé";
        }

    }else{
        echo "L'identifiant n'a pas été récupéré";
    }

    ?>

