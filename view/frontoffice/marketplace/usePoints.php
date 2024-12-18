<?php
session_start();
require_once '../../../controller/OrderController.php';
require_once '../../../controller/userc.php';


$orderController = new OrderController();

if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} // Inclus pour la mise à jour des ventes

if (isset($_POST['points_used'])) {
    $pointsToUse = intval($_POST['points_used']);

    try {
        $availablePoints = $orderController->getAvailablePoints($id_user);

        // Vérifier si les points demandés sont valides
        if ($pointsToUse > 0 && $pointsToUse <= $availablePoints) {
            // Nouvelle réduction à appliquer
            $reduction = $pointsToUse * 2.5;

            // Déduire les points et stocker la nouvelle réduction
            $orderController->usePoints($id_user, $pointsToUse);

            // Ajouter la réduction existante et recalculer proprement
            if (!isset($_SESSION['points_used_total'])) {
                $_SESSION['points_used_total'] = 0;
            }

            // Cumul des points utilisés
            $_SESSION['points_used_total'] += $pointsToUse;
            $_SESSION['points_reduction'] = $_SESSION['points_used_total'] * 2.5;

            $_SESSION['message'] = "Vous avez utilisé {$_SESSION['points_used_total']} points pour une réduction de {$_SESSION['points_reduction']} Dinars.";
        } else {
            $_SESSION['message'] = "Nombre de points invalide.";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }
}

// Redirection vers la page panier
header('Location: cartList.php');
exit;
?>
