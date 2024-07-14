<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['identifiant']) || empty($_SESSION['identifiant'])) {
    header("Location: connexion.php");
    exit;
}

// Vérifier si l'utilisateur a le droit de supprimer un animal
if($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'veterinaire') {
    echo "Vous n'avez pas les droits nécessaires pour accéder à cette page.";
    exit;
}

if(isset($_POST['animal_id'])) {
    $animalID = $_POST['animal_id'];

    // Supprimer l'animal de la base de données
    $supprimerAnimal = $bdd->prepare('DELETE FROM animaux WHERE id = ?');
    $supprimerAnimal->execute(array($animalID));

    // Rediriger vers la page des animaux après la suppression
    header("Location: animaux.php");
    exit;
} else {
    echo "ID d'animal non spécifié.";
    exit;
}
?>
