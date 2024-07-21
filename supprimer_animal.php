<?php
session_start();
try {
    // Tentative de connexion à la première base de données locale
    $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

    try {
        // Tentative de connexion à la deuxième base de données distante
        $bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8;', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


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
