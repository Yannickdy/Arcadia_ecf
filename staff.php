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

$error_message = "";

if(isset($_POST['envoi'])) {
    if(!empty($_POST['identifiant']) AND !empty($_POST['mdp']) AND !empty($_POST['role']) AND !empty($_POST['prenom']) AND !empty($_POST['nom'])) {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mdp = sha1($_POST['mdp']);
        $role = htmlspecialchars($_POST['role']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        
        // Insérer l'utilisateur dans la base de données
        $insertUser = $bdd->prepare('INSERT INTO membres(identifiant, mdp, role, prenom, nom) VALUES(?, ?, ?, ?, ?)');
        if($insertUser->execute(array($identifiant, $mdp, $role, $prenom, $nom))) {
            // Récupérer l'utilisateur nouvellement inséré
            $recupUser = $bdd->prepare('SELECT * FROM membres WHERE identifiant = ? AND mdp = ? AND prenom = ? AND nom = ?');
            $recupUser->execute(array($identifiant, $mdp, $prenom, $nom));
            
            if($recupUser->rowCount() > 0) {
                $userInfo = $recupUser->fetch();
                $_SESSION['identifiant'] = $userInfo['identifiant'];
                $_SESSION['mdp'] = $userInfo['mdp'];
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['role'] = $userInfo['role'];
                $_SESSION['prenom'] = $userInfo['prenom'];
                $_SESSION['nom'] = $userInfo['nom'];
                // Rediriger l'utilisateur ou traiter les données ici
            } else {
                $error_message = "Utilisateur non trouvé après l'insertion.";
            }
        } else {
            $error_message = "Erreur lors de l'insertion de l'utilisateur.";
        }
    } else {
        $error_message = "Tous les champs doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="admin_style.css">
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
                <a href="staff.php">Employé</a> <br /><br />
                <?php endif; ?>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="admin.php">Espace Administrateur</a>
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

    <main>
        <?php
        if($error_message != "") {
            echo '<p style="color:red;">'.$error_message.'</p>';
        }
        ?>
        <form method="POST" action="">
            <p class="inline">Identifiant : </p><input type="text" name="identifiant" ><br />
            <p class="inline">Prenom : </p><input type="text" name="prenom" ><br />
            <p class="inline">Nom : </p><input type="text" name="nom" ><br />
            <p class="inline">Mot de passe : </p><input type="password" name="mdp" ><br />
            <label for="role-select">Rôle :</label>
            <select id="role-select" name="role">
                <option value="">--Veuillez choisir une option--</option>
                <option value="admin">Admin</option>
                <option value="employe">Employé</option>
                <option value="veterinaire">Vétérinaire</option>
            </select>
            <br />
            <input class="button" type="submit" name="envoi" value="Connexion" />
        </form>

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
                <th>Nom</th>
                <th>Role</th>
                <th>Supprimer un utilisateur</th>
            </tr>
            <?php while($user = $recupUsers->fetch()) { ?>
                <tr>
                    <td><?= htmlspecialchars($user['identifiant']); ?></td>
                    <td><?= htmlspecialchars($user['prenom']); ?></td>
                    <td><?= htmlspecialchars($user['nom']); ?></td> 
                    <td><?= htmlspecialchars($user['role']); ?></td> 
                    <td>
                        <a href="suppression.php?id=<?= $user['id']; ?>">
                            <p>Supprimer le compte</p>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>
