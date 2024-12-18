<?php
session_start();
require_once '../../../controller/OrderController.php';
require_once '../../../controller/userc.php';

$orderController = new OrderController();

if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} // Inclus pour la mise à jour des ventes

try {
    $orderController->addOrder($id_user);
    echo "Votre commande a été confirmée avec succès.";
    header('Location: listOrder.php');
    exit;
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
