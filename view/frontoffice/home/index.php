<?php
require_once __DIR__ . '/../../../controller/userc.php';
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../FU/index.php');
    exit();
}
$userController = new userc();
$userData = null; // Avoid undefined variable issues

if (!empty($_SESSION['id'])) { // Match the session variable name
    $id = $_SESSION['id'];
    $userData = $userController->getUserById($id);
    if ($userData) {
        $username = htmlspecialchars($userData['name']);
    } else {
        $username = "Guest"; // Fallback if user not found
    }
} else {
    $username = "Guest"; // Fallback if not logged in
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
    <title>XOFram</title>
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
                <a href="index.html"><img src="images/logo.png"></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.html">Home</a>
                    <a class="nav-item nav-link" href="../marketplace/shop.php">Market</a>
                    <a class="nav-item nav-link" href="../front blog/taskfront.php">Blog</a>
                    <a class="nav-item nav-link" href="../meteo/taskfront.php">Meteo</a>
                    <a class="nav-item nav-link" href="../forum/forum.php">Forum</a>
                    <a class="nav-item nav-link" href="../event/taskfront.php">Event</a>
                    <a class="nav-item nav-link" href="../frontreclamation&reponse/create.php">Contact us</a>
                </div>
            </div>
            <div class="login_menu">
                <ul>
                    <li><a href="../FU/index.php">LOGIN</a></li>
                    <li>
                        <a href="#"><img src="images/search-icon.png"></a>
                    </li>
                </ul>
                <h1 style="color:white;">Bienvenue, <?php echo $username; ?></h1>
                <a style="color:white;" href="../FU/logout.php">Déconnexion</a>
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
                                    <li class="active"><a href="index.html">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li><a href="../forum/forum.php">Forum</a></li>
                                    <li><a href="../event/taskfront.php">Event</a></li>
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
                                    <li class="active"><a href="index.html">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li><a href="../forum/forum.php">Forum</a></li>
                                    <li><a href="../event/taskfront.php">Event</a></li>
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
                                    <li class="active"><a href="index.html">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li><a href="../forum/forum.php">Forum</a></li>
                                    <li><a href="../event/taskfront.php">Event</a></li>
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
    <!-- header section end -->
    <!-- services section start -->
    <div class="services_section layout_padding">
        <div class="container">
            <h1 class="services_taital">Services</h1>
            <div class="services_section_2 layout_padding">
                <div class="row">
                    <div class="col-md-4">
                        <div class="image_main active">
                            <img src="images/img-2.png" class="image_2">
                            <h2 class="vegetable_text">MarketPlace</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="image_main">
                            <img src="images/blog.png" class="image_2">
                            <h2 class="vegetable_text">Blogs</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="image_main">
                            <img src="images/durable.jpg" class="image_2">
                            <h2 class="vegetable_text"> Éducation à l’Agriculture Durable</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services_section_3 layout_padding">
                <div class="row">
                    <div class="col-md-6">
                        <div class="image_main">
                            <img src="images/weather.jpg" class="image_2">
                            <h2 class="vegetable_text">Weather Alerts</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="image_main">
                            <img src="images/forum.jpg" class="image_2">
                            <h2 class="vegetable_text">Forum</h2>
                        </div>
                    </div>

                </div>
            </div>
            <div class="read_bt_1">
                <a href="#">Go Up</a>
            </div>
        </div>
    </div>
    <!-- services section end -->
    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="about_main">
                        <h1 class="about_taital">Our Vision</h1>
                        <p class="about_text"> At AgroXpert, we envision a world where food is sourced locally, sustainably, and directly from those who grow it. We aim to be a hub for agricultural innovation and sustainable food consumption, making it easier for consumers
                            to access fresh, healthy products while supporting the livelihoods of local farmers.</p>
                        <div class="readmore_bt"><a href="#">Go Up</a></div>
                    </div>
                </div>
                <div class="col-md-6 padding_0">
                    <div class="image_7"><img src="images/img-7.png"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- resources section start -->
    <div class="resources_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="resources_main">
                        <h1 class="resources_taital">Resources for Farming</h1>
                        <h6 class="resources_taital_1">Empowering Farmers with Knowledge and Resources</h6>
                        <p class="resources_text">At AgroXpert, we provide farmers with valuable tools and knowledge to enhance agricultural practices. Our platform offers practical advice on crop management, seasonal farming tips, and sustainable techniques to help increase productivity
                            and reduce environmental impact.</p>
                        <div class="readmore_bt_1"><a href="#">Read More</a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div><img src="images/img-8.png" class="image_8"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- resources section end -->
    <!-- choose section star -->
    <div class="choose_section layout_padding">
        <div class="container">
            <h1 class="choose_taital">Why Choose Us</h1>
            <p class="choose_text">Empowering Farmers, Connecting Consumers, and Ensuring Fresh, Sustainable Produce Every Day!</p>
            <div class="choose_section_2 layout_padding">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="icon_1"><img src="images/icon-1.png"></div>
                        <h2 class="farm_text">Best Farm</h2>
                        <p class="dummy_text"> Our platform is packed with expert advice, tools, and tips to optimize your farming techniques and boost crop yields.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="icon_1"><img src="images/icon-1.png"></div>
                        <h2 class="farm_text">Fresh <br>Food and vegetables</h2>
                        <p class="dummy_text">We ensure that you get the freshest produce directly from local farmers, supporting healthier lifestyles and promoting sustainable agriculture</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="icon_1"><img src="images/icon-1.png"></div>
                        <h2 class="farm_text">100%Pure</h2>
                        <p class="dummy_text">Our commitment to quality means you can trust that all products sourced through AgroXpert are 100% pure, free from chemicals and pesticides.</p>
                    </div>
                </div>
            </div>
            <div class="read_bt_1"><a href="#">Go Up</a></div>
        </div>
    </div>
    <!-- choose section end -->
    <!-- blog section start -->

    <!-- blog section end -->
    <!-- newsletter section start -->
    <div class="newsletter_section layout_padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="newsletter_main">
                        <h1 class="newsletter_taital">Subscribe Our Newsletter</h1>
                        <p class="newsletter_text">Sign up for our newsletter and get the latest updates, seasonal produce recommendations, farming tips, exclusive offers, and much more delivered directly to your inbox! Whether you're a passionate gardener, a fresh food enthusiast,
                            or someone looking to support local agriculture, our newsletter is the best way to stay connected with everything happening at AgroXpert. </p>

                        <div class="subscribe_bt"><a href="#">Go Up</a></div>
                    </div>
                </div>
                <div class="col-md-6 padding_right_0">
                    <div class="image_12"><img src="images/img-12.png"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- newsletter section end -->
    <!-- client section start -->
    <div class="client_section layout_padding">
        <div class="container">
            <h1 class="choose_taital">What says our cutomers</h1>
            <p class="choose_text">See What People Are Saying About AgroXpert</p>
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="client_section_2 layout_padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="siaalya_text">Marie Dubois</h2>
                                    <p class="lorem_text">“I love how easy it is to buy fresh produce directly from farmers. AgroXpert has made it so convenient for me to get high-quality fruits and vegetables delivered straight to my doorstep!</p>
                                    <div class="quite_icon">
                                        <a href="#">
                                            <img src="images/quite-icon.png">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="siaalya_text">Paul Dupont</h2>
                                    <p class="lorem_text">“The recipes they share are fantastic! I’ve tried a few and my family loves them. It’s so helpful to have fresh, seasonal ingredients delivered, especially from local farmers.”</p>
                                    <div class="quite_icon">
                                        <a href="#"><img src="images/quite-icon.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="client_section_2 layout_padding">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="siaalya_text">Michel Lefevre </h2>
                                    <p class="lorem_text">“I’ve been buying from AgroXpert for months now, and I’m never disappointed. The quality of their produce is unmatched, and I trust that I’m supporting local farmers while getting the best food for my family.”</p>
                                    <div class="quite_icon">
                                        <a href="#"><img src="images/quite-icon.png"></div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="siaalya_text">Sophie Martin</h2>
                                    <p class="lorem_text">“AgroXpert is my go-to for fresh food and farming tips. Their customer service is amazing, and I always feel like I’m getting the best of what’s in season.”</p>
                                    <div class="quite_icon">
                                        <a href="#"><img src="images/quite-icon.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="next">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- contact section start -->

        <!-- contact section end -->
    </div>
    <!-- client section end -->
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