<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class=container><?php
require_once(__DIR__ . '/../../../controller/ParticipantController.php');

// Instantiate the controller
$participantController = new ParticipantController();

// Fetch the list of participants
$participants = $participantController->listParticipants();

// Display the participants in a table
echo "<h1>List of Participants</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Event ID</th>
            <th>Actions</th>
        </tr>";

foreach ($participants as $participant) {
    echo "<tr>
            <td>" . $participant['id_participant'] . "</td>
            <td>" . $participant['name'] . "</td>
            <td>" . $participant['email'] . "</td>
            <td>" . $participant['id'] . "</td>
            <td>
                <a href='updateParticipant.php?id=" . $participant['id_participant'] . "'>Edit</a> | 
                <a href='deleteParticipant.php?id=" . $participant['id_participant'] . "'>Delete</a>
            </td>
        </tr>";
}

echo "</table>";
?>
</div>
<style>  body {
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

        /* Heading styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }</style>
</body>
</html>
