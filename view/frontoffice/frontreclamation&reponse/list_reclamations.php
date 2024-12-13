<?php
// Inclure le contrôleur pour récupérer les réclamations
include '../../../controller/reclamationcontroller.php';

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();

// Récupérer la liste des réclamations depuis la base de données
$reclamations = $reclamationController->listReclamation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réclamations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
      
      
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .reclamation-list {
            margin-top: 20px;
        }
        .reclamation-item {
            background-color: #f9f9f9;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .status-label {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .status-label.traite {
            background-color: #28a745;
        }
        .status-label.non-traite {
            background-color: #dc3545;
        }
        .reclamation-item p {
            margin: 5px 0;
        }
        .delete-btn, .reply-btn {
            display: inline-block;
            padding: 10px 20px; /* Espace interne augmenté pour un meilleur confort visuel */
            font-size: 16px; /* Taille de police légèrement augmentée */
            font-weight: bold; /* Texte en gras pour une meilleure lisibilité */
            color: white; /* Couleur du texte */
            text-decoration: none; /* Supprimer les soulignements */
            border-radius: 5px; /* Coins arrondis */
            transition: background-color 0.3s ease; /* Animation fluide pour les interactions */
            margin-right: 12px; /* Marges légèrement augmentées pour plus d'espace */
            cursor: pointer; /* Curseur en main */
        }

        .delete-btn {
            background-color: #dc3545; /* Rouge pour "supprimer" */
        }

        .delete-btn:hover {
            background-color: #c82333; /* Rouge légèrement plus foncé au survol */
        }

        .reply-btn {
            background-color: #ffc107; /* Jaune pour "modifier" */
            color: #212529; /* Couleur du texte en noir pour contraster avec le fond */
        }

        .reply-btn:hover {
            background-color: #e0a800; /* Jaune plus foncé au survol */
        }

        .reply-btn[disabled] {
            cursor: not-allowed; /* Curseur bloqué */
            background-color: #ddd; /* Gris pour désactiver */
            color: #aaa; /* Texte grisé */
            pointer-events: none; /* Désactiver les clics */
        }

        .respond-btn {
            display: inline-block;
            background-color: #28a745; /* Vert pour indiquer une action positive */
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        .respond-btn:hover {
            background-color: #218838; /* Couleur plus foncée au survol */
        }

        .respond-btn:disabled, 
        .respond-btn[disabled] {
            background-color: #ccc; /* Gris pour le désactiver */
            color: #666;
            cursor: not-allowed;
            pointer-events: none;
        }
        .view-responses-btn {
            display: inline-block;
            background-color: #6f42c1; /* Violet foncé pour une touche élégante */
            color: #fff;
            text-decoration: none;
            padding: 10px 15px; /* Espace interne */
            border-radius: 5px; /* Coins arrondis */
            font-size: 14px; /* Taille de la police */
            font-weight: bold; /* Texte en gras */
            border: none; /* Pas de bordure */
            transition: background-color 0.3s ease; /* Animation fluide */
            cursor: pointer; /* Curseur en main */
        }

        .view-responses-btn:hover {
            background-color: #0056b3; /* Couleur bleue plus foncée au survol */
        }

        .view-responses-btn:disabled, 
        .view-responses-btn[disabled] {
            background-color: #ccc; /* Gris pour état désactivé */
            color: #666; /* Texte grisé */
            cursor: not-allowed; /* Curseur bloqué */
            pointer-events: none; /* Désactivation des clics */
        }


    </style>
</head>
<body>
<div class="container">
    <h1>Mes Réclamations</h1>

     
     <div class="reclamation-list">
        <?php
        if ($reclamations) {
            foreach ($reclamations as $reclamation) {
                echo '<div class="reclamation-item">';
                
                 
                $statusClass = $reclamation['statut'] === 'traite' ? 'traite' : 'non-traite';
                echo '<div class="status-label ' . $statusClass . '">' . htmlspecialchars($reclamation['statut']) . '</div>';
                
                // Affichage des champs
                echo '<p><strong>Date de Réclamation : </strong>' . htmlspecialchars($reclamation['datereclamation']) . '</p>';
                echo '<p><strong>Description : </strong>' . htmlspecialchars($reclamation['description']) . '</p>';
                echo '<p><strong>Utilisateur : </strong>ID #' . htmlspecialchars($reclamation['id_user']) . '</p>';
                echo '<p><strong>Téléphone : </strong>' . htmlspecialchars($reclamation['tel']) . '</p>';
                echo '<p><strong>Adresse : </strong>' . htmlspecialchars($reclamation['adresse']) . '</p>';
                ?> 
                
                
                <!-- Boutons pour répondre et modifier -->
                <a class="delete-btn" href="deletefront.php?id=<?php echo $reclamation['id']; ?>">supprimer</a>
                <?php if ($reclamation['statut'] !== 'traite'): ?>
                    <a class="reply-btn" href="update.php?id=<?php echo $reclamation['id']; ?>">Modifier</a>
                    <a class="respond-btn" href="repondrefront.php?id=<?php echo $reclamation['id']; ?>">Répondre</a>
                <?php else: ?>
                    <a class="reply-btn" disabled>Modifier</a>
                    <a class="respond-btn" disabled>Répondre</a>
                <?php endif; ?>
                <a class="view-responses-btn" href="voirreponse.php?id=<?php echo $reclamation['id']; ?>">Voir Réponses</a>

                <?php
                echo '</div>';
            }
        } else {
            echo '<p>Aucune réclamation trouvée.</p>';
        }
        ?>
    </div>
</div>
</body>
</html>
