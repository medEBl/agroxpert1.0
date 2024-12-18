<?php
require_once(__DIR__ . '../../config.php');

class BlogController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Assurez-vous que Config::connect() est bien défini
    }

    public function addBlog($blog) {
        try {
            // Afficher les données reçues pour le débogage
            var_dump($blog->getImage(), $blog->getTitre(), $blog->getContenu(), $blog->getTemps(), $blog->getIdCategory());
            
            $stmt = $this->db->prepare("
                INSERT INTO blog (image, titre, contenu, temps, id_category, nb_vue, nb_comments) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $blog->getImage(),
                $blog->getTitre(),
                $blog->getContenu(),
                $blog->getTemps(),
                $blog->getIdCategory(), // Utilisation de getIdCategory() pour la clé étrangère
                $blog->getNb_vue(),
                $blog->getNb_comments()
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout du blog : " . $e->getMessage());
            echo "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
    
    public function getAllBlogs() {
        try {
            $stmt = $this->db->query("SELECT * FROM blog");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des blogs : " . $e->getMessage();
            return [];
        }
    }

    public function getBlogById($id) {
        try {
            // Jointure avec la table category pour récupérer le nom de la catégorie
            $stmt = $this->db->prepare("
                SELECT blog.*, category.name AS category_name
                FROM blog
                LEFT JOIN category ON blog.id_category = category.id_category
                WHERE blog.id_blog = ?
            ");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du blog : " . $e->getMessage();
            return null;
        }
    }
    public function getBlogsByCategory($id_category) {
        // Préparer la requête SQL pour récupérer les blogs par catégorie
        $query = "SELECT * FROM blog WHERE id_category = :id_category";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $stmt->execute();
    
        // Récupérer les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function incrementViews($id) {
        try {
            $stmt = $this->db->prepare("UPDATE blog SET nb_vue = nb_vue + 1 WHERE id_blog = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour des vues : " . $e->getMessage();
        }
    }
    
    
    public function updateBlog($blog) {
        try {
            $stmt = $this->db->prepare("
                UPDATE blog SET image = ?, titre = ?, contenu = ?, temps = ?, id_category = ?, nb_vue = ?, nb_comments = ?
                WHERE id_blog = ?
            ");
            $stmt->execute([
                $blog->getImage(),
                $blog->getTitre(),
                $blog->getContenu(),
                $blog->getTemps(),
                $blog->getIdCategory(), // Utilisation de getIdCategory() pour la clé étrangère
                $blog->getNb_vue(),
                $blog->getNb_comments(),
                $blog->getId() // Le blog ID pour la mise à jour
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du blog : " . $e->getMessage();
        }
    }

    public function deleteBlog($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM blog WHERE id_blog = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du blog : " . $e->getMessage();
        }
    }
}
?>
