<?php
include_once(__DIR__ . '../../../../controller/categoryc.php');

// Vérifier si un ID de catégorie est passé dans l'URL
if (isset($_GET['id'])) {
    // Créer une instance du contrôleur des catégories
    $categoryController = new CategoryController();

    // Appeler la méthode pour supprimer la catégorie avec l'ID donné
    $categoryController->deleteCategory((int)$_GET['id']);

    // Rediriger vers la page de la liste des catégories après la suppression
    header('Location: category_list.php');
    exit;
}
?>
