<?php
require_once '../../../controller/OrderController.php';

$orderController = new OrderController();

if (isset($_POST['id_order']) && isset($_POST['status'])) {
    $id_order = (int) $_POST['id_order'];
    $status = htmlspecialchars($_POST['status']);

    try {
        $orderController->updateOrderStatus($id_order, $status);
        header('Location: manageOrders.php?success=1');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
