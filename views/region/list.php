<?php
$host = "tcp:mini-pojet-serveur.database.windows.net,1433";
$db_name = "societe";
$username = "guetari";
$password = "VERYnice7*";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);


$query = "SELECT ID_region, libelle FROM region";
$stmt = $conn->query($query);
$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La liste des regions</title>
    <link rel="stylesheet" href="../../public/styles/index.css">
</head>
<body>
    <h1>La liste des regions</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du région</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($regions as $region): ?>
                <tr>
                    <td><?= $region['ID_region']; ?></td>
                    <td><?= $region['libelle']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="../client/list.php">Revenir a la liste des clients</a>
</body>
</html>