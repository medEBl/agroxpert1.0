<?php
// Inclure les fichiers nécessaires
include_once(__DIR__ . '../../../../controller/categoryc.php');
include_once(__DIR__ . '../../../../config.php');
include_once(__DIR__ . '../../../../model/catgorym.php');
$db = new config();
$conn = $db->getConnexion();

// Créer une instance du contrôleur
$categoryController = new CategoryController();

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    // Créer un objet Category et appeler le contrôleur pour ajouter la catégorie
    $category = new Category($name);
    $categoryController->addCategory($category);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>
</head>
<body>
    <h2>Ajouter une nouvelle catégorie</h2>
    <form action="create_category.php" method="POST">
        <label for="category_name">Nom de la catégorie :</label>
        <input type="text" id="category_name" name="name" required>
        <input type="submit" value="Ajouter la catégorie">
    </form>
</body>
</html>
