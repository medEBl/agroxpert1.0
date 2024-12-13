<?php
require_once '../../../controller/CartController.php';
require_once '../../../controller/produitController.php';

$cartController = new CartController();
$productController = new ProduitController();
$id_user = 1; // Simulez un utilisateur connecté

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cart'], $_POST['quantity'])) {
    $id_cart = intval($_POST['id_cart']);
    $new_quantity = intval($_POST['quantity']);

    try {
        // Récupérer l'ancienne quantité et l'ID du produit
        $cart_item = $cartController->getCartItem($id_cart);
        $old_quantity = $cart_item['quantity'];
        $id_produit = $cart_item['id_produit'];

        // Mettre à jour la quantité dans le panier
        $cartController->updateCartItem($id_cart, $new_quantity);

        // Mettre à jour la quantité vendue dans la table produit
        $quantity_difference = $new_quantity - $old_quantity;
        $productController->updateProductSales($id_produit, $quantity_difference);

        header('Location: cartList.php'); // Redirige vers la liste du panier
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


