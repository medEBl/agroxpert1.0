<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Events</title>
</head>
<body>
    <div class="container">
        <?php
        require_once(__DIR__ . '/../../../controller/ForumeventController.php');

        // Instantiate the controller
        $forumeventController = new ForumeventController();

        // Get the search keyword if provided
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

        // Fetch the filtered list of events
        $events = $forumeventController->listevent($searchKeyword);

        // Display the events in a table with a "Participate" button
        echo "<h1>List of Events</h1>";

        // Add "Add Event" button and search bar at the top
        echo "<div style='margin-bottom: 20px;'>
                <a href='createevent.php'><button>Add Event</button></a>
                <form style='display: inline-block; margin-left: 20px;' method='GET' action=''>
                    <input type='text' name='search' placeholder='Search events...' value='" . htmlspecialchars($searchKeyword) . "'>
                    <button type='submit'>Search</button>
                </form>
              </div>";

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
    </div>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container for the page */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Styling the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Table header styling */
        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
        }

        /* Table cell styling */
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        /* Alternate row color */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Actions column layout */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        /* Actions column links */
        .action-buttons a {
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #007bff;
            border-radius: 5px;
        }

        .action-buttons a:hover {
            background-color: #007bff;
            color: white;
        }

        /* Add Event Button styling */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Hover effect for rows */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Center heading */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Search bar styling */
        input[type="text"] {
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        form button {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</body>
</html>
