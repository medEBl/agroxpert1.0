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
    
            // Debugging: Check if rows are affected
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
    
            echo "Post added successfully!";
            
        } catch (PDOException $e) {
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

    // Increment the number of views for a post
    public function incrementViews($idpost)
    {
        $sql = "UPDATE forumpost SET nbviewsp = nbviewsp + 1 WHERE idpost = :idpost";
        $db = config::getConnexion();
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':idpost', $idpost, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Increment the number of likes for a post
    public function incrementLikes($idpost)
    {
        $sql = "UPDATE forumpost SET nblikesp = nblikesp + 1 WHERE idpost = :idpost";
        $db = config::getConnexion();
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':idpost', $idpost, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    // Increment the number of dislikes for a post
public function incrementDislikes($idpost)
{
    $sql = "UPDATE forumpost SET nbdislikesp = nbdislikesp + 1 WHERE idpost = :idpost";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idpost', $idpost, PDO::PARAM_INT); // Bind the post ID as an integer
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    // Get a post by its ID
    public function getpostbyid($idpost)
    {
        $sql = "SELECT * FROM forumpost WHERE idpost = :idpost";
        $db = config::getConnexion();
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['idpost' => $idpost]);
            
            // Fetch the post
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$post) {
                echo "No post found with ID: " . $idpost;
            }
            return $post;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // List all posts sorted by views (optional - for most viewed posts)
    public function listPostsByViews()
    {
        $sql = "SELECT * FROM forumpost ORDER BY nbviewsp DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // List all posts sorted by likes (optional - for most liked posts)
    public function listPostsByLikes()
    {
        $sql = "SELECT * FROM forumpost ORDER BY nblikesp DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    // Increment the number of dislikes for a post

public function listPostsByDislikes()
    {
        $sql = "SELECT * FROM forumpost ORDER BY nbdislikes DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}
?>
