<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');
require_once(__DIR__ . '/../../../model/forummodel.php');

$error = "";

// Step 1: Check if `idpost` is passed in the URL
if (isset($_GET['idpost']) && !empty($_GET['idpost'])) {
    $postId = $_GET['idpost'];

    // Load the post data for the given ID
    $postController = new ForumpostController();
    $post = $postController->showpost($postId);

    if (!$post) {
        $error = "Post not found.";
    }
} else {
    $error = "No post ID provided.";
}

// Step 2: Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["titrePost"], $_POST["contenuPost"], $_POST["Id_User"], $_POST["postId"]) &&
        !empty($_POST["titrePost"]) && !empty($_POST["contenuPost"]) && !empty($_POST["Id_User"])
    ) {
        $post = new ForumPost(
            $_POST['postId'],
            $_POST['titrePost'],
            $_POST['contenuPost'],
            new DateTime(), // Current date
            $_POST['Id_User']
        );

        try {
            // Attempt to update the post
            $postController->updatepost($post, $_POST['postId']);

            // Redirect to the posts list
            header('Location: retrievepost.php');
            exit;
        } catch (Exception $e) {
            $error = "Error updating post: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Forum Post - Dashboard</title>
    <link rel="stylesheet" href="backi.css">
</head>

<body>
    <div class="container">
        <h1>Update Forum Post</h1>

        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if ($post) : ?>
            <form action="updatepost.php?idpost=<?= htmlspecialchars($post['idpost']); ?>" method="POST">
                <input type="hidden" name="postId" value="<?= htmlspecialchars($post['idpost']); ?>">

                <label for="titrePost">Title:</label>
                <input type="text" id="titrePost" name="titrePost" value="<?= htmlspecialchars($post['titleP']); ?>" required>

                <label for="contenuPost">Content:</label>
                <textarea id="contenuPost" name="contenuPost" rows="5" required><?= htmlspecialchars($post['contentP']); ?></textarea>

                <label for="Id_User">User ID:</label>
                <input type="text" id="Id_User" name="Id_User" value="<?= htmlspecialchars($post['Id_User']); ?>" required>

                <button type="submit">Update Post</button>
            </form>
        <?php else : ?>
            <p>No post found to update.</p>
        <?php endif; ?>
    </div>
</body>

</html>
