<?php
class Produit {
    private ?int $id_produit;
    private ?string $nom;
    private ?float $prix;
    private ?string $description;
    private ?string $category;
    private ?int $stock_quantity;
    private ?float $rating;
    private ?float $discount;

    // Constructeur
    public function __construct(
        ?int $id_produit = null,
        ?string $nom = null,
        ?float $prix = null,
        ?string $description = null,
        ?string $category = null,
        ?int $stock_quantity = null,
        ?float $rating = null,
        ?float $discount = null
    ) {
        $this->id_produit = $id_produit;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->description = $description;
        $this->category = $category;
        $this->stock_quantity = $stock_quantity;
        $this->rating = $rating;
        $this->discount = $discount;
    }

    // Getters et setters
    public function getIdProduit(): ?int { return $this->id_produit; }
    public function getNom(): ?string { return $this->nom; }
    public function getPrix(): ?float { return $this->prix; }
    public function getDescription(): ?string { return $this->description; }
    public function getCategory(): ?string { return $this->category; }
    public function getStockQuantity(): ?int { return $this->stock_quantity; }
    public function getRating(): ?float { return $this->rating; }
    public function getDiscount(): ?float { return $this->discount; }

    public function setIdProduit(?int $id_produit): void { $this->id_produit = $id_produit; }
    public function setNom(?string $nom): void { $this->nom = $nom; }
    public function setPrix(?float $prix): void { $this->prix = $prix; }
    public function setDescription(?string $description): void { $this->description = $description; }
    public function setCategory(?string $category): void { $this->category = $category; }
    public function setStockQuantity(?int $stock_quantity): void { $this->stock_quantity = $stock_quantity; }
    public function setRating(?float $rating): void { $this->rating = $rating; }
    public function setDiscount(?float $discount): void { $this->discount = $discount; }
}
?>
