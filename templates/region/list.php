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

        h1 {
            color: #47506d;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            max-width: 800px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 20px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-data {
            text-align: center;
            font-size: 16px;
            color: #888;
            padding: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table {
                width: 90%;
            }

            th, td {
                padding: 8px 12px;
            }
        }
    </style>

</head>
<body>
    <h1>La liste des regions</h1>
    <table>
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