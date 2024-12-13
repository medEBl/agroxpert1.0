<?php
require_once '../../../controller/CartController.php';
require_once '../../../controller/produitController.php'; // Inclus pour la mise à jour des ventes

$cartController = new CartController();
$productController = new ProduitController();
$id_user = 1; // Simulez un utilisateur connecté

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produit'], $_POST['quantity'])) {
    $id_produit = intval($_POST['id_produit']);
    $quantity = intval($_POST['quantity']);

    // Ajouter au panier
    $cartController->addToCart($id_produit, $quantity);

    // Mettre à jour les ventes dans la table produit
    $productController->updateProductSales($id_produit, $quantity);

    // Rediriger vers la page du marché
    header('Location: shop.php');
    exit;
}
?>