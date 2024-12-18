<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
include(__DIR__ . '/../../../controller/commentcontroller.php');

$blogController = new BlogController();
$commentController = new CommentController();

if (isset($_GET['id_blog']) && !empty($_GET['id_blog'])) {
    // Récupérer l'ID de l'article
    $id_blog = (int)$_GET['id_blog'];

    // Récupérer les détails de l'article
    $blog = $blogController->getBlogById($id_blog);

    // Vérifiez si l'article existe
    if (!$blog) {
        die('Article non trouvé dans la base de données.');
    }

    // Récupérer les commentaires associés à l'article
    $comments = $commentsController->getCommentsByBlogId($id_blog);
} else {
    // Si l'ID de l'article est manquant dans l'URL, afficher un message d'erreur
    die('ID de l\'article manquant dans l\'URL.');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($blog['titre']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Afficher l'article -->
        <div class="blog-content">
            <h1><?= htmlspecialchars($blog['titre']) ?></h1>
            <p><?= htmlspecialchars($blog['contenu']) ?></p>
            <small>Publié le : <?= htmlspecialchars($blog['temps']) ?></small>
        </div>

        <!-- Afficher les commentaires -->
        <div class="comments-section">
            <h2>Commentaires</h2>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><strong><?= htmlspecialchars($comment['auteur']) ?></strong> : <?= htmlspecialchars($comment['texte']) ?></p>
                        <small>Posté le : <?= htmlspecialchars($comment['date_c']) ?></small>
                        <a href="updateComment.php?id=<?= $comment['id_comment'] ?>&blog_id=<?= $blogId ?>">Modifier</a>
                        <a href="deleteComment.php?id=<?= $comment['id_comment'] ?>&blog_id=<?= $blogId ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun commentaire trouvé.</p>
            <?php endif; ?>
        </div>

        <!-- Ajouter un commentaire -->
        <div class="add-comment">
            <h2>Ajouter un commentaire</h2>
            <form action="addComment.php" method="POST">
    <input type="hidden" name="id_blog" value="<?= $id_blog ?>"> <!-- Utilisation de id_blog -->
    <label for="auteur">Auteur :</label>
    <input type="text" name="auteur" id="auteur" required>
    <label for="texte">Commentaire :</label>
    <textarea name="texte" id="texte" rows="5" required></textarea>
    <button type="submit">Envoyer</button>
</form>

        </div>
    </div>
</body>
</html>
