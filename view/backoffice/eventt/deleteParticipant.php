<?php
require_once(__DIR__ . '/../../../controller/ParticipantController.php');

// Check if the ID is passed via the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Instantiate the controller
    $participantController = new ParticipantController();

    // Delete the participant by ID
    $participantController->deleteParticipant($id);

    // Redirect to the list page or display success message
    echo "Participant with ID $id deleted successfully!";
    // Optionally redirect
    // header("Location: listParticipants.php");
} else {
    echo "No ID provided to delete.";
    exit;
}
?>
