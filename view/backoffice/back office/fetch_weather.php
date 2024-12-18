<?php
require_once(__DIR__ . '/../../../config1.php');

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$apiKey = 'meteo';
$city = isset($_GET['city']) ? $_GET['city'] : '';

if (empty($city)) {
    echo json_encode(['success' => false, 'error' => 'Aucun nom de ville spécifié']);
    exit;
}

$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=df04cb40ea7f08e4fe860ce7cd4cec47";

$response = @file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(['success' => false, 'error' => "Données météo introuvables pour $city"]);
    exit;
}

$data = json_decode($response, true);

if (isset($data['main']['temp'])) {
    echo json_encode([
        'success' => true,
        'temperature' => $data['main']['temp'],
        'humidity' => $data['main']['humidity'],
        'wind_speed' => $data['wind']['speed']
        
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Aucune donnée météo trouvée']);
}

?>
