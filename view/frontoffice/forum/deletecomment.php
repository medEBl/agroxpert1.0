<?php
// Include necessary files
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');

// Instantiate the controller
$forumcommentC = new ForumCommentController();

// Check if the ID of the comment to delete is passed
if (isset($_GET['idcommentp'])) {
    $idcommentp = intval($_GET['idcommentp']); // Get the comment ID

    // Delete the comment
    $forumcommentC->deleteComment($idcommentp);

    // Redirect back to the post page
    header("Location: forum.php");
    exit(); // Make sure the script stops here after redirect
}

// If we get to this point, it means there was no comment ID to delete
echo "Invalid comment ID!";
exit();
