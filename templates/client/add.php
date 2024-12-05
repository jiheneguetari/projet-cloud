<?php

$host = "tcp:mini-pojet-serveur.database.windows.net,1433";
$db_name = "societe";
$username = "guetari";
$password = "VERYnice7*";

try {
    $conn = new PDO(
        "sqlsrv:server=" . $host . ";Database=" . $db_name . ";Encrypt=true;TrustServerCertificate=false",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];

    $query = "INSERT INTO client (nom, prenom, age, ID_region) VALUES (:nom, :prenom, :age, :ID_region)";
    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':age' => $age,
            ':ID_region' => $ID_region
        ]);

        header('Location: list.php');
        exit();
    } catch (PDOException $e) {
        echo "Error adding client: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
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
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #47506d;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        label {
            font-size: 16px;
            color: #333;
            text-align: left;
            width: 100%;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 20px;
            display: inline-block;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Client</h1>
        <form action="add.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="age">Âge:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="ID_region">Région:</label>
                <select id="ID_region" name="ID_region" required>
                    <?php
                    $regionsQuery = "SELECT ID_region, libelle FROM region";
                    $regionsStmt = $conn->query($regionsQuery);
                    while ($region = $regionsStmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=\"{$region['ID_region']}\">{$region['libelle']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Ajouter</button>
        </form>
        <a href="list.php">Retour à la liste</a>
    </div>
</body>
</html>
