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
    <link rel="stylesoeet" href="css/owl.theme.default.min.css">
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
                    <a class="nav-item nav-link" href="index.html">Home</a>
                    <a class="nav-item nav-link" href="about.html">Market</a>
                    <a class="nav-item nav-link" href="services.html">Blog</a>
                    <a class="nav-item nav-link" href="products.html">Meteo</a>
                    <a class="nav-item nav-link" href="products.html">Forum</a>
                    <a class="nav-item nav-link" href="contact.html">Contact us</a>
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
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">Market</a></li>
                                    <li><a href="services.html">Blog</a></li>
                                    <li><a href="products.html">Meteo</a></li>
                                    <li class="active"><a href="products.html">Forum</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
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
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">Market</a></li>
                                    <li><a href="services.html">Blog</a></li>
                                    <li><a href="products.html">Meteo</a></li>
                                    <li class="active"><a href="products.html">Forum</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
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
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">Market</a></li>
                                    <li><a href="services.html">Blog</a></li>
                                    <li><a href="products.html">Meteo</a></li>
                                    <li class="active"><a href="products.html">Forum</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
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
    <!-- header section end -->
    <!-- Forum section start  (el header wel footer mayetmashoush) -->
  <!-- Forum section start  (el header wel footer mayetmashoush) -->

    <div class="main-content">
            

                <h1> Gestion des Forums</h1>
                <div class="add-post">
        <form action="addpostf.php" method="GET" style="text-align: right;">
            <button style="text-align:center" type="submit" class="add-comment-btn">Ajouter un Post</button>
        </form>
    </div>
            

            <main>
                <h2>Liste des Posts</h2>
                <section id="postList">
                    <div class="cards">
                        <!-- Loop through the posts and display them -->
                        <?php if ($list) { ?>
                            <?php foreach ($list as $post) { ?>
                                <article class="card">
                                    
                                        <h3><?= htmlspecialchars($post['titleP']); ?></h3>
                                        <p><strong>Auteur:</strong> <?= htmlspecialchars($post['authorname']); ?></p>
                                        <p><strong>Type d'utilisateur:</strong> <?= htmlspecialchars($post['typeuser']); ?></p>
                                    

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
                                        <a href="updatepostf.php?idpost=<?= $post['idpost']; ?>" class="edit">Modifier</a>
                                        <a href="deletepostf.php?idpost=<?= $post['idpost']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this post?');">Supprimer</a>
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
                                                    <a href="updatecomment.php?idcommentp=<?= $comment['idcommentp']; ?>" class="edit">Modifier</a>
                                                    <a href="deletecomment.php?idcommentp=<?= $comment['idcommentp']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this comment?');">Supprimer</a>
                                                </div>
                                            </div>
                                        <?php }
                                    } else {
                                        echo "<p>Aucun commentaire.</p>";
                                    }
                                    ?>

                                    <!-- Add Comment Form -->
                                    <form action="addcomment.php" method="POST">
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
<style>/* General Styling for Main Content */
.main-content {
    padding: 20px;
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.main-content h1 {
    color: #28a745;
    text-align: center;
    margin-bottom: 20px;
}

.main-content h2 {
    color: #2c3e50;
    margin-bottom: 15px;
}

/* Add Post Form Styling */
.add-post form {
    margin-bottom: 20px;
    text-align: right;
}

.add-post .add-comment-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.add-post .add-comment-btn:hover {
    background-color: #218838;
}

/* Cards for Posts */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card h3 {
    color: #2c3e50;
    margin-bottom: 10px;
}

.card p {
    color: #6c757d;
    margin: 5px 0;
}

/* Footer Section of Cards */
.card footer {
    border-top: 1px solid #ddd;
    margin-top: 15px;
    padding-top: 10px;
    color: #6c757d;
}

/* Actions Styling */
.actions {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

.actions a {
    text-decoration: none;
    padding: 5px 10px;
    color: white;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.actions .edit {
    background-color: #55a73f;

}

.actions .edit:hover {
    background-color: #e0a800;
}

.actions .delete {
    background-color: #55a73f;

}

.actions .delete:hover {
    background-color: #c82333;
}

/* Comments Section */
.comment {
    background-color: #f1f1f1;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
}

.comment p {
    margin: 5px 0;
}

.comment-actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.comment-actions a {
    font-size: 12px;
    padding: 5px 8px;
    text-decoration: none;
    color: white;
    border-radius: 3px;
}

.comment-actions .edit {
    background-color: #007bff;
}

.comment-actions .edit:hover {
    background-color: #0056b3;
}

.comment-actions .delete {
    background-color: #dc3545;
}

.comment-actions .delete:hover {
    background-color: #c82333;
}

/* Add Comment Form */
form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

form button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #218838;
}
</style>

    
    <!-- contact section end  (el header wel footer mayetmashoush)-->


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
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Weather Alerts</a></li>
                            <li class="active"><a href="#">Forum</a></li>
                            <li><a href="#">And more</a></li>
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
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">Copyright 2024 All Right Reserved By.<a href="https://html.design"> TeachTech</p>
         </div>
      </div>
      <!-- copyright section end -->    
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
        function example() {
  if (true) {
    console.log('Hello');
  } // Closing the 'if' block
} // Closing the function block

            
      </script>
      
   </body>
</html>