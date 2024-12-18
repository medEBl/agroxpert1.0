<?php
include(__DIR__ . '/../../../controller/categoryc.php');
include(__DIR__ . '/../../../model/Catgorym.php'); // Assurez-vous que le chemin est correct

$categoryController = new CategoryController();
$category = null;
$error = "";

if (isset($_GET['id'])) {
    // Récupérer la catégorie par ID
    $category = $categoryController->getCategoryById((int)$_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name'])) {
        // Création de l'objet Category mis à jour
        $categoryUpdated = new Category(
            htmlspecialchars($_POST['name']),
            (int)$_POST['id_category']  // Assurez-vous d'envoyer l'ID de la catégorie dans le formulaire
        );

        // Mise à jour de la catégorie
        $categoryController->updateCategory($categoryUpdated);

        // Rediriger vers la liste des catégories après la mise à jour
        header('Location: category_list.php');
        exit;
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Catégorie</title>
    <link rel="stylesheet" href="bac.css"> <!-- Assurez-vous d'avoir un fichier CSS approprié -->
</head>
<body>
    <div class="container">
         <!-- Sidebar -->
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
        <h2>Modifier la Catégorie</h2>
        
        <!-- Affichage du formulaire de mise à jour -->
        <form method="POST">
            <input type="hidden" name="id_category" value="<?= $category['id_category'] ?>">

            <!-- Champ pour le nom de la catégorie -->
            <label for="name">Nom de la catégorie :</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($category['name']) ?>" required>

            <!-- Affichage des erreurs -->
            <p style="color: red;"><?= $error ?></p>

            <!-- Bouton de soumission -->
            <button type="submit">Mettre à jour</button>
        </form>

        <a href="category_list.php">Retour à la liste des catégories</a>
    </div>
</body>
</html>
