<?php   
require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../../../controler/meteoC.php');

try {
    $stmt = $pdo->query("SELECT id_zone FROM zone");
    $zones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $message = "Erreur lors de la récupération des zones : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temperature = $_POST['temperature'];
    $humidite = $_POST['humidite'];
    $vent = $_POST['vent'];
    $zone = $_POST['zone'];
    $date = $_POST['date']; // Nouveau champ date
    $heure = $_POST['heure']; // Nouveau champ time

    try {
        // Appel de la fonction avec les nouveaux paramètres date et time
        createmeteo( $temperature, $humidite, $vent, $zone, $date, $heure);
        header("Location: listesmeteo.php");
        exit();
    } catch (Exception $e) {
        $message = "Erreur lors de l'insertion de la météo : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Météo</title>
    <script>
        function validateForm(event) {
            const temperature = parseFloat(document.getElementById('temperature').value);
            const humidite = parseFloat(document.getElementById('humidite').value);
            const vent = parseFloat(document.getElementById('vent').value);
            const zone = document.getElementById('zone').value;
            const date = document.getElementById('date').value; // Champ date
            const time = document.getElementById('time').value; // Champ time

            let errorMessage = "";

            if (isNaN(temperature) || temperature < -50 || temperature > 60) {
                errorMessage += "La température doit être comprise entre -50°C et 60°C.\n";
            }

            if (isNaN(humidite) || humidite < 0 || humidite > 100) {
                errorMessage += "L'humidité doit être comprise entre 0% et 100%.\n";
            }

            if (isNaN(vent) || vent < 0 || vent > 300) {
                errorMessage += "La vitesse du vent doit être comprise entre 0 km/h et 300 km/h.\n";
            }

            if (!zone) {
                errorMessage += "Veuillez sélectionner une zone.\n";
            }

            if (!date) {
                errorMessage += "Veuillez sélectionner une date valide.\n";
            }

            if (!heure) {
                errorMessage += "Veuillez sélectionner une heure valide.\n";
            }

            if (errorMessage) {
                alert(errorMessage);
                event.preventDefault();
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            form.addEventListener('submit', validateForm);
        });
    </script>
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
form select, 
form button {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 16px;
}

form input:focus, 
form select:focus, 
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

.error {
    color: red;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
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
    height: 100vh; /* La sidebar occupe toute la hauteur */
    position: fixed; /* Elle reste fixe pendant le défilement */
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
}

/* Header */
header h2 {
    font-size: 28px;
    color: #004d40;
    text-align: center;
    margin-bottom: 20px;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
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
            <li><a href="#user-management">Gestion des Utilisateurs</a></li>
            <li><a href="#alerts">Alertes</a></li>
            <li><a href="#forum">Forum</a></li>
            <li><a href="#blog">Blog</a></li>
            <li><a href="#feedback">Feedback</a></li>
            <li><a href="#marketplace">Marketplace</a></li>
        </ul>
    </nav>
</aside>


<main>
<header>
    <h2>Créer une Météo</h2>
</header>

    <?php if (isset($message)): ?>
        <p class="error"><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" action="createmeteo.php">
        <label for="temperature">Température (°C)</label>
        <input type="number" step="0.1" name="temperature" id="temperature" required>

        <label for="humidite">Humidité (%)</label>
        <input type="number" step="0.1" name="humidite" id="humidite" required>

        <label for="vent">Vitesse du vent (km/h)</label>
        <input type="number" step="0.1" name="vent" id="vent" required>

        <label for="zone">Zone</label>
        <select name="zone" id="zone" required>
            <option value="" disabled selected>Sélectionnez une zone</option>
            <?php foreach ($zones as $zone): ?>
                <option value="<?= htmlspecialchars($zone['id_zone']); ?>">
                    <?= htmlspecialchars($zone['id_zone']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        
        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>

        
        <label for="heure">Heure</label>
        <input type="time" name="heure" id="heure" required>

        <button type="submit">Créer</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 AgroXpert</p>
</footer>

</body>
</html>
