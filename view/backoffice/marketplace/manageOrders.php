<?php
require_once '../../../controller/OrderController.php';

$orderController = new OrderController();

// Récupérer les paramètres de recherche
$search_user = $_GET['user'] ?? null;
$search_date = $_GET['date'] ?? null;
$search_status = $_GET['status'] ?? null;

// Récupérer les commandes
$orders = $orderController->listOrdersBackOffice($search_user, $search_date, $search_status);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            color: #34495e;
            margin-top: 20px;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .filter-form {
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: space-around;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-form input, .filter-form select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filter-form button {
            padding: 10px 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-form button:hover {
            background-color: #1e8449;
        }

        .update-status {
            padding: 5px 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-status:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Manage Orders</h1>

    <form class="filter-form" method="GET" action="">
        <input type="text" name="user" placeholder="User ID" value="<?php echo htmlspecialchars($search_user); ?>">
        <input type="date" name="date" value="<?php echo htmlspecialchars($search_date); ?>">
        <select name="status">
            <option value="">All Status</option>
            <option value="Pending" <?php echo ($search_status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Shipped" <?php echo ($search_status == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
            <option value="Delivered" <?php echo ($search_status == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php if (empty($orders)): ?>
        <p style="text-align: center; color: #e74c3c;">No orders found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id_order']); ?></td>
                        <td><?php echo htmlspecialchars($order['id_user']); ?></td>
                        <td><?php echo number_format($order['total_price'], 2); ?>D</td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td>
                            <form action="updateOrderStatus.php" method="POST" style="display: inline-block;">
                                <input type="hidden" name="id_order" value="<?php echo $order['id_order']; ?>">
                                <select name="status">
                                    <option value="Pending">Pending</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                                <button class="update-status" type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
