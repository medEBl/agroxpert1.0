<?php
include(__DIR__ . '/../../../controller/commentcontroller.php');
include(__DIR__ . '/../../../model/Commentmodel.php'); // Assurez-vous que le chemin est correct

$commentController = new CommentController();
$comment = null;
$error = "";

// Vérification de l'existence de l'ID dans l'URL
if (isset($_GET['id'])) {
    // Récupérer le commentaire à modifier
    $comment = $commentController->getCommentById((int)$_GET['id']);
    // Vérifier si le commentaire existe
    if (!$comment) {
        die('Commentaire non trouvé.');
    }
}

// Si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification que tous les champs sont remplis
    if (!empty($_POST['texte']) && !empty($_POST['auteur']) && !empty($_POST['id_blog'])) {
        // Création de l'objet Comment mis à jour
        $commentUpdated = new Comment(
            (int)$_POST['id_c'],             // ID du commentaire (celui à modifier)
            htmlspecialchars($_POST['texte']),     // Texte du commentaire
            $comment->getDate(),                   // Date d'origine (pas modifiée)
            htmlspecialchars($_POST['auteur']),    // Auteur du commentaire
            htmlspecialchars($_POST['id_blog']) // ID de l'article associé
        );

        // Mise à jour du commentaire dans la base de données
        $commentController->updateComment($commentUpdated);

        // Rediriger vers la liste des commentaires après mise à jour
        header('Location: commentList.php');
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
    <title>Modifier un Commentaire</title>
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

        <!-- Formulaire de mise à jour du commentaire -->
        <h2>Modifier le Commentaire</h2>
        <form method="POST">
            <input type="hidden" name="id_comment" value="<?= $comment->getId() ?>">

            <!-- Champ pour le texte -->
            <label for="texte">Texte :</label>
            <textarea name="texte" id="texte" rows="5" required><?= htmlspecialchars($comment->getTexte()) ?></textarea>

            <!-- Champ pour l'auteur -->
            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" id="auteur" value="<?= htmlspecialchars($comment->getAuteur()) ?>" required>

            <!-- Champ pour l'ID de l'article -->
            <label for="id_article">ID de l'article :</label>
            <input type="number" name="id_article" id="id_article" value="<?= htmlspecialchars($comment->getIdBlog()) ?>" required>

            <!-- Affichage des erreurs -->
            <p style="color: red;"><?= $error ?></p>

            <!-- Bouton de soumission -->
            <button type="submit">Mettre à jour</button>
        </form>

        <a href="readmore.php">Retour à la liste des commentaires</a>
    </div>
</body>
</html>
