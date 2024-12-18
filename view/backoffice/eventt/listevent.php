<?php
include(__DIR__ . '/../../../controller/blogcontroller.php');
$blogController = new BlogController();
$blogs = $blogController->getAllBlogs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Articles</title>
    <link rel="stylesheet" href="bac.css">
</head>
<body>

    <!-- Container Principal -->
    <div class="container">

        <!-- Sidebar / Dashboard -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                <li><a href="../user/gestion.php">Gestion de Compte</a></li>
                    <li><a href="../marketplace/productList.php">Gestion de Market</a></li>
                    <li><a href="bloglist.php">Gestion de Blog</a></li>
                    <li><a href="../back office/zonelist.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="../backreclamation&reponse/admin.php">Gestion de Feedback</a></li>
                    <li><a href="../eventt/listevent.php">Gestion d'event</a></li>

                </ul>
            </nav>
        </aside>

        <!-- Articles Section -->
      
        <?php
        require_once(__DIR__ . '/../../../controller/ForumeventController.php');

        // Instantiate the controller
        $forumeventController = new ForumeventController();

        // Get the search keyword if provided
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

        // Fetch the filtered list of events
        $events = $forumeventController->listevent($searchKeyword);

        // Display the events in a table with a "Participate" button
       

        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>";

        // Loop through the events and display each one with a participate button
        foreach ($events as $event) {
            echo "<tr>
                    <td>" . $event['id'] . "</td>
                    <td>" . $event['name'] . "</td>
                    <td>" . $event['description'] . "</td>
                    <td>
                        <img src='" . $event['image'] . "' alt='Event Image' style='width: 100px; height: auto;'>
                    </td>
                    <td>
                        <div class='action-buttons'>
                            <a href='addParticipant.php?event_id=" . $event['id'] . "'>Participate</a>
                            <a href='updateevent.php?id=" . $event['id'] . "'>Edit</a>
                            <a href='deleteevent.php?id=" . $event['id'] . "'>Delete</a>
                        </div>
                    </td>
                </tr>";
        }

        echo "</table>";
        ?>

     

    </div> <!-- End of container -->
<style>/* Polices et Reset */
table {
    width: 80%;  /* Adjust table width to take up less space */
    max-width: 800px;  /* Limit the table width */
    border-collapse: collapse;
    margin: 20px auto;  /* Center the table */
}
th {
    background-color: #539f57;
    color: white;
    padding: 6px 10px;  /* Reduce padding */
    font-size: 14px;  /* Adjust header font size */
}
td {
    padding: 6px 10px;  /* Reduce padding */
    border: 1px solid #ddd;
    text-align: left;
    font-size: 12px;  /* Adjust font size for table cells */
}

/* Alternate row color */
tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover effect for rows */
tr:hover {
    background-color: #f1f1f1;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color:#fff;
    color: #333;
}

/* Conteneur principal */
.container {
    display: flex;
    min-height: 100vh;
}
/* Articles List Styling */
.article-container {
    margin-left: 250px; /* Garde de l'espace pour la sidebar */
    padding: 20px;
    width: calc(100% - 250px);
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.article-container h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.article-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.article-item img {
    width: 150px;
    height: 100px;
    margin-right: 20px;
    border-radius: 5px;
    object-fit: cover;
}

.article-item h3 {
    color: #4CAF50;
    margin-bottom: 10px;
    font-size: 18px;
}

.article-item p {
    color: #555;
    margin-bottom: 10px;
}

.article-item small {
    display: block;
    color: #999;
    margin-bottom: 10px;
}

.article-item a {
    display: inline-block;
    margin-right: 10px;
    color: #4CAF50;
    text-decoration: none;
    border: 1px solid #4CAF50;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s ease-in-out;
}

.article-item a:hover {
    background-color: #4CAF50;
    color: white;
}

.article-container .no-articles {
    text-align: center;
    color: #999;
    font-style: italic;
}

.add-article-btn {
    display: block;
    width: fit-content;
    margin: 20px auto;
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    text-align: center;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease-in-out;
}

.add-article-btn:hover {
    background-color: #45a049;
}


/* Sidebar */
.sidebar {
    width: 250px;
    background-color: #004d40;
    color: #fff;
    padding: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
    font-size: 24px;
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
    font-size: 18px;
    padding: 10px;
    display: block;
    border-radius: 5px;
    transition: background 0.3s, transform 0.3s;
}

.sidebar nav ul li a:hover {
    background: #26a69a;
    transform: translateX(10px);
}

/* Contenu principal */
.main-content {
    flex: 1;
    padding: 30px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
}

/* Header */
header h1 {
    font-size: 28px;
    color: #004d40;
    text-align: center;
    margin-bottom: 20px;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

/* Formulaire */
form {
    background: #f1f8e9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

form h2 {
    font-size: 22px;
    margin-bottom: 15px;
    color: #388e3c;
}

form label {
    font-size: 16px;
    margin-bottom: 5px;
    display: block;
}

form input, form textarea, form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

form button {
    background: #388e3c;
    color: #fff;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

form button:hover {
    background: #2e7d32;
}

/* Liste des articles */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.card {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.card:hover {
    transform: translateY(-10px);
}

.card h3 {
    font-size: 20px;
    color: #004d40;
    margin-bottom: 10px;
}

.card p {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.card .actions a {
    text-decoration: none;
    font-size: 14px;
    margin-right: 10px;
    color: #26a69a;
    font-weight: bold;
    transition: color 0.3s;
}

.card .actions a:hover {
    color: #004d40;
}
/* Add specific styles for action buttons in the table */
.action-buttons {
    display: flex;
    justify-content: space-evenly; /* Space buttons evenly */
    align-items: center;
}

.action-buttons a {
    padding: 8px 15px;
    color: white;
    background-color: #26a69a; /* Button color */
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s, transform 0.3s ease-in-out;
    display: inline-block;
    width: 90px;
    text-align: center; /* Center the text within buttons */
}

.action-buttons a:hover {
    background-color: #00796b; /* Darker shade on hover */
    transform: translateY(-2px); /* Slightly lift on hover */
}

.action-buttons a:nth-child(2) {
    background-color: #ff9800; /* Edit button color */
}

.action-buttons a:nth-child(2):hover {
    background-color: #f57c00; /* Darker edit color */
}

.action-buttons a:nth-child(3) {
    background-color: #f44336; /* Delete button color */
}

.action-buttons a:nth-child(3):hover {
    background-color: #d32f2f; /* Darker delete color */
}

</style>
</body>



</html>
