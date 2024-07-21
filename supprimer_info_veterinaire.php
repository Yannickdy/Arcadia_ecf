<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8', 'root', '');

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
