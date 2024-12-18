<?php

require_once (__DIR__ . '/../config.php' );


// zoneC.php


// zoneC.php

// Récupérer toutes les zones
function fetchZones($db) {
    $query = "SELECT * FROM zone";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchZoneById($db, $id_zone) {
    $sql = "SELECT * FROM zone WHERE id_zone = :id_zone";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_zone', $id_zone, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteZone($db, $id_zone) {
    $sql = "DELETE FROM zone WHERE id_zone = :id_zone";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_zone', $id_zone, PDO::PARAM_INT);
    return $stmt->execute();
}
// Mettre à jour une zone
function updateZone($db, $id_zone, $nom, $description, $altitude, $longitude) {
    $query = "UPDATE zone SET nom = :nom, description = :description, altitude = :altitude, longitude = :longitude WHERE id_zone = :id_zone";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_zone', $id_zone, PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':altitude', $altitude, PDO::PARAM_STR);
    $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    return $stmt->execute();
}



function createZone($nom, $description, $altitude, $longitude) {
    global $pdo; // Utiliser la variable $pdo définie dans config.php

    if (!$pdo) {
        throw new Exception("Connexion à la base de données non initialisée.");
    }

    try {
        $sql = "INSERT INTO zone (nom, description, altitude, longitude) VALUES (:nom, :description, :altitude, :longitude)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':altitude' => $altitude,
            ':longitude' => $longitude,
        ]);
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'insertion : " . $e->getMessage());
    }
}
?>