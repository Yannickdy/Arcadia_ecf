<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8', 'root', '');

// Vérifier si l'utilisateur est connecté et a le rôle admin
if (!isset($_SESSION['identifiant']) || empty($_SESSION['identifiant']) || $_SESSION['role'] !== 'admin') {
    // Rediriger vers la page de connexion si non connecté ou non admin
    header("Location: connexion.php");
    exit;
}

// Traitement de l'ajout des informations vétérinaires
if (isset($_POST['envoi_compte_rendu'])) {
    $animal_id = $_POST['animal_id'];
    $etat_animal = htmlspecialchars($_POST['etat_animal']);
    $nourriture = htmlspecialchars($_POST['nourriture']);
    $g_nourriture = htmlspecialchars($_POST['g_nourriture']);
    $date_passage = htmlspecialchars($_POST['date_passage']);
    $detail_animal = nl2br(htmlspecialchars($_POST['detail_animal']));

    // Insertion des informations dans la table info_veterinaire
    $insertInfoVeto = $bdd->prepare('INSERT INTO info_veterinaire (animal_id, etat_animal, nourriture, g_nourriture, date_passage, detail_animal) VALUES (?, ?, ?, ?, ?, ?)');
    $insertInfoVeto->execute([$animal_id, $etat_animal, $nourriture, $g_nourriture, $date_passage, $detail_animal]);

    // Redirection vers la page précédente après l'insertion
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
?>
