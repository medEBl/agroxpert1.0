<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/reponse.php');
require_once 'userc.php';
if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} 
class ReponseController {
    // Liste toutes les réponses
    public function listReponses() {
        $sql = "SELECT * FROM reponse";
        $db = config::getConnexion();
        try {
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Supprime une réponse par ID
    public function deleteReponse($id_reponse) {
        $sql = "DELETE FROM reponse WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_reponse' => $id_reponse]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajoute une nouvelle réponse
    public function addReponse($reponse) {
        $sql = "INSERT INTO reponse (id, reponse, date_reponse) VALUES (:id, :reponse, :date_reponse)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $reponse->getId(),
                'reponse' => $reponse->getReponse(),
                'date_reponse' => $reponse->getDateReponse()->format('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Met à jour une réponse existante
    public function updateReponse($reponse, $id_reponse) {
        $sql = "UPDATE reponse SET id = :id, reponse = :reponse, date_reponse = :date_reponse WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $reponse->getId(),
                'reponse' => $reponse->getReponse(),
                'date_reponse' => $reponse->getDateReponse()->format('Y-m-d'),
                'id_reponse' => $id_reponse
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Récupère une réponse par ID
    public function showReponse($id_reponse) {
        $sql = "SELECT * FROM reponse WHERE id_reponse = :id_reponse";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_reponse' => $id_reponse]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listReponsesByReclamation($id)
    {
        // Requête SQL pour récupérer les réponses liées à une réclamation spécifique
        $sql = "SELECT id_reponse, reponse, date_reponse 
                FROM reponse 
                WHERE id = :id";  // Filtre par l'ID de la réclamation (clé étrangère)
    
        $db = config::getConnexion(); // Connexion à la base de données
        try {
            $query = $db->prepare($sql); // Préparation de la requête
            $query->execute(['id' => $id]); // Liaison du paramètre ID
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourner les résultats sous forme associative
        } catch (PDOException $e) {
            // Gestion des erreurs SQL
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }
    // Récupérer les statistiques des réponses
public function getStatistics() {
    $db = config::getConnexion();

    try {
        // Statistique du nombre total de réponses
        $totalReponsesQuery = "SELECT COUNT(*) as total FROM reponse";
        $totalReponses = $db->query($totalReponsesQuery)->fetch(PDO::FETCH_ASSOC)['total'];

        // Statistique des réponses par réclamation (par ID de réclamation)
        $reponsesParReclamationQuery = "
            SELECT id, COUNT(*) as total_reponses 
            FROM reponse 
            GROUP BY id";
        $reponsesParReclamation = $db->query($reponsesParReclamationQuery)->fetchAll(PDO::FETCH_ASSOC);

        // Statistique des réponses par date (par jour)
        $reponsesParDateQuery = "
            SELECT DATE(date_reponse) as date, COUNT(*) as total_reponses 
            FROM reponse 
            GROUP BY DATE(date_reponse)";
        $reponsesParDate = $db->query($reponsesParDateQuery)->fetchAll(PDO::FETCH_ASSOC);

        // Retourner les statistiques sous forme de tableau
        return [
            'total' => $totalReponses,
            'par_reclamation' => $reponsesParReclamation,
            'par_date' => $reponsesParDate,
        ];
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

    

}
?>
