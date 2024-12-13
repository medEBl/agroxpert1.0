<?php
// Inclure le contrôleur pour récupérer les réponses
include '../../../controller/reponsecontroller.php';
// Créer des instances du contrôleur
$reponseController = new ReponseController();

// Récupérer la liste des réponses depuis la base de données
$reponses = $reponseController->listReponses();

// Afficher un message d'erreur si aucune réponse n'est trouvée
if (!$reponses) {
    echo "<p>Aucune réponse trouvée.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réponses</title>
    <style>
        /* Styles basiques */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        .reponse-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .reponse-item h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .reponse-item p {
            margin: 5px 0;
        }

        .button-group {
            margin-top: 10px;
        }

        .button-group a {
            padding: 8px 16px;
            margin-right: 10px;
            text-decoration: none;
            background-color: #00bfff;
            color: white;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .button-group a:hover {
            background-color: #007bb5;
        }

        .button-group a.delete-btn {
            background-color: #e74c3c;
        }

        .button-group a.delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Liste des Réponses</h1>

    <?php foreach ($reponses as $reponse): ?>
        <div class="reponse-item">
            <h3>Réponse ID: <?php echo $reponse['id_reponse']; ?></h3>
            <p><strong>Contenu :</strong> <?php echo htmlspecialchars($reponse['reponse']); ?></p>
            <p><strong>Date de réponse :</strong> <?php echo htmlspecialchars($reponse['date_reponse']); ?></p>

            <!-- Boutons pour Voir, Modifier et Supprimer -->
            <div class="button-group">
                <!-- Bouton Modifier la réponse -->
                <a href="updateReponse.php?id_reponse=<?php echo $reponse['id_reponse']; ?>">Modifier</a>

                <!-- Bouton Supprimer la réponse -->
                <a href="deleteReponse.php?id_reponse=<?php echo $reponse['id_reponse']; ?>" class="delete-btn" >Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
