<?php
session_start();

// Inclure le contrôleur
include '../../../controller/reclamationcontroller.php';
// include '../../model/reclamation.php';
require_once '../../../vendor/autoload.php'; // Inclure l'autoloader de Composer pour PHPMailer
require_once '../../../controller/userc.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = "";

// Créer une instance du contrôleur
$reclamationController = new ReclamationController();
if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} 
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["datereclamation"], $_POST["description"], $_POST["statut"],
         $_POST["tel"], $_POST["adresse"])
    ) {
        if (
            !empty($_POST["datereclamation"]) && !empty($_POST["description"]) &&
            !empty($_POST["statut"])  &&
            !empty($_POST["tel"]) && !empty($_POST["adresse"])
        ) {
            // Récupérer les données
            $email = $_POST['adresse']; // Adresse email de l'utilisateur

            // Valider l'adresse email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse email invalide.";
            } else {
                try {
                    // Créer un objet Reclamation
                    $reclamation = new Reclamation(
                        null, // ID est généré automatiquement par la base de données
                        new DateTime($_POST['datereclamation']), // Convertir la date en objet DateTime
                        $_POST['description'],
                        $_POST['statut'],
                        $id_user, // Convertir en entier
                        (int)$_POST['tel'],
                        $email
                    );

                    // Ajouter la réclamation via le contrôleur
                    $reclamationController->addReclamation($reclamation);

                    // Envoyer l'email de confirmation
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'agroxpert.web@gmail.com'; // Remplacez par votre email
                    $mail->Password = 'yljclmobtaajnudo'; // Mot de passe d'application Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('agroxpert.web@gmail.com', 'Service Reclamation');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Confirmation de votre réclamation';
                    $mail->Body = "
                        <div style='font-family: Arial, sans-serif; font-size: 16px; color: #333;'>
                            <h2 style='text-align: center;'>Réclamation enregistrée</h2>
                            <p>Bonjour,</p>
                            <p>Nous avons bien reçu votre réclamation. Voici les détails :</p>
                            <ul>
                                <li><strong>Date :</strong> {$_POST['datereclamation']}</li>
                                <li><strong>Description :</strong> {$_POST['description']}</li>
                            </ul>
                            <p>Nous traiterons votre réclamation dans les plus brefs délais.</p>
                            <p>Cordialement,</p>
                            <p>L'équipe de support.</p>
                        </div>
                    ";

                    $mail->send();
                    echo "Email de confirmation envoyé à $email.";

                    // Redirection après succès
                    header("Location: list_reclamations.php");
                    exit;
                } catch (Exception $e) {
                    $error = "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
                }
            }
        } else {
            $error = "Veuillez remplir tous les champs.";
        }
    } else {
        $error = "Données manquantes.";
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
        <h1>Soumettre une Réclamation</h1>
        <form method="POST" action="" id="reclamationForm">
            <div class="form-group">
                <label for="datereclamation">Date de Réclamation :</label>
                <input type="date" id="datereclamation" name="datereclamation" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="statut">Statut :</label>
                <select id="statut" name="statut" required>
                    <option value="non_traite">Non traité</option>
                    <option value="en_cours">En cours</option>
                    <option value="traite">Traité</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="tel">Téléphone :</label>
                <input type="tel" id="tel" name="tel" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse Email :</label>
                <input type="email" id="adresse" name="adresse" required>
            </div>
            <button type="submit" class="btn-submit">Soumettre</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>
    </div>
    <div     style=background-color: #f8f9fa;></div>
  
<style>/* Global Styles */


/* Container */
.container {
   
    padding: 20px 30px 10px 10px;
   
   
   
}

/* Form Styles */
h1 {
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

textarea {
    resize: none;
}

button.btn-submit {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button.btn-submit:hover {
    background-color: #0056b3;
}

/* Error Message */
.error-message {
    color: #d9534f;
    margin-top: 10px;
    font-weight: bold;
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
                        <li><a href="../marketplace/shop.php">MarketPlace</a></li>
                            <li><a href="../front blog/taskfront.php">Blogs</a></li>
                            <li><a href="../meteo/taskfront.php">Weather Alerts</a></li>
                            <li ><a href="../forum/forum.php">Forum</a></li>
                            <li a href="../event/taskfront.php">Event</a></li>
                            <li class="active"><><a href="create.php">Contact Us</a></li>
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