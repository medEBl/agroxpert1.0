<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');
require_once(__DIR__ . '/../../../controller/forumcommentcontroller.php');

// Instantiate controllers
$forumpostC = new ForumpostController();
$forumcommentC = new ForumCommentController();

// Get all posts
$list = $forumpostC->listpost();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Post List - Dashboard</title>
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
                    <li><a href="#">Gestion de Forum</a></li>
                    <!-- Add other sidebar items here -->
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>BackOffice - Gestion des Forums</h1>
                <div class="add-post">
        <form action="addpost.php" method="GET" style="text-align: right;">
            <button type="submit" class="add-comment-btn">Ajouter un Post</button>
        </form>
    </div>
            </header>

            <main>
                <h2>Liste des Posts</h2>
                <section id="postList">
                    <div class="cards">
                        <!-- Loop through the posts and display them -->
                        <?php if ($list) { ?>
                            <?php foreach ($list as $post) { ?>
                                <article class="card">
                                    <header>
                                        <h3><?= htmlspecialchars($post['titleP']); ?></h3>
                                        <p><strong>Auteur:</strong> <?= htmlspecialchars($post['authorname']); ?></p>
                                        <p><strong>Type d'utilisateur:</strong> <?= htmlspecialchars($post['typeuser']); ?></p>
                                    </header>

                                    <section>
                                        <p><strong>Type de Post:</strong> <?= htmlspecialchars($post['typepost']); ?></p>
                                        <p><?= htmlspecialchars($post['contentP']); ?></p>
                                    </section>

                                    <footer>
                                        <p><strong>Date de création:</strong> <?= htmlspecialchars($post['createDateP']); ?></p>
                                        <?php if (isset($post['updateDateP'])): ?>
                                            <p><strong>Date de mise à jour:</strong> <?= htmlspecialchars($post['updateDateP']); ?></p>
                                        <?php endif; ?>
                                    </footer>

                                    <!-- Actions Section -->
                                    <div class="actions">
                                        <a href="updatepost.php?idpost=<?= $post['idpost']; ?>" class="edit">Modifier</a>
                                        <a href="deletepost.php?idpost=<?= $post['idpost']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this post?');">Supprimer</a>
                                    </div>

                                    <!-- Display Comments -->
                                    <h4>Commentaires:</h4>
                                    <?php
                                    $comments = $forumcommentC->getCommentsByPostId($post['idpost']);
                                    if ($comments) {
                                        foreach ($comments as $comment) { ?>
                                            <div class="comment">
                                                <p><strong>Commentaire par <?= htmlspecialchars($comment['authorname']); ?>:</strong></p>
                                                <p><?= htmlspecialchars($comment['contentC']); ?></p>
                                                <p><small>Publié le: <?= htmlspecialchars($comment['createDateC']); ?></small></p>
                                                <?php if (isset($comment['updateDateC'])): ?>
                                                    <p><small>Mis à jour le: <?= htmlspecialchars($comment['updateDateC']); ?></small></p>
                                                <?php endif; ?>
                                                <p><small>Likes: <?= htmlspecialchars($comment['nblikec']); ?>, Dislikes: <?= htmlspecialchars($comment['nbdislikec']); ?></small></p>
                                                <div class="comment-actions">
                                                    <a href="updatecommentf.php?idcommentp=<?= $comment['idcommentp']; ?>" class="edit">Modifier</a>
                                                    <a href="deletecommentf.php?idcommentp=<?= $comment['idcommentp']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this comment?');">Supprimer</a>
                                                </div>
                                            </div>
                                        <?php }
                                    } else {
                                        echo "<p>Aucun commentaire.</p>";
                                    }
                                    ?>

                                    <!-- Add Comment Form -->
                                    <form action="addcommentf.php" method="POST">
                                        <input type="hidden" name="idpostc" value="<?= $post['idpost']; ?>">
                                        <textarea name="contentC" rows="4" required placeholder="Ajoutez un commentaire..."></textarea><br>
                                        <button type="submit">Ajouter Commentaire</button>
                                    </form>
                                </article>
                            <?php } ?>
                        <?php } else { ?>
                            <p>Aucun post n'a été trouvé.</p>
                        <?php } ?>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>
