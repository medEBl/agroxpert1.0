<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/eventmodel.php'); // Corrected the model file name

class ForumeventController
{
    // List all events
    public function listevent()
    {
        $sql = "SELECT * FROM event";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete an event by its ID
    public function deleteevent($id)
    {
        $sql = "DELETE FROM event WHERE id = :id";
        $db = config::getConnexion();
    
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT); // Ensure it's an integer
            $req->execute();
    
            // Debug: Check if rows are affected
            if ($req->rowCount() > 0) {
                echo "Event with ID $id deleted successfully."; // Debugging
            } else {
                echo "No event found with ID $id."; // Debugging
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a new event to the database
    public function addevent($event)
    {
        $sql = "INSERT INTO event (name, description) 
                VALUES (:name, :description)";
        
        $db = config::getConnexion();
        
        try {
            // Prepare the statement
            $query = $db->prepare($sql);
            
            // Bind values from the event object
            $query->bindValue(':name', $event->getName());
            $query->bindValue(':description', $event->getDescription());
            
            // Execute the query
            $query->execute();
    
            // Debugging: Message if event is added successfully
            echo "Event added successfully!";
            
        } catch (PDOException $e) {
            // Catch any errors and display them
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update an existing event
    public function updateevent($event, $id)
    {
        $sql = "UPDATE event SET 
                name = :name,
                description = :description
                WHERE id = :id";

        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'name' => $event->getName(),
                'description' => $event->getDescription()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Get event details by ID
    public function geteventbyid($id)
    {
        $sql = "SELECT * FROM event WHERE id = :id";
        $db = config::getConnexion();
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id]);
            
            // Fetch the event
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$event) {
                echo "No event found with ID: " . $id;
            }
            return $event;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
