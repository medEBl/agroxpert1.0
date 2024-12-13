<?php
require_once '../../../controller/CartController.php';

$cartController = new CartController();
$id_user = 1; // Simulez un utilisateur connecté

// Liste des codes promo valides et leurs réductions associées
$validPromoCodes = [
    'SAVE10' => 10, // 10% de réduction
    'SAVE20' => 20, // 20% de réduction
    'SAVE30' => 30  // 30% de réduction
];

if (isset($_POST['promo_code']) && !empty($_POST['promo_code'])) {
    $promo_code = htmlspecialchars($_POST['promo_code']);

    if (array_key_exists($promo_code, $validPromoCodes)) {
        // Appliquer le code promo
        $cartController->applyPromoCode($id_user, $promo_code);

        // Calculer la réduction
        $reduction = $validPromoCodes[$promo_code];
        $cartItems = $cartController->listCartItems($id_user);

        foreach ($cartItems as $item) {
            $discountedPrice = $item['total_price'] * (1 - $reduction / 100);

            // Mettre à jour le prix total dans la base de données
            $db = config::getConnexion();
            $updateSql = "UPDATE t_cart SET total_price = :total_price WHERE id_cart = :id_cart";
            $query = $db->prepare($updateSql);
            $query->execute([
                'total_price' => $discountedPrice,
                'id_cart' => $item['id_cart']
            ]);
        }

        // Retourner un message de succès
        $_SESSION['message'] = "Promo code applied successfully!";
    } else {
        // Retourner un message d'erreur
        $_SESSION['message'] = "Invalid promo code.";
    }
}

header('Location: cartList.php');
exit;
?>
