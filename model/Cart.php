<?php
class Cart {
    private ?int $id_cart;
    private ?int $id_produit;
    private ?int $quantity;
    private ?float $total_price;
    private ?int $id_user; // Ajout de l'id_user
    private ?string $promo_code; // Code promo appliqué

    public function __construct(?int $id_cart = null, ?int $id_produit = null, ?int $quantity = null, ?float $total_price = null, ?int $id_user = null , ?string $promo_code = null) {
        $this->id_cart = $id_cart;
        $this->id_produit = $id_produit;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
        $this->id_user = $id_user; // Initialiser id_user
        $this->promo_code = $promo_code; // Initialiser promo_code
    }

    // Getters
    public function getIdCart(): ?int { return $this->id_cart; }
    public function getIdProduit(): ?int { return $this->id_produit; }
    public function getQuantity(): ?int { return $this->quantity; }
    public function getTotalPrice(): ?float { return $this->total_price; }
    public function getIdUser(): ?int { return $this->id_user; } // Getter pour id_user
    public function getPromoCode(): ?string { return $this->promo_code; } // Getter pour promo_code


    // Setters
    public function setIdCart(?int $id_cart): void { $this->id_cart = $id_cart; }
    public function setIdProduit(?int $id_produit): void { $this->id_produit = $id_produit; }
    public function setQuantity(?int $quantity): void { $this->quantity = $quantity; }
    public function setTotalPrice(?float $total_price): void { $this->total_price = $total_price; }
    public function setIdUser(?int $id_user): void { $this->id_user = $id_user; } // Setter pour id_user
    public function setPromoCode(?string $promo_code): void { $this->promo_code = $promo_code; } // Setter pour promo_code

}
?>
