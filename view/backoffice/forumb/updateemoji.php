<?php
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $idcommentp = $input['idcommentp'];
    $newEmoji = $input['emoji'];

    $commentController = new ForumCommentController();
    $currentEmoji = $commentController->getEmoji($idcommentp);

    // Concatenate the new emoji to the existing emojis
    $updatedEmoji = $currentEmoji ? $currentEmoji . $newEmoji : $newEmoji;
    $commentController->updateEmoji($idcommentp, $updatedEmoji);

    echo json_encode(['success' => true]);
}
?>
