<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/forummodel.php');

class ForumpostController
{
    // List all posts
    public function listpost()
    {
        $sql = "SELECT * FROM forumpost";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete a post by its ID
    public function deletepost($idpost)
    {
        $sql = "DELETE FROM forumpost WHERE idpost = :idpost";
        $db = config::getConnexion();
    
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':idpost', $idpost, PDO::PARAM_INT); // Ensure it's an integer
            $req->execute();
    
            // Debug: Check if rows are affected
            if ($req->rowCount() > 0) {
                echo "Post with ID $idpost deleted successfully."; // Debugging
            } else {
                echo "No post found with ID $idpost."; // Debugging
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Add a new post to the database
    public function addpost($post)
    {
        $sql = "INSERT INTO forumpost (titleP, contentP, createDateP, Id_UserP, typeuser, authorname, typepost) 
                VALUES (:titleP, :contentP, :createDateP, :Id_UserP, :typeuser, :authorname, :typepost)";
        
        $db = config::getConnexion();
        
        try {
            // Prepare the statement
            $query = $db->prepare($sql);
            
            // Bind values from the post object
            $query->bindValue(':titleP', $post->getTitle());
            $query->bindValue(':contentP', $post->getContent());
            $query->bindValue(':createDateP', $post->getCreateDate()->format('Y-m-d H:i:s')); // Format DateTime object
            $query->bindValue(':Id_UserP', $post->getIdUser());
            $query->bindValue(':typeuser', $post->getTypeUser());
            $query->bindValue(':authorname', $post->getAuthorName());
            $query->bindValue(':typepost', $post->getTypePost());

            // Execute the query
            $query->execute();
    
            // Debugging: Message if post is added successfully
            echo "Post added successfully!";
            
        } catch (PDOException $e) {
            // Catch any errors and display them
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update an existing post
    public function updatepost($post, $idpost)
    {
        $sql = "UPDATE forumpost SET 
                titleP = :titleP,
                contentP = :contentP,
                updateDateP = :updateDateP,
                Id_UserP = :Id_UserP,
                typeuser = :typeuser,
                authorname = :authorname,
                typepost = :typepost
                WHERE idpost = :idpost";

        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idpost' => $idpost,
                'titleP' => $post->getTitle(),
                'contentP' => $post->getContent(),
                'updateDateP' => (new DateTime())->format('Y-m-d H:i:s'), // Update timestamp
                'Id_UserP' => $post->getIdUser(),
                'typeuser' => $post->getTypeUser(),
                'authorname' => $post->getAuthorName(),
                'typepost' => $post->getTypePost()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    public function getpostbyid($idpost)
{
    $sql = "SELECT * FROM forumpost WHERE idpost = :idpost";
    $db = config::getConnexion();
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(['idpost' => $idpost]);
        
        // Debugging: Print the result
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$post) {
            echo "No post found with ID: " . $idpost;  // Debugging
        }
        return $post;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    
}

?>
