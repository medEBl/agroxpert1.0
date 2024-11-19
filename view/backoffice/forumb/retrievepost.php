<?php
require_once(__DIR__ . '/../../../controller/forumcontroller.php');

// Instantiate the controller
$forumpostC = new ForumpostController();

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
            </header>

            <main>
                <h2>Liste des Posts</h2>
                <section id="postList">
                    <div class="cards">
                        <!-- Loop through the posts and display them -->
                        <?php if ($list) { // Check if posts exist ?>
                            <?php foreach ($list as $post) { ?>
                                <div class="card">
                                    <h3><?= htmlspecialchars($post['titleP']); ?></h3>
                                    <p><?= htmlspecialchars($post['contentP']); ?></p>
                                    <p><strong>Date de création :</strong> <?= htmlspecialchars($post['createDateP']); ?></p>
                                    <div class="actions">
                                        <a href="updatepost.php?idpost=<?= $post['idpost']; ?>" class="edit">Modifier</a>
                                        <a href="deletepost.php?idpost=<?= $post['idpost']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this post?');">Supprimer</a>
                                    </div>
                                </div>
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
