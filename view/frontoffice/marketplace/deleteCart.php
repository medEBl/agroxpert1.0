<?php
session_start();

require_once '../../../controller/CartController.php';
require_once '../../../controller/produitController.php';
require_once '../../../controller/userc.php';


$cartController = new CartController();
$productController = new ProduitController();

if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} // Inclus pour la mise à jour des ventes

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
