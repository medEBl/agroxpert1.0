<?php
session_start();
// Inclure le contrôleur pour récupérer les réclamations
include '../../../controller/reclamationcontroller.php';
require_once '../../../controller/userc.php';

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();
if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} 

// Récupérer la liste des réclamations depuis la base de données
$reclamations = $reclamationController->listReclamation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réclamations</title>
    <link rel="stylesheet" href="back.css">
    <style>
        
        
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
        .reclamation-item h2 {
            margin-top: 0;
            color: #007bff;
        }
        .reclamation-item p {
            margin: 5px 0;
        }
        .delete-btn, .reply-btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .delete-btn {
            background-color: #dc3545;
            margin-right: 10px;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .reply-btn {
            background-color: #28a745;
        }
        .reply-btn:hover {
            background-color: #218838;
        }
        .view-details {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .view-details:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #yellow;
            margin-right: 10px;}
        .list-btn, .reply-btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .list-btn {
            background-color: #4f161b;
            margin-right: 10px;
        }
        .list-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                <li><a href="../user/gestion.php">Gestion de Compte</a></li>
                    <li><a href="../marketplace/productList.php">Gestion de Market</a></li>
                    <li><a href="../mimi/bloglist.php">Gestion de Blog</a></li>
                    <li><a href="../back office/zonelist.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="admin.php">Gestion de Feedback</a></li>
                    <li><a href="../eventt/listevent.php">Gestion d'event</a></li>
                </ul>
            </nav>
        </aside>
    
        <header>
                <h1>BackOffice - Gestion des Reclamations</h1>
            </header>
            <main>
        <div class="reclamation-list">
            <?php
            // Vérifier si des réclamations sont récupérées
            if ($reclamations) {
                foreach ($reclamations as $reclamation) {
                    echo '<div class="reclamation-item">';
                    echo '<h2>Réclamation ID : ' . htmlspecialchars($reclamation['id']) . '</h2>';
                    echo '<p><strong>Date de Réclamation : </strong>' . htmlspecialchars($reclamation['datereclamation']) . '</p>';
                    echo '<p><strong>Description : </strong>' . htmlspecialchars($reclamation['description']) . '</p>';
                    echo '<p><strong>Statut : </strong>' . htmlspecialchars($reclamation['statut']) . '</p>';
                    echo '<p><strong>ID Utilisateur : </strong>' . htmlspecialchars($reclamation['id_user']) . '</p>';
                    echo '<p><strong>Téléphone : </strong>' . htmlspecialchars($reclamation['tel']) . '</p>';
                    echo '<p><strong>Adresse : </strong>' . htmlspecialchars($reclamation['adresse']) . '</p>';
                    ?>

                    <a href="delete.php?id=<?php echo $reclamation['id']; ?>" class="delete-btn">Supprimer</a>
                    <a href="repondre.php?id=<?php echo $reclamation['id']; ?>" class="reply-btn">Répondre</a>
                    <a href="reponses.php?id=<?php echo $reclamation['id']; ?>" class="list-btn">voir</a>
                    

                    <?php
                    echo '</div>';
                }
            } else {
                echo '<p>Aucune réclamation trouvée.</p>';
            }
            ?>
             </main>
        </div>
    </div>
</body>
</html>
