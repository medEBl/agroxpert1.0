<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/forummodel.php');

class ForumpostController
{
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
    

    public function addpost($post)
    {
        $sql = "INSERT INTO forumpost (titleP, contentP, createDateP, Id_User)
                VALUES (:titleP, :contentP, :createDateP, :Id_User)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titleP' => $post->getTitle(),
                'contentP' => $post->getContent(),
                'createDateP' => $post->getCreateDate()->format('Y-m-d'),
                'Id_User' => $post->getIdUser()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updatepost($post, $idpost)
    {
        $sql = "UPDATE forumpost SET 
                titleP = :titleP,
                contentP = :contentP,
                createDateP = :createDateP,
                Id_User = :Id_User
                WHERE idpost = :idpost";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idpost' => $idpost,
                'titleP' => $post->getTitle(),
                'contentP' => $post->getContent(),
                'createDateP' => $post->getCreateDate()->format('Y-m-d'),
                'Id_User' => $post->getIdUser()
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showpost($idpost)
    {
        $sql = "SELECT * FROM forumpost WHERE idpost = :idpost";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['idpost' => $idpost]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
