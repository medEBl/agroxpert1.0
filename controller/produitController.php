<?php
require_once __DIR__ . '/../config.php';
include(__DIR__ . '../../model/produit.php');

class ProduitController {
    // Fonction pour lister tous les produits
    public function listProduits() {
        $sql = "SELECT * FROM produit";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter un produit
    public function addProduit($produit) {
        $sql = "INSERT INTO produit (nom, prix, description, category, stock_quantity, rating, discount)
                VALUES (:nom, :prix, :description, :category, :stock_quantity, :rating, :discount)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $produit->getNom(),
                'prix' => $produit->getPrix(),
                'description' => $produit->getDescription(),
                'category' => $produit->getCategory(),
                'stock_quantity' => $produit->getStockQuantity(),
                'rating' => $produit->getRating(),
                'discount' => $produit->getDiscount()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mettre à jour un produit
    public function updateProduit($produit, $id_produit) {
        $sql = "UPDATE produit SET 
                nom = :nom, 
                prix = :prix, 
                description = :description, 
                category = :category, 
                stock_quantity = :stock_quantity, 
                rating = :rating, 
                discount = :discount
                WHERE id_produit = :id_produit";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_produit' => $id_produit,
                'nom' => $produit->getNom(),
                'prix' => $produit->getPrix(),
                'description' => $produit->getDescription(),
                'category' => $produit->getCategory(),
                'stock_quantity' => $produit->getStockQuantity(),
                'rating' => $produit->getRating(),
                'discount' => $produit->getDiscount()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Afficher un produit par ID
    public function showProduit($id_produit) {
        $sql = "SELECT * FROM produit WHERE id_produit = :id_produit";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_produit' => $id_produit]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function getLowStockProducts($threshold = 5) {
        $db = config::getConnexion();
        try {
            $sql = "SELECT id_produit, nom, stock_quantity FROM produit WHERE stock_quantity <= :threshold";
            $query = $db->prepare($sql);
            $query->execute(['threshold' => $threshold]);
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des produits en stock faible : " . $e->getMessage());
        }
    }



    public function updateProductSales($id_produit, $quantity) {
        $db = config::getConnexion(); // Connexion à la base de données
        $sql = "UPDATE produit SET quantity_sold = quantity_sold + :quantity WHERE id_produit = :id_produit";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    



    public function getTopProducts($limit = 5) {
        $db = config::getConnexion();
        $sql = "SELECT nom, SUM(quantity_sold) as total_vendu, SUM(quantity_sold * prix) as total_revenu
                FROM produit 
                GROUP BY nom 
                ORDER BY total_vendu DESC 
                LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getSalesByMonth() {
        $db = config::getConnexion();
        try {
            $sql = "SELECT DATE_FORMAT(date_vente, '%Y-%m') AS mois, SUM(quantity_sold) AS total_vendu
                    FROM produit
                    GROUP BY DATE_FORMAT(date_vente, '%Y-%m')
                    ORDER BY mois";
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des ventes par mois : " . $e->getMessage());
        }
    }


    public function getSalesGrowth() {
        $db = config::getConnexion();
        try {
            $sql = "SELECT DATE_FORMAT(date_vente, '%Y-%m') AS mois, SUM(quantity_sold) AS total_vendu
                    FROM produit
                    GROUP BY DATE_FORMAT(date_vente, '%Y-%m')
                    ORDER BY mois";
            $query = $db->query($sql);
            $sales = $query->fetchAll();
    
            // Calcul du taux de croissance
            $growth = [];
            for ($i = 1; $i < count($sales); $i++) {
                $previous = $sales[$i - 1]['total_vendu'];
                $current = $sales[$i]['total_vendu'];
                $taux = ($previous == 0) ? 0 : (($current - $previous) / $previous) * 100;
    
                $growth[] = [
                    'mois' => $sales[$i]['mois'],
                    'taux' => round($taux, 2)
                ];
            }
            return $growth;
        } catch (Exception $e) {
            throw new Exception("Erreur lors du calcul du taux de croissance des ventes : " . $e->getMessage());
        }
    }
    

    public function getSalesRevenue() {
        $db = config::getConnexion();
        try {
            $sql = "SELECT nom, SUM(quantity_sold * prix) as total_revenu 
                    FROM produit 
                    GROUP BY nom 
                    ORDER BY total_revenu DESC";
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération du chiffre d'affaires : " . $e->getMessage());
        }
    }
    
    
    
    
    
    
}
?>
