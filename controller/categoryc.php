<?php
require_once(__DIR__ . '../../config.php');

class CategoryController {
    private $db;

    public function __construct() {
        $this->db = Config::getConnexion(); // Assurez-vous que Config::connect() est bien défini
    }

    // Ajouter une nouvelle catégorie
    public function addCategory($category) {
        try {
            // Vérifier si la connexion est valide
            if (!$this->db) {
                throw new Exception("La connexion à la base de données a échoué.");
            }
            
            // Préparer et exécuter la requête d'ajout de la catégorie
            $stmt = $this->db->prepare("INSERT INTO category (name) VALUES (?)");
            $stmt->execute([$category->getName()]);
            
            echo "Catégorie ajoutée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la catégorie : " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    

    // Récupérer toutes les catégories
    public function getAllCategories() {
        try {
            $stmt = $this->db->query("SELECT * FROM category");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des catégories : " . $e->getMessage();
            return [];
        }
    }

    // Récupérer une catégorie par son ID
    public function getCategoryById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM category WHERE id_category = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la catégorie : " . $e->getMessage();
            return null;
        }
    }

    // Mettre à jour une catégorie
    public function updateCategory($category) {
        try {
            $stmt = $this->db->prepare("
                UPDATE category SET name = ? 
                WHERE id_category = ?
            ");
            $stmt->execute([
                $category->getName(),
                $category->getId()
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la catégorie : " . $e->getMessage();
        }
    }

    // Supprimer une catégorie
    public function deleteCategory($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM category WHERE id_category = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la catégorie : " . $e->getMessage();
        }
    }
}
?>
