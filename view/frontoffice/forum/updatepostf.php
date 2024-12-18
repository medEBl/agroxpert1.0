<?php

session_start();

require_once(__DIR__ . '/../../../controller/forumcontroller.php');
require_once(__DIR__ . '/../../../model/forummodel.php');
require_once '../../../controller/userc.php';

$error = "";
$post = null;
$postId = null;

// Step 1: Check if `idpost` is passed in the URL
if (isset($_GET['idpost']) && !empty($_GET['idpost'])) {
    $postId = $_GET['idpost'];

    // Load the post data for the given ID
    $postController = new ForumpostController();
    if (!empty($_SESSION['id'])){
        $Id_UserP =  $_SESSION['id'];
    }
    $post = $postController->getpostbyid($postId);

    if (!$post) {
        $error = "Post not found.";
    }
} else {
    $error = "No post ID provided.";
}

// Step 2: Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["titrePost"], $_POST["contenuPost"], $_POST["typeuser"], $_POST["authorname"], $_POST["typepost"]) &&
        !empty($_POST["titrePost"]) && !empty($_POST["contenuPost"]) && !empty($_POST["typeuser"]) && !empty($_POST["authorname"]) && !empty($_POST["typepost"])
    ) {
        // Create a new post object with the form data
        $post = new ForumPost(
            $_POST['postId'],
            $_POST['typeuser'],
            $_POST['authorname'],
            $_POST['typepost'],
            $_POST['titrePost'],
            $_POST['contenuPost'],
            new DateTime(), // Update date
            new DateTime(), // Same for updateDateP
            0, // Default views
            0, // Default likes
            $Id_UserP // Assume user ID is 1 for now
        );

        try {
            // Attempt to update the post
            $postController->updatepost($post, $_POST['postId']);

            // Redirect to the posts list
            header('Location: forum.php');
            exit;
        } catch (Exception $e) {
            $error = "Error updating post: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
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
                    <a class="nav-item nav-link" href="../home/index.php">Home</a>
                    <a class="nav-item nav-link" href="../marketplace/shop.php">Market</a>
                    <a class="nav-item nav-link" href="../front blog/taskfront.php">Blog</a>
                    <a class="nav-item nav-link" href="../meteo/taskfront.php">Meteo</a>
                    <a class="nav-item nav-link" href="forum.php">Forum</a>
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
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li class="active"><a href="forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">EVent</a></li>
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
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li class="active"><a href="forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">EVent</a></li>
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
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li class="active"><a href="forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">EVent</a></li>
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
    <style>/* General Container Styling */
.container {
    display: flex;
    
    min-height: 100vh;
    
    
    font-family: Arial, sans-serif;
}

/* Main Content Styling */
.main-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    box-sizing: border-box;
}

.main-content header h1 {
    color: #007bff;
    text-align: center;
    margin-bottom: 20px;
}

/* Error Message Styling */
.main-content p {
    font-size: 14px;
    color: red;
    text-align: center;
    margin-bottom: 15px;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

form label {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

form input,
form select,
form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

form input:focus,
form select:focus,
form textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

/* Button Styling */
form button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 600px) {
    .main-content {
        padding: 20px;
    }

    form button {
        font-size: 14px;
    }
}
</style>
    <!-- header section end -->
    <!-- Forum section start  (el header wel footer mayetmashoush) -->

    <div class="container">
        <div class="main-content">
            <header>
                <h1>Update Forum Post</h1>
            </header>

            <!-- Error Message -->
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <?php if ($post) : ?>
                <form id="updateForm" action="updatepostf.php?idpost=<?= htmlspecialchars($post['idpost']); ?>" method="POST">
    <input type="hidden" name="postId" value="<?= htmlspecialchars($post['idpost']); ?>">

    <!-- User Type Dropdown -->
    <label for="typeuser">Type d'utilisateur:</label>
    <select id="typeuser" name="typeuser" required>
        <option value="">Choose...</option> <!-- 'Choose' option added -->
        <option value="Admin" <?= $post['typeuser'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="Member" <?= $post['typeuser'] == 'Member' ? 'selected' : ''; ?>>Member</option>
    </select>

    <label for="authorname">Nom de l'Auteur:</label>
    <input type="text" id="authorname" name="authorname" value="<?= htmlspecialchars($post['authorname']); ?>" required>

    <!-- Post Type Dropdown -->
    <label for="typepost">Type de Post:</label>
    <select id="typepost" name="typepost" required>
        <option value="">Choose...</option> <!-- 'Choose' option added -->
        <option value="Discussion" <?= $post['typepost'] == 'Discussion' ? 'selected' : ''; ?>>Discussion</option>
        <option value="Question" <?= $post['typepost'] == 'Question' ? 'selected' : ''; ?>>Question</option>
    </select>

    <label for="titrePost">Titre :</label>
    <input type="text" id="titrePost" name="titrePost" value="<?= htmlspecialchars($post['titleP']); ?>" required>

    <label for="contenuPost">Contenu :</label>
    <textarea id="contenuPost" name="contenuPost" rows="5" required><?= htmlspecialchars($post['contentP']); ?></textarea>

    <button type="submit">Update Post</button>
    <div id="errorMessages" style="color: red; margin-top: 10px;"></div>
</form>

            <?php else : ?>
                <p>No post found to update.</p>
            <?php endif; ?>
        </div>
    </div>





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
                        <li><a href="../marketplace/shop.php">MarketPlace</a></li>
                            <li><a href="../front blog/taskfront.php">Blogs</a></li>
                            <li><a href="../meteo/taskfront.php">Weather Alerts</a></li>
                            <li class="active"><a href="forum.php">Forum</a></li>
                            <li ><a href="../event/taskfront.php">Event</a></li>
                            <li><a href="../frontreclamation&reponse/create.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">Our Products</h2>
                    <div class="footer_links">
                        <ul>
                            <li><a href="../marketplace/shop.php">Seasonal Produce</a></li>
                            <li><a href="../marketplace/shop.php">Organic Foods</a></li>
                            <li><a href="../marketplace/shop.php">Gardening Supplies</a></li>
                            <li><a href="../marketplace/shop.php">Meal Kits</a></li>
                            <li><a href="../marketplace/shop.php">And more</a></li>
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
      <script src="script.js"></script>
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