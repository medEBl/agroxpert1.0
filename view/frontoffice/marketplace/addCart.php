<?php
session_start();
require_once '../../../controller/CartController.php';
require_once '../../../controller/produitController.php'; // Inclus pour la mise à jour des ventes
require_once '../../../controller/userc.php';


$cartController = new CartController();
$productController = new ProduitController();

if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];} // Inclus pour la mise à jour des ventes

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