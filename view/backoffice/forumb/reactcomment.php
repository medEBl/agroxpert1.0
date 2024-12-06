<?php
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = $_POST['idcommentp'] ?? null;

    if ($commentId) {
        $forumcommentC = new ForumCommentController();
        $success = $forumcommentC->incrementEmojiCount($commentId); // Implement increment logic in the controller

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update emoji count.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid comment ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
