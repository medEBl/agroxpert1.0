<?php
require_once(__DIR__ . '/../../../controller/ForumeventController.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create controller instance and delete the event by ID
    $controller = new ForumeventController();
    $controller->deleteevent($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Event</title>
</head>
<body>
    <h1>Event Deleted</h1>

    <p>Event has been deleted successfully. <a href="listevent.php">Go back to the event list</a></p>
</body>
</html>
