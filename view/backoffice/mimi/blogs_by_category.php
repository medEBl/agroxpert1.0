<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
$blogController = new BlogController();

// Récupérer l'ID de la catégorie depuis l'URL
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

// Récupérer les blogs associés à cette catégorie
$blogs = $blogController->getBlogsByCategory($category_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Blogs par Catégorie</title>
    <link rel="stylesheet" href="cat.css">
</head>
<body>
    <div class="article-container">
        <p style="font-size: 30px;">Blogs dans cette catégorie</p>

        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="article-item">
                    <img src="<?= htmlspecialchars($blog['image']) ?>" alt="Image de l'article">
                    <div>
                        <h3><?= htmlspecialchars($blog['titre']) ?></h3>
                        <p><?= htmlspecialchars($blog['contenu']) ?></p>
                        <small>Publié le : <?= htmlspecialchars($blog['temps']) ?></small>
                        <a href="readmore.php?id=<?= $blog['id_blog'] ?>">Lire la suite</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun article trouvé dans cette catégorie.</p>
        <?php endif; ?>
    </div>
</body>
</html>
