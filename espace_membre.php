<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=zoo;charset=utf8;', 'root', '');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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