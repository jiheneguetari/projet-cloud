<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients en Tunisie</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #dafef5; /* Fond rose */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 40px;
            max-width: 400px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .nav a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav a:hover {
            background-color: #0056b3;
        }

        
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Clients en Tunisie</h1>
        <p>Veuillez selectionner une option</p>
        
        <div class="nav">
            <a href="./templates/client/list.php">Gerer les Clients</a>
            <a href="./templates/region/list.php">Liste des Regions</a>
        </div>
    </div>
</body>
</html>
