<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de la Tunisie - Météo</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7fa, #a7ffeb);
            display: flex;
        }

        header {
            background-color: #004d40;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .sidebar {
            width: 210px;
            background-color: #004d40;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            font-size: 22px;
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
            font-size: 16px;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .sidebar nav ul li a:hover {
            background: #26a69a;
            transform: translateX(10px);
        }

        #search-container {
            position: fixed;
            top: 100px;
            left: 210px;
            z-index: 1000;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
        }

        #city-search {
            width: 200px;
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #search-button {
            padding: 5px 10px;
            background-color: #004d40;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #search-button:hover {
            background-color: #26a69a;
        }

        #container {
            margin-left: 200px; /* Laisser de la place pour le sidebar */
            margin-top: 80px; /* Ajustement pour l'en-tête fixe */
            display: flex;
            justify-content: center; /* Centrer la carte horizontalement */
            align-items: center; /* Centrer la carte verticalement */
            height: calc(100vh - 80px); /* Exclure la hauteur de l'en-tête */
        }

        #map {
            width: 1000px; /* Réduction de la largeur de la carte */
            height: 600px; /* Réduction de la hauteur de la carte */
            border: 2px solid #004d40;
            border-radius: 8px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #004d40;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    Carte de la Tunisie - Cliquez sur une ville pour voir la météo
</header>

<aside class="sidebar">
    <h2>Mon Dashboard</h2>
    <nav>
        <ul>
        <li><a href="../user/gestion.php">Gestion de Compte</a></li>
                    <li><a href="../marketplace/productList.php">Gestion de Market</a></li>
                    <li><a href="../mimi/bloglist.php">Gestion de Blog</a></li>
                    <li><a href="../back office/zonelist.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="../backreclamation&reponse/admin.php">Gestion de Feedback</a></li>
                    <li><a href="../eventt/listevent.php">Gestion d'event</a></li>
        </ul>
    </nav>
</aside>

<div id="search-container">
    <input type="text" id="city-search" placeholder="Rechercher une ville..." />
    <button id="search-button">Rechercher</button>
</div>

<div id="container">
    <div id="map"></div>
</div>

<footer>
    © 2024 - Carte interactive de la Tunisie
</footer>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Initialisation de la carte
    var map = L.map('map').setView([33.8869, 9.5375], 7);

    // Ajout des tuiles OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Liste des villes en Tunisie
    var cities = [
        { name: "Tunis", lat: 36.8065, lng: 10.1815 },
        { name: "Sfax", lat: 34.7406, lng: 10.7603 },
        { name: "Sousse", lat: 35.8256, lng: 10.63699 },
        { name: "Gabès", lat: 33.8815, lng: 10.0982 },
        { name: "Bizerte", lat: 37.2746, lng: 9.8739 },
        { name: "Monastir", lat: 35.7771, lng: 10.8261 }
    ];

    // Ajouter des marqueurs pour chaque ville
    cities.forEach(city => {
        var marker = L.marker([city.lat, city.lng]).addTo(map);
        marker.bindPopup(`<b>${city.name}</b><br>Cliquer pour voir la météo.`);

        marker.on('click', function () {
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
    });

    // Fonction de recherche de ville
    document.getElementById('search-button').addEventListener('click', function () {
        var cityName = document.getElementById('city-search').value.trim();

        if (!cityName) {
            alert('Veuillez entrer le nom d\'une ville.');
            return;
        }

        // Vérifier si la ville est dans la liste
        var city = cities.find(c => c.name.toLowerCase() === cityName.toLowerCase());

        if (!city) {
            alert('Ville non trouvée. Veuillez vérifier l\'orthographe.');
            return;
        }

        // Centrer la carte sur la ville et afficher sa météo
        map.setView([city.lat, city.lng], 10);
        var marker = L.marker([city.lat, city.lng]).addTo(map);

        // Récupération des données météo pour la ville recherchée
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

</body>
</html>
