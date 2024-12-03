<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/ParticipantModel.php');

class ParticipantController
{
    // List all participants
    public function listParticipants()
    {
        $sql = "SELECT * FROM participants";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete a participant by its ID
    public function deleteParticipant($id)
    {
        $sql = "DELETE FROM participants WHERE id_participant = :id_participant";
        $db = config::getConnexion();

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id_participant', $id, PDO::PARAM_INT); // Ensure it's an integer
            $req->execute();

            // Debug: Check if rows are affected
            if ($req->rowCount() > 0) {
                echo "Participant with ID $id deleted successfully."; // Debugging
            } else {
                echo "No participant found with ID $id."; // Debugging
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a new participant
    public function addParticipant($participant)
    {
        $sql = "INSERT INTO participants (id_participant, name, email, id) 
                VALUES (:id_participant, :name, :email, :id)";
        
        $db = config::getConnexion();

        try {
            // Prepare the statement
            $query = $db->prepare($sql);

            // Bind values from the participant object
            $query->bindValue(':id_participant', $participant->getIdParticipant());
            $query->bindValue(':name', $participant->getName());
            $query->bindValue(':email', $participant->getEmail());
            $query->bindValue(':id', $participant->getEventId());

            // Execute the query
            $query->execute();

            // Debugging: Message if participant is added successfully
            echo "Participant added successfully!";

        } catch (PDOException $e) {
            // Catch any errors and display them
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update an existing participant
    public function updateParticipant($participant, $id)
    {
        $sql = "UPDATE participants SET 
                id_participant = :id_participant,
                name = :name,
                email = :email,
                id = :id 
                WHERE id_participant = :id_participant";

        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_participant' => $id,
                'name' => $participant->getName(),
                'email' => $participant->getEmail(),
                'id' => $participant->getEventId(),
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Get a participant by their ID
    public function getParticipantById($id)
    {
        $sql = "SELECT * FROM participants WHERE id_participant = :id_participant";
        $db = config::getConnexion();

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['id_participant' => $id]);

            // Fetch the result
            $participant = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$participant) {
                echo "No participant found with ID: " . $id;  // Debugging
            }
            return $participant;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
