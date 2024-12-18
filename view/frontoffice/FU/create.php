<?php
// Include necessary files and session management
require_once __DIR__ . '/../../../controller/userc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $typeUser = $_POST['typeUser'];
    $adresse = $_POST['adresse'];

    // Create an instance of the controller
    $controller = new userc();

    // Call the createUser method
    $response = $controller->createUser($username, $email, $password, $typeUser, $adresse);

    
}
header('Location: index.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Inscription</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <div class="g-recaptcha" data-sitekey=""></div>
</head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>