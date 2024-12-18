<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
include(__DIR__ . '/../../../model/Blog.php');
include(__DIR__ . '/../../../controller/categoryc.php'); // Pour récupérer les catégories

// Initialisation des variables
$error = "";
$blogController = new BlogController();
$categoryController = new CategoryController();
$categories = $categoryController->getAllCategories(); // Récupérer toutes les catégories
$target_file = "";

// Activer le rapport d'erreurs pour débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Vérification des champs obligatoires
        if (!empty($_POST["titre"]) && !empty($_POST["contenu"]) && !empty($_POST["temps"]) && !empty($_POST["id_category"])) {
            
            // Gestion de l'image
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                $target_dir = __DIR__ . "/uploads/";
                if (!file_exists($target_dir)) {
                    if (!mkdir($target_dir, 0777, true)) {
                        throw new Exception("Impossible de créer le dossier de téléchargement.");
                    }
                }

                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    throw new Exception("Erreur lors du téléchargement de l'image. Vérifiez les permissions du dossier.");
                }
            } else {
                throw new Exception("Veuillez sélectionner une image valide.");
            }

            // Si aucune erreur jusqu'ici, création et ajout du blog
            $blog = new Blog(
                null,
                "uploads/" . basename($_FILES["image"]["name"]), // Chemin relatif pour la base de données
                htmlspecialchars($_POST['titre']),
                htmlspecialchars($_POST['contenu']),
                htmlspecialchars($_POST['temps']),
                htmlspecialchars($_POST['id_category']),
                0, // nb_vue initialisé à 0
                0  // nb_comments initialisé à 0
            );

            // Ajout en base de données
            $blogController->addBlog($blog);
            header('Location: bloglist.php');
            exit;

        } else {
            throw new Exception("Tous les champs sont obligatoires.");
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
    <title>Ajouter un Article</title>
    <link rel="stylesheet" href="bac.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>/* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f7f7f7;
    color: #333;
    line-height: 1.6;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.main-content {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 800px;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

h1 {
    font-size: 2rem;
    font-weight: 600;
    color: #333;
}

h2 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #444;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-size: 1rem;
    color: #555;
}

input, textarea, select {
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

input:focus, textarea:focus, select:focus {
    border-color: #4CAF50;
    outline: none;
}

textarea {
    resize: vertical;
}

button {
    padding: 12px;
    font-size: 1.1rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

/* Error message */
#error {
    font-size: 0.9rem;
    margin-top: 10px;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main-content {
        padding: 20px;
        width: 100%;
    }

    h1 {
        font-size: 1.8rem;
    }

    h2 {
        font-size: 1.2rem;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 10px;
    }

    h1 {
        font-size: 1.6rem;
    }

    h2 {
        font-size: 1rem;
    }

    button {
        font-size: 1rem;
    }
}
</style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
       

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Ajouter un Article</h1>
            </header>

            <main>
                <form id="articleForm" method="POST" enctype="multipart/form-data">
                    <h2>Ajouter un Article</h2>

                    <!-- Image Upload -->
                    <label for="image">Image :</label>
                    <input type="file" name="image" id="image" accept="image/*" required>
                    
                    <!-- Title -->
                    <label for="titre">Titre :</label>
                    <input type="text" name="titre" id="titre" required>

                    <!-- Content -->
                    <label for="contenu">Contenu :</label>
                    <textarea name="contenu" id="contenu" rows="5" required></textarea>

                    <!-- Date -->
                    <label for="temps">Date :</label>
                    <input type="datetime-local" name="temps" id="temps" value="<?= date('Y-m-d\TH:i') ?>" required>

                    <!-- Category -->
                    <label for="id_category">Catégorie :</label>
                    <select name="id_category" id="id_category" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id_category'] ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Number of Views (Read-only) -->
                    <label for="nb_vue">Nombre de vues :</label>
                    <input type="number" name="nb_vue" id="nb_vue" value="0" readonly>

                    <!-- Number of Comments (Read-only) -->
                    <label for="nb_comments">Nombre de commentaires :</label>
                    <input type="number" name="nb_comments" id="nb_comments" value="0" readonly>

                    <!-- Submit Button -->
                    <button type="submit">Enregistrer</button>

                    <!-- Error Message -->
                    <p id="error" style="color: red;"><?= $error ?></p>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
