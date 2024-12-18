<?php
// Inclusion des fichiers nécessaires
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/reclamation.php');
require_once 'userc.php';
if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} 
class ReclamationController
{
    // Liste de toutes les réclamations
    public function listReclamation()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Supprimer une réclamation par ID
    public function deleteReclamation($id)
    {
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Ajouter une nouvelle réclamation
    public function addReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation (datereclamation, description, statut, id_user, tel, adresse) 
                VALUES (:datereclamation, :description, :statut, :id_user, :tel, :adresse)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'datereclamation' => $reclamation->getDatereclamation()->format('Y-m-d'), // Formater la date
                'description' => $reclamation->getDescription(),
                'statut' => $reclamation->getStatut(),
                'id_user' => $reclamation->getIdUser(),
                'tel' => $reclamation->getTel(),
                'adresse' => $reclamation->getAdresse()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mettre à jour une réclamation existante
    public function updateReclamation($reclamation, $id)
    {
        $sql = "UPDATE reclamation SET 
                datereclamation = :datereclamation,
                description = :description,
                statut = :statut,
                id_user = :id_user,
                tel = :tel,
                adresse = :adresse
                WHERE id = :id";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'datereclamation' => $reclamation->getDatereclamation()->format('Y-m-d'), // Formater la date
                'description' => $reclamation->getDescription(),
                'statut' => $reclamation->getStatut(),
                'id_user' => $reclamation->getIdUser(),
                'tel' => $reclamation->getTel(),
                'adresse' => $reclamation->getAdresse()
            ]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Afficher une réclamation par ID
    public function showReclamation($id)
    {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $reclamation = $query->fetch(PDO::FETCH_ASSOC);
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Récupérer une réclamation par ID (version optimisée)
    public function getReclamationById($id)
    {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    
    // Récupérer les statistiques des réclamations
    public function getStatistics()
    {
        $db = config::getConnexion();
        try {
            // Total des réclamations
            $sqlTotal = "SELECT COUNT(*) AS total FROM reclamation";
            $totalStmt = $db->query($sqlTotal);
            $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Réclamations par statut
            $sqlStatut = "SELECT statut, COUNT(*) AS count FROM reclamation GROUP BY statut";
            $statutStmt = $db->query($sqlStatut);
            $statutData = $statutStmt->fetchAll(PDO::FETCH_ASSOC);

            // Formater les données
            $statutArray = [];
            foreach ($statutData as $row) {
                $statutArray[$row['statut']] = $row['count'];
            }

            return [
                'total' => $total,
                'statut' => $statutArray
            ];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

    

?>
