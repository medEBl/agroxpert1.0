<?php
require_once(__DIR__ . '/../../../controller/itemcontroller.php');
require_once(__DIR__ . '/../../../model/itemmodel.php');

$error = "";
$item = null;
$itemId = null;

// Step 1: Check if `id` is passed in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $itemId = $_GET['id'];

    // Load the item data for the given ID
    $itemController = new ItemController();
    $item = $itemController->getItemById($itemId);

    if (!$item) {
        $error = "Item not found.";
    }
} else {
    $error = "No item ID provided.";
}

// Step 2: Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["name"], $_POST["description"]) &&
        !empty($_POST["name"]) && !empty($_POST["description"])
    ) {
        // Create a new item object with the form data
        $item = new Item(
            $_POST['itemId'],
            $_POST['name'],
            $_POST['description']
        );

        try {
            // Attempt to update the item
            $itemController->updateItem($item, $_POST['itemId']);

            // Redirect to the items list
            header('Location: retrieveitem.php');
            exit;
        } catch (Exception $e) {
            $error = "Error updating item: " . $e->getMessage();
        }
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
    <title>Update Item - Dashboard</title>
    <link rel="stylesheet" href="backi.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <header>
                <h1>Update Item</h1>
            </header>

            <!-- Error Message -->
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <?php if ($item) : ?>
                <form id="itemForm" action="updateitem.php?id=<?= htmlspecialchars($item['id']); ?>" method="POST">
                    <input type="hidden" name="itemId" value="<?= htmlspecialchars($item['id']); ?>">

                    <!-- Item Name -->
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($item['name']); ?>" required>

                    <!-- Item Description -->
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($item['description']); ?></textarea>

                    <button type="submit">Update Item</button>
                </form>
            <?php else : ?>
                <p>No item found to update.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
