<?php
// Inclusion des fichiers nécessaires
include '../../../controller/reclamationcontroller.php';

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();

// Récupérer les statistiques
$statistiques = $reclamationController->getStatistics();

// Calculer les différentes statistiques (nombre total, par statut, etc.)
$totalReclamations = $statistiques['total'];
$reclamationsParStatut = $statistiques['statut'];

// Conversion en JSON pour Chart.js
$statutLabels = json_encode(array_keys($reclamationsParStatut));
$statutData = json_encode(array_values($reclamationsParStatut));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Réclamations</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Statistiques des Réclamations</h1>

    <div>
        <h3>Total des réclamations: <?php echo $totalReclamations; ?></h3>
    </div>

    <div style="width: 60%; margin: auto;">
        <canvas id="statutChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('statutChart').getContext('2d');
        var statutChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $statutLabels; ?>,
                datasets: [{
                    label: 'Réclamations par statut',
                    data: <?php echo $statutData; ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
