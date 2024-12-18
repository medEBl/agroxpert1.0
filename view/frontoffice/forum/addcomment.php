<?php
session_start();
// Include necessary files
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');


// Instantiate the controller
$forumcommentC = new ForumCommentController();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $contentC = htmlspecialchars($_POST['contentC']);
    $authorname = htmlspecialchars($_POST['authorname']);
    $idpostc = intval($_POST['idpostc']); // Post ID, make sure it's an integer
    
    // Get the current date and time for createDateC
    $createDateC = new DateTime();
    
    // Set the Author ID to 1 (as per your assumption)
    if (!empty($_SESSION['id'])){
        $AuthoridC =  $_SESSION['id'];
    }
    
    // Create a new ForumComment object and set the properties
    $comment = new ForumComment();
    $comment->setContentC($contentC);
    $comment->setAuthorname($authorname);
    $comment->setIdpostc($idpostc);
    $comment->setCreateDateC($createDateC->format('Y-m-d H:i:s'));
    $comment->setAuthoridC($AuthoridC);
    
    // Insert the comment into the database using the controller method
    $forumcommentC->addComment($comment);
    
    // Redirect back to the post page or show a success message
    header("Location: forum.php"); // Redirect to the posts page
    exit();
}
?>

