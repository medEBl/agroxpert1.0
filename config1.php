<?php
$dsn = 'mysql:host=localhost;dbname=agroxpert_db;charset=utf8'; // Remplacez `your_database` par le nom de votre base de données
$username = 'root'; // Remplacez `your_username` par votre nom d'utilisateur
$password = ''; // Remplacez `your_password` par votre mot de passe

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
$host = 'localhost'; // Hôte de la base de données
$dbname = 'agroxpert_db'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur par défaut de XAMPP
$password = ''; // Mot de passe par défaut de XAMPP (laisser vide)

try {
    $pdo = new PDO('mysql:host=localhost;dbname=agroxpert_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}




?>
