<?php
include '../../../controller/produitController.php';

$productController = new ProduitController();

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET["id"])) {
    try {
        // Supprimer le produit
        $productController->deleteProduit($_GET["id"]);

        // Redirection après suppression
        header('Location: productList.php');
        exit();
    } catch (Exception $e) {
        // Afficher une erreur en cas de problème
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No product ID provided for deletion.";
}
?>
