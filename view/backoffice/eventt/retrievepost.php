<?php
require_once(__DIR__ . '/../../../controller/itemcontroller.php');

// Instantiate the controller
$itemController = new ItemController();

// Get all items (ID, Name, Description)
$list = $itemController->listItems();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item List - Dashboard</title>
    <link rel="stylesheet" href="backi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>DASHBOARD</h2>
            <nav>
                <ul>
                    <li><a href="#">Gestion des Items</a></li>
                    <!-- Add other sidebar items here -->
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>BackOffice - Gestion des Items</h1>
                <div class="add-item">
                    <form action="additem.php" method="GET" style="text-align: right;">
                        <button type="submit" class="add-item-btn">Ajouter un Item</button>
                    </form>
                </div>
            </header>

            <main>
                <h2>Liste des Items</h2>
                <section id="itemList">
                    <div class="cards">
                        <!-- Loop through the items and display them -->
                        <?php if ($list) { ?>
                            <?php foreach ($list as $item) { ?>
                                <article class="card">
                                    <header>
                                        <h3><?= htmlspecialchars($item['name']); ?></h3>
                                    </header>

                                    <section>
                                        <p><strong>Description:</strong> <?= htmlspecialchars($item['description']); ?></p>
                                    </section>

                                    <footer>
                                        <p><strong>ID de l'item:</strong> <?= htmlspecialchars($item['id']); ?></p>
                                    </footer>

                                    <!-- Actions Section -->
                                    <div class="actions">
                                        <a href="updateitem.php?id=<?= $item['id']; ?>" class="edit">Modifier</a>
                                        <a href="deleteitem.php?id=<?= $item['id']; ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet item ?');">Supprimer</a>
                                    </div>
                                </article>
                            <?php } ?>
                        <?php } else { ?>
                            <p>Aucun item n'a été trouvé.</p>
                        <?php } ?>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>
