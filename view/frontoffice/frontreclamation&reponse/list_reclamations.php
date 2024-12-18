<?php
session_start();
// Inclure le contrôleur pour récupérer les réclamations
include '../../../controller/reclamationcontroller.php';
require_once '../../../controller/userc.php';

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();
  
if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} 
// Récupérer la liste des réclamations depuis la base de données
$reclamations = $reclamationController->listReclamation();
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
    <style>
        
        
        h1 {
            text-align: center;
            color: #333;
        }
        .reclamation-list {
            margin-top: 20px;
        }
        .reclamation-item {
            background-color: #f9f9f9;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .status-label {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .status-label.traite {
            background-color: #28a745;
        }
        .status-label.non-traite {
            background-color: #dc3545;
        }
        .reclamation-item p {
            margin: 5px 0;
        }
        .delete-btn, .reply-btn {
            display: inline-block;
            padding: 10px 20px; /* Espace interne augmenté pour un meilleur confort visuel */
            font-size: 16px; /* Taille de police légèrement augmentée */
            font-weight: bold; /* Texte en gras pour une meilleure lisibilité */
            color: white; /* Couleur du texte */
            text-decoration: none; /* Supprimer les soulignements */
            border-radius: 5px; /* Coins arrondis */
            transition: background-color 0.3s ease; /* Animation fluide pour les interactions */
            margin-right: 12px; /* Marges légèrement augmentées pour plus d'espace */
            cursor: pointer; /* Curseur en main */
        }

        .delete-btn {
            background-color: #dc3545; /* Rouge pour "supprimer" */
        }

        .delete-btn:hover {
            background-color: #c82333; /* Rouge légèrement plus foncé au survol */
        }

        .reply-btn {
            background-color: #ffc107; /* Jaune pour "modifier" */
            color: #212529; /* Couleur du texte en noir pour contraster avec le fond */
        }

        .reply-btn:hover {
            background-color: #e0a800; /* Jaune plus foncé au survol */
        }

        .reply-btn[disabled] {
            cursor: not-allowed; /* Curseur bloqué */
            background-color: #ddd; /* Gris pour désactiver */
            color: #aaa; /* Texte grisé */
            pointer-events: none; /* Désactiver les clics */
        }

        .respond-btn {
            display: inline-block;
            background-color: #28a745; /* Vert pour indiquer une action positive */
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        .respond-btn:hover {
            background-color: #218838; /* Couleur plus foncée au survol */
        }

        .respond-btn:disabled, 
        .respond-btn[disabled] {
            background-color: #ccc; /* Gris pour le désactiver */
            color: #666;
            cursor: not-allowed;
            pointer-events: none;
        }
        .view-responses-btn {
            display: inline-block;
            background-color: #6f42c1; /* Violet foncé pour une touche élégante */
            color: #fff;
            text-decoration: none;
            padding: 10px 15px; /* Espace interne */
            border-radius: 5px; /* Coins arrondis */
            font-size: 14px; /* Taille de la police */
            font-weight: bold; /* Texte en gras */
            border: none; /* Pas de bordure */
            transition: background-color 0.3s ease; /* Animation fluide */
            cursor: pointer; /* Curseur en main */
        }

        .view-responses-btn:hover {
            background-color: #0056b3; /* Couleur bleue plus foncée au survol */
        }

        .view-responses-btn:disabled, 
        .view-responses-btn[disabled] {
            background-color: #ccc; /* Gris pour état désactivé */
            color: #666; /* Texte grisé */
            cursor: not-allowed; /* Curseur bloqué */
            pointer-events: none; /* Désactivation des clics */
        }


    </style>
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
                    <a class="nav-item nav-link" href="../forum/forum.php">Forum</a>
                    <a class="nav-item nav-link" href="../event/taskfront.php">Event</a>
                    <a class="nav-item nav-link" href="create.php">Contact us</a>
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
                                    <li ><a href="../forum/forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">Event</a></li>
                                    <li class="active"><a href="create.php">Contact us</a></li>
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
                                    <li ><a href="../forum/forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">Event</a></li>
                                    <li class="active"><a href="create.php">Contact us</a></li>
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
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="../marketplace/shop.php">Market</a></li>
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li><a href="../meteo/taskfront.php">Meteo</a></li>
                                    <li ><a href="../forum/forum.php">Forum</a></li>
                                    <li ><a href="../event/taskfront.php">Event</a></li>
                                    <li  class="active"><a href="create.php">Contact us</a></li>
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
    <!-- services section start -->
  <!-- --------------------------------------------------------------------------------------------------------------------------- -->   
  <div class="container">
    <h1>Mes Réclamations</h1>

     
     <div class="reclamation-list">
        <?php
        if ($reclamations) {
            foreach ($reclamations as $reclamation) {
                echo '<div class="reclamation-item">';
                
                 
                $statusClass = $reclamation['statut'] === 'traite' ? 'traite' : 'non-traite';
                echo '<div class="status-label ' . $statusClass . '">' . htmlspecialchars($reclamation['statut']) . '</div>';
                
                // Affichage des champs
                echo '<p><strong>Date de Réclamation : </strong>' . htmlspecialchars($reclamation['datereclamation']) . '</p>';
                echo '<p><strong>Description : </strong>' . htmlspecialchars($reclamation['description']) . '</p>';
                echo '<p><strong>Utilisateur : </strong>ID #' . htmlspecialchars($id_user) . '</p>';
                echo '<p><strong>Téléphone : </strong>' . htmlspecialchars($reclamation['tel']) . '</p>';
                echo '<p><strong>Adresse : </strong>' . htmlspecialchars($reclamation['adresse']) . '</p>';
                ?> 
                
                
                <!-- Boutons pour répondre et modifier -->
                <a class="delete-btn" href="deletefront.php?id=<?php echo $reclamation['id']; ?>">supprimer</a>
                <?php if ($reclamation['statut'] !== 'traite'): ?>
                    <a class="reply-btn" href="update.php?id=<?php echo $reclamation['id']; ?>">Modifier</a>
                    <a class="respond-btn" href="repondrefront.php?id=<?php echo $reclamation['id']; ?>">Répondre</a>
                <?php else: ?>
                    <a class="reply-btn" disabled>Modifier</a>
                    <a class="respond-btn" disabled>Répondre</a>
                <?php endif; ?>
                <a class="view-responses-btn" href="voirreponse.php?id=<?php echo $reclamation['id']; ?>">Voir Réponses</a>

                <?php
                echo '</div>';
            }
        } else {
            echo '<p>Aucune réclamation trouvée.</p>';
        }
        ?>
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
                        <li><a href="#">MarketPlace</a></li>
                            <li><a href="../front blog/taskfront.php">Blogs</a></li>
                            <li><a href="../meteo/taskfront.php">Weather Alerts</a></li>
                            <li ><a href="../forum/forum.php">Forum</a></li>
                            <li ><a href="../event/taskfront.php">Event</a></li>
                            <li class="active"><a href="create.php">Contact Us</a></li>
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