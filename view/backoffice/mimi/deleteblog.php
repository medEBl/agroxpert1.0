<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');

if (isset($_GET['id'])) {
    $blogController = new BlogController();
    $blogController->deleteBlog((int)$_GET['id']);
    header('Location: blogList.php');
    exit;
}
?>
