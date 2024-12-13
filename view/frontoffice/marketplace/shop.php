<?php 
include '../../../controller/produitController.php';

$productController = new ProduitController();
$list = $productController->listProduits(); // Récupération de la liste des produits
$lowStockProducts = $productController->getLowStockProducts(); // Produits avec stock faible
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif">

    <style>
    /* Marketplace Grid */
    .marketplace {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Ajuste la largeur minimale */
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        margin: 20px auto;
        background: linear-gradient(to bottom, #81c784, #66bb6a); /* Dégradé vert moyen */
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15); /* Ombre plus douce */
    }

    .product-card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .product-card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px); /* Légère élévation pour l'interactivité */
    }

    .product-card h3 {
        font-size: 1.5em;
        color: #212121; /* Texte sombre pour contraste */
    }

    .product-card .category {
        font-size: 1em;
        color: #757575; /* Gris foncé */
        margin: 5px 0;
    }

    .product-card .price {
        font-size: 1.2em;
        font-weight: bold;
        color: #388e3c; /* Vert vif */
        margin-top: 10px;
    }

    .product-card .rating {
        font-size: 1em;
        color: #fbc02d; /* Jaune pour les évaluations */
        margin-top: 5px;
    }

    .product-card .discount {
        font-size: 1em;
        color: #e74c3c; /* Rouge pour les réductions */
        margin-top: 5px;
    }

    .product-card button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #27ae60;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .product-card button:hover {
        background-color: #1e8449;
        transform: scale(1.05);
    }

    /* Filter Dropdown */
    .filter-container {
        text-align: center;
        margin: 20px 0;
    }

    .filter-container select {
        padding: 10px;
        font-size: 1rem;
        border-radius: 25px;
        border: 2px solid #ddd;
        outline: none;
        background-color: #66bb6a;
        color: white;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .filter-container select:hover {
        background-color: #388e3c;
        color: #ffffff;
    }

    /* Button to View Cart */
    .view-cart-container {
        text-align: center;
        margin-top: 20px;
    }

    .view-cart-button {
        padding: 10px 20px;
        background-color: #27ae60;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1em;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }


/* Icône flottante pour la notification */
.notification-icon {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: #ff9800;
    color: white;
    text-align: center;
    line-height: 50px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.5em;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    transition: background-color 0.3s ease;
}

.notification-icon:hover {
    background-color: #f57c00;
}

/* Boîte d'alerte flottante */
.stock-alert-box {
    display: none; /* Cachée par défaut */
    position: fixed;
    top: 80px;
    right: 20px;
    width: 300px;
    background-color: #fff;
    border: 1px solid #ff9800;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 15px;
    font-family: Arial, sans-serif;
    color: #333;
    z-index: 999;
}

.stock-alert-box.active {
    display: block; /* Affiche la boîte */
}




    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo">
                <a href="home.html"><img src="images/logo.png" alt="Logo"></a>
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
                    <li><a href="#"><img src="images/search-icon.png" alt="Search"></a></li>
                </ul>
            </div>
        </nav>
        <div class="banner_section layout_padding">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="banner_taital">Welcome<br> <span style="color: #fff;">To AgroXpert</span></h1>
                                    <p class="banner_text">Your Hub for Fresh Produce and Agricultural Expertise</p>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="images/img-1.png" class="image_1" alt="Banner Image"></div>
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
            </div>
        </div>
    </div>

    <?php if (!empty($lowStockProducts)): ?>
    <!-- Icône de notification -->
    <div id="stockNotificationIcon" class="notification-icon">
        ⚠️
    </div>

    <!-- Boîte de message cachée -->
    <div id="stockAlertBox" class="stock-alert-box">
        <h4>🚨 Produits en stock faible :</h4>
        <ul>
            <?php foreach ($lowStockProducts as $product): ?>
                <li>
                    <strong><?php echo htmlspecialchars($product['nom']); ?></strong> - 
                    Stock restant : <span><?php echo $product['stock_quantity']; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


    <!-- Sorting Options -->
    <div class="filter-container">
        <label for="category-filter">Filter by Category:</label>
        <select id="category-filter" onchange="filterByCategory()">
            <option value="all">All</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="Grains">Grains</option>
        </select>
        <label for="sort">Sort by:</label>
        <select id="sort" onchange="sortProducts(this.value)">
            <option value="price">Price</option>
            <option value="rating">Rating</option>
            <option value="discount">Discount</option>
        </select>
    </div>
    


    <!-- Marketplace Grid -->
    <div class="marketplace">
    <?php foreach ($list as $product): ?>
        <div class="product-card" data-id="<?php echo $product['id_produit']; ?>" data-category="<?php echo htmlspecialchars($product['category']); ?>">
            <h3><?php echo htmlspecialchars($product['nom']); ?></h3>
            <p class="category">Category: <?php echo htmlspecialchars($product['category']); ?></p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <div class="price">Price: $<?php echo htmlspecialchars($product['prix']); ?></div>
            <div class="rating">Rating: <?php echo htmlspecialchars($product['rating']); ?>/5</div>
            <div class="discount">Discount: <?php echo htmlspecialchars($product['discount']); ?>%</div>
            <div class="stock">Quantity Available: <?php echo htmlspecialchars($product['stock_quantity']); ?></div>
            <form action="addCart.php" method="POST">
                <input type="hidden" name="id_produit" value="<?php echo $product['id_produit']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" <?php echo ($product['stock_quantity'] <= 0) ? 'disabled' : ''; ?>>Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
    </div>
    
    <script>
    // Filtrer les produits par catégorie
    function filterByCategory() {
        const selectedCategory = document.getElementById("category-filter").value;
        const productCards = document.querySelectorAll(".product-card");

        productCards.forEach(card => {
            const productCategory = card.getAttribute("data-category");
            if (selectedCategory === "all" || productCategory === selectedCategory) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    // Trier les produits par critère
    function sortProducts(criteria) {
        const products = Array.from(document.querySelectorAll('.product-card'));
        const container = document.querySelector('.marketplace');

        products.sort((a, b) => {
            const aValue = parseFloat(a.querySelector(`.${criteria}`).innerText.match(/[\d.]+/)[0]);
            const bValue = parseFloat(b.querySelector(`.${criteria}`).innerText.match(/[\d.]+/)[0]);
            return bValue - aValue;
        });

        container.innerHTML = '';
        products.forEach(product => container.appendChild(product));
    }


    document.addEventListener("DOMContentLoaded", function () {
        const notificationIcon = document.getElementById("stockNotificationIcon");
        const alertBox = document.getElementById("stockAlertBox");

        // Toggle de la classe active
        notificationIcon.addEventListener("click", function () {
            alertBox.classList.toggle("active");
         });
    });


    </script>



    <!-- Button to View Cart -->
    <div class="view-cart-container">
        <a href="cartList.php" class="view-cart-button">Voir Panier</a>
    </div>

  <!-- Footer Section -->
  <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">About</h2>
                    <p class="ipsum_text">Welcome to AgroXpert, your trusted hub for fresh, local produce, expert agricultural advice, and a thriving community of farmers and consumers.</p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h2 class="useful_text">Services</h2>
                    <div class="footer_links">
                        <ul>
                            <li><a href="#">Marketplace</a></li>
                            <li><a href="#">Blogs</a></li>
                            <li><a href="#">Weather Alerts</a></li>
                            <li><a href="#">Forum</a></li>
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
                    <h2 class="useful_text">Contact Us</h2>
                    <div class="addres_link">
                        <ul>
                            <li><a href="#"><img src="images/map-icon.png" alt="Map Icon"><span class="padding_left_10">Esprit, El Ghazela</span></a></li>
                            <li><a href="#"><img src="images/call-icon.png" alt="Call Icon"><span class="padding_left_10">+216 52522736</span></a></li>
                            <li><a href="#"><img src="images/mail-icon.png" alt="Mail Icon"><span class="padding_left_10">AgroXpert@gmail.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">Copyright 2024 All Right Reserved By.<a href="https://html.design"> TeachTech</a></p>
        </div>
    </div>

    <!-- JS Files -->
     
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="shop.js"></script>
</body>
</html>