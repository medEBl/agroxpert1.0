<?php
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');


$forumcommentC = new ForumCommentController();

if (isset($_POST['idcommentp']) && isset($_POST['emoji'])) {
    $idcommentp = $_POST['idcommentp'];
    $emoji = $_POST['emoji'];

    // Add the reaction to the comment
    $forumcommentC->addReaction($idcommentp, $emoji);

    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
