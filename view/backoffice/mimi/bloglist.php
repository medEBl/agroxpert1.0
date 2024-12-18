<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
$blogController = new BlogController();
$blogs = $blogController->getAllBlogs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Articles</title>
    
</head>
<body>
<style>/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #e0f7fa, #a7ffeb);
    color: #333;
}

/* Main Container */
.container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar Styling */
.sidebar {
    width: 250px;
    background-color: #004d40;
    color: #fff;
    padding: 40px;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
    color: #b2dfdb;
}

.sidebar nav ul {
    list-style: none;
    padding: 0;
}

.sidebar nav ul li {
    margin-bottom: 15px;
}

.sidebar nav ul li a {
    text-decoration: none;
    color: #e0f2f1;
    font-size: 18px;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s, transform 0.3s;
}

.sidebar nav ul li a:hover {
    background: #26a69a;
    transform: translateX(10px);
}

/* Main Content Area */
.article-container {
    flex: 1;
    padding: 30px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    margin-left: 20px;
}

/* Header */
h2 {
    font-size: 28px;
    color: #004d40;
    text-align: center;
    margin-bottom: 20px;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

/* Search and Sort */
#myInput {
    padding: 10px;
    margin-bottom: 20px;
    width: 100%;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

#sortButton {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    margin-bottom: 20px;
}

#sortButton:hover {
    background-color: #2980b9;
}

/* Add Article Button */
.add-article-btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 20px;
}

.add-article-btn:hover {
    background-color: #2980b9;
}

/* Article Item Styling */
.article-item {
    display: flex;
    border-bottom: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #ffffff;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.article-item img {
    width: 150px;
    height: auto;
    margin-right: 20px;
    border-radius: 8px;
}

.article-item div {
    flex: 1;
}

.article-item h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #004d40;
}

.article-item p {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
}

.article-item small {
    font-size: 12px;
    color: #777;
    display: block;
    margin-bottom: 5px;
}

.article-item a {
    color: #3498db;
    text-decoration: none;
    margin-right: 15px;
    font-size: 14px;
}

.article-item a:hover {
    text-decoration: underline;
}

/* No Articles Found */
.no-articles {
    text-align: center;
    font-size: 18px;
    color: #777;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 220px;
        padding: 20px;
    }

    .article-container {
        margin-left: 10px;
        padding: 15px;
    }

    .sidebar h2 {
        font-size: 20px;
    }

    .sidebar nav ul li a {
        font-size: 16px;
    }

    .article-item {
        flex-direction: column;
        padding: 10px;
    }

    .article-item img {
        width: 100%;
        margin-right: 0;
        margin-bottom: 10px;
    }

    #myInput {
        font-size: 14px;
        padding: 8px;
    }

    #sortButton {
        font-size: 14px;
        padding: 8px 15px;
    }
}
</style>
    <!-- Container Principal -->
    <div class="container">

        <!-- Sidebar / Dashboard -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                <li><a href="../user/gestion.php">Gestion de Compte</a></li>
                    <li><a href="../marketplace/productList.php">Gestion de Market</a></li>
                    <li><a href="bloglist.php">Gestion de Blog</a></li>
                    <li><a href="../back office/zonelist.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="../backreclamation&reponse/admin.php">Gestion de Feedback</a></li>
                    <li><a href="../eventt/listevent.php">Gestion d'event</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Articles Section -->
        <div class="article-container">
            <h2>Liste des Articles</h2>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par titre...">
            <button id="sortButton">Trier par Titre</button>
            <a href="addblog.php" class="add-article-btn">Ajouter un article</a>

            <?php if (!empty($blogs)): ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="article-item">
                        <img src="<?= htmlspecialchars($blog['image']) ?>" alt="Image de l'article">
                        <div>
                            <h3><?= htmlspecialchars($blog['titre']) ?></h3>
                            <p>
                                <?php
                                $excerpt = substr(htmlspecialchars($blog['contenu']), 0, 150);
                                echo $excerpt . (strlen($blog['contenu']) > 150 ? '...' : '');
                                ?>
                            </p>
                            <small>Publié le : <?= htmlspecialchars($blog['temps']) ?></small>
                            <small>commentaires : <?= htmlspecialchars($blog['nb_comments']) ?></small>
                            <small>Vues : <?= htmlspecialchars($blog['nb_vue']) ?></small>
                            <a href="updateblog.php?id=<?= $blog['id_blog'] ?>">Modifier</a>
                            <a href="deleteblog.php?id=<?= $blog['id_blog'] ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                            <a href="readmore.php?id=<?= $blog['id_blog'] ?>">Lire la suite</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-articles">Aucun article trouvé.</p>
            <?php endif; ?>
        </div>

    </div> <!-- End of container -->

</body>

<script>
    // Fonction de recherche
    function myFunction() {
        var input, filter, articles, article, title, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        articles = document.querySelectorAll(".article-item"); 

        for (i = 0; i < articles.length; i++) {
            article = articles[i];
            title = article.querySelector("h3");
            txtValue = title.textContent || title.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                article.style.display = "";
            } else {
                article.style.display = "none";
            }
        }
    }

    // Fonction pour trier les articles par titre
    document.addEventListener("DOMContentLoaded", function () {
        const articlesContainer = document.querySelector(".article-container");
        const articles = Array.from(articlesContainer.querySelectorAll(".article-item"));
        const sortButton = document.querySelector("#sortButton");

        function sortArticlesByTitle() {
            const sortedArticles = articles.sort((a, b) => {
                const titleA = a.querySelector("h3").textContent.trim();
                const titleB = b.querySelector("h3").textContent.trim();
                return titleA.localeCompare(titleB);
            });

            sortedArticles.forEach((article) => {
                articlesContainer.appendChild(article);
            });
        }

        sortButton.addEventListener("click", sortArticlesByTitle);
    });
</script>


</html>
