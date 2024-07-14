<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['identifiant']) || empty($_SESSION['identifiant'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: connexion.php");
    exit;
}

// Récupérer le rôle de l'utilisateur depuis la session
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Vérifier si l'utilisateur a le droit de modifier un animal
if($role !== 'admin' && $role !== 'veterinaire') {
    // Rediriger ou afficher un message d'erreur si l'utilisateur n'est ni administrateur ni vétérinaire
    echo "Vous n'avez pas les droits nécessaires pour accéder à cette page.";
    exit;
}

// Vérifier si l'identifiant de l'animal à modifier est passé en paramètre
if(!isset($_GET['animal_id']) || empty($_GET['animal_id'])) {
    echo "Identifiant d'animal non spécifié.";
    exit;
}

$animal_id = $_GET['animal_id'];

// Récupérer les informations de l'animal à modifier depuis la base de données
$requeteAnimal = $bdd->prepare('SELECT * FROM animaux WHERE id = ?');
$requeteAnimal->execute(array($animal_id));
$animal = $requeteAnimal->fetch(PDO::FETCH_ASSOC);

if(!$animal) {
    echo "Animal non trouvé.";
    exit;
}

// Si un formulaire de modification est soumis
if(isset($_POST['modification'])) {
    // Récupérer les données soumises
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
        </div>
    </main>
</body>
</html>
