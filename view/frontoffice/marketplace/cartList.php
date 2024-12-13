<?php
require_once '../../../controller/CartController.php';
require_once '../../../controller/OrderController.php';

session_start();

$cartController = new CartController();
$orderController = new OrderController();

$id_user = 1; // Simulez un utilisateur connecté
$cartItems = $cartController->listCartItems($id_user); // Récupération des articles du panier

// Calcul du prix total
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['total_price'];
}

// Vérification si le panier est vide
if (empty($cartItems)) {
    unset($_SESSION['points_reduction']);
    $totalPrice = 0;
    $reduction = 0;
} else {
    $reduction = isset($_SESSION['points_reduction']) ? $_SESSION['points_reduction'] : 0;
    $totalPrice -= $reduction;

    if ($totalPrice < 0) $totalPrice = 0;
}

$availablePoints = $orderController->getAvailablePoints($id_user);
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #333; }
        h1 { text-align: center; margin: 20px 0; font-size: 2em; color: #2c3e50; }
        .cart-container { max-width: 1000px; margin: 20px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); padding: 20px; }
        .cart-item { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding: 15px 0; }
        .cart-item div { flex: 1; }
        h3 { margin: 0; color: #2c3e50; }
        p { margin: 5px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table th, table td { padding: 10px; text-align: center; border-bottom: 1px solid #ddd; }
        table th { background-color: #27ae60; color: #fff; }
        input[type="number"] { width: 60px; padding: 5px; margin-right: 10px; }
        button { padding: 8px 12px; background-color: #3498db; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #2980b9; }
        .cart-summary { margin-top: 20px; text-align: center; font-size: 1.2em; background: #ecf0f1; padding: 15px; border-radius: 8px; }
        .promo-section { text-align: center; margin-top: 20px; }
        .promo-section input { padding: 8px; width: 200px; margin-right: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .promo-section button { background-color: #27ae60; }
        .promo-section button:hover { background-color: #1e8449; }
    </style>
</head>
<body>
    <div class="cart-container">
        <!-- Retour au Marketplace -->
        <div class="back-to-marketplace">
            <a href="shop.php" style="text-decoration: none; color: #3498db; font-weight: bold;">← Retour au Marketplace</a>
        </div>

        <!-- Titre -->
        <h1>Votre Panier</h1>

        <!-- Message de session -->
        <?php if ($message): ?>
            <p style="color: green; text-align: center;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Tableau des Produits -->
        <?php if (!empty($cartItems)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nom']); ?></td>
                            <td><?php echo number_format($item['prix'], 2); ?>D</td>
                            <td>
                                <form action="updateCart.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id_cart" value="<?php echo $item['id_cart']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit">Modifier</button>
                                </form>
                            </td>
                            <td><?php echo number_format($item['total_price'], 2); ?>D</td>
                            <td>
                                <?php 
                                if ($item['quantity'] >= 10) echo "20% réduction appliquée";
                                elseif ($item['quantity'] >= 5) echo "10% réduction appliquée";
                                else echo "Pas de réduction";
                                ?>
                            </td>
                            <td>
                                <form action="deleteCart.php" method="POST">
                                    <input type="hidden" name="id_cart" value="<?php echo $item['id_cart']; ?>">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Récapitulatif du Panier -->
            <div class="cart-summary">
                <h2>Total : <?php echo number_format($totalPrice, 2); ?>D</h2>
                <?php if ($reduction > 0): ?>
                    <p style="color: red;">Réduction appliquée : <?php echo number_format($reduction, 2); ?>D</p>
                <?php endif; ?>
                <form action="addOrder.php" method="POST">
                    <button type="submit">Confirmer l'achat</button>
                </form>
            </div>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2em; color: #888;">Votre panier est vide.</p>
        <?php endif; ?>

        <!-- Section Promo Code -->
        <div class="promo-section">
            <form action="applyPromoCode.php" method="POST">
                <input type="text" name="promo_code" placeholder="Entrez un code promo" required>
                <button type="submit">Appliquer</button>
            </form>
        </div>

        <!-- Points de fidélité -->
        <div class="promo-section">
            <form action="usePoints.php" method="POST">
                <label for="points_used">Utilisez vos points de fidélité :</label>
                <input type="number" name="points_used" id="points_used" 
                       max="<?php echo $availablePoints; ?>" min="0" placeholder="Entrez vos points" required>
                <button type="submit">Utiliser</button>
            </form>
            <p style="color: green;">Points disponibles : <?php echo $availablePoints; ?></p>
        </div>
    </div>
</body>
</html>
