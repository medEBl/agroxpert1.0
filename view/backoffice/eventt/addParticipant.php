<?php
session_start();
require_once '../../../vendor/autoload.php'; 



require_once(__DIR__ . '/../../../controller/ParticipantController.php');
require_once '../../../controller/userc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event_id = $_POST['event_id'];


    // Create a Participant object
    $participant = new Participant(null, $name, $email, $event_id);

    // Instantiate the controller
    $participantController = new ParticipantController();
    
    // Add the participant
    $participantController->addParticipant($participant);

    // Send email notification using PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();  
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;  
        $mail->Username = 'khaldiselim2@gmail.com'; // Your Gmail email address  
        $mail->Password = 'bedt tmgm hedk zxjt'; // Use the app password generated above
        $mail->SMTPSecure = 'ssl'; // Use SSL encryption
        $mail->Port = 465; // SSL port
        
        // Recipients
        $mail->setFrom('selimkhaldi926@yahoo.com', 'Event Team');
        $mail->addAddress($email, $name); // Recipient's email and name
    
        // Content
        $mail->isHTML(false); // Send as plain text
        $mail->Subject = 'Event Registration Confirmation';
        $mail->Body = "Dear $name,\n\nThank you for registering for the event with ID $event_id.\n\nBest regards,\nEvent Team";
    
        $mail->send();
        echo "Participant added and email sent successfully!";
    } catch (Exception $e) {
        echo "Participant added, but email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Participant</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General body and layout styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        /* Container to center the form */
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading styling */
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Form styling */
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
        input[type="email"],
        input[type="number"] {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Submit button styling */
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

        /* Optional success message styling */
        .success-message {
            color: green;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        /* Optional error message styling */
        .error-message {
            color: red;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Add New Participant</h1>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="event_id">Event ID:</label>
            <input type="number" name="event_id" id="event_id" required><br>

            <button type="submit">Add Participant</button>
        </form>
    </div>
</body>
</html>
