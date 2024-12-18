<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/forumcommentmodel.php');
require_once 'userc.php';
if (!empty($_SESSION['id'])){
    $AuthoridC =  $_SESSION['id'];
}
class ForumCommentController
{
    // List all comments for a specific post
    public function listcomments($idpost)
    {
        $sql = "SELECT * FROM forumcomment WHERE idpostc = :idpostc";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':idpostc', $idpost, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Delete a comment by its ID
    public function deleteComment($idcommentp)
    {
        $sql = "DELETE FROM forumcomment WHERE idcommentp = :idcommentp";
        $db = config::getConnexion();

        try {
            // Prepare the query
            $query = $db->prepare($sql);
            $query->bindValue(':idcommentp', $idcommentp, PDO::PARAM_INT);

            // Execute the query
            $query->execute();
            echo "Comment deleted successfully!";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Add a new comment to a post
    public function addComment($comment)
    {
        $sql = "INSERT INTO forumcomment (contentC, createDateC, AuthoridC, authorname, idpostc)
                VALUES (:contentC, :createDateC, :AuthoridC, :authorname, :idpostc)";
        $db = config::getConnexion();
        
        try {
            // Prepare the SQL query
            $query = $db->prepare($sql);
            
            // Bind the values from the $comment object
            $query->bindValue(':contentC', $comment->getContentC());
            $query->bindValue(':createDateC', $comment->getCreateDateC());
            $query->bindValue(':AuthoridC', $comment->getAuthoridC());
            $query->bindValue(':authorname', $comment->getAuthorname());
            $query->bindValue(':idpostc', $comment->getIdpostc());
            
            // Execute the query
            $query->execute();
            
            // Debugging: Print success message
            echo "Comment added successfully!";
        } catch (PDOException $e) {
            // Handle any errors
            echo 'Error: ' . $e->getMessage();
        }
    }
    // Update an existing comment
    public function updateComment($comment)
    {
        $sql = "UPDATE forumcomment SET contentC = :contentC, updateDateC = :updateDateC WHERE idcommentp = :idcommentp";
        $db = config::getConnexion();

        try {
            // Prepare the SQL query
            $query = $db->prepare($sql);

            // Bind the values from the $comment object
            $query->bindValue(':contentC', $comment->getContentC());
            $query->bindValue(':updateDateC', $comment->getUpdateDateC());
            $query->bindValue(':idcommentp', $comment->getIdcommentp());

            // Execute the query
            $query->execute();
            echo "Comment updated successfully!";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Method to retrieve a comment by ID
    public function getCommentById($idcommentp)
    {
        $sql = "SELECT * FROM forumcomment WHERE idcommentp = :idcommentp";
        $db = config::getConnexion();

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['idcommentp' => $idcommentp]);
            $comment = $stmt->fetch(PDO::FETCH_ASSOC);
            return $comment ? $comment : null;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Get a comment by its ID
    
    public function getCommentsByPostId($idpost)
    {
        $sql = "SELECT * FROM forumcomment WHERE idpostc = :idpostc ORDER BY createDateC DESC";
        $db = config::getConnexion();
        
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['idpostc' => $idpost]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    
    // Update emoji reaction
public function addReaction($idcommentp, $emoji) {
    $db = config::getConnexion();
    
    // Check if the emoji is already set for the comment
    $sqlCheck = "SELECT emoji, emoji_count FROM forumcomment WHERE idcommentp = :idcommentp";
    try {
        $stmt = $db->prepare($sqlCheck);
        $stmt->execute(['idcommentp' => $idcommentp]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // If the emoji exists, update the count
            if ($result['emoji'] === $emoji) {
                // Increment the count if the same emoji is selected
                $sqlUpdate = "UPDATE forumcomment SET emoji_count = emoji_count + 1 WHERE idcommentp = :idcommentp";
            } else {
                // If a different emoji is selected, set the new emoji and reset the count to 1
                $sqlUpdate = "UPDATE forumcomment SET emoji = :emoji, emoji_count = 1 WHERE idcommentp = :idcommentp";
            }
            $stmt = $db->prepare($sqlUpdate);
            $stmt->execute(['idcommentp' => $idcommentp, 'emoji' => $emoji]);
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

  // Count the number of comments for a specific post
  public function countCommentsByPost($idpost)
  {
      $sql = "SELECT COUNT(*) AS commentCount FROM forumcomment WHERE idpostc = :idpost";
      $db = config::getConnexion();

      try {
          $stmt = $db->prepare($sql);
          $stmt->bindValue(':idpost', $idpost, PDO::PARAM_INT);
          $stmt->execute();

          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          return $result['commentCount'] ?? 0;
      } catch (PDOException $e) {
          echo 'Error: ' . $e->getMessage();
          return 0; // Return zero if an error occurs
      }
  }





}

?>
