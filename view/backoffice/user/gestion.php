<?php
include '../../../controller/userc.php';

// Instantiate the userc
$userc = new userc();
$search = isset($_POST['search']) ? $_POST['search'] : ''; // Get search term from POST
$typeUser = isset($_POST['typeUser']) ? $_POST['typeUser'] : ''; // Get role filter from POST

// Pass search and filter parameters to the method
$users = $userc->listUser($search, ['typeUser' => $typeUser]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice - Gestion des Comptes</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        // Function to apply filters and search dynamically
        function applyFilters() {
            const search = $('#search-bar').val();
            const typeUser = $('#filter-typeUser').val();

            $.ajax({
                url: 'filter.php', // Call filter.php
                type: 'POST',
                data: { search: search, typeUser: typeUser },
                success: function (response) {
                    // Update the user table with response HTML
                    $('#user-table').html(response);
                },
                error: function () {
                    alert('Error fetching data.');
                }
            });
        }

        // Event listeners for real-time filtering
        $('#search-bar').on('keyup', function () {
            applyFilters();
        });

        $('#filter-button').on('click', function () {
            applyFilters();
        });
    });
</script>

</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                <li><a href="gestion.php">Gestion de Compte</a></li>
                    <li><a href="../marketplace/productList.php">Gestion de Market</a></li>
                    <li><a href="../mimi/bloglist.php">Gestion de Blog</a></li>
                    <li><a href="../back office/zonelist.php">Gestion de Météo</a></li>
                    <li><a href="../forumb/retrievepost.php">Gestion de Forum</a></li>
                    <li><a href="../backreclamation&reponse/admin.php">Gestion de Feedback</a></li>
                    <li><a href="../eventt/listevent.php">Gestion d'event</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="main-content">
            <header>
                <h1>BackOffice - Gestion des Comptes</h1>
            </header>

            <main>
                <!-- Filter Section -->
                <section class="filter-section">
    <div class="filter-container">
        <div class="filter-group">
            <input 
                type="text" 
                id="search-bar" 
                class="filter-input" 
                placeholder="🔍 Rechercher par nom ou email..." 
            />
        </div>
        <div class="filter-group">
            <select id="filter-typeUser" class="filter-select">
                <option value="">Tous les rôles</option>
                <option value="Vendeur">Vendeur</option>
                <option value="Acheteur">Acheteur</option>
            </select>
        </div>
        <div class="filter-group">
            <button id="filter-button" class="filter-button">
                <span>🎯 Appliquer le filtre</span>
            </button>
        </div>
    </div>
</section>


                <section id="userList">
                    <h1>Liste des utilisateurs</h1>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="user-table">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']); ?></td>
                                        <td><?= htmlspecialchars($user['name']); ?></td>
                                        <td><?= htmlspecialchars($user['email']); ?></td>
                                        <td><?= htmlspecialchars($user['adresse']); ?></td>
                                        <td><?= htmlspecialchars($user['typeUser']); ?></td>

                                        <td>
                                            <a href="delete.php?id=<?= $user['id']; ?>" class="btn-delete">Supprimer</a>
                                            <a href="update.php?id=<?= $user['id']; ?>" class="btn-edit">Modifier</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">Aucun utilisateur trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <a href="../../frontoffice/FU/index.php">Ajouter un utilisateur</a>
                    <a href="../../frontoffice/FU/logout.php">Déconnexion</a>
                </section>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Filter or Search functionality
            
            function applyFilters() {
                const search = $('#search-bar').val();
                const typeUser = $('#filter-typeUser').val();

                $.ajax({
                    url: 'gestion.php',
                    type: 'POST',
                    data: { search: search, typeUser: typeUser },
                    success: function (response) {
                        // Update user table with response HTML
                        const newTableBody = $(response).find('#user-table').html();
                        $('#user-table').html(newTableBody);
                    }
                });
            }

            // Search bar event listener
            $('#search-bar').on('keyup', function () {
                applyFilters();
            });

            // Filter button event listener
            $('#filter-button').on('click', function () {
                applyFilters();
            });
        });
    </script>
    <style>/* Polices et reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #e0f7fa, #a7ffeb);
    color: #333;
}

/* Conteneur principal */
.container {
    display: flex;
    min-height: 100vh;
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

/* Section des fonctionnalités */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.card {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
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

.card .btn {
    text-decoration: none;
    font-size: 14px;
    padding: 10px 15px;
    background: #26a69a;
    color: #fff;
    border-radius: 5px;
    transition: background 0.3s;
}

.card .btn:hover {
    background: #004d40;
}
/* Tableau des utilisateurs */
.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 20px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background: #ffffff;
}

.table th, .table td {
    border-bottom: 1px solid #ddd;
    padding: 15px 20px;
    text-align: left;
    font-size: 16px;
    font-weight: 400;
}

.table th {
    background: #004d40;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    font-size: 14px;
}

.table td {
    text-align: center;
    color: #333;
}

.table tr:nth-child(even) {
    background: #f1f8ff;
}

.table tr:hover {
    background: #e0f7fa;
    transition: all 0.3s ease-in-out;
}

.table a {
    text-decoration: none;
    color: #004d40;
    font-weight: bold;
    transition: color 0.3s;
}

.table a:hover {
    color: #26a69a;
    text-decoration: underline;
}

/* Boutons d'action */
.btn-delete {
    color: #e53935;
    padding: 5px 10px;
    border: 1px solid #e53935;
    border-radius: 5px;
    background: #ffebee;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background: #e53935;
    color: #fff;
}

.btn-edit {
    color: #1e88e5;
    padding: 5px 10px;
    border: 1px solid #1e88e5;
    border-radius: 5px;
    background: #e3f2fd;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-edit:hover {
    background: #1e88e5;
    color: #fff;
}
/* General Styling for the User List Section */
#userList {
    margin: 20px auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

#userList h1 {
    font-size: 24px;
    color: #004d40;
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
}

#userList a {
    display: inline-block;
    margin: 10px 5px;
    padding: 10px 15px;
    font-size: 14px;
    text-decoration: none;
    background: #26a69a;
    color: #fff;
    border-radius: 5px;
    transition: background 0.3s;
}

#userList a:hover {
    background: #004d40;
}

/* Table Styling */
#userList table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    background: #ffffff;
}

#userList table thead {
    background: linear-gradient(135deg, #004d40, #00796b);
    color: #fff;
}

#userList table thead th {
    padding: 15px;
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    text-transform: uppercase;
}

#userList table tbody tr {
    transition: background 0.3s;
    border-bottom: 1px solid #ddd;
}

#userList table tbody tr:hover {
    background: #e0f7fa;
}

#userList table tbody td {
    padding: 15px;
    font-size: 14px;
    text-align: center;
    color: #333;
}

#userList table tbody td:first-child {
    font-weight: bold;
    color: #004d40;
}

#userList table tbody td:last-child {
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* Action Buttons */
.btn-delete {
    background: #e53935;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s;
}

.btn-delete:hover {
    background: #b71c1c;
}

.btn-edit {
    background: #1e88e5;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s;
}

.btn-edit:hover {
    background: #0d47a1;
}

/* Responsive Design */
@media (max-width: 768px) {
    #userList table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    #userList table thead {
        display: none;
    }

    #userList table tbody tr {
        display: block;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
    }

    #userList table tbody td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        font-size: 14px;
    }

    #userList table tbody td:before {
        content: attr(data-label);
        font-weight: bold;
        color: #004d40;
    }
}
/* Enhanced Filter Section Styling */
.filter-section {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: linear-gradient(135deg, #4db6ac, #00796b);
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    margin: 20px auto;
    max-width: 900px;
}

.filter-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    align-items: center;
}

.filter-group {
    flex: 1 1 auto;
    display: flex;
    justify-content: center;
}

.filter-input, 
.filter-select, 
.filter-button {
    font-size: 16px;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    outline: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

/* Input Field */
.filter-input {
    flex: 1;
    background: #fff;
    color: #333;
    border: 1px solid #004d40;
    max-width: 300px;
}

.filter-input::placeholder {
    color: #aaa;
    font-style: italic;
}

.filter-input:focus {
    box-shadow: 0 0 10px rgba(0, 200, 170, 0.8);
    border-color: #26a69a;
}

/* Dropdown */
.filter-select {
    background: #fff;
    color: #333;
    border: 1px solid #004d40;
    cursor: pointer;
    max-width: 200px;
}

.filter-select:focus {
    border-color: #26a69a;
    box-shadow: 0 0 10px rgba(0, 200, 170, 0.8);
}

/* Button */
.filter-button {
    background: #00796b;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.filter-button:hover {
    background: #004d40;
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Responsive */
@media screen and (max-width: 768px) {
    .filter-container {
        flex-direction: column;
    }
    .filter-group {
        width: 100%;
    }
    .filter-input, .filter-select, .filter-button {
        width: 100%;
    }
}


/* Responsive Design */
/*@media screen and (max-width: 768px) {
    .filter-section {
        flex-direction: column;
    }

    .filter-input, 
    .filter-select, 
    .filter-button {
        flex: 1 1 100%;
    }
}*/


</style>
</body>
</html>