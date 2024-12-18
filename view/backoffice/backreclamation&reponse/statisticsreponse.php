<?php
// Inclure les fichiers nécessaires
include '../../../controller/reponsecontroller.php';
// Créer une instance du contrôleur Reponse
$reponseController = new ReponseController();

// Récupérer les statistiques des réponses
$statistiques = $reponseController->getStatistics();

// Statistiques
$totalReponses = $statistiques['total'];
$reponsesParReclamation = $statistiques['par_reclamation'];
$reponsesParDate = $statistiques['par_date'];

// Préparer les données pour le graphique
$reclamationLabels = json_encode(array_column($reponsesParReclamation, 'id'));
$reclamationData = json_encode(array_column($reponsesParReclamation, 'total_reponses'));

$dateLabels = json_encode(array_column($reponsesParDate, 'date'));
$dateData = json_encode(array_column($reponsesParDate, 'total_reponses'));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Réponses</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Statistiques des Réponses</h1>

    <div>
        <h3>Total des réponses: <?php echo $totalReponses; ?></h3>
    </div>

    <div style="width: 60%; margin: auto;">
        <canvas id="reponseParReclamationChart"></canvas>
    </div>

    <div style="width: 60%; margin: auto; margin-top: 50px;">
        <canvas id="reponseParDateChart"></canvas>
    </div>

    <script>
        var ctx1 = document.getElementById('reponseParReclamationChart').getContext('2d');
        var reponseParReclamationChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo $reclamationLabels; ?>,
                datasets: [{
                    label: 'Réponses par réclamation',
                    data: <?php echo $reclamationData; ?>,
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

        var ctx2 = document.getElementById('reponseParDateChart').getContext('2d');
        var reponseParDateChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: <?php echo $dateLabels; ?>,
                datasets: [{
                    label: 'Réponses par date',
                    data: <?php echo $dateData; ?>,
                    fill: false,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    tension: 0.1
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
