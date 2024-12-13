<?php
require_once '../../../controller/OrderController.php';

$orderController = new OrderController();

$id_user = 1; // Simulez un utilisateur connecté (id_user = 1)

try {
    $orderController->addOrder($id_user);
    echo "Votre commande a été confirmée avec succès.";
    header('Location: listOrder.php');
    exit;
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
