<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

// Check if a post ID is provided
if (isset($_POST['idpost'])) {
    $postId = $_POST['idpost'];

    // Instantiate the controller
    $forumpostC = new ForumpostController();

    // Increment the likes for the post
    $forumpostC->incrementLikes($postId);

    // Redirect back to the post list or post detail page
    header('Location: retrievepost.php');  // Adjust this to the correct page where you want to redirect after liking
    exit();
} else {
    echo "Invalid post ID!";
}
?>
