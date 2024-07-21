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

// Vérifier que l'utilisateur est connecté et a les droits nécessaires
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'veterinaire')) {
    header('Location: index.php');
    exit();
}

// Vérifier si l'ID de l'information vétérinaire est fourni
if (isset($_POST['info_veto_id'])) {
    $info_veto_id = intval($_POST['info_veto_id']);
    
    // Supprimer l'information vétérinaire
    $requete = $bdd->prepare('DELETE FROM info_veterinaire WHERE id = ?');
    $requete->execute([$info_veto_id]);
    
    header('Location: veterinaire.php');
    exit();
} else {
    header('Location: veterinaire.php');
    exit();
}
?>
