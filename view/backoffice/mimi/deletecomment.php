<?php
include(__DIR__ . '/../../../controller/commentcontroller.php');
include(__DIR__ . '/../../../controller/blogcontroller.php');

// Check if an 'id' and 'blog_id' are passed via GET
if (isset($_GET['id']) && isset($_GET['blog_id'])) {
    $commentId = (int)$_GET['id'];  // ID of the comment to delete
    $blogId = (int)$_GET['blog_id']; // ID of the related blog

    // Create an instance of the CommentsController
    $commentsController = new CommentController();

    try {
        // Delete the comment
        $commentsController->deleteComment($commentId, $blogId);

        // Redirect back to the blog page
        header('Location: blogview.php?id=' . $blogId); // Redirect to the blog page
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "ID manquant.";
}
?>
