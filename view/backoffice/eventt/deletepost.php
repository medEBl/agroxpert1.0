<?php
require_once(__DIR__ . '/../../../controller/itemcontroller.php');

// Check if the ID is provided and valid
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];  // ID of the item to delete
} else {
    die("Invalid or missing ID.");
}

if (isset($id)) {
    try {
        // Create an instance of the item controller
        $itemController = new ItemController();
        
        // Attempt to delete the item by ID
        $itemController->deleteItem($id);

        // Redirect after deletion
        header('Location: retrieveItem.php'); // Redirect to the item list page
        exit;

    } catch (Exception $e) {
        // Display any error that occurs during the deletion process
        echo "Error deleting item: " . $e->getMessage();
    }
}
?>
