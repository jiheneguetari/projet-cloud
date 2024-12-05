<?php

$host = "tcp:mini-pojet-serveur.database.windows.net,1433";
$db_name = "societe";
$username = "guetari";
$password = "VERYnice7*";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);


$clients = [];
$searchQuery = "";


if (isset($_GET['search'])) {
    
    $searchQuery = "%" . $_GET['search'] . "%"; 
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region 
            WHERE c.nom LIKE ? OR c.prenom LIKE ?";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchQuery, $searchQuery]); 
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region";
    

    $stmt = $conn->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Clients</title>
</head>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9fffa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            width: 80%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #47506d;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        input[type="text"] {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions a {
            margin: 0 5px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .actions a:hover {
            text-decoration: underline;
        }
    </style>
<div class="container">
    <body>
        <h1>Liste des Clients</h1>
        <a href="add.php">Add a client</a>
    
    <!-- Search Form -->
    <form method="GET" action="">
        <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Search by name">
        <button type="submit">Search</button>
        <button style="color: white; background-color: red" href="list.php">Clear</button> <!-- Clear search -->
    </form>

    <table >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Région</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client['ID_client'] ?></td>
                        <td><?= $client['nom'] ?></td>
                        <td><?= $client['prenom'] ?></td>
                        <td><?= $client['age'] ?></td>
                        <td><?= $client['region'] ?></td>
                        <td>
                            <a style="color: green; text-decoration: underline;"  href="edit.php?action=editClient&id=<?= $client['ID_client'] ?>">Modifier</a>
                            <a style="color: red; text-decoration: underline;" href="delete.php?action=deleteClient&id=<?= $client['ID_client'] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No clients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a style="color:#505050; text-decoration: underline;" href="../../home.php">Back to Home</a>
            </div>
</body>
</html>