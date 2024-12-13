<?php
require_once '../../../controller/CartController.php';
require_once '../../../controller/produitController.php';

$cartController = new CartController();
$productController = new ProduitController();
$id_user = 1; // Simulez un utilisateur connecté

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cart'])) {
    $id_cart = intval($_POST['id_cart']);

    try {
        // Récupérer les informations du produit avant suppression
        $cart_item = $cartController->getCartItem($id_cart);
        $id_produit = $cart_item['id_produit'];
        $quantity = $cart_item['quantity'];

        // Supprimer l'article du panier
        $cartController->deleteCartItem($id_cart);

        // Soustraire la quantité vendue dans la table produit
        $productController->updateProductSales($id_produit, -$quantity);

        header('Location: cartList.php'); // Redirige vers la liste du panier
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
