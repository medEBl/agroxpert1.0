<?php
class Produit {
    private  $id_produit;
    private $nom;
    private  $prix;
    private  $description;
    private  $category;
    private  $stock_quantity;
    private  $rating;
    private  $discount;

    // Constructeur
    public function __construct(
        $id_produit = null,
         $nom = null,
         $prix = null,
         $description = null,
         $category = null,
         $stock_quantity = null,
         $rating = null,
         $discount = null
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
    public function getIdProduit() { return $this->id_produit; }
    public function getNom(){ return $this->nom; }
    public function getPrix() { return $this->prix; }
    public function getDescription() { return $this->description; }
    public function getCategory(){ return $this->category; }
    public function getStockQuantity(){ return $this->stock_quantity; }
    public function getRating() { return $this->rating; }
    public function getDiscount(){ return $this->discount; }

    public function setIdProduit( $id_produit) { $this->id_produit = $id_produit; }
    public function setNom( $nom) { $this->nom = $nom; }
    public function setPrix( $prix) { $this->prix = $prix; }
    public function setDescription( $description) { $this->description = $description; }
    public function setCategory($category) { $this->category = $category; }
    public function setStockQuantity( $stock_quantity){ $this->stock_quantity = $stock_quantity; }
    public function setRating( $rating){ $this->rating = $rating; }
    public function setDiscount( $discount) { $this->discount = $discount; }
}
?>
