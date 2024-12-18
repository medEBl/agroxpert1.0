<?php
include(__DIR__ . '../../../../controller/commentcontroller.php');
include(__DIR__ . '../../../../model/Commentmodel.php');

// Initialisation des variables
$error = "";
$commentController = new CommentController();

// Activer le rapport d'erreurs pour déboguer
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs obligatoires
    if (!empty($_POST["texte"]) && !empty($_POST["auteur"]) && !empty($_POST["id_blog"])) {
        // Initialisation de la date actuelle
        $date_c = date("Y-m-d H:i:s");

        // Création et ajout du commentaire
        $comment = new Comment(
            null,  // ID automatique ou NULL si généré en base
            htmlspecialchars($_POST['texte']),
            $date_c,
            htmlspecialchars($_POST['auteur']),
            htmlspecialchars($_POST['id_blog'])  // Utilisation de id_blog comme clé étrangère
        );

        try {
            $commentsController->addComment($comment);
            header('Location: commentList.php?id_blog=' . htmlspecialchars($_POST['id_blog'])); // Redirection après l'ajout
            exit;
        } catch (Exception $e) {
            $error = "Erreur lors de l'ajout du commentaire : " . $e->getMessage();
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Commentaire</title>
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
                <h1>Ajouter un Commentaire</h1>
            </header>

            <main>
                <form id="commentForm" method="POST">
                    <h2>Ajouter un Commentaire</h2>

                    <!-- Texte -->
                    <label for="texte">Texte :</label>
                    <textarea name="texte" id="texte" rows="5" required></textarea>

                    <!-- Auteur -->
                    <label for="auteur">Auteur :</label>
                    <input type="text" name="auteur" id="auteur" required>

                    <!-- ID de l'article -->
                    <label for="id_blog">ID de l'article :</label>
                    <input type="number" name=id_blog" id=id_blog" required>

                    <!-- Submit Button -->
                    <button type="submit" formaction="commentList.php">Enregistrer</button>

                    <!-- Error Message -->
                    <p id="error" style="color: red;"><?= $error ?></p>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
