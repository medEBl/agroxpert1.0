<?php
require_once(__DIR__ . '/../../../controller/ForumeventController.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create controller instance and get the event by ID
    $controller = new ForumeventController();
    $eventData = $controller->geteventbyid($id);

    if ($eventData) {
        $event = new Event($eventData['id'], $eventData['name'], $eventData['description']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated values from form
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Create updated Event object
    $updatedEvent = new Event($id, $name, $description);

    // Update event in the database
    $controller->updateevent($updatedEvent, $id);
    echo "<p>Event updated successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Event</title>
</head>
<body>
    <h1>Update Event</h1>

    <form action="updateevent.php?id=<?php echo $event->getId(); ?>" method="POST">
        <label for="name">Event Name:</label>
        <input type="text" name="name" value="<?php echo $event->getName(); ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $event->getDescription(); ?></textarea><br><br>

        <button type="submit">Update Event</button>
    </form>

    <a href="listevent.php">Back to Event List</a>
</body>
</html>
