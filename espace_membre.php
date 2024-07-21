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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
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
                <?php if(isset($_SESSION['identifiant'])): ?>
                    <a href="staff.php">Employé</a>
                <?php endif; ?>
            </div>
            <div class="utilisateur">
                <?php if(isset($_SESSION['identifiant'])): ?>
                    Identifiant: <?= htmlspecialchars($_SESSION['identifiant']); ?> | Rôle: <?= htmlspecialchars($_SESSION['role']); ?>
                    <a href="deconnexion.php">Déconnexion</a>
                <?php else: ?>
                    <a href="connexion.php">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
   <!-- Link to Add User Page -->
   <a href="admin.php">Add New User</a>

<?php
// Assuming $bdd is your PDO instance
// Fetch data from the database
$recupUsers = $bdd->query('SELECT * FROM membres');
?>

<!-- Display the table -->
<table>
    <tr>
        <th>Identifiant</th>
        <th>Prénom</th>
        <th>Role</th>
    </tr>
    <?php while($user = $recupUsers->fetch()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($user['identifiant']); ?></td>
            <td><?php echo htmlspecialchars($user['prenom']); ?></td>
            <td><?php echo htmlspecialchars($user['role']); ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>