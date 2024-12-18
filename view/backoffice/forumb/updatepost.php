<?php
session_start();
require_once(__DIR__ . '/../../../controller/forumcontroller.php');
require_once(__DIR__ . '/../../../model/forummodel.php');
require_once '../../../controller/userc.php';


$error = "";
$post = null;
$postId = null;
if (!empty($_SESSION['id'])){
    $Id_UserP =  $_SESSION['id'];} // Inclus pour la mise à jour des ventes
// Step 1: Check if `idpost` is passed in the URL
if (isset($_GET['idpost']) && !empty($_GET['idpost'])) {
    $postId = $_GET['idpost'];

    // Load the post data for the given ID
    $postController = new ForumpostController();
    $post = $postController->getpostbyid($postId);

    if (!$post) {
        $error = "Post not found.";
    }
} else {
    $error = "No post ID provided.";
}

// Step 2: Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["titrePost"], $_POST["contenuPost"], $_POST["typeuser"], $_POST["authorname"], $_POST["typepost"]) &&
        !empty($_POST["titrePost"]) && !empty($_POST["contenuPost"]) && !empty($_POST["typeuser"]) && !empty($_POST["authorname"]) && !empty($_POST["typepost"])
    ) {
        // Create a new post object with the form data
        $post = new ForumPost(
            $_POST['postId'],
            $_POST['typeuser'],
            $_POST['authorname'],
            $_POST['typepost'],
            $_POST['titrePost'],
            $_POST['contenuPost'],
            new DateTime(), // Update date
            new DateTime(), // Same for updateDateP
            0, // Default views
            0, // Default likes
            1 // Assume user ID is 1 for now
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
        <div class="main-content">
            <header>
                <h1>Update Forum Post</h1>
            </header>

            <!-- Error Message -->
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <?php if ($post) : ?>
                <form id="updateForm" action="updatepost.php?idpost=<?= htmlspecialchars($post['idpost']); ?>" method="POST">
    <input type="hidden" name="postId" value="<?= htmlspecialchars($post['idpost']); ?>">

    <!-- User Type Dropdown -->
    <label for="typeuser">Type d'utilisateur:</label>
    <select id="typeuser" name="typeuser" required>
        <option value="">Choose...</option> <!-- 'Choose' option added -->
        <option value="Admin" <?= $post['typeuser'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="Member" <?= $post['typeuser'] == 'Member' ? 'selected' : ''; ?>>Member</option>
    </select>

    <label for="authorname">Nom de l'Auteur:</label>
    <input type="text" id="authorname" name="authorname" value="<?= htmlspecialchars($post['authorname']); ?>" required>

    <!-- Post Type Dropdown -->
    <label for="typepost">Type de Post:</label>
    <select id="typepost" name="typepost" required>
        <option value="">Choose...</option> <!-- 'Choose' option added -->
        <option value="Discussion" <?= $post['typepost'] == 'Discussion' ? 'selected' : ''; ?>>Discussion</option>
        <option value="Question" <?= $post['typepost'] == 'Question' ? 'selected' : ''; ?>>Question</option>
    </select>

    <label for="titrePost">Titre :</label>
    <input type="text" id="titrePost" name="titrePost" value="<?= htmlspecialchars($post['titleP']); ?>" required>

    <label for="contenuPost">Contenu :</label>
    <textarea id="contenuPost" name="contenuPost" rows="5" required><?= htmlspecialchars($post['contentP']); ?></textarea>

    <button type="submit">Update Post</button>
    <div id="errorMessages" style="color: red; margin-top: 10px;"></div>
</form>

            <?php else : ?>
                <p>No post found to update.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
