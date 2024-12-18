<?php
class Comment {
    private $id_c;
    private $texte;
    private $date_c;
    private $auteur;
    private $id_blog;

    public function __construct($id_c, $texte, $date_c, $auteur, $id_blog) {
        $this->id_c = $id_c;
        $this->texte = $texte;
        $this->date_c = $date_c;
        $this->auteur = $auteur;
        $this->id_blog = $id_blog;
    }

    // Getters
    public function getId() {
        return $this->id_c;
    }

    public function getTexte() {
        return $this->texte;
    }

    public function getDate() {
        return $this->date_c;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getIdBlog() {
        return $this->id_blog;
    }

    // Setters
    public function setTexte($texte) {
        $this->texte = $texte;
    }

    public function setDate($date_c) {
        $this->date_c = $date_c;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function setIdBlog($id_blog) {
        $this->id_blog = $id_blog;
    }
}
?>
