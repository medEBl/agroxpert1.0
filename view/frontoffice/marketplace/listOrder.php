<?php
session_start();

require_once '../../../controller/OrderController.php';
require_once '../../../controller/userc.php';


$orderController = new OrderController();

if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} // Inclus pour la mise à jour des ventes
    
$orders = $orderController->listOrders($id_user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #2c3e50;
            margin: 20px 0;
            font-weight: 700;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        /* Order Card */
        .order-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            margin: 20px 0;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .order-details h3 {
            margin: 0;
            font-size: 1.2em;
            color: #27ae60;
        }

        .order-details p {
            margin: 5px 0;
            font-size: 1em;
            color: #555;
        }

        /* Order Status - Styles spécifiques */
        .order-status {
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 20px;
            text-transform: uppercase;
            font-size: 0.9em;
            display: inline-block;
            min-width: 100px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .status-pending {
            background-color: #f39c12; /* Jaune doré */
            color: #fff !important;
        }

        .status-shipped {
            background-color: #3498db; /* Bleu clair */
            color: #fff !important;
        }

        .status-delivered {
            background-color: #2ecc71; /* Vert vif */
            color: #fff !important;
        }

        /* No Orders Message */
        .no-orders {
            text-align: center;
            margin: 50px 0;
            font-size: 1.5em;
            color: #e74c3c;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .order-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <h1>Your Order History</h1>
    <div class="container">
        <?php if (empty($orders)): ?>
            <p class="no-orders">No orders found. <i class="fa-solid fa-box-open"></i></p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="order-details">
                        <h3>Order #<?php echo htmlspecialchars($order['id_order']); ?></h3>
                        <p><strong>Total Price:</strong> <?php echo number_format($order['total_price'], 2); ?> D</p>
                        <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                    </div>
                    <div class="order-status 
                        <?php 
                            echo ($order['status'] === 'Pending') ? 'status-pending' :
                                 (($order['status'] === 'Shipped') ? 'status-shipped' : 'status-delivered');
                        ?>">
                        <?php echo htmlspecialchars($order['status']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
