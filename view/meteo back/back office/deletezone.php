<?php
require_once(__DIR__ . '/../../../controler/zoneC.php');
require_once(__DIR__ . '/../../../config.php');

// Initialiser $message
$message = '';

// Vérifier si l'ID de la météo est passé dans l'URL
if (isset($_GET['id_zone']) && !empty($_GET['id_zone'])) {
    $id_zone = (int)$_GET['id_zone'];
    try {
        if (deleteZone($db, $id_zone)) {
            header("Location: zonelist.php?message=zone supprimée avec succès");
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
    <title>Suppression zone</title>
</head>
<body>
    <h1>Suppression d'une zone</h1>
    <?php if (!empty($message)) : ?>
        <p><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <a href="zonelist.php">Retour à la liste des zones</a>
</body>
</html>
