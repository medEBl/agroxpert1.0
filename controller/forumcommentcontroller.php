<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/forumcommentmodel.php');

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
    public function updateEmoji($idcommentp, $emoji)
{
    $sql = "UPDATE forumcomment SET emoji = :emoji WHERE idcommentp = :idcommentp";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindValue(':emoji', $emoji);
        $query->bindValue(':idcommentp', $idcommentp, PDO::PARAM_INT);
        $query->execute();
        echo "Emoji updated successfully!";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
public function getEmoji($idcommentp)
{
    $sql = "SELECT emoji FROM forumcomment WHERE idcommentp = :idcommentp";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(['idcommentp' => $idcommentp]);
        $emoji = $stmt->fetch(PDO::FETCH_ASSOC);
        return $emoji ? $emoji['emoji'] : null;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
public function incrementEmojiCount($idcommentp)
{
    $sql = "UPDATE forumcomment SET emoji = emoji + 1 WHERE idcommentp = :idcommentp";
    $db = config::getConnexion();

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':idcommentp', $idcommentp, PDO::PARAM_INT);
        $stmt->execute();
        return true; // You can return a success value or handle as needed
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return false; // Handle error if needed
    }
}





}

?>
