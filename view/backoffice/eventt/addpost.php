<?php
require_once(__DIR__ . '/../../../controller/itemcontroller.php');

$error = "";
$item = null;
$itemController = new ItemController(); // Assuming you have an ItemController
$Id_User = 1; // Assume user ID for testing

if (isset($_POST["name"]) && isset($_POST["description"])) {
    if (!empty($_POST["name"]) && !empty($_POST["description"])) {
        // Create a new item with the form data
        $item = new Item(
            null, // id will be auto-incremented in DB
            $_POST['name'],
            $_POST['description']
        );

        // Add the item to the database
        $itemController->addItem($item);
        header('Location: retrieveItem.php'); // Redirect to item list
        exit;
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Item - BackOffice</title>
    <link rel="stylesheet" href="backi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <header>
                <h1>Ajouter un Item</h1>
            </header>

            <!-- Error Message -->
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form id="itemForm" method="POST" action="">
                <!-- Name of the item -->
                <label for="name">Nom de l'Item:</label>
                <input type="text" id="name" name="name" placeholder="Nom de l'item" required>

                <!-- Description of the item -->
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" placeholder="Description de l'item" required></textarea>

                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
