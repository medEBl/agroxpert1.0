<?php
require_once(__DIR__ . '../../config.php');

class CommentController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Make sure Config::connect() is defined
    }

    public function addComment($comment) {
        try {
            // Use the correct properties of the Comment class
            $stmt = $this->db->prepare("
                INSERT INTO comments (texte, date_c, auteur, id_blog) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([
                $comment->getTexte(),       // getTexte() instead of getContent()
                $comment->getDate(),        // getDate() instead of getDatePosted()
                $comment->getAuteur(),      // getAuteur() instead of getAuthor()
                $comment->getIdBlog()       // getIdBlog() instead of getBlogId()
            ]);

            // Update the number of comments in the blog table
            $this->updateCommentCount($comment->getIdBlog());
        } catch (PDOException $e) {
            echo "Error while adding comment: " . $e->getMessage();
        }
    }

    public function getCommentsByBlogId($id) {
        try {
            // Ensure the correct column 'id_blog' is used in the query
            $stmt = $this->db->prepare("SELECT * FROM comments WHERE id_blog = ?");
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error while fetching comments: " . $e->getMessage();
            return [];
        }
    }

    public function getCommentById($id) {
        try {
            // Ensure the correct column 'id_c' is used
            $stmt = $this->db->prepare("SELECT * FROM comments WHERE id_c = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error while fetching comment: " . $e->getMessage();
            return null;
        }
    }

    public function updateComment($id, $texte) {
        try {
            // Update comment texte
            $stmt = $this->db->prepare("UPDATE comments SET texte = ? WHERE id_c = ?");
            $stmt->execute([$texte, $id]);
        } catch (PDOException $e) {
            echo "Error while updating comment: " . $e->getMessage();
        }
    }

    public function deleteComment($id, $blogId) {
        try {
            // Delete comment by id
            $stmt = $this->db->prepare("DELETE FROM comments WHERE id_c = ?");
            $stmt->execute([$id]);

            // Update the number of comments in the blog table after deletion
            $this->updateCommentCount($blogId);
        } catch (PDOException $e) {
            echo "Error while deleting comment: " . $e->getMessage();
        }
    }

    private function updateCommentCount($blogId) {
        try {
            // Count the number of comments for the blog
            $stmt = $this->db->prepare("SELECT COUNT(*) AS comment_count FROM comments WHERE id_blog = ?");
            $stmt->execute([$blogId]);
            $count = $stmt->fetch(PDO::FETCH_ASSOC)['comment_count'];

            // Update the blog's comment count
            $stmt = $this->db->prepare("UPDATE blog SET nb_comments = ? WHERE id_blog = ?");
            $stmt->execute([$count, $blogId]);
        } catch (PDOException $e) {
            echo "Error while updating comment count: " . $e->getMessage();
        }
    }
    public function getCommentCountByBlogId($blogId) {
        try {
            // Compter les commentaires associés au blog
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM comments WHERE id_blog = ?");
            $stmt->execute([$blogId]);
            return $stmt->fetchColumn();  // Récupérer le nombre de commentaires
        } catch (PDOException $e) {
            echo "Error while fetching comment count: " . $e->getMessage();
            return 0;
        }
    }
    
}
?>
