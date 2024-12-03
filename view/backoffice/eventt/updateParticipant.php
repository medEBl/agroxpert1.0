<?php
require_once(__DIR__ . '/../../../controller/ParticipantController.php');

// Get the participant ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Instantiate the controller
    $participantController = new ParticipantController();

    // Fetch the participant details by ID
    $participant = $participantController->getParticipantById($id);

    // If the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the data from the form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $event_id = $_POST['event_id'];

        // Create a Participant object
        $updatedParticipant = new Participant($id, $name, $email, $event_id);

        // Update the participant
        $participantController->updateParticipant($updatedParticipant, $id);

        // Redirect or display success message
        echo "Participant updated successfully!";
        // Optionally redirect
        // header("Location: listParticipants.php");
    }
} else {
    echo "Participant ID is missing.";
    exit;
}
?>

<h1>Update Participant</h1>
<form method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $participant['name']; ?>" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $participant['email']; ?>" required><br><br>
    
    <label for="event_id">Event ID:</label>
    <input type="number" name="event_id" id="event_id" value="<?php echo $participant['id']; ?>" required><br><br>
    
    <button type="submit">Update Participant</button>
</form>
<style>
        /* Body and general styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Container to center the content */
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            box-sizing: border-box;
        }

        /* Button styling */
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Error message styling */
        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
