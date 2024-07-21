<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact Zoo</title>
    <link rel="stylesheet" href="all.css">
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
    
    <main>
    <div class="d1"></div>
    <h2>Contactez-nous</h2>

    <?php
    // Vérification et traitement de l'envoi du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connexion à la base de données avec PDO
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8', 'root', '');
$bdd = new PDO('mysql:host=gi6kn64hu98hy0b6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=xbjwdvj3c34v3ay1;charset=utf8', 'fuxskjz01kufr48u', 'n5hb6h44og7ij4yc');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        // Récupération des données du formulaire
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $email = htmlspecialchars($_POST['email']);

        // Insertion des données dans la table demandes_contact
        $insertContact = $bdd->prepare('INSERT INTO contact (titre, description, email) VALUES (?, ?, ?)');
        $insertContact->execute(array($titre, $description, $email));

        // Email de réception au zoo
        $to = 'email_du_zoo@example.com';
        $subject = 'Nouvelle demande de contact depuis le site';
        $message = "Titre : $titre\n\n";
        $message .= "Description :\n$description\n\n";
        $message .= "Email du visiteur : $email";

        // En-têtes du mail
        $headers = "From: $email\r\nReply-To: $email\r\n";

        // Envoi du mail
        if (mail($to, $subject, $message, $headers)) {
            echo "<p>Votre demande a été envoyée avec succès. Nous vous répondrons dès que possible.</p>";
        } else {
            echo "<p>Erreur lors de l'envoi de votre demande. Veuillez réessayer plus tard.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>Titre :</p> <input type="text" name="titre" required><br />
        <p>Description :</p> <textarea name="description" required></textarea><br /><br />
        <p>Votre Email :</p> <input type="email" name="email" required><br /><br />
        <input type="submit" name="submit" value="Envoyer">
    </form>
    </main>
</body>
</html>
