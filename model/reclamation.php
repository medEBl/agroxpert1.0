<?php

class Reclamation {
    private $id; // Identifiant unique
    private  $datereclamation; // Date de la réclamation
    private  $description; // Description de la réclamation
    private  $statut; // Statut de la réclamation (ex: ouvert, fermé)
    private $id_user; // Identifiant de l'utilisateur
    private  $tel; // Téléphone de l'utilisateur
    private  $adresse; // Adresse de l'utilisateur

    // Constructor
    public function __construct(
         $id,
         $datereclamation,
         $description,
         $statut,
         $id_user,
         $tel,
       $adresse
    ) {
        $this->id = $id;
        $this->datereclamation = $datereclamation;
        $this->description = $description;
        $this->statut = $statut;
        $this->id_user = $id_user;
        $this->tel = $tel;
        $this->adresse = $adresse;
    }

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function setId( $id) {
        $this->id = $id;
    }

    public function getDatereclamation() {
        return $this->datereclamation;
    }

    public function setDatereclamation($datereclamation) {
        $this->datereclamation = $datereclamation;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription( $description) {
        $this->description = $description;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut){
        $this->statut = $statut;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($id_user){
        $this->id_user = $id_user;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel( $tel) {
        $this->tel = $tel;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse( $adresse){
        $this->adresse = $adresse;
    }
}
?>
