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
                                            <p><strong>Vues:</strong> <span id="view-count-<?= $post['idpost']; ?>"><?= htmlspecialchars($post['nbviewsp']); ?></span></p>
                                            <p><strong>Likes:</strong> <?= htmlspecialchars($post['nblikesp']); ?></p>
                                            <p><strong>Dislikes:</strong> <?= htmlspecialchars($post['nbdislikesp']); ?></p>
                                        </footer>

                                        <form action="likepost.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="idpost" value="<?= $post['idpost']; ?>">
                                            <button type="submit">Up_vote</button>
                                        </form>
                                        <form action="dislikepost.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="idpost" value="<?= $post['idpost']; ?>">
                                            <button type="submit">Down_vote</button>
                                        </form>

                                        <div class="actions">
                                            <a href="updatepost.php?idpost=<?= $post['idpost']; ?>" class="edit">Modifier</a>
                                            <a href="deletepost.php?idpost=<?= $post['idpost']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this post?');">Supprimer</a>
                                        </div>

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
                                                        <div class="comment-reactions">
  
    <?php
    // List of all possible emojis and their default count (0)
    $reaction_types = [
        'heart' => '❤️',
        'thumbs_up' => '👍',
        'thumbs_down' => '👎',
        'laugh' => '😂',
    ];

    // Display each emoji with the count of reactions
    foreach ($reaction_types as $emoji => $icon) {
        // If the emoji matches the current one, use the emoji_count, otherwise set to 0
        if ($comment['emoji'] == $emoji) {
            $count = $comment['emoji_count'];
        } else {
            $count = 0;
        }
        // Display only the icon and count without text
        echo "<span class='reaction-icon'>$icon <span class='count'>$count</span></span>";
    }
    ?>
</div>


<style>
    .emoji {
        cursor: pointer; /* Ensures the cursor is a pointer (clickable) */
    }
    .comment-reactions {
    display: flex;
    gap: 15px; /* Adds space between each emoji */
    flex-wrap: wrap; /* Wraps to the next line if there isn't enough space */
    margin-top: 10px;
    align-items: center; /* Vertically align the items */
}

.reaction-icon {
    font-size: 24px; /* Adjust the size of the emojis */
    display: flex;
    align-items: center; /* Vertically align the emoji and count */
}

.count {
    margin-left: 5px; /* Adds a small space between the emoji and the count */
    font-size: 18px; /* Smaller font size for the count */
}

</style>
                                                        
<form action="reactcomment.php" method="POST" id="reaction-form-<?= $comment['idcommentp']; ?>">
    <input type="hidden" name="idcommentp" value="<?= $comment['idcommentp']; ?>">
    <div class="emoji-container">
        <span class="emoji" data-emoji="heart">❤️</span>
        <span class="emoji" data-emoji="thumbs_up">👍</span>
        <span class="emoji" data-emoji="thumbs_down">👎</span>
        <span class="emoji" data-emoji="laugh">😂</span>
    </div>
</form>


<script>
   // Attach event listeners for all emojis in the current comment
document.querySelectorAll('[id^="reaction-form-"]').forEach(function(form) {
    form.querySelectorAll('.emoji').forEach(function(emojiElement) {
        emojiElement.addEventListener('click', function() {
            // Get the emoji value
            var emoji = emojiElement.getAttribute('data-emoji');

            // Check if the hidden emoji input exists in the form
            let emojiInput = form.querySelector('input[name="emoji"]');
            if (!emojiInput) {
                // If not, create a new hidden input
                emojiInput = document.createElement('input');
                emojiInput.type = 'hidden';
                emojiInput.name = 'emoji';
                form.appendChild(emojiInput);
            }

            // Set the emoji value
            emojiInput.value = emoji;

            // Submit the form
            form.submit();
        });
    });
});

</script>



      


                                                       
                                                    </div>
                                                <?php }
                                            } else {
                                                echo "<p>Aucun commentaire.</p>";
                                            }
                                            ?>
                                        </div>

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
        function togglePostDetails(postId) {
            const postDetails = document.getElementById('post-details-' + postId);
            const viewCount = document.getElementById('view-count-' + postId);

            if (postDetails.style.display === "none") {
                postDetails.style.display = "block";
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

        function toggleComments(postId) {
            const comments = document.getElementById('comments-' + postId);
            comments.style.display = comments.style.display === "none" ? "block" : "none";
        }
       


    </script>
      <script src="script.js"></script>
</body>

</html>
