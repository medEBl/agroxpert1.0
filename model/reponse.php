<?php

class Reponse {
    private $id_reponse; // ID primaire
    private $id; // Clé étrangère
    private $reponse; // Texte de la réponse
    private $date_reponse; // Date de la réponse

    // Constructeur
    public function __construct( $id_reponse,  $id,  $reponse,  $date_reponse) {
        $this->id_reponse = $id_reponse;
        $this->id = $id;
        $this->reponse = $reponse;
        $this->date_reponse = $date_reponse;
    }

    // Getters et Setters
    public function getIdReponse() {
        return $this->id_reponse;
    }

    public function setIdReponse($id_reponse) {
        $this->id_reponse = $id_reponse;
    }

    public function getId() {
        return $this->id;
    }

    public function setId( $id) {
        $this->id = $id;
    }

    public function getReponse() {
        return $this->reponse;
    }

    public function setReponse($reponse){
        $this->reponse = $reponse;
    }

    public function getDateReponse() {
        return $this->date_reponse;
    }

    public function setDateReponse( $date_reponse) {
        $this->date_reponse = $date_reponse;
    }
}
?>
