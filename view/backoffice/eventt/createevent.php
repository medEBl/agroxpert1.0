<?php

require_once(__DIR__ . '/../../../controller/ForumeventController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form is submitted
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Create new Event object
    $event = new Event(null, $name, $description);

    // Create controller instance and add the event
    $controller = new ForumeventController();
    $controller->addevent($event);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        /* Container for the form */
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styling */
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
        }

        /* Button Styling */
        button {
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Link Styling */
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            font-size: 16px;
            color: #007bff;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Create Event</h1>

        <form action="createevent.php" method="POST">
            <label for="name">Event Name:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea><br>

            <button type="submit">Create Event</button>
        </form>

        <a href="listevent.php">Back to Event List</a>
    </div>
</body>
</html>
