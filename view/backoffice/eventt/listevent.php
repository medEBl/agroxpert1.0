<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class=container><?php
require_once(__DIR__ . '/../../../controller/ForumeventController.php');

// Instantiate the controller
$forumeventController = new ForumeventController();

// Fetch the list of events
$events = $forumeventController->listevent();

// Display the events in a table with a "Participate" button
echo "<h1>List of Events</h1>";

// Add "Add Event" button at the top
echo "<a href='createevent.php'><button>Add Event</button></a><br><br>";

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>";

// Loop through the events and display each one with a participate button
foreach ($events as $event) {
    echo "<tr>
            <td>" . $event['id'] . "</td>
            <td>" . $event['name'] . "</td>
            <td>" . $event['description'] . "</td>
            <td>
                <!-- Participate Button, links to addParticipant.php -->
                <a href='addParticipant.php?event_id=" . $event['id'] . "'>Participate</a> | 
                <a href='updateevent.php?id=" . $event['id'] . "'>Edit</a> | 
                <a href='deleteevent.php?id=" . $event['id'] . "'>Delete</a>
            </td>
        </tr>";
}

echo "</table>";
?>
</div>
<style>/* General body styling */
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

/* Actions column links */
td a {
    color: #007bff;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #007bff;
    border-radius: 5px;
    margin-right: 5px;
}

td a:hover {
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
</style>
</body>
</html>
