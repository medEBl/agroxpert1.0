<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

$error = "";
$post = null;
$postController = new ForumpostController();
$Id_UserP = 1; // Assume user ID for testing

if (isset($_POST["titrePost"]) && isset($_POST["contenuPost"]) && isset($_POST["typeuser"]) && isset($_POST["authorname"]) && isset($_POST["typepost"])) {
    if (!empty($_POST["titrePost"]) && !empty($_POST["contenuPost"]) && !empty($_POST["typeuser"]) && !empty($_POST["authorname"]) && !empty($_POST["typepost"])) {
        // Create a new post with the form data
        $post = new ForumPost(
            null, // idpost will be auto-incremented in DB
            $_POST['typeuser'],
            $_POST['authorname'],
            $_POST['typepost'],
            $_POST['titrePost'],
            $_POST['contenuPost'],
            new DateTime(), // Current timestamp for createDateP
            new DateTime(), // Same for updateDateP initially
            0, // Default views
            0, // Default likes
            $Id_UserP // Set user ID to 1
        );

        // Add the post to the database
        $postController->addpost($post);
        header('Location: retrievepost.php'); // Redirect to post list
        exit;
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
    <title>Ajouter un Post - BackOffice</title>
    <link rel="stylesheet" href="backi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <header>
                <h1>Ajouter un Post</h1>
            </header>

            <!-- Error Message -->
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form id="forumForm" method="POST" action="">
                <!-- User Type Dropdown -->
                <label for="typeuser">Type d'utilisateur:</label>
<select id="typeuser" name="typeuser" required>
    <option value="">Select User Type</option> <!-- Invalid default -->
    <option value="Admin">Admin</option>
    <option value="Member">Member</option>
</select>

                <label for="authorname">Nom de l'Auteur:</label>
                <input type="text" id="authorname" name="authorname" placeholder="Nom de l'auteur" required>

                <!-- Post Type Dropdown -->
                <label for="typepost">Type de Post:</label>
<select id="typepost" name="typepost" required>
    <option value="">Select Post Type</option> <!-- Invalid default -->
    <option value="Discussion">Discussion</option>
    <option value="Question">Question</option>
</select>

                <label for="titrePost">Titre :</label>
                <input type="text" id="titrePost" name="titrePost" placeholder="Titre du post" required>

                <label for="contenuPost">Contenu :</label>
                <textarea id="contenuPost" name="contenuPost" rows="5" placeholder="Contenu du post" required></textarea>

                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>

</body>
</html>
