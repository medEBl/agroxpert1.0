<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
include(__DIR__ . '/../../../controller/categoryc.php');
$blogController = new BlogController();
$blogs = $blogController->getAllBlogs();
$categoryController = new CategoryController(); // Créer une instance du contrôleur de catégories
$categories = $categoryController->getAllCategories(); // Récupérer toutes les catégories

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Contact</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo">
                <a href="home.html"><img src="images/logo.png"></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="../home/index.php">Home</a>
                    <a class="nav-item nav-link" href="../marketplace/shop.php">Market</a>
                    <a class="nav-item nav-link" href="taskfront.php">Blog</a>
                    <a class="nav-item nav-link" href="../meteo/taskfront.php">Meteo</a>
                    <a class="nav-item nav-link" href="../forum/forum.php">Forum</a>
                    <a class="nav-item nav-link" href="../event/taskfront.php">Event</a>
                    <a class="nav-item nav-link" href="../frontreclamation&reponse/create.php">Contact us</a>
                </div>
            </div>
            <div class="login_menu">
                <ul>
                    <li><a href="#">LOGIN</a></li>
                    <li>
                        <a href="#"><img src="images/search-icon.png"></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- banner section end -->
        <div class="banner_section layout_padding">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital ">Welcome<br> <span style="color: #fff; ">To AgroXpert</span></h1>
                                    <p class="banner_text ">Your Hub for Fresh Produce and Agricultural Expertise</p>

                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                            <div class="custum_menu">
                                <ul>
                                <li><a href="../home/index.php">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li class="active"><a href="taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li ><a href="../forum/forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">Event</a></li>
                                    <li><a href="../frontreclamation&reponse/create.php">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Explore<br> <span style="color: #fff;">AgroXpert Today!</span></h1>
                                    <p class="banner_text">Sustainably Sourced, Expertly Curated</p>

                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                            <div class="custum_menu">
                                <ul>
                                <li><a href="../home/index.php">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li class="active"><a href="taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li ><a href="../forum/forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">Event</a></li>
                                    <li><a href="../frontreclamation&reponse/create.php">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Only <br> <span style="color: #fff;">at AgroXpert</span></h1>
                                    <p class="banner_text">Discover Seasonal Flavors and Expert Tips</p>

                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1"></div>
                                </div>
                            </div>
                            <div class="custum_menu">
                                <ul>
                                    <li><a href="../home/index.php">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li class="active"><a href="taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li ><a href="../forum/forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">Event</a></li>
                                    <li><a href="../frontreclamation&reponse/create.php">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <div style="background-color:#f8f9fa;" ><s style="color:#f8f9fa;background-color:#f8f9fa;">.</s></div>
    <!-- header section end -->
<!-- Articles Section -->
<div class="article-container">
    <h2>Mon Blog</h2>
    <div class="controls">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par titre...">
        <button id="sortButton">Trier par Titre</button>
    </div>
    <div class="article-grid">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="article-item">
                    <img src="<?= htmlspecialchars($blog['image']) ?>" alt="Image de l'article">
                    <h3><?= htmlspecialchars($blog['titre']) ?></h3>
                    <p>
                        <?php
                        $excerpt = substr(htmlspecialchars($blog['contenu']), 0, 100);
                        echo $excerpt . (strlen($blog['contenu']) > 100 ? '...' : '');
                        ?>
                    </p>
                    <small>Publié le : <?= htmlspecialchars($blog['temps']) ?></small>
                    <small><span class="emoji">💬</span> Commentaires : <?= htmlspecialchars($blog['nb_comments']) ?></small>
                    <small><span class="emoji">👁️</span> Vues : <?= htmlspecialchars($blog['nb_vue']) ?></small>
                    <a href="../../backoffice/mimi/readmore.php?id=<?= $blog['id_blog'] ?>">Lire la suite</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-articles">Aucun article trouvé.</p>
        <?php endif; ?>
    </div>
</div>


<!-- Section Liste des Catégories -->
<div class="category-container">
    <h3>Catégories</h3>
    <ul>
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <li>
                    <a href="../../backoffice/mimi/blogs_by_category.php?category_id=<?= $category['id_category'] ?>"><?= htmlspecialchars($category['name']) ?></a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune catégorie trouvée.</p>
        <?php endif; ?>
    </ul>
</div>

    <style>
        /* Emoji style */
.emoji {
    margin-right: 5px;
    font-size: 16px;
}

/* Section Catégories */
/* Conteneur des catégories */
.category-container {
    margin-bottom: 40px;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

/* Titre de la section des catégories */
.category-container h3 {
    font-size: 28px;
    font-weight: 700;
    color: #4CAF50;
    text-align: center;
    margin-bottom: 20px;
}

/* Liste des catégories avec grille */
.category-container ul {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    padding: 0;
    list-style-type: none;
}

/* Élément de chaque catégorie */
.category-container li {
    background-color: #f1f1f1;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Ajouter une icône avant le texte de chaque catégorie */
.category-container li::before {
    content: "📚"; /* Vous pouvez remplacer cette icône par un autre symbole ou une icône font-awesome */
    font-size: 20px;
    margin-right: 10px;
}

/* Lien vers chaque catégorie */
.category-container a {
    text-decoration: none;
    color: #333;
    font-size: 18px;
    font-weight: bold;
    display: block;
    transition: color 0.3s ease, transform 0.3s ease;
}

/* Effet au survol du lien et de l'élément */
.category-container li:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.category-container a:hover {
    color: #4CAF50;
    transform: scale(1.05);
}

/* Message lorsqu'aucune catégorie n'est trouvée */
.category-container p {
    font-size: 16px;
    color: #888;
    text-align: center;
    margin-top: 20px;
}


/* General Styles */
/* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

/* Container for the article content */
.article-container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out;
}

.article-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #444;
    animation: slideInLeft 0.7s ease-out;
}

.article-container input#myInput {
    width: calc(100% - 100px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.article-container button#sortButton {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect on buttons */
.article-container button#sortButton:hover {
    background-color: #0056b3;
    transform: scale(1.05); /* Slight zoom effect */
}

.article-container .add-article-btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 20px;
    float: right;
    animation: bounceIn 1s ease-out;
}

.article-container .add-article-btn:hover {
    background-color: #218838;
    transform: translateY(-5px); /* Hover effect */
}

/* Articles Grid Layout */
.article-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    animation: fadeInUp 0.7s ease-out;
}

/* Section Mon Blog */
.article-container h2 {
    font-size: 32px;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Conteneur de la barre de recherche et du bouton */
.article-container .controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

/* Champ de Recherche */
.article-container input#myInput {
    width: 250px;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 25px;
    font-size: 14px;
    box-sizing: border-box;
    transition: all 0.3s ease;
    outline: none;
}

/* Focus Effect */
.article-container input#myInput:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
}

/* Bouton Trier par Titre */
#sortButton {
    padding: 8px 18px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s, transform 0.3s;
}

/* Hover effect for sorting button */
#sortButton:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .article-container .controls {
        flex-direction: column;
        gap: 10px;
    }

    .article-container input#myInput {
        width: 80%;
    }

    #sortButton {
        width: 80%;
    }
}

/* Article Card Styles */
.article-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 15px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    animation: fadeInUp 0.7s ease-out;
}

.article-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

/* Hover effect on images */
.article-item img {
    max-width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 10px;
    transition: transform 0.3s ease;
}

.article-item img:hover {
    transform: scale(1.1); /* Zoom effect on hover */
}

.article-item h3 {
    font-size: 18px;
    margin: 0 0 10px;
    color: #007bff;
}

.article-item p {
    margin: 0 0 10px;
    color: #555;
    font-size: 14px;
    line-height: 1.6;
}

.article-item small {
    display: block;
    margin-bottom: 10px;
    color: #888;
    font-size: 12px;
}

.article-item a {
    display: inline-block;
    margin-top: 5px;
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    transition: background-color 0.3s, transform 0.3s;
    text-align: center;
}

.article-item a:hover {
    background-color: #0056b3;
    transform: translateY(-3px); /* Slight lift effect */
}

/* No Articles Found */
.no-articles {
    text-align: center;
    color: #888;
    font-style: italic;
    animation: fadeIn 1s ease-out;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}


    </style>
    <!-- blog section end -->

    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">About</h2>
                    <p class="ipsum_text">Welcome to AgroXpert, your trusted hub for fresh, local produce, expert agricultural advice, and a thriving community of farmers and consumers. Our mission is to bridge the gap between farm and table, helping you make informed decisions
                        about the food you eat and the way it's grown.</p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">Services</h2>
                    <div class="footer_links">
                        <ul>
                        <li><a href="#">MarketPlace</a></li>
                            <li class="active"><a href="taskfront.php">Blogs</a></li>
                            <li><a href="../meteo/taskfront.php">Weather Alerts</a></li>
                            <li ><a href="../forum/forum.php">Forum</a></li>
                            <li ><a href="../event/taskfront.php">Event</a></li>
                            <li><a href="../frontreclamation&reponse/create.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">Our Products</h2>
                    <div class="footer_links">
                        <ul>
                        <li><a href="#">Seasonal Produce</a></li>
                            <li><a href="#">Organic Foods</a></li>
                            <li><a href="#">Gardening Supplies</a></li>
                            <li><a href="#">Meal Kits</a></li>
                            <li><a href="#">And more</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">contact us</h2>
                    <div class="addres_link">
                        <ul>
                            <li>
                                <a href="#"><img src="images/map-icon.png"><span class="padding_left_10">Esprit ,El ghazela</span></a>
                            </li>
                            <li>
                                <a href="#"><img src="images/call-icon.png"><span class="padding_left_10">+216 52522736</span></a>
                            </li>
                            <li>
                                <a href="#"><img src="images/mail-icon.png"><span class="padding_left_10">AgroXpert@gmail.com</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Fonction de recherche en temps réel
        function searchFunction() {
            var input, filter, articles, articleItem, title, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            articles = document.getElementsByClassName("article-item");

            // Parcourir chaque article et vérifier si le titre contient le texte de la recherche
            for (i = 0; i < articles.length; i++) {
                articleItem = articles[i];
                title = articleItem.getElementsByTagName("h3")[0];
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    articleItem.style.display = "";
                } else {
                    articleItem.style.display = "none";
                }
            }
        }

        // Fonction de tri des articles par titre
        document.addEventListener("DOMContentLoaded", function () {
            const articlesContainer = document.querySelector(".article-container");  // The container for the articles
            const articles = Array.from(articlesContainer.querySelectorAll(".article-item"));  // All articles
            const sortButton = document.querySelector("#sortButton");  // The sort button

            // Function to sort articles by title
            function sortArticlesByTitle() {
                const sortedArticles = articles.sort((a, b) => {
                    const titleA = a.querySelector("h3").textContent.trim();
                    const titleB = b.querySelector("h3").textContent.trim();
                    return titleA.localeCompare(titleB);
                });

                // Re-arrange articles in the container
                sortedArticles.forEach((article) => {
                    articlesContainer.appendChild(article);
                });
            }

            // Add event listener to sort button
            if (sortButton) {
                sortButton.addEventListener("click", sortArticlesByTitle);
            }
        });
    </script>
</body>

</html>
