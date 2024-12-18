<?php
require_once(__DIR__ . '/../../../controller/blogcontroller.php');
require_once(__DIR__ . '/../../../controller/commentcontroller.php');
require_once(__DIR__ . '/../../../model/commentmodel.php');

// Check if an ID is passed via GET
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  // Blog ID
    var_dump($id);  // Debug: Check if ID is passed correctly

    // Create an instance of the BlogController
    $blogController = new BlogController();
    $blogController->incrementViews($id);
    $blog = $blogController->getBlogById($id);
    
   
    var_dump($blog);  // Debug: Check if blog data is retrieved correctly

    // Create an instance of the CommentsController
    $commentController = new CommentController();
    
    // Handle comment deletion
    if (isset($_GET['delete_id'])) {
        $commentId = (int)$_GET['delete_id'];
        $commentController->deleteComment($commentId, $id);
        header("Location: readmore.php?id=" . $id); 
        exit;
    }

    // Handle comment update
    if (isset($_GET['edit_id'])) {
        $editCommentId = (int)$_GET['edit_id'];
        $commentToEdit = $commentController->getCommentById($editCommentId);
    }

    // Handle comment update (POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_comment'])) {
        $updatedContent = $_POST['comment_content'];
        if (!empty($updatedContent)) {
            $commentController->updateComment($editCommentId, $updatedContent);
            header("Location: readmore.php?id=" . $id);  
            exit;
        }
    }

    if ($blog) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= htmlspecialchars($blog['titre']) ?></title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="blog-container">
                <div class="blog-image">
                    <img src="<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['titre']) ?>">
                </div>
                <h1 class="blog-title"><?= htmlspecialchars($blog['titre']) ?></h1>
<p class="blog-meta">
    Publié le : <?= htmlspecialchars($blog['temps']) ?><br>
    Catégorie : <?= htmlspecialchars($blog['category_name']) ?>
    <strong>Nombre de vues :</strong> <?= htmlspecialchars($blog['nb_vue']) ?>
</p>
<div class="blog-content">
    <p><?= nl2br(htmlspecialchars($blog['contenu'])) ?></p>
</div>

                <p>
                    <strong>Nombre de Commentaires :</strong> <?= htmlspecialchars($blog['nb_comments']) ?>
                </p>
            </div>

            <!-- Comments Section -->
            <div class="comment-section">
                <h3>Ajouter un commentaire</h3>
                
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update_comment'])) {
                    $commentContent = $_POST['comment'];
                    $userName = $_POST['name'];
                
                    if (!empty($commentContent) && !empty($userName)) {
                        $comment = new Comment(null, $commentContent, date('Y-m-d H:i:s'), $userName, $id);
                        $commentController->addComment($comment);
                        echo "<p>Merci pour votre commentaire !</p>";
                    } else {
                        echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
                    }
                }
                ?>

                <form class="comment-form" method="post" action="">
                    <input type="text" name="name" placeholder="Votre nom" required>
                    <textarea name="comment" rows="5" placeholder="Votre commentaire" required></textarea>
                    <button type="submit">Soumettre</button>
                </form>

                <h3>Commentaires :</h3>
                <?php
                // Fetch the comments for the current blog
                $comments = $commentController->getCommentsByBlogId($id);
                if ($comments) {
                    foreach ($comments as $comment) {
                        echo "<div class='comment-item'>";
                        echo "<strong>" . htmlspecialchars($comment['auteur']) . "</strong><br>";
                        echo "<p>" . nl2br(htmlspecialchars($comment['texte'])) . "</p>";
                        
                        // Edit and Delete buttons for comments
                        echo "<a href='?id=" . $id . "&edit_id=" . $comment['id_c'] . "'>Modifier</a> ";
                        echo "<a href='?id=" . $id . "&delete_id=" . $comment['id_c'] . "'>Supprimer</a>";
                        echo "</div>";
                    }
                }
                ?>

                <?php if (isset($commentToEdit)) : ?>
                <h3>Modifier le commentaire</h3>
                <form method="post" action="">
                    <textarea name="comment_content" rows="5"><?= htmlspecialchars($commentToEdit['texte']) ?></textarea>
                    <button type="submit" name="update_comment">Mettre à jour</button>
                </form>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Article introuvable.</p>";
    }
} else {
    echo "<p>Veuillez spécifier un ID valide.</p>";
}
?>
<style> /* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

/* Container for the blog content */
.blog-container {
    width: 80%;
    max-width: 1000px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.blog-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.blog-title {
    font-size: 2em;
    margin: 20px 0;
}

.blog-meta {
    font-size: 0.9em;
    color: #777;
}

.blog-content p {
    font-size: 1.1em;
    line-height: 1.6;
    margin-top: 20px;
}

/* Comment Section */
.comment-section {
    margin-top: 40px;
}

.comment-section h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.comment-form input,
.comment-form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.comment-form button {
    padding: 10px 20px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.comment-form button:hover {
    background-color: #218838;
}

/* Comment Items */
.comment-item {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.comment-item strong {
    font-weight: bold;
}

.comment-item a {
    color: #007bff;
    text-decoration: none;
    margin-left: 10px;
}

.comment-item a:hover {
    text-decoration: underline;
}

/* Error Messages */
.error-message {
    color: red;
    font-size: 1em;
    margin-top: 10px;
}

/* Responsiveness */
@media (max-width: 768px) {
    .blog-container {
        width: 95%;
        padding: 10px;
    }

    .blog-title {
        font-size: 1.8em;
    }

    .comment-section h3 {
        font-size: 1.3em;
    }
}
</style>
