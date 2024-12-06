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

                                    <!-- View more button to show full content and comments -->
                                    <button class="view-button" onclick="togglePostDetails(<?= $post['idpost']; ?>)">Voir le Post</button>
                                    <div id="post-details-<?= $post['idpost']; ?>" class="post-details" style="display: none;">
                                        <section>
                                            <p><strong>Type de Post:</strong> <?= htmlspecialchars($post['typepost']); ?></p>
                                            <p><?= htmlspecialchars($post['contentP']); ?></p>
                                        </section>

                                        <footer>
                                            <p><strong>Date de création:</strong> <?= htmlspecialchars($post['createDateP']); ?></p>
                                            <?php if (isset($post['updateDateP'])): ?>
                                                <p><strong>Date de mise à jour:</strong> <?= htmlspecialchars($post['updateDateP']); ?></p>
                                            <?php endif; ?>
                                            <!-- Views and Likes Count -->
                                            <p><strong>Vues:</strong> <span id="view-count-<?= $post['idpost']; ?>"><?= htmlspecialchars($post['nbviewsp']); ?></span></p>
                                            <p><strong>Likes:</strong> <?= htmlspecialchars($post['nblikesp']); ?></p>
                                            <p><strong>Dislikes:</strong> <?= htmlspecialchars($post['nbdislikesp']); ?></p>
                                        </footer>

                                        <!-- Like Button -->
                                        <form action="likepost.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="idpost" value="<?= $post['idpost']; ?>">
                                            <button type="submit">Like</button>
                                        </form>

                                        <!-- Dislike Button -->
                                        <form action="dislikepost.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="idpost" value="<?= $post['idpost']; ?>">
                                            <button type="submit">Dislike</button>
                                        </form>

                                        <!-- Button to toggle comments visibility -->
                                        <button class="view-comments-button" onclick="toggleComments(<?= $post['idpost']; ?>)">Voir les Commentaires</button>

                                        <div id="comments-<?= $post['idpost']; ?>" class="comments" style="display: none;">
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
                                        </div>

                                        <!-- Add Comment Form -->
                                        <form action="addcommentf.php" method="POST">
                                            <input type="hidden" name="idpostc" value="<?= $post['idpost']; ?>">
                                            <textarea name="contentC" rows="4" required placeholder="Ajoutez un commentaire..."></textarea><br>
                                            <button type="submit">Ajouter Commentaire</button>
                                        </form>
                                    </div>
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

    <script>
        // Function to handle toggle post details visibility and increment views
        function togglePostDetails(postId) {
            const postDetails = document.getElementById('post-details-' + postId);
            const viewCount = document.getElementById('view-count-' + postId);

            // Toggle visibility of the post details
            if (postDetails.style.display === "none") {
                postDetails.style.display = "block";

                // Increment the view count (you can also call the backend to update the view count in the database)
                fetch('incrementview.php?idpost=' + postId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            viewCount.innerText = data.newViewCount;
                        }
                    });
            } else {
                postDetails.style.display = "none";
            }
        }

        // Function to handle toggle comments visibility
        function toggleComments(postId) {
            const comments = document.getElementById('comments-' + postId);

            // Toggle visibility of comments
            if (comments.style.display === "none") {
                comments.style.display = "block";
            } else {
                comments.style.display = "none";
            }
        }
    </script>
</body>

</html>
