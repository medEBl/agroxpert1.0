<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

// Instantiate the controller
$forumpostC = new ForumpostController();

if (isset($_GET['idpost'])) {
    $idpost = $_GET['idpost'];
    $forumpostC->incrementViews($idpost);  // Increment the views in the database

    // Get the new view count
    $post = $forumpostC->getPostById($idpost);
    echo json_encode(['success' => true, 'newViewCount' => $post['nbviewsp']]);
} else {
    echo json_encode(['success' => false]);
}
?>
