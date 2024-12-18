<?php   


require_once(__DIR__ . '/../../../controller/zoneC.php');
require_once(__DIR__ . '/../../../controller/meteoC.php');

$message = '';
$editingzone = null;
$editingMeteo = null;


if (!isset($db)) {
    die("Erreur : Connexion à la base de données non initialisée.");
}


try {
    $zones = fetchZones($db); 
    if (!$zones) {
        $zones = []; 
    }
} catch (Exception $e) {
    $message = "Erreur : " . $e->getMessage();
    $zones = [];
}

if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    try {
        
        if (deleteZone($db, $delete_id)) {
            $message = "Zone supprimée avec succès.";
        } else {
            $message = "Erreur lors de la suppression de la zone.";
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}


if (isset($_POST['edit_id'])) {
    $editingId = (int)$_POST['edit_id'];
    try {
        $editingzone = fetchZoneById($db, $editingId); // Passez `$db` à la fonction
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}


if (isset($_POST['id_zone'])) {
    $id_zone = (int)$_POST['id_zone'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $latitude = $_POST['altitude']; 
    $longitude = $_POST['longitude'];

    
        
        try {
            if (updateZone($db, $id_zone, $nom, $description, $latitude, $longitude)) {
                $message = "Zone mise à jour avec succès.";
            } else {
                $message = "Erreur lors de la mise à jour de la zone.";
            }
        } catch (Exception $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    }
    if (isset($_POST['edit_id'])) {
        $editingId = (int)$_POST['edit_id'];
        $editingMeteo = fetchMeteoById($editingId);
        if (!$editingMeteo) {
            $message = "Erreur : Météo introuvable.";
        }
    }
    
    // Update weather entry
    if (isset($_POST['update'])) {
        $id_meteo = (int)$_POST['id_meteo'];
        $temperature = $_POST['temperature'];
        $humidite = $_POST['humidite'];
        $vent = $_POST['vent'];
        $zone = $_POST['zone'];
        $date = $_POST['date'];
        $heure = $_POST['heure']; // Nouveau champ*
    
        try {
            if (updateMeteo($id_meteo, $temperature, $humidite, $vent, $zone, $date, $heure)) {
                $message = "Météo mise à jour avec succès.";
            } else {
                $message = "Erreur lors de la mise à jour de la météo.";
            }
        } catch (Exception $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    }
    
    // Delete weather entry
    if (isset($_POST['delete_id'])) {
        $deleteId = (int)$_POST['delete_id'];
    
        try {
            if (deleteMeteo($deleteId)) {
                $message = "Météo supprimée avec succès.";
            } else {
                $message = "Erreur lors de la suppression de la météo.";
            }
        } catch (Exception $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    }
    
    // Fetch all weather entries
    try {
        $meteos = fetchMeteos();
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }



$editingzone = $editingzone ?? null;
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
                    <a class="nav-item nav-link" href="taskfront.php">Meteo</a>
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
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li class="active"><a href="taskfront.php">Meteo</a></li>
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
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li class="active"><a href="taskfront.php">Meteo</a></li>
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
                                    <li><a href="../front blog/taskfront.php">Blog</a></li>
                                    <li class="active"><a href="taskfront.php">Meteo</a></li>
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
    <!-- Forum section start  (el header wel footer mayetmashoush) -->
    <div class="content">
    <h1>Liste des zones</h1>
<style>
    
    /* Conteneur principal pour centrer */
    .main-content {
        flex: 1;
        padding: 30px;
        background: green;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Titres centrés */
    h1, h2 {
        text-align: center;
    }
    #map {
            height: 500px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    /* Centrer les tableaux */
    .table-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto; /* Centre le tableau */
        max-width: 1000px; /* Largeur maximale */
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: green;
        color: #fff;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }
</style>

</style>
<title>Carte Interactive avec Tri et Recherche</title>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <!-- Main Content -->
    </style>
<div class="content">
    <h1>Carte Tunisie</h1>

    <!-- Map -->
    <div id="map"></div>

    <!-- Search -->
    <div class="search-box">
        <label for="search">Rechercher une zone : </label>
        <input type="text" id="search" placeholder="Entrez le nom d'une zone" onkeyup="searchZones()">
    </div>

    <div class="table-container">
    <table id="zonesTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Nom</th>
                <th onclick="sortTable(1)">Description</th>
                <th onclick="sortTable(2)">Latitude</th>
                <th onclick="sortTable(3)">Longitude</th>
                <th onclick="sortTable(4)">Température</th>
                <th onclick="sortTable(5)">Humidité</th>
                <th onclick="sortTable(6)">Vent</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les lignes seront générées dynamiquement -->
        </tbody>
    </table>
</div>

<div id="map" style="height: 500px; margin-top: 20px;"></div>

<script>
    // Data for zones
    const zones = [
        { name: "Tunis", description: "nuageux", latitude: 36.8065, longitude: 10.1815, temperature: "27°C", humidity: "82%", wind: "7 km/h" },
        { name: "Sfax", description: "Ensoleillé", latitude: 34.7406, longitude: 10.7603, temperature: "30°C", humidity: "65%", wind: "10 km/h" },
        { name: "Sousse", description: "Pluvieux", latitude: 35.8256, longitude: 10.63699, temperature: "25°C", humidity: "70%", wind: "15 km/h" },
        { name: "Gafsa", description: "Chaud", latitude: 33.8815, longitude: 10.0982, temperature: "35°C", humidity: "40%", wind: "20 km/h" },
        { name: "Bizerte", description: "Venté", latitude: 37.2746, longitude: 9.8739, temperature: "22°C", humidity: "90%", wind: "5 km/h" }
    ];

    // Initialisation de la carte
    const map = L.map('map').setView([36.8065, 10.1815], 7);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Ajout des marqueurs sur la carte
    zones.forEach(zone => {
        const marker = L.marker([zone.latitude, zone.longitude]).addTo(map);
        marker.bindPopup(`
            <b>${zone.name}</b><br>
            ${zone.description}<br>
            Latitude: ${zone.latitude}<br>
            Longitude: ${zone.longitude}<br>
            Température: ${zone.temperature}<br>
            Humidité: ${zone.humidity}<br>
            Vent: ${zone.wind}
        `);
    });

    // Générer les lignes du tableau
    function loadTableData() {
        const tableBody = document.querySelector('#zonesTable tbody');
        tableBody.innerHTML = ''; // Clear existing rows
        zones.forEach(zone => {
            const row = `
                <tr>
                    <td>${zone.name}</td>
                    <td>${zone.description}</td>
                    <td>${zone.latitude}</td>
                    <td>${zone.longitude}</td>
                    <td>${zone.temperature}</td>
                    <td>${zone.humidity}</td>
                    <td>${zone.wind}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    // Load table data on page load
    loadTableData();
</script>

<script>
  
        
    mmm
    document.getElementById('search-button').addEventListener('click', function () {
        var cityName = document.getElementById('city-search').value.trim();

        if (!cityName) {
            alert('Veuillez entrer le nom d\'une ville.');
            return;
        }

        var city = cities.find(c => c.name.toLowerCase() === cityName.toLowerCase());

        if (!city) {
            alert('Ville non trouvée.');
            return;
        }

        map.setView([city.lat, city.lng], 10);
        var marker = L.marker([city.lat, city.lng]).addTo(map);

        fetch(`fetch_weather.php?city=${city.name}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    marker.bindPopup(`
                        <b>${city.name}</b><br>
                        Température : ${data.temperature} °C<br>
                        Humidité : ${data.humidity} %<br>
                        Vent : ${data.wind_speed} km/h
                    `).openPopup();
                } else {
                    marker.bindPopup(`<b>${city.name}</b><br>Erreur : ${data.error}`).openPopup();
                }
            })
            .catch(err => {
                marker.bindPopup(`<b>${city.name}</b><br>Erreur lors de la récupération des données.`).openPopup();
            });
    });
    
</script>
    
</script>
    

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
                            <li class="active"><a href="taskfront.php">Weather Alerts</a></li>
                            <li ><a href="../forum/forum.php">Forum</a></li>
                            <li a href="../event/taskfront.php">Event</a></li>
                            <li ><><a href="../frontreclamation&reponse/create.php">Contact Us</a></li>
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