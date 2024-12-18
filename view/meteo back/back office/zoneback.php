<?php
    require_once(__DIR__ . '/../../../controler/zoneC.php');
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroXpert - Zone Management</title>
     
</head>
<body>

    <header>
        <h1>Zone Management</h1>
    </header>

    <main>
        <h2>Zones Agricoles</h2>

        
        <form action="createzone.php" method="POST">
            <h3>créer une Zone</h3>
            <label for="nom">Nom:</label>
            <input type="text" name="nom" required>
            
            <label for="description">Description:</label>
            <textarea name="description" required></textarea>
            
            <label for="altitude">altitude:</label>
            <input type="text" name="latitude" required>
            
            <label for="longitude">Longitude:</label>
            <input type="text" name="longitude" required>
            
            <button type="submit" name="add">creer Zone</button>
        </form>

        
        <h3>Liste des Zones</h3>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($zones)): ?>
                    <?php foreach ($zones as $zone): ?>
                        <tr>
                            <td><?= htmlspecialchars($zone['nom']); ?></td>
                            <td><?= htmlspecialchars($zone['description']); ?></td>
                            <td><?= htmlspecialchars($zone['latitude']); ?></td>
                            <td><?= htmlspecialchars($zone['longitude']); ?></td>
                            <td>
                                
                                <form action="updatezone.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="zone_id" value="<?= $zone['id']; ?>">
                                    <input type="text" name="nom" value="<?= $zone['nom']; ?>" required>
                                    <textarea name="description" required><?= $zone['description']; ?></textarea>
                                    <input type="text" name="latitude" value="<?= $zone['latitude']; ?>" required>
                                    <input type="text" name="longitude" value="<?= $zone['longitude']; ?>" required>
                                    <button type="submit" name="update">Mettre à jour</button>
                                </form>
                                
                                <form action="deletezone.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="zone_id" value="<?= $zone['id']; ?>">
                                    <button type="submit" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette zone ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Aucune zone trouvée</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <style>
           
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    color: #333;
    line-height: 1.6;
}


header {
    background-color: green;
    color: white;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin: 0;
    font-size: 36px;
}


main {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}


form {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

form h3 {
    font-size: 24px;
    margin-bottom: 20px;
}

form label {
    font-size: 16px;
    margin-bottom: 5px;
    display: block;
}

form input[type="text"], form textarea {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form textarea {
    height: 100px;
    resize: vertical;
}

form button {
    background-color: green;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #2ecc71;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

table th {
    background-color: green;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table td button {
    background-color: green;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

table td button:hover {
    background-color: green;
}


footer {
    background-color: green;
    color: white;
    padding: 10px;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer p {
    margin: 0;
}


@media (max-width: 768px) {
    form {
        padding: 15px;
    }

    form button {
        font-size: 14px;
        padding: 8px 16px;
    }

    table th, table td {
        font-size: 14px;
        padding: 8px;
    }
}

@media (max-width: 480px) {
    header h1 {
        font-size: 28px;
    }

    form input[type="text"], form textarea {
        font-size: 14px;
        padding: 8px;
    }

    table th, table td {
        font-size: 12px;
    }

    table td button {
        font-size: 12px;
        padding: 6px 10px;
    }
}

        </style>
    </main>


    <footer>
        <p>&copy; 2024 AgroXpert</p>
    </footer>

</body>
</html>
