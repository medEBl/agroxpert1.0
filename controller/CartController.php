<?php


require_once __DIR__ . '../../config.php';
require_once 'userc.php';


if (!empty($_SESSION['id'])){
    $id_user =  $_SESSION['id'];}

class CartController {
    // Ajouter un produit au panier
    public function addToCart($id_produit, $quantity) {
        $db = config::getConnexion();
        $id_user = $_SESSION['id']; // Simulez un utilisateur connecté
    
        try {
            // Récupérer le prix et la quantité actuelle du produit
            $sql = "SELECT prix, stock_quantity FROM produit WHERE id_produit = :id_produit";
            $query = $db->prepare($sql);
            $query->execute(['id_produit' => $id_produit]);
            $produit = $query->fetch();
    
            if ($produit && $produit['stock_quantity'] >= $quantity) {
                $newStockQuantity = $produit['stock_quantity'] - $quantity;
    
                // Calculer le prix total avec les réductions automatiques
                $total_price = $produit['prix'] * $quantity;
                if ($quantity >= 10) {
                    $total_price *= 0.8; // 20% de réduction
                } elseif ($quantity >= 5) {
                    $total_price *= 0.9; // 10% de réduction
                }
    
                // Mettre à jour le stock
                $updateStock = "UPDATE produit SET stock_quantity = :stock_quantity WHERE id_produit = :id_produit";
                $db->prepare($updateStock)->execute([
                    'stock_quantity' => $newStockQuantity,
                    'id_produit' => $id_produit
                ]);
    
                // Ajouter ou mettre à jour le panier
                $checkCart = "SELECT * FROM t_cart WHERE id_produit = :id_produit AND id_user = :id_user";
                $cartQuery = $db->prepare($checkCart);
                $cartQuery->execute(['id_produit' => $id_produit, 'id_user' => $id_user]);
                $cartItem = $cartQuery->fetch();
    
                if ($cartItem) {
                    $newQuantity = $cartItem['quantity'] + $quantity;
                    $newTotalPrice = $produit['prix'] * $newQuantity;
    
                    // Appliquer les réductions automatiques
                    if ($newQuantity >= 10) {
                        $newTotalPrice *= 0.8;
                    } elseif ($newQuantity >= 5) {
                        $newTotalPrice *= 0.9;
                    }
    
                    $updateCart = "UPDATE t_cart SET quantity = :quantity, total_price = :total_price 
                                   WHERE id_produit = :id_produit AND id_user = :id_user";
                    $db->prepare($updateCart)->execute([
                        'quantity' => $newQuantity,
                        'total_price' => $newTotalPrice,
                        'id_produit' => $id_produit,
                        'id_user' => $id_user
                    ]);
                } else {
                    $insertCart = "INSERT INTO t_cart (id_produit, quantity, total_price, id_user) 
                                   VALUES (:id_produit, :quantity, :total_price, :id_user)";
                    $db->prepare($insertCart)->execute([
                        'id_produit' => $id_produit,
                        'quantity' => $quantity,
                        'total_price' => $total_price,
                        'id_user' => $id_user
                    ]);
                }
            } else {
                throw new Exception("Stock insuffisant pour ce produit.");
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout au panier : " . $e->getMessage());
        }
    }
    
    

    // Lister les produits du panier
    public function listCartItems($id_user) {
        $db = config::getConnexion();

        $sql = "SELECT c.id_cart, c.quantity, c.total_price, c.promo_code, p.nom, p.prix 
                FROM t_cart c 
                INNER JOIN produit p ON c.id_produit = p.id_produit 
                WHERE c.id_user = :id_user";
        $query = $db->prepare($sql);
        $query->execute(['id_user' => $id_user]);
        return $query->fetchAll();
    }

    // Appliquer un code promo
    public function applyPromoCode($id_user, $promo_code) {
        $db = config::getConnexion();

        $sql = "UPDATE t_cart SET promo_code = :promo_code WHERE id_user = :id_user";
        $query = $db->prepare($sql);

        try {
            $query->execute(['promo_code' => $promo_code, 'id_user' => $id_user]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Obtenir le code promo appliqué
    public function getPromoCode($id_user) {
        $db = config::getConnexion();

        $sql = "SELECT promo_code FROM t_cart WHERE id_user = :id_user LIMIT 1";
        $query = $db->prepare($sql);

        try {
            $query->execute(['id_user' => $id_user]);
            return $query->fetchColumn(); // Retourne le code promo
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Mettre à jour un produit dans le panier
    public function updateCartItem($id_cart, $new_quantity) {
        $db = config::getConnexion();
        $id_user = $_SESSION['id'];
    
        try {
            // Récupérer les informations actuelles
            $sql = "SELECT c.quantity, p.stock_quantity, p.prix, p.id_produit 
                    FROM t_cart c 
                    INNER JOIN produit p ON c.id_produit = p.id_produit 
                    WHERE c.id_cart = :id_cart AND c.id_user = :id_user";
            $query = $db->prepare($sql);
            $query->execute(['id_cart' => $id_cart, 'id_user' => $id_user]);
            $cartItem = $query->fetch();
    
            if ($cartItem) {
                $quantityDifference = $new_quantity - $cartItem['quantity'];
                $newStockQuantity = $cartItem['stock_quantity'] - $quantityDifference;
    
                if ($newStockQuantity < 0) {
                    throw new Exception("Quantité insuffisante en stock.");
                }
    
                // Mettre à jour le stock
                $updateStock = "UPDATE produit SET stock_quantity = :stock_quantity WHERE id_produit = :id_produit";
                $db->prepare($updateStock)->execute([
                    'stock_quantity' => $newStockQuantity,
                    'id_produit' => $cartItem['id_produit']
                ]);
    
                // Calculer le prix total avec les réductions
                $total_price = $new_quantity * $cartItem['prix'];
                if ($new_quantity >= 10) {
                    $total_price *= 0.8; // 20% de réduction
                } elseif ($new_quantity >= 5) {
                    $total_price *= 0.9; // 10% de réduction
                }
    
                // Mettre à jour le panier
                $updateCart = "UPDATE t_cart SET quantity = :quantity, total_price = :total_price 
                               WHERE id_cart = :id_cart AND id_user = :id_user";
                $db->prepare($updateCart)->execute([
                    'quantity' => $new_quantity,
                    'total_price' => $total_price,
                    'id_cart' => $id_cart,
                    'id_user' => $id_user
                ]);
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour du panier : " . $e->getMessage());
        }
    }
    
    
    
    
    

    // Supprimer un produit du panier
    public function deleteCartItem($id_cart) {
        $db = config::getConnexion();
        $id_user = $_SESSION['id']; // Simulez un utilisateur connecté
    
        try {
            // Obtenir les informations du produit à supprimer
            $sql = "SELECT c.quantity, p.stock_quantity, p.id_produit 
                    FROM t_cart c 
                    INNER JOIN produit p ON c.id_produit = p.id_produit 
                    WHERE c.id_cart = :id_cart AND c.id_user = :id_user";
            $query = $db->prepare($sql);
            $query->execute(['id_cart' => $id_cart, 'id_user' => $id_user]);
            $cartItem = $query->fetch();
    
            if ($cartItem) {
                $quantityToRestore = $cartItem['quantity'];
                $currentStockQuantity = $cartItem['stock_quantity'];
                $id_produit = $cartItem['id_produit'];
    
                // Restaurer la quantité dans le stock
                $newStockQuantity = $currentStockQuantity + $quantityToRestore;
                $updateStock = "UPDATE produit SET stock_quantity = :new_stock_quantity WHERE id_produit = :id_produit";
                $stockQuery = $db->prepare($updateStock);
                $stockQuery->execute([
                    'new_stock_quantity' => $newStockQuantity,
                    'id_produit' => $id_produit
                ]);
    
                // Supprimer l'élément du panier
                $deleteCart = "DELETE FROM t_cart WHERE id_cart = :id_cart AND id_user = :id_user";
                $cartQuery = $db->prepare($deleteCart);
                $cartQuery->execute([
                    'id_cart' => $id_cart,
                    'id_user' => $id_user
                ]);
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du produit du panier : " . $e->getMessage());
        }
    }



    

    public function getCartItem($id_cart) {
        $db = config::getConnexion();
        $sql = "SELECT id_produit, quantity FROM t_cart WHERE id_cart = :id_cart";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id_cart' => $id_cart]);
        return $stmt->fetch();
    }
    




    
}
?>
