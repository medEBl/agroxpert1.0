<?php 
require_once(__DIR__ . '/../config.php');

function fetchMeteoById($id_meteo) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM meteo WHERE id_meteo = :id_meteo");
    $stmt->execute([':id_meteo' => $id_meteo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchMeteos() {
    global $pdo; 
    try {
        $stmt = $pdo->prepare("SELECT * FROM meteo");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la récupération des données météo : " . $e->getMessage());
    }
}

function createmeteo($temperature, $humidite, $vent, $zone, $date, $heure) {
    global $pdo;

    try {
        $sql = "
            INSERT INTO meteo (temperature, humidite, vent, zone, date, heure) 
            VALUES (:temperature, :humidite, :vent, :zone, :date, :heure )
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':temperature' => $temperature,
            ':humidite' => $humidite,
            ':vent' => $vent,
            ':zone' => $zone,
            ':date' => $date,
            ':heure' => $heure,
        ]);
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'insertion : " . $e->getMessage());
    }
}



/**
 * Fonction pour mettre à jour une météo existante.
 */
function updatemeteo($id_meteo, $temperature, $humidite, $vent, $zone, $date, $heure) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("
            UPDATE meteo 
            SET temperature = :temperature, 
                humidite = :humidite, 
                vent = :vent, 
                zone = :zone, 
                date = :date,
                heure = :heure,
                updated_at = NOW()  
            WHERE id_meteo = :id_meteo
        ");
        $stmt->execute([
            ':id_meteo' => $id_meteo,
            ':temperature' => $temperature,
            ':humidite' => $humidite,
            ':vent' => $vent,
            ':zone' => $zone,
            ':date' => $date,
            ':heure' => $heure,
        ]);
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la mise à jour des données météo : " . $e->getMessage());
    }
}
/**
 * Fonction pour supprimer une météo par ID.
 */
function deleteMeteo($id_meteo) {
    global $pdo; 
    try {
        $stmt = $pdo->prepare("DELETE FROM meteo WHERE id_meteo = :id_meteo");
        $stmt->execute([':id_meteo' => $id_meteo]);
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la suppression des données météo : " . $e->getMessage());
    }
}
function listemeteo() {
    global $db; // Assurez-vous que $db est défini

    $query = "SELECT * FROM meteo";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

    global $pdo;  // Utiliser la même connexion que pour les autres fonctions

    $query = "SELECT * FROM meteo";
    $stmt = $pdo->prepare($query);  // Utiliser $pdo ici aussi
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function fetchMeteoByCity($city) {
    global $pdo; // Connexion PDO

    try {
        $query = "SELECT * FROM meteo WHERE LOWER(zone) = LOWER(:city) LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->execute();

        // Débogage : Afficher un message si aucune donnée n'est trouvée
        if ($stmt->rowCount() === 0) {
            die("Aucune donnée trouvée pour la ville : " . htmlspecialchars($city));
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        throw new Exception("Erreur lors de la récupération des données météo : " . $e->getMessage());
    }
}
function getCurrentWeather($city) {
    $apiKey = 'meteo_projet'; // Remplacez par votre clé API OpenWeatherMap
    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=tunise" . urlencode($city) . "&units=metric&lang=fr&appid=" . $apiKey;

    try {
        $response = file_get_contents($apiUrl);
        if ($response === FALSE) {
            throw new Exception("Impossible de récupérer les données de l'API météo.");
        }

        $weatherData = json_decode($response, true);

        // Vérifiez si les données sont valides
        if (!isset($weatherData['main']['temp'])) {
            throw new Exception("Données météo non disponibles pour cette ville.");
        }

        return [
            'temperature' => $weatherData['main']['temp'],
            'humidite' => $weatherData['main']['humidity'],
            'vent' => $weatherData['wind']['speed'],
            'description' => $weatherData['weather'][0]['description'],
        ];
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}

