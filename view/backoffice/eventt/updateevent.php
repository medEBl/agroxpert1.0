<?php
require_once(__DIR__ . '/../../../controller/ForumeventController.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Create controller instance and get the event by ID
    $controller = new ForumeventController();
    $eventData = $controller->geteventbyid($id);

    if ($eventData) {
        $event = new Event($eventData['id'], $eventData['name'], $eventData['description'], $eventData['image']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated values from the form
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Handle file upload (if a new file is uploaded)
    $targetDir = __DIR__ . '/uploads/';
    $imagePath = $event->getImage(); // Default to the existing image

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $imageName;

        // Create uploads directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imagePath = 'uploads/' . $imageName; // Relative path to save in DB
        } else {
            echo "Error uploading the image.";
            exit;
        }
    }

    // Create updated Event object
    $updatedEvent = new Event($id, $name, $description, $imagePath);

    // Update event in the database
    $controller->updateevent($updatedEvent, $id);
    echo "<p>Event updated successfully!</p>";

    // Redirect to event list
    header('Location: listevent.php');
    exit;
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

    <form action="updateevent.php?id=<?php echo $event->getId(); ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Event Name:</label>
        <input type="text" name="name" value="<?php echo $event->getName(); ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $event->getDescription(); ?></textarea><br><br>

        <label for="image">Event Image:</label>
        <?php if ($event->getImage()): ?>
            <img src="<?php echo $event->getImage(); ?>" alt="Event Image" style="max-width: 200px; display: block; margin-bottom: 10px;">
            <p>Current Image: <?php echo basename($event->getImage()); ?></p>
        <?php endif; ?>
        <input type="file" name="image" id="image" accept="image/*"><br><br>

        <button type="submit">Update Event</button>
        
        <a href="listevent.php">Back to Event List</a>
    </form>

    <style>
        /* General body and layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Centering the form container */
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        /* Form container style */
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Form label and input fields */
        label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Textarea styling */
        textarea {
            height: 150px;
            resize: vertical;
        }

        /* Submit button styling */
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        /* Button hover effect */
        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Link back to event list */
        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            text-decorat
