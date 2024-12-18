<?php
// Inclure le contrôleur pour les catégories
include_once(__DIR__ . '../../../../controller/categoryc.php');

// Créer une instance du contrôleur
$categoryController = new CategoryController();

// Récupérer toutes les catégories
$categories = $categoryController->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Catégories</title>
    <link rel="stylesheet" href="bac.css">
</head>
<body>
<aside class="sidebar">
    <h2>DASHBOARD</h2>
    <nav>
        <ul>
            <li><a href="#">Gestion de Compte</a></li>
            <li><a href="#">Gestion de Market</a></li>
            <li><a href="#">Gestion de Blog</a></li>
            <li><a href="#">Gestion de Météo</a></li>
            <li><a href="#">Gestion de Forum</a></li>
            <li><a href="#">Gestion de Feedback</a></li>
        </ul>
    </nav>
</aside>

<!-- Categories Section -->
<div class="category-container">
    <h2>Liste des Catégories</h2>
    <a href="addcategory.php" class="add-category-btn">Ajouter une catégorie</a>

    <?php if (!empty($categories)): ?>
    <?php foreach ($categories as $category): ?>
        <div class="category-item">
            <h3><a href="blogs_by_category.php?category_id=<?= $category['id_category'] ?>"><?= htmlspecialchars($category['name']) ?></a></h3>
            <a href="updatecategory.php?id=<?= $category['id_category'] ?>">Modifier</a>
            <a href="deletecategory.php?id=<?= $category['id_category'] ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="no-categories">Aucune catégorie trouvée.</p>
<?php endif; ?>

</div>
</body>
</html>
