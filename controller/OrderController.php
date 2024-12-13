<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../controller/CartController.php'; // Inclure le CartController

class OrderController {

// Ajouter une commande
public function addOrder($id_user, $finalPrice = null) {
    $db = config::getConnexion();
    $cartController = new CartController();
    $cartItems = $cartController->listCartItems($id_user);

    if (empty($cartItems)) {
        return false; // Panier vide
    }

    try {
        $db->beginTransaction();

        // Calculer le prix total si $finalPrice n'est pas fourni
        if ($finalPrice === null) {
            $finalPrice = 0;
            foreach ($cartItems as $item) {
                $finalPrice += $item['total_price'];
            }
        }

        // Calculer les points gagnés : 1 point pour chaque 10 Dinars
        $pointsEarned = floor($finalPrice / 10);

        // Insérer la commande dans la table `order`
        $sqlOrder = "INSERT INTO `order` (id_user, total_price, order_date, status, points_earned) 
                     VALUES (:id_user, :total_price, :order_date, :status, :points_earned)";
        $queryOrder = $db->prepare($sqlOrder);
        $queryOrder->execute([
            'id_user' => $id_user,
            'total_price' => $finalPrice,
            'order_date' => date('Y-m-d'),
            'status' => 'Pending',
            'points_earned' => $pointsEarned
        ]);

        // Vider le panier après la validation de la commande
        $sqlClearCart = "DELETE FROM t_cart WHERE id_user = :id_user";
        $queryClearCart = $db->prepare($sqlClearCart);
        $queryClearCart->execute(['id_user' => $id_user]);

        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollBack();
        throw new Exception("Erreur lors de la validation de l'achat : " . $e->getMessage());
    }
}


    // Lister les commandes d'un utilisateur
    public function listOrders($id_user) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM `order` WHERE id_user = :id_user ORDER BY order_date DESC";
        $query = $db->prepare($sql);
        $query->execute(['id_user' => $id_user]);
        return $query->fetchAll();
    }

    // Obtenir les détails d'une commande spécifique
    public function getOrderDetails($id_order) {
        $db = config::getConnexion();
        $sql = "SELECT * FROM `order` WHERE id_order = :id_order";
        $query = $db->prepare($sql);
        $query->execute(['id_order' => $id_order]);
        return $query->fetch();
    }






    // Fonction pour lister les commandes avec filtres
public function listOrdersBackOffice($user_id = null, $order_date = null, $status = null) {
    $db = config::getConnexion();
    $sql = "SELECT * FROM `order` WHERE 1";

    $params = [];
    if ($user_id) {
        $sql .= " AND id_user = :id_user";
        $params['id_user'] = $user_id;
    }
    if ($order_date) {
        $sql .= " AND order_date = :order_date";
        $params['order_date'] = $order_date;
    }
    if ($status) {
        $sql .= " AND status = :status";
        $params['status'] = $status;
    }

    $query = $db->prepare($sql);
    $query->execute($params);
    return $query->fetchAll();
}

// Fonction pour mettre à jour le statut d'une commande
public function updateOrderStatus($id_order, $status) {
    $db = config::getConnexion();
    $sql = "UPDATE `order` SET status = :status WHERE id_order = :id_order";
    $query = $db->prepare($sql);
    $query->execute([
        'status' => $status,
        'id_order' => $id_order
    ]);
}




public function getAvailablePoints($id_user) {
    $db = config::getConnexion();

    $sql = "SELECT SUM(points_earned - points_used) AS available_points 
            FROM `order` 
            WHERE id_user = :id_user";
    $query = $db->prepare($sql);
    $query->execute(['id_user' => $id_user]);

    return $query->fetchColumn();
}


public function usePoints($id_user, $pointsToUse) {
    $db = config::getConnexion();

    try {
        $db->beginTransaction();

        // Récupérer les commandes avec des points disponibles
        $sqlOrders = "SELECT id_order, points_earned, points_used 
                      FROM `order` 
                      WHERE id_user = :id_user AND (points_earned - points_used) > 0";
        $queryOrders = $db->prepare($sqlOrders);
        $queryOrders->execute(['id_user' => $id_user]);
        $orders = $queryOrders->fetchAll();

        $remainingPoints = $pointsToUse;

        foreach ($orders as $order) {
            $usablePoints = $order['points_earned'] - $order['points_used'];
            $pointsToDeduct = min($usablePoints, $remainingPoints);

            // Mettre à jour les points_used dans la commande
            $update = "UPDATE `order` SET points_used = points_used + :points WHERE id_order = :id_order";
            $db->prepare($update)->execute([
                'points' => $pointsToDeduct,
                'id_order' => $order['id_order']
            ]);

            $remainingPoints -= $pointsToDeduct;

            if ($remainingPoints <= 0) break;
        }

        $db->commit();
        return $pointsToUse - $remainingPoints; // Points réellement déduits
    } catch (Exception $e) {
        $db->rollBack();
        throw new Exception("Erreur lors de l'utilisation des points : " . $e->getMessage());
    }
}



}

?>
