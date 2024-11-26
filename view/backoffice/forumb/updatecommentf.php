<?php
// Include necessary files
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');

// Check if we have a comment ID and fetch it for editing
if (isset($_GET['idcommentp'])) {
    $idcommentp = $_GET['idcommentp'];

    // Instantiate the controller
    $forumCommentController = new ForumCommentController();
    $comment = $forumCommentController->getCommentById($idcommentp);
    
    if (!$comment) {
        echo "Comment not found!";
        exit;
    }
} else {
    echo "No comment ID provided!";
    exit;
}

// Check if the form is submitted to update the comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentC = $_POST['contentC'];
    $updateDateC = date('Y-m-d H:i:s'); // Current time as the update timestamp
    
    // Create a new comment object
    $commentToUpdate = new ForumComment();
    $commentToUpdate->setIdcommentp($idcommentp);
    $commentToUpdate->setContentC($contentC);
    $commentToUpdate->setUpdateDateC($updateDateC);

    // Call the controller to update the comment
    $forumCommentController->updateComment($commentToUpdate);
    
    // Redirect back to the post page or the list of comments (optional)
    header("Location: retrievepost.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commentaire</title>
    <link rel="stylesheet" href="backi.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <nav>
                <ul>
                    <li><a href="#">Forum Management</a></li>
                    <!-- Add other sidebar items here -->
                </ul>
            </nav>
        </aside>

        <div class="main-content">
            <header>
                <h1>Modifier Commentaire</h1>
            </header>

            <form method="POST">
                <div>
                    <p><strong>Commentaire par:</strong> <?= htmlspecialchars($comment['authorname']) ?></p>
                    <p><strong>Nombre de Likes:</strong> <?= htmlspecialchars($comment['nblikec']) ?></p>
                    <p><strong>Nombre de Dislikes:</strong> <?= htmlspecialchars($comment['nbdislikec']) ?></p>
                </div>

                <div>
                    <label for="contentC">Contenu du Commentaire:</label><br>
                    <textarea name="contentC" id="contentC" rows="5" cols="40"><?= htmlspecialchars($comment['contentC']) ?></textarea><br><br>
                    <input type="submit" value="Mettre à jour le commentaire">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
