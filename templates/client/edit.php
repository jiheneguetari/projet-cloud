<?php
$host = "tcp:mini-pojet-serveur.database.windows.net,1433";
$db_name = "societe";
$username = "guetari";
$password = "VERYnice7*";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);

$id = $_GET['id'] ?? null;
if ($id) {
    $query = "SELECT * FROM client WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];
    $query = "UPDATE client SET nom = ?, prenom = ?, age = ?, ID_region = ? WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$nom, $prenom, $age, $ID_region, $_POST['id']])) {
        header('Location: list.php');
        exit();
    } else {
        echo "Error updating client.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Client</title>
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

        h2 {
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

    <h2>Edit Client</h2>
    <?php if ($client): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $client['ID_client'] ?>">
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= $client['nom'] ?>"><br>
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?= $client['prenom'] ?>"><br>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" value="<?= $client['age'] ?>"><br>
        </div>  

        <div class="form-group">
            <label>Région</label>
            <select name="ID_region">
                <?php
                $regions = $conn->query("SELECT ID_region, libelle FROM region");
                while ($region = $regions->fetch(PDO::FETCH_ASSOC)) {
                    $selected = $region['ID_region'] == $client['ID_region'] ? 'selected' : '';
                    echo "<option value='{$region['ID_region']}' $selected>{$region['libelle']}</option>";
                }
                ?>
            </select><br>
        </div>
            <button type="submit">Update</button>
        </form>
    <?php else: ?>
        <p>Client not found.</p>
    <?php endif; ?>
    <a style="text-decoration: underline;" href="list.php">Back to List</a>
    </div>
</body>
</html>