<?php
// Inclure la configuration et les fonctions nécessaires
require_once(__DIR__ . '/../../../config1.php');
require_once(__DIR__ . '/../../../controller/meteoC.php');
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fonction pour récupérer les données météo actuelles
function getCurrentWeather($city) {
    $apiKey = 'meteo_projet'; // Remplacez par votre clé API OpenWeatherMap
    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city" . urlencode($city) . "&units=metric&lang=fr&appid=df04cb40ea7f08e4fe860ce7cd4cec47" . $apiKey;
    
    try {
        // Récupérer les données depuis l'API
        $response = file_get_contents($apiUrl);
        if ($response === FALSE) {
            throw new Exception("Impossible de récupérer les données de l'API météo.");
        }

        // Décoder les données JSON
        $weatherData = json_decode($response, true);

        // Vérifier si les données sont valides
        if (!isset($weatherData['main']['temp'])) {
            throw new Exception("Données météo non disponibles pour cette ville.");
        }

        // Retourner les informations météo pertinentes
        return [
            'temperature' => $weatherData['main']['temp'],
            'humidite' => $weatherData['main']['humidity'],
            'vent' => $weatherData['wind']['speed'],
            'description' => $weatherData['weather'][0]['description'],
        ];
    } catch (Exception $e) {
        // En cas d'erreur, retourner un message d'erreur
        return ["error" => $e->getMessage()];
    }
}

// Vérifier si une ville est spécifiée dans la requête
$city = isset($_GET['city']) ? $_GET['city'] : null;

if (!$city) {
    // Retourner une erreur si aucune ville n'est spécifiée
    die(json_encode(['error' => 'Aucune ville spécifiée.']));
}

// Récupérer les données météo de la ville
$weatherData = getCurrentWeather($city);

// Retourner les données au format JSON
header('Content-Type: application/json');
echo json_encode($weatherData);

// Exemple de réponse JSON (à remplacer par l'appel réel à l'API)
$jsonResponse = '{
   "message": "Count: 24",
   "cod": "200",
   "city_id": 4298960,
   "calctime": 0.00297316,
   "cnt": 24,
   "list": [
      {
         "dt": 1578384000,
         "main": {
            "temp": 275.45,
            "feels_like": 271.7,
            "pressure": 1014,
            "humidity": 74,
            "temp_min": 274.26,
            "temp_max": 276.48
         },
         "wind": {
            "speed": 2.16,
            "deg": 87
         },
         "clouds": {
            "all": 90
         },
         "weather": [
            {
               "id": 501,
               "main": "Rain",
               "description": "moderate rain",
               "icon": "10n"
            }
         ],
         "rain": {
            "1h": 0.9
         }
      }
   ]
}';


// Décoder la réponse JSON

$data = json_decode($jsonResponse, true);

// Vérifier si les données sont valides
if (isset($data['list']) && is_array($data['list'])) {
    foreach ($data['list'] as $weather) {
        $timestamp = $weather['dt'];
        $temperature = $weather['main']['temp'];
        $feelsLike = $weather['main']['feels_like'];
        $humidity = $weather['main']['humidity'];
        $windSpeed = $weather['wind']['speed'];
        $description = $weather['weather'][0]['description'];

        echo "<p>Date: " . date('Y-m-d H:i:s', $timestamp) . "</p>";
        echo "<p>Température: " . ($temperature - 275.45) . "°C</p>"; // Convert Kelvin to Celsius
        echo "<p>Température ressentie: " . ($feelsLike - 271.7) . "°C</p>";
        echo "<p>Humidité: " . $humidity . "%</p>";
        echo "<p>Vitesse du vent: " . $windSpeed . " m/s</p>";
        echo "<p>Description: " . ucfirst($description) . "</p>";
        echo "<hr>";
    }
} else {
    echo "<p>Aucune donnée météo trouvée.</p>";
}
?>