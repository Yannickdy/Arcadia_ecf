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

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['identifiant']) || empty($_SESSION['identifiant'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: connexion.php");
    exit;
}

// Vérifier si l'utilisateur a le droit de modifier un animal
if($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'veterinaire') {
    // Rediriger ou afficher un message d'erreur si l'utilisateur n'est pas autorisé
    echo "Vous n'avez pas les droits nécessaires pour accéder à cette page.";
    exit;
}

// Récupérer les informations de l'animal à modifier
$modifAnimal = null;
if(isset($_GET['animal_id'])) {
    $animalID = $_GET['animal_id'];
    $requeteAnimal = $bdd->prepare('SELECT * FROM animaux WHERE id = ?');
    $requeteAnimal->execute(array($animalID));
    $modifAnimal = $requeteAnimal->fetch(PDO::FETCH_ASSOC);
    
    if(!$modifAnimal) {
        echo "Animal non trouvé.";
        exit;
    }
} else {
    echo "ID d'animal non spécifié.";
    exit;
}

// Vérifier si un formulaire de modification a été soumis
if(isset($_POST['modification'])) {
    // Récupérer les données soumises
    $animal_id = $_POST['animal_id'];
    $nom_a = htmlspecialchars($_POST['nom_a']);
    $race_a = htmlspecialchars($_POST['race_a']);
    $habitat_a = htmlspecialchars($_POST['habitat_a']);
    $description = nl2br(htmlspecialchars($_POST['description']));

    // Mettre à jour l'animal dans la base de données
    $updateAnimal = $bdd->prepare('UPDATE animaux SET nom_a = ?, race_a = ?, habitat_a = ?, description = ? WHERE id = ?');
    $updateAnimal->execute(array($nom_a, $race_a, $habitat_a, $description, $animal_id));

    // Redirection vers la page principale après la modification
    header("Location: animaux.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="animaux-style.css">
    <title>Modifier Animal</title>
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
                <a href="contact.php">Contact</a>
            </div>
            <div class="utilisateur">
                <?php 
                // Afficher l'identifiant de l'utilisateur et son rôle
                echo "Identifiant: " . htmlspecialchars($_SESSION['identifiant']) . " | Rôle: " . htmlspecialchars($_SESSION['role']);
                ?>
                <a href="deconnexion.php">Déconnexion</a>
            </div>
        </div>
    </header>

    <main>
        <div class="modifier_animal">
<<<<<<< HEAD
            <h2>Modifier l'animal</h2>
            <?php if($modifAnimal): ?>
            <form method="POST" action="">
                <input type="hidden" name="animal_id" value="<?php echo $modifAnimal['id']; ?>">
                <p><label>Nom : </label><input type="text" name="nom_a" value="<?php echo htmlspecialchars($modifAnimal['nom_a']); ?>"></p>
                <p><label>Race : </label><input type="text" name="race_a" value="<?php echo htmlspecialchars($modifAnimal['race_a']); ?>"></p>
                <p><label>Habitat : </label><input type="text" name="habitat_a" value="<?php echo htmlspecialchars($modifAnimal['habitat_a']); ?>"></p>
                <p><label>Description : </label><textarea name="description"><?php echo htmlspecialchars($modifAnimal['description']); ?></textarea></p>
                <input type="submit" name="modification" value="Enregistrer les modifications">
            </form>
            <?php endif; ?>
=======
            <h2>Modifier un animal</h2>
            <form method="POST" action="">
                <p><label>Nom : </label><input type="text" name="nom_a" value="<?php echo htmlspecialchars($animal['nom_a']); ?>"></p>
                <p><label>Race : </label><input type="text" name="race_a" value="<?php echo htmlspecialchars($animal['race_a']); ?>"></p>
                Habitat :
                <select id="role-select" name="habitat_a">
                    <option value="">--Veuillez choisir une option--</option>
                    <option value="Savane" <?php if($animal['habitat_a'] == 'Savane') echo 'selected'; ?>>Savane</option>
                    <option value="Prairie" <?php if($animal['habitat_a'] == 'Prairie') echo 'selected'; ?>>Prairie</option>
                    <option value="Foret" <?php if($animal['habitat_a'] == 'Foret') echo 'selected'; ?>>Foret</option>
                    <option value="Toundra" <?php if($animal['habitat_a'] == 'Toundra') echo 'selected'; ?>>Toundra</option>
                </select>
                <p><label>Description : </label><textarea name="description"><?php echo htmlspecialchars($animal['description']); ?></textarea></p>
                <input type="submit" name="modification" value="Modifier">
            </form>
>>>>>>> dev
        </div>
    </main>
</body>
</html>
