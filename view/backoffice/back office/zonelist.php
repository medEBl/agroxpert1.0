<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Interactive avec Tri et Recherche</title>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            background: #f4f4f9;
            color: #333;
        }

        /* Sidebar */
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

        /* Main Content */
        .content {
            margin-left: 270px;
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #004d40;
            font-size: 26px;
            margin-bottom: 20px;
        }

        #map {
            height: 500px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #004d40;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
            cursor: pointer;
        }

        th:hover {
            background: #26a69a;
        }

        tr:hover {
            background: #f4f4f4;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
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
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<div class="content">
    <h1>Carte Interactive avec Tri et Recherche</h1>

    <!-- Map -->
    <div id="map"></div>

    <!-- Search -->
    <div class="search-box">
        <label for="search">Rechercher une zone : </label>
        <input type="text" id="search" placeholder="Entrez le nom d'une zone" onkeyup="searchZones()">
    </div>

    <!-- Table -->
    <div class="table-container">
        <table id="zonesTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">Nom</th>
                    <th onclick="sortTable(1)">Description</th>
                    <th onclick="sortTable(2)">Latitude</th>
                    <th onclick="sortTable(3)">Longitude</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les lignes seront générées dynamiquement -->
            </tbody>
        </table>
    </div>
</div>

<script>
    const zones = [
        { name: "Tunis ", description: "Description de la zone A", latitude: 36.8065, longitude: 10.1815 },
        { name: "Sfax", description: "Description de la zone B", latitude: 34.7406, longitude: 10.7603 },
        { name: "Sousse", description: "Description de la zone C", latitude: 35.8256, longitude: 10.63699 },
        { name: "Gafsa", description: "Description de la zone D", latitude: 33.8815, longitude: 10.0982 },
        { name: "Bizerte", description: "Description de la zone E", latitude: 37.2746, longitude: 9.8739 }
    ];

    // Initialisation de la carte
    const map = L.map('map').setView([36.8065, 10.1815], 7);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Ajout des marqueurs sur la carte
    zones.forEach(zone => {
        const marker = L.marker([zone.latitude, zone.longitude]).addTo(map);
        marker.bindPopup(`<b>${zone.name}</b><br>${zone.description}<br>Latitude: ${zone.latitude}<br>Longitude: ${zone.longitude}`);
    });

    // Générer les lignes du tableau
    function loadTableData() {
        const tableBody = document.querySelector('#zonesTable tbody');
        tableBody.innerHTML = ''; // Réinitialiser le tableau
        zones.forEach(zone => {
            const row = `
                <tr>
                    <td>${zone.name}</td>
                    <td>${zone.description}</td>
                    <td>${zone.latitude}</td>
                    <td>${zone.longitude}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    // Fonction de tri du tableau
    function sortTable(columnIndex) {
        const table = document.getElementById('zonesTable');
        const rows = Array.from(table.rows).slice(1); // Exclure l'en-tête
        let sortedRows;

        if (columnIndex === 2 || columnIndex === 3) {
            sortedRows = rows.sort((a, b) => parseFloat(a.cells[columnIndex].innerText) - parseFloat(b.cells[columnIndex].innerText));
        } else {
            sortedRows = rows.sort((a, b) => a.cells[columnIndex].innerText.localeCompare(b.cells[columnIndex].innerText));
        }

        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        sortedRows.forEach(row => tbody.appendChild(row));
    }

    // Fonction de recherche
    function searchZones() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const tableRows = document.querySelectorAll('#zonesTable tbody tr');
        tableRows.forEach(row => {
            const zoneName = row.cells[0].innerText.toLowerCase();
            if (zoneName.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    loadTableData();
</script>

</body>
</html>
