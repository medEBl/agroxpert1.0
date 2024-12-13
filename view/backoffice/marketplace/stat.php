<?php
require_once '../../../controller/produitController.php';

$productController = new ProduitController();

// Récupération des données
$topProducts = $productController->getTopProducts();
$lowStockProducts = $productController->getLowStockProducts();
$salesByMonth = $productController->getSalesByMonth();
$salesGrowth = $productController->getSalesGrowth();
$salesRevenue = $productController->getSalesRevenue();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques du Marketplace</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; color: #333; }
        h1 { text-align: center; margin-bottom: 30px; }
        .chart-container { width: 45%; margin: 20px; display: inline-block; vertical-align: top; }
        h2 { text-align: center; color: #555; }
    </style>
</head>
<body>
    <h1>Statistiques du Marketplace</h1>

    <!-- Top Produits Vendus -->
    <div class="chart-container">
        <h2>Top Produits Vendus</h2>
        <canvas id="topProductsChart"></canvas>
    </div>

    <!-- Répartition des Ventes -->
    <div class="chart-container">
        <h2>Répartition des Ventes</h2>
        <canvas id="salesPieChart"></canvas>
    </div>

    <!-- Chiffre d'Affaires Total -->
    <div class="chart-container" style="width: 90%;">
        <h2>Chiffre d'Affaires Total</h2>
        <canvas id="revenueLineChart"></canvas>
    </div>

    <!-- Produits en Stock Faible -->
    <div class="chart-container">
        <h2>Produits en Stock Faible</h2>
        <canvas id="lowStockChart"></canvas>
    </div>

    <!-- Évolution des Ventes -->
    <div class="chart-container">
        <h2>Évolution des Ventes par Mois</h2>
        <canvas id="salesTrendChart"></canvas>
    </div>

    <!-- Taux de Croissance -->
    <div class="chart-container">
        <h2>Taux de Croissance des Ventes</h2>
        <canvas id="salesGrowthChart"></canvas>
    </div>

    <script>
        // Top Produits Vendus
        const topProductNames = <?php echo json_encode(array_column($topProducts, 'nom')); ?>;
        const topProductSales = <?php echo json_encode(array_column($topProducts, 'total_vendu')); ?>;

        new Chart(document.getElementById("topProductsChart"), {
            type: 'bar',
            data: {
                labels: topProductNames,
                datasets: [{ label: 'Quantité Vendue', data: topProductSales, backgroundColor: 'rgba(75, 192, 192, 0.6)' }]
            }
        });

        // Répartition des Ventes
        new Chart(document.getElementById("salesPieChart"), {
            type: 'pie',
            data: {
                labels: topProductNames,
                datasets: [{ label: 'Répartition des Ventes', data: topProductSales, backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'] }]
            }
        });

        // Chiffre d'Affaires Total
        const productRevenues = <?php echo json_encode(array_column($topProducts, 'total_revenu')); ?>;

        new Chart(document.getElementById("revenueLineChart"), {
            type: 'line',
            data: {
                labels: topProductNames,
                datasets: [{ label: 'Chiffre d\'Affaires (€)', data: productRevenues, borderColor: '#4BC0C0', fill: true }]
            }
        });

        // Produits en Stock Faible
        const lowStockNames = <?php echo json_encode(array_column($lowStockProducts, 'nom')); ?>;
        const lowStockQuantities = <?php echo json_encode(array_column($lowStockProducts, 'stock_quantity')); ?>;

        new Chart(document.getElementById("lowStockChart"), {
            type: 'bar',
            data: {
                labels: lowStockNames,
                datasets: [{ label: 'Stock Restant', data: lowStockQuantities, backgroundColor: '#FF6384' }]
            }
        });

        // Évolution des Ventes par Mois
        const salesMonths = <?php echo json_encode(array_column($salesByMonth, 'mois')); ?>;
        const salesQuantities = <?php echo json_encode(array_column($salesByMonth, 'total_vendu')); ?>;

        new Chart(document.getElementById("salesTrendChart"), {
            type: 'line',
            data: {
                labels: salesMonths,
                datasets: [{ label: 'Ventes Mensuelles', data: salesQuantities, borderColor: '#36A2EB', fill: false }]
            }
        });

        // Taux de Croissance des Ventes
        const growthMonths = <?php echo json_encode(array_column($salesGrowth, 'mois')); ?>;
        const growthRates = <?php echo json_encode(array_column($salesGrowth, 'taux')); ?>;

        new Chart(document.getElementById("salesGrowthChart"), {
            type: 'bar',
            data: {
                labels: growthMonths,
                datasets: [{
                    label: 'Taux de Croissance (%)',
                    data: growthRates,
                    backgroundColor: growthRates.map(rate => rate >= 0 ? 'rgba(75, 192, 192, 0.6)' : 'rgba(255, 99, 132, 0.6)')
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>
</body>
</html>
