<?php
session_start();
include '../../../controller/reponsecontroller.php'; // Inclure le contrôleur qui récupère les réponses

require_once '../../../controller/userc.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les Réponses</title>
    <link rel="stylesheet" href="back.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <div class="main-content">
        <h2>Réponses à la Réclamation</h2>

        <?php
        if (isset($_GET['id'])) { // Vérification de l'ID de la réclamation
            $repController = new ReponseController();
            if (!empty($_SESSION['id'])){
                $id =  $_SESSION['id'];} 
            $reponses = $repController->listReponsesByReclamation($_GET['id']); // Utilise l'ID pour récupérer les réponses

            if (empty($reponses)) {
                echo "<p>Aucune réponse pour cette réclamation.</p>";
            } else {
                // Création d'un tableau
                echo "<table class='response-table'>";
                echo "<thead>";
                echo "<tr><th>ID Réponse</th><th>Réponse</th><th>Date Réponse</th></tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($reponses as $reponse) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($reponse['id_reponse']) . "</td>"; // ID de la réponse
                    echo "<td>" . htmlspecialchars($reponse['reponse']) . "</td>";    // Contenu de la réponse
                    echo "<td>" . htmlspecialchars($reponse['date_reponse']) . "</td>"; // Date de la réponse
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        } else {
            echo "<p>ID de réclamation non spécifié.</p>";
        }
        ?>
    </div>
    <style>
 h2 {
    text-align: center;
    font-size: 2.5em; /* Taille du titre */
    margin-bottom: 20px;
    text-transform: uppercase;
    background: linear-gradient(90deg, #007bff, #6f42c1); /* Dégradé bleu-violet */
    -webkit-background-clip: text; /* Clip du dégradé au texte */
    -webkit-text-fill-color: transparent; /* Remplissage transparent pour afficher le dégradé */
    letter-spacing: 2px; /* Espacement des lettres */
    padding-bottom: 10px;
}

body {
    font-family: 'Roboto', Arial, sans-serif;
    background-color: #f9fafb; /* Arrière-plan clair */
    margin: 0;
    padding: 0;
    color: #333333; /* Texte principal */
}

.main-content {
    width: 80%;
    max-width: 1200px; /* Limite maximale */
    margin: 40px auto;
    background: #ffffff; /* Fond blanc */
    padding: 30px;
    border-radius: 15px; /* Coins arrondis */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Ombre douce */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.main-content:hover {
    transform: scale(1.01); /* Zoom léger au survol */
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); /* Ombre renforcée */
}

h2 {
    text-align: center;
    color: #4a4a4a; /* Gris foncé */
    font-size: 2em;
    margin-bottom: 20px;
    border-bottom: 3px solid #007bff; /* Ligne bleue sous le titre */
    padding-bottom: 10px;
    text-transform: uppercase;
}

.response-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 1em;
    color: #4a4a4a;
}

.response-table th, .response-table td {
    padding: 15px 20px; /* Espacement interne */
    border: 1px solid #dddddd;
    text-align: left;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.response-table th {
    background-color: #007bff; /* Bleu intense */
    color: #ffffff; /* Blanc pour contraste */
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.response-table tr:nth-child(even) {
    background-color: #f9f9f9; /* Gris clair */
}

.response-table tr:hover {
    background-color: #f1f5ff; /* Bleu très clair */
    cursor: pointer; /* Curseur interactif */
}

.response-table td:hover {
    color: #007bff; /* Texte bleu au survol */
}

.no-response, .error {
    color: #d9534f; /* Rouge subtil */
    font-size: 1.2em;
    text-align: center;
    margin-top: 20px;
}

button, a {
    display: inline-block;
    padding: 12px 18px;
    background-color: #28a745; /* Vert pour actions positives */
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 1em;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

button:hover, a:hover {
    background-color: #218838; /* Vert plus sombre */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
}

button:active, a:active {
    background-color: #1e7e34; /* Vert encore plus sombre */
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); /* Ombre réduite */
}

footer {
    margin-top: 40px;
    text-align: center;
    color: #777777;
    font-size: 0.9em;
    padding: 10px;
    border-top: 1px solid #dddddd;
    background-color: #f1f1f1; /* Fond clair */
}  
</style>
</body>
</html>
