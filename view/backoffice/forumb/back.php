<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

$error = "";
$post = null;
$postId = null;

// Initialize controller
$postController = new ForumpostController();

// Step 1: Handle form submission for Add Post or Update Post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["titrePost"], $_POST["contenuPost"], $_POST["typeuser"], $_POST["authorname"], $_POST["typepost"]) &&
        !empty($_POST["titrePost"]) && !empty($_POST["contenuPost"]) && !empty($_POST["typeuser"]) && !empty($_POST["authorname"]) && !empty($_POST["typepost"])) {

        // Check if it's an update or a new post
        if (isset($_POST['postId']) && !empty($_POST['postId'])) {
            // Update the post
            $postId = $_POST['postId'];
            $post = new ForumPost(
                $postId, // ID is passed for update
                $_POST['typeuser'],
                $_POST['authorname'],
                $_POST['typepost'],
                $_POST['titrePost'],
                $_POST['contenuPost'],
                new DateTime(), // Updated Date
                new DateTime(), // Updated Date
                0, // Views
                0, // Likes
                1 // User ID (default for testing)
            );
            $postController->updatePost($post,$idpost); // Update post in the database
        } else {
            // Add a new post
            $post = new ForumPost(
                null, // ID will be auto-incremented
                $_POST['typeuser'],
                $_POST['authorname'],
                $_POST['typepost'],
                $_POST['titrePost'],
                $_POST['contenuPost'],
                new DateTime(), // Create Date
                new DateTime(), // Update Date
                0, // Views
                0, // Likes
                1 // User ID (default for testing)
            );
            $postController->addpost($post); // Add the new post to the database
        }
    } else {
        $error = "Please fill in all fields.";
    }
}

// Step 2: Handle Post Deletion
if (isset($_GET['deletepost'])) {
    $postId = $_GET['deletepost'];
    $postController->deletePost($postId);
}

// Step 3: Retrieve the list of posts
$postsList = $postController->listpost();

// Step 4: Handle Edit (Get Post for Editing)
$postToEdit = null;
if (isset($_GET['idpost'])) {
    $postId = $_GET['idpost'];
    $postToEdit = $postController->getpostbyid($postId);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice - Gestion des Articles et Forums</title>
    <link rel="stylesheet" href="backi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                    <li><a href="#">Gestion de Compte</a></li>
                    <li><a href="#">Gestion de Market</a></li>
                    <li><a href="#">Gestion de Blog</a></li>
                    <li><a href="#">Gestion de Météo</a></li>
                    <li><a href="#">Gestion de Forum</a></li>
                    <li><a href="#">Gestion de Feedback</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>BackOffice - Gestion des Forums</h1>
            </header>

            <!-- Add or Edit Post Form -->
            <h2><?= $postToEdit ? 'Modifier un Post' : 'Ajouter un Post'; ?></h2>
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <?php if ($postToEdit) : ?>
                    <input type="hidden" name="postId" value="<?= htmlspecialchars($postToEdit['idpost']); ?>" />
                <?php endif; ?>

                <label for="typeuser">Type d'utilisateur:</label>
                <select id="typeuser" name="typeuser" required>
                    <option value="Admin" <?= $postToEdit && $postToEdit['typeuser'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Member" <?= $postToEdit && $postToEdit['typeuser'] == 'Member' ? 'selected' : ''; ?>>Member</option>
                </select>

                <label for="authorname">Nom de l'Auteur:</label>
                <input type="text" id="authorname" name="authorname" placeholder="Nom de l'auteur" value="<?= $postToEdit ? htmlspecialchars($postToEdit['authorname']) : ''; ?>" required>

                <label for="typepost">Type de Post:</label>
                <select id="typepost" name="typepost" required>
                    <option value="Discussion" <?= $postToEdit && $postToEdit['typepost'] == 'Discussion' ? 'selected' : ''; ?>>Discussion</option>
                    <option value="Question" <?= $postToEdit && $postToEdit['typepost'] == 'Question' ? 'selected' : ''; ?>>Question</option>
                </select>

                <label for="titrePost">Titre :</label>
                <input type="text" id="titrePost" name="titrePost" placeholder="Titre du post" value="<?= $postToEdit ? htmlspecialchars($postToEdit['titleP']) : ''; ?>" required>

                <label for="contenuPost">Contenu :</label>
                <textarea id="contenuPost" name="contenuPost" rows="5" placeholder="Contenu du post" required><?= $postToEdit ? htmlspecialchars($postToEdit['contentP']) : ''; ?></textarea>

                <button type="submit"><?= $postToEdit ? 'Mettre à jour' : 'Enregistrer'; ?></button>
            </form>

            <!-- List of Posts -->
            <h2>Liste des Posts</h2>
            <div class="cards">
                <?php if ($postsList) : ?>
                    <?php foreach ($postsList as $post) : ?>
                        <div class="card">
                            <h3><?= htmlspecialchars($post['titleP']); ?></h3>
                            <p><strong>Auteur:</strong> <?= htmlspecialchars($post['authorname']); ?></p>
                            <p><strong>Type d'utilisateur:</strong> <?= htmlspecialchars($post['typeuser']); ?></p>
                            <p><strong>Type de Post:</strong> <?= htmlspecialchars($post['typepost']); ?></p>
                            <p><?= htmlspecialchars($post['contentP']); ?></p>
                            <p><strong>Date de création:</strong> <?= htmlspecialchars($post['createDateP']); ?></p>
                            <div class="actions">
                                <a href="?idpost=<?= $post['idpost']; ?>" class="edit">Modifier</a>
                                <a href="?deletepost=<?= $post['idpost']; ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')">Supprimer</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Aucun post disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
