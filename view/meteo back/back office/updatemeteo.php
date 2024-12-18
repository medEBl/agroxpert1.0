<?php
require_once(__DIR__ . '/../../../controler/meteoC.php');

$id_meteo = isset($_GET['id_meteo']) ? (int)$_GET['id_meteo'] : null;
if (!$id_meteo) {
    die('ID météo non fourni.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temperature = $_POST['temperature'];
    $humidite = $_POST['humidite'];
    $vent = $_POST['vent'];
    $zone = $_POST['zone'];

    try {
        if (updatemeteo($id_meteo, $temperature, $humidite, $vent, $zone,$date,$heure)) {
            $message = "Météo mise à jour avec succès !";
        } else {
            $message = "Erreur lors de la mise à jour.";
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}

// Récupérer les données actuelles de la météo
$meteos = fetchMeteos();
$meteo = array_filter($meteos, fn($m) => $m['id_meteo'] == $id_meteo)[0];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour Météo</title>
</head>
<body>
    <h1>Mettre à jour la météo</h1>
    <?php if (isset($message)) : ?>
        <p><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Température (°C):</label>
        <input type="number" step="0.1" name="temperature" value="<?= htmlspecialchars($meteo['temperature']); ?>" required>

        <label>Humidité (%):</label>
        <input type="number" step="0.1" name="humidite" value="<?= htmlspecialchars($meteo['humidite']); ?>" required>

        <label>Vent (km/h):</label>
        <input type="number" step="0.1" name="vent" value="<?= htmlspecialchars($meteo['vent']); ?>" required>

        <label>Zone (ID):</label>
        <input type="number" name="zone" value="<?= htmlspecialchars($meteo['zone']); ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>
    
</body>
</html>
