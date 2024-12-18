<?php
require_once(__DIR__ . '/../../../controler/meteoC.php');
require_once(__DIR__ . '/../../../config.php');

// Initialiser $message
$message = '';

// Vérifier si l'ID de la météo est passé dans l'URL
if (isset($_GET['id_meteo']) && !empty($_GET['id_meteo'])) {
    $id_meteo = (int)$_GET['id_meteo'];
    try {
        if (deleteMeteo($id_meteo)) {
            header("Location: listesmeteo.php?message=Météo supprimée avec succès");
            exit();
        } else {
            $message = "Erreur lors de la suppression de la météo.";
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
} 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression Météo</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

      
        .sidebar {
            width: 200px;
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin: 15px 0;
        }

        .sidebar nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar nav ul li a:hover {
            background-color: #45a049;
        }

     
        .content {
            margin-left: 270px;
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            color: white;
        }

        .update-btn {
            background-color: green;
        }

        .update-btn:hover {
            background-color: green;
        }

        .delete-btn {
            background-color: green;
        }

        .delete-btn:hover {
            background-color: green;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
        }

        input, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
        }

        .message {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }

        .add-btn {
            background-color: #28a745;
            padding: 10px 10px;
            color: white;
            border: none;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: #218838;
        }
        .title-container{
            text-align: center;
        }
    </style>
</head>
<body>
<aside class="sidebar">
    <h2>Mon Dashboard</h2>
    <nav>
        <ul>
            <li><a href="#user-management">Gestion des Utilisateurs</a></li>
            <li><a href="#alerts">Alertes</a></li>
            <li><a href="#forum">Forum</a></li>
            <li><a href="#blog">Blog</a></li>
            <li><a href="#feedback">Feedback</a></li>
            <li><a href="#marketplace">Marketplace</a></li>
        </ul>
    </nav>
</aside>
    <h1>Suppression d'une météo</h1>

    <?php if (!empty($message)) : ?>
        <p><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <a href="listesmeteo.php">Retour à la liste des météos</a>
    <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Température (°C)</th>
                    <th>Humidité (%)</th>
                    <th>Vent (km/h)</th>
                    <th>Zone </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
                    <tr>
                        <td><?= htmlspecialchars($meteo['id_meteo']); ?></td>
                        <td><?= htmlspecialchars($meteo['temperature']); ?></td>
                        <td><?= htmlspecialchars($meteo['humidite']); ?></td>
                        <td><?= htmlspecialchars($meteo['vent']); ?></td>
                        <td><?= htmlspecialchars($meteo['zone']); ?></td>
                        <td>
                            
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette météo ?');">
                                <input type="hidden" name="delete_id" value="">
                                <button class="delete-btn" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                
            </tbody>
        </table>
</body>
</html>
