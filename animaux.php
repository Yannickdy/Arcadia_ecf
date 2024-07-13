<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['identifiant']) || empty($_SESSION['identifiant'])) {
    // Rediriger vers la page de connexion si non connecté
    header("Location: connexion.php");
    exit;
}

// Vérifier si l'utilisateur a le droit d'ajouter un animal
if($_SESSION['role'] !== 'admin') {
    // Rediriger ou afficher un message d'erreur si l'utilisateur n'est pas administrateur
    echo "Vous n'avez pas les droits nécessaires pour accéder à cette page.";
    exit;
}

$nouvelAnimalAjoute = false;

if(isset($_POST['envoi'])){
    if(!empty($_POST['nom_a']) AND !empty($_POST['race_a']) AND !empty($_POST['habitat_a']) AND !empty($_POST['description'])){
        $nom_a = htmlspecialchars($_POST['nom_a']);
        $race_a = htmlspecialchars($_POST['race_a']);
        $habitat_a = htmlspecialchars($_POST['habitat_a']);
        $description = nl2br(htmlspecialchars($_POST['description']));
        
        // Gestion de l'upload d'image
        if(isset($_FILES['image_a']) && $_FILES['image_a']['error'] === UPLOAD_ERR_OK) {
            $image_a = $_FILES['image_a'];
            $imageFileName = uploadImage($image_a);
            
            if($imageFileName !== null) {
                // Insérer l'animal dans la base de données avec l'image
                $ajoutAnimal = $bdd->prepare('INSERT INTO animaux(nom_a, race_a, habitat_a, description, image_a) VALUES(?, ?, ?, ?, ?)');
                $ajoutAnimal->execute(array($nom_a, $race_a, $habitat_a, $description, $imageFileName));
                
                // Marquer que le nouvel animal a été ajouté avec succès
                $nouvelAnimalAjoute = true;
            } else {
                echo "Erreur lors de l'upload de l'image.";
            }
        } else {
            echo "Erreur lors de l'upload de l'image.";
        }
    }
}

// Fonction pour gérer l'upload d'image
function uploadImage($image) {
    $targetDir = "./images/";
    $targetFile = $targetDir . basename($image['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $newFileName = uniqid() . "." . $imageFileType;

    if(move_uploaded_file($image['tmp_name'], $targetDir . $newFileName)) {
        return $newFileName;
    } else {
        return null;
    }
}

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
// Récupérer tous les animaux depuis la base de données
$requeteAnimaux = $bdd->query('SELECT * FROM animaux');
$animaux = $requeteAnimaux->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="animaux-style.css">
    <title>Animaux</title>
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
        <div class="animauxgrid">
            <!-- Affichage de tous les animaux -->
            <?php foreach($animaux as $animal): ?>
            <div class="animal">
                <?php if(isset($animal['image_a']) && !empty($animal['image_a'])): ?>
                <img src="./images/<?php echo htmlspecialchars($animal['image_a']); ?>" alt="<?php echo htmlspecialchars($animal['race_a']); ?>">
                <?php else: ?>
                <img src="./images/default.jpg" alt="Image par défaut">
                <?php endif; ?>
                <ul>
                <li><strong>Nom :</strong> <?php echo htmlspecialchars($animal['nom_a']); ?></li>
                <li><strong>Race :</strong> <?php echo htmlspecialchars($animal['race_a']); ?></li>
                <li><strong>Habitat :</strong> <?php echo htmlspecialchars($animal['habitat_a']); ?></li>
                <li><strong>Description :</strong> <?php echo nl2br(htmlspecialchars($animal['description'])); ?></li>
                </ul>
                <?php if($_SESSION['role'] !== 'admin' || $_SESSION['role'] !== 'veterinaire'): ?>

                <!-- Bouton de modification -->
                <form method="GET" action="modifier_animal.php">
                    <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                    <input type="submit" name="modifier" value="Modifier">
                </form>
                <!-- Bouton de suppression -->
                <form method="POST" action="supprimer_animal.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">
                    <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                    <input type="submit" name="supprimer" value="Supprimer">
                </form>
                <?php endif; ?>
            </div>

            <?php endforeach; ?>

            <!-- Formulaire d'ajout d'animal -->
            <div class="ajout_animal">
                <h2>Ajouter un animal</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                    <p><label>Nom : </label><input type="text" name="nom_a"></p>
                    <p><label>Race : </label><input type="text" name="race_a"></p>
                    <label for="role-select">Habitat :</label>
                    <select id="role-select" name="habitat_a">
                        <option value="">--Veuillez choisir une option--</option>
                        <option value="savane">Savane</option>
                        <option value="prairie">Prairie</option>
                        <option value="toundra">Toundra</option>
                        <option value="foret">Forêt</option>
                    </select>
                    <p><label>Description : </label><textarea name="description"></textarea></p>
                    <p><label>Image : </label><input type="file" name="image_a"></p>
                    <input type="submit" name="envoi" value="Ajouter">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
