<?php
include(__DIR__ . '/../../../controller/categoryc.php'); // Inclure le contrôleur des catégories
include(__DIR__ . '/../../../model/catgorym.php'); // Inclure le modèle Category

// Initialisation des variables
$error = "";
$categoryController = new CategoryController();

// Activer le rapport d'erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Vérification des champs obligatoires
        if (!empty($_POST["name"])) {

            // Création et ajout de la catégorie
            $category = new Category(
                htmlspecialchars($_POST['name'])
            );

            // Ajout en base de données
            $categoryController->addCategory($category);
            header('Location: category_list.php'); // Redirection après ajout
            exit;

        } else {
            throw new Exception("Le champ nom est obligatoire.");
        }
    } catch (Exception $e) {
        $error = "Erreur : " . $e->getMessage();
        // Ajouter un log pour le débogage
        error_log($error);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Catégorie</title>
    <link rel="stylesheet" href="bac.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Ajouter une Catégorie</h1>
            </header>

            <main>
                <form id="categoryForm" method="POST">
                    <h2>Ajouter une Catégorie</h2>

                    <!-- Category Name -->
                    <label for="name">Nom de la catégorie :</label>
                    <input type="text" name="name" id="name" required>

                    <!-- Submit Button -->
                    <button type="submit">Enregistrer</button>

                    <!-- Error Message -->
                    <p id="error" style="color: red;">
                        <?= $error ?>
                    </p>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
