<?php   
require_once(__DIR__ . '/../../../config1.php');
require_once(__DIR__ . '/../../../controller/zoneC.php');
$successMessage = "";
$errorMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $altitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);

    // Validation côté serveur
    if (strlen($nom) < 3 || strlen($description) < 10 || $altitude < -90 || $altitude > 90 || $longitude < -180 || $longitude > 180) {
        $errorMessage = "Données invalides. Veuillez vérifier les champs.";
    } else {
        try {
            // Insertion dans la base de données
            $query = "INSERT INTO zone (nom, description, altitude, longitude) VALUES (:nom, :description, :altitude, :longitude)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':nom' => $nom,
                ':description' => $description,
                ':altitude' => $altitude,
                ':longitude' => $longitude
            ]);
            header("Location: zonelist.php");
            $successMessage = "Zone ajoutée avec succès.";
        } catch (Exception $e) {
            $errorMessage = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}

// Récupérer toutes les zones existantes pour les afficher
try {
    $query = "SELECT * FROM zone";
    $stmt = $pdo->query($query);
    $zones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $errorMessage = "Erreur lors de la récupération des zones : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroXpert - Créer une Zone</title>
    <style>
        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        form h2 {
            font-size: 24px;
            color: #004d40;
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        form input,
        form textarea,
        form button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        form input:focus,
        form textarea:focus,
        form button:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        form button {
            background-color: #26a69a;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background-color: #004d40;
        }

        .success, .error {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #004d40;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #b2dfdb;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin-bottom: 15px;
        }

        .sidebar nav ul li a {
            text-decoration: none;
            color: #e0f2f1;
            font-size: 18px;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .sidebar nav ul li a:hover {
            background: #26a69a;
            transform: translateX(10px);
        }

        /* Main content adjustment */
        main {
            flex: 1;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            margin-left: 250px;
        }

        /* Header */
        header h1 {
            font-size: 28px;
            color: #004d40;
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px; /* Ajustez la hauteur selon vos besoins */
        }
        

        /* Footer */
        footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #666;
            background: #e0f7fa;
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <h2>Mon Dashboard</h2>
    <nav>
        <ul>
        <li><a href="../user/gestion.php">Gestion de Compte</a></li>
                    <li><a href="../marketplace/productList.php">Gestion de Market</a></li>
                    <li><a href="../mimi/bloglist.php">Gestion de Blog</a></li>
                    <li><a href="listesmeteo.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="../backreclamation&reponse/admin.php">Gestion de Feedback</a></li>
        </ul>
    </nav>
</aside>

<main>
    <header>
        <h1>Back Office</h1>
    </header>

    <h2>Créer une Zone Agricole</h2>

    <form method="POST" action="">
        <h3>Veuillez remplir les informations ci-dessous</h3>

        <label for="nom">Nom:</label>
        <input type="text" name="nom" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="latitude">Latitude:</label>
        <input type="text" name="latitude" required>

        <label for="longitude">Longitude:</label>
        <input type="text" name="longitude" required>

        <button type="submit" name="add">Créer Zone</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 AgroXpert</p>
</footer>

</body>
</html>
