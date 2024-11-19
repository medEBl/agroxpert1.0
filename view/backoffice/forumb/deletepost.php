<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

// Debug: Check if the ID is received
if (isset($_GET['idpost']) && !empty($_GET['idpost'])) {
    $idpost = $_GET['idpost'];
    echo "ID received: " . $idpost; // Debugging
} else {
    die("No ID provided.");
}
if (isset($idpost)) {
    try {
        $postController = new ForumpostController();
        $postController->deletepost($idpost); // Call the delete method
        header('Location: retrievepost.php'); // Redirect back to the post list
        exit;
    } catch (Exception $e) {
        echo "Error deleting post: " . $e->getMessage(); // Log any errors
    }
}

