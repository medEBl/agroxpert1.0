<?php
class Blog {
    private $id_blog;
    private $image;
    private $titre;
    private $contenu;
    private $temps;
    private $id_category;  // Remplacer 'categorie' par 'id_category' pour refléter la relation avec la table category
    private $nb_vue;
    private $nb_comments;

    public function __construct($id_blog, $image, $titre, $contenu, $temps, $id_category, $nb_vue, $nb_comments) {
        $this->id_blog = $id_blog;
        $this->image = $image;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->temps = $temps;
        $this->id_category = $id_category;  // Initialisation de la clé étrangère id_category
        $this->nb_vue = $nb_vue;
        $this->nb_comments = $nb_comments;
    }

    // Getters
    public function getId() {
        return $this->id_blog;
    }

    public function getImage() {
        return $this->image;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getTemps() {
        return $this->temps;
    }

    public function getIdCategory() {
        return $this->id_category;  // Getter pour la clé étrangère id_category
    }

    public function getNb_vue() {
        return $this->nb_vue;
    }

    public function getNb_comments() {
        return $this->nb_comments;
    }

    // Setters
    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setTemps($temps) {
        $this->temps = $temps;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setIdCategory($id_category) {
        $this->id_category = $id_category;  // Setter pour la clé étrangère id_category
    }

    public function setNb_vue($nb_vue) {
        $this->nb_vue = $nb_vue;
    }

    public function setNb_comments($nb_comments) {
        $this->nb_comments = $nb_comments;
    }
}
?>
