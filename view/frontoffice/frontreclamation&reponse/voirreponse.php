<?php
include '../../../controller/reponsecontroller.php'; // Inclure le contrôleur qui récupère les réponses
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

        <!-- Ajouter un bouton "Ajouter une réponse" -->
        <div class="add-response-btn">
            <a href="repondrefront.php?id=<?php echo $_GET['id']; ?>" class="btn-add-response">Ajouter une réponse</a>
        </div>

        <?php
        if (isset($_GET['id'])) { // Vérification de l'ID de la réclamation
            $repController = new ReponseController();
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
        /* Style pour le bouton "Ajouter une réponse" */
        .btn-add-response {
            display: inline-block;
            padding: 12px 18px;
            background-color: #28a745; /* Vert pour actions positives */
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-add-response:hover {
            background-color: #218838; /* Vert plus sombre */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Ombre plus marquée */
        }

        .btn-add-response:active {
            background-color: #1e7e34; /* Vert encore plus sombre */
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); /* Ombre réduite */
        }

        /* Autres styles (reste du CSS déjà fourni) */
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
    </style>
    
</body>
</html>
