<?php 
require_once(__DIR__ . '/../../../controler/zoneC.php');
require_once(__DIR__ . '/../../../config.php');

if (isset($_GET['id_zone'])) {
    $id_zone = $_GET['id_zone'];

    // Fetch the current zone data
    try {
        global $pdo; // Make sure $pdo is available
        $stmt = $pdo->prepare("SELECT * FROM zone WHERE id= :id_zone");
        $stmt->bindParam(':id_zone', $id_zone, PDO::PARAM_INT);
        $stmt->execute();
        $zone = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$zone) {
            $errorMessage = "Zone not found.";
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_zone = $_POST['id_zone'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $altitude = $_POST['altitude'];
    $longitude = $_POST['longitude'];

    try {
        if (updatezone($pdo, $id_zone, $nom, $description, $altitude, $longitude)) {
            echo "Zone updated successfully!";
        } else { 
            echo "Error updating zone.";
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Zone</title>
</head>
<body>
    <h1>Update Zone</h1>

    <!-- Formulaire de mise à jour -->
    <form method="POST" action="">
        <input type="hidden" name="id_zone" value="<?php echo htmlspecialchars($id_zone); ?>">

        <label for="nom">Zone Name:</label><br>
        <!-- Pré-remplir les champs avec les valeurs actuelles de la zone -->
        <input type="text" id="nom" name="nom" value="" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="latitude">Latitude:</label><br>
        <input type="text" id="latitude" name="latitude" value="" required><br><br>

        <label for="longitude">Longitude:</label><br>
        <input type="text" id="longitude" name="longitude" value="" required><br><br>

        <button type="submit" name="update">Update Zone</button>
    </form>
    
</body>
<style>
 /* Votre style CSS ici */
</style>
</html>
