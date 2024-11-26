<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

// Check if the ID is provided and valid
if (isset($_GET['idpost']) && !empty($_GET['idpost']) && is_numeric($_GET['idpost'])) {
    $idpost = $_GET['idpost'];
} else {
    die("Invalid or missing ID.");
}

if (isset($idpost)) {
    try {
        // Create an instance of the post controller
        $postController = new ForumpostController();
        
        // Attempt to delete the post
        $postController->deletepost($idpost);

        // Redirect after deletion
        header('Location: retrievepost.php'); // Redirect to the post list page
        exit;

    } catch (Exception $e) {
        // Display any error that occurs during the deletion process
        echo "Error deleting post: " . $e->getMessage();
    }
}
?>
